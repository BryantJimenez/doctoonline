<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
    		['id' => 1, 'name' => 'Novedades', 'slug' => 'novedades'],
            ['id' => 2, 'name' => 'Convenios', 'slug' => 'convenios']
    	];
    	DB::table('categories')->insert($categories);
    }
}
