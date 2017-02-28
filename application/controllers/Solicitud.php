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
        $variables = array('detalle_solicitud', 'comentarios_seccion_solitud');
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

        //Obtiene datos para cargar de inicio
        $tmp_get_value = $_SERVER['QUERY_STRING']; //Verificando si tiene variables por GET iduser=487&idcurso=819
        if (!empty($tmp_get_value) & $_SERVER['REQUEST_METHOD'] == 'GET') {
            $varr = array();
            $variable = explode('&', $tmp_get_value);
            if (!empty($variable)and isset($variable[0])and isset($variable[1])) {
                $var_tipo = explode('=', $variable[0]);
                $var_id = explode('=', $variable[1]);
                if ($var_tipo[0] == 'tipo' and $var_id[0] == 'id') {
                    $tipo_f = intval($var_tipo[1]);
                    $value_f = intval($var_id[1]);
                }
            }
        }
//        pr($tipo_f);
//        pr($value_f);
        //********************

        $rol_sesion = $this->session->userdata('rol_cve');
//        pr($this->session->userdata());
        $datos_usuario = array();
        $tipo_busqueda_definida = $this->config->item('tipo_busqueda'); //Carga el tipo de busqueda según el archivo de configuración
//        $array_where = NULL;
        switch ($rol_sesion) {
            case E_rol::ENTIDAD://Entidad
                $datos_usuario['entidad_cve'] = $this->session->userdata('entidad_id');
                $array_catalogos = array(Enum_cg::c_estado, Enum_cg::c_subcategoria);
//                $sub_sistema_id = carga_catalogos_generales(array(Enum_cg::c_entidad), null, array(Enum_cg::c_entidad => array('id' => $datos_usuario['entidad_cve'])), false, null, array(Enum_cg::c_entidad => 'name'));
//                $array_where = array(Enum_cg::c_subsistema => array('id' => $sub_sistema_id[Enum_cg::c_entidad][0]['subsistema_id']));
//                pr($array_where);
                $datos_usuario['mostrar_agrgar_solicitud'] = 1;
                $data['title_template'] = $string_values['title_template_entidad'] . $this->session->userdata('name_entidad');
                //Verifica que se este invocando la carga de algún catálogo y sus permisos
                if (isset($tipo_f) and isset($value_f) and isset($tipo_busqueda_definida[$tipo_f]) and in_array($rol_sesion, $tipo_busqueda_definida[$tipo_f]['rol_permite'])) {//Valida la carga de un valor de un catálogo
                    $data[$tipo_busqueda_definida[$tipo_f]["nom_var"]] = $value_f;
                }
                break;
            case E_rol::DGAJ://Juridico
                $array_catalogos = array(Enum_cg::c_estado, Enum_cg::c_entidad, Enum_cg::c_subcategoria, Enum_cg::c_subsistema);
                $data['title_template'] = $string_values['title_template_dgj'] . $this->session->userdata('rol_name');
                //Verifica que se este invocando la carga de algún catálogo y sus permisos
                if (isset($tipo_f) and isset($value_f) and isset($tipo_busqueda_definida[$tipo_f]) and in_array($rol_sesion, $tipo_busqueda_definida[$tipo_f]['rol_permite'])) {//Valida la carga de un valor de un catálogo
                    $data[$tipo_busqueda_definida[$tipo_f]["nom_var"]] = $value_f;
//                    pr($data);
                }
                break;
            case E_rol::ADMINISTRADOR://Juridico
                $array_catalogos = array(Enum_cg::c_estado, Enum_cg::c_entidad, Enum_cg::c_subcategoria, Enum_cg::c_subsistema);
                $data['title_template'] = $string_values['title_template_dgj'] . $this->session->userdata('rol_name');
                //Verifica que se este invocando la carga de algún catálogo y sus permisos
                if (isset($tipo_f) and isset($value_f) and isset($tipo_busqueda_definida[$tipo_f]) and in_array($rol_sesion, $tipo_busqueda_definida[$tipo_f]['rol_permite'])) {//Valida la carga de un valor de un catálogo
                    $data[$tipo_busqueda_definida[$tipo_f]["nom_var"]] = $value_f;
//                    pr($data);
                }
                break;
            case E_rol::SUPERADMINISTRADOR://Juridico
                $array_catalogos = array(Enum_cg::c_estado, Enum_cg::c_entidad, Enum_cg::c_subcategoria, Enum_cg::c_subsistema);
                $data['title_template'] = $string_values['title_template_dgj'] . $this->session->userdata('rol_name');
                //Verifica que se este invocando la carga de algún catálogo y sus permisos
                if (isset($tipo_f) and isset($value_f) and isset($tipo_busqueda_definida[$tipo_f]) and in_array($rol_sesion, $tipo_busqueda_definida[$tipo_f]['rol_permite'])) {//Valida la carga de un valor de un catálogo
                    $data[$tipo_busqueda_definida[$tipo_f]["nom_var"]] = $value_f;
//                    pr($data);
                }
        }
        //Carga catÃ¡logos
        $data = carga_catalogos_generales($array_catalogos, $data, null, TRUE, NULL, array(enum_cg::c_estado => 'id', Enum_cg::c_entidad => 'name', Enum_cg::c_subcategoria => 'nombre', Enum_cg::c_subsistema => 'name'));

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
        if ($this->input->is_ajax_request()) { //Solo se accede al mÃ©todo a travÃ©s de una peticiÃ³n ajax
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
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginaciÃ³n
        //$pagination = $this->template->pagination_data_buscador_asignar_validador($data); //Crear mensaje y links de paginaciÃ³n
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
            $this->delete_datos_validado(); //Elimina los datos de empleado validado, si se encuentran los datos almacenados en la variable de sesiÃ³n
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
        $this->session->unset_userdata('comentarios_seccion_solitud'); //Limpia comentarios de sección
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
                //ValidaciÃ³n general de la validaciÃ³n actual del docente
                if (!empty($datos_post['solicitud_cve'])) {
                    $datos_solicitud['solicitud_cve'] = $this->seguridad->decrypt_base64($datos_post['solicitud_cve']); //Identificador de la comisiÃ³n
                }

                if (!empty($datos_post['histsolicitudcve'])) {
                    $datos_solicitud['histsolicitudcve'] = $this->seguridad->decrypt_base64($datos_post['histsolicitudcve']); //Identificador de la comisiÃ³n
                }

                if (!empty($datos_post['estado_cve'])) {
                    $datos_solicitud['estado_cve'] = $this->seguridad->decrypt_base64($datos_post['estado_cve']); //Identificador de la comisiÃ³n
                }
                //Genera reglas de estado 
                $reglas_validacion = $this->req->getReglasEstadosSolicitud();
//                pr($reglas_validacion);
                $parametros_estado['reglas_validacion'] = $reglas_validacion;
                $parametros_estado['rol_seleccionado'] = $rol_seleccionado;
                $parametros_estado['estado_cve'] = $datos_solicitud['estado_cve'];
                $datosPerfil['boton_estado'] = genera_botones_estado_solicitud($parametros_estado);

                //Obtiene las propiedades del estado actual
                $propEstadoActual = $reglas_validacion[$parametros_estado['estado_cve']];//
                //********** Obtiene mensajes por sección
                //Propiedades de las secciones
                $secciones = $this->req->getSeccionesSolicitud(); //Obtiene totas las secciones
                $array_comentarios = array();
                if ($propEstadoActual['hidden_add_comment']) {

                    //Recorre las secciones
                    foreach ($secciones as $value) {
                        $array_comentarios[$value] = '<a href="#"'
                                . 'class="comentario"'
                                . 'data-solicitudcve="' . $datos_post['solicitud_cve'] . '"'
                                . 'data-histsolicitudcve="' . $datos_post['histsolicitudcve'] . '"'
                                . 'data-seccioncve="' . $value . '" onclick="ver_comentarios_seccion(this)" '
                                . 'data-toggle="modal" data-target="#modal_censo">'
//                                    . $string_values['add_ver_comment']
                                . '<span class="glyphicon glyphicon-comment btn-msg" '
                                . 'placeholder="' . $string_values['add_ver_comment'] . '"'
                                . 'title="' . $string_values['add_ver_comment'] . '">'
                                . '</span></a>';
                    }
                } else {
                    foreach ($secciones as $value) {
                        $array_comentarios[$value] = '';//Agrega la referencia de los botone de mensajes vacia
                    }
                }
//                pr($array_comentarios);
                $vista = $propEstadoActual['vista'][$rol_seleccionado];
                //Carga la vista actual
                switch ($vista) {
                    case 'detalle':
                        $datosSeccion['solicitud_cve'] = $datos_solicitud['solicitud_cve'];
                        $datosSeccion['hist_cve'] = $datos_solicitud['histsolicitudcve'];
                        $datosSeccion['estado_cve'] = $datos_solicitud['estado_cve'];
                        $datosSeccion['solicitud'] = $this->req->getSolicitud($datosSeccion['solicitud_cve']);
                        $datosSeccion['botones_seccion'] = $array_comentarios; //Iconos de sección comentarios
                        $datosSeccion["tipoColab"] = $this->cg->get_combo_catalogo("c_tipo_colab");
                        $datosSeccion["c_nacionalidad"] = $this->cg->get_combo_catalogo("c_nacionalidad");
                        $datosPerfil['vista'] = $this->load->view('solicitud/buscador/dgaj_revision', $datosSeccion, true);
                        break;
                    case 'editar_registro'://La edición de registro se presenta en la correccion basicamente
                        $data = null;
                        try {
                            $info_solicitud = $this->req->getSolicitud(intval($datos_solicitud['solicitud_cve']));
//                            pr($info_solicitud);
                            $data["tipoColab"] = $this->cg->get_combo_catalogo("c_tipo_colab");
                            $data["datos"]["solicitud"] = $info_solicitud;
                            $data["combos"]["c_idioma"] = $this->cg->get_combo_catalogo("c_idioma");
                            $data["secciones"] = $this->req->get_sections();
//                            $data["secciones"] = $info_solicitud['secciones'];
                        } catch (Exception $ex) {
                            print ($ex);
                        }
                        $datosSeccion['botones_seccion'] = $array_comentarios;
                        $this->session->set_userdata('botones_seccion', $array_comentarios); //Guarda los botones de los comentarios de las secciones
                        $datosPerfil['vista'] = $this->load->view('solicitud/secciones.tpl.php', $data, true);

                        break;
                }
                //Carga datos de la solicitud del ISBN
                $this->session->set_userdata('detalle_solicitud', $datos_solicitud); //Asigna la informaciÃ³n del usuario al que se va a validar
                echo $this->load->view('solicitud/buscador/index', $datosPerfil, true);
            }
//            pr($this->session->userdata('datosvalidadoactual'));$datos_empleado_validar
        } else {
            redirect(site_url());
        }
    }

    function registrar($solicitud_id=0) {

        // pr($this->session->userdata());    
        $id_entidad = $this->session->userdata("entidad_id"); //from session
        $id_categoria = null;
        $id_subcategoria = null;
        $rol_seleccionado = $this->session->userdata('rol_cve'); //Rol seleccionado de la pantalla de roles
        if($solicitud_id > 0){
            $data["solicitud"] = $this->req->getSolicitud($solicitud_id,false);
        }
        //pr($data);
        //si tiene datosbusca por id
        if ($this->input->post()) {
            $data["save"] = $this->input->post();
            
            $this->config->load('form_validation'); //Cargar archivo con validaciones
            $validations = $this->config->item('solicitud'); //Obtener validaciones de archivo 
            $this->form_validation->set_rules($validations); //AÃ±adir validaciones
            if ($this->form_validation->run()) {
                //pr($data["save"]);
                if(isset($data["save"]["solicitud_id"])){ //edit
                    $update = $this->req->editSolicitud($data["save"]);
                    //redirect("solicitud/registrar/".$data["save"]["solicitud_id"]);
                    redirect("solicitud");
                }else{ //save
                    $data["save"]["solicitud"]["entidad_id"] = $id_entidad;
                    $solicitud = $this->req->addSolicitud($data["save"]);
                    if ($solicitud > 0) {
                        //redirect("solicitud/secciones/$solicitud");
                        redirect("solicitud");
                    }
                }
            }
        }
        $data["combos"]["categorias"] = $this->req->listCategoria();
        $data["combos"]["sub_categorias"] = $this->req->listSubCategoria();

        //Genera reglas de estado 
        $reglas_validacion = $this->req->getReglasEstadosSolicitud();
        $parametros_estado['reglas_validacion'] = $reglas_validacion;
        $parametros_estado['rol_seleccionado'] = $rol_seleccionado;
        $parametros_estado['estado_cve'] = Enum_es::__default; //Estado inicial para enviar una solicitud
        $data['boton_estado'] = genera_botones_estado_solicitud($parametros_estado);
//        pr($data['boton_estado']);

        $main_contet = $this->load->view('solicitud/registrar.tpl.php', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    function sub_categoria(){
        if ($this->input->is_ajax_request()) {
            $categoria = $this->input->post();
            //pr($categoria);
            if(isset($categoria["categoria"])){
                $data["combos"]["sub_categorias"] = $this->req->listSubCategoria($categoria["categoria"]);
            }
            $response['content'] = $this->load->view("solicitud/secciones/subcategoria.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function secciones($solicitud) {
        //echo $solicitud;
        $data = array();
        try {
            $data["datos"]["solicitud"] = $this->req->getSolicitud($solicitud, FALSE);
            $data["combos"]["c_idioma"] = $this->cg->get_combo_catalogo("c_idioma");
            $data["secciones"] = $this->req->get_sections();
            //$data["files"] = "Mis archivos";
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
                $rol_actual = $this->session->userdata('rol_cve'); //Rol seleccionado actual
//                pr($datos_post);
//                exit();
//                pr($solicitud_cve);
                $datosSeccion['solicitud_cve'] = $solicitud_cve;
                $datosSeccion['hist_cve'] = $hist_cve;
//                $datosSeccion['estado_cve'] = $datos_solicitud['estado_cve'];
                $solicitud_datos = $this->req->getSolicitud($solicitud_cve);
//                pr($solicitud_datos);
                $secciones = $this->req->getSeccionesSolicitud(); //Obtiene totas las secciones
                $datosSeccion['solicitud'] = $solicitud_datos;
                $datosSeccion['is_botones'] = $solicitud_datos;
                $array_comentarios = array();
                foreach ($secciones as $value) {
                    $array_comentarios[$value] = '';
                }
                $datosSeccion['botones_seccion'] = $array_comentarios;

                $datosSeccion['link_editar'] = '';
                if (isset($datos_post['is_botones']) and $datos_post['is_botones'] == 1 and $rol_actual == E_rol::ENTIDAD) {//Genera botones para editar la información de la solicitid 
//                        data-dismiss="modal"
                    $boton_editar = '<a class="btn btn-default" data-toggle="tab" href="#select_perfil_solicitud" 
                        data-dismiss="modal"
                        onclick="funcion_ver_solicitud_entidad(this)" 
                        data-solicitudcve="' . $datos_post['solicitud_cve'] . '" 
                        data-histsolicitudcve="' . $datos_post['hist_solicitudcve'] . '" 
                        data-estadosolicitudcve="' . $datos_post['estado_solicitud'] . '" 
                        data-row="0" aria-expanded="true">
                        Editar
                        </a>';
                    $datosSeccion['link_editar'] = $boton_editar;
                }
//                pr($this->get_datos_detalle_solicitud($solicitud_datos));
                $datosSeccion["tipoColab"] = $this->cg->get_combo_catalogo("c_tipo_colab");
                $datosSeccion["c_nacionalidad"] = $this->cg->get_combo_catalogo("c_nacionalidad");
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

    function historial() {
        if ($this->input->is_ajax_request()) {
            if ($this->input->post()) {
                $this->load->helper('date');
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores
                $solicitud_cve = intval($this->seguridad->decrypt_base64($datos_post['solicitud_cve']));

                $solicitud_datos['data'] = $this->req->getHistorial($solicitud_cve);
                $data_detalle = $this->load->view('solicitud/historial', $solicitud_datos, true);
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
                $estado_transicion_cve = intval($this->seguridad->decrypt_base64($datos_post['estado_solicitud_cve'])); //Identifica si es un tipo de validar, enviar a correccion o en revisiÃ³n el estado
                $hist_validacion_actual = intval($datos_detalle_solicitud['histsolicitudcve']); //Identifica si es un tipo de validar, enviar a correccion o en revisiÃ³n el estado
                $solicitud_cve = intval($datos_detalle_solicitud['solicitud_cve']); //Identifica si es un tipo de validar, enviar a correccion o en revisiÃ³n el estado
//                pr($datos_post);
                //Obtiene las reglas de estado 
                $reglas_validacion = $this->req->getReglasEstadosSolicitud();
                $estado_ca = $reglas_validacion[$estado_transicion_cve]; //Reglas del estado de transiciÃ³n
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
                } else {//Regresar mensaje de que no paso el estado cde la validaciÃ³n
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
                $estado_solisitud = $this->session->userdata('detalle_solicitud')['estado_cve'];
                $rol_seleccionado = $this->session->userdata('rol_cve');
                $reglas_validacion = $this->req->getReglasEstadosSolicitud()[$estado_solisitud]; //Obtiene reglas de estado
                $data_coment['add_comment_seccion'] = $reglas_validacion['add_comment_seccion'][$rol_seleccionado];

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
                //Obtiene icono botón del comentario ***************
                $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::TEMA])) ? $this->session->userdata('botones_seccion')[En_secciones::TEMA] : ''; //Botones de comentarios para las secciones
//                pr($data['comentarios']);
//                exit();
                //Fin ***************
                $data["combos"]["tipo_contenido"] = $this->cg->get_combo_catalogo("c_tipo_contenido", "id", "nombre", null, "nombre asc");
                $response['content'] = $this->load->view("solicitud/secciones/sec_tema.tpl.php", $data, true);
                echo json_encode($response);
                return 0;
            }
        } else {
            redirect("/");
        }
    }

    function sec_sol_idioma() {
        if ($this->input->is_ajax_request()) {
            $data["idiomas"] = $this->input->post();

            if (count($data["idiomas"]) == 1) {//load idiomas
                load:
                $idiomas = $this->req->get_idiomas($data["idiomas"]["solicitud_id"]);

                if (is_array($idiomas) && !empty($idiomas)) {
                    foreach ($idiomas as $id => $idioma) {
                        $data["idiomas"]["idiomas"][$id] = $idioma["idioma"];
                    }
                    //$data["debug"]["idiomas"] = $data["idiomas"]["idiomas"];
                }
            } else if (isset($data["idiomas"]["idiomas"])) {//save
                $lang = explode(",", $data["idiomas"]["idiomas"]);
                $data["idiomas"]["idiomas"] = $lang = array_filter($lang);

                //remover registros
                $this->req->delete("sol_idioma", array("solicitud" => $data["idiomas"]["solicitud_id"]));
                //registrar idiomas
                foreach ($lang as $id => $row) {
                    $save = array(
                        "idioma" => $row,
                        "solicitud" => $data["idiomas"]["solicitud_id"]
                    );
                    //$data["debug"]["idioma_".$id] = $this->req->add("sol_idioma",$save,TRUE);
                    if (!$this->req->add("sol_idioma", $save, TRUE)) {
                        $data["debug"][$id] = $save;
                    }
                }
                $response['message'] = "Los idiomas se han guardado exitosamente";
                goto load;
            }
//            pr($this->session->userdata('botones_seccion'));
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::IDIOMA])) ? $this->session->userdata('botones_seccion')[En_secciones::IDIOMA] : ''; //Botones de comentarios para las secciones
            //Fin ***************
            //$response['message'] = 
            $response['result'] = "true";

            $data["combos"]["c_idioma"] = $this->cg->get_combo_catalogo("c_idioma");
            $response['content'] = $this->load->view("solicitud/secciones/sec_sol_idioma.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec_traduccion() {
        if ($this->input->is_ajax_request()) {
            $data["traduccion"] = $this->input->post();
            //load from the begining
            begining:
            //pr($data);
            if(isset($data["traduccion"]["del"])){
                //pr($data);
                echo "entra caramba!!!!";
                unset($data["traduccion"]["del"]);
                unset($data["traduccion"]["id"]);
                $response['message'] = "La traducción se ha eliminado ";
            }elseif (count($data["traduccion"]) == 1) {
                load:
                // $data["debug"][0] = 
                $data["traduccion"] = $this->req->get_section("traduccion", array(
                    "solicitud_id" => $data["traduccion"]["solicitud_id"]
                ));
                if (count($data["traduccion"]) == 1) {
                    $data["traduccion"] = $data["traduccion"][0];
                    $data["traduccion"]["has_traduction"] = 1;
                }
            }elseif (isset($data["traduccion"]["id"])) {
                $where = array("id" => $data["traduccion"]["id"]);
                unset($data["traduccion"]["id"]);
                unset($data["traduccion"]["has_traduction"]);
                $update = $this->req->update("traduccion", $data["traduccion"], $where);
                if ($update) {
                    $response['message'] = "La traducción se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
                //$data["debug"][1]="update;";
                goto load;
            } else {
                unset($data["traduccion"]["has_traduction"]);
                $save = $this->req->add("traduccion", $data["traduccion"]);
                if ($save) {
                    $update = $this->req->update("solicitud", array("has_traduccion" => 1), array("id" => $data["traduccion"]["solicitud_id"]));
                    $response['message'] = "La sección se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
                //$data["debug"][2]="new brand";
                goto load;
            }

            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::TRADUCCION])) ? $this->session->userdata('botones_seccion')[En_secciones::TRADUCCION] : ''; //Botones de comentarios para las secciones
            //Fin ***************

            $response['result'] = "true";
            $data["combos"]["c_idioma"] = $this->cg->get_combo_catalogo("c_idioma");

            // $data["combos"]["c_idioma_del"] = $this->cg->get_combo_catalogo("c_idioma");
            // $data["combos"]["c_idioma_al"] = $this->cg->get_combo_catalogo("c_idioma");
            $response['content'] = $this->load->view("solicitud/secciones/sec_traduccion.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec_colaboradores() {
        if ($this->input->is_ajax_request()) {
            $data["debug"]["colab"] = $data["colab"] = $this->input->post();
            //$response['message'] = "Mi mensaje de colaboradores";
            if(isset($data["colab"]["eliminar"]) && $data["colab"]["eliminar"]){
                unset($data["colab"]["eliminar"]);
                $this->req->delete('colaboradores', $data["colab"]); 
                $response['message'] = "La información del colaborador/autor se ha eliminado exitosamente";
                $response['result'] = "true";
            }
            elseif (count($data["colab"]) == 1 && isset($data["colab"]["solicitud_id"])) {
                //$data["debug"]="load section";
                $response['result'] = "true";
            } elseif (isset($data["colab"]["update"])) {//update
                $where = array("solicitud_id" => $data["colab"]["solicitud_id"],
                    "id_colab" => $data["colab"]["id_colab"]);
                unset($data["colab"]["id_colab"]);
                unset($data["colab"]["solicitud_id"]);
                unset($data["colab"]["update"]);
                $update = $this->req->update("colaboradores", $data["colab"], $where);
                if ($update) {
                    $response['message'] = "La información del colaborador se ha editado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            } elseif (isset($data["colab"]["id_colab"])) {
                $data["colab"] = $this->req->get_section("colaboradores", array("solicitud_id" => $data["colab"]["solicitud_id"],
                    "id_colab" => $data["colab"]["id_colab"]
                        )
                );
                if (count($data["colab"]) == 1) {
                    $data["colab"] = $data["colab"][0];
                }
            } else {
                //$data["debug"]="save";
                $save = $this->req->add("colaboradores", $data["colab"]);
                if ($save) {
                    $update = $this->req->update("solicitud", array("has_colaboradores" => 1), array("id" => $data["colab"]["solicitud_id"]));
                    $response['message'] = "La información del colaborador se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            }
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::COLABORADORES])) ? $this->session->userdata('botones_seccion')[En_secciones::COLABORADORES] : ''; //Botones de comentarios para las secciones
            $data["combos"]["c_nacionalidad"] = $this->cg->get_combo_catalogo("c_nacionalidad");
            $data["combos"]["c_tipo"] = $this->cg->get_combo_catalogo("c_tipo_colab");


            $response['content'] = $this->load->view("solicitud/secciones/sec_colaboradores.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec_edicion() {
        if ($this->input->is_ajax_request()) {
            //$data["debug"] = 
            $data["edicion"] = $this->input->post();

            if (count($data["edicion"]) == 1 && isset($data["edicion"]["solicitud_id"])) {
                $edicion = $this->req->get_section("edicion", array(
                    "solicitud_id" => $data["edicion"]["solicitud_id"]
                ));
                if (count($edicion) > 0) {
                    $data["edicion"] = $edicion[0];
                }
                $response['result'] = "true";
            } elseif (count($data["edicion"]) > 1 && !isset($data["edicion"]["id"])) {
                if (isset($data["edicion"]["coedicion"])) {
                    $data["edicion"]["coedicion"] = 1;
                }
                //save
                $save = $this->req->add("edicion", $data["edicion"]);
                if ($save) {
                    $update = $this->req->update("solicitud", array("has_informacion_edicion" => 1), array("id" => $data["edicion"]["solicitud_id"])
                    );
                    $response['message'] = "La información de edición se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            } elseif (count($data["edicion"]) > 1 && isset($data["edicion"]["id"])) {
                //edit
                $data["edicion"]["coedicion"] = isset($data["edicion"]["coedicion"]) ? 1 : 0;
                //$data["debug"] = $data["edicion"];
                $where = array(
                    "solicitud_id" => $data["edicion"]["solicitud_id"],
                    "id" => $data["edicion"]["id"]
                );
                $update = $this->req->update("edicion", $data["edicion"], $where);
                if ($update) {
                    $response['message'] = "La Información de edición se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            }
            $response['result'] = "true";
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::INFO_EDICION])) ? $this->session->userdata('botones_seccion')[En_secciones::INFO_EDICION] : ''; //Botones de comentarios para las secciones
            //Fin ***************

            $data["combos"]["c_ciudad"] = $this->cg->get_combo_catalogo("c_ciudad");
            $data["combos"]["c_departamento"] = $this->cg->get_combo_catalogo("c_departamento");

            $response['content'] = $this->load->view("solicitud/secciones/sec_edicion.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec_epay() {
        if ($this->input->is_ajax_request()) {
            $data["epay"] = $this->input->post();

            if (count($data["epay"]) == 1 && isset($data["epay"]["solicitud_id"])) {
                $epay = $this->req->get_section("epay", array(
                    "solicitud_id" => $data["epay"]["solicitud_id"]
                ));
                if (count($epay) > 0) {
                    $data["epay"] = $epay[0];
                }
                $response['result'] = "true";
            } elseif (count($data["epay"]) > 1 && !isset($data["epay"]["id"])) {
                //save
                //$data["debug"] = $data["epay"];
                $save = $this->req->add("epay", $data["epay"]);
                if ($save) {
                    $update = $this->req->update("solicitud", array("has_pago" => 1), array("id" => $data["epay"]["solicitud_id"])
                    );
                    $response['message'] = "La información del pago se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            } elseif (count($data["epay"]) > 1 && isset($data["epay"]["id"])) {
                //edit
                //$data["debug"] = $data["epay"];
                $where = array(
                    "solicitud_id" => $data["epay"]["solicitud_id"],
                    "id" => $data["epay"]["id"]
                );
                $update = $this->req->update("epay", $data["epay"], $where);
                if ($update) {
                    $response['message'] = "La información del pago se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            }
            $response['result'] = "true";
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::PAGO_ELECTRONICO])) ? $this->session->userdata('botones_seccion')[En_secciones::PAGO_ELECTRONICO] : ''; //Botones de comentarios para las secciones
            //Fin ***************

            $response['content'] = $this->load->view("solicitud/secciones/sec_epay.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec_comercializable() {
        if ($this->input->is_ajax_request()) {
            $data["comercializable"] = $this->input->post();
            //$data["debug"] = $data["comercializable"];
            if (count($data["comercializable"]) == 1 && isset($data["comercializable"]["solicitud_id"])) {
                $comercializable = $this->req->get_section("comercializable", array(
                    "solicitud_id" => $data["comercializable"]["solicitud_id"]
                ));
                if (count($comercializable) > 0) {
                    $data["comercializable"] = $comercializable[0];
                }
                //$data["debug"] = $data["comercializable"];
                $response['result'] = "true";
            } elseif (count($data["comercializable"]) > 1 && !isset($data["comercializable"]["id"])) {
                //save

                $save = $this->req->add("comercializable", $data["comercializable"]);
                if ($save) {
                    $update = $this->req->update("solicitud", array("has_comercializable" => 1), array("id" => $data["comercializable"]["solicitud_id"])
                    );
                    $response['message'] = "Los datos de Comercialización se han guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            } elseif (count($data["comercializable"]) > 1 && isset($data["comercializable"]["id"])) {
                //edit
                $where = array(
                    "solicitud_id" => $data["comercializable"]["solicitud_id"],
                    "id" => $data["comercializable"]["id"]
                );
                $update = $this->req->update("comercializable", $data["comercializable"], $where);
                if ($update) {
                    $response['message'] = "La Información de edición se ha guardado exitosamente";
                    $response['result'] = "true";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                }
            }


            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::COMERCIALIZACION])) ? $this->session->userdata('botones_seccion')[En_secciones::COMERCIALIZACION] : ''; //Botones de comentarios para las secciones
            //Fin ***************

            $response['content'] = $this->load->view("solicitud/secciones/sec_comercializable.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec__descripcion_fisica() {
        if ($this->input->is_ajax_request()) {
            $data["df"] = $this->input->post();
            $solicitud_id = $data["df"]["solicitud_id"];
            //print_r($data["df"]);
            $fields = array("medio", "formato","tamanio_desc", "tamanio", "id", "solicitud_id");
            $tabla = array("print" => "desc_fisica_impresa", "digital" => "
                desc_electronica");
            $tipo = "print";
            if (isset($data["df"]["rad_df"])) {//salvar
                $tipo = $data["df"]["rad_df"];
                unset($data["df"]["rad_df"]);
                if ($tipo == "digital") {
                    foreach ($data["df"] as $key => $field) {
                        if (!in_array($key, $fields)) {
                            unset($data["df"][$key]);
                        }
                    }
                } elseif ($tipo == "print") {
                    foreach ($data["df"] as $key => $field) {
                        if (in_array($key, $fields)) {
                            unset($data["df"][$key]);
                        }
                    }
                    $data["df"]["solicitud_id"] = $solicitud_id;
                }
                $this->req->delete("desc_fisica_impresa", 
                                    array("solicitud_id"=>$solicitud_id)); 
                $this->req->delete("desc_electronica", 
                                    array("solicitud_id"=>$solicitud_id)); 
                $save = $this->req->add($tabla[$tipo], $data["df"]);
                if ($save) {
                    $update = $this->req->update("solicitud", array("has_desc_fisica" => 1), array("id" => $data["df"]["solicitud_id"])
                    );
                    $response['message'] = "La descripción de la obra se ha guardado exitosamente";
                } else {
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                }
            }
            foreach ($tabla as $key => $value) {
                //pr($value);
                $df = $this->req->get_section($value, array(
                    "solicitud_id" => $solicitud_id
                ));
                if (count($df) === 1) {
                    $data["df"] = $df[0];
                    $data["df"]["rad_df"] = $key;
                    break;
                }
            }

            //$data["debug"] = $data["df"];
            $data["_descripcion_fisica"] = $data["df"];
            unset($data["df"]);
            $response['result'] = "true";
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::DESC_FISICA])) ? $this->session->userdata('botones_seccion')[En_secciones::DESC_FISICA] : ''; //Botones de comentarios para las secciones
            //Fin ***************

            $data["combos"]["c_desc_fisica"] = $this->cg->get_combo_catalogo("c_desc_fisica");
            $data["combos"]["c_encuadernacion"] = $this->cg->get_combo_catalogo("c_encuadernacion");
            $data["combos"]["c_gramaje"] = $this->cg->get_combo_catalogo("c_gramaje");
            $data["combos"]["c_impresion"] = $this->cg->get_combo_catalogo("c_impresion");
            //$data["combos"]["c_tinta"] = $this->cg->get_combo_catalogo("c_tinta");
            $data["combos"]["c_tipo_papel"] = $this->cg->get_combo_catalogo("c_tipo_papel");
            $data["combos"]["c_formato"] = $this->cg->get_combo_catalogo("c_formato");
            $data["combos"]["c_medio"] = $this->cg->get_combo_catalogo("c_medio");
            $data["combos"]["c_tamanio"] = $this->cg->get_combo_catalogo("c_tamanio");
            $data["combos"]["c_num_tintas"] = $this->cg->get_combo_catalogo("c_num_tintas");

            $response['content'] = $this->load->view("solicitud/secciones/sec_desc_fisica.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function sec_barcode() {
        if ($this->input->is_ajax_request()) {
            $data["debug"] = $data["barcode"] = $this->input->post();

            $response['result'] = "true";
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::CODIGO_BARRAS])) ? $this->session->userdata('botones_seccion')[En_secciones::CODIGO_BARRAS] : ''; //Botones de comentarios para las secciones
            //Fin ***************

            $response['content'] = $this->load->view("solicitud/secciones/sec_barcode.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function file() {
        if (!$this->input->is_ajax_request()) {
            redirect("/");
        }
        $post = $this->input->post();
        //pr($post);
        if (isset($post["option"]) && isset($post["solicitud_id"])) {
            switch ($post["option"]) {
                case "add":
                    $response['message'] = "add";
                    $response['result'] = "true";
                    //subir archivo
                    //guardar en BD
                    break;
                case "remove":
                    $response['message'] = "remove";
                    $response['result'] = "true";
                    break;
                default:
                    $response['message'] = "Se ha producido un error, favor de verificarlo";
                    $response['result'] = "false";
                    break;
            }
            $data["file_list"] = $this->req->get_section("files", array("solicitud_id" => $post["solicitud_id"]));
            $response['content'] = $this->load->view("solicitud/secciones/file_list.tpl.php", $data, true);
        } else {
            $response['message'] = "Se ha producido un error, favor de verificarlo";
            $response['result'] = "false";
        }
        echo json_encode($response);
        return 0;

        /*
          $allowed = array('png', 'jpg', 'gif','zip');

          if(isset($_FILES["upl"]) && $_FILES['upl']['error'] == 0){
          $extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);
          if(!in_array(strtolower($extension), $allowed)){
          echo '{"status":"error"}';
          exit;
          }
          $route = "/Applications/mappstack/apache2/htdocs/isbn/assets/uf/uploads/".$_FILES['upl']['name'];
          $test = array("status"=>"success");
          if(isset($_POST["jesus"])){
          $test["prueba"] = $_POST["jesus"];
          }
          if(move_uploaded_file($_FILES['upl']['tmp_name'], $route)){
          echo json_encode($test);
          exit;
          }
          }
          echo '{"status":"error"}';
          exit; */
    }

    function sec_files() {
        if ($this->input->is_ajax_request()) {
            $data["files"] = $this->input->post();
            $data["file_list"] = $this->req->get_section(
                    "files", array(
                "solicitud_id" => $data["files"]["solicitud_id"]
                    )
            );
            $response['result'] = "true";
            //Obtiene icono botón del comentario ***************
            $data['comentarios'] = (!is_null($this->session->userdata('botones_seccion')[En_secciones::ARCHIVOS])) ? $this->session->userdata('botones_seccion')[En_secciones::ARCHIVOS] : ''; //Botones de comentarios para las secciones
            //Fin ***************
            $response['content'] = $this->load->view("solicitud/secciones/registro_documentacion.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    function seccion() {
        if ($this->input->is_ajax_request()) {
            $data["debug"] = $data["seccion"] = $this->input->post();

            //load from the begining
            if (count($data["seccion"]) == 2 && isset($data["seccion"]["seccion_id"]) && isset($data["seccion"]["solicitud_id"])) {
                load:
                $data["debug"][0] = "Load";
                //buscar registro
            } elseif (isset($data[$data["seccion_id"]["id"]])) {
                //update
                $data["debug"][1] = "update";
                goto load;
            } else {

                $data["debug"][2] = "new brand";
                goto load;
            }
            $response['result'] = "true";


            $response['content'] = $this->load->view("solicitud/secciones/sec_" . $data['seccion']['seccion_id'] . ".tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

}
