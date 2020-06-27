<?php
use Illuminate\Support\Facades\Route;

//Get all transactions
Route::get('/transactions', 'TransactionController@all')->name('transactionsAll');

//Used for filter form
Route::post('/transactions', 'TransactionController@all')->name('transactionsAll');

//Used in paid modal
Route::delete('/transaction/paid/{id}', 'TransactionController@paid')->name('transactionPaid');

//Used in cancel modal
Route::delete('/transaction/canceled/{id}', 'TransactionController@canceled')->name('transactionCanceled');
