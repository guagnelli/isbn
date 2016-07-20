<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona las solicitudes
 * @version 	: 1.0.0
 * @autor 		: Miguel Guagnelli
 */
class Solicitud extends MY_Controller {
    /**
     * Class Constructor
     */
    function __construct() {
        parent::__construct();
        $this->load->database();
		$this->load->helper('url');
		$this->load->library('Grocery_CRUD');
		$this->load->library('form_complete');
		$this->config->load("general");
    }
    
    function add(){
        try{
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('solicitud');
            
            $crud->set_relation('entidad_id','entidad','name');

			$output = $crud->render();
			$this->template->setMainContent($this->load->view('solicitud/index',$output,TRUE));
			$this->template->getTemplate();

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
    }
}