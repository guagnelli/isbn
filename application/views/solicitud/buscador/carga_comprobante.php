<?php
//pr($solicitud);
$this->lang->load('interface', 'spanish');
$string_detalle = $this->lang->line('interface')['solicitud_detalle'];
//pr($solicitud);
?>
<div class="text-left" role="main">
    <!---Cuerpo-->
    <?php
    echo form_open_multipart("solicitud/guardar_estado_comprobante", array(
        'id' => 'frm_file_comprobante',
        'name' => 'frm_file',
        'class' => 'form-horizontal form-label-left',
        'method' => 'post'
    ));
    ?>
    <div id="msg_general" role="alert" ></div>
    <div class="x_panel">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                <b><span class="required">*</span>Archivo comprobante:</b>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <?php
                echo $this->form_complete->create_element(array(
                    'id' => 'archivo',
                    'type' => 'upload',
                    'attributes' => array(
                        'class' => 'form-control col-md-7 col-xs-12',
                        'style' => 'width:100%; ',
                        'accept' => "application/pdf",
                        'autocomplete' => 'off',
                        'maxlength' => 13,
                        'minlength' => 10
                )));
                ?>
            </div>
        </div>
    </div>
    <?php echo form_close(); ?>

</div>
<?php echo js("uf/jquery.form.min.js"); ?>
<?php echo js("uf/uf_ri.js"); ?>