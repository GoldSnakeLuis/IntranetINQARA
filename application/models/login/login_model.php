<?php

class Login_model extends CI_Model {

    function loginQry_login($nombre, $password) {
        $query = $this->db->query('SELECT * FROM usuario where (nick = "' . $nombre . '" or  correo = "' . $nombre . '" ) and uso = 1 and clave = "' . $password . '";');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

}
