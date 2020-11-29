<?php

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = [
          ['id' => 1, 'name' => 'Arica', 'region_id' => 1],
          ['id' => 2, 'name' => 'Parinacota', 'region_id' => 1],
          ['id' => 3, 'name' => 'Iquique', 'region_id' => 2],
          ['id' => 4, 'name' => 'El Tamarugal', 'region_id' => 2],
          ['id' => 5, 'name' => 'Tocopilla', 'region_id' => 3],
          ['id' => 6, 'name' => 'El Loa', 'region_id' => 3],
          ['id' => 7, 'name' => 'Antofagasta', 'region_id' => 3],
          ['id' => 8, 'name' => 'Chañaral', 'region_id' => 4],
          ['id' => 9, 'name' => 'Copiapó', 'region_id' => 4],
          ['id' => 10, 'name' => 'Huasco', 'region_id' => 4],
          ['id' => 11, 'name' => 'Elqui', 'region_id' => 5],
          ['id' => 12, 'name' => 'Limarí', 'region_id' => 5],
          ['id' => 13, 'name' => 'Choapa', 'region_id' => 5],
          ['id' => 14, 'name' => 'Petorca', 'region_id' => 6],
          ['id' => 15, 'name' => 'Los Andes', 'region_id' => 6],
          ['id' => 16, 'name' => 'San Felipe de Aconcagua', 'region_id' => 6],
          ['id' => 17, 'name' => 'Quillota', 'region_id' => 6],
          ['id' => 18, 'name' => 'Valparaiso', 'region_id' => 6],
          ['id' => 19, 'name' => 'San Antonio', 'region_id' => 6],
          ['id' => 20, 'name' => 'Isla de Pascua', 'region_id' => 6],
          ['id' => 21, 'name' => 'Marga Marga', 'region_id' => 6],
          ['id' => 22, 'name' => 'Chacabuco', 'region_id' => 7],
          ['id' => 23, 'name' => 'Santiago', 'region_id' => 7],
          ['id' => 24, 'name' => 'Cordillera', 'region_id' => 7],
          ['id' => 25, 'name' => 'Maipo', 'region_id' => 7],
          ['id' => 26, 'name' => 'Melipilla', 'region_id' => 7],
          ['id' => 27, 'name' => 'Talagante', 'region_id' => 7],
          ['id' => 28, 'name' => 'Cachapoal', 'region_id' => 8],
          ['id' => 29, 'name' => 'Colchagua', 'region_id' => 8],
          ['id' => 30, 'name' => 'Cardenal Caro', 'region_id' => 8],
          ['id' => 31, 'name' => 'Curicó', 'region_id' => 9],
          ['id' => 32, 'name' => 'Talca', 'region_id' => 9],
          ['id' => 33, 'name' => 'Linares', 'region_id' => 9],
          ['id' => 34, 'name' => 'Cauquenes', 'region_id' => 9],
          ['id' => 35, 'name' => 'Diguillín', 'region_id' => 10],
          ['id' => 36, 'name' => 'Itata', 'region_id' => 10],
          ['id' => 37, 'name' => 'Punilla', 'region_id' => 10],
          ['id' => 38, 'name' => 'Bio Bío', 'region_id' => 11],
          ['id' => 39, 'name' => 'Concepción', 'region_id' => 11],
          ['id' => 40, 'name' => 'Arauco', 'region_id' => 11],
          ['id' => 41, 'name' => 'Malleco', 'region_id' => 12],
          ['id' => 42, 'name' => 'Cautín', 'region_id' => 12],
          ['id' => 43, 'name' => 'Valdivia', 'region_id' => 13],
          ['id' => 44, 'name' => 'Ranco', 'region_id' => 13],
          ['id' => 45, 'name' => 'Osorno', 'region_id' => 14],
          ['id' => 46, 'name' => 'Llanquihue', 'region_id' => 14],
          ['id' => 47, 'name' => 'Chiloé', 'region_id' => 14],
          ['id' => 48, 'name' => 'Palena', 'region_id' => 14],
          ['id' => 49, 'name' => 'Coyhaique', 'region_id' => 15],
          ['id' => 50, 'name' => 'Aysén', 'region_id' => 15],
          ['id' => 51, 'name' => 'General Carrera', 'region_id' => 15],
          ['id' => 52, 'name' => 'Capitán Prat', 'region_id' => 15],
          ['id' => 53, 'name' => 'Última Esperanza', 'region_id' => 16],
          ['id' => 54, 'name' => 'Magallanes', 'region_id' => 16],
          ['id' => 55, 'name' => 'Tierra del Fuego', 'region_id' => 16],
          ['id' => 56, 'name' => 'Antártica Chilena', 'region_id' => 16]
      ];
      DB::table('provinces')->insert($provinces);
  }
}
