<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRateRequest extends FormRequest
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
            'rate' => 'required|integer|numeric|between:1,5'
        ];
    }

    public function messages()
    {
        return [
            'rate.required'=>'This field is required',
            'rate.between' => 'Insert value between 1-5'
        ];
    }
}
