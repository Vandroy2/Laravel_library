<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest.admin')->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');

    Route::match(['GET', 'POST'], '/auth', [UserController::class, 'auth'])->name('auth');
});

Route::middleware('auth.admin')->group(function() {

    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

//    ==============================================Users==============================================================

    Route::get('/users', [UserController::class, 'users'])->name('users');

    Route::get('/users/user/create', [UserController::class, 'userCreate'])->name('userCreate');

    Route::post('/users/user/createSubmit', [UserController::class, 'userCreateSubmit'])->name('userCreateSubmit');

    Route::get('/users/user/{user}/edit', [UserController::class, 'userEdit'])->name('userEdit');

    Route::post('/users/user/{user}/editSubmit', [UserController::class, 'userEditSubmit'])->name('userEditSubmit');

    Route::get('/users/user/{user}/delete', [UserController::class, 'userDelete'])->name('userDelete');

//    ================================================City==============================================================

    Route::get('/libraries', [libraryController::class, 'libraries'])->name('cities');

    Route::get('/libraries/library/create', [libraryController::class, 'libraryCreate'])->name('libraryCreate');

    Route::post('/libraries/library/createSubmit', [libraryController::class, 'libraryCreateSubmit'])->name('libraryCreateSubmit');

    Route::get('/libraries/library/{library}/edit', [libraryController::class, 'libraryEdit'])->name('libraryEdit');

    Route::post('/libraries/library/{library}/editSubmit', [libraryController::class, 'libraryEditSubmit'])->name('libraryEditSubmit');

    Route::get('/libraries/library/{library}/delete', [libraryController::class, 'libraryDelete'])->name('libraryDelete');

//    ================================================libraries=========================================================


});
