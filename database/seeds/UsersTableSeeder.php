<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $param = [
        'name' => 'test',
        'email' => 'test@gmail.com',
        'password' => bcrypt('testtest'),
      ];

      DB::table('users')->insert($param);
    }
}
