<?php
//pr($solicitud);
$this->lang->load('interface', 'spanish');
$string_detalle = $this->lang->line('interface')['solicitud_detalle'];
//pr($estado_actual);
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
    <?php if (isset($estado_actual['is_captura_isbn'])) { ?>
        <div class="isbn_panel">
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                    <strong>Captura ISBN</strong>
                </label>
                <div class="col-md-9 col-sm-9 col-xs-12">
                    <?php
                    echo $this->form_complete->create_element(array('id' => 'isbn_libro',
                        'type' => 'text',
                        'value' => '',
                        'attributes' => array(
                            'class' => 'form-control',
                            'placeholder' => 'ISBN',
                            'maxlength' => '4000',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'title' => 'ISBN')));
                    ?>
                    <?php echo form_error_format('comentario_justificacion'); ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="x_panel">
        <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">
                <strong>Comentario</strong>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <?php
                echo $this->form_complete->create_element(array('id' => 'description',
                    'type' => 'textarea',
                    'value' => '',
                    'attributes' => array(
                        'class' => 'form-control',
                        'placeholder' => 'Comentario',
                        'maxlength' => '4000',
                        'data-toggle' => 'tooltip',
                        'data-placement' => 'top',
                        'title' => 'Comentario')));
                ?>
                <?php echo form_error_format('comentario_justificacion'); ?>
            </div>
        </div>

    </div>
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