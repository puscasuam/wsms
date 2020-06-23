<?php
use Illuminate\Support\Facades\Route;

////Routes for partners
//Get all partners
Route::get('/partners', 'PartnerController@all')->name('partnersAll');

//Used for filter form
Route::post('/partners', 'PartnerController@all')->name('partnersAll');

//Used in add partner form
Route::post('/partner', 'PartnerController@post')->name('partnerAdd');

//Get add partner form / page
Route::get('/partner', 'PartnerController@form')->name('newPartner');

//Get a partner - by id
Route::get('/partner/{id}', 'PartnerController@get')->name('partnerGet');

Route::delete('/partner/{id}', 'PartnerController@delete')->name('partnerDelete');

//Used in view form
Route::get('/partner/{id}/view', 'PartnerController@view')->name('partnerView');
