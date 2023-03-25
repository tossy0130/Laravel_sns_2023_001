<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// === モデル読み込み
use App\Models\Post;
use App\Models\Comment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     *  コメント 保存
     */
    public function store(Request $request)
    {
        // Comment モデル作成
        $comment = new Comment;
        $comment->comment = $request->comment;
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::user()->id;

        $comment->save();

        return redirect('/');
    }

    /**
     *  コメント　削除
     */
    public function destroy(Request $request)
    {
        $comment = Comment::find($request->comment_id);
        $comment->delete();

        return redirect('/');
    }
}
