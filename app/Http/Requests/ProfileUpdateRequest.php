<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            // 'gender' => 'required|in:male,female',
            // 'address' => 'required|string',
            // 'date_of_birth' => 'required|date',
            // 'highschool' => 'required|string',
            // 'grad_year' => 'required|integer|min:1980|max:' . date('Y'),
            // 'bachelor_year' => 'required|integer|min:1980|max:' . date('Y'),
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama Lengkap wajib diisi.',
            // 'gender.required' => 'Jenis Kelamin harus dipilih.',
            // 'address.required' => 'Alamat Lengkap tidak boleh kosong.',
            // 'date_of_birth.required' => 'Tanggal Lahir harus diisi.',
            // 'highschool.required' => 'Nama SMA/SMK/MA harus diisi.',
            // 'grad_year.required' => 'Tahun Lulus harus dipilih.',
            // 'bachelor_year.required' => 'Tahun Masuk Kuliah harus dipilih.',
        ];
    }
}
