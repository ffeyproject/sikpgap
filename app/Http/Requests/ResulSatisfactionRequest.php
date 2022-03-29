<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResulSatisfactionRequest extends FormRequest
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
             'satisfactions_id' => 'required',
             'item_evaluations_id' => 'required',
             'desc_kesesuaian' => 'required',
             'kritik_saran' => 'required',
             'score' => 'required',
        ];
    }
}