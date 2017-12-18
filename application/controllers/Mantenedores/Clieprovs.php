<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Clieprovs extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Mantenedores/Clieprov_model');
    }

    public function index() {
        $data['actualP'] = 'Mantenedor';
        $data['actualH'] = 'Cliente/Proveedor';
        $data['main_content'] = 'mantenedores/clieprovs_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Clientes/Proveedores';
        $this->load->view('master/template', $data);
    }

    public function Clieprovs_lista() {
        $data = json_encode($this->Clieprov_model->clieprovQry_listar());
        return print_r($data);
    }

    public function Clieprov_listaxID() {
        $data = json_encode($this->Clieprov_model->clieprovQry_getxid());
        return print_r($data);
    }

    /*
      public function Clieprov_actualizaEstado() {
      $data = $this->Clieprov_model->clieprovQry_updestado();
      return print_r($data);
      }
     */

    public function Clieprov_registrar() {
        $data = $this->Clieprov_model->clieprovQry_ins();
        return print_r($data);
    }

}
