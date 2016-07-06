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

// Cart routes
Route::get('/cart', 'CartController@show');
Route::post('/cart/{cartItems}', 'CartController@update');
Route::put('/cart/{item}/{itemType}', 'CartController@store');

Route::get('/checkout', function () {
    return view('checkout');
});

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

Route::group(['middleware' => 'auth'], function () {

    Route::get('/checkout', function () {
        return view('checkout');
    });

    Route::post('/checkout', 'PagesController@postOrder');
});
