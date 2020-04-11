<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'area_id'=>'required|exists:areas,id',
            'street_name'=>'required',
            'building_number'=>'required',
            'floor_number'=>'required',
            'flat_number'=>'required',
            'is_main'=>'required|in:0,1'
        ];
    }
}
