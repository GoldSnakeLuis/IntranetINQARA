<?php

class Login_model extends CI_Model {

    function loginQry_login($nombre, $password) {
        $query = $this->db->query('SELECT * FROM usuario where nick = "' . $nombre . '" and clave = "' . $password . '";');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

}
