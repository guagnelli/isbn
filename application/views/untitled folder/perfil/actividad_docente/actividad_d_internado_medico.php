<?php defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <script type='text/javascript'>
        $(function() {
            $('#datetimepicker1').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format:'DD-MM-YYYY', 
            locale: 'es',
            useCurrent: false
        });
        $('#datetimepicker2').datetimepicker({
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down"
            },
            format:'DD-MM-YYYY', 
            locale: 'es',
            useCurrent: false
        });
    });
    </script>
    <div class="list-group">
        <div class="list-group-item">
                <div class="panel-body">
                            <?php if(isset($error)){ ?>
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                           <?php echo html_message($error, $tipo_msg); ?>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                            </div>
                            <?php } ?>
                            <div class='row'>
                                <div class="col-md-6">
                                     <label for='lbl_rol_desempenia' class="control-label">
                                         <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_rol_desempenia']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-user"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'crol_desempenia', 'type' => 'dropdown', 
                                                'options' => $crol_desempenia, 
                                                'first' => array('' => $string_values['drop_rol_desempenia']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_rol_desempenia'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('crol_desempenia'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for='lbl_institucion_edu_avala' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_institucion_edu_avala']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-oil"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'cinstitucion_avala', 'type' => 'dropdown', 
                                                'options' => $cinstitucion_avala, 
                                                'first' => array('' => $string_values['drop_institucion_edu_avala']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                'placeholder' => 'Institución avala', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_institucion_edu_avala'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('cinstitucion_avala'); ?>
                                </div>
                            </div>
                    
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='lbl_recibe_pago_extra' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_recibe_pago_extra']; ?>
                                    </label>
                                    <div class='row'>
                                        <div class="col-md-6 text-right">
                                            <label>
                                                <?php
                                                echo $this->form_complete->create_element(
                                                array('id'=>'pago_extra', 'type'=>'radio',
                                                        'value' => 'Si',
                                                        'attributes'=>array(
                                                        'class'=>'radio-inline m-r-sm',
                                                        'title'=> $string_values['radio_duracion_horas'],
    //                                                    'disabled'=> '',
//                                                        'checked'=>"checked",
                                                        'onchange' =>"mostrar_horas_fechas('block')"    
                                                        )
                                                    )
                                                );
                                                ?>
                                                Si
                                            </label>
                                        </div>
                                        <div class="col-md-6 text-left">
                                            <label>
                                                <?php
                                                echo $this->form_complete->create_element(
                                                array('id'=>'pago_extra', 'type'=>'radio',
                                                        'value' => 'No',
                                                        'attributes'=>array(
                                                        'class'=>'radio-inline m-r-sm',
                                                        'title'=> $string_values['radio_duracion_horas'],
    //                                                    'disabled'=> '',
//                                                        'checked'=>"checked",
                                                        'onchange' =>"mostrar_horas_fechas('block')"    
                                                        )
                                                    )
                                                );
                                                ?>
                                                No
                                            </label>
                                        </div>
                                    </div>
                                   <?php   echo form_error_format('pago_extra'); ?>
                                </div>
                                <div class="col-md-6">
                                    <label for='lbl_modulo' class="control-label">
                                        <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_modulo']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-book"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'cmodulo', 'type' => 'dropdown', 
                                                'options' => $cmodulo,
                                                'first' => array('' => $string_values['drop_modulo']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'modulo_name', 'class' => 'form-control', 
                                                'placeholder' => 'Módulo', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_modulo'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('cmodulo'); ?>
                                </div>
                            </div>
                            <div class='row'>
                                <div class="col-md-6">
                                    <label for='lbl_modalidad' class="control-label">
                                         <b class="rojo">*</b>
                                         <?php echo $string_values['lbl_modalidad']; ?>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="fa fa-dot-circle-o"> </span>
                                        </span>
                                        <?php 
                                            echo $this->form_complete->create_element(array('id' => 'cmodalidad', 'type' => 'dropdown', 
                                                'options' => $cmodalidad, 
                                                'first' => array('' => $string_values['drop_modalidad']), 
                                                'value' => '',
                                                'attributes' => array('name' => 'modalidad_name', 'class' => 'form-control', 
                                                'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['lbl_modalidad'] ))); 
                                        ?>
                                   </div>
                                   <?php   echo form_error_format('cmodalidad'); ?>
                                </div>
                                <div class="col-md-6">
                                        <label for='lbl_anio_que_impartio_curso' class="control-label">
                                            <b class="rojo">*</b>
                                            <?php echo $string_values['lbl_anio_que_impartio_curso']; ?>
                                        </label>
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <!--<span class="glyphicon glyphicon-calendar"> </span>-->
                                            <span class="fa fa-calendar"> </span>
                                        </span>
                                        <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'actividad_anios_dedicados_docencia','type'=>'number',
                                                    'value' => '',
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['lbl_anio_que_impartio_curso'],
                                                    'min'=> '1900',
                                                    'max'=> '2050',
                                                    'data-toggle'=>'tooltip',
                                                    'data-placement'=>'bottom',
                                                    'title'=>$string_values['lbl_anio_que_impartio_curso'],
                                                    )
                                                )
                                            );
                                        ?>
                                        </div>
                                        <?php echo form_error_format('actividad_anios_dedicados_docencia'); ?>
                                </div>
                            </div>
                        <br>
                            <div class='row'>
                                <div class='col-sm-12 text-center' id="fecha_inicio">
                                    <label for='lbl_periodo' class="control-label">
                                        <?php echo $string_values['lbl_periodo']; ?>
                                    </label>
                                </div>
                            </div>
                        <br>
                            <div class='row'>
                                <div class='col-sm-6' id="fecha_inicio">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker1" >
                                            <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'periodo_fecha_inicio_pick','type'=>'text',
                                                    'value' => '',
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['lbl_duracion_fecha_inicio'],
                                                    'data-toggle'=>'tooltip',
                                                    'title'=>$string_values['lbl_duracion_fecha_inicio'],
                                                    )
                                                )
                                            );
                                            ?>
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_error_format('periodo_fecha_inicio_pick'); ?>

                                </div>

                                <div class='col-sm-6 ' id="fecha_fin">
                                    <div class="form-group">
                                        <div class='input-group date' id='datetimepicker2'>
                                            <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'periodo_fecha_fin_pick','type'=>'text',
                                                    'value' => '',
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['lbl_duracion_fecha_final'],
                                                    'data-toggle'=>'tooltip',
                                                    'title'=>$string_values['lbl_duracion_fecha_final'],
                                                    )
                                                )
                                            );
                                            ?>
                                            <span class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <?php echo form_error_format('periodo_fecha_fin_pick'); ?>
                                </div>
                            
                            </div>
                        <br>
                            <div class="row">
                                <div class="col-md-6">
                                        <label for='radio_duracion_fecha' class="control-label">
                                            <?php echo $string_values['lbl_tipo_comprobante']; ?>
                                        </label>
                                         <?php 
                                            echo $this->form_complete->create_element(array('id' => 'ctipo_comprobante', 
                                                'type' => 'dropdown', 
                                                'options' => $ctipo_comprobante, 
                                                'first' => array('' => $string_values['drop_tipo_comprobante']), 
                                                'value' => '',
                                                'class'=>'form-control',
                                                'attributes' => array('class' => 'form-control', 'aria-describedby'=>"help-tipo-comprobante",
                                                'placeholder' => $string_values['title_tipo_comprobante'], 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                'title' => $string_values['title_tipo_comprobante'] ))); 
                                        ?>
                                        <?php echo form_error_format('ctipo_comprobante'); ?>
                                </div>
                                <div class="col-md-6">
                                    <!--<li class="list-group-item">-->
                                        <!--<input id="archivo-comprobante" type="file" name="file" class="file" accept="application/pdf">Maneja la carga del archivo-->
                                        <input id="archivo-comprobante" type="file" name="file" class="file" accept="application/pdf">
                                        <label for='radio_duracion_fecha' class="control-label">
                                            <?php echo $string_values['lbl_comprobante']; ?>
                                        </label>
                                        <div class="input-group">                                           
                                             <?php
                                                echo $this->form_complete->create_element(
                                                array('id'=>'text_comprobante','type'=>'text',
                                                        'value' => '',
                                                        'attributes'=>array(
                                                        'class'=>'form-control',
                                                        'placeholder'=>$string_values['title_cargar_comprobante'],
                                                        'min'=> '0',
                                                        'max'=> '100',
                                                        'data-toggle'=>'tooltip',
                                                        'data-placement'=>'bottom',
                                                        'title'=>$string_values['title_cargar_comprobante'],
                                                        'readonly'=>'readonly',
                                                        )
                                                    )
                                                );
                                             ?>
                                           
                                          <div class="input-group-btn">
                                            <button type="button" aria-expanded="false" class="btn btn-default browse">
                                                <span aria-hidden="true" class="glyphicon glyphicon-file"> </span>
                                            </button>
                                            <a role="button" tabindex="0" data-container="body" data-trigger="focus" data-toggle="popover" data-placement="top" data-title="Comprobante" data-content="Aquí usted puede seleccionar el tipo de comprobante que se le otorgo en el curso y posteriormente subirlo al sistema para su verificación" class="btn btn-default" data-original-title="" title="">
                                                <span aria-hidden="true" class="glyphicon glyphicon-question-sign"> </span>
                                            </a>
                                          </div>
                                        </div><span id="help-tipo-comprobante" class="help-block">Seleccionar y subir al sistema el tipo de comprobante que se le otorgo en el curso</span>
                                        <?php echo form_error_format('text_comprobante'); ?>
                                </div>
                            </div>
                            
                    </div>
                </div>
                <?php if(isset($pie_pag)){ echo $pie_pag; }?>
            </div>
