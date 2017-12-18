<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Documentos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Mantenedores/Documento_model');
    }

    public function index() {
        $data['actualP'] = 'Mantenedor';
        $data['actualH'] = 'Documentos';
        $data['main_content'] = 'mantenedores/documentos_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Clientes/Proveedores';
        $this->load->view('master/template', $data);
    }

    public function Documentos_lista() {
        $data = json_encode($this->Documento_model->documentoQry_listar());
        return print_r($data);
    }

    public function Documento_listaxID() {
        $data = json_encode($this->Documento_model->documentoQry_getxid());
        return print_r($data);
    }
/*
    public function Documento_actualizaEstado() {
        $data = $this->Documento_model->documentoQry_updestado();
        return print_r($data);
    }
*/
    public function Documento_registrar() {
        $data = $this->Documento_model->documentoQry_ins();
        return print_r($data);
    }
}
