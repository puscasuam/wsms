<?php
use Illuminate\Support\Facades\Route;

//Routes for orders
//Get all products
Route::get('/orders', 'OrderController@all')->name('ordersAll');

//Used for filter form
Route::post('/orders', 'OrderController@all')->name('ordersAll');

////Get a order - by id
//Route::get('/order/{id}', 'OrderController@get')->name('orderGet');

////Used in add product form
//Route::post('/product', 'ProductController@post')->name('productAdd');
//
//Route::delete('/product/{id}', 'ProductController@delete')->name('productDelete');
////Route::get('/product/{id}', 'ProductController@delete')->name('productDelete');
//
//Get add product form / page
Route::get('/order', 'OrderController@form')->name('orderNew');

////Used in view form
//Route::get('/product/{id}/view', 'ProductController@view')->name('productView');

