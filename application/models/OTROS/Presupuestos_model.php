<?php

class Presupuestos_model extends CI_Model {

    function presupuestoQry_getxid() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        $query = $this->db->query('SELECT * FROM presupuestos WHERE estado = 1 or estado = 2 and  id= "' . $id . '";');
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function presupuestoQry_getxidObra() {
        if (isset($_POST['cboobra'])) {
            $id = $_POST['cboobra'];
        }
        $query = $this->db->query('SELECT * FROM presupuestos WHERE estado = 1 and obras_id= "' . $id . '";');
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function presupuestoQry_get() {

        $query = $this->db->query('SELECT p.*,o.NombreCorto as Obra FROM presupuestos p inner join obras o on p.obras_id = o.id WHERE p.estado = 1 ;');
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function presupuestoQry_updestado() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }

        $this->db->set('estado', $estado, FALSE);
        $this->db->where('id', $id);
        $this->db->update('presupuestos');
    }

    function presupuestoQry_ins() {
        $ofertado = null;
        $adicional = null;
        $reintegros = null;
        $deductivos = null;
        $obras_id = null;
        
        if (isset($_POST['ofertado'])) {
            $ofertado = $_POST['ofertado'];
        }
        if (isset($_POST['adicional'])) {
            $adicional = $_POST['adicional'];
        }
        if (isset($_POST['reintegros'])) {
            $reintegros = $_POST['reintegros'];
        }
        if (isset($_POST['deductivos'])) {
            $deductivos = $_POST['deductivos'];
        }
        if (isset($_POST['selectObra'])) {
            $obras_id = $_POST['selectObra'];
        }
        
        $data = array(
            'ofertado' => $ofertado,
            'adicional' => $adicional,
            'reintegros' => $reintegros,
            'deductivos' => $deductivos,
            'obras_id' => $obras_id
        );

        $this->db->insert('presupuestos', $data);
    }

    function presupuestoQry_upd() {
        
        if (isset($_POST['txtIdEditar'])) {
            $editarID = $_POST['txtIdEditar'];
        }

        $ofertado = null;
        $adicional = null;
        $reintegros = null;
        $deductivos = null;
        $obras_id = null;
        
        if (isset($_POST['ofertado'])) {
            $ofertado = $_POST['ofertado'];
        }
        if (isset($_POST['adicional'])) {
            $adicional = $_POST['adicional'];
        }
        if (isset($_POST['reintegros'])) {
            $reintegros = $_POST['reintegros'];
        }
        if (isset($_POST['deductivos'])) {
            $deductivos = $_POST['deductivos'];
        }
           if (isset($_POST['selectObra'])) {
            $obras_id = $_POST['selectObra'];
        }
        
        $data = array(
            'ofertado' => $ofertado,
            'adicional' => $adicional,
            'reintegros' => $reintegros,
            'deductivos' => $deductivos,
            'obras_id' => $obras_id
        );
        
        $this->db->where('id', $editarID);
        $this->db->update('presupuestos', $data);
    }

}
