<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getGeneros() {
        
    }

    /**
     * 
     * @return Array
     */
    public function getEstadoCivil() {
        $query = $this->db->get('cestado_civil');
        $estadoCivil = $query->result_array();
        $query->free_result();
        return $estadoCivil;
    }

    /**
     * 
     * @param int $identificador
     */
    public function getEmpleadoData($identificador) {
        $this->db->select(array(
            'EMP_NOMBRE as nombre',
            'EMP_APE_PATERNO as apellidoPaterno',
            'EMP_APE_MATERNO as apellidoMaterno',
            'EMP_CURP as curp',
            'EMP_EDAD as edad',
            'EMP_GENERO as generoSelected',
            'CESTADO_CIVIL_CVE as estadoCivilSelected',
            'EMP_EMAIL as correoElectronico',
            'EMP_TEL_PARTICULAR as telParticular',
            'EMP_TEL_LABORAL as telLaboral',
            'EMP_NUM_FUE_IMSS as empleosFueraImss',
            'EMP_MATRICULA as matricula',
            'DEL_NOMBRE as delegacion',
            'NOM_CATEGORIA as nombreCategoria',
            'EM.CATEGORIA_CVE as claveCategoria',
            'ADS_NOM_AREA as nombreAreaAdscripcion',
            'ADS_NOM_UNIDAD as nombreUnidadAdscripcion',
            'EM.ADSCRIPCION_CVE as claveAdscripcion',
            'TIP_CON_NOMBRE as tipoContratacion',
            'EMP_TEL_PARTICULAR as estatusEmpleado',
            'CP.PRE_NOMBRE as clavePresupuestal',
            ''
        ));
        $this->db->from('empleado AS EM');
        $this->db->join('cdelegacion AS CDEL', 'CDEL.DELEGACION_CVE = EM.DELEGACION_CVE', 'left');
        $this->db->join('ccategoria AS CCAT', 'CCAT.ID_CAT = EM.CATEGORIA_CVE', 'left');
        $this->db->join('adscripcion AS ADS', 'ADS.ADSCRIPCION_CVE = EM.ADSCRIPCION_CVE', 'left');
        $this->db->join('ctipo_contratacion AS CTC', 'EM.tip_contratacion_cve =  CTC.tip_contratacion_cve', 'left');
        $this->db->join('cdepartamento AS CD', 'CD.DEPARTAMENTO_CVE =  EM.DEPARTAMENTO_CVE', 'left');
        $this->db->join('cpresupuestal AS CP', 'CP.PRESUPUESTAL_CVE =  CD.PRESUPUESTAL_CVE  ', 'left');
        $this->db->where('EM.USUARIO_CVE', $identificador);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function insert_comprobante($array_campos) {
        if (is_null($array_campos)) {
            return -1;
        }
        $this->db->insert('comprobante', $array_campos); //Almacena usuario
        $obtiene_id_comprobante = $this->db->insert_id();
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            return $obtiene_id_comprobante;
        }
    }

}
