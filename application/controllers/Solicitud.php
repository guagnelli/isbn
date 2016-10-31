<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona una solicitud
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag 
 * 
 */
class Solicitud extends MY_Controller {

    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');

    }

    function index(){

    }

    function registrar(){
        $this->load->model("solicitud_model",'sol');
        $id_entidad = 1; //from session
        $id_categoria = null;
        $id_subcategoria = null;

        //si tiene datosbusca por id
        if($this->input->post()){
            $post = $this->input->post();
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('solicitud'); //Obtener validaciones de archivo 
            $this->form_validation->set_rules($validations); //Añadir validaciones
            //pr($post);
            $data["save"]=$post;
            
            if ($this->form_validation->run()) {
                //$data["datos"]["entidad"] = $this->sol->getEntidad($id_entidad);
                $data["save"]["solicitud"]["entidad_id"] = $id_entidad;
                $solicitud = $this->sol->addSolicitud(); 
                if(!$solicitud){
                    echo "no se ha podido guardar";
                }else{
                    redirect("solicitud/secciones/$solicitud");
                }
                //pr($data);
            }
            
        }

        $data["datos"]["categorias"] = $this->sol->listCategoria();
        $data["datos"]["sub_categorias"] = $this->sol->listSubCategoria($id_categoria);

        $main_contet = $this->load->view('solicitud/registrar.tpl.php', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    function secciones($solicitud){
        echo "soy las secciones de una solicitud";
    }

    function baja(){

    }

    function edicion(){

    }

    function detalle(){
        $this->load->model("Solicitud_model",'req');
        $solicitud = $this->req->getSolicitud(1);
        pr($solicitud);
    	$main_contet = $this->load->view('solicitud/detalle.tpl.php', null, true);
		$this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

}