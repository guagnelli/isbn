<?php 
if(isset($debug)){
  pr($debug);
}

?>
<p class="lead">Registro de documentaci&oacute;n <?php echo $comentarios; ?></p>
<?php
echo form_open("solicitud/file/",array(
    'id'=>'upload',
    'method'=>'post',
    "enctype"=>"multipart/form-data"
));
?>

<div class="form-group">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">
    <b><span class="required">*</span>Nombre del archivo:</b>
  </label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <?php
    echo $this->form_complete->create_element(array(
     'id' => 'nombre',
     'type' => 'text',
     'value' => isset($files["nombre"]) ? $files["nombre"]:"",
     'class' => 'form-control col-md-8 col-xs-12',
     'attributes' => array('placeholder' => 'Nombre del archivo')
     ));
     ?>
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-4 col-sm-4 col-xs-12">
    <b><span class="required">*</span>Archivo:</b>
  </label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <input type="file" name="file" class="form-control col-md-8 col-xs-12" 
    	placehorlder="Archivo" />
  </div>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send_file" 
            type="button" 
            class="btn btn-form" 
            data-type="add"
            onclick="btn_file(this)" >
      Subir archivo
  </div>
</div>
<div id="div_flist">
</div>
	
<?php 
echo form_close(); 
echo js("solicitud/uf.js");
?>