<?php
//pr($registro);

$solicitud_cve = $this->seguridad->encrypt_base64($registro['solicitud_id']);
$hist_solicitud = $this->seguridad->encrypt_base64(intval($registro['historico_id']));
$estado_solicitud = $this->seguridad->encrypt_base64(intval(1));
?>

<div class="col-md-12 col-sm-12 col-xs-12" id="div_secciones">
    <div class="x_panel">
        <div class="x_content" id="edicion">
        	contenido
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	$('#edicion').empty();
    var obj_post = {histsolicitudcve: '<?php echo $hist_solicitud; ?>', 
    				solicitud_cve: '<?php echo $solicitud_cve; ?>', 
    				estado_cve: '<?php echo $estado_solicitud; ?>'};
    data_ajax_post(site_url + '/solicitud/seccion_index', null, '#edicion', obj_post);
});
</script>