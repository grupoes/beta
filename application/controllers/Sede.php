<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Sede extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("sede");
			$this->load->view("Sede/index",compact('lista'));

		}
		else{
			$this->load->view("Error/404");
		}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
						$departamento=$this->Mantenimiento_m->lista("departamento");
			$this->load->view('Sede/nuevo',compact("departamento"));
		}else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_sede="";
			if(isset($_POST['id_sede'])){
               $id_sede=$_POST['id_sede'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$_POST["observacion"],
	           	 "direccion"=>$_POST['direccion'],
	           	 "horario_m_i"=>$_POST['horario_m_i'].":00",
	           	 "horario_m"=>$_POST['horario_m'].":00",
	           	 "horario_t_i"=>$_POST['horario_t_i'].":00",
	           	 "horario_t"=>$_POST['horario_t'].":00",
	           	 'telefono' => $_POST["telefono"],
	           	 'idDepartemento' => $_POST["distrito"]
	        	);

	
			if($id_sede==""){
			     $this->Mantenimiento_m->insertar("sede",$data);
			     echo "1";
		        }
	        	else
	        	{
	        	$this->Mantenimiento_m->actualizar("sede",$data,$id_sede,"id_sede");
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
			
			$data=$this->Mantenimiento_m->consulta2("select TIME_FORMAT(horario_m_i, '%H:%i') as horario_m_i,TIME_FORMAT(horario_m, '%H:%i') as horario_m,TIME_FORMAT(horario_t_i, '%H:%i') as horario_t_i,TIME_FORMAT(horario_t, '%H:%i') as horario_t,id_sede,descripcion,
				direccion,observacion,telefono from sede where estado=1 and id_sede=".$_POST['id']);
                $departamento=$this->Mantenimiento_m->lista("departamento");
			$this->load->view('Sede/nuevo',compact("data","departamento"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_Sede=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("sede",$id_Sede,"id_sede");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>