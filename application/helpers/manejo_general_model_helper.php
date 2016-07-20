<?php

/**
 * Método que valida una variable; que exista, no sea nula o vacía
 * @autor 		: LEAS.
 * @modified 	: 
 * @param 		: mixed $valor Parámetro a validar
 * @return 		: bool. TRUE en caso de que exista, no sea vacía o nula de lo contrario devolverá FALSE
 */
if (!function_exists('carga_catalogos')) {

    function carga_catalogos_censo($array_catalogos = array(), $data = array()) {
        if (isset($array_catalogos) AND is_null($array_catalogos)) {
            $array_catalogos = array();
        }
        if (isset($data) AND is_null($data)) {
            $data = array();
        }
        $CI = & get_instance();
        $CI->load->model('Catalogos_generales', 'cg');
        $tmp_result = null;

        foreach ($array_catalogos as $index) {
            switch ($index) {
                case 1://cmodalidad
                    $tmp_result = $CI->cg->get_cmodalidad();
                    $data['cmodalidad'] = dropdown_options($tmp_result, 'MODALIDAD_CVE', 'MOD_NOMBRE');
                    break;
                case 2://licenciatura
                    $tmp_result = $CI->cg->get_licenciatura();
                    $data['licenciatura'] = dropdown_options($tmp_result, 'LICENCIATURA_CVE', 'LIC_NOMBRE');
                    break;
                case 3://cmodulo
                    $tmp_result = $CI->cg->get_cmodulo();
                    $data['cmodulo'] = dropdown_options($tmp_result, 'MODULO_CVE', 'MODULO_NOMBRE');
                    break;
                case 4://carea
                    $tmp_result = $CI->cg->get_carea();
                    $data['carea'] = dropdown_options($tmp_result, 'AREA_CVE', 'AREA_NOMBRE');
                    break;
                case 5://cmateria
                    $tmp_result = $CI->cg->get_cmateria();
                    $data['cmateria'] = dropdown_options($tmp_result, 'MATERIA_CVE', 'MATERIA_NOMBRE');
                    break;
                case 6://ccurso
                    $tmp_result = $CI->cg->get_ccurso();
                    $data['ccurso'] = dropdown_options($tmp_result, 'CURSO_CVE', 'CUR_NOMBRE');
                    break;
                case 7://cinstitucion_avala
                    $tmp_result = $CI->cg->get_cinstitucion_avala();
                    $data['cinstitucion_avala'] = dropdown_options($tmp_result, 'INS_AVALA_CVE', 'IA_NOMBRE');
                    break;
                case 8://ctipo_actividad_docente
                    $tmp_result = $CI->cg->get_ctipo_actividad_docente();
                    $data['ctipo_actividad_docente'] = dropdown_options($tmp_result, 'TIP_ACT_DOC_CVE', 'TIP_ACT_DOC_NOMBRE');
                    break;
                case 9://crol_desempenia
                    $tmp_result = $CI->cg->get_crol_desempenia();
                    $data['crol_desempenia'] = dropdown_options($tmp_result, 'ROL_DESEMPENIA_CVE', 'ROL_DESEMPENIA');
                    break;
                case 10://ctipo_comprobante
                    $tmp_result = $CI->cg->get_ctipo_comprobante();
                    $data['ctipo_comprobante'] = dropdown_options($tmp_result, 'TIPO_COMPROBANTE_CVE', 'TIP_COM_NOMBRE');
                    break;
                case 11://ctipo_licenciatura
                    $tmp_result = $CI->cg->get_ctipo_licenciatura();
                    $data['ctipo_licenciatura'] = dropdown_options($tmp_result, 'TIP_LICENCIATURA_CVE', 'TIP_LIC_NOMBRE');
                    break;
                case 12://ctipo_curso
                    $tmp_result = $CI->cg->get_ctipo_curso();
                    $data['ctipo_curso'] = dropdown_options($tmp_result, 'TIP_CURSO_CVE', 'TIP_CUR_NOMBRE');
//                    pr($tmp_result);
                    break;
                case 13://ctipo_especialidad
                    $tmp_result = $CI->cg->get_ctipo_especialidad();
                    $data['ctipo_especialidad'] = dropdown_options($tmp_result, 'TIP_ESP_MEDICA_CVE', 'TIP_ESP_MED_NOMBRE');
                    break;
                case 14://ctipo_formacion_profesional
                    $tmp_result = $CI->cg->get_ctipo_formacion_profesional();
                    $data['ctipo_formacion_profesional'] = dropdown_options($tmp_result, 'TIP_FOR_PROF_CVE', 'TIP_FOR_PRO_NOMBRE');
                case 15://ctipo_participacion
                    $tmp_result = $CI->cg->get_ctipo_participacion();
                    $data['ctipo_participacion'] = dropdown_options($tmp_result, 'TIP_PARTICIPACION_CVE', 'TIP_PAR_NOMBRE');
                    break;
                case 16://ctipo_material
                    $tmp_result = $CI->cg->get_ctipo_material();
                    $data['ctipo_material'] = dropdown_options($tmp_result, 'TIP_MATERIAL_CVE', 'TIP_MAT_NOMBRE');
                    break;
                case 17://ctipo_material
                    $tmp_result = $CI->cg->get_cestado_civil();
                    $data['cestado_civil'] = dropdown_options($tmp_result, 'CESTADO_CIVIL_CVE', 'EDO_CIV_NOMBRE');
                    break;
                case 18://cejercicio_predominante
                    $tmp_result = $CI->cg->get_cejercicio_predominante();
                    $data['cejercicio_predominante'] = dropdown_options($tmp_result, 'EJER_PREDOMI_CVE', 'EJE_PRE_NOMBRE');
                    break;
                case 19://cejercicio_profesional
                    $tmp_result = $CI->cg->get_cejercicio_profesional();
                    $data['cejercicio_profesional'] = dropdown_options($tmp_result, 'EJE_PRO_CVE', 'EJE_PRO_NOMBRE');
                    break;
            }
        }
        return $data;
    }

}


if (!function_exists('registro_bitacora')) {

    /**
     * @autor : LEAS
     * @param type $usuario_cve : identificador del usuario que hizo la modificación
     * @param type $ruta : Ruta (controlador) donde se efectuo el cambio
     * @param type $entidad
     * @param type $reg_entidad_cve
     * @param type $parametros_json
     * @param type $operacion
     * @return type
     */
    function registro_bitacora($usuario_cve = null, $ruta = null, $entidad = null, $reg_entidad_cve = null, $parametros_json = null, $operacion = null) {
        $CI = & get_instance();
        $CI->load->config('general');
        
        $parametros = $CI->config->item('parametros_bitacora');
        $parametros['USUARIO_CVE'] = $usuario_cve; //Asigna id del usuario
        $parametros['BIT_OPERACION'] = $operacion; //insert,update o delete
        if (is_null($ruta) AND empty($ruta)) {
            $parametros['BIT_RUTA'] = $_SERVER['REQUEST_URI'];//Obtiene la ruta URI actual 
        }
        // Obtener ip del cliente
        $parametros['BIT_IP'] = get_ip_cliente(); //Le manda la ip del cliente
        $parametros['ENTIDAD'] = $entidad; //Le manda la ip del cliente
        $parametros['REGISTRO_ENTIDAD_CVE'] = $reg_entidad_cve; //Id del registro agregado, modificado 
        $parametros['PARAMETROS_JSON'] = $parametros_json; //Le manda valor de json

        $CI->load->model('Catalogos_generales', 'cg');
        $result = $CI->cg->set_bitacora_gral($parametros); //Invoca la función para guardar bitacora
        return $result;
    }

}
    