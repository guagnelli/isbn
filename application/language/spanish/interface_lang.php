<?php
/**
 * Archivo que contiene los textos del sistema
 * Contrucción del índice.
 * 	- Archivo fuente: interface_
 * 	- Modulo: login
 *  - Controlador: login
 *  - Identificador único del texto dentro del arreglo: texto_bienvenida
 * 		Ej:
 * 			$lang['interface_login']['login']['texto_bienvenida'] = 'Bienvenido al sistema SIPIMSS';
 * 			$lang['interface_login']['login']['texto_usuario'] = 'Usuario:';
 * 			$lang['interface_login']['login']['texto_contrasenia'] = 'Contraseña:';
 * 			$lang['interface_censo']['formacion']['texto_bienvenida'] = '...';
 * 			$lang['interface_censo']['actividad']['texto_bienvenida'] = '...';
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

//$lang['interface_'][''][''] = '';
//$lang['interface']['registro']['texto_bienvenida'] = 'Hola mundo';
$lang['interface'] = array(
    /*'registro' => array(
        'lbl_bienvenido' => 'Bienvenido',
        'lbl_formulario' => 'Registro de docentes al censo de profesores',
        'lbl_campos_obligatorios' => 'Campos obligatorios',
        'lbl_matricula' => 'Matrícula',
        'plh_matricula' => 'Introduzca su matrícula',
        'lbl_delegacion' => 'Delegación',
        'plh_delegacion' => 'Seleccione su delegación',
        'lbl_contrasenia' => 'Introdusca una contraseña',
        'plh_contrasenia' => 'Introduzca una contraseña',
        'lbl_confirma_contrasenia' => 'Confirmar contraseña',
        'plh_confirma_contrasenia' => 'Confirme su contraseña',
        'lbl_correo' => 'Correo electrónico',
        'plh_correo' => 'Introduzca su correo electronico',
        'lbl_captcha' => 'Codigo de seguridad',
        'plh_captcha' => 'Escriba el texto de la imágen',
        'plh_btn_guardar' => 'Registrar',
        'lbl_no_registrado' => '¿No se ha registrado?',
        'lbl_existe_registro' => 'El usuario ya se encuentra registrado',
        'phl_la_matricula_existe' => 'El usuario con matricula: [field] ya se encuentrá registrado',
        'phl_registro_correcto' => 'El registro se efectuo correctamente',
        'phl_registro_incorrecto_del_empleado' => 'El registro del empleado no se pudo validar',
        'error_no_inserto_empleado' => 'No se pudieron guardar los datos del empleado'
    ),*/
    'restablecer_contrasenia' => array(
        'lbl_olvido_contrasenia' => 'He olvidado mi contraseña',
    ),
    'login' => array(
        'lbl_formulario' => 'Iniciar sesión',
        'er_no_usuario' => 'No se encontró registro del usuario',
        'er_contrasenia_incorrecta' => 'La contraseña del usuario es incorrecta',
        'er_general' => 'Datos incorrectos'
    ),
    //Textos generales
    'general' => array(
        'msg_no_existe_empleado' => 'No se encontrarón datos del empleado. Por favor registre sus datos',
        'advertencia_agregar_todos_los_datos' => 'Debe llenar todos los campos obligatorios',
        'datos_almacenados_correctamente' => 'Los datos se almacenaron correctamente',
        'error_guardar' => 'Los datos no se almacenaron. Por favor intentemo más tarde'
    ),
    'solicitud_index' => array(
        'title_template' => 'Revisión de solicitudes',
        'lbl_cantidad_registros' => 'Cantidad de registros',
        'lbl_ordenar_por' => 'Ordenar por:',
        'lbl_tipo_orden' => 'Tipo de orden:',
        'lbl_estado_solicitud' => 'Estado de la solicitud',
        'lbl_entidades' => 'Entidades',
        'lbl_subsistema' => 'Subsistemas',
        'text_buscar_por' => 'Buscar por: ',
        'txt_buscar_solicitud' => 'Buscar por: ',
        'drop_estado_solicitud' => 'Selecciona estado de la solicitud',
        'drop_entidades' => 'Seleccionar entidad',
        'drop_subsistema' => 'Seleccionar Subsistemas',
        'li_isbn' => 'ISBN',
        'li_title_obra' => 'Titulo del libro',
        'li_sub_title_obra' => 'Sub titulo del libro',
        'order_titulo_libro' => 'Titulo del libro',
        'order_estado_solicitud' => 'Estado de la solicitud',
        'order_subtitulo_libro' => 'Sub titulo del libro',
        'order_isbn' => 'ISBN',
        'btn_agreagar_solicitud' => 'Nueva solicitud',
        
    ),
    'tabla_resultados' => array(
        'resp_sin_resultados' => 'No se encontraron resultados',
        'title_folio' => 'Folio',
        'title_estado' => 'Estado del libro',
        'title_libro' => 'Titulo del libro',
        'title_isbn_libro' => 'ISBN del libro',
        'title_name_entidad' => 'Entidad',
        'title_fecha_validacion' => 'Fecha última validacion',
        'title_validacion' => 'Validar',
        'title_ver_detalle' => 'Detalle',
        'link_ver_detalle_solicitud' => 'Detalle',
        'link_ver_solicitud' => 'Ver solicitud',
    ),
    'solicitud_detalle' => array(
        'lbl_titulo_seccion' => 'Detalle de la solicitud',
    ),
    'solicitud_cambio_estado' => array(
        'lbl_titulo_seccion' => 'Detalle de la solicitud',
        'save_estado_error' => 'Detalle de la solicitud',
        'save_default' => 'El cambio de estado se efectuo correctamente',
        'save_envio_revision' => 'La solicitud se envió a revisión correctamente',
    )
);

//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';
