<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
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
            'num_pages' => ['required','integer'],
//            'created_date'=>['required','date'],
            'author_id'=>['required','exists:authors,id'],
//            'library_id'=>['required'],
          'created_date'=>['required','date_format:"Y"'],

        ];
    }
    public function messages(): array
    {

        return [
            'name.required' => 'Введите имя',
            'name.min' => 'Недостаточно символов',
            'num_page.required' => 'Введите колличество страниц',
            'num_page.integer' => 'Введите числовое значение',
            'created_date.required'=>'Введите дату создания книги',
            'created_date.integer' => 'Введите год написания книги в числовом формате',
            'author_id.required'=>'Введите идентификатор автора',
            'author_id.exists'=>'Такого идентификатора не сущетвует',
            'library_id.required'=>'Введите библиотеку',
            'created_date.date_format'=>'Введите год написания книги в формате: Год',
        ];
    }
}
