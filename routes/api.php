<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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

Route::post('/store', 'API\UserController@store');


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     // dd($request->user());
//     return $request->user()->addresses;
// });

Route::group(['middleware'=>'auth:sanctum'], function(){

    Route::get('/addresses','API\AddressController@index');
    Route::post('/addresses','API\AddressController@store');
    Route::patch('/addresses/{address}','API\AddressController@update');
    Route::delete('/addresses/{address}','API\AddressController@destroy');

});
    


