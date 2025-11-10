<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Captacion extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("captacion");
			$this->load->view("Captacion/index",compact('lista'));

		//}
		//else{
		//	$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Captacion/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_grado="";
			if(isset($_POST['id_captacion'])){
               $id_grado=$_POST['id_grado'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);

			//print_r($data);
			if($id_grado==""){
			     $this->Mantenimiento_m->insertar("captacion",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("captacion",$data,$id_captacion,"id_captacion");
	        	 echo "2";
	        	}
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function actualizar()
	{   
		if ($this->input->is_ajax_request()){
			$data="";
			//echo $_POST['id'];
			$data=$this->Mantenimiento_m->lista_uno("captacion",$_POST['id'],"id_captacion");

			$this->load->view('Captacion/nuevo',compact("data"));
		}

		else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_captacion=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("captacion",$id_captacion,"id_captacion");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>