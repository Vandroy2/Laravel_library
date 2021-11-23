<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCreateRequest;
use App\Models\Book;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Image;
use App\Models\Office;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use PHPUnit\Framework\Constraint\Count;


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


        return view('layouts.admin.books', compact('books'));

    }

//============================================Создание книги============================================================

    public function create()
    {
        $books = Book::all();

        return view('layouts.admin.book_create', ['books'=>$books]);
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
        return view('layouts.admin.book_edit', ['book'=>$book, 'images'=>$images]);

    }
//====================================Обновление книги==================================================================

    public function update(Request $request, Book $book, Image $image): RedirectResponse
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
//==============================================Изменение количества====================================================

    public function changeQuantity(Request $request): JsonResponse
    {
        /**
         * @var Book $book
         */
        $cartBooksArr = $request->session()->get('cartBooks', []);

        $quantity = $request->get('quantity');

        $book_id = $request->get('book_id');

        $book = Book::query()->find($book_id);


        if ($book->books_number > 1 && $quantity < 0) {

            $book->books_number += $quantity;

            $book->books_limit -=$quantity;

            $book->save();

            $cartBooksArr[$book_id]['count'] = $book->books_number;

            $request->session()->put('cartBooks', $cartBooksArr);
        }

        if ($quantity > 0) {

            if ($book->books_limit > 0){

                $book->books_number += $quantity;

                $book->books_limit -= $quantity;

                $book->save();

                $cartBooksArr[$book_id]['count'] = $book->books_number;

                $request->session()->put('cartBooks', $cartBooksArr);
            }
        }

        return response()->json(['book'=>$book]);
    }
//================================================Сброс количества при закрытии корзины=================================

    public function resetQuantity(Request $request)
    {
        $books_in_basket_id = $request->get('books_in_basket_id');

        if ($books_in_basket_id) {

            /* @var Book[] $resetBooks */

            $resetBooks = Book::query()->whereIn('id', $books_in_basket_id)->get();

            foreach ($resetBooks as $resetBook){

                $resetBook->books_limit += $resetBook->books_number;

                $resetBook->books_number = 0;

                $resetBook->save();
            }
        }
    }

//==================================================Заказ книги=========================================================
    public function order(Book $book)
    {
        $deliveries = Delivery::all();

        $cities = City::all();

        $offices = Office::all();

        if (\Illuminate\Support\Facades\Request::ajax()) {

            return response()->json([

                'bookOrder' => $book,
                'deliveries' => $deliveries,
                'cities' => $cities,
                'offices' => $offices,
            ]);
        }
        else {
            return view('book_order', [

                'bookOrder' => $book,
                'deliveries' => $deliveries,
                'cities' => $cities,
                'offices' => $offices,
            ]);
        }

    }
//=============================================Множественный заказ книг=================================================

    public function multipleOrder(Request $request)
    {
        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $deliveries = Delivery::all();

        $cities = City::all();

        $offices = Office::all();

        return view('multiple_book_order', [

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

        $num = Count($cartBooksArr);

        return response()->json(
            [
                'status' => 'success',
                'book_add_to_basket' => $book,
                'number' =>$num
            ]
        );
    }

//==============================================Удаление книги из корзины===============================================

    public function deleteFromBasket(Request $request): JsonResponse  #Добавить Request на id книги
    {
            $bookDeleteId = $request->get('delete_book_id');

            /* @var Book $bookDelete */

            $bookDelete = Book::query()->find($bookDeleteId);

            $bookDelete->books_limit += $bookDelete->books_number;

            $bookDelete->books_number = 0;

            $bookDelete->save();

            $cartBooksArr = $request->session()->get('cartBooks', []);

            $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

            $books= $cartBooks->filter(function ($book) use($bookDeleteId)
            {
                return $book->id != $bookDeleteId;

            })->all();

            $request->session()->put('cartBooks', $books);

            return response()->json(['bookDelete'=>$bookDelete]);
    }

//===============================================Очистка корзины========================================================

    public function clearBasket(Request $request): RedirectResponse
    {
        $reset = $request->get('reset');

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $request->session()->forget('cartBooks');

            foreach ($cartBooks as $book) {

                    $book->books_limit += $book->books_number;

                    $book->books_number = 0;

                    $book->save();
            }

            if ($reset){

                return redirect()->route('onlineLibrary')->with('errors', 'Заказ был отменен');
            }

       return redirect()->route('onlineLibrary')->with('success', 'Заказ успешно отправлен. Мы свяжемся с Вами в ближайшее время.');
    }

    public function limit(Request $request): JsonResponse
    {

        $book_id = $request->get('book_id');

        $book = Book::query()->find($book_id);

        return response()->json(['bookOrder'=>$book]);
    }


}
