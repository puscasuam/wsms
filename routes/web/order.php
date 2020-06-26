<?php
use Illuminate\Support\Facades\Route;

//Routes for orders
//Get all orders
Route::get('/orders', 'OrderController@all')->name('ordersAll');

//Get add order form / page
Route::get('/order', 'OrderController@form')->name('orderNew');

//Used in add order form
Route::post('/order', 'OrderController@post')->name('orderAdd');

//Get a order - by id
Route::get('/order/{id}', 'OrderController@get')->name('orderGet');

//Used in view form
Route::get('/order/{id}/view', 'OrderController@view')->name('orderView');

//Used to delete an order
Route::delete('/order/{id}', 'OrderController@delete')->name('orderDelete');

//Used for filter form
Route::post('/orders', 'OrderController@all')->name('ordersAll');
