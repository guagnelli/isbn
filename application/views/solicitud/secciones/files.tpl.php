<?php $comentarios = (!is_null($this->session->userdata('botones_seccion')[En_secciones::ARCHIVOS])) ? $this->session->userdata('botones_seccion')[En_secciones::ARCHIVOS] : ''; //Botones de comentarios para las secciones
?>
<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <p class="lead">Archivos <?php echo $comentarios; ?></p>
    <?php
    if(isset($debug)){
    	pr($debug);
    } 
    
	echo form_open_multipart("files/index",array(
	    'id'=>'frm_file',
	    'name'=>'frm_file',
	    'class'=>'form-horizontal form-label-left',
	    'method'=>'post'
	));
	?>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <b><span class="required">*</span>Nombre del archivo:</b>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" 
               class="form-control col-md-7 col-xs-12"
               placeholder="Nombre del archivo"
               id="nombre" 
               name="nombre" 
               value="<?php echo isset($file['nombre'])?$file['nombre']:''?>">
        <?php echo form_error('nombre'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <b><span class="required">*</span>Archivo:</b>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
      	<?php 
      	echo $this->form_complete->create_element(array(
      		'id'=>'archivo',
      		'type'=>'upload',
      		'attributes'=>array(
                'class'=>'form-control col-md-7 col-xs-12',
                'style'=>'width:100%; ',
                'autocomplete'=>'off',
                'maxlength'=>13,
                'minlength'=>10
        )));
      	?>
        <?php echo form_error('archivo'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <b><span class="required">*</span>Tipo:</b>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'file_type',
         'type' => 'dropdown',
         'options' => $combos["c_tipo_file"],
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($file["file_type"]) ? $file["file_type"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
         <?php echo form_error('file_type'); ?>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <b><span class="required">*</span>Descripci&oacute;n:</b>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
      	<textarea rows="6" cols="50" 
      			  id="description" 
      			  name="description" 
      			  class="form-control col-md-7 col-xs-12"><?php echo isset($file['description'])?$file['description']:''?></textarea>
        <?php echo form_error('description'); ?>
      </div>
    </div>
    <div class="form-group">
	  <div class="col-md-12 text-center">
	  	<?php echo img("loader.gif",
	  					array("id"=>"loading-img", 
	  						  "style"=>"display:none;" ,
	  						  "alt"=>"Subiendo archivo"));
	  	?>
	    <button id="send_file" 
	            type="button" 
	            class="btn btn-form" 
	            data-type="files"
	            onclick="btn_file(this)" >
	      Subir archivo
	      </button>
	  </div>
	</div>
    <?php echo form_close(); ?>
   </div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-12 col-sm-12">
		<div id="progressbox" >
			<div id="progressbar"></div >
			<div id="statustxt"></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xs-12 col-md-12 col-sm-12" id="div_flist">
	</div>
</div>
<?php echo js("uf/jquery.form.min.js");?>
<?php echo js("uf/uf.js");?>
<script type="text/javascript">
$("#div_flist").ready(function(){
  var solicitud = $("#sol").val();
  ajax(site_url+"/files/list_files/",{
          "solicitud_id":solicitud,
        },
        "#div_flist",
        "#msg_list");
});
</script>