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
//        Log::info("Got an IPN message from PayPal");
//        return;

        return $this->ipnCode();
    }

    private function ipnCode() {
        define("DEBUG", 1);
        // Set to 0 once you're ready to go live
        define("USE_SANDBOX", 1);
        define("LOG_FILE", "./ipn.log");
        // Read POST data
        // reading posted data directly from $_POST causes serialization
        // issues with array data in POST. Reading raw POST data from input stream instead.
        $raw_post_data = file_get_contents('php://input');
        $raw_post_array = explode('&', $raw_post_data);
        $myPost = array();
        foreach ($raw_post_array as $keyval) {
            $keyval = explode ('=', $keyval);
            if (count($keyval) == 2)
                $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
        // read the post from PayPal system and add 'cmd'
        $req = 'cmd=_notify-validate';
        if(function_exists('get_magic_quotes_gpc')) {
            $get_magic_quotes_exists = true;
        }
        foreach ($myPost as $key => $value) {
            if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
                $value = urlencode(stripslashes($value));
            } else {
                $value = urlencode($value);
            }
            $req .= "&$key=$value";
        }
        // Post IPN data back to PayPal to validate the IPN data is genuine
        // Without this step anyone can fake IPN data
        if(USE_SANDBOX == true) {
            $paypal_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
        } else {
            $paypal_url = "https://www.paypal.com/cgi-bin/webscr";
        }
        $ch = curl_init($paypal_url);
        if ($ch == FALSE) {
            return FALSE;
        }
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
        if(DEBUG == true) {
            curl_setopt($ch, CURLOPT_HEADER, 1);
            curl_setopt($ch, CURLINFO_HEADER_OUT, 1);
        }
        // CONFIG: Optional proxy configuration
        //curl_setopt($ch, CURLOPT_PROXY, $proxy);
        //curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, 1);
        // Set TCP timeout to 30 seconds
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close'));
        // CONFIG: Please download 'cacert.pem' from "http://curl.haxx.se/docs/caextract.html" and set the directory path
        // of the certificate as shown below. Ensure the file is readable by the webserver.
        // This is mandatory for some environments.
        //$cert = __DIR__ . "./cacert.pem";
        //curl_setopt($ch, CURLOPT_CAINFO, $cert);
        $res = curl_exec($ch);
        if (curl_errno($ch) != 0) // cURL error
        {
            if(DEBUG == true) {
                error_log(date('[Y-m-d H:i e] '). "Can't connect to PayPal to validate IPN message: " . curl_error($ch) . PHP_EOL, 3, LOG_FILE);
            }
            curl_close($ch);
            exit;
        } else {
            // Log the entire HTTP response if debug is switched on.
            if(DEBUG == true) {
                error_log(date('[Y-m-d H:i e] '). "HTTP request of validation request:". curl_getinfo($ch, CURLINFO_HEADER_OUT) ." for IPN payload: $req" . PHP_EOL, 3, LOG_FILE);
                error_log(date('[Y-m-d H:i e] '). "HTTP response of validation request: $res" . PHP_EOL, 3, LOG_FILE);
            }
            curl_close($ch);
        }
        // Inspect IPN validation result and act accordingly
        // Split response headers and payload, a better way for strcmp
        $tokens = explode("\r\n\r\n", trim($res));
        $res = trim(end($tokens));
        if (strcmp ($res, "VERIFIED") == 0) {
            // check whether the payment_status is Completed
            // check that txn_id has not been previously processed
            // check that receiver_email is your PayPal email
            // check that payment_amount/payment_currency are correct
            // process payment and mark item as paid.
            // assign posted variables to local variables
            //$item_name = $_POST['item_name'];
            //$item_number = $_POST['item_number'];
            //$payment_status = $_POST['payment_status'];
            //$payment_amount = $_POST['mc_gross'];
            //$payment_currency = $_POST['mc_currency'];
            //$txn_id = $_POST['txn_id'];
            //$receiver_email = $_POST['receiver_email'];
            //$payer_email = $_POST['payer_email'];

            if(DEBUG == true) {
                error_log(date('[Y-m-d H:i e] '). "Verified IPN: $req ". PHP_EOL, 3, LOG_FILE);
            }
        } else if (strcmp ($res, "INVALID") == 0) {
            // log for manual investigation
            // Add business logic here which deals with invalid IPN messages
            if(DEBUG == true) {
                error_log(date('[Y-m-d H:i e] '). "Invalid IPN: $req" . PHP_EOL, 3, LOG_FILE);
            }
        }
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
