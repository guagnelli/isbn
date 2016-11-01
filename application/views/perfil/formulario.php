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
                    <h4><?php echo $string_values['title_perfil']; ?> </h4>
                    <br>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_nombre']; ?>: </span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'nombre',
                                'type' => 'text',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_nombre'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_nombre'])));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_paterno']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'apaterno',
                                'type' => 'text',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_paterno'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_paterno'])));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_materno']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'amaterno',
                                'type' => 'text',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_materno'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_materno'])));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_correo']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'correo',
                                'type' => 'text',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_correo'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_correo'])));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_contrasenia']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'contrasenia',
                                'type' => 'text',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_contrasenia'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_contrasenia'])));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_confirmacion']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'confirmacion',
                                'type' => 'text',
                                'value' => '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_confirmacion'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_confirmacion'])));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-group-btn text-right" >
                        <button type="submit" id="btn_guardar" aria-expanded="false" 
                                class="btn btn-default browse" 
                                title="<?php echo $string_values['lbl_guardar']; ?>" 
                                data-toggle="tooltip">
                            <?php echo $string_values['lbl_guardar'];?> <span aria-hidden="true" class="glyphicon glyphicon-search"></span>
                        </button>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>    
</div>






