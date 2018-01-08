<?php

class Usuario_model extends CI_Model {

    function usuarioQry_listar() {

        $this->db->select('*');
        $this->db->from('usuario');
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

    function usuarioQry_getxid() {
        if (isset($_POST['id'])) {
            $idusuario = $_POST['id'];
        }
         $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('id',$idusuario );
        $this->db->where('estado', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function usuarioQry_getxparam() {
        if (isset($_POST['seltipo'])) {
            $tipo = $_POST['seltipo'];
        }
        if (isset($_POST['seluso'])) {
            $uso = $_POST['seluso'];
        }
         $this->db->select('*');
        $this->db->from('usuario');
        $this->db->where('uso',$uso );
        $this->db->where('tipo',$tipo );
        $this->db->where('estado', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function usuarioQry_ins() {
        $nick = null;
        $clave = null;
        $correo = null;
        $nombres = null;
        $tipo = null;
        $uso = null;
        
        if (isset($_POST['txtNick'])) {
            $nick = $_POST['txtNick'];
        }
        if (isset($_POST['txtClave'])) {
            $clave = $_POST['txtClave'];
        }
        if (isset($_POST['txtCorreo'])) {
            $correo = $_POST['txtCorreo'];
        }
        if (isset($_POST['txtNombres'])) {
            $nombres = $_POST['txtNombres'];
        }
        if (isset($_POST['selTipo'])) {
            $tipo = $_POST['selTipo'];
        } 
        if (isset($_POST['selUso'])) {
            $uso = $_POST['selUso'];
        }
        $data = array(
            'nick' => $nick,
            'clave' => md5($clave),
            'correo' => $correo,
            'nombres' => $nombres,
            'tipo' => $tipo,
            'uso' => $uso,
            'estado' => 1
           
        );
        $this->db->insert('usuario', $data);
        return $this->db->insert_id();
    }
    
    function usuarioQry_upd() {
        if (!empty($_POST["txtIdEditar"])) {
            $id = $_POST["txtIdEditar"];
        }
        $nick = null;
        $clave = null;
        $correo = null;
        $nombres = null;
        $tipo = null;
        $uso = null;
        if (isset($_POST['txtNick'])) {
            $nick = $_POST['txtNick'];
        }
        if (isset($_POST['txtClave'])) {
            $clave = $_POST['txtClave'];
        }
        if (isset($_POST['txtCorreo'])) {
            $correo = $_POST['txtCorreo'];
        }
        if (isset($_POST['txtNombres'])) {
            $nombres = $_POST['txtNombres'];
        }
        if (isset($_POST['selTipo'])) {
            $tipo = $_POST['selTipo'];
        } 
        if (isset($_POST['selUso'])) {
            $uso = $_POST['selUso'];
        }
        $data = array(
            'nick' => $nick,
            'clave' => md5($clave),
            'correo' => $correo,
            'nombres' => $nombres,
            'tipo' => $tipo,
            'uso' => $uso,
            'estado' => 1
           
        );
        
        $this->db->where('id', $id);
        $this->db->update('usuario', $data);
    }
    
    function usuarioQry_updestado() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }

        $this->db->set('estado', $estado, FALSE);
        $this->db->where('id', $id);
        $this->db->update('usuario');
    }
    
}