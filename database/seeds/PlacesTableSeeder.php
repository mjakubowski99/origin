<?php

use Illuminate\Database\Seeder;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('places')->insert([
            'car' => 1, 
            'number' => 1
        ]);

        DB::table('places')->insert([
            'car' => 1, 
            'number' => 2
        ]);

        DB::table('places')->insert([
            'car' => 2, 
            'number' => 1
        ]);
    }
}
