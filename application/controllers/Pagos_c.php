<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Pagos_c extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request())
    {

			$tipocliente=$this->Mantenimiento_m->lista("tipocliente");

			$this->load->view("Pagos_c/index",compact('tipocliente'));

		}
		else{
			$this->load->view("Error/404");
		}
	}
	public function data()
	{
       $option=$_POST["data"];
       if($option=="carrera")
       {
         $data=$this->Mantenimiento_m->consulta("SELECT DISTINCT(carrera) from cliente ");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->carrera."'>".$value->carrera."</option>";
         }
     
        $datos=array("data"=>$html,"titulo"=>"Carreras");
       echo json_encode($datos);
       }


       if($option=="universidad")
       {
         $data=$this->Mantenimiento_m->lista("universidad");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->id_universidad."'>".$value->descripcion."</option>";
         }

        $datos=array("data"=>$html,"titulo"=>"Universidad");
       echo json_encode($datos);
       }
        if($option=="tiponivel")
       {
         $data=$this->Mantenimiento_m->lista("categoria");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->id_categoria."'>".$value->descripcion."</option>";
         }
      
        $datos=array("data"=>$html,"titulo"=>"Tipo de cetegorias");
       echo json_encode($datos);
       }
         if($option=="grado")
       {
         $data=$this->Mantenimiento_m->lista("grado");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->id_grado."'>".$value->descripcion."</option>";
         }
    
        $datos=array("data"=>$html,"titulo"=>"Grado Academico");
       echo json_encode($datos);
       }
      if($option=="medio")
       {
         $data=$this->Mantenimiento_m->lista("captacion");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->id_captacion."'>".$value->descripcion."</option>";
         }
         
        $datos=array("data"=>$html,"titulo"=>"Captacion de clientes");
       echo json_encode($datos);
       }
           if($option=="trabajador")
       {
         $data=$this->Mantenimiento_m->consulta("SELECT persona.dni,persona.nombres,persona.apellidos from usuario,persona,trabajador where usuario.persona=persona.dni and 
persona.dni=trabajador.dni and usuario.usu_perfil=2 or usuario.usu_perfil=4 and usu_estado=1 ");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->dni."'>".$value->nombres." ".$value->apellidos."</option>";
         }

        $datos=array("data"=>$html,"titulo"=>"Trabajadores");
       echo json_encode($datos);
       }

        if($option=="sede")
       {
         $data=$this->Mantenimiento_m->lista("sede");
         $html="";
         $html.="<option value='0'>todos</option >";

         foreach ($data as $key => $value) {
         	$html.="<option value='".$value->id_sede."'>".$value->descripcion."</option>";
         }
         
        $datos=array("data"=>$html,"titulo"=>"Sede");
       echo json_encode($datos);
       }

	}
 
public function generar()
  {$tipocliente1="";
    if(isset($_POST["tipocliente"])){$tipocliente1=$_POST["tipocliente"];}
     $data="";
     $info="";
       if(isset($_POST["data"])){$data=$_POST["data"];}
       if(isset($_POST["info"])){$info=$_POST["info"];}
    
       if(isset($_POST["tiempo"])){$tiempo=$_POST["tiempo"];}
         $fechainicio=$_POST["fechainicio"];
     $fechafin=$_POST["fechafin"];
//echo $data;
    
  //   	echo "hola";
echo $sql="SELECT
ficha_enfoque.titulo_enfoque,
cronograma.cuo_fechacancelado as fecha_registro,
persona.nombres,
persona.apellidos,
ficha_enfoque.id_usuario,
cronograma.cuo_montopagado as pagado

FROM
ficha_enfoque
INNER JOIN produccion ON ficha_enfoque.id_ficha_enfoque = produccion.id_ficha_enfoque
INNER JOIN cliente ON ficha_enfoque.id_cliente = cliente.dni
INNER JOIN persona ON cliente.dni = persona.dni
INNER JOIN usuario ON ficha_enfoque.id_usuario = usuario.usu_id
INNER JOIN pago ON ficha_enfoque.id_ficha_enfoque = pago.id_ficha_enfoque
INNER JOIN cronograma ON pago.id_pago = cronograma.id_pago where cronograma.cuo_montopagado>0  and cronograma.cuo_fechacancelado BETWEEN '".$fechainicio."' and '".$fechafin."'".
$this->tipocliente($tipocliente1)." ".$this->categoria($data,$info)."
 ";


     	$data1=$this->Mantenimiento_m->consulta($sql);

     	$html="";
       $c=0;
$da=0;
$total=0;

        foreach ($data1 as $key => $value) {
            $c=$c+1;
            $da=1;
            $total=$total+$value->pagado;
         	$html.="<tr>";
         	  $html.="<td>".$c."</td><td>".$value->nombres." ".$value->apellidos."</td><td>".$value->titulo_enfoque."</td><td>".$value->pagado."</td><td>".$value->fecha_registro."</td>";
         		$html.="</tr>";
         }
         if($da==0){
          $html.= "<tr><td colspan='7'><center><h2>no hay resultados</h2></center></td></tr>";        
         }
             echo $html;

  echo "<tr><td colspan='3'><td><h2>Total: </h2></td></td><td><h3>".$total."</h3></td></tr>";
   
 


 


  }

	function tipocliente($id){
      if($id=="0"){
        return "";
      }
      else{
      return " and cliente.id_tipocliente= '".$id."'";
      }
	}

	function categoria($tipo,$id)
	{
       if($tipo=="0"){
        return "";
       }
       else
       {
       	  if($id!="0")
       	  {
               if($tipo=="carrera"){
                  return "and cliente.carrera='".$id."'";
               }
                if($tipo=="universidad"){
                  return "and cliente.id_universidad=".$id;
               }
                if($tipo=="tiponivel"){
                     return "and ficha_enfoque.id_categoria=".$id;
               }
                if($tipo=="grado"){
                  return "and ficha_enfoque.id_grado=".$id;
               }
                if($tipo=="medio"){
                        return "and ficha_enfoque.id_captacion=".$id;
               }
                if($tipo=="trabajador"){
                               return "and ficha_enfoque.id_trabajador=".$id;

               }
                  if($tipo=="sede"){
                               return "and usuario.usu_sede=".$id;

               }

       	  }
       	  else{
       	  	return "";
       	  }
       }
	}
}

?>