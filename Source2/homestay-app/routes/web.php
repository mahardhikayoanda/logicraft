<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Customer\ReservationController;
use App\Http\Controllers\Customer\CustomerPropertyController;
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\DashboardRedirectController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\PropertyController;
use App\Http\Controllers\Owner\PropertyImageController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Controllers\Resepsionis\PropertyController as ReceptionistPropertyController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CustomerMiddleware;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisDashboardController;
use App\Http\Controllers\Resepsionis\PromotionController;
use App\Http\Middleware\ResepsionisMiddleware;
use App\Models\Promotion;
use App\Http\Controllers\Resepsionis\ReservationController as ResepsionisReservationController;

// Route pencarian lokasi (OpenStreetMap API)
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

// Route umum
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardRedirectController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Profile untuk semua user (autentikasi)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Admin
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/role/{role}', [UserController::class, 'indexByRole'])->name('byRole');
    Route::get('/admin/users/owner/{id}/detail', [UserController::class, 'detailOwner'])->name('detailOwner');
});

// Route Owner
Route::middleware(['auth', OwnerMiddleware::class])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/owner/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/report', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/create', [PropertyController::class, 'create'])->name('properties.create');
    Route::post('/properties', [PropertyController::class, 'store'])->name('properties.store');
    Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
    Route::get('/properties/{property}/edit', [PropertyController::class, 'edit'])->name('properties.edit');
    Route::put('/properties/{property}', [PropertyController::class, 'update'])->name('properties.update');
    Route::delete('/properties/{property}', [PropertyController::class, 'destroy'])->name('properties.destroy');
    Route::delete('properties/images/{id}', [PropertyImageController::class, 'destroy'])->name('properties.images.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Customer
Route::middleware(['auth', CustomerMiddleware::class])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
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

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Resepsionis
Route::middleware(['auth', ResepsionisMiddleware::class])->prefix('resepsionis')->name('resepsionis.')->group(function () {
        Route::get('/dashboard', [ResepsionisDashboardController::class, 'index'])->name('dashboard');

        // ✅ Route manual untuk PromotionController
        Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
        Route::get('/promotions/create', [PromotionController::class, 'create'])->name('promotions.create');
        Route::post('/promotions', [PromotionController::class, 'store'])->name('promotions.store');
        Route::get('/promotions/{promotion}/edit', [PromotionController::class, 'edit'])->name('promotions.edit');
        Route::put('/promotions/{promotion}', [PromotionController::class, 'update'])->name('promotions.update');
        Route::delete('/promotions/{promotion}', [PromotionController::class, 'destroy'])->name('promotions.destroy');

        //ini tempat route reservasi resepsionis
        Route::get('/reservations', [ResepsionisReservationController::class, 'index'])->name('reservations.index');


        // Properti & Profil
        Route::get('/properties', [ReceptionistPropertyController::class, 'index'])->name('properties.index');
        Route::put('/properties/{property}/availability', [ReceptionistPropertyController::class, 'updateAvailability'])->name('properties.updateAvailability');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::get('/dashboard', [ResepsionisDashboardController::class, 'index'])->name('dashboard');
    // // Route::resource('promotions', PromotionController::class);
    
    // Route::get('/promotions', [PromotionController::class, 'index'])->name('promotions.index');
    // Route::get('/properties', [ReceptionistPropertyController::class, 'index'])->name('properties.index');
    // Route::put('/properties/{property}/availability', [ReceptionistPropertyController::class, 'updateAvailability'])->name('properties.updateAvailability');

    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';