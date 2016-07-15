<?php

namespace App\Http\Controllers;

use DB as DB;
use App\User;
use App\Cart;
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
    public function create(CheckoutRequest $request)
    {
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

        // Creates credit card token
        $cardExpiration = explode('/', $request->cardExpiration);
        // CAN'T USE THE STRIPE TOKEN TWICE
        $creditCardToken = Token::create(array(
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

        // Determines if a subscription or product is being bought
        if (isset($itemsPurchased['fpClub'])) {
            $response = $this->user->newSubscription('primary', 'fpClub')->create($creditCardToken->id, ['email' => $request->input('billing-email')]);
        }

        if ($amount->product > 0) {
            // $response = $user->charge(($amount->product), ['source' => $creditCardToken]);
            $response = Charge::create(array(
              'amount' => $amount->product,
              'currency' => 'usd',
              'source' => $creditCardToken->id
            ));
        }

        if (isset($response)) {
            $this->createPurchase($response, $itemsPurchased, $amount);
            $cart->items = null;
            $cart->total = null;
            $cart->save();

            $this->fullfillmentEmail($request, $cartItems);
        }

         return redirect('/');
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
        $cartDbEntry = $this->retrieveCartDatabaseEntry($request);

        if ($cartDbEntry) {
            $cartItems = json_decode($cartDbEntry->items);
            $total = $cartDbEntry->total;

            foreach ($cartItems as $key => $item) {
                if ($item->type == 'plan' && !Auth::user()) {
                    return view('auth.login', ['required' => true]);
                }
            }

            return view('checkout', ['cartItems' => $cartItems, 'total' => $total]);
        } else {
            return redirect('/cart');
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

    private function createPurchase($response, $itemsPurchased, $amount) {
        if (isset($response)) {
            Purchase::create([
                'user_id' => $this->userId,
                'items' => json_encode($itemsPurchased),
                'amount' => $amount->total,
                'stripe_transaction_id' => $response->id,
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
