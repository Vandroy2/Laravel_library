<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorCreateRequest;
use App\Http\Requests\Admin\AuthorEditRequest;
use App\Models\Author;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AuthorController extends Controller
{
    public function view(Request $request)
    {
        $search_author = $request->input('search_author');

        $authors = Author::query()

            ->when(!empty($search_author), function ($query) use ($search_author) {
                return $query
                    ->where('author_name', 'like', "%$search_author%")
                    ->orwhere('author_surname', 'like', "%$search_author%")
                    ->orwhere(DB::raw(  " (YEAR(CURRENT_DATE) - YEAR(`birthday`)) -
            (DATE_FORMAT(CURRENT_DATE, '%m%d') < DATE_FORMAT(`birthday`, '%m%d')) "), $search_author);
            })
            ->get();


        return view('layouts.admin.authors', ['authors' => $authors,]);
    }


    public function create(){

        $authors =Author::all();

        return view ('layouts.admin.author_create', ['authors'=>$authors]);
    }

    public function store(AuthorCreateRequest $request): RedirectResponse
    {
        $author = new Author();

        $author->fill($request->all());

        $author->save();

        return redirect()->route('admin.authors')->with('success', 'Автор был добавлен');
    }

    public function edit(Author $author)
    {
        return view('layouts.admin.author_edit', ['author'=>$author]);
    }

    public function update(AuthorEditRequest $request, Author $author): RedirectResponse
    {

        $author->fill($request->all());

        $author->save();

        return redirect()->route('admin.authors', ['author'=>$author])->with('success', 'Автор был отредактирован');
    }

    public function delete(Author $author): RedirectResponse
    {
        $author->delete();

        return redirect()->route('admin.authors')->with('success', 'Автор был удален');
    }
}
