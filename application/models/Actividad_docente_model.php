<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Actividad_docente_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getGeneros() {
        
    }

    /**
     * 
     * @param int $usuario_id
     */
    public function get_actividad_docente_general($usuario_id) {
        $this->db->select(array('adg.ACT_DOC_GRAL_CVE', 'adg.ANIOS_DEDICADOS', 'adg.EJER_PREDOMI_CVE',
            'adg.EMPLEADO_CVE "EMPLEADO_CVE"', 'adg.CURSO_MAS_DEDICADO', 'adg.CURSO_PRINC_IMPARTE', 'adg.TIP_ACT_DOC_PRINCIPAL_CVE'));
        $this->db->from('actividad_docente_gral as adg');
        $this->db->join('empleado as em', 'em.EMPLEADO_CVE = adg.EMPLEADO_CVE');
        $this->db->where('em.USUARIO_CVE', $usuario_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_actividad_docente_general($datos_actividad_docente) {
        $result['return'] = -1;
        $result['parametros'] = '';
        if (is_null($datos_actividad_docente)) {
            return $result;
        }
        $this->db->insert('actividad_docente_gral', $datos_actividad_docente); //Almacena usuario
        $index += $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result['return'] = -1;
        } else {
            $datos_actividad_docente['ACT_DOC_GRAL_CVE'] = $index;
            $result['actualizados'] = $datos_actividad_docente;
        }
        return $result;
    }

    public function update_actividad_docente_general($datos_actividad_docente) {
        $result['return'] = -1;
        $result['actualizados'] = '';
        if (is_null($datos_actividad_docente)) {
            return $result;
        }
        //Actualiza
        $error = $this->db->where("EMPLEADO_CVE", $datos_actividad_docente['EMPLEADO_CVE']);
        $this->db->update('actividad_docente_gral', $datos_actividad_docente);
        pr($this->db->last_query());
        $result['return'] = 1;
        $result['actualizados'] = $datos_actividad_docente;
        return $result;
    }

    public function update_curso_principal_actividad_docente($datos_cur_principal = null) {
        $result['return'] = -1;
        $result['actualizados'] = '';
        if (is_null($datos_cur_principal)) {
            return $result;
        }
        //'\'
        
        //Actualiza
        $this->db->where("ACT_DOC_GRAL_CVE", $datos_cur_principal['ACT_DOC_GRAL_CVE']);
        $query = $this->db->update('actividad_docente_gral', $datos_cur_principal);
//        $num_row = $this->db->num_rows();
//        pr($query);
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $result['return'] = 0;
        }else{
            $result['return'] = 1;
            $result['actualizados'] = $datos_cur_principal;
        }
        return $result;
    }

    public function insert_emp_actividad_docente_gen($name_entidad = null, $array_campos, $pk) {
        if (is_null($name_entidad)) {
            return -1;
        }
        if (is_null($array_campos)) {
            return -1;
        }
        $this->db->insert($name_entidad, $array_campos); //Almacena tipo de actividad, según nombre de la entidad enviado
        $index = $obtiene_id_entidad_actividad_docente = $this->db->insert_id();
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            $array_campos[$pk] = $index;

            $result[$name_entidad] = $array_campos;
            return $result;
        }
    }

    /**
     * 
     * @param int $usuario_id
     */
    public function get_actividades_docente($actividad_docente_general_cve = null) {
        if (isset($actividad_docente_general_cve) AND is_nan($actividad_docente_general_cve)) {
            return -1;
        }
        //Entidad de emp_actividad_docente 
        $select_emp_actividad_docente = 'select ead.EMP_ACT_DOCENTE_CVE "cve_actividad_docente", ead.EAD_ANIO_CURSO "anio", ead.EAD_DURACION "duracion"
            ,ead.EAD_FCH_INICIO "fecha_inicio", ead.EAD_FCH_FIN "fecha_fin"
            ,ead.TIP_ACT_DOC_CVE "ta_cve", ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad", ead.ACT_DOC_GRAL_CVE "actividad_general_cve"  
            from emp_actividad_docente as ead
            inner join ctipo_actividad_docente as ctad on ctad.TIP_ACT_DOC_CVE = ead.TIP_ACT_DOC_CVE
            where ead.ACT_DOC_GRAL_CVE = ' . $actividad_docente_general_cve;
        //Entidad de emp_educacion_distancia 
        $select_emp_educacion_distancia = 'select eed.EMP_EDU_DISTANCIA_CVE "cve_actividad_docente", eed.EDD_CUR_ANIO "anio", eed.EED_DURACION "duracion"
            ,eed.EDD_FCH_INICIO "fecha_inicio", eed.EED_FCH_FIN "fecha_fin"
            ,eed.TIP_ACT_DOC_CVE "ta_cve", ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad", eed.ACT_DOC_GRAL_CVE "actividad_general_cve" 
            from emp_educacion_distancia as eed
            inner join ctipo_actividad_docente as ctad on ctad.TIP_ACT_DOC_CVE = eed.TIP_ACT_DOC_CVE
            where eed.ACT_DOC_GRAL_CVE = ' . $actividad_docente_general_cve;
        //Entidad de emp_esp_medica
        $select_emp_esp_medica = 'select esm.EMP_ESP_MEDICA_CVE "cve_actividad_docente", esm.EEM_ANIO_FUNGIO "anio", esm.EEM_DURACION "duracion"
            ,esm.EEM_FCH_INICIO "fecha_inicio", esm.EEM_FCH_FIN "fecha_fin"
            ,esm.TIP_ACT_DOC_CVE "ta_cve", ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad", esm.ACT_DOC_GRAL_CVE "actividad_general_cve"  
            from emp_esp_medica as esm
            inner join ctipo_actividad_docente as ctad on ctad.TIP_ACT_DOC_CVE = esm.TIP_ACT_DOC_CVE
            where esm.ACT_DOC_GRAL_CVE = ' . $actividad_docente_general_cve;

        $query = $this->db->query($select_emp_actividad_docente . " UNION " . $select_emp_educacion_distancia . " UNION " . $select_emp_esp_medica);
        return $query->result_array();
    }

    /**
     * 
     * @param type $entidad   Nombre de la entidad (emp_actividad_docente, emp_educacion_distancia o emp_esp_medica)
     * @param type $index_entidad 
     * @return type
     */
    public function get_datos_actividad_docente($entidad = null, $index_entidad) {
        if (isset($actividad_docente_general_cve) AND is_nan($actividad_docente_general_cve)) {
            return -1;
        }
        $select = null;
        $from = '';
        $where = '';
        $on = '';
        switch ($entidad) {
            case 'emp_actividad_docente':
                $select = array('ead.EMP_ACT_DOCENTE_CVE "cve_actividad_docente"', 'ead.EAD_ANIO_CURSO "anio"', 'ead.EAD_DURACION "duracion"'
                    , 'ead.EAD_FCH_INICIO "fecha_inicio"', 'ead.EAD_FCH_FIN "fecha_fin"'
                    , 'ead.TIP_ACT_DOC_CVE "ta_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad"', 'ead.ACT_DOC_GRAL_CVE "actividad_general_cve"');
                $from = 'emp_actividad_docente as ead';
                $where = 'ead.EMP_ACT_DOCENTE_CVE';
                $on = 'ctad.TIP_ACT_DOC_CVE = ead.TIP_ACT_DOC_CVE';
                break;
            case 'emp_educacion_distancia':
                $select = array('eed.EMP_EDU_DISTANCIA_CVE "cve_actividad_docente"', 'eed.EDD_CUR_ANIO "anio"', 'eed.EED_DURACION "duracion"'
                    , 'eed.EDD_FCH_INICIO "fecha_inicio"', 'eed.EED_FCH_FIN "fecha_fin"'
                    , 'eed.TIP_ACT_DOC_CVE "ta_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad"', 'eed.ACT_DOC_GRAL_CVE "actividad_general_cve"');
                $from = 'emp_educacion_distancia as eed';
                $where = 'eed.EMP_EDU_DISTANCIA_CVE';
                $on = 'ctad.TIP_ACT_DOC_CVE = eed.TIP_ACT_DOC_CVE';
                break;
            case 'emp_esp_medica':
                $select = array('esm.EMP_ESP_MEDICA_CVE "cve_actividad_docente"', 'esm.EEM_ANIO_FUNGIO "anio"', 'esm.EEM_DURACION "duracion"'
                    , 'esm.EEM_FCH_INICIO "fecha_inicio"', 'esm.EEM_FCH_FIN "fecha_fin"'
                    , 'esm.TIP_ACT_DOC_CVE "ta_cve"', 'ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad"', 'esm.ACT_DOC_GRAL_CVE "actividad_general_cve"');
                $from = 'emp_esp_medica as esm';
                $where = 'esm.EMP_ESP_MEDICA_CVE';
                $on = 'ctad.TIP_ACT_DOC_CVE = esm.TIP_ACT_DOC_CVE';
                break;
        }

        $this->db->select($select);
        $this->db->from($from);
        $this->db->join('ctipo_actividad_docente as ctad', $on);
        $this->db->where($where, $index_entidad);
        $query = $this->db->get();
//        pr($query->result_array());
        return $query->result_array();
    }

    /**
     * 
     * @param int $usuario_id
     */
//    public function get_actividades_docente($actividad_docente_general_cve = null) {
//        if (isset($actividad_docente_general_cve) AND is_nan($actividad_docente_general_cve)) {
//            return -1;
//        }
//        //Entidad de emp_actividad_docente 
//        $array_emp_actividad_docente = array('ead.EMP_ACT_DOCENTE_CVE "cve_actividad_docente"', 'ead.EAD_ANIO_CURSO "anio"'
//            , 'ead.EAD_DURACION "duracion"', 'ead.EAD_FCH_INICIO "fecha_inicio"', 'ead.EAD_FCH_FIN "fecha_fin"', 'ead.TIP_ACT_DOC_CVE "ta_cve"'
//            , 'ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad"', 'ead.ACT_DOC_GRAL_CVE "actividad_general_cve"');
//
//        //Entidad de emp_educacion_distancia 
//        $array_emp_educacion_distancia = array('eed.EMP_EDU_DISTANCIA_CVE "cve_actividad_docente"', 'eed.EDD_CUR_ANIO "anio"'
//            , 'eed.EED_DURACION "duracion"', 'eed.EED_DURACION "duracion"', 'eed.EDD_FCH_INICIO "fecha_inicio"', 'eed.EED_FCH_FIN "fecha_fin"', 'eed.TIP_ACT_DOC_CVE "ta_cve"'
//            , 'ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad"', 'eed.ACT_DOC_GRAL_CVE "actividad_general_cve"');
//
//        //Entidad de emp_esp_medica
//        $array_emp_esp_medica = array('esm.EMP_ESP_MEDICA_CVE "cve_actividad_docente"', 'esm.EEM_ANIO_FUNGIO "anio"'
//            , 'esm.EEM_DURACION "duracion"', 'esm.EEM_FCH_INICIO "fecha_inicio"', 'esm.EEM_FCH_FIN "fecha_fin"', 'esm.TIP_ACT_DOC_CVE "ta_cve"'
//            , 'ctad.TIP_ACT_DOC_NOMBRE "nombre_tp_actividad"', 'esm.ACT_DOC_GRAL_CVE "actividad_general_cve"');
//
//        $this->db->select($array_emp_actividad_docente);
//        $this->db->from('emp_actividad_docente as ead');
//        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = ead.TIP_ACT_DOC_CVE');
//        $this->db->where_in('ead.ACT_DOC_GRAL_CVE', $actividad_docente_general_cve);
////        $this->db->get();
//        $subQuery1 = $this->db->_compile_select();
////        $this->db->_reset_select();
//
//        $this->db->select($array_emp_educacion_distancia);
//        $this->db->from('emp_educacion_distancia as eed');
//        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = eed.TIP_ACT_DOC_CVE');
//        $this->db->where_in('eed.ACT_DOC_GRAL_CVE', $actividad_docente_general_cve);
////        $this->db->get();
//        $subQuery2 = $this->db->_compile_select();
////        $this->db->_reset_select();
//
//        $this->db->select($array_emp_esp_medica);
//        $this->db->from('emp_esp_medica as esm');
//        $this->db->join('ctipo_actividad_docente as ctad', 'ctad.TIP_ACT_DOC_CVE = esm.TIP_ACT_DOC_CVE');
//        $this->db->where_in('esm.ACT_DOC_GRAL_CVE', $actividad_docente_general_cve);
////        $this->db->get();
//        $subQuery3 = $this->db->_compile_select();
////        $this->db->_reset_select();
//
//        $this->db->query("select * from ($subQuery1 UNION $subQuery2 UNION $subQuery3) as union_actividad_docente");
//        $this->db->from("($subQuery1 UNION $subQuery2 UNION $subQuery3)");
//        $query = $this->db->get();
//
//        return $query->result_array();
//    }


    public function get_verifica_curso_principal_actividad_general($index_tp_actividad = null, $index_entidad = null, $index_actividad_general = null) {
        $this->db->select(array('*'));
        $this->db->from('actividad_docente_gral as adg');
        $this->db->where('TIP_ACT_DOC_PRINCIPAL_CVE', $index_tp_actividad);
        $this->db->where('CURSO_PRINC_IMPARTE', $index_entidad);
        $this->db->where('CURSO_PRINC_IMPARTE', $index_actividad_general);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function delete_actividad_docente($entidad = null, $campo_where = null, $id_registro = null) {
        if (is_null($entidad) || is_null($campo_where) || is_null($id_registro)) {
            return -1;
        }
        $this->db->where($campo_where, $id_registro);
        $this->db->delete($entidad);
        return 1;
    }

}
