<?php

use Illuminate\Database\Seeder;

class CategoryexamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category_exams = [
    		['id' => 1, 'name' => "Imagenología", 'slug' => "imagenologia"]
    	];
    	DB::table('category_exams')->insert($category_exams);
    }
}
