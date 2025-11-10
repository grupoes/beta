<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Tipo_norma extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("tipo_norma");
			$this->load->view("Tipo_norma/index",compact('lista'));

		//}
		//else{
		//	$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Tipo_norma/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_tipo_norma="";
			if(isset($_POST['id_tipo_norma'])){
               $id_tipo_norma=$_POST['id_tipo_norma'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);

			//print_r($data);
			if($id_tipo_norma==""){
			     $this->Mantenimiento_m->insertar("tipo_norma",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("tipo_norma",$data,$id_tipo_norma,"id_tipo_norma");
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
			$data=$this->Mantenimiento_m->lista_uno("tipo_norma",$_POST['id'],"id_tipo_norma");

			$this->load->view('Tipo_norma/nuevo',compact("data"));
		}

		else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_tipo_norma=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("tipo_norma",$id_tipo_norma,"id_tipo_norma");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>