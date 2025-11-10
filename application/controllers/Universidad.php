<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Universidad extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("universidad");
			$this->load->view("Universidad/index",compact('lista'));

		//}
		//else{
		//	$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Universidad/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){

			$observacion="";
			$id_universidad="";
			if(isset($_POST['id_universidad'])){
               $id_universidad=$_POST['id_universidad'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"]
	        	);


			
			if($id_universidad==""){
			     $this->Mantenimiento_m->insertar("universidad",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("universidad",$data,$id_universidad,"id_universidad");
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
			
			$data=$this->Mantenimiento_m->lista_uno("universidad",$_POST['id'],"id_universidad");

			$this->load->view('Universidad/nuevo',compact("data"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_universidad=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("universidad",$id_universidad,"id_universidad");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>