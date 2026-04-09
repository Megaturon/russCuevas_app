<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main-page');
});

Route::get('/login', function () {
    return view('login-page');
});

Route::get('/reset-password', function () {
    return view('reset-password');
});

Route::get('/forget-password', function () {
    return view('forget-password');
});

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/signup', function () {
    return view('signup-page');
});

Route::get('/appointments', function () {
    return view('appointments');
});