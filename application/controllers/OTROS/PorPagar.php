<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PorPagar extends CI_Controller {
    public $tipo = 'P';
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Cobrarpagardoc_model');
        $this->load->model('Mantenedores/Documento_model');
        $this->load->model('Ctactecpd_model');
        $this->load->model('Mantenedores/Obra_model');
    }
    
    public function index() {
        $data['actualP'] = 'Cuentas Por Pagar';
        $data['actualH'] = 'PorPagar';
        $data['main_content'] = 'porpagar/porpagar_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | PorPagar';
        $this->load->view('master/template', $data);
    }
    
    
    function calcular_total() {
        if (isset($_POST['txtTotalValor'])) {
            $valorinicial = $_POST['txtTotalValor'];
        }
        if (isset($_POST['txtadelantDir'])) {
            $adelantodirecto = $_POST['txtadelantDir'];
        }
         if (isset($_POST['txtAdelantoMat'])) {
            $adelantomateriales = $_POST['txtAdelantoMat'];
        }
        $montototal = $valorinicial - $adelantodirecto-$adelantomateriales;
        return $montototal;
    }
    
    public function PorPagarPorPagar_lista() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_Sumatorias($this->tipo));
        return print_r($data);
    }
    public function PorPagarPorPagar_listaxObra() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxidObraSumatorias($this->tipo));
        return print_r($data);
    }
     public function PorPagar_listaxPorPagar() {
        $data = json_encode($this->Ctactecpd_model->ctactecpdQry_getxAmortización());
        return print_r($data);
    }
    
    public function PorPagar_lista() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_listar($this->tipo));
        return print_r($data);
    }

    public function PorPagar_listaxObra() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxidObra($this->tipo));
        return print_r($data);
    }
    
    public function PorPagar_listaxID() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxid($this->tipo));
        return print_r($data);
    }

    public function PorPagar_Eliminar() {
        $this->db->trans_start();
            $data = $this->Ctactecpd_model->ctactecpdQry_eliminarxCPD();
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_eliminar();
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }    
        
        return print_r($data);
    }
    
    public function PorPagar_registrar() {
        $montototal = $this->calcular_total();
        if (!empty($_POST["txtIdEditar"])) {
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_upd();
        } else {
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_ins($montototal,$this->tipo);
        }
        return print_r($data);
    } 
    public function Ctacte_Eliminar() {
        $this->db->trans_start(); 
            $query3 = $this->Ctactecpd_model->ctactecpdQry_getxid();
            $data = $this->Ctactecpd_model->ctactecpdQry_eliminar();
            $query = $this->Ctactecpd_model->ctactecpdQry_getsumatoria();
            $query2 = $this->Cobrarpagardoc_model->cobrarpagardocQry_getxid($this->tipo);
                $saldo=$query2[0]->Saldo+$query3[0]->Pago;
                $pagado = $query[0]->Pago;
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_upd($pagado,$saldo);
            
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }
        return print_r($data);
    }
    public function Ctacte_registrar() {
        $this->db->trans_start(); 
            $data = $this->Ctactecpd_model->ctactecpdQry_ins();
            $query = $this->Ctactecpd_model->ctactecpdQry_getsumatoria();
            $query2 = $this->Cobrarpagardoc_model->cobrarpagardocQry_getxid($this->tipo);
                if (isset($_POST['pago'])) {
                    $pago = $_POST['pago'];
                }
                $saldo=$query2[0]->Saldo-$pago;
                $pagado = $query[0]->Pago;
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_upd($pagado,$saldo);
        
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }
        
        return print_r($data);
    } 
    
    
     public function generaReporte() {
        $data['titulo'] = 'Reporte por Pagar';
        $data['porpagar'] = $this->Cobrarpagardoc_model->cobrarpagardocQry_getxidObraSumatorias($this->tipo);
        $_POST['id'] = $_REQUEST['cboobra'];
        $data['info_obra'] = $this->Obra_model->obraQry_getxid();

//        $this->load->library('pdf');
//        $this->pdf->load_view('reportes/reporte_amortizacion', $data);
//        $this->pdf->set_paper('A4', 'landscape');
//        $this->pdf->render();
//        $this->pdf->stream("RPT_Prueba.pdf");

        $this->load->view('reportes/reporte_porpagar', $data); //descomentar para ver en HTML y no como PDF
    }
}
