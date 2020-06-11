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


Route::get('/add-brand', 'BrandController@addBrand');
Route::get('/add-category', 'CategoryController@addCategory');



Route::get('/add-gemstone', 'GemstoneController@addGemstone')->name('addGemstone');
Route::get('/add-gemstone-product', 'ProductController@addGemstoneProduct');

Route::get('/add-product-material', 'ProductController@addProductMaterial');

Route::get('/add-material', 'MaterialController@addMaterial');

Route::get('/add-location', 'LocationController@addLocation');

Route::get('/add-sublocation', 'SublocationController@addSublocation');
Route::get('/add-product-sublocation', 'ProductController@addProductSublocation');



//Routes for products
Route::get('/products', 'ProductController@all')->name('productsAll');
Route::get('/product/{id}', 'ProductController@get')->name('productGet');
Route::post('/product', 'ProductController@post')->name('productAdd');
Route::delete('/product/{id}', 'ProductController@delete')->name('productDelete');
Route::get('/product/{id}', 'ProductController@delete')->name('productDelete');

Route::get('/product', 'ProductController@form')->name('newProduct');

//Route::get('/products', function () {
//    return view('product/all');
//});
