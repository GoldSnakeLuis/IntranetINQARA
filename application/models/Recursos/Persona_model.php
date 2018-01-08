<?php

class Persona_model extends CI_Model {

    function personaQry_listar() {

        $this->db->select('*');
        $this->db->from('persona');
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

    function personaQry_getxid() {
        if (isset($_POST['id'])) {
            $idpersona = $_POST['id'];
        }
         $this->db->select('*');
        $this->db->from('persona');
        $this->db->where('id',$idpersona );
        $this->db->where('estado', 1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
   
    function personaQry_ins() {
        $dni = null;
        $nombre = null;
        $apaterno = null;
        $amaterno = null;
        $fechanac = null;
        $ubigeo = null;
        $direccion = null;
        $nrocta = null;
        
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'];
        }
        if (isset($_POST['txtAPaterno'])) {
            $apaterno = $_POST['txtAPaterno'];
        }
        if (isset($_POST['txtAMaterno'])) {
            $amaterno = $_POST['txtAMaterno'];
        }
        if (isset($_POST['txtFechaNacimiento'])) {
            $fechanac = trim($_POST['txtFechaNacimiento']);
            $fechanac = DateTime::createFromFormat('d/m/Y', $fechanac)->format('Y-m-d');
        }
        if (isset($_POST['selDep']) && isset($_POST['selDist']) && isset($_POST['selProv']) ) {
            $ubigeo = $_POST['selDep'] . "" .$_POST['selDist']."" .$_POST['selProv'];
        }
        if (isset($_POST['txtDireccion'])) {
            $direccion = $_POST['txtDireccion'];
        }
        if (isset($_POST['selTipo'])) {
            $tipo = $_POST['selTipo'];
        } 
        if (isset($_POST['selUso'])) {
            $uso = $_POST['selUso'];
        }
        $data = array(
            'dni' => $dni,
            'nombre' => $nombre,
            'apellido_paterno' => $apaterno,
            'apellido_materno' => $amaterno,
            'fecha_nacimiento' => $fechanac,
            'ubigeo' => $ubigeo,
            'direccion' => $direccion,
            'nro_cuenta' => $nrocta,
            'estado' => 1
           
        );
        $this->db->insert('persona', $data);
        return $this->db->insert_id();
    }
    
    function personaQry_upd() {
        if (!empty($_POST["txtIdEditar"])) {
            $id = $_POST["txtIdEditar"];
        }
         $dni = null;
        $nombre = null;
        $apaterno = null;
        $amaterno = null;
        $fechanac = null;
        $ubigeo = null;
        $direccion = null;
        $nrocta = null;
        
        if (isset($_POST['txtNombre'])) {
            $nombre = $_POST['txtNombre'];
        }
        if (isset($_POST['txtAPaterno'])) {
            $apaterno = $_POST['txtAPaterno'];
        }
        if (isset($_POST['txtAMaterno'])) {
            $amaterno = $_POST['txtAMaterno'];
        }
        if (isset($_POST['txtFechaNacimiento'])) {
            $fechanac = trim($_POST['txtFechaNacimiento']);
            $fechanac = DateTime::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
        }
        if (isset($_POST['selDep']) && isset($_POST['selDist']) && isset($_POST['selProv']) ) {
            $ubigeo = $_POST['selDep'] . "" .$_POST['selDist']."" .$_POST['selProv'];
        }
        if (isset($_POST['txtDireccion'])) {
            $direccion = $_POST['txtDireccion'];
        }
        if (isset($_POST['selTipo'])) {
            $tipo = $_POST['selTipo'];
        } 
        if (isset($_POST['selUso'])) {
            $uso = $_POST['selUso'];
        }
        $data = array(
            'dni' => $dni,
            'nombre' => $nombre,
            'apellido_paterno' => $apaterno,
            'apellido_materno' => $amaterno,
            'fecha_nacimiento' => $fechanac,
            'ubigeo' => $ubigeo,
            'direccion' => $direccion,
            'nro_cuenta' => $nrocta,
            'estado' => 1
           
        );
        
        $this->db->where('id', $id);
        $this->db->update('persona', $data);
    }
    
    function personaQry_updestado() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }

        $this->db->set('estado', $estado, FALSE);
        $this->db->where('id', $id);
        $this->db->update('persona');
    }
    
}