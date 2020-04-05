<?php

use Illuminate\Support\Facades\Route;

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

Route::group([],function(){

    Route::get('/pharmacies','PharmacyController@index')->name('pharmacies.index');
    
    Route::get('/pharmacies/create','PharmacyController@create')->name('pharmacies.create');
    
    Route::get('/pharmacies/{pharmacy}','PharmacyController@show')->name('pharmacies.show');

    Route::post('/pharmacies', 'PharmacyController@store')->name('pharmacies.store');

});