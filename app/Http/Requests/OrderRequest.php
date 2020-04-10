<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'doctor_id'=>'required',
            'pharmacy_id'=>'required',
            'is_insured'=>'required',
            'prescription1'=>'required|Image',
            'prescription2'=>'Image',
            'prescription3'=>'Image'
        ];
    }
}