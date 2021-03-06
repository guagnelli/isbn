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

    protected function format($tmp){
        //pr($tmp);
        $data = array();
        if(isset($tmp["title"])){
            $data["libro"]["title"] = $tmp["title"];
        }
        if(isset($tmp["subtitle"])){
            $data["libro"]["subtitle"] = $tmp["subtitle"];
        }
        if(isset($tmp["resenia"])){
            $data["libro"]["resenia"] = $tmp["resenia"];
        }
        if(isset($tmp["solicitud"]["solicitud_id"])){
            $data["solicitud"]["solicitud_id"] = $tmp["solicitud"]["solicitud_id"];
        }
        if(isset($tmp["solicitud_id"])){
            // $data["solicitud"]["solicitud_id"] = $tmp["solicitud_id"];
            $data["solicitud_id"] = $tmp["solicitud_id"];
        }
        if(isset($tmp["solicitud"]["entidad_id"])){
            $data["solicitud"]["entidad_id"] = $tmp["solicitud"]["entidad_id"];
        }
        if(isset($tmp["sol_tipo_obra"])){
            $data["solicitud"]["sol_tipo_obra"] = $tmp["sol_tipo_obra"];
        }
        if(isset($tmp["folio_coleccion"])){
            $data["solicitud"]["folio_coleccion"] = $tmp["folio_coleccion"];
        }
        if(isset($tmp["id_subcategoria"])){
            $data["solicitud"]["id_subcategoria"] = $tmp["id_subcategoria"];
        }
        if(isset($tmp["isbn_coleccion"])){
            $data["solicitud"]["isbn_coleccion"] = $tmp["isbn_coleccion"];
        }
        if(isset($tmp["titulo_coleccion"])){
            $data["solicitud"]["titulo_coleccion"] = $tmp["titulo_coleccion"];
        }
        return $data;
    }

    function get_libro_solicitud($id_solicitud = NULL, $select = array('l.id')) {
        if (is_null($id_solicitud)) {
            return array();
        }
        $this->db->select($select);
        $this->db->join('libro l', 'l.id = s.libro_id');
        $this->db->where('s.id', $id_solicitud);
        $result = $this->db->get('solicitud s');
        $querys = $result->result_array();
        $result->free_result();
        return $querys;
    }

    function get_file_estado_solicitud($id_solicitud = NULL, $select = array('hri.c_estado_id', 'f.*')) {
        if (is_null($id_solicitud)) {
            return array();
        }
        $this->db->select($select);
        $this->db->join('hist_revision_isbn hri', 'hri.solicitud_cve = s.id');
        $this->db->join('files f', 'hri.id_file = f.id');
        $this->db->where('hri.is_actual', true);
        $this->db->where('s.id', $id_solicitud);
        $result = $this->db->get('solicitud s');
        $querys = $result->result_array();
        $result->free_result();
        return $querys;
    }

    function addSolicitud($data) {
        
        $data = $this->format($data);
        // pr($data);
        $this->db->trans_begin();
        $this->db->insert("libro", $data["libro"]);
        if ($this->db->affected_rows() > 0) {
            $data["solicitud"]["libro_id"] = $this->db->insert_id();
            $data["solicitud"]["folio"] = "ISBN-" . $data["solicitud"]["sol_tipo_obra"] . "-" . str_pad($this->db->insert_id(), 10, 0, STR_PAD_LEFT);
            // pr($data);
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

    function editSolicitud($data) {
        //pr($data);
        $data = $this->format($data);
        //pr($data);
        // exit;
        $this->db->select("libro_id");
        $this->db->where("id", $data["solicitud_id"]);
        $result = $this->db->get("solicitud");
        $data["libro_id"] = isset($result->result_array()[0]["libro_id"]) ? $result->result_array()[0]["libro_id"] : 0;
        $this->update("libro", $data["libro"], array("id" => $data["libro_id"]));
        $this->update("solicitud", $data["solicitud"], array("id" => $data["solicitud_id"]));
        return true;
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
            $conf_secciones = $this->config->item('conf_secciones');
            // secciones
            $this->db->where("estado", 1);
            $secciones = $this->db->get("seccion_solicitud");
            $result_sec_sol = $secciones->result_array();
//            pr($this->db->last_query());
            foreach ($result_sec_sol as $seccion) {
                if (substr($seccion["tbl_seccion"], 0, 1) != '_') {
                    $sConf = $conf_secciones[$seccion['id']]['select'];
                    //                pr($sConf);
                    $this->db->select($sConf);
                    $this->db->where($seccion["referencia"], $id);
                    //echo $seccion["tbl_seccion"],",";
                    $result = $this->db->get($seccion["tbl_seccion"]);
                    $solicitud["secciones"][$seccion["cve_seccion"]] = $result->result_array();
                    $result->free_result();
                    //                pr($this->db->last_query());
                }
            }
            $solicitud["secciones"] += $this->getDF($id);
            $solicitud["secciones"]["files"] = $this->get_section("files", array(
                "solicitud_id" => $id
            ));
        }
//        pr($solicitud);
        return $solicitud;
    }

    function getDF($solicitud_id) {
        //$tabla = array("print" => "desc_fisica_impresa", "digital" => "desc_electronica");
        $data = array();

        $query = "select m.nombre medio, t.nombre tamanio, f.nombre formato, de.tamanio_desc, de.url
                from desc_electronica de 
                LEFT join c_medio m on(de.medio = m.id)
                LEFT JOIN c_formato f ON(de.formato = f.id)
                LEFT JOIN c_tamanio t ON(de.tamanio = t.id)
                WHERE de.solicitud_id = " . $solicitud_id;
        $result = $this->db->query($query);

        if ($result->num_rows() === 1) {
            $data["digital"] = $result->result_array();
            $data["digital"] = $data["digital"][0];
            return $data;
        } else {
            $query = "Select df.nombre desc_fisica, en.nombre encuadernacion, 
                g.nombre gramaje, i.nombre impresion,
                nt.nombre num_tintas, tp.nombre tipo_papel,
                fi.no_paginas, fi.ancho, fi.alto
                from desc_fisica_impresa fi 
                left join c_desc_fisica df ON(fi.desc_fisica = df.id)
                left join c_encuadernacion en ON(fi.encuadernacion = en.id)
                left join c_gramaje g ON(fi.gramaje = g.id)
                left join c_impresion i ON(fi.impresion = i.id)
                left join c_num_tintas nt ON(fi.num_tintas = nt.id)
                left join c_tipo_papel tp ON(fi.tipo_papel = tp.id)
                WHERE fi.solicitud_id = " . $solicitud_id;
            $result = $this->db->query($query);
            if ($result->num_rows() === 1) {
                $data["print"] = $result->result_array();
                $data["print"] = $data["print"][0];
                return $data;
            }
        }
        return $data;
    }

    function getHistorial($id = null,$is_actual =FALSE,$select = null) {
        if (is_null($id)) {
            throw new Exception("Identificador no definido", 1);
        }
        $this->db->from("solicitud as s");
        $this->db->join('hist_revision_isbn as h', 'h.solicitud_cve=s.id');
        $this->db->join('c_estado as e', 'e.id = h.c_estado_id');
        
        if(!is_null($select)){
            $this->db->select($select);
        }
        //solicitud
        $this->db->where("s.id", $id);
        if($is_actual){
            $this->db->where("h.is_actual",1);
        }
        $this->db->order_by("h.reg_revision", "asc");
        $result = $this->db->get();
        //echo $this->db->last_query();


        //pr($this->db->last_query());
        if ($result->num_rows() < 1) {
            throw new Exception("El identificador no se encuentra registrado", 1);
        }
        $solicitud = $result->result_array();
        $result->free_result();
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
        $busqueda_text =  'titulo_obra'; //busqueda en texto por
        if(isset($params['menu_busqueda'])){
            $busqueda_text =  $arra_buscar_por[$params['menu_busqueda']]; //busqueda en texto por
        }
        
        $select = array('s.id "solicitud_cve"', 'hri.id "hist_solicitud"', 'ce.name "name_estado"', 's.folio "folio_libro"','s.folio_coleccion "coleccion"','s.sol_tipo_obra',
            's.date_created "fecha_solicitud"', 'lb.title "titulo_libro"', 'lb.isbn "isbn_libro"',
            'DATE_FORMAT(hri.reg_revision,"%d-%m-%Y %r" ) "fecha_ultima_revision"', 'cent.name "name_entidad"',
            'hri.c_estado_id "estado_cve"', 'sc.nombre "sub_categoria"',
            '(select count(*) from files where files.solicitud_id = s.id) count_files',
        );
        $this->db->start_cache();/**         * *************Inicio cache  *************** */
//        $this->db->from('cdepartamento as dp');
        $this->db->join('c_estado ce', 'ce.id = hri.c_estado_id');
        $this->db->join('solicitud s', 's.id = hri.solicitud_cve');
        $this->db->join('c_entidad cent', 'cent.id = s.entidad_id');
        $this->db->join('libro lb', 'lb.id = s.libro_id');
        $this->db->join('c_subcategoria sc', 'sc.id = s.id_subcategoria', 'left');
        //where que son obligatorios
        $this->db->where('hri.is_actual', 1); //último estado
        //pr($params);
        
        if ($params['estado_cve'] && $params['estado_cve'] > 0) {//Filtro de estado 
            $this->db->where('hri.c_estado_id', $params['estado_cve']);
        }
        if (isset($params['entidad_cve']) && $params['entidad_cve'] > 0) {//Filtro de entidad 
            $this->db->where('s.entidad_id', $params['entidad_cve']);
        }
        if (isset($params['categoria_cve']) && $params['categoria_cve'] != "") {//Filtro de categoria 
            $this->db->where('sc.id_categoria', $params['categoria_cve']);
        }
        if (isset($params['sub_categoria_cve']) && $params['sub_categoria_cve'] > 0) {//Filtro de categoria 
            $this->db->where('sc.id', $params['sub_categoria_cve']);
        }
        if (isset($params['sub_sistema_cve']) and $params['sub_sistema_cve'] > 0) {//Filtro subsistema 
            $this->db->where('cent.subsistema_id', $params['sub_sistema_cve']);
        }
        if (isset($params['sol_tipo_obra']) and in_array($params['sol_tipo_obra'], array("V","I","C"))) {//Filtro subsistema 
            $this->db->where('s.sol_tipo_obra', $params['sol_tipo_obra']);
        }
        if(isset($params['periodo'])){
            if(!is_null($params['periodo']['inicio'])){
                $this->db->where('date(hri.reg_revision) >=', $params['periodo']['inicio']);
            }
            $this->db->where('date(hri.reg_revision) <=', 'CURRENT_DATE');
        }

        switch ($params['rol_seleccionado']) {
            case E_rol::ENTIDAD:
                break;
            case E_rol::DGAJ:
                $this->db->where('ce.id>=2');
                break;
        }
        if(isset($params['buscador_solicitudes'])){
            if (is_array($busqueda_text)) {//si es un array lo recorre, ejemplo es la concatenación de nombre, ap y am
                foreach ($busqueda_text as $value) {
                    $this->db->or_like($value, $params['buscador_solicitudes']);
                }
            } else {//pone un like para buscar
                $this->db->like($busqueda_text, $params['buscador_solicitudes']);
            }
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
        //echo $this->db->last_query();
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
        if ($result->num_rows() == 0) {
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
        if ($result->num_rows() == 0) {
            return array();
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
        //reglas del estados de solicitud

        $reglas_estado = array(
            //primer estado  o en registro
            Enum_es::__default => array(//El estado default
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::Registro),
                'is_boton' => 1,
                'titulo_boton' => 'Realizar solicitud',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 0,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 0, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
                'vista_detalle_solicitud' => 0,
                'hidden_add_comment' => 0, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'name_comprobante' => '',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
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
                'is_cancelable_solicitud' => 1,
//                'funcion_demandada' => 'cambio_estado(this)',
                'atributos' => 'id="send" type="submit" class="btn" onclick="retrun false;"',
                'mensaje_guardado_correcto' => 'save_envio_revision',
//                'add_comment_seccion' => 0,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 0, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
//                'vista' => 'editar_registro',
                'vista' => array(E_rol::ENTIDAD => 'editar_registro', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 0, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'name_comprobante' => '',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::En_revision => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Correccion, Enum_es::Revision_indautor),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a revisión',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 1,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 1, E_rol::DGAJ => 1, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
                'vista_detalle_solicitud' => 1,
//                'vista' => 'detalle',
                'vista' => array(E_rol::ENTIDAD => 'detalle', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 1, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'name_comprobante' => '',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::Correcciones_atendidas => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Correccion, Enum_es::Revision_indautor),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a revisión',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 1,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 1, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
                'vista_detalle_solicitud' => 1,
//                'vista' => 'detalle',
                'vista' => array(E_rol::ENTIDAD => 'detalle', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 1, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'name_comprobante' => '',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::Correccion => array(
                'rol_permite' => array(E_rol::ENTIDAD),
                'estados_transicion' => array(Enum_es::Correcciones_atendidas),
                'is_boton' => 1,
                'titulo_boton' => 'Enviar a corrección',
                'color_status' => '',
                'is_editable_solicitud' => 1,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 0,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 0, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
                'vista_detalle_solicitud' => 0,
                'vista' => array(E_rol::ENTIDAD => 'editar_registro', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 1, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'name_comprobante' => '',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::Revision_indautor => array(//Imprime el pdf para enviarlo con indautor
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Rechazado_indautor, Enum_es::Aceptado_indautor, Enum_es::Correccion),
                'is_boton' => 1,
                'titulo_boton' => 'Revisión por indautor',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 1,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 1, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
                'vista_detalle_solicitud' => 1,
//                'vista' => 'detalle',
                'vista' => array(E_rol::ENTIDAD => 'detalle', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 1, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'name_comprobante' => '',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::Rechazado_indautor => array(//Sube el pdf que regresa indautor, y decide radicarlo o enviarlo a corrección 
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(),
                'is_boton' => 1,
                'titulo_boton' => 'Rechazado por indautor',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'ventana_comprobante(this)',
                'funcion_demandada_auxiliar' => 'guardar_estado_comprobante(this)',
//                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 1,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 0, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
//                'add_comment_seccion' => array(),
                'vista_detalle_solicitud' => 1,
//                'vista' => 'detalle',
                'vista' => array(E_rol::ENTIDAD => 'detalle', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 1, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 1,
                'tipo_file' => 'r',
                'name_comprobante' => 'rechazado_indautor',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::Aceptado_indautor => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(Enum_es::Comprobado_isbn),
                'is_boton' => 1,
                'titulo_boton' => 'Aceptado por indautor',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'ventana_comprobante(this)',
                'funcion_demandada_auxiliar' => 'guardar_estado_comprobante(this)',
//                'add_comment_seccion' => 1,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 0, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
//                'add_comment_seccion' => array(),
                'vista_detalle_solicitud' => 1,
//                'vista' => 'detalle',
                'vista' => array(E_rol::ENTIDAD => 'detalle', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 1, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 1,
                'is_captura_isbn' => 1,
                'tipo_file' => 'a',
                'name_comprobante' => 'aceptado_indautor',
                'text_cambio_estado' => 'Confirme que realmente desea continuar'
            ),
            Enum_es::Comprobado_isbn => array(
                'rol_permite' => array(E_rol::DGAJ),
                'estados_transicion' => array(),
                'is_boton' => 1,
                'titulo_boton' => 'Comprobar',
                'color_status' => '',
                'is_editable_solicitud' => 0,
                'is_cancelable_solicitud' => 0,
                'funcion_demandada' => 'cambio_estado(this)',
//                'add_comment_seccion' => 1,
                'add_comment_seccion' => array(E_rol::ENTIDAD => 0, E_rol::DGAJ => 0, E_rol::ADMINISTRADOR => 0, E_rol::SUPERADMINISTRADOR => 0),
//                'add_comment_seccion' => array(),
                'vista_detalle_solicitud' => 1,
//                'vista' => 'detalle',
                'vista' => array(E_rol::ENTIDAD => 'detalle', E_rol::DGAJ => 'detalle', E_rol::ADMINISTRADOR => 'detalle', E_rol::SUPERADMINISTRADOR => 'detalle'),
                'hidden_add_comment' => 0, //Muestra boton de mensajes de comentarios por secciíon
                'is_comprobante' => 0,
                'text_cambio_estado' => '¿Se a comprobado el isbn?'
            ),
        );
        return $reglas_estado;
    }

    function getValidacionesSeccionesConfig() {
        $secciones = array(
            En_secciones::TEMA => array('is_validar' => 1),
            En_secciones::IDIOMA => array('is_validar' => 0),
            En_secciones::COLABORADORES => array('is_validar' => 0),
            En_secciones::TRADUCCION => array('is_validar' => 0),
            En_secciones::INFO_EDICION => array('is_validar' => 0),
            En_secciones::COMERCIALIZACION => array('is_validar' => 0),
            En_secciones::DESC_FISICA => array('is_validar' => 0),
            En_secciones::DESC_FISICA_ELECTRONICA => array('is_validar' => 0),
            En_secciones::DESC_FISICA_IMPRESA => array('is_validar' => 0),
            En_secciones::PAGO_ELECTRONICO => array('is_validar' => 0),
            En_secciones::CODIGO_BARRAS => array('is_validar' => 0),
            En_secciones::ARCHIVOS => array('is_validar' => 0),
        );
        return$secciones;
    }

    function getSeccionesSolicitud() {
        $secciones = array(
            En_secciones::TEMA,
            En_secciones::IDIOMA,
            En_secciones::COLABORADORES,
            En_secciones::TRADUCCION,
            En_secciones::INFO_EDICION,
            En_secciones::COMERCIALIZACION,
            En_secciones::DESC_FISICA,
            En_secciones::DESC_FISICA_ELECTRONICA,
            En_secciones::DESC_FISICA_IMPRESA,
            En_secciones::PAGO_ELECTRONICO,
            En_secciones::CODIGO_BARRAS,
            En_secciones::ARCHIVOS,
            En_secciones::TITULO_LIBRO,
            En_secciones::CLAS_TEMATICA,
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
            'ss.nom_seccion "name_seccion"','oss.rol "rol"','oss.nombre "usuario"'
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
        //pr($this->session->userdata('rol_cve'));
        $parametros_insert_comentarios["rol"] = $this->session->userdata('rol_cve');
        $parametros_insert_comentarios["nombre"] = $this->session->userdata('nombre');
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

    function get_sections($param = array("estado" => 1),$id_in=array()) {
        if(!is_null($param)){
            foreach ($param as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if(!empty($id_in)){
            $this->db->where_in('id',$id_in);
        }
        $secciones = $this->db->get("seccion_solicitud");
        $r = $secciones->result_array();
//        pr($this->db->last_query());
        return $r;
    }

    /**
     * 
     * @param author LEAS
     * @param fecha 20/03/2017
     * @param type $solicitud_id Identificador de la solicitud, referencia
     * @param type $sections_validacion Secciones a validar como obligatorias para cambiar el estado
     * @return int 0 = alguna sección no paso la validación; 1 = todas las validaciones pasaron la validacion 
     */
    function get_valida_sections($solicitud_id = null, $sections_validacion = array()) {
        if (is_null($solicitud_id)) {//Valida existencia de la solicitud, si es igual a null, no puede validar aceptado
            return array('valido' => 0, 'seccion' => '');
        }
        if (empty($sections_validacion)) {//Si el array de validación es vacio, no se encuentra como obligatorio la validación de ninguna sección
            return array('valido' => 1, 'seccion' => '');
        }

        foreach ($sections_validacion as $seccion) {
            $this->db->from($seccion['tbl_seccion'])->where($seccion['referencia'], $solicitud_id);
            $countAllResult = $this->db->count_all_results();
            if ($countAllResult < 1) {
                return array('valido' => 0, 'seccion' => $seccion['nom_seccion']);
            }
        }

        return array('valido' => 1, 'seccion' => '');
    }

    function get_usuario($where = array(), $select = '') {
        $this->db->select($select);
        $this->db->where($where);
        $secciones = $this->db->get("usuario");
        return $secciones->result_array();
    }

    function cancel($solicitud_id = 0){
        if($solicitud_id == 0){
            return false;
        }
        
        $this->db->query("DELETE FROM barcode where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM colaboradores where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM comercializable where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM files where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM edicion where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM epay where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM tema where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM traduccion where solicitud_id = $solicitud_id");
        $this->db->query("DELETE FROM sol_idioma where solicitud = $solicitud_id");
        $this->db->query("DELETE FROM hist_revision_isbn where solicitud_cve = $solicitud_id");
        $query = $this->db->query("SELECT libro_id FROM solicitud where id = $solicitud_id");
        $solicitud = $query->result_array();
        //pr($solicitud);
        if(count($solicitud) < 1){
            return false;
        }
        $libro_id = $solicitud[0]["libro_id"];
        $this->db->query("DELETE FROM solicitud where id = $solicitud_id");
        $this->db->query("DELETE FROM libro where id = $libro_id");
        return true;
    }

    function get_sections_ext(){
        $this->db->select("nom_seccion label, id cve");    
        $this->db->where("id between 1 and 6");
        $secciones = $this->db->get("seccion_solicitud");
        return $secciones->result_array();
    }

    function get_solicitudes($params = null){
        //pr($params);
        //obtenemos las secciones
        $conf_secciones = $this->config->item('conf_secciones');

        //obtenemos las solicitudes
        //filtros

        if(isset($params["id_subcategoria"]) && !empty($params["id_subcategoria"])){
            $this->db->where("id_subcat",$params["id_subcategoria"]);
        }

        if(isset($params["filtros"]["sol_tipo_obra"]) && !empty($params["filtros"]["sol_tipo_obra"])){
            $this->db->where("sol_tipo_obra",$params["filtros"]["sol_tipo_obra"]);
        }

        if(isset($params["filtros"]["init"]) && !empty($params["filtros"]["init"])){
            $this->db->where("date_ BETWEEN '".$params["filtros"]["init"]."' and CURRENT_DATE");
        }

        $result = $this->db->get("v_solicitud");
        $solicitudes = $result->result_array();
        //pr($solicitudes);

        $secciones = array();
        //obtenemos secciones
        if(isset($params["all"])){
            $secciones = $this->get_sections(null, array(1,2,3,4,5,6));
        }elseif(isset($params["seccion"]) && is_array($params["seccion"])){
            $secciones = $this->get_sections(null, array_keys($params["seccion"]));
        }

        //recorremos los resultados
        foreach($solicitudes as $key=>$solicitud){
            //pr($solicitud);
            foreach ($secciones as $seccion){
                $sConf = $conf_secciones[$seccion['id']]['select'];
                //pr($sConf);
                $this->db->select($sConf);
                $this->db->where($seccion["referencia"], $solicitud["solicitud_cve"]);
                $result = $this->db->get($seccion["tbl_seccion"]);
                
                $solicitudes[$key]["secciones"][$seccion["nom_seccion"]] = $result->result_array();
                $result->free_result();
            }
            if (isset($params["df"]) || isset($params["all"])) {
                $solicitudes[$key]["secciones"] += $this->getDF($solicitud["solicitud_cve"]);
            }
        }
        //pr($solicitudes);
        if(isset($params["generar"])){
            echo json_encode($solicitudes);
        }
    }

}

?>
