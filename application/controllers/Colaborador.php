<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona una solicitud
 * @version     : 1.0.0
 * @autor       : Mr. Guag 
 * 
 */
class Colaborador extends MY_Controller {
    
    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Catalogos_generales', 'cg');
    }

    

    function list_colaboradores(){
        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            $this->load->model('Solicitud_model', 'req');
            $data["list_colaboradores"] = $this->req->get_section("colaboradores",
                array("solicitud_id"=>$data["solicitud_id"]));
            $data["combos"]["c_nacionalidad"] = $this->cg->get_combo_catalogo("c_idioma");
            $data["combos"]["c_tipo"] = array("A"=>"Autor",
                                              "C"=>"Colaborador",
                                              "Ad"=>"Adaptador",
                                              ""=>"Sin selección");
            $response['content'] = $this->load->view("solicitud/secciones/sec_colab_list.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }
}