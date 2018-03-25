function guardar_estado_comprobante(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var estado_solicitud = button_obj.data('estadosolicitudcve');//    var tipo_transicion =obj.data('tipotransicion');
    var tipo_file = button_obj.data('tipofile');//    var tipo_transicion =obj.data('tipotransicion');
//    alert(estado_solicitud);
    //Remover contenido de un div 
    var id = "#frm_file_comprobante";
    var input = $('<input name="estado_cve" type="hidden" value="' + estado_solicitud + '">');
    var input_file = $('<input name="file_type" type="hidden" value="' + tipo_file + '">');
    $(id).append(input);
    $(id).append(input_file);
    //alert(action);
    var options = {
        //target:   '#tab_files',   // target element(s) to be updated with server response 
        beforeSubmit: beforeSubmit, // pre-submit callback 
        success: afterSuccess, // post-submit callback 
        uploadProgress: OnProgress, //upload progress callback 
        resetForm: true        // reset the form after successful submit 
    };
    $(id).ajaxSubmit(options);
}

function btn_dfile(obj) {
    var id = "#frm_file";
    var solicitud = $("#sol").val();
    var file = $(obj).data("file");
    var form_data = {"id": file, "solicitud_id": solicitud};
    var action = site_url + "/files/delete";
    apprise("Esta a punto de eliminar la información de traducción, ¿desea continuar?",
            {verify: true},
            function (btnClick) {
                if (btnClick) {
                    ajax(action, form_data, '#div_flist', '#msg_general');
                }
            });
}

function btn_file(obj) {
    var id = "#frm_file";
    var solicitud = $("#sol").val();
    var action = $(id).attr("action");
    var input = $('<input name="solicitud_id" type="hidden" value="' + solicitud + '">');
    $(id).append(input);
    //alert(action);
    var options = {
        //target:   '#tab_files',   // target element(s) to be updated with server response 
        beforeSubmit: beforeSubmit, // pre-submit callback 
        success: afterSuccess, // post-submit callback 
        uploadProgress: OnProgress, //upload progress callback 
        resetForm: true        // reset the form after successful submit 
    };
    $(id).ajaxSubmit(options);
}

//function after succesful file upload (when server response)
function afterSuccess(response) {
    try {
        var resp = $.parseJSON(response);
        if (resp.content !== undefined) {
            //alert("hello you")
            $("#tab_files").html(resp.content);
        }
        if (resp.message !== undefined) {
            if (resp.error !== undefined) {
                $("#msg_general").show();
                $("#msg_general").addClass('alert alert-' + resp.error + ' alert-dismissible fade in');
                $("#msg_general").text(resp.message);
            } else {
                $("#msg_general").show();
                $("#msg_general").addClass('alert alert-info alert-dismissible fade in');
                $("#msg_general").text(resp.message);
                $('#modal_censo').modal('toggle');
                try {
                    funcion_buscar_solicitudes();//Recarga lista de solicitudes
//                            document.getElementById("regresa_list").accion='onClick';
                    $(document).ready(function () {
                        $('.botonF1').trigger('click');
                    });
                } catch (e) {
                }
            }
        }
    } catch (e) {

    }
    $('#send_file').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button
    $('#progressbox').delay(1000).fadeOut(); //hide progress bar
}

//function to check file size before uploading.
function beforeSubmit() {

    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {
        var isbn = $("#tipo").val();
        //alert(isbn)
        if(isbn == "Aceptar" ){
            if (!$('#isbn_libro').val()) { //check empty input filed
                $("#msg_general").show();
                $("#msg_general").addClass('alert alert-warning alert-dismissible fade in');

                $("#msg_general").text("El campo ISBN es obligatorio, por favor Ingreselo");
                return false;
            }else if(!$('#folio_indautor').val()){
                $("#msg_general").show();
                $("#msg_general").addClass('alert alert-warning alert-dismissible fade in');

                $("#msg_general").text("El campo Folío es obligatorio, por favor Ingreselo");
                return false;
                
            }else{
                var isbn = $('#isbn_libro').val();
                if(isbn.length != 13){
                    $("#msg_general").show();
                    $("#msg_general").addClass('alert alert-warning alert-dismissible fade in');

                    $("#msg_general").text("El campo ISBN debe contener 13 caracteres, por favor verifíquelo");
                    return false;
                }
            }
        }  

        if (!$('#archivo').val()) { //check empty input filed
            $("#msg_general").show();
            $("#msg_general").addClass('alert alert-warning alert-dismissible fade in');

            $("#msg_general").text("El campo Archivo es obligatorio, por favor seleccione un archivo");
            return false;
        }

        
        var conf = confirm("Esta a punto de "+isbn+" la solicitud, ¿desea continuar?");
        if(conf){
            var fsize = $('#archivo')[0].files[0].size; //get file size
            var ftype = $('#archivo')[0].files[0].type; // get file type


            //allow file types 
            switch (ftype)
            {
                case 'image/png':
                case 'image/gif':
                case 'image/jpeg':
                case 'image/jpg':
                case 'application/pdf':
                    break;
                default:
                    //alert(ftype)
                    $("#msg_general").show();
                    $("#msg_general").text("El archivo con extensión '" + ftype + "' no esta permitido");
                    $("#msg_general").attr('class', '');
                    $("#msg_general").addClass('alert alert-info alert-dismissible fade in');
                    return false
            }

            //Allowed file size is less than 5 MB (1048576)
            if (fsize > 5242880) {
                $("#msg_general").show();
                $("#msg_general").text("El archivo con extensión '" + ftype + "' no esta permitido");
                $("#msg_general").attr('class', '');
                $("#msg_general").addClass('alert alert-info alert-dismissible fade in');
                $("#msg_general").text("El tamaño del archivo es de " + bytesToSize(fsize) + ", superior al máximo de 5MB");
                return false
            }

            $('#send_file').hide(); //hide submit button
            $('#loading-img').show(); //hide submit button
            $("#msg_general").text("");
            $("#msg_general").attr('class', '');
            $("#msg_general").hide();
        }else{
            return false;
        }

            
    } else
    {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#msg_list").text("Please upgrade your browser, because your current browser lacks some new features we need!");
        return false;
    }
}

//progress bar function
function OnProgress(event, position, total, percentComplete) {
    //Progress bar
    $('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if (percentComplete > 50)
    {
        $('#statustxt').css('color', '#000'); //change status text to white after 50%
    }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0)
        return '0 Bytes';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}