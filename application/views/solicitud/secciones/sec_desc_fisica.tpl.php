<?php
if(isset($debug)){
  //pr($debug);
}
echo form_open("solicitud/sec__descripcion_fisica",array(
    'id'=>'frm__descripcion_fisica',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
//pr($combos);
if(isset($_descripcion_fisica["id"])){
?>
  <input type="hidden" id="id__descripcion_fisica" name="id_colab" value="<?php echo $_descripcion_fisica["id"]?>">
  <input type="hidden" id="update" name="update" value="1">
<?php
}
?>

<p class="lead">Descripci&oacute;n f&iacute;sica <?php echo $comentarios; ?></p>
<div class="item form-group">
	<div class="col-md-12 col-sm-12 col-xs-12">
	    Impresa &nbsp;<input name="rad_df" type="radio" id="print" value="print" checked>
	    | &nbsp; Electr&oacute;nica &nbsp; <input name="rad_df" type="radio" id="digital" value="digital" >
	</div>
</div>
<div id="div_print">
	<div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Descripci&oacute;n F&iacute;sica:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_desc_fisica',
         'type' => 'dropdown',
         'options' => $combos["c_desc_fisica"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_desc_fisica"]) ? $_descripcion_fisica["c_desc_fisica"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Encuadernaci&oacute;n:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_encuadernacion',
         'type' => 'dropdown',
         'options' => $combos["c_encuadernacion"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_encuadernacion"]) ? $_descripcion_fisica["c_encuadernacion"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Gramaje:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_gramaje',
         'type' => 'dropdown',
         'options' => $combos["c_gramaje"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_gramaje"]) ? $_descripcion_fisica["c_gramaje"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tipo de impresi&oacute;n:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_impresion',
         'type' => 'dropdown',
         'options' => $combos["c_impresion"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_impresion"]) ? $_descripcion_fisica["c_impresion"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tipo de tinta:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_tinta',
         'type' => 'dropdown',
         'options' => $combos["c_tinta"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_tinta"]) ? $_descripcion_fisica["c_tinta"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tipo de papel:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_tipo_papel',
         'type' => 'dropdown',
         'options' => $combos["c_tipo_papel"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_tipo_papel"]) ? $_descripcion_fisica["c_tipo_papel"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
</div>
<div id="div_digital" style="display:none">
	<div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Formato:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_formato',
         'type' => 'dropdown',
         'options' => $combos["c_formato"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_formato"]) ? $_descripcion_fisica["c_formato"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Medio:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_medio',
         'type' => 'dropdown',
         'options' => $combos["c_medio"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_medio"]) ? $_descripcion_fisica["c_medio"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tama&ntilde;o:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'c_tamanio',
         'type' => 'dropdown',
         'options' => $combos["c_tamanio"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["c_tamanio"]) ? $_descripcion_fisica["c_tamanio"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send__descripcion_fisica" 
            type="button" 
            class="btn btn-form" 
            data-type="_descripcion_fisica"
            onclick="btn(this)" >
      Registrar descripci&oacute;n f&iacute;sica
    </button>
  </div>
</div>
<?php echo form_close(); ?>
<script src='<?php echo asset_url()?>js/solicitud/descripcion_fisica.js'></script>
