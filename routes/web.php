<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthenticatedSessionController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'login'])->name('login.post');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/**
 * Routes untuk Admin
 */
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/riwayat', [AnggotaController::class, 'riwayatPeminjamanAdmin'])->name('admin.riwayat');
    Route::post('/admin/perpanjang/{id}', [AnggotaController::class, 'perpanjangPeminjaman'])->name('admin.perpanjang-peminjaman');
    Route::post('/admin/selesaikan/{id}', [AnggotaController::class, 'selesaikanPeminjaman'])->name('admin.selesaikan-peminjaman');
});
    Route::resource('book', BookController::class);
    Route::resource('user', UserController::class);


/**
 * Routes untuk Anggota
 * 
 */
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
    Route::get('/riwayat-peminjaman', [AnggotaController::class, 'riwayatPeminjaman'])->name('riwayat');
    Route::post('/kembalikan-buku/{id}', [AnggotaController::class, 'kembalikanBuku'])->name('kembalikan_buku');
    Route::resource('/', AnggotaController::class)->parameters(['' => 'anggota']);
});

require __DIR__ . '/auth.php';
