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
        'username', 'mail', 'password', 'bio', 'images'
    ];


    // ユーザーのアイコン未登録時は icon1.png が表示されるようにする
    public function getProfileImageUrlAttribute()
    {
        // 画像が設定されていて、かつファイルが存在する場合
        if ($this->images && \Storage::disk('public')->exists($this->images))
            {
                return asset('storage/' . $this->images);
            }

        // それ以外はデフォルト画像
        return asset('images/icon1.png');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // フォロー数カウント
    public function followings()
    {
        return $this->hasMany(Follow::class, 'following_id');
    }

    // フォロワー数カウント
    public function followers()
    {
        return $this->hasMany(Follow::class, 'followed_id');
    }

    //フォローしているユーザー表示
    public function follows()
    {
        return $this->belongsToMany(
        // 関係を結ぶテーブル決めて
        User::class,
        // 第一引数で中間テーブルを決めて
        'follows',
        // 第二引数で中間テーブルのうち “自分” を指すカラムを決めて
        'following_id',
        // 第三引数で中間テーブルのうち “相手” を指すカラムを決める
        'followed_id'
        );
        // これでフォローしている人が表示される
        // フォロワー表示する場合は'followed_id'が第二引数に来る
    }

    //フォロワー表示
    //フォローと逆で、第二引数で “相手”、第三引数で “自分”を指すカラムを決める
    public function followed()
    {
        return $this->belongsToMany(
        User::class,'follows','followed_id','following_id');
    }

    // フォローしているかを判定
    public function isFollowing($userId)
    {
        return $this->follows()->where('followed_id', $userId)->exists();
    }
}
