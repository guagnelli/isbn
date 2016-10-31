<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_solicitudes);
?>
<!--<script type='text/javascript' src="<?php // echo base_url();   ?>assets/js/validacion_docente/validar_censo.js"></script>-->
</style>
<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/solicitud/solicitud_isbn.js">
</script>

<div id="tabla_designar_validador" class="col-lg-12 table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr class="bg-red">
                <th  style="color:#ffffff"><?php echo $string_values['title_folio'] ?></th>
                <th style="color:#ffffff" ><?php echo $string_values['title_estado'] ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_isbn_libro'] ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_libro'] ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_name_entidad'] ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_fecha_validacion'] ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_ver_detalle'] ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_validacion'] ?></th>
            </tr>
        </thead >
        <tbody>
            <?php
            foreach ($lista_solicitudes as $key_ai => $val) {
//                pr($val['hist_validacion_cve']);
                $solicitud_cve = $this->seguridad->encrypt_base64($val['solicitud_cve']);
                $hist_solicitud = $this->seguridad->encrypt_base64(intval($val['hist_solicitud']));
                $estado_solicitud = $this->seguridad->encrypt_base64(intval($val['estado_cve']));
                $link_ver_detalle = '';

                $link_ver_detalle = '<button '
                        . 'id="btn_ver_detalle" '
                        . 'type="button" '
                        . 'class="btn btn-link btn-sm" '
                        . 'data-row="' . $key_ai . '"'
                        . 'data-solicitudcve ="' . $solicitud_cve . '"'
                        . 'data-estadosolicitud="' . $estado_solicitud . '"'
                        . 'data-histsolicitudcve="' . $hist_solicitud . '"'
                        . 'data-toggle="modal"'
                        . 'data-target="#modal_censo"'
                        . 'onclick="ver_detalle_solicitud(this)" >' .
                        $string_values['link_ver_detalle_solicitud']
                        . '</button>';

                $link_ver_solicitud = 'class=" text-center" '
                        . 'onclick="funcion_ver_solicitud_entidad(this)" '
                        . 'data-solicitudcve ="' . $solicitud_cve . '"'
                        . 'data-row="' . $key_ai . '"'
                        . 'data-histsolicitudcve="' . $hist_solicitud . '"'
                        . 'data-estadosolicitud="' . $estado_solicitud . '"';

                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td >" . $val['folio_libro'] . "</td>";
                echo "<td>" . $val['name_estado'] . "</td>";
                echo "<td>" . $val['isbn_libro'] . "</td>";
                echo "<td>" . $val['titulo_libro'] . "</td>";
                echo "<td>" . $val['name_entidad'] . "</td>";
                echo "<td>" . $val['fecha_ultima_revision'] . "</td>";
                echo "<td>" . $link_ver_detalle . "</td>";
                echo "<td  " . $link_ver_solicitud . "><a data-toggle='tab' href='#select_perfil_solicitud'> " . $string_values['link_ver_solicitud'] . " </a></td>";
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>