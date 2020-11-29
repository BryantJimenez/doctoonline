<?php

use Illuminate\Database\Seeder;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
    		['id' => 1, 'name' => 'Examenes a Domicilio', 'slug' => 'examenes-a-domicilio', 'image' => 'examenes-a-domicio.png', 'banner' => 'banner-examenes-a-domicio.png', 'title' => 'Llevamos nuestro laboratorio a tu hogar', 'description' => '<p>Ahora puede realizar sus exámenes de Laboratorio desde la seguridad de su casa, con nuestros mejores convenios y tratamientos disponibles.<br><br>Debe ingresar a nuestro sistema para solicitar los mismos o llamar a nuestro teléfono para realizar agenda de fecha y hora.</p>', 'line' => 'Sin Demoras y en tu Hogar!', 'icon' => 'icono-examenes-a-domicio.png', 'diary_title' => 'Agenda de Servicios:', 'diary_description' => '<p>Registrandose e ingresando a nuestro sistema, va a poder realizar diferentes consultas a su médico especialista, así como visualizar su historial clinico, ordenes de examen y convenios desde un solo lugar.</p>', 'app_title' => 'APP ANDROID (Proximamente...)', 'app_description' => '<p>Pendientes por ser pioneros en tecnología, creamos entorno android para que desde cualquier tablet o teléfono pueda acceder a los mejores servicios y plataformas de doctoonline.</p>', 'type' => '2', 'featured' => "1", 'state' => "1"],
    		['id' => 2, 'name' => 'Médicos a Domicio', 'slug' => 'medicos-a-domicilio', 'image' => 'medicos-a-domicilio.png', 'banner' => 'banner-medicos-a-domicio.png', 'title' => 'Vamos Volando', 'description' => '<p>Nuestro médico visita al paciente en casa para revisar el estado de salud, recomendar diagnósticos, formular un plan de tratamiento para administrarse en casa (en casos donde sea posible) y derivar a un especialista, si es necesario.</p>', 'line' => 'En la comodidad de tu hogar, Seguimos Cuidando de Tí', 'icon' => 'icono-medicos-a-domicilio.png', 'diary_title' => 'Agenda de Servicios:', 'diary_description' => '<p>Registrandose e ingresando a nuestro sistema, va a poder realizar diferentes consultas a su médico especialista, así como visualizar su historial clinico, ordenes de examen y convenios desde un solo lugar.</p>', 'app_title' => 'APP ANDROID (Proximamente...)', 'app_description' => '<p>Pendientes por ser pioneros en tecnología, creamos entorno android para que desde cualquier tablet o teléfono pueda acceder a los mejores servicios y plataformas de doctoonline.</p>', 'type' => '1', 'featured' => "1", 'state' => "1"],
    		['id' => 3, 'name' => 'Consulta Virtual', 'slug' => 'consulta-virtual', 'image' => 'consulta-virtual.png', 'banner' => 'banner-consulta-virtual.png', 'title' => 'Telemedicina a Distancia', 'description' => '<p>En lo que respecta a su salud, creemos que tiene derecho a decidir que hacer con su cuerpo. Es por eso que le ofrecemos la oportunidad de consultar a un médico con licencia y registrado en el MINSAL en caso de tener problemas de salud o necesidades de tratamiento inmediato.<br><br>La consulta mádica puede ser entregada a distancia por medio telefónico, online utilizando un smartphone, tablet o simplemente desde su computadora.</p>', 'line' => 'Estamos Contigo en Todos Lados...', 'icon' => 'icono-consulta-virtual.png', 'diary_title' => 'Agenda de Servicios:', 'diary_description' => '<p>Registrandose e ingresando a nuestro sistema, va a poder realizar diferentes consultas a su médico especialista, así como visualizar su historial clinico, ordenes de examen y convenios desde un solo lugar.</p>', 'app_title' => 'APP ANDROID (Proximamente...)', 'app_description' => '<p>Pendientes por ser pioneros en tecnología, creamos entorno android para que desde cualquier tablet o teléfono pueda acceder a los mejores servicios y plataformas de doctoonline.</p>', 'type' => '1', 'featured' => "1", 'state' => "1"]
    	];
    	DB::table('services')->insert($services);
    }
}
