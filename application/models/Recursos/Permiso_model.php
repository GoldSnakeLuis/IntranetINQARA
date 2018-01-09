<?php

class Permiso_model extends CI_Model {

    function permisosQry_getxusuariovent() {
        if (isset($_POST['usuario_id'])) {
            $idusuario = $_POST['usuario_id'];
        }
        if (isset($_POST['idventana'])) {
            $idventana = $_POST['idventana'];
        }
        $this->db->select('*');
        $this->db->from('permisos');
        $this->db->where('usuario_id',$idusuario );
        $this->db->where('ventana_id',$idventana );
        $this->db->where('estado', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function permisoQry_upd() {
        if (isset($_REQUEST['usuario_id'])) {
            $idusuario = $_REQUEST['usuario_id'];
        }
        if (isset($_REQUEST['idventana'])) {
            $idventana = $_REQUEST['idventana'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }
        
        date_default_timezone_set('America/Lima');
        $fechaHoraActual = date("Y-m-d H:i:s", time());
        
        
        $this->db->set('estado', $estado, FALSE);
        $this->db->set('PermisoUsuario_FechaActualizacion', $fechaHoraActual);
        $this->db->where('usuario_id', $idusuario);
        $this->db->where('ventana_id', $idventana);
        $this->db->update('permisos');
    }
    
    function permisoQry_ins() {
        
        if (isset($_REQUEST['usuario_id'])) {
            $idusuario = $_REQUEST['usuario_id'];
        }
        if (isset($_REQUEST['idventana'])) {
            $idventana = $_REQUEST['idventana'];
        }
        
        
        date_default_timezone_set('America/Lima');
        $fechaHoraActual = date("Y-m-d H:i:s", time());
        
        $data = array(
            'usuario_id' => $idusuario,
            'ventana_id' => $idventana,
            'estado' => 1,
            'fechacreacion' => $fechaHoraActual
           
        );
        $this->db->insert('permisos', $data);
        return $this->db->insert_id();
    }
    
}