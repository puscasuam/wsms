<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Mail\WelcomeMail;

Auth::routes();

Route::get('/email', function () {
//    Mail::to('puscasu.a.m@gmail.com')->send(new WelcomeMail());

    return new WelcomeMail();})->name('welcomeMail');
