<?php

namespace App\Events;



use App\Models\User;

class LoginAdminEvent
{

    public $user;

    /**
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}


