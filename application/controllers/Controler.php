<?php defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('America/Lima');
class Controler extends CI_Controller {

	public function lista_modulos(){
		$modulos = $this->db->query("select *from modulo where mod_padre=0")->result_array();
		foreach ($modulos as $key => $value) {
			$mod = $this->db->query("select modulo.*from modulo inner join permisos on(modulo.mod_id=permisos.per_modulo) inner join perfil on(perfil.per_id=permisos.per_perfil) where permisos.per_perfil=".$_SESSION["usuario_perfil"]." and modulo.mod_padre=".$value["mod_id"]." and modulo.mod_estado=1")->result_array();
			$modulos[$key]["lista"] = $mod;
		}
		return $modulos;
	}
}
