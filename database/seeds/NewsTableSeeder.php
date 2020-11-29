<?php

use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$content="<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>";

        $news = [
        	['id' => 1, 'image' => 'noti3.png', 'title' => 'Teleconsultas en Tiempos de Covid', 'slug' => 'teleconsultas-en-tiempos-de-covid', 'content' => $content, 'featured' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 02)],
        	['id' => 2, 'image' => 'noti2.png', 'title' => 'Adquirimos 10 nuevas ambulancias de última generación', 'slug' => 'adquirimos-10-nuevas-ambulancias-de-ultima-generacion', 'content' => $content, 'featured' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 03)],
        	['id' => 3, 'image' => 'noti1.png', 'title' => 'Nuevo Equipamento Técnologico para Examenes', 'slug' => 'nuevo-equipamento-tecnologico-para-examenes', 'content' => $content, 'featured' => '1', 'state' => '1', 'created_at' => Carbon\Carbon::create(2020, 07, 03)]
    	];
    	DB::table('news')->insert($news);
    }
}
