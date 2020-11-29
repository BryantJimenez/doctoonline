/*
=========================================
|                                       |
|           Scroll To Top               |
|                                       |
=========================================
*/ 
$('.scrollTop').click(function() {
  $("html, body").animate({scrollTop: 0});
});


$('.navbar .dropdown.notification-dropdown > .dropdown-menu, .navbar .dropdown.message-dropdown > .dropdown-menu ').click(function(e) {
  e.stopPropagation();
});

/*
=========================================
|                                       |
|       Multi-Check checkbox            |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}


/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

/*
    This MultiCheck Function is recommanded for datatable
    */

    function multiCheck(tb_var) {
      tb_var.on("change", ".chk-parent", function() {
        var e=$(this).closest("table").find("td:first-child .child-chk"), a=$(this).is(":checked");
        $(e).each(function() {
          a?($(this).prop("checked", !0), $(this).closest("tr").addClass("active")): ($(this).prop("checked", !1), $(this).closest("tr").removeClass("active"))
        })
      }),
      tb_var.on("change", "tbody tr .new-control", function() {
        $(this).parents("tr").toggleClass("active")
      })
    }

/*
=========================================
|                                       |
|           MultiCheck                  |
|                                       |
=========================================
*/

function checkall(clickchk, relChkbox) {

  var checker = $('#' + clickchk);
  var multichk = $('.' + relChkbox);


  checker.click(function () {
    multichk.prop('checked', $(this).prop('checked'));
  });    
}

/*
=========================================
|                                       |
|               Tooltips                |
|                                       |
=========================================
*/

$('.bs-tooltip').tooltip();

/*
=========================================
|                                       |
|               Popovers                |
|                                       |
=========================================
*/

$('.bs-popover').popover();


/*
================================================
|                                              |
|               Rounded Tooltip                |
|                                              |
================================================
*/

$('.t-dot').tooltip({
  template: '<div class="tooltip status rounded-tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
})


/*
================================================
|            IE VERSION Dector                 |
================================================
*/

function GetIEVersion() {
  var sAgent = window.navigator.userAgent;
  var Idx = sAgent.indexOf("MSIE");

  // If IE, return version number.
  if (Idx > 0) 
    return parseInt(sAgent.substring(Idx+ 5, sAgent.indexOf(".", Idx)));

  // If IE 11 then look for Updated user agent string.
  else if (!!navigator.userAgent.match(/Trident\/7\./)) 
    return 11;

  else
    return 0; //It is not IE
}

//////// Scripts ////////
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
  //Validación para introducir solo números, la K y borrar
  $('#dv, #search-dv').keypress(function() {
    return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 75 || event.charCode == 107 || event.charCode == 127;
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

  //datepicker material
  if ($('.dateMaterial').length) {
    $('.dateMaterial').bootstrapMaterialDatePicker({
      lang : 'es',
      time: false,
      cancelText: 'Cancelar',
      clearText: 'Limpiar',
      format: 'DD-MM-YYYY',
      maxDate : new Date()
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

  if ($('#selectServiceSubcategory').length || $('#selectServiceDoctor').length) {
    $('#selectServiceSubcategory option:selected, #selectServiceDoctor option:selected').each(function(index, el) {
      var service=el.value;
      $('div[service="'+service+'"] div[schedule]').each(function(index, el) {
        if ($('#'+service+'StartFlatpickr'+index).length && $('#'+service+'EndFlatpickr'+index).length) {
          var startFlatpickr=flatpickr(document.getElementById(service+'StartFlatpickr'+index), {
            locale: 'es',
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            maxTime: "23:59",
            onChange: function(selectedDates, dateStr, instance) {
              endFlatpickr.set("minTime", $("#"+service+"StartFlatpickr"+index).val());
            }
          });

          var endFlatpickr=flatpickr(document.getElementById(service+'EndFlatpickr'+index), {
            locale: 'es',
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minTime: "00:00",
            onChange: function(selectedDates, dateStr, instance) {
              startFlatpickr.set("maxTime", $("#"+service+"EndFlatpickr"+index).val());
            }
          });
        }
      });
    });
  }

  if ($('#selectDateDiary').length) {
    flatpickr(document.getElementById('selectDateDiary'), {
      locale: 'es',
      enableTime: false,
      dateFormat: "d-m-Y",
      minDate: "today"
    });
  }

  //touchspin
  if ($('.children').length) {
    $(".children").TouchSpin({
      min: 1,
      max: 99,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.interval').length) {
    $(".interval").TouchSpin({
      min: 1,
      max: 1000,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  //CKeditor plugin
  if ($('#content-news').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-news');
  }

  if ($('#content-about').length) {
    CKEDITOR.config.height=200;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-about');
  }

  if ($('#content-mission').length) {
    CKEDITOR.config.height=200;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-mission');
  }

  if ($('#content-vision').length) {
    CKEDITOR.config.height=200;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-vision');
  }

  if ($('#content-description').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-description');
  }

  if ($('#content-diary-description').length) {
    CKEDITOR.config.height=200;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-diary-description');
  }

  if ($('#content-app-description').length) {
    CKEDITOR.config.height=200;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-app-description');
  }

  if ($('#content-term').length) {
    CKEDITOR.config.height=400;
    CKEDITOR.config.width='auto';
    CKEDITOR.replace('content-term');
  }
});

// Alternar entre estadisticas semanales y mensuales
$('#week_tab').click(function(event) {
  $('div[tab="month_tab"]').addClass('d-none');
  $('div[tab="week_tab"]').removeClass('d-none');
});

$('#month_tab').click(function(event) {
  $('div[tab="week_tab"]').addClass('d-none');
  $('div[tab="month_tab"]').removeClass('d-none');
});

// funcion para cambiar el input hidden al cambiar el switch de estado
$('#stateCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#stateHidden').val(1);
  } else {
    $('#stateHidden').val(0);
  }
});

// funcion para cambiar el input hidden al cambiar el switch de boton
$('#buttonCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#buttonHidden').val(1);
    $('#buttonInputs').removeClass('d-none');
  } else {
    $('#buttonHidden').val(0);
    $('#buttonInputs').addClass('d-none');
  }
});

// funcion para cambiar el input hidden al cambiar el switch de noticias
$('#featuredCheckbox').change(function(event) {
  if ($(this).is(':checked')) {
    $('#featuredHidden').val(1);
  } else {
    $('#featuredHidden').val(0);
  }
});

//funciones para desactivar y activar usuarios
function deactiveAdmin(slug) {
  $("#deactiveAdmin").modal();
  $('#formDeactiveAdmin').attr('action', '/admin/administradores/' + slug + '/desactivar');
}

function activeAdmin(slug) {
  $("#activeAdmin").modal();
  $('#formActiveAdmin').attr('action', '/admin/administradores/' + slug + '/activar');
}

function deactivePatient(slug) {
  $("#deactivePatient").modal();
  $('#formDeactivePatient').attr('action', '/admin/pacientes/' + slug + '/desactivar');
}

function activePatient(slug) {
  $("#activePatient").modal();
  $('#formActivePatient').attr('action', '/admin/pacientes/' + slug + '/activar');
}

function deactiveDoctor(slug) {
  $("#deactiveDoctor").modal();
  $('#formDeactiveDoctor').attr('action', '/admin/medicos/' + slug + '/desactivar');
}

function activeDoctor(slug) {
  $("#activeDoctor").modal();
  $('#formActiveDoctor').attr('action', '/admin/medicos/' + slug + '/activar');
}

function deactiveBanner(slug) {
  $("#deactiveBanner").modal();
  $('#formDeactiveBanner').attr('action', '/admin/banners/' + slug + '/desactivar');
}

function activeBanner(slug) {
  $("#activeBanner").modal();
  $('#formActiveBanner').attr('action', '/admin/banners/' + slug + '/activar');
}

function deactiveNew(slug) {
  $("#deactiveNew").modal();
  $('#formDeactiveNew').attr('action', '/admin/noticias/' + slug + '/desactivar');
}

function activeNew(slug) {
  $("#activeNew").modal();
  $('#formActiveNew').attr('action', '/admin/noticias/' + slug + '/activar');
}

function deactiveService(slug) {
  $("#deactiveService").modal();
  $('#formDeactiveService').attr('action', '/admin/servicios/' + slug + '/desactivar');
}

function activeService(slug) {
  $("#activeService").modal();
  $('#formActiveService').attr('action', '/admin/servicios/' + slug + '/activar');
}

function deactiveSubcategoryDiary(slug) {
  $("#deactiveSubcategoryDiary").modal();
  $('#formDeactiveSubcategoryDiary').attr('action', '/admin/subcategorias-agenda/' + slug + '/desactivar');
}

function activeSubcategoryDiary(slug) {
  $("#activeSubcategoryDiary").modal();
  $('#formActiveSubcategoryDiary').attr('action', '/admin/subcategorias-agenda/' + slug + '/activar');
}

function deactiveDoctorDiary(slug) {
  $("#deactiveDoctorDiary").modal();
  $('#formDeactiveDoctorDiary').attr('action', '/admin/medico-agenda/' + slug + '/desactivar');
}

function activeDoctorDiary(slug) {
  $("#activeDoctorDiary").modal();
  $('#formActiveDoctorDiary').attr('action', '/admin/medico-agenda/' + slug + '/activar');
}

function deactiveDiary(slug) {
  $("#deactiveDiary").modal();
  $('#formDeactiveDiary').attr('action', '/admin/reservas/' + slug + '/desactivar');
}

function activeDiary(slug) {
  $("#activeDiary").modal();
  $('#formActiveDiary').attr('action', '/admin/reservas/' + slug + '/activar');
}

//funciones para preguntar al eliminar
function deleteAdmin(slug) {
  $("#deleteAdmin").modal();
  $('#formDeleteAdmin').attr('action', '/admin/administradores/' + slug);
}

function deletePatient(slug) {
  $("#deletePatient").modal();
  $('#formDeletePatient').attr('action', '/admin/pacientes/' + slug);
}

function deleteDoctor(slug) {
  $("#deleteDoctor").modal();
  $('#formDeleteDoctor').attr('action', '/admin/medicos/' + slug);
}

function deleteReport(slug) {
  $("#deleteReport").modal();
  $('#formDeleteReport').attr('action', '/admin/informes/' + slug);
}

function deleteBanner(slug) {
  $("#deleteBanner").modal();
  $('#formDeleteBanner').attr('action', '/admin/banners/' + slug);
}

function deleteCategory(slug) {
  $("#deleteCategory").modal();
  $('#formDeleteCategory').attr('action', '/admin/categorias/' + slug);
}

function deleteNew(slug) {
  $("#deleteNew").modal();
  $('#formDeleteNew').attr('action', '/admin/noticias/' + slug);
}

function deleteService(slug) {
  $("#deleteService").modal();
  $('#formDeleteService').attr('action', '/admin/servicios/' + slug);
}

function deleteCategoryDiary(slug) {
  $("#deleteCategoryDiary").modal();
  $('#formDeleteCategoryDiary').attr('action', '/admin/categoria-agenda/' + slug);
}

function deleteSubcategoryDiary(slug) {
  $("#deleteSubcategoryDiary").modal();
  $('#formDeleteSubcategoryDiary').attr('action', '/admin/subcategorias-agenda/' + slug);
}

function deleteApplicant(slug) {
  $("#deleteApplicant").modal();
  $('#formDeleteApplicant').attr('action', '/admin/bolsa-de-trabajo/' + slug);
}

function deleteSpecialty(slug) {
  $("#deleteSpecialty").modal();
  $('#formDeleteSpecialty').attr('action', '/admin/especialidades/' + slug);
}

function deleteInsurer(slug) {
  $("#deleteInsurer").modal();
  $('#formDeleteInsurer').attr('action', '/admin/aseguradoras/' + slug);
}

function deleteProfession(slug) {
  $("#deleteProfession").modal();
  $('#formDeleteProfession').attr('action', '/admin/profesiones/' + slug);
}

function deleteCategoryExam(slug) {
  $("#deleteCategoryExam").modal();
  $('#formDeleteCategoryExam').attr('action', '/admin/categoria-examenes/' + slug);
}

function deleteSubcategory(slug) {
  $("#deleteSubcategory").modal();
  $('#formDeleteSubcategory').attr('action', '/admin/subcategorias/' + slug);
}

function deleteDisease(slug) {
  $("#deleteDisease").modal();
  $('#formDeleteDisease').attr('action', '/admin/enfermedades/' + slug);
}

function deleteOperation(slug) {
  $("#deleteOperation").modal();
  $('#formDeleteOperation').attr('action', '/admin/operaciones/' + slug);
}

function deleteDoctorDiary(slug) {
  $("#deleteDoctorDiary").modal();
  $('#formDeleteDoctorDiary').attr('action', '/admin/medico-agenda/' + slug);
}

function deleteRegion(id) {
  $("#deleteRegion").modal();
  $('#formDeleteRegion').attr('action', '/admin/regiones/' + id);
}

function deleteProvince(id) {
  $("#deleteProvince").modal();
  $('#formDeleteProvince').attr('action', '/admin/provincias/' + id);
}

function deleteCommune(id) {
  $("#deleteCommune").modal();
  $('#formDeleteCommune').attr('action', '/admin/comunas/' + id);
}

function deletePharmacy(slug) {
  $("#deletePharmacy").modal();
  $('#formDeletePharmacy').attr('action', '/admin/farmacias/' + slug);
}

function deleteCovenant(slug) {
  $("#deleteCovenant").modal();
  $('#formDeleteCovenant').attr('action', '/admin/convenios/' + slug);
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
      $("#selectProvinces option").remove();
      $("#selectProvinces").attr('disabled', true);

      $('#selectProvinces').append($('<option>', {
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
    $("#selectProvinces option").remove();
    $('#selectProvinces').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#selectProvinces").attr('disabled', true);
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
          text: obj[i].name
        }));
      }
      $("#selectSubcategories").attr('disabled', false);
    });
  } else {
    $("#selectSubcategories option").remove();
    $('#selectSubcategories').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#selectSubcategories").attr('disabled', true);
  }
});

$('#selectSpecialties').change(function() {
  var slug=$('#selectSpecialties option:selected').val(), service=$('#selectServiceDiary option:selected').val();
  $("#diaryDateTime").addClass('d-none');
  $('#selectTimeDiary option').remove();
  $('#selectTimeDiary').append($('<option>', {
    value: '',
    text: 'Seleccione'
  }));
  $("#diaryDateTime input, #diaryDateTime select").val("");
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
  if (slug!="") {
    $("#diaryDateTime input").attr('select', slug);
    $("#diaryDateTime").removeClass('d-none');
  } else {
    $("#diaryDateTime").addClass('d-none');
    $('#selectTimeDiary option').remove();
    $('#selectTimeDiary').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#diaryDateTime input, #diaryDateTime select").val("");
  }
});

$('#selectCategoriesDiaries').change(function() {
  var slug=$('#selectCategoriesDiaries option:selected').val(), service=$('#selectServiceDiary option:selected').val();
  $("#diaryDateTime").addClass('d-none');
  $('#selectTimeDiary option').remove();
  $('#selectTimeDiary').append($('<option>', {
    value: '',
    text: 'Seleccione'
  }));
  $("#diaryDateTime input, #diaryDateTime select").val("");
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
      $("#selectSubcategoriesDiaries option").remove();
      $('#selectSubcategoriesDiaries').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        $('#selectSubcategoriesDiaries').append($('<option>', {
          value: obj[i].slug,
          text: obj[i].name
        }));
      }
    });
  } else {
    $("#selectSubcategoriesDiaries option").remove();
    $('#selectSubcategoriesDiaries').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
  }
});

$('#selectSubcategoriesDiaries').change(function() {
  var slug=$('#selectSubcategoriesDiaries option:selected').val();
  if (slug!="") {
    $("#diaryDateTime input").attr('select', slug);
    $("#diaryDateTime").removeClass('d-none');
  } else {
    $("#diaryDateTime").addClass('d-none');
    $('#selectTimeDiary option').remove();
    $('#selectTimeDiary').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $("#diaryDateTime input, #diaryDateTime select").val("");
  }
});

$('#selectServiceDiary').change(function() {
  var slug=$('#selectServiceDiary option:selected').val();
  $("#diaryDateTime").addClass('d-none');
  $('#selectTimeDiary option').remove();
  $('#selectTimeDiary').append($('<option>', {
    value: '',
    text: 'Seleccione'
  }));
  $("#diaryDateTime input, #diaryDateTime select").val("");
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
      var category=$('#selectCategoriesDiaries option:selected').val();
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
          $("#selectSubcategoriesDiaries option").remove();
          $('#selectSubcategoriesDiaries').append($('<option>', {
            value: '',
            text: 'Seleccione'
          }));
          for (var i=obj.length-1; i>=0; i--) {
            $('#selectSubcategoriesDiaries').append($('<option>', {
              value: obj[i].slug,
              text: obj[i].name
            }));
          }
        });
      }
    }
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
$('#btn-search-rut').click(function() {
  var rut=$('#search-rut').val(), dv=$('#search-dv').val(), type=$(this).attr('type'), total=0, multiple=2;
  $('#btn-search-rut').attr('disabled', true);
  $('#rutErrors').addClass('d-none');
  $('#rutErrors').text('');

  if (rut=="" && dv=="") {
    $('#rutErrors').removeClass('d-none');
    $('#rutErrors').text('Todos los campos son obligatorios.');
    $('#btn-search-rut').attr('disabled', false);
  } else if(rut.length<2) {
    $('#rutErrors').removeClass('d-none');
    $('#rutErrors').text('Escribe mínimo 2 caracteres.');
    $('#btn-search-rut').attr('disabled', false);
  } else if(rut.length>11) {
    $('#rutErrors').removeClass('d-none');
    $('#rutErrors').text('Escribe máximo 11 caracteres.');
    $('#btn-search-rut').attr('disabled', false);
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
      $('#btn-search-rut').attr('disabled', false);
      Lobibox.notify('warning', {
        title: 'El RUT no es valido',
        sound: true,
        msg: 'Verifique si el RUT y el digito verificador son correctos.'
      });
    } else {

      if (type=="doctor") {
        var url="/medicos/buscar/dni";
      } else {
        var url="/usuarios/buscar/dni";
      }

      $.ajax({
        url: url,
        type: 'POST',
        dataType: 'json',
        data: {dni: rut, dv: dv},
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      })
      .done(function(obj) {
        if (obj.status) {

          if (obj.type=="people") {
            $('#exist-rut').val(obj.dni);
            $('#exist-name').val(obj.name);
            $('#exist-phone').val(obj.phone);
            $('#exist-celular').val(obj.celular);
            $('#exist-gender').val(obj.gender);
            $('#exist-postal').val(obj.postal);
            $('#exist-address-place').val(obj.address_place);
            $('#exist-address').val(obj.address);
            $('#exist-birthday').val(obj.birthday);
            $('#exist-age').val(obj.age);
            $('#exist-email').val(obj.email);
            $('#rut-hidden').val(rut);
            $('#dv-hidden').val(dv);
            $('#slug-hidden').val(obj.slug);

            $('#layout-search, #layout-new-user').addClass('d-none');
            $('#layout-old-user').removeClass('d-none');
          }

          if (obj.type=="patient") {
            Lobibox.notify('warning', {
              title: 'El paciente ya existe',
              sound: true,
              msg: 'El usuario ya esta registrado como un paciente en el sistema.'
            });
          }

          if (obj.type=="doctor") {
            Lobibox.notify('warning', {
              title: 'El médico ya existe',
              sound: true,
              msg: 'El usuario ya esta registrado como un médico en el sistema.'
            });
          }
          $('#btn-search-rut').attr('disabled', false);
          
        } else {
          $('input[name="dni"]').val(rut);
          $('#dv').val(dv);
          $('#layout-search, #layout-old-user').addClass('d-none');
          $('#layout-new-user').removeClass('d-none');
          $('#btn-search-rut').attr('disabled', false);
          Lobibox.notify('success', {
            title: 'El RUT es valido',
            sound: true,
            msg: 'El RUT ha sido verificado exitosamente.'
          });
        }
      });
    }
  }
});

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

// Función para saber el día
function day(day) {
  if (day==0) {
    day="Domingo";
  } else if (day==1) {
    day="Lunes";
  } else if (day==2) {
    day="Martes";
  } else if (day==3) {
    day="Miércoles";
  } else if (day==4) {
    day="Jueves";
  } else if (day==5) {
    day="Viernes";
  } else if (day==6) {
    day="Sábado";
  }
  return day;
}

$('#selectServiceDoctor').change(function() {
  var service=false;
  $('#selectServiceDoctor option:selected').each(function(index, el) {
    if (el.value=="consulta-virtual") {
      service=true;
    }
  });

  if (service) {
    $("#doctorUrl b").removeClass('d-none');
    $("#doctorUrl input").attr('required', true);
  } else {
    $("#doctorUrl b").addClass('d-none');
    $("#doctorUrl input").attr('required', false);
  }
});

// Horarios dependiendo el servicio
$('#selectServiceSubcategory, #selectServiceDoctor').change(function(event) {
  $('#selectServiceSubcategory option:not(:selected), #selectServiceDoctor option:not(:selected)').each(function(index, el) {
    if ($('#serviceSchedule div#'+el.value).length) {
      $('#serviceSchedule div#'+el.value).remove();
    }
  });

  $('#selectServiceSubcategory option:selected, #selectServiceDoctor option:selected').each(function(index, el) {
    if ($('#serviceSchedule div#'+el.value).length===0) {
      $('#serviceSchedule').append($('<div>', {
        class: 'row',
        id: el.value
      }));
      $('#serviceSchedule div#'+el.value).html('<div class="col-12">'+
        '<p class="font-weight-bold">'+el.text+
        '<button type="button" class="btn btn-sm btn-primary diary-add-day px-2 py-1 ml-2" service="'+el.value+'"><i class="fa fa-plus"></i></button>'+
        '<button type="button" class="btn btn-sm btn-danger diary-remove-day d-none px-2 py-1 ml-2" service="'+el.value+'"><i class="fa fa-minus"></i></button>'+
        '</p>'+
        '</div>'+
        '<div class="col-12" service="'+el.value+'">'+
        '<div class="row" schedule="0">'+
        '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
        '<label class="col-form-label">Día<b class="text-danger">*</b></label>'+
        '<select class="form-control" name="day[]" required>'+
        '<option value="1">'+day(1)+'</option>'+
        '<option value="2">'+day(2)+'</option>'+
        '<option value="3">'+day(3)+'</option>'+
        '<option value="4">'+day(4)+'</option>'+
        '<option value="5">'+day(5)+'</option>'+
        '<option value="6">'+day(6)+'</option>'+
        '<option value="0">'+day(0)+'</option>'+
        '</select>'+
        '</div>'+
        '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
        '<label class="col-form-label">Hora de Inicio<b class="text-danger">*</b></label>'+
        '<input class="form-control" type="text" required name="start[]" placeholder="Seleccione" id="'+el.value+'StartFlatpickr0" value="06:00">'+
        '</div>'+
        '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
        '<label class="col-form-label">Hora Final<b class="text-danger">*</b></label>'+
        '<input class="form-control" type="text" name="end[]" placeholder="Seleccione" id="'+el.value+'EndFlatpickr0" value="18:00">'+
        '</div>'+
        '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
        '<label class="col-form-label">Precio<b class="text-danger">*</b></label>'+
        '<input class="form-control decimal" type="text" name="price[]" required placeholder="Introduzca un precio" value="0.00">'+
        '</div>'+
        '<input class="form-control" type="hidden" name="service[]" value="'+el.value+'">'+
        '</div>'+
        '</div>');

      if ($('#'+el.value+'StartFlatpickr0').length && $('#'+el.value+'EndFlatpickr0').length) {
        var startFlatpickr=flatpickr(document.getElementById(el.value+'StartFlatpickr0'), {
          locale: 'es',
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
          time_24hr: false,
          maxTime: "23:59",
          onChange: function(selectedDates, dateStr, instance) {
            endFlatpickr.set("minTime", $("#"+el.value+"StartFlatpickr0").val());
          }
        });

        var endFlatpickr=flatpickr(document.getElementById(el.value+'EndFlatpickr0'), {
          locale: 'es',
          enableTime: true,
          noCalendar: true,
          dateFormat: "H:i",
          time_24hr: false,
          minTime: "00:00",
          onChange: function(selectedDates, dateStr, instance) {
            startFlatpickr.set("maxTime", $("#"+el.value+"EndFlatpickr0").val());
          }
        });
      }

      if ($('.decimal').length) {
        $(".decimal").TouchSpin({
          min: 0,
          max: 999999999,
          step: 0.50,
          decimals: 2,
          buttondown_class: 'btn btn-primary pt-2 pb-3',
          buttonup_class: 'btn btn-primary pt-2 pb-3'
        });
      }

      // Función para agregar horarios
      $('.diary-add-day[service="'+el.value+'"]').on('click', function(event) {
        var schedule=parseInt($('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]:last-child').attr('schedule'))+1;

        $('#serviceSchedule div[service="'+$(this).attr('service')+'"]').append($('<div>', {
          class: 'row',
          schedule: schedule
        }));
        $('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule="'+schedule+'"]').html('<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
          '<label class="col-form-label">Día<b class="text-danger">*</b></label>'+
          '<select class="form-control" name="day[]" required>'+
          '<option value="1">'+day(1)+'</option>'+
          '<option value="2">'+day(2)+'</option>'+
          '<option value="3">'+day(3)+'</option>'+
          '<option value="4">'+day(4)+'</option>'+
          '<option value="5">'+day(5)+'</option>'+
          '<option value="6">'+day(6)+'</option>'+
          '<option value="0">'+day(0)+'</option>'+
          '</select>'+
          '</div>'+
          '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
          '<label class="col-form-label">Hora de Inicio<b class="text-danger">*</b></label>'+
          '<input class="form-control" type="text" required name="start[]" placeholder="Seleccione" id="'+$(this).attr('service')+'StartFlatpickr'+schedule+'" value="06:00">'+
          '</div>'+
          '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
          '<label class="col-form-label">Hora Final<b class="text-danger">*</b></label>'+
          '<input class="form-control" type="text" name="end[]" placeholder="Seleccione" id="'+$(this).attr('service')+'EndFlatpickr'+schedule+'" value="18:00">'+
          '</div>'+
          '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
          '<label class="col-form-label">Precio<b class="text-danger">*</b></label>'+
          '<input class="form-control decimal" type="text" name="price[]" required placeholder="Introduzca un precio" value="0.00">'+
          '</div>'+
          '<input class="form-control" type="hidden" name="service[]" value="'+$(this).attr('service')+'">');

        if ($('#'+$(this).attr('service')+'StartFlatpickr'+schedule).length && $('#'+$(this).attr('service')+'EndFlatpickr'+schedule).length) {
          var startFlatpickr2=flatpickr(document.getElementById($(this).attr('service')+'StartFlatpickr'+schedule), {
            locale: 'es',
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            maxTime: "23:59",
            onChange: function(selectedDates, dateStr, instance) {
              endFlatpickr2.set("minTime", $("#"+$(this).attr('service')+"StartFlatpickr"+schedule).val());
            }
          });

          var endFlatpickr2=flatpickr(document.getElementById($(this).attr('service')+'EndFlatpickr'+schedule), {
            locale: 'es',
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false,
            minTime: "00:00",
            onChange: function(selectedDates, dateStr, instance) {
              startFlatpickr2.set("maxTime", $("#"+$(this).attr('service')+"EndFlatpickr"+schedule).val());
            }
          });
        }

        if ($('.decimal').length) {
          $(".decimal").TouchSpin({
            min: 0,
            max: 999999999,
            step: 0.50,
            decimals: 2,
            buttondown_class: 'btn btn-primary pt-2 pb-3',
            buttonup_class: 'btn btn-primary pt-2 pb-3'
          });
        }

        if ($('.diary-remove-day[service="'+$(this).attr('service')+'"]').hasClass('d-none')) {
          $('.diary-remove-day[service="'+$(this).attr('service')+'"]').removeClass('d-none');
        }
      });

      // Función para remover horarios
      $('.diary-remove-day[service="'+el.value+'"]').on('click', function(event) {
        if ($('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]').length>1) {
          $('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]:last-child').remove();
        }

        if ($('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]').length==1) {
          $('.diary-remove-day[service="'+$(this).attr('service')+'"]').addClass('d-none');
        }
      });
    }
  });
});

// Función para agregar horarios
$('.diary-add-day[service]').on('click', function(event) {
  var schedule=parseInt($('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]:last-child').attr('schedule'))+1;

  $('#serviceSchedule div[service="'+$(this).attr('service')+'"]').append($('<div>', {
    class: 'row',
    schedule: schedule
  }));
  $('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule="'+schedule+'"]').html('<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
    '<label class="col-form-label">Día<b class="text-danger">*</b></label>'+
    '<select class="form-control" name="day[]" required>'+
    '<option value="1">'+day(1)+'</option>'+
    '<option value="2">'+day(2)+'</option>'+
    '<option value="3">'+day(3)+'</option>'+
    '<option value="4">'+day(4)+'</option>'+
    '<option value="5">'+day(5)+'</option>'+
    '<option value="6">'+day(6)+'</option>'+
    '<option value="0">'+day(0)+'</option>'+
    '</select>'+
    '</div>'+
    '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
    '<label class="col-form-label">Hora de Inicio<b class="text-danger">*</b></label>'+
    '<input class="form-control" type="text" required name="start[]" placeholder="Seleccione" id="'+$(this).attr('service')+'StartFlatpickr'+schedule+'" value="06:00">'+
    '</div>'+
    '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
    '<label class="col-form-label">Hora Final<b class="text-danger">*</b></label>'+
    '<input class="form-control" type="text" name="end[]" placeholder="Seleccione" id="'+$(this).attr('service')+'EndFlatpickr'+schedule+'" value="18:00">'+
    '</div>'+
    '<div class="form-group col-lg-3 col-md-6 col-sm-6 col-12">'+
    '<label class="col-form-label">Precio<b class="text-danger">*</b></label>'+
    '<input class="form-control decimal" type="text" name="price[]" required placeholder="Introduzca un precio" value="0.00">'+
    '</div>'+
    '<input class="form-control" type="hidden" name="service[]" value="'+$(this).attr('service')+'">');

  if ($('#'+$(this).attr('service')+'StartFlatpickr'+schedule).length && $('#'+$(this).attr('service')+'EndFlatpickr'+schedule).length) {
    var startFlatpickr2=flatpickr(document.getElementById($(this).attr('service')+'StartFlatpickr'+schedule), {
      locale: 'es',
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: false,
      maxTime: "23:59",
      onChange: function(selectedDates, dateStr, instance) {
        endFlatpickr2.set("minTime", $("#"+$(this).attr('service')+"StartFlatpickr"+schedule).val());
      }
    });

    var endFlatpickr2=flatpickr(document.getElementById($(this).attr('service')+'EndFlatpickr'+schedule), {
      locale: 'es',
      enableTime: true,
      noCalendar: true,
      dateFormat: "H:i",
      time_24hr: false,
      minTime: "00:00",
      onChange: function(selectedDates, dateStr, instance) {
        startFlatpickr2.set("maxTime", $("#"+$(this).attr('service')+"EndFlatpickr"+schedule).val());
      }
    });
  }

  if ($('.decimal').length) {
    $(".decimal").TouchSpin({
      min: 0,
      max: 999999999,
      step: 0.50,
      decimals: 2,
      buttondown_class: 'btn btn-primary pt-2 pb-3',
      buttonup_class: 'btn btn-primary pt-2 pb-3'
    });
  }

  if ($('.diary-remove-day[service="'+$(this).attr('service')+'"]').hasClass('d-none')) {
    $('.diary-remove-day[service="'+$(this).attr('service')+'"]').removeClass('d-none');
  }
});

// Función para remover horarios
$('.diary-remove-day[service]').on('click', function(event) {
  if ($('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]').length>1) {
    $('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]:last-child').remove();
  }

  if ($('#serviceSchedule div[service="'+$(this).attr('service')+'"] div[schedule]').length==1) {
    $('.diary-remove-day[service="'+$(this).attr('service')+'"]').addClass('d-none');
  }
});

// Cambiar selects dependiendo del tipo de servicio
$('#selectServiceDiary').change(function() {
  var val=$('#selectServiceDiary option:selected').val();
  if (val!="") {
    $("#diaryDateTime input").attr('service', val);
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
      $('#selectTimeDiary option').remove();

      $('#selectTimeDiary').append($('<option>', {
        value: '',
        text: 'Seleccione'
      }));
      for (var i=obj.length-1; i>=0; i--) {
        if (obj[i].type==1) {
          $('#selectTimeDiary').append($('<option>', {
            value: obj[i].time,
            text: obj[i].time
          }));
        } else {
          $('#selectTimeDiary').append($('<option>', {
            value: obj[i].time,
            text: obj[i].time,
            disabled: "disabled"
          }));
        }

      }

      $('button[action="diary"]').attr('disabled', false);
    });
  } else {
    $('#selectTimeDiary option').remove();
    $('#selectTimeDiary').append($('<option>', {
      value: '',
      text: 'Seleccione'
    }));
    $('button[action="diary"]').attr('disabled', false);
  }
});