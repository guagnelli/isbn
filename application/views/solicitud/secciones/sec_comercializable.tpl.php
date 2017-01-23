<?php

echo form_open("solicitud/sec_comercializable",array(
    'id'=>'frm_comercializable',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
if(isset($debug)){
  pr($debug);
}

if(isset($comercializable["id"])){
?>
	<input type="hidden" name="id" value="<?php echo $comercializable["id"];?>">
<?php
}

?>
<p class="lead">Comercializable <?php echo $comentarios; ?></p>
<!--div class="item form-group">
  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
      <b><span class="required">*</span>Es comercializable: </b>
  </label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <input id="is_comercializable" type="checkbox" class="js-switch" checked="" />
  </div>
</div-->
<div id="div_comercializable">
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b><span class="required">*</span>Ejemplares nacionales: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="ejemplares_nacional" 
	           class="form-control col-md-8 col-xs-12" 
	           name="ejemplares_nacional" 
	           placeholder="Ejemplares nacionales" 
	           required="required"
	           value = '<?php echo isset($comercializable["ejemplares_nacional"]) ? $comercializable["ejemplares_nacional"]:""?>'
	           type="number" />
	  </div>
	</div>
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b><span class="required">*</span>Precio local: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="precio_local" 
	           class="form-control col-md-8 col-xs-12" 
	           name="precio_local" 
	           placeholder="Precio local" 
	           required="required"
	           value = '<?php echo isset($comercializable["precio_local"]) ? $comercializable["precio_local"]:""?>'
	           type="number" />
	  </div>
	</div>
  	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b><span class="required">*</span>Ejemplares externos: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="ejemplares_externa" 
	           class="form-control col-md-8 col-xs-12" 
	           name="ejemplares_externa" 
	           placeholder="Ejemplares externos" 
	           required="required"
	           value = '<?php echo isset($comercializable["ejemplares_externa"]) ? $comercializable["ejemplares_externa"]:""?>'
	           type="number" />
	  </div>
	</div>
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b><span class="required">*</span>Precio a externos: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="precio_externo" 
	           class="form-control col-md-8 col-xs-12" 
	           name="precio_externo" 
	           placeholder="Precio a externos" 
	           required="required"
	           value = '<?php echo isset($comercializable["precio_externo"]) ? $comercializable["precio_externo"]:""?>'
	           type="number" />
	  </div>
	</div>
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b><span class="required">*</span>Oferta total: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="oferta_total" 
	           class="form-control col-md-8 col-xs-12" 
	           name="oferta_total" 
	           placeholder="Oferta total" 
	           required="required"
	           value = '<?php echo isset($comercializable["oferta_total"]) ? $comercializable["oferta_total"]:""?>'
	           type="number" />
	  </div>
	</div>
	<div class="form-group">
    <div class="col-md-12 text-center">
    	<button id="send_comercializable" 
            type="button" 
            class="btn btn-form" 
            data-type="comercializable"
            onclick="btn(this);" >
    	Guardar datos de comercialización
    </button>
    </div>
</div>
</div>

<?php
echo form_close();
?>