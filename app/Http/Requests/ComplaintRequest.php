<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplaintRequest extends FormRequest
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
             'buyers_id' => 'required',
             'tgl_keluhan' => 'required|date',
             'nama_marketing' => 'required',
             'no_wo' => 'required',
             'no_sc' => 'required',
             'nama_motif' => 'required',
             'cw_qty' => 'required',
             'jenis' => 'required',
             'cw_qty' => 'required',
             'masalah' => 'required',
             'solusi' => 'required',
        ];
    }
}
