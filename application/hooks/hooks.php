<?php if(!defined('BASEPATH')) exit('NO DIRECT SCRIPT ACCESS ALLOWED');

class Log_user{
    
    var $CI;
    
    function is_login(){
        $CI =& get_instance();
        
        $CI->load->library('session');
        $CI->load->helper('url');
        $CI->config->load('general');

        $logeado = $CI->session->userdata('usuario_logeado'); ///Obtener datos de sesión
        $nick = $CI->session->userdata('nick');
        $rol_cve = $CI->session->userdata('rol_cve');

        $modulos_no_sesion = $CI->config->item('modulos_no_sesion');
        $modulos_sesion_generales = $CI->config->item('modulos_sesion_generales');
        $modulos_permitidos = (isset($CI->config->item('modulos_permisos')[$rol_cve])) ? array_merge($modulos_sesion_generales, $CI->config->item('modulos_permisos')[$rol_cve]['permisos']) : array();
        //$tipo_admin_config = $CI->config->item('rol_admin'); ///Tipo de perfil del usuario que inicio sesión
        //pr($CI->session->userdata());
        //$modulos_permitidos = ($rol_cve==$tipo_admin_config) ? $CI->config->item('menu_admin') : $CI->config->item('menu_aspirante');
        //pr($CI->config->item('modulos_permisos')); pr($rol_cve); 
        //pr($modulos_permitidos); pr($CI->session->userdata());
        $controlador = $CI->uri->segment(1);  //Controlador
        $accion = $CI->uri->segment(2);  //Accion
        $accion = (empty($accion) || is_null($accion)) ? 'index' : $accion;
        $accion_total = "*";

        //$excepciones = array('login'=>array('index','cerrar_session','cerrar_session_ajax','recuperar_contrasenia','actualizar_contrasenia'),'registro'=>array('index')); //Excepciones, acceso sin sesión activa
        $excepciones = $modulos_no_sesion;
        $no_accesos = array('login'=>array('index')); //No acceso, con sesión activa
        
        $bandera_excepcion = $bandera_no_acceso = FALSE;
        if((empty($logeado) || is_null($logeado)) || (empty($nick) || is_null($nick))){ //En caso de que no cuente con datos en sesión
            foreach ($excepciones as $key_excepcion => $excepcion) { //Recorremos listado de excepciones
                if(($controlador==$key_excepcion && in_array($accion, $excepcion)) || ($controlador==$key_excepcion && in_array($accion_total, $excepcion))) { //Verificamos si la ruta actual se encuentra dentro de las excepciones
                    $bandera_excepcion = TRUE;
                }
            }
            if($bandera_excepcion===FALSE){
                if($CI->input->is_ajax_request()){
                    redirect('login/cerrar_session_ajax');
                } else {
                    redirect('login');
                    exit();
                }
            }
        } else { //En caso de que existan datos en sesión
            $bandera_encontrado=FALSE;
            foreach ($modulos_permitidos as $key_mod_perm => $modulo_permitido) {
                //echo "controlador: $controlador | key_mod_perm: $key_mod_perm | accion: $accion | modulo_permitido: $modulo_permitido | accion_total: $accion_total <br>";
                if(($controlador==$key_mod_perm && in_array($accion, $modulo_permitido)) || ($controlador==$key_mod_perm && in_array($accion_total, $modulo_permitido))){
                    $bandera_encontrado=TRUE;
                }
                //echo "|";pr($bandera_encontrado);echo "|";
            }
            foreach ($no_accesos as $key_excepcion_login => $no_acceso) { //Recorremos listado de no accesos
                if($controlador==$key_excepcion_login && in_array($accion, $no_acceso)){ //Verificamos si la ruta actual se encuentra dentro de los no acceso
                    $bandera_no_acceso = TRUE;
                }
            }
            //echo "bandeta_encontrado:"; pr($bandera_encontrado);
            //echo "bandeta_no_Aceeso:"; pr($bandera_no_acceso);
            //exit();
            if($bandera_encontrado===FALSE || $bandera_no_acceso===TRUE){
                redirect('dashboard');
                exit();
            }
        }
    }
}
