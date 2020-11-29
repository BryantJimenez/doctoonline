<?php

use Illuminate\Database\Seeder;

class InsurersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $insurers = [
    		['id' => 1, 'name' => 'Fonasa', 'slug' => 'fonasa'],
    		['id' => 2, 'name' => 'Banmedica', 'slug' => 'banmedica'],
    		['id' => 3, 'name' => 'Consalud', 'slug' => 'consalud'],
    		['id' => 4, 'name' => 'Colmena', 'slug' => 'colmena'],
    		['id' => 5, 'name' => 'Nueva Masvida', 'slug' => 'nueva-masvida'],
    		['id' => 6, 'name' => 'Cruz Blanca', 'slug' => 'cruz-blanca'],
    		['id' => 7, 'name' => 'Vidatres', 'slug' => 'vidatres']
    	];
    	DB::table('insurers')->insert($insurers);
    }
}
