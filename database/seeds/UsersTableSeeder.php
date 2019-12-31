<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          'name'     => 'admin',
          'lastname' => 'admin',
          'email'    => 'admin@test.com',
          'type_id'  => 1,
          'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
          'name'     => 'client',
          'lastname' => 'client',
          'email'    => 'client@test.com',
          'type_id'  => 2,
          'password' => Hash::make('password'),
        ]);
    }
}
