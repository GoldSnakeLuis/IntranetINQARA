<?php

class Ctactecpd_model extends CI_Model {

    function ctactecpdQry_getxAmortización() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        $this->db->select('*');
        $this->db->from('ctactecpd');
        $this->db->where('CobrarPagarDoc_id', $id);
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function ctactecpdQry_getxid() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->db->select('*');
        $this->db->from('ctactecpd');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function ctactecpdQry_getsumatoria() {
        if (isset($_POST['cpd_id'])) {
            $id = $_POST['cpd_id'];
        }
        $this->db->select('sum(Pago) as Pago');
        $this->db->from('ctactecpd');
        $this->db->where('CobrarPagarDoc_id', $id);
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function ctactecpdQry_eliminar() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->db->where('id', $id);
        $this->db->delete('ctactecpd');
    }
    function ctactecpdQry_eliminarxCPD() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->db->where('CobrarPagarDoc_id', $id);
        $this->db->delete('ctactecpd');
    }
    
    function ctactecpdQry_ins() {
        $Pago = null;
        $Fecha = null;
        if (isset($_POST['cpd_id'])) {
            $id = $_POST['cpd_id'];
        }
        
        if (isset($_POST['txtFecha'])) {
            $Fecha = trim($_POST['txtFecha']);
            $Fecha = DateTime::createFromFormat('d/m/Y', $Fecha)->format('Y-m-d');
        }
        if (isset($_POST['pago'])) {
            $Pago = $_POST['pago'];
        }


        $data = array(
            'Pago' => $Pago,
            'Fecha' => $Fecha,
            'CobrarPagarDoc_id' =>$id,
        );
        $this->db->insert('ctactecpd', $data);
    }

}

