<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Xcobrar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //$this->load->model('master/master_model');
    }

    public function amortizaciones() {
        $data['actualP'] = 'xCobrar';
        $data['actualH'] = 'Amortizaciones';
        //$data['slider_principal'] = $this->master_model->slider_principal('panel_noticias');        
        $data['main_content'] = 'xCobrar/amortizaciones_view';
        $data['titulo'] = 'CHC | Amortizaciones';
        $this->load->view('master/template', $data);
    }

}
