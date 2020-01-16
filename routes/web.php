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


//cup
Route::get('/cup', 'CupController@index');
Route::get('/cup/create', 'CupController@store');
Route::get('/cup/delete/{id}', 'CupController@destroy');
Route::get('/cup/plus_coffee/{id}', 'CupController@plus_coffee');
Route::get('/cup/min_coffee/{id}', 'CupController@min_coffee');

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function (){

    Route::get('/', 'OrderController@index')->name('index');
    Route::get('/place', 'OrderController@create')->name('create');
    Route::get('/{id}', 'OrderController@show')->name('show');

    Route::group(['middleware' => ['auth']], function (){
        Route::post('/', 'OrderController@store')->name('store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
        Route::put('/{id}', 'OrderController@update')->name('update');
        Route::delete('/{id}', 'OrderController@delete')->name('delete');
    });
});

Route::group(['prefix' => 'users', 'as' => 'users.'], function (){

    Route::get('/', 'UserController@index')->name('index');
    Route::get('/{id}', 'UserController@show')->name('show');

    Route::group(['middleware' => ['auth']], function (){
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::put('/{id}', 'UserController@update')->name('update');
    });
});


