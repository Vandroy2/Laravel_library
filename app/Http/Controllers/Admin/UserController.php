<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Models\Book;
use App\Models\Book_Order;
use App\Models\Image;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller

{

    public function login()
    {
        return view('admin.login');
    }


    public function  logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }


    public function auth(LoginRequest $request): RedirectResponse

    {
        $auth = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);


        if ($auth)
        {
            return redirect()->route('admin.index');
        }
            else return redirect()->route('admin.login')->with('errors', 'авторизация не удалась');

    }


    public function index()
    {
        return view('admin.index');
    }


    public function view(Request $request)
    {

        $search_user = $request->input('search_user');

        $users = User::query()

            ->with('images')
            ->when(!empty($search_user), function ($query) use($search_user){
                return $query
                    ->where('id', '=', "$search_user")
                    ->orwhere('name', 'like', "%$search_user%")
                    ->orwhere('surname', 'like', "%$search_user%")
                    ->orwhere('email', 'like', "%$search_user%");
            })

            ->get();



        return view('admin.users.index', ['users'=>$users]);

    }

        public function create()
        {

            $users = User::all();

            return view('admin.users.edit', ['user_data'=>$users]);


        }

        public function  store(UserCreateRequest $request): RedirectResponse
        {

            $user = new User();

            $user->fill($request->all());

            $user->save();

            foreach (Arr::wrap($request->file('images', [])) as $imageFile)
            {

                $image = new Image();

                $image->images = $imageFile->store('uploads', 'public');

                $user->images()->save($image);
            }

            return redirect()->route('admin.users', $user)->with('success', 'Пользователь был добавлен');

        }


    public function edit(User $user)
        {
            $images = Image::all();

            return view('admin.users.edit', ['user'=>$user, 'images'=>$images]);

        }

    public function update(UserEditRequest $request, User $user, Image $image): RedirectResponse
    {
        $user->fill($request->all());
        //        if($request->has('password'))
        //        $user->password = Hash::make($request->input('password'));

        $user->save();

        $users = User::all();

        $image->delete();

        foreach (Arr::wrap($request->file('images', [])) as $imageFile)
        {

            $image = new Image();

            $image->images = $imageFile->store('uploads', 'public');

            $user->images()->save($image);
        }

        return redirect()->route('admin.users',  [
            'users'=>$users,
            'user'=>$user
        ])->with('success', 'Пользователь был отредактирован');
    }

    public function delete(User $user): RedirectResponse
    {

        $orders = Order::query()->where('user_id', '=', $user->id)->get();

        foreach ($orders as $order){

            $multipleOrders = Book_Order::query()
                ->where('order_id', $order->id)->get();

            foreach ($multipleOrders as $multipleOrder) {

                $book = Book::query()->find($multipleOrder->book_id);

                /**
                 * @var Book $book
                 */

                $book->books_limit += $multipleOrder->book_number;

                $book->save();

            $order = Book_Order::query()->where('order_id', '=', $order->id)->delete();
        }}

        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Пользователь удален');

    }
}




