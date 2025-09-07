<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanan = [
            [
                'nama' => 'Ganti Oli',
                'deskripsi' => 'Penggantian oli mesin dengan oli berkualitas tinggi',
                'harga' => 150000,
            ],
            [
                'nama' => 'Service Berkala',
                'deskripsi' => 'Service rutin untuk menjaga performa kendaraan',
                'harga' => 300000,
            ],
            [
                'nama' => 'Ganti Ban',
                'deskripsi' => 'Penggantian ban dengan ban baru berkualitas',
                'harga' => 500000,
            ],
            [
                'nama' => 'Perbaikan Rem',
                'deskripsi' => 'Perbaikan dan penggantian sistem rem',
                'harga' => 400000,
            ],
            [
                'nama' => 'Tune-up Mesin',
                'deskripsi' => 'Perawatan menyeluruh untuk mesin kendaraan',
                'harga' => 600000,
            ],
        ];

        foreach ($layanan as $data) {
            Layanan::create($data);
        }
    }
}