<?php

namespace App\DTO;



use App\Models\ListOfSubscribe;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\Eloquent\Model;


class SubscribeDto implements Arrayable
{

    /**
     * @var integer
     */

    protected $listSubscribe_id;

    /**
     * @param $listSubscribe_id
     */

    public function __construct($listSubscribe_id)
    {
        $this->listSubscribe_id = $listSubscribe_id;
    }

    /**
     * @return Model
     */

    public function getListOfSubscribe(): Model
    {
        return ListOfSubscribe::query()->where('id', '=', $this->listSubscribe_id)->firstOrFail();
    }
    /**
     * @return Carbon
     */

    public function getEndDate(): Carbon
    {
        $listSubscribe = $this->getListOfSubscribe();

        /** @var ListOfSubscribe $listSubscribe */

        if ($listSubscribe->listSubscribeMonthQuantity == 6)
        {
            return Carbon::now()->addMonths(6);
        }
        if ($listSubscribe->listSubscribeMonthQuantity == 12)
        {
            return Carbon::now()->addYear();
        }

        return Carbon::now()->addMonth();
    }

    /**
     * @param $id
     * @return static
     */

    public static function createById($id): self
    {
        return new self($id);
    }

    /**
     * @return array
     */

    public function toArray(): array
    {
        $listSubscribe = $this->getListOfSubscribe();

        /** @var ListOfSubscribe $listSubscribe */

        return
            [
                'subscribe_alias' => $listSubscribe->alias,

                'subscribe_type' => $listSubscribe->listSubscribeType,

                'subscribe_price' => $listSubscribe->listSubscribePrice,

                'monthQuantity' => $listSubscribe->listSubscribeMonthQuantity,

                'dateStart' => Carbon::today(),

                'dateEnd' => $this->getEndDate(),

                'canceled' => 0,
            ];
        }

}
