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

    public function get_solicitud_por_entidad(){
        $resultado = array();

        /*if(array_key_exists('fields', $params)){
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
        }*/
        $this->db->select('COUNT(solicitud.solicitud_id) as total, entidad.entidad_id, entidad.name');

        $this->db->group_by('entidad_id');

        $this->db->order_by('entidad.name');

        $this->db->join('entidad', 'solicitud.entidad_id=entidad.entidad_id', 'left');

        $query = $this->db->get('solicitud'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }

    public function get_solicitud_por_subsistema(){
        $resultado = array();

        $this->db->select('COUNT(solicitud.solicitud_id) as total, subsistema.subsistema_id, subsistema.name');

        $this->db->group_by('subsistema.subsistema_id');

        $this->db->order_by('subsistema.name');

        $this->db->join('obra', 'solicitud.obra_id=obra.obra_id', 'left');
        $this->db->join('subsistema', 'obra.subsistema_id=subsistema.subsistema_id', 'left');

        $query = $this->db->get('solicitud'); //Obtener conjunto de registros
        
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }
}
/*///SELECT COUNT(s.solicitud_id) as total, su.subsistema_id, su.name FROM solicitud as s 
LEFT JOIN obra as o ON s.obra_id=o.obra_id 
LEFT JOIN subsistema as su ON o.subsistema_id=su.subsistema_id 
GROUP BY su.subsistema_id ORDER BY su.name*/