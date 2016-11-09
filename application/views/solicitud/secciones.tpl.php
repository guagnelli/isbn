<?php 
//pr($secciones);
// pr($datos);
?>
<!-- page content >
<form action="entidad_nueva_solicitud.html" method="post" class="form-horizontal form-label-left" novalidate-->
  <!---Cuerpo-->
  <div class="col-md-12 col-sm-12 col-xs-12" id="div_secciones">
    <div class="x_panel">
      <div class="x_title">
        <h2> Solicitud de ISBN de la <?php echo $datos["solicitud"]["entidad"]["nombre"]?></h2>
        <ul class="nav navbar-right panel_toolbox">
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <label class="" id="msg_general"></label>
        <p><b>Título de la obra:</b> <?php echo $datos["solicitud"]["libro"]["title"]?></p>
        <p><b>Subtítulo:</b> <?php echo $datos["solicitud"]["libro"]["subtitle"]?></p>
        <p><b>Tipo de obra:</b> <?php echo $datos["solicitud"]["sol_tipo_obra"]?></p>
        <div class="col-xs-3">
          <!-- required for floating -->
          <!-- Nav tabs -->
          <ul class="nav nav-tabs tabs-left">
          <?php 
            foreach($secciones as $id=>$seccion){
            ?>
            <li class="">
              <a href="#tab_<?php echo $seccion["tbl_seccion"]?>" data-toggle="tab">
                <?php echo $seccion["nom_seccion"]?>
              </a>
            </li>
            <?php
            }
          ?>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content" id="tab_sections">
            <input type="hidden" id="sol" value="<?php echo $datos['solicitud']['id']?>">
            <?php 
            foreach($secciones as $id=>$seccion){
            ?>
            <div class="tab-pane" id="tab_<?php echo $seccion["tbl_seccion"]?>">
              <?php echo $seccion["nom_seccion"]?>
            </div>
            <?php
            }
            ?>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div> 
  <!--/form>
<!-- /page content -->
<?php
echo js("solicitud/secciones.js");
?>
<script type="text/javascript">
//alert("step one");
function load_sections(){

  var solicitud = $("#sol").val();
  <?php foreach($secciones as $id=>$seccion){?>
    //alert("/solicitud/sec_<?php echo $seccion["tbl_seccion"]?>");
    ajax(site_url+"/solicitud/sec_<?php echo $seccion["tbl_seccion"]?>",{
          "solicitud_id":solicitud,
        },
        "#tab_<?php echo $seccion['tbl_seccion']?>",
        "#msg_general");
  <?php
  }
  ?>
}
$(document).ready(function (){
    //alert("step one");
    load_sections();
});
</script>
