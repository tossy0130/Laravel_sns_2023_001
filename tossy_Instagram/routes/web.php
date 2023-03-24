<?php

use Illuminate\Support\Facades\Route;

# コントローラー追加
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// === ユーザー編集
Route::get('/users/edit', [UsersController::class, 'edit']);
Route::post('/users/update', [UsersController::class, 'update']);

// === ユーザ詳細画面 表示
Route::get('/users/{user_id}', [UsersController::class, 'show']);
