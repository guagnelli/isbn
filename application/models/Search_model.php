<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search_model extends MY_Model {

    function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        // $ci = get_instance(); // CI_Loader instance
        $this->load->config('general');
        $this->load->database();
    }

    function get_solicitudes($params = null){
    	if(!is_null($params)){
    		$this->db->where($params);
    		$result = $this->db->get("v_solicitud");
            $conf_secciones = $this->config->item('conf_secciones');
    		return $result->result_array();
    	}
    }
}
?>