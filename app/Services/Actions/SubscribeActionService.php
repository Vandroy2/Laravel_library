<?php

namespace App\Services\Actions;

use App\DTO\SubscribeDto;
use App\Models\Subscribe;
use App\Services\SubscribeService;


class SubscribeActionService
{
    /**
     * @param SubscribeDto $dto
     * @return Subscribe
     */
    public function createSubscribe(SubscribeDto $dto): Subscribe
    {
        return $this->saveSubscribe(new Subscribe(), $dto);
    }

    /**
     * @param Subscribe $subscribe
     * @param SubscribeDto $dto
     * @return Subscribe
     */
    public function updateSubscribe(Subscribe $subscribe, SubscribeDto $dto): Subscribe
    {
        return $this->saveSubscribe($subscribe, $dto);
    }



    /**
     * @param Subscribe $subscribe
     * @param SubscribeDto $dto
     * @return Subscribe
     */

    public function saveSubscribe(Subscribe $subscribe, SubscribeDto $dto): Subscribe
    {
        $serviceItem = new SubscribeService($subscribe);

        $serviceItem
            ->changeAttribute($dto)
            ->commitChanges();

        return $serviceItem->getSubscribe();
    }
}
