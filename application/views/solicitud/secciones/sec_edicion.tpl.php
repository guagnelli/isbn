<?php
//echo js('daterangepicker.js');
//  pr('holaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa');
echo form_open("solicitud/sec_edicion", array(
    'id' => 'frm_edicion',
    'class' => 'form-horizontal form-label-left',
    'method' => 'post'
));
if (isset($debug)) {
 // pr($debug);
}

if (isset($edicion["id"])) {
    ?>
    <input type="hidden" name="id" value="<?php echo $edicion["id"]; ?>">
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
               name="no_edicion" 
               placeholder="No. Edición" 
               value = "<?php echo isset($edicion["no_edicion"]) ? $edicion["no_edicion"] : ""; ?>"
               type="number"
               onkeydown="key_press(event)"
                onkeypress="key_press(event)" />
        <?php echo form_error('no_edicion'); ?>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b><span class="required">*</span>Estado: </b>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array('id' => 'depto_id',
            'type' => 'dropdown',
            'options' => $combos["c_departamento"],
            'first' => array('' => "Seleccione una opción"),
            'value' => isset($edicion["depto_id"]) ? $edicion["depto_id"] : "",
            'class' => '',
            'attributes' => array('class' => '')
        ));
        ?> 
        <?php echo form_error('depto_id'); ?>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b><span class="required">*</span>Ciudad de edición:</b>
    </label>
    <div class="col-md-8 col-sm-8 col-xs-12" id="div_ciudad">
    </div>
</div>
<div class="item xdisplay_inputx form-group has-feedback">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b><span class="required">*</span>Fecha de aparición: </b>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" class="form-control has-feedback-left" 
               id="fecha_aparicion"
               name="fecha_aparicion"
               aria-describedby="inputSuccess2Status2"
               value = '<?php echo isset($edicion["fecha_aparicion"]) ? $edicion["fecha_aparicion"] : ""; ?>'
               >
        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true"></span>
        <span id="inputSuccess2Status2" class="sr-only">(success)</span>
        <?php echo form_error('fecha_aparicion'); ?>
    </div>
</div>

<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b>Coedición: </b>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input id="coedicion" 
               name="coedicion" 
               type="checkbox" 
               class="js-switch" 
               <?php echo (isset($edicion["coedicion"]) && $edicion["coedicion"]) == 1 ? "checked" : ""; ?>
               />
        <?php echo form_error('coedicion'); ?>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b><span class="required">*</span>Coeditor: </b>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input id="coeditor" 
               class="form-control col-md-7 col-xs-12" 
               name="coeditor" 
               placeholder="Coeditor" 
               value = "<?php echo isset($edicion["coeditor"]) ? $edicion["coeditor"] : "" ?>"
               type="text">
        <?php echo form_error('coeditor'); ?>
    </div>
</div>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b><span class="required">*</span>Radicado: </b>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input id="radicado" 
               class="form-control col-md-7 col-xs-12"
               name="radicado" 
               placeholder="Radicado" 
               value = "<?php echo isset($edicion["radicado"]) ? $edicion["radicado"] : ""; ?>"
               type="number"
               onkeydown="key_press(event)"
             onkeypress="key_press(event)" />
        <?php echo form_error('radicado'); ?>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12 text-center">
        <button id="send_edicion" 
                type="button" 
                class="btn btn-form" 
                data-type="edicion"
                onclick="btn(this);" >
            Guardar Informaci&oacute;n de edici&oacute;n
        </button>
    </div>
</div>
<?php
echo form_close();
?>


<script type="text/javascript">
  $(document).ready(function () {
    $('#fecha_aparicion').daterangepicker({
          singleDatePicker: true,
          calender_style: "picker_3",
          startDate: moment(),
          minDate: moment(),
          locale: {
              daysOfWeek: ['D', 'L', 'M', 'Mc', 'J', 'V', 'S'],
              monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
              format: "YYYY-MM-DD",
              separator: "-",
          }

      },
      function (start, end, label) {
          //console.log(start.toISOString(), end.toISOString(), label);
          $('#fecha_aparicion').val(start.format('YYYY-MM-DD'));
      });
  });
  $("#coedicion").ready(function(){
    <?php if(isset($edicion["coedicion"]) && ($edicion["coedicion"]==1 || $edicion["coedicion"]=='on')){?>
      $("#coedicion").prop('checked', true);
      $("#coeditor").prop('disabled', false);
      $("#radicado").prop('checked', true);
      $("#radicado").prop('disabled', false);
    <?php }else{?>
      $("#coedicion").prop('checked', false);
      $("#coeditor").prop('disabled', true);
      $("#radicado").prop('checked', false);
      $("#radicado").prop('disabled', true);
    <?php }?>
    $("#coedicion").click(function(){
      if($("#coedicion").prop("checked")){
        //alert($("#coedicion").prop("checked"));
        $("#coeditor").prop('disabled', false);
        $("#radicado").prop('disabled', false);
      }else{
        apprise("Esta a punto de eliminar la información del coeditor y radicado, ¿desea continuar?",
                {verify: true},
                function(){
                  $("#coeditor").val("");
                  $("#coeditor").prop('disabled', true);
                  $("#radicado").val("");
                  $("#radicado").prop('disabled', true);
                }
        );
      }
    });
  });
  $("#depto_id").change(function(){
    var estado = $("#depto_id").val();
    ajax(site_url + "/solicitud/get_ciudad/",{
            "depto_id": estado
        },
        "#div_ciudad",
        "#msg_general2");
  });

  $("#div_ciudad").ready(function(){
    var estado = <?php echo isset($edicion["depto_id"]) ? $edicion["depto_id"] : 0; ?>;
    var ciudad = <?php echo isset($edicion["ciudad_id"]) ? $edicion["ciudad_id"] : 0; ?>;
    ajax(site_url + "/solicitud/get_ciudad/",{
            "depto_id": estado,
            "ciudad_id":ciudad
        },
        "#div_ciudad",
        "#msg_general2");
  });
</script>
