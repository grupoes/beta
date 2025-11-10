<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class formulario extends Controler {
 public function __construct() {
        parent::__construct();
       $this->load->model("Mantenimiento_m");
      
    }
public function index()
{
  $this->load->view("Formulario/index");
}

public  function guardar()
 {

   $arrayName = array('cli_ing_nombre' =>  $_POST["nombre"],
   	'cli_ing_apellido' =>  $_POST["apellido"],
   	'cli_ing_correo' => $_POST["correo"],
   	'cli_ing_telefono' => $_POST["celular"],
   	'cli_ing_ciudad' =>  $_POST["ciudad"],
   	'cli_ing_ciclo' =>  $_POST["ciclo"],
   	'cli_ing_fecha' => date("Y-m-d"),
   	'cli_ing_hora' =>  date("H:i:s"),
    'cli_ing_carrera'=>$_POST["carrera"]
);
   $this->Mantenimiento_m->insertar("cliente_ingreso",$arrayName);

   $sql=$this->Mantenimiento_m->consulta("SELECT * from usuario where (usu_perfil=1 or usu_perfil=5) and usu_estado=1 ");
      foreach ($sql as $key => $value) {
       $data=array
       (
       	"descripcion"=>"Se a registrado un posible cliente",
       	"imagen"=>"Nuevo_cliente",
       	 "fecha"=>date("Y-m-d H:i:s"),
       	 "url"=>"Nuevo_cliente",
       	 "id_usuario"=>$value->persona,
       	 "nombre"=>$_POST["nombre"]." ". $_POST["apellido"],
       	 "id"=>""
       );

       $this->Mantenimiento_m->insertar("notificacion",$data);
   }

 }



}