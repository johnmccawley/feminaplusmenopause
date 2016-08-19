<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Mail;
use Log;
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
//        $plan = Plan::retrieve('fpClub');
//        $displayTotal = $this->formatDisplayPrice($plan->amount);
//        $cartItems = json_decode('{"fpClub":{"amount":1,"type":"plan","name":"Femina Plus Club Refill","description":"1 Bottle a Month for 12 Months (13th Bottle Free!)","price":' . $plan->amount . ',"display_price":"' . $displayTotal . '"}}');
//        $sessionToken = $request->session()->get('_token');
//        $transactionId = ($request->input('subscr_id')) ? $request->input('subscr_id') : null;
//        $customerData = $this->setShippingInfo($request);
//
//        $this->createPurchase($transactionId, $sessionToken, $customerData, 'complete', $cartItems, $cartItems->fpClub->price, 'paypal');
//
//        $this->fullfillmentEmail($customerData->shipping, $cartItems);
        Log::info("Got an IPN message from PayPal");
        return header("Status: 200");
    }

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

//        $customerData->shipping->firstName = ($request->input('first_name')) ? $request->input('last_name') : null;
//        $customerData->shipping->lastName = ($request->input('last_name')) ? $request->input('last_name') : null;
//        $customerData->shipping->email = ($request->input('payer_email')) ? $request->input('payer_email') : null;
//        $customerData->shipping->phone = ($request->input('')) ? $request->input('') : null;
//        $customerData->shipping->addressOne = ($request->input('address_street')) ? $request->input('address_street') : null;
//        $customerData->shipping->city = ($request->input('address_city')) ? $request->input('address_city') : null;
//        $customerData->shipping->state = ($request->input('address_state')) ? $request->input('address_state') : null;
//        $customerData->shipping->zip = ($request->input('address_zip')) ? $request->input('address_zip') : null;

        $customerData->shipping->firstName = 'Sean';
        $customerData->shipping->lastName = 'Baluha';
        $customerData->shipping->email = 'sbaluha@jekyllhydelabs.com';
        $customerData->shipping->phone = '1234567890';
        $customerData->shipping->addressOne = '12345 some lane';
        $customerData->shipping->city = 'someCity';
        $customerData->shipping->state = 'MI';
        $customerData->shipping->zip = '48185';

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
