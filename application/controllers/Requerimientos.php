<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Requerimientos extends CI_Controller {
    public $tipo = 'R';
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Cobrarpagardoc_model');
        $this->load->model('Mantenedores/Documento_model');
    }
    
    
    public function index() {
        $data['actualP'] = 'Requerimientos';
        $data['actualH'] = 'Requerimientos';
        $data['main_content'] = 'requerimientos_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Requerimientos';
        $this->load->view('master/template', $data);
    }
   
    
    public function Requerimiento_lista() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_listar($this->tipo));
        return print_r($data);
    }

    public function Requerimiento_listaxObra() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxidObra($this->tipo));
        return print_r($data);
    }
    
    public function Requerimiento_listaxID() {
        $data = json_encode($this->Cobrarpagardoc_model->cobrarpagardocQry_getxid($this->tipo));
        return print_r($data);
    }

    public function Requerimiento_Eliminar() {
        $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_eliminar();
        return print_r($data);
    }

    public function Requerimiento_registrar() {
        if (isset($_POST['txtTotalValor'])) {
            $montototal = $_POST['txtTotalValor'];
        }
        if (!empty($_POST["txtIdEditar"])) {
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_upd();
        } else {
            $data = $this->Cobrarpagardoc_model->cobrarpagardocQry_ins($montototal,$this->tipo);
        }
        return print_r($data);
    } 
}
