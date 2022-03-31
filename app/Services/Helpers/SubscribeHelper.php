<?php

namespace App\Services\Helpers;
use App\Models\ListOfSubscribe;
use App\Models\Subscribe;
use Illuminate\Support\Facades\Auth;

class SubscribeHelper
{

    /**
     * @param ListOfSubscribe $listOfSubscribe
     * @return bool
     */
    public static function checkBelongsToSubscribe(ListOfSubscribe $listOfSubscribe): bool
    {
        /**
         * @var ListOfSubscribe $listOfSubscribe
         * @var Subscribe $subscribe
         */

        $user = Auth::user();


         $collection = $user->subscribes->filter(function ($subscribe) use ($listOfSubscribe)
            {
                if ($subscribe->subscribe_alias == $listOfSubscribe->alias)
                {
                    return true;
                }
                else{

                    return false;
                }

            });

         if ($collection->isEmpty())
         {
             return false;
         }

         else return true;
    }

}
