$(function() {
    if($('#btn_agregar_ce').length){
        $('#btn_agregar_ce').on('click', function() {
            data_ajax(site_url+'/convocatoria_evaluacion/agregar_convocatoria', null, '#modal_content');
        });
    }
    if($('.btn_editar_ce').length){
        $('.btn_editar_ce').on('click', function() {
            //console.log($(this).attr('data-value'));
            data_ajax(site_url+'/convocatoria_evaluacion/agregar_convocatoria/'+$(this).attr('data-value'), null, '#modal_content');
        });
    }    
});