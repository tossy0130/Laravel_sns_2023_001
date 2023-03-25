<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// === Model 読み込み
use App\Models\Like;
use App\Models\Post;

use Laravel\Ui\Presets\React;

// === Auth 読み込み
use Illuminate\Support\Facades\Auth;
// === Validator 読み込み
use Illuminate\Support\Facades\Validator;

class LikesController extends Controller
{
    // === コンストラクタ　（このクラスが呼ばれると、最初に処理する）
    public function __construct()
    {
        // ====== ログインしていなかったら、ログインページへ遷移させる。
        $this->middleware('auth');
    }

    public function store(Request $request)
    {

        // === LIKEモデル作成
        $like = new Like;
        $like->post_id = $request->post_id;
        $like->user_id = Auth::user()->id;

        $like->save();

        // === ルートへリダイレクト
        return redirect('/');
    }

    public function destroy(Request $request)
    {
        $like = Like::find($request->like_id);
        $like->delete();

        return redirect('/');
    }
}
