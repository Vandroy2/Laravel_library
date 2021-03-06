<?php



use App\Http\Controllers\CabinetController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\OnlineLibraryController;
use App\Models\Comment;
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




Route::get('/', function () {return view('login'); })->name('login');

Route::get('/', [commentController::class, 'view'])->name('main');

Route::post('/registration', [LoginController::class, 'registration'])->name('registration');

Route::post('/auth', [LoginController::class, 'auth'])->name('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/reg', function () { return view('registration'); })->name('reg');



Route::prefix('olineLibrary')->group(function (){

    Route::match(['get', 'post'], '/', [OnlineLibraryController::class, 'view'])->name('onlineLibrary');

    Route::match(['get', 'post'], '/favorite/{book}', [OnlineLibraryController::class, 'addToFavorite'])->name('onLineLibraryAddToFavorite');

    Route::match(['get', 'post'], '/addToBasket', [OnlineLibraryController::class, 'addToBasket'])->name('onlineLibraryAddToBasket');

    Route::get('/toSubscribe', function (){

        $comments = Comment::query()->where('published', '=', 1)->get();

        return view('site.index', compact('comments'))->with('error', 'для оформления подписки нужно пройти авторизацию');

    })->name('toSubscribe');
});

Route::prefix('offices')->group(function (){

    Route::match(['get','post'], '/show', [OfficeController::class, 'show'])->name('officesShow');
});

Route::prefix('delivery')->group(function (){

    Route::match(['get', 'post'], '/', [DeliveryController::class, 'view'])->name('deliveries');
});




Route::middleware('auth')->group(function (){

    Route::prefix('cabinet')->group(function (){

        Route::get('/personal', [CabinetController::class, 'statistic'])->name('personalCabinet');

        Route::get('/personalComments', [CabinetController::class, 'view'])->name('personalCabinetComments');

        Route::match(['post', 'get'], '/orders', [CabinetController::class, 'orders'])->name('personalCabinetOrders');

        Route::get('/favoriteBooks', [CabinetController::class, 'favoriteBooks'])->name('onLineLibraryFavoritesBooks');

        Route::match(['get', 'post'], '/favoritePersonal/{book}', [CabinetController::class, 'addToFavoritePersonal'])->name('onLineLibraryAddToFavoritePersonal');

        Route::get('/purchasedBooks', [CabinetController::class, 'purchasedBooks'])->name('purchasedBooks');

        Route::post('/subscribeSale', [CabinetController::class, 'subscribeSale'])->name('subscribeSale');

        Route::get('/pdf/{book}', [CabinetController::class, 'pdfFile'])->name('pdfFile');

        Route::get('/subscribes', [CabinetController::class, 'subscribes'])->name('subscribes');

        Route::get('/payment/{listOfSubscribe}', [CabinetController::class,'payment'])->name('payment');

        Route::match(['GET', 'POST'],'/ajax', [CabinetController::class, 'markNotifications'])->name('markNotifications');

    });




//    =================================================================================================================

Route::prefix('comments')->group(function (){

    Route::post('/', [commentController::class, 'view'])->name('comments');

    Route::post('/store', [commentController::class, 'store'])->name('commentStore');

});

});





