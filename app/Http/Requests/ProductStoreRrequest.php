<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRrequest extends FormRequest
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
            'name'         => 'required|string|between:5,20',
            'manufacturer' => 'required|string|between:2,20',
            'description'  => 'required|string|max:500',
            'price'        => 'required|numeric',
            'quantity'     => 'required|numeric',
            'photo'        => 'required|image:jpeg,png,svg|max:4048'
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => 'This field is required',
            'name.between'         => 'Enter 5-20 characters',
            'price.required'       => 'This field is required',
            'price.numeric'        => 'This field must be numeric',
            'quantity.required'    => 'This field is required',
            'quantity.numeric'     => 'This field must be numeric',
            'photo.required'       => 'This field is required',
            'photo.image'          => 'You must enter correct file format',
            'photo.max'            => 'Photo cant be bigger than 4mb',
            'description.required' => 'This field is requied',
            'description.max'      => 'This field can contain max 500 characters'

        ];
    }
}
