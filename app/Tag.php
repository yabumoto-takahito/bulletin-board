<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
        // 所謂ホワイトリスト。$fillableに指定したカラムのみ、create()やfill()、update()で値が代入される。
        protected $fillable = [
          'tag_name'
    ];
}
