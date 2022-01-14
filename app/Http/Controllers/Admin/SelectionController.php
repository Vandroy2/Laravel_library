<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SelectionRequest;
use App\Models\Author;
use App\Models\Selection;
use App\Models\Genre;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;



class SelectionController extends Controller
{
    /**
     * @return View
     */

    public function index(): View
    {
        $selections = Selection::all();

        return view('admin.selections.index', compact('selections'));
    }

    /**
     * @return View
     */

    public function create():View
    {
        $authors = Author::all();

        $genres = Genre::all();

        return view('admin.selections.edit', compact('authors', 'genres'));
    }

    /**
     * @param SelectionRequest $request
     * @return RedirectResponse
     * @throws
     */

    public function store(SelectionRequest $request): RedirectResponse
    {

        $selection = new Selection();

        $selection->fill($request->except('genre_id', 'author_id', 'created_at'));

        $selection->created_at = Cart::getDate($request);

        $selection->save();

        Cart::getSelection($request, $selection);

        return redirect()->route('admin.selections')->with('success', 'Выборка успешно создана');
    }

    /**
     * @param Selection $selection
     * @return View
     */

    public function edit(Selection $selection): View
    {
        $authors = Author::all();

        $genres = Genre::all();

        return view('admin.selections.edit', compact('selection', 'authors', 'genres'));
    }

    /**
     * @param SelectionRequest $request
     * @param Selection $selection
     * @return RedirectResponse
     */

    public function update(SelectionRequest $request, Selection $selection): RedirectResponse
    {

        $selection->fill($request->except('genre_id', 'author_id', 'created_at'));

        $selection->created_at = Cart::getDate($request);

        $selection->save();

        $selection->genres()->detach();

        $selection->authors()->detach();

        Cart::getSelection($request, $selection);

        return redirect()->route('admin.selections')->with('success', 'Выборка успешно обновлена');
    }

    /**
     * @param Selection $selection
     * @return RedirectResponse
     */

    public function destroy(Selection $selection): RedirectResponse
    {
        $selection->delete();

        return redirect()->route('admin.selections')->with('success', 'Выборка успешно удалена');

    }
}
