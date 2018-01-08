<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Obras extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Mantenedores/Obra_model');
    }

    public function index() {
        $data['actualP'] = 'Mantenedor';
        $data['actualH'] = 'Proyectos/Obras';
        $data['main_content'] = 'mantenedores/obras_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Obras';
        $this->load->view('master/template', $data);
    }

    public function Obras_lista() {
        $data = json_encode($this->Obra_model->obraQry_listar());
        return print_r($data);
    }

    public function Obra_listaxID() {
        $data = json_encode($this->Obra_model->obraQry_getxid());
        return print_r($data);
    }

    public function Obra_actualizaEstado() {
        $data = $this->Obra_model->obraQry_updestado();
        return print_r($data);
    }

    public function Obra_registrar() {
        if (!empty($_POST["txtIdEditar"])) {
            $data = $this->Obra_model->obraQry_upd();
        } else {
            $data = $this->Obra_model->obraQry_ins();
        }
        return print_r($data);
    }
}
