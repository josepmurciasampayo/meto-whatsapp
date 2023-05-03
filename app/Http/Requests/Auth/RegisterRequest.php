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
                'required', 'string', 'max:255'
            ],

            'last' => [
                'required', 'string', 'max:255'
            ],

            'email' => [
                'required', 'string', 'email',
                'max:255', 'unique:users', 'confirmed'
            ],

            'email_confirmation' => [
                'required', 'email'
            ],

            'phone.code' => [
                'required', 'numeric', 'max:3'
            ],

            'phone.number' => [
                'required', 'numeric', 'max:20'
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
            'phone.code.max' => 'The phone number code field should have a max of 3 characters.',

            'phone.number.required' => 'The phone number field is required.',
            'phone.number.numeric' => 'The phone number field should be numeric.',
            'phone.number.max' => 'The phone number field should have a max of 20 characters.',
        ];
    }
}
