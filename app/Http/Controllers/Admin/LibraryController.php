<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LibraryCreateRequest;
use App\Models\Library;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LibraryController extends Controller
{
    public function view(Request $request){

        $search_library = $request->input('search_library');

        $libraries = Library::query()
            ->with(['city'])
            ->when(!empty($search_library), function ($query) use($search_library ){
                return $query
                    ->join('cities', 'libraries.city_id', '=', 'cities.id')
                    ->where('libraries.library_name', 'like', "%$search_library%")
                    ->orwhere('cities.city_name', 'like', "%$search_library%");
            })

            ->orderBy('libraries.library_name','desc')
            ->paginate('10');



        return view('layouts.admin.libraries', compact('libraries'));
    }

    public function create(){

        $libraries = Library::all();

        return view('layouts.admin.library_create', ['libraries'=>$libraries]);
    }

    public function store(LibraryCreateRequest $request): RedirectResponse
    {
        $library = new Library();

        $library->fill($request->all());

        $library->save();

        return redirect()->route('admin.libraries', ['library'=>$library])->with('success', 'Библиотека добавлена');

    }

    public function edit(Library $library)
    {
        $libraries = Library::all();
        return view('layouts.admin.library_edit', [
            'library'=>$library,
            'libraries'=>$libraries,
        ]);

    }

    public function update(LibraryCreateRequest $request, Library $library): RedirectResponse
    {
        $libraries = Library::all();

        $library->fill($request->all());

        $library->save();

        return redirect()->route('admin.libraries', [
                 'library'=>$library,
                'libraries'=>$libraries,
            ])->with('success', 'Библиотека была обновлена');


    }

    public function delete(Library $library): RedirectResponse
    {
        $library->delete();

        return redirect()->route('admin.libraries')->with('success', 'Библиотека удалена');

    }
}
