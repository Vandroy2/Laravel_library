<?php

namespace App\Helpers;

use App\Models\Book;
use Carbon\Carbon;
use Illuminate\Http\Request;


class Cart
{
        static function clearCart(Request $request){

        $cartBooksArr = $request->session()->get('cartBooks', []);

        $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

        $cartBooks->map(function ($cartBook) use ($cartBooksArr){

            $cartBook->books_limit += $cartBooksArr[$cartBook->id]['count'];

            $cartBook->save();

            $cartBooksArr[$cartBook->id]['count'] = 0;

            return $cartBook;

        });

        $request->session()->forget('cartBooks');

        }

        static function getOrderSum(Request $request)
        {
            $cartBooksArr = $request->session()->get('cartBooks', []);

            $cartBooks = Book::query()->whereIn('id', array_keys($cartBooksArr))->get();

            $sumOrder = 0;

            foreach ($cartBooks as $cartBook)
            {
                $sumOrder += $cartBook->price * $cartBooksArr[$cartBook->id]['count'];
            }

            return $sumOrder;
        }

        public static function getSelection($request, $selection)
        {
            $genreIdArr = $request->get('genre_id');

            $authorIdArr = $request->get('author_id');

            if ($genreIdArr){
                foreach ($genreIdArr  as $id ){
                    $selection->genres()->attach($id);
                }
            }

            if ($authorIdArr){

                foreach ($authorIdArr as $id){

                    $selection->authors()->attach($id);
                }
            }
            return $selection;
        }



        public static function bookFilter($selection)
        {

            $salesSort = $selection->sortBySales;

            $priceSort = $selection->sortByPrice;

            $query = Book::query()->with('author', 'images');

            $genreId=[];

            foreach ($selection->genres as $genre)
            {
                $genreId[]=$genre->id;
            }


            if ($selection->authors->isEmpty()) {

                $authorId = null;
            }
            else{

                $authorId=[];

                foreach ($selection->authors as $author)
                {
                    $authorId[]=$author->id;
                }
            }




            if($genreId && $genreId !='Жанр'){

                $query->whereIn('genre_id', $genreId);
            }

            if ($authorId && $authorId !='Автор'){

                $query->whereIn('author_id', $authorId);
            }

            if ($selection->priceParamLow)
            {
                $query->where('price', '>', $selection->priceParamLow);
            }

            if ($selection->priceParamHigh)
            {
                $query->where('price', '<', $selection->priceParamHigh);
            }


            if ($salesSort == 'sales_hi' && $salesSort != 'Популярность')

                $query->select('books.*')
                    ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
                    ->orderBy('sales.count', 'desc');

            if ($salesSort == 'sales_low' && $salesSort != 'Популярность')

                $query->select('books.*')
                    ->leftJoin('sales', 'books.id', '=', 'sales.book_id')
                    ->orderBy('sales.count', 'asc');

            if ($priceSort == 'price_hi' && $priceSort!= 'Цена')

                $query->orderBy('price', 'desc');

            if ($priceSort == 'price_low' && $priceSort != 'Цена')

                $query->orderBy('price');

            if ($selection->limit && $selection->limit != 'Not limited'){

                return $query->take($selection->limit)->get();
            }
            else{
                return $query->get();
            }

        }

        public static function getDate($request): string
        {

            if ($request->get('created_at')){
                return Carbon::createFromFormat('Y-m-d', $request->get('created_at'))->toDateTimeString();
            }

            return Carbon::now();

        }

}
