<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {
    var $string_values;

	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        //$this->lang->load('interface_administracion');
        //$this->string_values = $this->lang->line('interface_administracion')['usuario']['model']; //Cargar textos utilizados en vista
    }

    public function get_usuario($params=array()){
        $resultado = array();

        if(array_key_exists('conditions', $params)){
            $this->db->where($params['conditions']);
        }
        $this->db->join('rol', 'usuario.rol_cve=rol.rol_cve', 'left');

        $query = $this->db->get('usuario'); //Obtener conjunto de registros
        //pr($this->db->last_query());
        $resultado=$query->result_array();

        $query->free_result(); //Libera la memoria

        return $resultado;
    }
}