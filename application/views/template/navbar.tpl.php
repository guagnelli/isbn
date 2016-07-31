<?php
$usuario_logueado = $this->session->userdata('usuario_logeado');
$tipo_admin = $this->session->userdata('rol_cve'); //Tipo de usuario almacenado en sesión
$tipo_admin_config = $this->config->item('rol_admin'); //Identificador de administrador
/*pr($usuario_logueado);
pr($tipo_admin);
pr($tipo_admin_config);
pr($this->session->userdata());*/
if (exist_and_not_null($usuario_logueado)) { ///Validar si usuario inicio sesión
    if ($tipo_admin == $tipo_admin_config['SUPERADMIN']['id'] || $tipo_admin == $tipo_admin_config['ADMIN']['id']) { ///Super-administrador y Administrador
        echo '<nav class="navbar navbar-default">   <div class="container-fluid">   <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="' . site_url() . '"><span class="glyphicon glyphicon-user"></span> ' . $this->session->userdata("nombre") . " " . $this->session->userdata("apaterno") . " " . $this->session->userdata("amaterno") . '</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="navbar-form navbar-left" role="search"><div class="form-group">
                ';
        ?>
        <?php echo '</div></div> <ul class="nav navbar-nav navbar-right">  '; ?>
        <li><a href="<?php echo site_url('dashboard'); ?>"  ><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <!-- <li><a href="<?php //echo site_url('rol'); ?>" ><span class="glyphicon glyphicon-list"></span> Ver listado de roles</a></li> -->
        <li><a href="<?php echo site_url('login/cerrar_session'); ?>"  ><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
        <?php
        echo '</ul></div></div></nav>';
    } else { //Usuario
        echo '<nav class="navbar navbar-default">   <div class="container-fluid">   <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="' . site_url() . '"><span class="glyphicon glyphicon-user"></span> ' . $this->session->userdata("nombre") . " " . $this->session->userdata("apaterno") . " " . $this->session->userdata("amaterno") . '</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="navbar-form navbar-left" role="search"><div class="form-group">';
        ?>
        <?php echo '</div></div> <ul class="nav navbar-nav navbar-right">  '; ?>
        <li><a href="<?php echo site_url('dashboard'); ?>"  ><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
        <li><a href="<?php echo site_url('rol'); ?>" ><span class="glyphicon glyphicon-list"></span> Ver listado de roles</a></li>
        <li><a href="<?php echo site_url('login/cerrar_session'); ?>"  ><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
        <?php
        echo '   </ul>     </div>  </div>  </nav>';
    }
} else { ///Usuario sin sesión
    echo '<nav class="navbar navbar-default">   <div class="container-fluid">   <div class="navbar-header">
        <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
           <span class="sr-only">Toggle navigation</span>
           <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="' . site_url() . '"><span class="glyphicon glyphicon-user"></span> ' . $this->session->userdata("nombre") . " " .$this->session->userdata("apaterno") . " " .$this->session->userdata("amaterno") . " " .'</a>
       </div> -->
       <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
       <!--<div class="navbar-form navbar-left" role="search"> <div class="form-group">';
    ?>
    <?php echo '</div></div> --> <ul class="nav navbar-nav navbar-left">  '; ?>
    <li><a href="<?php echo site_url('dashboard'); ?>"  ><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
    <?php
    echo '   </ul>     </div>  </div>  </nav>';
}
?>