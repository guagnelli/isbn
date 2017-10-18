<?php
$usuario_logueado = $this->session->userdata('usuario_logeado');
$tipo_admin = $this->session->userdata('rol_cve'); //Tipo de usuario almacenado en sesión
$tipo_admin_config = $this->config->item('rol_admin'); //Identificador de administrador
?>
<style type="text/css">
    .dropdown-submenu {
    position:relative;
}
.dropdown-submenu>.dropdown-menu {
    top:0;
    left:100%;
    margin-top:-6px;
    margin-left:-1px;
    -webkit-border-radius:0 6px 6px 6px;
    -moz-border-radius:0 6px 6px 6px;
    border-radius:0 6px 6px 6px;
}
.dropdown-submenu:hover>.dropdown-menu {
    display:block;
}
.dropdown-submenu>a:after {
    display:block;
    content:" ";
    float:right;
    width:0;
    height:0;
    border-color:transparent;
    border-style:solid;
    border-width:5px 0 5px 5px;
    border-left-color:#cccccc;
    margin-top:5px;
    margin-right:-10px;
}
.dropdown-submenu:hover>a:after {
    border-left-color:#ffffff;
}
.dropdown-submenu.pull-left {
    float:none;
}
.dropdown-submenu.pull-left>.dropdown-menu {
    left:-100%;
    margin-left:10px;
    -webkit-border-radius:6px 0 6px 6px;
    -moz-border-radius:6px 0 6px 6px;
    border-radius:6px 0 6px 6px;
}
</style>
<div class="top_nav" style="margin-left: 0px !important;">
    <div class="nav_menu">
        <?php if (exist_and_not_null($usuario_logueado)) { ///Validar si usuario inicio sesión
            echo '<nav>   <div class="container-fluid">   <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="' . site_url('perfil') . '"><span class="glyphicon glyphicon-user"></span> ' . $this->session->userdata("nombre") . '</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <div class="navbar-form navbar-left" role="search"><div class="form-group">
                </div></div> <ul class="nav navbar-nav pull-right">'; ?>
            <li><a href="<?php echo site_url('solicitud'); ?>"  ><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
            <?php foreach ($this->config->item('modulos_permisos')[$tipo_admin]['menu'] as $key_menu => $menu) {
                if(is_array($menu)){
                    echo '<li class="menu-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-chevron-down"></span> '.$key_menu.'</a>
                        <ul class="dropdown-menu">';
                    foreach ($menu as $key_submenu => $submenu) {
                        echo '<li class="menu-item dropdown"><a href="'.site_url($key_submenu).'" ><span class="glyphicon glyphicon-list"></span> '.$submenu.'</a></li>';
                    }
                    echo "</ul></li>";
                } else {
                    echo '<li><a href="'.site_url($key_menu).'" ><span class="glyphicon glyphicon-list"></span> '.$menu.'</a></li>';
                }
            } ?>
            <li><a href="<?php echo site_url('login/cerrar_session'); ?>"  ><span class="glyphicon glyphicon-log-out"></span> Cerrar sesión</a></li>
            <?php
            echo '</ul></div></div></nav>';
            
        } else { ///Usuario sin sesión ?>
            <nav>
                <div class="nav toggle"></div>
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="<?php echo site_url('solicitud/index'); ?>"  ><span class="glyphicon glyphicon-home"></span> Inicio</a></li>
                </ul>   
            </nav>
            <?php
        }
        ?>
    </div>
</div>