<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Conceptos extends Controler {

	public function index(){
		if ($this->input->is_ajax_request()){
			$lista = $this->db->query("select * from concepto inner join tipo_movimiento on(concepto.id_tipo_movimiento=tipo_movimiento.id_tipo_movimiento) where concepto.con_estado=1")->result();
            	$this->load->view('Conceptos/index',compact('lista'));
        	}else{
            	$this->load->view('Error/404');
        	}
	}

	public function new_concepto(){
		if ($this->input->is_ajax_request()){
			$tipos = $this->db->query("select * from tipo_movimiento where tipo_movimiento_estado=1")->result();
			$this->load->view('Conceptos/nuevo',compact('tipos'));
		}else{
			$this->load->view('Error/404');
		}
	}

	function save_concepto(){
		if ($this->input->is_ajax_request()){
			$data = array(
	           	'id_tipo_movimiento' => $_POST["tipomovimiento"],
	           	'con_descripcion' => $_POST["descripcion"]
	        	);
	        	if($_POST["id"]==""){
	            	$estado=$this->db->insert('concepto', $data);
	        	}else{
	            	$this->db->where('con_id',$_POST["id"]);
	            	$estado=$this->db->update('concepto', $data);
	        	}
	        	echo $estado;
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function update_concepto(){
        	$query = $this->db->get_where('concepto', array('con_id' => $_POST["id"]))->result();
        	echo json_encode($query);
    	}

    	function delete_concepto(){
    		if ($this->input->is_ajax_request()){
    			$data = array(
	           	'con_estado' => 0
	        	);
	        	$this->db->where('con_id', $_POST["id"]);
	        	$estado=$this->db->update('concepto', $data);
	        	echo $estado;
    		}else{
            	$this->load->view('Error/404');
        	}
    	}
}