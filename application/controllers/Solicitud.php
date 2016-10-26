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
    }

    function index(){

    }

    function registrar(){

    }

    function baja(){

    }

    function edicion(){

    }

    function detalle(){
    	$main_contet = $this->load->view('solicitud/detalle.tpl.php', null, true);
		$this->template->multiligual = TRUE;
		$this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

}