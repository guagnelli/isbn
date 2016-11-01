<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($lista_solicitudes);
if(!isset($descarga)){ ?>
    <div class="col-lg-12 text-right">
        <div class="input-group-btn" >
            <button type="button" id="btn_descargar_solicitudes" aria-expanded="false" 
                    class="btn btn-default browse" 
                    title="<?php echo $string_values['txt_descargar_solicitud']; ?>" 
                    data-toggle="tooltip" onclick="funcion_descargar_solicitudes()" >
                <?php echo $string_values['txt_descargar_solicitud']; ?> <span aria-hidden="true" class="glyphicon glyphicon-download"></span>
            </button>
        </div>
    </div>
<?php } ?>
<div id="tabla_designar_validador" class="col-lg-12 table-responsive">
    <!--Mostrará la tabla de actividad docente --> 
    <table class="table table-striped table-hover table-bordered" id="tabla_investigacion_docente">
        <thead>
            <tr>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_folio'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_isbn_libro'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_libro'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_name_subsistema'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_name_entidad'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_name_categoria'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_name_subcategoria'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_estado'] ?></th>
                <th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_fecha_validacion'] ?></th>
                <?php if(!isset($descarga)){ ?><th style="background-color:#e74c3c; color:#ffffff;"><?php echo $string_values['title_ver_detalle'] ?></th><?php } ?>
            </tr>
        </thead >
        <tbody>
            <?php
            foreach ($lista_solicitudes as $key_ai => $val) {
                $solicitud_cve = $this->seguridad->encrypt_base64($val['solicitud_cve']);
                $hist_solicitud = $this->seguridad->encrypt_base64(intval($val['hist_solicitud']));
                $link_ver_detalle = '';
                $link_ver_detalle = '<button '
                        . 'id="btn_ver_detalle" '
                        . 'type="button" '
                        . 'class="btn btn-link btn-sm" '
                        . 'data-row="' . $key_ai . '"'
                        . 'data-solicitudcve ="' . $solicitud_cve . '"'
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
                        . 'data-histsolicitudcve="' . $hist_solicitud . '"';
                echo "<tr id='id_row_" . $key_ai . "' data-keyrow=" . $key_ai . ">";
                echo "<td >" . $val['folio_libro'] . "</td>";
                echo "<td>" . $val['isbn_libro'] . "</td>";
                echo "<td>" . $val['titulo_libro'] . "</td>";
                echo "<td>" . $val['name_subsistema'] . "</td>";
                echo "<td>" . $val['name_entidad'] . "</td>";
                echo "<td>" . $val['name_categoria'] . "</td>";
                echo "<td>" . $val['name_subcategoria'] . "</td>";
                echo "<td>" . $val['name_estado'] . "</td>";
                echo "<td>" . nice_date($val['fecha_ultima_revision'], 'd/m/Y') . "</td>";
                if(!isset($descarga)){ 
                    echo "<td>" . $link_ver_detalle . "</td>";
                }
                echo "<tr>";
            }
            ?>
        </tbody>
    </table>
</div>