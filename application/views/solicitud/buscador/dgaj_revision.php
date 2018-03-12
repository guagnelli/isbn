<?php
//pr($solicitud);
$this->lang->load('interface', 'spanish');
$string_detalle = $this->lang->line('interface')['solicitud_detalle'];
//pr($this->session->userdata('detalle_solicitud'));
//pr($solicitud);

?>
<div class="text-left" role="main">
    <div class="">
        <h3><?php echo $string_detalle['title_detalle_gral']; ?></h3>
    </div>
    <!---Cuerpo-->
    <div class="x_panel">
        <div class="x_title">
            <h2><?php echo $string_detalle['title_titulo_libro'] . $solicitud['libro']['title']; ?> <?php echo $botones_seccion[En_secciones::TITULO_LIBRO]; ?>
                
                <?php if (!empty($solicitud['libro']['subtitle'])) { ?>
                    <br><?php echo $string_detalle['title_subtitulo_libro'] . $solicitud['libro']['subtitle']; ?> 
                <?php } ?>

                <?php if (!empty($solicitud['sol_tipo_obra'])) { ?>
                    <br><?php echo $string_detalle['title_tipo_obra'] . $solicitud['sol_tipo_obra']; ?> 
                <?php } ?>
            </h2>
            <ul class="nav navbar-right panel_toolbox"></ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php if (!empty($solicitud['libro']['resenia'])) { ?>
                <p class="lead">
                    <?php echo "<b>".$string_detalle['libro_resenia']."</b>";?>
                </p>
                <address>
                <?php echo $solicitud['libro']['resenia']; ?> 
                </address>
            <?php } ?>
            <p class="lead">
                <b>
                    <?php echo $string_detalle['title_clas_tematica']; ?>
                </b>
                <?php echo $botones_seccion[En_secciones::CLAS_TEMATICA]; ?>
            </p>
            <address>
                <b><?php echo $string_detalle['li_categoria'] ?></b>
                <?php echo $solicitud['clasificacion_tematica']['categoria']; ?><br />
                <b><?php echo $string_detalle['li_sub_categoria'] ?></b>
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
                    <b><?php echo $string_detalle['li_coleccion'] ?></b>
                    <?php echo $solicitud['secciones']['t'][0]['coleccion']; ?><br />
                    <b><?php echo $string_detalle['li_nom_serie_coleccion'] ?></b> 
                    <?php echo $solicitud['secciones']['t'][0]['nombre_serie']; ?><br />
                    <b><?php echo $string_detalle['li_num_coleccion'] ?></b>
                    <?php echo $solicitud['secciones']['t'][0]['no_coleccion']; ?><br />
                    <b><?php echo $string_detalle['li_tipo_contenido_coleccion'] ?></b> 
                    <?php 
                    $tipo_cont = $solicitud['secciones']['t'][0]['tipo_contenido']; 
                    echo $c_tipo_contenido[$tipo_cont];
                        
                    ?>
                </address>

            <?php } ?>

            <?php if (!empty($solicitud['secciones']['colab'])) { ?>
                <p class="lead"><b><?php echo $string_detalle['title_colaboradores']; ?></b> <?php echo $botones_seccion[En_secciones::COLABORADORES]; ?></p>
                <?php foreach ($solicitud['secciones']['colab'] as $colaborador) { ?>
                    <address>
                        <b>Nombre:&nbsp;</b><?php 
                            $name = isset($colaborador["nombre"]) ? $colaborador["nombre"]."&nbsp;" : "";
                            $name .= isset($colaborador["paterno"]) ? $colaborador["paterno"]."&nbsp;" : "";
                            $name .= isset($colaborador["materno"]) ? $colaborador["materno"] : ""; 

                            echo $name;
                        ?><br /> 
                        <b>Rol:&nbsp;</b><?php echo $tipoColab[$colaborador['tipo']]; ?><br /> 
                        <b>Nacionalidad:&nbsp;</b><?php echo $c_nacionalidad[$colaborador['nacionalidad']]; ?><br /> 
                        <b>Seud&oacute;nimo:&nbsp;</b><?php echo $colaborador['seudonimo'] ?><br />
                        <b>Correo electr&oacute;nico:&nbsp;</b><?php echo $colaborador['email'] ?>
                    </address>
                <?php } ?>
            <?php } ?>


            <?php if (!empty($solicitud['secciones']['trns'])) { ?>
                <p class="lead"><b><?php echo $string_detalle['title_traduccion']; ?></b> <?php echo $botones_seccion[En_secciones::TRADUCCION]; ?></p>
                <?php $traduccion = $solicitud['secciones']['trns'][0]; ?> 
                <address>
                    <b><?php echo $string_detalle['li_title_original_traduccion']; ?> </b>
                    <?php echo $traduccion['titulo_original']; ?><br />
                    <b><?php echo $string_detalle['li_idioma_orig_traduccion'] ?></b>
                    <?php echo $traduccion['ni_orig']; ?><br />
                    <b><?php echo $string_detalle['li_idioma_del_traduccion'] ?></b>
                    <?php echo $traduccion['ni_del']; ?><br />
                    <b><?php echo $string_detalle['li_idioma_al_traduccion'] ?></b>
                    <?php echo $traduccion['ni_al']; ?>
                </address>    
            <?php } ?>

            <?php if (!empty($solicitud['secciones']['ed'])) { ?>
                <?php $ed_ = $solicitud['secciones']['ed'][0]; ?>
                <p class="lead"><b><?php echo $string_detalle['title_info_edicion']; ?></b><?php echo $botones_seccion[En_secciones::INFO_EDICION]; ?></p>
                <address>
                    <b>No. Edici&oacute;n:&nbsp;</b><?php echo $ed_['no_edicion']; ?><br /> 
                    <b>Departamento, provincia o estado:&nbsp;</b><?php echo $ed_['nome_dpto']; ?><br /> 
                    <b>Ciudad de dici&oacute;n:&nbsp</b><?php echo $ed_['name_ciudad']; ?><br /> 
                    <b>Fecha de aparici&oacute;n:&nbsp;</b><?php echo $ed_['fecha_aparicion']; ?><br /> 
                    <b>Coedici&oacute;n:&nbsp;</b><?php echo $ed_['coedicion']; ?><br /> 
                    <b>Coeditor:&nbsp;</b><?php echo $ed_['coeditor']; ?><br /> 
                </address>

            <?php } ?>

            <?php if (!empty($solicitud['secciones']['cmrc'])) { ?>
                <?php $cmrc_ = $solicitud['secciones']['cmrc'][0]; ?>
                <p class="lead"><b>Comercializaci&oacute;n</b><?php echo $botones_seccion[En_secciones::COMERCIALIZACION]; ?></p>
                <address>
                    <b>Ejemplares nacionales:&nbsp;</b><?php echo $cmrc_['ejemplares_nacional']; ?><br /> 
                    <b>Precio local:&nbsp;</b><?php echo $cmrc_['precio_local']; ?><br /> 
                    <b>Ejemplares externos:&nbsp;</b><?php echo $cmrc_['ejemplares_externa']; ?><br /> 
                    <b>Precio a externos:&nbsp;</b><?php echo $cmrc_['precio_externo']; ?><br /> 
                    <b>Oferta total:&nbsp;</b><?php echo $cmrc_['oferta_total']; ?><br /> 
                </address>

            <?php } ?>

            <?php if (isset($solicitud['secciones']['print']) && !empty($solicitud['secciones']['print'])) { ?>

                <p class="lead"><b>Descripci&oacute;n f&iacute;sica (Impresa)</b><?php echo $botones_seccion[En_secciones::DESC_FISICA]; ?></p>
                <address>
                    <b>Descripci&oacute;n f&iacute;sica:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['desc_fisica'];?><br /> 
                    <b>Encuadernac&iacute;n:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['encuadernacion'];?><br /> 
                    <b>Gramaje:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['gramaje'];?><br /> 
                    <b>Tipo de impresi&oacute;n:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['impresion'];?><br /> 
                    <b>Tipo de papel:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['tipo_papel'];?><br /> 
                    <b>N&uacute;mero de p&aacute;ginas:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['no_paginas'];?><br /> 
                    <b>N&uacute;mero tintas:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['num_tintas'];?><br /> 
                    <b>Ancho:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['ancho'];?> cm<br /> 
                    <b>Alto:&nbsp;</b>
                        <?php echo $solicitud['secciones']['print']['alto'];?> cm<br /> 
                </address>

            <?php } elseif (isset($solicitud['secciones']['digital']) && !empty($solicitud['secciones']['digital'])) { ?>
                <p class="lead"><b>Descripci&oacute;n f&iacute;sica (Electrónica)</b><?php echo $botones_seccion[En_secciones::DESC_FISICA]; ?></p>
                <?php $digital_df = $solicitud['secciones']['digital']; ?>
                <address>
                    <b>Medio:&nbsp; </b><?php echo $digital_df['medio']; ?><br /> 
                    <b>Formato: </b><?php echo $digital_df['formato']; ?><br /> 
                    <b>Tamaño: </b><?php echo $digital_df['tamanio_desc']. ' ' .$digital_df['tamanio']; ?><br /> 
                    <b>URL: </b><a href='<?php echo $digital_df['url'] ?>'><?php echo $digital_df['url'] ?></a><br />
                </address>
            <?php }
            ?>

            <?php if (!empty($solicitud['secciones']['epay'])) { ?>
                <?php $epay_r = $solicitud['secciones']['epay'][0]; ?>
                <p class="lead"><b>Pago electr&oacute;nico</b><?php echo $botones_seccion[En_secciones::PAGO_ELECTRONICO]; ?></p>
                <address>
                    <b>Clave de pago:&nbsp;</b><?php echo $epay_r['pay_hash']; ?><br /> 
                    <b>Cadena de dependencia:&nbsp;</b><?php echo $epay_r['cadena_dependencia']; ?><br /> 
                    <b>Cadena de referencia:&nbsp;</b><?php echo $epay_r['cadena_referencia']; ?><br /> 
                    <b>N&uacute;mero de operador:&nbsp;</b><?php echo $epay_r['no_operacion'] ?><br />
                </address>
            <?php } ?>


            <?php if (!empty($solicitud['secciones']['files'])) { ?>
                <p class="lead"><b>Archivos</b> <?php echo $botones_seccion[En_secciones::ARCHIVOS]; ?></p>
                <br>
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12 text-center">
                        <?php $data_seccion['files'] = $solicitud['secciones']['files']; ?>
                        <?php $data_seccion['enable_options'] = FALSE; 
                        $datos_eccion["c_tipo_file"] = $c_tipo_file;
                        ?>
                        <?php echo $this->load->view('solicitud/secciones/file_list.tpl.php', $data_seccion, true); ?>
                    </div>
                </div>
            <?php } ?>

            <?php // if (!empty($file_estado)) { ?>
            <?php // pr($file_estado); ?>

<!--                <p class="lead">
                    <b>Archivo comprobante <?php // echo $array_tipo_comprobante[$file_estado[0]['file_type']]    ?>: </b>
                </p>-->
            <!--<address>-->
                <!--<b>Descripci&oacute;n comprobante: <?php // echo $file_estado[0]['description'];    ?></b>-->
            <?php // $this->load->library('seguridad'); ?>
            <?php // echo '<a href="' . site_url('solicitud/ver_archivo/' . $this->seguridad->encrypt_base64($file_estado[0]['solicitud_id'] . '/' . $file_estado[0]['nombre_fisico'])) . '" target="_blank"><span class="glyphicon glyphicon-search"></span>Ver comprobante ' . $array_tipo_comprobante[$file_estado[0]['file_type']] . '</a>'; ?>
            <!--</address>-->
            <?php // } ?>

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