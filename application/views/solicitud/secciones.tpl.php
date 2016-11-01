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
              <a href="#idioma" data-toggle="tab">Idioma</a>
            </li>
            <li>
              <a href="#colaboradores" data-toggle="tab">Colaboradores</a>
            </li>
            <li>
              <a href="#traduccion" data-toggle="tab">Traducción</a>
            </li>
            <li>
              <a href="#edicion" data-toggle="tab">Información de edición</a>
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
            <div class="tab-pane" id="idioma">
              <p class="lead">Idiomas</p>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">
                  <span class="required">*</span>Seleccionar idioma:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="select2_multiple form-control col-md-7 col-xs-12" multiple="multiple">
                    <option>Seleccione una opción</option>
                    <option>Español</option>
                    <option>Inglés</option>
                    <option>Frances</option>
                    <option>Alemán</option>
                    <option>Italiano</option>
                  </select>
                </div>
              </div>
              <script type="text/javascript">
                  $(".select2_multiple").ready(function() {
                    $(".select2_single").select2({
                      placeholder: "Select a state",
                      allowClear: true
                    });
                    $(".select2_group").select2({});
                    $(".select2_multiple").select2({
                      maximumSelectionLength: 4,
                      placeholder: "Cuatro opciones mínimo",
                      allowClear: true
                    });
                  });
                </script>
            </div>
            <div class="tab-pane" id="colaboradores">
              <p class="lead">Colaboradores</p>
              <div class="control-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Agregar colaboradores:</label>
                <div class="col-md-9 col-sm-9 col-xs-12" id="div_tags">
                  <input id="tags_1" type="text" class="tags form-control" value="Rolando Cordera" data-default="Agregar colaborador"/>
                  <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                </div>
                <!-- jQuery Tags Input -->
                <script>
                  function onAddTag(tag) {
                    alert("Colaborador agregado: " + tag);
                  }

                  function onRemoveTag(tag) {
                    alert("Colaborador borrado: " + tag);
                  }

                  function onChangeTag(input, tag) {
                    alert("Colaborador modificado: " + tag);
                  }

                  $("#div_tags").ready(function() {
                    $('#tags_1').tagsInput({
                      width: 'auto'
                    });
                  });
                </script>
                <!-- /jQuery Tags Input -->
              </div>
            </div>
            <div class="tab-pane" id="traduccion">
              <p class="lead">Traducción</p>
              <div class="form-group">
                <div class="col-md-9 col-sm-9 col-xs-12">
                  <label>
                      Traducción: <input type="checkbox" class="js-switch" checked />
                    </label>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                  <span class="required">*</span>Idioma Del:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <select id="heard" class="form-control" required>
                    <option>Seleccione una opción</option>
                    <option>Español</option>
                    <option>Inglés</option>
                    <option>Frances</option>
                    <option>Alemán</option>
                    <option>Italiano</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                  <span class="required">*</span>Idioma Al:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <select id="heard" class="form-control" required>
                    <option>Seleccione una opción</option>
                    <option>Español</option>
                    <option>Inglés</option>
                    <option>Frances</option>
                    <option>Alemán</option>
                    <option>Italiano</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                  <span class="required">*</span>Idioma original:
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                   <select id="heard" class="form-control" required>
                    <option>Seleccione una opción</option>
                    <option>Español</option>
                    <option>Inglés</option>
                    <option>Frances</option>
                    <option>Alemán</option>
                    <option>Italiano</option>
                  </select>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
                  <span class="required">*</span>Título en el idioma original: 
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" name="name" placeholder="" required="required" type="text">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="edicion">
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