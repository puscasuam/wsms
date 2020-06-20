<?php
use Illuminate\Support\Facades\Route;

//Routes for transactions
//Get all transactions
Route::get('/transactions', 'TransactionController@all')->name('transactionsAll');

////Used for filter form
//Route::post('/products', 'ProductController@all')->name('productsAll');
//
////Get a transaction - by id
//Route::get('/product/{id}', 'ProductController@get')->name('productGet');

////Used in add product form
//Route::post('/product', 'ProductController@post')->name('productAdd');
//
//Route::delete('/product/{id}', 'ProductController@delete')->name('productDelete');
////Route::get('/product/{id}', 'ProductController@delete')->name('productDelete');
//
////Get add product form / page
//Route::get('/product', 'ProductController@form')->name('newProduct');
//
////Used in view form
//Route::get('/product/{id}/view', 'ProductController@view')->name('productView');
