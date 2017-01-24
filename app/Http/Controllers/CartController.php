<?php

namespace App\Http\Controllers;

use DB as DB;
use App\Cart;
use \Stripe\Stripe as Stripe;
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
    public function store(Request $request, $id)
    {
        $cartDbEntry = $this->retrieveCartDatabaseEntry($request);
        if ($cartDbEntry) {
            $cart = Cart::find($cartDbEntry->id);
            if (is_null($cart->items)) {
                $cartItems = (object)[];
            } else {
                $cartItems = json_decode($cart->items);
            }
        } else {
            $cart = Cart::create([
                'token' => $request->session()->get('_token'),
                'items' => null,
                'total' => null
            ]);
            $cartItems = (object)[];
        }

        if (array_key_exists($id, $cartItems)) {
            $cartItems->$id->amount++;
            $cartItems->$id->display_price = $this->formatDisplayPrice($cartItems->$id->price);
        } else {
            $product = DB::table('products')->where('sku', $id)->first();
            $type = ($product->subscription == true) ? 'plan' : 'product';

            $displayPrice = $this->formatDisplayPrice($product->price);
            $cartItems->$id = (object)['amount' => 1, 'type' => $type, 'name' => $product->full_name, 'description' => $product->description, 'price' => $product->price, 'display_price' => $displayPrice];
        }

        $this->saveCart($cart, $cartItems);

        return redirect('/cart');
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
        } else {
            $cartItems = null;
            $total = 0;
        }

        return view('cart', ['cartItems' => $cartItems, 'total' => $total]);
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
    public function update(Request $request)
    {
        $updatedCartData = $request->input('cartData');
        $cartDbEntry = $this->retrieveCartDatabaseEntry($request);
        $cart = Cart::find($cartDbEntry->id);
        $cartItems = json_decode($cart->items);

        foreach($updatedCartData as $item) {
            $productName = $item['productName'];
            $productAmount = intval($item['productAmount']);
            if ($productAmount <= 0) {
                unset($cartItems->$productName);
            } else {
                $cartItems->$productName->amount = intval($item['productAmount']);
            }
        }

        $this->saveCart($cart, $cartItems);

        return $updatedCartData;
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

    private function retrieveCartDatabaseEntry($request) {
        $token = $request->session()->get('_token');
        return DB::table('carts')->where('token', $token)->first();
    }

    private function saveCart($cart, $cartItems) {
        $total = $this->calculateTotal($cartItems);
        $cart->items = (json_encode($cartItems) == "{}") ? null : json_encode($cartItems);
        $cart->total = $this->formatDisplayPrice($total);
        $cart->charge_total = $total;
        $cart->codes_applied = null;
        $cart->save();

        return $cart;
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
            $total += $item->amount * $item->price;
        }

        return $total;
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
