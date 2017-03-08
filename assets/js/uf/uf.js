/*function ajax_files(action,form_data,div_content,div_msg){
	$.ajax({
        url: action,
        data: form_data,
        mimeType: "multipart/form-data",
        contentType: false,
        cache: false,
        processData: false,
        //dataType: 'JSON',
        type: 'POST',
        beforeSend: function (xhr) {
            console.log(form_data);
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
	//var type = $(obj).data("type");
	var id = "#frm_file";
	var solicitud = $("#sol").val();
    var action = $(id).attr("action");
    var form_data = new FormData($(id)[0]);
    form_data.append('solicitud_id', solicitud);
	//var form_data = $(id).serialize();
    
	//alert(form_data);
	ajax_files(action,form_data,'#tab_files','#msg_general');
	//});
}
function btn_dfile(obj){
    var type = $(obj).data("type");
    var id = "#frm_file";
    var solicitud = $("#sol").val();
    // alert(id)
    //alert(solicitud);
    
    var input = $('<input name="file_id" type="hidden" value="'+solicitud+'">');
    $(id).append(input);
    var action = $(id).attr("action");
    var form_data = $(id).serialize();
    //alert(form_data);
    ajax_files(action,form_data,'#div_flist','#msg_general');
    //});
}*/

function btn_file(obj){
    var id = "#frm_file";
    var solicitud = $("#sol").val();
    var action = $(id).attr("action");
    //alert(action);
    var options = { 
        //target:   '#tab_files',   // target element(s) to be updated with server response 
        beforeSubmit:  beforeSubmit,  // pre-submit callback 
        success:       afterSuccess,  // post-submit callback 
        uploadProgress: OnProgress, //upload progress callback 
        resetForm: true        // reset the form after successful submit 
    };
    $(id).ajaxSubmit(options); 
    /*$(id).submit(function() { 
                   
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    });*/
}

//function after succesful file upload (when server response)
function afterSuccess(response){
    try{
        var resp = $.parseJSON(response);
        if (resp.content !== undefined) {
            alert("hello you")
            $("#tab_files").html(resp.content);
        }
    }catch(e){

    }
    $('#send_file').show(); //hide submit button
    $('#loading-img').hide(); //hide submit button
    $('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
}

//function to check file size before uploading.
function beforeSubmit(){
    
    //check whether browser fully supports all File API
   if (window.File && window.FileReader && window.FileList && window.Blob){
        if( !$('#archivo').val()){ //check empty input filed
            $("#msg_general").show();
            $("#msg_general").addClass('alert alert-info alert-dismissible fade in');;
            $("#msg_general").text("El campo Archivo es obligatorio, por favor seleccione un archivo");
            return false
        }
        
        var fsize = $('#archivo')[0].files[0].size; //get file size
        var ftype = $('#archivo')[0].files[0].type; // get file type
        

        //allow file types 
        switch(ftype)
        {
            case 'image/png': 
            case 'image/gif': 
            case 'image/jpeg': 
            case 'image/pjpeg':
            case 'application/pdf':
            case 'application/msword':
                break;
            default:
                //alert(ftype)
                $("#msg_general").show();
                $("#msg_general").text("El archivo con extensión '"+ftype+"' no esta permitido");
                $("#msg_general").attr('class', '');
                $("#msg_general").addClass('alert alert-info alert-dismissible fade in');
                return false
        }
        
        //Allowed file size is less than 5 MB (1048576)
        if(fsize>5242880){
            $("#msg_general").show();
            $("#msg_general").text("El archivo con extensión '"+ftype+"' no esta permitido");
            $("#msg_general").attr('class', '');
            $("#msg_general").addClass('alert alert-info alert-dismissible fade in');
            $("#msg_general").text("El tamaño del archivo es de "+bytesToSize(fsize) +", superior al máximo de 5MB");
            return false
        }
                
        $('#send_file').hide(); //hide submit button
        $('#loading-img').show(); //hide submit button
        $("#msg_general").text("");  
        $("#msg_general").attr('class', '');
        $("#msg_general").hide();  
    }
    else
    {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#msg_list").text("Please upgrade your browser, because your current browser lacks some new features we need!");
        return false;
    }
}

//progress bar function
function OnProgress(event, position, total, percentComplete){
    //Progress bar
    $('#progressbox').show();
    $('#progressbar').width(percentComplete + '%') //update progressbar percent complete
    $('#statustxt').html(percentComplete + '%'); //update status text
    if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
}

//function to format bites bit.ly/19yoIPO
function bytesToSize(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
}