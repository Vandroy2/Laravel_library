<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Cart;
use App\Http\Controllers\Controller;
use App\Http\Requests\OrderFormRequest;
use App\Models\Book;
use App\Models\Book_Order;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Office;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
//================================================Все заказы============================================================
    public function view()
    {
        $orders = Order::all();

        $multipleOrder = Book_Order::all();

        return view('admin.orders.index', [
            'orders'=>$orders,
            'multipleOrder'=>$multipleOrder,

        ]);
    }
//================================================Создание заказа=======================================================

    public function create(OrderFormRequest $request): RedirectResponse
    {

        /* @var Book $book */

        //------------------------------------Получение данных из реквеста-----------------------------------------------

        $order = new Order();

        $order->fill($request->all());

        $order->save();

        if (!Auth::check()){

            $email = $request->get('email');

            $existUser = User::query()->where('email', '=', $email)->first();

            if ($existUser)
            {
                /* @var User $existUser */

                $order->user_id = $existUser ->id;
            }
            else{
                $user = new User();

                $user->fill($request->all());

                $user->save();

                $order->user_id = $user->id;
            }
            $order->save();
        }

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $cartBooks = $cartBooks->map(function($book) use($cartBooksArr) {

            $book->books_number = Arr::get(Arr::get($cartBooksArr, $book->id, []), 'count');

            return $book;
        });

        //---------------------------------------Проверка на пустой заказ-----------------------------------------------

        foreach ($cartBooks as $book){

            if ($book->books_number == 0){

                return redirect()->route('onlineLibrary')->with('errors', 'количество книг не может быть меньше 1');
            }
            else
        {
            $multipleOrder = new Book_Order();

            $multipleOrder->book_number = $cartBooksArr[$book->id]['count'];

            $multipleOrder->book_id = $book->id;

            $multipleOrder->order_id = $order->id;

            $multipleOrder->save();

            $book->books_limit -= $cartBooksArr[$book->id]['count'];

            $book->books_number = 0;

            $book->save();
        }
        }

        Cart::clearCart($request);

        return redirect()->route('onlineLibrary')->with('success', 'Ваш заказ успешно отправлен. Мы свяжемся с вами в ближайшее время');
    }

//===========================================Отображение выбранного заказа==============================================

    public function order(Order $order)
    {

        $multipleOrder = Book_Order::query()
            ->where('order_id', $order->id)->get();

        $book_id = Book_Order::query()->pluck('book_id');

        $books = Book::query()->find($book_id);

        return view('admin.orders.order', [
            'order'=>$order,
            'multipleOrder'=>$multipleOrder,
            'books'=>$books,
        ]);
    }

//===============================================Редактирование заказа==================================================

    public function edit(Order $order)
    {
    //----------------------------------------Получение данных для редактирования заказа-------------------------------

        $deliveries = Delivery::all();

        $offices = Office::all();

        $books = Book::all();

        $cities = City::all();

        $status = Status::all();

        //-------------------------------------Передача данных----------------------------------------------------------

        if (\Illuminate\Support\Facades\Request::ajax()) {

            return response()->json([

                'order'=>$order,
                'deliveries'=>$deliveries,
                'offices' => $offices,
                'books' => $books,
                'cities'=> $cities,
                'status'=>$status,
            ]);
        }
        return view('admin.orders.edit', [
            'order'=>$order,
            'deliveries'=>$deliveries,
            'offices' => $offices,
            'books' => $books,
            'cities'=> $cities,
            'status'=>$status,

        ]);
    }

//=====================================================Обновление заказа================================================

    /**
     * @param Request $request
     * @param Order $order
     * @return RedirectResponse
     */
    public function update(Request $request, Order $order): RedirectResponse
    {
        //---------------------------------Получение данных из реквеста и сохранение заказа-----------------------------

        if ($order->orderBooks->isEmpty()){
            $order->delete();
        }

        foreach ($request->get('books') as $book){

            if($book['book_number'] == 0){
               return redirect()->back()->with('errors', 'количество книг в заказе не может быть меньше 1');
           }

        }
        $editedOrderBooks = collect($request->get('books', []))->keyBy(function($orderBook) {
            return Arr::get($orderBook, 'book_id');
        });

        $existsOrderBooks = $order->orderBooks->keyBy('book_id');

        //------------------------------------------- add---------------------------------------------------------------
        $newOrderBooks = $editedOrderBooks->diffKeys($existsOrderBooks);

        //------------------------------------------- delete------------------------------------------------------------
        $deletedOrderBooks = $existsOrderBooks->diffKeys($editedOrderBooks);


        $deletedOrderBooks->each(function($orderBook) {
            /* @var Book_Order $orderBook */

            $book = Book::query()->where('id', '=', $orderBook->book_id)->first();

            /* @var Book $book */

            $book->books_limit += $orderBook->book_number;

            $book->save();

            $orderBook->delete();
        });

        //--------------------Создание нового заказа с измененными книгами----------------------------------------------

        $newOrderBooks->each(function ($item) use($order) {

            $order->orderBooks()->save(
                new Book_Order(
                    [
                        'book_id' => Arr::get($item, 'book_id'),
                        'book_number' => Arr::get($item, 'book_number'),
                    ]
                )
            );

            $book = Book::query()
                ->where('id', '=', $item['book_id'])->first();

            /* @var Book $book */

            $book->books_limit =  $item['books_limit'];

            $book->save();

        });

        //-------------------------Синхронизация остатков книги при Ajax запросе----------------------------------------

        foreach ($editedOrderBooks as $editedOrderBook){

            $book = Book::query()
                ->where('id', '=', $editedOrderBook['book_id'])->first();

            /* @var Book $book */

            $book->books_limit =  $editedOrderBook['books_limit'];

            $book->save();
        }

        //------------------------------Обработка измененного количества книг-------------------------------------------

        foreach ($existsOrderBooks as $bookId => $existsOrderBook){

            if (!Arr::has($editedOrderBooks, $bookId)){
                continue;
            }
            $existsOrderBook->book_number = $editedOrderBooks->get($bookId)['book_number'];

            $existsOrderBook->save();
        }

        $order->fill($request->all());

        $order->save();

        //------------------------------Проверка на статус заказа и редактирование количества книг----------------------

        if ($order->status->status == 'canceled'){

            foreach ($editedOrderBooks as $editedOrderBook){

                $book = Book::query()
                    ->where('id', '=', $editedOrderBook['book_id'])->first();

                /* @var Book $book */

                $book->books_limit +=  $editedOrderBook['book_number'];

                $book->save();
            }

            return redirect()->route('admin.orders')->with('success', 'заказ был отменен');
        }

        //-----------------------------------Регистрация продажи книги--------------------------------------------------

        if ($order->status->status == 'allowed'){

            foreach ($editedOrderBooks as $editedOrderBook){

                $book = Book::query()
                    ->where('id', '=', $editedOrderBook['book_id'])->first();

                $bookOrder = Book_Order::query()
                    ->where('order_id', '=', $order->id)
                    ->where('book_id', '=', $book->id)->first();

                /* @var Book $book */

                $sale = Sale::query()->where('book_id','=', $book->id)->first();

                if($sale)
                {
                    $sale->count += $bookOrder->book_number;

                    $sale->save();
                }
                else{
                    $newSale = Sale::create(
                        [
                            'count' => $bookOrder->book_number,
                            'order_id' => $order->id,
                            'book_id' => $book->id,
                        ]);

                    $newSale->save();
                }
            }
        }
            return redirect()->route('admin.orders', ['order'=>$order])->with('success', 'заказ успешно отредактирован');
    }

    //-------------------------------------------Удаление заказа--------------------------------------------------------

    public function delete(Request $request): RedirectResponse
    {
        /**
         * @var Book $book
         * @var Order $order
         */

        $order_id = $request->get('order_id');

        $books_id = $request->get('books_id');

        $order = Order::query()->find($order_id);

        $books = Book::query()->whereIn('id', $books_id)->get();

        $multipleOrders = Book_Order::query()
            ->where('order_id', $order->id)->get();

        if($order->status->status != "allowed" && $order->status->status != "canceled") {

            foreach ($multipleOrders as $multipleOrder) {

                $book = Book::query()->find($multipleOrder->book_id);

                $book->books_limit += $multipleOrder->book_number;

                $book->save();
        }
        }

        foreach ($books as $book) {
            $order->books()->detach($book);
        }

        //----------------------------Удаление пользователя-------------------------------------------------------------
//        $user = User::query()->where('id', '=', $order->user_id)->first();
//
//        /* @var User $user */

//        $user_id = Order::query()->pluck('user_id')->toArray();
//
//        if (!$user->birthday && count(array_keys($user_id, $user->id)) <= 1){
//
//            $user->delete();
//        }
        //--------------------------------------------------------------------------------------------------------------

        $order->delete();



        return redirect()->route('admin.orders')->with('success', 'Заказ удален');

    }

//=========================================Изменение количества книг в заказе===========================================

    public function changeQuantityBookOrder(Request $request): JsonResponse
    {
        /**
         * @var Book $book
         *
         * @var Book_Order $multipleOrder
         */

        $quantity = $request->get('quantity');

        $book_id = $request->get('book_id');

        $order_id = $request->get('order_id');


        $multipleOrder = Book_Order::query()
            ->where('order_id', '=', $order_id)
            ->where('book_id', '=', $book_id)->first();

        $book = Book::query()->find($book_id);

        if ($multipleOrder->book_number > 1 && $quantity < 0) {

            $multipleOrder->book_number += $quantity;

            $book->books_limit -=$quantity;

            $book->save();

            $multipleOrder->save();
        }

        if ($quantity > 0) {

            if ($book->books_limit > 0){

                $multipleOrder->book_number += $quantity;

                $book->books_limit -= $quantity;

                $book->save();

                $multipleOrder->save();
            }
        }

        return response()->json(['bookOrder'=>$book, 'multipleOrder'=>$multipleOrder]);
    }

    public function deleteBookOrder(Request $request): JsonResponse
    {
        /* @var Book_Order $multipleOrder
         * @var Book $book
         * @var Order $order
         */

        $delete_book_id = $request->get('delete_book_id');

        $order_id = $request->get('order_id');

        $book_number = $request->get('book_number');

        $multipleOrder = Book_Order::query()
            ->where('order_id', '=', $order_id)
            ->where('book_id', '=', $delete_book_id)->first();

        $book = Book::query()->find($delete_book_id);

        $book->books_limit += $book_number;

        $book->save();

        $multipleOrder->delete();

        return response()->json(['status'=>'success']);
    }

}
