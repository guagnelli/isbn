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
/*if(isset($idiomas)){
  pr($idiomas);
}
if(isset($debug)){
  pr($debug);
}*/
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
  <div class="col-md-9 col-sm-9 col-xs-12">
    <select id="drop_idiomas" 
            name="drop_idiomas" 
            data-placeholder="Selecciona un idioma" 
            class="chosen-select" 
            multiple style="width:350px;" 
            tabindex="4">
        <?php 
            $selected = "";
            foreach ($combos["c_idioma"] as $key => $value) {
              if(isset($idiomas["idiomas"]) && in_array($key,$idiomas["idiomas"])){
                $selected = "selected";
              }
              echo "<option value='$key' $selected>$value</option>";
              $selected = "";
            }
          ?>
    </select>
    <input type="hidden" id="idiomas" name="idiomas" value="">
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
    $('.chosen-select').chosen().change(function(event){
        var select = $(event.target).attr("id");
        var str = "";
        $( "#"+select+" option:selected" ).each(function(){
          str += ","+$(this).val() + " ";
        });
        $("#idiomas").val(str);
    }).trigger( "change" );
  </script>