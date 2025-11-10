<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Tipo_caja extends Controler {

	public function index(){
		
			$lista = $this->db->query("select * from caja where caja_estado=1")->result();
            	$this->load->view('Tipo_caja/index',compact('lista'));
        	
	}

	public function new_caja(){
		if ($this->input->is_ajax_request()){
			$this->load->view('Tipo_caja/nuevo');
        	}else{
            	$this->load->view('Error/404');
        	}
	}

	function save_caja(){
		if ($this->input->is_ajax_request()){
			$data = array(
	           	'caja_descripcion' => $_POST["descripcion"],
	           
	        	);
	        	if($_POST["id"]==""){
	            	$estado=$this->db->insert('caja', $data);
	        	}else{
	            	$this->db->where('id_caja',$_POST["id"]);
	            	$estado=$this->db->update('caja', $data);
	        	}
	        	echo $estado;
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function update_caja(){
        	$query = $this->db->get_where('caja', array('id_caja' => $_POST["id"]))->result();
        	echo json_encode($query);
    	}

    	function delete_caja(){
    		if ($this->input->is_ajax_request()){
    			$data = array(
	           	'caja_estado' => 0
	        	);
	        	$this->db->where('id_caja', $_POST["id"]);
	        	$estado=$this->db->update('caja', $data);
	        	echo $estado;
    		}else{
            	$this->load->view('Error/404');
        	}
    	}
}