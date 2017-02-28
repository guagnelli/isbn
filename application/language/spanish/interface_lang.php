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
        'error_guardar' => 'Los datos no se almacenaron. Por favor intentemo más tarde',
        'actualizacion' => 'Se han guardado satisfactoriamente los cambios.',
        'error' => 'Ha ocurrido un error durante el almacenamiento, inténtelo más tarde por favor.'
    ),
    'solicitud_index' => array(
        'title_template_dgj' => 'Revisión de solicitudes por ',
        'title_template_entidad' => 'Revisión de solicitudes de la entidad ',
        'title_template_default' => 'Revisión de solicitudes',
        'title_reporte' => 'Reporte',
        'lbl_cantidad_registros' => 'Cantidad de registros',
        'lbl_ordenar_por' => 'Ordenar por:',
        'lbl_tipo_orden' => 'Tipo de orden:',
        'lbl_estado_solicitud' => 'Estado de la solicitud',
        'lbl_entidades' => 'Entidades',
        'lbl_subsistema' => 'Subsistemas',
        'lbl_subcategoria' => 'Tema',
        'lbl_categoria' => 'Categoría',
        'text_buscar_por' => 'Buscar por: ',
        'txt_buscar_solicitud' => 'Buscar por: ',
        'drop_estado_solicitud' => 'Selecciona estado de la solicitud',
        'drop_entidades' => 'Seleccionar entidad',
        'drop_subsistema' => 'Seleccionar subsistema',
        'drop_subcategoria' => 'Seleccionar subcategoría',
        'drop_categoria' => 'Seleccionar categoría',
        'li_isbn' => 'ISBN',
        'li_title_obra' => 'Título del libro',
        'li_sub_title_obra' => 'Subtítulo del libro',
        'order_titulo_libro' => 'Título del libro',
        'order_entidad' => 'Entidad',
        'order_estado_solicitud' => 'Estado de la solicitud',
        'order_subtitulo_libro' => 'Subtítulo del libro',
        'order_isbn' => 'ISBN',
        'order_subsistema' => 'Subsistema',
        'order_categoria' => 'Categoría',
        'order_subcategoria' => 'Subcategoría',
        'btn_agreagar_solicitud' => 'Nueva solicitud',
        
    ),
    'tabla_resultados' => array(
        'resp_sin_resultados' => 'No se encontraron resultados',
        'txt_descargar_solicitud' => 'Descargar',
        'title_folio' => 'Folio',
        'title_estado' => 'Estado del libro',
        'title_libro' => 'Titulo del libro',
        'title_isbn_libro' => 'ISBN del libro',
        'title_name_entidad' => 'Entidad',
        'title_name_subsistema' => 'Subsistema',
        'title_name_categoria' => 'Categoría',
        'title_name_subcategoria' => 'Subcategoría',
        'title_fecha_validacion' => 'Fecha última validacion',
        'title_operacion' => 'Acciones',
//        'title_ver_detalle' => 'Detalle',
        'title_subcategoria' => 'Sub categoría',
        'link_ver_detalle_solicitud' => 'Detalle',
        'link_ver_solicitud' => 'Ver solicitud',
    ),
    'perfil' => array(
        'title_perfil' => 'Perfil',
        'lbl_nombre' => 'Nombre',
        'lbl_paterno' => 'Apellido paterno',
        'lbl_materno' => 'Apellido materno',
        'lbl_correo' => 'Correo electrónico',
        'lbl_contrasenia' => 'Contraseña',
        'lbl_contrasenia_confirmacion' => 'Confirmar contraseña',
        'lbl_guardar' => 'Guardar'
    ),
    'solicitud_detalle' => array(
        'title_detalle_gral' => 'Dirección General de Asuntos Jurídicos',
        'title_titulo_libro' => 'Detalle del libro: ',
        'title_subtitulo_libro' => 'Sub titulo del libro: ',
        'lbl_titulo_seccion' => 'Detalle de la solicitud',
        'add_ver_comment' => 'Agregar comentario',
        'title_clas_tematica' => 'Clasificación temática: ',
        'title_tema' => 'Tema:',
        'title_colaboradores' => 'Colaboradores: ',
        'title_idioma' => 'Idioma(s): ',
        'title_traduccion' => 'Traducción: ',
        'title_info_edicion' => 'Información de edición: ',
        'li_categoria' => 'Categoría: ',
        'li_sub_categoria' => 'Sub categoría: ',
        'li_coleccion' => 'Colección: ',
        'li_num_coleccion' => 'No. de colección: ',
        'li_nom_serie_coleccion' => 'Nombre de la colección: ',
        'li_tipo_contenido_coleccion' => 'Tipo de contenido: ',
        'li_name_colaborador' => 'Nombre: ',
        'li_tipo_colaborador' => ', ',
        'li_title_original_traduccion' => 'Titulo original: ',
        'li_idioma_orig_traduccion' => 'Idioma original: ',
        'li_idioma_del_traduccion' => 'Tradicción del: ',
        'li_idioma_al_traduccion' => 'Traducción al: ',
        
    ),
    'solicitud_cambio_estado' => array(
        'lbl_titulo_seccion' => 'Detalle de la solicitud',
        'save_estado_error' => 'Detalle de la solicitud',
        'save_default' => 'El cambio de estado se efectuo correctamente',
        'save_envio_revision' => 'La solicitud se envió a revisión correctamente',
    ),
    'solicitud_comentarios_seccion' => array(
        'title_seccion' => 'Comentarios de la seccion: ',
        'fecha_comentario' => 'Fecha: ',
        'estado_solicitud' => 'Estado de la solicitud: ',
        'name_seccion' => 'Sección: ',
        'comentario' => 'Observaciones: ',
        'title_libro' => 'Titulo del libro: ',
        'title_isbn' => 'ISBN: ',
        'title_sub_titulo' => 'Subtitulo del libro: ',
        'btn_text_collapse_mensajes' => 'Historial de comentarios de la sección',
        'lbl_comentario' => 'Comentario:',
        'btn_guardar_comentario' => 'Guardar',
        'btn_close' => 'Cancelar',
        'save_correcto_comentario' => 'Las observaciones se guardaron correctamente',
        'save_incorrecto_comentario' => 'No fue posible guardar las observaciones de la sección.<br>Por favor intentelo más tarde',
    )
);

//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';
