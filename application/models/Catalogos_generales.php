<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogos_generales extends CI_Model {


    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    //******************************************************************************************************************
    /**
     * 
     * @return type array retorna los datos del catálogo "cestado_civil" 
     * "EJER_PREDOMI_CVE"  ,  "EJE_PRE_NOMBRE"
     * "AND", "OR", "HAVING()", OR_HAVING();
     */
    public function get_catalogo_general($entidad, $order_by, $array_where = null, $type_where = 'AND') {
//        pr($entidad . ' => ' . $type_where);
        if (!is_null($array_where)) {
            foreach ($array_where as $key => $value) {
                if (is_array($value)) {
                    switch ($type_where) {
                        case 'OR'://or in   
                            $this->db->or_where_in($key, $value);
                            break;
                        case 'NOTOR'://or not_in   
                            $this->db->where_not_in($key, $value);
                            break;
                        default :
//                            foreach ($value as $key => $value_prima) {
                            $this->db->where($value);
//                            }
                    }
                } else {
                    $this->db->where($key, $value);
                }
            }
        }
        $this->db->order_by($order_by);
        $query = $this->db->get($entidad);
        $estadoCivil = $query->result_array();
        $query->free_result();
//        pr($this->db->last_query());
        return $estadoCivil;
    }

    //******************************************************************************************************************
  

    /**
     * 
     * @param autor LEAS
     * @param type $array_campos
     * @return type
     */
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

    public function get_combo_catalogo($table, $field_key="id", $field_value="nombre",$conditions=null){
        
        if(!is_null($conditions) && is_array($conditions)){
            $this->db->where($conditions);
        }
        $this->db->select("$field_key,$field_value");
        //Seleccione una opción
        $catalogo = $this->db->get($table);
        //$options = array();
        
        foreach ($catalogo->result_array() as $key => $value) {
            $options[$value[$field_key]] = $value[$field_value];
        }
        $options[0]="Seleccione una opción";
        return $options;
    }
   
}
