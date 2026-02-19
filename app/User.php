<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'mail', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // フォロー
    public function followings()
    {
    return $this->hasMany(Follow::class, 'following_id');
    }

    // フォロワー
    public function followers()
    {
    return $this->hasMany(Follow::class, 'followed_id');
    }

    // 投稿削除ボタンに必要となる「roleカラムが'admin'の場合にtrueを返す」機能
    public function isAdmin()
    {
    return $this->role === 'admin';
    }
}
