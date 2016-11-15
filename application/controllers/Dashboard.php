<?php   defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona EL DASHBOARD
 * @version 	: 1.0.0
 * @autor 		: JZDP
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

        switch ($this->session->userdata('rol_cve')) {
            case E_rol::SUPERADMINISTRADOR: case E_rol::ADMINISTRADOR: case E_rol::DGAJ:
                $solicitud_x_entidad = $this->dashboard->get_solicitud_por_entidad(); //Total de solicitudes por entidad
                $solicitud_x_subsistema = $this->dashboard->get_solicitud_por_subsistema(); //Total de solicitudes por subsistema
                $solicitud_x_estado = $this->dashboard->get_solicitud_por_estado(); //Total de solicitudes por estado
                $solicitud_x_subcategoria = $this->dashboard->get_solicitud_por_subcategoria(); //Total de solicitudes por subcategoria
                break;
            case E_rol::ENTIDAD:
                /*$solicitud_x_entidad = $this->dashboard->get_solicitud_por_entidad(array('conditions'=>'c_entidad.id='.$this->session->userdata('entidad_id'))); //Total de solicitudes por entidad
                $solicitud_x_subsistema = $this->dashboard->get_solicitud_por_subsistema(array('conditions'=>'c_entidad.id='.$this->session->userdata('entidad_id'))); //Total de solicitudes por subsistema */
                $solicitud_x_entidad = array(); //Total de solicitudes por entidad
                $solicitud_x_subsistema = array(); //Total de solicitudes por subsistema
                $solicitud_x_estado = $this->dashboard->get_solicitud_por_estado(array('conditions'=>'solicitud.entidad_id='.$this->session->userdata('entidad_id'))); //Total de solicitudes por estado
                $solicitud_x_subcategoria = $this->dashboard->get_solicitud_por_subcategoria(array('conditions'=>'solicitud.entidad_id='.$this->session->userdata('entidad_id'))); //Total de solicitudes por subcategoria
            break;
        }
        $tipo_busqueda = $this->config->item('tipo_busqueda');
        $datos['solicitud_x_entidad'] = json_encode($this->get_json_grafica($solicitud_x_entidad, $tipo_busqueda[1]['id']));
        $datos['solicitud_x_subsistema'] = json_encode($this->get_json_grafica($solicitud_x_subsistema, $tipo_busqueda[2]['id']));
        $datos['solicitud_x_estado'] = json_encode($this->get_json_grafica($solicitud_x_estado, $tipo_busqueda[3]['id']));
        $datos['solicitud_x_subcategoria'] = json_encode($this->get_json_grafica($solicitud_x_subcategoria, $tipo_busqueda[4]['id']));
        
        $this->template->setMainContent($this->load->view('dashboard/dashboard', $datos, TRUE));
        $this->template->getTemplate();
	}

    private function get_json_grafica($datos, $tipo){
        $sxe_t = array();
        foreach ($datos as $key_sxe => $sxe) {
            $sxe_t[$key_sxe]['name'] = $sxe['name'];
            $sxe_t[$key_sxe]['y'] = intval($sxe['total']);
            $sxe_t[$key_sxe]['identificador'] = intval($sxe['id']);
            $sxe_t[$key_sxe]['tipo'] = $tipo;
        }
        return $sxe_t;
    }
}
