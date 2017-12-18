<?php

class Cobrarpagardoc_model extends CI_Model {

    function cobrarpagardocQry_listar($tipo) {
         $this->db->select('c.*,d.Descripcion as desc_documento');
        $this->db->from('cobrarpagardoc c');
        $this->db->join('documento d', 'c.documento_id = d.id');
        $this->db->where('c.Tipo', $tipo);
        $this->db->order_by('c.fecha','ASC');
        $query = $this->db->get();
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function cobrarpagardocQry_getxid($tipo) {
        if (isset($_POST['cpd_id'])) {
            $id = $_POST['cpd_id'];
        }else{
            $id = $_REQUEST['id'];
        }
        
        $this->db->select('*');
        $this->db->from('cobrarpagardoc');
        $this->db->where('Tipo', $tipo);
        $this->db->where('id', $id);
        $this->db->order_by('documento_id', 'DESC');
        $this->db->order_by('fecha', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function cobrarpagardocQry_getxidObra($tipo) {
        if (isset($_REQUEST['cboobra'])) {
            $id = $_REQUEST['cboobra'];
        }
        $this->db->select('cp.*,c.*,d.Descripcion as desc_documento,o.Monto_Inicial as monto_Obra');
        $this->db->from('cobrarpagardoc c');
        $this->db->join('documento d', 'c.documento_id = d.id');
        $this->db->join('obras o', 'c.obras_id = o.id');
        $this->db->join('clieprov cp', 'c.clieprov_id = cp.id');
        $this->db->where('c.Tipo', $tipo);
        $this->db->where('c.obras_id', $id);
        $this->db->order_by('c.fecha','ASC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function cobrarpagardocQry_getxidObraSumatorias($tipo) {
          if (isset($_REQUEST['cboobra'])) {
            $id = $_REQUEST['cboobra'];
        }
        $this->db->select('cp.Razon_Social as Empresa,cp.ruc,cta.id as cta_id,ifnull(sum(cta.Pago),0) as MontoCan,min(cta.fecha) fechaCan,(c.MontoTotal-ifnull(sum(cta.Pago),0)) as saldoResum ,c.*,d.Descripcion as desc_documento,o.Monto_Inicial as monto_Obra');
        $this->db->from('cobrarpagardoc c');
        $this->db->join('documento d', 'c.documento_id = d.id');
        $this->db->join('obras o', 'c.obras_id = o.id');
        $this->db->join('clieprov cp', 'c.clieprov_id = cp.id');
        $this->db->join('ctactecpd cta', 'cta.CobrarPagarDoc_id = c.id','left');
        $this->db->where('c.Tipo', $tipo);
        $this->db->where('c.obras_id', $id);
        $this->db->group_by('c.id','ASC');
        $this->db->order_by('c.fecha','ASC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    
    function cobrarpagardocQry_Sumatorias($tipo) {

        $this->db->select('cta.id as cta_id,ifnull(sum(cta.Pago),0) as MontoCan,min(cta.fecha) fechaCan,(c.MontoTotal-ifnull(sum(cta.Pago),0)) as saldoResum ,c.*,d.Descripcion as desc_documento,o.*');
        $this->db->from('cobrarpagardoc c');
        $this->db->join('documento d', 'c.documento_id = d.id');
        $this->db->join('obras o', 'c.obras_id = o.id');
        $this->db->join('ctactecpd cta', 'cta.CobrarPagarDoc_id = c.id','left');
        $this->db->where('c.Tipo', $tipo);
        $this->db->group_by('c.id','ASC');
        $this->db->order_by('c.fecha','ASC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function cobrarpagardocQry_eliminar() {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        
        $this->db->where('id', $id);
        $this->db->delete('cobrarpagardoc');
    }

    function cobrarpagardocQry_ins($montototal,$tipo) {
        $obras_id = null;
        $clieprov_id = null;
        $descripcion = null;
        $fecha = null;
        $numero = null;
        $valorinicial = null;
        $reajustefp = null;
        $adelantodirecto = null;
        $adelantomateriales = null;
        $deduccionrad = null;
        $deduccionram = null;
        $pagado = 0;
        $detraccion = 'NO';
        $saldo = $montototal;
        $documento_id = null;
        $banco = null;
        $cuenta = null;
        $cci=null;
        $doc = '';
        
        if (isset($_POST['selectDoc'])) {
            $documento_id = $_POST['selectDoc'];
        }
        if (isset($_POST['idObra'])) {
            $obras_id = $_POST['idObra'];
        }
        if (isset($_POST['selectClienteProv'])) {
            $clieprov_id = $_POST['selectClienteProv'];
        }
        if (isset($_POST['txtDescripcion'])) {
            $descripcion = $_POST['txtDescripcion'];
        }
        if (isset($_POST['desc_doc'])) {
            $doc = $_POST['desc_doc'];
        }
        if (isset($_POST['txtNroFactura'])) {
            $numero = $_POST['txtNroFactura'];
        }
        if (isset($_POST['txtTotalValor'])) {
            $valorinicial = $_POST['txtTotalValor'];
        }
        if (isset($_POST['txtReajusteForm'])) {
            $reajustefp = $_POST['txtReajusteForm'];
        }
        if (isset($_POST['txtadelantDir'])) {
            $adelantodirecto = $_POST['txtadelantDir'];
        }
        if (isset($_POST['txtAdelantoMat'])) {
            $adelantomateriales = $_POST['txtAdelantoMat'];
        }
        if (isset($_POST['txtDeduccionAdDir'])) {
            $deduccionrad = $_POST['txtDeduccionAdDir'];
        }
        if (isset($_POST['txtDeduccionAdMat'])) {
            $deduccionram = $_POST['txtDeduccionAdMat'];
        }
        if (isset($_POST['txtFechaFactura'])) {
            $fecha = trim($_POST['txtFechaFactura']);
            $fecha = DateTime::createFromFormat('d/m/Y', $fecha)->format('Y-m-d');
        }
        
        if (isset($_POST['txtBanco'])) {
            $banco = $_POST['txtBanco'];
        }
        if (isset($_POST['txtCuenta'])) {
            $cuenta = $_POST['txtCuenta'];
        }
        if (isset($_POST['txtCci'])) {
            $cci = $_POST['txtCci'];
        }
        
        $data = array(
            'obras_id' => $obras_id,
            'clieprov_id' => $clieprov_id,
            'Descripcion' => $doc . " " .$descripcion,
            'Fecha' => $fecha,
            'Numero' => $numero,
            'ValorInicial' => $valorinicial,
            'ReajusteFP' => $reajustefp,
            'AdelantoDirecto' => $adelantodirecto,
            'AdelantoMateriales' => $adelantomateriales,
            'DeduccionRAD' => $deduccionrad,
            'DeduccionRAM' => $deduccionram,
            'MontoTotal' => $montototal,
            'Pagado' => $pagado,
            'Saldo' => $saldo,
            'Tipo' => $tipo,
            'Detraccion' => $detraccion,
            'documento_id' => $documento_id,
            'banco' => $banco,
            'cuenta' => $cuenta,
            'cci' => $cci
        );
        $this->db->insert('cobrarpagardoc', $data);
    }

    function cobrarpagardocQry_upd($pagado,$saldo) {
        if($saldo==0){
            $detraccion = 'SI';
        }else{
            $detraccion = 'NO';
        }
        
        if (isset($_POST['cpd_id'])) {
            $id = $_POST['cpd_id'];
        }
        $data = array(
            'Pagado' => $pagado,
            'Saldo' => $saldo,
            'Detraccion' => $detraccion,
        );
        
        $this->db->where('id', $id);
        $this->db->update('cobrarpagardoc', $data);
    }

}
