<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

$config['salt'] = "B0no5"; ///SALT
$config['modulos_no_sesion'] = array(
    'login' => array('index', 'cerrar_session', 'cerrar_session_ajax'),
    'pagina_no_encontrada' => array('index'),
    'recuperar_contrasenia' => array('*'),
    'captcha' => array('*')
);
$config['modulos_sesion_generales'] = array(
    'login' => array('cerrar_session', 'cerrar_session_ajax'),
    'dashboard' => array('*'),
    'perfil' => array('*'),
    'pagina_no_encontrada' => array('index')
);
/*$config['modulos_permisos'] = array(E_rol::SUPERADMINISTRADOR => array('solicitud' => array('*')), 
    E_rol::ADMINISTRADOR => array('solicitud' => array('*')),
    E_rol::DGAJ => array('solicitud' => array('*')), 
    E_rol::ENTIDAD => array('solicitud' => array('*'))
);*/
$config['modulos_permisos'] = array(
    E_rol::SUPERADMINISTRADOR => array('permisos' => array('solicitud' => array('*'), 'reporte' => array('*')), 'menu'=>array('Solicitud' => array('solicitud/index'=>'Solicitud', 'solicitud/registrar'=>'Registrar'), 'reporte'=>'Reporte')), 
    E_rol::ADMINISTRADOR => array('permisos' => array('solicitud' => array('*'), 'reporte' => array('*')), 'menu'=>array('Solicitud' => array('solicitud/index'=>'Solicitud', 'solicitud/registrar'=>'Registrar'), 'reporte'=>'Reporte')),
    E_rol::DGAJ => array('permisos' => array('solicitud' => array('*')), 'menu'=>array('solicitud/index'=>'Solicitud')), 
    E_rol::ENTIDAD => array(
        'permisos' => array('solicitud' => array('*')), 
        'menu'=>array('solicitud/index'=>'Solicitud',
                      "solicitud/registrar"=>"Nueva solicitud"),)
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

$config['cestado_usuario'] = array('ACTIVO' => array('id' => 1), 'INACTIVO' => array('id' => 2), 'RESTABLECERCONTRASENIA' => array('id' => 3), 'RESTABLECERCMA' => array('id' => 4));

$config['catalogos_definidos'] = array(
    Enum_cg::c_barcode_size => array('id' => '', 'desc' => ''),
    Enum_cg::c_entidad => array('id' => 'id', 'desc' => 'name'),
    Enum_cg::c_estado => array('id' => 'id', 'desc' => 'name'),
    Enum_cg::c_subsistema => array('id'=>'id', 'desc'=>'name'),
    Enum_cg::c_categoria => array('id'=>'id', 'desc'=>'nombre'),
    Enum_cg::c_subcategoria => array('id'=>'id', 'desc'=>'nombre'),
);

$config['alert_msg'] = array(
    'SUCCESS' => array('id_msg' => 1, 'class' => 'success'),
    'DANGER' => array('id_msg' => 2, 'class' => 'danger'),
    'WARNING' => array('id_msg' => 3, 'class' => 'warning'),
    'INFO' => array('id_msg' => 4, 'class' => 'info')
);

$config['tipo_obra'] = array(
    'I' => 'Independiente',
    'C' => 'Completa',
    'V' => 'Volumen',
);