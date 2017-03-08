<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona una solicitud
 * @version 	: 1.0.0
 * @autor 		: Mr. Guag 
 * 
 */
class Files extends MY_Controller {
    var $route_base;
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
        $this->route_base = "/Applications/mappstack/apache2/htdocs/isbn/assets/js/uf/uploads/";
    }

    public function index(){
        //get_tipo_file
        if ($this->input->is_ajax_request()) {
            $data["file"] = $this->input->post();
            
            $this->load->model("Files_model","file");
            if(count($data["file"])>1 && isset($_FILES["archivo"])){
                //savefile
                $allowed = array('png','jpeg', 'jpg', 'gif','pdf');
                if(isset($_FILES["archivo"]) && $_FILES['archivo']['error'] == 0){
                    //$data["file"]["_file"] = $_FILES;

                    $extension = pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
                    if(!in_array(strtolower($extension), $allowed)){
                        $response["message"] = "El archivo con extensión '".$extension."' no esta permitido";
                    }else{
                        $date = date("Y.m.d.h.i.s");
                        $data["file"]["nombre_fisico"] = $data["file"]["file_type"]."_".$date.".".$extension;

                        $file_id = $this->file->add_file($data["file"]);
                        //saving data
                        if($file_id > 0){
                            $route = $this->route_base;
                            $route .= $data["file"]["solicitud_id"]."/";
                            if(!file_exists($route)){
                                mkdir($route, 0775, true);
                            }
                            
                            if(move_uploaded_file($_FILES['archivo']['tmp_name'], $route.$data["file"]["nombre_fisico"])){
                                $response["message"] = "El archivo se ha guardado correctamente";
                            }else{
                                $response["message"] = "Error al guardar archivo";
                            }
                        }else{
                            $response["message"] = "La información ingresada es incorrecta, favor de berificarla.";
                        }
                    }
                }
                //saveregister
            }
            //$data["debug"] = $data["file"];
            $data["combos"]["c_tipo_file"] = $this->cg->get_tipo_file();
            $response['content'] = $this->load->view("solicitud/secciones/files.tpl.php", $data, true);
            echo json_encode($response);
            return 0;
        } else {
            redirect("/");
        }
    }

    public function list_files($test=null){
        if ($this->input->is_ajax_request()) {
            /*if(!is_null($test)){
                $data["debug"] = "paso de post por actividades";
            }*/
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

    public function delete(){
        if ($this->input->is_ajax_request()) {
            $data["post"] = $this->input->post();
            $this->load->model("Files_model","file");
            $file = $this->file->get($data["post"]["id"]);
            if(is_array($file)){
                $route = $this->route_base;
                $route .= $data["post"]["solicitud_id"]."/";
                @unlink($route.$file["nombre_fisico"]);
                $this->file->delete("files",array("id"=>$data["post"]["id"]));
            }
            $this->list_files();
            //echo json_encode($response);
            //return 0;
        }else {
            redirect("/");
        }
    }
}