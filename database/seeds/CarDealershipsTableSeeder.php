<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarDealershipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('car_dealerships')->insert([
        'name' => 'Global Cars',
        'city' => 'Caracas'
      ]);

      DB::table('car_dealerships')->insert([
        'name' => 'Fast Cars',
        'city' => 'Bogota'
      ]);

      DB::table('car_dealerships')->insert([
        'name' => 'Chrysler Cars',
        'city' => 'Buenos Aires'
      ]);

      DB::table('car_dealerships')->insert([
        'name' => 'Toyota Cars',
        'city' => 'Medellin'
      ]);

      DB::table('car_dealerships')->insert([
        'name' => 'Ford Cars',
        'city' => 'Valencia'
      ]);
    }
}
