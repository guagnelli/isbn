<!-- Select2 -->
<link href="<?php echo asset_url()?>/vendors/select2/dist/css/select2.min.css" rel="stylesheet">
<script src='<?php echo asset_url()?>/vendors/select2/dist/js/select2.full.min.js'></script>
<style>
.select2-container--default .select2-search--inline .select2-search__field {
  width: 100% !important;
}
.select2-container{
  width: 100% !important;
}
</style>
<?php echo form_open("solicitud/sec_idioma",array(
    'id'=>'frm_idioma',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));?>
<p class="lead">Idiomas</p>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12">
    <b><span class="required">*</span>Seleccionar idioma:</b>
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <select class="select2_multiple form-control col-md-7 col-xs-12" multiple="multiple">
      <option>Seleccione un idioma</option>
      <option>Español</option>
      <option>Inglés</option>
      <option>Frances</option>
      <option>Alemán</option>
      <option>Italiano</option>
    </select>
  </div>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send_idioma" 
            type="button" 
            class="btn btn-form" 
            data-type="idioma"
            onclick="retrun false;" >
      Guardar tema
    </button>
  </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
  $(".select2_multiple").ready(function() {
    $(".select2_multiple").select2({
      //maximumSelectionLength: 10,
      placeholder: "Seleccione un idioma",
      allowClear: true
    });
  });
  btn();
</script>