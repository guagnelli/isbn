<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Clase que contiene métodos para verificación de accesos al sitio
 * @version 	: 1.0.0
 * @author      : PABLO JOSÉ
 **/
class Mi_solicitud extends MY_Controller {

	function __construct(){
		parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('Seguridad');
        $this->load->model('Solicitud_model','mod_solicitud');
        $this->config->load('general');
	}

	/***********Página de inicio
    * aqui buscaremos las convocatorias que esten activas, solo es una por cierto periodo
    *Función que determina el tipo de usuario y lo dirige a su página de bienvenida
    *@method: void index()
    */
	public function index($solicitud_base64=null){
        $error = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){            
            $solicitud_completa = $this->construir_solicitud($validacion['ids']);
            $solicitud_completa['ac_li'] = array('class="active"','','','','');
            $solicitud_completa['ac_tab'] = array('active','','','','');
            $solicitud_completa['num_solicitud'] = $validacion['ids']['solicitud_id'];
            
            $contenido = $this->load->view("solicitud/solicitud.php", $solicitud_completa, true);
        } else {
            $contenido = $validacion['error'];
        }
        
        $this->template->setTitle("Solicitud");
        $this->template->setMainContent($contenido);
        $this->template->getTemplate();
	}

    /**
     * Método que valida el identificador de la solicitud
     * @param   string      $solicitud_base64   Identificador en base64.
     * @param   string      $solicitud_encrypt  Identificador encriptado en sha512.
     * @return  array       $resultado          En caso de que sean correctos se envían los identificadores, de lo contrario un mensaje de error.
    **/
    private function validacion_identificador_solicitud($solicitud_base64, $solicitud_encrypt){
        $resultado = array('resultado'=>false, 'error'=>'', 'ids'=>array());
        if(exist_and_not_null($solicitud_base64) && exist_and_not_null($solicitud_encrypt)){ //Validamos que no sea vacío el identificador
            $solicitud_id = (int)$this->seguridad->decrypt_base64($solicitud_base64); ///Convertimos a entero identificador codificado
            if($this->seguridad->encrypt_sha512($this->config->item('salt').$solicitud_id)==$solicitud_encrypt){ //Realizar comprobación de identificadores
                $resultado['resultado'] = true;
                $resultado['ids']['solicitud_id']=$solicitud_id;
                $resultado['ids']['solicitud_encrypt']=$solicitud_encrypt;
                $resultado['ids']['solicitud_base64']=$solicitud_base64;
            } else {
                $resultado['error'] = html_message("Solicitud incorrecta.")."<br><br>";
            }
        } else {
            $resultado['error'] = html_message("Solicitud incorrecta.")."<br><br>";
        }
        return $resultado;
    }

    private function construir_solicitud_contacto($solicitud, $datos_error=null){
        $data_inf = $this->mod_solicitud->mostrar_datos_inf_contacto($solicitud); //Obtener información de contacto
        $df = $this->mod_solicitud->mostrar_datos_fam_contacto($solicitud);
        $data_fam = (isset($df['0'])) ? $df[0] : null;
        if(exist_and_not_null($data_inf)){
            foreach ($data_inf as $key_ic => $inf_contacto) {
                $data_inf['inf_contacto'][$inf_contacto['ic_nom_tipo']]=$inf_contacto;
            }
        }
        if(isset($datos_error['contacto']) && !empty($datos_error['contacto'])){
            $data_fam['fc_nombre'] = $datos_error['contacto']['inf_nom_fam'];
            $data_fam['fc_parentesco'] = $datos_error['contacto']['inf_tel_fam'];
            $data_fam['fc_tel'] = $datos_error['contacto']['inf_parentesco_fam'];
            $data_fam['fc_email'] = $datos_error['contacto']['inf_email_fam'];
        }
        return array('inf'=>$data_inf,'fam'=>$data_fam,'tipos'=>$this->config->item('informacion_contacto'));
    }

    private function construir_solicitud_aplicacion($aplicacion_id, $datos_error=null){        
        $da = $this->mod_solicitud->mostrar_datos_aplicacion($aplicacion_id);
        $data_aplicacion = $da[0];
        if(isset($datos_error['aplicacion']) && !empty($datos_error['aplicacion'])){
            $data_aplicacion['ap_programa'] = $datos_error['aplicacion']['app_nombre'];
            $data_aplicacion['ap_institucion'] = $datos_error['aplicacion']['app_institucion'];
            $data_aplicacion['ap_ubicacion'] = $datos_error['aplicacion']['app_ubicacion'];
            $data_aplicacion['ap_inicio'] = $datos_error['aplicacion']['app_inicio'];
            $data_aplicacion['ap_termino'] = $datos_error['aplicacion']['app_termino'];
        }
        return $data_aplicacion;
    }

    private function construir_solicitud_escolar($solicitud, $datos_error=null){
        $de = $this->mod_solicitud->mostrar_datos_escolar($solicitud);

        $data_escolar = $de[0];
        if(isset($datos_error['escolar']) && !empty($datos_error['escolar'])){
            $data_escolar['tipo_usuario_id'] = $datos_error['escolar']['tipouser'];
            $data_escolar['institucion_id'] = $datos_error['escolar']['inst'];
            $data_escolar['esc_promedio'] = $datos_error['escolar']['prom'];
            $data_escolar['especialidad_id'] = $datos_error['escolar']['especialidad'];
            $data_escolar['esc_materia'] = $datos_error['escolar']['materia'];
            $data_escolar['esc_nivel'] = $datos_error['escolar']['nivel_academico'];
            $data_escolar['esc_horas'] = $datos_error['escolar']['hrs'];
            $data_escolar['tipo_profesor'] = $datos_error['escolar']['tipo_profesor'];
            $data_escolar['otra_especialidad'] = $datos_error['escolar']['otra_especialidad'];
        }
        return $data_escolar;
    }

    public function construir_solicitud($identificadores, $datos_error=null) {
        if(!empty($identificadores)){
            $this->load->library('Seguridad');
            $this->load->model("Escolar_modelo","escolar");
            $solicitud = $identificadores['solicitud_id'];
            ////////////////////////////////// Solicitud ////////////////////////////////
            $data_aplicacion = $data_escolar = $data_documentacion = array();
            $data_solicitud = $this->extract_data($this->mod_solicitud->mostrar_datos_solicitud($solicitud)); //Formato a los datos de solicitud
            
            if(exist_and_not_null($data_solicitud)){
                ////////////////////////////////// Contacto ////////////////////////////////
                $data_contacto = $this->construir_solicitud_contacto($solicitud, $datos_error);
                ////////////////////////////////// Aplicación //////////////////////////////
                if(exist_and_not_null_array($data_solicitud, 'aplicacion_id')){ //En caso de tener aplicación asociada se obtiene información
                    $data_aplicacion = $this->construir_solicitud_aplicacion($data_solicitud['aplicacion_id'], $datos_error);
                }
                ////////////////////////////////// Escolar /////////////////////////////////
                $data_escolar['escolar'] = $this->construir_solicitud_escolar($solicitud, $datos_error);
                ////////////////////////////// Documentación //////////////////////////////
                $data_documentacion['requerida'] = (exist_and_not_null_array($data_solicitud, 'modalidad_id')) ? $this->documentacion_requerida($data_solicitud['modalidad_id']) : null;
                $data_documentacion['documentacion_por_solicitud'] = $this->documentacion_por_solicitud($solicitud);
                ////Se envían identificadores a todas las vistas
                $data_arch_validacion = $data_solicitud['ids'] = $data_contacto['ids'] = $data_aplicacion['ids'] = $data_escolar['ids'] = $data_documentacion['ids'] = $identificadores;

                ////////////////////////////////// Vistas //////////////////////////////////
                $solicitud_completa['datos_solicitud']=$this->load->view("solicitud/vista_datos_solicitud.php",$data_solicitud,true);
                $solicitud_estado = $this->config->item('solicitud_estado');
                $tipo_profesores = $this->config->item('tipo_profesores');
                $tipo_admin_sess = $this->session->userdata('tipo_admin');
                $tipo_admin_conf = $this->config->item('tipo_admin');                
                
                if(($data_solicitud['est_sol_id']==$solicitud_estado['creacion']['id'] || $data_solicitud['est_sol_id']==$solicitud_estado['correcion']['id']) && $tipo_admin_conf!=$tipo_admin_sess){ //Si esta en creación se muestra formulario de edición
                    $data_escolar['tipo_usuario'] = $this->escolar->lst_tipo_usuario(); ///Catálogos
                    $data_escolar['institucion'] = $this->escolar->lst_inst_ads();
                    $data_escolar['especialidad'] = $this->escolar->lst_especialidades();
                    $data_escolar['tipo_profesores'] = $tipo_profesores;
                    $data_escolar['escolar']['otra_especialidad'] = $data_solicitud['otra_especialidad'];
                    
                    $solicitud_completa['datos_solicitud']=$this->load->view("solicitud/update_datos_solicitud.php",$data_solicitud,true);
                    $solicitud_completa['info_contacto'] = $this->load->view("solicitud/registro_info_contacto",$data_contacto,true);
                    $solicitud_completa['aplicacion']=$this->load->view("solicitud/registro_aplicacion",$data_aplicacion,true);
                    $solicitud_completa['escolar']=$this->load->view("solicitud/registro_escolar",$data_escolar,true);
                    $solicitud_completa['documentacion']=$this->load->view("solicitud/registro_documentacion",$data_documentacion,true);
                } else { //Formulario detalle (No edición)
                    $data_escolar['escolar']['otra_especialidad'] = $data_solicitud['otra_especialidad'];
                    $data_escolar['tipo_usuario'] = $this->escolar->lst_tipo_usuario(array('conditions'=>array('tipo_usuario_id'=>$data_escolar['escolar']['tipo_usuario_id']))); ///Catálogos
                    $data_escolar['institucion'] = $this->escolar->lst_inst_ads(array('conditions'=>array('institucion_id'=>$data_escolar['escolar']['institucion_id'])));
                    $data_escolar['especialidad'] = $this->escolar->lst_especialidades(array('conditions'=>array('esp_id'=>$data_escolar['escolar']['especialidad_id'])));
                    $data_escolar['tipo_profesores'] = (isset($data_escolar['escolar']['tipo_profesor'])) ? $tipo_profesores[$data_escolar['escolar']['tipo_profesor']] : "";
                    
                    
                    $solicitud_completa['datos_solicitud']=$this->load->view("solicitud/vista_datos_solicitud.php",$data_solicitud,true);
                    $solicitud_completa['info_contacto'] = $this->load->view("solicitud/vista_info_contacto",$data_contacto,true);
                    $solicitud_completa['aplicacion']=$this->load->view("solicitud/vista_aplicacion",$data_aplicacion,true);
                    $solicitud_completa['escolar']=$this->load->view("solicitud/vista_escolar",$data_escolar,true);
                    
                    if($data_solicitud['est_sol_id']==$solicitud_estado['validacion']['id'] && $tipo_admin_conf==$tipo_admin_sess){
                        $archivos_validacion['num_solicitud'] = $solicitud;
                        $data_arch_validacion['archivos'] = $this->mod_solicitud->listado_archivos($archivos_validacion);
                        $solicitud_completa['documentacion']=$this->load->view("solicitud/resultado_archivos",$data_arch_validacion,true);
                
                    }else{
                        $solicitud_completa['documentacion']=$this->load->view("solicitud/vista_documentacion",$data_documentacion,true);
                    }
                }
                $solicitud_completa['folio'] = $data_solicitud['s_folio'];

                return $solicitud_completa;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    private function extract_data($data_solicitud) {
        //pr($data_solicitud);
        $genero = $this->config->item('genero');
        $resultado = $data_solicitud[0];
        $resultado['genero'] = ($resultado['asp_sexo'] == $genero['femenino']['id']) ? $genero['femenino']['label'] : $genero['masculino']['label'];
        return $resultado;
    }

    public function postulacion($solicitud_base64){
        $error = $msg = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $solicitud_estado = $this->config->item('solicitud_estado');
            $datos_error = null;
            ////////////////////////////////// Solicitud ////////////////////////////////
            $datos['aplicacion'] = array();
            $datos['solicitud'] = $this->extract_data($this->mod_solicitud->mostrar_datos_solicitud($validacion['ids']['solicitud_id'])); //Formato a los datos de solicitud
            if(!empty($datos['solicitud'])) { //Verificar que exista solicitud
                ////////////////////////////////// Aplicación //////////////////////////////
                if(exist_and_not_null_array($datos['solicitud'], 'aplicacion_id')){ //En caso de tener aplicación asociada se obtiene información
                    $datos['aplicacion'] = $this->construir_solicitud_aplicacion($datos['solicitud']['aplicacion_id']);
                }
                //pr($datos['solicitud']);
                if($this->input->post() && $datos['solicitud']['est_sol_id'] == $solicitud_estado['completa']['id']){ ///Solo almacenar en caso de que el estado de la solicitud sea aceptado
                    $this->config->load('form_validation'); // Cargar archivo con validaciones
                    $validations = $this->config->item('reg_postulacion'); // Obtener validaciones de archivo
                    $tipo_beca = $this->config->item('tipo_beca');
                    
                    $this->form_validation->set_rules($validations);

                    if($tipo_beca['sep']['id']==$datos['solicitud']['tipo_beca_id']){ ///En caso de que la beca sea de tipo SEP, el itinerario será obligatorio 
                        $this->form_validation->set_rules('fecha_inicio', 'Itinerario de partida', 'required|max_length[100]|alpha_numeric_accent_space_dot_double_quot');
                        $this->form_validation->set_rules('fecha_fin', 'Itinerario de regreso', 'required|max_length[100]|alpha_numeric_accent_space_dot_double_quot');
                    }

                    $inf_it = $this->input->post(null, true); //Cargamos el array post en una variable
                    if($this->form_validation->run() == TRUE){
                        $inf_itinerario['oficio']['solicitud_id'] = $validacion['ids']['solicitud_id'];
                        $inf_itinerario['oficio']['responsable_id'] = $this->config->item('responsable_id'); ///Identificador del responsable (Fase 1, será fijo 'Dr. Cazares')
                        $inf_itinerario['oficio']['formato_id']= $this->config->item('formato_id');
                        $inf_itinerario['oficio']['ofi_folio']= $inf_it['oficio'];
                        $inf_itinerario['solicitud']['sol_itinerario_fch1']= $inf_it['fecha_inicio'];
                        $inf_itinerario['solicitud']['sol_itinerario_fch2']= $inf_it['fecha_fin'];
                        $inf_itinerario['solicitud']['est_sol_id']= $solicitud_estado['postulado']['id'];
                        $inf_itinerario['mov_solicitud']['mov_estado']= $solicitud_estado['postulado']['id'];
                        $inf_itinerario['mov_solicitud']['mov_comentario']= null;
                        $inf_itinerario['mov_solicitud']['num_solicitud']= $validacion['ids']['solicitud_id'];
                        
                        $guardar_informacion = $this->mod_solicitud->guarda_info_itinerario($inf_itinerario);
                        if($guardar_informacion['result'] == true){
                            
                            $msg = "Actualización correcta.";
                            $datos['solicitud'] = $this->extract_data($this->mod_solicitud->mostrar_datos_solicitud($validacion['ids']['solicitud_id'])); //Obtenemos datos actualizados
                            
                            $aspirante = $this->mod_solicitud->datos_aspirante_solicitud($validacion['ids']['solicitud_id']);
                            
                            $vista = $this->load->view('template/email/enviar_correo_postulacion_activa', null, true);
                            $subject = "Carta de postulación :: IMSS becas";
                                
                                $check_envio_correo = $this->enviar_correo($aspirante['data'], $vista, $subject);
                                if($check_envio_correo['result'] == true){
                                    $msg= 'Un mensaje fue enviado a la cuenta de correo del aspirante, para notificar que su carta de postulación ya esta activa.';
                                }else{
                                    $error = "Ocurrió un error durante el envío del correo, inténtelo más tarde.";
                                }
                                
                            
                        } else {
                            $error = "Ocurrió un error durante el almacenamiento de los datos, inténtelo más tarde.";
                        }
                    } else {
                        $datos_error['itinerario'] = $inf_it; //Datos introducidos por usuario
                    }
                } else {
                    //$error = "No se han enviado datos."; // = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
                }            
                $datos['ids'] = $validacion['ids'];
                $datos['error'] = $error;
                $datos['msg'] = $msg;
                switch ($datos['solicitud']['est_sol_id']) {
                    case $solicitud_estado['completa']['id']:
                        $contenido = $this->load->view("postulacion/postulacion_itinerario.php", $datos, true);
                        break;
                    case $solicitud_estado['postulado']['id']:
                        $data_oficio = $this->mod_solicitud->get_oficio(array('conditions'=>array('solicitud_id'=>$validacion['ids']['solicitud_id'])));
                        $datos['oficio'] = $data_oficio[0];
                        $contenido = $this->load->view("postulacion/postulacion_itinerario_vista.php", $datos, true);
                        break;
                    default:
                        $contenido = html_message("<p style='padding:15px;'>Imposible postular solicitud, estado de la solicitud incorrecto.</p>");
                    break;
                }
            } else {
                $contenido = html_message("<p style='padding:15px;'>Solicitud incorrecta.</p>");
            }
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Generar carta de postulacion");
        $this->template->getTemplate();
    }
    
    public function salvar_contacto($solicitud_base64){
        $error = $msg = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;
            if($this->input->post()){
                $this->config->load('form_validation'); // Cargar archivo con validaciones
                $validations = $this->config->item('reg_info_contacto'); // Obtener validaciones de archivo
                $this->form_validation->set_rules($validations);

                $inf_contacto = $this->input->post(null, true); //Cargamos el array post en una variable
                if($this->form_validation->run() == TRUE){
                    $info_contacto['num_solicitud'] = $validacion['ids']['solicitud_id'];
                    $info_contacto['info_contacto']= array($inf_contacto['info_tel_casa'],$inf_contacto['info_tel_cel'],$inf_contacto['info_mail_inst'],$inf_contacto['info_mail_per']);
                    $info_contacto['nombre_fam']= $inf_contacto['inf_nom_fam'];
                    $info_contacto['parentesco']= $inf_contacto['inf_parentesco_fam'];
                    $info_contacto['tel_fam']= $inf_contacto['inf_tel_fam'];
                    $info_contacto['email_fam']= $inf_contacto['inf_email_fam'];
                    
                    $guardar_informacion = $this->mod_solicitud->guarda_info_contacto($info_contacto);
                    if($guardar_informacion == true){
                        $msg = "Actualización correcta.";
                    } else {
                        $error = "Ocurrió un error durante el almacenamiento de los datos, inténtelo más tarde.";
                    }
                } else {
                    $datos_error['contacto'] = $inf_contacto; //Datos introducidos por usuario
                }
            } else {
                //$error = "No se han enviado datos."; // = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
            }
            $solicitud_completa = $this->construir_solicitud($validacion['ids'], $datos_error);
            
            $solicitud_completa['ac_li'] = array('','class="active"','','','');
            $solicitud_completa['ac_tab'] = array('','active','','','');
            $solicitud_completa['error'] = $error;
            $solicitud_completa['msg'] = $msg;
            $solicitud_completa['num_solicitud'] = $validacion['ids']['solicitud_id'];

            $contenido = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Registro información de contacto");
        $this->template->getTemplate();  
	}
    
    public function salvar_aplicacion($solicitud_base64){
        $error = $msg = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;
            if($this->input->post()){
                $this->config->load('form_validation'); // Cargar archivo con validaciones
                $validations = $this->config->item('reg_aplicacion'); // Obtener validaciones de archivo
                $this->form_validation->set_rules($validations);
                
                $inf_app = $this->input->post(null, true);// cargamos el array post en una variable
                if($this->form_validation->run() == TRUE){
                    $info_aplicacion['num_solicitud'] = $validacion['ids']['solicitud_id'];
                    $info_aplicacion['ap_programa']= $inf_app['app_nombre'];
                    $info_aplicacion['ap_institucion']= $inf_app['app_institucion'];
                    $info_aplicacion['ap_ubicacion']= $inf_app['app_ubicacion'];
                    $info_aplicacion['ap_inicio']= $inf_app['app_inicio'];
                    $info_aplicacion['ap_termino']= $inf_app['app_termino'];
                    
                    $guardar_informacion = $this->mod_solicitud->guarda_aplicacion($info_aplicacion);
                    if($guardar_informacion == true) {
                        $msg = "Actualización correcta.";
                    } else {
                        $error = "Ocurrió un error durante el almacenamiento de los datos, inténtelo más tarde.";
                    }
                } else {
                    $datos_error['aplicacion'] = $inf_app; //Datos introducidos por usuario
                }
            } else {
                //$error = "No se han enviado datos."; //$this->template->setMainContent($this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE));
            }
            $solicitud_completa = $this->construir_solicitud($validacion['ids'], $datos_error);

            $solicitud_completa['ac_li'] = array('','','class="active"','','');
            $solicitud_completa['ac_tab'] = array('','','active','','');
            $solicitud_completa['error'] = $error;
            $solicitud_completa['msg'] = $msg;
            $solicitud_completa['num_solicitud'] = $validacion['ids']['solicitud_id'];

            $contenido = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Registro informacion de aplicaci&oacute;n");
        $this->template->getTemplate();
	}

    public function salvar_escolar($solicitud_base64){
        $error = $msg = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;
            if($this->input->post()){
                $this->config->load('form_validation'); // Cargar archivo con validaciones
                $validations = $this->config->item('reg_escolar'); // Obtener validaciones de archivo
                $this->form_validation->set_rules($validations);
                
                $inf_esc = $this->input->post(null, true);// cargamos el array post en una variable
                $tipo_aspirante = $this->config->item('tipo_aspirante');
                if($inf_esc['tipouser']==$tipo_aspirante['docente']){ //En caso de ser docente se agregan validaciones
                    $this->form_validation->set_rules('hrs', 'Número de horas que imparte de la materia', 'required|integer|max_length[2]');
                    $this->form_validation->set_rules('materia', 'Materia que imparte', 'required|max_length[50]|alpha_numeric_accent_space_dot_double_quot');
                    //$this->form_validation->set_rules('nivel', 'Nivel académico de la materia que imparte', 'required|max_length[100]');
                    $this->form_validation->set_rules('tipo_profesor', 'Tipo de docente', 'required');
                }
                if($inf_esc['especialidad']==$this->config->item('otra_especialidad')){
                    $this->form_validation->set_rules('otra_especialidad', 'Otra espacilaidad', 'required|alpha_numeric_accent_space_dot_double_quot');
                }
                if($this->form_validation->run() == TRUE){
                    $inf_escolar['solicitud_id'] = $validacion['ids']['solicitud_id'];                    
                    $inf_escolar['tipo_usuario_id']= $inf_esc['tipouser'];
                    $inf_escolar['institucion_id']= $inf_esc['inst'];
                    $inf_escolar['esc_promedio']= $inf_esc['prom'];
                    $inf_escolar['esc_nivel']= $inf_esc['nivel_academico'];
                    $inf_escolar['especialidad_id']= $inf_esc['especialidad'];
                    if($inf_esc['tipouser']==$tipo_aspirante['docente']){ //En caso de ser docente se almacenan estos datos                       
                        $inf_escolar['esc_materia'] = $inf_esc['materia'];
                        $inf_escolar['esc_horas'] = $inf_esc['hrs'];
                        $inf_escolar['tipo_profesor'] = $inf_esc['tipo_profesor'];
                    } else {
                        $inf_escolar['esc_materia'] = null;
                        $inf_escolar['esc_horas'] = null;
                        $inf_escolar['tipo_profesor'] = null;
                    }
                    if($inf_esc['especialidad'] == $this->config->item('otra_especialidad')){
                        $inf_escolar['otra_especialidad']= $inf_esc['otra_especialidad'];
                    } else {
                        $inf_escolar['otra_especialidad'] = null;
                    }
                    
                    $guardar_informacion = $this->mod_solicitud->guarda_escolar($inf_escolar);
                    if($guardar_informacion == true) {
                        $msg = "Actualización correcta.";
                    } else {
                        $error = "Ocurrió un error durante el almacenamiento de los datos, inténtelo más tarde.";
                    }
                } else {
                    $datos_error['escolar'] = $inf_esc; //Datos introducidos por usuario
                }
            } else {
                //$error = "No se han enviado datos."; //$this->template->setMainContent($this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE));
            }
            $solicitud_completa = $this->construir_solicitud($validacion['ids'], $datos_error);

            $solicitud_completa['ac_li'] = array('','','','class="active"','');
            $solicitud_completa['ac_tab'] = array('','','','active','');
            $solicitud_completa['error'] = $error;
            $solicitud_completa['msg'] = $msg;
            $solicitud_completa['num_solicitud'] = $validacion['ids']['solicitud_id'];

            $contenido = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Registro informacion escolar");
        $this->template->getTemplate();
    }


    public function cerrar_solicitud($solicitud_base64){
        $error = $msg = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //e=Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;

            $solicitud = $validacion['ids']['solicitud_id'];
            $solicitud_estado = $this->config->item('solicitud_estado'); //Estados de la solicitud, definidos en archivo de configuración
            $data_solicitud = $this->mod_solicitud->ver_solicitud($solicitud);
            
            if($data_solicitud['data'][0]['est_sol_id']==$solicitud_estado['creacion']['id'] || $data_solicitud['data'][0]['est_sol_id']==$solicitud_estado['correcion']['id']){
                $solicitud_validar_exista_informacion = $this->solicitud_validar_exista_informacion($solicitud);
                $solicitud_validar_documentacion_obligatoria_completa = $this->solicitud_validar_documentacion_obligatoria_completa($solicitud);
                if($solicitud_validar_exista_informacion && $solicitud_validar_documentacion_obligatoria_completa){
                    $solicitud_actualizar = $this->mod_solicitud->solicitud_actualizar_estado($solicitud, array('est_sol_id'=>$solicitud_estado['validacion']['id']), array('num_solicitud'=>$solicitud, 'mov_estado'=>$solicitud_estado['validacion']['id'], 'mov_comentario'=>null));
                    if($solicitud_actualizar['result'] == TRUE){
                        $this->session->set_flashdata('success', '<div role="success" class="alert alert-success"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>'.$solicitud_actualizar['msg'].'</div>');
                        redirect('mi_solicitud/index/'.$validacion['ids']['solicitud_base64'].'?e='.$validacion['ids']['solicitud_encrypt']);
                        exit();
                    } else {
                        $error = $solicitud_actualizar['msg'];
                    }
                } else {
                    $error = "No ha sido cerrada la solicitud, asegurese de:<br>";
                    if(!$solicitud_validar_exista_informacion){ ///Verificar que exista información capturada
                        $error = "- Haber llenado la información correspondiente a 'Información contacto', 'Aplicación beca' y 'Escolar'.<br>";
                    }
                    if(!$solicitud_validar_documentacion_obligatoria_completa){
                        $error .= "- Haber subido todos los archivos obligatorios.";
                    }
                }
                
                $solicitud_completa = $this->construir_solicitud($validacion['ids'], $datos_error);

                $solicitud_completa['ac_li'] = array('','','','','class="active"');
                $solicitud_completa['ac_tab'] = array('','','','','active');
                $solicitud_completa['error'] = $error;
                $solicitud_completa['msg'] = $msg;
                $solicitud_completa['num_solicitud'] = $solicitud;

                $contenido = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
            } else {
                $contenido = html_message("<p style='padding:15px;'>Imposible cerrar solicitud, estado de la solicitud incorrecto.</p>");
            }
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Cerrar solicitud");
        $this->template->getTemplate();
    }

    private function documentacion_requerida($modalidad){
        return $this->mod_solicitud->documentacion_requerida(array('conditions'=>array('modalidad_id'=>$modalidad)));
    }

    private function documentacion_por_solicitud($solicitud){
        return $this->mod_solicitud->documentacion_por_solicitud(array('conditions'=>array('solicitud_id'=>$solicitud)));
    }

    private function nombrar_archivo($solicitud, $requisito){
        $this->load->library('Seguridad');
        return $this->seguridad->encrypt_sha256($solicitud.'_'.$requisito);
    }

    public function cargar_archivo(){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            if($_FILES && $this->input->post()){
                $this->load->library('Seguridad');
                $solicitud = $this->input->post('s', true); //Identificador de la solicitud
                $solicitud_encrypt = $this->input->post('e', true); //Identificador de la solicitud encriptado
                $requisito_encrypt = $this->input->post('req', true); //Identificador del requisito encriptado
                $valor_minimo = $this->input->post('valor_minimo', true); //Identificador del valor mínimo establecido para el requisito
                
                $resultado = array('resultado'=>FALSE, 'error'=>'', 'data'=>'');
                foreach ($_FILES as $key_file => $file) {
                    if(exist_and_not_null_array($file, 'name') && exist_and_not_null_array($file,'tmp_name') && $file['error']==0){ ////Validar la carga de archivo
                        $requisito = str_replace("requisito_", "", $key_file); //Obtener identificador del requisito cargado
                        if($this->seguridad->encrypt_sha512($this->config->item('salt').$requisito)==$requisito_encrypt && $this->seguridad->encrypt_sha512($this->config->item('salt').$solicitud)==$solicitud_encrypt) { //Comprobar que el requisito y la solicitud seleccionadas sean los correctos (Seguridad)
                            $insert = true;

                            $ruta_archivos = $this->config->item('ruta_documentacion').$solicitud."/";
                            if(!file_exists($ruta_archivos) && !is_dir($ruta_archivos)){ //Si no existe la carpeta se crea
                                mkdir($ruta_archivos);
                            }

                            $archivo_actual = $this->mod_solicitud->documentacion_por_solicitud(array('conditions'=>array('archivo.solicitud_id'=>$solicitud, 'archivo.requisito_id'=>$requisito)));
                            $requisito_actual = $this->mod_solicitud->documentacion_requerida(array('conditions'=>array('requisito.requisito_id'=>$requisito)));
                            /*pr($archivo_actual);
                            pr($requisito_actual);
                            pr($valor_minimo);*/
                            if((!empty($requisito_actual) && $requisito_actual[0]['req_obligatorio']==true && !empty($requisito_actual[0]['req_val_minimo']) && empty($valor_minimo))
                             || (!empty($requisito_actual) && $requisito_actual[0]['req_obligatorio']==true && !empty($requisito_actual[0]['req_especifico']) && empty($valor_minimo)) ) { ///Verificar si el valor mínimo es requerido y fue seleccionado por el usuario
                                $resultado['error'] = "Para cargar el archivo es necesario que seleccione la calificación a corroborar en el documento.";
                            } else {
                                if(!empty($archivo_actual)){ //En caso de existir registro en la BD se define que se realizará una actualización y se elimina el archivo
                                    unlink($ruta_archivos.$archivo_actual[0]['arc_nombre']);
                                    $insert = false;
                                }

                                $config['upload_path']          = $ruta_archivos;
                                $config['allowed_types']        = $this->config->item('extension_documentacion');
                                $config['max_size']             = $this->config->item('max_size_documentacion'); // Definir tamaño máximo de archivo
                                $config['detect_mime']          = TRUE; // Validar mime type
                                $config['file_name']            = $this->nombrar_archivo($solicitud, $requisito); ///Renombrar archivo
                                
                                $this->load->library('upload', $config); ///Librería que carga y valida los archivos

                                if(!$this->upload->do_upload($key_file)) {
                                    $resultado['error'] = $this->upload->display_errors();
                                } else {
                                    $resultado['data']['name'] = $this->upload->data('raw_name');
                                    $resultado['data']['filename'] = $this->upload->data('file_name');
                                    if($insert===true){
                                        $archivo = $this->formato_archivo(array('requisito'=>$requisito, 'solicitud'=>$solicitud, 'nombre'=>$resultado['data']['filename'], 'valor'=>$valor_minimo));
                                        $resultado_almacenado = $this->mod_solicitud->guardar_documentacion($archivo);
                                    } else {
                                        $resultado_almacenado = $this->mod_solicitud->actualizar_documentacion((object)array('requisito_id'=>$requisito, 'solicitud_id'=>$solicitud, 'arc_fecha'=>"now", 'arc_nombre'=>$resultado['data']['filename'], 'arc_valor'=>$valor_minimo));
                                    }
                                    if($resultado_almacenado['result']==TRUE){
                                        $resultado['resultado'] = TRUE;
                                    } else {
                                        unlink($ruta_archivos);
                                    }
                                }                                    
                            }
                            echo json_encode($resultado);
                            exit();
                        } else {
                            $resultado['error'] = "Ocurrió un error durante la carga del archivo, recargue la página por favor.";
                        }
                    }
                }
            } else {
                redirect(site_url()); //Redirigir al inicio del sistema si no se recibio información por método post
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    private function formato_archivo($data){
        $archivo = new Archivo_documentacion;
        $archivo->requisito_id = $data['requisito'];
        //$archivo->arc_correcto = (exist_and_not_null_array($data,'correcto')) ? $data['correcto'] : 2;
        $archivo->arc_correcto = 2; //Al cargar archivo siempre se considerará que tendrá validación por parte de admin
        $archivo->arc_valor = (exist_and_not_null_array($data,'valor')) ? $data['valor'] : null;
        $archivo->arc_fecha = (exist_and_not_null_array($data,'fecha')) ? $data['fecha'] : 'now';
        $archivo->arc_nombre = (exist_and_not_null_array($data,'nombre')) ? $data['nombre'] : '';
        $archivo->solicitud_id = $data['solicitud'];

        return $archivo;
    }

    private function solicitud_validar_exista_informacion($solicitud){
        $registro = $this->mod_solicitud->solicitud_validar_exista_informacion($solicitud);
        
        return ($registro>0) ? true : false;
    }

    private function solicitud_validar_documentacion_obligatoria_completa($solicitud){
        $registro = $this->mod_solicitud->solicitud_validar_documentacion_obligatoria_completa($solicitud);
        return ($registro>0) ? true : false;
    }

    public function generar_pdf(){
        if($this->input->is_ajax_request()){ //Solo se accede al método a través de una petición ajax
            if($this->input->post()){
                //pr($this->input->post(null, true));
                $solicitud = $this->input->post('s', true); //Identificador de la solicitud
                $solicitud_encrypt = $this->input->post('e', true); //Identificador de la solicitud encriptado
                $resultado = array('resultado'=>FALSE, 'error'=>'', 'data'=>'');
                if($this->seguridad->encrypt_sha512($this->config->item('salt').$solicitud)==$solicitud_encrypt){
                    if($this->session->has_userdata('solicitud_beca')) { //Eliminamos valor de sesión.
                        $this->session->unset_userdata('solicitud_beca');
                    }
                    if($this->solicitud_validar_exista_informacion($solicitud)){
                        $this->session->set_userdata('solicitud_beca', $solicitud); //Agregamos identificador de solicitud en sesión
                        $resultado['resultado'] = TRUE;
                    } else {
                        $resultado['error'] = "Solicitud de beca no generada, asegurese de haber llenado la información correspondiente a: 'Información contacto', 'Aplicación beca' y 'Escolar'.";
                    }
                } else {
                    $resultado['error'] = "Solicitud inválida, recargue la página e inténtelo de nuevo por favor.";
                }
                echo json_encode($resultado);
                exit();
            } else {
                redirect(site_url()); //Redirigir al inicio del sistema si no se recibio información por método post
            }
        } else {
            redirect(site_url()); //Redirigir al inicio del sistema si se desea acceder al método mediante una petición normal, no ajax
        }
    }

    public function extract_data_report($result) {
        if($result !=false){
            foreach ($result as $row){                
                $tel_casa = " "; $tel_cel = " "; $mail_inst = " "; $mail_per = " ";  $pasaporte = array(); $sexo_asp = " "; $nacimiento = " "; //$tipo_profesor="";
                if(isset($row->INFO_CONTACTO) && !empty($row->VAL_CONTACTO)){
                    $reg_contacto = explode(",", $row->INFO_CONTACTO);
                    $val_contacto = explode(",", $row->VAL_CONTACTO);
                    $tel_casa = (isset($reg_contacto[0])&&$reg_contacto[0] == 'TEL CASA') ? $val_contacto[0] : " "; 
                    
					$tel_cel = (isset($reg_contacto[1])&&$reg_contacto[1] == ' TEL OFICINA') ? $val_contacto[1] : " ";  
                    
					$mail_inst = (isset($reg_contacto[2])&&$reg_contacto[2] == ' EMAIL PERSONAL') ? $val_contacto[2] : " ";  
                    
					$mail_per = (isset($reg_contacto[3])&& $reg_contacto[3] == ' EMAIL INSTITUCIONAL') ? $val_contacto[3] : " ";
                }
                
                if(isset($row->NACIMIENTO) && !empty($row->NACIMIENTO)){
                    $nacimiento = explode("-", $row->NACIMIENTO);
                }
                               
                if(isset($row->PASAPORTE) && !empty($row->PASAPORTE)){
                    $pasaporte = explode("-", $row->PASAPORTE);
                }
                
                if(isset($row->INICIO_APLICACION) && !empty($row->INICIO_APLICACION)){
                    $ini_app = explode("-", $row->INICIO_APLICACION);
                }
                
                if(isset($row->TERMINO_APLICACION) && !empty($row->TERMINO_APLICACION)){
                    $fin_app = explode("-", $row->TERMINO_APLICACION);
                }
                                
                if(isset($row->SEXO) && !empty($row->SEXO)){
                    $sexo_asp = ($row->SEXO == 'F') ? "FEMENINO" : "MASCULINO";
                }
                
                if(isset($row->MODALIDAD_ID) && !empty($row->MODALIDAD_ID)){
                    $requisitos = $this->mod_solicitud->search_requisito($row->MODALIDAD_ID);
                    if($requisitos != false){
                        foreach ($requisitos as $requisito){
                            $sol_requisitos['obligatorio'][]= $requisito->req_obligatorio;
                            $sol_requisitos['nombre'][]=$requisito->req_nombre;
                            
                        }
                    }
                }
                if(isset($row->TIPO_PROFESOR) && !empty($row->TIPO_PROFESOR)) { 
                    
                    $tipo=$row->TIPO_PROFESOR;
                    $profesores = $this->config->item('tipo_profesores');
                    $tipo_profesor = $profesores[$tipo];
                    
                }
                
                //pr($sol_requisitos);
                                
                $datos = array("sol_num"        =>  ( isset($row->SOLICITUD) && !empty($row->SOLICITUD)) ? $row->SOLICITUD : ""
                        , "sol_beca"            => (isset($row->BECA) && !empty($row->BECA)) ? $row->BECA : ""
                        , "sol_modalidad"       => (isset($row->MODALIDAD) && !empty($row->MODALIDAD)) ? $row->MODALIDAD : ""
                        , "sol_apaterno"        => (isset($row->PATERNO) && !empty($row->PATERNO)) ? $row->PATERNO : ""
                        , "sol_amaterno"        => (isset($row->MATERNO) && !empty($row->MATERNO)) ? $row->MATERNO : ""
                        , "sol_nom_asp"         => (isset($row->NOMBRE) && !empty($row->NOMBRE)) ? $row->NOMBRE : ""
                        , "sol_sexo"            => (isset($sexo_asp) && !empty($sexo_asp)) ? $sexo_asp : ""
                        , "sol_anio_na"         => (isset($nacimiento[0]) && !empty($nacimiento[0])) ? $nacimiento[0] : ""
                        , "sol_mes_na"          => (isset($nacimiento[1]) && !empty($nacimiento[1])) ? $nacimiento[1] : ""
                        , "sol_dia_na"          => (isset($nacimiento[2]) && !empty($nacimiento[2])) ? $nacimiento[2] : ""
                        , "sol_curp"            => (isset($row->CURP) && !empty($row->CURP)) ? $row->CURP : ""
                        , "sol_rfc"             => (isset($row->RFC) && !empty($row->RFC)) ? $row->RFC : ""
                        , "sol_est_civil"       => (isset($row->ESTADO_CIVIL) && !empty($row->ESTADO_CIVIL)) ? $row->ESTADO_CIVIL : ""
                        , "sol_anio_pas"        => (isset($pasaporte[0]) && !empty($pasaporte[0])) ? $pasaporte[0] : ""
                        , "sol_mes_pas"         => (isset($pasaporte[1]) && !empty($pasaporte[1])) ? $pasaporte[1] : ""
                        , "sol_dia_pas"         => (isset($pasaporte[2]) && !empty($pasaporte[2])) ? $pasaporte[2] : ""
                        , "sol_matricula"       => (isset($row->MATRICULA) && !empty($row->MATRICULA)) ? $row->MATRICULA : ""
                        , "sol_contrato"        => (isset($row->TIPO_CONTRATO) && !empty($row->TIPO_CONTRATO)) ? $row->TIPO_CONTRATO : ""
                        , "sol_adscripcion"     => (isset($row->ADSCRIPCION) && !empty($row->ADSCRIPCION)) ? $row->ADSCRIPCION : ""
                        , "sol_delegacion"      => (isset($row->DELEGACION) && !empty($row->DELEGACION)) ? $row->DELEGACION : ""
                        , "sol_categoria"       => (isset($row->CATEGORIA) && !empty($row->CATEGORIA)) ? $row->CATEGORIA : ""
                        , "sol_anios_ant"       => (isset($row->ANT_ANIO) && !empty($row->ANT_ANIO)) ? $row->ANT_ANIO : ""
                        , "sol_quincena_ant"    => (isset($row->ANT_QUIN) && !empty($row->ANT_QUIN)) ? $row->ANT_QUIN : ""
                        , "sol_dias_ant"        => (isset($row->ANT_DIA) && !empty($row->ANT_DIA)) ? $row->ANT_DIA : ""
                        , "sol_tel_of"          => (isset($tel_casa) && !empty($tel_casa)) ? $tel_casa : ""
                        , "sol_email_inst"      => (isset($mail_inst) && !empty($mail_inst)) ? $mail_inst : ""
                        , "sol_tel_cel"         => (isset($tel_cel) && !empty($tel_cel)) ? $tel_cel : ""
                        , "sol_email_alterno"   => (isset($mail_per) && !empty($mail_per)) ? $mail_per : ""
                        , "sol_nom_fam"         => (isset($row->FAMILIAR) && !empty($row->FAMILIAR)) ? $row->FAMILIAR : ""
                        , "sol_parent_fam"      => (isset($row->PARENTESCO) && !empty($row->PARENTESCO)) ? $row->PARENTESCO : ""
                        , "sol_email_fam"       => (isset($row->FAM_EMAIL) && !empty($row->FAM_EMAIL)) ? $row->FAM_EMAIL : ""
                        , "sol_tel_fam"         => (isset($row->FAM_TEL) && !empty($row->FAM_TEL)) ? $row->FAM_TEL : ""
                        , "sol_aplicacion"      => (isset($row->PROGRAMA) && !empty($row->PROGRAMA)) ? $row->PROGRAMA : ""
                        , "sol_inst_aplicacion" => (isset($row->INSTITUCION_APLICACION) && !empty($row->INSTITUCION_APLICACION)) ? $row->INSTITUCION_APLICACION : ""
                        , "sol_ubicacion_inst"  => (isset($row->UBICACION_INSTITUCION) && !empty($row->UBICACION_INSTITUCION)) ? $row->UBICACION_INSTITUCION : ""
                        , "sol_anio_ini"        => (isset($ini_app[0]) && !empty($ini_app[0])) ? $ini_app[0] : ""
                        , "sol_mes_ini"         => (isset($ini_app[1]) && !empty($ini_app[1])) ? $ini_app[1] : ""
                        , "sol_dia_ini"         => (isset($ini_app[2]) && !empty($ini_app[2])) ? $ini_app[2] : ""
                        , "sol_anio_fin"        => (isset($fin_app[0]) && !empty($fin_app[0])) ? $fin_app[0] : ""
                        , "sol_mes_fin"         => (isset($fin_app[1]) && !empty($fin_app[1])) ? $fin_app[1] : ""
                        , "sol_dia_fin"         => (isset($fin_app[2]) && !empty($fin_app[2])) ? $fin_app[2] : ""
                        , "sol_tipo_asp"        => (isset($row->TIPO_ASPIRANTE) && !empty($row->TIPO_ASPIRANTE)) ? $row->TIPO_ASPIRANTE : ""
                        , "sol_universidad"     => (isset($row->UNIVERSIDAD) && !empty($row->UNIVERSIDAD)) ? $row->UNIVERSIDAD : ""
                        , "sol_institucion"     => (isset($row->INSTITUCION) && !empty($row->INSTITUCION)) ? $row->INSTITUCION : ""
                        , "sol_nivel_academico" => (isset($row->NIVEL_ACADEMICO) && !empty($row->NIVEL_ACADEMICO)) ? $row->NIVEL_ACADEMICO : ""
                        , "sol_promedio"        => (isset($row->PROMEDIO) && !empty($row->PROMEDIO)) ? $row->PROMEDIO : ""
                        , "sol_materia"         => (isset($row->MATERIA) && !empty($row->MATERIA)) ? $row->MATERIA : ""
                        , "sol_tipo_profesor"   => (!empty($tipo_profesor)) ? $tipo_profesor : ""
                        , "sol_horas"         => (isset($row->HORAS) && !empty($row->HORAS)) ? $row->HORAS : ""
                        , "sol_especialidad"    => (isset($row->ESPECIALIDAD) && !empty($row->ESPECIALIDAD)) ? $row->ESPECIALIDAD : "", "sol_especialidad_id"    => (isset($row->ESPECIALIDAD_ID) && !empty($row->ESPECIALIDAD_ID)) ? $row->ESPECIALIDAD_ID : "", "sol_otra_especialidad"    => (isset($row->OTRA_ESPECIALIDAD) && !empty($row->OTRA_ESPECIALIDAD)) ? $row->OTRA_ESPECIALIDAD : ""
                        , "sol_requisitos"    => (isset($sol_requisitos) && !empty($sol_requisitos)) ? $sol_requisitos : ""
                    );
                
                
                return $datos;
                }
            }else{
                return false;;
            }
        }
        
    public function show_pdf(){             
        $this->load->library('my_fpdf');
        
        if($this->session->has_userdata('solicitud_beca')) {
            $solicitud = $this->session->userdata('solicitud_beca');
            $datos = array();
            
            $datos = $this->extract_data_report($this->mod_solicitud->llenar_formato_solicitud($solicitud));
            if($datos != false){
                $pdf = new My_fpdf();
                
                $pdf->AliasNbPages();
                $pdf->AddPage();
                $pdf->SetFont('Arial','',9);
                $pdf->SolicitudReport($datos);
                $pdf->Output();
            }
            $this->session->unset_userdata('solicitud_beca');
        } else {
            echo "Solicitud inválida";
        }
        exit();
    }
    
    public function validar_archivos($solicitud_base64 = null){
        $error = $msg = "";
        //(isset($solicitud_base64) && !empty($solicitud_base64)) ? $solicitud_base64 : null
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;
            $this->load->library('form_validation');
            
            $archivo_validacion = array();
            $archivos['num_solicitud'] = $validacion['ids']['solicitud_id'];
            
            $archivo_validacion['archivos'] = $this->mod_solicitud->listado_archivos($archivos);
           
            $validar_campos = array();            
            
            if($this->input->post()){
                $this->config->load('form_validation'); // Cargar archivo con validaciones
                $validar_campos = $this->config->item('validar_archivos'); // Obtener validaciones de archivo
                
                foreach ($archivo_validacion['archivos']['data'] as $key => $requisito) {
                    $validar_campos[] = array('field'=>'archivo_'.$requisito['archivo_id'].'', 'label'=>'Archivo', 'rules'=>'required|exact_length[1]|numeric');
                }                                
                
                $this->form_validation->set_rules($validar_campos);                
                $val_archivos = $this->input->post(null, true);// cargamos el array post en una variable
                if($this->form_validation->run() == TRUE){
                    
                    $val_archivos;
                    $contador=0; $sumar_valor=0;$data_solicitud=array();$data_mov_solicitud=array();$data_archivos=array();
                    //extraer el id del archivo y guardar la actualizacion
                    foreach($val_archivos as $key=>$value) { 
                        $imput_name= explode("_", $key);
                        
                        if($contador > 0 && $imput_name[0] == "archivo"){
                            $data_archivos[] = array('archivo_id'=>$imput_name[1],'arc_correcto'=>$value);
                            $sumar_valor=$sumar_valor+$value;
                        }else{
                            $comentario = $value; 
                        }
                        
                        $contador++;                        
                    }                    
                    //si contador menos uno es igual a suma valor
                    //todos los archivos son correctos mandamos la validacion como aceptado, si no actualizamos como correccion o no 
                    $solicitud_estado = $this->config->item('solicitud_estado');
                    
                    if(($contador-1) == $sumar_valor){ $est_sol=$solicitud_estado['completa']['id']; }else{ $est_sol=$solicitud_estado['correcion']['id']; }
                    
                    $data_solicitud=array("num_solicitud"=>$archivos['num_solicitud'], 'est_sol'=> $est_sol);
                    $data_mov_solicitud=array('num_solicitud'=>$archivos['num_solicitud'],'est_sol'=>$est_sol,'comentario'=>$comentario);
                    
                    //pr($data_archivos);
                    $guarda_validacion = $this->mod_solicitud->guarda_validacion_archivos($data_solicitud,$data_mov_solicitud,$data_archivos);
                    
                    if($guarda_validacion==true){                        
                       $mensaje = '<div role="success" class="alert alert-success"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>La validación de archivos se ha guardado correctamente</div>';                       
                        $check_envio_correo=  $this->mod_solicitud->datos_aspirante_solicitud($archivos['num_solicitud']);
                        if($est_sol==$solicitud_estado['completa']['id']){
                            $vista = $this->load->view('template/email/enviar_correo_docs_aceptados', null, true);
                            $subject = "Documentos aceptados :: IMSS becas";
                            
                            $check_envio_correo = $this->enviar_correo($check_envio_correo['data'], $vista, $subject); //Enviar correos
                            if($check_envio_correo['result'] == true){
                                $mensaje .= '<div role="success" class="alert alert-success"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Un mensaje fue enviado a la cuenta de correo del aspirante, para notificar la validación de sus documentos.</div>';
                            } else {
                                $error = "Ocurrió un error durante el envío del correo, inténtelo más tarde.";
                            }
                        }else{
                            if($est_sol==$solicitud_estado['correcion']['id']){      
                                
                                $vista = $this->load->view('template/email/enviar_correo_docs_no', null, true);
                                $subject = "Documentos no aceptados :: IMSS becas";
                                
                                $check_envio_correo = $this->enviar_correo($check_envio_correo['data'], $vista, $subject);
                                if($check_envio_correo['result'] == true){
                                    $mensaje .= '<div role="success" class="alert alert-success"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>Un mensaje fue enviado a la cuenta de correo del aspirante, para notificar la validación de sus documentos.</div>';
                                }else{
                                    $error = "Ocurrió un error durante el envío del correo, inténtelo más tarde.";
                                }                                
                            }
                        }                        
                        $this->session->set_flashdata('msg_solicitudes',$mensaje);
                        redirect('solicitudes');
                        
                    }                    
                    
                }else {
                    //$datos_error['archivos'] = $inf_app; //Datos introducidos por usuario
                }
                
            }
             $archivo_validacion['ids'] = $validacion['ids'];
            $contenido = $this->load->view('solicitud/resultado_archivos.php',$archivo_validacion, TRUE);
/**/
        
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Validaci&oacute;n de archivos");
        $this->template->getTemplate();
        
    }

    //VALIDAR QUE EL ESTADO DE LA SOLICITUD SEA CORRECTO
    public function postulacion_pdf($solicitud_base64 = null){
        $error = $msg = "";
        //(isset($solicitud_base64) && !empty($solicitud_base64)) ? $solicitud_base64 : null
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;
            
            $this->load->library('pdf_postulacion');
            $archivo_validacion = array();
            $archivos['num_solicitud'] = $validacion['ids']['solicitud_id'];
            
            $datos=array();
            $data_pos=$this->mod_solicitud->llenar_postulacion($archivos['num_solicitud']);
            
            if($data_pos != false){
                
                foreach ($data_pos as $row){ 


                    
                    $datos=array('pos_tipo_beca'=>$row->tipo_beca, 
                    'pos_tipo_usuario'=>$row->tipo_usuario, 
                    'pos_modalidad_id'=>$row->modalidad_id,
                    'pos_modalidad'=>$row->nom_beca_mod, 
                    'pos_oficio'=>$row->num_oficio, 
                    'pos_nom_asp'=>$row->nombre_completo, 
                    'pos_inst_app'=>$row->inst_app,
                    'pos_ini_app'=>$row->ini_app,
                    'pos_fin_app'=>$row->fin_app,
                    'pos_itinerario1'=>$row->itinerario1,
                    'pos_itinerario2'=>$row->itinerario2,
                    'pos_curp'=>$row->curp,
                    'pos_esc_asp'=>$row->esc_inst,
                    'pos_materia'=>$row->materia,
                    'pos_promedio'=>$row->promedio,
                    'pos_ingles'=>$row->ingles,
                    'pos_adscripcion'=>$row->adscripcion,
                    'pos_programa_app'=>$row->programa_app,
                    'pos_responsable'=>$row->responsable,
                    'pos_cargo_resp'=> $row->cargo);
                    
                    }
                     /*
                    pr($datos);
                   */
                    $pdf = new Pdf_postulacion();

                    $pdf->AliasNbPages();
                    $pdf->AddPage();
                    $pdf->SetFont('Arial','',9);            
                    $pdf->WritePostulacion($datos);
                    $pdf->Output();
                    
                    
                }
                        
            }
        }
        
        
    public function salvar_datos_solicitud($solicitud_base64){
        $error = $msg = "";
        $validacion = $this->validacion_identificador_solicitud($solicitud_base64, $this->input->get('e', true)); //Identificador encriptado sha512(salt+solicitud)
        if($validacion['resultado']===true){
            $datos_error = null;
            if($this->input->post()){
                $this->config->load('form_validation'); // Cargar archivo con validaciones
                $validations = $this->config->item('update_sol_asp'); // Obtener validaciones de archivo
                $this->form_validation->set_rules($validations);
                
                $inf_datos_sol = $this->input->post(null, true);// cargamos el array post en una variable
                if($this->form_validation->run() == TRUE){
                    $info_data_sol['num_solicitud'] = $validacion['ids']['solicitud_id'];
                    $info_data_sol['matricula']= $this->session->userdata('matricula');
                    $info_data_sol['asp_nom']= mb_strtoupper($inf_datos_sol['asp_nom'], 'UTF-8');
                    $info_data_sol['asp_pat']= mb_strtoupper($inf_datos_sol['asp_pat'], 'UTF-8');
                    $info_data_sol['asp_mat']= mb_strtoupper($inf_datos_sol['asp_mat'], 'UTF-8');
                    $info_data_sol['sol_passport']= $inf_datos_sol['sol_passport'];
                    
                    $guardar_informacion = $this->mod_solicitud->update_datos_solicitud($info_data_sol);
                    if($guardar_informacion == true) {
                        $msg = "Actualización correcta.";
                    } else {
                        $error = "Ocurrió un error durante el almacenamiento de los datos, inténtelo más tarde.";
                    }
                } else {
                    $datos_error['data_solicitud'] = $inf_datos_sol; //Datos introducidos por usuario
                }
            } else {
                //$error = "No se han enviado datos."; //$this->template->setMainContent($this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE));
            }
            $solicitud_completa = $this->construir_solicitud($validacion['ids'], $datos_error);

            $solicitud_completa['ac_li'] = array('class="active"','','','','');
            $solicitud_completa['ac_tab'] = array('active','','','','');
            $solicitud_completa['error'] = $error;
            $solicitud_completa['msg'] = $msg;
            $solicitud_completa['num_solicitud'] = $validacion['ids']['solicitud_id'];

            $contenido = $this->load->view('solicitud/solicitud.php',$solicitud_completa, TRUE);
        } else {
            $contenido = $validacion['error'];
        }
        $this->template->setMainContent($contenido);
        $this->template->setTitle("Registro informacion de aplicaci&oacute;n");
        $this->template->getTemplate();
	}
        
        private function construir_update_datos_solicitud($solicitud, $datos_error=null){        
        $dus = $this->mod_solicitud->mostrar_datos_solicitud($solicitud);
        $data_update_sol = $dus[0];
        if(isset($datos_error['data_solicitud']) && !empty($datos_error['data_solicitud'])){
            $data_update_sol['asp_nom'] = mb_strtoupper($datos_error['data_solicitud']['asp_nom'], 'UTF-8');
            $data_update_sol['asp_pat'] = mb_strtoupper($datos_error['data_solicitud']['asp_pat'], 'UTF-8');
            $data_update_sol['asp_mat'] = mb_strtoupper($datos_error['data_solicitud']['asp_mat'], 'UTF-8');
            $data_update_sol['sol_passport'] = $datos_error['data_solicitud']['asp_passport'];
        }
        return $data_update_sol;
    }
    
    private function enviar_correo($aspirante, $vista, $subject){
        $this->load->library('My_phpmailer');
        
        $mail = $this->my_phpmailer->phpmailerclass(); //Se cargan datos por default definidos en config/email

        $resultado = array('result'=>false, 'error'=>null);
        
        $plantilla = $vista;
        //$plantilla = $this->load->view('template/email/enviar_correo_recuperar_contrasenia', null, true);
        
        $mail->addAddress($aspirante->asp_email, utf8_decode($aspirante->asp_nombre.' '.$aspirante->asp_paterno.' '.$aspirante->asp_materno));
        $mail->Subject = utf8_decode($subject);
        $mail->msgHTML(utf8_decode($plantilla));
        //$mail->AltBody = 'This is a plain-text message body';
        
        if (!$mail->send()) { //send the message, check for errors
            $resultado['result'] = false;
            $resultado['error'] = $mail->ErrorInfo;
        } else {
            $resultado['result'] = true;
        }
        return $resultado;
    }
    
    	
}

class Archivo_documentacion{
    public $requisito_id;
    public $arc_correcto;
    public $arc_valor;
    public $arc_fecha;
    public $solicitud_id;
}