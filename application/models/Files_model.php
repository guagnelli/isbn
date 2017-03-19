<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Files_model extends CI_Model {

    public function __construct() {
        // Call the CI_Model constructor
        parent::__construct();
        //$this->config->load('general');
        $this->load->database();
    }

    function add_file($data = null) {
        if (is_null($data)) {
            return FALSE;
        }
        $this->db->trans_begin();
        $this->db->insert("files", $data);
        if ($this->db->affected_rows() > 0) {
            $id = $this->db->insert_id();
            $this->db->trans_commit();
            return $id;
        }

        $this->db->trans_rollback();
        return FALSE;
    }

    function add_file_isbn($data = null, $data_extra = null) {
        if (is_null($data)) {
            return FALSE;
        }
        $this->db->trans_begin();
        $this->db->insert("files", $data);
        $id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            if (!is_null($data_extra)) {
                $this->load->model("Solicitud_model", "sm");
                $id_libro_solicitud = $this->sm->get_libro_solicitud($data_extra['solicitud'], array('l.id'));
                if (!empty($id_libro_solicitud)) {//Valida que el resultado no sea vacio
                    $this->db->where('id', $id_libro_solicitud[0]['id']); //Condición del registro
                    $this->db->update('libro', array('isbn' => $data_extra['isbn'])); //Actualización del registro
                }
            }

            $this->db->trans_commit();
            return $id;
        }

        $this->db->trans_rollback();
        return FALSE;
    }

    function file_list($solicitud_id) {
        $this->db->where(array("solicitud_id" => $solicitud_id));
        $resp = $this->db->get("files");
        $files = $resp->result_array();
        unset($resp);
        return $files;
    }

    function delete($table = null, $where = array()) {
        if (is_null($table) || !is_array($where)) {
            return false;
        }
        $this->db->delete($table, $where);
        return true;
    }

    function get($id) {
        $this->db->where(array("id" => $id));
        $file = $this->db->get("files");
        $file = $file->result_array();
        if (count($file) == 1) {
            return $file[0];
        } else
            return 0;
    }

}

?>