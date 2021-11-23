<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class OrderFormRequest extends FormRequest
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
        if (!Auth::check()) {
            return [
                'name' => 'required|min:3',
                'surname' => 'required|min:3',
                'email' => 'required|min:8|email'
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [

            'name.required'=> 'введите имя',
            'name.min'=> 'Минимальное количество символов 3',
            'surname.required'=> 'введите фамилию',
            'surname.min'=> 'Минимальное количество символов 3',
            'email.email' => 'Введенный email не является электронным адресом',
            'email.required' => 'Введите email',
            'email.min' => 'Минимальное количество символов 8',
            'email.unique'=>'Такой email уже существует',
            'password.required' => 'Введите password',


        ];
    }
}
