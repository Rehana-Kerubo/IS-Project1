<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\VendorController;

Route::get('/', function () {
    return view('landing');
});
Route::get('/login-register', function () {
    return view('login-register');
});
Route::get('/buyer/landing', function () {
    return view('buyer/landing');
});

Route::get('/buyer/view-acc', function () {
    return view('buyer/view-acc');
});
Route::get('/buyer/edit', function () {
    return view('buyer/edit');
});
Route::get('/buyer/b-products', function () {
    return view('buyer/b-products');
});
Route::get('/buyer/be-vendor', function () {
    return view('buyer/be-vendor');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');
Route::put('/buyer/update-profile', [BuyerController::class, 'updateProfile'])->name('buyer.update-profile');
Route::get('/buyer/search', [BuyerController::class, 'search'])->name('buyer.search');
// GET: to show the form
Route::get('/buyer/checkout', [BuyerController::class, 'checkout'])->name('buyer.checkout');

// POST: to handle the form submission
Route::post('/buyer/checkout', [BuyerController::class, 'processCheckout'])->name('buyer.checkout.process');


Route::get('/buyer/payment-loader', [BuyerController::class, 'paymentLoader'])->name('buyer.payment.loader');
Route::get('/buyer/payment-success', [BuyerController::class, 'paymentSuccess'])->name('buyer.payment.success');

Route::middleware(['auth'])->group(function () {
    Route::get('/buyer/be-vendor', [VendorController::class, 'create'])->name('buyer.be-vendor');
    Route::post('/buyer/be-vendor', [VendorController::class, 'store'])->name('buyer.be-vendor.submit');
});


Route::get('/vendor/dashboard', function() {
    return view('/vendor/dashboard');
});
Route::get('/vendor/products', function() {
    return view('/vendor/products');
});
Route::get('/vendor/booked', function() {
    return view('/vendor/booked');
});
Route::get('/vendor/analytics', function() {
    return view('/vendor/analytics');
});