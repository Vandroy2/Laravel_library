<?php

namespace App\Http\Controllers;


use App\Models\Book;
use App\Models\Book_Order;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    public function view()
    {
        $commentsNotPublished = Comment::query()
            ->whereNull('published')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $commentPublished = Comment::query()
            ->where('published', '=', 1)
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('personalCabinetComments', ['commentsNotPublished' => $commentsNotPublished, 'commentPublished' => $commentPublished]);
    }

    public function orders()
    {
        $id = Auth::id();

        $orders = Order::query()
            ->where('user_id', '=', $id)->get();

        $orders_id = $orders->pluck('id');

        $multipleOrder = Book_Order::query()
            ->whereIn('order_id', $orders_id)->get();

        $book_id = $multipleOrder->pluck('book_id');

        $books = Book::query()->find($book_id);

        return view('personalCabinetOrders', [
            'orders' => $orders,
            'multipleOrder'=>$multipleOrder,
            'books'=>$books,
            ]);
    }

    public function addToFavoritePersonal(Book $book): RedirectResponse
    {
        Auth::user()->books()->toggle($book);

        return redirect()->back();
    }

    public function favoriteBooks()
    {
        $books = Auth::user()->books->unique();

        return view('favorites_books', compact('books'));
    }

}


