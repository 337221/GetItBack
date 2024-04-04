<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DistanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/book-a-ride', [DistanceController::class, 'index'])->name('book-a-ride');
    Route::post('/calculate-distance', [DistanceController::class, 'calculate'])->name('calculate-distance');
    Route::post('/book-ride', [DistanceController::class, 'bookRide'])->name('book-ride');
    Route::get('/ride-history', [DistanceController::class, 'rideHistory'])->name('ride-history');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::post('/admin/update-price', [AdminController::class, 'updatePricePerKilometer'])->name('admin.update-price');
    Route::patch('/admin/bookings/{booking}/status', [AdminController::class, 'updateBookingStatus'])->name('admin.update-booking-status');
    Route::get('/admin/reservations', [AdminController::class, 'reservations'])->name('admin.reservations');
});

require __DIR__.'/auth.php';
