<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/sanctum/token', 'API\SanctumController@generateToken');

Route::post('/users', 'API\UserController@store');

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::patch('/users', 'API\UserController@update');


    Route::get('/addresses','API\AddressController@index');
    Route::post('/addresses','API\AddressController@store');
    Route::patch('/addresses/{address}','API\AddressController@update');
    Route::delete('/addresses/{address}','API\AddressController@destroy');

    Route::get('/orders','API\OrderController@index');
    Route::get('/orders/{order}','API\OrderController@show');
    Route::post('/orders','API\OrderController@store');
    Route::patch('/orders/{address}','API\OrderController@update');
    Route::delete('/orders/{address}','API\OrderController@destroy');



});
    


