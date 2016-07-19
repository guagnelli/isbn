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