<?php

namespace App\Http\Controllers;

use App\User;
use \Stripe\Stripe as Stripe;
use \Stripe\Token as Token;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest as PaymentRequest;

use App\Http\Requests;

class PaymentController extends Controller
{
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
     public function create(PaymentRequest $request)
     {
         $this->setApiKey();

         $expiration = explode("/", $request->expiration);

         $creditCardToken = Token::create(array(
           "card" => array(
               "name" => $request->name,
               "number" => $request->cardNumber,
               "exp_month" => $expiration[0],
               "exp_year" => $expiration[1],
               "cvc" => $request->cvc
           )
         ));

        //  $user = new User();
        //  $user->getUserInformation($request->userId);
         //
        //  $payment = new Payment();
        //  $payment->
        //  $product = new Product();

         try {
             $response = $user->charge($product->getPrice($request->productId), ["source" => $creditCardToken]);
         } catch (Exception $e) {
             echo $e->message();
         }

         return redirect("/");
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
        Stripe::setApiKey(env("STRIPE_SECRET"));
    }
}
