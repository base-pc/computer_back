<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
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
            'fullname' => 'required|string|between:2,100',
            'email'    => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
            'avatar'   => 'mimes:jpeg,png',
            'is_admin' => 'bool'
        ];
    }

    public function messages()
    {
        return [
            'fullname.required'  => 'This field is required',
            'email.required'     => 'This field is required',
            'email.string'       => 'Email is invalid',
            'email.unique'       => 'Email is already taken',
            'email.email'        => 'Email is invalid',
            'password.min'       => 'Password must contain minimum 6 characters',
            'password.confirmed' => 'Passwords are not match',
        ];
    }
}

