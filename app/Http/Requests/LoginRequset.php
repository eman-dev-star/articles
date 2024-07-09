<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequset extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email'=>'required|email',
            'password'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'email is required',
            'email.email'=>'The email must be an emai',
            'password.required'=>'password is required',

        ];
    }
}
