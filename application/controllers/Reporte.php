<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que muestra los reportes
 * @version 	: 1.0.0
 * @autor 		: JZDP
 */
class Reporte extends MY_Controller {
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
        $this->load->model("Reporte_model", 'reporte');
    }

    public function index(){
        $this->lang->load('interface');
        $string_values = $this->lang->line('interface')['solicitud_index'];
        $data['string_values'] = $string_values;
        $data['order_columns'] = array('hri.c_estado_id' => $string_values['order_estado_solicitud'], 'lb.title' => $string_values['order_titulo_libro'],
            'lb.subtitle' => $string_values['order_subtitulo_libro'], 'lb.isbn' => $string_values['order_isbn']
        );
        //$rol_sesion = $this->session->userdata('rol_usuario_cve');

        //Carga catálogos
        $array_catalogos = array(Enum_cg::c_estado, Enum_cg::c_entidad, Enum_cg::c_subsistema, Enum_cg::c_categoria, Enum_cg::c_subcategoria);
        $data = carga_catalogos_generales($array_catalogos, $data, null, TRUE, NULL, array(enum_cg::c_estado => 'id', Enum_cg::c_entidad => 'name', Enum_cg::c_subsistema => 'name', Enum_cg::c_categoria => 'nombre', Enum_cg::c_subcategoria => 'nombre'));

        //Carga datos de usuario 
        //$this->session->set_userdata('datos_usuario', $datos_usuario); //entidad

        $main_contet = $this->load->view('reporte/filtros', $data, true);
        $this->template->setCuerpoModal($this->ventana_modal->carga_modal());
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

    public function buscador_solicitudes($current_row = null) {
        if ($this->input->is_ajax_request()) { //Solo se accede al método a través de una petición ajax
            if (!is_null($this->input->post())) {
                $this->lang->load('interface');
                $string_values = $this->lang->line('interface')['tabla_resultados'];
                $filtros = $this->input->post(null, true); //Obtenemos el post o los valores 
                //pr($filtros);
                //pr($this->session->userdata());
                //$datos_usuario = $this->session->userdata('datos_usuario');
                //$filtros += $datos_usuario;
                //$filtros['rol_seleccionado'] = $this->session->userdata('rol_usuario_cve'); //Carga el rol actual (entidad o DGAJ)
                $filtros['current_row'] = (isset($current_row) && !empty($current_row)) ? $current_row : 0;

                $resultado = $this->reporte->get_buscar_solicitudes($filtros);
                //pr($resultado['result']);
                //exit();
                $data['string_values'] = $string_values;
                $data['lista_solicitudes'] = $resultado['result'];
                $data['total'] = $resultado['total'];
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
        $data['controller'] = 'Reporte_model';
        $data['action'] = 'get_buscar_solicitudes';
        $pagination = $this->template->pagination_data($data); //Crear mensaje y links de paginación
        //$pagination = $this->template->pagination_data_buscador_asignar_validador($data); //Crear mensaje y links de paginación
        $links = "<div class='col-sm-5 dataTables_info' style='line-height: 50px;'>" . $pagination['total'] . "</div>
                    <div class='col-sm-7 text-right'>" . $pagination['links'] . "</div>";
        $datos['lista_solicitudes'] = $data['lista_solicitudes'];
        $datos['string_values'] = $data['string_values'];
        echo $links . $this->load->view('reporte/tabla_resultados_solicitudes', $datos, TRUE) . $links . '
                <script>
                $("ul.pagination li a").click(function(event){
                    data_ajax(this, "' . $form['form_recurso'] . '", "' . $form['elemento_resultado'] . '");
                    event.preventDefault();
                });
                </script>';
    }
    
    /**
     * 
     */
    /*public function seccion_index() {
        //echo "SOY UN INDEX....";
        if ($this->input->is_ajax_request()) {
            if (!is_null($this->input->post())) {
                $this->lang->load('interface', 'spanish');
                $string_values = $this->lang->line('interface')['solicitud_detalle'];
                $datosPerfil['string_values'] = $string_values; 
                $datos_post = $this->input->post(null, true); //Obtenemos el post o los valores

                $rol_seleccionado = $this->session->userdata('rol_seleccionado'); //Rol seleccionado de la pantalla de roles

                $datos_solicitud = array();
                $datos_solicitud['estado_correccion'] = null;
                //Validación general de la validación actual del docente
                if (!empty($datos_post['solicitud_cve'])) {
                    $datos_solicitud['solicitud_cve'] = $this->seguridad->decrypt_base64($datos_post['solicitud_cve']); //Identificador de la comisión
                }

                if (!empty($datos_post['histsolicitudcve'])) {
                    $datos_solicitud['histsolicitudcve'] = $this->seguridad->decrypt_base64($datos_post['histsolicitudcve']); //Identificador de la comisión
                }

                //Carga datos de la solicitud del ISBN
                $this->session->set_userdata('detalle_solicitud', $datos_solicitud); //Asigna la información del usuario al que se va a validar

                echo $this->load->view('solicitud/buscador/index', $datosPerfil, true);
            }
        } else {
            redirect(site_url());
        }
    }*/
}