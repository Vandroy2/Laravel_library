<?php

namespace App\Http\Controllers;

use App\Models\Comment;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



class CommentController extends Controller
{
    public function view(){

        $comments = Comment::query()

        ->where('published', '=', 1)->get();

        return view('site.index', compact('comments'));
    }



    public function store(Request $request): RedirectResponse
    {
        $comment = new Comment();

        $comment->fill($request->all());

        $comment->user_id = Auth::user()->id;

        if (Comment::query()
            ->where('user_id', Auth::user()->id)->exists())
        {
            return redirect()->route('main')->with('errors', 'Вы уже оставляли отзыв');
        }

          $comment->save();
          return redirect()->route('main', ['comment'=>$comment])->with('success', 'Спасибо за Ваш отзыв.После модерации он появится на сайте');
    }

    /**
     * @throws AuthorizationException
     */
    public function edit(Comment $comment){

        $this->authorize('edit',[self::class, $comment]);

        return view('admin.cabinet.comment_edit', [
            'comment'=>$comment,
        ]);

    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $comment->fill($request->all());

        $comment->save();

        return redirect()->route('main', ['comment'=>$comment])->with('success', 'Комментарий отредактирован');
    }

    public function delete(Comment $comment)
    {
        $comment->delete();

        $comments = Comment::all();

        return view('layouts.admin.personalCabinet', ['comments'=>$comments]);
    }
}
