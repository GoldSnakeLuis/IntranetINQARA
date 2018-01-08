<?php

class CartaFianza_model extends CI_Model {

    function cartafianzaQry_listar() {

        $this->db->select('*');
        $this->db->from('cartafianza');
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

    function cartafianzaQry_getxid() {
        if (isset($_POST['id'])) {
            $idcartafianza = $_POST['id'];
        }
        $query = $this->db->query('SELECT * FROM cartafianza WHERE Id= "' . $idcartafianza . '";');
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function cartafianzaQry_getxidObra() {
        if (isset($_REQUEST['idObra'])) {
            $idObra = $_REQUEST['idObra'];
        }
         $this->db->select('d.*,dd.*');
        $this->db->from('cartafianza d');
        $this->db->join('cf_fechas dd', 'dd.cartafianza_id = d.id','left');
        $this->db->where('d.obras_id', $idObra);
        $this->db->where('estado', 1);
        $this->db->where('dd.visible', 0);
        
        
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function cartafianzadetQry_getxidCF() {
         if (isset($_REQUEST['id'])) {
            $idcarta = $_REQUEST['id'];
        }
        $this->db->select('dd.*');
        $this->db->from('cartafianza d');
        $this->db->join('cf_fechas dd', 'dd.cartafianza_id = d.id');
        $this->db->where('d.id', $idcarta);
        $this->db->where('estado', 1);
        $this->db->where('dd.visible', 1);
        $this->db->order_by('d.id', 'DESC');
        $query = $this->db->get();

        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    
    function cartafianzaRepQry_getxidObra() {
        if (isset($_REQUEST['idObra'])) {
            $idObra = $_REQUEST['idObra'];
        }
        $query = $this->db->query('SELECT * ,ifnull(x.contar,1) contar FROM cartafianza c '
                . 'left join cf_fechas cf on c.id = cf.cartafianza_id '
                . 'left join (select cartafianza_id,count(*) as contar from cf_fechas group by cartafianza_id) x on x.cartafianza_id = c.id '
                . 'where c.obras_id= "' . $idObra . '" and c.estado = 1 '
                . 'ORDER BY cf.cartafianza_id,cf.fechaemision ASC;');
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function CartaFianzaQry_updestado() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }

        $this->db->set('estado', $estado, FALSE);
        $this->db->where('id', $id);
        $this->db->update('cartafianza');
    }
    
    function cartafianzaDetQry_Eliminar() {
         if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $this->db->where('cartafianza_id', $id);
        $this->db->where('visible', 1);
        $this->db->delete('cf_fechas');
    }

    function cartafianzaDetQry_EliminarAll() {
         if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $this->db->where('cartafianza_id', $id);
        $this->db->delete('cf_fechas');
    }
    
    function cartafianzaQry_Eliminar() {
         if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }

        $this->db->where('id', $id);
        $this->db->delete('cartafianza');
    }
    
    function cartafianzaQry_ins() {
        $FielCumplimiento = null;
        $numero = null;
        $gastofinac = null;
        $obras_id = null;
         if (isset($_POST['txtGastoFinanciero'])) {
            $gastofinac = $_POST['txtGastoFinanciero'];
        }

        if (isset($_POST['txtFielCumplimiento'])) {
            $FielCumplimiento = $_POST['txtFielCumplimiento'];
        }
        if (isset($_POST['txtNroCarta'])) {
            $numero = $_POST['txtNroCarta'];
        }
        if (isset($_POST['idObra'])) {
            $obras_id = $_POST['idObra'];
        }

        $data = array(
            'obras_id' => $obras_id,
            'FielCumplimiento' => $FielCumplimiento,
            'numero' => $numero,
            'gastofinac' => $gastofinac,
            'estado' =>1
        );
        $this->db->insert('cartafianza', $data);
        return $this->db->insert_id();
    }

    function cartafianzafecQry_ins() {
        if (isset($_POST['cpd_id'])) {
            $cartafianza_id = $_POST['cpd_id'];
        }
        if (isset($_POST['txtFecha'])) {
            $fechaemision = trim($_POST['txtFecha']);
            $fechaemision = DateTime::createFromFormat('d/m/Y', $fechaemision)->format('Y-m-d');
        }
        if (isset($_POST['txtFecha2'])) {
            $fechavencimiento = trim($_POST['txtFecha2']);
            $fechavencimiento = DateTime::createFromFormat('d/m/Y', $fechavencimiento)->format('Y-m-d');
        }
        if (isset($_POST['txtRenov'])) {
            $montorenov = $_POST['txtRenov'];
        }
        
        $data = array(
            'cartafianza_id' => $cartafianza_id,
            'fechaemision' => $fechaemision,
            'fechavencimiento' => $fechavencimiento,
            'monto' => $montorenov,
            'visible' =>1,
            'es_amortizado' => 1,
        );
        $this->db->insert('cf_fechas', $data);
    }

    function cartafianzafecQry_ins2($cartafianza_id) {

        if (isset($_POST['txtGastoFinanciero'])) {
            $montorenov = $_POST['txtGastoFinanciero'];
        }
        if (isset($_POST['txtFechaIni'])) {
            $fechaemision = trim($_POST['txtFechaIni']);
            $fechaemision = DateTime::createFromFormat('d/m/Y', $fechaemision)->format('Y-m-d');
        }
        if (isset($_POST['txtFechaFin'])) {
            $fechavencimiento = trim($_POST['txtFechaFin']);
            $fechavencimiento = DateTime::createFromFormat('d/m/Y', $fechavencimiento)->format('Y-m-d');
        }
        
        $data = array(
            'cartafianza_id' => $cartafianza_id,
            'fechaemision' => $fechaemision,
            'fechavencimiento' => $fechavencimiento,
            'monto' => $montorenov,
            'visible' =>0,
            'es_amortizado' => 1,
        );
        $this->db->insert('cf_fechas', $data);
    }
    
    function cartafianzaQry_upd() {

        if (isset($_POST['txtIdEditar'])) {
            $editarID = $_POST['txtIdEditar'];
        }

        $FielCumplimiento = null;
        $numero = null;
        $gastofinac = null;
        $obras_id = null;


        if (isset($_POST['txtFielCumplimiento'])) {
            $FielCumplimiento = $_POST['txtFielCumplimiento'];
        }
        if (isset($_POST['txtnumero'])) {
            $numero = $_POST['txtnumero'];
        }
        if (isset($_POST['txtgastofinac'])) {
            $gastofinac = $_POST['txtgastofinac'];
        }
        if (isset($_POST['cboObras'])) {
            $obras_id = $_POST['cboObras'];
        }
        $data = array(
            'obras_id' => $obras_id,
            'FielCumplimiento' => $FielCumplimiento,
            'numero' => $numero,
            'gastofinac' => $gastofinac,
        );
        $this->db->where('id', $editarID);
        $this->db->update('cartafianza', $data);
    }

}
