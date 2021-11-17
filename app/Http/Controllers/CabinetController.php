<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    public function view()
    {
        $commentsNotPublished = Comment::query()
            ->where('published', '=', null)
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $commentPublished = Comment::query()
            ->where('published', '=', '1')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('personalCabinetComments', ['commentsNotPublished' => $commentsNotPublished, 'commentPublished' => $commentPublished]);
    }

    public function orders()
    {
        $id = Auth::id();

        $orders = Order::query()
            ->where('user_id', '=', $id)->get();


        return view('personalCabinetOrders', ['orders' => $orders,]);
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


