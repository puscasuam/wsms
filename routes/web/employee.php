<?php
use Illuminate\Support\Facades\Route;

//Routes for employees
//Get all employees
Route::get('/employees', 'EmployeeController@all')->name('employeesAll');

//Used for filter form
Route::post('/employees', 'EmployeeController@all')->name('employeesAll');

////Get an employee - by id
//Route::get('/product/{id}', 'ProductController@get')->name('productGet');

//Used in add employee form
Route::post('/employee', 'EmployeeController@post')->name('employeeAdd');

//Route::delete('/product/{id}', 'ProductController@delete')->name('productDelete');
////Route::get('/product/{id}', 'ProductController@delete')->name('productDelete');
//
//Get add employee form / page
Route::get('/employee', 'EmployeeController@form')->name('employeeNew');
//
////Used in view form
//Route::get('/product/{id}/view', 'ProductController@view')->name('productView');

