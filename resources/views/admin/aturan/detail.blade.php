@extends('layouts.admin')

@section('title', 'Detail Aturan')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.aturan.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Kembali ke Daftar Aturan
    </a>
    <h2 class="text-2xl font-bold text-gray-800 mt-4">Detail Aturan</h2>
    <p class="text-gray-600 mt-2">Aturan sistem rekomendasi berbasis kata kunci</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Informasi Aturan</h3>
    </div>
    
    <div class="px-6 py-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informasi Utama -->
            <div class="space-y-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Kata Kunci</h4>
                    <div class="mt-2 flex flex-wrap gap-2">
                        @foreach(explode(',', $aturan->kata_kunci) as $keyword)
                        <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                            {{ trim($keyword) }}
                        </span>
                        @endforeach
                    </div>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Tanggal Dibuat</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $aturan->created_at->format('d M Y H:i') }}</p>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500">Terakhir Diupdate</h4>
                    <p class="mt-1 text-sm text-gray-900">{{ $aturan->updated_at->format('d M Y H:i') }}</p>
                </div>
            </div>
            
            <!-- Rekomendasi -->
            <div>
                <h4 class="text-sm font-medium text-gray-500">Rekomendasi Sistem</h4>
                <div class="mt-3 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <p class="text-gray-700 leading-relaxed">{{ $aturan->rekomendasi }}</p>
                </div>
            </div>
        </div>
        
        <!-- Contoh Penggunaan -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h4 class="text-lg font-medium text-gray-800 mb-4">Contoh Penggunaan</h4>
            <div class="bg-gray-50 rounded-lg p-6">
                <div class="mb-4">
                    <h5 class="text-sm font-medium text-gray-700 mb-2">Keluhan Pelanggan:</h5>
                    <div class="bg-white p-4 rounded border">
                        <p class="text-gray-600 italic">"Mobil saya mengeluarkan suara berisik dari mesin dan terasa kurang bertenaga saat dijalan..."</p>
                    </div>
                </div>
                
                <div class="mb-4">
                    <h5 class="text-sm font-medium text-gray-700 mb-2">Kata Kunci Terdeteksi:</h5>
                    <div class="flex flex-wrap gap-2">
                        @php
                        $contohKeluhan = "Mobil saya mengeluarkan suara berisik dari mesin dan terasa kurang bertenaga saat dijalan";
                        $keywords = explode(',', $aturan->kata_kunci);
                        $detectedKeywords = [];
                        foreach ($keywords as $keyword) {
                            $trimmedKeyword = trim($keyword);
                            if (stripos($contohKeluhan, $trimmedKeyword) !== false) {
                                $detectedKeywords[] = $trimmedKeyword;
                            }
                        }
                        @endphp
                        
                        @if(count($detectedKeywords) > 0)
                            @foreach($detectedKeywords as $keyword)
                            <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                {{ $keyword }} ✓
                            </span>
                            @endforeach
                        @else
                            <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                Tidak ada kata kunci yang cocok
                            </span>
                        @endif
                    </div>
                </div>
                
                <div>
                    <h5 class="text-sm font-medium text-gray-700 mb-2">Rekomendasi yang Diberikan:</h5>
                    <div class="bg-green-50 p-4 rounded border border-green-200">
                        <p class="text-gray-700">{{ $aturan->rekomendasi }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="px-6 py-4 bg-gray-50 text-right">
        <a href="{{ route('admin.aturan.edit', $aturan->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md mr-3">
            <i class="fas fa-edit mr-2"></i> Edit Aturan
        </a>
        <form action="{{ route('admin.aturan.destroy', $aturan->id) }}" method="POST" class="inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md" 
                onclick="return confirm('Apakah Anda yakin ingin menghapus aturan ini?')">
                <i class="fas fa-trash mr-2"></i> Hapus Aturan
            </button>
        </form>
    </div>
</div>

<!-- Aturan Terkait -->
<div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-800">Aturan dengan Kata Kunci Serupa</h3>
    </div>
    
    <div class="overflow-x-auto">
        @php
        $currentKeywords = array_map('trim', explode(',', $aturan->kata_kunci));
        $similarRules = [];
        
        foreach ($allAturan as $rule) {
            if ($rule->id != $aturan->id) {
                $ruleKeywords = array_map('trim', explode(',', $rule->kata_kunci));
                $commonKeywords = array_intersect($currentKeywords, $ruleKeywords);
                if (count($commonKeywords) > 0) {
                    $similarRules[] = [
                        'aturan' => $rule,
                        'common_keywords' => $commonKeywords
                    ];
                }
            }
        }
        @endphp
        
        @if(count($similarRules) > 0)
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kata Kunci</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kata Kunci Sama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($similarRules as $similar)
                <tr>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach(explode(',', $similar['aturan']->kata_kunci) as $keyword)
                            <span class="inline-block bg-gray-100 text-gray-800 px-2 py-1 rounded text-xs">
                                {{ trim($keyword) }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-wrap gap-1">
                            @foreach($similar['common_keywords'] as $keyword)
                            <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs">
                                {{ $keyword }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <a href="{{ route('admin.aturan.show', $similar['aturan']->id) }}" class="text-blue-600 hover:text-blue-900">
                            <i class="fas fa-eye mr-1"></i> Lihat
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="px-6 py-8 text-center">
            <i class="fas fa-info-circle text-3xl text-gray-300 mb-3"></i>
            <p class="text-gray-500">Tidak ada aturan dengan kata kunci serupa</p>
        </div>
        @endif
    </div>
</div>
@endsection