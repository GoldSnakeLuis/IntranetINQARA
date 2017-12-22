<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contenido extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Portal/Contenido_model');
        $this->load->model('Portal/Ventana_model');
    }

    public function index() {
        $data['actualP'] = 'Portal';
        $data['actualH'] = 'Contenido';
        $data['main_content'] = 'portal/contenido_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Contenido';
        $this->load->view('master/template', $data);
    }

    public function Contenido_lista() {
        $data = json_encode($this->Contenido_model->contenidoQry_listar());
        return print_r($data);
    }

    public function Ventana_lista() {
        $data = json_encode($this->Ventana_model->ventanaQry_listar());
        return print_r($data);
    }
    
    public function Ventana_listaxid() {
        $data = json_encode($this->Ventana_model->ventanaQry_getxid());
        return print_r($data);
    }
    
    public function Contenido_listaxidVentana() {
        $data = json_encode($this->Contenido_model->contenidoQry_getxidVentana());
        return print_r($data);
    }

    public function Contenido_listaxID() {
        $data = json_encode($this->Contenido_model->contenidoQry_getxid());
        return print_r($data);
    }

    public function Contenido_actualizaEstado() {
        $data = $this->Contenido_model->contenidoQry_updestado();
        return print_r($data);
    }
    
    public function Contenido_Eliminar() {
        $this->db->trans_start();
            $data = $this->Contenido_model->contenidoDetQry_Eliminar();
            $data = $this->Contenido_model->contenidoQry_Eliminar();
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }
        return print_r($data);
    }
    
    public function Contenido_registrar() {
        $this->db->trans_start(); 
            if (!empty($_POST["txtIdEditar"])) {
                $data = $this->Contenido_model->contenidoQry_upd();
            } else {
                $data = $this->Contenido_model->contenidoQry_ins();
                $data = $this->Ventana_model->ventanaDetQry_ins($data);
            }
        $this->db->trans_complete();  // rollback automático
        if ($this->db->trans_status() === FALSE) {
            $data = 0;
        }
        return print_r($data);
    }
}
