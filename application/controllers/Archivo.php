<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Clase que gestiona el login
 * @version 	: 1.0.0
 * @autor 		: Jesús Díaz P. & Pablo José
 */

class Archivo extends CI_Controller {
    /**
     * * Carga de clases para el acceso a base de datos y para la creación de elementos del formulario
     * * @access 		: public
     * * @modified 	: 
     */
    public function __construct() {
        parent::__construct();        
        
        $this->load->database();
    }
    
    public function index(){
        redirect('login');
    }

    public function descarga($file=null, $descarga=true){
        $html = '<div role="alert" class="alert alert-success" style="padding:25px; margin-bottom:80px;"><button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button><h4>Archivo incorrecto.</h4></div>';
        
        if(!is_null($file)){
            $file = urlencode($file); ///Decodificar url, evitar hack
            if(strlen($file)<=70) { //Validar longitud y existencia del archivo
                $this->load->model("Solicitud_model", "solicitud");
                $archivo = $this->solicitud->get_archivo($file); //Se valida que exista registro en base de datos

                if(!empty($archivo)){
                    $this->config->load('general'); //Se cargan archivos de configuración
                    $ruta_archivo = $this->config->item('ruta_documentacion').$archivo[0]['solicitud_id']."/".$archivo[0]['arc_nombre'];
                    if(file_exists($ruta_archivo)){
                        $ext = pathinfo($ruta_archivo, PATHINFO_EXTENSION);
                        header('Content-Description: File Transfer');
                        if($ext!="pdf"){
                            header('Content-Type: application/octet-stream');
                        } else {
                            header('Content-type: application/pdf');
                        }
                        if($descarga==true){ ///Descargar
                            header('Content-Disposition: attachment; filename="'.$archivo[0]['req_nombre'].'.'.$ext.'"');
                        } else { ///Ver en línea
                            header('Content-Disposition: inline; filename="'.$archivo[0]['req_nombre'].'.'.$ext.'"');
                        }
                        header('Content-Transfer-Encoding: binary');
                        header('Expires: 0');
                        header('Cache-Control: must-revalidate');
                        header('Pragma: public');
                        header('Content-Length: ' . filesize($ruta_archivo));
                        ob_clean();
                        flush();
                        //readfile($ruta_archivo);
                        echo file_get_contents($ruta_archivo);
                        exit;
                    }
                }
            }
        }
        $this->template->setMainContent($html);
        $this->template->getTemplate();
    }
}