<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AuthorCreateRequest extends FormRequest
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
            'author_name' => ['required','string','min:3','max:255',],
            'author_surname' => ['required','string','min:3','max:255',],
            'birthday' => ['required','date',],
        ];
    }
    public function messages(): array
    {

        return [
            'author_name.required' => 'Введите имя',
            'author_name.min' => 'Недостаточно символов',
            'author_surname.required' => 'Введите фамилию',
            'author_surname.min' => 'Недостаточно символов',
            'birthday.required' => 'Введите дату рождения',
            'birthday.date' => 'Введите дату рождения в формате Год-Месяц-День',



        ];
    }
}
