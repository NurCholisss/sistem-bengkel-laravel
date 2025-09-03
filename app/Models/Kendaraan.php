<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $table = 'vehicles';
    
    protected $fillable = [
        'pengguna_id',
        'merk',
        'model',
        'tahun',
        'plat_nomor',
    ];

    // Relasi dengan pengguna
    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id');
    }

    // Relasi dengan pemesanan
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'kendaraan_id');
    }
}