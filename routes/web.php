<?php

use App\Http\Controllers\Admin\AdminCheckoutController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Landing Page Routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');

//Login With Google (Socialite Route) Routes
Route::get('/sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');

Route::middleware(['auth'])->group(function() {
    // Checkout Routes
    Route::controller(CheckoutController::class)->middleware('ensureUserRole:user')->group(function() {
        Route::get('/checkout/success', 'success')->name('checkout.success');   // Kenapa Route Succes ditaroh diatas, agar path nya tidak menuju ke camp slug
        Route::get('/checkout/{camp:slug}', 'create')->name('checkout.create');
        Route::post('/checkout/{camp:slug}', 'store')->name('checkout.store');
    });

    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    // User Dashboard
    Route::middleware('ensureUserRole:user')->prefix('user/dashboard')->name('user.')->group(function() {
        Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
    });

    // Admin Dashboard
    Route::middleware('ensureUserRole:admin')->prefix('admin/dashboard')->name('admin.')->group(function() {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::post('/checkout/{checkout}', [AdminCheckoutController::class, 'update'])->name('checkout.update');
    });
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
