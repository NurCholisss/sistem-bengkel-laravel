<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanLayananRequests extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255|unique:services,nama',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|numeric|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama layanan wajib diisi.',
            'nama.max' => 'Nama layanan maksimal 255 karakter.',
            'nama.unique' => 'Nama layanan sudah ada.',
            'harga.required' => 'Harga layanan wajib diisi.',
            'harga.numeric' => 'Harga harus berupa angka.',
            'harga.min' => 'Harga tidak boleh negatif.',
        ];
    }
}