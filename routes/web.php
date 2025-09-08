<?php

use App\Http\Controllers\Autentikasi\MasukControllers;
use App\Http\Controllers\Autentikasi\DaftarControllers;
use Illuminate\Support\Facades\Route;

// Rute autentikasi
Route::get('/masuk', [MasukControllers::class, 'index'])->name('masuk');
Route::post('/masuk', [MasukControllers::class, 'authenticate'])->name('masuk.authenticate');
Route::get('/daftar', [DaftarControllers::class, 'index'])->name('daftar');
Route::post('/daftar', [DaftarControllers::class, 'store'])->name('daftar.store');
Route::post('/keluar', [MasukControllers::class, 'logout'])->name('keluar');

// Rute beranda umum
Route::get('/', function () {
    return view('utama.beranda');
})->name('beranda');

// Grup rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Rute akan diisi oleh admin.php dan pelanggan.php
});

// Include rute admin dan pelanggan
require __DIR__.'/admin.php';
require __DIR__.'/pelanggan.php';