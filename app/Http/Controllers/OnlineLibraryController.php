<?php

namespace App\Http\Controllers;

use App\DTO\SubscribeDto;
use App\Helpers\Cart;
use App\Http\Requests\Filters\BookFilter;
use App\Models\Book;
use App\Models\Comment;
use App\Services\Actions\BookActionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineLibraryController extends Controller {
    /**
     * @var BookActionService
     */
    protected $service;

    public function __construct(BookActionService $service) {
        $this->service = $service;
    }

    public function view(Request $request)
    {

        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $search_book = $request->input('search_book');

        $subscribeBooks = $this->service->fetchByFilter(BookFilter::createByRequest($request));

        $books = Book::query()
            ->select('books.*')
            ->with(['author', 'images'])
            ->when(!empty($search_book), function ($query) use ($search_book) {
                return $query
                    ->Join('authors', 'books.author_id', '=', 'authors.id')
                    ->join('libraries', 'books.library_id', '=', 'libraries.id')
                    ->where('books.book_name', 'like', "%$search_book%")
                    ->orwhere('authors.author_name', 'like', "%$search_book%")
                    ->orwhere('authors.author_surname', 'like', "%$search_book%")
                    ->orwhere('libraries.library_name', 'like', "%$search_book%");
            })->paginate(18);


        return view('site.onlineLibrary.index',
            [
                'comments' => $comments,
                'books' => $books,
                'cartBooks' => $cartBooks,
                'sumOrder' => Cart::getOrderSum($request),
                'top' => null
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


