<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$people = [
    		['id' => 1, 'dni' => '1000', 'verify_digit' => '6', 'name' => 'Nuevo', 'first_lastname' => 'Usuario', 'second_lastname' => 'Paciente', 'photo' => 'usuario.png', 'slug' => 'nuevo-usuario-paciente', 'gender' => 'Masculino', 'phone' => '12345678', 'celular' => '123456780', 'birthday' => '2000-01-16', 'address' => 'Dirección nueva', 'postal' => '2020', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'type' => 2, 'commune_id' => 5, 'country_id' => 40],
            ['id' => 2, 'dni' => '10000', 'verify_digit' => '5', 'name' => 'Nuevo', 'first_lastname' => 'Usuario', 'second_lastname' => 'Doctor',	'photo' => 'usuario.png', 'slug' => 'nuevo-usuario-doctor',	'gender' => 'Masculino', 'phone' => '12345678',	'celular' => '123456780', 'birthday' => '2000-01-16', 'address' => 'Dirección nueva', 'postal' => '2020', 'email' => 'correo@gmail.com', 'password' => bcrypt('12345678'), 'type' => 1, 'commune_id' => 5, 'country_id' => 40]
    	];
    	DB::table('people')->insert($people);
    }
}
