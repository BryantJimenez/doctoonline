<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = [
    		['id' => 1, 'image' => 'bannerprincipal.png', 'title' => 'Cuidamos tu salud!', 'slug' => 'banner', 'text' => 'Trabajamos cada día para brindar la mejor asistencia médica', 'button' => "1", 'button_text' => 'Ver Servicios', 'pre_url' => NULL, 'url' => NULL, 'target' => 0, 'type' => '1', 'state' => '1'],
            ['id' => 2, 'image' => 'bannercoronavirus.png', 'title' => 'Coronavirus', 'slug' => 'banner-0', 'text' => 'Todo los que necesitas saber...', 'button' => "1", 'button_text' => 'Como Prevenir', 'pre_url' => NULL, 'url' => NULL, 'target' => 0, 'type' => '2', 'state' => '1']
    	];
    	DB::table('banners')->insert($banner);
    }
}
