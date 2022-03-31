<?php

namespace App\Services\Actions;



use App\Models\User;
use Illuminate\Support\Facades\Auth;


class BookActionService
{

    public static function fetchSubscribeBooks($book): bool
    {
        if (Auth::user())
        {
            $user = User::query()->where('id', '=', Auth::user()->id)->firstOrFail();

            $booksArr = UserActionService::fetchSubscribedBooks($user);

            foreach ($booksArr as $subscribeBooks)
            {
                foreach ($subscribeBooks as $subscribeBook)
                {
                    if ($subscribeBook->id == $book->id)
                    {
                        return true;
                    }
                }
            }
        }

        return false;
    }





}
