<?php

use Illuminate\Support\Facades\Route;

# コントローラー追加
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\CommentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});
*/

// === ルーティング　書き方
Route::get('/', [PostsController::class, 'index']);

Auth::routes();

// === home
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [PostsController::class, 'index']);

// === ユーザー編集
Route::get('/users/edit', [UsersController::class, 'edit']);
Route::post('/users/update', [UsersController::class, 'update']);

// === ユーザ詳細画面 表示
Route::get('/users/{user_id}', [UsersController::class, 'show']);

//=============== 投稿新規画面　・　投稿新規処理
Route::get('/posts/new', [PostsController::class, 'new'])->name('new');
Route::post('/posts', [PostsController::class, 'store']);
// === 投稿削除処理
Route::get('/postsdelete/{post_id}', [PostsController::class, 'destroy']);


// ======== いいね機能 いいね処理
Route::get('/posts/{post_id}/likes', [LikesController::class, 'store']);
// === いいね　取り消し
Route::get('/likes/{like_id}', [LikesController::class, 'destroy']);

//========== コメント機能
Route::post('/posts/{comment_id}/comments', [CommentsController::class, 'store']);

Route::get('/comments/{commnet_id}', [CommentsController::class, 'destroy']);
