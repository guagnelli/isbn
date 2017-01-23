$(document).ready(function(){
	$("#btn_d_solicitud_pdf").click(function() {
		generar_solicitud_beca();
	});
	$("#btn_d_solicitud_cerrar").click(function() {
		cerrar_solicitud();
	});
});

function cargar_validacion_archivo(req, ereq){
	var archivo = $('#requisito_'+req).val();
	var carga = '#capa_carga_archivo_'+req;
	//var val_id = $('#val_id').val();
	var error = "#error_carga_archivo_"+req;
	var valor_minimo = "";
	if ( $("#valor_minimo_"+req).length ) {
		valor_minimo = $("#valor_minimo_"+req).val();
	}
	//console.log(valor_minimo);
	if(archivo!=""){ //Validar que contenga archivo
		if(validate_extension(archivo, extension_documentacion)){ //Validar la extensión, definida en archivo de configuración
			var formData = new FormData($('#registro_documentacion')[0]);
			formData.append('req', ereq);
			formData.append('valor_minimo', valor_minimo);
			//console.log(formData);
			$.ajax({
                url: site_url+'/mi_solicitud/cargar_archivo',
                type: 'POST',
                data: formData,
                mimeType: "multipart/form-data",
                contentType: false,
                cache: false,
                processData: false,
                dataType: 'JSON',
                beforeSend: function( xhr ) {
                	$(carga).hide();
					$(error).html(create_loader());
				}
        	})
        	.done(function(response) {
        		if(response.resultado==true){
					$(carga).show();
					//cargar_archivo_listado(val_id);
					$(error).html(html_message("El archivo se ha cargado exitosamente.", 'success'));
					$('#requisito_'+req).val("");
					//link = "<button class='btn-xs btn-block btn-exito btn_requisito btn' value='Descargar' id='btn_d_3' type='button' name='btn_d_3'>Descargar</button>";
					//link = "<a href='"+site_url+"/archivo/descarga/"+response.data.filename+"' class='btn-xs btn-block btn-exito btn_requisito btn'><span class='glyphicon glyphicon-download-alt text-right' placeholder='Descargar' title='Descargar' data-toggle='tooltip' data-placement='top'> </span></a>";
					link = "<a href='"+site_url+"/archivo/descarga/"+response.data.filename+"' class='btn-xs turqueza'><span class='glyphicon glyphicon-download-alt text-right' placeholder='Descargar' title='Descargar' data-toggle='tooltip' data-placement='top' style='font-size:20px;'> </span></a>";
                    
                    
                    //link = "<a href='"+site_url+"/archivo/descarga/"+response.data.filename+"' class='btn-xs btn-block btn-exito btn_requisito btn'>Descargar</a>";
					icon = "<span id='icon_"+req+"' class='input-group-addon glyphicon glyphicon-zoom-in azul' title='Por validar por el administrador' data-toggle='tooltip' data-placement='top'> </span>";
					$("#link_descarga_"+req).html(link);
					$("#icon_"+req).remove();
					$(icon).insertBefore("#requisito_"+req);
				} else {
					$(error).html(html_message(response.error, 'danger'));
				}
			})
			.fail(function( jqXHR, textStatus ) {
				$(error).html(html_message("Ocurrió un error durante el proceso, inténtelo más tarde.", 'danger'));
			})
			.always(function() {
				remove_loader();
				$(carga).show();
				$('#evidencia_archivo').val('');
				/*$('[data-toggle="tooltip"]').tooltip();*/
			});
		} else {
			$(error).html(html_message("El archivo seleccionado no esta permitido. Por favor elija un archivo con alguna de las siguientes extensiones: "+extension_documentacion, 'danger'));
		}
	} else {
		$(error).html(create_loader());
		$(error).html(html_message("Debe seleccionar un archivo para ser almacenado. Por favor elija uno.", 'danger'));
	}
}


function generar_solicitud_beca(){
	var formData = new FormData($('#registro_documentacion')[0]);
	var carga = '#buttons';
	var error = "#error_carga_archivo";
	$.ajax({
        url: site_url+'/mi_solicitud/generar_pdf',
        type: 'POST',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        dataType: 'JSON',
        beforeSend: function( xhr ) {
        	$(carga).hide();
			$(error).html(create_loader());
		}
	})
	.done(function(response) {
		if(response.resultado==true){
			$(carga).show();
			window.open(site_url+'/mi_solicitud/show_pdf', "_blank", 'fullscreen=yes, location=no, menubar=no, titlebar=no, toolbar=no');
		} else {
			$(error).html(html_message(response.error, 'danger'));
		}
	})
	.fail(function( jqXHR, textStatus ) {
		$(error).html(html_message("Ocurrió un error durante el proceso, inténtelo más tarde.", 'danger'));
	})
	.always(function() {
		remove_loader();
		$(carga).show();
		/*$('[data-toggle="tooltip"]').tooltip();*/
	});
}

function cerrar_solicitud(){
	var b = $('#b').val();
	var e = $('#e').val();
	if(confirm("¿Esta seguro de querer continuar con está acción?\n No podrá modificar información una vez que sea cerrada la solicitud.")){
		document.location.href = site_url+'/mi_solicitud/cerrar_solicitud/'+b+'?e='+e;
	}
}