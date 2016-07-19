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
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');

        //$this->load->config('general');
    }
}