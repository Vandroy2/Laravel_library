<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SelectionRequest extends FormRequest
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
            'selection_name' => 'min:3|required',
            'created_at' =>'date',
            'priceParamLow' => [
                'nullable',
                'integer',
                function ($attribute, $value, $fail) {

                    $highValue = $this->get('priceParamHigh');

                    $value = $this->get('priceParamLow');

                    $attribute = 'Нижней границы';
                    if ($highValue && $value > $highValue) {
                        $fail('Поле '.$attribute.' не может быть больше верхнего предела цены.');
                    }
                },
            ],
            'priceParamHigh' =>
                ['nullable',
                'integer',
                 function ($attribute, $value, $fail) {

                    $lowValue = $this->get('priceParamLow');

                    $value = $this->get('priceParamHigh');

                     $attribute = 'Верхней границы';

                    if ($lowValue && $value < $lowValue) {
                        $fail('Поле '.$attribute.' не может быть меньше нижнего предела цены.');
                    }
                },
                ],

        ];
    }

    public function messages(): array
    {

        return [
            'selection_name.required' => 'Введите имя подборки',
            'selection_name.unique' => 'Такое имя уже существует',
            'selection_name.min' =>'Имя не может быть меньше 3-х символов',
            'created_at.date_format' => 'Поле календаря должно быть датой',
            'priceParamLow.integer' => 'Поле цены должно быть числом',
            'priceParamLow.lt' => 'Поле должно быть меньше верхней границы указанной цены',
            'priceParamHigh.integer' => 'Поле цены должно быть числом',
            'priceParamHigh.gt'=> 'Поле должно быть больше нижней границы указанной цены',
        ];
    }
}
