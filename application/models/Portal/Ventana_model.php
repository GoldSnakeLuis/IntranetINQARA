
<?php

class Ventana_model extends CI_Model {

     function ventanaQry_listar() {

        $this->db->select('*');
        $this->db->from('ventana');
        $this->db->where('estado', 1);
        $this->db->or_where('estado', 2);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();

        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function ventanaQry_getxid() {
        if (isset($_POST['id'])) {
            $idventana = $_POST['id'];
        }
         $this->db->select('*');
        $this->db->from('ventana');
        $this->db->where('id',$idventana );
        $this->db->where('estado', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function ventanaDetQry_ins($contenido_id) {
        $ventana_id = null;
         if (isset($_POST['selVentana'])) {
            $ventana_id = $_POST['selVentana'];
        }       
        $data = array(
            'ventana_id' => $ventana_id,
            'contenido_id' => $contenido_id,
           
        );
        $this->db->insert('ventana_detalle', $data);
        return $this->db->insert_id();
    }
    
}