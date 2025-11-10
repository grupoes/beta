<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Enfoque extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("tipo_enfoque");
			$this->load->view("Enfoque/index",compact('lista'));

		//}
		//else{
		//	$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Enfoque/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_tipo_enfoque="";

			if(isset($_POST['id_tipo_enfoque'])){
               $id_tipo_enfoque=$_POST['id_tipo_enfoque'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);

			//print_r($data);
			if($id_tipo_enfoque==""){
			     $this->Mantenimiento_m->insertar("tipo_enfoque",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("tipo_enfoque",$data,$id_tipo_enfoque,"id_tipo_enfoque");
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
			$data=$this->Mantenimiento_m->lista_uno("tipo_enfoque",$_POST['id'],"id_tipo_enfoque");

			$this->load->view('Enfoque/nuevo',compact("data"));
		}

		else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_tipo_enfoque=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("tipo_enfoque",$id_tipo_enfoque,"id_tipo_enfoque");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>