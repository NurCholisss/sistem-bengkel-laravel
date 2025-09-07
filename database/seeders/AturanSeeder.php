<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aturan;

class AturanSeeder extends Seeder
{
    public function run(): void
    {
        $aturan = [
            [
                'kata_kunci' => 'oli,mesin,berisik',
                'rekomendasi' => 'Disarankan untuk melakukan ganti oli dan pengecekan mesin. Kemungkinan mesin berisik karena oli yang sudah kotor atau kurang.',
            ],
            [
                'kata_kunci' => 'rem,berisik,ngerem',
                'rekomendasi' => 'Disarankan untuk pengecekan sistem rem. Kemungkinan kampas rem sudah tipis atau ada masalah pada cakram rem.',
            ],
            [
                'kata_kunci' => 'ban,getar,stir',
                'rekomendasi' => 'Disarankan untuk pengecekan ban dan spooring. Kemungkinan ban tidak balance atau perlu spooring.',
            ],
            [
                'kata_kunci' => 'mesin,berasap,putih',
                'rekomendasi' => 'Disarankan untuk pengecekan mesin menyeluruh. Kemungkinan ada kebocoran pada kepala silinder atau masalah sistem pendingin.',
            ],
            [
                'kata_kunci' => 'bensin,boros,irit',
                'rekomendasi' => 'Disarankan untuk tune-up mesin dan pengecekan sistem bahan bakar. Kemungkinan perlu ganti busi, filter udara, atau servis karburator/injector.',
            ],
        ];

        foreach ($aturan as $data) {
            Aturan::create($data);
        }
    }
}