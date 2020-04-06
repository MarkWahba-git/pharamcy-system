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

});

Route::get('/', function () {
    return view('welcome');
});
