(function($) {

	"use strict";

	$('[data-toggle="tooltip"]').tooltip();

 	// loader
 	var loader = function() {
 		setTimeout(function() { 
 			if($('#ftco-loader').length > 0) {
 				$('#ftco-loader').removeClass('show');
 			}
 		}, 1);
 	};
 	loader();

 })(jQuery);

 //Script para input file personalizado
 if ($("#file-hidden").length) {
  const file_hidden = document.querySelector("#file-hidden"),
  file_photo = document.querySelector(".file-photo");
  // Escuchar cuando cambie
  file_hidden.addEventListener("change", () => {
      // Los archivos seleccionados, pueden ser muchos o uno
      const files = file_hidden.files;
      // Si no hay archivos salimos de la función y quitamos la imagen
      if (!files || !files.length) {
        file_photo.src = "";
        return;
      }
      // Ahora tomamos el primer archivo, el cual vamos a previsualizar
      const first_file = files[0];
      // Lo convertimos a un objeto de tipo objectURL
      const objectURL = URL.createObjectURL(first_file);
      // Y a la fuente de la imagen le ponemos el objectURL
      file_photo.src = objectURL;
    });
}

$(document).ready(function() {
 	//Validación para introducir solo números
 	$('.number, #phone').keypress(function() {
 		return event.charCode >= 48 && event.charCode <= 57;
 	});
	//Validación para introducir solo letras y espacios
	$('#name, #lastname, .only-letters').keypress(function() {
		return event.charCode >= 65 && event.charCode <= 90 || event.charCode >= 97 && event.charCode <= 122 || event.charCode==32;
	});
	//Validación para solo presionar enter y borrar
	$('.date').keypress(function() {
		return event.charCode == 32 || event.charCode == 127;
	});

  //select2
  if ($('.select2').length) {
    $('.select2').select2({
      language: "es",
      placeholder: "Seleccione",
      tags: true
    });
  }

 	//Datatables normal
 	if ($('.table-normal').length) {
 		$('.table-normal').DataTable({
 			"oLanguage": {
 				"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
 				"sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
 				"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
 				"sSearchPlaceholder": "Buscar...",
 				"sLengthMenu": "Mostrar _MENU_ registros",
 				"sProcessing":     "Procesando...",
 				"sZeroRecords":    "No se encontraron resultados",
 				"sEmptyTable":     "Ningún resultado disponible en esta tabla",
 				"sInfoEmpty":      "No hay resultados",
 				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
 				"sInfoPostFix":    "",
 				"sUrl":            "",
 				"sInfoThousands":  ",",
 				"sLoadingRecords": "Cargando...",
 				"oAria": {
 					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
 					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
 				}
 			},
 			"stripeClasses": [],
 			"lengthMenu": [10, 20, 50, 100, 200, 500],
 			"pageLength": 10
 		});
 	}

 	if ($('.table-export').length) {
 		$('.table-export').DataTable({
 			dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
 			buttons: {
 				buttons: [
 				{ extend: 'copy', className: 'btn' },
 				{ extend: 'csv', className: 'btn' },
 				{ extend: 'excel', className: 'btn' },
 				{ extend: 'print', className: 'btn' }
 				]
 			},
 			"oLanguage": {
 				"oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
 				"sInfo": "Resultados del _START_ al _END_ de un total de _TOTAL_ registros",
 				"sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
 				"sSearchPlaceholder": "Buscar...",
 				"sLengthMenu": "Mostrar _MENU_ registros",
 				"sProcessing":     "Procesando...",
 				"sZeroRecords":    "No se encontraron resultados",
 				"sEmptyTable":     "Ningún resultado disponible en esta tabla",
 				"sInfoEmpty":      "No hay resultados",
 				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
 				"sInfoPostFix":    "",
 				"sUrl":            "",
 				"sInfoThousands":  ",",
 				"sLoadingRecords": "Cargando...",
 				"oAria": {
 					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
 					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
 				},
 				"buttons": {
 					"copy": "Copiar",
 					"print": "Imprimir"
 				}
 			},
 			"stripeClasses": [],
 			"lengthMenu": [10, 20, 50, 100, 200, 500],
 			"pageLength": 10
 		});
 	}

  //dropify para input file más personalizado
  if ($('.dropify').length) {
    $('.dropify').dropify({
      messages: {
        default: 'Arrastre y suelte una imagen o da click para seleccionarla',
        replace: 'Arrastre y suelte una imagen o haga click para reemplazar',
        remove: 'Remover',
        error: 'Lo sentimos, el archivo es demasiado grande'
      },
      error: {
        'fileSize': 'El tamaño del archivo es demasiado grande ({{ value }} máximo).',
        'minWidth': 'El ancho de la imagen es demasiado pequeño ({{ value }}}px mínimo).',
        'maxWidth': 'El ancho de la imagen es demasiado grande ({{ value }}}px máximo).',
        'minHeight': 'La altura de la imagen es demasiado pequeña ({{ value }}}px mínimo).',
        'maxHeight': 'La altura de la imagen es demasiado grande ({{ value }}px máximo).',
        'imageFormat': 'El formato de imagen no está permitido (Debe ser {{ value }}).'
      }
    });
  }

  // flatpickr
  if ($('#flatpickr').length) {
    flatpickr(document.getElementById('flatpickr'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      maxDate : "today"
    });
  }

  if ($('#diariesDate').length) {
    flatpickr(document.getElementById('diariesDate'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y"
    });
  }

  //touchspin
  if ($('.int').length) {
    $(".int").TouchSpin({
      initval: 0,
      min: 0,
      max: 999,
      buttondown_class: 'btn btn-primary rounded-0 py-1',
      buttonup_class: 'btn btn-primary rounded-0 py-1'
    });
  }

  if ($('.children').length) {
    $(".children").TouchSpin({
      min: 1,
      max: 99,
      buttondown_class: 'btn btn-primary rounded',
      buttonup_class: 'btn btn-primary rounded'
    });
  }

  if ($('.temperature').length) {
    $(".temperature").TouchSpin({
      initval: 0.0,
      min: 0,
      max: 999,
      step: 0.1,
      decimals: 1,
      postfix: '°C',
      buttondown_class: 'btn btn-primary rounded-0 py-1',
      buttonup_class: 'btn btn-primary rounded-0 py-1',
      postfix_extraclass: "text-dark px-1 pt-1"
    });
  }

  if ($('.pressure').length) {
    $(".pressure").TouchSpin({
      initval: 0.0,
      min: 0,
      max: 999,
      step: 0.1,
      decimals: 1,
      buttondown_class: 'btn btn-primary rounded-0 py-1',
      buttonup_class: 'btn btn-primary rounded-0 py-1'
    });
  }

  if ($('.frequency').length) {
    $(".frequency").TouchSpin({
      initval: 0.0,
      min: 0,
      max: 999,
      step: 0.1,
      decimals: 1,
      buttondown_class: 'btn btn-primary rounded-0 py-1',
      buttonup_class: 'btn btn-primary rounded-0 py-1'
    });
  }

  if ($('.weight').length) {
    $(".weight").TouchSpin({
      initval: 0.0,
      min: 0,
      max: 999,
      step: 0.1,
      decimals: 1,
      postfix: 'Kgs.',
      buttondown_class: 'btn btn-primary rounded-0 py-1',
      buttonup_class: 'btn btn-primary rounded-0 py-1',
      postfix_extraclass: "text-dark px-1 pt-1"
    });
  }

  if ($('.height').length) {
    $(".height").TouchSpin({
      initval: 0.00,
      min: 0,
      max: 999,
      step: 0.05,
      decimals: 2,
      postfix: 'Mts.',
      buttondown_class: 'btn btn-primary rounded-0 py-1',
      buttonup_class: 'btn btn-primary rounded-0 py-1',
      postfix_extraclass: "text-dark px-1 pt-1"
    });
  }

  //Jquery uploader
  if ($('.dm-uploader').length && $('#slug').length) {
    var slug=$('#slug').val();
    $('.dm-uploader').dmUploader({
      url: '/imagenes/informes/editar/'+slug,
      maxFileSize: 20000000,
      extraData: function() {
        return {
          "exam": $(this).attr('exam')
        };
      },
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      onDragEnter: function(){
        this.addClass('active');
      },
      onDragLeave: function(){
        this.removeClass('active');
      },
      onBeforeUpload: function(){
        var exam=this.attr('exam');
        $('button[type="submit"]').attr('disabled', true);
        $(".response[exam='"+exam+"']").text('Subiendo Archivo...');
      },
      onUploadSuccess: function(id, data){
        var obj=data, exam=this.attr('exam');

        if (obj.status) {
          $(".images[exam='"+exam+"']").append($('<div>', {
            'class': 'form-group col-lg-2 col-md-3 col-sm-6 col-12',
            'element': id
          }).append($('<img>', {
            'src': '/admins/img/reports/'+obj.name,
            'class': 'rounded img-fluid'                            
          })).append($('<button>', {
            'type': 'button',
            'class': 'btn btn-danger btn-sm btn-circle btn-absolute-right removeImage',
            'image': id,
            'urlImage': '/admins/img/reports/'+obj.name
          }).append('<i class="fa fa-trash">')));
          $('button[type="submit"]').attr('disabled', false);
          $(".response[exam='"+exam+"'").text('Correcto');
          Lobibox.notify('success', {
            title: 'Registro exitoso',
            sound: true,
            msg: 'La imagen ha sido agregada exitosamente.'
          });

          //funcion para eliminar imagenes de vehiculos
          $('.removeImage').on('click', function(event) {
            var img=$(this).attr('image'), slug=$('#slug').val(), urlImage=event.currentTarget.attributes[3].value;
            urlImage=urlImage.split('/');
            if (slug!="") {
              $.ajax({
                url: '/imagenes/informes/eliminar',
                type: 'POST',
                dataType: 'json',
                data: {slug: slug, url: urlImage[4]},
                headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
              })
              .done(function(obj) {
                if (obj.status) {
                  $("div[element='"+img+"']").remove();
                  Lobibox.notify('success', {
                    title: 'Eliminación Exitosa',
                    sound: true,
                    msg: 'La imagen ha sido eliminada exitosamente.'
                  });
                } else {
                  Lobibox.notify('error', {
                    title: 'Eliminación Fallida',
                    sound: true,
                    msg: 'Ha ocurrido un problema, intentelo nuevamente.'
                  });
                }
              });
            }
          });
        } else {
          $('button[type="submit"]').attr('disabled', false);
          $(".response[exam='"+exam+"'").text('Error');
          Lobibox.notify('error', {
            title: 'Registro Fallido',
            sound: true,
            msg: 'Ha ocurrido un problema, intentelo nuevamente.'
          });
        }
      },
      onUploadError: function(id, xhr, status, message){
        var exam=this.attr('exam');
        $('button[type="submit"]').attr('disabled', false);
        $(".response[exam='"+exam+"'").text('Error');
      },
      onFileSizeError: function(file){
        var exam=this.attr('exam');
        $('button[type="submit"]').attr('disabled', false);
        $(".response[exam='"+exam+"'").text('El archivo \'' + file.name + '\' excede el tamaño máximo permitido.');
      }
    });

  } else if ($('.dm-uploader').length) {
    $('.dm-uploader').dmUploader({
      url: '/imagenes/informes',
      maxFileSize: 20000000,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      onDragEnter: function(){
        this.addClass('active');
      },
      onDragLeave: function(){
        this.removeClass('active');
      },
      onBeforeUpload: function(){
        var exam=this.attr('exam');
        $('button[type="submit"]').attr('disabled', true);
        $(".response[exam='"+exam+"']").text('Subiendo Archivo...');
      },
      onUploadSuccess: function(id, data){
        var obj=data, exam=this.attr('exam');

        if (obj.status) {
          $(".images[exam='"+exam+"']").append($('<div>', {
            'class': 'form-group col-lg-2 col-md-3 col-sm-6 col-12',
            'element': id
          }).append($('<img>', {
            'src': '/admins/img/reports/'+obj.name,
            'class': 'rounded img-fluid'                            
          })).append($('<input>', {
            'type': 'hidden',
            'name': 'files[]',
            'value': obj.name                        
          })).append($('<input>', {
            'type': 'hidden',
            'name': 'exams[]',
            'value': exam                        
          })).append($('<button>', {
            'type': 'button',
            'class': 'btn btn-danger btn-sm btn-circle btn-absolute-right',
            'image': id,
            'urlImage': '/admins/img/reports/'+obj.name,
            'onclick': 'deleteImageCreate("'+id+'");'
          }).append('<i class="fa fa-trash">')));

          $('button[type="submit"]').attr('disabled', false);
          $(".response[exam='"+exam+"']").text('Correcto');
        } else {
          $('button[type="submit"]').attr('disabled', false);
          $(".response[exam='"+exam+"']").text('Error');
        }
      },
      onUploadError: function(id, xhr, status, message){
        var exam=this.attr('exam');
        $('button[type="submit"]').attr('disabled', false);
        $(".response[exam='"+exam+"']").text('Error');
      },
      onFileSizeError: function(file){
        var exam=this.attr('exam');
        $('button[type="submit"]').attr('disabled', false);
        $(".response[exam='"+exam+"']").text('El archivo \'' + file.name + '\' excede el tamaño máximo permitido.');
      }
    });
  }  
});

// Funciones para agregar datos a select
$('#selectRegions').change(function() {
  var id=$('#selectRegions option:selected').val();
  if (id!="") {
    $.ajax({
      url: '/provincias/agregar',
      type: 'POST',
      dataType: 'json',
      data: {id: id},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#selectProvinces option, #selectCommunes option").remove();
      $("#selectProvinces, #selectCommunes").attr('disabled', true);

      $('#selectProvinces, #selectCommunes').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        $('#selectProvinces').append($('<option>', {
          value: obj[i].id,
          text: obj[i].name
        }));
      }
      $("#selectProvinces").attr('disabled', false);
    });
  } else {
    $("#selectProvinces option, #selectCommunes option").remove();
    $('#selectProvinces, #selectCommunes').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#selectProvinces, #selectCommunes").attr('disabled', true);
  }
});

$('#selectProvinces').change(function() {
  var id=$('#selectProvinces option:selected').val();
  if (id!="") {
    $.ajax({
      url: '/comunas/agregar',
      type: 'POST',
      dataType: 'json',
      data: {id: id},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#selectCommunes option").remove();
      $("#selectCommunes").attr('disabled', true);

      $('#selectCommunes').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        $('#selectCommunes').append($('<option>', {
          value: obj[i].id,
          text: obj[i].name
        }));
      }
      $("#selectCommunes").attr('disabled', false);
    });
  } else {
    $("#selectCommunes option").remove();
    $('#selectCommunes').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#selectCommunes").attr('disabled', true);
  }
});

$('#selectCategories').change(function() {
  var slug=$('#selectCategories option:selected').val();
  if (slug!="") {
    $.ajax({
      url: '/subcategorias/agregar',
      type: 'POST',
      dataType: 'json',
      data: {slug: slug},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#selectSubcategories option").remove();
      $("#selectSubcategories").attr('disabled', true);

      $('#selectSubcategories').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        $('#selectSubcategories').append($('<option>', {
          value: obj[i].slug,
          text: obj[i].name,
          code: obj[i].code
        }));
      }
      $("#selectSubcategories").attr('disabled', false);
      $("#code").val("");
    });
  } else {
    $("#selectSubcategories option").remove();
    $('#selectSubcategories').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#selectSubcategories").attr('disabled', true);
    $("#code").val("");
  }
});

$('#selectSubcategories').change(function() {
  var value=$('#selectSubcategories option:selected').val();
  if (value!="") {
    $("#code").val($('#selectSubcategories option:selected').attr('code'));
  } else {
    $("#code").val("");
  }
});

//Validación de cuantos hijos tiene
$('.question_children').change(function() {
  if ($(this).val()=="No") {
    $('.children-content input').attr('disabled', true);
    $('.children-content input').val("1");
    $('.children-content').addClass('d-none');
  } else if ($(this).val()=="Si") {
    $('.children-content input').attr('disabled', false);
    $('.children-content input').val("1");
    $('.children-content').removeClass('d-none');
  }
});

//Calcular edad en base a la fecha de nacimiento
$('input[name="birthday"]').change(function() {
  var date=$(this).val();
  date=date.split("-");
  var today=new Date();
  var birthday=new Date(date[2]+"-"+date[1]+"-"+date[0]);
  var age=today.getFullYear()-birthday.getFullYear();
  var month=today.getMonth()-birthday.getMonth();

  if (month<0 || (month===0 && today.getDate()<birthday.getDate())) {
    age--;
  }
  $('#age').val(age+" Años");
});

// Verificación de rut
$('#dv, input[name="dni"]').keyup(function() {
  if ($('input[name="dni"]').val()>7 && $('#dv').val()!="") {
    var body=$('input[name="dni"]').val(), dv=$('#dv').val(), total=0, multiple=2;

    // Para cada dígito del Cuerpo
    for(i=1; i<=body.length; i++) {
      // Obtener su Producto con el Múltiplo Correspondiente
      index=multiple*body.charAt(body.length-i);
      // Sumar al Contador General
      total=total+index;
      // Consolidar Múltiplo dentro del rango [2,7]
      if(multiple<7) {
        multiple=multiple+1;
      } else {
        multiple=2;
      }
    }

    // Calcular Dígito Verificador en base al Módulo 11
    var dvFinal=11-(total%11);

    // Casos Especiales (0 y K)
    if (dv=='k') {
      var dvCompare=10;
    } else if (dv==0) {
      var dvCompare=11;
    } else {
      var dvCompare=dv;
    }

    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvFinal!=dvCompare) {
      $('button[type="submit"]').attr('disabled', true);
      Lobibox.notify('warning', {
        title: 'El RUT no es valido',
        sound: true,
        msg: 'Verifique si el RUT y el digito verificador son correctos.'
      });
    } else {
      $('button[type="submit"]').attr('disabled', false);
      Lobibox.notify('success', {
        title: 'El RUT es valido',
        sound: true,
        msg: 'El RUT ha sido verificado exitosamente.'
      });
    }
  }
});

//Funcion para buscar paciente por DNI
$('#searchButtonPatient').click(function(event) {
  $('#searchErrors').addClass('d-none');
  $('#searchErrors').text('');
  var rut=$('#searchPatient').val(), dv=$('#searchDv').val(),  total=0, multiple=2;
  $('#searchButtonPatient').attr('disabled', true);

  if (rut=="" || dv=="") {
    $('#searchErrors').removeClass('d-none');
    $('#searchErrors').text('Todos los campos son obligatorios');
    $('#searchButtonPatient').attr('disabled', false);
  } else if(rut.length<2) {
    $('#searchErrors').removeClass('d-none');
    $('#searchErrors').text('Introduzca mínimo 2 digitos');
    $('#searchButtonPatient').attr('disabled', false);
  } else if(rut.length>11) {
    $('#searchErrors').removeClass('d-none');
    $('#searchErrors').text('Introduzca máximo 11 digitos');
    $('#searchButtonPatient').attr('disabled', false);
  } else {

    // Para cada dígito del Cuerpo
    for(i=1; i<=rut.length; i++) {
      // Obtener su Producto con el Múltiplo Correspondiente
      index=multiple*rut.charAt(rut.length-i);
      // Sumar al Contador General
      total=total+index;
      // Consolidar Múltiplo dentro del rango [2,7]
      if(multiple<7) {
        multiple=multiple+1;
      } else {
        multiple=2;
      }
    }

    // Calcular Dígito Verificador en base al Módulo 11
    var dvFinal=11-(total%11);
    
    // Casos Especiales (0 y K)
    if (dv=='k') {
      var dvCompare=10;
    } else if (dv==0) {
      var dvCompare=11;
    } else {
      var dvCompare=dv;
    }
    
    // Validar que el Cuerpo coincide con su Dígito Verificador
    if (dvFinal!=dvCompare) {
      $('#searchButtonPatient').attr('disabled', false);
      Lobibox.notify('warning', {
        title: 'El RUT no es valido',
        sound: true,
        msg: 'Verifique si el RUT y el digito verificador son correctos.'
      });
    } else {

      $.ajax({
        url: '/pacientes/exist',
        type: 'POST',
        dataType: 'json',
        data: {dni: rut, dv: dv},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      .done(function(obj) {
        if (obj.status) {
          var num=1;
          $('#photoUser').attr('src', '/admins/img/users/'+obj.user.photo);
          $('#photoUser').attr('alt', obj.user.name+" "+obj.user.first_lastname+" "+obj.user.second_lastname);
          $('#nameUser').text(obj.user.name+" "+obj.user.first_lastname+" "+obj.user.second_lastname);
          $('#dniUser').text('RUT: '+obj.user.dni);
          $('#movilUser').text('MÓVIL: '+obj.user.movil);
          $('#btnAddReport').attr('href', "informes/"+obj.user.slug+"/registrar");

          $('#reportsRow tr').remove();
          for (var i=obj.reports.length-1; i>=0; i--) {
            if (obj.reports[i].state==2) {
              $('#reportsRow').append($('<tr>').append($('<td>', {
                text: num
              })).append($('<td>', {
                text: obj.reports[i].date
              })).append($('<td>', {
                text: obj.reports[i].reason
              })).append($('<td>', {
                text: obj.reports[i].doctor
              })).append($('<td>', {
                text: "Abierto"
              })).append($('<td>').append($('<a>', {
                class: "btn btn-sm btn-primary rounded",
                href: "informes/"+obj.reports[i].slug,
                text: "CONTINUAR"
              }))));
            } else {
              if ((obj.reports[i].recipe==null || obj.reports[i].recipe=="") && (obj.reports[i].order==null || obj.reports[i].order=="")) {
                $('#reportsRow').append($('<tr>').append($('<td>', {
                  text: num
                })).append($('<td>', {
                  text: obj.reports[i].date
                })).append($('<td>', {
                  text: obj.reports[i].reason
                })).append($('<td>', {
                  text: obj.reports[i].doctor
                })).append($('<td>', {
                  text: "Cerrado"
                })).append($('<td>').append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-2",
                  href: "informes/"+obj.reports[i].slug
                }).append($('<i>', {
                  class: "fa fa-eye"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded",
                  href: "informes/"+obj.reports[i].slug+"/editar"
                }).append($('<i>', {
                  class: "fa fa-edit"
                })))));
              } else if ((obj.reports[i].recipe!=null || obj.reports[i].recipe!="") && (obj.reports[i].order==null || obj.reports[i].order=="")) {
                $('#reportsRow').append($('<tr>').append($('<td>', {
                  text: num
                })).append($('<td>', {
                  text: obj.reports[i].date
                })).append($('<td>', {
                  text: obj.reports[i].reason
                })).append($('<td>', {
                  text: obj.reports[i].doctor
                })).append($('<td>', {
                  text: "Cerrado"
                })).append($('<td>').append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/"+obj.reports[i].slug
                }).append($('<i>', {
                  class: "fa fa-eye"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/"+obj.reports[i].slug+"/editar"
                }).append($('<i>', {
                  class: "fa fa-edit"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded",
                  href: "informes/receta/"+obj.reports[i].slug+"/pdf",
                  target: "_blank"
                }).append($('<i>', {
                  class: "fa fa-file-pdf"
                })))));
              } else if ((obj.reports[i].recipe==null || obj.reports[i].recipe=="") && (obj.reports[i].order!=null || obj.reports[i].order!="")) {
                $('#reportsRow').append($('<tr>').append($('<td>', {
                  text: num
                })).append($('<td>', {
                  text: obj.reports[i].date
                })).append($('<td>', {
                  text: obj.reports[i].reason
                })).append($('<td>', {
                  text: obj.reports[i].doctor
                })).append($('<td>', {
                  text: "Cerrado"
                })).append($('<td>').append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/"+obj.reports[i].slug
                }).append($('<i>', {
                  class: "fa fa-eye"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/"+obj.reports[i].slug+"/editar"
                }).append($('<i>', {
                  class: "fa fa-edit"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded",
                  href: "informes/orden/"+obj.reports[i].slug+"/pdf",
                  target: "_blank"
                }).append($('<i>', {
                  class: "fa fa-file-medical"
                })))));
              } else {
                $('#reportsRow').append($('<tr>').append($('<td>', {
                  text: num
                })).append($('<td>', {
                  text: obj.reports[i].date
                })).append($('<td>', {
                  text: obj.reports[i].reason
                })).append($('<td>', {
                  text: obj.reports[i].doctor
                })).append($('<td>', {
                  text: "Cerrado"
                })).append($('<td>').append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/"+obj.reports[i].slug
                }).append($('<i>', {
                  class: "fa fa-eye"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/"+obj.reports[i].slug+"/editar"
                }).append($('<i>', {
                  class: "fa fa-edit"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded mr-1",
                  href: "informes/receta/"+obj.reports[i].slug+"/pdf",
                  target: "_blank"
                }).append($('<i>', {
                  class: "fa fa-file-pdf"
                }))).append($('<a>', {
                  class: "btn btn-sm btn-primary rounded",
                  href: "informes/orden/"+obj.reports[i].slug+"/pdf",
                  target: "_blank"
                }).append($('<i>', {
                  class: "fa fa-file-medical"
                })))));
              }
              
            }
            num++;
          }
          $('#emptyPatient').addClass('d-none');
          $('#dataPatient, #reportsPatient').removeClass('d-none');
          $('#searchButtonPatient').attr('disabled', false);
          $('#searchPatient, #searchDv').val("");
        } else {
          $('#dataPatient, #reportsPatient').addClass('d-none');
          $('#emptyPatient').removeClass('d-none');
          $('#searchButtonPatient').attr('disabled', false);
          Lobibox.notify(obj.type, {
            title: obj.title,
            sound: true,
            msg: obj.msg
          });
        }
      });
}

}
});

//Validaciones para desarrollar parrafo sobre enfermedades
$('select[name="select_personal_history"]').change(function() {
  if ($(this).val()=="No") {
    $('select[name="disease_personal[]"]').attr('disabled', true);
    $('textarea[name="personal_history"]').attr('disabled', true);
  } else if ($(this).val()=="Si") {
    $('select[name="disease_personal[]"]').attr('disabled', false);
    $('textarea[name="personal_history"]').attr('disabled', false);
  }
});

$('select[name="select_surgical_history"]').change(function() {
  if ($(this).val()=="No") {
    $('select[name="surgicals[]"]').attr('disabled', true);
    $('textarea[name="surgical_history"]').attr('disabled', true);
  } else if ($(this).val()=="Si") {
    $('select[name="surgicals[]"]').attr('disabled', false);
    $('textarea[name="surgical_history"]').attr('disabled', false);
  }
});

$('select[name="select_family_history"]').change(function() {
  if ($(this).val()=="No") {
    $('select[name="disease_family[]"]').attr('disabled', true);
    $('textarea[name="family_history"]').attr('disabled', true);
  } else if ($(this).val()=="Si") {
    $('select[name="disease_family[]"]').attr('disabled', false);
    $('textarea[name="family_history"]').attr('disabled', false);
  }
});

$('select[name="tobacco"]').change(function() {
  if ($(this).val()=="No") {
    $('input[name="number_cigarettes"]').attr('disabled', true);
    $('input[name="years_smoker"]').attr('disabled', true);
  } else if ($(this).val()=="Si") {
    $('input[name="number_cigarettes"]').attr('disabled', false);
    $('input[name="years_smoker"]').attr('disabled', false);
  }
});

$('select[name="alcohol"]').change(function() {
  if ($(this).val()=="No") {
    $('input[name="number_liters"]').attr('disabled', true);
    $('input[name="years_taker"]').attr('disabled', true);
  } else if ($(this).val()=="Si") {
    $('input[name="number_liters"]').attr('disabled', false);
    $('input[name="years_taker"]').attr('disabled', false);
  }
});

$('select[name="drugs"]').change(function() {
  if ($(this).val()=="No") {
    $('input[name="years_consumption"]').attr('disabled', true);
    $('textarea[name="indicate_drugs"]').attr('disabled', true);
  } else if ($(this).val()=="Si") {
    $('input[name="years_consumption"]').attr('disabled', false);
    $('textarea[name="indicate_drugs"]').attr('disabled', false);
  }
});

//Calculo de Fumador
$('input[name="number_cigarettes"]').change(function(event) {
  if ($('input[name="years_smoker"]').val()!="" && $(this).val()!="") {
    var years=parseInt($('input[name="years_smoker"]').val()), number=parseInt($(this).val()), smoker_calc=0;
    smoker_calc=parseFloat((number*years)/20).toFixed(2);
    $('.smoker_calc').text(smoker_calc);
  }
});

$('input[name="number_cigarettes"]').keyup(function(event) {
  if ($('input[name="years_smoker"]').val()!="" && $(this).val()!="") {
    var years=parseInt($('input[name="years_smoker"]').val()), number=parseInt($(this).val()), smoker_calc=0;
    smoker_calc=parseFloat((number*years)/20).toFixed(2);
    $('.smoker_calc').text(smoker_calc);
  }
});

$('input[name="years_smoker"]').change(function(event) {
  if ($(this).val()!="" && $('input[name="number_cigarettes"]').val()!="") {
    var years=parseInt($(this).val()), number=parseInt($('input[name="number_cigarettes"]').val()), smoker_calc=0;
    smoker_calc=parseFloat((number*years)/20).toFixed(2);
    $('.smoker_calc').text(smoker_calc);
  }
});

$('input[name="years_smoker"]').keyup(function(event) {
  if ($(this).val()!="" && $('input[name="number_cigarettes"]').val()!="") {
    var years=parseInt($(this).val()), number=parseInt($('input[name="number_cigarettes"]').val()), smoker_calc=0;
    smoker_calc=parseFloat((number*years)/20).toFixed(2);
    $('.smoker_calc').text(smoker_calc);
  }
});

//Calculo del IMC
$('.height').change(function(event) {
  if ($('.weight').val()!="" && $(this).val()!="") {
    var weight=parseFloat($('.weight').val()), height=parseFloat($(this).val()), imc=0;
    if (weight>0 && height>0) {
      imc=parseFloat(weight/(height*height)).toFixed(2);
    }
    $('.imc').text(imc+" Kg/M2");
  }
});

$('.height').keyup(function(event) {
  if ($('.weight').val()!="" && $(this).val()!="") {
    var weight=parseFloat($('.weight').val()), height=parseFloat($(this).val()), imc=0;
    if (weight>0 && height>0) {
      imc=parseFloat(weight/(height*height)).toFixed(2);
    }
    $('.imc').text(imc+" Kg/M2");
  }
});

$('.weight').change(function(event) {
  if ($('.height').val()!="" && $(this).val()!="") {
    var weight=parseFloat($(this).val()), height=parseFloat($('.height').val()), imc=0;
    if (weight>0 && height>0) {
      imc=parseFloat(weight/(height*height)).toFixed(2);
    }
    $('.imc').text(imc+" Kg/M2");
  }
});

$('.weight').keyup(function(event) {
  if ($('.height').val()!="" && $(this).val()!="") {
    var weight=parseFloat($(this).val()), height=parseFloat($('.height').val()), imc=0;
    if (weight>0 && height>0) {
      imc=parseFloat(weight/(height*height)).toFixed(2);
    }
    $('.imc').text(imc+" Kg/M2");
  }
});

//Examenes
$('#addExam').click(function() {
  $('#examAlertDanger, #examAlertSuccess, #examAlertExist').addClass('d-none');
  $("#addExamModal").modal();
});

$('#submitExam').click(function(event) {
  $('#examErrors').addClass('d-none');
  $('#examErrors').text('');
  var category=$('select[name="categoryExam"]').val(), subcategory=$('select[name="subcategoryExam"]').val(), type=$('select[name="typeExam"]').val();

  if (category=="" && subcategory=="" && type=="") {
    $('#examErrors').removeClass('d-none');
    $('#examErrors').text('Todos los campos son obligatorios.');
  } else {
    $.ajax({
      url: '/examenes/nuevo',
      type: 'POST',
      dataType: 'json',
      data: {category: category, subcategory: subcategory, type: type},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      if (obj.status) {
        $('#selectExam').append($('<option>', {
          value: obj.slug,
          text: obj.name,
          selected: "selected"
        }));
        $('select[name="subcategoryExam"]').val("");
        $('select[name="typeExam"]').val("");
        $('#code').val("");
        $('#examAlertDanger, #examAlertExist').addClass('d-none');
        $('#examAlertSuccess').removeClass('d-none');
        $("#addExamModal").modal("hide");
      } else {
        if (obj.copy) {
          $('#examAlertSuccess, #examAlertDanger').addClass('d-none');
          $('#examAlertExist').removeClass('d-none');
        } else {
          $('#examAlertSuccess, #examAlertExist').addClass('d-none');
          $('#examAlertDanger').removeClass('d-none');
        }
      }
    });
  }
});

//Funcion para eliminar imagenes de los informes
function deleteImageCreate(img){
  $("div[element="+img+"]").remove();
}

//funcion para eliminar imagenes de los informes
$('.removeImage').click(function(event) {
  var img=$(this).attr('image'), slug=$('#slug').val(), urlImage=event.currentTarget.attributes[3].value;
  urlImage=urlImage.split('/');
  if (slug!="") {
    $.ajax({
      url: '/imagenes/informes/eliminar',
      type: 'POST',
      dataType: 'json',
      data: {slug: slug, url: urlImage[6]},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      if (obj.status) {
        $("div[element='"+img+"']").remove();
        Lobibox.notify('success', {
          title: 'Eliminación Exitosa',
          sound: true,
          msg: 'La imagen ha sido eliminada exitosamente.'
        });
      } else {
        Lobibox.notify('error', {
          title: 'Eliminación Fallida',
          sound: true,
          msg: 'Ha ocurrido un problema, intentelo nuevamente.'
        });
      }
    });
  }
});

// Obtener reservas al cambiar la fecha
$('#diariesDate').change(function() {
  var val=$('#diariesDate').val(), slug=$('#diariesDate').attr('slug');
  $("#diaryRow tr").remove();
  if (val!="") {
    $.ajax({
      url: '/agenda/reservas',
      type: 'POST',
      dataType: 'json',
      data: {date: val, slug: slug},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#dateDiary").text(val);

      for (var i=obj.length-1; i>=0; i--) {
        $('#diaryRow').append($('<tr>').append($('<td>', {
          text: i+1
        })).append($('<td>', {
          text: obj[i].date
        })).append($('<td>', {
          text: obj[i].name
        })).append($('<td>', {
          text: obj[i].service
        })).append($('<td>', {
          html: obj[i].state
        })).append($('<td>').append($('<a>', {
          href: "/agenda/"+obj[i].slug,
          class: "btn btn-sm btn-primary text-uppercase rounded",
          text: "Ver"
        }))));
      }
    });
  }
});