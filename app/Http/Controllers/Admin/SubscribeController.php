<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class SubscribeController extends Controller
{
    /**
     * @return View
     */

    public function index(): View
    {
        $subscribes = Subscribe::all();

        return view('admin.subscribes.index', compact('subscribes'));
    }

    /**
     * @param Subscribe $subscribe
     * @return View
     */

    public function edit(Subscribe $subscribe): View
    {
        return view('admin.subscribes.edit', compact('subscribe'));
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

        $subscribe  = new Subscribe();

        $subscribe->fill($request->all());

        $subscribe->save();

        return view('admin.index')->with('success', 'Подписка успешно создана');
    }

    /**
     * @param Request $request
     * @param Subscribe $subscribe
     * @return RedirectResponse
     */

    public function update(Request $request, Subscribe $subscribe): RedirectResponse
    {
        $subscribe->fill($request->all());

        $subscribe->save();

        return redirect()->route('admin.subscribes')->with('success', 'Подборка успешно обновлена');
    }

    /**
     * @param Subscribe $subscribe
     * @return RedirectResponse
     */

    public function destroy(Subscribe $subscribe): RedirectResponse
    {
        $subscribe->delete();

        return redirect()->route('admin.subscribes')->with('success', 'Подборка успешно удалена');
    }
}
