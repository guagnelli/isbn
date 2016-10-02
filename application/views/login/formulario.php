<?php   echo form_open('login/index', array('id'=>'login')); ?>


<div class="x_panel">
    <div class="x_title">
        <h2>Inicio de sesión <small></small></h2>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">
        <div class="row" style="border-bottom: 1px solid #E0E0E0; padding-bottom: 5px; margin-bottom: 5px;">
            <div class="col-md-12" style="overflow:hidden;">
                <div class="col-md-8 center-margin">
                        <div class="form-group">
                            <?php if(isset($error)){ ?>
                            <div class="row">
                                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                <div class="col-md-10 col-sm-10 col-xs-10">
                                <?php echo html_message($error, $tipo_msg); ?>
                                </div>
                                <div class="col-md-1 col-sm-1 col-xs-1"></div>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label>Usuario:</label>
                            <?php
                            echo $this->form_complete->create_element(array('id'=>'nick', 'type'=>'text', 'attributes'=>array('class'=>'form-control', 'maxlength'=>'20', 'autocomplete'=>'off', 'placeholder'=>'Usuario', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Usuario')));
                            ?>
                            <span class="text-danger"> <?php echo form_error('nick','','');?> </span>
                        </div>
                        <div class="form-group">
                            <label>Contraseña:</label>
                            <?php
                            echo $this->form_complete->create_element(array('id'=>'passwd', 'type'=>'password', 'attributes'=>array('class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Contrase&ntilde;a', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Contrase&ntilde;a')));
                            ?>
                            <span class="text-danger"> <?php echo form_error('passwd','','');?> </span>
                        </div>
                        <div class="list-group-item">
                            <div id="captcha_first"></div>

                            <script type="text/javascript">
                                // inicia codigo javascript necesario para un captcha
                                $( document ).ready(function() {
                                    data_ajax(site_url+"/captcha/get_new_captcha_ajax", "#null", "#captcha_first"); // cargamos por primera vez el captcha
                                });
                                // termina codigo javascript necesario para un captcha
                            </script>
                            
                            <input type="text" class="form-control" name="userCaptcha" id="userCaptcha" placeholder="Escribe el texto de la imágen" autocomplete="off" value="<?php if(!empty($userCaptcha))echo $userCaptcha; ?>">
                            <span class="text-danger"> <?php echo form_error('userCaptcha','','');?> </span>
                        </div>
                        <div class="form-group">
                            <!-- <button id="entidad" type="button" class="btn">Ingresar como Entidad</button> -->
                            <?php
                                echo $this->form_complete->create_element(array('id'=>'btn_login', 'type'=>'submit', 'value'=>'Iniciar sesión', 'attributes'=>array('class'=>'btn espacio')));
                            ?>
                            <!-- <button id="dgaj" type="button" class="btn">Ingresar como DGAJ</button> -->
                        </div>
                </div>

            </div>
        </div>
    </div>
        



        <!-- <div class="col-md-4 col-sm-3 col-xs-12"></div>
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="panel">
                <div class="breadcrumbs6 panel-heading">
                    <h1 style="padding-left:20px;"><small><span class="glyphicon glyphicon-info-sign"></span></small> Iniciar sesi&oacute;n</h1>
                </div>

                <div class="list-group">

                    <div class="list-group-item">
                              <?php if(isset($error)){ ?>
    					<div class="row">
                                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
                                            <div class="col-md-10 col-sm-10 col-xs-10">
                                                    <?php echo html_message($error, $tipo_msg); ?>
                                            </div>
                                            <div class="col-md-1 col-sm-1 col-xs-1"></div>
    					</div>
                                <?php } ?>
                    </div>
                    <div class="list-group-item">
                            <label for="nick">Nombre de usuario:</label>
                            <?php
                                echo $this->form_complete->create_element(array('id'=>'nick', 'type'=>'text', 'attributes'=>array('class'=>'form-control', 'maxlength'=>'20', 'autocomplete'=>'off', 'placeholder'=>'Nombre de usuario', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Nombre de usuario')));

                            ?>
                            <span class="text-danger"> <?php echo form_error('nick','','');?> </span>
                        </div>
                        <div class="list-group-item">
                            <label for="passwd">Contrase&ntilde;a:</label>
                            <?php
                                echo $this->form_complete->create_element(array('id'=>'passwd', 'type'=>'password', 'attributes'=>array('class'=>'form-control', 'autocomplete'=>'off', 'placeholder'=>'Contrase&ntilde;a', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Contrase&ntilde;a')));
                            ?>
                            <span class="text-danger"> <?php echo form_error('passwd','','');?> </span>
                        </div>
                        <div class="list-group-item">
                          <div id="captcha_first"></div>

                          <script type="text/javascript">
                          // inicia codigo javascript necesario para un captcha
                          $( document ).ready(function() {
                            data_ajax(site_url+"/captcha/get_new_captcha_ajax", "#null", "#captcha_first"); // cargamos por primera vez el captcha
                          });
                          // termina codigo javascript necesario para un captcha
                          </script>

                          <input type="text" class="form-control" name="userCaptcha" id="userCaptcha" placeholder="Escribe el texto de la imágen" autocomplete="off" value="<?php if(!empty($userCaptcha))echo $userCaptcha; ?>">
                            <span class="text-danger"> <?php echo form_error('userCaptcha','','');?> </span>
                        </div>
                        <div class="list-group-item" >
                            <?php
                                echo $this->form_complete->create_element(array('id'=>'btn_login', 'type'=>'submit', 'value'=>'Iniciar sesión', 'attributes'=>array('class'=>'btn btn-amarillo btn-block espacio')));
                            ?>
                        </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-3 col-xs-12"></div> -->

</div> <!-- row 12-->
<input type="hidden" id="token" name="token" value="<?php echo (exist_and_not_null($this->session->userdata('token')) ? $this->session->userdata('token') : ''); ?>">
<?php

echo form_close(); ?>

<script type="text/javascript">
    $( "#img-captcha" ).find( "img" ).addClass( "img-rounded");
</script>
<br><br>

