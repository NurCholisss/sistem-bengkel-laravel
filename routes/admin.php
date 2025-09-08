<?php

use App\Http\Controllers\Admin\DasborControllers;
use App\Http\Controllers\Admin\PemesananControllers;
use App\Http\Controllers\Admin\LayananControllers;
use App\Http\Controllers\Admin\AturanControllers;
use App\Http\Controllers\Admin\PenggunaControllers;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'peran:admin'])->group(function () {
    // Dashboard
    Route::get('/dasbor', [DasborControllers::class, 'index'])->name('dasbor');
    
    // Manajemen Pemesanan
    Route::resource('pemesanan', PemesananControllers::class)->except(['create', 'store']);
    
    // Manajemen Layanan
    Route::resource('layanan', LayananControllers::class);
    
    // Manajemen Aturan
    Route::resource('aturan', AturanControllers::class);
    
    // Manajemen Pengguna
    Route::resource('pengguna', PenggunaControllers::class)->except(['create', 'store']);
});