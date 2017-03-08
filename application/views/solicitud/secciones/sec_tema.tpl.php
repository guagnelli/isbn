<?php 
if(isset($debug)){
  pr($debug);
}
echo form_open("solicitud/sec_tema",array(
    'id'=>'frm_tema',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
if(isset($tema["id"])){
?>
<input type="hidden" name="id" value="<?php echo $tema["id"];?>">
<?php
}
?>
<p class="lead">Tema <?php echo $comentarios; ?></p>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Colección: </b>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="coleccion" 
      class="form-control col-md-7 col-xs-12" 
      data-validate-length-range="6" 
      data-validate-words="2" 
      name="coleccion" 
      placeholder="Colección" 
      required="required" 
      <?php
      if(isset($tema["coleccion"])){
      ?>
      value="<?php echo $tema['coleccion'];?>"
      <?php
      }?>
      type="text">
  </div>
  <?php echo form_error('coleccion'); ?>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>No. de colección: </b>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="no_coleccion" 
      class="form-control col-md-7 col-xs-12" 
      data-validate-length-range="6" 
      data-validate-words="2" 
      name="no_coleccion" 
      placeholder="Número de colección" 
      required="required" 
      <?php
      if(isset($tema["no_coleccion"])){
      ?>
      value="<?php echo $tema["no_coleccion"];?>"
      <?php
      }?>
      type="text">
  </div>
  <?php echo form_error('no_coleccion'); ?>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Tipo de contenido:</b>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
     <select name="tipo_contenido" 
             id="tipo_contenido" 
             class="form-control" required>
      <?php 
        $selected = "";
        foreach ($combos["tipo_contenido"] as $key => $value) {
          if($key==$tema["tipo_contenido"]){
            $selected = "selected";
          }
          echo "<option value='$key' $selected>$value</option>";
          $selected = "";
        }
      ?>
    </select>
  </div>
  <?php echo form_error('tipo_contenido'); ?>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Nombre de la serie: </b>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="nombre_serie" 
           class="form-control col-md-7 col-xs-12" 
           data-validate-length-range="6" 
           data-validate-words="2" 
           name="nombre_serie" 
           placeholder="Nombre de la serie" 
           required="required"
          <?php
          if(isset($tema["nombre_serie"])){
          ?>
          value="<?php echo $tema["nombre_serie"];?>"
          <?php
          }?> 
           type="text">
  </div>
  <?php echo form_error('nombre_serie'); ?>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send_tema" 
            type="button" 
            class="btn btn-form" 
            data-type="tema"
            onclick="btn(this);" >
      Guardar tema
    </button>
  </div>
</div>
<?php
echo form_close();
?>
<script type="text/javascript">//btn();</script>