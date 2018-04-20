<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="panel-group" id="accordion">
    <?php if (isset($titulo_libro)) { ?>
        <div class="row">
            <div class="col-sm-12">
                <strong><?php echo $string_values["title_libro"] ?></strong>
                <?php echo $titulo_libro; ?><br />
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <strong><?php echo $string_values["title_sub_titulo"] ?></strong>
                <?php echo $subtitulo; ?><br />
            </div>
            <div class="col-sm-6">
                <strong><?php echo $string_values["title_isbn"] ?></strong>
                <?php echo $isbn; //pr($_SESSION)?>
            </div>
        </div>
    <?php } ?>
    <?php if (!empty($comentarios_seccion)) { ?>
        <br/>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#id_div_detalles_estado" aria-expanded="true"><?php echo $string_values['btn_text_collapse_mensajes']; ?></button>
                <div id="id_div_detalles_estado" class="collapse mensajeria" aria-expanded="true" >
                    <?php foreach ($comentarios_seccion as $value) { 
                        $class_comment = "comment comment-them";
                        //$titulo = "DGAJ:";
                        if($value["rol"] == $this->session->userdata('rol_cve')){
                            $class_comment = "comment comment-me";
                            //$titulo = "Yo:";
                        }
                    ?>

                        <div class="<?php echo $class_comment; ?>">
                            <strong><?php echo $value["usuario"];?></strong><br>
                            <strong><?php echo $string_values['fecha_comentario'] ?></strong><?php echo $value['fecha_comentario']; ?><br>
                            <strong><?php echo $string_values['name_seccion'] ?></strong><?php echo $value['name_seccion']; ?><br>
                            <strong><?php echo $string_values['estado_solicitud'] ?></strong><?php echo $value['name_estado']; ?><br>
                            <strong><?php echo $string_values['comentario'] ?></strong><?php echo $value['comentario']; ?><br>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    <br/>
    <?php if ($add_comment_seccion == 1) {//Sólo el dgaj puede validar ?>
        <?php echo form_open('', array('id' => 'form_comentario_seccion')); ?>
        <div class="row">
            <div class="col-md-12">
                <strong><?php echo $string_values['lbl_comentario']; ?></strong>
                <div class="input-group">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-comment"> </span>
                    </span>
                    <?php
                    echo $this->form_complete->create_element(array('id' => 'comentario_justificacion',
                        'type' => 'textarea',
                        'value' => '',
                        'attributes' => array(
                            'class' => 'form-control',
                            'placeholder' => $string_values['lbl_comentario'],
                            'maxlength' => '4000',
                            'data-toggle' => 'tooltip',
                            'data-placement' => 'top',
                            'rows'=>'5',
                            'title' => $string_values['lbl_comentario'])));
                    ?>
                </div>
                <?php echo form_error_format('comentario_justificacion'); ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    <?php } ?>
</div>


