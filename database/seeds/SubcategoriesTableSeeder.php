<?php

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subcategories = [
    		['id' => 1, 'name' => 'Rayos', 'slug' => 'rayos', 'code' => '1100', 'category_id' => 1],
            ['id' => 2, 'name' => 'Imagen Magnetica', 'slug' => 'imagen-magnetica', 'code' => '1101', 'category_id' => 1],
            ['id' => 3, 'name' => 'Ecografía', 'slug' => 'ecografia', 'code' => '1102', 'category_id' => 1],
            ['id' => 4, 'name' => 'Mamografía', 'slug' => 'mamografia', 'code' => '1103', 'category_id' => 1]
    	];
    	DB::table('subcategories')->insert($subcategories);
    }
}
