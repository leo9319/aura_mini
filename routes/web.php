<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('sales', 'SaleController@index')->name('sales.index');
Route::get('sales/create', 'SaleController@create')->name('sales.create');
Route::post('sales/store', 'SaleController@store')->name('sales.store');
Route::get('sales/show/{sale}', 'SaleController@show')->name('sales.show');
Route::get('getProductInfo', 'ProductController@getProductInfo');
Route::get('getCompanyZone', 'DeliveryCompanyController@getCompanyZone');
