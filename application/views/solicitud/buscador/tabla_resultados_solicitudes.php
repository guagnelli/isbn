<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_solicitudes);
//pr($rol_cve);
//pr($reglas_estados);
?>
<!--<script type='text/javascript' src="<?php // echo base_url();                           ?>assets/js/validacion_docente/validar_censo.js"></script>-->

<!--<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/solicitud/solicitud_isbn.js"></script>-->


<?php
echo js("solicitud/secciones.js");
?>
<script type="text/javascript" language="javascript" class="init">

    $(document).ready(function () {
        $('#tabla_isbn').DataTable({
//            "order": [[2, "desc"]]
//            "order": [[0, 'desc'], [1, 'desc'], [2, 'desc']],
//            "columnDefs": [
////                {"orderData": [0, 1], "targets": 0},
//                {"orderData": 0, "targets": 2},
////                {"orderData": [2, 3, 4], "targets": 2}
//            ]
            "paging": false,
            "ordering": true,
            "info": false,
            "searching": false
        });
    });

</script>

<div id="div_tabla_isbn" class="col-lg-12 table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_isbn">
        <thead>
            <tr class="bg-red">
                <th  style="color:#ffffff"><?php echo $string_values['title_folio']; ?></th>
                <th style="color:#ffffff" ><?php echo $string_values['title_estado']; ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_isbn_libro']; ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_libro']; ?></th>
                <?php if ($rol_cve != E_rol::ENTIDAD) { ?>
                    <th style="color:#ffffff"><?php echo $string_values['title_name_entidad']; ?></th>
                <?php } ?>
                <th style="color:#ffffff"><?php echo $string_values['title_subcategoria']; ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_fecha_validacion']; ?></th>
                <th style="color:#ffffff"><?php echo $string_values['title_operacion']; ?></th>
            </tr>
        </thead >
        <tbody>
            <?php
            foreach ($lista_solicitudes as $key_ai => $val) {
//                pr($val);
//                pr($val['hist_validacion_cve']);
                $solicitud_cve = $this->seguridad->encrypt_base64($val['solicitud_cve']);
                $hist_solicitud = $this->seguridad->encrypt_base64(intval($val['hist_solicitud']));
                $estado_solicitud = $this->seguridad->encrypt_base64(intval($val['estado_cve']));
                $link_ver_detalle = '';

//                $link_ver_detalle = '<button '
//                        . 'id="btn_ver_detalle" '
//                        . 'type="button" '
//                        . 'class="btn btn-link btn-sm" '
//                        . 'data-row="' . $key_ai . '"'
//                        . 'data-solicitudcve ="' . $solicitud_cve . '"'
//                        . 'data-estadosolicitudcve="' . $estado_solicitud . '"'
//                        . 'data-histsolicitudcve="' . $hist_solicitud . '"'
//                        . 'data-toggle="modal"'
//                        . 'data-target="#modal_censo"'
//                        . 'onclick="ver_detalle_solicitud(this)" >' .
//                        $string_values['link_ver_detalle_solicitud']
//                        . '</button>';

                $link_ver_detalle = '<a href="#" '
                        . 'data-solicitudcve ="' . $solicitud_cve . '" '
                        . 'data-estadosolicitudcve="' . $estado_solicitud . '" '
                        . 'data-histsolicitudcve="' . $hist_solicitud . '" '
                        . 'data-toggle="modal" '
                        . 'data-target="#modal_censo" '
                        . 'data-original-title="' . $string_values['link_ver_detalle_solicitud']
                        . ' title="' . $string_values['link_ver_detalle_solicitud']
                        . ' onclick="ver_detalle_solicitud(this)"> '
                        . '<span class="glyphicon glyphicon-eye-open btn-msg" '
                        . '"> '
                        . '</span></a>';

//                $link_ver_solicitud = 'class=" text-center" ';

                $href_solicitud = '<a data-toggle="tab" href="#select_perfil_solicitud" '
                        . 'onclick="funcion_ver_solicitud_entidad(this)" '
                        . 'data-solicitudcve ="' . $solicitud_cve . '" '
                        . 'data-estadosolicitudcve="' . $estado_solicitud . '" '
                        . 'data-histsolicitudcve="' . $hist_solicitud . '" '
                        . 'data-row="' . $key_ai . '" '
                        . '> '
                        . '<span class="glyphicon glyphicon-edit btn-msg"></span> '
                        . '</a>';

                $link_ver_historial = '<a href="#" '
                        . 'data-solicitudcve ="' . $solicitud_cve . '" '
                        . 'data-toggle="modal" '
                        . 'data-target="#modal_censo" '
                        . 'data-original-title="' . $string_values['link_ver_detalle_solicitud']
                        . ' title="' . $string_values['link_ver_detalle_solicitud']
                        . ' onclick="ver_historial_solicitud(this)"> '
                        . '<span class="glyphicon glyphicon-dashboard btn-msg" '
                        . '"> '
                        . '</span></a>';
//                $link_editar_titulo = isset($link_editar_titulo) ? $link_editar_titulo : '';
//               $link_editar = '<a class="" '
//                       . 'href="' . site_url() . '/solicitud/registrar/' . $val['solicitud_cve'] . '" '
//                       . 'target="_blank"><span class="glyphicon glyphicon-edit btn-msg"></span></a>';
                $link_editar = '';
                $link_editar_titulo = '';
                if (valida_acceso_rol_validador($rol_cve, $val['estado_cve'], $reglas_estados) AND $reglas_estados[$val['estado_cve']]['is_editable_solicitud']) {
                    $link_editar = '<form method="post" id="form_editar_' . $key_ai . '" action="' . site_url() . '/solicitud/registrar" target="_blank">'
                            . '<input type="hidden" id="solicitud" name="solicitud" value="' . $val['solicitud_cve'] . '" /> '
                            . '<span class="glyphicon glyphicon-edit btn-msg" '
                            . 'data-original-title="' . $string_values['link_ver_detalle_solicitud'] . '" title="" placeholder="Ordernar por"'
                            . 'data-keyrow="' . $key_ai . '" '
                            . 'onclick="editar_sol(this)">'
                            . '</span> '
                            . ' </form>';
                    if (isset($reglas_estados[$val['estado_cve']]['vista'][$rol_cve]) and $reglas_estados[$val['estado_cve']]['vista'][$rol_cve] == 'editar_registro') {

                        $link_editar_titulo = '<a class="" '
                                . 'href="' . site_url() . '/solicitud/registrar/' . $val['solicitud_cve'] . '" '
                                . 'target="_blank"><span class="glyphicon glyphicon-superscript btn-msg"></span></a>';
                    }


//                    $link_editar = '<a href="#" class="button search">
//                                        <span class="spanclass"></span>
//                                        <input class="expand" name="searchString" type="text">
//                                        <span id="searchButton" class="search icon-small open-btn"></span>
//                                    </a>';
                }
//                            . '<input class = "btn btn-primary" type = "submit" value = "" name = "btn_' . $key_ai . '">'

                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td >" . $val['folio_libro'] . "</td>";
                echo "<td>" . $val['name_estado'] . "</td>";
                echo "<td>" . $val['isbn_libro'] . "</td>";
                echo "<td>" . $val['titulo_libro'] . "</td>";
                if ($rol_cve != E_rol::ENTIDAD) {
                    echo "<td>" . $val['name_entidad'] . "</td>";
                }
                echo "<td>" . $val['sub_categoria'] . "</td>";
                echo "<td>" . $val['fecha_ultima_revision'] . "</td>";
                echo "<td >" . $link_ver_detalle . $href_solicitud . $link_ver_historial . $link_editar_titulo . "</td>";
//                echo "<td  " . $link_ver_solicitud . "><a data-toggle='tab' href='#select_perfil_solicitud'> " . $string_values['link_ver_solicitud'] . " </a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
//    $(document).ready($("#btn_buscar_solicitudes").trigger("click"));
    function editar_sol(element) {
        var obj = $(element);
        var key = obj.data('keyrow');
        ajax();
        $("#form_editar_" + key).submit();
    }
//    $(document).ready(function () {
//        $('#tabla_isbn').DataTable({
////            "ajax": "data/objects.txt",
//            "columns": [
//                {"data": "name"},
//                {"data": "position"},
//                {"data": "office"},
//                {"data": "extn"},
//                {"data": "start_date"},
//                {"data": "salary"}
//            ]
//        });
//    });
</script>