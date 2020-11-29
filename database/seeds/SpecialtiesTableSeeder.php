<?php

use Illuminate\Database\Seeder;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialties = [
    		['id' => 1, 'name' => 'Fisioterapeuta', 'slug' => 'fisioterapeuta'],
    		['id' => 2, 'name' => 'Medicina General', 'slug' => 'medicina-general']
    	];
    	DB::table('specialties')->insert($specialties);
    }
}
