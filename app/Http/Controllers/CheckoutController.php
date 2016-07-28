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
    private $user, $userId;

    function __construct() {
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
            // Retrieves cart
            $cartDbEntry = $this->retrieveCartDatabaseEntry($request);
            $cart = Cart::findOrFail($cartDbEntry->id);
            if (is_null($cart->items)) {
                return redirect('/cart');
            }

            // Gets cart items
            $cartItems = json_decode($cart->items);
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
                $this->createPurchase($response->stripe_id, $purchased, $amount->plan);
            }

            if ($amount->product > 0) {
                $source = $this->getSource($request);
                $response = $this->user->charge(($amount->product), ['source' => $source]);
                unset($itemsPurchased['fpClub']);
                $this->createPurchase($response->id, $itemsPurchased, $amount->product);
            }

            if (isset($response)) {
                $displayTotal = $cart->total;
                $cart->items = null;
                $cart->total = null;
                $cart->save();

                $this->fullfillmentEmail($request, $cartItems);
            }

             return $this->receipt($request, $cartItems, $displayTotal);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }
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
            $cartDbEntry = $this->retrieveCartDatabaseEntry($request);

            if ($cartDbEntry) {
                $cartItems = json_decode($cartDbEntry->items);
                $total = $cartDbEntry->total;

                foreach ($cartItems as $key => $item) {
                    if ($item->type == 'plan' && Auth::guest()) {
                        return view('auth.login', ['required' => true]);
                    }
                }

                if (Auth::guest()) {
                    $this->user = null;
                } else if ($this->user && isset($this->user->name)) {
                    $name = explode(" ", $this->user->name);
                    $this->user->first_name = $name[0];
                    $this->user->last_name = $name[1];
                }

                return view('checkout', ['cartItems' => $cartItems, 'total' => $total, 'user' => $this->user]);
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

            $cartDbEntry = $this->retrieveCartDatabaseEntry($request);
            $cart = Cart::findOrFail($cartDbEntry->id);

            if ($coupon) {
                $this->checkIfCodeAlreadyUsed($coupon->code, $cart);
                
                if (isset($coupon->discount_percent)) {
                    $cart->charge_total -= intval($cart->charge_total * ($coupon->discount_percent / 100));

                    $cart->codes_applied = $this->addToAppliedCoupons($coupon->code, $cart);
                } else if (isset($coupon->discount_amount)) {
                    $cart->charge_total -= intval($coupon->discount_amount * 100);

                    $cart->charge_total = ($cart->charge_total < 0) ? 0 : $cart->charge_total;

                    $cart->codes_applied = $this->addToAppliedCoupons($coupon->code, $cart);
                }

                $cart->total = $this->formatDisplayPrice($cart->charge_total);
                $cart->save();
            } else {
                throw new \Exception("Coupon code doesn't exist");
            }
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return back();
    }

    private function addToAppliedCoupons($couponCode, $cart) {
        if ($cart->codes_applied) {
            $codesApplied = json_decode($cart->codes_applied);
            $codesApplied->$couponCode = true;
        } else {
            $codesApplied = (object)[$couponCode => true];
        }

        return json_encode($codesApplied);
    }

    private function checkIfCodeAlreadyUsed($code, $cart) {
        if ($cart->codes_applied) {
            $codesApplied = json_decode($cart->codes_applied);

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

    public function receipt($request, $cartItems, $total) {
        return view('receipt', ['request' => $request, 'cartItems' => $cartItems, 'total' => $total]);
    }

    private function setUserData($request) {
        $userData = (object)[];
        if ($request->input('billing-same')) {
            $userData->firstName = $request->input('billing-name-first');
            $userData->lastName = $request->input('billing-name-last');
            $userData->email = $request->input('billing-email');
            $userData->phone = $request->input('billing-phone');
            $userData->addressOne = $request->input('billing-address-1');
            $userData->addressTwo = ($request->input('billing-address-2')) ? $request->input('billing-address-2') : null;
            $userData->city = $request->input('billing-city');
            $userData->state = $request->input('billing-state');
            $userData->zip = $request->input('billing-zip');
        } else {
            $userData->firstName = $request->input('shipping-name-first');
            $userData->lastName = $request->input('shipping-name-last');
            $userData->email = $request->input('shipping-email');
            $userData->phone = $request->input('shipping-phone');
            $userData->addressOne = $request->input('shipping-address-1');
            $userData->addressTwo = ($request->input('shipping-address-2')) ? $request->input('shipping-address-2') : null;
            $userData->city = $request->input('shipping-city');
            $userData->state = $request->input('shipping-state');
            $userData->zip = $request->input('shipping-zip');
        }

        return $userData;
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

    private function createPurchase($transactionId, $itemsPurchased, $amount) {
        // Local database log entry of purchases
        if (isset($transactionId)) {
            Purchase::create([
                'user_id' => $this->userId,
                'items' => json_encode($itemsPurchased),
                'amount' => $amount,
                'stripe_transaction_id' => $transactionId,
            ]);
        }
    }

    private function fullfillmentEmail($request, $purchased) {
        $userData = $this->setUserData($request);

        Mail::send('emails.fullfill', ['userData' => $userData, 'purchased' => $purchased], function ($message) use ($userData, $purchased) {
           $message->from('fullfillment@mg.feminaplus.com', 'Femina Plus');
           $message->to(env('FULLFILL_EMAIL_ONE'), null)->subject('FULLFILLMENT REQUEST');
           $message->cc(env('FULLFILL_EMAIL_TWO'), null)->subject('FULLFILLMENT REQUEST');
       });
    }

    private function retrieveCartDatabaseEntry($request) {
        $token = $request->session()->get('_token');
        return DB::table('carts')->where('token', $token)->first();
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
