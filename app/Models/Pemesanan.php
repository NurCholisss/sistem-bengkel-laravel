<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'bookings';
    
    protected $fillable = [
        'pengguna_id',
        'kendaraan_id',
        'layanan_id',
        'tanggal_jadwal',
        'waktu_jadwal',
        'keluhan_pelanggan',
        'rekomendasi_sistem',
        'status',
    ];

    protected $casts = [
        'tanggal_jadwal' => 'date',
    ];

    // Relasi dengan pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Relasi dengan kendaraan
    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id');
    }

    // Relasi dengan layanan
    public function layanan()
    {
        return $this->belongsTo(Layanan::class, 'layanan_id');
    }
}