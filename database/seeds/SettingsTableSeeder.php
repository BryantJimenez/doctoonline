<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
    		['id' => 1, 'terms' => '<p>El uso de esta plataforma de Doctoonline se realiza mediante teléfono, Ipad o PC, requiere que el usuario tenga una buena conección a Internet y se realice en un lugar lejos de distractores como musica, personas conversando, etc.</p><p>Este servicio cumple con las disposiciones previstas de acuerdo a las siguientes leyes:</p><p>1.- Ley N° 19.628 sobre Protección de Datos de Carácter Personal</p><p>Ley N° 20.584 que Regula los Derechos y Deberes que tienen las Personas en relación a su Atención de Salud, Resolución MINSAL FONASA N° 204, de fecha 24 de marzo de 2020. Oficio Circular IP N° 7, de la Intendencia de Prestadores de Salud, de fecha 13 de abril de 2020, y demás normativas aplicables.</p><p>Este servicio solo esta disponible para pacientes que posean Ficha Clínica Electrónica en la plataforma Online.</p>', 'banner' => 'banner-about.png', 'about' => '<p>Doctoonline.cl es una plataforma web que permite la práctica de la medicina mediante la interacción de un médico y su paciente a través de dispositivos móviles, logrando así realizar una consulta médica a distancia (independiente del lugar geográfico).<br><br>Es una alternativa viable, pensaba en la comodidad del paciente para iniciar un tratamiento médico personalizado y/o obtener una segunda opinión de especialistas médicos, que por razones de tiempo, recursos o distancia no podrían ocurrir.</p>', 'mission' => '<p>Poner a disposición de los médicos y pacientes: Una Consulta a Distancia de Calidad, en tiempo real, con un nivel interactivo similar a una consulta presencial.<br><br>Buscamos evitar traslados inenecesarios de los pacientes mediante disponibilidad horaria conveniente, entregando respuestas y orientaciones profesionales oportunas, y reduciendo los costos del tratamiento.</p>', 'vision' => '<p>Doctoonline.cl ofrece una solución innovadora en la relación médico-paciente que les permite independizarse de las limitaciones provocadas por la distancia, el costo, los horarios, asegurando la calidad de las consultas.</p>', 'phone' => '+56 9 3305 0033', 'email' => 'correo@correo.com', 'address' => 'La capitania 80, Oficina 108<br>Las Condes - Santiago de Chile', 'facebook' => 'https://www.facebook.com', 'twitter' => 'https://www.twitter.com', 'instagram' => 'https://www.instagram.com', 'interval' => 20]
    	];
    	DB::table('settings')->insert($settings);
    }
}
