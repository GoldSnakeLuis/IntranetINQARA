<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Personas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Recursos/Persona_model');
        $this->load->model('Recursos/Usuario_model');
    }

    public function index() {
        $data['actualP'] = 'Recursos Huamanos';
        $data['actualH'] = 'Personas';
        $data['main_content'] = 'recursos/personas_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Personas';
        $this->load->view('master/template', $data);
    }

    public function Personas_lista() {
        $data = json_encode($this->Persona_model->personaQry_listar());
        return print_r($data);
    }

    public function Personas_listaxID() {
        $data = json_encode($this->Persona_model->personaQry_getxid());
        return print_r($data);
    }

    public function Personas_listaxParam() {
        $data = json_encode($this->Persona_model->personaQry_getxparam());
        return print_r($data);
    }
    public function Personas_actualizaEstado() {
        $data = $this->Persona_model->personaQry_updestado();
        return print_r($data);
    }
    
    public function Personas_registrar() {
        if (!empty($_POST["txtIdEditar"])) {
                $data = $this->Persona_model->personaQry_upd();
            } else {
                $data = $this->Persona_model->personaQry_ins();
            }
    }
}
