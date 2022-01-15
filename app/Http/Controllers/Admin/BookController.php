<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCreateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\City;
use App\Models\Comment;
use App\Models\Delivery;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Library;
use App\Models\Office;
use App\Models\Order;


use App\Models\Selection;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use app\Helpers\Cart;



class BookController extends Controller
{

//======================================Список всех книг================================================================

    public function view(Request $request)
    {
        $search_book = $request->input('search_book');


        $books = Book::query()
            ->select('books.*')
            ->with(['library', 'author'])


            ->when(!empty($search_book), function($query) use($search_book){
                return $query
                    ->leftJoin('libraries', 'books.library_id', '=', 'libraries.id')
                    ->leftJoin('authors', 'books.author_id', '=', 'authors.id')

                    ->where('books.book_name', 'like', "%$search_book%")
                    ->orwhere('authors.author_name', 'like', "%$search_book%")
                    ->orwhere('authors.author_surname', 'like', "%$search_book%")
                    ->orwhere('libraries.library_name', 'like', "%$search_book%");
            })

            ->paginate(8);

        return view('admin.books.index', compact('books'));

    }

//============================================Создание книги============================================================

    public function create()
    {
        $books = Book::all();

        $images = Image::all();

        $genres = Genre::all();

        $authors = Author::all();

        $libraries = Library::all();

        return view('admin.books.edit', ['books'=>$books, 'images'=>$images, 'genres'=>$genres, 'authors'=> $authors, 'libraries' => $libraries,]);
    }

    public function store(BookCreateRequest $request): RedirectResponse
    {

        $book = new Book();

        $book->fill($request->all());

        $book->save();

        foreach (Arr::wrap($request->file('images', [])) as $imageFile)
        {

            $image = new Image();

            $image->images = $imageFile->store('uploads', 'public');

            $book->images()->save($image);
        }

        return redirect()->route('admin.books')->with('success', 'Книга была создана');
    }

//===================================Редактирование книги===============================================================

    public function edit(Book $book)
    {
        $images = Image::all();

        $genres = Genre::all();

        $authors = Author::all();

        $libraries = Library::all();

        return view('admin.books.edit', [
            'book'=>$book,
            'images'=>$images,
            'genres'=>$genres,
            'authors'=> $authors,
            'libraries' => $libraries,

        ]);

    }
//====================================Обновление книги==================================================================

    public function update(BookCreateRequest $request, Book $book, Image $image): RedirectResponse
    {
        $book->fill($request->all());

        $book->save();

        $image->delete();


        foreach (Arr::wrap($request->file('images', [])) as $imageFile)
        {

            $image = new Image();

            $image->images = $imageFile->store('uploads', 'public');

            $book->images()->save($image);
        }

        return redirect()->route('admin.books', ['book'=>$book,])->with('success', 'Книга была отредактирована');

    }
//==============================================Удаление книги==========================================================

    public function delete(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Книга была удалена');
    }
//==============================================Изменение количества книг в корзине=====================================

    public function changeQuantity(Request $request): JsonResponse
    {
        /* @var Book $book */

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $quantity = $request->get('quantity');

        $book_id = $request->get('book_id');

        $book = Book::query()->where('id', '=', $book_id)->first();


            if ($cartBooksArr[$book_id]['count'] > 1 && $quantity < 0) {

                $cartBooksArr[$book_id]['count'] += $quantity;

                $book->books_limit -= $quantity;

                $book->save();

            }

            if ($quantity > 0) {

                if ($book->books_limit > 0){

                    $cartBooksArr[$book_id]['count'] += $quantity;

                    $book->books_limit -=$quantity;

                    $book->save();

                }
            }

        $request->session()->put('cartBooks', $cartBooksArr);

            $number = $cartBooksArr[$book_id]['count'];

            return response()->json(['book'=>$book, 'number'=>$number, 'sumOrder'=>Cart::getOrderSum($request)]);
    }

//===============================================Изменение количества при заказе одной книги============================

    public function changeBookQuantity(Request $request): JsonResponse
    {
        $id = $request->get('book_id');

        $quantity = $request->get('quantity');

        $book = Book::query()->find($id);

        if ($book->books_number > 1 && $quantity < 0 || $quantity > 0 && $book->books_limit > 0) {

            $book->books_number += $quantity;

            $book->books_limit -= $quantity;

            $book->save();

        }

        $sum = $book->price * $book->books_number;

            return response()->json(['book'=>$book, 'bookOrderSum'=> $sum, 'status' =>200]);
    }

//==================================================Заказ книги=========================================================

    public function order(Request $request, Book $book)
    {


        $deliveries = Delivery::all();

        $cities = City::all();

        $offices = Office::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

//        if(Arr::has($cartBooksArr, $book->id))
//            return response()->json(['status' => 'fail', 'message' => 'Book is exist in cart.'], 422);

        /** cartBooks = [1 => ['count' => 1], ]*/

        $cartBooksArr[$book->id] = ['count' => 1];

        $request->session()->put('cartBooks', $cartBooksArr);

        $book->books_limit -= 1;

        $book->save();

        $book->books_number = 1;

        $count = $cartBooksArr[$book->id]['count'];

        $sum = $book->price * $cartBooksArr[$book->id]['count'];

        if (\Illuminate\Support\Facades\Request::ajax()) {

            return response()->json([

                'bookOrder' => $book,
                'deliveries' => $deliveries,
                'cities' => $cities,
                'offices' => $offices,
                'num' => $count,
                'sum' => $sum
            ]);
        }
        else {
            return view('site.bookOrder.book_order', [

                'bookOrder' => $book,
                'deliveries' => $deliveries,
                'cities' => $cities,
                'offices' => $offices,
                'sum' => $sum,
            ]);
        }

    }
//=============================================Множественный заказ книг=================================================

    public function multipleOrder(Request $request)
    {

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $cartBooks = $cartBooks->map(function($book) use($cartBooksArr) {

            $book->books_number = Arr::get(Arr::get($cartBooksArr, $book->id, []), 'count');

            return $book;
        });

        $deliveries = Delivery::all();

        $cities = City::all();

        $offices = Office::all();

        return view('site.bookOrder.multiple_book_order', [

            'booksOrder'=>$cartBooks,
            'deliveries'=> $deliveries ,
            'cities'=>$cities ,
            'offices'=>$offices,
        ]);
    }

//=============================================Добавление книги в корзину===============================================

    public function addToBasket(Request $request, $id): JsonResponse  #Добавить Request на id книги
    {

        $cartBooksArr = $request->session()->get('cartBooks', []);

        if(Arr::has($cartBooksArr, $id))
            return response()->json(['status' => 'fail', 'message' => 'Book is exist in cart.'], 422);

        /** cartBooks = [1 => ['count' => 1], ]*/

        $cartBooksArr[$id] = ['count' => 1];

        $request->session()->put('cartBooks', $cartBooksArr);

        $book = Book::query()->find($id);

        /**
         * @var Book| $book
         */

        $book->books_limit -= 1;

        $book->save();

        $num = Count($cartBooksArr);

        $sum = $book->price * $cartBooksArr[$book->id]['count'];

        return response()->json(
            [
                'status' => 'success',
                'book_add_to_basket' => $book,
                'number' =>$num,
                'sumOrder'=>Cart::getOrderSum($request),
                'sum' => $sum
            ]
        );
    }

//==============================================Удаление книги из корзины===============================================

    public function deleteFromBasket(Request $request): JsonResponse  #Добавить Request на id книги
    {
            $bookDeleteId = $request->get('delete_book_id');

            /* @var Book $bookDelete */

            $bookDelete = Book::query()->find($bookDeleteId);

            $cartBooksArr = $request->session()->get('cartBooks', []);

            $bookDelete->books_limit += $cartBooksArr[$bookDeleteId]['count'];

            $cartBooksArr[$bookDeleteId]['count'] = 0;

            $bookDelete->save();

            foreach (array_keys($cartBooksArr) as $id)
                {
                    if ($id == $bookDeleteId)
               {
                    unset($cartBooksArr[$id]);
               }
                }

            $request->session()->put('cartBooks', $cartBooksArr);

            return response()->json(['bookDelete'=>$bookDelete, 'sumOrder'=>Cart::getOrderSum($request)]);
    }

//===============================================Очистка корзины========================================================

    public function clearBasket(Request $request): RedirectResponse
    {
        /* @var Book $book,
         * @var Book $cartBook
         */

        Cart::clearCart($request);

        return redirect()->route('onlineLibrary')->with('errors', 'Заказ был отменен');
    }


    public function limit(Request $request): JsonResponse
    {

        $book_id = $request->get('book_id');

        $book = Book::query()->find($book_id);

        return response()->json(['bookOrder'=>$book]);
    }

    public function add(Request $request): JsonResponse
    {
            $order_id = $request->get('order_id');

            $order = Order::query()->find($order_id);

        /**
         * @var Order $order
         */

            $i = array_key_last($order->books->toArray());

            $books = Book::all();

                return response()->json([
                   'books' =>$books,
                    'order' =>$order,
                    'i' => $i,
                ]);
        }

//==============================================Выборка книг============================================================

        public function selection()
        {
            $books = Book::all();

            $images = Image::all();

            $genres = Genre::all();

            $authors = Author::all();

            return view('admin.selections.book_selection', compact('books', 'images', 'genres', 'authors'));
        }

//========================================Фильтр========================================================================

        public function filterBooks(Request $request): JsonResponse
        {
            $startDate = Carbon::now()->subMonth();

            $endDate = Carbon::now();

            $genreId = $request->get('genreId');

            $authorId = $request->get('authorId');

            $salesSort = $request->get('sortSales');

            $priceSort = $request->get('sortPrice');

            $query = Book::query()->with('author', 'images');



            if($genreId && $genreId !='Жанр'){

                $query->where('genre_id', $genreId);

            }

            if ($authorId && $authorId !='Автор'){

                    $query->where('author_id', $authorId);
                }

            if ($salesSort == 'sales_hi' && $salesSort != 'Популярность')

                $query->select('books.*')
                    ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
                    ->whereBetween('sales.created_at',[$startDate, $endDate])
                    ->orderBy('sales.count', 'desc');

            if ($salesSort == 'sales_low' && $salesSort != 'Популярность')

                $query->select('books.*')
                    ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
                    ->whereBetween('sales.created_at',[$startDate, $endDate])
                    ->orderBy('sales.count');

            if ($priceSort == 'price_hi' && $priceSort != 'Цена')

                $query->orderBy('price', 'desc');

            if ($priceSort == 'price_low' && $priceSort != 'Цена')

                $query->orderBy('price');

            $books = $query->get();

                return response()->json(['books' => $books]);
        }


//=====================================Подборка=========================================================================


    public function top(Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $top = 'top10';

        $books = Book::query()
            ->select('books.*')
            ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
            ->orderBy('count','desc')
            ->take(10)
            ->get();


        return view('site.onlineLibrary.index', ['comments'=>$comments, 'books'=>$books, 'cartBooks'=>$cartBooks, 'sumOrder'=>Cart::getOrderSum($request), 'top'=>$top]);
    }

    public function newest(Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $top = 'top10';

        $books = Book::query()
          ->orderBy('created_date', 'desc')
            ->take(10)
            ->get();

        return view('site.onlineLibrary.index', ['comments'=>$comments, 'books'=>$books, 'cartBooks'=>$cartBooks, 'sumOrder'=>Cart::getOrderSum($request), 'top'=>$top]);
    }

    public function topAuthors(Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $top = 'author';

        // DB::statement("SET sql_mode='';");

        $authors = Author::query()
            ->selectRaw('authors.*, SUM(sales.count) as top_sales')
            ->leftJoin('books', 'books.author_id', '=', 'authors.id')
            ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
            ->groupBy('authors.id')
            ->orderBy('top_sales', 'desc')
            ->take(5)
            ->get();

        return view('site.onlineLibrary.topAuthors', ['authors'=>$authors,'comments'=>$comments, 'cartBooks'=>$cartBooks, 'sumOrder'=>Cart::getOrderSum($request), 'top'=>$top]);
    }

    public function topGenres (Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $top = 'genre';

        $genres = Genre::query()
            ->selectRaw('genres.*, SUM(sales.count) as top_sales')
            ->leftJoin('books', 'books.genre_id', '=', 'genres.id')
            ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
            ->groupBy('genres.id')
            ->orderBy('top_sales', 'desc')
            ->take(3)
            ->get();

        return view('site.onlineLibrary.topGenres', ['genres'=>$genres,'comments'=>$comments, 'cartBooks'=>$cartBooks, 'sumOrder'=>Cart::getOrderSum($request), 'top'=>$top]);
    }

    public function lowPrice(Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();



        $books = Book::query()
            ->where('price', '<', 200)
            ->orderBy('price', 'desc')
            ->paginate(18);

        return view('site.onlineLibrary.index', ['books'=>$books,'comments'=>$comments, 'cartBooks'=>$cartBooks, 'sumOrder'=>Cart::getOrderSum($request), 'top'=>null]);
    }

    public function selections(Request $request)
    {
        $comments = Comment::all();

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $selections = Selection::all();



        foreach ($selections as $selection)
        {
            $selection->books()->detach();

            $books = Cart::bookFilter($selection);

            $selection->books()->toggle($books);
        }

        return view('site.onlineLibrary.selections', ['selections'=>$selections,'comments'=>$comments, 'cartBooks'=>$cartBooks, 'sumOrder'=>Cart::getOrderSum($request), 'top'=>null]);
}}
