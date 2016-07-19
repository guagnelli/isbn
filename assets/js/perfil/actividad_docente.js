$(function() {

    $('#btn_agregar_actividad_modal').on('click', function() {
        var isReadOnly = $('.nameFields').prop('readonly');
        $('.nameFields').prop('readonly', !isReadOnly);
        var a = hrutes['get_data_ajax_actividad'];
        var cad_split = a.split(":");
//        data_ajax(site_url + '/perfil    /get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
        data_ajax(site_url + '/' + cad_split[0] + '/get_data_ajax_actividad_modal/0   ', '#form_actividad_docente_general', '#modal_content');
//        data_ajax(site_url + '/' + cad_split[0] + '/get_data_ajax_actividad_modal', '#form_actividad_docente_general', '#modal_content');
//        alert('continua.....');
    });

    $('#btn_guardar_actividad').on('click', function() {//Llama agetget_"data_ajax_actividad" para guardar información
//        data_ajax(site_url + '/perfil/get_data_ajax_actividad/', '#form_actividad_docente', '#get_data_ajax_actividad');
        apprise('Confirme que realmente desea actualizar los datos', {verify: true}, function(btnClick) {
            if (btnClick) {
                $.ajax({
                    url: site_url + '/perfil/get_data_ajax_actividad',
                    data: $('#form_actividad_docente').serialize(),
                    method: 'POST',
                    beforeSend: function(xhr) {
                        $('#get_data_ajax_actividad').html(create_loader());
                    }
                })
                        .done(function(response) {
//                            alert(response);
                            $('#get_data_ajax_actividad').html(response);
                            $('#mensaje_error').html('Los datos se almacenaron correctamente');
                            $('#mensaje_error_div').removeClass('alert-danger').addClass('alert-success');
                            $('#div_error').show();
                            setTimeout("$('#div_error').hide()", 5000);//desaparece div
                        })
                        .fail(function(jqXHR, response) {
                            $('#get_data_ajax_actividad').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                        })
                        .always(function() {
                            remove_loader();
                        });
            } else {
                return false;
            }
        });
    });

//    $('#btn_guardar_actividad_especifica').on('click', function() {//Llama agetget_"data_ajax_actividad" para guardar información
//        var x = document.getElementById("#btn_guardar_actividad_especifica");
//        alert('aa' + x.value);
//        //data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/1', '#form_actividad_docente_especifico', '#info_actividad_docente');
//    });
});

//$('#fecha_inicio_pick').datetimepicker({
//    icons: {
//        time: "fa fa-clock-o",
//        date: "fa fa-calendar",
//        up: "fa fa-arrow-up",
//        down: "fa fa-arrow-down"
//    }
//});
//$('#fecha_fin_pick').datetimepicker({
//    icons: {
//        time: "fa fa-clock-o",
//        date: "fa fa-calendar",
//        up: "fa fa-arrow-up",
//        down: "fa fa-arrow-down"
//    }
//});

//document.getElementById("tipo_actividad_docente").onchange = function() {
//    tipo_actividad_docente();
//};

//function tipo_actividad_docente() {
//    var x = document.getElementById("tipo_actividad_docente");
//}

function funcion_eliminar_actividad_docente(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var a = hrutes['get_data_ajax_actividad'];
    var cad_split = a.split(":");
    var index_tp_actividad = button_obj.data('cvead');
    var index_entidad = button_obj.data('tacve');
    var is_curso_principal = button_obj.data('cp');
    if (is_curso_principal===1) {
        apprise('Es un curso principal, no es posible eliminar');
    } else {

        apprise('Confirme que realmente desea eliminar la actividad', {verify: true}, function(btnClick) {
            if (btnClick) {
                var button_obj = $(element);
                $.ajax({
                    url: site_url + '/' + cad_split[0] + '/get_data_ajax_eliminar_actividad_modal',
                    data: {
                        index_tp_actividad: index_tp_actividad,
                        index_entidad: index_entidad,
                        is_curso_principal: is_curso_principal,
                    },
                    method: 'POST',
                    beforeSend: function(xhr) {

                    }
                })
                        .done(function(response) {
                            var response = $.parseJSON(response);
                            $('#mensaje_error').html(response.error);
                            $('#mensaje_error_div').removeClass('alert-danger').addClass('alert-success');
                            $('#id_row_' + button_obj.data('idrow')).remove();
                            $('#div_error').show();
                            setTimeout("$('#div_error').hide()", 5000);

                        })
                        .fail(function(jqXHR, response) {
                            $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                            $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
                            $('#div_error').show();
                            setTimeout("$('#div_error').hide()", 6000);
                        })
                        .always(function() {
                            remove_loader();
                        });
            } else {
                return false;
            }
        });
    }


}
function funcion_asignar_curso_principal(element) {
    var radio_curso_principal = $(element);
    var a = hrutes['get_data_ajax_actividad'];
    var cad_split = a.split(":");
    var entidad_tp_a_cve = radio_curso_principal.data('entidadtpacve');
    var act_general_cve = radio_curso_principal.data('actividadgeneralcve');
    var act_docente_cve = radio_curso_principal.data('actividaddocentecve');
    var cp = radio_curso_principal.data('cp');
    var key_row_select = radio_curso_principal.data('keyrowselect');
//    alert(act_general_cve + ' ' + entidad_tp_a_cve + ' ' + act_docente_cve + ' ' + cp);
    //Busca el row de la tabla que contiene el curso principal



    $.ajax({
        url: site_url + '/perfil/get_data_ajax_actualiza_curso_principal',
        data: {
            actividad_general_cve: act_general_cve,
            index_tp_actividad: entidad_tp_a_cve,
            actividad_docente_cve: act_docente_cve,
        },
        method: 'POST',
        beforeSend: function(xhr) {
//            $('#tabla_actividades_docente').html(create_loader());
        }
    })
            .done(function(response) {
                var response = $.parseJSON(response);//
                $('#mensaje_error_div').removeClass('alert-danger').removeClass('alert-success');
                if (response.result === 1) {
                    //Actializa vista de curso principal
                    $('#mensaje_error').html(response.error);
                    var cur_principal = curso_principal_actividad_docente();
                    $('#id_row_' + cur_principal).removeClass('success').addClass('');
                    $('#id_row_' + cur_principal).data("cp", 0);
                    $('#id_row_' + cur_principal).find('td').find('button[id=btn_eliminar_actividad_modal]').data("cp", 0);
                    $('#id_row_' + key_row_select).removeClass('').addClass('success');
                    $('#id_row_' + key_row_select).data("cp", 1);
                    $('#id_row_' + key_row_select).find('td').find('button[id=btn_eliminar_actividad_modal]').data("cp", 1);


                }
                $('#mensaje_error_div').addClass('alert-' + response.tipo_msg);
                $('#mensaje_error').html(response.error);
                $('#div_error').show();
                setTimeout("$('#div_error').hide()", 5000);
            })
            .fail(function(jqXHR, response) {
                $('#mensaje_error_div').removeClass('alert-danger').removeClass('alert-success');
                $('#mensaje_error_div').addClass('alert-danger');
                $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                $('#div_error').show();
                setTimeout("$('#div_error').hide()", 5000);
//                $('#div_error').show();
//                $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
            })
            .always(function() {
                remove_loader();
            });

}



/**
 * 
 * @returns {}Obtiene el row de a la tabla de actividad docente que contiene 
 * el curso principal 
 */
function curso_principal_actividad_docente() {
    var cur_prin_actual = -1;
    var obj_row;
    for (var i = 0; i < document.getElementById('tabla_actividades').rows.length; i++) {
        obj_row = $(document.getElementById('tabla_actividades').rows[i]);
        if (obj_row.data('cp') === '1' || obj_row.data('cp') === 1) {
            cur_prin_actual = obj_row.data('keyrow');
            break;
        }
    }
    return cur_prin_actual;
}

function funcion_agregar_nueva_actividad() {
    //////////////
    var valor_radio_curso = '123';
    var titulo_tipo_actividad = 'titulo prueba';
    var anio = '2005';
    var duracion = '78';
    var fecha_inicio = '78';
    var fecha_fin = '546';
    var tacve = '100';
    var cvead = '30';
    var cp = '0';
    var idrow = funcion_obtener_max_id_row_table_actividad() + 1;//Obtiene el maximo index de el row de la tabla de actividades
    ////////////

    var htmlRowTemplate = $('#template_row_nueva_act').html();
    var htmlNewRow = htmlRowTemplate.replace(/\$\$valor_radio_curso\$\$/g, valor_radio_curso)
            .replace(/\$\$titulo_tipo_actividad\$\$/g, titulo_tipo_actividad)
            .replace(/\$\$anio\$\$/g, anio)
            .replace(/\$\$duracion\$\$/g, duracion)
            .replace(/\$\$fecha_inicio\$\$/g, fecha_inicio)
            .replace(/\$\$fecha_fin\$\$/g, fecha_fin)
            .replace(/\$\$tacve\$\$/g, tacve)
            .replace(/\$\$cvead\$\$/g, cvead)
            .replace(/\$\$cp\$\$/g, cp)
            .replace(/\$\$idrow\$\$/g, idrow)
            .replace(/\$\$key\$\$/g, idrow);//identificador unitario de el row
    $('#tabla_actividades').append($(htmlNewRow));
}

/**
 * 
 * @returns {Number} Recorre los row(s) de la tabla actividad docente, para 
 * obtener el index máximo del row
 */
function funcion_obtener_max_id_row_table_actividad() {
    var index_macx = -1;
    var obj_row;

    for (var i = 0; i < document.getElementById('tabla_actividades').rows.length; i++) {
        obj_row = $(document.getElementById('tabla_actividades').rows[i]);
        if (index_macx < obj_row.data('keyrow')) {
            index_macx = cur_prin_actual = obj_row.data('keyrow');
        }
    }
    return index_macx;
}


//function funcion_guargar(index) {
//    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
//}
function funcion_guargar(index) {
//    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
    $.ajax({
        url: site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/0',
        data: $('#form_actividad_docente_especifico').serialize(),
        method: 'POST',
        beforeSend: function(xhr) {
            $('#info_actividad_docente').html(create_loader());
        }
    })
            .done(function(response) {
                var is_html = response.indexOf('<div class=\"list-group\">');//si existe la cadena, entonces es un html
//                alert(is_html + ' ' + response);
                if (is_html > -1) {
                    $('#info_actividad_docente').html(response);
//                    $('#modal_censo').modal(toggle);
                } else {
                    if (response) {

                        var response_json = $.parseJSON(response);//
                        var valor_radio_curso = response_json.insertar[0].cve_actividad_docente;
                        var titulo_tipo_actividad = response_json.insertar[0].nombre_tp_actividad;
                        var anio = response_json.insertar[0].anio;
                        var duracion = response_json.insertar[0].duracion;
                        var fecha_inicio = response_json.insertar[0].fecha_inicio;
                        var fecha_fin = response_json.insertar[0].fecha_fin;
                        var tacve = response_json.insertar[0].ta_cve;
                        var cvead = response_json.insertar[0].cve_actividad_docente;
                        var cp = '0';
                        var idrow = funcion_obtener_max_id_row_table_actividad() + 1;//Obtiene el maximo index de el row de la tabla de actividades
                        ////////////
                        duracion = (duracion === null) ? '' : duracion;
                        fecha_inicio = (fecha_inicio === null) ? '' : fecha_inicio;
                        fecha_fin = (fecha_fin === null) ? '' : fecha_fin;

                        var htmlRowTemplate = $('#template_row_nueva_act').html();
                        var htmlNewRow = htmlRowTemplate.replace(/\$\$valor_radio_curso\$\$/g, valor_radio_curso)
                                .replace(/\$\$titulo_tipo_actividad\$\$/g, titulo_tipo_actividad)
                                .replace(/\$\$anio\$\$/g, anio)
                                .replace(/\$\$duracion\$\$/g, duracion)
                                .replace(/\$\$fecha_inicio\$\$/g, fecha_inicio)
                                .replace(/\$\$fecha_fin\$\$/g, fecha_fin)
                                .replace(/\$\$tacve\$\$/g, tacve)
                                .replace(/\$\$cvead\$\$/g, cvead)
                                .replace(/\$\$cp\$\$/g, cp)
                                .replace(/\$\$idrow\$\$/g, idrow)
                                .replace(/\$\$key\$\$/g, idrow);//identificador unitario de el row
                        $('#tabla_actividades').append($(htmlNewRow))
                        $('#mensaje_error').html(response_json.error);
                        $('#mensaje_error_div').removeClass('alert-danger').addClass('alert-success');
                        $('#div_error').show();
                        setTimeout("$('#div_error').hide()", 5000);
                    }
                }
            })
            .fail(function(jqXHR, response) {
//                $('#div_error').show();
//                $('#mensaje_error').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
            })
            .always(function() {
                remove_loader();
            });
}
function funcion_editar(index, id_actividad) {
    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + index + '/1/' + id_actividad, '#form_actividad_docente_especifico', '#info_actividad_docente');
}
function myFunctionActividad() {
    var x = document.getElementById("tipo_actividad_docente");
    data_ajax(site_url + '/perfil/get_data_ajax_actividad_cuerpo_modal/' + x.value + '/0/0', '#form_actividad_docente_especifico', '#info_actividad_docente');
}

function mostrar_horas_fechas(horas) {
    if (horas == 'none') {
        document.getElementById('div_horas_dedicadas').style.display = 'none';
        document.getElementById('fecha_inicio').style.display = 'block';
        document.getElementById('fecha_fin').style.display = 'block';
    } else {
        document.getElementById('div_horas_dedicadas').style.display = 'block';
        document.getElementById('fecha_inicio').style.display = 'none';
        document.getElementById('fecha_fin').style.display = 'none';
    }
}




