<?php

namespace App\Helpers;

class BookHelper
{
        public static function storeFile($request, $book)
{
    $bookFile = $request->file('file');

    if ($request->get('type') == 'pdf')
    {
        $book->file = $bookFile->store('pdf', 'public');
    }

    if ($request->get('type') == 'audio')
    {
        $book->file = $bookFile->store('audio', 'public');
    }
}
}
