<?php   defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el perfil
 * @version 	: 1.0.0
 * @autor 		: JZDP
 */

class Perfil extends CI_Controller {
    /**
     * Carga de clases para el acceso a base de datos y obtencion de las variables de session
	 * @access 		: public
     */
    public function __construct() {
        parent::__construct();
        $this->load->library('form_complete');
        $this->load->model('Perfil_model', 'perfil');
    }
    
    /**
     * Método que carga el formulario de búsqueda y el listado de publicaciones.
     * @autor 		: Jesús Díaz P.
	 * @modified 	: 
	 * @access 		: public
     */
    public function index()	{
        $this->config->load('general');
        $this->load->library('form_validation');
        $this->lang->load('interface');
        $string_values = $this->lang->line('interface')['perfil'];
        $data['string_values'] = $string_values;
        $usuario_id = $this->session->userdata('identificador');
        pr($this->session->userdata());

        if(!is_null($this->input->post()) && !empty($this->input->post())){ //Se verifica que se haya recibido información por método post
            $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
            pr($datos_formulario);
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            
            $this->form_validation->set_rules('form_perfil');
            if(!empty($datos_formulario['contrasenia'])) { //Añadir opción en caso de ser edición y exista información en campo de contraseñia
                $this->form_validation->set_rules('contrasenia','Contraseña','callback_valid_pass|max_length[30]|min_length[8]');
            }
            if($this->form_validation->run() == TRUE){ //Validar datos
                /*$usu_vo->USU_CONTRASENIA = contrasenia_formato($usu_vo->USU_MATRICULA, $usu_vo->USU_CONTRASENIA);
                unset($usu_vo->USU_MATRICULA); //Se elimina matrícula porque no se actualiza en una edición
                if(empty($usu_vo->USU_CONTRASENIA)){ //Se elimina contraseña de objeto si se envía vacía
                    unset($usu_vo->USU_CONTRASENIA);
                }*/
                $password_encrypt = hash('sha512', $password); //aplica algoritmo de seguridad

                $resultado = $this->perfil->update_usuario($usuario_id, $usu_vo); //Actualización de información
                $datos['msg'] = imprimir_resultado($resultado); ///Muestra mensaje
            }
        }
        $datos['dato_usuario'] = $this->perfil->get_usuario(array('conditions'=>array('usuario_cve'=>$usuario_id)))[0]; //Obtener datos
        
        $this->template->setMainContent($this->load->view('perfil/formulario', $data, TRUE));
        $this->template->getTemplate();
	}
}
