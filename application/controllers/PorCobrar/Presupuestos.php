<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuestos extends CI_Controller {
    public $tipo = 'R';
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Presupuestos_model');
        $this->load->model('Mantenedores/Obra_model');
    }
    
    
    public function index() {
        $data['actualP'] = 'Presupuestos';
        $data['actualH'] = 'Presupuestos';
        $data['main_content'] = 'porcobrar/presupuestos_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Presupuestos';
        $this->load->view('master/template', $data);
    }
   
    public function Presupuesto_listaxObra() {
        $data = json_encode($this->Presupuestos_model->presupuestoQry_getxidObra());
        return print_r($data);
    }
    
    public function Presupuesto_lista() {
        $data = json_encode($this->Presupuestos_model->presupuestoQry_get());
        return print_r($data);
    }
    
    public function Presupuesto_listaxID() {
        $data = json_encode($this->Presupuestos_model->presupuestoQry_getxid());
        return print_r($data);
    }

     public function Presupuesto_actualizaEstado() {
        $data = $this->Presupuestos_model->presupuestoQry_updestado();
        return print_r($data);
    }

    public function Presupuesto_registrar() {
        if (!empty($_POST["txtIdEditar"])) {
            $data = $this->Presupuestos_model->presupuestoQry_upd();
        } else {
            $data = $this->Presupuestos_model->presupuestoQry_ins();
        }
        return print_r($data);
    } 
}
