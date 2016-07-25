<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\User;
use \Stripe\Stripe;
use \Stripe\Subscription;
use App\Http\Requests;
use App\Http\Requests\HomeRequest as HomeRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $user, $userId;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->setApiKey();
        $this->user = (Auth::user()) ? User::findOrFail(Auth::user()->id) : null;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subscription = $this->retrieveSubscription();
        return view('auth.account', ['subscription' => $subscription, 'user' => $this->user]);
    }

    public function updateUser(HomeRequest $request) {
        $user = User::findOrFail($this->user->id);
        $user->name = $request->input('user-name');
        $user->email = $request->input('user-email');
        $user->phone = $request->input('user-phone');
        $user->address = $request->input('user-address-1');
        $user->apartment_suite_number = $request->input('user-address-2');
        $user->city = $request->input('user-city');
        $user->state = $request->input('user-state');
        $user->zip = $request->input('user-zip');

        $user->save();

        return redirect('/home');
    }

    private function retrieveSubscription() {
        $subDbEntry = DB::table('subscriptions')->where('user_id', $this->user->id)->orderBy('updated_at', 'desc')->first();

        if ($subDbEntry) {
            $subscription = Subscription::retrieve($subDbEntry->stripe_id);
        } else {
            $subscription = null;
        }

        return $subscription;
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
