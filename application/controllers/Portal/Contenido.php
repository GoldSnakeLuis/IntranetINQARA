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

    public function Ventana_lista() {
        $data = json_encode($this->Ventana_model->ventanaQry_listar());
        return print_r($data);
    }
    
    public function Ventana_listaxid() {
        $data = json_encode($this->Ventana_model->ventanaQry_getxid());
        return print_r($data);
    }
    
    public function Contenido_lista() {
        $data = json_encode($this->Contenido_model->contenidoQry_listar());
        return print_r($data);
    }
    
    public function Contenido_listaxID() {
        $data = json_encode($this->Contenido_model->contenidoQry_getxid());
        return print_r($data);
    }

    public function Contenido_listaxidVentana() {
        $data = json_encode($this->Contenido_model->contenidoQry_getxidVentana());
        return print_r($data);
    }

    public function Contenido_actualizaEstado() {
        $data = $this->Contenido_model->contenidoQry_updestado();
        return print_r($data);
    }
    
    public function Contenido_registrar() {
        date_default_timezone_set('America/Lima');
        $date = date('dmY_his', time());
        $extensiones = array('jpeg', 'jpg', 'png', 'gif', 'bmp', ''); // valid extensions
        $rutaIMG = URL_UPLOAD . 'img/slides/';
        $urlIMGThumbs = URL_UPLOAD . 'img/slides/thumbnails';
        
        if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
            $img = $_FILES['image']['name'];
            $tmp = $_FILES['image']['tmp_name'];
            $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
            $imgNombre = 'contenido_' . $date . '.' . $ext;
            if (in_array($ext, $extensiones)) {
                $rutaIMG = $rutaIMG . strtolower($imgNombre);
                if (move_uploaded_file($tmp, $rutaIMG)) {
                    chmod($rutaIMG, 0755);

                    $this->load->library('image_lib');
//      ************* REDIMENCIONAR **************
                    $img_cfg['image_library'] = 'gd2';
                    $img_cfg['source_image'] = $rutaIMG;
                    $img_cfg['maintain_ratio'] = FALSE;
                    //$img_cfg['create_thumb'] = TRUE;
                    $img_cfg['new_image'] = $rutaIMG;
                    $img_cfg['width'] = 1528;
                    $img_cfg['height'] = 500;
                    $img_cfg['quality'] = 100;
                    $img_cfg['file_name'] = $imgNombre;
//      ************* CREAR THUMBNAIL **************
                    $img_thumb['image_library'] = 'gd2';
                    $img_thumb['source_image'] = $rutaIMG;
                    $img_thumb['maintain_ratio'] = FALSE;
                    //$img_thumb['create_thumb'] = TRUE;
                    $img_thumb['new_image'] = $urlIMGThumbs;
                    $img_thumb['width'] = 300;
                    $img_thumb['height'] = 130;
                    $img_thumb['quality'] = 100;
                    $img_thumb['file_name'] = $imgNombre;

                    $this->image_lib->initialize($img_cfg);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
                    $this->image_lib->initialize($img_thumb);
                    $this->image_lib->resize();
                    $this->image_lib->clear();
//      ************* FIN THUMBNAIL **************   
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                    $this->db->trans_start(); 
                        if (!empty($_POST["txtIdEditar"])) {
                            $data = $this->Contenido_model->contenidoQry_upd($imgNombre);
                        } else {
                            $data = $this->Contenido_model->contenidoQry_ins($imgNombre);
                            $data = $this->Ventana_model->ventanaDetQry_ins($data);
                        }
                    $this->db->trans_complete();  // rollback automático
                    if ($this->db->trans_status() === FALSE) {
                        $data = 0;
                    }
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
                }
            } else {
                echo 'Invalido';
            }
        } else {
            $data = $this->Contenido_model->contenidoQry_upd("");
        }
         return print_r($data);
    }
    
    
    
 }
