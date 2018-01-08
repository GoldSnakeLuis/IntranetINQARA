<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CartaFianza extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('CartaFianza_model');
        $this->load->model('Mantenedores/Obra_model');
    }

    public function index() {
        $data['actualP'] = 'CartaFianza';
        $data['actualH'] = 'CartaFianza';
        $data['main_content'] = 'cartafianza/cartafianza_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | CartaFianza';
        $this->load->view('master/template', $data);
    }

    public function CartaFianza_lista() {
        $data = json_encode($this->CartaFianza_model->cartafianzaQry_listar());
        return print_r($data);
    }

    public function CartaFianza_listaxidObra() {
        $data = json_encode($this->CartaFianza_model->cartafianzaQry_getxidObra());
        return print_r($data);
    }

    public function CartaFianzaDet_listaxIDCF() {
        $data = json_encode($this->CartaFianza_model->cartafianzadetQry_getxidCF());
        return print_r($data);
    }
    
    public function CartaFianza_listaxID() {
        $data = json_encode($this->CartaFianza_model->cartafianzaQry_getxid());
        return print_r($data);
    }

    public function CartaFianza_actualizaEstado() {
        $data = $this->CartaFianza_model->cartafianzaQry_updestado();
        return print_r($data);
    }

    public function CartaFianzaDet_Eliminar() {
        $data = $this->CartaFianza_model->cartafianzaDetQry_Eliminar();
        return print_r($data);
    }
    
    public function CartaFianzaDet_registrar() {
        $data = $this->CartaFianza_model->cartafianzafecQry_ins();
        return print_r($data);
    }
    
    public function CartaFianza_Eliminar() {
        $this->db->trans_start();
            $data = $this->CartaFianza_model->cartafianzaDetQry_EliminarAll();
            $data = $this->CartaFianza_model->cartafianzaQry_Eliminar();
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }
        return print_r($data);
    }
    
    public function CartaFianza_registrar() {
        $this->db->trans_start(); 
            if (!empty($_POST["txtIdEditar"])) {
                $data = $this->CartaFianza_model->cartafianzaQry_upd();
            } else {
                $data = $this->CartaFianza_model->cartafianzaQry_ins();
                $data = $this->CartaFianza_model->cartafianzafecQry_ins2($data);
            }
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }
        return print_r($data);
    }

    public function generaReporte() {
        $data['titulo'] = 'Reporte Cartas Fianza';
        $data['cartafianza'] = $this->CartaFianza_model->cartafianzaRepQry_getxidObra();
        $_POST['id'] = $_REQUEST['idObra'];
        $data['info_obra'] = $this->Obra_model->obraQry_getxid();
/*
        $this->load->library('pdf');
        $this->pdf->load_view('reportes/reporte_cartafianza', $data);
        $this->pdf->set_paper('A4', 'landscape');
        $this->pdf->render();
        $this->pdf->stream("RPT_Prueba.pdf");
*/
        $this->load->view('reportes/reporte_cartafianza', $data); //descomentar para ver en HTML y no como PDF
    }

}
