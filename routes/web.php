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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products', 'ProductController@getAllProducts')->name('products');

Route::get('/table', function () {
    return view('table');
});

Route::get('/add-brand', 'BrandController@addBrand');
Route::get('/add-category', 'CategoryController@addCategory');
Route::get('/add-product', 'ProductController@addProduct')->name('addProduct');

Route::get('/add-gemstone', 'GemstoneController@addGemstone')->name('addGemstone');
Route::get('/add-gemstone-product', 'ProductController@addGemstoneProduct');

Route::get('/add-product-material', 'ProductController@addProductMaterial');

Route::get('/add-material', 'MaterialController@addMaterial');

Route::get('/add-location', 'LocationController@addLocation');

Route::get('/add-sublocation', 'SublocationController@addSublocation');
Route::get('/add-product-sublocation', 'ProductController@addProductSublocation');



