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

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/privacy', function () {
    return view('privacy');
});
