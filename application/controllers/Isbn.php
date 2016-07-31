<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Miguel Guagnelli
 */
class Isbn extends CI_Controller {

    /**
     * * Constructor
     * * Carga de clases para el acceso a base de datos y para la creación de elementos del formulario
     * * @access 		: public
     * * @modified 	: 
     */

    public function __construct() {
        parent::__construct();

        $this->load->database();
        $this->load->helper(array('form', 'captcha'));
        $this->load->library('form_complete');
        $this->load->library('form_validation');
        //$this->load->library('Bitacora');
        $this->load->model('Login_model', 'lm');
        $this->load->model('Request_model', 'req');
    }

    public function index(){
    	$data["list"] = $this->req->request_list();
    	$view_ = $this->load->view('isbn/index.tpl.php', $data, TRUE);
        $this->template->setMainContent($view_);
        //$this->template->setMainContent($imprime);*/
        $this->template->getTemplate();
    }

    public function new_reques(){

    }
}