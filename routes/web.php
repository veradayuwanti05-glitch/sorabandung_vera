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

// ==========================================
// 1. RUTE KHUSUS WARGA
// ==========================================
Route::middleware(['auth', 'role:warga'])->group(function () {
    Route::get('/warga/dashboard', [WargaController::class, 'index'])->name('warga.dashboard');
    Route::get('/warga/reports/create', [WargaController::class, 'create'])->name('warga.reports.create');
    Route::post('/warga/reports', [WargaController::class, 'store'])->name('warga.reports.store');
    Route::get('/warga/reports/{id}/edit', [WargaController::class, 'edit'])->name('warga.reports.edit');
    Route::put('/warga/reports/{id}', [WargaController::class, 'update'])->name('warga.reports.update');
    Route::get('/warga/reports/{id}', [WargaController::class, 'show'])->name('warga.reports.show');
});

// ==========================================
// 2. RUTE KHUSUS ADMIN PUSAT (PEMKOT)
// ==========================================
Route::middleware(['auth', 'role:admin_pusat'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Utama Admin
    Route::get('/dashboard', [AdminPusatController::class, 'index'])->name('dashboard');
    
    // Kelola Laporan (Halaman Utama / Index)
    Route::get('/reports', [AdminPusatController::class, 'reports'])->name('reports.index');
    
    // Fitur Baru: Verifikasi Awal (Show, Kirim ke Kecamatan, & Tolak Laporan)
    Route::get('/reports/{id}', [AdminPusatController::class, 'show'])->name('reports.show');
    Route::put('/reports/{id}/kirim', [AdminPusatController::class, 'kirimKeKecamatan'])->name('reports.kirim');
    Route::put('/reports/{id}/tolak', [AdminPusatController::class, 'tolakLaporan'])->name('reports.tolak');
    
    // Rute Lama: Meneruskan Laporan Langsung via Form Index Priority
    Route::post('/reports/{id}/forward', [AdminPusatController::class, 'forward'])->name('reports.forward');
    
    // Rute Kelola Petugas Kecamatan
    Route::get('/petugas', [AdminPusatController::class, 'petugasIndex'])->name('petugas.index');
    Route::post('/petugas/store', [AdminPusatController::class, 'petugasStore'])->name('petugas.store');
    
    // Rute Kelola Data Warga
    Route::get('/warga', [AdminPusatController::class, 'wargaIndex'])->name('warga.index');
    Route::delete('/warga/{id}', [AdminPusatController::class, 'wargaDestroy'])->name('warga.destroy');
});


Route::middleware(['auth', 'role:pem_kecamatan'])->group(function () {
    Route::get('/kecamatan/dashboard', [PemKecamatanController::class, 'index'])->name('kecamatan.dashboard');
    Route::get('/kecamatan/reports/{id}', [PemKecamatanController::class, 'show'])->name('kecamatan.reports.show');
    Route::post('/kecamatan/reports/{id}/process', [PemKecamatanController::class, 'process'])->name('kecamatan.reports.process');
    Route::post('/kecamatan/reports/{id}/resolve', [PemKecamatanController::class, 'resolve'])->name('kecamatan.reports.resolve');
    Route::get('/kecamatan/reports/{id}/pdf', [PemKecamatanController::class, 'exportPdf'])->name('kecamatan.reports.pdf');
});