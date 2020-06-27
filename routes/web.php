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
})->name('welcome');


//Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


//Used in out order to get product details
Route::post('/occupancy-rate-json', 'HomeController@occupancyRateJson')->name('occupancyRateJson');

//Used in getting employees number
Route::post('/employees-no-json', 'HomeController@employeesNoJson')->name('employeesNoJson');

//Used in getting income number
Route::post('/income-no-json', 'HomeController@incomeNoJson')->name('incomeNoJson');

//Used in getting outcome number
Route::post('/outcome-no-json', 'HomeController@outcomeNoJson')->name('outcomeNoJson');

//Used in getting outcome number
Route::post('/location-occupancy-json', 'HomeController@locationOccupancyJson')->name('locationOccupancyJson');

