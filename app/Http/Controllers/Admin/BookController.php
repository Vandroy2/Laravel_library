<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCreateRequest;
use App\Models\Book;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class BookController extends Controller
{
    public function books(Request $request)
    {
        $search_book = $request->input('search_book');


        $books = Book::query()
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

    public function bookCreate()
    {
        $books = Book::all();

        return view('layouts.admin.book_create', ['books'=>$books]);
    }

    public function bookCreateSubmit(BookCreateRequest $request): RedirectResponse
    {
        $book = new Book();

        $book->fill($request->all());

        $book->save();

        return redirect()->route('admin.books')->with('success', 'Книга была создана');
    }

    public function bookEdit(Book $book)
    {
        return view('layouts.admin.book_edit', ['book'=>$book]);

    }

    public function bookEditSubmit(BookCreateRequest $request, Book $book): RedirectResponse
    {
        $book->fill($request->all());

        $book->save();

        return redirect()->route('admin.books', ['book'=>$book])->with('success', 'Книга была отредактирована');

    }

    public function bookDelete(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Книга была удалена');
    }


}
