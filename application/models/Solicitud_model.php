<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends MY_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    function addSolicitud($data){
        return true;
    }

    function getList($id=null,$filtro=array(),$offset=0,$limit=10,$array=true){
    }

    function getSolicitud($id=null,$array=true){
    	if(is_null($id)){
    		throw new Exception("Identificador no definido", 1);
    	}

        //solicitud
        $this->db->where("solicitud.id",$id);
    	$result = $this->db->get("solicitud");
        if($result->num_rows()<1){
            throw new Exception("El identificador no se encuentra registrado", 1);
        }
        $solicitud = $result->row_array();
        $result->free_result();

        $solicitud["entidad"] = $this->getEntidad($solicitud["entidad_id"]);
        $solicitud["libro"] = $this->getLibro($solicitud["libro_id"]);
        $solicitud["clasificacion_tematica"] = $this->getClasifTematica($solicitud["id_subcategoria"]);
        // secciones
        $secciones = $this->db->get("seccion_solicitud");
        foreach ($secciones->result_array() as $seccion) {
            $solicitud["secciones"][$seccion["cve_seccion"]]="hello world_".$seccion["cve_seccion"];
        }

        return $solicitud;
    }

    function getEntidad($id=null){
        if(is_null($id)){
            throw new Exception("Identificador no definido", 1);
        }

        $this->db->select("c_entidad.id as id, c_entidad.name as nombre, c_entidad.code, 
            c_subsistema.id as subsistema_id, c_subsistema.name as subsistema_nombre");
        $this->db->where("c_entidad.id",$id);
        $this->db->join("c_subsistema","c_subsistema.id=c_entidad.subsistema_id");
        $result = $this->db->get("c_entidad");
        // echo $this->db->last_query();
        if($result->num_rows() != 1){
            throw new Exception("Error inesperado en la entidad {$id}", 1);
        }
        $entidad = new Entidad_dao();
        $entidad->id = $result->row()->id;
        $entidad->nombre = $result->row()->nombre;
        $entidad->code = $result->row()->code;
        $entidad->subsistema_id = $result->row()->subsistema_id;
        $entidad->subsistema_nombre = $result->row()->subsistema_nombre;
        $result->free_result();
        return $entidad;
    }

    function listCategoria($id_categoria=null){
        if(!is_null($id_categoria)){
            $this->db->where("id_categoria",$id_categoria);
        }
        $result = $this->db->get("c_categoria");
        if($result->num_rows() != 1){
            throw new Exception("El catálogo esta vacio", 1);
        }
        $list = $result->result_array();
        $result->free_result();
        return $list;
    }

    function listSubCategoria($id_categoria=null,$id_subcategoria=null){
        if(!is_null($id_subcategoria)){
            $this->db->where("id",$id_subcategoria);
        }elseif(!is_null($id_categoria)){
            $this->db->where("id_categoria",$id_categoria);
        }
        $result = $this->db->get("c_subcategoria");
        if($result->num_rows() != 1){
            throw new Exception("La categoria {$id} no existe", 1);
        }
        $list = $result->result_array();
        $result->free_result();
        return $list;
    }

    function getLibro(){
        return new Libro_dao();
    }

    function getClasifTematica(){
        return new Clasif_tematica_dao();
    }
}

class Libro_dao{
    var $id;
    var $titulo;
    var $subtitulo;
    var $isbn;
}
class Clasif_tematica_dao{
    var $id;
    var $categoria;
    var $subcategoria_id;
    var $sub_categoria;
}
class Entidad_dao{
    var $id;
    var $nombre;
    var $code;
    var $subsistema_id;
    var $subsistema_nombre;
}
class Barcode_dao{}
class Colaboradores_dao{}
class E_desc_dao{}
class P_desc_dao{}
class Edicion_dao{}
class E_pay_dao{}
class Tema_dao{}
class Traduccion_dao{}

?>