<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('customers', 'HomeController@customers')->name('customers');
    Route::get('products', 'HomeController@products')->name('products');
    Route::get('orders', 'HomeController@orders')->name('orders');
    Route::get('orders/{invoiceNumber}', 'HomeController@orderDetails')->name('orders.details');
});

Auth::routes();
