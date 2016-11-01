function ajax(action,form_data,div_content,div_msg){
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
function load_sections(){
	var form_data = {solicitud_id:$("#sol").val()};
	//alert(site_url+"/solicitud/load_seccion")
	ajax(site_url+"/solicitud/sec_tema",form_data,'#tab_tema','#msg_general');
	btn();
}
$("#tab_sections").ready(function (){
	load_sections();
	
});

function btn(){
	//alert("hola");
	$(".btn-form").click(function(){
		var boton = $(this).attr("id")
		var type = $(this).data("type");
		var id = "#frm_"+type;
		var solicitud = $("#sol").val();
		//alert(solicitud);
		
		var input = $('<input name="solicitud_id" type="hidden" value="'+solicitud+'">');
		$(id).append(input);
		//data_ajax($(id).attr("action"),id,"#msg_secciones");
		var action = $(id).attr("action");
		var form_data = $(id).serialize();
		//alert(action);
		ajax(action,form_data,'#tab_'+type,'#msg_general');
	});
}