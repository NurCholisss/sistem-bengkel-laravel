<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Jalankan seeder utama
        $this->call([
            PenggunaSeeder::class,
            LayananSeeder::class,
            AturanSeeder::class,
        ]);
    }
}
