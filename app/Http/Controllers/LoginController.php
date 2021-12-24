<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function auth(LoginRequest $request): string
    {
        $auth = Auth::attempt(['email'=>$request->input('email'), 'password'=>$request->input('password')]);



        if ($auth){

            return redirect()->route('main')->with('success', 'вы успешно аунтефицировались');
        }
            else return redirect()->route('main')->with('errors', 'вы ввели неверные данные');
    }

    public function registration(RegistrationRequest $request): RedirectResponse
    {

        $user = new User();

            if($request->has('password')) {
                $user->password = Hash::make($request->input('password'));
            }

        $user->fill($request->all());

            $user->save();

            return redirect()->route('main')->with('success', 'вы успешно зарегистрировались');

    }

    public function  logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('main');
    }
}
