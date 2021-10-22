<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Delivery;
use App\Models\Office;
use App\Models\Ukrcity;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{


    public function bookOrder(Request $request, Book $book)
    {
        $quantity = $request->get('quantity');

        $delivery_id = $request->get('delivery_id');

        $books = Book::all();

        $deliveries = Delivery::query()
            ->with('offices')->get();

        $ukrcities = Ukrcity::all();

        $offices = Office::query()
            ->when(!empty($delivery_id), function ($query) use ($delivery_id) {
                return $query->where('delivery_id', '=', $delivery_id);
            })
            ->get();

        if ($book->books_number > 0 && $quantity < 0) {
            $book->books_number += $quantity;
            $book->books_limit -=$quantity;

            $book->save();
        }


        if ($quantity > 0) {
            if ($book->books_limit > 0){

                $book->books_number += $quantity;
                $book->books_limit -= $quantity;

            $book->save();
        }
        }

        if (\Illuminate\Support\Facades\Request::ajax()) {

            return response()->json([


                'bookOrder' => $book,
                'books' => $books,
                'deliveries' => $deliveries,
                'ukrcities' => $ukrcities,
                'offices' => $offices,
            ]);
        }
        else {
            return view('book_order', [
                'bookOrder' => $book,
                'books' => $books,
                'deliveries' => $deliveries,
                'ukrcities' => $ukrcities,
                'offices' => $offices,
            ]);
        }
    }
}








