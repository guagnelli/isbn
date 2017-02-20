<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Nueva solicitud<small></small></h2>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                $action = "solicitud/registrar";
                echo form_open($action, array(
                    'class' => 'form-horizontal form-label-left',
                    'method' => 'post',
                ));
                if(isset($solicitud["id"])){
                  echo "<input type='hidden' value='".$solicitud["id"]."' name='solicitud_id'  />"; 
                }
                ?>
                <p class="lead">Obra</p>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Título de la obra:</b> 
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'libro[title]',
                       'type' => 'text',
                       'value' => isset($solicitud["libro"]["title"]) ? $solicitud["libro"]["title"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => '',
                          'min'=>'0',
                          'placeholder'=>'Título de la obra',
                          "required"=>"required",
                          "oninvalid"=>"this.setCustomValidity('Debe ingresar el título de la obra')"
                          )
                       ));
                       ?>        
                       <?php echo form_error_format('libro[title]'); ?>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b>Subtítulo: </b>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'libro[subtitle]',
                       'type' => 'text',
                       'value' => isset($solicitud["libro"]["subtitle"]) ? $solicitud["libro"]["subtitle"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => '',
                          'min'=>'0',
                          'placeholder'=>'Subtítulo de la obra',
                          )
                       ));
                       ?> 
                        
                    </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                  <b><span class="required">*</span>Tipo de obra: </b>
                  </label>
                  <input type="radio" 
                   class="flat" 
                   name="solicitud[sol_tipo_obra]"
                   value="I" 
                   <?php
                    echo (isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Independiente")?"checked":"";
                   ?> 
                   required /> Independiente
                  <input type="radio" 
                   class="flat" 
                   name="solicitud[sol_tipo_obra]"
                   <?php
                    echo (isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Completa")?"checked":"";
                   ?> 
                   value="C" /> Completa 
                  <input type="radio" 
                   class="flat" 
                   name="solicitud[sol_tipo_obra]"
                   <?php
                    echo (isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Volumen")?"checked":"";
                   ?> 
                   value="V" /> Volumen 

                </div>
                <p class="lead">Clasificación temática</p>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Temática principal: </b>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'solicitud_categoria',
                       'type' => 'dropdown',
                       'options' => dropdown_options($combos["categorias"], "id", "nombre"),
                       'first' => array('' => "Seleccione una opción"),
                       'value' => isset($solicitud["clasificacion_tematica"]["id_categoria"]) ? $solicitud["clasificacion_tematica"]["id_categoria"]:"",
                       'class' => '',
                       'attributes' => array('onchange' => 'sub_categoria(this)')
                       ));
                       ?>
                        <span class="error">
                            <?php echo form_error("solicitud_categoria"); ?>
                        </span>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Sub-categoría:</b>
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12" id="div_subcategoria">
                    <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'solicitud[id_subcategoria]',
                       'type' => 'dropdown',
                       'options' => dropdown_options($combos["sub_categorias"], "id", "nombre"),
                       'first' => array('' => "Seleccione una opción"),
                       'value' => isset($solicitud["clasificacion_tematica"]["id_subcategoria"]) ? $solicitud["clasificacion_tematica"]["id_subcategoria"]:"",
                       'class' => '',
                       'attributes' => array('class' => '')
                       ));
                       ?>
                        
                    </div>
                    <span class="error">
                      <?php echo form_error("solicitud[id_subcategoria]"); ?>
                    </span>
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3">
                    <button id="send" type="submit" class="btn" onclick="retrun false;" >Realizar solicitud</button>
                    <button type="button" class="btn btn-primary" onclick="window.close()">Cancelar</button>
                  </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div> 
<?php echo js("solicitud/secciones.js");?>
<script type="text/javascript">
function sub_categoria(obj){
  var categoria_id = $(obj).val();
  var action = "<?php echo base_url();?>index.php/solicitud/sub_categoria";
  var form_data = {categoria:categoria_id};
  //alert(form_data)
  ajax(action,form_data,'#div_subcategoria','#msg_general');
  //});
}
</script>