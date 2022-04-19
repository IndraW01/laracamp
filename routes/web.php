<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Landing Page Routes
Route::get('/', [HomeController::class, 'index'])->name('welcome');
// Akhir Landing Page Routes

//Login With Google (Socialite Route) Routes
Route::get('/sign-in-google', [UserController::class, 'google'])->name('user.login.google');
Route::get('/auth/google/callback', [UserController::class, 'handleProviderCallback'])->name('user.google.callback');
// Akhir Login With Google Routes

Route::middleware(['auth'])->group(function() {
    // Checkout Routes
    Route::get('checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');   // Kenapa Route Succes ditaroh diatas agar path nya tidak menuju ke camp slug
    Route::get('checkout/{camp:slug}', [CheckoutController::class, 'create'])->name('checkout.create');
    Route::post('checkout/{camp:slug}', [CheckoutController::class, 'store'])->name('checkout.store');
    // Akhir Checkout Routes

    // User Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('user.dashboard');
    // Akhir User Dashboard Routes
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
