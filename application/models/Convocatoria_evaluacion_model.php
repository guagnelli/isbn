<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Convocatoria_evaluacion_model extends CI_Model {
	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

	/*public function get_convocatoria_evaluacion($params=null){
        $resultado = array();

        if(array_key_exists('fields', $params)){
            if(is_array($params['fields'])){
                $this->db->select($params['fields'][0], $params['fields'][1]);
            } else {
                $this->db->select($params['fields']);
            }
        }
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        if(array_key_exists('order', $params)){
            $this->db->order_by($params['order']);
        }
        
        $this->db->join('admin_dictamen_evaluacion', 'admin_validador.ADMIN_VALIDADOR_CVE=admin_dictamen_evaluacion.ADMIN_VALIDADOR_CVE', 'left');

        $query = $this->db->get('admin_validador'); //Obtener conjunto de registros
        pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }*/

    public function get_convocatoria_evaluacion($params=null){
        $resultado = array();

        if(array_key_exists('fields', $params)){
            if(is_array($params['fields'])){
                $this->db->select($params['fields'][0], $params['fields'][1]);
            } else {
                $this->db->select($params['fields']);
            }
        }
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        if(array_key_exists('order', $params)){
            $this->db->order_by($params['order']);
        }

        $query = $this->db->get('admin_validador'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_convocatoria_dictamen_evaluacion($params=null){
        $resultado = array();

        if(array_key_exists('fields', $params)){
            $this->db->select($params['fields']);
        }
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        if(array_key_exists('order', $params)){
            $this->db->order_by($params['order']);
        }

        $query = $this->db->get('admin_dictamen_evaluacion'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }
}
