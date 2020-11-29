<?php

use Illuminate\Database\Seeder;

class DoctorspecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$doctor_specialty = [
    		['id' => 1, 'specialty_id' => 1, 'doctor_id' => 1]
    	];
    	DB::table('doctor_specialty')->insert($doctor_specialty);
    }
}
