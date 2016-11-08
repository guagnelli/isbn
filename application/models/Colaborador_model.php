<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Colaborador_model extends MY_Model {

    function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        // $ci = get_instance(); // CI_Loader instance
        $this->load->config('general');
        $this->load->database();
    }

    function add(){
        
    }

    function list(){

    }

    function delete(){

    }
}