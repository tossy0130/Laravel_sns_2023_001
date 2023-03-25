<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    // === 「１対１」→ メソッド名は単数形
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    // === 「１対１」→ メソッド名は単数形
    public function post()
    {
        return $this->belongsTo('App\Models\Post');
    }

}
