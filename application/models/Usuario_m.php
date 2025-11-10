<?php

class Usuario_m extends CI_Model
{

    function __construct() {
        parent::__construct();
    }

      public function traerusuarios() {

        $r = $this->db->query("SELECT * from usuario,perfil,persona WHERE usuario.usu_perfil=perfil.per_id and usuario.usu_estado=1 and persona.dni=usuario.persona");
        return $r->result();
    }

  

}

?>