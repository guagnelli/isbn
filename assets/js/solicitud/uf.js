function ajax_files(action,form_data,div_content,div_msg){
	$.ajax({
        url: action,
        data: form_data,
        method: 'POST',
        beforeSend: function (xhr) {
            $(div_msg).html(create_loader());
        }
    }).done(function (response) {
        //alert(response)
        try{
            var resp = $.parseJSON(response);
            $(div_msg).show();        
            $(div_msg).text(resp.message);
            if(resp.result=="true"){
                $(div_msg).addClass('alert-success');
            }else{
                $(div_msg).addClass('alert-danger');
            }
            //setTimeout("$("+div_msg+").hide()", 5000);
            //recargar_fecha_ultima_actualizacion();//Recarga la fecha de la ultima actualización del modulo perfil
            $(div_content).html(resp.content);
        }catch(e){
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

function btn_file(obj){
	var type = $(obj).data("type");
	var id = "#upload";
	var solicitud = $("#sol").val();
	// alert(id)
	//alert(solicitud);
	
	var input = $('<input name="solicitud_id" type="hidden" value="'+solicitud+'">');
	$(id).append(input);	
	var input = $('<input name="option" type="hidden" value="'+type+'">');
	$(id).append(input);
	if(type == "remove"){
		var id = $(obj).data("file");
		var input = $('<input name="id" type="hidden" value="'+id+'">');
		$(id).append(input);
		alert(solicitud)
	}
	var action = $(id).attr("action");
	var form_data = $(id).serialize();
	//alert(form_data);
	ajax_files(action,form_data,'#div_flist','#msg_general');
	//});
}