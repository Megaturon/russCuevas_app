<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('main-page', ['gallery' => 'none']);
});

Route::redirect('/login-page', '/login');
Route::redirect('/signup-page', '/signup');
Route::redirect('/forgot-password', '/forget-password');

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

Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forget-password', [AuthController::class, 'sendVerificationCode'])->name('password.email');
Route::post('/verify-otp', [AuthController::class, 'verifyCode'])->name('password.verify');

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

use App\Http\Controllers\AppointmentController;

Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');

use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/appointment-action', [AdminController::class, 'appointmentAction'])->name('admin.appointment.action');
    Route::post('/quote-action', [AdminController::class, 'quoteAction'])->name('admin.quote.action');
    Route::post('/user-action', [AdminController::class, 'userAction'])->name('admin.user.action');
    Route::post('/filter-appointments', [AdminController::class, 'filterAppointments'])->name('admin.filter.appointments');
});
