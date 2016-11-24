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
            <p><b><?php echo $string_detalle['title_clas_tematica']; ?></b></p>
            <ul>    
                <li><?php echo $string_detalle['li_categoria'] . $solicitud['clasificacion_tematica']['categoria']; ?></li>
                <li><?php echo $string_detalle['li_sub_categoria'] . $solicitud['clasificacion_tematica']['subcategoria']; ?></li>
            </ul>

            <?php if (!empty($solicitud['secciones']['t'])) { ?>
                <p><b><?php echo $string_detalle['title_tema']; ?></b> <?php echo $botones_seccion[En_secciones::TEMA]; ?></p> 
                <ul>    
                    <li><?php echo $string_detalle['li_coleccion'] . $solicitud['secciones']['t'][0]['coleccion']; ?></li>
                    <li><?php echo $string_detalle['li_nom_serie_coleccion'] . $solicitud['secciones']['t'][0]['nombre_serie']; ?></li>
                    <li><?php echo $string_detalle['li_num_coleccion'] . $solicitud['secciones']['t'][0]['no_coleccion']; ?></li>
                    <li><?php echo $string_detalle['li_tipo_contenido_coleccion'] . $solicitud['secciones']['t'][0]['tipo_contenido']; ?></li>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['colab'])) { ?>
                <?php $tipoColab = $this->config->item('tipo_colab'); ?>
                <p><b><?php echo $string_detalle['title_colaboradores']; ?></b> <?php echo $botones_seccion[En_secciones::COLABORADORES]; ?></p>
                <ul>    
                    <?php foreach ($solicitud['secciones']['colab'] as $colaborador) { ?>
                        <li><?php echo $string_detalle['li_name_colaborador'] . $colaborador['nombre'] . $string_detalle['li_tipo_colaborador'] . $tipoColab[$colaborador['tipo']]; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['lng'])) { ?>
                <p><b><?php echo $string_detalle['title_idioma']; ?></b> <?php echo $botones_seccion[En_secciones::IDIOMA]; ?></p>
                <?php // $coma = ''; ?>
                <ul>    
                    <?php foreach ($solicitud['secciones']['lng'] as $lenguaje) { ?>
                        <li><?php echo $lenguaje['nam_idioma']; ?></li>
                        <?php // $coma = ', '; ?>
                    <?php } ?>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['trns'])) { ?>
                <p><b><?php echo $string_detalle['title_traduccion']; ?></b> <?php echo $botones_seccion[En_secciones::TRADUCCION]; ?></p>
                <ul>    
                    <?php $traduccion = $solicitud['secciones']['trns'][0]; ?>
                    <li><?php echo $string_detalle['li_title_original_traduccion'] . $traduccion['titulo_original']; ?></li>
                    <li><?php echo $string_detalle['li_idioma_orig_traduccion'] . $traduccion['ni_orig']; ?></li>
                    <li><?php echo $string_detalle['li_idioma_del_traduccion'] . $traduccion['ni_del']; ?></li>
                    <li><?php echo $string_detalle['li_idioma_al_traduccion'] . $traduccion['ni_al']; ?></li>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['edi'])) { ?>
                <p><b><?php echo $string_detalle['title_info_edicion']; ?></b></p>
                <ul>    
                    <li>No. Edición: Cuarta edición 2014 </li>
                    <li>Centeno 163-1, colonia Granjas Esmeralda, C.P. 09810, México DF, en el mes de enero 2014 </li>    
                    <li>Fecha de aparición 2005 </li>
                    <li>Coedición: SN </li>
                </ul>
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