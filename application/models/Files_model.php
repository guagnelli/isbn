<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        //$this->config->load('general');
        // $this->load->database();
    }

    function addFile(){}
    function file_list($solicitud_id){
    	$this->db->where(array("solicitud_id"=>$solicitud_id));
    	$resp = $this->db->get("files");
    	$files =  $resp->result_array();
    	unset($resp);
    	return $files;
    }
    function delFile(){}
}
?>