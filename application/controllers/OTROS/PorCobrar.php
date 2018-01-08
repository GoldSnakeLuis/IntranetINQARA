<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class PorCobrar extends CI_Controller {
    public $tipo = 'A';
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Cobrarpagardoc_model');
        $this->load->model('Ctactecpd_model');
        $this->load->model('Mantenedores/Obra_model');
        $this->load->model('Presupuestos_model');
    }
    public function index() {
        $data['actualP'] = 'Por_Cobrar';
        $data['actualH'] = 'ControlPagos';
        $data['main_content'] = 'porcobrar/controlpagos_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Control de Pagos';
        $this->load->view('master/template', $data);
    }
    
    public function PorCobrarAmortizacion_listaxObra() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxidObraSumatorias($this->tipo));
        return print_r($data);
    }

    public function PorCobrar_listaxID() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxid($this->tipo));
        return print_r($data);
    }
        
    public function PorCobrar_listaxAmortizacion() {
        $data = json_encode($this->Ctactecpd_model->ctactecpdQry_getxAmortización());
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
        $data['titulo'] = 'Reporte Control Pagos';
        $data['porpagar'] = $this->Cobrarpagardoc_model->cobrarpagardocQry_getxidObraSumatorias($this->tipo);
        $data['presupuesto'] = $this->Presupuestos_model->presupuestoQry_getxidObra();
        $_POST['id'] = $_REQUEST['cboobra'];
        $data['info_obra'] = $this->Obra_model->obraQry_getxid();

//        $this->load->library('pdf');
//        $this->pdf->load_view('reportes/reporte_amortizacion', $data);
//        $this->pdf->set_paper('A4', 'landscape');
//        $this->pdf->render();
//        $this->pdf->stream("RPT_Prueba.pdf");

        $this->load->view('reportes/reporte_controlpago', $data); //descomentar para ver en HTML y no como PDF
    }
}
