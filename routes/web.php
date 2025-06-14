<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\BuyerController;

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