<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\PersonalCabinetController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest.admin',])->group(function () {
    Route::get('/login', [UserController::class, 'login'])->name('login');

    Route::match(['GET', 'POST'], '/auth', [UserController::class, 'auth'])->name('auth');
});

Route::middleware([
    'auth.admin',
    'can:auth',
])->group(function() {

    Route::get('/', [UserController::class, 'index'])->name('index');

    Route::get('/logout', [UserController::class, 'logout'])->name('logout');


    //    ==============================================Users==============================================================

    Route::prefix('users')->group(function (){

        Route::get('/', [UserController::class, 'view'])->name('users');

        Route::get('/create', [UserController::class, 'create'])->middleware('can:admin.create')->name('userCreate');

        Route::post('/store', [UserController::class, 'store'])->name('userStore');

        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('userEdit');

        Route::post('/update/{user}', [UserController::class, 'update'])->name('userUpdate');

        Route::get('/delete/{user}', [UserController::class, 'delete'])->middleware('can:admin.delete')->name('userDelete');
    });
//    ================================================City==============================================================

    Route::prefix('cities')->group(function (){

        Route::get('/', [CityController::class, 'view'])->name('cities');

        Route::get('/create', [CityController::class, 'create'])->name('cityCreate');

        Route::post('/store', [CityController::class, 'store'])->name('cityStore');

        Route::get('/edit/{city}', [CityController::class, 'edit'])->name('cityEdit');

        Route::post('/update/{city}', [CityController::class, 'update'])->name('cityUpdate');

        Route::get('/delete/{city}', [CityController::class, 'delete'])->name('cityDelete');

    });

//    ================================================libraries=========================================================

    Route::prefix('libraries')->group(function (){

        Route::get('/', [LibraryController::class, 'view'])->name('libraries');

        Route::get('/create', [LibraryController::class, 'create'])->name('libraryCreate');

        Route::post('/store', [LibraryController::class, 'store'])->name('libraryStore');

        Route::get('/edit/{library}', [LibraryController::class, 'edit'])->name('libraryEdit');

        Route::post('/update/{library}', [LibraryController::class, 'update'])->name('libraryUpdate');

        Route::get('/delete/{library}', [LibraryController::class, 'delete'])->name('libraryDelete');

    });

//    ======================================================Authors=========================================================

    Route::prefix('authors')->group(function (){

        Route::get('/', [AuthorController::class, 'view'])->name('authors');

        Route::get('/create', [AuthorController::class, 'create'])->name('authorCreate');

        Route::post('/store', [AuthorController::class, 'store'])->name('authorStore');

        Route::get('/edit/{author}', [AuthorController::class, 'edit'])->name('authorEdit');

        Route::post('/update/{author}', [AuthorController::class, 'update'])->name('authorUpdate');

        Route::get('/delete/{author}', [AuthorController::class, 'delete'])->name('authorDelete');

    });

//    =======================================================Books==============================================================

    Route::prefix('books')->group(function (){

        Route::get('/', [bookController::class, 'view'])->name('books');

        Route::get('/create', [bookController::class, 'create'])->name('bookCreate');

        Route::post('/store', [bookController::class, 'store'])->name('bookStore');

         Route::get('/edit/{book}', [bookController::class, 'edit'])->name('bookEdit');

        Route::post('/update/{book}', [bookController::class, 'update'])->name('bookUpdate');

        Route::get('/delete/{book}', [bookController::class, 'delete'])->name('bookDelete');

    });
    //===============================================Comments================================================================

    Route::prefix('personalCabinet')->group(function (){

    Route::any('/', [PersonalCabinetController::class, 'view'])->name('personalCabinet');

    Route::get('/allow/{comment}', [PersonalCabinetController::class, 'allow'])->name('personalCabinetAllow');

    Route::get('/edit/{comment}', [PersonalCabinetController::class, 'edit'])->middleware('can:edit,comment')
        ->name('personalCabinetEdit');

    Route::post('/update/{comment}', [PersonalCabinetController::class, 'update'])->name('personalCabinetUpdate');

    Route::get('/delete/{comment}', [PersonalCabinetController::class, 'delete'])->middleware('can:delete,comment')
        ->name('personalCabinetDelete');
    });

    Route::prefix('images')->group(function (){

        Route::get('/delete/{image}', [ImageController::class, 'delete'])->name('imageDelete');

        Route::get('/deleteByUser/{image}', [ImageController::class, 'deleteByUser'])->name('imageDeleteByUser');

    });



});



