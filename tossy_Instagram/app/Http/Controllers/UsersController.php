<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// === User model読み込み
use App\Models\User;

// === Auth 読み込み
use Illuminate\Support\Facades\Auth;

// === Validator 読み込み
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    //

    //=== 詳細画面 処理
    public function show($user_id)
    {
        // === $user_id に 一致するカラムを１件抽出 みつからなかった場合は　エラーを返す
        $user = User::where('id', $user_id)
            ->firstOrFail();

        return view('user.show', ['user' => $user]);
    }

    //===================== ユーザー変更処理 Start ====================
    //==== GET 編集表示
    public function edit()
    {
        $user = Auth::user();

        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request)
    {
        // バリデーション（入力値チェック）
        $validator = Validator::make($request->all(), [
            'user_name' => 'required|string|max:255',
            'user_password' => 'required|string|min:6|confirmed',
        ]);

        // バリデーションの結果がエラーの場合
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = User::find($request->id);
        $user->name = $request->user_name;

        if ($request->user_profile_photo != null) {
            // === storeAs => 所定の場所に保存する
            // storeAsメソッドで保存するとファイルは　プロジェクト名/storage/app/に保存される
            $request->user_profile_photo->storeAs('public/user_images', $user->id . '.jpg');
            $user->profile_photo = $user->id . '.jpg';
        }

        // === bcrypt => ハッシュ化する
        $user->password = bcrypt($request->user_password);
        $user->save();

        return redirect('/users/' . $request->id);
    }
}
