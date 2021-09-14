<?php

namespace App\Http\Middleware\Admin;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
       if (Auth::check()){
           echo 'Пройдите антифекацию повторно';
           exit();
       }

        return $next($request);
    }
    protected function redirectTo()
    {
        echo 'Пользователь аунтефицирован';
        exit();
    }
}

//namespace App\Http\Middleware\Admin;
//
//use App\Http\Middleware\RedirectIfAuthenticated as BaseRedirectIfAuthenticated;
//
//class RedirectIfAuthenticated extends BaseRedirectIfAuthenticated
//{
//    protected function redirectTo()
//    {
//        return route('users');
//    }
//}



