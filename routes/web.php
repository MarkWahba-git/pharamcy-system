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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::group([],function(){

    Route::get('/pharmacies','PharmacyController@index')->name('pharmacies.index');
    
    Route::get('/pharmacies/create','PharmacyController@create')->name('pharmacies.create');
    
    Route::get('/pharmacies/{pharmacy}','PharmacyController@show')->name('pharmacies.show');

    Route::post('/pharmacies', 'PharmacyController@store')->name('pharmacies.store');

});

////// Doctor Crud Routes 

Route::get('doctor-list', 'DoctorController@index');
Route::get('doctor-list/{id}/edit', 'DoctorController@edit');
Route::post('doctor-list/store', 'DoctorController@store');
Route::get('doctor-list/delete/{id}', 'DoctorController@destroy');

//////////////////////////////////////////////////////




Route::group([],function(){

    Route::get('/drugs','DrugController@index')->name('drugs.index');

   Route::get('/drugs/getdrugs','DrugController@getDrugs')->name('drugs.getdrugs');
   Route::post('/drugs/postdrugs','DrugController@addDrug')->name('drugs.postdrugs');
   Route::get('/drugs/fetchdrugs','DrugController@fetchDrug')->name('drugs.fetchdrugs');
   Route::get('/drugs/deletedrugs','DrugController@deleteDrug')->name('drugs.deletedrugs');
   Route::get('/drugs/selectdrugs','DrugController@selectDrugs')->name('drugs.selectdrugs');
   Route::post('/drugs/fetchlist','DrugController@fetchList')->name('drugs.fetchlist');
   Route::get('/drugs/orderdrugs','DrugController@orderDrugs')->name('drugs.orderdrugs');
});

Route::get('/', function () {
    return view('welcome');
});
<<<<<<< HEAD
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
=======

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
>>>>>>> 5ed1083868c4a5e9766b974737219cce1925c7ef
