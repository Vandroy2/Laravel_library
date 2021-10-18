<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Delivery;
use App\Models\Office;
use App\Models\Order;
use App\Models\Status;
use App\Models\Ukrcity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function view()
    {
        $orders = Order::all();

        return view('layouts.admin.orders', ['orders'=>$orders]);
    }


    public function create(Request $request): RedirectResponse
    {
        $order = new Order();

        $order->delivery_id = $request->get('delivery_name');
        $order->ukrcity_id = $request->get('ukrcity_name');
        $order->office_id = $request->get('office_number');


        if ($order->delivery_id === 'Служба доставки' || $order->ukrcity_id ==='Город'|| $order->office_id ==='Отделение'){
            return redirect()->back()->with('errors', 'Выберите необходимые пареметры для оформления заказа');
        }

        $order->fill($request->all());

        $book_id = $order->book_id;

        $bookOrder = Book::query()
            ->where('id', '=', $book_id)->first();

        if ($bookOrder->books_number == 0){

            return redirect()->back()->with('errors', 'Количество книг в заказе не может быть меньше 1');
        }

        $order->save();

        return redirect()->back()->with('success', 'Заказ успешно отправлен. Мы свяжемся с Вами в ближайшее время.');

    }

    public function order(Order $order)
    {
        $orders = Order::all();

        $status_id = $order->status_id;

        $book_id = $order->book_id;

        $delivery_id = $order->delivery_id;

        $ukrcity_id = $order->ukrcity_id;

        $office_id = $order->office_id;

        $bookOrder = Book::query()
            ->where('id', '=', $book_id)
        ->first();

        $delivery  = Delivery::query()
            ->where('id', '=', $delivery_id)
            ->first();
        $ukrcity  = Ukrcity::query()
            ->where('id', '=', $ukrcity_id)
            ->first();

        $office  = Office::query()
            ->where('id', '=', $office_id)
            ->first();
        $book  = Book::query()
            ->where('id', '=', $book_id)
            ->first();

        $status  = Status::query()
            ->where('id', '=', $status_id)
            ->first();

        $deliveries = Delivery::all();

        return view('layouts.admin.order', [
            'orders'=>$orders,
            'order'=>$order,
            'bookOrder'=>$bookOrder,
            'delivery' =>$delivery,
            'ukrcity' =>$ukrcity,
            'office' =>$office,
            'book' =>$book,
            'deliveries'=>$deliveries,
            'status'=>$status,

        ]);
    }

    public function edit(Order $order)
    {
        if ($order->status->status == 'allowed'){
            return redirect()->back()->with('errors', 'Заказ уже отправлен. Вы не можете его отредактировать');
        }

        if ($order->status->status == 'canceled'){
            return redirect()->back()->with('errors', 'Заказ был отменен. Вы не можете его отредактировать');
        }


        $deliveries = Delivery::all();
        $offices = Office::all();
        $books = Book::all();
        $ukrcities = Ukrcity::all();
        $status = Status::all();
        $book_id = $order->book_id;
        $bookOrder = Book::query()
            ->where('id', '=', $book_id)->first();

        $status_id = $order->status_id;

        $delivery_id = $order->delivery_id;

        $ukrcity_id = $order->ukrcity_id;

        $office_id = $order->office_id;

        $deliveryOrder  = Delivery::query()
            ->where('id', '=', $delivery_id)
            ->first();
        $ukrcityOrder  = Ukrcity::query()
            ->where('id', '=', $ukrcity_id)
            ->first();

        $officeOrder  = Office::query()
            ->where('id', '=', $office_id)
            ->first();


        $statusOrder  = Status::query()
            ->where('id', '=', $status_id)
            ->first();




        return view('layouts.admin.order_edit', [
            'order'=>$order,
            'deliveries'=>$deliveries,
            'offices' => $offices,
            'books' => $books,
            'ukrcities'=> $ukrcities,
            'status'=>$status,
            'bookOrder'=>$bookOrder,
            'deliveryOrder'=>$deliveryOrder,
            'ukrcityOrder'=>$ukrcityOrder,
            'officeOrder'=>$officeOrder,
            'statusOrder'=>$statusOrder,


        ]);
    }

    public function update(Request $request, Order $order): RedirectResponse
    {

        $status_name = $request->get('status');

        $status = Status::query()
            ->where('status', '=', $status_name)->first();

        $order->status_id = $status->id;

        $order->fill($request->all());

        $order->save();

        $book_id = $order->book_id;

        $bookOrder = Book::query()
            ->where('id', '=', $book_id)
            ->first();

        if($status->status == 'allowed'){
            if ($bookOrder->books_limit >= $bookOrder->books_number) {
                $bookOrder->books_limit -= $bookOrder->books_number;
                $bookOrder->books_number = 0;
                $bookOrder->save();
            }
        }

        if ($status->status == 'canceled'){
            $bookOrder->books_number = 0;

            return redirect()->route('admin.orders')->with('success', 'заказ был отменен');
        }



        return redirect()->route('admin.orders', ['order'=>$order])->with('success', 'заказ успешно отредактирован');
    }

    public function delete(Order $order): RedirectResponse
    {
        $order->delete();

        return redirect()->route('admin.orders')->with('success', 'Заказ удален');
    }


}
