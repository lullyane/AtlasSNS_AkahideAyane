<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Follow extends Model
{
    protected $table = 'follows';

    // フォロー
    public function follower()
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    // フォロワー
    public function followed()
    {
        return $this->belongsTo(User::class, 'followed_id');
    }


    // Postsコントローラーで使うメソッド
    public function followingIds($user_id)
    {
    return $this->where('following_id', $user_id)->get();
    }
    // following_idが$user_idと一致する行を探す
    // 一致したレコードをコレクションとしてgetで取得し、Postsコントローラーファイルに返す
    // ▲フォローリスト
    // ▼フォロワーリスト
    public function followedIds($user_id)
    {
    return $this->where('followed_id', $user_id)->get();
    }
}
