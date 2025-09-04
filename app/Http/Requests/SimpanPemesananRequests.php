<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanPemesananRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kendaraan_id' => 'required|exists:vehicles,id',
            'layanan_id' => 'nullable|exists:services,id',
            'tanggal_jadwal' => 'required|date|after_or_equal:today',
            'waktu_jadwal' => 'required|date_format:H:i',
            'keluhan_pelanggan' => 'required|string|min:10',
        ];
    }

    public function messages(): array
    {
        return [
            'kendaraan_id.required' => 'Pilih kendaraan wajib diisi.',
            'kendaraan_id.exists' => 'Kendaraan yang dipilih tidak valid.',
            'layanan_id.exists' => 'Layanan yang dipilih tidak valid.',
            'tanggal_jadwal.required' => 'Tanggal jadwal wajib diisi.',
            'tanggal_jadwal.after_or_equal' => 'Tanggal jadwal tidak boleh tanggal yang sudah lewat.',
            'waktu_jadwal.required' => 'Waktu jadwal wajib diisi.',
            'waktu_jadwal.date_format' => 'Format waktu jadwal tidak valid.',
            'keluhan_pelanggan.required' => 'Keluhan pelanggan wajib diisi.',
            'keluhan_pelanggan.min' => 'Keluhan pelanggan minimal 10 karakter.',
        ];
    }
}