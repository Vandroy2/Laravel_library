<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CityCreateRequest;
use App\Http\Requests\Admin\CityEditRequest;
use App\Models\City;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function view(Request $request)
    {


        $reqName = $request->input('search_name');

        $cities = City::query()

            ->with(['libraries'])
        ->when(!empty($reqName), function ($query) use($reqName){
         return $query->where('city_name', 'like', "%$reqName%");
        })
            ->orderBy('city_name','asc')
            ->paginate(10);

        return view('layouts.admin.cities',['cities'=>$cities]);
    }

    public function create()
    {
        $cities = City::all();

        return view('layouts.admin.city_create', ['cities'=>$cities]);
    }

    public  function store(CityCreateRequest $request): RedirectResponse
    {
        $city = new City();

        $city->fill($request->all());

        $city->save();

        return redirect()->route('admin.cities', ['city'=>$city])->with('success', 'Город был добавлен');

    }

    public function  edit(City $city)
    {
        return view('layouts.admin.city_edit', ['city'=>$city]);
    }

    public function update(CityEditRequest $request, City $city): RedirectResponse
    {
        $city->fill($request->all());

        $city->save();

        return redirect()->route('admin.cities', [
            'city' =>$city,
        ])->with('success', 'Город был отредактирован');
    }

    public function delete(City $city): RedirectResponse
    {
        $city->delete();

        return redirect()->route('admin.cities')->with('success', 'Город удален');
    }


}
