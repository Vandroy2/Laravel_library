<?php

namespace App\Http\Controllers\Admin;

use App\Models\Comment;
use App\Models\User;
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

        return view('admin.cabinet.index', ['commentsNotPublished'=>$commentsNotPublished, 'commentPublished'=>$commentPublished]);
    }

    public function allow(Comment $comment): RedirectResponse
    {

        $comment->published = '1';

        $comment->save();

        return redirect()->route('admin.personalCabinet')->with('success', 'отправка комментария одобрена');
    }

    public function edit(Comment $comment){

        return view('admin.cabinet.comment_edit',compact('comment'));
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

    public function premium(Request $request)
    {
        $id = $request->get('user_id');

        $user = User::query()->findOrFail($id);

        $user->premium = 1;

        $user->save();

        return redirect(route('main'))->with('success', 'Премиум подписка успешно оформлена');
    }
}



