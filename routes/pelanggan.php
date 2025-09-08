<?php

use App\Http\Controllers\Pelanggan\BerandaControllers;
use App\Http\Controllers\Pelanggan\PemesananControllers;
use App\Http\Controllers\Pelanggan\KendaraanControllers;
use App\Http\Controllers\Pelanggan\LayananControllers;
use App\Http\Controllers\Pelanggan\RekomendasiControllers;
use Illuminate\Support\Facades\Route;

Route::prefix('pelanggan')->name('pelanggan.')->middleware(['auth', 'peran:pelanggan'])->group(function () {
    // Dashboard
    Route::get('/beranda', [BerandaControllers::class, 'index'])->name('beranda');
    
    // Manajemen Pemesanan
    Route::resource('pemesanan', PemesananControllers::class)->except(['edit', 'update', 'destroy']);
    
    // Manajemen Kendaraan
    Route::resource('kendaraan', KendaraanControllers::class);
    
    // Lihat Layanan
    Route::resource('layanan', LayananControllers::class)->only(['index', 'show']);
    
    // Rekomendasi
    Route::get('/rekomendasi', [RekomendasiControllers::class, 'index'])->name('rekomendasi');
});