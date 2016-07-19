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
    'registro' => array(
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
        'error_no_inserto_empleado' => 'No se pudieron guardar los datos del empleado'
    ),
    'restablecer_contrasenia' => array(
        'lbl_olvido_contrasenia' => 'He olvidado mi contraseña',
    ),
    'login' => array(
        'lbl_formulario' => 'Iniciar sesión',
        'er_no_usuario' => 'No se encontró registro del usuario',
        'er_contrasenia_incorrecta' => 'La contraseña del usuario es incorrecta',
        'er_general' => 'Datos incorrectos'
    ),
    //perfil string values
    'perfil' => array(
        'lbl_titulo_seccion' => 'Mi perfil',
        'lbl_informacion_general' => 'Información general',
        'lbl_formacion' => 'Formación',
        'lbl_formacion_personal_salud' => 'Formación del personal de salud',
        'lbl_formacion_docente' => 'Formación docente',
        'lbl_becas_comisiones' => 'Becas y comisiones laborales',
        'lbl_actividad' => 'Actividad docente',
        'lbl_comisiones_academicas' => 'Comisiones academicas',
        'lbl_elaboracion_material' => 'Elaboración de material educativo',
        'lbl_informacion_general_informacion_personal' => 'Información personal',
        'lbl_informacion_general_apellido_paterno' => 'Apellido paterno',
        'plh_informacion_general_apellido_paterno' => 'Introduzca su apellido paterno',
        'lbl_informacion_general_apellido_materno' => 'Apellido materno',
        'plh_informacion_general_apellido_materno' => 'Introduzca su apellido materno',
        'lbl_informacion_general_nombre' => 'Nombre',
        'plh_informacion_general_nombre' => 'Introduzca su nombre',
        'lbl_informacion_general_edad' => 'Edad',
        'plh_informacion_general_edad' => 'Introduzca su edad',
        'lbl_informacion_general_genero' => 'Género',
        'plh_informacion_general_genero' => 'Seleccione su género',
        'lbl_informacion_general_estado_civil' => 'Estado civil',
        'plh_informacion_general_estado_civil' => 'Seleccione su estado civil',
        'lbl_informacion_general_telefono_particular' => 'Teléfono particular',
        'plh_informacion_general_telefono_particular' => 'Introduzca su teléfono particular',
        'lbl_informacion_general_telefono_laboral' => 'Teléfono laboral',
        'plh_informacion_general_telefono_laboral' => 'Introduzca su teléfono laboral',
        'lbl_informacion_general_correo_electronico' => 'Correo electrónico',
        'plh_informacion_general_correo_electronico' => 'Introduzca su correo electrónico',
        'lbl_informacion_general_empleos_actuales' => 'Número de empleos actuales fuera del IMSS',
        'plh_informacion_general_empleos_actuales' => 'Introduzca su número de empleos actuales fuera del IMSS',
        'btn_informacion_general_editar_nombre' => 'Editar nombre',
        'btn_informacion_general_guardar_informacion_personal' => 'Guardar información personal',        
        'lbl_informacion_general_informacion_imss' => 'Información IMSS',        
        'lbl_informacion_general_matricula' => 'Matrícula',
        'lbl_informacion_general_delegacion' => 'Delegación',
        'lbl_informacion_general_nombre_categoria' => 'Nombre de la categoría/Puesto',
        'lbl_informacion_general_clave_categoria' => 'Clave de la categoría/Puesto',
        'lbl_informacion_general_nombre_area_adscripcion' => 'Nombre del área de adscripción',
        'lbl_informacion_general_nombre_unidad_adscripcion' => 'Nombre de la unidad de adscripción',
        'lbl_informacion_general_nombre_clave_adscripcion' => 'Clave de adscripción',
        'lbl_informacion_general_antiguedad' => 'Antigüedad',
        'lbl_informacion_general_antiguedad_anios' => 'Años',
        'lbl_informacion_general_antiguedad_quincenas' => 'Quincenas',
        'lbl_informacion_general_antiguedad_dias' => 'Días',
        'lbl_informacion_general_tipo_contratacion' => 'Tipo de contratación',
        'lbl_informacion_general_estatus_empleado' => 'Estatus del empleado',
        'lbl_informacion_general_clave_presupuestal' => 'Clave presupuestal',
        'lbl_informacion_general_curp' => 'CURP',
        'lbl_formacion_salud_formacion_profesional' => 'Tipo formación profesional',
        'lbl_formacion_salud_subtipo_formacion_profesional' => 'Subtipo formación profesional',
        'lbl_formacion_salud_comprobante' => 'Cedula profesional / Comprobante',
        'lbl_formacion_salud_tipo_comprobante' => 'Tipo de comprobante',
        'plh_formacion_salud_tipo_comprobante' => 'Tipo de comprobante',
        'lbl_formacion_salud_editar' => 'Editar',
        'lbl_formacion_salud_borrar' => 'Borrar',
        'btn_formacion_salud_agregar_formacion_profesional' => 'Agregar formación profesional',
        'plh_formacion_salud_formacion_profesional' => 'Seleccione una formación profesional',
        'plh_formacion_salud_subtipo_formacion_profesional' => 'Seleccione un subtipo de formación profesional',
    ),
    //Selección de roles del usuario 
    'rol' => array(
        'lbl_selecciona_rol' => 'Debe seleccionar un rol para cargar',
    ),
    //Textos generales
    'general' => array(
        'msg_no_existe_empleado'=>'No se encontrarón datos del empleado. Por favor registre sus datos',
        'advertencia_agregar_todos_los_datos'=>'Debe llenar todos los campos obligatorios',
        'datos_almacenados_correctamente'=>'Los datos se almacenaron correctamente',
        'error_guardar'=>'Los datos no se almacenaron. Por favor intentemo más tarde'
    ),
    //Actividad del docente
    'actividad_docente' => array(
        'error_no_registro' => 'No existe un registro',
        'lbl_pregunta_eliminar_actividad_docente' => 'Confirme que realmente desea eliminar la actividad [field]',
        'lbl_info_no_elimina_actividad_curso_principal' => 'La actividad [field] no puede ser removida. <br>Debe seleccionar otra actividad como curso principal',
        'save_curso_principal_modificado' => 'El curso principal se actualizo correctamente',
        'error_curso_principal_modificado' => 'No fue posible actualizar el curso principal',
        'error_insertar' => 'No se pudierón almacenar los datos de la actividad del docente',
        'error_actualizar' => 'No se pudierón actualizar los datos de la actividad del docente',
        'error_eliminar' => 'No se pudo eliminar la actividad [field]. <br>Por favor intente más tarde',
        'succesfull_insertar' => 'Los datos datos de la actividad del docente se almacenarón correctamente',
        'succesfull_actualizar' => 'Los datos de la actividad del docente se actualizarón correctamente',
        'succesfull_eliminar' => 'Los datos de la actividad [field] fueron removidos correctamente',
        'tl_titulo' => 'Actividad del docente',
        'stl_actividad_salud' => 'Actividad en salud',
        'stl_actividad_docente' => 'Actividad del docente',
        'tab_actividad_ad' => 'Actividad del docente',
        'lbl_actividad_di' => 'Desarrollo de investigación',
        'lbl_actividad_eps' => 'Ejercicio profesional en salud',
        'lbl_anios_dad' => 'Años dedicados a la actividad docente',
        'lbl_ejercicio_pd' => 'Ejercicio predominante como docente',
        'lbl_curso_principal' => 'Curso principal que imparte el profesor/a',
        'text_name_curso_imparte' => 'Nombre del curso',
        'btn_add_cp' => 'Asignar curso principal',
        'btn_guardar_cp' => 'Guardar curso principal',
        'btn_actualizar_cp' => 'Actualizar curso principal',
        'btn_add_new_actividad' => 'Agregar nueva actividad',
        'btn_add_investigacion' => 'Agregar investigación',
        'lbl_tipo_actividad_docente' => 'Tipo de actividad',
        'lbl_curso' => 'Nombre del curso',
        'drop_curso' => 'Selecciona nombre del curso',
        'lbl_rol_desempenia' => 'Rol que desempeña como profesor/tutor',
        'drop_rol_desempenia' => 'Seleccione rol que desempeña',
        'lbl_institucion_edu_avala' => 'Institución educativa que avala',
        'drop_institucion_edu_avala' => 'Seleccione institución educativa que avala',
        'lbl_recibe_pago_extra' => '¿Recibe pago extra por la institución que avala?',
        'lbl_licenciatura' => 'Licenciatura',
        'drop_licenciatura' => 'Seleccione licenciatura',
        'lbl_modalidad' => 'Modalidad',
        'drop_modalidad' => 'Seleccione modalidad',
        'lbl_anio_que_impartio_curso' => 'Año que se impartió',
        'lbl_duracion' => 'Duración',
        'radio_duracion_horas' => 'Hora(s)',
        'radio_duracion_fecha' => 'Fecha(s)',
        'lbl_duracion_fecha_inicio' => 'Fecha de inicio',
        'lbl_duracion_fecha_final' => 'Fecha de termino',
        'drop_tipo_comprobante' => 'Seleccione el tipo de comprobante',
        'title_tipo_comprobante' => 'Tipo de comprobante',
        'lbl_tipo_comprobante' => 'Tipo de comprobante',
        'title_cargar_comprobante' => 'Cargar comprobante',
        'lbl_comprobante' => 'Comprobante',
        'lbl_modulo' => 'Módulo',
        'drop_modulo' => 'Seleccione módulo',
        'lbl_periodo' => 'Período',
        'lbl_especialidad' => 'Especialidad',
        'drop_especialidad' => 'Seleccione una especialidad',
        'lbl_anio_fungio' => 'Año en que fungió',
        'lbl_nombre_materia' => 'Nombre de la materia que impartió',
        'text_nombre_materia' => 'Nombre de la materia',
        'lbl_area' => 'Área',
        'drop_area' => 'Seleccione área',
        'drop_tipo_formacion_profesional' => 'Seleccione tipo de formación profesional',
        'lbl_tipo_formacion_profesional' => 'Formación profesional',
        'lbl_nombre_material_elaborado' => 'Nombre del material elaborado',
        'ph_material_elaborado' => 'Nombre del material',
        'lbl_tipo_material' => 'Tipo de material elaborado',
        'drop_tipo_material' => 'Seleccione tipo de material',
        'lbl_tipo_participacion' => 'Tipo de participación',
        'drop_tipo_participacion' => 'Seleccione tipo de participación',
        'lbl_tipo_curso' => 'Tipo de curso',
        'drop_tipo_curso' => 'Seleccione tipo de curso',
        'lbl_folio' => 'Folío constancia',
        'text_folio_constancia' => 'Folío',
        'tab_titulo_form_prof' => 'Formación profesional',
        'tab_titulo_pro_salud_cur_principal' => 'CP',
        'tab_titulo_pro_salud_actividad' => 'Tipo de actividad',
        'tab_titulo_cedula_prof' => 'Cédula profesional / Complobante',
        'tab_titulo_pro_salud_duracion' => 'Duración',
        'tab_titulo_pro_salud_fecha_inicio' => 'Fecha de inicio',
        'tab_titulo_pro_salud_fecha_fin' => 'Fecha de fin',
        'tab_titulo_pro_salud_anio' => 'Año',
        'tab_titulo_editar' => 'Editar',
        'tab_titulo_eliminar' => 'Eliminar',
    ),
);




//$lang['interface_registro_profesor'] = 'Impresión de texto prueba';
//$lang['interface_otro_mensaje'] = '&lsaquo; Primero';
