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

}
