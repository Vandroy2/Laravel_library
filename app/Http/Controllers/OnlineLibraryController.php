<?php



namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Book_User;
use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OnlineLibraryController extends Controller
{
    public function view(Request $request)
    {
        $comments = Comment::all();

        $search_book = $request->input('search_book');

        $books = Book::query()
            ->select('books.*')
            ->with(['author', 'images'])

            ->when(!empty($search_book), function($query) use($search_book){
                return $query
                    ->Join('authors', 'books.author_id', '=', 'authors.id')
                    ->join('libraries', 'books.library_id', '=', 'libraries.id')
                    ->where('books.book_name', 'like', "%$search_book%")
                    ->orwhere('authors.author_name', 'like', "%$search_book%")
                    ->orwhere('authors.author_surname', 'like', "%$search_book%")
                    ->orwhere('libraries.library_name', 'like', "%$search_book%");
            })->paginate(18);

        return view('onlineLibrary', ['comments'=>$comments, 'books'=>$books, ]);
    }

    public function addToFavorite(Book $book)
    {
        Auth::user()->books()->toggle($book);

        if (Auth::user()->books->contains($book)){
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
            'book' => [
                'id' => $book->id,
                'name' => $book->book_name,
            ],
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


