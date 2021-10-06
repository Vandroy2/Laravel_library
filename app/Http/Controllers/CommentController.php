<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use http\Env\Response;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function view(){


        $comments = Comment::query()

        ->where('published', '=', '1')->get();

        return view('index', compact('comments'));
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

        return view('layouts.comments.comment_edit', [
            'comment'=>$comment,
        ]);

    }

    public function update(Request $request, Comment $comment): RedirectResponse
    {
        $comment->fill($request->all());

        $comment->save();

        return redirect()->route('main', ['comment'=>$comment])->with('success', 'Комментарий отредактирован');
    }

    /**
     * @param Comment $comment
     * @return \Illuminate\Http\Response
     */
    public function delete(Comment $comment): \Illuminate\Http\Response
    {
//        $this->authorize('delete',[self::class, $comment]);

        $comment->delete();

        $comments = Comment::all();

        return response()->view('layouts.admin.personalCabinet', ['comments'=>$comments]);
    }
}
