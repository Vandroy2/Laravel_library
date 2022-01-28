<?php

namespace App\Http\Controllers;


use App\Http\Requests\SubscribeRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Book_Order;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Order;
use App\Models\Subscribe;
use App\Models\User;
use App\Services\Actions\UserActionService;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CabinetController extends Controller
{
    /**
     * @var $user
     */

    protected $service;

    /**
     * @param UserActionService $service
     */

    public function __construct(UserActionService $service)
    {
        return $this->service = $service;
    }

    /**
     * @return View
     */

    public function view(): View
    {
        $commentsNotPublished = Comment::query()
            ->whereNull('published')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $commentPublished = Comment::query()
            ->where('published', '=', 1)
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('site.personalCabinet.comments', ['commentsNotPublished' => $commentsNotPublished, 'commentPublished' => $commentPublished]);
    }

    /**
     * @return View
     */

    public function orders(): View
    {
        $id = Auth::id();

        $orders = Order::query()
            ->where('user_id', '=', $id)->get();

        $orders_id = $orders->pluck('id');

        $multipleOrder = Book_Order::query()
            ->whereIn('order_id', $orders_id)->get();

        $book_id = $multipleOrder->pluck('book_id');

        $books = Book::query()->find($book_id);

        return view('site.personalCabinet.orders', [
            'orders' => $orders,
            'multipleOrder'=>$multipleOrder,
            'books'=>$books,
            ]);
    }

    /**
     * @param Book $book
     * @return RedirectResponse
     */

    public function addToFavoritePersonal(Book $book): RedirectResponse
    {
        Auth::user()->books()->toggle($book);

        return redirect()->back();
    }

    /**
     * @return View
     */

    public function favoriteBooks(): View
    {
        $books = Auth::user()->books->unique();

        return view('site.personalCabinet.favorites_books', compact('books'));
    }

    /**
     * @return View
     */

    public function statistic(): View
    {

        $genres = Genre::query()
            ->selectRaw('genres.*, SUM(sales.count) as top_sales')
            ->leftJoin('books', 'books.genre_id', '=', 'genres.id')
            ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
            ->groupBy('genres.id')
            ->orderBy('top_sales', 'desc')
            ->get();

        $authors = Author::query()
            ->selectRaw('authors.*, SUM(sales.count) as top_sales')
            ->leftJoin('books', 'books.author_id', '=', 'authors.id')
            ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
            ->groupBy('authors.id')
            ->orderBy('top_sales', 'desc')
            ->get();


        $genresForChart = [];

        foreach ($genres as $genre)
        {
            $genresForChart[] = [
                'sale'=>$genre->top_sales,
                'name'=>$genre->genre_name,

                ];
        }

        $authorsForChart = [];

        foreach ($authors as $author)
        {
            $authorsForChart[] = [
                'sale'=>$author->top_sales,
                'name'=>$author->fullname,

            ];
        }

        return view('site.personalCabinet.index', compact('genresForChart', 'authorsForChart'));
    }

    /**
     * @return View
     */

    public function purchasedBooks(): View
    {
            return view('site.personalCabinet.purchasedBooks');
    }

    /**
     * @param Book $book
     * @return View
     */

    public function pdfFile(Book $book): View
    {
        return view('site.personalCabinet.pdfFile', compact('book'));
    }

    /**
     * @return View
     */

    public function subscribes(): View
    {
        $subscribes = Subscribe::query()->orderBy('monthQuantity')->get();

        return view('site.personalCabinet.subscribes', compact('subscribes'));
    }

    /**
     * @param Subscribe $subscribe
     * @return View
     */

    public function payment(Subscribe $subscribe): View
    {
        $authors = Author::all();

        $genres = Genre::all();

        return view('site.personalCabinet.payment', compact('subscribe', 'authors', 'genres'));
    }

    public function subscribeSale(SubscribeRequest $request): RedirectResponse
    {
        $this->service->updatePaymentUser($request->createDto());

        return redirect()->route('main')->with('success', 'Подписка оформлена');

    }

}


