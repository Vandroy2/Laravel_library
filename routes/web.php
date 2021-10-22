<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BookOrderController;
use App\Http\Controllers\CabinetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OnlineLibraryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [commentController::class, 'view'])->name('main');

Route::post('/registration', [LoginController::class, 'registration'])->name('registration');

Route::post('/auth', [LoginController::class, 'auth'])->name('auth');

Route::get('/reg', function () {
   return view('registration');
})->name('reg');

Route::middleware('auth')->group(function (){

    Route::get('/personalComments', [CabinetController::class, 'view'])->name('personalCabinetComments');

    Route::get('/personal', function (){
        return view('personalCabinet');})->name('personalCabinet');

    Route::match(['post', 'get'], '/orders', [CabinetController::class, 'orders'])->name('personalCabinetOrders');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

//    =======================================================Publications==========================================================

Route::prefix('comments')->group(function (){

    Route::post('/', [commentController::class, 'view'])->name('comments');

    Route::post('/store', [commentController::class, 'store'])->name('commentStore');



});

Route::prefix('olineLibrary')->group(function (){

    Route::match(['get', 'post'], '/', [OnlineLibraryController::class, 'view'])->name('onlineLibrary');

    Route::match(['get', 'post'], '/favorite/{book}', [OnlineLibraryController::class, 'addToFavorite'])->name('onLineLibraryAddToFavorite');

    Route::match(['get', 'post'], '/favoritePersonal/{book}', [OnlineLibraryController::class, 'addToFavoritePersonal'])->name('onLineLibraryAddToFavoritePersonal');

    Route::get('/favoriteBooks', [OnlineLibraryController::class, 'favoriteBooks'])->name('onLineLibraryFavoritesBooks');
});

Route::prefix('bookOrder')->group(function (){

Route::match(['get','post'], '/{book}', [BookOrderController::class, 'bookOrder'])->name('bookOrder');

//Route::match(['get','post'], '/changeQuantity/{bookOrder}', [BookOrderController::class, 'changeQuantity'])->name('bookChangeQuantity');

//Route::match(['get','post'], '/incNumber/{bookOrder}', [BookOrderController::class, 'incNumber'])->name('bookOrderincNumber');
//
//Route::match(['get','post'], '/decNumber/{bookOrder}', [BookOrderController::class, 'decNumber'])->name('bookOrderdecNumber');


});

});





