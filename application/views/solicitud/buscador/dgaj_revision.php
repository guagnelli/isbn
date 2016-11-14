<?php
pr($solicitud);
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
                <p><b><?php echo $string_detalle['title_tema']; ?></b><?php echo $botones_seccion[En_secciones::TEMA]; ?></p> 
                <ul>    
                    <li><?php echo $string_detalle['li_coleccion'] . $solicitud['secciones']['t'][0]['coleccion']; ?></li>
                    <li><?php echo $string_detalle['li_nom_serie_coleccion'] . $solicitud['secciones']['t'][0]['nombre_serie']; ?></li>
                    <li><?php echo $string_detalle['li_num_coleccion'] . $solicitud['secciones']['t'][0]['no_coleccion']; ?></li>
                    <li><?php echo $string_detalle['li_tipo_contenido_coleccion'] . $solicitud['secciones']['t'][0]['tipo_contenido']; ?></li>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['colab'])) { ?>
                <p><b><?php echo $string_detalle['title_colaboradores']; ?></b><?php echo $botones_seccion[En_secciones::COLABORADORES]; ?></p>
                <!--<a href="#" class="comentario" ><span class="glyphicon glyphicon-comment"></span></a>-->
                <ul>    
                    <li>SN / Colaboradores</li>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['lng'])) { ?>
                <p><b><?php echo $string_detalle['title_idioma']; ?></b><?php echo $botones_seccion[En_secciones::IDIOMA]; ?></p>
                <ul>    
                    <li>Idioma. Español</li>
                </ul>
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['trns'])) { ?>
                <p><b><?php echo $string_detalle['title_traduccion']; ?></b><?php echo $botones_seccion[En_secciones::TRADUCCION]; ?></p>
                <ul>    
                    <li>SN/ Traducción</li>
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