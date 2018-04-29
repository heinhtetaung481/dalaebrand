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

Route::get('/home', 'ItemsController@index')->name('home');

Route::resource('/stock', 'ItemsController');

Route::get('/order/gender/{gender}', 'OrderItemsController@checkGender');

Route::get('/order/size/{size}','OrderItemsController@checkSize');

Route::post('/order/item','OrderItemsController@getItemId');

Route::get('/order/{id}/edit', 'OrderItemsController@edit');

Route::get('/order/{itemtype}/{size}','OrderItemsController@checkColor');

Route::resource('/order', 'OrderItemsController');

Route::post('/oitemp', 'OitempController@store');

Route::get('/oitemp/{id}', 'OitempController@destroy');

Route::resource('/design', 'DesignsController');

Route::get('/datatables/orderdata', 'DatatablesController@orderData')->name('datatables.orderdata');

Route::get('/datatables/stockdata', 'DatatablesController@stockData')->name('datatables.stockdata');

Route::get('/export/items', 'ExportController@items');

Route::get('/export/orders', 'ExportController@orders');

Route::get('/export/orderitems', 'ExportController@orderitems');



