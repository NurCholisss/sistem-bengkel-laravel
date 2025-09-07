<?php

namespace App\Actions;

class CocokkanKeluhan
{
    public function hitungKecocokan(string $keluhan, string $kataKunci): float
    {
        // Normalisasi teks
        $keluhan = strtolower(trim($keluhan));
        $kataKunci = strtolower(trim($kataKunci));
        
        // Split kata kunci menjadi array
        $kataKunciArray = explode(',', $kataKunci);
        $totalKata = count($kataKunciArray);
        $kataCocok = 0;
        
        if ($totalKata === 0) {
            return 0;
        }
        
        // Hitung persentase kata kunci yang cocok
        foreach ($kataKunciArray as $kata) {
            $kata = trim($kata);
            if (!empty($kata) && str_contains($keluhan, $kata)) {
                $kataCocok++;
            }
        }
        
        return $kataCocok / $totalKata;
    }
}