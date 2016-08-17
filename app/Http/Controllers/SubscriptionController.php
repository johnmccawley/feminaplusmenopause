<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use App\User;
use App\Cart;
use App\Purchase;
use \Stripe\Stripe;
use \Stripe\Plan as Plan;
use Illuminate\Http\Request;

use App\Http\Requests;

class SubscriptionController extends Controller
{
    private $user, $userId;

    public function __construct()
    {
        $this->setApiKey();
        $this->user = (Auth::user()) ? User::findOrFail(Auth::user()->id) : null;
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->verifyPurchase($request)) {
            $plan = Plan::retrieve('fpClub');
            $displayTotal = $this->formatDisplayPrice($plan->amount);
            $cartItems = json_decode("{'fpClub':{'amount':1,'type':'plan','name':'Femina Plus Club Refill','description':'1 Bottle a Month for 12 Months (13th Bottle Free!)','price':$plan->amount,'display_price':$displayTotal}}");
            $sessionToken = $request->session()->get('_token');
            $transactionId = ($request->input('paymentId')) ? $request->input('paymentId') : null;
            $customerData = $this->setShippingInfo($request);

            $this->createPurchase($transactionId, $sessionToken, $customerData, 'complete', $cartItems, $cartItems->price, 'paypal');

            $this->fullfillmentEmail($customerData->shipping, $cartItems);

            return view('receipt', ['customerData' => $customerData, 'cartItems' => $cartItems, 'total' => $displayTotal]);
        }

        return redirect('/');
    }

    private function verifyPurchase($request) {
        return true;
    }

//    public function test(Request $request) {
//        $clientId = env('PAYPAL_CLIENT');
//        $secret = env('PAYPAL_SECRET');
//        $url = (env('APP_ENV') == 'production') ? 'paypal' : 'sandbox.paypal';
//        $id = "I-UDYLF176YBEP";
//
//        $tokenResponse = json_decode(exec("curl -v https://api.$url.com/v1/oauth2/token -H \"Accept: application/json\" -H \"Accept-Language: en_US\" -u \"$clientId:$secret\" -d \"grant_type=client_credentials\""));
//
//        return exec("curl -v GET https://api.sandbox.paypal.com/v1/payments/billing-agreements/$id -H 'Content-Type:application/json' -H 'Authorization: Bearer $tokenResponse->access_token'");
//    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        // 
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
    public function destroy()
    {
        try {
            $response = $this->user->subscription('primary')->cancel();
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect('/home');
    }

    private function setShippingInfo($request) {
        $customerData = (object)['shipping' => (object)[]];

        $customerData->shipping->firstName = $request->input('shipping-name-first');
        $customerData->shipping->lastName = $request->input('shipping-name-last');
        $customerData->shipping->email = $request->input('shipping-email');
        $customerData->shipping->phone = $request->input('shipping-phone');
        $customerData->shipping->addressOne = $request->input('shipping-address-1');
        $customerData->shipping->addressTwo = ($request->input('shipping-address-2')) ? $request->input('shipping-address-2') : null;
        $customerData->shipping->city = $request->input('shipping-city');
        $customerData->shipping->state = $request->input('shipping-state');
        $customerData->shipping->zip = $request->input('shipping-zip');

        return $customerData;
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
            $message->from('fullfillment@mg.feminaplusmenopause.com', 'Femina Plus');
            $message->to(env('FULLFILL_EMAIL_ONE'), null)->subject('FULLFILLMENT REQUEST');
            $message->cc(env('FULLFILL_EMAIL_TWO'), null)->subject('FULLFILLMENT REQUEST');
        });
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
