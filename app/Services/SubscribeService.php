<?php

namespace App\Services;


use App\Models\Subscribe;



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
     * @return int
     */

    public function getSubscribeId(): int
    {
        return $this->subscribe->id;
    }

    public function changeAttributes($dto):self
    {
        $this->subscribe->fill($dto->toArray());

        return $this;
    }

    /**
     * @return $this
     */

    public function commitChanges(): SubscribeService
    {
        $this->subscribe->save();

        return $this;
    }

}
