<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertiesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\Auth\RegisteredUserController;


Route::get('/register', [RegisteredUserController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'register']);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('owner.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Owner routes
Route::middleware(['auth'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerController::class, 'index'])->name('dashboard');
    Route::get('/properties', [OwnerController::class, 'properties'])->name('properties');
    Route::get('/transactions', [OwnerController::class, 'transactions'])->name('transactions');
    Route::get('/bookkeeping', [OwnerController::class, 'bookkeeping'])->name('bookkeeping');
});

// Properties routes - PERBAIKI BAGIAN INI
Route::middleware(['auth'])->group(function () {
    // Resource route untuk CRUD properties
    Route::resource('properties', PropertiesController::class);
    
    // Route tambahan untuk AJAX dan fungsi khusus
    Route::get('/properties/{id}/details', [PropertiesController::class, 'details'])->name('properties.details');
    Route::post('/properties/{id}/toggle-status', [PropertiesController::class, 'toggleStatus'])->name('properties.toggle-status');
    Route::patch('/properties/{id}/rental-status', [PropertiesController::class, 'updateRentalStatus'])->name('properties.update-rental-status');
    Route::get('/api/properties', [PropertiesController::class, 'apiIndex'])->name('properties.api');
    Route::get('/api/properties/statistics', [PropertiesController::class, 'getStatistics'])->name('properties.statistics');
});

Route::middleware('auth')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
    Route::get('/transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
    Route::patch('/transactions/{transaction}/status', [TransactionController::class, 'updateStatus'])->name('transactions.update-status');
});

require __DIR__.'/auth.php';