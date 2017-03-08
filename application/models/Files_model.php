<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Files_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        //$this->config->load('general');
        $this->load->database();
    }

    function add_file($data = null){
    	if(is_null($data)){
    		return FALSE;
    	}
    	$this->db->trans_begin();
        	$this->db->insert("files", $data);
    		if ($this->db->affected_rows() > 0) {
    			$id = $this->db->insert_id();
    			$this->db->trans_commit();
    			return $id;
			}

        $this->db->trans_rollback();
		return FALSE;
    }
    function file_list($solicitud_id){
    	$this->db->where(array("solicitud_id"=>$solicitud_id));
    	$resp = $this->db->get("files");
    	$files =  $resp->result_array();
    	unset($resp);
    	return $files;
    }
    
    function delete($table = null, $where = array()) {
        if (is_null($table) || !is_array($where)) {
            return false;
        }
        $this->db->delete($table, $where);
        return true;
    }

    function get($id){
    	$this->db->where(array("id"=>$id));
    	$file = $this->db->get("files");
    	$file = $file->result_array();
    	if(count($file)==1){
    		return $file[0];
    	}else
    	return 0;
    }
}
?>