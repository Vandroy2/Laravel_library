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
            'name' => ['required','string','min:3','max:255',],
            'surname' => ['required','string','min:3','max:255',],
            'birthday' => ['required','date',],
        ];
    }
    public function messages(): array
    {

        return [
            'name.required' => 'Введите имя',
            'name.min' => 'Недостаточно символов',
            'surname.required' => 'Введите фамилию',
            'surname.min' => 'Недостаточно символов',
            'birthday.required' => 'Введите дату рождения',
            'birthday.date' => 'Введите дату рождения в формате Год-Месяц-День',



        ];
    }
}
