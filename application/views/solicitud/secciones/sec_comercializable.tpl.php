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
	      <b>Ejemplares nacionales: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="ejemplares_nacional" 
	           class="form-control col-md-8 col-xs-12 only-numbers" 
	           name="ejemplares_nacional" 
	           placeholder="Ejemplares nacionales" 
	           required="required"
	           value = '<?php echo isset($comercializable["ejemplares_nacional"]) ? $comercializable["ejemplares_nacional"]:""?>'
	           type="number" min="0"
	           onkeydown="key_press(event)"
	           onkeypress="key_press(event)"
	            />
	    <?php echo form_error('ejemplares_nacional'); ?>
	  </div>
	</div>
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b>Precio local: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="precio_local" 
	           class="form-control col-md-8 col-xs-12" 
	           name="precio_local" 
	           placeholder="Precio local" 
	           required="required"
	           value = '<?php echo isset($comercializable["precio_local"]) ? $comercializable["precio_local"]:""?>'
	           type="number"
	           onkeydown="key_press(event)"
	           onkeypress="key_press(event)" />
	    <?php echo form_error('precio_local'); ?>
	  </div>
	</div>
  	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b>Ejemplares externos: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="ejemplares_externa" 
	           class="form-control col-md-8 col-xs-12" 
	           name="ejemplares_externa" 
	           placeholder="Ejemplares externos" 
	           required="required"
	           value = '<?php echo isset($comercializable["ejemplares_externa"]) ? $comercializable["ejemplares_externa"]:""?>'
	           type="number" min="0"
	           onkeydown="key_press(event)"
	           onkeypress="key_press(event)" />
	    <?php echo form_error('ejemplares_externa'); ?>
	  </div>
	</div>
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b>Precio a externos: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="precio_externo" 
	           class="form-control col-md-8 col-xs-12" 
	           name="precio_externo" 
	           placeholder="Precio a externos" 
	           required="required"
	           value = '<?php echo isset($comercializable["precio_externo"]) ? $comercializable["precio_externo"]:""?>'
	           type="number"
	           onkeydown="key_press(event)"
	           onkeypress="key_press(event)"
	            />
	    <?php echo form_error('precio_externo'); ?>
	  </div>
	</div>
	<div class="item form-group">
	  <label class="control-label col-md-4 col-sm-4 col-xs-12" for="name">
	      <b>Oferta total: </b>
	  </label>
	  <div class="col-md-8 col-sm-8 col-xs-12">
	    <input id="oferta_total" 
	           class="form-control col-md-8 col-xs-12" 
	           name="oferta_total" 
	           placeholder="Oferta total" 
	           required="required"
	           value = '<?php echo isset($comercializable["oferta_total"]) ? $comercializable["oferta_total"]:""?>'
	           type="number"
	           onkeydown="key_press(event)"
	           onkeypress="key_press(event)" />
	    <?php echo form_error('oferta_total'); ?>
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
<script type="text/javascript">
	$("#oferta_total").ready(function(){
		$("#ejemplares_nacional").change(function(){
			var nac = $("#ejemplares_nacional").val();
			if(nac < 0){
				$("#ejemplares_nacional").val(0);
			}
			$("#oferta_total").val(suma_ejemplares());
		});
		$("#ejemplares_externa").change(function(){
			var nac = $("#ejemplares_externa").val();
			if(nac < 0){
				$("#ejemplares_externa").val(0);
			}
			$("#oferta_total").val(suma_ejemplares());
		});
	});
	function suma_ejemplares(){
		var a = parseInt($("#ejemplares_nacional").val());
		var b =	parseInt($("#ejemplares_externa").val());
		
		total = a+b;
		if(total < 0){
			total = 0;
		}
		return total;
	}
</script>