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
        //pr($this->session->userdata());

        if(!is_null($this->input->post()) && !empty($this->input->post())){ //Se verifica que se haya recibido información por método post
            $datos_formulario = $this->input->post(null, true); //Datos del formulario se envían para generar la consulta
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            
            $this->form_validation->set_rules($this->config->item('form_perfil')); //Agregar validaciones

            if(!empty($datos_formulario['contrasenia']) && !empty($datos_formulario['confirmacion'])) { 
            //Añadir opción en caso de ser edición y exista información en campo de contraseñia
                $this->form_validation->set_rules('contrasenia','Contraseña','alpha_numeric|max_length[30]|min_length[8]');
                $this->form_validation->set_rules('confirmacion','Confirmar contraseña','matches[contrasenia]');
            }

            if($this->form_validation->run() == TRUE){ //Validar datos
                $usu_vo = $this->usuario_vo($datos_formulario);
                if(!empty($datos_formulario['contrasenia'])) { //Añadir opción en caso de ser edición y exista información en campo de contraseñia
                    $usu_vo->usu_contrasenia = hash('sha512', $datos_formulario['contrasenia']); //aplica algoritmo de seguridad
                }

               $resultado = $this->perfil->update_usuario($usuario_id, $usu_vo); //Actualización de información
                if($resultado['result']===true){ //Almacenar en sesión
                    $this->session->set_userdata(array('nombre'=>$datos_formulario['nombre'], 'apaterno'=>$datos_formulario['apaterno'], 'amaterno'=>$datos_formulario['amaterno'], 'mail'=>$datos_formulario['correo'])); ///Si es correcto iniciamos sesión
                }
                $data['msg'] = imprimir_resultado($resultado); ///Muestra mensaje*/
                redirect('solicitud');
                //pr($datos_formulario);
            }/* else {
                pr(validation_errors());
            }*/
        }
        $data['dato_usuario'] = $this->perfil->get_usuario(array('conditions'=>array('usuario_cve'=>$usuario_id)))[0]; //Obtener datos
        
        $this->template->setMainContent($this->load->view('perfil/formulario', $data, TRUE));
        $this->template->getTemplate();
	}


    private function usuario_vo($usuario=array()){
        $result = new Usuario_dao;
        //$result->usu_nick = (isset($usuario['matricula']) && !empty($usuario['matricula'])) ? $usuario['matricula'] : NULL;
        //$result->usu_nombre = (isset($usuario['nombre']) && !empty($usuario['nombre'])) ? $usuario['nombre'] : NULL;
        $result->usu_paterno = (isset($usuario['apaterno']) && !empty($usuario['apaterno'])) ? $usuario['apaterno'] : NULL;
        $result->usu_materno = (isset($usuario['amaterno']) && !empty($usuario['amaterno'])) ? $usuario['amaterno'] : NULL;
        $result->usu_correo = (isset($usuario['correo']) && !empty($usuario['correo'])) ? $usuario['correo'] : NULL;
        //$result->usu_contrasenia = (isset($usuario['contrasenia']) && !empty($usuario['contrasenia'])) ? $usuario['contrasenia'] : NULL;
        
        return $result;
    }
}

class Usuario_dao {
    //public $usuario_cve;
    //public $usu_nick;
    //public $usu_nombre;
    public $usu_paterno;
    public $usu_materno;
    public $usu_correo;
    //public $usu_contrasenia;
    /*public $USU_CORREO_ALTERNATIVO;
    public $USU_TEL_LABORAL;
    public $USU_TEL_PARTICULAR;
    public $ESTADO_USUARIO_CVE;
    public $CESTADO_CIVIL_CVE;*/
}