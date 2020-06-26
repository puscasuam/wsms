<?php

use Illuminate\Support\Facades\Route;

//Routes for employees

//Get all employees
Route::get('/employees', 'EmployeeController@all')->name('employeesAll');

//Get add employee form / page
Route::get('/employee', 'EmployeeController@form')->name('employeeNew');

//Used in add employee form
Route::post('/employee', 'EmployeeController@post')->name('employeeAdd');

//Get an employee - by id
Route::get('/employee/{id}', 'EmployeeController@get')->name('employeeGet');

//Used in view form
Route::get('/employee/{id}/view', 'EmployeeController@view')->name('employeeView');

//Used to update employee - by id
Route::patch('/employee', 'EmployeeController@update')->name('employeeUpdate');

//Used to delete an employee
Route::delete('/employee/{id}', 'EmployeeController@delete')->name('employeeDelete');

//Used for filter form
Route::post('/employees', 'EmployeeController@all')->name('employeesAll');
