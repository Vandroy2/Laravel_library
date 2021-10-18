<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Delivery;
use App\Models\Office;
use App\Models\Ukrcity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{


    public function bookOrder(Request $request, Book $book)
    {


        $delivery_id = $request->get('delivery_id');




        $books = Book::all();
        $deliveries = Delivery::query()
        ->with('offices')->get();
        $ukrcities = Ukrcity::all();
        $offices = Office::query()
            ->when(!empty($delivery_id ), function ($query) use($delivery_id) {
                return $query->where('delivery_id', '=', $delivery_id);
        })
            ->get();


        if (\Illuminate\Support\Facades\Request::ajax()) {

            return response()->json([

                'bookOrder'=>$book,
                'books' =>$books,
                'deliveries'=>$deliveries,
                'ukrcities'=>$ukrcities,
                'offices'=>$offices,
            ]);
        }
        else {
            return view('book_order', [
                'bookOrder'=>$book,
                'books' =>$books,
                'deliveries'=>$deliveries,
                'ukrcities'=>$ukrcities,
                'offices'=>$offices,
            ]);
        }


    }

    public function incNumber(Book $bookOrder): \Illuminate\Http\JsonResponse
    {

        if ($bookOrder->books_number < $bookOrder->books_limit)
        {
            $bookOrder->books_number += 1;

            $bookOrder->save();

            return response()->json([
                'book'=>$bookOrder
            ]);
        }

        return response()->json([
            'book'=>$bookOrder
        ]);
    }

    public function decNumber(Book $bookOrder): \Illuminate\Http\JsonResponse
    {
        if ($bookOrder->books_number > 0) {
            $bookOrder->books_number -= 1;

            $bookOrder->save();

            return response()->json([
                'bookOrder'=>$bookOrder
            ]);
        }
        return response()->json([
            'book'=>$bookOrder
        ]);
    }
}
