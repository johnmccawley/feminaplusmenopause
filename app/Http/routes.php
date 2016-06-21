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
use App\User;

Route::get('/', function () {
    return view('home');
});

Route::get('/product', function ()  {
    return view('product');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', 'ContactController@create');

Route::get('/clinical', function () {
    return view('clinical');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/payment', function () {
        // $user = User::with($id)->get();
        return view('payment');
    });

    Route::post('/payment', 'PaymentController@create');

    Route::get('order', ['as' => 'order', 'uses' => 'PagesController@getOrder']);
    Route::post('order', ['as' => 'order-post', 'uses' => 'PagesController@postOrder']);
});

Route::get('/cart', function () {
    return view('cart');
});
