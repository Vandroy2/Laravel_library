<?php

namespace App\Http\Requests;


use App\DTO\PaymentDto;
use App\DTO\SubscribeDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SubscribeRequest extends FormRequest
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

        if (Auth::user()->cart_number)
            return [
                "user_id" => ['required', 'exists:users,id'],
                "subscribe_id" => ['required', 'exists:subscribes,id'],
                "subscribe_price" => ['required', 'integer'],
                "balance" => ['required', 'integer', 'gt:subscribe_price'],
                'authors_id' => [ "requiredIf:subscribe_type,Authors", 'array', 'size:3',],
                'authors_id.*' => ['exists:authors,id'],
                'genres_id' => ["requiredIf:subscribe_type,Genre", 'array', 'size:2',],
                'genre_id.*' => ['exists:genres,id']
            ];


        return [
            'cartNumber1' =>['integer', 'required'],
            'cartNumber2' =>['integer', 'required'],
            'cartNumber3' =>['integer', 'required'],
            'cartNumber4' =>['integer', 'required'],
            'name'=>['exists:users,name', 'required'],
            'month'=>['date_format: "m"', 'required'],
            'year'=>['date_format: "Y"', 'required'],
            'card_ccv'=>['required'],
            "user_id" => ['required', 'exists:users,id'],
            "subscribe_id" => ['required', 'exists:subscribes,id'],
            "subscribe_price" => ['required', 'integer'],
            "balance" => ['required', 'integer', 'gt:subscribe_price'],
            'authors_id' => [ "requiredIf:subscribe_type,Authors", 'array', 'size:3',],
            'authors_id.*' => ['exists:authors,id'],
            'genres_id' => ["requiredIf:subscribe_type,Genre", 'array', 'size:2',],
            'genre_id.*' => ['exists:genres,id']
        ];
    }

    public function messages(): array
    {
        return [
            'cartNumber1.required' => 'Введите значение номера карты',
            'cartNumber1.integer' => 'Значение номера карты должно быть числовым',
            'cartNumber2.required' => 'Введите значение номера карты',
            'cartNumber2.integer' => 'Значение номера карты должно быть числовым',
            'cartNumber3.required' => 'Введите значение номера карты',
            'cartNumber3.integer' => 'Значение номера карты должно быть числовым',
            'cartNumber4.required' => 'Введите значение номера карты',
            'cartNumber4.integer' => 'Значение номера карты должно быть числовым',
            'name.required' => 'Введите имя владельца карты',
            'name.exists' => 'Для оплаты принимаются только карты зарегистрированных пользователей',
            'month.required' => 'Введите месяц действия карты',
            'month.date_format' => 'Введите дату правильного формата',
            'year.required' => 'Введите год действия карты',
            'year.date_format' => 'Введите дату правильного формата',
            'card_ccv.required'=> 'Введите значение ccv карты',
            "user_id.required" => 'Введите id пользователя',
            'user_id.exists' => 'Такого id не существует',
            "subscribe_id.required" => 'Введите id подписки',
            'subscribe_id.exists' => 'Такого id не существует',
            'subscribe_price.required' => 'Введите цену подписки',
            "subscribe_price.integer" => 'Значение цены должно быть числом',
            "balance.required" => "Введите баланс",
            "balance.integer" => "Поле баланса должно быть числом",
            "balance.gt" => "Недостаточно средств для оформления заказа",


        ];

    }

    public function createPaymentDto(): PaymentDto{
        return PaymentDto::createFromArray($this->all());
    }


}
