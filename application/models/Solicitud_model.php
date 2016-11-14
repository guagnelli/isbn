<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Solicitud_model extends MY_Model {

    function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        // $ci = get_instance(); // CI_Loader instance
        $this->load->config('general');
        $this->load->database();
    }

    function addSolicitud($data) {
        // pr($data);
        $this->db->trans_begin();
        $this->db->insert("libro", $data["libro"]);
        if ($this->db->affected_rows() > 0) {
            $data["solicitud"]["libro_id"] = $this->db->insert_id();
            $data["solicitud"]["folio"] = "folio-" . str_pad($this->db->insert_id(), 10, 0, STR_PAD_LEFT);
            $this->db->insert("solicitud", $data["solicitud"]);
            if ($this->db->affected_rows() > 0) {
                $solicitud_id = $this->db->insert_id();
                $this->db->insert("hist_revision_isbn", array(
                    "c_estado_id" => 1,
                    "solicitud_cve" => $solicitud_id
                ));
                if ($this->db->affected_rows() > 0) {
                    $this->db->trans_commit();
                    return $solicitud_id;
                } else {
                    $this->db->trans_rollback();
                }
            } else {
                $this->db->trans_rollback();
            }
        } else {
            $this->db->trans_rollback();
        }
        return false;
    }

    function getSolicitud($id = null, $load_secciones = true, $array = true) {
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
//        pr($this->db->last_query());
        $solicitud["entidad"] = $this->getEntidad($solicitud["entidad_id"]);
        $solicitud["libro"] = $this->getLibro($solicitud["libro_id"]);
        $solicitud["clasificacion_tematica"] = $this->getClasifTematica($solicitud["id_subcategoria"]);
        $tipo_obra = $this->config->item('tipo_obra');
        $solicitud["sol_tipo_obra"] = $tipo_obra[$solicitud["sol_tipo_obra"]];

        if ($load_secciones) {
            // secciones
            $secciones = $this->db->get("seccion_solicitud");
            foreach ($secciones->result_array() as $seccion) {
                $this->db->where($seccion["referencia"], $id);
                $result = $this->db->get($seccion["tbl_seccion"]);
                $solicitud["secciones"][$seccion["cve_seccion"]] = $result->result_array();
                $result->free_result();
            }
        }
        //pr($solicitud);
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
        $entidad = $result->row_array();
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
            'hri.reg_revision "fecha_ultima_revision"', 'cent.name "name_entidad"', 'hri.c_estado_id "estado_cve"'
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

    function listCategoria($id_categoria = null) {
        if (!is_null($id_categoria)) {
            $this->db->where("id_categoria", $id_categoria);
        }
        $result = $this->db->get("c_categoria");
        if ($result->num_rows() != 1) {
            throw new Exception("El catálogo esta vacio", 1);
        }
        $list = $result->result_array();
        $result->free_result();
        return $list;
    }

    function listSubCategoria($id_categoria = null, $id_subcategoria = null) {
        if (!is_null($id_subcategoria)) {
            $this->db->where("id", $id_subcategoria);
        } elseif (!is_null($id_categoria)) {
            $this->db->where("id_categoria", $id_categoria);
        }
        $result = $this->db->get("c_subcategoria");
        if ($result->num_rows() != 1) {
            throw new Exception("La categoria {$id} no existe", 1);
        }
        $list = $result->result_array();
        $result->free_result();
        return $list;
    }

    function getLibro($id) {
        $this->db->where("id", $id);
        $libro = $this->db->get("libro");
        return $libro->row_array();
    }

    function getClasifTematica($id) {
        $this->db->select("c_categoria.id id_categoria,c_categoria.nombre categoria, 
            c_subcategoria.id id_subcategoria, c_subcategoria.nombre subcategoria");
        $this->db->where("c_subcategoria.id", $id);
        $this->db->join("c_categoria", "c_subcategoria.id_categoria = c_categoria.id");
        $ct = $this->db->get("c_subcategoria");
        return $ct->row_array();
    }

    function getReglasEstadosSolicitud() {

        $reglas_estado = array(
            Enum_es::__default => array(//El estado default
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::Registro),
                'is_boton' => 1,
                'titulo_boton' => 'Realizar solicitud',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 0,
                'vista_detalle_solicitud' => 0,
            ),
//            Enum_es::Carga_datos_libro => array(//El docente se encuentra registrando información del libro
//                'rol_permite' => array(E_rol::ENTIDAD),
//                'estados_transicion' => array(Enum_es::Registro),
//                'is_boton' => 1,
//                'titulo_boton' => 'Guardar solicitud',
//                'color_status' => '',
//                'funcion_demandada' => 'cambio_estado(this)',
//                'atributos' => 'id="send" type="submit" class="btn" onclick="retrun false;"',
//                'add_comment_seccion' => 0,
//                'vista_detalle_solicitud' => 0,
//                'vista' => 'tema',
//            ),
            Enum_es::Registro => array(
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::En_revision),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a DGAJ',
                'color_status' => '',
                'is_editable_solicitud' => 1,
//                'funcion_demandada' => 'cambio_estado(this)',
                'atributos' => 'id="send" type="submit" class="btn" onclick="retrun false;"',
                'mensaje_guardado_correcto' => 'save_envio_revision',
                'add_comment_seccion' => 0,
                'vista' => 'editar_registro',
            ),
            Enum_es::En_revision => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Correccion, Enum_es::Revision_indautor),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a revisión',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 1,
                'vista_detalle_solicitud' => 1,
                'vista' => 'detalle',
            ),
            Enum_es::Revision_de_correccion => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Correccion, Enum_es::Revision_indautor),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a revisión',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 1,
                'vista_detalle_solicitud' => 1,
                'vista' => 'detalle',
            ),
            Enum_es::Correccion => array(
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::Revision_de_correccion),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a corrección',
                'color_status' => '',
                'is_editable_solicitud' => 1,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 0,
                'vista_detalle_solicitud' => 0,
                'vista_detalle_solicitud' => 0,
                'vista' => 'editar_registro',
            ),
            Enum_es::Revision_indautor => array(//Imprime el pdf para enviarlo con indautor
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Revisado_indautor),
                'is_boton' => 1,
                'titulo_boton' => 'Revisión por indautor',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 1,
                'vista_detalle_solicitud' => 1,
                'vista' => 'detalle',
            ),
            Enum_es::Revisado_indautor => array(//Sube el pdf que regresa indautor, y decide radicarlo o enviarlo a corrección 
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Correccion, Enum_es::Radicado),
                'is_boton' => 1,
                'titulo_boton' => 'Cargar resultado de indautor',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 1,
                'vista_detalle_solicitud' => 1,
                'vista' => 'detalle',
            ),
            Enum_es::Radicado => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(),
                'is_boton' => 1,
                'titulo_boton' => 'Radicar',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
                'add_comment_seccion' => 1,
                'vista_detalle_solicitud' => 1,
                'vista' => 'detalle',
            ),
        );
        return $reglas_estado;
    }

    function getSeccionesSolicitud() {
        $secciones = array(
            En_secciones::TEMA, En_secciones::IDIOMA, En_secciones::COLABORADORES, En_secciones::TRADUCCION,
            En_secciones::INFO_EDICION, En_secciones::COMERCIALIZACION, En_secciones::DESC_FISICA_ELECTRONICA,
            En_secciones::DESC_FISICA_IMPRESA, En_secciones::PAGO_ELECTRONICO, En_secciones::CODIGO_BARRAS
        );
        return $secciones;
    }

    public function update_insert_estado_solicitud($parametros_insert_nuevo_hist, $parametros_update_hist_actual, $condicion_hist_actual) {

        $this->db->trans_begin(); //Definir inicio de transacción
        //Actualiza el estado actual de la historia de la solicitud, para darla de baja
        $this->db->where($condicion_hist_actual);
        $this->db->update('hist_revision_isbn', $parametros_update_hist_actual); //Inserción de registro
//        pr($this->db->last_query());
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0; //Rollback 
        } else {
            $this->db->insert('hist_revision_isbn', $parametros_insert_nuevo_hist); //Inserción de registro
            $data_hist_id = $this->db->insert_id(); //Obtener identificador insertado
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return 0; //Rollback 
            } else {
//                pr($this->db->last_query());
                $this->db->trans_commit();
                return $data_hist_id; //retorna el id de la última historia de la solicitud
            }
            //pr($this->db->last_query());
        }
    }

    function add($table = null, $data = null, $return_id = false) {
        if (is_null($table)) {
            return false;
        }
        $this->db->insert($table, $data);
        if ($return_id) {
            return $this->db->insert_id();
        }
        if ($this->db->insert_id() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function update($table = null, $data = null, $where = array()) {
        if (is_null($table) || !is_array($where)) {
            return false;
        }
        $this->db->update($table, $data, $where);
        return true;
    }

    function delete($table = null, $where = array()) {
        if (is_null($table) || !is_array($where)) {
            return false;
        }
        $this->db->delete($table, $where);
        return true;
    }

    function get_comentarios_seccion($seccion_cve, $solicitud_cve) {
        $select = array('oss.id "observacion_seccion_cve"', 'oss.hist_revision_isbn_id "hist_cve"',
            'oss.comentarios "comentario"', 'oss.fecha_comment "fecha_comentario"', 'ce.name "name_estado"',
            'ss.nom_seccion "name_seccion"'
        );
        $this->db->select($select);
        $this->db->join('hist_revision_isbn hri', 'hri.id = oss.hist_revision_isbn_id');
        $this->db->join('seccion_solicitud ss', 'ss.id = oss.seccion_cve');
        $this->db->join('c_estado ce', 'ce.id = hri.c_estado_id');
        //where que son obligatorios
        $this->db->where('ss.id', $seccion_cve); //seccion
        $this->db->where('hri.solicitud_cve', $solicitud_cve); //último estado
        $this->db->order_by('oss.fecha_comment', 'desc');
        $result = $this->db->get("observaciones_seccion_solicitud oss");
        // echo $this->db->last_query();
        $comentarios = $result->result_array();
        $result->free_result();
        return $comentarios;
    }

    function get_datos_grales_solicitud($seccion_cve, $solicitud_cve) {
        $subselect = '(select ss.nom_seccion from seccion_solicitud ss where ss.id = ' . $seccion_cve . ') as "name_seccion"';
        $select = array('lb.title "titulo_libro"', 'lb.subtitle "subtitulo_libro"', 'lb.isbn "isbn_libro"',
            $subselect
        );
        $this->db->select($select);
        $this->db->join('libro lb', 'lb.id  = s.libro_id');
        //where que son obligatorios
        $this->db->where('s.id', $solicitud_cve); //seccion
        $result = $this->db->get("solicitud s");
//         echo $this->db->last_query();
        $comentarios = $result->result_array();
        $result->free_result();
        return $comentarios;
    }

    /**
     * 
     * @param type $parametros_insert_comentarios Agrega un comentario a la seccion actual y 
     * relacionada con su historia
     * @return int
     */
    public function insert_comentario_seccion($parametros_insert_comentarios) {
        $this->db->trans_begin(); //Definir inicio de transacción
        //Inserta un comentario de sección
        $this->db->insert('observaciones_seccion_solicitud', $parametros_insert_comentarios); //Inserción de registro

        $data_hist_id = $this->db->insert_id(); //Obtener identificador insertado
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0; //Rollback 
        } else {
//                pr($this->db->last_query());
            $this->db->trans_commit();
            return $data_hist_id; //retorna el id de la última historia de la solicitud
        }
    }

    function get_tema($solicitud_id = null) {
        $this->db->where("solicitud_id", $solicitud_id);
        $result = $this->db->get("tema");
        if ($result->num_rows() == 0) {
            return TRUE;
        } elseif ($result->num_rows() == 1) {
            $tema = $result->row_array();
            $result->free_result();
            return $tema;
        } else {
            return false;
        }
    }

    function get_idiomas($solicitud_id = null) {
        $this->db->select("idioma");
        $this->db->where("solicitud", $solicitud_id);
        $result = $this->db->get("sol_idioma");
        if ($result->num_rows() == 0) {
            return TRUE;
        } elseif ($result->num_rows() > 0) {
            $idiomas = $result->result_array();
            $result->free_result();
            return $idiomas;
        } else {
            return false;
        }
    }

    function get_section($tabla, $where = array()) {
        $this->db->where($where);
        $result = $this->db->get($tabla);
        $seccion = $result->result_array();
        $result->free_result();
        return $seccion;
    }

    function get_sections() {
        $this->db->where("estado", 1);
        $secciones = $this->db->get("seccion_solicitud");
        return $secciones->result_array();
    }

}

?>