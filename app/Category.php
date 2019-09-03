<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // 所謂ホワイトリスト。$fillableに指定したカラムのみ、create()やfill()、update()で値が代入される。
    protected $fillable = [
        'category_name'
    ];
}
