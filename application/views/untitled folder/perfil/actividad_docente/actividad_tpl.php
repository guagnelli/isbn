<?php defined('BASEPATH') OR exit('No direct script access allowed');
        $fecha_ultima_actualizacion = 'Fecha de última actualizacón: 11 de julio de 2016 ';
//    pr($tipo_msg);
        $colapso_div_ejercicio_profesional = 'collapse in';
//        $colapso_div_ejercicio_profesional = 'collapse';
//        pr($datos_tabla_actividades_docente);
//        pr($actividades_docente_objet);
?>

    <style type="text/css">
        .button-padding {padding-top: 30px}
        .rojo {color: #a94442}.panel-body table{color: #000} .pinfo{padding-left:20px; padding-bottom: 20px;}
    </style>

    <script type='text/javascript' src="<?php echo base_url(); ?>assets/js/perfil/actividad_docente.js"></script>
    
    <!-- Inicio informacion personal -->
    <?php echo form_open('', array('id'=>'form_actividad_docente')); ?>
    
    <div class="list-group">
        
        <div class="list-group-item">
            <div class='row text-right'>
                <font size=1><?php  echo $fecha_ultima_actualizacion; ?></font>
            </div>
            <div class='row' >
                
                        <div class="row" style='display:hidden;' id='div_error'>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                            <div class="col-md-10 col-sm-10 col-xs-10">
                                <?php/*  if($tipo_msg==='danger' || $tipo_msg==='warning'){
                                         $colapso_div_ejercicio_profesional = 'collapse in';
                                       } 
                                       echo html_message($error, $tipo_msg);*/ ?>
                                <div id='mensaje_error_div' class='alert'>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <span id='mensaje_error'></span>
                                </div>
                            </div>
                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                        </div>
                
            </div>
        </div>
        <div class="list-group-item">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a data-toggle="tab" href="#actividad_docente_tab">
                        <strong>
                            <?php echo $string_values['tab_actividad_ad'];?>
                        </strong>
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#ejercicio_profesional_salud">
                        <strong>
                            <?php echo $string_values['lbl_actividad_eps'];?>
                        </strong>
                    </a>
                </li>
                <li>
                    <a data-toggle="tab" href="#desarrollo_investigacion">
                        <strong>
                          <?php echo $string_values['lbl_actividad_di'];?>
                        </strong>
                    </a>
                </li>
            </ul>
            <div id = 'tab_content_actividad_docente' class='tab-content col-md-12'>
                
                    <div id = 'actividad_docente_tab' class='tab-pane fade in active'>

                            <div class="panel-body">
                                <div>
                                   <br>
                                       <h4>Actividad docente</h4>
                                   <br>
                                </div>
                                <!--Ejercicio profecional en salud-->
                                <div class='row'>
                                    <div class="form-group col-xs-5 col-md-5">
                                        <label for='perfil_anios_dedicados_docencia' class="control-label">
                                            <b class="rojo">*</b>
                                            <?php echo $string_values['lbl_anios_dad']; ?>
                                        </label>
                                        <div class="input-group">
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"> </span>
                                        </span>
                                        <?php
                                            echo $this->form_complete->create_element(
                                            array('id'=>'actividad_anios_dedicados_docencia','type'=>'number',
                                                    'value' => empty($actividad_docente)?'':$actividad_docente[0]['ANIOS_DEDICADOS'],
                                                    'attributes'=>array(
                                                    'class'=>'form-control',
                                                    'placeholder'=>$string_values['lbl_anios_dad'],
                                                    'min'=> '0',
                                                    'max'=> '50',
                                                    'data-toggle'=>'tooltip',
                                                    'data-placement'=>'bottom',
                                                    'title'=>$string_values['lbl_anios_dad'],
                                                    )
                                                )
                                            );
                                        ?>
                                        </div>
                                        <?php   echo form_error_format('actividad_anios_dedicados_docencia'); ?>
                                    </div>

                                    <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                        <label for='lbl_ejercicio_pd' class="control-label">
                                            <b class="rojo">*</b>
                                            <?php echo $string_values['lbl_ejercicio_pd']; ?>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-user"> </span>
                                            </span>
                                            <?php 
                                                echo $this->form_complete->create_element(array('id' => 'ejercicio_predominante', 'type' => 'dropdown', 
                                                    'options' => $cejercicio_predominante, 
                                                    'first' => array('' => 'Selecciona ejercicio'), 
                                                    'value' => empty($actividad_docente)?'':$actividad_docente[0]['EJER_PREDOMI_CVE'],
                                                    'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
                                                    'placeholder' => 'Categoría', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 
                                                    'title' => $string_values['lbl_ejercicio_pd'] ))); 
                                            ?>
                                        </div>
                                        <?php   echo form_error_format('ejercicio_predominante'); ?>
                                    </div>

                                </div>
        <!--                        <div class="row">
                                    <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1 ">
                                        <label for='perfil_ejercicio_predominante' class="control-label">
                                            <b class="rojo">*</b>
                                            <?php // echo $string_values['lbl_curso_principal']; ?>
                                        </label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-book"> </span>
                                            </span>
                                            <?php 
        //                                      echo $this->form_complete->create_element(array('id' => 'curso_principal_imapare', 
        //                                            'type' => 'dropdown', 'options' => $cursos,
        //                                            'first' => array('' => 'Selecciona curso'),
        ////                                            'value' => empty($actividad_docente)?'':$actividad_docente[0]['CURSO_PRINC_IMPARTE'],
        //                                            'value' => 1,
        //                                            'attributes' => array('name' => 'categoria', 'class' => 'form-control', 
        //                                            'placeholder' => 'Categoría','data-toggle' => 'tooltip', 'data-placement' => 'top', 
        //                                            'title' => $string_values['lbl_curso_principal'] )));
                                            ?>
                                        </div>
                                        <?php //   echo form_error_format('curso_principal_imapare'); ?>
                                    </div>
                                    <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1 ">

                                    </div>
                                </div>-->
                                <div class="row">
                                    <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1 ">
                                            <!--<a class="btn btn-success " data-toggle="tab" href="#get_data_ajax_actividad" >-->
                                                <?php // echo $string_values['btn_guardar_cp']; ?>
                                            <!--</a>-->

                                            <button type="button" class="btn btn-success" id="btn_guardar_actividad" value="ajax">
                                                <?php echo $string_values['btn_guardar_cp']; ?>
                                                <?php // echo $string_values['perfil']['btn_informacion_general_editar_nombre']; ?> 
                                            </button>
                                     </div>    
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">


                                    </div>
                                    <div class="form-group col-xs-5 col-md-5 col-md-offset-1 col-md-offset-1">
                                        <button type="button" class="btn btn-success btn-lg" id="btn_agregar_actividad_modal" data-toggle="modal" data-target="#modal_censo">
                                            <?php echo $string_values['btn_add_new_actividad']; ?>
                                        </button>
                                    </div>
                                </div>
                                <div class="row" >
                                    <div id="tabla_actividades_docente" class="table-responsive">
                                        <!--Mostrará la tabla de actividad docente --> 
                                        <table class="table table-striped table-hover table-bordered" id="tabla_actividades">
                                            <thead>
                                                <tr class='success'>
                                                    <th><?php echo $string_values['tab_titulo_pro_salud_cur_principal'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_pro_salud_actividad'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_pro_salud_anio'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_pro_salud_duracion'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_pro_salud_fecha_inicio'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_pro_salud_fecha_fin'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_editar'] ?></th>
                                                    <th><?php echo $string_values['tab_titulo_eliminar'] ?></th>
                                                    <!--<th>Opciones</th>-->
                                                </tr>
                                            </thead>
                                            <tbody>

                                                    <?php //Generará la tabla que muestrá las actividades del docente
                                                            foreach ($datos_tabla_actividades_docente as $key => $value) {
                                                                //Valida curso principal
                                                                $is_cur_principal_igual = ($curso_principal === $value['cve_actividad_docente'])?1:0;
                                                                $is_tp_actividad_igual = ($curso_principal_entidad_contiene  === $value['ta_cve'])?1:0;
                                                                $is_cur_principal = ($is_cur_principal_igual ===1 AND $is_tp_actividad_igual===1)?1:0; 
                                        //                                                        pr($is_cur_principal .  ' : ' . $value['cve_actividad_docente'] . ' -> ' . $curso_principal .' ,  ' . $value['ta_cve'] . ' -> ' . $curso_principal_entidad_contiene  );
                                                                if($is_cur_principal===1){
                                                                    $checked = 'checked';
                                                                    $reg_principal = 'success';
                                                                    $cp = '1';
                                                                }else{
                                                                    $checked = 'none';
                                                                    $reg_principal = '';
                                                                    $cp = '0';
                                                                }
                                                                echo "<tr class='". $reg_principal ."' id='id_row_".$key."' data-cp='".$cp."' data-keyrow=".$key." >";
                                                                echo "<td >".$this->form_complete->create_element(
                                                                            array('id'=>'radio_curso_principal', 'type'=>'radio',
                                                                                'value' => $value['cve_actividad_docente'],
                                                                                'attributes'=>array(
                                                                                'class'=>'radio-inline m-r-sm',
                                                                                'title'=> $string_values['radio_duracion_horas'],
                                        //                                                    'disabled'=> '',
                                                                                $checked=>$checked,
                                                                                'onchange'=>'funcion_asignar_curso_principal(this)',
                                                                                'data-entidadtpacve'=>"'".$value['ta_cve']."'",//cve del catálogo tipo de actividad (ctipo_actividad)
                                                                                'data-actividadgeneralcve'=>"'".$value['actividad_general_cve']."'",//actividad general cve
                                                                                'data-actividaddocentecve'=>"'".$value['cve_actividad_docente']."'",//actividad de docente cve, según la entidad (emp_actividad_docente, emp_esp_med o emp_educacion_distancia)
                                                                                'data-cp'=>"'".$cp."'", //indica si es un curso principal, 0-no; 1-si;
                                                                                'data-keyrowselect'=>$key, //indica si es un curso principal, 0-no; 1-si;
                                                                                )
                                                                            )).
                                                                     "</td>";
                                                                echo "<td class='class_titulo'>".$value['nombre_tp_actividad']."</td>";
                                                                echo "<td >".$value['anio']."</td>";
                                                                echo "<td >".$value['duracion']."</td>";
                                                                echo "<td >".$value['fecha_inicio']."</td>";
                                                                echo "<td >".$value['fecha_fin']."</td>";
                                                                echo '<td>'
                                                                            . '<button type="button" '
                                                                                . 'class="btn btn-link btn-sm" '
                                                                                . 'id="btn_editar_actividad_modal" '
                                                                            . $string_values['tab_titulo_editar']
                                                                            .'</button>'
                                                                     . '</td>';
                                                                echo '<td>'
                                                                         . '<button '
                                                                            . 'type="button" '
                                                                            . 'class="btn btn-link btn-sm" '
                                                                            . 'id="btn_eliminar_actividad_modal" '
                                                                            . 'data-idrow ="' .$key.'"'
                                                                            . 'data-tacve ="' .$value['ta_cve'].'"'
                                                                            . 'data-cvead ="' .$value['cve_actividad_docente'].'"'
                                                                            . 'data-cp ="' .$is_cur_principal.'"'
                                                                            .'onclick="funcion_eliminar_actividad_docente(this)" >'.
                                                                                $string_values['tab_titulo_eliminar']
                                                                         .'</button>'
                                                                    . '</td>';
                                                                echo "</tr>";
                                                            }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                    </div><!--Termina primer tab-->
            
                    <div id = 'ejercicio_profesional_salud' class='tab-pane fade'>
                        <div class="panel-body">
                                <!--Datos de Ejercicio profecional en salud-->
                            <div>
                               <br>
                               <h4>Actividad en salud</h4>
                               <br>
                            </div>
                        </div>
                    </div>

                    <div id = 'desarrollo_investigacion' class='tab-pane fade'>
                        <div class="panel-body">
                            <!--Datos de Desarrollo deinvestigacion-->
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><?php echo $string_values['tab_titulo_form_prof'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_cedula_prof'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_editar'] ?></th>
                                            <th><?php echo $string_values['tab_titulo_eliminar'] ?></th>
                                            <!--<th>Opciones</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                       </td>
                                            <!--<td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="data_ajax(site_url+\'/bonos_titular/get_data_ajax_info_emp/'. hash('sha512',$v['emp']) .'\', null, \'#modal_content\')">'.$v['emp_matricula'].'</button></td>-->
                                            <td ></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                            <td ><button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#exampleModal" ></button></td>
                                    </tbody>
                                </table>
                            </div>
                         </div>
                      </div>
                
            </div>
        </div>
        _____________________
        <span id="simular" onclick="funcion_agregar_nueva_actividad()">
            simular
        </span>
        ____________________
    </div>
  
    <script type="text/template" id="template_row_nueva_act">
        <tr id="id_row_$$idrow$$" data-cp="$$cp$$" data-keyrow="$$key$$">
        <td>
        <input type="radio" name="radio_curso_principal" value="$$valor_radio_curso$$" id="radio_curso_principal" class="radio-inline m-r-sm" title="Hora(s)">
        </td>
        <td class='class_titulo'>$$titulo_tipo_actividad$$</td>
        <td>$$anio$$</td>
        <td>$$duracion$$</td>
        <td>$$fecha_inicio$$</td>
        <td>$$fecha_fin$$</td>
        <td>
            <button type="button" class="btn btn-link btn-sm" id="btn_editar_actividad_modal">Editar</button>
        </td>
        <td>
            <button type="button" class="btn btn-link btn-sm" id="btn_eliminar_actividad_modal" data-idrow="$$idrow$$" data-tacve="$$tacve$$" data-cvead="$$cvead$$" data-cp="$$cp$$" onclick="funcion_eliminar_actividad_docente(this)">
        Eliminar
        </button>
        </td>
        </tr>
    </script>
    
    
    <?php echo form_close(); ?>
  