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

//       =====================Проверка на невыбранные поля==============================================================

        $delivery = $request->get('delivery_id');
        $ukrcity = $request->get('ukrcity_id');
        $office = $request->get('office_id');

        if ($delivery === 'delivery' || $ukrcity==='ukrcity'|| $office ==='office'){
            return redirect()->back()->with('errors', 'Выберите необходимые пареметры для оформления заказа');
        }

//        ==============================================================================================================

        $order->fill($request->all());

        $bookOrder = Book::query()
            ->where('id', '=', $order->book_id)->first();

//        =======================Проверка на пустой заказ===============================================================

        if ($bookOrder->books_number == 0){
            return redirect()->back()->with('errors', 'Количество книг в заказе не может быть меньше 1');
        }

//        ==============================================================================================================

        $order->save();

        return redirect()->back()->with('success', 'Заказ успешно отправлен. Мы свяжемся с Вами в ближайшее время.');

    }

    public function order(Order $order)
    {

        $book  = Book::query()
            ->where('id', '=', $order->book_id)
            ->first();

        return view('layouts.admin.order', [
            'order'=>$order,
            'book' =>$book,
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
        $bookOrder = Book::query()
            ->where('id', '=', $order->book_id)->first();


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

    public function update(Request $request, Order $order): RedirectResponse
    {

        $order->fill($request->all());

        $order->save();

        $bookOrder = Book::query()
            ->where('id', '=', $order->book_id)
            ->first();

        if($order->status->status == 'allowed'){
            if ($bookOrder->books_limit >= $bookOrder->books_number) {
                $bookOrder->books_limit -= $bookOrder->books_number;
                $bookOrder->books_number = 0;
                $bookOrder->save();
            }
        }

        if ($order->status->status == 'canceled'){
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
