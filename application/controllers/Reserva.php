<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class reserva extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("sede");
			$this->load->view("Reserva/index",compact('lista'));

		//}
		//else{
		//	$this->load->view("Error/404");
		//}
	}


  public function asesor()
  {

  echo  $sql="SELECT * from horario_trabajador where horario_trabajador.empiezo_tiempo='".date("Y-m-d H:i:00")."'";

$dat=$this->Mantenimiento_m->consulta3($sql);
foreach ($dat as $key => $value) {
  $data=$value["id_trabajador"];
  $sql1="select * from usuario where persona=".$data;
  $id_usuario="";
  $datos=$this->Mantenimiento_m->consulta3($sql1);
  foreach ($datos as $key => $value1) {
     echo $id_usuario=$value1["usu_id"];
      }
      $sql1="SELECT *  from logproduccion,produccion,ficha_enfoque,cliente,persona
where logproduccion.idproduccion=produccion.id_producion and 
ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque AND
cliente.dni=ficha_enfoque.id_cliente and logproduccion.idhorario=".$value["id_horario"]." and 
cliente.dni=persona.dni";
   $nombre=$this->Mantenimiento_m->consulta3($sql1);
  $this->enviar($id_usuario,$nombre[0]["nombres"]." ".$nombre[0]["apellidos"],$value["titulo"]." ".$value["descripcion"]);
   }
  }



	public function verificar()
 	{

  
      $diaActual=date("Y-m-d H:i:00");
    $diaA = new DateTime($diaActual);
    $diaE = new DateTime($_POST["fecha"]);
      if($diaE<$diaA)
      {
        echo "falso"; exit();
      }
      else
      {
             $tiempo = explode("T",$_POST["fecha"]);
              if($tiempo[1]=="13:00:00" || (string)$tiempo[1]=="14:00:00")
            {
              echo "almuerzo";exit();
            }

      }
      

      $c=0; 
      $fecha = date($_POST["fecha"]); 
      $i=0;
		do{
			$i=$i+1;
            $nuevafecha = strtotime('+1 hour',strtotime($fecha));
            $nuevafecha1 = date ( 'Y-m-d H:00:00' , $nuevafecha );
            $tiempo = explode(" ", $nuevafecha1);
          
            if((string)$tiempo[1]=="13:00:00" || (string)$tiempo[1]=="19:00:00" || $this->verificar_fecha($nuevafecha1,$_POST["id_sede"])){
             $c=1;
            }
            $fecha=$nuevafecha1;

          
		}while($c==0);
		for ($j=1; $j <=$i ; $j++) { 
		echo "<option value='".$j."'>".$j."</option>";
		}
	}
 





    public function reservar_skype()
    {
    	       $para= $_POST["correo"];
             $fecha_inicio=$_POST["inicio"]." ".$_POST["hora"];
             $fecha = date($fecha_inicio);
             $nuevafecha = strtotime($_POST["duracion"].' hour',strtotime($fecha));
             $fecha_fin = date ( 'Y-m-d H:00:00' , $nuevafecha );
             $hora=$_POST["duracion"].":00:00";
             $nombre=$_POST["nombre"];
             $apellido=$_POST["apellido"];



            
             $skype=$_POST["skype"];


 $sql="select * from usuario where usu_perfil=4 and usu_estado=1 and usu_sede=".$_POST["id_sede"];
      $dat1=$this->Mantenimiento_m->consulta2($sql);


$dat=array(
   "empiezo_tiempo"=>$fecha_inicio,
   "fin_tiempo"=>$fecha_fin,
   "id_trabajador"=>$dat1->persona,
   "titulo"=>"Cita skype ".$_POST["nombre"]." ".$_POST["apellido"],
   "color"=>"#00ACC1",
   "descripcion"=>"Datos del cliente:telf.".$_POST["telefono"]." correo: ".$para,
   "tiempo"=>$hora,
   "idTiempo"=>1

);

$datos=$this->Mantenimiento_m->consulta2("select max(id_horario) as id_horario from horario_trabajador");




 $this->Mantenimiento_m->insertar("horario_trabajador",$dat);
$dat=array(
           "res_titulo"=>"Reservado para ".$nombre,
           "res_nombre"=>$nombre,
           "res_apellido"=>$apellido,
           "res_skype"=>$skype,
           "res_email"=>$para,
           "res_tiempo"=>$hora,
           "res_inicio"=>$fecha_inicio,
           "res_fin"=>$fecha_fin,
           "id_sede"=>$_POST["id_sede"],
           "res_telefono"=>$_POST["telefono"],
           "id_horario"=>$datos->id_horario

       );


 $this->Mantenimiento_m->insertar("reservar_horario",$dat);






$dat1=$this->Mantenimiento_m->consulta3("select max(id_reserva) as maximo from reservar_horario");

$id=$dat1[0]["maximo"];
if($_POST["id_sede"]==5)
{
$usuario="grupoesconsultores_tarapoto@outlook";
}
if($_POST["id_sede"]==6)
{
$usuario="ES Consultores Chiclayo";
}
if($_POST["id_sede"]==7)
{
 $usuario="esconsultoresayacucho@gmail.com";
}

$titulo    = 'CORREO DE CONFIRMACION DE LA RESERVA PARA UNA ASESORIA EN GRUPO ESCONSULTORES';
$mensaje   = '<img src="https://www.grupoesconsultores.com/public/assets/img/logo-color.png"  width="100px" height="60px" /> <br>
<b>DE:</b>GRUPOESCONSULTORES<BR><b>PARA:</b>'.$para.'<br> <b>Asunto: </b>Confirmacion de reunion por Skype<br><br>
estimado '.$_POST["nombre"].'<br> Este mensaje es para confirmar tu cita para este:<br>'.$fecha_inicio.' hasta '.$fecha_fin."<br><br>Asegurate de agregarme a tu Skype <br>Skype ID: ".$usuario."<br><br>Duracion: ".$_POST["duracion"]." horas <br>
Estos son tus datos: <br>Nombres: ".$nombre."<br> Apellidos: ".$apellido." <br>Email: ".$para."<br>Tu Skype: ".$skype."<br>
<br><a href='https://www.grupoesconsultores.com/consultoria/reserva/eliminar/".$id."'>Cancelar cita</a>  <a href='https://www.grupoesconsultores.com/consultoria/reserva/editar/".$id."'>Editar cita</a>";




$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales

$cabeceras .= 'From: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";
$cabeceras .= 'Cc: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";
$cabeceras .= 'Bcc: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";

mail($para, $titulo, $mensaje, $cabeceras);

$dat=$this->Mantenimiento_m->consulta3("SELECT * from usuario where usuario.usu_perfil=5 and usuario.usu_estado=1");

foreach ($dat as $key => $value) {
   $data=array(
     'descripcion' =>"Se creo una cita en skype ", 
      'fecha'=>date("Y-m-d H:i:s"),
      'nombre'=>$_POST["nombre"]." ".$_POST["apellido"],
      'url'=>"Skype",
      'id_usuario'=>$value["persona"],
      'id'=>1
      );
    $this->Mantenimiento_m->insertar("notificacion",$data);
    $this->enviar($value["usu_id"],$_POST["nombre"]." ".$_POST["apellido"],"Se creo una cita en skype");
}

$dat=$this->Mantenimiento_m->consulta3("SELECT * from usuario where (usuario.usu_perfil=1 or usuario.usu_perfil=4) and usuario.usu_estado=1 and usu_sede=".$_POST["id_sede"]);

foreach ($dat as $key => $value) {
   $data=array(
     'descripcion' =>"Se creo una cita en skype ", 
      'fecha'=>date("Y-m-d H:i:s"),
      'nombre'=>$_POST["nombre"]." ".$_POST["apellido"],
      'url'=>"Skype",
      'id_usuario'=>$value["persona"],
      'id'=>1
      );
    $this->Mantenimiento_m->insertar("notificacion",$data);
    $this->enviar($value["usu_id"],$_POST["nombre"]." ".$_POST["apellido"],"Se creo una cita en skype");
}
    	  

}


    public function horario()
    {
    	$sql="select * from reservar_horario where res_estado=1 and id_sede=".$_POST["id_sede"];

    	 $data=$this->Mantenimiento_m->consulta($sql);
     
          $datos1= [];

       foreach ($data as $key => $value) 
       {
            
             $datos1[$key]["title"]="Reservado";
              $datos1[$key]["start"]=$value->res_inicio;
              //$datos1[$key]["color"]=$value->color;
              $datos1[$key]["end"]=$value->res_fin;
              $datos1[$key]["id"]=$value->id_reserva;
              $datos1[$key]["overlap"]=false;
                $datos1[$key]["startEditable"]=false;
                  $datos1[$key]["durationEditable"]=false;
         }
          echo json_encode($datos1);


    }




  public function horario_cliente()
    {
      //$sql="select * from reservar_horario where res_estado=1 and id_sede=".$_POST["id_sede"];
      $sql="select * from usuario where usu_perfil=4 and usu_estado=1 and usu_sede=".$_POST["id_sede"];
      $dat=$this->Mantenimiento_m->consulta2($sql);
   $sql="select * from horario_trabajador where id_trabajador=".$dat->persona;

       $data=$this->Mantenimiento_m->consulta($sql);
     
          $datos1= [];

       foreach ($data as $key => $value) 
       {
            
             $datos1[$key]["title"]="Reservado";
              $datos1[$key]["start"]=$value->empiezo_tiempo;
              //$datos1[$key]["color"]=$value->color;
              $fecha=date($value->empiezo_tiempo);
               $nuevafecha = strtotime('+1 hour',strtotime($fecha));
            $nuevafecha1 = date ( 'Y-m-d H:i:00' , $nuevafecha );
              $datos1[$key]["end"]=$nuevafecha1;

              //$datos1[$key]["id"]=$value->id_reserva;
              $datos1[$key]["overlap"]=false;
                $datos1[$key]["startEditable"]=false;
                  $datos1[$key]["durationEditable"]=false;
         }
          echo json_encode($datos1);


    }















      public function eliminar($id)
      {
          $this->Mantenimiento_m->consulta1("update reservar_horario set res_estado=0 where id_reserva=".$id);
          echo "se borro correctamente";
          echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
      }
   public function verificar_fecha($fecha,$id_sede)
   {

      $dat=$this->Mantenimiento_m->consulta3("select * from reservar_horario where res_inicio='".$fecha."' and id_sede=".$id_sede." and res_estado=1");
      if(count($dat)==0)
      {
         return false;
      }
      else{
             return true;
      }

   }

   public function ver_sede()
   { 
    $lista=$this->Mantenimiento_m->lista("sede");
      echo "<option value='0'>Seleccionar</option>";
     foreach ($lista as $key => $value) {
                       echo "<option value='".$value->id_sede."'>".$value->descripcion."</option>";
                     }
   }
   
   public function traer_sede()
   {
      $dat=$this->Mantenimiento_m->consulta3("select * from sede where id_sede=".$_POST["sede"]);
      echo json_encode($dat);
   }

  public function enviar($id_usuario,$titulo,$descripcion)
{
  
  $datos=array();
  $ver=$this->Mantenimiento_m->consulta("select * from token_web where id_usuario=".$id_usuario);
  foreach ($ver as $key => $value) {
    $datos[$key]=$value->token_web;
  }
   

 
  $fcmMsg = array(
  'body' => $descripcion,
  'title' =>$titulo,
 'icon'=>'https://www.grupoesconsultores.com/icon.png',
   "click_action"=> "https://www.grupoesconsultores.com/consultoria/"
);

$fcmFields = array(
  'registration_ids' => $datos,
  //'to'=>$singleID,
        'priority' => 'high',
  'notification' => $fcmMsg
);
$headers = array(
  'Authorization: key=AAAAQ5blEbs:APA91bH34O_Ch66z1Dq5lrKBgEO8lSWf7KPY3cRK_okO6Irb2QfQJyXLC9PzlP-dfmFUtEutqn3GlIc30VD1WoNgNwfJgFCuoCHLSt2AO9lklVn4_Kx4s9GViJYRjozrPRip-OPyWTYS',
  'Content-Type: application/json'
);
 
 echo json_encode($fcmFields);
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result . "\n\n";



}

public function editar($id)
{
	$datos=$this->Mantenimiento_m->consulta2("select * from reservar_horario where id_reserva=".$id);
	$this->load->view("Reserva/editar",compact('datos'));
}
public function editar_horario()
{

    $para= $_POST["correo"];
             $fecha_inicio=$_POST["inicio"]." ".$_POST["hora"];
             $fecha = date($fecha_inicio);
             $nuevafecha = strtotime($_POST["duracion"].' hour',strtotime($fecha));
             $fecha_fin = date ( 'Y-m-d H:00:00' , $nuevafecha );
             $hora=$_POST["duracion"].":00:00";
             $nombre=$_POST["nombre"];
             $apellido=$_POST["apellido"];
             $skype=$_POST["skype"];

             $data=array('res_inicio' =>$fecha_inicio , 'res_fin'=>$fecha_fin,'res_tiempo'=>$hora);
             $this->db->where('id_reserva',$_POST["id_reserva"]);
	            	$estado=$this->db->update('reservar_horario', $data);

	           $data=array('empiezo_tiempo' =>$fecha_inicio , 'fin_tiempo'=>$fecha_fin,'tiempo'=>$hora);
             $this->db->where('id_horario',$_POST["id_horario"]);
	            	$estado=$this->db->update('horario_trabajador', $data);

	        $id=$dat1[0]["maximo"];
if($_POST["id_sede"]==5)
{
$usuario="grupoesconsultores_tarapoto@outlook";
}
if($_POST["id_sede"]==6)
{
$usuario="ES Consultores Chiclayo";
}
if($_POST["id_sede"]==7)
{
 $usuario="esconsultoresayacucho@gmail.com";
}

$titulo    = 'SE EDITO CORRECTAMENTE LA RESERVA PARA UNA ASESORIA EN GRUPO ESCONSULTORES';
$mensaje   = '<img src="https://www.grupoesconsultores.com/public/assets/img/logo-color.png"  width="100px" height="60px" /> <br>
<b>DE:</b>GRUPOESCONSULTORES<BR><b>PARA:</b>'.$para.'<br> <b>Asunto: </b>Confirmacion de reunion por Skype<br><br>
estimado '.$_POST["nombre"].'<br> Este mensaje es para confirmar tu cita para este:<br>'.$fecha_inicio.' hasta '.$fecha_fin."<br><br>Asegurate de agregarme a tu Skype <br>Skype ID: ".$usuario."<br><br>Duracion: ".$_POST["duracion"]." horas <br>
Estos son tus datos: <br>Nombres: ".$nombre."<br> Apellidos: ".$apellido." <br>Email: ".$para."<br>Tu Skype: ".$skype."<br>
<br><a href='https://www.grupoesconsultores.com/consultoria/reserva/eliminar/".$_POST["id_reserva"]."'>Cancelar cita</a>  <a href='https://www.grupoesconsultores.com/consultoria/reserva/editar/".$_POST["id_reserva"]."'>Editar cita</a>";




$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales

$cabeceras .= 'From: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";
$cabeceras .= 'Cc: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";
$cabeceras .= 'Bcc: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";

mail($para, $titulo, $mensaje, $cabeceras);
foreach ($dat as $key => $value) {
   $data=array(
     'descripcion' =>"Actualizo la cita en skype ", 
      'fecha'=>date("Y-m-d H:i:s"),
      'nombre'=>$_POST["nombre"]." ".$_POST["apellido"],
      'url'=>"Skype",
      'id_usuario'=>$value["persona"],
      'id'=>1
      );
    $this->Mantenimiento_m->insertar("notificacion",$data);
    $this->enviar($value["usu_id"],$_POST["nombre"]." ".$_POST["apellido"],"Se creo una cita en skype");
}

$dat=$this->Mantenimiento_m->consulta3("SELECT * from usuario where (usuario.usu_perfil=1 or usuario.usu_perfil=4) and usuario.usu_estado=1 and usu_sede=".$_POST["id_sede"]);

foreach ($dat as $key => $value) {
   $data=array(
     'descripcion' =>"Actualizo la cita en skype ", 
      'fecha'=>date("Y-m-d H:i:s"),
      'nombre'=>$_POST["nombre"]." ".$_POST["apellido"],
      'url'=>"Skype",
      'id_usuario'=>$value["persona"],
      'id'=>1
      );
    $this->Mantenimiento_m->insertar("notificacion",$data);
    $this->enviar($value["usu_id"],$_POST["nombre"]." ".$_POST["apellido"],"Se creo una cita en skype");
}




}



}