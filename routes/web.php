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

Route::get('/', function () {
    return view('homepage');
});

Route::group(['prefix' => 'orders', 'as' => 'orders.'], function (){
    Route::group(['middleware' => ['auth', "permissions"]], function (){
        Route::get('/', 'OrderController@index')->name('index');
        Route::post('/', 'OrderController@store')->name('store');
        Route::get('/edit/{id}', 'OrderController@edit')->name('edit');
        Route::get('/place', 'OrderController@create')->name('create');
        Route::get('/{id}', 'OrderController@show')->name('show');
        Route::put('/{id}', 'OrderController@update')->name('update');
        Route::delete('/{id}', 'OrderController@delete')->name('delete');
    });
});

Route::group(['prefix' => 'users', 'as' => 'users.'], function (){
    Route::group(['middleware' => ['auth', 'permissions']], function (){
        Route::get('/', 'UserController@index')->name('index');
        Route::get('/edit/{id}', 'UserController@edit')->name('edit');
        Route::get('/{id}', 'UserController@show')->name('show');
        Route::put('/{id}', 'UserController@update')->name('update');
    });
});

Route::resource('newcuppy', 'UploadImageController');

// test image converter
Route::get('/img', function()
{
    $img = Image::make(file_get_contents('./foo.png'));
    $img->resize(300, 200);
    return $img->response('jpg');
});
