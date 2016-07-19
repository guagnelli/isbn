<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona EL DASHBOARD
 * @version 	: 1.0.0
 * @autor 		: Pablo José D.
 */
class Pruebas extends CI_Controller {

    /**
     * Carga de clases para el acceso a base de datos y obtencion de las variables de session
     * @access 		: public
     */
    public function __construct() {
        parent::__construct();
//        $this->load->model('Bitacora_model', 'bitacora');
        $this->load->model('Login_model', 'lm');
//        $this->load->library('enum_privilegios_conf');
//        $this->load->library('enum_estados_empleado');
        $this->config->load('general');
//        $this->input->server();
    }

    public function index() {
        /*
          $parametros = $this->config->item('parametros_bitacora');
          $parametros['USUARIO_CVE'] = 56;
          //$parametros['BIT_VALORES'] = 'valor|nada|nulo';
          //        $parametros['BIT_IP'] = $this->input->ip_address();
          $parametros['BIT_IP'] = $this->get_real_ip();
          //                $_SERVER['HTTP_CLIENT_IP'];
          $parametros['BIT_RUTA'] = 'https://facebook.com/carlitadddd';
          //        $parametros['MODULO_CVE'] = null;

          //        pr($this->input->ip_address());
          //        pr($_SERVER['REMOTE_ADDR']);
          //        pr($_SERVER['HTTP_FORWARDED']);
          $result = $this->bitacora->set_bitacora($parametros);
          if ($result) {
          pr("Hola y bienvenidos!! ");
          } else {
          pr("No se pudo insertar la bitacora!! ");
          }

          $parametros_log = $this->config->item('parametros_log');
          $parametros_log['USUARIO_CVE'] = 56;
          $parametros_log['LOG_INI_SES_IP'] = '11.26.25.94';

          $resultado = $this->bitacora->set_log_ususario($parametros_log);
          if ($resultado) {
          pr("log satisfactorio!! ");
          } else {
          pr("No se pudo insertar el log!! ");
          }
         */
//        hash('sha512', "password123"."987654321" )
//        $var = '10010629';
//        $pass = 123;
////        $pass_encrypt = hash('SHA512', $pass);
//////        pr($pass_encrypt);
//////        $var = '1001062';
////        $resultado = $this->bitacora->set_login($var, $pass);
////        if(!is_null($resultado[0]) && $resultado[0]['cantidad_reg']){
////            
////        }else{
////            
////        }
////        pr($resultado);
//        $resultado = $this->lm->get_usuario_rol_modulo_sesion(1);
//        pr($resultado);

        $roles = $this->lm->get_usuario_rol_modulo_sesion(1); //Módulos por rol 
        $modulos_extra = $this->lm->get_usuario_modulo_extra_sesion(1); //Módulos extra por usuario 
        $juntar = $this->generar_propiedades_permisos($roles, $modulos_extra);
        pr('$roles');
        pr($roles);
        pr($modulos_extra);
        pr($juntar);
       $this->session->sess_destroy();
    }

    private function generar_propiedades_permisos($roles, $modulos_extra) {
        $existe_mod_extra = isset($modulos_extra) and is_null($modulos_extra) and empty($modulos_extra);
        $array_result = array();
        if (isset($roles) and !is_null($roles) and !empty($roles)) {//Debe existir rol
            if ($existe_mod_extra) {//Si existen roles extra (usuario-módulo)
                $array_result = $this->evaluar_rol_con_modulos($roles, $modulos_extra);
//            pr($this->evaluar_rol($roles));
            } else {//Evalua unicamente la tabla de usuario - rol
                $array_result = $this->evaluar_rol($roles);
            }
        }
        return $array_result;
    }

    private function evaluar_rol_con_modulos($roles, $modulos_extra) {
        $roles_modu = $this->evaluar_rol($roles);
        $usuario_modulos = crear_formato_array($modulos_extra, 'cve_modulo', TRUE);
        $array_keys_rol = array_keys($roles_modu); //Obtiene las llaves del arreglo de roles
        //Número de iteracciones según la cantidad de registros de 
        for ($j = 0; $j < count($roles_modu); $j++) {
            $key = $array_keys_rol[$j]; //primera llave 
            $value = $roles_modu[$key]; //valor correspondiente (array de modulos)
            $array_keys_m_ex = array_keys($usuario_modulos); //Obtiene las llaves del arreglo de modulos
            for ($k = 0; $k < count($usuario_modulos); $k++) {
                $keyp = $array_keys_m_ex[$k];
                if (array_key_exists($keyp, $value)) {//Verifica que exista el modulo en el array
                    //Verifica que no tenga acceso, para quitarlo
                    if (!$usuario_modulos[$keyp]['acceso_modulo']) {
                        unset($roles_modu[$key][$keyp]); //Quita valor
                    }
                } else {
                    if ($usuario_modulos[$keyp]['acceso_modulo']) {
                        $roles_modu[$key][$keyp] = $usuario_modulos[$keyp];
                    }
                }
            }
        }

        return $roles_modu;
    }

    private function evaluar_rol($roles) {
        $roles_formato = crear_formato_array($roles, 'cve_rol', FALSE);
        foreach ($roles_formato as $key => $value) {
//            $thiscrear_formato_modulos($value);
            $modulos_formatos = crear_formato_array($value, 'cve_modulo', TRUE);
//            pr($modulos_formatos);
            $roles_formato[$key] = $modulos_formatos;
        }
        return $roles_formato;
    }

    function get_real_ip() {

        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }

}
