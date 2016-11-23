<?php 
echo js('daterangepicker.js');
//  pr($tema);
echo form_open("solicitud/sec_edicion",array(
    'id'=>'frm_edicion',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
if(isset($debug)){
  pr($debug);
}

if(isset($edicion["id"])){
?>
<input type="hidden" name="id" value="<?php echo $edicion["id"];?>">
<?php
}
?>
<p class="lead">Información de edición <?php echo $comentarios; ?></p>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
      <b><span class="required">*</span>No. Edición: </b>
  </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input id="no_edicion" 
           class="form-control col-md-7 col-xs-12" 
           data-validate-length-range="6" 
           data-validate-words="2" 
           name="no_edicion" 
           placeholder="No. Edición" 
           required="required" 
           type="text" />
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Departamento, provincia o estado: </b>
  </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <?php
      echo $this->form_complete->create_element(array('id' => 'depto_id',
       'type' => 'dropdown',
       'options' => $combos["c_departamento"],
       'first' => array('' => "Seleccione una opción"),
       'value' => isset($edicion["depto_id"]) ? $edicion["depto_id"]:"",
       'class' => '',
       'attributes' => array('class' => '')
       ));
    ?> 
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Ciudad de edición:</b>
  </label>
  <div class="col-md-8 col-sm-8 col-xs-12">
    <?php
      echo $this->form_complete->create_element(array('id' => 'ciudad_id',
       'type' => 'dropdown',
       'options' => $combos["c_ciudad"],
       'first' => array('' => "Seleccione una opción"),
       'value' => isset($edicion["ciudad_id"]) ? $edicion["ciudad_id"]:"",
       'class' => '',
       'attributes' => array('class' => '')
       ));
    ?>
  </div>
</div>
<div class="item xdisplay_inputx form-group has-feedback">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Fecha de aparición: </b>
  </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="Fecha de aparición" aria-describedby="inputSuccess2Status2">
    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
  </div>
  <script>
  /*$("#single_cal2").ready(function(){
    $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_2"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
  });*/
  </script>
</div>
    
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Coedición: </b>
  </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="checkbox" class="js-switch" checked />
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <b><span class="required">*</span>Coeditor: </b>
  </label>
  <div class="col-md-9 col-sm-9 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
  </div>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send_edicion" 
            type="button" 
            class="btn btn-form" 
            data-type="edicion"
            onclick="btn(this);" >
      Guardar tema
    </button>
  </div>
</div>
<?php
echo form_close();
?>