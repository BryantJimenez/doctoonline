<?php

use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$regions = [
    		['id' => 1, 'name' => 'Arica y Parinacota'],
    		['id' => 2, 'name' => 'Tarapacá'],
    		['id' => 3, 'name' => 'Antofagasta'],
    		['id' => 4, 'name' => 'Atacama'],
    		['id' => 5, 'name' => 'Coquimbo'],
    		['id' => 6, 'name' => 'Valparaiso'],
    		['id' => 7, 'name' => 'Metropolitana de Santiago'],
    		['id' => 8, 'name' => 'Libertador General Bernardo O\'Higgins'],
    		['id' => 9, 'name' => 'Maule'],
    		['id' => 10, 'name' => 'Ñuble'],
    		['id' => 11, 'name' => 'Biobío'],
    		['id' => 12, 'name' => 'La Araucanía'],
    		['id' => 13, 'name' => 'Los Ríos'],
    		['id' => 14, 'name' => 'Los Lagos'],
    		['id' => 15, 'name' => 'Aysén del General Carlos Ibáñez del Campo'],
    		['id' => 16, 'name' => 'Magallanes y de la Antártica Chilena']
    	];
    	DB::table('regions')->insert($regions);
    }
}
