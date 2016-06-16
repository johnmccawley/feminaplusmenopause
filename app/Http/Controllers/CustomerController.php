<?php

namespace App\Http\Controllers;

use App\User;
use \Stripe\Stripe as Stripe;
use \Stripe\Token as Token;
use Illuminate\Http\Request;

use App\Http\Requests;

class CustomerController extends Controller
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
    public function create(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'cardNumber' => 'required|max:16',
            'expiration' => 'required|max:7',
            'cvc' => 'required|max:4'
        ]);

        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $expiration = explode('/', $request->expiration);

        $creditCardToken = Token::create(array(
          "card" => array(
              "name" => $request->name,
              "number" => $request->cardNumber,
              "exp_month" => $expiration[0],
              "exp_year" => $expiration[1],
              "cvc" => $request->cvc
          )
        ));

        $user = new User();

        try {
            $response = $user->charge(999, ['source' => $creditCardToken]);
        } catch (Exception $e) {
            echo $e->message();
        }

        return redirect('/');
        // $user->newSubscription('main', 'fpclubtwo')->create($creditCardToken);
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
}
