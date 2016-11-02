<?php if ($rol_cve == E_rol::DGAJ) {//Sólo el dgaj puede validar  ?>
    <div class="list-group-item text-center center">
        <button type="button" id="close_modal_censo" class="btn btn-default" data-dismiss="modal"><?php echo $string_values['btn_close']; ?></button>
        <button type="button" class="btn btn-default"
                data-seccioncve="<?php echo (isset($seccion)) ? $seccion : ''; ?> "
                data-histsolicitudcve="<?php echo (isset($hist_sol)) ? $hist_sol : ''; ?> "
                data-solicitudcve="<?php echo (isset($solicitud_cve)) ? $solicitud_cve : ''; ?> "
                onclick="funcion_guardar_comentario(this)" >
                    <?php echo $string_values['btn_guardar_comentario']; ?>
        </button>
    </div>
<?php } ?>