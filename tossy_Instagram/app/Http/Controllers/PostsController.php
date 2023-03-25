<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// === Post model読み込み
use App\Models\Post;
use App\Models\Like;

// === Auth 読み込み
use Illuminate\Support\Facades\Auth;
// === Validator 読み込み
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class PostsController extends Controller
{

    //コンストラクタ （このクラスが呼ばれると最初にこの処理をする）
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する（この処理を消すとログインしなくてもページを表示する）
        $this->middleware('auth');
    }

    public function index()
    {

        // === 10件　取得  created降降順_at の降順
        $posts = Post::limit(10)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('post.index', ['posts' => $posts]);
    }

    /*
    *  投稿新規 表示
    */
    public function new()
    {
        return view('post.new');
    }

    /*
    *  投稿新規　処理
    */
    public function store(Request $request)
    {
        // バリデーション（入力チェック）
        $validator = Validator::make($request->all(), [
            'caption' => 'required|max:255',
            'photo' => 'required'
        ]);

        // バリデーションの結果チェック
        if ($validator->fails()) {

            // === 入力値の値を保持したまま前の画面に戻る
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Post モデルの作成
        $post = new Post;
        $post->caption = $request->caption;
        $post->user_id = Auth::user()->id;

        $post->save();

        $request->photo->storeAs('public/post_images', $post->id . '.jpg');

        return redirect('/');
    }

    /**
     * 　投稿削除　処理
     */
    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();

        return redirect('/');
    }
}
