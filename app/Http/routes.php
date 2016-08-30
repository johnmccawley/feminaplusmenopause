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

Route::post('/notify', 'SubscriptionController@sendMessage');

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function ()  {
    return view('product');
});

Route::get('/clinical', function () {
    return view('clinical');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', 'ContactController@create');

// User routes
Route::post('/userUpdate', 'HomeController@updateUser');

// Cart routes
Route::get('/cart', 'CartController@show');
Route::post('/cartUpdate', 'CartController@update');
Route::put('/cart/{item}/{itemType}', 'CartController@store');

// Checkout routes
Route::get('/checkout', 'CheckoutController@show');
Route::post('/checkout', 'CheckoutController@create');
Route::post('/checkoutCoupon', 'CheckoutController@applyCoupon');
Route::get('/paymentComplete', 'CheckoutController@paymentComplete');
Route::get('/paymentCancelled', 'CheckoutController@paymentCancelled');
Route::get('/receipt/{token}', 'CheckoutController@receipt');

// Coupon routes
Route::get('/coupon', 'CouponController@show');
Route::post('/coupon', 'CouponController@create');
Route::post('/coupon/{id}/update', 'CouponController@update');

// Subscription routes
Route::post('/subscription', 'SubscriptionController@destroy');
Route::post('/notify', 'SubscriptionController@store');

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/buy', function () {
    return view('buy');
});

Route::get('/confirm', function () {
    return view('confirm');
});

Route::auth();

Route::get('/home', 'HomeController@index');
