<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @param $factory
     * @return void
     */
    public function run()
    {
        $books = Book::all();

        foreach ($books as $book){
            $book->update([
                'price'=>rand(100, 500)
            ]);
        }



    }
}
