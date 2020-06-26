<?php
use Illuminate\Support\Facades\Route;

//Get all transactions
Route::get('/transactions', 'TransactionController@all')->name('transactionsAll');

////Get add product form / page
//Route::get('/product', 'ProductController@form')->name('newProduct');
//
////Used in add product form
//Route::post('/product', 'ProductController@post')->name('productAdd');
//
////Get a product - by id
//Route::get('/product/{id}', 'ProductController@get')->name('productGet');
//
////Used in view form
//Route::get('/product/{id}/view', 'ProductController@view')->name('productView');
//
////Used to update product - by id
//Route::patch('/product', 'ProductController@update')->name('productUpdate');
//
////Used to delete a product
//Route::delete('/product/{id}', 'ProductController@delete')->name('productDelete');
//
////Used for filter form
//Route::post('/products', 'ProductController@all')->name('productsAll');

