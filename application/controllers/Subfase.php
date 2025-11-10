<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Subfase extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->consulta("select fases.titulo,tipo_enfoque.descripcion,subfase.id_subfase,subfase.observacion,subfase.descripcion as subfase from fases,tipo_enfoque,subfase where fases.id_tipo_enfoque=tipo_enfoque.id_tipo_enfoque and fases.id_fase=subfase.id_fase and
				 subfase.estado=1");
			$this->load->view("Subfase/index",compact('lista'));

		//}
		//else{
		//	$this->load->view("Error/404");
		//}
	}

	
	public function nuevo()
	{
		if ($this->input->is_ajax_request())
		{  
         $fase=$this->Mantenimiento_m->consulta("select tipo_enfoque.descripcion,fases.id_fase,fases.titulo from fases,tipo_enfoque where
         	  fases.id_tipo_enfoque=tipo_enfoque.id_tipo_enfoque and fases.estado=1");
          

        $categoria=$this->Mantenimiento_m->consulta("select * from categoria where estado=1");
		$this->load->view('Subfase/nuevo',compact("categoria","fase"));
		}
		else{
            	$this->load->view('Error/404');
        	}
	}

	function registrar(){
		//print_r($_POST['id_categoria']);
		if ($this->input->is_ajax_request()){
			$observacion="";
			$id_subfase="";
			
			if(isset($_POST['id_subfase'])){
               $id_subfase=$_POST['id_subfase'];
			}
			if (isset($_POST['observacion'])) {
				$observacion=$_POST['observacion'];
			}

			$data = array(
	           	'descripcion' => $_POST["descripcion"],
	           	 'observacion'=>$observacion,
	           	 'id_fase'=>$_POST['id_fase'],
	           	 'titulo'=>$_POST['titulo']
	           		        	);

			
                 
			if($id_subfase==""){
			    $this->Mantenimiento_m->insertar("subfase",$data);
			    $maximo=$this->Mantenimiento_m->maximo_subfase();
			   foreach ($_POST['id_categoria'] as $key => $value) {
			     	$datos=$_POST['id_categoria'][$key];
			     	 $dato=array("id_subfase"=>$maximo,
			     	 	"id_categoria"=>$datos);
			     	 $this->Mantenimiento_m->insertar("categoria_subfase",$dato);
			     	
			     }

			     echo "1";
		        }
	        	else
	        	{
	      	$this->Mantenimiento_m->actualizar("subfase",$data,$id_subfase,"id_subfase");
                $this->Mantenimiento_m->consulta1("delete from categoria_subfase where id_subfase=".$id_subfase);
	      	 foreach ($_POST['id_categoria'] as $key => $value) {
			     	$datos=$_POST['id_categoria'][$key];
			     	 $dato=array("id_subfase"=>$_POST['id_subfase'],
			     	 	"id_categoria"=>$datos);
			     	 $this->Mantenimiento_m->insertar("categoria_subfase",$dato);
			     	
			     }
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
			
			$data=$this->Mantenimiento_m->lista_uno("subfase",$_POST['id'],"id_subfase");
			
			$lista_categoria=$this->Mantenimiento_m->consulta("select id_categoria from categoria_subfase where id_subfase=".$_POST['id']);
                $categoria=$this->Mantenimiento_m->consulta("select * from categoria where estado=1");
                  $fase=$this->Mantenimiento_m->consulta("select tipo_enfoque.descripcion,fases.id_fase,fases.titulo from fases,tipo_enfoque where
         	  fases.id_tipo_enfoque=tipo_enfoque.id_tipo_enfoque and fases.estado=1");
          

        $categoria=$this->Mantenimiento_m->consulta("select * from categoria where estado=1");
			$this->load->view('Subfase/nuevo',compact("data","categoria","fase","lista_categoria"));
		}else{
            	$this->load->view('Error/404');
        	}
	}
	function eliminar()
	{
		 if ($this->input->is_ajax_request()){
               $id_fase=$_POST['id'];
               $data=$this->Mantenimiento_m->eliminar("subfase",$id_fase,"id_subfase");
               echo $data;
		 }
		 	else{
                $this->load->view('Error/404');
		 	}
	}
}

?>