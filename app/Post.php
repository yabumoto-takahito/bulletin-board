<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // 所謂ホワイトリスト。$fillableに指定したカラムのみ、create()やfill()、update()で値が代入される。
    protected $fillable = [
        'user_id', 'category_id', 'content', 'title'
    ];

    public function category() {
      return $this->belongsTo('App\Category');
    }

    public function user() {
      return $this->belongsTo('App\User');
    }
}
