<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
    }

    public function index() {
        $data['actualP'] = 'Dashboard';
        $data['actualH'] = 'Dashboard';
        //$data['slider_principal'] = $this->master_model->slider_principal('panel_noticias');        
        $data['main_content'] = 'dashboard/dashboard_view';
        $data['titulo'] = 'CHC | Bienvenida';
        $this->load->view('master/template', $data);
    }

}
