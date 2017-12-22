<?php

class Contenido_model extends CI_Model {

    function contenidoQry_listar() {

        $this->db->select('c.*,v.nombre as nombre_vent,v.link,v.estado');
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
         $this->db->select('c.*,v.nombre as nombre_vent,v.link,v.estado');
        $this->db->from('contenido c');
        $this->db->join('ventana_detalle d', 'd.contenido_id = c.id');
        $this->db->join('ventana v', 'v.id = d.ventana_id');
        $this->db->where('c.id',$idcontenido );
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
        $this->db->select('c.*,v.nombre as nombre_vent,v.link,v.estado');
        $this->db->from('contenido c');
        $this->db->join('ventana_detalle d', 'd.contenido_id = c.id');
        $this->db->join('ventana v', 'v.id = d.ventana_id');
        $this->db->where('v.id',$idVentana );
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

    function contenidoQry_ins() {
        $descripcion = null;
        $contenido = null;
        $ruta_imagen = null;
        $link = null;
        $es_titulo = null;
        $tamanio = null;
        $fuente_letra = null;
        
         if (isset($_POST['txtDescripcion'])) {
            $descripcion = $_POST['txtDescripcion'];
        }

        if (isset($_POST['txtContenido'])) {
            $contenido = $_POST['txtContenido'];
        }
        if (isset($_POST['txtrutaimagen'])) {
            $ruta_imagen = $_POST['txtrutaimagen'];
        }
        if (isset($_POST['txtlink'])) {
            $link = $_POST['txtlink'];
        }
        if (isset($_POST['es_titulo'])) {
            $es_titulo = $_POST['es_titulo'];
        }
        if (isset($_POST['txtTamanio'])) {
            $tamanio = $_POST['txtTamanio'];
        }
        if (isset($_POST['txtFuente'])) {
            $fuente_letra = $_POST['txtFuente'];
        }
        
        
        $data = array(
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            'ruta_imagen' => $ruta_imagen,
            'link' => $link,
            'es_titulo' =>$es_titulo,
            'tamanio' => $tamanio,
            'fuente_letra' => $fuente_letra
        );
        $this->db->insert('contenido', $data);
        return $this->db->insert_id();
    }

    function contenidoQry_upd() {

        if (isset($_POST['txtIdEditar'])) {
            $editarID = $_POST['txtIdEditar'];
        }

       $descripcion = null;
        $contenido = null;
        $ruta_imagen = null;
        $link = null;
        $es_titulo = null;
        $tamanio = null;
        $fuente_letra = null;
        
         if (isset($_POST['txtDescripcion'])) {
            $descripcion = $_POST['txtDescripcion'];
        }

        if (isset($_POST['txtContenido'])) {
            $contenido = $_POST['txtContenido'];
        }
        if (isset($_POST['txtrutaimagen'])) {
            $ruta_imagen = $_POST['txtrutaimagen'];
        }
        if (isset($_POST['txtlink'])) {
            $link = $_POST['txtlink'];
        }
        if (isset($_POST['es_titulo'])) {
            $es_titulo = $_POST['es_titulo'];
        }
        if (isset($_POST['txtTamanio'])) {
            $tamanio = $_POST['txtTamanio'];
        }
        if (isset($_POST['txtFuente'])) {
            $fuente_letra = $_POST['txtFuente'];
        }
        
        
        $data = array(
            'descripcion' => $descripcion,
            'contenido' => $contenido,
            'ruta_imagen' => $ruta_imagen,
            'link' => $link,
            'es_titulo' =>$es_titulo,
            'tamanio' => $tamanio,
            'fuente_letra' => $fuente_letra
        );
        
        $this->db->where('id', $editarID);
        $this->db->update('contenido', $data);
    }

}
