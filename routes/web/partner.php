<?php
use Illuminate\Support\Facades\Route;

////Routes for partners
//Get all partners
Route::get('/partners', 'PartnerController@all')->name('partnersAll');

//Get add partner form / page
Route::get('/partner', 'PartnerController@form')->name('newPartner');

//Used in add partner form
Route::post('/partner', 'PartnerController@post')->name('partnerAdd');

//Get a partner - by id
Route::get('/partner/{id}', 'PartnerController@get')->name('partnerGet');

//Used in view form
Route::get('/partner/{id}/view', 'PartnerController@view')->name('partnerView');

//Used to update partner - by id
Route::patch('/partner', 'PartnerController@update')->name('partnerUpdate');

//Used to delete a partner
Route::delete('/partner/{id}', 'PartnerController@delete')->name('partnerDelete');

//Used for filter form
Route::post('/partners', 'PartnerController@all')->name('partnersAll');
