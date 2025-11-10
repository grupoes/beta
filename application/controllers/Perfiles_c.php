<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Perfiles_c extends Controler{
	public function index(){
		//if ($this->input->is_ajax_request()){
			$lista = $this->db->query("select * from perfil where per_estado=1")->result();
			$this->load->view('Perfiles/index',compact('lista'));
		//}else{
		//	$this->load->view('Error/404');
		//}
	}

	public function new_perfil(){
		$this->load->view('Perfiles/nuevo');
	}
	public function save_perfil(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'per_descripcion' => $_POST["perfil"],
				'observacion' => $_POST["descripcion"]
				);
			if($_POST["id"]==""){
				$estado=$this->db->insert('perfil', $data);
			}else{
				$this->db->where('per_id',$_POST["id"]);
				$estado=$this->db->update('perfil', $data);
			}
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

	function update_perfil(){
		$query = $this->db->get_where('perfil', array('per_id' => $_POST["id"]))->result();
		echo json_encode($query);
	}

	function delete_perfil(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'per_estado' => 0
				);
			$this->db->where('per_id', $_POST["id"]);
			$estado=$this->db->update('perfil', $data);
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}
	
}