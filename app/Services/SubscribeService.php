<?php

namespace App\Services;

use App\DTO\SubscribeDto;
use App\Models\Book;
use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class SubscribeService
{

    /**
     * @var Subscribe
     */
    protected $subscribe;

    /**
     * @param Subscribe $subscribe
     */

    public function __construct(Subscribe $subscribe)
    {
        $this->subscribe = $subscribe;
    }

    /**
     * @return Subscribe
     */

    public function getSubscribe(): Subscribe
    {
        return $this->subscribe;
    }

    /**
     * @param SubscribeDto $dto
     * @return SubscribeService
     */

    public function changeAttribute(SubscribeDto $dto): self
    {
        $this->subscribe->fill($dto->toArray());

        return $this;
    }

    /**
     * @param int $id
     * @param SubscribeDto $dto
     * @return array|Collection
     */

    public function fetchSubscribeBooksId(int $id, SubscribeDto $dto)
    {
        if($dto->getSubscribeType()){
            if ($dto->getSubscribeType() == 'Authors')
            {
                return Book::query()->whereIn("author_id", $id)->pluck('id');
            }
            if ($dto->getSubscribeType() == 'Genre')
            {
                return Book::query()->whereIn("genre_id", $id)->pluck('id');
            }

            if ($dto->getSubscribeType() == 'New')
            {
                $date = Carbon::parse('2022-01-01 00:00:00');

                return Book::query()->where("created_at",'>', $date)->pluck('id');
            }

            return Book::all()->pluck('id');
        }
        else return [];

    }

    /**
     * @param Subscribe $subscribe
     * @param SubscribeDto $dto
     * @return Subscribe
     */



    /**
     * @return $this
     */

    public function commitChanges(): SubscribeService
    {
        $this->subscribe->save();

        return $this;
    }




}
