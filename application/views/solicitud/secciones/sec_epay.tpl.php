<?php
if (isset($debug)) {
    //pr($debug);
}
//echo form_close(); 
echo form_open("solicitud/sec_epay", array(
    'id' => 'frm_epay',
    'class' => 'form-horizontal form-label-left',
    'method' => 'post'
));
//echo "Hola";
//pr($combos);
if (isset($epay["id"])) {
    ?>
    <input type="hidden" id="id" name="id" value="<?php echo $epay["id"] ?>" />
    <?php
}
?>


<div class="row">
    <div class="col-xs-12 col-md-12 col-sm-12">
        <p class="lead">Informaci&oacute;n de pago <?php echo $comentarios; ?></p>
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">
                <b><span class="required">*</span>Llave de pago:</b>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'pay_hash',
                    'type' => 'text',
                    'value' => isset($epay["pay_hash"]) ? $epay["pay_hash"] : "",
                    'class' => 'form-control col-md-8 col-xs-12',
                    'attributes' => array('placeholder' => 'Clave de pago')
                ));
                ?>
                <?php echo form_error('pay_hash'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">
                <b><span class="required">*</span>N&uacute;mero de operaci&oacute;n:</b>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">
                <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'no_operacion',
                    'type' => 'text',
                    'value' => isset($epay["no_operacion"]) ? $epay["no_operacion"] : "",
                    'class' => 'form-control col-md-8 col-xs-12',
                    'attributes' => array('placeholder' => 'N&uacute;mero de operaci&oacute;n')
                ));
                ?>
                <?php echo form_error('no_operacion'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">
                <b><span class="required">*</span>Cadena de la dependencia:</b>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">cadena estática dependencia
                <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'cadena_dependencia',
                    'type' => 'hidden',
                    'value' => '000000000',
                ));
                ?>
                <?php echo form_error('cadena_dependencia'); ?>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4 col-sm-4 col-xs-12">
                <b><span class="required">*</span>Clave de referencia:</b>
            </label>
            <div class="col-md-8 col-sm-8 col-xs-12">cadena estática referencia
                <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'cadena_referencia',
                    'type' => 'hidden',
                    'value' => '000000',
                ));
                ?>
                <?php echo form_error('cadena_referencia'); ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-12 text-center">
                <button id="send_epay" 
                        type="button" 
                        class="btn btn-form" 
                        data-type="epay"
                        onclick="btn(this)" >
                    Registrar informaci&oacute;n de pago
                </button>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>