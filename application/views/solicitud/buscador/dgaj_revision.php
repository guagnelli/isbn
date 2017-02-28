<?php
//pr($solicitud);
$this->lang->load('interface', 'spanish');
$string_detalle = $this->lang->line('interface')['solicitud_detalle'];
?>
<div class="text-left" role="main">
    <div class="">
        <h3><?php echo $string_detalle['title_detalle_gral']; ?></h3>
    </div>
    <!---Cuerpo-->
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $string_detalle['title_titulo_libro'] . $solicitud['libro']['title']; ?> 
                <?php if (!empty($solicitud['libro']['subtitle'])) { ?>
                    <br><?php echo $string_detalle['title_subtitulo_libro'] . $solicitud['libro']['subtitle']; ?> 
                <?php } ?>
            </h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <p class="lead">
                <b>
                <?php echo $string_detalle['title_clas_tematica']; ?>
                </b>
            </p>
            <address>
                <b><?php echo $string_detalle['li_categoria']?></b>
                   <?php echo $solicitud['clasificacion_tematica']['categoria']; ?><br />
                <b><?php echo $string_detalle['li_sub_categoria']?></b>
                   <?php echo $solicitud['clasificacion_tematica']['subcategoria']; ?><br />
            </address>

            <?php if (!empty($solicitud['secciones']['lng'])) { ?>
                <p class="lead"><b><?php echo $string_detalle['title_idioma']; ?></b> <?php echo $botones_seccion[En_secciones::IDIOMA]; ?></p>  
                    <?php foreach ($solicitud['secciones']['lng'] as $lenguaje) { ?>
                    <?php echo $lenguaje['nam_idioma']; ?>;
                    <?php } ?>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['t'])) { ?>
                <p  class="lead"><b><?php echo $string_detalle['title_tema']; ?></b> <?php echo $botones_seccion[En_secciones::TEMA]; ?></p> 
                <address>
                    <b><?php echo $string_detalle['li_coleccion']?></b>
                        <?php echo $solicitud['secciones']['t'][0]['coleccion']; ?><br />
                    <b><?php echo $string_detalle['li_nom_serie_coleccion']?></b> 
                        <?php echo $solicitud['secciones']['t'][0]['nombre_serie']; ?><br />
                    <b><?php echo $string_detalle['li_num_coleccion']?></b>
                        <?php echo $solicitud['secciones']['t'][0]['no_coleccion']; ?><br />
                    <b><?php echo $string_detalle['li_tipo_contenido_coleccion']?></b> 
                        <?php echo $solicitud['secciones']['t'][0]['tipo_contenido']; ?>
                </address>
                
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['colab'])) { ?>
                <p class="lead"><b><?php echo $string_detalle['title_colaboradores']; ?></b> <?php echo $botones_seccion[En_secciones::COLABORADORES]; ?></p>
                <?php foreach ($solicitud['secciones']['colab'] as $colaborador) { ?>
                    <address>
                        <b>Nombre:&nbsp;</b><?php echo $colaborador['nombre']; ?><br /> 
                        <b>Rol:&nbsp;</b><?php echo $tipoColab[$colaborador['tipo']]; ?><br /> 
                        <b>Nacionalidad:&nbsp;</b><?php echo $c_nacionalidad[$colaborador['nacionalidad']]; ?><br /> 
                        <b>Seud&oacute;nimo:&nbsp;</b><?php echo $colaborador['seudonimo']?><br />
                        <b>Correo electr&oacute;nico:&nbsp;</b><?php echo $colaborador['email']?>
                    </address>
                <?php } ?>
            <?php } ?>


            <?php if (!empty($solicitud['secciones']['trns'])) { ?>
                <p class="lead"><b><?php echo $string_detalle['title_traduccion']; ?></b> <?php echo $botones_seccion[En_secciones::TRADUCCION]; ?></p>
                <?php $traduccion = $solicitud['secciones']['trns'][0]; ?> 
                <address>
                    <b><?php echo $string_detalle['li_title_original_traduccion'];?> </b>
                        <?php echo $traduccion['titulo_original']; ?><br />
                    <b><?php echo $string_detalle['li_idioma_orig_traduccion']?></b>
                        <?php echo $traduccion['ni_orig']; ?><br />
                    <b><?php echo $string_detalle['li_idioma_del_traduccion']?></b>
                        <?php echo $traduccion['ni_del']; ?><br />
                    <b><?php echo $string_detalle['li_idioma_al_traduccion']?></b>
                        <?php echo $traduccion['ni_al']; ?>
                </address>    
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['ed'])) { ?>
                <p class="lead"><b><?php echo $string_detalle['title_info_edicion']; ?></b></p>
                
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['cmrc'])) { ?>
                <p class="lead"><b>Comercializaci&oacute;n</b></p>
                
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['df'])) { ?>
                <p class="lead"><b>Descripci&oacute;n f&iacute;sica</b></p>
                
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['epay'])) { ?>
                <p class="lead"><b>Pago electr&oacute;nico</b></p>
                
            <?php } ?>

            <br>
            <?php if (isset($link_editar)) { ?>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 text-center">
                        <button type="button" id="close_modal" class="btn btn-defult" data-dismiss="modal">Cancelar</button>
                        <?php echo $link_editar; ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>