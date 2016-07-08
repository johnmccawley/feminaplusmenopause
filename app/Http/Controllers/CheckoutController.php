<?php

namespace App\Http\Controllers;

use DB as DB;
use \Stripe\Stripe as Stripe;
use Illuminate\Http\Request;

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

    private function retrieveCartDatabaseEntry($request) {
        $token = $request->session()->get('_token');
        return DB::table('carts')->where('token', $token)->first();
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
