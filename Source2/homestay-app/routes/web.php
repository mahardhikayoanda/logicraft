<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardRedirectController;

// Guest
use App\Http\Controllers\Guest\GuestPropertyController;

// Admin
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Middleware\AdminMiddleware;

// Owner
use App\Http\Controllers\Owner\DashboardController as OwnerDashboardController;
use App\Http\Controllers\Owner\PropertyController as OwnerPropertyController;
use App\Http\Controllers\Owner\PropertyImageController;
use App\Http\Controllers\Owner\ReportController;
use App\Http\Middleware\OwnerMiddleware;

// Customer
use App\Http\Controllers\Customer\DashboardController as CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerPropertyController;
use App\Http\Controllers\Customer\ReservationController;
use App\Http\Controllers\Customer\WishlistController;
use App\Http\Controllers\Customer\ReviewController;
use App\Http\Middleware\CustomerMiddleware;

// Resepsionis
use App\Http\Controllers\Resepsionis\DashboardController as ResepsionisDashboardController;
use App\Http\Controllers\Resepsionis\PromotionController;
use App\Http\Controllers\Resepsionis\PropertyController as ReceptionistPropertyController;
use App\Http\Controllers\Resepsionis\ReservationController as ResepsionisReservationController;
use App\Http\Middleware\ResepsionisMiddleware;

//Route guest
Route::get('/', [GuestPropertyController::class, 'home'])->name('guest.home');
Route::get('/guest/properties', [GuestPropertyController::class, 'index'])->name('guest.properties.index');
Route::get('/property/{id}', [GuestPropertyController::class, 'show'])->name('guest.properties.show');


//Dashboard Redirect (After Login)

Route::get('/dashboard', [DashboardRedirectController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//Authenticated User Routes (Profile)

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin Routes

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin/users')->name('admin.users.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
    Route::patch('/{user}', [UserController::class, 'update'])->name('update');
    Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

    Route::get('/role/{role}', [UserController::class, 'indexByRole'])->name('byRole');
    Route::get('/owner/{id}/detail', [UserController::class, 'detailOwner'])->name('detailOwner');
});

//Owner Routes

Route::middleware(['auth', OwnerMiddleware::class])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [OwnerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/report', [ReportController::class, 'index'])->name('reports.index');

    Route::resource('properties', OwnerPropertyController::class)->except(['show']);
    Route::get('properties/{property}', [OwnerPropertyController::class, 'show'])->name('properties.show');
    Route::delete('properties/images/{id}', [PropertyImageController::class, 'destroy'])->name('properties.images.destroy');

    // Profile (shared)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Customer Routes

Route::middleware(['auth', CustomerMiddleware::class])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/properties', [CustomerPropertyController::class, 'index'])->name('properties.index');
    Route::get('/properties/{property}', [CustomerPropertyController::class, 'show'])->name('properties.show');

    // Reservation
    Route::get('/reservations/create/{property}', [ReservationController::class, 'create'])->name('reservations.create');
    Route::post('/properties/{property}/reservations', [ReservationController::class, 'store'])->name('reservations.store');
    Route::get('/reservations/history', [ReservationController::class, 'history'])->name('reservations.history');
    Route::get('/reservations/{reservation}', [ReservationController::class, 'show'])->name('reservations.show');
    Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])->name('reservations.edit');
    Route::put('/reservations/{reservation}', [ReservationController::class, 'update'])->name('reservations.update');
    Route::put('/reservations/{reservation}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::get('/reservations/{reservation}/payment-callback', [ReservationController::class, 'paymentCallback'])->name('reservations.callback');

    // Wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/{propertyId}', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{propertyId}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Review
    Route::get('/reviews/{reservation}/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/reviews/{reservation}', [ReviewController::class, 'store'])->name('reviews.store');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');

    // Profile (shared)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Resepsionis Routes

Route::middleware(['auth', ResepsionisMiddleware::class])->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/dashboard', [ResepsionisDashboardController::class, 'index'])->name('dashboard');

    // Promotion
    Route::resource('promotions', PromotionController::class)->except(['show']);

    // Reservation View
    Route::get('/reservations', [ResepsionisReservationController::class, 'index'])->name('reservations.index');

    // Property
    Route::get('/properties', [ReceptionistPropertyController::class, 'index'])->name('properties.index');
    Route::put('/properties/{property}/availability', [ReceptionistPropertyController::class, 'updateAvailability'])->name('properties.updateAvailability');

    // Profile (shared)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
