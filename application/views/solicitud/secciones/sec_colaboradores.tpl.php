<?php
if(isset($debug)){
  pr($debug);
}
echo form_open("solicitud/sec_colaboradores",array(
    'id'=>'frm_colaboradores',
    'class'=>'form-horizontal form-label-left',
    'method'=>'post'
));
if(isset($colab["id_colab"])){
?>
  <input type="hidden" id="id_colab" name="id_colab" value="<?php echo $colab["id_colab"]?>">
  <input type="hidden" id="update" name="update" value="1">
<?php
}
?>
<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12">
    <p class="lead">Colaboradores</p>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <b><span class="required">*</span>Nombre:</b>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" 
               class="form-control col-md-7 col-xs-12"
               placeholder="Nombre del colaborador"
               id="nombre" 
               name="nombre" 
               value="<?php echo isset($colab['nombre'])?$colab['nombre']:''?>">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">
        <b><span class="required">*</span>Tipo:</b>
      </label>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <?php
        echo $this->form_complete->create_element(array(
         'id' => 'tipo',
         'type' => 'dropdown',
         'options' => array("A"=>"Autor","C"=>"Colaborador"),
         'first' => array('' => "Seleccione una opción"),
         'value' => isset($colab["tipo"]) ? $colab["tipo"]:"",
         'class' => '',
         'attributes' => array('class' => '')
         ));
         ?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12 text-center">
        <button id="send_colaboradores" 
                type="button" 
                class="btn btn-form" 
                data-type="colaboradores"
                onclick="btn(this)" >
          Registrar colaborador/autor
        </button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>
<div class="row">
  <div class="col-xs-12 col-md-12 col-sm-12" id="div_colab_list">
  </div>
</div>

<script type="text/javascript">
$("#div_colab_list").ready(function(){
  var solicitud = $("#sol").val();
  ajax(site_url+"/colaborador/list_colaboradores/",{
          "solicitud_id":solicitud,
        },
        "#div_colab_list",
        "#msg_general");
});
</script>