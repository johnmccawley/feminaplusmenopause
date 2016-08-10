<?php

namespace App\Http\Controllers;

use DB as DB;
use App\User;
use App\Cart;
use App\Coupon;
use App\Purchase;
use \Stripe\Stripe as Stripe;
use \Stripe\Token as Token;
use \Stripe\Charge as Charge;
use \Stripe\Subscription as Subscription;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest as CheckoutRequest;

use Auth;
use Mail;
use App\Http\Requests;

class CheckoutController extends Controller
{
    private $user, $userId, $cart;

    function __construct(Request $request) {
        $this->cart = $this->retrieveCartDatabaseEntry($request);
        $this->setApiKey();
        $this->user = (Auth::user()) ? User::findOrFail(Auth::user()->id) : new User();
        $this->userId = (Auth::user()) ? Auth::user()->id : null;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CheckoutRequest $request)
    {
        try {
            if (is_null($this->cart->items)) {
                throw new \Exception('Cart is empty');
            }

            if ($request->input('card-submit') == 'card') {
                return $this->creditCardPayment($request);
            } else if ($request->input('paypal-submit') == 'paypal') {
                return $this->paypalPayment($request);
            } else {
                throw new \Exception('Invalid payment selection');
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    private function creditCardPayment($request) {
        // Gets cart items
        $cartItems = json_decode($this->cart->items);
        $sessionToken = $request->session()->get('_token');
        $customerData = $this->setCustomerData($request);
        $amount = (object)['total' => 0, 'product' => 0, 'plan' => 0];
        foreach($cartItems as $key => $item) {
            $itemsPurchased[$key] = ['product' => $key, 'amount' => $item->amount, 'price' => $item->price];

            $amount->total += $item->price;
            if ($item->type == 'product') {
                $amount->product += $item->price;
            } else if ($item->type == 'plan') {
                $amount->plan += $item->price;
            }
        }

        // Determines if a subscription or product is being bought
        if (isset($itemsPurchased['fpClub'])) {
            $source = $this->getSource($request);

            $response = $this->user->newSubscription('primary', 'fpClub')->create($source->id, ['email' => $request->input('billing-email')]);

            $purchased = (object)['fpClub' => $itemsPurchased['fpClub']];
            $this->createPurchase($response->stripe_id, $sessionToken, $customerData, 'complete', $purchased, $amount->plan, 'stripe');
        }

        if ($amount->product > 0) {
            $source = $this->getSource($request);

            $response = $this->user->charge(($amount->product), ['source' => $source]);

            unset($itemsPurchased['fpClub']);
            $this->createPurchase($response->id, $sessionToken, $customerData, 'complete', $itemsPurchased, $amount->product, 'stripe');
        }

        if (is_null($response)) {
            throw new \Exception('Failed to make purchase');
        }

        $cartTotal = $this->cart->total;
        $this->cart->items = null;
        $this->cart->total = null;
        $this->cart->save();

        $this->fullfillmentEmail($customerData->shipping, $cartItems);

        return $this->receipt($customerData, $cartItems, $cartTotal);
    }

    private function paypalPayment($request) {
        $cartItems = json_decode($this->cart->items);
        foreach ($cartItems as $key => $item) {
            if ($item->type == 'plan') {
                throw new \Exception("You can't purchase Femina Plus Club through paypal at this time, we apologize for the inconvenience.");
            }
        }

        $clientId = env('PAYPAL_CLIENT');
        $secret = env('PAYPAL_SECRET');
        $url = (env('APP_ENV') == 'production') ? 'paypal' : 'sandbox.paypal';

        $tokenResponse = json_decode(exec("curl -v https://api.$url.com/v1/oauth2/token -H \"Accept: application/json\" -H \"Accept-Language: en_US\" -u \"$clientId:$secret\" -d \"grant_type=client_credentials\""));

        $sessionToken = $request->session()->get('_token');
        $customerData = $this->setCustomerData($request);
        $this->createPurchase(null, $sessionToken, $customerData, 'created', json_decode($this->cart->items), $this->cart->charge_total, 'paypal');

        $total = $this->cart->charge_total/100;
        $returnUrl = env('APP_URL') . '/paymentComplete';
        $cancelUrl = env('APP_URL') . '/paymentCancelled';

        $response = json_decode(exec("curl -v https://api.$url.com/v1/payments/payment -H \"Content-Type: application/json\" -H \"Authorization: Bearer $tokenResponse->access_token\" -d '{\"intent\":\"sale\",\"redirect_urls\":{\"return_url\":\"$returnUrl\",\"cancel_url\":\"$cancelUrl\"},\"payer\":{\"payment_method\":\"paypal\"},\"transactions\":[{\"amount\":{\"total\":\"$total\",\"currency\":\"USD\"}}]}'"));

        foreach($response->links as $link) {
            if ($link->method == 'REDIRECT') {
                $redirect = $link->href;
                break;
            }
        }

        if (isset($redirect)) {
            return redirect($redirect);
        } else {
            throw new \Exception('Paypal authentication failed!');
        }
    }

    private function paypalBillingPlan($accessToken, $url) {
//        json_decode(exec("curl -v POST https://api.$url.com/v1/payments/billing-plans -H 'Content-Type:application/json' -H 'Authorization: Bearer $accessToken' -d '{\"name\": \"T-Shirt of the Month Club Plan\",\"description\": \"Template creation.\",\"type\": \"fixed\",\"payment_definitions\": [{\"name\": \"Regular Payments\",\"type\": \"REGULAR\",\"frequency\": \"MONTH\",\"frequency_interval\": \"2\",\"amount\": {\"value\": \"100\",\"currency\": \"USD\"},\"cycles\": \"12\",\"charge_models\": [{\"type\": \"SHIPPING\",\"amount\": {\"value\": \"10\",\"currency\": \"USD\"}},{\"type\": \"TAX\",\"amount\": {\"value\": \"12\",\"currency\": \"USD\"}}]}],\"merchant_preferences\": {\"setup_fee\": {\"value\": \"1\",\"currency\": \"USD\"},\"return_url\": \"http://www.return.com\",\"cancel_url\": \"http://www.cancel.com\",\"auto_bill_amount\": \"YES\",\"initial_fail_amount_action\": \"CONTINUE\",\"max_fail_attempts\": \"0\"}}"));
    }

    public function paymentComplete(Request $request) {
        $cartItems = json_decode($this->cart->items);
        if ($request->input('paymentId') && $request->input('token') && $request->input('PayerID')) {
            $purchaseDbEntry = DB::table('purchases')->orderBy('created_at', 'desc')->where('token', $request->session()->get('_token'))->first();
            $purchase = Purchase::findOrFail($purchaseDbEntry->id);

            $purchase->transaction_id = $request->input('paymentId');
            $purchase->purchase_status = 'complete';
            $purchase->save();

            $this->cart->items = null;
            $this->cart->total = null;
            $this->cart->save();

            $customerData = json_decode($purchase->customer_info);

            $this->fullfillmentEmail($customerData->shipping, $cartItems);

            $displayTotal = $this->formatDisplayPrice($purchase->amount);
            return $this->receipt($customerData, $cartItems, $displayTotal);
        }

        return redirect('/');
    }

    public function paymentCancelled(Request $request) {
        if (!$request->input('paymentId') && $request->input('token') && !$request->input('PayerID')) {
            $purchaseDbEntry = DB::table('purchases')->orderBy('created_at', 'desc')->where('token', $request->session()->get('_token'))->first();
            $purchase = Purchase::findOrFail($purchaseDbEntry->id);

            $purchase->purchase_status = 'cancelled';
            $purchase->save();
        }

        return redirect('/');
    }

    private function receipt($customerData, $cartItems, $cartTotal) {
        return view('receipt', ['customerData' => $customerData, 'cartItems' => $cartItems, 'total' => $cartTotal]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            if ($this->cart) {
                $cartItems = json_decode($this->cart->items);
                $subscription = DB::table('subscriptions')->where('user_id', $this->userId)->first();

                foreach ($cartItems as $key => $item) {
                    if ($item->type == 'plan' && Auth::guest()) {
                        return view('auth.login', ['required' => true]);
                    } else if ($item->type == 'plan' && $subscription->ends_at == null) {
                        throw new \Exception('You already have a femina plus club subscription');
                    }
                }

                if (Auth::guest()) {
                    $this->user = null;
                } else if ($this->user && isset($this->user->name)) {
                    $name = explode(" ", $this->user->name);
                    $this->user->first_name = $name[0];
                    $this->user->last_name = $name[1];
                }

                return view('checkout', ['cartItems' => $cartItems, 'total' => $this->cart->total, 'user' => $this->user]);
            } else {
                return redirect('/cart');
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function applyCoupon(Request $request) {
        try {
            $coupon = Coupon::where('code', $request->input('coupon-code'))->first();

            if ($coupon) {
                $this->checkIfCodeAlreadyUsed($coupon->code);

                if ($coupon->discount_type == 'percent') {
                    $this->cart->charge_total -= intval($this->cart->charge_total * ($coupon->discount_amount / 100));

                    $this->cart->codes_applied = $this->addToAppliedCoupons($coupon->code);
                } else if ($coupon->discount_type == 'amount') {
                    $this->cart->charge_total -= intval($coupon->discount_amount * 100);

                    $this->cart->charge_total = ($this->cart->charge_total < 0) ? 0 : $this->cart->charge_total;

                    $this->cart->codes_applied = $this->addToAppliedCoupons($coupon->code);
                }

                $this->cart->total = $this->formatDisplayPrice($this->cart->charge_total);
                $this->cart->save();
            } else {
                throw new \Exception("Coupon code doesn't exist");
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return back();
    }

    private function addToAppliedCoupons($couponCode) {
        if ($this->cart->codes_applied) {
            $codesApplied = json_decode($this->cart->codes_applied);
            $codesApplied->$couponCode = true;
        } else {
            $codesApplied = (object)[$couponCode => true];
        }

        return json_encode($codesApplied);
    }

    private function checkIfCodeAlreadyUsed($code) {
        if ($this->cart->codes_applied) {
            $codesApplied = json_decode($this->cart->codes_applied);

            if (isset($codesApplied->$code)) {
                throw new \Exception("Code already used!");
            }
        }
    }

    private function formatDisplayPrice($amount) {
        $displayPrice = '$' . $amount / 100;
        if (strpos($displayPrice, '.')) {
            $explodedPrice = explode('.', $displayPrice);
            if (strlen($explodedPrice[1]) == 1) {
                $displayPrice .= '0';
            }
        } else {
            $displayPrice .= '.00';
        }

        return $displayPrice;
    }

    private function setCustomerData($request) {
        $billingAddressTwo = $request->input('billing-address-2');
        $shippingAddressTwo = $request->input('shipping-address-2');
        $customerData = (object)['billing' => (object)[], 'shipping' => (object)[]];

//        Billing information
        $customerData->billing->firstName = $request->input('billing-name-first');
        $customerData->billing->lastName = $request->input('billing-name-last');
        $customerData->billing->email = $request->input('billing-email');
        $customerData->billing->phone = $request->input('billing-phone');
        $customerData->billing->addressOne = $request->input('billing-address-1');
        $customerData->billing->addressTwo = ($billingAddressTwo) ? $billingAddressTwo : null;
        $customerData->billing->city = $request->input('billing-city');
        $customerData->billing->state = $request->input('billing-state');
        $customerData->billing->zip = $request->input('billing-zip');

//        Shipping Information
        $customerData->shipping->firstName = ($request->input('shipping-name-first')) ? $request->input('shipping-name-first') : $request->input('billing-name-first');
        $customerData->shipping->lastName = ($request->input('shipping-name-last')) ? $request->input('shipping-name-last') : $request->input('billing-name-last');
        $customerData->shipping->email = ($request->input('shipping-email')) ? $request->input('shipping-email') : $request->input('billing-email');
        $customerData->shipping->phone = ($request->input('shipping-phone')) ? $request->input('shipping-phone') : $request->input('billing-phone');
        $customerData->shipping->addressOne = ($request->input('shipping-address-1')) ? $request->input('shipping-address-1') : $request->input('billing-address-1');
        if ($shippingAddressTwo) {
            $customerData->shipping->addressTwo = $shippingAddressTwo;
        } else if ($billingAddressTwo) {
            $customerData->shipping->addressTwo = $billingAddressTwo;
        } else {
            $customerData->shipping->addressTwo = null;
        }
        $customerData->shipping->city = ($request->input('shipping-city')) ? $request->input('shipping-city') : $request->input('billing-city');
        $customerData->shipping->state = ($request->input('shipping-state')) ? $request->input('shipping-state') : $request->input('billing-state');
        $customerData->shipping->zip = ($request->input('shipping-zip')) ? $request->input('shipping-zip') : $request->input('billing-zip');

        return $customerData;
    }

    private function getSource($request) {
        $cardExpiration = explode('/', $request->cardExpiration);
        return Token::create(array(
            'card' => array(
                'name'          => $request->cardName,
                'number'        => $request->cardNumber,
                'exp_month'     => $cardExpiration[0],
                'exp_year'      => $cardExpiration[1],
                'cvc'           => $request->cardCvc,
                'address_line1' => $request->input('billing-address-1'),
                'address_line2' => $request->input('billing-address-2'),
                'address_city'  => $request->input('billing-city'),
                'address_state' => $request->input('billing-state'),
                'address_zip'   => $request->input('billing-zip')
            )
        ));
    }

    private function createPurchase($transactionId, $sessionToken, $customerData, $purchaseStatus, $itemsPurchased, $amount, $processor) {
        // Local database log entry of purchases
        Purchase::create([
            'user_id' => $this->userId,
            'token' => $sessionToken,
            'customer_info' => json_encode($customerData),
            'purchase_status' => $purchaseStatus,
            'items' => json_encode($itemsPurchased),
            'amount' => $amount,
            'payment_processor' => $processor,
            'transaction_id' => $transactionId
        ]);
    }

    private function fullfillmentEmail($customerData, $purchased) {
        Mail::send('emails.fullfill', ['customerData' => $customerData, 'purchased' => $purchased], function ($message) use ($customerData, $purchased) {
           $message->from('fullfillment@mg.feminaplus.com', 'Femina Plus');
           $message->to(env('FULLFILL_EMAIL_ONE'), null)->subject('FULLFILLMENT REQUEST');
           $message->cc(env('FULLFILL_EMAIL_TWO'), null)->subject('FULLFILLMENT REQUEST');
       });
    }

    private function retrieveCartDatabaseEntry($request) {
        $token = $request->session()->get('_token');
        $cartDbEntry = DB::table('carts')->where('token', $token)->first();
        return Cart::findOrFail($cartDbEntry->id);
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
