<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'lastname' => 'required|string',
            'firstname' => 'required|string',
            'mobile' => 'required|numeric',
            'email' => 'required|email|unique:users',
            'password' => 'sometimes|regex:/^([a-zA-Z0-9@!\.$]{8,16})$/',
            'confirm_password' => 'same:password'
        ];
    }
}
