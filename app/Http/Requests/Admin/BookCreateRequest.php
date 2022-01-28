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
            'price'=> ['required','integer'],
            'author_id'=>['required','exists:authors,id'],
            'library_id'=>['required', 'exists:libraries,id'],
            'created_date'=>['required','date_format:"Y"'],
            'books_limit'=>['required', 'integer'],
//            'images'=>['required', 'array'],
            'images.*' =>['mimes:jpg,png,jpeg,bmp'],
            'file'=>['required',
                function($attribute, $value, $fail){

                $value = $this->get('type');

                $valueFile = $this->file('file')->getMimeType();

                $attribute = 'формат';

                if ($value == 'pdf' && $valueFile !== 'application/pdf'){

                    $fail('Не верный '.$attribute.' текстового файла.');
                }

                    if ( $value == 'audio')

                        if( $valueFile !== 'audio/x-wav' && $valueFile !== 'audio/mpeg' && $valueFile !== 'audio/x-ms-wma' && $valueFile !== 'audio/x-aac')
                        {
                        $fail('Не верный '.$attribute.' аудио файла.');
                    }

                    if (!$valueFile){
                        $fail('Отсутствует нужный'. $attribute .' файла.');
                    }
        }
        ]
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
            'author_id.exists'=>'Такого автора не существует',
            'library_id.required'=>'Введите название библиотеки',
            'library_id.exists'=>'Такой библиотеки не существует',
            'created_date.date_format'=>'Введите год написания книги в формате: Год',
            'books_limit.required'=>'Введите остаток книг',
            'books_limit.integer'=>'Остаток книг должен быть числовым значением',
            'price.required'=>'Введите цену книги',
            'price'=>'Остаток книг должен быть числовым значением',
            'images.required'=>'Добавьте картинку для книги',
            'images.mimes'=>'Неверный формат картинки',

        ];
    }
}
