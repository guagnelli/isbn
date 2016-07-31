<?php if(!defined('BASEPATH')) exit('NO DIRECT SCRIPT ACCESS ALLOWED');

class Log_user{
    
    var $CI;
    
    function is_login(){
        $CI =& get_instance();
        
        $CI->load->library('session');
        $CI->load->helper('url');

        $logeado = $CI->session->userdata('usuario_logeado');
        $nick = $CI->session->userdata('nick');

        $controlador = $CI->uri->segment(1);  //Controlador
        $accion = $CI->uri->segment(2);  //Accion
        $accion = (empty($accion) || is_null($accion)) ? 'index' : $accion;
        $accion_total = "*";

        $excepciones = array('login'=>array('index', 'cerrar_session', 'cerrar_session_ajax'),'buscador'=>array('*'),'captcha' => array('*')); //Excepciones, sin sesión activa
        $excepciones_login = array('login'=>array('index')); //Excepciones, sin sesión activa
        //pr($CI->session->userdata());
        //exit();
        $bandera_excepcion = FALSE;
        if((empty($logeado) || is_null($logeado)) || (empty($nick) || is_null($nick))){ //En caso de que no cuente con datos en sesión
            foreach ($excepciones as $key_excepcion => $excepcion) { //Recorremos listado de excepciones
                if(($controlador==$key_excepcion && in_array($accion, $excepcion)) || ($controlador==$key_excepcion && in_array($accion_total, $excepcion))) { //Verificamos si la ruta actual se encuentra dentro de las excepciones
                    $bandera_excepcion = TRUE;
                }
            }
            if($bandera_excepcion===FALSE){
                echo "entro";
                if($CI->input->is_ajax_request()){
                    redirect('login/cerrar_session_ajax');
                } else {
                    redirect('login');
                    exit();
                }
            }
            /*pr($bandera_excepcion);
            pr($controlador);
            pr($accion);*/
            //exit();
        } else { //En caso de que existan datos en sesión
            foreach ($excepciones_login as $key_excepcion_login => $excepcion_login) { //Recorremos listado de excepciones
                if($controlador==$key_excepcion_login && in_array($accion, $excepcion_login)){ //Verificamos si la ruta actual se encuentra dentro de las excepciones
                    $bandera_excepcion = TRUE;
                }
            }
            if($bandera_excepcion===TRUE){
                redirect('dashboard');
                exit();
            }
        }
    }
}
