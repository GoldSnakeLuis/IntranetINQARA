<?php

class Contenido_model extends CI_Model {

    function contenidoQry_listar() {

        $this->db->select('c.*,v.id as ventana_id,v.nombre as nombre_vent,v.link,v.estado');
        $this->db->from('contenido c');
        $this->db->join('ventana_detalle d', 'd.contenido_id = c.id');
        $this->db->join('ventana v', 'v.id = d.ventana_id');
        $this->db->where('v.estado', 1);
        $this->db->or_where('v.estado', 2);
        $this->db->order_by('v.id', 'DESC');
        $query = $this->db->get();

        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function contenidoQry_getxid() {
        if (isset($_POST['id'])) {
            $idcontenido = $_POST['id'];
        }
        $this->db->select('c.*,v.id as ventana_id,v.nombre as nombre_vent,v.link,v.estado');
        $this->db->from('contenido c');
        $this->db->join('ventana_detalle d', 'd.contenido_id = c.id');
        $this->db->join('ventana v', 'v.id = d.ventana_id');
        $this->db->where('c.id',$idcontenido );
        $this->db->where('c.estado', 1);
        $this->db->or_where('c.estado', 2);
        $this->db->where('v.estado', 1);
        $this->db->or_where('v.estado', 2);
        $this->db->order_by('v.id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    function contenidoQry_getxidVentana() {
        if (isset($_REQUEST['idVentana'])) {
            $idVentana = $_REQUEST['idVentana'];
        }
        $this->db->select('c.*,v.id as ventana_id,v.nombre as nombre_vent,v.link,v.estado');
        $this->db->from('contenido c');
        $this->db->join('ventana_detalle d', 'd.contenido_id = c.id');
        $this->db->join('ventana v', 'v.id = d.ventana_id');
        $this->db->where('v.id',$idVentana );
        $this->db->where('c.estado', 1);
        $this->db->or_where('c.estado', 2);
        $this->db->where('v.estado', 1);
        $this->db->or_where('v.estado', 2);
        $this->db->order_by('v.id', 'DESC');
        $query = $this->db->get();
        
        if (count($query) > 0) {
            return $query->result();
        } else {
            return null;
        }
    }
    
    function ContenidoQry_updestado() {
        if (isset($_REQUEST['id'])) {
            $id = $_REQUEST['id'];
        }
        if (isset($_REQUEST['estado'])) {
            $estado = $_REQUEST['estado'];
        }

        $this->db->set('estado', $estado, FALSE);
        $this->db->where('id', $id);
        $this->db->update('contenido');
    }

    function contenidoQry_ins($imgNombre) {
        $descripcion = null;
        $ruta_imagen = null;
        $link = null;
        $tamanio = null;
        $fuenteletra = null;
        $alineacion = null;
        $texto = null;
        $prioridad = null;
        $slider = null;
        $informativo = null;

        if (isset($_POST['txtDescripcion'])) {
            $descripcion = $_POST['txtDescripcion'];
        }
        if (isset($_POST['txtlink'])) {
            $link = $_POST['txtlink'];
        }
        if (isset($_POST['txtTamanio'])) {
            $tamanio = $_POST['txtTamanio'];
        }
        if (isset($_POST['txtFuente'])) {
            $fuenteletra = $_POST['txtFuente'];
        }
        if (isset($_POST['txtAlineacion'])) {
            $alineacion = $_POST['txtAlineacion'];
        }
        if (isset($_POST['txtTexto'])) {
            $texto = $_POST['txtTexto'];
        }
        if (isset($_POST['txtPrioridad'])) {
            $prioridad = $_POST['txtPrioridad'];
        }
        if (isset($_POST['chkslider'])) {
            $slider = $_POST['chkslider'];
        }
        if (isset($_POST['chkinformativo'])) {
            $informativo = $_POST['chkinformativo'];
        }
        $data = array(
            'descripcion' => $descripcion,
            'ruta_imagen' => $imgNombre,
            'link' => $link,
            'tamanio' => $tamanio,
            'fuenteletra' => $fuenteletra,
            'alineacion' => $alineacion,
            'texto' => $texto,
            'prioridad' => $prioridad,
            'slider' => $slider,
            'informativo' => $informativo,
        );
        $this->db->insert('contenido', $data);
        return $this->db->insert_id();
    }

    function contenidoQry_upd($imgNombre) {

        if (isset($_POST['txtIdEditar'])) {
            $editarID = $_POST['txtIdEditar'];
        }

        $descripcion = null;
        $ruta_imagen = null;
        $link = null;
        $tamanio = null;
        $fuenteletra = null;
        $alineacion = null;
        $texto = null;
        $prioridad = null;
        $slider = null;
        $informativo = null;

        if (isset($_POST['txtDescripcion'])) {
            $descripcion = $_POST['txtDescripcion'];
        }
        if (isset($_POST['txtlink'])) {
            $link = $_POST['txtlink'];
        }
        if (isset($_POST['txtTamanio'])) {
            $tamanio = $_POST['txtTamanio'];
        }
        if (isset($_POST['txtFuente'])) {
            $fuenteletra = $_POST['txtFuente'];
        }
        if (isset($_POST['txtAlineacion'])) {
            $alineacion = $_POST['txtAlineacion'];
        }
        if (isset($_POST['txtTexto'])) {
            $texto = $_POST['txtTexto'];
        }
        if (isset($_POST['txtPrioridad'])) {
            $prioridad = $_POST['txtPrioridad'];
        }
        if (isset($_POST['chkslider'])) {
            $slider = $_POST['chkslider'];
        }
        if (isset($_POST['chkinformativo'])) {
            $informativo = $_POST['chkinformativo'];
        }
        $data = array(
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            'link' => $link,
            'tamanio' => $tamanio,
            'fuenteletra' => $fuenteletra,
            'alineacion' => $alineacion,
            'texto' => $texto,
            'prioridad' => $prioridad,
            'slider' => $slider,
            'informativo' => $informativo,
        );
        if (isset($_FILES['image']['name']) && $imgNombre != "") {
            $data['ruta_imagen'] = $imgNombre;
        }
        $this->db->where('id', $editarID);
        $this->db->update('contenido', $data);
    }

}
