<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UlasanController;


Route::get('/dashboard', function () {
    return view('resepsionis.dashboard');
})->name('dashboard');
// Route::get('/ulasan', [UlasanController::class, 'index'])->name('reviews.index');
// Route::post('/ulasan/{id}', [UlasanController::class, 'store'])->name('reviews.store');
Route::get('/reservasi/tambah', [ReservasiController::class, 'create'])->name('reservasi.tambah');
Route::post('/reservasi/simpan', [ReservasiController::class, 'store'])->name('reservasi.simpan');
Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
Route::get('/reservasi/{id}/edit', [ReservasiController::class, 'edit'])->name('reservasi.edit');
Route::put('/reservasi/{id}', [ReservasiController::class, 'update'])->name('reservasi.update');
Route::get('/reservasi/dihapus', [ReservasiController::class, 'dihapus'])->name('reservasi.dihapus');
Route::delete('/resepsionis/reservasi/{id}', [ReservasiController::class, 'destroy'])->name('reservasi.destroy');
Route::resource('/resepsionis/reservasi', ReservasiController::class);
Route::get('/resepsionis/reservasi-dihapus', [ReservasiController::class, 'dihapus'])->name('reservasi.dihapus');

Route::get('/', function () {
    return view('welcome');
});
