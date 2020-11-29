<?php

use Illuminate\Database\Seeder;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $diseases = [
    		['id' => 1, 'name' => 'Diabetes', 'slug' => 'diabetes']
    	];
    	DB::table('diseases')->insert($diseases);
    }
}
