<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Request_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->config->load('general');
        // $this->load->database();
    }

    public function request_list(){
    	$list = array("Soy una lista");
    	return $list;
    }

    public function get_request($request_id = null){
    	if(is_null($request_id)){
    		return null;
    	}
    	else{
    		$request = new Object();
    		return $request;
    	}
    }
}