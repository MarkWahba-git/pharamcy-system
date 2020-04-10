<?php

use Illuminate\Support\Facades\Route;

Route::post('/sanctum/token', 'API\SanctumController@generateToken');

Route::post('/users', 'API\UserController@store');

Route::group(['middleware'=>'auth:sanctum'], function(){

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
    


