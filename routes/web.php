<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/////////////////////////////////////// AUTH ////////////////////////////////////////////////////

Auth::routes(['register' => false]);
Route::get('/administradores/email', 'AdminController@emailVerifyAdmin');
Route::get('/usuarios/email', 'AdminController@emailVerifyPeople');
Route::get('/farmacias/email', 'AdminController@emailVerifyPharmacy');
Route::get('/convenios/email', 'AdminController@emailVerifyCovenant');
Route::post('/usuarios/buscar/dni', 'AdminController@searchRutPatient');
Route::post('/medicos/buscar/dni', 'AdminController@searchRutDoctor');
Route::post('/usuarios/existe', 'AdminController@searchRutPeople');
Route::post('/agenda/servicio', 'AdminController@diaryTimes');
Route::post('/agenda/reservas', 'AdminController@diariesDay');

Route::group(['middleware' => ['login']], function () {
	Route::get('/ingresar', 'AuthController@loginForm')->name('ingresar');
	Route::get('/registro', 'AuthController@registerForm')->name('registro');
	Route::get('/recuperar', 'AuthController@recoveryForm')->name('recuperar');
	Route::get('/restaurar/{slug}/{token}', 'AuthController@resetForm')->name('restaurar');
	Route::post('/ingresar', 'AuthController@login')->name('login.custom');
	Route::post('/registro', 'AuthController@register')->name('register.custom');
	Route::post('/recuperar', 'AuthController@recovery')->name('recovery.custom');
	Route::post('/restaurar/{slug}/{token}', 'AuthController@reset')->name('reset.custom');
});

Route::group(['middleware' => ['session_verify', 'web.session']], function () {
	Route::post('/salir', 'AuthController@logout')->name('logout.custom');

	// ///////////////////////////////////////////// WEB ////////////////////////////////////////////////
	Route::get('/seleccionar', 'WebController@selected')->name('web.selected');
	Route::get('/seleccionar/medico', 'WebController@selectedDoctor')->name('web.selected.doctor');
	Route::get('/seleccionar/paciente', 'WebController@selectedPatient')->name('web.selected.patient');

	Route::group(['middleware' => ['selected.type']], function () {
		Route::get('/perfil', 'WebController@profile')->name('web.profile');
		Route::get('/perfil/editar', 'WebController@profileEdit')->name('web.profile.edit');
		Route::put('/perfil/editar', 'WebController@profileUpdate')->name('web.profile.update');

		Route::group(['middleware' => ['patient']], function () {
			Route::get('/informes', 'WebController@reports')->name('reports');
		});

		Route::group(['middleware' => ['doctor']], function () {
			Route::get('/buscar', 'WebController@search')->name('search');
			Route::post('/pacientes/exist', 'WebController@exist')->name('web.patients.exist');
			Route::get('/pacientes/registrar', 'WebController@createPatient')->name('web.patients.create');
			Route::post('/pacientes', 'WebController@storePatient')->name('web.patients.store');

			Route::get('/informes/{slug}/registrar/{report?}', 'WebController@createReport')->name('reports.create');
			Route::get('/informes/{slug}/siguiente/{phase}', 'WebController@nextStep')->name('reports.step');
			Route::post('/informes', 'WebController@storeReport')->name('reports.store');
			Route::put('/informes/{slug}/primero', 'WebController@storeReportOne')->name('reports.store.one');
			Route::put('/informes/{slug}/segundo', 'WebController@storeReportTwo')->name('reports.store.two');
			Route::put('/informes/{slug}/tercero', 'WebController@storeReportThree')->name('reports.store.three');
			Route::put('/informes/{slug}/cuarto', 'WebController@storeReportFour')->name('reports.store.four');
			Route::put('/informes/{slug}/quinto', 'WebController@storeReportFive')->name('reports.store.five');
			Route::put('/informes/{slug}/sexto', 'WebController@storeReportSix')->name('reports.store.six');
			Route::get('/informes/{slug}/editar/{phase?}', 'WebController@editReport')->name('reports.edit');
			Route::put('/informes/{slug}/fase/primero', 'WebController@updateReportOne')->name('reports.update.one');
			Route::put('/informes/{slug}/fase/segundo', 'WebController@updateReportTwo')->name('reports.update.two');
			Route::put('/informes/{slug}/fase/tercero', 'WebController@updateReportThree')->name('reports.update.three');
			Route::put('/informes/{slug}/fase/cuarto', 'WebController@updateReportFour')->name('reports.update.four');
			Route::put('/informes/{slug}/fase/quinto', 'WebController@updateReportFive')->name('reports.update.five');
			Route::put('/informes/{slug}/fase/sexto', 'WebController@updateReportSix')->name('reports.update.six');
		});

		Route::get('/informes/{slug}', 'WebController@showReport')->name('reports.show');
		Route::get('/informes/receta/{slug}/pdf', 'ReportController@pdfRecipe')->name('reports.pdf.recipe');
		Route::get('/informes/orden/{slug}/pdf', 'ReportController@pdfOrder')->name('reports.pdf.order');

		Route::get('/agenda', 'WebController@diaries')->name('diaries');
		Route::get('/agenda/{slug}', 'WebController@showDiary')->name('diaries.show');
	});
});

Route::group(['middleware' => ['session_verify']], function () {
	Route::post('/salir', 'AuthController@logout')->name('logout.custom');

	/////////////////////////////////////////////// WEB ////////////////////////////////////////////////
	Route::get('/', 'WebController@index')->name('home');
	Route::get('/quienes-somos', 'WebController@about')->name('about');
	Route::get('/servicios/{slug}', 'WebController@services')->name('services');
	Route::get('/agendar/{phase?}', 'WebController@diary')->name('diary');
	Route::post('/agendar/primero', 'WebController@storeDiary')->name('diary.store');
	Route::post('/agendar/segundo', 'WebController@storeDiaryTwo')->name('diary.store.two');
	Route::post('/agendar/tercero', 'WebController@storeDiaryThree')->name('diary.store.three');
	Route::post('/agendar/cuarto', 'WebController@storeDiaryFour')->name('diary.store.four');
	Route::post('/agendar/respuesta', 'WebController@diaryResponse')->name('diary.response');
	Route::get('/agendar/{token}/exitoso', 'WebController@diarySuccess')->name('diary.success');
	Route::get('/noticias/{category?}', 'WebController@news')->name('news');
	Route::get('/noticias/{category}/{slug}', 'WebController@new')->name('new');
	Route::get('/contacto', 'WebController@contact')->name('contact');
	Route::post('/contacto', 'SettingController@sendEmail')->name('contact.send');
	Route::get('/trabaja-con-nosotros', 'WebController@applicant')->name('applicant');
	Route::post('/trabaja-con-nosotros', 'ApplicantController@store')->name('solicitudes.store');
});

//Provincias
Route::post('/provincias/agregar', 'ProvinceController@addProvinces')->name('provincias.add');

//Comunas
Route::post('/comunas/agregar', 'CommuneController@addCommunes')->name('comunas.add');

//Subcategorias
Route::post('/subcategorias/agregar', 'SubcategoryController@addSubcategories')->name('subcategorias.add');

//Examenes
Route::post('/examenes/nuevo', 'ExamController@new')->name('examenes.new');

//Médicos
Route::post('/medicos/agregar', 'DoctorController@addDoctors')->name('medicos.add');
Route::post('/medicos/buscar', 'DoctorController@searchDoctor')->name('medicos.search');

//Subcategorias de Agenda
Route::post('/subcategorias/agenda/agregar', 'SubcategoryDiaryController@addSubcategories')->name('subcategorias.agenda.add');

//Reportes
Route::post('/imagenes/informes', 'ReportController@file')->name('informes.store.images');
Route::post('/imagenes/informes/editar/{slug}', 'ReportController@fileEdit')->name('informes.edit.images');
Route::post('/imagenes/informes/eliminar', 'ReportController@fileDestroy')->name('informes.destroy.images');

Route::group(['middleware' => ['auth', 'admin']], function () {
	/////////////////////////////////////// ADMIN ///////////////////////////////////////////////////

	// Inicio
	Route::get('/admin', 'AdminController@index')->name('admin');
	Route::get('/admin/perfil', 'AdminController@profile')->name('profile');
	Route::get('/admin/perfil/editar', 'AdminController@profileEdit')->name('profile.edit');
	Route::put('/admin/perfil/', 'AdminController@profileUpdate')->name('profile.update');

	// Administradores
	Route::get('/admin/administradores', 'AdministratorController@index')->name('administradores.index');
	Route::get('/admin/administradores/registrar', 'AdministratorController@create')->name('administradores.create');
	Route::post('/admin/administradores', 'AdministratorController@store')->name('administradores.store');
	Route::get('/admin/administradores/{slug}', 'AdministratorController@show')->name('administradores.show');
	Route::get('/admin/administradores/{slug}/editar', 'AdministratorController@edit')->name('administradores.edit');
	Route::put('/admin/administradores/{slug}', 'AdministratorController@update')->name('administradores.update');
	Route::delete('/admin/administradores/{slug}', 'AdministratorController@destroy')->name('administradores.delete');
	Route::put('/admin/administradores/{slug}/activar', 'AdministratorController@activate')->name('administradores.activate');
	Route::put('/admin/administradores/{slug}/desactivar', 'AdministratorController@deactivate')->name('administradores.deactivate');

	// Pacientes
	Route::get('/admin/pacientes', 'PatientController@index')->name('pacientes.index');
	Route::get('/admin/pacientes/registrar', 'PatientController@create')->name('pacientes.create');
	Route::post('/admin/pacientes', 'PatientController@store')->name('pacientes.store');
	Route::get('/admin/pacientes/{slug}', 'PatientController@show')->name('pacientes.show');
	Route::get('/admin/pacientes/{slug}/editar', 'PatientController@edit')->name('pacientes.edit');
	Route::put('/admin/pacientes/{slug}', 'PatientController@update')->name('pacientes.update');
	Route::delete('/admin/pacientes/{slug}', 'PatientController@destroy')->name('pacientes.delete');
	Route::put('/admin/pacientes/{slug}/activar', 'PatientController@activate')->name('pacientes.activate');
	Route::put('/admin/pacientes/{slug}/desactivar', 'PatientController@deactivate')->name('pacientes.deactivate');
	Route::get('/admin/pacientes/{slug}/informes', 'PatientController@reports')->name('pacientes.reports');
	Route::get('/admin/pacientes/{slug}/informes/{report}', 'PatientController@report')->name('pacientes.reports.show');

	// Medicos
	Route::get('/admin/medicos', 'DoctorController@index')->name('medicos.index');
	Route::get('/admin/medicos/registrar', 'DoctorController@create')->name('medicos.create');
	Route::post('/admin/medicos', 'DoctorController@store')->name('medicos.store');
	Route::get('/admin/medicos/{slug}', 'DoctorController@show')->name('medicos.show');
	Route::get('/admin/medicos/{slug}/editar', 'DoctorController@edit')->name('medicos.edit');
	Route::put('/admin/medicos/{slug}', 'DoctorController@update')->name('medicos.update');
	Route::delete('/admin/medicos/{slug}', 'DoctorController@destroy')->name('medicos.delete');
	Route::put('/admin/medicos/{slug}/activar', 'DoctorController@activate')->name('medicos.activate');
	Route::put('/admin/medicos/{slug}/desactivar', 'DoctorController@deactivate')->name('medicos.deactivate');

	// Informes
	Route::get('/admin/informes', 'ReportController@index')->name('informes.index');
	Route::get('/admin/informes/{slug}', 'ReportController@show')->name('informes.show');
	Route::delete('/admin/informes/{slug}', 'ReportController@destroy')->name('informes.delete');
	Route::get('/admin/informes/receta/{slug}/pdf', 'ReportController@pdfRecipe')->name('informes.pdf.recipe');
	Route::get('/admin/informes/orden/{slug}/pdf', 'ReportController@pdfOrder')->name('informes.pdf.order');

	// Banners
	Route::get('/admin/banners', 'BannerController@index')->name('banners.index');
	Route::get('/admin/banners/registrar', 'BannerController@create')->name('banners.create');
	Route::post('/admin/banners', 'BannerController@store')->name('banners.store');
	Route::get('/admin/banners/{slug}/editar', 'BannerController@edit')->name('banners.edit');
	Route::put('/admin/banners/{slug}', 'BannerController@update')->name('banners.update');
	Route::delete('/admin/banners/{slug}', 'BannerController@destroy')->name('banners.delete');
	Route::put('/admin/banners/{slug}/activar', 'BannerController@activate')->name('banners.activate');
	Route::put('/admin/banners/{slug}/desactivar', 'BannerController@deactivate')->name('banners.deactivate');

	// Categorías
	Route::get('/admin/categorias', 'CategoryController@index')->name('categorias.index');
	Route::get('/admin/categorias/registrar', 'CategoryController@create')->name('categorias.create');
	Route::post('/admin/categorias', 'CategoryController@store')->name('categorias.store');
	Route::get('/admin/categorias/{slug}/editar', 'CategoryController@edit')->name('categorias.edit');
	Route::put('/admin/categorias/{slug}', 'CategoryController@update')->name('categorias.update');
	Route::delete('/admin/categorias/{slug}', 'CategoryController@destroy')->name('categorias.delete');

	// Noticias
	Route::get('/admin/noticias', 'NewController@index')->name('noticias.index');
	Route::get('/admin/noticias/registrar', 'NewController@create')->name('noticias.create');
	Route::post('/admin/noticias', 'NewController@store')->name('noticias.store');
	Route::get('/admin/noticias/{slug}/editar', 'NewController@edit')->name('noticias.edit');
	Route::put('/admin/noticias/{slug}', 'NewController@update')->name('noticias.update');
	Route::delete('/admin/noticias/{slug}', 'NewController@destroy')->name('noticias.delete');
	Route::put('/admin/noticias/{slug}/activar', 'NewController@activate')->name('noticias.activate');
	Route::put('/admin/noticias/{slug}/desactivar', 'NewController@deactivate')->name('noticias.deactivate');

	// Servicios
	Route::get('/admin/servicios', 'ServiceController@index')->name('servicios.index');
	Route::get('/admin/servicios/registrar', 'ServiceController@create')->name('servicios.create');
	Route::post('/admin/servicios', 'ServiceController@store')->name('servicios.store');
	Route::get('/admin/servicios/{slug}/editar', 'ServiceController@edit')->name('servicios.edit');
	Route::put('/admin/servicios/{slug}', 'ServiceController@update')->name('servicios.update');
	Route::delete('/admin/servicios/{slug}', 'ServiceController@destroy')->name('servicios.delete');
	Route::put('/admin/servicios/{slug}/activar', 'ServiceController@activate')->name('servicios.activate');
	Route::put('/admin/servicios/{slug}/desactivar', 'ServiceController@deactivate')->name('servicios.deactivate');

	// Categorías de Agenda
	Route::get('/admin/categoria-agenda', 'CategoryDiaryController@index')->name('categorias.agenda.index');
	Route::get('/admin/categoria-agenda/registrar', 'CategoryDiaryController@create')->name('categorias.agenda.create');
	Route::post('/admin/categoria-agenda', 'CategoryDiaryController@store')->name('categorias.agenda.store');
	Route::get('/admin/categoria-agenda/{slug}/editar', 'CategoryDiaryController@edit')->name('categorias.agenda.edit');
	Route::put('/admin/categoria-agenda/{slug}', 'CategoryDiaryController@update')->name('categorias.agenda.update');
	Route::delete('/admin/categoria-agenda/{slug}', 'CategoryDiaryController@destroy')->name('categorias.agenda.delete');

	// Subcategorías de Agenda
	Route::get('/admin/subcategorias-agenda', 'SubcategoryDiaryController@index')->name('subcategorias.agenda.index');
	Route::get('/admin/subcategorias-agenda/registrar', 'SubcategoryDiaryController@create')->name('subcategorias.agenda.create');
	Route::post('/admin/subcategorias-agenda', 'SubcategoryDiaryController@store')->name('subcategorias.agenda.store');
	Route::get('/admin/subcategorias-agenda/{slug}/editar', 'SubcategoryDiaryController@edit')->name('subcategorias.agenda.edit');
	Route::put('/admin/subcategorias-agenda/{slug}', 'SubcategoryDiaryController@update')->name('subcategorias.agenda.update');
	Route::delete('/admin/subcategorias-agenda/{slug}', 'SubcategoryDiaryController@destroy')->name('subcategorias.agenda.delete');
	Route::put('/admin/subcategorias-agenda/{slug}/activar', 'SubcategoryDiaryController@activate')->name('subcategorias.agenda.activate');
	Route::put('/admin/subcategorias-agenda/{slug}/desactivar', 'SubcategoryDiaryController@deactivate')->name('subcategorias.agenda.deactivate');

	// Medicos de Agenda
	Route::get('/admin/medico-agenda', 'DiaryDoctorController@index')->name('medicos.agenda.index');
	Route::get('/admin/medico-agenda/registrar', 'DiaryDoctorController@create')->name('medicos.agenda.create');
	Route::post('/admin/medico-agenda', 'DiaryDoctorController@store')->name('medicos.agenda.store');
	Route::get('/admin/medico-agenda/{slug}/editar', 'DiaryDoctorController@edit')->name('medicos.agenda.edit');
	Route::put('/admin/medico-agenda/{slug}', 'DiaryDoctorController@update')->name('medicos.agenda.update');
	Route::delete('/admin/medico-agenda/{slug}', 'DiaryDoctorController@destroy')->name('medicos.agenda.delete');
	Route::put('/admin/medico-agenda/{slug}/activar', 'DiaryDoctorController@activate')->name('medicos.agenda.activate');
	Route::put('/admin/medico-agenda/{slug}/desactivar', 'DiaryDoctorController@deactivate')->name('medicos.agenda.deactivate');

	// Agenda
	Route::get('/admin/reservas', 'DiaryController@index')->name('reservas.index');
	Route::get('/admin/reservas/registrar', 'DiaryController@create')->name('reservas.create');
	Route::post('/admin/reservas', 'DiaryController@store')->name('reservas.store');
	Route::get('/admin/reservas/{slug}', 'DiaryController@show')->name('reservas.show');
	Route::get('/admin/reservas/{slug}/editar', 'DiaryController@edit')->name('reservas.edit');
	Route::put('/admin/reservas/{slug}', 'DiaryController@update')->name('reservas.update');
	Route::put('/admin/reservas/{slug}/activar', 'DiaryController@activate')->name('reservas.activate');
	Route::put('/admin/reservas/{slug}/desactivar', 'DiaryController@deactivate')->name('reservas.deactivate');

	// Especialidades
	Route::get('/admin/especialidades', 'SpecialtyController@index')->name('especialidades.index');
	Route::get('/admin/especialidades/registrar', 'SpecialtyController@create')->name('especialidades.create');
	Route::post('/admin/especialidades', 'SpecialtyController@store')->name('especialidades.store');
	Route::get('/admin/especialidades/{slug}/editar', 'SpecialtyController@edit')->name('especialidades.edit');
	Route::put('/admin/especialidades/{slug}', 'SpecialtyController@update')->name('especialidades.update');
	Route::delete('/admin/especialidades/{slug}', 'SpecialtyController@destroy')->name('especialidades.delete');

	// Aseguradoras
	Route::get('/admin/aseguradoras', 'InsurerController@index')->name('aseguradoras.index');
	Route::get('/admin/aseguradoras/registrar', 'InsurerController@create')->name('aseguradoras.create');
	Route::post('/admin/aseguradoras', 'InsurerController@store')->name('aseguradoras.store');
	Route::get('/admin/aseguradoras/{slug}/editar', 'InsurerController@edit')->name('aseguradoras.edit');
	Route::put('/admin/aseguradoras/{slug}', 'InsurerController@update')->name('aseguradoras.update');
	Route::delete('/admin/aseguradoras/{slug}', 'InsurerController@destroy')->name('aseguradoras.delete');

	// Profesiones
	Route::get('/admin/profesiones', 'ProfessionController@index')->name('profesiones.index');
	Route::get('/admin/profesiones/registrar', 'ProfessionController@create')->name('profesiones.create');
	Route::post('/admin/profesiones', 'ProfessionController@store')->name('profesiones.store');
	Route::get('/admin/profesiones/{slug}/editar', 'ProfessionController@edit')->name('profesiones.edit');
	Route::put('/admin/profesiones/{slug}', 'ProfessionController@update')->name('profesiones.update');
	Route::delete('/admin/profesiones/{slug}', 'ProfessionController@destroy')->name('profesiones.delete');

	// Categorías de Examenes
	Route::get('/admin/categoria-examenes', 'CategoryExamController@index')->name('categorias.examenes.index');
	Route::get('/admin/categoria-examenes/registrar', 'CategoryExamController@create')->name('categorias.examenes.create');
	Route::post('/admin/categoria-examenes', 'CategoryExamController@store')->name('categorias.examenes.store');
	Route::get('/admin/categoria-examenes/{slug}/editar', 'CategoryExamController@edit')->name('categorias.examenes.edit');
	Route::put('/admin/categoria-examenes/{slug}', 'CategoryExamController@update')->name('categorias.examenes.update');
	Route::delete('/admin/categoria-examenes/{slug}', 'CategoryExamController@destroy')->name('categorias.examenes.delete');

	// Subcategorías
	Route::get('/admin/subcategorias', 'SubcategoryController@index')->name('subcategorias.index');
	Route::get('/admin/subcategorias/registrar', 'SubcategoryController@create')->name('subcategorias.create');
	Route::post('/admin/subcategorias', 'SubcategoryController@store')->name('subcategorias.store');
	Route::get('/admin/subcategorias/{slug}/editar', 'SubcategoryController@edit')->name('subcategorias.edit');
	Route::put('/admin/subcategorias/{slug}', 'SubcategoryController@update')->name('subcategorias.update');
	Route::delete('/admin/subcategorias/{slug}', 'SubcategoryController@destroy')->name('subcategorias.delete');

	// Examenes
	Route::get('/admin/examenes', 'ExamController@index')->name('examenes.index');
	Route::get('/admin/examenes/registrar', 'ExamController@create')->name('examenes.create');
	Route::post('/admin/examenes', 'ExamController@store')->name('examenes.store');
	Route::get('/admin/examenes/{slug}/editar', 'ExamController@edit')->name('examenes.edit');
	Route::put('/admin/examenes/{slug}', 'ExamController@update')->name('examenes.update');
	Route::delete('/admin/examenes/{slug}', 'ExamController@destroy')->name('examenes.delete');

	// Enfermedades
	Route::get('/admin/enfermedades', 'DiseaseController@index')->name('enfermedades.index');
	Route::get('/admin/enfermedades/registrar', 'DiseaseController@create')->name('enfermedades.create');
	Route::post('/admin/enfermedades', 'DiseaseController@store')->name('enfermedades.store');
	Route::get('/admin/enfermedades/{slug}/editar', 'DiseaseController@edit')->name('enfermedades.edit');
	Route::put('/admin/enfermedades/{slug}', 'DiseaseController@update')->name('enfermedades.update');
	Route::delete('/admin/enfermedades/{slug}', 'DiseaseController@destroy')->name('enfermedades.delete');

	// Operaciones
	Route::get('/admin/operaciones', 'OperationController@index')->name('operaciones.index');
	Route::get('/admin/operaciones/registrar', 'OperationController@create')->name('operaciones.create');
	Route::post('/admin/operaciones', 'OperationController@store')->name('operaciones.store');
	Route::get('/admin/operaciones/{slug}/editar', 'OperationController@edit')->name('operaciones.edit');
	Route::put('/admin/operaciones/{slug}', 'OperationController@update')->name('operaciones.update');
	Route::delete('/admin/operaciones/{slug}', 'OperationController@destroy')->name('operaciones.delete');

	// Regiones
	Route::get('/admin/regiones', 'RegionController@index')->name('regiones.index');
	Route::get('/admin/regiones/registrar', 'RegionController@create')->name('regiones.create');
	Route::post('/admin/regiones', 'RegionController@store')->name('regiones.store');
	Route::get('/admin/regiones/{slug}/editar', 'RegionController@edit')->name('regiones.edit');
	Route::put('/admin/regiones/{slug}', 'RegionController@update')->name('regiones.update');
	Route::delete('/admin/regiones/{slug}', 'RegionController@destroy')->name('regiones.delete');

	// Provincias
	Route::get('/admin/provincias', 'ProvinceController@index')->name('provincias.index');
	Route::get('/admin/provincias/registrar', 'ProvinceController@create')->name('provincias.create');
	Route::post('/admin/provincias', 'ProvinceController@store')->name('provincias.store');
	Route::get('/admin/provincias/{slug}/editar', 'ProvinceController@edit')->name('provincias.edit');
	Route::put('/admin/provincias/{slug}', 'ProvinceController@update')->name('provincias.update');
	Route::delete('/admin/provincias/{slug}', 'ProvinceController@destroy')->name('provincias.delete');

	// Comunas
	Route::get('/admin/comunas', 'CommuneController@index')->name('comunas.index');
	Route::get('/admin/comunas/registrar', 'CommuneController@create')->name('comunas.create');
	Route::post('/admin/comunas', 'CommuneController@store')->name('comunas.store');
	Route::get('/admin/comunas/{slug}/editar', 'CommuneController@edit')->name('comunas.edit');
	Route::put('/admin/comunas/{slug}', 'CommuneController@update')->name('comunas.update');
	Route::delete('/admin/comunas/{slug}', 'CommuneController@destroy')->name('comunas.delete');

	// Quienes Somos
	Route::get('/admin/quienes-somos', 'SettingController@aboutEdit')->name('nosotros.edit');
	Route::put('/admin/quienes-somos', 'SettingController@aboutUpdate')->name('nosotros.update');

	// Contacto
	Route::get('/admin/contactos', 'SettingController@contactEdit')->name('contactos.edit');
	Route::put('/admin/contactos', 'SettingController@contactUpdate')->name('contactos.update');

	// Farmacias
	Route::get('/admin/farmacias', 'PharmacyController@index')->name('farmacias.index');
	Route::get('/admin/farmacias/registrar', 'PharmacyController@create')->name('farmacias.create');
	Route::post('/admin/farmacias', 'PharmacyController@store')->name('farmacias.store');
	Route::get('/admin/farmacias/{slug}/editar', 'PharmacyController@edit')->name('farmacias.edit');
	Route::put('/admin/farmacias/{slug}', 'PharmacyController@update')->name('farmacias.update');
	Route::delete('/admin/farmacias/{slug}', 'PharmacyController@destroy')->name('farmacias.delete');

	// Convenios
	Route::get('/admin/convenios', 'CovenantController@index')->name('convenios.index');
	Route::get('/admin/convenios/registrar', 'CovenantController@create')->name('convenios.create');
	Route::post('/admin/convenios', 'CovenantController@store')->name('convenios.store');
	Route::get('/admin/convenios/{slug}/editar', 'CovenantController@edit')->name('convenios.edit');
	Route::put('/admin/convenios/{slug}', 'CovenantController@update')->name('convenios.update');
	Route::delete('/admin/convenios/{slug}', 'CovenantController@destroy')->name('convenios.delete');

	// Bolsa de Trabajo
	Route::get('/admin/bolsa-de-trabajo', 'ApplicantController@index')->name('solicitudes.index');
	Route::get('/admin/bolsa-de-trabajo/{slug}', 'ApplicantController@show')->name('solicitudes.show');
	Route::delete('/admin/bolsa-de-trabajo/{slug}', 'ApplicantController@destroy')->name('solicitudes.delete');

	// Términos y condiciones
	Route::get('/admin/terminos/editar', 'SettingController@editTerms')->name('terminos.edit');
	Route::put('/admin/terminos', 'SettingController@updateTerms')->name('terminos.update');
});