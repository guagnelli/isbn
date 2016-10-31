<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {
    var $string_values;

	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        //$this->lang->load('interface_administracion');
        //$this->string_values = $this->lang->line('interface_administracion')['usuario']['model']; //Cargar textos utilizados en vista
    }

    public function get_solicitud_por_entidad($params=array()){
        $resultado = array();

        /*if(array_key_exists('fields', $params)){
            if(is_array($params['fields'])){
                $this->db->select($params['fields'][0], $params['fields'][1]);
            } else {
                $this->db->select($params['fields']);
            }
        }
        if(array_key_exists('order', $params)){
            $this->db->order_by($params['order']);
        }*/
        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        $this->db->select('COUNT(solicitud.id) as total, c_entidad.id, c_entidad.name');

        $this->db->group_by('c_entidad.id');

        $this->db->order_by('c_entidad.name');

        $this->db->join('solicitud', 'solicitud.entidad_id=c_entidad.id', 'left');

        $query = $this->db->get('c_entidad'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_solicitud_por_subcategoria($params=array()){
        $resultado = array();

        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        $this->db->select('COUNT(solicitud.id) as total, c_subcategoria.id, c_subcategoria.nombre as name');

        $this->db->group_by('c_subcategoria.id');

        $this->db->order_by('c_subcategoria.nombre');

        $this->db->join('solicitud', 'solicitud.id_subcategoria=c_subcategoria.id', 'left');

        $query = $this->db->get('c_subcategoria'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    /*public function get_solicitud_por_subsistema(){
        $resultado = array();

        $this->db->select('COUNT(solicitud.id) as total, c_subsistema.id, c_subsistema.name');

        $this->db->group_by('c_subsistema.id');

        $this->db->order_by('c_subsistema.name');

        $this->db->join('c_entidad', 'solicitud.entidad_id=c_entidad.id', 'left');
        $this->db->join('c_subsistema', 'c_entidad.subsistema_id=c_subsistema.id', 'left');

        $query = $this->db->get('solicitud'); //Obtener conjunto de registros
        
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }*/
    public function get_solicitud_por_subsistema($params=array()){
        $resultado = array();

        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }

        $this->db->select('COUNT(solicitud.id) as total, c_subsistema.id, c_subsistema.name');

        $this->db->group_by('c_subsistema.id');

        $this->db->order_by('c_subsistema.name');

        $this->db->join('c_entidad', 'c_entidad.subsistema_id=c_subsistema.id', 'left');
        $this->db->join('solicitud', 'solicitud.entidad_id=c_entidad.id', 'left');

        $query = $this->db->get('c_subsistema'); //Obtener conjunto de registros
        
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_solicitud_por_estado($params=array()){
        $resultado = array();

        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }

        $this->db->where('hist_revision_isbn.is_actual=1');

        $this->db->select('COUNT(solicitud.id) as total, c_estado.id, c_estado.name');

        $this->db->group_by('c_estado.id');

        $this->db->order_by('c_estado.id');

        $this->db->join('hist_revision_isbn', 'hist_revision_isbn.c_estado_id=c_estado.id', 'left');
        $this->db->join('solicitud', 'solicitud.id=hist_revision_isbn.solicitud_cve', 'left');

        $query = $this->db->get('c_estado'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }
}
/*///SELECT COUNT(s.solicitud_id) as total, su.subsistema_id, su.name FROM solicitud as s 
LEFT JOIN obra as o ON s.obra_id=o.obra_id 
LEFT JOIN subsistema as su ON o.subsistema_id=su.subsistema_id 
GROUP BY su.subsistema_id ORDER BY su.name*/