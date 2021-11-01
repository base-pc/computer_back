<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
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
            'email'    => 'required|string|email|max:100',
            'password' => 'required|string|min:6',
            //
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'This field is required',
            'email.email'    => 'Email is invalid',
            'email.string'   => 'Email is invalid',
            'password.min'   => 'Password must contain minimum 6 characters',
        ];
    }


}

