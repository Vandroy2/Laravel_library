<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $genres = Genre::query()
        ->with('image')
        ->get();

        return view('admin.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return view
     */
    public function create(): View
    {
        return view('admin.genres.edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {



        $genre = new Genre();

        $genre->fill($request->all());

        $genre->save();

        $imageFile = $request->file('image');

        $image = new Image();

        $image->images = $imageFile->store('uploads', 'public');

        $genre->image()->save($image);

        return redirect()->route('admin.genres.index')->with('success', 'жанр успешно создан');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Genre $genre
     * @return view
     */
    public function edit(Genre $genre): View
    {
        return view('admin.genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Genre $genre
     * @return RedirectResponse
     */
    public function update(Request $request, Genre $genre): RedirectResponse
    {
        $genre->fill($request->all());

        $genre->save();

        $image = $genre->image;

        $imageFile = $request->file('image');

        if ($imageFile){

            $image->delete();

            $image = new Image();

            $image->images = $imageFile->store('uploads', 'public');

            $genre->image()->save($image);
        }

        return redirect()->route('admin.genres.index')->with('success', 'жанр успешно отредактирован');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Genre $genre
     * @return RedirectResponse
     */
    public function destroy(Genre $genre): RedirectResponse
    {

        $genre->books()->delete();

        $genre->delete();

        return redirect()->route('admin.genres.index')->with('success', 'жанр успешно удален');

    }
}
