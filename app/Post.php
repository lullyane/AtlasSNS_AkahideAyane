<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    // 一括保存するカラムを指定
    protected $fillable = [
        'user_id',
        'post',
    ];

    // 投稿はユーザーに属するのでUserモデルとリレーションする
    public function user()
{
    return $this->belongsTo(User::class);
}

}
