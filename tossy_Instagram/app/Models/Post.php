<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // === 多　側
    // 「１対１」→ メソッド名は単数形
    public function user()
    {
        // return $this->belongsTo('App\User');
        return $this->belongsTo('App\Models\User');
    }

    // === hasMany 設定
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    /**
     *  いいね　
     */
    public function likedBy($user)
    {
        return Like::where('user_id', $user->id)->where('post_id', $this->id);
    }

    /**
     *  １　対　多  , Post . Comment
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
