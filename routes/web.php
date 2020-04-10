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

/* **Pharmacy Routes** */
//=======================================================================================
Route::group([],function(){
    Route::get('/pharmacies','PharmacyController@index')->name('pharmacies.index');
    Route::get('/pharmacies/getPharmacies','PharmacyController@getPharmacies')->name('pharmacies.getPharmacies');
    Route::post('/pharmacies/postPharmacies','PharmacyController@postPharmacies')->name('pharmacies.postPharmacies');
    Route::get('/pharmacies/fetchPharmacies','PharmacyController@fetchPharmacies')->name('pharmacies.fetchPharmacies');
    Route::get('/pharmacies/removePharmacy','PharmacyController@removePharmacy')->name('pharmacies.removePharmacy');
});
//=======================================================================================

/* **Doctor Routes** */
Route::group([],function(){ 
    Route::get('doctor-list', 'DoctorController@index');
    Route::get('doctor-list/{id}/edit', 'DoctorController@edit');
    Route::post('doctor-list/store', 'DoctorController@store');
    Route::get('doctor-list/delete/{id}', 'DoctorController@destroy');
});
//=======================================================================================

/* **Drug Routes** */ 
Route::group([],function(){
    Route::get('/drugs','DrugController@index')->name('drugs.index');
    Route::get('/drugs/getdrugs','DrugController@getDrugs')->name('drugs.getdrugs');
    Route::post('/drugs/postdrugs','DrugController@addDrug')->name('drugs.postdrugs');
    Route::get('/drugs/getdrugs','DrugController@getDrugs')->name('drugs.getdrugs');
    Route::post('/drugs/postdrugs','DrugController@addDrug')->name('drugs.postdrugs');
    Route::get('/drugs/fetchdrugs','DrugController@fetchDrug')->name('drugs.fetchdrugs');
    Route::get('/drugs/deletedrugs','DrugController@deleteDrug')->name('drugs.deletedrugs');
    Route::get('/drugs/selectdrugs','DrugController@selectDrugs')->name('drugs.selectdrugs');
    Route::post('/drugs/fetchlist','DrugController@fetchList')->name('drugs.fetchlist');
    Route::get('/drugs/orderdrugs','DrugController@orderDrugs')->name('drugs.orderdrugs');
});
//=======================================================================================

/* **User Routes** */ 
Route::group([],function(){
    Route::get('/users','UserController@index')->name('users.index');
    Route::get('/users/getUsers','UserController@getUsers')->name('users.getUsers');
    Route::post('/users/postUsers','UserController@postUsers')->name('users.postUsers');
    Route::get('/users/fetchUsers','UserController@fetchUsers')->name('users.fetchUsers');
    Route::get('/users/removeUser','UserController@removeUser')->name('users.removeUser');
});
//============================================================================================

/* **Orders Routes** */
Route::group([],function(){
    Route::get('/orders','OrdersController@index')->name('orders.index');
    Route::get('/orders/getdata','OrdersController@getData')->name('orders.getdata');
    Route::post('/orders/postorder','OrdersController@postOrders')->name('orders.postorder');
    Route::get('orders/fetchorder', 'OrdersController@fetchorder')->name('orders.fetchorder');
    Route::get('orders/removeorder', 'OrdersController@removeorder')->name('orders.removeorder');








});
//============================================================================================

/* **Doctors Routes** */
Route::group([],function(){
    Route::get('/doctorstab','DoctorTabController@index')->name('doctorstab.index');
    
    Route::delete('/doctorstab/{doctor}','DoctorTabController@destroy')->name('doctorstab.destroy');
    Route::get('/doctorstab/{doctor}/edit','DoctorTabController@edit')->name('doctorstab.edit');
    Route::put('/doctorstab/{doctor}','DoctorTabController@update')->name('doctorstab.update');
    Route::put('/doctorstab/ban/{doctor}','DoctorTabController@ban')->name('doctorstab.ban');
    Route::get('/doctorstab/fetch_image/{doctor}', 'DoctorTabController@fetch_image')->name('doctorstab.fetch_image');


    //create doctor
    Route::get('/doctorstab/create','DoctorTabController@create')->name('doctorstab.create');
    Route::post('/doctorstab','DoctorTabController@store')->name('doctorstab.store');

    
});
//============================================================================================


Auth::routes(['register' => false,
            'verify' => true

]);

Route::get('/home', 'HomeController@index')->name('home');
