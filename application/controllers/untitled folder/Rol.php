<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que contiene métodos para registro de participantes en talleres
 * @version 	: 1.0.0
 * @author      : Pablo José
 * */
class Rol extends MY_Controller {

    private $estado_taller;

    /*     * *********Costructor
     * Función inicial que atrae los atributos de libreria captcha_becas, form_validation y form_complete
     */

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_complete');
        $this->load->library('seguridad');
        $this->load->library('empleados_siap');
        $this->load->model('Registro_model', 'mod_registro');
        $this->load->config('general');
        $this->config->load('general');
        $this->load->model('Login_model', 'lm');
        //$this->lang->load('interface');
    }

    /*     * *********Registro de participantes
     * Función que determina el tipo de usuario y lo dirige a su página de bienvenida
     * @method: void index()
     * @author: Pablo José J.
     */

    public function index() {
        $data= array();
        if ($this->input->post()) { //Validar que la información se haya enviado por método POST para almacenado
            //Carga herramientas de mensajes de texto al usuario 
            $this->lang->load('interface', 'spanish');
            $mensajes = $this->lang->line('interface');
            $tipo_msg = $this->config->item('alert_msg');
            $value = $this->input->post('seleciion_role', TRUE);
//            pr($value);
            if (empty($value)) {
                //Mostrar mensaje de advertencia para seleccionar un rol
                $this->session->set_userdata('rol_seleccionado', array());
                $data['error'] = $mensajes['rol']['lbl_selecciona_rol'];
                $data['tipo_msg'] = $tipo_msg['WARNING']['class'];
            } else {
                //Cargar controlador
                $lista_roles_modulos = $this->session->userdata('lista_roles_modulos'); //Módulos de acceso del usuario
                $rol_seleccionado = get_array_valor($lista_roles_modulos, $value);
                $this->session->set_userdata('rol_seleccionado', $rol_seleccionado);
                redirect('perfil');
            }
        }
//        pr($this->session->userdata('rol_seleccionado'));
        $lista_roles = $this->session->userdata('lista_roles');
        $data['lista_roles'] = $lista_roles;
        $main_contet = $this->load->view('login/Selection_role_tpl', $data, true);
        $this->template->setMainContent($main_contet);
        $this->template->getTemplate();
    }

}
