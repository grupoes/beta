<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Categoria extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("categoria");
			$this->load->view("Categoria/index",compact('lista'));

		//}
		//else{
			//$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Categoria/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_categoria="";
			if(isset($_POST['id_categoria'])){
               $id_categoria=$_POST['id_categoria'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);

			//print_r($data);
			if($id_categoria==""){
			     $this->Mantenimiento_m->insertar("categoria",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("categoria",$data,$id_categoria,"id_categoria");
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
			
			$data=$this->Mantenimiento_m->lista_uno("categoria",$_POST['id'],"id_categoria");

			$this->load->view('Categoria/nuevo',compact("data"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_categoria=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("categoria",$id_categoria,"id_categoria");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>