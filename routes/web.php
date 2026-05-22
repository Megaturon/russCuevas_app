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

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/reset-password', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('password.request');
Route::post('/forget-password', [AuthController::class, 'sendVerificationCode'])->name('password.email');
Route::post('/verify-otp', [AuthController::class, 'verifyCode'])->name('password.verify');

Route::get('/faq', function () {
    return view('faq');
});

Route::get('/our-story', function () {
    return view('our-story');
});

Route::get('/privacy', function () {
    return view('privacy');
});

Route::get('/terms', function () {
    return view('terms');
});

use App\Http\Controllers\AppointmentController;

Route::middleware('auth')->group(function () {
    // Show the quote form (GET request)
    Route::get('/get-a-quote', [QuoteController::class, 'index'])->name('quote.index');

    // Submit the quote form (POST request)
    Route::post('/get-a-quote', [QuoteController::class, 'store'])->name('quote.store');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('appointments.store');
});

// Client response routes for rescheduling (publicly accessible)
Route::get('/appointment/{id}/confirm-reschedule', [AppointmentController::class, 'confirmReschedule'])->name('appointment.confirm_reschedule');
Route::get('/appointment/{id}/cancel-reschedule', [AppointmentController::class, 'cancelReschedule'])->name('appointment.cancel_reschedule');

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ReceiptController;

// Token-based Payment Routes (No login required)
Route::get('/quotes/{token}/paymongo', [CheckoutController::class, 'paymongoRedirect'])->name('checkout.paymongo');
Route::get('/quotes/{token}/pay', [CheckoutController::class, 'showPayment'])->name('checkout.pay');
Route::post('/quotes/{token}/process-payment', [CheckoutController::class, 'processPayment'])->name('checkout.process_payment');
Route::get('/quotes/{token}/payment-success', [CheckoutController::class, 'successCallback'])->name('checkout.payment_success');

use App\Http\Controllers\ClientPortalController;

Route::middleware('auth')->prefix('portal')->group(function () {
    Route::get('/appointments', [ClientPortalController::class, 'appointments'])->name('portal.appointments');
    Route::get('/quotes', [ClientPortalController::class, 'quotes'])->name('portal.quotes');
    Route::get('/receipts', [ClientPortalController::class, 'receipts'])->name('portal.receipts');
});

// Formal Receipt Route (Public for seamless demo flow)
Route::get('/receipts/{reference}', [ReceiptController::class, 'show'])->name('receipts.show');
Route::get('/receipts/{reference}/download', [ReceiptController::class, 'download'])->name('receipts.download');

use App\Http\Controllers\AdminController;

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/appointment-action', [AdminController::class, 'appointmentAction'])->name('admin.appointment.action');
    Route::post('/quote-action', [AdminController::class, 'quoteAction'])->name('admin.quote.action');
    Route::post('/user-action', [AdminController::class, 'userAction'])->name('admin.user.action');
    Route::post('/filter-appointments', [AdminController::class, 'filterAppointments'])->name('admin.filter.appointments');
    Route::get('/latest-appointments', [AdminController::class, 'latestAppointments'])->name('admin.latest.appointments');
});

// Chatbot route
Route::post('/chatbot/send', function (\Illuminate\Http\Request $request) {
    $message = $request->input('message');
    
    $reply = "I received your message: '{$message}'. I am a simple bot!";
    if (stripos($message, 'hello') !== false || stripos($message, 'hi') !== false) {
        $reply = "Hello! How can I help you today?";
    } elseif (stripos($message, 'appointment') !== false || stripos($message, 'book') !== false) {
        $reply = "You can book an appointment by clicking the 'Book an Appointment' button on our home page!";
    } elseif (stripos($message, 'price') !== false || stripos($message, 'cost') !== false) {
        $reply = "Our prices vary depending on the design. Please submit a quote request or book a consultation.";
    }
    
    broadcast(new \App\Events\ChatMessageEvent($reply, 'Bot'));
    
    return response()->json(['status' => 'success']);
});
