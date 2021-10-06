<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function delete(Image $image): RedirectResponse
    {
        $id = $image->book_id;

        $book = Book::query()
            ->where('id', '=', "$id")->first();

        $image->delete();

        return redirect()->route('admin.bookEdit', compact('book'));
    }

    public function deleteByUser(Image $image): RedirectResponse
    {
        $id = $image->user_id;

        $user = User::query()
            ->where('id', '=', "$id")->first();

        $image->delete();

        return redirect()->route('admin.userEdit', compact('user'));
    }


}
