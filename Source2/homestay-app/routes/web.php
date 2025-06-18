<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Owner\PropertyController;
use App\Http\Controllers\Owner\PropertyImageController;
use App\Http\Controllers\Customer\ReservationController;
use App\Http\Controllers\Customer\CustomerPropertyController;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Controllers\LokasiController;
// routes/web.php
use Illuminate\Support\Facades\Http;

Route::get('/api/cari-lokasi', function () {
    $query = request('q');
    if (!$query) return response()->json(['error' => 'No query'], 400);

    $response = Http::withHeaders([
        'User-Agent' => 'YourAppName/1.0 (your@email.com)'
    ])->get('https://nominatim.openstreetmap.org/search', [
        'q' => $query,
        'format' => 'json'
    ]);

    return $response->json();
});

Route::post('/lokasi', [LokasiController::class, 'store'])->name('lokasi.store');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', OwnerMiddleware::class])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::delete('properties/images/{id}', [PropertyImageController::class, 'destroy'])->name('properties.images.destroy');
});

Route::middleware(['auth', CustomerMiddleware::class])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/properties', [CustomerPropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{property}', [CustomerPropertyController::class, 'show'])->name('properties.show');
    Route::get('/reservations/create/{property}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/properties/{property}/reserve', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/history', [ReservationController::class, 'history'])->name('reservations.history');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::put('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
});


require __DIR__ . '/auth.php';
