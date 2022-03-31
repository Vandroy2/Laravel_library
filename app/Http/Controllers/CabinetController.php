<?php

namespace App\Http\Controllers;


use App\DTO\SubscribeDto;
use App\Http\Requests\Filters\BookFilter;
use App\Http\Requests\SubscribeRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Book_Order;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\ListOfSubscribe;
use App\Models\Order;
use App\Services\Actions\SubscribeActionService;
use App\Services\Actions\UserActionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CabinetController extends Controller
{
    /**
     * @var $user
     */

    protected $userActionService;

    /**
     * @var $subscribeService
     */

    protected $subscribeActionService;

    /**
     * @param UserActionService $userActionService
     * @param SubscribeActionService $subscribeActionService
     */

    public function __construct(UserActionService $userActionService, SubscribeActionService $subscribeActionService)
    {
        $this->userActionService = $userActionService;

        $this->subscribeActionService = $subscribeActionService;

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

        $notifications = Auth::user()->unreadNotifications;

        return view('site.personalCabinet.index', compact('genresForChart', 'authorsForChart', 'notifications'));
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
        $listOfSubscribes = ListOfSubscribe::query()->orderBy('listSubscribeMonthQuantity')->get();

        return view('site.personalCabinet.listOfSubscribes', compact('listOfSubscribes'));
    }

    /**
     * @param ListOfSubscribe $listOfSubscribe
     * @return View
     */

    public function payment(ListOfSubscribe $listOfSubscribe): View
    {
        $authors = Author::all();

        $genres = Genre::all();

        return view('site.personalCabinet.payment', compact('listOfSubscribe', 'authors', 'genres'));
    }

    /**
     * @param SubscribeRequest $request
     * @return RedirectResponse
     */

    public function subscribeSale(SubscribeRequest $request): RedirectResponse
    {

        $filter = BookFilter::createByRequest($request);

        $subscribe = $this->subscribeActionService->createSubscribe(SubscribeDto::createById($request->get('listSubscribe_id')));

        $this->userActionService->updatePaymentUser($request->createPaymentDto(), $subscribe->id);

        $this->userActionService->attachSubscribeItems($filter, $this->subscribeActionService, $subscribe);

       return redirect()->route('main')->with('success', 'Подписка оформлена');

    }

    /**
     * @param Request $request
     * @return Response
     */

    public function markNotifications(Request $request): Response
    {
        Auth::user()->unreadNotifications
            ->when($request->input('id'), function ($query) use($request){
            return $query->where('id', '=', $request->input('id'));
        })->markAsRead();

        return response()->noContent();
    }

}


