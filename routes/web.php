<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StallPaymentController;


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

Route::middleware(['auth:buyer'])->group(function () {
    Route::get('/buyer/be-vendor', [VendorController::class, 'create'])->name('buyer.be-vendor');
    Route::post('/buyer/be-vendor', [VendorController::class, 'store'])->name('buyer.be-vendor.submit');
});


Route::get('/vendor/v-landing', function() {
    return view('/vendor/v-landing');
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
Route::get('/vendor/add-product', function() {
    return view('/vendor/add-product');
});
Route::put('/vendor/dashboard/update', [VendorController::class, 'update'])->name('vendor.update');
Route::middleware(['auth:buyer'])->group(function () {
    Route::get('/vendor/add-product', [ProductController::class, 'create'])->name('vendor.products.create');
    Route::post('/vendor/add-product', [ProductController::class, 'store'])->name('vendor.products.store');
});
Route::middleware(['auth:buyer'])->group(function () {
    Route::get('/vendor/products', [ProductController::class, 'index'])->name('vendor.products.index');
    Route::get('/vendor/products/{product}/edit', [ProductController::class, 'edit'])->name('vendor.products.edit');
    Route::put('/vendor/products/{id}', [ProductController::class, 'update'])->name('vendor.products.update');
    Route::put('/vendor/products/{product}', [ProductController::class, 'update'])->name('vendor.products.update');
    Route::delete('/vendor/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// Route::get('/vendor/book-stall', function() {
//     return view('/vendor/book-stall');
// });
// Route::middleware(['auth:buyer'])->group(function () {
//     Route::get('/vendor/book-stall', [StallPaymentController::class, 'create'])->name('vendor.book-stall');
//     Route::post('/vendor/book-stall', [StallPaymentController::class, 'store'])->name('vendor.book-stall');
// });
// Show available flea markets (announcements)
Route::get('/vendor/book-stall', [StallPaymentController::class, 'index'])->name('stall.select');

// Show form with selected flea market
Route::get('/vendor/book-stall/{announcement_id}', [StallPaymentController::class, 'create'])->name('stall.create');

// Store the booking/payment
Route::post('/vendor/book-stall', [StallPaymentController::class, 'store'])->name('stall.store');



