<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminPusatController;
use App\Http\Controllers\PemKecamatanController;
use App\Http\Controllers\WargaController;

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes bawaan Laravel
Auth::routes();

// Rute khusus Warga
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', [WargaController::class, 'index'])->name('warga.dashboard');
    Route::get('/warga/reports/create', [WargaController::class, 'create'])->name('warga.reports.create');
    Route::post('/warga/reports', [WargaController::class, 'store'])->name('warga.reports.store');
    Route::get('/warga/reports/{id}', [WargaController::class, 'show'])->name('warga.reports.show');
});

// Rute khusus Admin Pusat (Pemkot)
Route::middleware(['auth', 'role:admin_pusat'])->group(function () {
    Route::get('/admin/dashboard', [AdminPusatController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/reports', [AdminPusatController::class, 'reports'])->name('admin.reports.index');
    Route::post('/admin/reports/{id}/forward', [AdminPusatController::class, 'forward'])->name('admin.reports.forward');
    
    // Rute Kelola Petugas Kecamatan
    Route::get('/admin/petugas', [AdminPusatController::class, 'petugasIndex'])->name('admin.petugas.index');
    Route::post('/admin/petugas/store', [AdminPusatController::class, 'petugasStore'])->name('admin.petugas.store');

    // PERBAIKAN: Rute Kelola Data Warga (Sejajar dengan fitur petugas)
    Route::get('/admin/warga', [AdminPusatController::class, 'wargaIndex'])->name('admin.warga.index');
    Route::delete('/admin/warga/{id}', [AdminPusatController::class, 'wargaDestroy'])->name('admin.warga.destroy');
});

// Rute khusus Pemerintah Kecamatan
Route::middleware(['auth', 'role:pem_kecamatan'])->group(function () {
    Route::get('/kecamatan/dashboard', [PemKecamatanController::class, 'index'])->name('kecamatan.dashboard');
    Route::get('/kecamatan/reports/{id}', [PemKecamatanController::class, 'show'])->name('kecamatan.reports.show');
    Route::post('/kecamatan/reports/{id}/process', [PemKecamatanController::class, 'process'])->name('kecamatan.reports.process');
    Route::post('/kecamatan/reports/{id}/resolve', [PemKecamatanController::class, 'resolve'])->name('kecamatan.reports.resolve');
    Route::get('/kecamatan/reports/{id}/pdf', [PemKecamatanController::class, 'exportPdf'])->name('kecamatan.reports.pdf');
});