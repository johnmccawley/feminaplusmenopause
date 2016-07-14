<?php

namespace App\Http\Controllers;

use DB as DB;
use App\User;
use App\Cart;
use App\Purchase;
use \Stripe\Stripe as Stripe;
use \Stripe\Token as Token;
use \Stripe\Charge as Charge;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutRequest as CheckoutRequest;

use Auth;
use Mail;
use App\Http\Requests;

class CheckoutController extends Controller
{

    function __construct() {
        $this->setApiKey();
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
        $cartDbEntry = $this->retrieveCartDatabaseEntry($request);
        $cart = Cart::findOrFail($cartDbEntry->id);
        if (is_null($cart->items)) {
            return redirect('/cart');
        }

        $cartItems = json_decode($cart->items);
        $amount = 0;
        foreach($cartItems as $key => $item) {
            $amount += $item->price;
            $itemsPurchased[] = ['product' => $key, 'amount' => $item->amount, 'price' => $item->price];
        }

        $expiration = explode('/', $request->expiration);
        $creditCardToken = Token::create(array(
            'card' => array(
                'name' => $request->name,
                'number' => $request->cardNumber,
                'exp_month' => $expiration[0],
                'exp_year' => $expiration[1],
                'cvc' => $request->cvc
            )
        ));

        if (Auth::user()) {
            $user = User::findOrFail(Auth::user()->id);
            $userId = $user->id;
        } else {
            $userId = null;
        }

        if ($request->product == 'auto-refill') {
            // DO NOTHING FOR NOW
            // $response = $user->newSubscription('main', 'fpclubone')->create($creditCardToken, ['email' => $user->email]);
            //
            // if (isset($response)) {
            //     Purchase::create([
            //         'user_id' => $user->id,
            //         'product' => 'fpclubone',
            //         'amount' => $amount,
            //         'stripe_transaction_id' => $response->id,
            //     ]);
            //     // $this->fullfillmentEmail();
            // }
        } else {
            try {
                $response = Charge::create(array(
                  'amount' => $amount,
                  'currency' => 'usd',
                  'source' => $creditCardToken
                ));
                // $response = $user->charge(($amount), ['source' => $creditCardToken]);
            } catch (Exception $e) {
                echo $e->message();
            }

            if (isset($response)) {
                Purchase::create([
                    'user_id' => $userId,
                    'items' => json_encode($itemsPurchased),
                    'amount' => $amount,
                    'stripe_transaction_id' => $response->id,
                ]);
                $cart->items = null;
                $cart->total = null;
                $cart->save();
                // $this->fullfillmentEmail($request);
            }

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

    private function fullfillmentEmail($userInfo) {
        Mail::send('emails.fullfill', ['userInfo' => $userInfo], function ($message) use ($userInfo) {
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
