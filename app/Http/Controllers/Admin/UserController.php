<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\Admin\UserCreateRequest;
use App\Http\Requests\Admin\UserEditRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
//        if (Auth::check()){
//            echo 'Пользователь аунтефицирован';
//            exit();
//        }
//        else echo 'Пройдите антифекацию повторно';
//        exit();

        $auth = Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')]);

        if ($auth)
        {
            return redirect()->route('admin.index');
        }

        return redirect()->route('admin.login')->with('error', 'аунтефикация не удалась');

    }


    public function index()
    {
        return view('admin.index');
    }


    public function users()
    {
        $users = User::all();

        return view('layouts.admin.users', ['users'=>$users]);

    }

        public function userCreate()
        {

            $users = User::all();

            return view('layouts.admin.user_create', ['user_data'=>$users]);


        }

        public function  userCreateSubmit(UserCreateRequest $request): RedirectResponse
        {

            $user = new User();

            $user->fill($request->all());

            $user->save();

            return redirect()->route('admin.users', $user)->with('success', 'Пользователь был добавлен');

        }

        public function userEdit(User $user)
        {

            return view('layouts.admin.user_edit', ['user'=>$user]);

        }

    public function userEditSubmit(UserEditRequest $request, User $user): RedirectResponse
    {
        $user->fill($request->all());
        //        if($request->has('password'))
        //        $user->password = Hash::make($request->input('password'));

        $user->save();

        $users = User::all();

        return redirect()->route('admin.users',  [
            'users'=>$users,
            'user'=>$user
        ])->with('success', 'Пользователь был отредактирован');
    }

    public function userDelete(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Пользователь удален');


    }



}
