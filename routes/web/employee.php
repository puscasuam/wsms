<?php
use Illuminate\Support\Facades\Route;

//Routes for employees
//Get all employees
Route::get('/employees', 'EmployeeController@all')->name('employeesAll');

//Used for filter form
Route::post('/employees', 'EmployeeController@all')->name('employeesAll');

//Get an employee - by id
Route::get('/employee/{id}', 'EmployeeController@get')->name('employeeGet');

//Used in add employee form
Route::post('/employee', 'EmployeeController@post')->name('employeeAdd');

Route::delete('/employee/{id}', 'EmployeeController@delete')->name('employeeDelete');

//Get add employee form / page
Route::get('/employee', 'EmployeeController@form')->name('employeeNew');

//Used in view form
Route::get('/employee/{id}/view', 'EmployeeController@view')->name('employeeView');

