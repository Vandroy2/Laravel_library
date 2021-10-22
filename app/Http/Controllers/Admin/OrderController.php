<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Delivery;
use App\Models\Office;
use App\Models\Order;
use App\Models\Status;
use App\Models\Ukrcity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;


class OrderController extends Controller
{

//================================================Все заказы============================================================
    public function view()
    {
        $orders = Order::all();

        return view('layouts.admin.orders', ['orders'=>$orders]);
    }

//================================================Создание заказа=======================================================

    public function create(Request $request): RedirectResponse
    {
        $order = new Order();

        // ---------------------------------Проверка на невыбранные поля--------------------------------------------------

        $delivery = $request->get('delivery_id');

        $ukrcity = $request->get('ukrcity_id');

        $office = $request->get('office_id');

        if ($delivery === 'delivery' || $ukrcity==='ukrcity'|| $office ==='office'|| $office === "Отделение"){

            return redirect()->back()->with('errors', 'Выберите необходимые пареметры для оформления заказа');
        }

      //------------------------------------Получение данных из реквеста-----------------------------------------------

        $order->fill($request->all());

        $bookOrder = Book::query()
            ->where('id', '=', $order->book_id)->first();

      //  -----------------------Проверка на количство книг и сохранение данных заказа----------------------------------

        if ($bookOrder->books_number == 0){

            return redirect()->back()->with('errors', 'Количество книг в заказе не может быть меньше 1');
        }
        $order->book_number = $bookOrder->books_number;

        $bookOrder->books_number = 0;

        $bookOrder->save();

        $order->save();

        return redirect()->back()->with('success', 'Заказ успешно отправлен. Мы свяжемся с Вами в ближайшее время.');
    }

//===========================================Отображение выбранного заказа==============================================

    public function order(Order $order)
    {
        $book  = Book::query()
            ->where('id', '=', $order->book_id)->first(); # если нужно будет добавить в заказ несколько разных книг, нужно передавать коллекцию(get)

        return view('layouts.admin.order', [
            'order'=>$order,
            'book' =>$book,
        ]);
    }

//===============================================Редактирование заказа==================================================

    public function edit(Request $request, Order $order)
    {
        //------------------------------------------Получение данных из Ajax запроса---------------------------------------

        $book_id = $request->get('book_id');

        $reset = $request->get('reset');

        $delivery_id = $request->get('delivery_id');



        //----------------------------------------Проверка статуса заказа-----------------------------------------------

        if ($order->status->status == 'allowed'){
            return redirect()->back()->with('errors', 'Заказ уже отправлен. Вы не можете его отредактировать');
        }

        if ($order->status->status == 'canceled'){
            return redirect()->back()->with('errors', 'Заказ был отменен. Вы не можете его отредактировать');
        }

        //--------------------------------Полученеие данных для редактирования заказа-----------------------------------

        $deliveries = Delivery::all();

        $offices = Office::query()
            ->when(!empty($delivery_id ), function ($query) use($delivery_id) {
                return $query->where('delivery_id', '=', $delivery_id);
            })->get();

        $books = Book::all();

        $ukrcities = Ukrcity::all();

        $status = Status::all();

        if ($book_id) {
            $bookOrder = Book::query()
                ->when(!empty($book_id ), function ($query) use($book_id) {
                    return $query->where('id', '=', $book_id);           # если нужно будет добавить в заказ несколько разных книг, нужно передавать коллекцию(get)
                })->first();
        }

        else {$bookOrder = Book::query()
            ->where('id', '=', $order->book_id)->first();} # если нужно будет добавить в заказ несколько разных книг, нужно передавать коллекцию(get)

        if ($reset){

            $book = Book::query()
                ->where('id', '=', $order->book_id)->first();

            $book->books_limit += $order->book_number;

            $book->save();

            $order->book_number = 0;

            $order->save();

            $reset = null;
        }

        //----------------------------------------Изменение количества при нажатии на кнопки----------------------------

        $quantity = $request->get('quantity');

        if ($order->book_number > 0 && $quantity < 0) {

            $order->book_number += $quantity;

            $bookOrder->books_limit -=$quantity;

            $bookOrder->save();

            $order->save();
        }

        if ($quantity > 0) {
            if ($bookOrder->books_limit > 0){

                $order->book_number += $quantity;

                $bookOrder->books_limit -= $quantity;

                $bookOrder->save();

                $order->save();
            }
        }

        //-------------------------------------Передача данных----------------------------------------------------------

        if (\Illuminate\Support\Facades\Request::ajax()) {

            return response()->json([

                'order'=>$order,
                'deliveries'=>$deliveries,
                'offices' => $offices,
                'books' => $books,
                'ukrcities'=> $ukrcities,
                'status'=>$status,
                'bookOrder'=>$bookOrder,

            ]);
        }

        return view('layouts.admin.order_edit', [
            'order'=>$order,
            'deliveries'=>$deliveries,
            'offices' => $offices,
            'books' => $books,
            'ukrcities'=> $ukrcities,
            'status'=>$status,
            'bookOrder'=>$bookOrder,
        ]);
    }

//=====================================================Обновление заказа================================================



    public function update(Request $request, Order $order): RedirectResponse
    {//---------------------------------Получение данных из реквеста и сохранение заказа-----------------------------

        $order->fill($request->all());

        $order->save();

        $bookOrder = Book::query()
            ->where('id', '=', $order->book_id)
            ->first();

        //------------------------------Проверка на статус заказа и редактирование количества книг----------------------

        if ($order->status->status == 'canceled'){
            $bookOrder->books_limit +=$order->book_number;

            $order->book_number = 0;

            $bookOrder->save();

            $order->save();

            return redirect()->route('admin.orders')->with('success', 'заказ был отменен');
        }

        if ($order->status->status == 'accepted'){

            return redirect()->route('admin.orders')
                ->with('success', 'Заказ принят. Для обработки перейдите на страницу редектирования');
        }

            return redirect()->route('admin.orders', ['order'=>$order])->with('success', 'заказ успешно отредактирован');
    }

    //-------------------------------------------Удаление заказа--------------------------------------------------------

    public function delete(Order $order): RedirectResponse
    {
        if($order->status->status != "allowed") {
            $bookOrder = Book::query()
                ->where('id', '=', $order->book_id)->first(); # если нужно будет добавить в заказ несколько разных книг, нужно передавать коллекцию(get)

            $bookOrder->books_limit += $order->book_number;

            $order->book_number = 0;

            $bookOrder->save();

            $order->save();
        }
            $order->delete();

            return redirect()->route('admin.orders')->with('success', 'Заказ удален');
    }
}
