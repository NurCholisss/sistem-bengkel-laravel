<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pengguna_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kendaraan_id')->constrained('vehicles')->onDelete('cascade');
            $table->foreignId('layanan_id')->nullable()->constrained('services')->onDelete('set null');
            $table->date('tanggal_jadwal');
            $table->time('waktu_jadwal');
            $table->text('keluhan_pelanggan');
            $table->text('rekomendasi_sistem')->nullable();
            $table->enum('status', ['menunggu', 'disetujui', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};