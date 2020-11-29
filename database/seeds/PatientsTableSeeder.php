<?php

use Illuminate\Database\Seeder;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $patients = [
    		['id' => 1, 'civil_state' => 'Soltero', 'children' => NULL, 'laboral' => 'Empleado', 'state' => '1', 'study_id' => 1, 'insurer_id' => 1, 'people_id' => 1]
    	];
    	DB::table('patients')->insert($patients);
    }
}
