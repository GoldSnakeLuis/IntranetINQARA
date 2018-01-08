<?php

class Menu_model extends CI_Model {

    function moduloQry_getxUsuario() {
        if (isset($_POST['usuario_id'])) {
            $idusuario = $_POST['usuario_id'];
        }
        $this->db->select('m.*');
        $this->db->from('permisos p');
        $this->db->join('ventana v', 'p.ventana_id = v.id');
        $this->db->join('modulo m', 'v.modulo_id = m.id');
        $this->db->where('p.usuario_id', $idUsuario);
        $this->db->where('p.estado', 1);
        $this->db->where('v.estado', 1);
        $this->db->where('m.estado', 1);
        $this->db->group_by('m.id');

        $query = $this->db->get();

        if (count($query) > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function moduloQry_listar() {

        $this->db->select('*');
        $this->db->from('modulo');        
        $this->db->where('estado', 1);        

        $query = $this->db->get();

        if (count($query) > 0) {
            return $query;
        } else {
            return null;
        }

    }

    function ventanaQry_getxUsuario() {
        if (isset($_POST['usuario_id'])) {
            $idusuario = $_POST['usuario_id'];
        }
        
        $this->db->select('v.*');
        $this->db->from('permisos p');
        $this->db->join('ventana v', 'p.ventana_id = v.id');
        $this->db->where('p.usuario_id', $idusuario);
        $this->db->where('p.estado', 1);
        $this->db->where('v.estado', 1);

        $query = $this->db->get();

        if (count($query) > 0) {
            return $query;
        } else {
            return null;
        }
    }

    function ventanaQry_listar() {

        $this->db->select('*');
        $this->db->from('ventana');        
        $this->db->where('estado', 1);        

        $query = $this->db->get();

        if (count($query) > 0) {
            return $query;
        } else {
            return null;
        }
    }

}
