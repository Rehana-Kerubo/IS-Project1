<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
});
Route::get('login', function () {
    return view('login-register');
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