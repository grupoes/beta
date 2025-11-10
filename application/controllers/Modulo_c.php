<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Modulo_c extends Controler {

	public function index(){
		//if ($this->input->is_ajax_request()){
			$lista = $this->db->query("select * from modulo where mod_estado=1")->result();
			$this->load->view('Modulos/index',compact('lista'));
		//}else{
			//$this->load->view('Error/404');
		//}
	}

	public function new_modulo(){
		if ($this->input->is_ajax_request()){
			$padres = $this->db->query("select *from modulo where mod_padre=0 and mod_estado=1")->result();
			$this->load->view('Modulos/nuevo',compact('padres'));
		}else{
			$this->load->view('Error/404');
		}
	}


	public function save_modulo(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'mod_descripcion' => $_POST["modulo"],
				'mod_url' => $_POST["url"],
				'mod_padre' => $_POST["padre"],
				'mod_icono' => $_POST["icono"]
				);
			if($_POST["id"]==""){
				$estado=$this->db->insert('modulo', $data);
			}else{
				$this->db->where('mod_id',$_POST["id"]);
				$estado=$this->db->update('modulo', $data);
			}
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

	function update_modulo(){
		$query = $this->db->get_where('modulo', array('mod_id' => $_POST["id"]))->result();
		echo json_encode($query);
	}

	function delete_modulo(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'mod_estado' => 0
				);
			$this->db->where('mod_id', $_POST["id"]);
			$estado=$this->db->update('modulo', $data);
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

}