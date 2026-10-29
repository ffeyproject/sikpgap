<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = $this->route('user') ?? request()->route('user');
        $userId = is_object($user) ? $user->id : $user;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $userId,
            'username' => 'required|string|max:255|unique:users,username,' . $userId,
            'posisi' => 'required|string',
            'g_ttd' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ];
    }

    /**
     * Custom error messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Nama pengguna wajib diisi.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Alamat email ini sudah digunakan oleh pengguna lain.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan oleh akun lain.',
            'posisi.required' => 'Posisi / jabatan wajib dipilih.',
            'g_ttd.image' => 'File tanda tangan harus berupa gambar (JPG, PNG, GIF, SVG, WEBP).',
            'g_ttd.mimes' => 'Format file tanda tangan harus berformat: JPEG, JPG, PNG, GIF, SVG, atau WEBP.',
            'g_ttd.max' => 'Ukuran file tanda tangan tidak boleh melebihi 5 MB.',
        ];
    }
}
