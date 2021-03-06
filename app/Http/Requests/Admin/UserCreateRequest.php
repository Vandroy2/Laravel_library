<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => ['required','string','min:3','max:255',],
            'email' => ['required','email','unique:users,email,', 'min:8'],
            'surname'=>['required','string','min:3','max:255',],
            'birthday'=>['required', 'date']
        ];
    }
    public function messages(): array
    {

        return [
            'name.required' => 'Введите имя',
            'name.min' => 'Недостаточно символов',
            'surname.required' => 'Введите имя фамилию',
            'surname.min' => 'Недостаточно символов',
            'email.required' => 'Введите email',
            'email.exists' => 'Такого email не существует',
            'email.unique' => 'Такой email уже существует',
            'birthday.required' => 'Введите дату рождения',
            'birthday.date' => 'Введите дату рождения в формате Год-Месяц-День',


        ];
    }
}
