<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona una solicitud
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag 
 * 
 */
class Search extends MY_Controller {
	function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->model("Solicitud_model", 'req');
        $this->tipo_obra = array("V"=>"Volúmen","C"=>"Completa","I"=>"Independiente");
    }
    
	public function index($inicio=null){
        $rol_cve = $this->session->userdata('rol_cve');
        $params = array("estado_cve"=>8,"periodo"=>1,"inicio"=>$inicio,'rol_seleccionado' => $rol_cve );
        $resultado = $this->req->get_buscar_solicitudes($params);
        echo json_encode($resultado);
	}
}
