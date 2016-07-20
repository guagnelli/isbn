<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Ricardo Sanchez S
 */
class Perfil extends MY_Controller {

    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->model('Perfil_model', 'modPerfil');
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->model('Actividad_docente_model', 'adm');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        //$this->lang->load('interface');
    }

    /**
     * 
     * @author Ricardo Sanchez S
     */
    public function index() {
        $rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles

        $array_menu = get_busca_hijos($rol_seleccionado, $this->uri->segment(1));
        $datosPerfil = $this->loadInfo($this->session->userdata('identificador'));

        $datosPerfil['generos'] = array('F' => 'Femenino', 'M' => 'Masculino');
        $datosPerfil['estadosCiviles'] = dropdown_options($this->modPerfil->getEstadoCivil(), 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE');
        $datosPerfil['formacionProfesionalOptions'] = array();
        $datosPerfil['tipoComprobanteOptions'] = array();
        $datosPerfil['array_menu'] = $array_menu;


        $main_content = $this->load->view('perfil/index', $datosPerfil, true);
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_content);
        $this->template->getTemplate();
    }

    /**
     * 
     * @param mixed $parameters
     */
    private function loadInfo($identificador) {
        $empleadoData = $this->modPerfil->getEmpleadoData($identificador);
        $datosPerfil = array();
        if (count($empleadoData)) {
            foreach ($empleadoData['0'] as $key => $value) {
                $datosPerfil[$key] = $value;
            }
        }
        return $datosPerfil;
    }

    /**
     * author LEAS
     * Guarda actividad docente general
     */
    public function get_data_ajax_actividad() {
//        pr($_SERVER);
        $data = array();
        $tipo_msg = $this->config->item('alert_msg');
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
//        pr($actividad_docente);
        if ($this->input->post()) { //Validar que la información se haya enviado por método POST para almacenado
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('form_actividad_docente_general'); //Obtener validaciones de archivo
//            pr($validations);
            $this->form_validation->set_rules($validations);
//            pr($this->input->post(null, true));
            if ($this->form_validation->run()) { //Se ejecuta la validación de datos
                $datos_registro = $this->input->post(null, true);
                if (empty($actividad_docente)) {//insertar nueva actividad
                    $empleado = $this->cg->getDatos_empleado($result_id_user);
                    //Obtener identificador de empleado
                    if (!empty($empleado)) {
                        $actividad_docente_up['ANIOS_DEDICADOS'] = $datos_registro['actividad_anios_dedicados_docencia'];
                        $actividad_docente_up['EJER_PREDOMI_CVE'] = $datos_registro['ejercicio_predominante'];
//                        $actividad_docente_up['CURSO_PRINC_IMPARTE'] = $datos_registro['curso_principal_imapare'];
                        $actividad_docente_up['EMPLEADO_CVE'] = $empleado[0]['EMPLEADO_CVE']; //Asigna cve del empleado
                        $resultado = $this->adm->insert_actividad_docente_general($actividad_docente_up); //Inserta datos del docente
                        if ($resultado['return'] === -1) {//hubo un error a la hora de insertar un registro
                            $data['error'] = $string_values['error_insertar']; //Mensaje de que no encontro empleado
                            $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        } else {//Los datos se insertaron correctamente
                            $data['error'] = $string_values['succesfull_insertar']; //Mensaje de que los datos se insertaron correctamente
                            $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de éxito
                            //Datos de bitacora el actividad general del docente del usuario
                            $json = json_encode($resultado['parametros']);
                            $result = registro_bitacora($result_id_user, null, 'actividad_docente_gral', 'ACT_DOC_GRAL_CVE:' . $resultado['ACT_DOC_GRAL_CVE'], $json, 'insert');
                        }
                    } else {//No existe el empleado, manda un mensaje
                        $data['error'] = $this->lang->line('interface')['general']['msg_no_existe_empleado']; //Mensaje de que no encontro empleado
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    }
                } else {//Actualizar
                    //Preguntar si, existira mas de una actividad general por ususario, y si no, como se distingue 
                    $actividad_docente_up['ANIOS_DEDICADOS'] = $datos_registro['actividad_anios_dedicados_docencia'];
                    $actividad_docente_up['EJER_PREDOMI_CVE'] = $datos_registro['ejercicio_predominante'];
//                    $actividad_docente_up['CURSO_PRINC_IMPARTE'] = $datos_registro['curso_principal_imapare'];
                    $actividad_docente_up['EMPLEADO_CVE'] = $actividad_docente[0]['EMPLEADO_CVE']; //Asigna cve del empleado
                    $resultado = $this->adm->update_actividad_docente_general($actividad_docente_up); //Verifica si existe el ususario ya contiene datos de actividad
                    if ($resultado['return'] == -1) {//hubo un error a la hora de insertar un registro
                        $data['error'] = $string_values['error_actualizar']; //Mensaje de existio un error al actualizar los datos de actividad docente
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                    } else {//Los datos se insertaron correctamente
                        $data['error'] = $string_values['succesfull_actualizar']; //Mensaje de que los datos se actualizarón correctamente
                        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de éxito
//                        //Datos de bitacora el actividad general del docente del usuario
                        $json = json_encode($resultado['actualizados']);
                        $result = registro_bitacora($result_id_user, null, 'actividad_docente_gral', 'EMPLEADO_CVE', $json, 'update');
                    }
                }
//                $parse = json_encode($data);
//                echo $parse;
//                exit();
            }
        }

        $data['string_values'] = $string_values; //Array de textos que muestra el formulario para actividad
        //Carga catálogos según array, visto en config->general->catalogos_indexados 
        $data = carga_catalogos_censo(array(enum_ecg::cejercicio_predominante), $data); //Carga el catálogo de ejercicio predominante

        $data['actividad_docente'] = $actividad_docente; //

        if (!empty($actividad_docente)) {
//            pr($actividad_docente);
            $data['curso_principal'] = $actividad_docente[0]['CURSO_PRINC_IMPARTE']; //Identificador del curso principal 
            $data['curso_principal_entidad_contiene'] = $actividad_docente[0]['TIP_ACT_DOC_PRINCIPAL_CVE']; //Entidad que contiene el curso principal
            $data['datos_tabla_actividades_docente'] = $this->adm->get_actividades_docente($actividad_docente[0]['ACT_DOC_GRAL_CVE']); //Datos de las tablas emp_actividad_docente, emp_educacion_distancia, emp_esp_medica
//            pr($data['datos_tabla_actividades_docente']);
        }

        $main_contet = $this->load->view('perfil/actividad_docente/actividad_tpl', $data, FALSE);
    }

    public function get_data_ajax_liscta_actividades() {
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $data['string_values'] = $string_values;
        if (!empty($actividad_docente)) {
//            pr($actividad_docente);
            $data['curso_principal'] = $actividad_docente[0]['CURSO_PRINC_IMPARTE']; //Identificador del curso principal 
            $data['curso_principal_entidad_contiene'] = $actividad_docente[0]['TIP_ACT_DOC_PRINCIPAL_CVE']; //Entidad que contiene el curso principal
            $data['datos_tabla_actividades_docente'] = $this->adm->get_actividades_docente($actividad_docente[0]['ACT_DOC_GRAL_CVE']); //Datos de las tablas emp_actividad_docente, emp_educacion_distancia, emp_esp_medica
        }
        echo $this->load->view('perfil/actividad_docente/tabla_actividades_docentes', $data, FALSE);
    }

    /**
     * author LEAS
     * Carga el modal con opciones de tipo de actividad tipo de actividad
     * @param type $insertar si "insertar" es igual con "0" muestra el combo que 
     * carga los tipos de actividad docente. Si "insertar" es mayor que "0"
     */
    public function get_data_ajax_actividad_modal($insertar = '0') {
        if ($this->input->is_ajax_request()) {
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar 
            $data_actividad['string_values'] = $string_values; //Crea la variable 
            $data_actividad['boton_guardar'] = 0;
            if ($this->input->post()) {//Después de cargar el formulario
                if ($this->input->post('tipo_actividad_docente', false) > 0) {
                    $data_actividad['boton_guardar'] = 1;
                }
            }

            if ($insertar === '0') {//Muestra el combo para seleccionar tipo de actividad docente 
                $tipo_actividad_docente = $this->cg->get_tipo_actividad_docente(); //Obtiene tipos de actividad del docente
                $data_actividad['tipo_actividad_docente'] = dropdown_options($tipo_actividad_docente, 'TIP_ACT_DOC_CVE', 'TIP_ACT_DOC_NOMBRE'); //Indicamos que muestré los siguientes datos index y descripción
            }

            $data = array(
                'titulo_modal' => 'Actividad docente',
                'cuerpo_modal' => $this->load->view('perfil/actividad_docente/actividad_modal_tpl', $data_actividad, TRUE),
            );
            echo $this->ventana_modal->carga_modal($data); //Carga los div de modal
        }
    }

    /**
     * @author LEAS
     * @param type $index_tipo_actividad_docente 
     */
    public function get_data_ajax_actividad_cuerpo_modal($index_tipo_actividad_docente = null, $combo = '0', $id_tipo_actividad = '0') {
        if ($this->input->is_ajax_request() && $index_tipo_actividad_docente != null) {//Si es un ajax
            $configuracion_formularios_actividad_docente = $this->config->item('actividad_docente_componentes')[$index_tipo_actividad_docente]; //Carga la configuración  del formularío
            $tipo_msg = $this->config->item('alert_msg');
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente']; //Carga textos a utilizar
            $datos['string_values'] = $string_values; //Almacena textos de actividad en el arreglo
            $valores['mostrar_hora_fecha_duracion'] = 0; //


            if ($this->input->post() AND $combo === '1') {
                $datos_registro = $this->input->post(null, true);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('form_ccl'); //Obtener validaciones de archivo
                $valores['mostrar_hora_fecha_duracion'] = $this->get_valor_validacion($datos_registro, 'duracion'); //Muestrá validaciones de hora y fecha de inicio y termino según la opción de duración
                $array_validaciones_extra_actividad = $configuracion_formularios_actividad_docente['validaciones_extra']; //Carga las validaciones extrá de archivo config->general que no se pudieron automatizar con el post, es decir radio button etc
                $result_validacion = $this->analiza_validacion($validations, $datos_registro, $array_validaciones_extra_actividad); //Genera las validaciones del formulario que realmente deben ser tomadas en cuenta
                $validations = $result_validacion['validacion'];
                $this->form_validation->set_rules($validations); //Carga las validaciones
//                pr($result_validacion['fechas']);
//                if (!empty($result_validacion['fechas'])) {//Si hay fechas que validar, se modifican los datos de fechas ya volteadas
//                    $this->form_validation->set_data($result_validacion['fechas']); //Carga las validaciones
//                }

                if ($this->form_validation->run()) {//Ejecuta validaciones
                    if ($id_tipo_actividad === '0') {//Guardar un nuevo registro
                        $result_guardar_actividad = $this->guardar_actividad($configuracion_formularios_actividad_docente, $datos_registro, array('TIP_ACT_DOC_CVE' => $index_tipo_actividad_docente));
//                        $result_guardar_actividad = -1;
                        $resultado = array();
                        if (is_array($result_guardar_actividad)) {//Se guardo correctamente, asignna mensaje success y registra en bitacora
                            $resultado['error'] = $this->lang->line('interface')['general']['datos_almacenados_correctamente']; //Mensaje de que no encontro empleado
                            $resultado['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                            //Guarda bitacora
                            //Datos de bitacora el actividad general del docente del usuario
                            $result_id_user = $this->session->userdata('identificador'); //Asigna id del usuario
                            $entity = $configuracion_formularios_actividad_docente['tabla_guardado'];
                            $pk = $configuracion_formularios_actividad_docente['llave_primaria'];
                            $index_pk = $result_guardar_actividad[$entity][$pk];
                            $json = json_encode($result_guardar_actividad);
                            $result = registro_bitacora($result_id_user, null, $entity, $pk . ":" . $index_pk, $json, 'insert');

                            //obtener datos del último registro guardado en la entidad correspondiente
                            $entidad_guardado = $configuracion_formularios_actividad_docente['tabla_guardado'];
//                            pr($entidad_guardado);
//                            pr( $result_guardar_actividad);
                            $rs = $this->adm->get_datos_actividad_docente($entidad_guardado, $index_pk);
//                            pr($rs);
                            $resultado['insertar'] = $rs;
                        } else {
                            $resultado['error'] = $this->lang->line('interface')['general']['error_guardar']; //Mensaje de que no encontro empleado
                            $resultado['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        }

                        echo json_encode($resultado);
                        exit();
                    } else {//Editar valor actividad docente especificada
                    }
                }
            }
            if ($index_tipo_actividad_docente > 0) {//Checa si debe aparecer el botòn de guardar 
                $valores['identificador'] = $index_tipo_actividad_docente;
                $datos['pie_pag'] = $this->load->view('perfil/actividad_docente/actividad_pie', $valores, true); //Carga la vista correspondiente al index
                //Carga catalogos 
                $datos = carga_catalogos_censo($configuracion_formularios_actividad_docente['catalogos_indexados'], $datos); //Carga los catálogos de la configuración
//            pr($datos);
                echo $this->load->view($configuracion_formularios_actividad_docente['vista'], $datos, TRUE); //Carga la vista correspondiente al index
            }
        }
    }

    /**
     * @author LEAS
     * @param type $validaciones
     * @param type $key
     * @return int
     */
    private function get_valor_validacion($validaciones, $key) {
        if (array_key_exists($key, $validaciones)) {
            return $validaciones[$key];
        }
        return 0;
    }

    /**
     * author LEAS
     * @param type $array_validacion
     * @param type $array_componentes
     * @param type $validacion_extra Las validaciones extra estan pensadas más 
     *             para "radio button" validaciones_extra, es un array de reglas 
     *             que se encuentrá en 
     * "config"->"general"->"actividad_docente_componentes"->"validaciones_extra"
     * y son de tipo textuales,
     * @return type
     */
    private function analiza_validacion($array_validacion, $array_componentes, $validacion_extra) {
//        pr($array_componentes);
//        pr($array_validacion);
        $array_result = array();
        foreach ($array_componentes as $key => $value) {
            switch ($key) {
                case 'fecha_inicio_pick'://No carga si no hasta duraciòn 
//                    $array_fechas['fecha_inicio_pick'] = date("Y-m-d", strtotime($value));
                    break;
                case 'fecha_fin_pick'://No carga si no hasta duraciòn
//                    $array_fechas['fecha_fin_pick'] = date("Y-m-d", strtotime($value));
                    break;
                case 'hora_dedicadas'://No carga si no hasta duraciòn
                    break;
                case 'duracion':
                    if ($value === 'hora_dedicadas') {
                        $array_result['validacion'][] = $array_validacion['hora_dedicadas'];
                    } else {//fechas_dedicadas
                        $array_result['validacion'][] = $array_validacion['fecha_inicio_pick'];
                        $array_result['validacion'][] = $array_validacion['fecha_fin_pick'];
                    }
                    break;
                default :
                    $array_result['validacion'][] = $array_validacion[$key];
            }
        }
        //Busca si existen validaciones extra
        foreach ($validacion_extra as $value_extra) {
            if (!array_key_exists($value_extra, $array_componentes)) {
                $array_result['validacion'][] = $array_validacion[$value_extra];
            }
        }
//        $array_result['fechas'] = $array_fechas;
//        pr($array_result);
        return $array_result;
    }

    /**
     * author LEAS
     * @param type $array_propiedades_actividad
     * @param array $arrar_datos_post
     * @param type $array_elementos_no_post
     * @param type $actividad_docente_general
     * @return type
     */
    private function guardar_actividad($array_propiedades_actividad, $arrar_datos_post = null, $array_elementos_no_post = NULL) {
        if (is_null($arrar_datos_post)) {//si es null returna -1 que indica que no se guardo 
            return -1;
        }
        $entidad_guardado = $array_propiedades_actividad['tabla_guardado']; //Se obtiene el nombre de la entidad de guardado
        $entidad_guardado_pk = $array_propiedades_actividad['llave_primaria']; //Se obtiene la llave primaria de la entidad de guardado
        //Asignar actividad docente general "actividad_docente_general" ********
        $result_id_user = $this->session->userdata('identificador');
        $actividad_docente_general = $this->adm->get_actividad_docente_general($result_id_user);
        if (empty($actividad_docente_general)) {
            return -1;
        } else {
            $arrar_datos_post['actividad_docente_general'] = $actividad_docente_general[0]['ACT_DOC_GRAL_CVE'];
        }
        //Guardar comprobante **************************************************
        if (array_key_exists('text_comprobante', $arrar_datos_post)) {
            $entidad_comprobante = $this->config->item('comprobante'); //Campos de la entidad comprobante del archivo general
            $array_comprobante = array();
            foreach ($entidad_comprobante as $key_com => $value_com) {
                $inser = $value_com['insert']; //Obtiene de archivo "general" los campos de comprobante
                $array_comprobante[$inser] = $arrar_datos_post[$key_com]; //Crea el array para guardar comprobante
            }
            //Guarda comprobante
            $index_comprobante = $this->modPerfil->insert_comprobante($array_comprobante); //Guardar valores en entidad
        }//*********************************************************************
        //Guardar actividad
        $array_entidad_guardado = $this->config->item($entidad_guardado); //Se obtiene los campos de la entidad donde se almacenarán los datos 
//        pr($entidad_guardado);
//        pr($arrar_datos_post);
//        pr($array_entidad_guardado);

        $campos_insert = array();
        $campos_insert['TIP_ACT_DOC_CVE'] = $array_elementos_no_post['TIP_ACT_DOC_CVE'];
        foreach ($arrar_datos_post as $key => $value) {//Genera array de campos y valores para insertar
            switch ($key) {
                case 'comprobante':
                    break;
                case 'ctipo_comprobante':
                    break;
                case 'text_comprobante':
                    if (isset($index_comprobante) && $index_comprobante > 0) {
                        //Asigna valor de comprobante
                        $keys_ = $array_entidad_guardado['comprobante']['insert'];
                        $campos_insert[$keys_] = $index_comprobante; //Asigna el valor de comprobante
                    }
                    break;
                case 'fecha_inicio_pick':
                    break;
                case 'fecha_fin_pick':
                    break;
                case 'duracion':
                    if ($value === 'hora_dedicadas') {
                        $keys_ = $array_entidad_guardado['hora_dedicadas']['insert'];
                        $campos_insert[$keys_] = $arrar_datos_post['hora_dedicadas'];
                    } else {
                        $keys_ = $array_entidad_guardado['fecha_inicio_pick']['insert'];
                        $campos_insert[$keys_] = $arrar_datos_post['fecha_inicio_pick'];
                        $keys_ = $array_entidad_guardado['fecha_fin_pick']['insert'];
                        $campos_insert[$keys_] = $arrar_datos_post['fecha_fin_pick'];
                    }
                    break;
                default :
                    $keys_ = $array_entidad_guardado[$key]['insert'];
                    $campos_insert[$keys_] = $value;
            }
        }

        //Agrega campos que no se optienen por post como tipo_actividad_cve 
        $result = $this->adm->insert_emp_actividad_docente_gen($entidad_guardado, $campos_insert, $entidad_guardado_pk); //Guardar valores en entidad
        return $result;
    }

    public function get_data_ajax_eliminar_actividad_modal() {
//        pr('tipo de actividad ' . $index_tp_actividad);
//        pr('tipo de actividad ' . $index_entidad);
//        pr('tipo de actividad ' . $is_cur_principal);
        $datos_registro = $this->input->post(null, true);
        //pr($datos_registro);  
        //exit();
        $propiedades_formulario_actividad = $this->config->item('actividad_docente_componentes')[$datos_registro['index_entidad']]; //Propiedades de la tabla de referencia
//        pr('tipo de actividad name entidad: ' . $propiedades_formulario_actividad['tabla_guardado']);
        $data = array();
        $tipo_msg = $this->config->item('alert_msg');
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['actividad_docente'];
        $result_id_user = $this->session->userdata('identificador'); //Asignamos id usuario a variable
        $texto_tipo_actividad = $propiedades_formulario_actividad['texto'];
//        if ($post === '1') {//Indica que debe intentar eliminar el curso
        if ($this->input->post()) {//Indica que debe intentar eliminar el curso
//            if ($this->form_validation->run()) {}
            $entidad_eliminacion = $propiedades_formulario_actividad['tabla_guardado'];
            $campo_where = $propiedades_formulario_actividad['llave_primaria'];
            $resul_delete = $this->adm->delete_actividad_docente($entidad_eliminacion, $campo_where, $datos_registro['index_tp_actividad']); //Verifica si existe el ususario ya contiene datos de actividad
            if ($resul_delete === -1) {//Manda mensaje de que no se pudo borrar el registro
                $valor_msj = str_replace('[field]', $texto_tipo_actividad, $string_values['error_eliminar']); //Agrega nombre de la actividad de docente
                $data['error'] = $valor_msj; //Mensaje de que no encontro empleado
                $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $this->output->set_status_header('400');
            } else {
                $valor_msj = str_replace('[field]', $texto_tipo_actividad, $string_values['succesfull_eliminar']); //Agrega nombre de la actividad de docente
                $data['error'] = $valor_msj; //Mensaje de que no encontro empleado
                $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $data['borrado_correcto'] = 1; //Tipo de mensaje de error
            }
            echo json_encode($data);
        }

//        $actividad_docente = $this->adm->get_actividad_docente_general($result_id_user); //Verifica si existe el ususario ya contiene datos de actividad
//        if (!empty($actividad_docente)) {//Verifica datos del usuario, es decir, que exista un registro en la tabla actividad_docente_gral
//            $data['actividad_general_cve'] = $actividad_docente[0]['ACT_DOC_GRAL_CVE'];
//            $data['index_tp_actividad'] = $index_tp_actividad; //Envía index de actividad a la vista 
//            $data['index_entidad'] = $index_entidad; //Envía index de entidad a la vista 
//            $data['is_cur_principal'] = $is_cur_principal; //Envía si es curso principal a la vista
//            if ($is_cur_principal === '1') {//Valida que no sea un curso principal
//                //Curso principal
//                $valor_msj = str_replace('[field]', $texto_tipo_actividad, $string_values['lbl_info_no_elimina_actividad_curso_principal']); //Agrega nombre de la actividad de docente
//                $data['error'] = $valor_msj; //Mensaje de que es curso principal, por lo tanto, no se puede eliminar la actividad 
//                $data['tipo_msg'] = $tipo_msg['WARNING']['class']; //Tipo de mensaje de error
//            } else {
//                //Confirmar que desea eliminar curso
//                $data['pregunta'] = str_replace('[field]', $texto_tipo_actividad, $string_values['lbl_pregunta_eliminar_actividad_docente']);
//            }
//        } else {
//            $data['error'] = $string_values['error_no_registro']; //Mensaje de que no encontró de actividad docente general para el usuario
//        }
//
//        $vista = array(
//            'titulo_modal' => 'Eliminar actividad docente',
//            'cuerpo_modal' => $this->load->view('perfil/actividad_docente/actividad_eliminar_tpl', $data, TRUE),
//        );
//        echo $this->ventana_modal->carga_modal($vista); //Carga los div de modal
    }

    public function get_data_ajax_actualiza_curso_principal() {
        if ($this->input->post()) {//Datos mandados por post
            $this->lang->load('interface', 'spanish');
            $string_values = $this->lang->line('interface')['actividad_docente'];
            $tipo_msg = $this->config->item('alert_msg');
            $value = $this->input->post(null, FALSE);
            $actividad_general_cve = str_replace("'", '', $value['actividad_general_cve']);
            $actividad_general_cve = str_replace("/", '', $actividad_general_cve);
            $index_tp_actividad = str_replace("'", '', $value['index_tp_actividad']);
            $index_tp_actividad = str_replace("/", '', $index_tp_actividad);
            $actividad_docente = str_replace("'", '', $value['actividad_docente_cve']);
            $actividad_docente = str_replace("/", '', $actividad_docente);

            $datos['ACT_DOC_GRAL_CVE'] = $actividad_general_cve;
            $datos['TIP_ACT_DOC_PRINCIPAL_CVE'] = $index_tp_actividad;
            $datos['CURSO_PRINC_IMPARTE'] = $actividad_docente;
//            pr($datos);
            $result = $this->adm->update_curso_principal_actividad_docente($datos);
//            pr($result);
            if ($result['return'] === 1) {
                $data['error'] = $string_values['save_curso_principal_modificado']; //
                $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                $data['result'] = 1; //Error resultado success
            } else if ($result['return'] < 0) {
                $data['error'] = $string_values['error_curso_principal_modificado']; //
                $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                $data['result'] = 0; //Error resultado mal
            } else {
                $this->output->set_status_header('400');
            }
//            pr(json_encode($data));
            echo json_encode($data);

            exit();
        }
    }

    private function verifica_curso_principal_actividad_docente($index_tp_actividad = '0', $index_entidad = '0', $id_user = '0') {
        if ($index_entidad === '0' || $index_tp_actividad = '0' || $id_user = '0') {
            return -1; //No es curso principal
        }
        $actividad_docente = $this->adm->get_actividad_docente_general($id_user); //Verifica si existe el ususario ya contiene datos de actividad
        if (!empty($actividad_docente)) {//Existe la actividad docente general
            $actividad_docente = $this->adm->get_verifica_curso_principal_actividad_general($index_tp_actividad, $index_entidad, $actividad_docente); //Verifica si es curso principal
        } else {
            return -1; //No es curso principal
        }
    }

    private function cargar_comprobante() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf';
        $config['max_size'] = '20000';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
        } else {

            $file_data = $this->upload->data();
            $file_path = './uploads/' . $file_data['file_name'];
        }
    }

}
