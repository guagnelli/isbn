<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<?php echo css("style-sipimss.css"); ?>

<script>
    $('.botonF1').hover(function () {
        $('.btn').addClass('animacionVer');
    })
    $('.contenedor').mouseleave(function () {
        $('.btn').removeClass('animacionVer');
    })
</script>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/solicitud/solicitud_index.js"></script>

<div class="row" id="contenedor_formulario">

    <div class="col-sm-12 col-md-12 col-lg-12">

        <div class="panel">
            <div class="breadcrumbs6 panel-heading" style="padding-left:20px;">
                <h1 id="titulo_registro">
                    <small>
                        <span class="glyphicon glyphicon-info-sign">
                        </span>
                    </small>
                    <?php echo $string_values['lbl_titulo_seccion']; ?>
                </h1>
            </div>
            <div class="panel-body">

            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 contenedor" >
        <span id="pie"  onclick="funcion_cerrar_validacion_empleado(this)">
            <a class="botonF1" data-toggle='tab' href='#select_buscador_solicitud_entidad'>><?php // echo $string_values['lbl_validar_empleado'];    ?></a>
        </span>
    </div>
</div>