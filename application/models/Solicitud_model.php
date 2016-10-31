<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends MY_Model {

    private $reglas_estado = null;

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        $this->load->database();
    }

    function getSolicitud($id = null, $array = true) {
        if (is_null($id)) {
            throw new Exception("Identificador no definido", 1);
        }

        //solicitud
        $this->db->where("solicitud.id", $id);
        $result = $this->db->get("solicitud");
        if ($result->num_rows() < 1) {
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
            $solicitud["secciones"][$seccion["cve_seccion"]] = "hello world_" . $seccion["cve_seccion"];
        }

        return $solicitud;
    }

    function getEntidad($id = null) {
        if (is_null($id)) {
            throw new Exception("Identificador no definido", 1);
        }

        $this->db->select("c_entidad.id as id, c_entidad.name as nombre, c_entidad.code, 
            c_subsistema.id as subsistema_id, c_subsistema.name as subsistema_nombre");
        $this->db->where("c_entidad.id", $id);
        $this->db->join("c_subsistema", "c_subsistema.id=c_entidad.subsistema_id");
        $result = $this->db->get("c_entidad");
        // echo $this->db->last_query();
        if ($result->num_rows() != 1) {
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

    public function get_buscar_solicitudes($params) {
        $arra_buscar_por = array(
            'isbn' => 'lb.isbn',
            'titulo_obra' => 'lb.title',
            'sub_titulo_obra' => 'lb.subtitle',
        );
        $busqueda_text = $arra_buscar_por[$params['menu_busqueda']]; //busqueda en texto por

        $select = array('s.id "solicitud_cve"', 'hri.id "hist_solicitud"', 'ce.name "name_estado"', 's.folio "folio_libro"',
            's.date_created "fecha_solicitud"', 'lb.title "titulo_libro"', 'lb.isbn "isbn_libro"',
            'hri.reg_revision "fecha_ultima_revision"', 'cent.name "name_entidad"'
        );

        $this->db->start_cache();/**         * *************Inicio cache  *************** */
//        $this->db->from('cdepartamento as dp');
        $this->db->join('c_estado ce', 'ce.id = hri.c_estado_id');
        $this->db->join('solicitud s', 's.id = hri.solicitud_cve');
        $this->db->join('c_entidad cent', 'cent.id = s.entidad_id');
        $this->db->join('libro lb', 'lb.id = s.libro_id');

        //where que son obligatorios
        $this->db->where('hri.is_actual', 1); //último estado

        if ($params['estado_cve'] > 0) {
            $this->db->where('hri.c_estado_id', $params['estado_cve']);
        }
        if ($params['entidad_cve'] > 0) {
            $this->db->where('s.entidad_id', $params['entidad_cve']);
        }
        switch ($params['rol_seleccionado']) {
            case E_rol::ENTIDAD:
                break;
            case E_rol::DGAJ:
                break;
        }


        if (is_array($busqueda_text)) {//si es un array lo recorre, ejemplo es la concatenación de nombre, ap y am
            foreach ($busqueda_text as $value) {
                $this->db->or_like($value, $params['buscador_solicitudes']);
            }
        } else {//pone un like para buscar
            $this->db->like($busqueda_text, $params['buscador_solicitudes']);
        }
        $this->db->stop_cache(); //************************************Fin cache
        //Cuenta la cantidad de registros
        $num_rows = $this->db->query($this->db->select('count(*) as total')->get_compiled_select('hist_revision_isbn hri'))->result();
        $this->db->reset_query(); //Reset de query 
        $this->db->select($select); //Crea query de consulta
        if (isset($params['per_page']) && isset($params['current_row'])) { //Establecer límite definido para paginación 
            $this->db->limit($params['per_page'], $params['current_row']);
        }

        $order_type = (isset($params['order_type'])) ? $params['order_type'] : 'asc';

        if (isset($params['order'])) { //Establecer límite definido para paginación 
            $orden = $params['order'];
//            pr($orden);
            if ($orden === 'fullname') {
                $orden = 'em.EMP_NOMBRE, em.EMP_APE_PATERNO, em.EMP_APE_MATERNO';
            }
            $this->db->order_by($orden, $order_type);
        }

        $ejecuta = $this->db->get('hist_revision_isbn hri'); //Prepara la consulta ( aún no la ejecuta)
        $query = $ejecuta->result_array();
//        pr($this->db->last_query());
//        $query->free_result();
        $this->db->flush_cache(); //Limpia la cache
        $result['result'] = $query;
        $result['total'] = $num_rows[0]->total;
        return $result;
    }

    function getLibro() {
        return new Libro_dao();
    }

    function getClasifTematica() {
        return new Clasif_tematica_dao();
    }

    function getReglasEstadosSolicitud() {
        $this->reglas_estado = array(
            Enum_es::Carga_datos_libro => array(//El docente se encuentra registrando información del libro
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::Registro),
                'is_boton' => FALSE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
            Enum_es::Registro => array(
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::En_revision),
                'is_boton' => TRUE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
            Enum_es::En_revision => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Correccion, Enum_es::Revision_indautor),
                'is_boton' => TRUE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
            Enum_es::Correccion => array(
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::En_revision),
                'is_boton' => TRUE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
            Enum_es::Revision_indautor => array(//Imprime el pdf para enviarlo con indautor
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Revisado_indautor),
                'is_boton' => TRUE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
            Enum_es::Revisado_indautor => array(//Sube el pdf que regresa indautor, y decide radicarlo o enviarlo a corrección 
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Radicado, Enum_es::Correccion),
                'is_boton' => TRUE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
            Enum_es::Radicado => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(),
                'is_boton' => FALSE,
                'titulo_boton' => '',
                'color_status' => '',
                'funcion_demandada' => '',
            ),
        );
    }

}

class Libro_dao {

    var $id;
    var $titulo;
    var $subtitulo;
    var $isbn;

}

class Clasif_tematica_dao {

    var $id;
    var $categoria;
    var $subcategoria_id;
    var $sub_categoria;

}

class Entidad_dao {

    var $id;
    var $nombre;
    var $code;
    var $subsistema_id;
    var $subsistema_nombre;

}

class Barcode_dao {
    
}

class Colaboradores_dao {
    
}

class E_desc_dao {
    
}

class P_desc_dao {
    
}

class Edicion_dao {
    
}

class E_pay_dao {
    
}

class Tema_dao {
    
}

class Traduccion_dao {
    
}

?>