<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {

        return [
            'email' => 'required|exists:users,email',
            'password' => 'required|min:4',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */


    public function messages(): array
    {

        return [

            'email.required' => 'Введите email',
            'email.exists' => 'Такого email не существует',
            'password.required' => 'Введите password',

        ];
    }
}
