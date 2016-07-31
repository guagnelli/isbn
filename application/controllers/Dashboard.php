<?php   defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona EL DASHBOARD
 * @version 	: 1.0.0
 * @autor 		: Pablo José D.
 */

class Dashboard extends CI_Controller {
    /**
     * Carga de clases para el acceso a base de datos y obtencion de las variables de session
	 * @access 		: public
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model', 'dashboard');
    }
    
    /**
     * Método que carga el formulario de búsqueda y el listado de publicaciones.
     * @autor 		: Jesús Díaz P.
	 * @modified 	: 
	 * @access 		: public
     */
    public function index()	{
        $this->config->load('general');

        $datos = array();
        $solicitud_x_entidad = $this->dashboard->get_solicitud_por_entidad(); //Total de solicitudes por entidad
        $solicitud_x_subsistema = $this->dashboard->get_solicitud_por_subsistema(); //Total de solicitudes por subsistema
        
        $datos['solicitud_x_entidad'] = json_encode($this->get_json_grafica($solicitud_x_entidad));
        $datos['solicitud_x_subsistema'] = json_encode($this->get_json_grafica($solicitud_x_subsistema));
        $this->template->setMainContent($this->load->view('dashboard/dashboard', $datos, TRUE));
        $this->template->getTemplate();
	}

    private function get_json_grafica($datos){
        $sxe_t = array();
        foreach ($datos as $key_sxe => $sxe) {
            $sxe_t[$key_sxe]['name'] = $sxe['name'];
            $sxe_t[$key_sxe]['y'] = intval($sxe['total']);
        }
        return $sxe_t;
    }
}
