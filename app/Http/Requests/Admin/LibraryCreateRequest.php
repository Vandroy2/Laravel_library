<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LibraryCreateRequest extends FormRequest
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
//            'city_id' => ['required'],
            'city_id' => ['required','exists:cities,id'],
        ];
    }
    public function messages(): array
    {

        return [
            'name.required' => 'Введите имя',
            'name.min' => 'Недостаточно символов',
            'city_id.required' => 'Введите идентификатор города',
            'city_id.exists' => 'Такого идентификатора не существует'



        ];
    }
}
