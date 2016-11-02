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
        $this->load->library('form_complete');
        $this->load->library('Ventana_modal');
        $this->load->config('general');
        $this->load->library('form_validation');
        $this->load->library('seguridad');
        $this->load->model('Catalogos_generales', 'cg');
        $this->load->model("Solicitud_model", 'req');
    }

    private function limpia_varsesion() {
        $variables = array('detalle_solicitud',);
        foreach ($variables as $value) {
            $this->session->unset_userdata($value);
        }
    }

    function index() {
//        $this->session->set_userdata('rol_cve', E_rol::ENTIDAD); //entidad
//       $this->session->set_userdata('rol_usuario_cve', '2');//Juridico

        $this->limpia_varsesion();
        $this->lang->load('interface', 'spanish');
        $string_values = $this->lang->line('interface')['solicitud_index'];
        $data['string_values'] = $string_values;
        $data['order_columns'] = array('hri.c_estado_id' => $string_values['order_estado_solicitud'], 'lb.title' => $string_values['order_titulo_libro'],
            'lb.subtitle' => $string_values['order_subtitulo_libro'], 'lb.isbn' => $string_values['order_isbn']
        );
        $rol_sesion = $this->session->userdata('rol_cve');
//        pr($this->session->userdata('entidad_id'));
        $datos_usuario = array();
        switch ($rol_sesion) {
            case E_rol::ENTIDAD://Entidad
                $array_catalogos = array(Enum_cg::c_estado);
                $datos_usuario['entidad_cve'] = $this->session->userdata('entidad_id');
                $datos_usuario['mostrar_agrgar_solicitud'] = 1;
                break;
            case E_rol::DGAJ://Juridico
                $array_catalogos = array(Enum_cg::c_estado, Enum_cg::c_entidad);
                break;
            case E_rol::ADMINISTRADOR://Juridico
        }
        //Carga catálogos
        $data = carga_catalogos_generales($array_catalogos, $data, null, TRUE, NULL, array(enum_cg::c_estado => 'id', Enum_cg::c_entidad => 'name'));

        //Carga datos de usuario 
        $this->session->set_userdata('datos_usuario', $datos_usuario); //entidad

        $main_contet = $this->load->view('solicitud/buscador/solicitud_isbn_tpl', $data, true);
//        $this->template->multiligual = TRUE;
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    /**
     * @fecha LEAS
     * @author LEAS
     * @param type $current_row
     */
    function buscador_solicituides($current_row = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
//            $this->detalle();
//            exit();
            if (!is_null($this->input->post())) {
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['tabla_resultados'];
                $filtros = $this->input->post(null, true); //Obtenemos el post o los valores 
                $rol_cve = $this->session->userdata('rol_cve');
//                pr($filtros);
                $datos_usuario = $this->session->userdata('datos_usuario');
                $filtros += $datos_usuario;
                $filtros['rol_seleccionado'] = $rol_cve; //Carga el rol actual (entidad o DGAJ)
//                pr($filtros);
                $filtros['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0;

                $resutlado = $this->req->get_buscar_solicitudes($filtros);
//                pr($resutlado['result']);
//                exit();
                
                $data['rol_cve'] = $rol_cve;
                $data['reglas_estados'] = $this->req->getReglasEstadosSolicitud();
                $data['string_values'] = $string_values;
                $data['lista_solicitudes'] = $resutlado['result'];
                $data['total'] = $resutlado['total'];
                $data['current_row'] = $filtros['current_row'];
                $data['per_page'] = $this->input->post('per_page');

                if (isset($data['lista_solicitudes']) && !empty($data['lista_solicitudes'])) {
                    $this->listado_resultado_unidades($data, array('form_recurso' => '#form_busqueda_solicitudes',
                        'elemento_resultado' => '#div_result_solicitudes'
                    )); //Generar listado en caso de obtener datos
                } else {
                    echo $string_values ['resp_sin_resultados'];
                }
            }
        } else {
            redirect(site_url());
        }
    }

    private function listado_resultado_unidades($data, $form) {
        $data['controller'] = 'Solicitud_model';
        $data['action'] = 'get_buscar_solicitudes';
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginación
        //$pagination = $this->template->pagination_data_buscador_asignar_validador($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info' style='line-height: 50px;'>" . $pagination['total'] . "</div>
                    <div class='col-sm-7 text-right'>" . $pagination['links'] . "</div>";
        $datos['lista_solicitudes'] = $data['lista_solicitudes'];
        $datos['string_values'] = $data['string_values'];
        $datos['reglas_estados'] = $data['reglas_estados'];
        $datos['rol_cve'] = $data['rol_cve'];
        echo $links . $this->load->view('solicitud/buscador/tabla_resultados_solicitudes', $datos, TRUE) . $links . '
                <script>
                $("ul.pagination li a").click(function(event){
                    data_ajax(this, "' . $form['form_recurso'] . '", "' . $form['elemento_resultado'] . '");
                    event.preventDefault();
                });
                </script>';
    }

    public function seccion_delete_datos_solicituid() {
        if ($this->input->is_ajax_request()) {
//            if ($this->input->post()) {
//                $datos_post = $this->input->post(null, TRUE);
            $this->delete_datos_validado(); //Elimina los datos de empleado validado, si se encuentran los datos almacenados en la variable de sesión
//            }
        } else {
            redirect(site_url());
        }
    }

    private function delete_datos_validado() {
        if (!is_null($this->session->userdata('detalle_solicitud'))) {
            $this->session->unset_userdata('detalle_solicitud');
        }
    }

    /**
     * 
     */
    public function seccion_index() {
        //echo "SOY UN INDEX....";
        if ($this->input->is_ajax_request()) {
            if (!is_null($this->input->post())) {
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['solicitud_detalle'];
                $datosPerfil['string_values'] = $string_values;
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
//                pr($datos_post);
                $rol_seleccionado = $this->session->userdata('rol_cve'); //Rol seleccionado de la pantalla de roles
//                pr($rol_seleccionado);
                $datos_solicitud = array();
                $datos_solicitud['estado_correccion'] = null;
                //Validación general de la validación actual del docente
                if (!empty($datos_post['solicitud_cve'])) {
                    $datos_solicitud['solicitud_cve'] = $this->seguridad->decrypt_base64($datos_post['solicitud_cve']); //Identificador de la comisión
                }

                if (!empty($datos_post['histsolicitudcve'])) {
                    $datos_solicitud['histsolicitudcve'] = $this->seguridad->decrypt_base64($datos_post['histsolicitudcve']); //Identificador de la comisión
                }
                if (!empty($datos_post['estado_cve'])) {
                    $datos_solicitud['estado_cve'] = $this->seguridad->decrypt_base64($datos_post['estado_cve']); //Identificador de la comisión
                }
                //Genera reglas de estado 
                $reglas_validacion = $this->req->getReglasEstadosSolicitud();
                $parametros_estado['reglas_validacion'] = $reglas_validacion;
                $parametros_estado['rol_seleccionado'] = $rol_seleccionado;
                $parametros_estado['estado_cve'] = $datos_solicitud['estado_cve'];
                $datosPerfil['boton_estado'] = genera_botones_estado_solicitud($parametros_estado);

                //Obtiene las propiedades del estado actual
                $propEstadoActual = $reglas_validacion[$parametros_estado['estado_cve']];

                //Carga la vista actual
                switch ($propEstadoActual['vista']) {
                    case 'detalle':
                        $datosSeccion['solicitud_cve'] = $datos_solicitud['solicitud_cve'];
                        $datosSeccion['hist_cve'] = $datos_solicitud['histsolicitudcve'];
                        $datosSeccion['estado_cve'] = $datos_solicitud['estado_cve'];

                        $secciones = $this->req->getSeccionesSolicitud(); //Obtiene totas las secciones
                        $array_comentarios = array();
                        foreach ($secciones as $value) {
                            $array_comentarios[$value] = '<a href="#"'
                                    . 'class="comentario"'
                                    . 'data-solicitudcve="' . $datos_post['solicitud_cve'] . '"'
                                    . 'data-histsolicitudcve="' . $datos_post['histsolicitudcve'] . '"'
                                    . 'data-seccioncve="' . $value . '"'
                                    . 'data-toggle="modal" data-target="#modal_censo">'
//                                    . $string_values['add_ver_comment']
                                    . '<span class="glyphicon glyphicon-comment btn-msg" '
                                    . 'placeholder="' . $string_values['add_ver_comment'] . '"'
                                    . 'title="' . $string_values['add_ver_comment'] . '">'
                                    . '</span></a>';
                        }
                        $datosSeccion['botones_seccion'] = $array_comentarios;
                        $datosPerfil['vista'] = $this->load->view('solicitud/buscador/dgaj_revision', $datosSeccion, true);
                        break;
                    case 'editar_registro':
                        $data = null;
                        try {
                            $data["datos"]["solicitud"] = $this->req->getSolicitud(intval($datos_solicitud['solicitud_cve']));
                        } catch (Exception $ex) {
                            print ($ex);
                        }
                        $datosPerfil['vista'] = $this->load->view('solicitud/secciones.tpl.php', $data, true);
                        break;
                }
                //Carga datos de la solicitud del ISBN
                $this->session->set_userdata('detalle_solicitud', $datos_solicitud); //Asigna la información del usuario al que se va a validar
                echo $this->load->view('solicitud/buscador/index', $datosPerfil, true);
            }
//            pr($this->session->userdata('datosvalidadoactual'));$datos_empleado_validar
        } else {
            redirect(site_url());
        }
    }

    function registrar() {
        // pr($this->session->userdata());    
        $id_entidad = $this->session->userdata("entidad_id"); //from session
        $id_categoria = null;
        $id_subcategoria = null;
        $rol_seleccionado = $this->session->userdata('rol_cve'); //Rol seleccionado de la pantalla de roles
        //si tiene datosbusca por id
        if ($this->input->post()) {
            $post = $this->input->post();
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('solicitud'); //Obtener validaciones de archivo 
            $this->form_validation->set_rules($validations); //Añadir validaciones
//            pr($post);
            $data["save"] = $post;

            if ($this->form_validation->run()) {
                //$data["datos"]["entidad"] = $this->sol->getEntidad($id_entidad);
                $data["save"]["solicitud"]["entidad_id"] = $id_entidad;
                $solicitud = $this->req->addSolicitud($data["save"]);
                if ($solicitud > 0) {
                    redirect("solicitud/secciones/$solicitud");
                }
                //pr($data);
            }
        }
        $data["datos"]["categorias"] = $this->req->listCategoria();
        $data["datos"]["sub_categorias"] = $this->req->listSubCategoria($id_categoria);

        //Genera reglas de estado 
        $reglas_validacion = $this->req->getReglasEstadosSolicitud();
        $parametros_estado['reglas_validacion'] = $this->req->getReglasEstadosSolicitud();
        $parametros_estado['rol_seleccionado'] = $rol_seleccionado;
        $parametros_estado['estado_cve'] = Enum_es::__default; //Estado inicial para enviar una solicitud
        $data['boton_estado'] = genera_botones_estado_solicitud($parametros_estado);
//        pr($data['boton_estado']);

        $main_contet = $this->load->view('solicitud/registrar.tpl.php', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    function secciones($solicitud) {
        try {
            $data["datos"]["solicitud"] = $this->req->getSolicitud($solicitud);
        } catch (Exception $ex) {
            print ($ex);
        }
        $main_contet = $this->load->view('solicitud/secciones.tpl.php', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    function detalle() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
                $solicitud_cve = intval($this->seguridad->decrypt_base64($datos_post['solicitud_cve']));
                $hist_cve = intval($this->seguridad->decrypt_base64($datos_post['hist_solicitudcve']));
//                pr();
//                exit();
                $datosSeccion['solicitud_cve'] = $solicitud_cve;
                $datosSeccion['hist_cve'] = $hist_cve;
//                $datosSeccion['estado_cve'] = $datos_solicitud['estado_cve'];
                $solicitud_datos = $this->req->getSolicitud($solicitud_cve);
                pr($solicitud_datos);
                $secciones = $this->req->getSeccionesSolicitud(); //Obtiene totas las secciones
                $array_comentarios = array();
                foreach ($secciones as $value) {
                    $array_comentarios[$value] = '';
                }
                $datosSeccion['botones_seccion'] = $array_comentarios;
                $data_detalle = $this->load->view('solicitud/buscador/dgaj_revision', $datosSeccion, true);
                $data = array(
                    'titulo_modal' => null,
                    'cuerpo_modal' => $data_detalle,
                    'pie_modal' => null
                );
                echo $this->ventana_modal->carga_modal($data);
            }
        } else {
            redirect(site_url());
        }
    }

    public function enviar_cambio_estado_solicitud() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
                $this->lang->load('interface', 'spanish');
                $tipo_msg = $this->config->item('alert_msg');
                $string_values = $this->lang->line('interface')['solicitud_cambio_estado'];
                $datos_detalle_solicitud = $this->session->userdata('detalle_solicitud'); //Datos del detalle
                $estado_transicion_cve = intval($this->seguridad->decrypt_base64($datos_post['estado_solicitud_cve'])); //Identifica si es un tipo de validar, enviar a correccion o en revisión el estado
                $hist_validacion_actual = intval($datos_detalle_solicitud['histsolicitudcve']); //Identifica si es un tipo de validar, enviar a correccion o en revisión el estado
                $solicitud_cve = intval($datos_detalle_solicitud['solicitud_cve']); //Identifica si es un tipo de validar, enviar a correccion o en revisión el estado
//                pr($datos_post);
                //Obtiene las reglas de estado 
                $reglas_validacion = $this->req->getReglasEstadosSolicitud();
                $estado_ca = $reglas_validacion[$estado_transicion_cve]; //Reglas del estado de transición
                $pasa_validacion_datos = 1;

                if ($pasa_validacion_datos == 1) {
                    $parametro_hist_actual_mod = array('is_actual' => 0);
                    $condicion_actualizacion = array('id' => $hist_validacion_actual);
                    $parametros_insert_hist_val = array('is_actual' => 1, 'solicitud_cve' => $solicitud_cve, 'c_estado_id' => $estado_transicion_cve);
                    $result_cam_estado = $this->req->update_insert_estado_solicitud($parametros_insert_hist_val, $parametro_hist_actual_mod, $condicion_actualizacion);
                    if ($result_cam_estado > 0) {//No existe error, por lo que se actualizo el estado correctamente
                        if (isset($estado_ca['mensaje_guardado_correcto'])) {
                            $data['error'] = $string_values[$estado_ca['mensaje_guardado_correcto']]; //
                        } else {
                            $data['error'] = $string_values['save_default']; //
                        }
                        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                        $data['result'] = 1; //Error resultado success
                    } else {//Manda mensaje de error que no se pudo almacenar los datos
                        $data['error'] = $string_values['save_estado_error']; //
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $data['result'] = 0; //Error resultado success
                    }
                    echo json_encode($data);
                    exit();
                } else {//Regresar mensaje de que no paso el estado cde la validación
                }
            }
        } else {
            redirect(site_url());
        }
    }

    public function comentarios_seccion() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
                $this->lang->load('interface', 'spanish');
//                $tipo_msg = $this->config->item('alert_msg');
                $string_values = $this->lang->line('interface')['solicitud_comentarios_seccion'];
                $solicitud_cve = $this->seguridad->decrypt_base64($datos_post['solicitud_cve']);
                $seccion = $datos_post['seccion_cve'];
//                pr($datos_post);
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $validations = $this->config->item('comentario_jus');
                $this->form_validation->set_rules($validations);
                if ($this->form_validation->run()) {
                    //Obtiene datos del historial
                    $hist_cve = $this->seguridad->decrypt_base64($datos_post['hist_cve']);

                    $insert_comentario = $this->req->insert_comentario_seccion(array('hist_revision_isbn_id' => $hist_cve, 'seccion_cve' => $seccion, 'comentarios' => $datos_post['comentario_justificacion']));
                    $tipo_msg = $this->config->item('alert_msg');
                    if ($insert_comentario > 0) {
                        $data['error'] = $string_values['save_correcto_comentario']; //
                        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                        $data['result'] = 1; //Error resultado success
                    } else {
                        $data['error'] = $string_values['save_incorrecto_comentario']; //
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $data['result'] = 0; //Error resultado success
                    }
                    echo json_encode($data);
                    exit();
                }
                //Obtiene datos de la solicitud
                $array_solicitud = $this->req->get_datos_grales_solicitud($seccion, $solicitud_cve);
                $data_coment['hist_sol'] = $datos_post['hist_cve'];
                $data_coment['seccion'] = $seccion;
                $data_coment['solicitud_cve'] = $datos_post['solicitud_cve'];
                $data_coment['rol_cve'] = $this->session->userdata('rol_cve');

                $data_coment['comentarios_seccion'] = $this->req->get_comentarios_seccion($seccion, $solicitud_cve);
                $data_coment['string_values'] = $string_values;
                $titulo_seccion = '';
                if (!empty($array_solicitud)) {
                    $data_coment['titulo_libro'] = $array_solicitud[0]['titulo_libro'];
                    $data_coment['isbn'] = $array_solicitud[0]['isbn_libro'];
                    $data_coment['subtitulo'] = $array_solicitud[0]['subtitulo_libro'];
                    $titulo_seccion = $string_values['title_seccion'] . $array_solicitud[0]['name_seccion'];
                }
//                pr($datos_post);


                $data = array(
                    'titulo_modal' => $titulo_seccion,
                    'cuerpo_modal' => $this->load->view('solicitud/buscador/comentario_seccion', $data_coment, true),
                    'pie_modal' => $this->load->view('solicitud/buscador/comentario_pie', $data_coment, true)
                );
                echo $this->ventana_modal->carga_modal($data);
            }
        } else {
            redirect(site_url());
        }
    }

    public function guarda_comentario_seccion() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
                $string_values = $this->lang->line('interface')['solicitud_comentarios_seccion'];
                $tipo_msg = $this->config->item('alert_msg');
                $this->lang->load('interface', 'spanish');
                $this->config->load('form_validation'); //Cargar archivo con validaciones
                $this->form_validation->set_rules('comentario_jus');
                if ($this->form_validation->run() == TRUE) {
                    $seccion = $datos_post['seccion_cve'];
                    //Obtiene datos del historial
                    $hist_cve = $this->seguridad->decrypt_base64($datos_post['hist_cve']);

                    $insert_comentario = $this->req->insert_comentario_seccion(array('hist_revision_isbn_id' => $hist_cve, 'seccion_cve' => $seccion, 'comentarios' => $datos_post['comentario_justificacion']));
                    if ($insert_comentario > 0) {
                        $data['error'] = $string_values['save_correcto_comentario']; //
                        $data['tipo_msg'] = $tipo_msg['SUCCESS']['class']; //Tipo de mensaje de error
                        $data['result'] = 1; //Error resultado success
                    } else {
                        $data['error'] = $string_values['save_incorrecto_comentario']; //
                        $data['tipo_msg'] = $tipo_msg['DANGER']['class']; //Tipo de mensaje de error
                        $data['result'] = 0; //Error resultado success
                    }
                }
            }
        } else {
            redirect(site_url());
        }
    }

    function sec_tema() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $data["tema"] = $this->input->post();
                //load from the begining
                if (count($data["tema"]) == 1) {
                    $tema = $this->req->get_tema($data["tema"]["solicitud_id"]);
                    if (is_array($tema)) {
                        $data["tema"] = $tema;
                    }
                } elseif (isset($data["tema"]["id"])) {//update
                    $this->config->load('form_validation'); //Cargar archivo con validaciones
                    $validations = $this->config->item('sol_sec_tema'); //Obtener validaciones de archivo 
                    $this->form_validation->set_rules($validations);

                    $where = array("id" => $data["tema"]["id"]);
                    unset($data["tema"]["id"]);
                    $update = $this->req->update("tema", $data["tema"], $where);
                    if ($update) {
                        $response['message'] = "El tema se ha guardado exitosamente";
                        $response['result'] = "true";
                    } else {
                        $response['message'] = "Se ha producido un error, favor de verificarlo";
                        $response['result'] = "false";
                    }
                } else {
                    $this->config->load('form_validation'); //Cargar archivo con validaciones
                    $validations = $this->config->item('sol_sec_tema'); //Obtener validaciones de archivo 
                    $this->form_validation->set_rules($validations);

                    $save = $this->req->add("tema", $data["tema"]);
                    if ($save) {
                        $update = $this->req->update("solicitud", array("has_tema" => 1), array("id" => $data["tema"]["solicitud_id"]));
                        $response['message'] = "El tema se ha guardado exitosamente";
                        $response['result'] = "true";
                    } else {
                        $response['message'] = "Se ha producido un error, favor de verificarlo";
                        $response['result'] = "false";
                    }
                }
                $data["combos"]["tipo_contenido"] = $this->cg->get_combo_catalogo("c_tipo_contenido");
                $response['content'] = $this->load->view("solicitud/secciones/sec_tema.tpl.php", $data, true);
                echo json_encode($response);
                return 0;
            }
        } else {
            redirect("/");
        }
    }

    function sec_idioma() {
        if ($this->input->is_ajax_request()) {
            /* if($this->input->post()){
              $data["tema"] = $this->input->post();
              if(count($data["tema"])==1){//first load
              //buscar idiomas seleccionados
              }
              } */
            $response['message'] = pr($this->input->post(), true);
            $response['result'] = "true";
            $data["combos"]["idioma"] = $this->cg->get_combo_catalogo("c_idioma");
            $response['content'] = $this->load->view("solicitud/secciones/sec_idioma.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

}
