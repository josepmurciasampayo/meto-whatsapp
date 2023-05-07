<?php

namespace App\Http\Requests\Uni;

use Illuminate\Foundation\Http\FormRequest;

class UniLocationRequest extends FormRequest
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
            'country' => [
                'bail', 'required', 'exists:enum_countries,id'
            ],

            'state' => [
                'bail', 'required', 'string'
            ],

            'city' => [
                'bail', 'required', 'string'
            ]
        ];
    }
}