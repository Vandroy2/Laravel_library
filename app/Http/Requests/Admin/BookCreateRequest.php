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
            'book_name' => ['required','string','min:3','max:255',],
            'num_pages' => ['required','integer'],
            'author_id'=>['required','exists:authors,id'],
            'created_date'=>['required','date_format:"Y"'],

        ];
    }
    public function messages(): array
    {

        return [
            'book_name.required' => 'Введите имя',
            'book_name.min' => 'Недостаточно символов',
            'num_page.required' => 'Введите количество страниц',
            'num_page.integer' => 'Введите числовое значение',
            'created_date.required'=>'Введите дату создания книги',
            'created_date.integer' => 'Введите год написания книги в числовом формате',
            'author_id.required'=>'Введите идентификатор автора',
            'author_id.exists'=>'Такого идентификатора не существует',
            'library_id.required'=>'Введите библиотеку',
            'created_date.date_format'=>'Введите год написания книги в формате: Год',
        ];
    }
}
