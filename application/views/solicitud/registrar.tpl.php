<?php 
//pr($solicitud);
// pr($debug);
$class = $is_ajax ? "":'class="x_panel"';
$action = $is_ajax ? "solicitud/registrar" : "solicitud/registrar";
$titulo_header = $is_ajax ? "<p class='lead'>Información de la solicitud</p>" : "<h2>Información de la solicitud<small></small></h2>";
$comentarios_titulo_libro = (!is_null($this->session->userdata('botones_seccion')[En_secciones::TITULO_LIBRO])) ? $this->session->userdata('botones_seccion')[En_secciones::TITULO_LIBRO] : ''; //Botones de comentarios para las secciones
$comentarios_clas_tematica = (!is_null($this->session->userdata('botones_seccion')[En_secciones::CLAS_TEMATICA])) ? $this->session->userdata('botones_seccion')[En_secciones::CLAS_TEMATICA] : ''; //Botones de comentarios para las secciones
?>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div <?php echo $class;?> >
            <div class='<?php $class = $is_ajax ? "":'class="x_title"';?>'>
                <?php echo $titulo_header; ?>
                <ul class="nav navbar-right panel_toolbox">
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <?php
                echo form_open($action, array(
                    'class' => 'form-horizontal form-label-left',
                    'method' => 'post',
                    "id"=>"solicitud",
                ));
                if(isset($solicitud["id"])){
                  echo "<input type='hidden' value='".$solicitud["id"]."' name='solicitud_id'  />"; 
                }
                ?>
                <p class="lead">Obra</p>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Título de la obra:</b> 
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'title',
                       'type' => 'text',
                       'value' => isset($solicitud["libro"]["title"]) ? $solicitud["libro"]["title"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => '',
                          'min'=>'0',
                          'placeholder'=>'Título de la obra',
                          
                          )
                       ));
                       ?><?php echo $comentarios_titulo_libro; ?>      
                       <?php echo form_error('title'); ?>
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b>Subtítulo: </b>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'subtitle',
                       'type' => 'text',
                       'value' => isset($solicitud["libro"]["subtitle"]) ? $solicitud["libro"]["subtitle"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => '',
                          'min'=>'0',
                          'placeholder'=>'Subtítulo de la obra',
                          )
                       ));
                       ?> 
                        
                    </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                  <b><span class="required">*</span>Tipo de obra: </b>
                  </label>
                  <input type="radio" 
                   class="flat" 
                   name="sol_tipo_obra"
                   value="I" 
                   <?php
                    echo (isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Independiente")?"checked":"";
                   ?> 
                   /> Independiente
                  <input type="radio" 
                   class="flat" 
                   name="sol_tipo_obra"
                   <?php
                    echo (isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Completa")?"checked":"";
                   ?> 
                   value="C" 
                   /> Completa 
                  <input type="radio" 
                   id="volumen"
                   class="flat" 
                   name="sol_tipo_obra"
                   <?php
                    echo (isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Volumen")?"checked":"";
                   ?> 
                   value="V" 
                   /> Volumen 
                   <br><?php echo form_error('sol_tipo_obra'); ?>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-12 col-sm-12 col-xs-12 " for="name">
                        <b><i>Nota: En caso de seleccionar volumen, deberá ingresar el folio (en caso de estar en proceso)o el ISBN de la colección completa</i></b> 
                    </label>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Folio de la colección completa a la que pertenece este volúmen:</b> 
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'folio_coleccion',
                       // 'id' => 'solicitud[folio_coleccion]',
                       'type' => 'text',
                       'value' => isset($solicitud["folio_coleccion"]) ? $solicitud["folio_coleccion"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => 'folio_coleccion',
                          'min'=>'0',
                          'placeholder'=>'Folio de la colecci&oacute;n completa',
                          )
                       ));
                       ?>        
                    </div>
                    <br><?php echo form_error('folio_coleccion'); ?>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>ISBN de la Colecci&oacute;n:</b> 
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'isbn_coleccion',
                       // 'id' => 'solicitud[folio_coleccion]',
                       'type' => 'text',
                       'value' => isset($solicitud["isbn_coleccion"]) ? $solicitud["isbn_coleccion"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => 'folio_coleccion',
                          'min'=>'0',
                          'placeholder'=>'ISBN de la colecci&oacute;n completa',
                          )
                       ));
                       ?>     
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b>T&iacute;tulo de la colecci&oacute;n:</b> 
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'titulo_coleccion',
                       // 'id' => 'solicitud[folio_coleccion]',
                       'type' => 'text',
                       'value' => isset($solicitud["titulo_coleccion"]) ? $solicitud["titulo_coleccion"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => 'folio_coleccion',
                          'min'=>'0',
                          'placeholder'=>'T&iacute;tulo de la colecci&oacute;n completa',
                          )
                       ));
                       ?>     
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Reseña:</b> 
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       // 'id' => 'libro[resenia]',
                       'id' => 'resenia',
                       'type' => 'textarea',
                       'value' => isset($solicitud["libro"]["resenia"]) ? $solicitud["libro"]["resenia"]:"",
                       'class' => 'form-control col-md-7 col-xs-12',
                       'attributes' => array(
                          'class' => '',
                          'min'=>'0',
                          'placeholder'=>'Reseña de la obra',
                          
                          )
                       ));
                       ?>        
                       <?php echo form_error('resenia'); ?>
                    </div>
                </div>
                <p class="lead">Clasificación temática</p>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Temática principal: </b>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                      <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'solicitud_categoria',
                       'type' => 'dropdown',
                       'options' => dropdown_options($combos["categorias"], "id", "nombre"),
                       // 'first' => array('0' => "Seleccione una opción"),
                       'value' => isset($solicitud["clasificacion_tematica"]["id_categoria"]) ? $solicitud["clasificacion_tematica"]["id_categoria"]:"",
                       'class' => '',
                       'attributes' => array('onchange' => 'sub_categoria(this)',
                          
                        )
                       ));
                       ?>
                       <?php echo $comentarios_clas_tematica; ?>
                      <?php echo form_error("solicitud_categoria"); ?>
                        
                    </div>
                </div>
                <div class="item form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                        <b><span class="required">*</span>Sub-categoría:</b>
                    </label>
                    <div class="col-md-9 col-sm-9 col-xs-12" id="div_subcategoria">
                    <?php
                      echo $this->form_complete->create_element(array(
                       'id' => 'id_subcategoria',
                       // 'id' => 'solicitud[id_subcategoria]',
                       'type' => 'dropdown',
                       'options' => dropdown_options($combos["sub_categorias"], "id", "nombre"),
                       'first' => array('' => "Seleccione una opción"),
                       'value' => isset($solicitud["clasificacion_tematica"]["id_subcategoria"]) ? $solicitud["clasificacion_tematica"]["id_subcategoria"]:"",
                       'class' => '',
                       
                       ));
                       ?>
                        <?php echo form_error("id_subcategoria"); ?>
                    </div>
                    
                </div>
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-md-offset-3">
                    <?php if(isset($solicitud["id"])){
                    ?>
                    <button id="edit" type="button" class="btn" onclick="return false;" >Guardar cambio</button>
                    <?php
                    }else{
                    ?>
                    <button id="send" type="submit" class="btn" onclick="" >Realizar solicitud</button>
                    <button id="submit" type="button" class="btn btn-primary" onclick="window.location='<?php echo site_url('solicitud/index'); ?>'">Cancelar</button>
                    <?php
                    }
                    ?>
                    
                    
                  </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div> 
<?php 
echo js("solicitud/secciones.js");
//(isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Volumen")
?>

<script type="text/javascript">
$( "#submit" ).click(function( event ) {
  event.preventDefault();
});

//edicion
$( "#edit" ).click(function( event ) {
  var action = $("#solicitud").attr("action");
  var data = $("#solicitud").serialize();
  ajax(action,data,'#tab_obra','#msg_general');
});

$("#folio_coleccion").ready(function(){
 // alert("error");
  <?php
  if(isset($solicitud["sol_tipo_obra"])&&$solicitud["sol_tipo_obra"] =="Volumen"){
  ?>
  $(".folio_coleccion").prop('disabled', false);
  <?php
  }
  else{
    ?>
    $(".folio_coleccion").prop('disabled', true);
    <?php
  }
  ?>
  $("input[name^='sol_tipo_obra']").change(function(){
    //alert($("input[name^='solicitud\[sol_tipo_obra\]']:checked").val())
    if($("input[name^='sol_tipo_obra']:checked").val() == "V"){
      $(".folio_coleccion").prop('disabled', false);
    }else{
      $(".folio_coleccion").val("");
      $(".folio_coleccion").prop('disabled', true);
      /*apprise("Esta a punto de eliminar la información Folio de la colección completa, ¿desea continuar?",
          {verify: true},
          function(){
            
          }
        );*/
    }
  });
});
function sub_categoria(obj){
  var categoria_id = $(obj).val();
  var action = "<?php echo base_url();?>index.php/solicitud/sub_categoria";
  var form_data = {categoria:categoria_id};
  //alert(form_data)
  ajax(action,form_data,'#div_subcategoria','#msg_general');
  //});
}
</script>