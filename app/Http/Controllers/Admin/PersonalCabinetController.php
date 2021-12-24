<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class PersonalCabinetController extends Controller
{
    public function view(){

        $commentsNotPublished= Comment::query()
            ->whereNull('published')->get();

        $commentPublished = Comment::query()
            ->where('published', '=', '1')->get();

        return view('layouts.admin.personalCabinet', ['commentsNotPublished'=>$commentsNotPublished, 'commentPublished'=>$commentPublished]);
    }

    public function allow(Comment $comment): RedirectResponse
    {

        $comment->published = '1';

        $comment->save();

        return redirect()->route('admin.personalCabinet')->with('success', 'отправка комментария одобрена');
    }

    public function edit(Comment $comment){

        return view('layouts.comments.comment_edit',compact('comment'));
    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {

        $comment->fill($request->all());
        $comment->save();

        return redirect()->route('admin.personalCabinet', compact('comment'));
    }

    public function delete(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('admin.personalCabinet')->with('success', 'отзыв удален');

    }
}



