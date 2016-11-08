<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil_model extends CI_Model {
    var $string_values;

	public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
        $this->lang->load('interface');
        $this->string_values = $this->lang->line('interface')['general']; //Cargar textos utilizados en vista
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

    public function update_usuario($identificador, $datos) {
        $resultado = array('result' => null, 'msg' => '', 'data' => null);

        $this->db->trans_begin(); //Definir inicio de transacción
        $this->db->where('usuario_cve', $identificador);
        $this->db->update('usuario', $datos); //Inserción de registro

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $resultado['result'] = FALSE;
            $resultado['msg'] = $this->string_values['error'];
        } else {
            $this->db->trans_commit();
            $resultado['data']['identificador'] = $identificador;
            $resultado['msg'] = $this->string_values['actualizacion'];
            $resultado['result'] = TRUE;
        }

        return $resultado;
    }
}