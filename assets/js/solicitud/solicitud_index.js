function cambio_estado(element) {
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

    