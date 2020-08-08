<?php

use Illuminate\Database\Seeder;

class TrainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trains')->insert([
            'name' => 'TLK202'
        ]);

        DB::table('trains')->insert([
            'name' => 'TLK203'
        ]);
    }
}
