function ajax(action, form_data, div_content, div_msg) {
    $.ajax({
        url: action,
        data: form_data,
        method: 'POST',
        beforeSend: function (xhr) {
            $(div_msg).html(create_loader());
        }
    }).done(function (response) {
        //alert(response)
        try {
            var resp = $.parseJSON(response);

            if (resp.message !== undefined) {
                //alert(resp.message)
                $(div_msg).show();
                //var msg = "<button type='button' class='close' data-dismiss='alert aria-label='Close'><span aria-hidden='true'>×</span></button>";
                $(div_msg).text(resp.message);
                $(div_msg).attr('class', '');
                $(div_msg).addClass('alert alert-info alert-dismissible fade in');
                //setTimeout($(div_msg).hide(), 5000);
            } else if (resp.message === undefined) {
                $(div_msg).hide()
            }           /*if(resp.result=="true"){
             
             }else{
             $(div_msg).addClass('alert-info');
             }*/

            //recargar_fecha_ultima_actualizacion();//Recarga la fecha de la ultima actualización del modulo perfil
            $(div_content).html(resp.content);
        } catch (e) {
            $(div_content).html(response);
        }

    }).fail(function (jqXHR, response) {
        $(div_msg).removeClass('alert-success').addClass('alert-danger');
        $(div_msg).html('Ocurrió un error durante el proceso, inténtelo más tarde.');
    })
            .always(function () {
                remove_loader();
            });
}

function btn(obj) {
    //alert("hola");
    //$(".btn-form").click(function(){
    var boton = $(obj).attr("id");
    var type = $(obj).data("type");
    var id = "#frm_" + type;
    var solicitud = $("#sol").val();
    // alert(id)
    //alert(solicitud);

    var input = $('<input name="solicitud_id" type="hidden" value="' + solicitud + '">');
    $(id).append(input);
    //data_ajax($(id).attr("action"),id,"#msg_secciones");
    var action = $(id).attr("action");
    var form_data = $(id).serialize();
    //alert(form_data);
//	alert(action);
    ajax(action, form_data, '#tab_' + type, '#msg_general');
    //});
}
