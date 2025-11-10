<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Especialidad extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("especialidad");
			$this->load->view("Especialidad/index",compact('lista'));

		//}
		//else{
			//$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Especialidad/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
            
			$observacion="";
			$id_especialidad="";
			if(isset($_POST['id_especialidad'])){
               $id_especialidad=$_POST['id_especialidad'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);


			
			if($id_especialidad==""){
			     $this->Mantenimiento_m->insertar("especialidad",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("especialidad",$data,$id_especialidad,"id_especialidad");
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
			
			$data=$this->Mantenimiento_m->lista_uno("especialidad",$_POST['id'],"id_especialidad");

			$this->load->view('Especialidad/nuevo',compact("data"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_especialidad=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("especialidad",$id_especialidad,"id_especialidad");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>