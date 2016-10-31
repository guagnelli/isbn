<?php
// pr($datos);
?>
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
        echo form_open("solicitud/registrar",array(
            'class'=>'form-horizontal form-label-left',
            'method'=>'post',
        ));
      ?>
          <p class="lead">Obra</p>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
              <b><span class="required">*</span>Título de la obra:</b> 
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="libro[titulo]" 
                     class="form-control col-md-7 col-xs-12" 
                     data-validate-length-range="6" 
                     data-validate-words="2" 
                     name="libro[titulo]" 
                     placeholder="Título de la obra" 
                     type="text"
                     required="required"
                     value="<?php echo isset($save['libro']['titulo'])? $save['libro']['titulo'] : '';?>"
                     oninvalid="this.setCustomValidity('Debe ingresar el título de la obra')"
                     oninput="setCustomValidity('')" 
                     >
              <?php echo form_error_format('libro[titulo]'); ?>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
              <b>Subtítulo: </b>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <input id="libro[subtitulo]" 
                 class="form-control col-md-7 col-xs-12" 
                 data-validate-length-range="6" 
                 data-validate-words="2" 
                 name="libro[subtitulo]" 
                 value="<?php echo isset($save['libro']['subtitulo'])? $save['libro']['subtitulo'] : '';?>"
                 placeholder="Subtítulo de la obra" 
                 type="text">
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
                     checked="" 
                     required /> Independiente 
              <input type="radio" 
                     class="flat" 
                     name="solicitud[sol_tipo_obra]"
                     value="C" /> Completa 
              <input type="radio" 
                     class="flat" 
                     name="solicitud[sol_tipo_obra]"
                     value="V" /> Volumen 
            
          </div>
          <p class="lead">Clasificación temática</p>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
              <b><span class="required">*</span>Temática principal: </b>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="solicitud_categoria" 
                      name="solicitud_categoria" 
                      class="form-control" 
                      required="required" >
              <?php 
                echo "<option>Seleccione una categoría</option>";
                $options = dropdown_options($datos["categorias"],"id","nombre");
                $selected = "";
                foreach ($options as $key => $value) {
                  if($key==$save["solicitud_categoria"]){
                    $selected = "selected";
                  }
                  echo "<option value='$key' $selected>$value</option>";
                }
              ?>
              </select>
              <span class="error">
                <?php echo form_error("solicitud_categoria");?>
              </span>
            </div>
          </div>
          <div class="item form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
              <b><span class="required">*</span>Sub-categoría:</b>
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
              <select id="solicitud_subcategoria" 
                      name="solicitud[subcategoria_id]" 
                      class="form-control" 
                      required="required" >
                <?php 
                $options = dropdown_options($datos["sub_categorias"],"id","nombre");
                  echo "<option>Seleccione una subcategoría</option>";
                  $selected = "";
                foreach ($options as $key => $value) {
                  if($key==$save["solicitud"]["subcategoria_id"]){
                    $selected = "selected";
                  }
                  echo "<option value='$key' $selected>$value</option>";
                }
                ?>
              </select>
              <span class="error">
                <?php echo form_error("solicitud[subcategoria_id]");?>
              </span>
            </div>
          </div>
          <div class="ln_solid"></div>
          <div class="form-group">
            <div class="col-md-6 col-md-offset-3">
              <button id="send" type="submit" class="btn" onclick="retrun false;" >Realizar solicitud</button>
              <button type="submit" class="btn btn-primary">Cancelar</button>
            </div>
          </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
</div>  