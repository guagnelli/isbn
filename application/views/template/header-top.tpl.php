<div class="container">
  <div class="row">
  <!-- Header Links Starts -->
    <div class="col-sm-5 col-xs-12">
    <div class="region region-social"><div class="block-block-4">
      <div class="header-links">
        <ul class="nav navbar-nav pull-left">
          <li>
            <a href="index.html">
              <i class="fa fa-facebook hidden-lg hidden-md" title="Facebook"></i>
              <span class="hidden-sm hidden-xs">
                Facebook
              </span>
            </a>
          </li>
          <li>
            <a href="#">  
              <i class="fa fa-twitter hidden-lg hidden-md" title="Twitter"></i>
              <span class="hidden-sm hidden-xs">
                Twitter
              </span>
            </a>
          </li>
          <li>
            <a href="#">
              <i class="fa fa-rss-square hidden-lg hidden-md" title="RSS"></i>
              <span class="hidden-sm hidden-xs">
                RSS
              </span>
            </a>
          </li>
        </ul>
      </div></div></div>
    </div>
  <!-- Header Links Ends -->
  <!-- seccion buscadores Starts -->
    <?php 
    /*$url_harvester = $this->config->item("url_harvester");
    echo form_open($url_harvester, array('id'=>'form_main')); ?>
    <div class="col-sm-5 col-xs-12">
      <div class="pull-right">
      <!-- Search Starts -->
    
      <div id="search">
        <div class="input-group">
          <input id="q" name="q" type="text" class="form-control input-lg" placeholder="buscar" style="padding: 1px 16px;">
          <span class="input-group-btn">
          <button id="btn_busqueda_avanzada" class="btn btn-lg" type="button">
            <i class="fa fa-search"></i>
          </button>
          </span>
        </div>
      </div>  
  <!-- Search Ends -->
      </div>
    </div>
    <div class="col-sm-2 col-xs-12 header-links"><ul class="nav navbar-nav pull-right"><li><a href="<?php echo site_url('revistas/busqueda_avanzada'); ?>" style="color:#f42434;">Búsqueda avanzada</a><li></ul></div>
    <?php echo form_close();*/ ?>
  <!-- seccion buscadores Ends -->
  </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
  $("#btn_busqueda_avanzada").click(function(event){
    event.preventDefault();
    ejecutar_busqueda_avanzada("#form_main");
  });
});
function ejecutar_busqueda_avanzada(form_recurso){
  var campo_busqueda_avanzada = $("#q").val();
  if(campo_busqueda_avanzada==""){
    alert("Debe escribir un parámetro para la búsqueda.");
  } else {
    $(form_recurso).submit();
  }
}
</script>