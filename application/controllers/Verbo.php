<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Verbo extends Controler {

	public function index(){
		if ($this->input->is_ajax_request()){
			$lista = $this->db->query("SELECT verbo.ver_id,verbo.ver_verbo, verbo.ver_observacion FROM verbo where verbo.estado = 1")->result();
			$this->load->view('Verbo/index',compact('lista'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function new_modulo(){
		if ($this->input->is_ajax_request()){
			$padres = $this->db->query("SELECT tipo_verbo.tiv_id,tipo_verbo.tiv_tipverbo FROM tipo_verbo where estado = 1")->result();
			$this->load->view('Verbo/nuevo',compact('padres'));
		}else{
			$this->load->view('Error/404');
		}
	}


	public function save_modulo(){
		if ($this->input->is_ajax_request()){
			$valores = $_POST['tipoverbo'];
			$data = array(
				'ver_verbo' => $_POST["verbo"],
				'ver_sus1' => $_POST["pal1"],
				'ver_sus2' => $_POST["pal2"],
				'ver_observacion' => $_POST["observacion"]
				);
			if($_POST["id"]==""){
				$estado=$this->db->insert('verbo', $data);
				$id_verbo = $this->db->query("SELECT verbo.ver_id FROM verbo where ver_verbo ='".$_POST["verbo"]."' ")->result_array();
				for ($j=0; $j <count($valores); $j++) { 
					 $guardar = array(
					'tiv_id' => $valores[$j],
					'ver_id' => $id_verbo[0]["ver_id"]
					);
				$estado=$this->db->insert('detalle_tip_verbo', $guardar);
				}
			}else{
				$this->db->where('ver_id',$_POST["id"]);
				$estado=$this->db->update('verbo', $data);
			}
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

	function update_modulo(){

	}

	function delete_modulo(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'estado' => 0
				);
			$this->db->where('ver_id', $_POST["id"]);
			$estado=$this->db->update('verbo', $data);
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

}