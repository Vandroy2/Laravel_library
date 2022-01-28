<?php

namespace App\DTO;

use App\Helpers\ArrayHelper;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;

class SubscribeDto implements Arrayable
{
    /**
     * @var string
     */
    protected $subscribeType;

    /**
     * @var integer
     */
    protected $subscribePrice;

    /**
     * @var integer
     */

    protected $monthQuantity;
    /**
     * @var array
     */

    protected $authorsId;

    /**
     * @var array
     */

    protected $genresId;


    /**
     * @param $subscribeType
     * @param $subscribePrice
     * @param $monthQuantity
     * @param $authorsId
     * @param $genresId
     */

    public function __construct($subscribeType, $subscribePrice, $monthQuantity, $authorsId, $genresId)
    {
        $this->subscribeType= $subscribeType;

        $this->subscribePrice= $subscribePrice;

        $this->monthQuantity = $monthQuantity;

        $this->authorsId = $authorsId;

        $this->genresId = $genresId;
    }

    /**
     * @return string
     */

    public function getSubscribeType(): string
    {
        return $this->subscribeType;
    }

    /**
     * @return int
     */

    public function getSubscribePrice(): int
    {
        return $this->subscribePrice;
    }

    /**
     * @return int
     */
    public function getMonthQuantity(): int
    {
        return $this->monthQuantity;
    }

    /**
     * @return array
     */

    public function getAuthorsId(): array
    {
        return $this->authorsId;
    }

    /**
     * @return array
     */
    public function getGenresId(): array
    {
        return $this->genresId;
    }


    /**
     * @param array $attributes
     * @return $this
     */

    public function createFromArray(array $attributes):self
    {
        return new self(
            (string)ArrayHelper::getNotEmptyValue($attributes, 'subscribe_type'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'subscribe_price'),
            (integer)ArrayHelper::getNotEmptyValue($attributes, 'monthQuantity'),
            Arr::wrap(ArrayHelper::getNotEmptyValue($attributes, 'authors_id[]')),
            Arr::wrap(ArrayHelper::getNotEmptyValue($attributes, 'genres_id[]')),

        );
    }

    public function toArray(): array
    {
       return [
           'subscribe_type' => $this->subscribeType,

           'subscribe_price' => $this->subscribePrice,

           'monthQuantity' => $this->monthQuantity,
       ];
    }
}
