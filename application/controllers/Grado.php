<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Grado extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("grado");
			$this->load->view("Grado/index",compact('lista'));

		//}
		//else{
			//$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Grado/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_grado="";
			if(isset($_POST['id_grado'])){
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
			     $this->Mantenimiento_m->insertar("grado",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("grado",$data,$id_grado,"id_grado");
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
			$data=$this->Mantenimiento_m->lista_uno("grado",$_POST['id'],"id_grado");

			$this->load->view('Grado/nuevo',compact("data"));
		}

		else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_grado=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("grado",$id_grado,"id_grado");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>