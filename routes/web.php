<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\MeteranController;

// ----------------- HALAMAN LANDING -----------------
Route::get('/', fn () => view('index'));

// ----------------- LOGIN & LOGOUT -----------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ----------------- ADMIN ONLY -----------------
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/users', UserController::class);
    Route::resource('/pelanggans', PelangganController::class);
    Route::resource('/pengumumans', PengumumanController::class);
    Route::resource('/tarifs', TarifController::class);
    Route::resource('/periodes', PeriodeController::class);

    // Fitur khusus admin di meteran
    Route::patch('/pengumumans/{id}/toggle', [PengumumanController::class, 'toggleTampilkanDiUser'])->name('pengumumans.toggle');
});

// ----------------- ADMIN & PETUGAS (SHARED) -----------------
Route::middleware(['auth', 'role:admin|petugas'])->group(function () {
    Route::resource('/meterans', MeteranController::class)->names('meterans');
    Route::patch('/meterans/{meteran}/lunas', [MeteranController::class, 'markAsLunas'])->name('meterans.markAsLunas');
});

// ----------------- PETUGAS REDIRECT DASHBOARD -----------------
Route::prefix('petugas')->name('petugas.')->middleware(['auth', 'role:petugas'])->group(function () {
    Route::get('/', fn() => redirect()->route('meterans.index'));
});

// ----------------- USER -----------------
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'dashboardUser'])->name('user.dashboard');
});
