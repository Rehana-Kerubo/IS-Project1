<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleController;

Route::get('/', function () {
    return view('landing');
});
Route::get('/login-register', function () {
    return view('login-register');
});

// Route::get('/userlogin', function () {
//     return view('userlogin');
// });

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

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