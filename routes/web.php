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

Route::get('login-page','LoginController@index');

Route::get('pks-page','PksController@index');
Route::post('create-pks','PksController@create');
Route::post('fetch-pks','PksController@show');

Route::get('fetch-provinces','PksController@getProvinces');
Route::get('fetch-cities','PksController@getCities');
Route::get('fetch-districts','PksController@getDistricts');
Route::get('fetch-subDistricts','PksController@getSubDistricts');



Route::get('open-layer-page','PksController@openLayer');
