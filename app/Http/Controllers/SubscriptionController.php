<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use \Stripe\Stripe;
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
            DB::table('subscriptions')->where('id', $response->id)->update(['active' => false]);
        } catch (\Exception $e) {
            return back()->withErrors($e->getMessage())->withInput();
        }

        return redirect('/home');
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
