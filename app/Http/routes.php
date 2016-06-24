<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use DB as DB;
use App\User;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function ()  {
    return view('product');
});

// Route::get('auth/login', 'Auth\AuthController@getLogin');

Route::get('/clinical', function () {
    return view('clinical');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', 'ContactController@create');

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/confirm', function () {
    return view('/');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::put('/cart/{item}/{itemType}', 'CartController@store');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/checkout', function () {
        return view('checkout');
    });

    Route::post('/checkout', 'PagesController@postOrder');
});

Route::get('/cart', function (Request $request) {
    $token = $request->session()->get('_token');
    $cart = DB::table('carts')->where('token', $token)->first();
    if ($cart) {
        $cartItems = json_decode($cart->sku);
        $total = $cart->total/100;
    } else {
        $cartItems = null;
        $total = 0;
    }
    return view('cart', ['cartItems' => $cartItems, 'total' => $total]);
});
