<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $param = [
        'title' => 'hoge',
        'content' => 'test1',
        'user_id' => 1,
        'category_id' => 1,
      ];
      DB::table('posts')->insert($param);

      $param = [
        'title' => 'hoge',
        'content' => 'test2',
        'user_id' => 1,
        'category_id' => 1,
      ];
      DB::table('posts')->insert($param);

      $param = [
        'title' => 'hoge',
        'content' => 'test3',
        'user_id' => 1,
        'category_id' => 1,
      ];
      DB::table('posts')->insert($param);
    }
}
