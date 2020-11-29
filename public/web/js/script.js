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

//
$(document).ready(function() {
	//socials js
	if ($('#social').length) {
		$("#social").jsSocials({
			showLabel: false,
			showCount: false,
			shares: ["facebook", "twitter"]
		});
	}

	// flatpickr
	if ($('#flatpickr').length) {
		flatpickr(document.getElementById('flatpickr'), {
			locale: 'es',
			enableTime: false,
			dateFormat: "d-m-Y",
			maxDate: "today"
		});
	}

  if ($('#selectDateDiary').length) {
    flatpickr(document.getElementById('selectDateDiary'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      minDate: "today",
      defaultDate: "today"
    });
  }

  //dropify para input file más personalizado
  if ($('.dropify').length) {
    $('.dropify').dropify({
      messages: {
        default: 'Arrastre y suelte un archivo o da click para seleccionarla',
        replace: 'Arrastre y suelte un archivo o haga click para reemplazar',
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
});

$('#btn-search').click(function(event) {
  if ($('#div-search').hasClass('d-none')) {
   $('#div-search').removeClass('d-none');
 } else {
   $('#div-search').addClass('d-none');
 }
});

// Verificación de rut
if ($('#dv').length && $('input[name="dni"]').length) {
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
}

if ($('#valid-dv').length && $('#valid-dni').length) {
  $('#valid-dv, #valid-dni').keyup(function() {
    if ($('#valid-dni').val()>7 && $('#valid-dv').val()!="") {
      var body=$('#valid-dni').val(), dv=$('#valid-dv').val(), total=0, multiple=2;

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
        $.ajax({
          url: '/usuarios/existe',
          type: 'POST',
          dataType: 'json',
          data: {dni: body, dv: dv},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        .done(function(obj) {
          if (obj.status) {
            $('.exist-name').val(obj.name);
            $('.exist-lastname').val(obj.lastname);
            $('.exist-phone').val(obj.phone);
            $('.exist-gender').val(obj.gender);
            $('.exist-birthday').val(obj.birthday);
            $('.exist-email').val(obj.email);
          }

          $('button[type="submit"]').attr('disabled', false);
          Lobibox.notify('success', {
            title: 'El RUT es valido',
            sound: true,
            msg: 'El RUT ha sido verificado exitosamente.'
          });
        });
      }
    }
  });
}

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

      $('#selectProvinces').append($('<option>', {
        value: '',
        text: 'PROVINCIA'
      }));
      $('#selectCommunes').append($('<option>', {
        value: '',
        text: 'COMUNA'
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
    $('#selectProvinces').append($('<option>', {
      value: '',
      text: 'PROVINCIA'
    }));
    $('#selectCommunes').append($('<option>', {
      value: '',
      text: 'COMUNA'
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
        text: 'COMUNA'
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
      text: 'COMUNA'
    }));
    $("#selectCommunes").attr('disabled', true);
  }
});

$('#selectSpecialties').change(function() {
  var slug=$('#selectSpecialties option:selected').val(), service=$('#selectServiceDiary option:selected').val();
  if (slug!="") {
    $.ajax({
      url: '/medicos/agregar',
      type: 'POST',
      dataType: 'json',
      data: {slug: slug, service: service},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#selectDoctors option").remove();
      $('#selectDoctors').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        $('#selectDoctors').append($('<option>', {
          value: obj[i].slug,
          text: obj[i].name
        }));
      }
    });
  } else {
    $("#selectDoctors option").remove();
    $('#selectDoctors').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
  }
});

$('#selectDoctors').change(function() {
  var slug=$('#selectDoctors option:selected').val();
  $('#cardDoctor').addClass('d-none');
  if (slug!="") {
    $.ajax({
      url: '/medicos/buscar',
      type: 'POST',
      dataType: 'json',
      data: {slug: slug},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#photoDoctor").attr('src', '/admins/img/template/imagen.jpg');
      $("#nameDoctor, #descriptionDoctor").text("");
      $("#starsDoctor i").remove();
      $("#photoDoctor").attr('src', '/admins/img/users/'+obj.photo);
      $("#nameDoctor").text(obj.name);
      $("#descriptionDoctor").html(obj.description);
      // $("#specialtiesDoctor").text(obj.specialties);
      for (var i=obj.rating-1; i>=0; i--) {
        $('#starsDoctor').append($('<i>', {
          class: "fa fa-2x fa-star mr-1"
        }));
      }
      $('#cardDoctor').removeClass('d-none');
    });
  } else {
    $("#nameDoctor, #descriptionDoctor").text("");
    $("#starsDoctor i").remove();
  }
});

$('#selectCategories').change(function() {
  var slug=$('#selectCategories option:selected').val(), service=$('#selectServiceDiary option:selected').val();
  if (slug!="") {
    $.ajax({
      url: '/subcategorias/agenda/agregar',
      type: 'POST',
      dataType: 'json',
      data: {slug: slug, service: service},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#selectSubcategories option").remove();
      $('#selectSubcategories').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        $('#selectSubcategories').append($('<option>', {
          value: obj[i].slug,
          text: obj[i].name
        }));
      }
    });
  } else {
    $("#selectSubcategories option").remove();
    $('#selectSubcategories').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
  }
});

$('#selectServiceDiary').change(function() {
  var slug=$('#selectServiceDiary option:selected').val();
  $('#cardDoctor').addClass('d-none');
  if (slug!="") {
    var type=$('#selectServiceDiary option:selected').attr('type');
    if (type==1) {
      var specialty=$('#selectSpecialties option:selected').val();
      if (specialty!="") {
        $.ajax({
          url: '/medicos/agregar',
          type: 'POST',
          dataType: 'json',
          data: {slug: specialty, service: slug},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        .done(function(obj) {
          $("#selectDoctors option").remove();
          $('#selectDoctors').append($('<option>', {
            value: '',
            text: 'Seleccione'
          }));
          for (var i=obj.length-1; i>=0; i--) {
            $('#selectDoctors').append($('<option>', {
              value: obj[i].slug,
              text: obj[i].name
            }));
          }
        });
      }
    }

    if (type==2) {
      var category=$('#selectCategories option:selected').val();
      if (category!="") {
        $.ajax({
          url: '/subcategorias/agenda/agregar',
          type: 'POST',
          dataType: 'json',
          data: {slug: category, service: slug},
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        .done(function(obj) {
          $("#selectSubcategories option").remove();
          $('#selectSubcategories').append($('<option>', {
            value: '',
            text: 'Seleccione'
          }));
          for (var i=obj.length-1; i>=0; i--) {
            $('#selectSubcategories').append($('<option>', {
              value: obj[i].slug,
              text: obj[i].name
            }));
          }
        });
      }
    }
  }
});

// Cambiar selects dependiendo del tipo de servicio
$('#selectServiceDiary').change(function() {
  var val=$('#selectServiceDiary option:selected').val();
  if (val!="") {
    var type=$('#selectServiceDiary option:selected').attr('type');
    if (type==1) {
      $("#serviceTypeExam").addClass('d-none');
      $("#serviceTypeExam select").attr('disabled', true);
      $("#serviceTypeDoctor").removeClass('d-none');
      $("#serviceTypeDoctor select").attr('disabled', false);
    }
    if (type==2) {
      $("#serviceTypeDoctor").addClass('d-none');
      $("#serviceTypeDoctor select").attr('disabled', true);
      $("#serviceTypeExam").removeClass('d-none');
      $("#serviceTypeExam select").attr('disabled', false);
    }
  } else {
    $("#serviceTypeDoctor, #serviceTypeExam").addClass('d-none');
    $("#serviceTypeDoctor select, #serviceTypeExam select").attr('disabled', true);
  }
});

// Obtener disponibilidad al cambiar la fecha
$('#selectDateDiary').change(function() {
  var val=$('#selectDateDiary').val(), service=$('#selectDateDiary').attr('service'), selected=$('#selectDateDiary').attr('select');
  $('#scheduleDiary').addClass('d-none');
  $('button[action="diary"]').attr('disabled', true);
  if (val!="") {
    $.ajax({
      url: '/agenda/servicio',
      type: 'POST',
      dataType: 'json',
      data: {date: val, service: service, selected: selected},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    })
    .done(function(obj) {
      $("#timeDiary div").remove();
      $("#dateDiary").text(val);

      if (obj.length>0) {
        for (var i=obj.length-1; i>=0; i--) {
          if (obj[i].type==1) {
            var type="bg-available";
          } else {
            var type="bg-not-available";
          }
          $('#timeDiary').append($('<div>', {
            class: "col-xl-4 col-lg-3 col-md-4 col-4"
          }).append($('<p>', {
            class: "text-white text-center font-weight-bold "+type+" rounded p-1",
            type: obj[i].type,
            text: obj[i].time
          })));
        }

        $('#timeDiary div p').on('click', function(event) {
          if ($(this).hasClass('bg-available')) {
            $('#timeDiary div p[type="1"]').addClass('bg-available');
            $('#timeDiary div p[type="2"]').addClass('bg-not-available');
            $('#timeDiary div p').removeClass('bg-selected');
            $(this).addClass('bg-selected');
            $(this).removeClass('bg-available');
            $('#inputTimeDiary').val($(this).text());
            $('button[action="diary"]').attr('disabled', false);
          }
        });
      } else {
        $('#timeDiary').append($('<div>', {
          class: "col-12"
        }).append($('<p>', {
          class: "h3 text-center text-danger font-weight-bold",
          text: "No hay un horario disponible este día"
        })));
      }

      $('#scheduleDiary').removeClass('d-none');
    });
  } else {
    $('#scheduleDiary').addClass('d-none');
  }
});

// Seleccionar hora para agendar cita
$('#timeDiary div p').click(function() {
  if ($(this).hasClass('bg-available')) {
    $('#timeDiary div p[type="1"]').addClass('bg-available');
    $('#timeDiary div p[type="2"]').addClass('bg-not-available');
    $('#timeDiary div p').removeClass('bg-selected');
    $(this).addClass('bg-selected');
    $(this).removeClass('bg-available');
    $('#inputTimeDiary').val($(this).text());
    $('button[action="diary"]').attr('disabled', false);
  }
});