<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

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
            <!--            <div class="breadcrumbs6 panel-heading" style="padding-left:20px;">
                            <h1 id="titulo_registro">
                                <small>
                                    <span class="glyphicon glyphicon-info-sign">
                                    </span>
                                </small>
            <?php // echo $string_values['lbl_titulo_seccion']; ?>
                            </h1>
                        </div>-->
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    <!--<div id="cuerpo_solicitud" class="list-group-item text-center center ">-->
                    <?php if (isset($vista)) { ?>

                        <?php echo $vista; ?>
                    <?php } ?>
                    <!--</div>-->
                    <!--</div>-->
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                        <?php if (isset($boton_estado)) { ?>
                            <a class="btn btn-primary" data-toggle='tab' href='#select_buscador_solicitud_entidad'>Guardar</a>

                            <?php
                            foreach ($boton_estado as $botones) {
                                echo $botones;
                            }
                            ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>