<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BookCreateRequest;
use App\Models\Book;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
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

    public function edit(Book $book)
    {
        $images = Image::all();
        return view('layouts.admin.book_edit', ['book'=>$book, 'images'=>$images]);

    }

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

    public function delete(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()->route('admin.books')->with('success', 'Книга была удалена');
    }


}
