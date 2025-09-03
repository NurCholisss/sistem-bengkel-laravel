<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    
    protected $fillable = [
        'nama',
        'email',
        'kata_sandi',
        'role',
        'telepon',
        'alamat',
    ];

    protected $hidden = [
        'kata_sandi',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAuthPassword()
    {
        return $this->kata_sandi;
    }

    // Relasi dengan kendaraan
    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class, 'pengguna_id');
    }

    // Relasi dengan pemesanan
    public function pemesanan()
    {
        return $this->hasMany(Pemesanan::class, 'pengguna_id');
    }
}