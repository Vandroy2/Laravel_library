<?php

use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PersonalCabinetController;
use App\Http\Controllers\Admin\SelectionController;
use App\Http\Controllers\Admin\ListOfSubscribeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\GenreController;
use Illuminate\Support\Facades\Route;

//================================================Order books===========================================================

Route::prefix('books')->group(function (){

    Route::get('/order/book/{book}', [bookController::class, 'order'])->name('bookOrder');

    Route::match(['get', 'post'],'/order/books', [bookController::class, 'multipleOrder'])->name('bookMultipleOrder');

    Route::match(['get', 'post'], '/book/changeQuantity', [bookController::class, 'changeQuantity'])->name('bookChangeQuantity');

    Route::match(['get', 'post'], '/book/resetQuantity', [bookController::class, 'resetQuantity'])->name('bookResetQuantity');

    Route::match(['get', 'post'], '/book/addToBasket/{id}', [bookController::class, 'addToBasket'])->name('bookAddToBasket');

    Route::match(['get', 'post'], '/book/deleteFromBasket', [bookController::class, 'deleteFromBasket'])->name('bookDeleteFromBasket');

    Route::match(['get', 'post'], '/book/clearBasket', [bookController::class, 'clearBasket'])->name('bookClearBasket');

    Route::match(['get', 'post'], '/book/limit', [bookController::class, 'limit'])->name('bookLimit');

    Route::match(['get', 'post'], '/book/add', [bookController::class, 'add'])->name('bookAdd');

    Route::get('/top', [bookController::class, 'top'])->name('bookTop10');

    Route::get('/newest', [bookController::class, 'newest'])->name('bookNewest');

    Route::get('/topAuthors', [bookController::class, 'topAuthors'])->name('bookTopAuthors');

    Route::get('/topGenres', [bookController::class, 'topGenres'])->name('bookTopGenres');

    Route::get('/lowPrice', [bookController::class, 'lowPrice'])->name('bookLowPrice');

    Route::match(['post', 'get'],'/changeBookQuantity', [bookController::class, 'changeBookQuantity'])->name('bookChangeBookQuantity');

    Route::get('/selections', [bookController::class, 'selections'])->name('bookSelections');

});

    Route::match(['get', 'post'],'/cities/show', [CityController::class, 'show'])->name('citiesShow');

    Route::match(['get','post'], '/create', [OrderController::class, 'create'])->name('orderCreate');

    Route::post('/premium', [PersonalCabinetController::class, 'premium'])->name('premium');




//======================================================================================================================

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

        //------------------------------Тест сессии---------------------------------------------------------------------

        Route::get('/session', [UserController::class, 'session'])->name('usersSession');

        Route::get('/sessionAbout', [UserController::class, 'sessionAbout'])->name('usersSessionAbout');

        //--------------------------------------------------------------------------------------------------------------
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

        Route::post('/create', [LibraryController::class, 'create'])->name('libraryCreate');

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

//    =======================================================Books======================================================

    Route::prefix('books')->group(function (){

        Route::get('/', [bookController::class, 'view'])->name('books');

        Route::get('/create', [bookController::class, 'create'])->name('bookCreate');

        Route::match(['get', 'post'],'/store', [bookController::class, 'store'])->name('bookStore');

        Route::get('/edit/{book}', [bookController::class, 'edit'])->name('bookEdit');

        Route::post('/update/{book}', [bookController::class, 'update'])->name('bookUpdate');

        Route::get('/delete/{book}', [bookController::class, 'delete'])->name('bookDelete');

        Route::get('/filter', [bookController::class, 'selection'])->name('bookFilters');

        Route::match(['get', 'post'],'/filterBooks', [bookController::class, 'filterBooks'])->name('filterBooks');
    });

    //===============================================Personal cabinet===================================================

    Route::prefix('personalCabinet')->group(function (){

    Route::any('/', [PersonalCabinetController::class, 'view'])->name('personalCabinet');

    Route::get('/allow/{comment}', [PersonalCabinetController::class, 'allow'])->name('personalCabinetAllow');

    Route::get('/edit/{comment}', [PersonalCabinetController::class, 'edit'])->middleware('can:edit,comment')
        ->name('personalCabinetEdit');

    Route::post('/update/{comment}', [PersonalCabinetController::class, 'update'])->name('personalCabinetUpdate');

    Route::get('/delete/{comment}', [PersonalCabinetController::class, 'delete'])->middleware('can:delete,comment')
        ->name('personalCabinetDelete');


    });

    //=================================================Images===========================================================
    Route::prefix('images')->group(function (){

        Route::get('/delete/{image}', [ImageController::class, 'delete'])->name('imageDelete');

        Route::get('/deleteByUser/{image}', [ImageController::class, 'deleteByUser'])->name('imageDeleteByUser');

    });

    //===============================================Orders=============================================================

    Route::prefix('orders')->group(function (){

        Route::match(['get','post'], '/', [OrderController::class, 'view'])->name('orders');

//        Route::match(['get','post'], '/create', [OrderController::class, 'create'])->name('orderCreate');

        Route::match(['get','post'], '/createMultiple', [OrderController::class, 'createMultiple'])->name('orderCreateMultiple');

        Route::match(['get','post'], '/order/{order}', [OrderController::class, 'order'])->name('order');

        Route::match(['get','post'], '/edit/{order}', [OrderController::class, 'edit'])->middleware('status')->name('orderEdit');

        Route::match(['get','post'], '/update/{order}', [OrderController::class, 'update'])->middleware('orderUpdateStatus')->name('orderUpdate');

        Route::match(['get','post'], '/delete', [OrderController::class, 'delete'])->name('orderDelete');

        Route::match(['get','post'], '/changeQuantityBookOrder', [OrderController::class, 'changeQuantityBookOrder'])->name('orderChangeQuantityBookOrder');

        Route::match(['get','post'], '/deleteBookOrder', [OrderController::class, 'deleteBookOrder'])->name('orderDeleteBookOrder');

    });

    Route::prefix('genres')->group(function (){

        Route::resource('genres', GenreController::class);

    });

    Route::prefix('selection')->group(function (){

        Route::get('/index', [SelectionController::class, 'index'])->name('selections');

        Route::get('/create', [SelectionController::class, 'create'])->name('selection.create');

        Route::match(['get','post'], '/store', [SelectionController::class, 'store'])->name('selection.store');

        Route::get('show', [SelectionController::class, 'show'])->name('bookSelection.show');

        Route::match(['get', 'post'],'/edit/{selection}', [SelectionController::class, 'edit'])->name('selection.edit');

        Route::match(['get', 'post'],'/update/{selection}', [SelectionController::class, 'update'])->name('selection.update');

        Route::match(['get', 'post'],'/destroy/{selection}', [SelectionController::class, 'destroy'])->name('selection.destroy');



    });

    Route::prefix('listOfSubscribes')->group(function (){

        Route::get('/', [ListOfSubscribeController::class, 'index'])->name('listOfSubscribes');

        Route::get('/create', [ListOfSubscribeController::class, 'create'])->name('listOfSubscribe.create');

        Route::post('/store', [ListOfSubscribeController::class, 'store'])->name('listOfSubscribe.store');

        Route::get('/edit/{listOfSubscribe}', [ListOfSubscribeController::class, 'edit'])->name('listOfSubscribe.edit');

        Route::post('/update/{listOfSubscribe}', [ListOfSubscribeController::class, 'update'])->name('listOfSubscribe.update');

        Route::get('/destroy{listOfSubscribe}', [ListOfSubscribeController::class, 'destroy'])->name('listOfSubscribe.destroy');


    });

});




