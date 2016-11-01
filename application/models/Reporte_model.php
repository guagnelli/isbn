<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends MY_Model {

    private $reglas_estado = null;

    function __construct() {
        parent::__construct();
        $this->load->config('general');
        $this->load->database();
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
            'hri.reg_revision "fecha_ultima_revision"', 'cent.name "name_entidad"', 'c_subsistema.name "name_subsistema"'
            , 'c_categoria.nombre "name_categoria"', 'c_subcategoria.nombre "name_subcategoria"'
        );
        $this->db->start_cache();/**         * *************Inicio cache  *************** */
//        $this->db->from('cdepartamento as dp');
        $this->db->join('c_estado ce', 'ce.id = hri.c_estado_id');
        $this->db->join('solicitud s', 's.id = hri.solicitud_cve');
        $this->db->join('c_entidad cent', 'cent.id = s.entidad_id');
        $this->db->join('libro lb', 'lb.id = s.libro_id');
        $this->db->join('c_subsistema', 'cent.subsistema_id=c_subsistema.id', 'left');
        $this->db->join('c_subcategoria', 's.id_subcategoria=c_subcategoria.id', 'left');
        $this->db->join('c_categoria', 'c_subcategoria.id_categoria=c_categoria.id', 'left');
        //where que son obligatorios
        $this->db->where('hri.is_actual', 1); //último estado
        if ($params['estado_cve'] > 0) {
            $this->db->where('hri.c_estado_id', $params['estado_cve']);
        }
        if ($params['entidad_cve'] > 0) {
            $this->db->where('s.entidad_id', $params['entidad_cve']);
        }
        if ($params['subsistema_cve'] > 0) {
            $this->db->where('cent.subsistema_id', $params['subsistema_cve']);
        }
        if ($params['subcategoria_cve'] > 0) {
            $this->db->where('s.id_subcategoria', $params['subcategoria_cve']);
        }
        if ($params['categoria_cve'] > 0) {
            $this->db->where('c_subcategoria.id_categoria', $params['categoria_cve']);
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

        $descarga = (isset($params['descarga']) && $params['descarga'] == true) ? true : false;
        if (isset($params['per_page']) && isset($params['current_row']) && !$descarga) { //Establecer límite definido para paginación 
            $this->db->limit($params['per_page'], $params['current_row']);
        }
        $order_type = (isset($params['order_type'])) ? $params['order_type'] : 'asc';
        if (isset($params['order'])) { //Establecer límite definido para paginación 
            $orden = $params['order'];
            //pr($orden);
            if ($orden === 'fullname') {
                $orden = 'em.EMP_NOMBRE, em.EMP_APE_PATERNO, em.EMP_APE_MATERNO';
            }
            $this->db->order_by($orden, $order_type);
        }
        $ejecuta = $this->db->get('hist_revision_isbn hri'); //Prepara la consulta ( aún no la ejecuta)
        $query = $ejecuta->result_array();
        //pr($this->db->last_query());
        //$query->free_result();
        $this->db->flush_cache(); //Limpia la cache
        $result['result'] = $query;
        $result['total'] = $num_rows[0]->total;
        return $result;
    }
}
