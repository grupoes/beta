<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Permisos_c extends Controler {

	public function index(){
		//if ($this->input->is_ajax_request()){
			if (isset($_GET["id"])) {
				$id = $_GET["id"];
			}else{
				$id=0;
			}
			$perfiles = $this->db->query("select * from perfil where per_estado=1")->result();
			$lista_permisos = $this->db->query("select *from modulo where mod_padre=0")->result_array();
			foreach ($lista_permisos as $key => $value) {
				$mod = $this->db->query("select *from modulo where mod_padre=".$value["mod_id"]." and mod_estado=1")->result_array();
				$lista_permisos[$key]["lista"] = $mod;
			}
			$activos = $this->db->get_where('permisos', array('per_perfil' =>$id))->result_array();
			$this->load->view('Permisos/index',compact('lista_permisos','activos','perfiles'));
		//}else{
			//$this->load->view('Error/404');
		//}
	}

	function save_permisos(){
		if ($this->input->is_ajax_request()){
			$this->db->where('per_perfil', $_POST["perfil"]);
			$this->db->delete('permisos');
			$estado = 1;
			if (isset($_POST['modulos'])) {
				foreach ($_POST['modulos'] as $key => $value) {
					$data = array(
						'per_perfil' => $_POST["perfil"],
						'per_modulo' => $value,
						'per_nuevo' => 1,
						'per_modificar' => 1,
						'per_eliminar' => 1,
						'per_ver' => 1,
						'per_imprimir' => 1
						);
					$estado = $this->db->insert('permisos', $data);
				}
			}
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}
}