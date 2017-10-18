<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style type="text/css">
    .button-padding {padding-top: 30px}
    .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    /*Oculta el file para cargar comprobante y deja asi solo muestra un botón*/
    .borderlist {    list-style-position:inside; border: 1px solid #8c9494}
    .lip { cursor: pointer;
           display:block; }
</style>

<!-- <script type='text/javascript' src="<?php //echo base_url(); ?>assets/js/perfil.js"></script> -->

    <!-- Inicio informacion personal -->
<div class="list-group">

    <div class="list-group-item">

        <div class="panel-body tab-content">
            <?php echo form_open('perfil', array('id' => 'form_perfil')); ?>
            <div id="select_buscador_solicitud_entidad" class="tab-pane fade active in">
                <div class="row">
                    <br>
                    <h4><?php echo $string_values['title_perfil'].$dato_usuario['usu_nombre']; ?> </h4>
                    <br>
                </div>
                <div class="row">
                    <?php if(isset($msg) && !is_null($msg)){ echo $msg; } //Imprimir mensaje ?>
                    <div id="mensaje"></div>
                </div>
                <!--div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon">* <?php echo $string_values['lbl_nombre']; ?>: </span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'nombre',
                                'type' => 'text',
                                'value' => $dato_usuario['usu_nombre'],
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_nombre'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_nombre'])));
                            ?>
                        </div>
                        <?php echo form_error_format('nombre'); ?>
                    </div>
                </div-->
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon">* <?php echo $string_values['lbl_nombre']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'apaterno',
                                'type' => 'text',
                                'value' => $dato_usuario['usu_paterno'],
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_nombre'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_nombre'])));
                            ?>
                        </div>
                        <?php echo form_error_format('apaterno'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon">* <?php echo $string_values['lbl_paterno']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'amaterno',
                                'type' => 'text',
                                'value' => $dato_usuario['usu_materno'],
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_paterno'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_paterno'])));
                            ?>
                        </div>
                        <?php echo form_error_format('amaterno'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon">* <?php echo $string_values['lbl_correo']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'correo',
                                'type' => 'text',
                                'value' => $dato_usuario['usu_correo'],
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_correo'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_correo'])));
                            ?>
                        </div>
                        <?php echo form_error_format('correo'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_contrasenia']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'contrasenia',
                                'type' => 'password',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_contrasenia'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_contrasenia'])));
                            ?>
                        </div>
                        <?php echo form_error_format('contrasenia'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_contrasenia_confirmacion']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'confirmacion',
                                'type' => 'password',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_contrasenia_confirmacion'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_contrasenia_confirmacion'])));
                            ?>
                        </div>
                        <?php echo form_error_format('confirmacion'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group-btn text-right" >
                        <button type="submit" id="btn_guardar" aria-expanded="false" 
                                class="btn btn-default browse" 
                                title="<?php echo $string_values['lbl_guardar']; ?>" 
                                data-toggle="tooltip">
                            <?php echo $string_values['lbl_guardar'];?> <span aria-hidden="true" class="glyphicon glyphicon-send"></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>    
</div>






