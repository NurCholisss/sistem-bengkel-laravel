<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'services';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
    ];

    // Relasi dengan pemesanan
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'layanan_id');
    }
}