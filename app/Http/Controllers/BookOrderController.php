<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\City;
use App\Models\Delivery;
use App\Models\Office;
use App\Models\Ukrcity;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{


//    public function bookOrder(Request $request, Book $book)
//    {
//
//
//        $delivery_id = $request->get('delivery_id');
//
////        $books = Book::all();
//
//        $deliveries = Delivery::query()
//            ->with('offices')->get();
//
//        $ukrcities = Ukrcity::all();
//
//        $offices = Office::query()
//            ->when(!empty($delivery_id), function ($query) use ($delivery_id) {
//                return $query->where('delivery_id', '=', $delivery_id);
//            })
//            ->get();
//
//
//
//        if (\Illuminate\Support\Facades\Request::ajax()) {
//
//            return response()->json([
//
//
//                'bookOrder' => $book,
////                'books' => $books,
//                'deliveries' => $deliveries,
//                'ukrcities' => $ukrcities,
//                'offices' => $offices,
//            ]);
//        }
//        else {
//            return view('book_order', [
//                'bookOrder' => $book,
////                'books' => $books,
//                'deliveries' => $deliveries,
//                'ukrcities' => $ukrcities,
//                'offices' => $offices,
//            ]);
//        }
//    }


//    public function booksMultipleOrder(Request $request)
//    {
//
//
//        $booksInBasket_id = $request->get('booksInBasket');
//
////        if (!empty($booksInBasket_id)){
//
//        $booksInBasket = Book::query()
//            ->whereIn('id', $booksInBasket_id)->get();
//
//        $deliveries = Delivery::all();
//        $cities = City::all();
//        $offices = Office::all();
//
//        return view('multiple_book_order', [
//            'booksOrder'=>$booksInBasket,
//            'deliveries'=> $deliveries ,
//            'cities'=>$cities ,
//            'offices'=>$offices,
//        ]);
//    }



//    }

}








