<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;

Route::get('/', function () {
    return view('welcome');
});

// Show the quote form (GET request)
Route::get('/get-a-quote', [QuoteController::class, 'index'])->name('quote.index');

// Submit the quote form (POST request)
Route::post('/get-a-quote', [QuoteController::class, 'store'])->name('quote.store');
