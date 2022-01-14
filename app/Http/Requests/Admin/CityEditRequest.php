<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CityEditRequest extends FormRequest
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
            'city_name' => ['required','string','min:3','max:255',],
        ];
    }

    /**
     * @return string[]
     */


    public function messages(): array
    {

        return [
            'city_name.required' => 'Введите имя',
            'city_name.min' => 'Недостаточно символов',
        ];
    }
}
