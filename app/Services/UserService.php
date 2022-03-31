<?php

namespace App\Services;

use App\DTO\PaymentDto;
use App\DTO\UserDto;
use App\Models\User;

class UserService
{
    /**
     * @var User
     */

    private $user;

    /**
     * UserService constructor
     *
     * @param User $user
     */

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param UserDTO|PaymentDto $dto
     * @return $this
     */

    public function changeAttributes($dto):self
    {
        $this->user->fill($dto->toArray());

        return $this;
    }

    /**
     * @param int $price
     * @param int $id
     * @return $this
     */

    public function payment(int $price, int $id): UserService
    {
        $this->user->balance -= $price;

        if (!$this->user->subscribes->contains($id))
        {
            $this->user->subscribes()->attach($id);
        }

        return $this;
    }

    /**
     * @return $this
     */

    public function commitChanges():self
    {
        $this->user->save();
        return $this;
    }

}
