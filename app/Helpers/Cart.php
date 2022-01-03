<?php

namespace App\Helpers;

use App\Models\Book;
use Illuminate\Http\Request;


class Cart
{
        static function clearCart(Request $request){

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $cartBooks->map(function ($cartBook) use ($cartBooksArr){

            $cartBook->books_limit += $cartBooksArr[$cartBook->id]['count'];

            $cartBook->save();

            $cartBooksArr[$cartBook->id]['count'] = 0;

            return $cartBook;

        });

        $request->session()->forget('cartBooks');

        }

        static function getOrderSum(Request $request)
        {
            $cartBooksArr = $request->session()->get('cartBooks', []);

            $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

            $sumOrder = 0;

            foreach ($cartBooks as $cartBook)
            {
                $sumOrder += $cartBook->price * $cartBooksArr[$cartBook->id]['count'];
            }

            return $sumOrder;
        }

}
