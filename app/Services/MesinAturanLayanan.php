<?php

namespace App\Services;

use App\Models\Aturan;
use App\Actions\CocokkanKeluhan;

class MesinAturanLayanan
{
    protected $cocokkanKeluhan;

    public function __construct(CocokkanKeluhan $cocokkanKeluhan)
    {
        $this->cocokkanKeluhan = $cocokkanKeluhan;
    }

    public function prosesKeluhan(string $keluhan): string
    {
        $aturan = Aturan::all();
        $rekomendasi = 'Tidak ada rekomendasi khusus. Silakan hubungi kami untuk konsultasi lebih lanjut.';
        $skorTertinggi = 0;
        
        foreach ($aturan as $rule) {
            $skor = $this->cocokkanKeluhan->hitungKecocokan($keluhan, $rule->kata_kunci);
            
            if ($skor > $skorTertinggi) {
                $skorTertinggi = $skor;
                $rekomendasi = $rule->rekomendasi;
            }
        }
        
        return $rekomendasi;
    }
}