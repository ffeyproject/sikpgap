<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResultComplaintRequest extends FormRequest
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
        return [
             'complaints_id' => 'required',
             'target_waktu' => 'required',
             'defects_id' => 'required',
             'hasil_penelusuran' => 'required',
             'tindakan' => 'required',
             'tgl_verifikasi' => 'required',
             'hasil_verifikasi' => 'required',
             'penyelidik' => 'required',
             'departements_id' => 'required',

        ];
    }
}