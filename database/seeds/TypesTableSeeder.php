<?php

use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
    		['id' => 1, 'name' => 'Normal', 'slug' => 'normal'],
    		['id' => 2, 'name' => 'A Considerar', 'slug' => 'a-considerar'],
    		['id' => 3, 'name' => 'Urgente', 'slug' => 'urgente']
    	];
    	DB::table('types')->insert($types);
    }
}
