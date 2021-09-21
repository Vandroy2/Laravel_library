<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\LibraryController;
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

    Route::get('/cities', [CityController::class, 'cities'])->name('cities');

    Route::get('/cities/city/create', [CityController::class, 'cityCreate'])->name('cityCreate');

    Route::post('/cities/city/createSubmit', [CityController::class, 'cityCreateSubmit'])->name('cityCreateSubmit');

    Route::get('/cities/city/{city}/edit', [CityController::class, 'cityEdit'])->name('cityEdit');

    Route::post('/cities/city/{city}/editSubmit', [CityController::class, 'cityEditSubmit'])->name('cityEditSubmit');

    Route::get('/cities/city/{city}/delete', [CityController::class, 'cityDelete'])->name('cityDelete');

//    ================================================libraries=========================================================

    Route::get('/libraries', [LibraryController::class, 'libraries'])->name('libraries');

    Route::get('/libraries/library/create', [LibraryController::class, 'libraryCreate'])->name('libraryCreate');

    Route::post('/libraries/library/createSubmit', [LibraryController::class, 'libraryCreateSubmit'])->name('libraryCreateSubmit');

    Route::get('/libraries/library/{library}/edit', [LibraryController::class, 'libraryEdit'])->name('libraryEdit');

    Route::post('/libraries/library/{library}/editSubmit', [LibraryController::class, 'libraryEditSubmit'])->name('libraryEditSubmit');

    Route::get('/libraries/library/{library}/delete', [LibraryController::class, 'libraryDelete'])->name('libraryDelete');

//    ======================================================Authors=========================================================

    Route::get('/authors', [AuthorController::class, 'authors'])->name('authors');

    Route::get('/authors/author/create', [AuthorController::class, 'authorCreate'])->name('authorCreate');

    Route::post('/authors/author/authorSubmit', [AuthorController::class, 'authorCreateSubmit'])->name('authorCreateSubmit');

    Route::get('/authors/author/{author}/edit', [AuthorController::class, 'authorEdit'])->name('authorEdit');

    Route::post('/authors/author{author}/editSubmit', [AuthorController::class, 'authorEditSubmit'])->name('authorEditSubmit');

    Route::get('/authors/author/{author}/delete', [AuthorController::class, 'authorDelete'])->name('authorDelete');

//    =======================================================Books==============================================================

    Route::get('/books', [bookController::class, 'books'])->name('books');

    Route::get('/books/book/create', [bookController::class, 'bookCreate'])->name('bookCreate');

    Route::post('/books/book/bookSubmit', [bookController::class, 'bookCreateSubmit'])->name('bookCreateSubmit');

    Route::get('/books/book{book}/edit', [bookController::class, 'bookEdit'])->name('bookEdit');

    Route::post('/books/book{book}/editSubmit', [bookController::class, 'bookEditSubmit'])->name('bookEditSubmit');

    Route::get('/books/book/{book}/delete', [bookController::class, 'bookDelete'])->name('bookDelete');

});
