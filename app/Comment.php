<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // 所謂ホワイトリスト。$fillableに指定したカラムのみ、create()やfill()、update()で値が代入される。
    protected $fillable = [
        'user_id', 'post_id', 'comment',
    ];

    public function user() {
      return $this->belongsTo('App\User');
    }
}
