<?php

namespace App\Services\Actions;

use App\DTO\PaymentDto;
use App\DTO\UserDTO;
use App\Http\Requests\Filters\BookFilter;
use App\Models\Book;
use App\Models\User;

use App\Services\SubscribeService;
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

    /**
     * @param PaymentDto $paymentDto
     * @param $id
     * @return User
     */

    public function updatePaymentUser(PaymentDto $paymentDto, $id): User
    {

        $user = $this->fetchPayingUser($paymentDto->getId());

        $serviceItem = new  UserService($user);
        $serviceItem
            ->changeAttributes($paymentDto)
            ->payment($paymentDto->getPrice(), $id)
            ->commitChanges();

        return $serviceItem->getUser();
    }

    /**
     * @param BookFilter $filter
     * @param SubscribeActionService $service
     * @param $subscribe
     * @return SubscribeActionService
     */

    public function attachSubscribeItems(BookFilter $filter, SubscribeActionService $service, $subscribe): SubscribeActionService
    {
        return  $service->fetchSubscribeItems($filter, $subscribe);
    }

    /**
     * @param User $user
     * @return array
     */

    public static function fetchSubscribedBooks(User $user): array
    {

        if (!$user->subscribes->isEmpty())
        {
            $books = [];

            foreach ($user->subscribes as $subscribe)
            {
                if ($subscribe->subscribe_type == 'Premium')
                {
                    $books[] = Book::all();
                }
            }

            foreach ($user->subscribes as $subscribe)
            {
                if ($subscribe->subscribe_type == 'Authors')
                {
                    foreach ($subscribe->authors as $author)
                    {
                        $book = Book::query()->subscribeAuthors($author->id)->get();

                        $books[] = $book;


                    }
                }
            }

            foreach ($user->subscribes as $subscribe)
            {
                if ($subscribe->subscribe_type == 'Genre')
                {
                    foreach ($subscribe->genres as $genre)
                    {
                        $book = Book::query()->subscribeGenres($genre->id)->get();

                        $books[] = $book;
                    }
                }
            }

            foreach ($user->subscribes as $subscribe)
            {
                if ($subscribe->subscribe_type == 'New')
                {
                    $book = Book::query()->subscribeNew()->get();

                        $books[] = $book;
                }
            }

            return $books;

        }

        else{

            return [];
        }

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
