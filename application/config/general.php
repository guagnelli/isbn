<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['salt'] = "B0no5"; ///SALT

$config['modulos_no_sesion'] = array(
    'login' => array('index', 'cerrar_session', 'cerrar_session_ajax'),
    'registro' => array('*'),
    'pagina_no_encontrada' => array('index'),
    'recuperar_contrasenia' => '*',
    'captcha' => '*'
);
$config['modulos_sesion_generales'] = array(
    'login' => array('cerrar_session', 'cerrar_session_ajax'),
    'rol' => '*',
    'pagina_no_encontrada' => array('index'),
    'pruebas' => '*'
);

/////Ruta de solicitudes
//$config['ruta_documentacion'] = $_SERVER["DOCUMENT_ROOT"] . "/sipimss_bonos/assets/files/archivos_bono/";
//$config['ruta_documentacion_web'] = asset_url() . 'files/archivos_bono/'; //base_url()."assets/files/solicitudes/";

$config['tiempo_fuerza_bruta'] = 60 * 60; //3600 = 1 hora => Tiempo válido para chequeo de fuerza bruta

$config['intentos_fuerza_bruta'] = 10; ///Número de intentos válidos durante tiempo 'tiempo_fuerza_bruta'

$config['tiempo_recuperar_contrasenia'] = 60 * 60 * 24; //3600 * 24 = 86400 = 1 día => Límite de tiempo que estará activo el link

$config['meses'] = array(1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril', 5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto', 9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre');

$config['rol_admin'] = array('SUPERADMIN' => array('id' => 1, 'text' => 'Super-admin'), 'ADMIN' => array('id' => 2, 'text' => 'Admin'), 'USUARIO' => array('id' => 3, 'text' => 'Usuario'));

$config['bon_pro_eva_min'] = (float) 80.00;

$config['bon_sum_act_min'] = 26;

$config['cestado_usuario'] = array('ACTIVO'=>array('id'=>1), 'INACTIVO'=>array('id'=>2), 'RESTABLECERCONTRASENIA'=>array('id'=>3), 'RESTABLECERCMA'=>array('id'=>4));
