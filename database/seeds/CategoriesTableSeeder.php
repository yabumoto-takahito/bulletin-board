<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $param = [
        'category_name' => 'life',
        'category_name' => 'programing',
        'category_name' => 'love'
      ];

      DB::table('categories')->insert($param);
    }
}
