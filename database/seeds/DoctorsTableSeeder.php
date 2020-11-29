<?php

use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $doctors = [
    		['id' => 1, 'number_doctor' => '12', 'inscription' => '12', 'signature' => 'imagen.jpg', 'state' => '1', 'profession_id' => 1, 'people_id' => 2]
    	];
    	DB::table('doctors')->insert($doctors);
    }
}
