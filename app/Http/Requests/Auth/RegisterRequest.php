<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first' => [
                'required', 'string', 'max:255', 'doesnt_start_with:💳',
            ],

            'last' => [
                'required', 'string', 'max:255'
            ],

            'email' => [
                'required', 'string', 'email', 'max:255', 'unique:users', 'confirmed'
            ],

            'email_confirmation' => [
                'required', 'email'
            ],

            'phone.code' => [
                'required', 'string', 'max:5'
            ],

            'phone.number' => [
                'required', 'string', 'max:20'
            ],

            'password' => [
                'required', 'string', 'confirmed', 'min:8'
            ],

            'password_confirmation' => [
                'required', 'string'
            ]
        ];
    }

    public function messages()
    {
        return [
            'phone.code.required' => 'The phone number code field is required.',
            'phone.code.numeric' => 'The phone number code field should be numeric.',
            'phone.code.digits' => 'The phone number code field should have a max of 5 characters.',

            'phone.number.required' => 'The phone number field is required.',
            'phone.number.numeric' => 'The phone number field should be numeric.',
            'phone.number.digits' => 'The phone number field should have a max of 20 characters.',
        ];
    }
}
