<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\CarsLocationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/cities/{id}', [LocationController::class, 'DataCities'])->name('cities');
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'location', 'middleware' => 'admin'], function () {
        Route::get('/', [LocationController::class, 'index'])->name('location');
        Route::post('/', [LocationController::class, 'store'])->name('location.store');
        Route::get('/{location}', [LocationController::class, 'edit'])->name('location.edit');
        Route::post('/{location}', [LocationController::class, 'update'])->name('location.update');
        Route::delete('/{location}', [LocationController::class, 'destroy'])->name('location.destroy');
    });

    Route::group(['prefix' => 'brands', 'middleware' => 'admin'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('brands');
        Route::post('/', [BrandController::class, 'store'])->name('brands.store');
        Route::get('/{brand}', [BrandController::class, 'edit'])->name('brands.edit');
        Route::post('/{brand}', [BrandController::class, 'update'])->name('brands.update');
        Route::delete('/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');
    });

    Route::group(['prefix' => 'cars', 'middleware' => 'admin'], function () {
        Route::get('/', [CarsController::class, 'index'])->name('cars');
        Route::post('/', [CarsController::class, 'store'])->name('cars.store');
        Route::get('/{car}', [CarsController::class, 'edit'])->name('cars.edit');
        Route::post('/{car}', [CarsController::class, 'update'])->name('cars.update');
        Route::delete('/{car}', [CarsController::class, 'destroy'])->name('cars.destroy');
    });

    Route::group(['prefix' => 'cars-location', 'middleware' => 'admin'], function () {
        Route::get('/', [CarsLocationController::class, 'index'])->name('cars-location');
        Route::post('/', [CarsLocationController::class, 'store'])->name('cars-location.store');
        Route::get('/{carLocation}', [CarsLocationController::class, 'edit'])->name('cars-location.edit');
        Route::post('/{carLocation}', [CarsLocationController::class, 'update'])->name('cars-location.update');
        Route::delete('/{carLocation}', [CarsLocationController::class, 'destroy'])->name('cars-location.destroy');
    });

    Route::group(['prefix' => 'drivers', 'middleware' => 'admin'], function () {
        Route::get('/', [DriverController::class, 'index'])->name('drivers');
        Route::post('/', [DriverController::class, 'store'])->name('drivers.store');
        Route::get('/{driver}', [DriverController::class, 'edit'])->name('drivers.edit');
        Route::post('/{driver}', [DriverController::class, 'update'])->name('drivers.update');
        Route::delete('/{driver}', [DriverController::class, 'destroy'])->name('drivers.destroy');
    });

    Route::group(['prefix' => 'users', 'middleware' => 'admin'], function () {
        Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('users');
        Route::post('/', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');
        Route::get('/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
        Route::post('/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');
    });

    Route::group(['prefix' => 'bookings'], function () {
        Route::get('/', [App\Http\Controllers\BookingController::class, 'index'])->name('bookings');
        Route::get('/{booking}', [App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
        Route::post('/{booking}', [App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
        Route::delete('/{booking}', [App\Http\Controllers\BookingController::class, 'destroy'])->name('bookings.destroy');
    });

    Route::group(['prefix' => 'payments', 'middleware' => 'admin'], function () {
        Route::get('/', [App\Http\Controllers\PaymentController::class, 'index'])->name('payments');
        Route::post('/{payment}', [App\Http\Controllers\PaymentController::class, 'update'])->name('payments.update');
        Route::delete('/{payment}', [App\Http\Controllers\PaymentController::class, 'destroy'])->name('payments.destroy');
    });

    Route::get('/invoices/{booking}', [App\Http\Controllers\BookingController::class, 'downloadInvoice'])->name('invoices');
});

Route::get('/', [FrontendController::class, 'splash'])->name('splash');
Route::get('/home', [FrontendController::class, 'index'])->name('home');
Route::get('/detail/{car}', [FrontendController::class, 'detail'])->name('detail');
Route::get('{car}/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::post('/booking/{car}', [FrontendController::class, 'booking'])->name('booking');
Route::get('/payment/{payment}', [FrontendController::class, 'paymentSuccess'])->name('payment');

require __DIR__ . '/auth.php';
