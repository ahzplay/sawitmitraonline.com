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

Route::get('/get-price-unit', function () {
    return json_encode(array(
            array('id'=>1,'unit'=>'kg',),
            array('id'=>2,'unit'=>'gr',),
            array('id'=>3,'unit'=>'ton',))
    );
});
Route::get('get-tbs-status', function () {
    return json_encode(array(
        array('id'=>1,'status'=>'NAIK',),
        array('id'=>2,'status'=>'TURUN',))
    );
});

Route::group(['middleware' => 'pageAuth'], function(){
    Route::get('logout','LoginController@logoutAction');

    Route::get('pks-page','PksController@index');
    Route::post('create-pks','PksController@create');
    Route::post('fetch-pks','PksController@show');
    Route::post('destroy-pks','PksController@destroy');


});

Route::get('login-page','LoginController@index');
Route::post('login-action','LoginController@loginAction');

Route::get('fetch-provinces','PksController@getProvinces');
Route::get('fetch-cities','PksController@getCities');
Route::get('fetch-districts','PksController@getDistricts');
Route::get('fetch-subDistricts','PksController@getSubDistricts');




Route::post('fetch-tbs-prices','PksController@getTbsPrices');
Route::post('create-tbs-price','PksController@createTbsPrice');
