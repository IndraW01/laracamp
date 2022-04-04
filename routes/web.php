<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Route::get('/success-checkout', function () {
    return view('success-checkout');
})->name('success.checkout');
