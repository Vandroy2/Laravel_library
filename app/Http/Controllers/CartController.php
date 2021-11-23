<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Arr;

class CartController extends Controller {
    /**
     * @param  Request $request
     *
     * @return JsonResponse|AnonymousResourceCollection
     */
    public function index(Request $request) {
        $cartBooksArr = $request->session()->get('cartBooks', []);

        if(empty($cartBooksArr))
            return response()->json([]);

        /* @var Book[]|Collection $cartBooks */
        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $cartBooks = $cartBooks->map(function($book) use($cartBooksArr) {

            $book->books_number = Arr::get(Arr::get($cartBooksArr, $book->id, []), 'count', 1);
            $book->inCart = Arr::has($cartBooksArr, $book->id);

            return $book;
        });

        BookResource::withoutWrapping();

        return BookResource::collection($cartBooks);
    }
}
