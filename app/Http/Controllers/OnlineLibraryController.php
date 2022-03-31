<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Book;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineLibraryController extends Controller {

    public function view(Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $books = Book::query()->onlineLibraryBooks($request)->paginate(18);

        return view('site.onlineLibrary.index',
            [
                'comments' => $comments,
                'books' => $books,
                'cartBooks' => $cartBooks,
                'sumOrder' => Cart::getOrderSum($request),
                'top' => null,
            ]
        );

    }

    public function addToFavorite(Book $book): JsonResponse
    {
        Auth::user()->books()->toggle($book);

        if (Auth::user()->books->contains($book)) {

            return response()->json([
                'added' => true,
                'book' => [
                    'id' => $book->id,
                    'name' => $book->book_name,
                ],
            ]);
        }

        return response()->json([
            'added' => false,
            'book' => ['id' => $book->id, 'name' => $book->book_name,],
        ]);
    }
}


