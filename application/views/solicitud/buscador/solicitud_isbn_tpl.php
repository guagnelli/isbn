<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//pr($entidad_id);
?>

<style type="text/css">
    .button-padding {padding-top: 30px}
    .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    /*Oculta el file para cargar comprobante y deja asi solo muestra un botón*/
    .borderlist {    list-style-position:inside; border: 1px solid #8c9494}
    .lip { cursor: pointer;
           display:block; }


</style>

<script type='text/javascript' src="<?php echo base_url(); ?>assets/js/solicitud/solicitud_isbn.js">
    var hash = window.location.hash;
    $('.nav.nav-pills a[href="' + hash + '"]').tab('show', function () {
//        alert('invocacion');
        $(document).scrollTop();
    });
</script>
<?php echo css("datatables/jquery.dataTables.css"); ?>
<?php echo js("datatables/jquery.dataTables.js"); ?>
<!-- Inicio informacion personal -->

<div class="list-group">

    <div class="list-group-item">
        <div class="panel-body tab-content">
            <div class="row" >
                <div class="col-md-12 col-sm-12 col-xs-12 " id='div_error_index' style='display:none'>
                    <div id='mensaje_error_div_index' class='alert'>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <span id='mensaje_error_index'></span>
                    </div>
                </div>
            </div>

            <div id="select_buscador_solicitud_entidad" class="tab-pane fade active in">
                <div>
                    <br>
                    <h4><?php echo $title_template; ?> </h4>
                    <br>
                </div>
                <?php echo form_open('', array('id' => 'form_busqueda_solicitudes')); ?>
                <?php if (isset($c_entidad)) { //Si existe entidad, no es ususario entidad  ?> 
                    <!--                    <div class="row">
                                            <div class="col-md-12 col-lg-12 col-sm-12">
                                                <a class="btn btn-primary" href="<?php // echo site_url();              ?>/solicitud/registrar"  target="_blank"><?php echo $string_values['btn_agreagar_solicitud']; ?></a>
                                            </div>
                                        </div>-->
                    <?php // } else { //Si existe entidad, no es ususario entidad  ?> 
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <div class="panel-body input-group ">
                                <span class="input-group-addon"><?php echo $string_values['lbl_entidades']; ?></span>
                                <?php
                                echo $this->form_complete->create_element(array('id' => 'entidad_cve',
                                    'type' => 'dropdown',
                                    'options' => $c_entidad,
                                    'first' => array('' => $string_values['drop_estado_solicitud']),
                                    'value' => (isset($entidad_id)) ? $entidad_id : '',
                                    'class' => 'form-control',
                                    'attributes' => array('class' => 'form-control',
                                        'placeholder' => $string_values['lbl_entidades'],
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => $string_values['lbl_entidades'],
                                        'onchange' => 'funcion_buscar_solicitudes()')));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-sm-6">
                            <div class="panel-body input-group ">
                                <span class="input-group-addon"><?php echo $string_values['lbl_subsistema']; ?></span>
                                <?php
                                echo $this->form_complete->create_element(array('id' => 'sub_sistema_cve',
                                    'type' => 'dropdown',
                                    'options' => $c_subsistema,
                                    'first' => array('' => $string_values['drop_subsistema']),
                                    'value' => (isset($subsistema_cve)) ? $subsistema_cve : '',
                                    'class' => 'form-control',
                                    'attributes' => array('class' => 'form-control',
                                        'placeholder' => $string_values['lbl_subsistema'],
                                        'data-toggle' => 'tooltip',
                                        'data-placement' => 'top',
                                        'title' => $string_values['lbl_subsistema'],
                                        'onchange' => 'funcion_buscar_solicitudes()'
                                    )
                                ));
                                ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_estado_solicitud']; ?></span>
                            <?php
                            if ($this->session->userdata('rol_cve') == 3) {
                                unset($c_estado[1]);
                            }
                            echo $this->form_complete->create_element(array('id' => 'estado_cve',
                                'type' => 'dropdown',
                                'options' => $c_estado,
                                'first' => array('' => $string_values['drop_estado_solicitud']),
                                'value' => (isset($estado_cve)) ? $estado_cve : '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_estado_solicitud'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_estado_solicitud'],
                                    'onchange' => 'funcion_buscar_solicitudes()'
                                )
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_tematica']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'categoria_cve',
                                'type' => 'dropdown',
                                'options' => $c_categoria,
                                'first' => array('' => $string_values['drop_tematica']),
                                'value' => (isset($subcategoria_cve)) ? $subcategoria_cve : '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_tematica'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_tematica'],
                                    'onchange' => 'sub_categoria(this); funcion_buscar_solicitudes();'
                                )
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_subcategoria']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'sub_categoria_cve',
                                'type' => 'dropdown',
                                'options' => $c_subcategoria,
                                'first' => array('0' => $string_values['drop_subcategoria']),
                                'value' => (isset($subcategoria_cve)) ? $subcategoria_cve : '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_subcategoria'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_subcategoria'],
                                    'onchange' => 'funcion_buscar_solicitudes()'
                                )
                            ));
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="panel-body input-group ">
                            <span class="input-group-addon"><?php echo $string_values['lbl_tipoobra']; ?></span>
                            <?php
                            echo $this->form_complete->create_element(array('id' => 'sol_tipo_obra',
                                'type' => 'dropdown',
                                'options' => $c_tipoobra,
                                'first' => array('' => $string_values['drop_tipoobra']),
                                'value' => (isset($ipo_obra)) ? $tipo_obra : '',
                                'class' => 'form-control',
                                'attributes' => array('class' => 'form-control',
                                    'placeholder' => $string_values['lbl_tipoobra'],
                                    'data-toggle' => 'tooltip',
                                    'data-placement' => 'top',
                                    'title' => $string_values['lbl_tipoobra'],
                                    'onchange' => 'funcion_buscar_solicitudes()'
                                )
                            ));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="panel-body input-group">
                            <span class="input-group-addon"><?php echo $string_values['lbl_cantidad_registros']; ?></span>
                            <?php echo $this->form_complete->create_element(array('id' => 'per_page', 'type' => 'dropdown', 'options' => array(10 => 10, 20 => 20, 50 => 50, 100 => 100, 500 => 500), 'attributes' => array('class' => 'form-control', 'placeholder' => 'Número de registros a mostrar', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Número de registros a mostrar', 'onchange' => "funcion_buscar_solicitudes()"))); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="panel-body input-group input-group-sm">
                            <span class="input-group-addon"><?php echo $string_values['lbl_ordenar_por']; ?>:</span>
                            <?php echo $this->form_complete->create_element(array('id' => 'order', 'type' => 'dropdown', 'options' => $order_columns, 'attributes' => array('class' => 'form-control', 'placeholder' => 'Ordernar por', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Ordenar por', 'onchange' => "funcion_buscar_solicitudes()"))); ?>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-md-4">
                        <div class="panel-body input-group input-group-sm">
                            <span class="input-group-addon"><?php echo $string_values['lbl_tipo_orden']; ?></span>
                            <?php echo $this->form_complete->create_element(array('id' => 'order_type', 'type' => 'dropdown', 'options' => array('ASC' => 'Ascendente', 'DESC' => 'Descendente'), 'attributes' => array('class' => 'form-control', 'placeholder' => 'Ordernar por', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'Ordenar por', 'onchange' => "funcion_buscar_solicitudes()"))); ?>
                        </div>
                    </div>
                </div>
                <div class="row" >
                    <div class="col-md-12 col-lg-12 col-sm-12">
                        <div class="panel-body input-group">
                            <input type="hidden" id="menu_select" name="menu_busqueda" value="titulo_obra">
                            <div class="input-group-btn">
                                <button id="btn_buscar_por" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-default dropdown-toggle " data-toggle="tooltip" data-original-title="<?php echo $string_values['text_buscar_por']; ?>"><?php echo $string_values['li_title_obra']; ?><span class="caret"> </span></button>
                                <ul id="ul_menu_buscar_por" data-seleccionado='titulo_obra' class="dropdown-menu borderlist">
                                    <li class="lip" onclick="funcion_menu_tipo_busqueda_solicitud('isbn')"><?php echo $string_values['li_isbn']; ?></li>
                                    <li class="lip" onclick="funcion_menu_tipo_busqueda_solicitud('titulo_obra')"><?php echo $string_values['li_title_obra']; ?></li>
                                    <li class="lip" onclick="funcion_menu_tipo_busqueda_solicitud('sub_titulo_obra')"><?php echo $string_values['li_sub_title_obra']; ?></li>
                                </ul>
                            </div>

                            <?php
                            echo $this->form_complete->create_element(
                                    array('id' => 'buscador_solicitudes', 'type' => 'text',
                                        'value' => '',
                                        'attributes' => array(
                                            'placeholder' => $string_values['txt_buscar_solicitud'],
                                            'data-toggle' => 'tooltip',
                                            'data-placement' => 'bottom',
                                            'class' => 'form-control',
                                            'onkeypress' => 'return runScript_busqueda_val(event);',
                                            'title' => $string_values['txt_buscar_solicitud'],
                                        )
                                    )
                            );
                            ?>
                            <div class="input-group-btn" >
                                <button type="button" id="btn_buscar_solicitudes" aria-expanded="false" 
                                        class="btn btn-default browse" 
                                        title="<?php echo$string_values['txt_buscar_solicitud']; ?>" 
                                        data-toggle="tooltip" onclick="funcion_buscar_solicitudes()" >
                                    <span aria-hidden="true" class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <div class="row" >
                    <div id="div_result_solicitudes" class="row" style="padding:0 20px;">

                    </div>
                </div>
            </div>
            <div id="select_perfil_solicitud" class="tab-pane fade">

            </div>
        </div>
    </div>    

</div>
<script type="text/javascript">
function sub_categoria(obj){
  var categoria_id = $(obj).val();
  var action = "<?php echo base_url();?>index.php/solicitud/sub_categoria";
  var form_data = {categoria:categoria_id};
  //alert(form_data)
  ajax(action,form_data,'#sub_categoria_cve','#msg_general');
  //});
}
</script>





