<?php echo form_open("solicitud/sec_traduccion", array(
    'id' => 'frm_traduccion',
    'class' => 'form-horizontal form-label-left',
    'method' => 'post'
));
//pr($traduccion); ?>
<p class="lead">Traducción <?php echo $comentarios; ?></p>
<div class="item form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
        <b>Traducci&oacute;n: </b>
    </label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <input id="traduccion" 
               name="traduccion" 
               type="checkbox" 
               class="js-switch" 
               <?php echo (isset($traduccion["id"]) || isset($traduccion["traduccion"])) ? "checked" : ""; ?>
               />
    </div>
</div>
<div id="div_traduccion">
    <?php
    /* if(isset($combos)){
      pr($combos);
      } */
    if (isset($debug)) {
        pr($debug);
    }
    if (isset($traduccion["id"])) {
        ?>
        <input type="hidden" name="id" value="<?php echo $traduccion["id"]; ?>">
        <?php
    }
    ?>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
            <b><span class="required">*</span>Idioma Del:</b>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <?php
            echo $this->form_complete->create_element(array('id' => 'idioma_del',
                'type' => 'dropdown',
                'options' => $combos["c_idioma"],
                'first' => array('' => "Seleccione una opción"),
                'value' => isset($traduccion["idioma_del"]) ? $traduccion["idioma_del"] : "",
                'class' => '',
                'attributes' => array('class' => '')
            ));
            ?>
            <?php echo form_error('idioma_del'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
            <b><span class="required">*</span>Idioma Al:</b>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <?php
            echo $this->form_complete->create_element(array('id' => 'idioma_al',
                'type' => 'dropdown',
                'options' => $combos["c_idioma"],
                'first' => array('' => "Seleccione una opción"),
                'value' => isset($traduccion["idioma_al"]) ? $traduccion["idioma_al"] : "",
                'class' => '',
                'attributes' => array('class' => '')
            ));
            ?>
            <?php echo form_error('idioma_al'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
            <b><span class="required">*</span>Idioma original:</b>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <?php
            echo $this->form_complete->create_element(array('id' => 'idioma_original',
                'type' => 'dropdown',
                'options' => $combos["c_idioma"],
                'first' => array('' => "Seleccione una opci&oacute;n"),
                'value' => isset($traduccion["idioma_original"]) ? $traduccion["idioma_original"] : "",
                'class' => '',
                'attributes' => array('class' => '')
            ));
            ?>
            <?php echo form_error('idioma_original'); ?>
        </div>
    </div>
    <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">
            <b><span class="required">*</span>Título en el idioma original: </b>
        </label>
        <div class="col-md-9 col-sm-9 col-xs-12">
            <input id="titulo_original" 
                   class="form-control col-md-9 col-xs-12" 
                   data-validate-length-range="6" 
                   data-validate-words="2" 
                   name="titulo_original" 
                   placeholder="" 
                   required="required" 
                   type="text"
                   value="<?php echo isset($traduccion["titulo_original"]) ? $traduccion["titulo_original"] : "" ?>"
                   >
            <?php echo form_error('titulo_original'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12 text-center">
            <button id="send_traduccion" 
                    type="button" 
                    class="btn btn-form" 
                    data-type="traduccion"
                    onclick="btn(this)" >
                Guardar traducción
            </button>
        </div>
    </div>
</div>
<?php echo form_close(); ?> 
<script type="text/javascript">
<?php
echo "var base_url = '" . base_url() . "';";
?>
    $(document).ready(function () {
<?php
if (isset($traduccion["id"])) {
    ?>
            $("#div_traduccion").show();
    <?php } else {
    ?>
            $("#div_traduccion").hide()
    <?php }
?>
        if($("#traduccion").prop("checked")==true){
            $("#div_traduccion").show('slow');
        }
    });
</script>
<?php echo js("solicitud/traduccion.js"); ?>