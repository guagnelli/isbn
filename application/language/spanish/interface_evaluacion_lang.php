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
$lang['interface_evaluacion'] = array(
    'convocatoria_evaluacion' => array(
        'buscador' => array(
            'titulo' => 'Administrar fechas de evaluación',
            'proxima_evaluacion' => 'Próxima evaluación:',
            'agregar_convocatoria' => 'Agregar fecha',
            'tab_head_fecha_fin_registro' => 'Fecha fin de registro docente',
            'tab_head_fecha_fin_validacion1' => 'Fin validación 1',
            'tab_head_fecha_fin_validacion2' => 'Fin validación 2',
            'tab_head_fecha_dictamen' => 'Dictamen',
            'tab_head_fecha_inconformidad' => 'Inconformidad',
            'tab_head_acciones' => 'Acciones',
            'lbl_editar' => 'Editar',
            'lbl_eliminar' => 'Eliminar',
            'titulo_agregar' => 'Agregar convocatoria',            
        ),
        'agregar' => array(
            'titulo_agregar' => 'Agregar convocatoria',
            'tab_head_fecha_fin_registro' => 'Fecha fin de registro docente',
            'tab_head_fecha_fin_validacion1' => 'Fecha fin validación 1',
            'tab_head_fecha_fin_validacion2' => 'Fecha fin validación 2',
            'btn_enviar' => 'Enviar',
            'btn_cancelar' => 'Cancelar',
        ),
    ),    
);
//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';
