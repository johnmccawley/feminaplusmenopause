<?php

namespace App\Http\Controllers;

use DB as DB;
use App\Cart;
use \Stripe\Stripe as Stripe;
use \Stripe\Product as Product;
use \Stripe\SKU as SKU;
use \Stripe\Plan as Plan;
use Illuminate\Cookie\CookieJar;
use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
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
    public function store(Request $request, $id, $itemType)
    {
        $token = $request->session()->get('_token');
        $cartDbEntry = DB::table('carts')->where('token', $token)->first();
        if ($cartDbEntry) {
            $cart = Cart::find($cartDbEntry->id);
            $cartItems = json_decode($cart->items);
        } else {
            $cart = Cart::create([
                'token' => $token,
                'items' => null,
                'total' => null
            ]);
            $cartItems = [];
        }

        if (array_key_exists($id, $cartItems)) {
            $cartItems->$id->amount++;
            $cartItems->$id->price = ($cartItems->$id->price * $cartItems->$id->amount);
            $cartItems->$id->display_price = $this->formatDisplayPrice($cartItems->$id->price);
        } else {
            if ($itemType == 'product') {
                $sku = SKU::retrieve($id);
                $product = Product::retrieve('feminaplus');

                $displayPrice = $this->formatDisplayPrice($sku->price);
                $cartItems->$id = (object)['amount' => 1, 'type' => 'product', 'name' => $product->name, 'description' => $product->description, 'price' => $sku->price, 'display_price' => $displayPrice];
            } else if ($itemType == 'plan') {
                $plan = Plan::retrieve('fpClub');

                $displayPrice = $this->formatDisplayPrice($plan->amount);
                $cartItems->$id = (object)['amount' => 1, 'type' => 'plan', 'name' => $plan->name, 'description' => $plan->statement_descriptor, 'price' => $plan->amount, 'display_price' => $displayPrice];
            }
        }

        $cart->items = json_encode($cartItems);
        $cart->total = $this->calculateTotal($cartItems);
        $cart->save();

        return redirect('/cart');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function destroy($id)
    {
        //
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

    private function calculateTotal($cartItems) {
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item->price;
        }

        return $this->formatDisplayPrice($total);
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
