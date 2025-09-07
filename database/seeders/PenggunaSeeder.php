<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // Buat admin default
        Pengguna::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'kata_sandi' => Hash::make('password123'),
            'role' => 'admin',
            'telepon' => '081234567890',
            'alamat' => 'Jl. Bengkel No. 1',
        ]);

        // Buat beberapa pelanggan contoh
        Pengguna::create([
            'nama' => 'Upin',
            'email' => 'upin@gmail.com',
            'kata_sandi' => Hash::make('password123'),
            'role' => 'pelanggan',
            'telepon' => '081234567891',
            'alamat' => 'Jl. Durian Runtuh No. 5',
        ]);

        Pengguna::create([
            'nama' => 'Ipin',
            'email' => 'ipin@gmail.com',
            'kata_sandi' => Hash::make('password123'),
            'role' => 'pelanggan',
            'telepon' => '081234567892',
            'alamat' => 'Jl. Durian Runtuh No. 6',
        ]);
    }
}