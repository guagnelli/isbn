<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_generales extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    /**
     * 
     * @autor       : LEAS.
     * @Fecha       : 09052016.
     * @param array $parametros 'USUARIO_CVE', 'BIT_VALORES', 'MODULO_CVE', 'BIT_IP' 
     * y 'BIT_RUTA'
     * @return boolean Si se inserta el registro de bitacora con los parametros 
     * correspondientes. Devuelve 1 si todo se cumplio satisfactoriamente, si no, 
     * en el caso de que el usuario sea nullo o algo ocurrio en la base de datos, devuelve 0
     */
    public function set_bitacora_gral($parametros = null) {
        if (!isset($parametros)) {
            return false;
        }

        if (is_null($parametros)) {
            return false;
        }
        if (!isset($parametros['USUARIO_CVE']) || is_null($parametros['USUARIO_CVE'])) {
            return false;
        }
        if (!isset($parametros['BIT_OPERACION']) || is_null($parametros['BIT_OPERACION'])) {
            $parametros['BIT_OPERACION'] = 'NULL';
        }
        if (!isset($parametros['BIT_IP'])|| is_null($parametros['BIT_IP'])) {
            $parametros['BIT_IP'] = 'NULL';
        }
        if (!isset($parametros['BIT_RUTA'])|| is_null($parametros['BIT_RUTA'])) {
            $parametros['BIT_RUTA'] = 'NULL';
        }
        if (!isset($parametros['MODULO_CVE'])AND is_null($parametros['MODULO_CVE'])) {
            $parametros['MODULO_CVE'] = 'NULL';
        }
        if (!isset($parametros['ENTIDAD'])|| is_null($parametros['ENTIDAD'])) {
            $parametros['ENTIDAD'] = 'NULL';
        }
        if (!isset($parametros['REGISTRO_ENTIDAD_CVE'])|| is_null($parametros['REGISTRO_ENTIDAD_CVE'])) {
            $parametros['REGISTRO_ENTIDAD_CVE'] = 'NULL';
        }
        if (!isset($parametros['PARAMETROS_JSON']) || is_null($parametros['PARAMETROS_JSON'])) {
            $parametros['PARAMETROS_JSON'] = 'NULL';
        }
        $usuario_cve = $parametros['USUARIO_CVE'];
        $bit_operacion = $parametros['BIT_OPERACION'];
        $bit_ip = $parametros['BIT_IP'];
        $bit_ruta = $parametros['BIT_RUTA'];
        $modulo_cve = $parametros['MODULO_CVE'];
        $entidad = $parametros['ENTIDAD'];
        $registro_entidad_cve = $parametros['REGISTRO_ENTIDAD_CVE'];
        $parametros_json = $parametros['PARAMETROS_JSON'];
        $res = '@res';
        $this->db->reconnect();
        //genera la llamada al procedimiento
        $llamada = "call bitacora_ejecuta_historico($usuario_cve, '$bit_operacion', '$bit_ip', '$bit_ruta', $modulo_cve, '$entidad', '$registro_entidad_cve', '$parametros_json', $res )";
        $procedimiento = $this->db->query($llamada); //Ejecuta el procedimiento almacenado
        $resultado = isset($procedimiento->result()[0]->res);
        $resultado = $resultado && $procedimiento->result()[0]->res;
        $procedimiento->free_result(); //Libera el resultado
        $this->db->close();

        return $resultado;
    }

    /**
     * 
     * @param type $id_usuario identificador del usuario
     * 
     */
    public function getDatos_empleado($id_usuario) {
        $query = $this->db->where('USUARIO_CVE', $id_usuario); //Condicion del usuario 
        $query = $this->db->get('empleado'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "rist_delegacion"
     * 
     */
    public function getDelegaciones_rist() {
//        $this->db->select(array(''));
        $query = $this->db->get('rist_delegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cdelegacion" que es la 
     * tabla principal de delegaciones
     * 
     */
    public function getDelegaciones() {
//        $this->db->select(array(''));
        $query = $this->db->get('cdelegacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ccurso" 
     * 
     * 
     */
    public function get_ccurso() {
//        $this->db->select(array(''));
        $query = $this->db->get('ccurso'); //Obtener conjunto de registros
        $resultado = $query->result_array();

        $query->free_result(); //Libera la memoria
//        pr($resultado);
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_actividad_docente" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_tipo_actividad_docente() {
        $query = $this->db->get('ctipo_actividad_docente'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /////*******Checar campos
    /**
     * 
     * @return type array retorna los datos del catálogo "cmaterial" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmaterial() {
        $query = $this->db->get('cmaterial'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "licenciatura" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_licenciatura() {
        $query = $this->db->get('licenciatura'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cmodulo" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmodulo() {
        $query = $this->db->get('cmodulo'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "carea" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_carea() {
        $query = $this->db->get('carea'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cinstitucion_avala" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cinstitucion_avala() {
        $query = $this->db->get('cinstitucion_avala'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_crol_desempenia() {
        $query = $this->db->get('crol_desempenia'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_cmodalidad() {
        $query = $this->db->get('cmodalidad'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "crol_desempenia" 
     * "TIP_ACT_DOC_CVE"  y  "TIP_ACT_DOC_NOMBRE"
     * 
     */
    public function get_ctipo_comprobante() {
        $query = $this->db->get('ctipo_comprobante'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_especialidad" 
     * "TIP_ESP_MEDICA_CVE"  y  "TIP_ESP_MED_NOMBRE"
     * 
     */
    public function get_ctipo_especialidad() {
        $query = $this->db->get('ctipo_especialidad'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_especialidad" 
     * "TIP_FOR_PROF_CVE"  ,  "TIP_FOR_PRO_NOMBRE"   y "SUB_FOR_PRO_CVE"
     * 
     */
    public function get_ctipo_formacion_profesional() {
        $query = $this->db->get('ctipo_formacion_profesional'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_participacion" 
     * "TIP_PARTICIPACION_CVE"  ,  "TIP_PAR_NOMBRE" 
     * 
     */
    public function get_ctipo_participacion() {
        $query = $this->db->get('ctipo_participacion'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_participacion" 
     * "TIP_MATERIAL_CVE"  ,  "TIP_MAT_NOMBRE"  y "TIP_MAT_TIPO"
     * 
     */
    public function get_ctipo_material() {
        $query = $this->db->get('ctipo_material'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "ctipo_curso" 
     * "TIP_CURSO_CVE"  ,  "TIP_CUR_NOMBRE"
     * 
     */
    public function get_ctipo_curso() {
        $query = $this->db->get('ctipo_curso'); //Obtener conjunto de registros
        $resultado = $query->result_array();
        $query->free_result(); //Libera la memoria
        return $resultado;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "CESTADO_CIVIL_CVE"  ,  "EDO_CIV_NOMBRE"
     * 
     */
    public function get_cestado_civil() {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "EJE_PRO_CVE"  ,  "EJE_PRO_NOMBRE"
     * 
     */
    public function get_cejercicio_profesional() {
        $query = $this->db->get('cejercicio_profesional');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "EJER_PREDOMI_CVE"  ,  "EJE_PRE_NOMBRE"
     * 
     */
    public function get_cejercicio_predominante() {
        $query = $this->db->get('cejercicio_predominante');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

}
