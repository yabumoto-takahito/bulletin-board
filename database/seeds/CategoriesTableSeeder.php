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
      ];
      DB::table('categories')->insert($param);

      $param = [
        'category_name' => 'programing',
      ];
      DB::table('categories')->insert($param);

      $param = [
        'category_name' => 'love',
      ];

      DB::table('categories')->insert($param);
    }
}
