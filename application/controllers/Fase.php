<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Fase extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->consulta("select fases.id_fase,fases.descripcion,fases.titulo,fases.observacion,tipo_enfoque.descripcion as enfoque from tipo_enfoque,fases where tipo_enfoque.id_tipo_enfoque=fases.id_tipo_enfoque and fases.estado=1");
			$this->load->view("Fase/index",compact('lista'));

		//}
		//else{
			//$this->load->view("Error/404");
		//}
	}

	
	public function nuevo()
	{
		if ($this->input->is_ajax_request())
		{  
         $tipo_enfoque =$this->Mantenimiento_m->consulta("select * from tipo_enfoque");
		$this->load->view('Fase/nuevo',compact("tipo_enfoque"));
		}
		else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_fase="";
			
			if(isset($_POST['id_fase'])){
               $id_fase=$_POST['id_fase'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$observacion,
	           	 'titulo'=>$_POST['titulo'],
	           	 "id_tipo_enfoque"=>$_POST['id_tipo_enfoque']
	        	);

						if($id_fase==""){

			     $this->Mantenimiento_m->insertar("fases",$data);
			     echo "1";
		        }
	        	else
	        	{
	      	$this->Mantenimiento_m->actualizar("fases",$data,$id_fase,"id_fase");
	        	 echo "2";
	        	}
		}
	else{
       	$this->load->view('Error/404');
       	}
	}

	function actualizar()
	{   
		if ($this->input->is_ajax_request()){
			$data="";
			
			$data=$this->Mantenimiento_m->lista_uno("fases",$_POST['id'],"id_fase");
                $tipo_enfoque =$this->Mantenimiento_m->consulta("select * from tipo_enfoque");
			$this->load->view('Fase/nuevo',compact("data","tipo_enfoque"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_fase=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("fases",$id_fase,"id_fase");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>