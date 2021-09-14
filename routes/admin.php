<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

//Route::middleware('guest.admin')->group(function (){
    Route::get('/',[UserController::class, 'login'])->name('login');
  Route::post('/auth', [UserController::class, 'auth'])->name('auth');
//});

Route::middleware('auth.admin')->group(function(){

    Route::get('/index', [UserController::class, 'index'])->name('index');

    Route::get('/logout', [UserController::class, 'login'])->name('logout');

    Route::get('/users', [UserController::class, 'users'])->name('users');

    Route::get('/users/user/create', [UserController::class, 'userCreate'])->name('userCreate');

    Route::post('/users/user/createSubmit', [UserController::class, 'userCreateSubmit'])->name('userCreateSubmit');

    Route::get('/users/user/{user}/edit', [UserController::class, 'userEdit'])->name('userEdit');

    Route::post('/users/user/{user}/editSubmit', [UserController::class, 'userEditSubmit'])->name('userEditSubmit');

    Route::get('/users/user/{user}/delete', [UserController::class, 'userDelete'])->name('userDelete');
});
