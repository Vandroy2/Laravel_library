<?php

namespace App\Services\Actions;

use App\DTO\PaymentDto;
use App\DTO\UserDTO;
use App\Models\User;
use App\Services\UserService;

class UserActionService
{
    /**
     * @param UserDTO $dto
     * @return User
     */
    public function createUser(UserDTO $dto):User{
        return $this->saveUser(new User(), $dto);
    }

    /**
     * @param User $user
     * @param UserDTO $dto
     * @return User
     */

    public function updateUser(User $user, UserDTO $dto):User
    {
        return $this->saveUser($user, $dto);
    }

    public function updatePaymentUser(PaymentDto $paymentDTO): User
    {

        $user = $this->fetchPayingUser($paymentDTO->getId());

        $serviceItem = new  UserService($user);
        $serviceItem
            ->changeAttributes($paymentDTO)
            ->payment($paymentDTO->getPrice(), $paymentDTO->getSubscribeId())
            ->commitChanges();


        return $serviceItem->getUser();
    }



    /**
     * @param User $user
     * @param UserDTO $userDTO
     * @return User
     */

    public function saveUser(User $user, UserDTO $userDTO):User{
        $serviceItemService = new  UserService($user);

        $serviceItemService
            ->changeAttributes($userDTO)
            ->commitChanges();

        return $serviceItemService->getUser();
    }

    /**
     * @param int $id
     * @return User
     */

    public function fetchPayingUser(int $id): User
    {
        return User::query()->whereId($id)->first();
    }
}
