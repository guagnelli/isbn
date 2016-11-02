<!-- Select2 -->
<link href="<?php echo asset_url()?>/vendors/choosen/chosen.css" rel="stylesheet">
<script src='<?php echo asset_url()?>/vendors/choosen/chosen.jquery.js'></script>
<script src='<?php echo asset_url()?>/vendors/choosen/docsupport/prism.js'></script>
<style>
.select2-container--default .select2-search--inline .select2-search__field {
  width: 100% !important;
}
.chosen-container{
  width: 100% !important;
}
</style>
<?php 
if(isset($debug)){
  pr($debug);
}
echo form_open("solicitud/sec_idioma",array(
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
    <select id="drop_idiomas" data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4">
            <option value=""></option>
            <option value="es" selected>Español</option>
            <option value="en" selected>Inglés</option>
            <option value="it">Italiano</option>
            <option value="fr">Polaco</option>
            <option value="pl">Frances</option>
            <option value="j">Algeria</option>
            <option value="la">Samoa</option>
            <option value="Andorra">Andorra</option>
            
    </select>
    <input type="hidden" id="idiomas" value="">
  </div>
</div>
<div class="form-group">
  <div class="col-md-12 text-center">
    <button id="send_idioma" 
            type="button" 
            class="btn btn-form" 
            data-type="idioma"
            onclick="btn(this)" >
      Guardar tema
    </button>
  </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
  /*$(".select2_multiple").ready(function() {
    $(".select2_multiple").select2({
      data: [{'id': 'pol','text':'Polonia'}],
      //maximumSelectionLength: 10,
      placeholder: "Seleccione un idioma",
      allowClear: true
    });
  });
  //btn();*/
</script>
<script type="text/javascript">
    $('.chosen-select').chosen().change(function(event){
        var select = $(event.target).attr("id");
        var str = "";
        $( "#"+select+" option:selected" ).each(function(){
          str += ","+$(this).text() + " ";
        });
        $("#idiomas").val(str);
    }).trigger( "change" );
  </script>