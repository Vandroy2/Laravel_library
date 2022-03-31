<?php

namespace App\Services\Actions;

use App\DTO\SubscribeDto;
use App\Http\Requests\Filters\BookFilter;
use App\Models\Subscribe;
use App\Services\SubscribeService;
use http\Env\Request;


class SubscribeActionService extends SubscribeService
{
    /**
     * @param SubscribeDto $subscribeDto
     * @return Subscribe
     */
    public function createSubscribe(SubscribeDto $subscribeDto): Subscribe
    {
        return $this->saveSubscribe(new Subscribe(), $subscribeDto);
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
     * @param BookFilter $filter
     * @param Subscribe $subscribe
     * @return SubscribeActionService
     */

    public function fetchSubscribeItems(BookFilter $filter, Subscribe $subscribe): SubscribeActionService
    {
        if ($filter->hasAuthors())
        {
            $ids = $filter->getAuthorsIDs();

            foreach ($ids as $id){

                if (!$subscribe->authors->contains($id))
                {
                    $subscribe->authors()->attach($id);
                }
            }
            return $this;
        }

        if ($filter->hasGenres())
        {
            $ids = $filter->getGenreIDs();

            foreach ($ids as $id){

                if (!$subscribe->genres->contains($id))
                {
                    $subscribe->genres()->attach($id);
                }
            }

            return $this;
        }

        return $this;
    }

    /**
     * @param Subscribe $subscribe
     * @return Subscribe
     */


    /**
     * @param Subscribe $subscribe
     * @param SubscribeDto $subscribeDto
     * @return Subscribe
     */

    public function saveSubscribe(Subscribe $subscribe, SubscribeDto $subscribeDto): Subscribe
    {
        $serviceItem = new SubscribeService($subscribe);

        $serviceItem

            ->changeAttributes($subscribeDto)
            ->commitChanges();

        return $serviceItem->getSubscribe();
    }
}
