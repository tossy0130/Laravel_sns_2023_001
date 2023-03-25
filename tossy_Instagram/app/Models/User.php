<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Symfony\Component\CssSelector\Node\FunctionNode;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     *   ============ hasMany 設定 ============== User -> Post
     */
    public function posts()
    {
        // return $this->hasMany('App\Post');
        return $this->hasMany('App\Models\Post');
    }

    /**
     *  ============ hasMany 設定 ============== User -> Like
     */
    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    /**
     *  ============ hasMany 設定 ============== User -> Comment
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}
