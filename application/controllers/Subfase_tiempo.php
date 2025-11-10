<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Subfase_tiempo extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request()){
              $fase=$this->Mantenimiento_m->consulta("select tipo_enfoque.descripcion,fases.id_fase,fases.titulo from fases,tipo_enfoque where
         	  fases.id_tipo_enfoque=tipo_enfoque.id_tipo_enfoque and fases.estado=1");
          
		      $dificultad=$this->Mantenimiento_m->consulta("select * from dificultad ");
		      $hacer=$this->Mantenimiento_m->consulta("select * from tarea");
			$this->load->view("Subfase_t/index",compact("fase","dificultad","hacer"));

		}
		else{
			$this->load->view("Error/404");
		}
	}

	

	function registrar(){
		
		     $id_tiempo="";
		     if(isset($_POST['id_tiempo'])){
             $id_tiempo=$_POST['id_tiempo'];
		     }
           // echo $id_tiempo;
			$data = array(
	           	'id_tarea' => $_POST["id_tarea"],
	           	 'id_dificultad'=> $_POST["id_dificultad"],
	           	 'id_subfase'=>$_POST['id_subfase'],
	           	 "tiempo"=>$_POST['anytime-time'].":00"
	        	);
        
				if($id_tiempo==""){
   
			    $this->Mantenimiento_m->insertar("subfase_tiempo",$data);
			     echo "1";
		        }
	        	else
	        	{
	        		   print_r($data);
	      		$this->Mantenimiento_m->actualizar("subfase_tiempo",$data,$id_tiempo,"id_tiempo");
	        	 echo "2";
	        	}
	
	}


	public function subfases()
	{
			if ($this->input->is_ajax_request()){
               $subfases=$this->Mantenimiento_m->consulta("select * from subfase where estado=1 and id_fase=".$_POST['id']);
                 $html="";

							 foreach($subfases as $value1){

							 	$a="'radio'";
	    						$html.= '
                                <div class="radio">
	    						<label class="radio-inline">
									   <input type="radio" value="'.$value1->id_subfase.'" name="id_subfase" id="id_subfase" >'.$value1->descripcion.'</label></div>';
								       	}
            $html.='<script>$( "input:radio[name=id_subfase]" ).on( "click", function() {
            	var fase=$("#id_fase").val();
 var subfase=$("input:radio[name=id_subfase]:checked").val();
 var dificultad=$("#id_dificultad").val();
var hacer=$("#id_tarea").val();
var tiempo=$("#anytime-time").val();
//alert(subfase);
if(fase!="" && dificultad!="" && fase!="" && hacer!="" && tiempo!=""){
   $.post(base_url+"Subfase_tiempo/traer",{"id_dificultad":dificultad,"id_subfase":subfase,"id_tarea":hacer},function(data){
 
         
        $("#anytime-time").val(data.tiempo);
        $("#id_tiempo").val(data.idtiempo);
  }, "json");
}
else{
	alert("Error Falta Agregar");
	 $("#id_subfase ").each(function(){
      $(this).prop("checked", false); 
  });
}
});</script>';
            echo $html;                   
			}
			else{
       	$this->load->view('Error/404');
       	}

	}


	public function traer()
{  
     $sql="SELECT id_tiempo,TIME_FORMAT(tiempo, '%H:%i') as 'tiempo'  from subfase_tiempo where id_tarea=".$_POST['id_tarea']." and id_subfase=".$_POST['id_subfase']. " and id_dificultad=".$_POST["id_dificultad"];

	$data=$this->Mantenimiento_m->consulta2($sql);
   //echo count($data);exit();
	if(count($data)==0)
	{
        echo json_encode(array("idtiempo"=>"","tiempo"=>"0:00")); 
	}
	else{
        echo json_encode(array("idtiempo"=>$data->id_tiempo,"tiempo"=>$data->tiempo)); 
	}

}
}





	

