<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Moroso extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }
	public function index(){
		if ($this->input->is_ajax_request()){
			//$lista = $this->db->query("select * from modulo where mod_estado=1")->result();

			$tipocliente=$this->Mantenimiento_m->lista("tipocliente");
			$this->load->view('Moroso/index',compact("tipocliente"));
		}else{
			$this->load->view('Error/404');
		}
	}
public function info()
{
$tipocliente1="";
    if(isset($_POST["tipocliente"])){$tipocliente1=$_POST["tipocliente"];}
     $data="";
     $info="";
       if(isset($_POST["data"])){$data=$_POST["data"];}
       if(isset($_POST["info"])){$info=$_POST["info"];}
    
       if(isset($_POST["tiempo"])){$tiempo=$_POST["tiempo"];}


     $fechainicio=$_POST["fechainicio"];
     $fechafin=$_POST["fechafin"];
    $sql='select cronograma.cuo_montocuota-cronograma.cuo_montopagado as deuda ,persona.nombres,persona.apellidos,ficha_enfoque.titulo_enfoque,cronograma.cuo_fechavence  FROM
pago,cronograma,ficha_enfoque,persona,usuario,cliente
WHERE cliente.dni=ficha_enfoque.id_cliente and usuario.usu_id=ficha_enfoque.id_usuario and pago.id_pago=cronograma.id_pago and
pago.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and
ficha_enfoque.id_cliente=persona.dni and cronograma.cuo_estado=1 
and cronograma.cuo_fechavence BETWEEN "'. $fechainicio.'" and "'.$fechafin.'" '.$this->tipocliente($tipocliente1)." ".$this->categoria($data,$info); 
//echo $sql;
$datos=$this->Mantenimiento_m->consulta($sql);
$c=1;
$total=0;
$da=0;
foreach ($datos as $key => $value) {
  $da=1;
  echo "<tr>";
  echo "<td>".$c."</td>";
    echo "<td>".$value->titulo_enfoque."</td>";
      echo "<td>".$value->nombres." ".$value->apellidos."</td>";
      
$total=$total+$value->deuda;
      
          echo "<td>".$value->cuo_fechavence."</td>";
            echo "<td>".$value->deuda."</td>";
  echo "</tr>";
  $c=$c+1;
}
   if($da==0){
         echo "<tr><td colspan='7'><center><h2>no hay resultados</h2></center></td></tr>";        
         }
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
	/*public function info(){
        $sql="select * from pago where estado=1";
        $dat=$this->Mantenimiento_m->consulta($sql);
 
        foreach ($dat as $key => $value) {
        	$sql1="select * from cronograma where id_pago=".$value->id_pago;
                   $c=0;
               
        	$dati=$this->Mantenimiento_m->consulta($sql1);
        	foreach ($dati as $key => $value1) {

        		if($value1->cuo_fechacancelado=="")
        		{ 
                $diaActual=date("Y-m-d 00:00:00");
                      $datetime1 = new DateTime($diaActual);
                $datetime = new DateTime($value1->cuo_fechavence." 00:00:00");
                if($datetime>$datetime1)
                      {
                      
                        $c=$c+1;
                }
        		}

        	}
            echo "<br>".$c;
   
            if($c>=1){
                echo $value->id_pago;

               } 
        }
         
	}*/

}