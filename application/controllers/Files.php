<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona una solicitud
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag 
 * 
 */
class Files extends MY_Controller {

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

    public function index(){
        //get_tipo_file
        if ($this->input->is_ajax_request()) {
            $data["file"] = $this->input->post();
            $data["file"]["_file"] = $_FILES;
            $this->load->model("Files_model","file");
            if(count($data["file"])>1 && isset($_FILES["archivo"])){
                //savefile
                $allowed = array('png', 'jpg', 'gif','zip');
                $data["file"]["_file"] = $_FILES;
                            /*
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
                //saveregister
            }
            $data["debug"] = $data["file"];
            $data["combos"]["c_tipo_file"] = $this->cg->get_tipo_file();
            $response['content'] = $this->load->view("solicitud/secciones/files.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    public function list_files(){
        if ($this->input->is_ajax_request()) {
            $data["post"] = $this->input->post();
            $this->load->model("Files_model","file");
            $data["combos"]["c_tipo_file"] = $this->cg->get_tipo_file();
            $data["files"]=$this->file->file_list($data["post"]["solicitud_id"]);
            $response['content'] = $this->load->view("solicitud/secciones/file_list.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }
}