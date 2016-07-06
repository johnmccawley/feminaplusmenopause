<?php

namespace App\Http\Controllers;

use App\User;
use App\Purchase;
use \Stripe\Stripe as Stripe;
use \Stripe\Token as Token;
use App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PageRequest as PageRequest;

use Auth;
use Mail;
use App\Http\Requests;

class PagesController extends Controller
{
    public function getOrder()
    {
        return view('payment');
    }

    public function postOrder(PageRequest $request)
    {

        $this->setApiKey();
        // $request->product = 'auto-refill';
        $request->product = 'oneBottle';

        switch ($request->product) {
            case 'auto-refill':
                $amount = 3600;
                break;
            case 'oneBottle':
                $amount = 3950;
                break;
            case 'twoBottle':
                $amount = 7790;
                break;
            case 'fourBottle':
                $amount = 14990;
                break;
            default:
                return redirect()->route('/')
                    ->withErrors('Product not valid!')
                    ->withInput();
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

        // $user = Auth::id();
        // if (!isset(Auth::user()->stripe_id))

        // $user = User::where('email', $request->email)->first();
        // $customerID = User::where('email', $email)->value('stripe_customer_id');

        $user = User::findOrFail(Auth::user()->id);
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
                $response = $user->charge(($amount), ['source' => $creditCardToken]);
            } catch (Exception $e) {
                echo $e->message();
            }

            if (isset($response)) {
                Purchase::create([
                    'user_id' => $user->id,
                    'product' => $request->product,
                    'amount' => $amount,
                    'stripe_transaction_id' => $response->id,
                ]);
                $this->fullfillmentEmail($user, $request->product);
            }

        }

         return redirect('/');



        //
        // FUCK EVERYTHING BEYOND THIS POINT
        //

        // // Checking is product valid
        // $product = $request->input('product');
        // switch ($product) {
        //     case 'book':
        //         $amount = 1000;
        //         break;
        //     case 'game':
        //         $amount = 2000;
        //         break;
        //     case 'movie':
        //         $amount = 1500;
        //         break;
        //     default:
        //         return redirect()->route('order')
        //             ->withErrors('Product not valid!')
        //             ->withInput();
        // }
        //
        // $name = explode(' ', $request->input('name'));
        //
        // $token = $request->input('stripeToken');
        // $first_name = $name[0];
        // $last_name = $name[1];
        // $email = $request->input('email');
        // $emailCheck = User::where('email', $email)->value('email');
        //
        // \Stripe\Stripe::setApiKey(env('STRIPE_SK'));
        //
        // // If the email doesn't exist in the database create new customer and user record
        // if (!isset($emailCheck)) {
        //     // Create a new Stripe customer
        //     try {
        //         $customer = \Stripe\Customer::create([
        //         'source' => $token,
        //         'email' => $email,
        //         'metadata' => [
        //             'First Name' => $first_name,
        //             'Last Name' => $last_name
        //         ]
        //         ]);
        //     } catch (\Stripe\Error\Card $e) {
        //         return redirect()->route('order')
        //             ->withErrors($e->getMessage())
        //             ->withInput();
        //     }
        //
        //     $customerID = $customer->id;
        //
        //     // Create a new user in the database with Stripe
        //     $user = User::create([
        //     'first_name' => $first_name,
        //     'last_name' => $last_name,
        //     'email' => $email,
        //     'stripe_customer_id' => $customerID,
        //     ]);
        // } else {
        //     $customerID = User::where('email', $email)->value('stripe_customer_id');
        //     $user = User::where('email', $email)->first();
        // }
        //
        // // Charging the Customer with the selected amount
        // try {
        //     $charge = \Stripe\Charge::create([
        //         'amount' => $amount,
        //         'currency' => 'usd',
        //         'customer' => $customerID,
        //         'metadata' => [
        //             'product_name' => $product
        //         ]
        //         ]);
        // } catch (\Stripe\Error\Card $e) {
        //     return redirect()->route('order')
        //         ->withErrors($e->getMessage())
        //         ->withInput();
        // }
        //
        // // Create purchase record in the database
        // Purchase::create([
        //     'user_id' => $user->id,
        //     'product' => $product,
        //     'amount' => $amount,
        //     'stripe_transaction_id' => $charge->id,
        // ]);
        //
        // return redirect()->route('order')
        //     ->with('successful', 'Your purchase was successful!');
    }

    private function fullfillmentEmail($user, $product) {
        Mail::send('emails.fullfill', ['user' => $user, 'product' => $product], function ($message) use ($user, $product) {
           $message->from('fullfillment@mg.feminaplus.com', 'Femina Plus');
           $message->to(env('FULLFILL_EMAIL_ONE'), null)->subject('FULLFILLMENT REQUEST');
           $message->cc(env('FULLFILL_EMAIL_TWO'), null)->subject('FULLFILLMENT REQUEST');
       });
    }

    private function setApiKey() {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }
}
