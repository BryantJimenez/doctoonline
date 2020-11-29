<?php

use Illuminate\Database\Seeder;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $professions = [
    		['id' => 1, 'name' => 'Médico', 'slug' => 'medico']
    	];
    	DB::table('professions')->insert($professions);
    }
}
