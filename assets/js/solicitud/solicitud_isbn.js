var menu_busqueda_solicitud = new Object();
menu_busqueda_solicitud['isbn'] = 'isbn';
menu_busqueda_solicitud['titulo_obra'] = 'Titulo del libro';
menu_busqueda_solicitud['sub_titulo_obra'] = 'Sub titulo del libro';

$(function () {

    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function () {
        $(document).scrollTop();
    });
});


function funcion_buscar_solicitudes() {
    var path = site_url + '/solicitud/buscador_solicituides/0';
//    var val_post = $('#form_busqueda_docentes_validar').serialize();
    data_ajax(path, '#form_busqueda_solicitudes', '#div_result_solicitudes');
}

/**
 * 
 * @param {type} name Menu de opciónes de filtro
 * @returns {undefined}
 */
function funcion_menu_tipo_busqueda_solicitud(name) {
    var text = menu_busqueda_solicitud[name];//Busca en el hashmap el nombre indicado
    $("#menu_busqueda").val(name);//Modifica el valor del menu
    $("#btn_buscar_por").text(text);//Cambia el texto del botón
    $("#btn_buscar_por").append('<span class="caret"> </span>');//Agregar span al botón para mostrar icono flechita
    $("#buscador_solicitudes").attr('data-original-title', 'Buscar por: ' + text);//Cambia el texto del la caja de texto 
    $("#btn_buscar_b").attr('data-original-title', 'Buscar por: ' + text);//Cambia el texto del botón
}

function runScript_busqueda_val(e) {
    if (e.keyCode == 13) {
//      var tb = document.getElementById("scriptBox");
//      eval(tb.value);
        $("#btn_buscar_solicitudes").trigger("click");//Dispara el onclic del botón buscar validador en el sied
        return false;
    }
}

/**
 * Carga el valor de 
 * @param {type} element
 * @returns {undefined}
 */
function funcion_ver_solicitud_entidad(element) {
    var button_obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
    var solicitud_cve = button_obj.data('solicitudcve');
    var histsolicitudcve = button_obj.data('histsolicitudcve');
    var estado_solicitud = button_obj.data('estadosolicitudcve');
    //Remover contenido de un div 
    $('#select_perfil_solicitud').empty();
    var obj_post = {histsolicitudcve: histsolicitudcve, solicitud_cve: solicitud_cve, estado_cve: estado_solicitud};
    data_ajax_post(site_url + '/solicitud/seccion_index', null, '#select_perfil_solicitud', obj_post);
}
function funcion_cerrar_vista_solicitud(element) {
//    alert('jsahjhdadas');
    $('#select_perfil_validar').empty();
    data_ajax_post(site_url + '/solicitud/seccion_delete_datos_solicituid', null, null);
}

function ver_detalle_solicitud(element) {
    var obj = $(element); //Convierte a objeto todos los elementos del this que llegan del componente html (button en esté caso)
//    var hist_val_cve = obj.data('histvalcve');
    var row = obj.data('row');
    var hist_solicitudcve = obj.data('histsolicitudcve');
    var solicitud_cve = obj.data('solicitudcve');
    var formData = {hist_solicitudcve: hist_solicitudcve, solicitud_cve: solicitud_cve};
    data_ajax_post(site_url + '/solicitud/detalle', null, '#modal_content', formData);
}


    