<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /***
     *   1　対　多   => 多
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     *  1　対　多   => 多
     */
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }
}
