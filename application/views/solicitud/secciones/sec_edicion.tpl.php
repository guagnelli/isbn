<?php 
//  pr($tema);
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
<p class="lead">Información de edición</p>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <span class="required">*</span>No. Edición: 
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <span class="required">*</span>Departamento, provincia o estado: 
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <span class="required">*</span>Ciudad de edición: 
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
  </div>
</div>
<div class="item xdisplay_inputx form-group has-feedback">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <span class="required">*</span>Fecha de aparición: 
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" class="form-control has-feedback-left" id="single_cal2" placeholder="First Name" aria-describedby="inputSuccess2Status2">
    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
    <span id="inputSuccess2Status2" class="sr-only">(success)</span>
  </div>
  <script>
    $('#single_cal2').daterangepicker({
        singleDatePicker: true,
        calender_style: "picker_2"
      }, function(start, end, label) {
        console.log(start.toISOString(), end.toISOString(), label);
      });
  </script>
</div>
  
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <span class="required">*</span>Coedición: 
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
      <input type="checkbox" class="js-switch" checked />
  </div>
</div>
<div class="item form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
    <span class="required">*</span>Coeditor: 
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
  </div>
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