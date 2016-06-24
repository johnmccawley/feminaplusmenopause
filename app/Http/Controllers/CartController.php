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
        if ($itemType == 'product') {
            $sku = SKU::retrieve($id);
            $product = Product::retrieve('feminaplus');

            $item = (object)['id' => $sku->id, 'type' => 'product', 'name' => $product->name, 'description' => $product->description, 'price' => $sku->price];
        } else if ($itemType == 'plan') {
            $plan = Plan::retrieve('fpClub');

            $item = (object)['id' => $plan->id, 'type' => 'plan', 'name' => $plan->name, 'description' => $plan->statement_descriptor, 'price' => $plan->amount];
        }

        $token = $request->session()->get('_token');
        $cartDbEntry = DB::table('carts')->where('token', $token)->first();
        if ($cartDbEntry) {
            $cart = Cart::find($cartDbEntry->id);
            $sku = json_decode($cart->sku);
            $sku[] = $item;
            $cart->sku = json_encode($sku);
            $cart->save();
        } else {
            $sku = array($item);
            Cart::create([
                'token' => $token,
                'sku' => json_encode($sku)
            ]);
        }

        return redirect('/product');
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

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
