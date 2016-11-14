function cambio_estado(element) {
    apprise('Confirme que realmente desea continuar', {verify: true}, function (btnClick) {
        if (btnClick) {
            var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
            var estado_solicitud = button_obj.data('estadosolicitudcve');//    var tipo_transicion =obj.data('tipotransicion');

//    var formData = $('#form_validar_docente').serialize();
            var formData = '&estado_solicitud_cve=' + estado_solicitud;
            $.ajax({
                url: site_url + '/solicitud/enviar_cambio_estado_solicitud',
                data: formData,
                method: 'POST',
                beforeSend: function (xhr) {
                    $('#seccion_validar').html(create_loader());
                }
            })
                    .done(function (response) {
                        try {
                            var response = $.parseJSON(response);
                            if (response.result === 1) {
                                $('#mensaje_error_index').html(response.error);
                                $('#mensaje_error_div_index').removeClass('alert-danger').removeClass('alert-success').addClass('alert-' + response.tipo_msg);
                                $('#div_error_index').show();
                                setTimeout("$('#div_error_index').hide()", 5000);
                                try {
                                    funcion_buscar_solicitudes();//Recarga lista de solicitudes
//                            document.getElementById("regresa_list").accion='onClick';
                                    $(document).ready(function () {
                                        $('.botonF1').trigger('click');
                                    });
                                } catch (e) {
                                    $('#seccion_validar').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                                }
                            } else {
                                $('#mensaje_error_index').html(response.error);
                                $('#mensaje_error_div_index').removeClass('alert-danger').removeClass('alert-success').addClass('alert-' + response.tipo_msg);
                                $('#div_error_index').show();
                                setTimeout("$('#div_error_index').hide()", 5000);
                                try {
                                } catch (e) {
                                    $('#seccion_validar').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                                }

                            }
                        } catch (e) {
//                $('#seccion_validar').html(response);
                            $('#seccion_validar').html(response);

                        }
                    })
                    .fail(function (jqXHR, response) {
//                $('#div_error').show();
                        $('#seccion_validar').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
                    })
                    .always(function () {
                        remove_loader();
                    });
        }
    });
}

//$('.comentario').click(function () {
//    var button_obj = $(this); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
//    var hist_cve = button_obj.data('histsolicitudcve');
//    var solicitud_cve = button_obj.data('solicitudcve');
//    var seccion_cve = button_obj.data('seccioncve');
//    var obj = {hist_cve: hist_cve, solicitud_cve: solicitud_cve, seccion_cve: seccion_cve};
//    data_ajax_post(site_url + '/solicitud/comentarios_seccion', null, '#modal_content', obj);
//});

//$('.guardacomentario').click(function () {
function  funcion_guardar_comentario(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var hist_cve = button_obj.data('histsolicitudcve');
    var solicitud_cve = button_obj.data('solicitudcve');
    var seccion_cve = button_obj.data('seccioncve');

    var formData = $('#form_comentario_seccion').serialize();
    formData += '&hist_cve=' + hist_cve + '&seccion_cve=' + seccion_cve + '&solicitud_cve=' + solicitud_cve;
    $.ajax({
        url: site_url + '/solicitud/comentarios_seccion',
        data: formData,
        method: 'POST',
        beforeSend: function (xhr) {
            $('#modal_content').html(create_loader());
        }
    })
            .done(function (response) {
                try {
                    var response = $.parseJSON(response);
                    if (response.result === 1) {
                        try {//Si noexiste herror, cierra el modal
                            $('#mensaje_error_index').html(response.error);
                            $('#mensaje_error_div_index').removeClass('alert-danger').removeClass('alert-success').addClass('alert-' + response.tipo_msg);
                            $('#div_error_index').show();
                            setTimeout("$('#div_error_index').hide()", 5000);
                            $('#modal_censo').modal('toggle');
                        } catch (e) {
                            $('#seccion_validar').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                        }
                    } else {
                        $('#mensaje_error_index').html(response.error);
                        $('#mensaje_error_div_index').removeClass('alert-danger').removeClass('alert-success').addClass('alert-' + response.tipo_msg);
                        $('#div_error_index').show();
                        setTimeout("$('#div_error_index').hide()", 5000);
                        try {
                        } catch (e) {
                            $('#modal_content').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
                        }

                    }
                } catch (e) {
//                $('#seccion_validar').html(response);
                    $('#modal_content').html(response);

                }
            })
            .fail(function (jqXHR, response) {
//                $('#div_error').show();
                $('#modal_content').html('Ocurrió un error durante el proceso, inténtelo más tarde.');
//                $('#mensaje_error_div').removeClass('alert-success').addClass('alert-danger');
            })
            .always(function () {
                remove_loader();
            });
}
;