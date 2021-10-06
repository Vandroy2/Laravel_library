<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CabinetController extends Controller
{
    public function view(){

        $commentsNotPublished= Comment::query()
            ->where('published','=', null)
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        $commentPublished = Comment::query()
            ->where('published', '=', '1')
            ->where('user_id', '=', Auth::user()->id)
            ->get();

        return view('personalCabinetComments', ['commentsNotPublished'=>$commentsNotPublished, 'commentPublished'=>$commentPublished]);
    }
}
