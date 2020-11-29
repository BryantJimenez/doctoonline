$(document).ready(function(){
	//Usuarios login
	$("button[action='login']").on("click",function(){
		$("#formLogin").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='login']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Usuarios register
	$("button[action='register']").on("click",function(){
		$("#formRegister").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				first_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				second_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				gender: {
					required: true
				},

				country_id: {
					required: true
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				},

				commune_id: {
					required: true
				},

				birthday: {
					required: true,
					date: false
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				terms: {
					required: true
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				first_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				second_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				},

				commune_id: {
					required: 'Seleccione una opción.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Recuperar Contraseña
	$("button[action='reset']").on("click",function(){
		$("#formReset").validate({
			rules:
			{
				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='reset']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Perfil
	$("button[action='profile']").on("click",function(){
		$("#formProfile").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='profile']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Administradores
	$("button[action='admin']").on("click",function(){
		$("#formAdministrator").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/administradores/email",
						type: "get"
					}
				},

				phone: {
					required: false,
					minlength: 5,
					maxlength: 15
				},

				type: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='admin']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Pacientes
	$("button[action='patient']").on("click",function(){
		$("#formPatient").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				first_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				second_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				photo: {
					required: false
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				celular: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				country_id: {
					required: true
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				},

				commune_id: {
					required: true
				},

				postal: {
					required: true,
					minlength: 1,
					maxlength: 8
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				birthday: {
					required: true,
					date: false
				},

				civil_state: {
					required: true
				},

				laboral: {
					required: true
				},

				study_id: {
					required: true
				},

				insurer_id: {
					required: true
				},

				children: {
					required: true,
					min: 1,
					max: 99
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				first_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				second_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				celular: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				},

				commune_id: {
					required: 'Seleccione una opción.'
				},

				postal: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				civil_state: {
					required: 'Seleccione una opción.'
				},

				laboral: {
					required: 'Seleccione una opción.'
				},

				study_id: {
					required: 'Seleccione una opción.'
				},

				insurer_id: {
					required: 'Seleccione una opción.'
				},

				children: {
					min: 'Escribe mínimo el número {0}.',
					max: 'Escribe máximo el número {0}.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='patient']").attr('disabled', true);
				form.submit();
			}
		});
});

$("button[action='patientOld']").on("click",function(){
	$("#formPatientOld").validate({
		rules:
		{
			civil_state: {
				required: true
			},

			laboral: {
				required: true
			},

			study_id: {
				required: true
			},

			insurer_id: {
				required: true
			},

			children: {
				required: true,
				min: 1,
				max: 99
			}
		},
		messages:
		{
			civil_state: {
				required: 'Seleccione una opción.'
			},

			laboral: {
				required: 'Seleccione una opción.'
			},

			study_id: {
				required: 'Seleccione una opción.'
			},

			insurer_id: {
				required: 'Seleccione una opción.'
			},

			children: {
				min: 'Escribe mínimo el número {0}.',
				max: 'Escribe máximo el número {0}.'
			}
		},
		submitHandler: function(form) {
			$("button[action='patientOld']").attr('disabled', true);
			form.submit();
		}
	});
});

	//Pacientes editar
	$("button[action='patient']").on("click",function(){
		$("#formPatientEdit").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				first_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				second_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				photo: {
					required: false
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				celular: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				country_id: {
					required: true
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				},

				commune_id: {
					required: true
				},

				postal: {
					required: true,
					minlength: 1,
					maxlength: 8
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				birthday: {
					required: true,
					date: false
				},

				civil_state: {
					required: true
				},

				laboral: {
					required: true
				},

				study_id: {
					required: true
				},

				insurer_id: {
					required: true
				},

				children: {
					required: true,
					min: 1,
					max: 99
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				first_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				second_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				celular: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				},

				commune_id: {
					required: 'Seleccione una opción.'
				},

				postal: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				civil_state: {
					required: 'Seleccione una opción.'
				},

				laboral: {
					required: 'Seleccione una opción.'
				},

				study_id: {
					required: 'Seleccione una opción.'
				},

				insurer_id: {
					required: 'Seleccione una opción.'
				},

				children: {
					min: 'Escribe mínimo el número {0}.',
					max: 'Escribe máximo el número {0}.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='patient']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Médicos
	$("button[action='doctor']").on("click",function(){
		$("#formDoctor").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				first_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				second_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				photo: {
					required: false
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191,
					remote: {
						url: "/usuarios/email",
						type: "get"
					}
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				celular: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				country_id: {
					required: true
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				},

				commune_id: {
					required: true
				},

				postal: {
					required: true,
					minlength: 1,
					maxlength: 8
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				birthday: {
					required: true,
					date: false
				},

				profession: {
					required: true
				},

				number_doctor: {
					required: true,
					minlength: 1,
					maxlength: 191
				},

				inscription: {
					required: true,
					minlength: 1,
					maxlength: 191
				},

				specialty_id: {
					required: true
				},

				signature: {
					required: true
				},

				password: {
					required: true,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				first_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				second_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				celular: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				},

				commune_id: {
					required: 'Seleccione una opción.'
				},

				postal: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				profession: {
					required: 'Seleccione una opción.'
				},

				number_doctor: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				inscription: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				specialty_id: {
					required: 'Seleccione una opción.'
				},

				signature: {
					required: 'Seleccione una foto.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='doctor']").attr('disabled', true);
				form.submit();
			}
		});
});

$("button[action='doctorOld']").on("click",function(){
	$("#formDoctorOld").validate({
		rules:
		{
			profession: {
				required: true
			},

			number_doctor: {
				required: true,
				minlength: 1,
				maxlength: 191
			},

			inscription: {
				required: true,
				minlength: 1,
				maxlength: 191
			},

			specialty_id: {
				required: true
			},

			signature: {
				required: true
			}
		},
		messages:
		{
			profession: {
				required: 'Seleccione una opción.'
			},

			number_doctor: {
				minlength: 'Escribe mínimo {0} caracteres.',
				maxlength: 'Escribe máximo {0} caracteres.'
			},

			inscription: {
				minlength: 'Escribe mínimo {0} caracteres.',
				maxlength: 'Escribe máximo {0} caracteres.'
			},

			specialty_id: {
				required: 'Seleccione una opción.'
			},

			signature: {
				required: 'Seleccione una foto.'
			}
		},
		submitHandler: function(form) {
			$("button[action='doctorOld']").attr('disabled', true);
			form.submit();
		}
	});
});

	//Médicos editar
	$("button[action='doctor']").on("click",function(){
		$("#formDoctorEdit").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				first_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				second_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				photo: {
					required: false
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				celular: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				country_id: {
					required: true
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				},

				commune_id: {
					required: true
				},

				postal: {
					required: true,
					minlength: 1,
					maxlength: 8
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				birthday: {
					required: true,
					date: false
				},

				profession: {
					required: true
				},

				number_doctor: {
					required: true,
					minlength: 1,
					maxlength: 191
				},

				inscription: {
					required: true,
					minlength: 1,
					maxlength: 191
				},

				specialty_id: {
					required: true
				},

				signature: {
					required: false
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				first_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				second_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				celular: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				},

				commune_id: {
					required: 'Seleccione una opción.'
				},

				postal: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				profession: {
					required: 'Seleccione una opción.'
				},

				number_doctor: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				inscription: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				specialty_id: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='doctor']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Create
	$("button[action='banner']").on("click",function(){
		$("#formBannerCreate").validate({
			rules:
			{
				title: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				text: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				button: {
					required: true
				},

				text_button: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				pre_url: {
					required: true
				},

				url: {
					required: false,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				text: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				button: {
					required: 'Seleccione una opción.'
				},

				text_button: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				pre_url: {
					required: 'Seleccione una opción.'
				},

				url: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Banners Edit
	$("button[action='banner']").on("click",function(){
		$("#formBannerEdit").validate({
			rules:
			{
				title: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				text: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				button: {
					required: true
				},

				text_button: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				pre_url: {
					required: true
				},

				url: {
					required: false,
					minlength: 3,
					maxlength: 191
				},

				state: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				text: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				button: {
					required: 'Seleccione una opción.'
				},

				text_button: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				pre_url: {
					required: 'Seleccione una opción.'
				},

				url: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='banner']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Categorias
	$("button[action='category']").on("click",function(){
		$("#formCategory").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='category']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Noticias Create
	$("button[action='new']").on("click",function(){
		$("#formNewCreate").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				content: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				featured: {
					required: true
				},

				category_id: {
					required: true
				},

				state: {
					required: true
				},

				image: {
					required: true
				}
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				content: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				},

				image: {
					required: 'Seleccione una imagen.'
				}
			},
			submitHandler: function(form) {
				$("button[action='new']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Noticias Edit
	$("button[action='new']").on("click",function(){
		$("#formNewEdit").validate({
			rules:
			{
				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				content: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				category_id: {
					required: true
				},

				featured: {
					required: true
				},

				state: {
					required: true
				},
			},
			messages:
			{
				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				content: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				featured: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='new']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Servicios Create
	$("button[action='service']").on("click",function(){
		$("#formServiceCreate").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: true
				},

				banner: {
					required: true
				},

				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				line: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				icon: {
					required: true
				},

				diary_title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				diary_description: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				app_title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				app_description: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				type: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				image: {
					required: 'Seleccione una imagen.'
				},

				banner: {
					required: 'Seleccione una imagen.'
				},

				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				line: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				icon: {
					required: 'Seleccione una imagen.'
				},

				diary_title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				diary_description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				app_title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				app_description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opcion.'
				}
			},
			submitHandler: function(form) {
				$("button[action='service']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Servicios Edit
	$("button[action='service']").on("click",function(){
		$("#formServiceEdit").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				image: {
					required: false
				},

				banner: {
					required: false
				},

				title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				description: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				line: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				icon: {
					required: false
				},

				diary_title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				diary_description: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				app_title: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				app_description: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				},

				type: {
					required: true
				},

				state: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				line: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				diary_title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				diary_description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				app_title: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				app_description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				type: {
					required: 'Seleccione una opcion.'
				},

				state: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='service']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Subcategorias de la Agenda
	$("button[action='subcategory']").on("click",function(){
		$("#formSubcategoryDiary").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				code: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				category_id: {
					required: true
				},

				service_id: {
					required: true
				},

				day: {
					required: true
				},

				start: {
					required: true,
					date: false,
					time: false
				},

				end: {
					required: true,
					date: false,
					time: false
				},

				price: {
					required: true,
					min: 0
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				code: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				service_id: {
					required: 'Seleccione una opción.'
				},

				day: {
					required: 'Seleccione una opción.'
				},

				price: {
					min: 'Escribe un valor mayor o igual a {0}.'
				}
			},
			submitHandler: function(form) {
				$("button[action='subcategory']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Especialidades
	$("button[action='specialty']").on("click",function(){
		$("#formSpecialty").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='specialty']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Aseguradoras
	$("button[action='insurer']").on("click",function(){
		$("#formInsurer").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='insurer']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Profesionales
	$("button[action='profession']").on("click",function(){
		$("#formProfession").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='profession']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Subcategorias
	$("button[action='subcategory']").on("click",function(){
		$("#formSubcategory").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				code: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				category_id: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				code: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='subcategory']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Examenes
	$("button[action='exam']").on("click",function(){
		$("#formExam").validate({
			rules:
			{
				type_id: {
					required: true
				},

				category_id: {
					required: true
				},

				subcategory_id: {
					required: true
				}
			},
			messages:
			{
				type_id: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				subcategory_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='exam']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Enfermedades
	$("button[action='disease']").on("click",function(){
		$("#formDisease").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='disease']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Operaciones
	$("button[action='operation']").on("click",function(){
		$("#formOperation").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='operation']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Médicos de Agenda
	$("button[action='doctor']").on("click",function(){
		$("#formDiaryDoctor").validate({
			rules:
			{
				description: {
					required: true,
					minlength: 2,
					maxlength: 1000
				},

				rating: {
					required: true
				},

				url: {
					minlength: 5,
					maxlength: 191
				},

				doctor_id: {
					required: true
				},

				service_id: {
					required: true
				},

				day: {
					required: true
				},

				start: {
					required: true,
					date: false,
					time: false
				},

				end: {
					required: true,
					date: false,
					time: false
				},

				price: {
					required: true,
					min: 0
				}
			},
			messages:
			{
				description: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				rating: {
					required: 'Seleccione una opción.'
				},

				url: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				doctor_id: {
					required: 'Seleccione una opción.'
				},

				service_id: {
					required: 'Seleccione una opción.'
				},

				day: {
					required: 'Seleccione una opción.'
				},

				price: {
					min: 'Escribe un valor mayor o igual a {0}.'
				}
			},
			submitHandler: function(form) {
				$("button[action='doctor']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Regiones
	$("button[action='region']").on("click",function(){
		$("#formRegion").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='region']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Provincias
	$("button[action='province']").on("click",function(){
		$("#formProvince").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				region_id: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='province']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Comunas
	$("button[action='commune']").on("click",function(){
		$("#formCommune").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='commune']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Quienes Somos
	$("button[action='about']").on("click",function(){
		$("#formAbout").validate({
			rules:
			{
				banner: {
					required: false
				},

				about: {
					required: false,
					minlength: 5,
					maxlength: 64000
				},

				mission: {
					required: false,
					minlength: 5,
					maxlength: 64000
				},

				vision: {
					required: false,
					minlength: 5,
					maxlength: 64000
				}
			},
			messages:
			{
				about: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				mission: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				vision: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='about']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Farmacias
	$("button[action='pharmacy']").on("click",function(){
		$("#formPharmacy").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 2,
					maxlength: 191,
					remote: {
						url: "/farmacias/email",
						type: "get"
					}
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='pharmacy']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Farmacias Edit
	$("button[action='pharmacy']").on("click",function(){
		$("#formPharmacyEdit").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 2,
					maxlength: 191
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='pharmacy']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Convenios
	$("button[action='covenant']").on("click",function(){
		$("#formCovenant").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 2,
					maxlength: 191,
					remote: {
						url: "/convenios/email",
						type: "get"
					}
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.',
					remote: "Este correo ya esta en uso."
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='covenant']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Convenios Edit
	$("button[action='covenant']").on("click",function(){
		$("#formCovenantEdit").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 2,
					maxlength: 191
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='covenant']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Contacto
	$("button[action='contact']").on("click",function(){
		$("#formContact").validate({
			rules:
			{
				phone: {
					required: false,
					minlength: 5,
					maxlength: 20
				},

				email: {
					required: false,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				address: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				map: {
					required: false,
					minlength: 2,
					maxlength: 1000
				},

				address: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				facebook: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				twitter: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				instagram: {
					required: false,
					minlength: 2,
					maxlength: 191
				},

				interval: {
					required: false,
					min: 1,
					max: 1000
				}
			},
			messages:
			{
				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				map: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				facebook: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				twitter: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				instagram: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				interval: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				}
			},
			submitHandler: function(form) {
				$("button[action='contact']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Contacto Web
	$("button[action='contact']").on("click",function(){
		$("#formContactWeb").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				message: {
					required: true,
					minlength: 5,
					maxlength: 64000
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				message: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='contact']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Trabaja con nosotros Web
	$("button[action='applicant']").on("click",function(){
		$("#formApplicantWeb").validate({
			rules:
			{
				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				message: {
					required: true,
					minlength: 5,
					maxlength: 64000
				},

				file: {
					required: true
				}
			},
			messages:
			{
				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				message: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				file: {
					required: 'Seleccione un archivo.'
				}
			},
			submitHandler: function(form) {
				$("button[action='applicant']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Terminos y condiciones
	$("button[action='term']").on("click",function(){
		$("#formTerm").validate({
			rules:
			{
				terms: {
					required: true,
					minlength: 2,
					maxlength: 16770000
				}
			},
			messages:
			{
				terms: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='term']").attr('disabled', true);
				form.submit();
			}
		});
	});

	//Usuarios register editar
	$("button[action='register']").on("click",function(){
		$("#formRegisterEdit").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				first_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				second_lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				photo: {
					required: false
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				celular: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				country_id: {
					required: true
				},

				region_id: {
					required: true
				},

				province_id: {
					required: true
				},

				commune_id: {
					required: true
				},

				postal: {
					required: true,
					minlength: 1,
					maxlength: 8
				},

				address: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				birthday: {
					required: true,
					date: false
				},

				civil_state: {
					required: true
				},

				laboral: {
					required: true
				},

				study_id: {
					required: true
				},

				insurer_id: {
					required: true
				},

				children: {
					required: true,
					min: 1,
					max: 99
				},

				profession: {
					required: true
				},

				number_doctor: {
					required: true,
					minlength: 1,
					maxlength: 191
				},

				inscription: {
					required: true,
					minlength: 1,
					maxlength: 191
				},

				specialty_id: {
					required: true
				},

				signature: {
					required: false
				},

				password: {
					required: false,
					minlength: 8,
					maxlength: 40
				},

				password_confirmation: { 
					equalTo: "#password",
					minlength: 8,
					maxlength: 40
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				first_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				second_lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				celular: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				country_id: {
					required: 'Seleccione una opción.'
				},

				region_id: {
					required: 'Seleccione una opción.'
				},

				province_id: {
					required: 'Seleccione una opción.'
				},

				commune_id: {
					required: 'Seleccione una opción.'
				},

				postal: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				address: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				civil_state: {
					required: 'Seleccione una opción.'
				},

				laboral: {
					required: 'Seleccione una opción.'
				},

				study_id: {
					required: 'Seleccione una opción.'
				},

				insurer_id: {
					required: 'Seleccione una opción.'
				},

				children: {
					min: 'Escribe mínimo el número {0}.',
					max: 'Escribe máximo el número {0}.'
				},

				profession: {
					required: 'Seleccione una opción.'
				},

				number_doctor: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				inscription: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				specialty_id: {
					required: 'Seleccione una opción.'
				},

				password: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				password_confirmation: { 
					equalTo: 'Los datos ingresados no coinciden.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='register']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reportes (Consultas)
	$("button[action='report']").on("click",function(){
		$("#formReport").validate({
			rules:
			{
				reason: {
					required: true,
					minlength: 2,
					maxlength: 65000
				},

				select_personal_history: {
					required: true
				},

				disease_personal: {
					required: true
				},

				personal_history: {
					required: true,
					minlength: 2,
					maxlength: 65000
				},

				select_surgical_history: {
					required: true
				},

				surgicals: {
					required: true
				},

				surgical_history: {
					required: true,
					minlength: 2,
					maxlength: 65000
				},

				select_family_history: {
					required: true
				},

				disease_family: {
					required: true
				},

				family_history: {
					required: true,
					minlength: 2,
					maxlength: 65000
				},

				medicines: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				foods: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				others_allergies: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				alcohol: {
					required: true
				},

				number_liters: {
					required: true,
					min: 0,
					max: 100
				},

				years_taker: {
					required: true,
					min: 0,
					max: 100
				},

				tobacco: {
					required: true
				},

				number_cigarettes: {
					required: true,
					min: 0,
					max: 100
				},

				years_smoker: {
					required: true,
					min: 0,
					max: 100
				},

				drugs: {
					required: true
				},

				years_consumption: {
					required: true,
					min: 0,
					max: 100
				},

				indicate_drugs: {
					required: true,
					minlength: 2,
					maxlength: 65000
				},

				disease_current: {
					required: true,
					minlength: 2,
					maxlength: 65000
				}
			},
			messages:
			{
				reason: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				select_personal_history: {
					required: 'Seleccione una opción.'
				},

				disease_personal: {
					required: 'Seleccione una opción.'
				},

				personal_history: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				select_surgical_history: {
					required: 'Seleccione una opción.'
				},

				surgicals: {
					required: 'Seleccione una opción.'
				},

				surgical_history: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				select_family_history: {
					required: 'Seleccione una opción.'
				},

				disease_family: {
					required: 'Seleccione una opción.'
				},

				family_history: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				medicines: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				foods: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				others_allergies: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				tobacco: {
					required: 'Seleccione una opción.'
				},

				number_cigarettes: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				years_smoker: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				alcohol: {
					required: 'Seleccione una opción.'
				},

				number_liters: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				years_taker: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				drugs: {
					required: 'Seleccione una opción.'
				},

				years_consumption: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				indicate_drugs: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				disease_current: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='report']").attr('disabled', true);
				form.submit();
			}
		});
});

	// Reportes (Revision)
	$("button[action='report']").on("click",function(){
		$("#formReportTwo").validate({
			rules:
			{
				weight: {
					required: true,
					min: 0,
					max: 999
				},

				height: {
					required: true,
					min: 0,
					max: 999
				},

				temperature: {
					required: true,
					min: 0,
					max: 999
				},

				systolic_pressure: {
					required: true,
					min: 0,
					max: 999
				},

				dystolic_pressure: {
					required: true,
					min: 0,
					max: 999
				},

				pulse: {
					required: true,
					min: 0,
					max: 999
				},

				frequency: {
					required: true,
					min: 0,
					max: 999
				},

				mucous: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				head_neck: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				respiratory: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				cardiovascular: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				abdomen: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				others_exams: {
					required: false,
					minlength: 2,
					maxlength: 65000
				}
			},
			messages:
			{
				weight: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				height: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				temperature: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				systolic_pressure: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				dystolic_pressure: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				pulse: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				frequency: {
					min: 'Escribe un valor mayor o igual a {0}.',
					max: 'Escribe un valor menor o igual a {0}.'
				},

				mucous: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				head_neck: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				respiratory: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				cardiovascular: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				abdomen: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				others_exams: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='report']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reportes (Ordenes y Examenes)
	$("button[action='report']").on("click",function(){
		$("#formReportThree").validate({
			rules:
			{
				order: {
					required: false,
					minlength: 2,
					maxlength: 65000
				},

				exam_id: {
					required: false
				}
			},
			messages:
			{
				order: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='report']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reportes (Recetas)
	$("button[action='report']").on("click",function(){
		$("#formReportFour").validate({
			rules:
			{
				recipe: {
					required: false,
					minlength: 2,
					maxlength: 65000
				}
			},
			messages:
			{
				recipe: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='report']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reportes (Resultados de Examenes)
	$("button[action='report']").on("click",function(){
		$("#formReportFive").validate({
			rules:
			{
				results: {
					required: true,
					minlength: 2,
					maxlength: 65000
				}
			},
			messages:
			{
				results: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='report']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Reportes (Informe Médico)
	$("button[action='report']").on("click",function(){
		$("#formReportSix").validate({
			rules:
			{
				report: {
					required: true,
					minlength: 2,
					maxlength: 65000
				}
			},
			messages:
			{
				report: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				}
			},
			submitHandler: function(form) {
				$("button[action='report']").attr('disabled', true);
				form.submit();
			}
		});
	});
	
	// Agendar Cita (Identificación)
	$("button[action='diary']").on("click",function(){
		$("#formDiary").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				birthday: {
					required: true,
					date: false
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				}
			},
			submitHandler: function(form) {
				$("button[action='diary']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Agendar Cita (Área y Profesional)
	$("button[action='diary']").on("click",function(){
		$("#formDiaryTwo").validate({
			rules:
			{
				service_id: {
					required: true
				},

				specialty_id: {
					required: true
				},

				doctor_id: {
					required: true
				},

				category_id: {
					required: true
				},

				subcategory_id: {
					required: true
				}
			},
			messages:
			{
				service_id: {
					required: 'Seleccione una opción.'
				},

				specialty_id: {
					required: 'Seleccione una opción.'
				},

				doctor_id: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				subcategory_id: {
					required: 'Seleccione una opción.'
				}
			},
			submitHandler: function(form) {
				$("button[action='diary']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Agendar Cita (Fecha y Hora)
	$("button[action='diary']").on("click",function(){
		$("#formDiaryThree").validate({
			rules:
			{
				date: {
					required: true,
					date: false
				},

				time: {
					required: true
				}
			},
			messages:
			{
				date: {
					required: 'Seleccione una fecha.'
				},

				time: {
					required: 'Seleccione una hora.'
				}
			},
			submitHandler: function(form) {
				$("button[action='diary']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Agenda Create
	$("button[action='diary']").on("click",function(){
		$("#formDiaryCreate").validate({
			rules:
			{
				dni: {
					required: true,
					minlength: 2,
					maxlength: 11
				},

				verify_digit: {
					required: true,
					minlength: 1,
					maxlength: 1
				},

				name: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				lastname: {
					required: true,
					minlength: 2,
					maxlength: 191
				},

				email: {
					required: true,
					email: true,
					minlength: 5,
					maxlength: 191
				},

				phone: {
					required: true,
					minlength: 5,
					maxlength: 15
				},

				gender: {
					required: true
				},

				birthday: {
					required: true,
					date: false
				},

				service_id: {
					required: true
				},

				specialty_id: {
					required: true
				},

				doctor_id: {
					required: true
				},

				category_id: {
					required: true
				},

				subcategory_id: {
					required: true
				},

				date: {
					required: true,
					date: false
				},

				time: {
					required: true
				}
			},
			messages:
			{
				dni: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				verify_digit: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				name: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				lastname: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				email: {
					email: 'Introduce una dirección de correo valida.',
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				phone: {
					minlength: 'Escribe mínimo {0} caracteres.',
					maxlength: 'Escribe máximo {0} caracteres.'
				},

				gender: {
					required: 'Seleccione una opción.'
				},

				birthday: {
					required: 'Seleccione una fecha.'
				},

				service_id: {
					required: 'Seleccione una opción.'
				},

				specialty_id: {
					required: 'Seleccione una opción.'
				},

				doctor_id: {
					required: 'Seleccione una opción.'
				},

				category_id: {
					required: 'Seleccione una opción.'
				},

				subcategory_id: {
					required: 'Seleccione una opción.'
				},

				date: {
					required: 'Seleccione una fecha.'
				},

				time: {
					required: 'Seleccione una hora.'
				}
			},
			submitHandler: function(form) {
				$("button[action='diary']").attr('disabled', true);
				form.submit();
			}
		});
	});

	// Agenda Edit
	$("button[action='diary']").on("click",function(){
		$("#formDiaryEdit").validate({
			rules:
			{
				date: {
					required: true,
					date: false
				},

				time: {
					required: true
				}
			},
			messages:
			{
				date: {
					required: 'Seleccione una fecha.'
				},

				time: {
					required: 'Seleccione una hora.'
				}
			},
			submitHandler: function(form) {
				$("button[action='diary']").attr('disabled', true);
				form.submit();
			}
		});
	});
});