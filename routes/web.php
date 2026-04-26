<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/main');

Route::get('/main', function () {
    return view('main-page', ['gallery' => 'none']);
});

Route::get('/main/{id}', function (string $id) {
    return view('main-page', ['gallery' => $id]);
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signup', [AuthController::class, 'showRegistrationForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);

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

// Show the quote form (GET request)
Route::get('/get-a-quote', [QuoteController::class, 'index'])->name('quote.index');

// Submit the quote form (POST request)
Route::post('/get-a-quote', [QuoteController::class, 'store'])->name('quote.store');

Route::get('/appointments', function () {
    return view('appointments');
})->name('appointments.index');