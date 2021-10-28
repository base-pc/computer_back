<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRrequest extends FormRequest
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
            'name' => 'requied|string|between:3:35',
            'icon' => 'requied|image:jpeg,png,svg|max:4048'
        ];
    }

    public function messages()
    {
        return [
            'name.requied' => 'This field is requied',
            'icon.requied' => 'This field is requied',
            'icon.image'   => 'You must enter correct file format',
        ];
    }
}
