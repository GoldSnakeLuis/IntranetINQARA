<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            header("Location: " . MAIN_URL);
        }
        $this->load->model('Recursos/Usuario_model');
        $this->load->model('Recursos/Permiso_model');
        $this->load->model('Portal/Menu_model');
    }

    public function index() {
        $data['actualP'] = 'Recursos Huamanos';
        $data['actualH'] = 'Usuarios';
        $data['main_content'] = 'recursos/usuarios_view';
        $data['page_assets'] = 'advance_form';
        $data['titulo'] = 'INTRANET | Usuarios';
        $this->load->view('master/template', $data);
    }

    public function Usuarios_lista() {
        $data = json_encode($this->Usuario_model->usuarioQry_listar());
        return print_r($data);
    }

    public function Usuarios_listaxID() {
        $data = json_encode($this->Usuario_model->usuarioQry_getxid());
        return print_r($data);
    }

    public function Usuarios_listaxParam() {
        $data = json_encode($this->Usuario_model->usuarioQry_getxparam());
        return print_r($data);
    }
    public function Usuarios_actualizaEstado() {
        $data = $this->Usuario_model->usuarioQry_updestado();
        return print_r($data);
    }
    
    public function Usuarios_registrar() {
            if (!empty($_POST["txtIdEditar"])) {
                $data = $this->Usuario_model->usuarioQry_upd();
            } else {
                $data = $this->Usuario_model->usuarioQry_ins();
            }
    }
//-----------------------------------------------------PERMISOS ---------------------------------------------
    public function Permisos_listaxUsuario() {
        $data = json_encode($this->Permiso_model->permisosQry_getxusuariovent());
        return print_r($data);
    }

    public function Usuarios_actualizaPermisos() {
        if (!empty($_POST["txtEditar"])) {
            $data = $this->Permiso_model->permisoQry_upd();
        } else  {
            $data = $this->Permiso_model->permisoQry_ins();
        }
        
        $data = json_encode($this->Permiso_model->permisosQry_getxusuariovent());
        return print_r($data);
    }
    
    
//---------------------------------------------------------------------------------------------------
    public function getModulos() {
        $modulos = json_encode($this->Menu_model->moduloQry_listar());
        return print_r($modulos);
    }

    public function getVentanas() {
        $ventanas = json_encode($this->Menu_model->ventanaQry_listar());
        return print_r($ventanas);
    }
}
