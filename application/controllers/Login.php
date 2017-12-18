<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login/login_model');
    }

    public function index() {                
        $this->load->view('login_view');
    }

    public function iniciarSesion() {
        $nombre = $this->input->post('nick');
        $password = md5($this->input->post('clave'));

        $resultado = $this->login_model->loginQry_login($nombre, $password);

        if ($resultado != null) {
            if ($resultado->clave == $password) {

                $data = array(
                    'nick' => $resultado->nick,
                    'nombre' => $resultado->nombres,
                    'correo' => $resultado->correo,
                    'login' => true
                );
                $this->session->set_userdata($data);
                header("Location: " . MAIN_URL . "/Dashboard");
            } else {
                header("Location: " . MAIN_URL);
                die();
            }
        } else {
            header("Location: " . MAIN_URL);
            die();
        }
    }

    public function cerrarSesion() {
        $this->session->sess_destroy();
        header("Location: " . MAIN_URL);
    }

}
