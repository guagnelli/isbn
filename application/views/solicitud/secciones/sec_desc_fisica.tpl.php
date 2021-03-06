<?php
if(isset($debug)){
  pr($debug);
}
echo form_open("solicitud/sec__descripcion_fisica",array(
    'id'=>'frm__descripcion_fisica',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
//pr($combos);
if(isset($_descripcion_fisica["id"])){
?>
  <input type="hidden" id="id" name="id" value="<?php echo $_descripcion_fisica["id"]?>">
<?php
}
?>

<p class="lead">Descripci&oacute;n f&iacute;sica <?php echo $comentarios; ?></p>
<div class="form-group">
      <label class="control-label col-md-12 col-sm-12 col-xs-12">
        <b><i>Nota: Recuerde que la Descripci&oacute;n f&iacute;sica debe coincidir con la de la colección</i></b>
      </label>
    </div>
<div class="item form-group">
	<div class="col-md-12 col-sm-12 col-xs-12">
	    Impresa &nbsp;<input name="rad_df" type="radio" id="print" value="print" checked>
	    | &nbsp; Electr&oacute;nica &nbsp; <input name="rad_df" type="radio" id="digital" value="digital" >
      <?php echo form_error('rad_df'); ?>
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
         'id' => 'desc_fisica',
         'type' => 'dropdown',
         'options' => $combos["c_desc_fisica"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["desc_fisica"]) ? $_descripcion_fisica["desc_fisica"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('desc_fisica'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Encuadernaci&oacute;n:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'encuadernacion',
         'type' => 'dropdown',
         'options' => $combos["c_encuadernacion"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["encuadernacion"]) ? $_descripcion_fisica["encuadernacion"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('encuadernacion'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Gramaje:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'gramaje',
         'type' => 'dropdown',
         'options' => $combos["c_gramaje"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["gramaje"]) ? $_descripcion_fisica["gramaje"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('gramaje'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tipo de impresi&oacute;n:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'impresion',
         'type' => 'dropdown',
         'options' => $combos["c_impresion"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["impresion"]) ? $_descripcion_fisica["impresion"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('impresion'); ?>
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tipo de papel:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'tipo_papel',
         'type' => 'dropdown',
         'options' => $combos["c_tipo_papel"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["tipo_papel"]) ? $_descripcion_fisica["tipo_papel"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('tipo_papel'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>N&uacute;mero de P&aacute;ginas:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'no_paginas',
         'type' => 'number',
         'value' => isset($_descripcion_fisica["no_paginas"]) ? $_descripcion_fisica["no_paginas"]:"",
         'class' => '',
         'attributes' => array('class' => '',
                               'min'=>'0',
                               'onkeydown="key_press(event)"'=>'',
                               'onkeypress="key_press(event)"'=>'')
         ));
         ?>
         <?php echo form_error('no_paginas'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>N&uacute;mero de tintas:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'num_tintas',
         'type' => 'dropdown',
         'options' => $combos["c_num_tintas"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["num_tintas"]) ? $_descripcion_fisica["num_tintas"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('num_tintas'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Ancho:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'ancho',
         'type' => 'text',
         'value' => isset($_descripcion_fisica["ancho"]) ? $_descripcion_fisica["ancho"]:"",
         'class' => '',
         'attributes' => array('class' => 'º',
                                
                                //"style"=>"display:bloq;"
                               )
         ));
         ?> Cm
         <?php echo form_error('ancho'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Alto:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'alto',
         'type' => 'text',
         'value' => isset($_descripcion_fisica["alto"]) ? $_descripcion_fisica["alto"]:"",
         'class' => '',
         'attributes' => array('class' => 'allownumericwithdecimal',)
         ));
         ?>Cm
         <?php echo form_error('alto'); ?>
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
         'id' => 'formato',
         'type' => 'dropdown',
         'options' => $combos["c_formato"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["formato"]) ? $_descripcion_fisica["formato"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('formato'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Medio:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'medio',
         'type' => 'dropdown',
         'options' => $combos["c_medio"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["medio"]) ? $_descripcion_fisica["medio"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('medio'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b>URL:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'url',
         'type' => 'text',
         'value' => isset($_descripcion_fisica["url"]) ? $_descripcion_fisica["url"]:"",
         'class' => '',
         'attributes' => array('class' => '',)
         ));
         ?>
         <?php echo form_error('url'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-4 col-sm-4 col-xs-12">
        <b><span class="required">*</span>Tama&ntilde;o:</b>
      </label>
      <div class="col-md-8 col-sm-8 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'tamanio_desc',
         'type' => 'text',
         'value' => isset($_descripcion_fisica["tamanio_desc"]) ? $_descripcion_fisica["tamanio_desc"]:"",
         'attributes' => array('class' => 'col-md-4 col-sm-4 allownumericwithdecimal',
                               'min'=>'0','style'=>"width:100px",
                                )
         ));
         ?>
         <?php echo form_error('tamanio_desc'); ?>
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'tamanio',
         'type' => 'dropdown',
         'options' => $combos["c_tamanio"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($_descripcion_fisica["tamanio"]) ? $_descripcion_fisica["tamanio"]:"",
         'class' => '',
         'attributes' => array('class' => 'col-md-4 col-sm-4')
         ));
         ?>
         <?php echo form_error('tamanio'); ?>
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
      Registrar descripci&oacute;n
    </button>
  </div>
</div>
<?php echo form_close(); ?>
<script src='<?php echo asset_url()?>js/solicitud/descripcion_fisica.js'></script>
<script type="text/javascript">
  $(document).ready(function (){
    <?php if(isset($_descripcion_fisica["rad_df"])){
    ?>
    $("#<?php echo $_descripcion_fisica['rad_df']; ?>").prop( "checked", true );
    show_div("<?php echo $_descripcion_fisica['rad_df']; ?>");
    <?php
    }?>
  });
</script>
