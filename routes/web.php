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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/orders/place', 'OrderController@create');
Route::post('/orders', 'OrderController@store');
Route::get('/orders/edit/{id}', 'OrderController@edit');
Route::get('/orders/{id}', 'OrderController@show');
Route::put('/orders/{id}', 'OrderController@update');

//cup
Route::get('/cup', 'CupController@index');
