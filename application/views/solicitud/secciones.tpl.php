<?php
//pr($secciones);
//pr($datos);
$comentarios_titulo_libro = (!is_null($this->session->userdata('botones_seccion')[En_secciones::TITULO_LIBRO])) ? $this->session->userdata('botones_seccion')[En_secciones::TITULO_LIBRO] : ''; //Botones de comentarios para las secciones
$comentarios_clas_tematica = (!is_null($this->session->userdata('botones_seccion')[En_secciones::CLAS_TEMATICA])) ? $this->session->userdata('botones_seccion')[En_secciones::CLAS_TEMATICA] : ''; //Botones de comentarios para las secciones
$this->lang->load('interface', 'spanish');
$string_detalle = $this->lang->line('interface')['solicitud_detalle'];
?>
<link href="<?php echo asset_url() ?>vendors/switchery/dist/switchery.min.css" rel="stylesheet">
<script src='<?php echo asset_url() ?>vendors/switchery/dist/switchery.min.js'></script>
<?php
echo js("moment.min.js");
echo js("daterangepicker.js");
?>
<!---Cuerpo-->
<div class="col-md-12 col-sm-12 col-xs-12" id="div_secciones">
    <div class="x_panel">
        <div class="x_title">
            <h2> Solicitud de ISBN de la <?php echo $datos["solicitud"]["entidad"]["nombre"] ?></h2>
            <ul class="nav navbar-right panel_toolbox">
            </ul>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <div id="msg_general" role="alert" ></div>
            <div id="msg_general2" role="alert" >prueba</div>
            <div id="div_msg" role="alert" >prueba</div>
            <!--p><b>Título de la obra:</b> <?php echo $datos["solicitud"]["libro"]["title"] ?> <?php echo $comentarios_titulo_libro; ?></p>
            <p><b>Subtítulo:</b> <?php echo $datos["solicitud"]["libro"]["subtitle"] ?></p>
            <p><b>Tipo de obra:</b> <?php echo $datos["solicitud"]["sol_tipo_obra"] ?></p>
            <?php if (isset($datos["solicitud"]["clasificacion_tematica"]) and ! empty($datos["solicitud"]["clasificacion_tematica"])) { ?>
                <br>
                <p ><b>Clasificación temática:</b> 
                <?php echo $comentarios_clas_tematica; ?>
                </p>
                <p>
                <address>

                    <b><?php echo $string_detalle['li_categoria'] ?></b>
                    <?php echo $datos["solicitud"]["clasificacion_tematica"]["categoria"] ?><br />
                    <b><?php echo $string_detalle['li_sub_categoria'] ?></b>
                    <?php echo $datos["solicitud"]["clasificacion_tematica"]["subcategoria"] ?><br />
                </address>
            <?php } ?>
            <br-->

            <div class="col-xs-3">
                <!-- required for floating -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs tabs-left">
                    <li class="">
                        <a href="#tab_obra" data-toggle="tab">
                            Información de la Obra
                        </a>
                    </li>
                    <?php
                    foreach ($secciones as $id => $seccion) {
                        ?>
                        <li class="">
                            <a href="#tab_<?php echo $seccion["tbl_seccion"] ?>" data-toggle="tab">
                                <?php echo $seccion["nom_seccion"] ?>
                            </a>
                        </li>
                        <?php
                    }
                    ?>
                    <li>
                        <a href="#tab_files" data-toggle="tab">
                            Archivos
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-xs-9">
                <!-- Tab panes -->
                <div class="tab-content" id="tab_sections">
                    <input type="hidden" id="sol" value="<?php echo $datos['solicitud']['id'] ?>">
                    <div class="tab-pane active" id="tab_obra">
                        <?php //echo $files ?>
                    </div>
                    <?php
                    foreach ($secciones as $id => $seccion) {
                        ?>
                        <div class="tab-pane" id="tab_<?php echo $seccion["tbl_seccion"] ?>">
                            <?php echo $seccion["nom_seccion"] ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="tab-pane" id="tab_files">
                        <?php echo $files ?>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div> 

<?php
echo js("solicitud/secciones.js");
?>
<script type="text/javascript">
//alert("step one");
    function load_sections() {

        var solicitud = $("#sol").val();

        ajax(site_url + "/files", {
            "solicitud_id": solicitud,
        },
                "#tab_files",
                "#msg_general");

        ajax(site_url + "/solicitud/registrar/",{
            "solicitud_id": solicitud,
        },
                "#tab_obra",
                "#msg_general2");

<?php foreach ($secciones as $id => $seccion) { ?>
            ajax(site_url + "/solicitud/sec_<?php echo $seccion["tbl_seccion"] ?>", {
                "solicitud_id": solicitud,
            },
                    "#tab_<?php echo $seccion['tbl_seccion'] ?>",
                    "#msg_general");
    <?php
}
?>
    }
    $(document).ready(function () {
        //alert("step one");
        load_sections();
        $("#tab_obra").ready(function(){
            $("#tab_obra").css("active");
        });
    });
</script>
