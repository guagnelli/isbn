<?php // pr( $identificador);    ?>
<div class="list-group-item text-center center">
    <button type="button" id="close_modal_censo" class="btn btn-default" data-dismiss="modal"><?php echo $string_values['btn_close']; ?></button>
    <button id="btn_guardar_comentario" type="button" class="btn btn-default"
            data-secciocve="<?php echo (isset($seccion)) ? $seccion: ''; ?> "
            data-histsolicitudcve="<?php echo (isset($hist_sol)) ? $hist_sol: ''; ?> "
            onclick="funcion_guardar(this)" >
                <?php echo $string_values['btn_guardar_comentario']; ?>
    </button>
</div>