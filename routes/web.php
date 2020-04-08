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
// from andrew

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::group([],function(){

    Route::get('/pharmacies','PharmacyController@index')->name('pharmacies.index');

    Route::get('/pharmacies/{pharmacy}','PharmacyController@show')->name('pharmacies.show');

});

Route::group([],function(){

    Route::get('/drugs','DrugController@index')->name('drugs.index');

   Route::get('/drugs/getdrugs','DrugController@getDrugs')->name('drugs.getdrugs');
   Route::post('/drugs/postdrugs','DrugController@addDrug')->name('drugs.postdrugs');

});
Route::group([],function(){

    Route::get('/orders','OrdersController@index')->name('orders.index');
    Route::get('/orders/getdata', 'OrdersController@getData')->name('orders.getdata');






});
Route::group([],function(){

  
    Route::get('/doctorstab','DoctorTabController@index')->name('doctorstab.index');

    Route::delete('/doctorstab/{doctor}','DoctorTabController@destroy')->name('doctorstab.destroy');
    Route::get('/doctorstab/{doctor}/edit','DoctorTabController@edit')->name('doctorstab.edit');
    Route::put('/doctorstab/{doctor}','DoctorTabController@update')->name('doctorstab.update');
    Route::get('doctorstab/fetch_image/{doctor}', 'DoctorTabController@fetch_image');

    
});
