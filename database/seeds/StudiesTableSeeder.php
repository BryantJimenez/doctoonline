<?php

use Illuminate\Database\Seeder;

class StudiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $studies = [
    		['id' => 1, 'name' => 'Sin Estudios', 'slug' => 'sin-estudios'],
    		['id' => 2, 'name' => 'Enseñanza Basica', 'slug' => 'ensenanza-basica'],
    		['id' => 3, 'name' => 'Enseñanza Media', 'slug' => 'ensenanza-media'],
    		['id' => 4, 'name' => 'Estudios Universitarios Incompletos', 'slug' => 'estudios-universitarios-incompletos'],
    		['id' => 5, 'name' => 'Estudios Universitarios Completos', 'slug' => 'estudios-universitarios-completos'],
    	];
    	DB::table('studies')->insert($studies);
    }
}
