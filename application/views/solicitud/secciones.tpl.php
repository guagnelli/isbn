<?php 
// pr($combos);
// pr($datos);
echo js("solicitud/secciones.js");
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
            <li class="active">
              <a href="#tab_tema" data-toggle="tab">Tema</a>
            </li>
            <li>
              <a href="#tab_idioma" data-toggle="tab">Idioma</a>
            </li>
            <li>
              <a href="#tab_colaboradores" data-toggle="tab">Colaboradores</a>
            </li>
            <li>
              <a href="#tab_traduccion" data-toggle="tab">Traducción</a>
            </li>
            <li>
              <a href="#tab_edicion" data-toggle="tab">Información de edición</a>
            </li>
            <li>
              <a href="#tab_comerce" data-toggle="tab">Comercializable</a>
            </li>
            <li>
              <a href="#tab_fisica" data-toggle="tab">Descripción física</a>
            </li>
            <li>
              <a href="#tab_epay" data-toggle="tab">Pago electrónico E5Cinco</a>
            </li>
            <li>
              <a href="#tab_barcode" data-toggle="tab">Código de barras</a>
            </li>
            <li>
              <a href="#tab_epaybc" data-toggle="tab">Pago electrónico E5Cinco del CB</a>
            </li>
          </ul>
        </div>

        <div class="col-xs-9">
          <!-- Tab panes -->
          <div class="tab-content" id="tab_sections">
          <input type="hidden" id="sol" value="<?php echo $datos['solicitud']['id']?>">
            <div class="tab-pane active" id="tab_tema">
              <!--tema-->              
            </div>
            <div class="tab-pane" id="tab_idioma">
              <!--idioma-->
            </div>
            <div class="tab-pane" id="tab_colaboradores">
              <!--colaboradores-->
            </div>
            <div class="tab-pane" id="tab_traduccion">
              <!--traduccion-->
            </div>
            <div class="tab-pane" id="tab_edicion">
              <!--edicion-->
            </div>
            <div class="tab-pane" id="tab_comerce">
              <!--comercializable-->
            </div>
            <div class="tab-pane" id="tab_fisica">              
              <!--fisica-->
            </div>
            <div class="tab-pane" id="tab_epay">
              <!--pago electronico-->
            </div>
            <div class="tab-pane" id="tab_barcode">
              <!--codigo de barras-->
            </div>
            <div class="tab-pane" id="tab_epaybc">
              <!--epay bar code-->
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12 text-center">
            <button id="send" type="submit" class="btn" onclick="retrun false;" >Enviar solicitud a revisión</button>
          </div>
        </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div> 
  <!--/form>
<!-- /page content -->