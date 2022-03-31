<?php

namespace App\DTO;

use App\Helpers\ArrayHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Facades\Auth;


class PaymentDto implements Arrayable
{
    /**
     * @var integer
     */
    protected $cartNumber1;
    /**
     * @var integer
     */
    protected $cartNumber2;
    /**
     * @var integer
     */
    protected $cartNumber3;
    /**
     * @var integer
     */
    protected $cartNumber4;
    /**
     * @var integer
     */
    protected $price;
    /**
     *@var integer
     */
    protected $userId;
    /**
     *  @var integer
     */

    protected $listSubscribe;

    /**
     * @param $price
     * @param $cartNumber1
     * @param $cartNumber2
     * @param $cartNumber3
     * @param $cartNumber4
     * @param $userId
     * @param $listSubscribe
     */
    public function __construct(
        $cartNumber1,
        $cartNumber2,
        $cartNumber3,
        $cartNumber4,
        $price,
        $userId,
        $listSubscribe
    )
    {
        $this->cartNumber1 = $cartNumber1;
        $this->cartNumber2 = $cartNumber2;
        $this->cartNumber3 = $cartNumber3;
        $this->cartNumber4 = $cartNumber4;
        $this->price = $price;
        $this->userId = $userId;
        $this->listSubscribe = $listSubscribe;


    }

    /**
     * @return string
     */

    public function getCartNumber(): string
    {
        return "{$this->cartNumber1} {$this->cartNumber2} {$this->cartNumber3} {$this->cartNumber4}";
    }

    /**
     * @return int
     */

    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @return int
     */

    public function getId():int
    {
        return $this->userId;
    }

    /**
     * @param array $attributes
     * @return static
     */

    public static function createFromArray(array $attributes):self{
        return new self(
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'cartNumber1'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'cartNumber2'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'cartNumber3'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'cartNumber4'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'listSubscribePrice'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'user_id'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'listSubscribe_id'),
        );
    }

    public function toArray(): array
    {
        if (Auth::user()->cart_number){

            return [];
        }
        else
            return ['cart_number'=>$this->getCartNumber(),];
    }


}
