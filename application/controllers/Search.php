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
        $this->load->config('secciones');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->model("Search_model", 'srch');
        $this->load->model("Solicitud_model", 'req');
        $this->tipo_obra = array("V"=>"Volúmen","C"=>"Completa","I"=>"Independiente");
    }
    
	public function result($inicio=null){
        $rol_cve = $this->session->userdata('rol_cve');
        $data = $this->input->get(NULL, TRUE); 
        //pr($data);
        $resultado = $this->req->get_solicitudes($data);
        
        //echo json_encode($resultado);
	}

    public function index(){
        //$this->limpia_varsesion();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['solicitud_index'];
        //$this->session->set_userdata('datos_usuario', $datos_usuario); //entidad
        
        $data["tipo_obra"] = $this->tipo_obra;
        $data["combos"]["categorias"] = $this->req->listCategoria();
        $main_contet = $this->load->view('solicitud/buscador/search_form.tpl.php', $data, true);
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    public function sections(){
        if ($this->input->is_ajax_request()) {
            //$data["fields"] = $this->config->item('cfg_solicitud');
            $data["fields"] = $this->req->get_sections_ext();
            $response['content'] = $this->load->view("solicitud/buscador/search_sections.tpl.php", $data, true);
            //echo $response["content"];
            echo json_encode($response);
            return 0;
        }else{
            redirect(site_url());
        }
    }
}
