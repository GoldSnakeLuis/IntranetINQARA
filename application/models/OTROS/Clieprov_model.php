<?php

class Clieprov_model extends CI_Model {

    function clieprovQry_listar() {

        $this->db->select('*');
        $this->db->from('clieprov');
        $this->db->order_by('Razon_Social', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function clieprovQry_getxid() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $this->db->select('*');
        $this->db->from('clieprov');
        $this->db->where('id', $id);
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    /*
    function ClieprovQry_updestado() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }

        $this->db->set('Estado', $estado, FALSE);
        $this->db->where('Id', $id);
        $this->db->update('clieprov');
    }
    */

    function clieprovQry_ins() {
        $Razon_Social = null;
        $ruc = null;
        
        if (isset($_POST['razonsocial'])) {
            $Razon_Social = $_POST['razonsocial'];
        }
        if (isset($_POST['ruc'])) {
            $ruc = $_POST['ruc'];
        }

        $data = array(
            'Razon_Social' => $Razon_Social,
            'ruc' => $ruc,
        );

        $this->db->insert('clieprov', $data);
        return $this->db->insert_id();
    }
/*
    function clieprovQry_upd() {

         $Razon_Social = null;
        $ruc = null;
        
        if (isset($_POST['razonsocial'])) {
            $Razon_Social = $_POST['razonsocial'];
        }
        if (isset($_POST['ruc'])) {
            $ruc = $_POST['ruc'];
        }

        $data = array(
            'Razon_Social' => $Razon_Social,
            'ruc' => $ruc,
        );
        $this->db->where('id', $editarID);
        $this->db->update('clieprov', $data);
    }
*/
}

