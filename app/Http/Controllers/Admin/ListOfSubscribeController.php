<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ListOfSubscribe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ListOfSubscribeController extends Controller
{
    /**
     * @return View
     */

    public function index(): View
    {
        $subscribes = ListOfSubscribe::all();

        return view('admin.subscribes.index', compact('subscribes'));
    }

    /**
     * @param ListOfSubscribe $listOfSubscribe
     * @return View
     */

    public function edit(ListOfSubscribe $listOfSubscribe): View
    {
        return view('admin.subscribes.edit', compact('listOfSubscribe'));
    }

    /**
     * @return View
     */

    public function create(): View
    {
        return view('admin.subscribes.edit');
    }

    /**
     * @param Request $request
     * @return View
     */

    public function store(Request $request): View
    {

        $listOfSubscribe  = new ListOfSubscribe();

        $listOfSubscribe->fill($request->all());

        $listOfSubscribe->save();

        return view('admin.index')->with('success', 'Подписка успешно создана');
    }

    /**
     * @param Request $request
     * @param ListOfSubscribe $listOfSubscribe
     * @return RedirectResponse
     */

    public function update(Request $request, ListOfSubscribe $listOfSubscribe): RedirectResponse
    {
        $listOfSubscribe->fill($request->all());

        $listOfSubscribe->save();

        return redirect()->route('admin.subscribes')->with('success', 'Подборка успешно обновлена');
    }

    /**
     * @param ListOfSubscribe $listOfSubscribe
     * @return RedirectResponse
     */

    public function destroy(ListOfSubscribe $listOfSubscribe): RedirectResponse
    {
        $listOfSubscribe->delete();

        return redirect()->route('admin.subscribes')->with('success', 'Подборка успешно удалена');
    }
}
