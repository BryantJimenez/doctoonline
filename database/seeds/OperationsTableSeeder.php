<?php

use Illuminate\Database\Seeder;

class OperationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operations = [
    		['id' => 1, 'name' => 'Pancreas', 'slug' => 'pancreas']
    	];
    	DB::table('operations')->insert($operations);
    }
}
