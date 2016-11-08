<?php 
/*if(isset($combos)){
  pr($combos);
}
if(isset($debug)){
  pr($debug);
}*/

echo form_open("solicitud/sec_traduccion",array(
    'id'=>'frm_traduccion',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
if(isset($traduccion["id"])){
?>
<input type="hidden" name="id" value="<?php echo $traduccion["id"];?>">
<?php
}
?>
<p class="lead">Traducción <?php echo $comentarios; ?></p>
<!--div class="form-group">
	<div class="col-md-12 col-sm-12 col-xs-12">
	  	<label>
	      <b>Traducción:</b> 
	      <input id="has_traduction" 
	      		 name="has_traduction" 
	      		 type="checkbox" 
	      		 class="js-switch" 
	      		 <?php echo isset($traduccion["has_traduction"]) ? "checked":"" ?> />
	    </label>
	</div>
</div-->
<div class="item form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
  		<b><span class="required">*</span>Idioma Del:</b>
	</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
		<?php
    	echo $this->form_complete->create_element(array('id' => 'idioma_del',
           'type' => 'dropdown',
           'options' => $combos["c_idioma"],
           'first' => array('' => "Seleccione una opción"),
           'value' => isset($traduccion["idioma_del"]) ? $traduccion["idioma_del"]:"",
           'class' => '',
           'attributes' => array('class' => '')
           ));
       ?>
	</div>
</div>
<div class="item form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
	  <b><span class="required">*</span>Idioma Al:</b>
	</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
   		<?php
    	echo $this->form_complete->create_element(array('id' => 'idioma_al',
           'type' => 'dropdown',
           'options' => $combos["c_idioma"],
           'first' => array('' => "Seleccione una opción"),
           'value' => isset($traduccion["idioma_al"]) ? $traduccion["idioma_al"]:"",
           'class' => '',
           'attributes' => array('class' => '')
           ));
       ?>
	</div>
</div>
<div class="item form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
  		<b><span class="required">*</span>Idioma original:</b>
	</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
   		<?php
    	echo $this->form_complete->create_element(array('id' => 'idioma_original',
           'type' => 'dropdown',
           'options' => $combos["c_idioma"],
           'first' => array('' => "Seleccione una opci&oacute;n"),
           'value' => isset($traduccion["idioma_original"]) ? $traduccion["idioma_original"]:"",
           'class' => '',
           'attributes' => array('class' => '')
           ));
       ?>
	</div>
</div>
<div class="item form-group">
	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
  		<b><span class="required">*</span>Título en el idioma original: </b>
	</label>
	<div class="col-md-9 col-sm-9 col-xs-12">
  		<input id="titulo_original" 
  			   class="form-control col-md-9 col-xs-12" 
  			   data-validate-length-range="6" 
  			   data-validate-words="2" 
  			   name="titulo_original" 
  			   placeholder="" 
  			   required="required" 
  			   type="text"
			   value="<?php echo isset($traduccion["titulo_original"]) ? $traduccion["titulo_original"]:"" ?>"
  			   >
	</div>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send_traduccion" 
            type="button" 
            class="btn btn-form" 
            data-type="traduccion"
            onclick="btn(this)" >
      Guardar tema
    </button>
  </div>
</div>
<?php
echo form_close();
?>