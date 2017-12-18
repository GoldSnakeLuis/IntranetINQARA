<?php

class Documento_model extends CI_Model {

    function documentoQry_listar() {
        $this->db->select('*');
        $this->db->from('documento');
        $this->db->where('Estado', 1);
        $this->db->where_not_in('id', 99);
        $this->db->order_by('id', 'DESC');
        
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function documentoQry_getxid() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->db->select('*');
        $this->db->from('documento');
        $this->db->where('Estado', 1);
        $this->db->and_where('id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

}
