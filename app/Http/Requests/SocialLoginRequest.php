<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialLoginRequest extends FormRequest
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
            '_token'    => 'required|string',
            '_provider' => 'required|string'
            //
        ];
    }

    public function messages()
    {
        return [
            '_token.required'    => 'Token is required',
            '_provider.required' => 'Provider is required'
        ];
    }
}
