<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT');
class Android extends Controler {
 public function __construct() {
        parent::__construct();
       $this->load->model("Mantenimiento_m");
      
    }
public function index()
{
  $this->load->view("Android/index");
}

public function sesion()
{
  
     $postdata = file_get_contents("php://input");
       
            $request = json_decode($postdata);
            echo $request->usuario;

}

   public function registrar_token()
   {

     $postdata = file_get_contents("php://input");
       if (isset($postdata)) {
            $request = json_decode($postdata);
      $data=$this->Mantenimiento_m->consulta2("select * from token where token='".$request->token."'");

     
     
    if(count($data)==0)
        {

            $data2=array(
             "token"=> $request->token,
             "id_usuario"=>""
           );
            $this->Mantenimiento_m->insertar("token",$data2);
       
         }
       }
       echo json_encode("datos");
   }

public function enviar()
{
  define( 'API_ACCESS_KEY', 'AAAAQ5blEbs:APA91bH34O_Ch66z1Dq5lrKBgEO8lSWf7KPY3cRK_okO6Irb2QfQJyXLC9PzlP-dfmFUtEutqn3GlIc30VD1WoNgNwfJgFCuoCHLSt2AO9lklVn4_Kx4s9GViJYRjozrPRip-OPyWTYS' );
  $datos=array();
  $ver=$this->Mantenimiento_m->consulta("select * from token");
  foreach ($ver as $key => $value) {
    $datos[$key]=$value->token;
  }
   

 
  $fcmMsg = array(
  'body' => $_POST["descripcion"],
  'title' =>$_POST["titulo"],
 'sound' => "default",
        'color' => "#203E78" 
);

$fcmFields = array(
  'registration_ids' => $datos,
  //'to'=>$singleID,
        'priority' => 'high',
  'notification' => $fcmMsg
);
$headers = array(
  'Authorization: key=' . API_ACCESS_KEY,
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



     public function todos_empresas()

    {
         $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
        $request = json_decode($postdata);
              $username = $request->nombre;
              $num=$request->numero;
             
              
       if($username==""){
        $sql="select * from empresa where emp_estado=1  ";

       }
        else{
            $sql="select * from empresa where emp_estado=1 and emp_razon_social LIKE '".$username."%'" ;

        }

            $data=$this->Mantenimiento_m->consulta3($sql);

        echo  json_encode($data);
       }

    }
     
      public function categoria_empresa()

    {
         $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
        $request = json_decode($postdata);
              $id_categoria = $request->id;
              $palabra=$request->palabra;
             
              
       if($palabra==""){
        $sql="select * from empresa where emp_estado=1 and id_categoria=".$id_categoria;

       }
        else{
            $sql="select * from empresa where emp_estado=1 and id_categoria=".$id_categoria." and emp_razon_social LIKE '".$palabra."%'" ;

        }

            $data=$this->Mantenimiento_m->consulta3($sql);

        echo  json_encode($data);
       }

    }

    public function una_empresa($id)
    {
        $sql="select * from empresa where emp_estado=1 and id_empresa=".$id;
    	    $data=$this->Mantenimiento_m->consulta3($sql);
    	echo  json_encode($data);
    }
        public function todas_categorias()
    {
    	$sql="select * from categoria where cat_estado=1";
    	    $data=$this->Mantenimiento_m->consulta3($sql);
    	echo  json_encode($data);
    }


    public function fotos($id)
    {
        $sql="select * from foto where fot_estado=1 and id_empresa=".$id;
            $data=$this->Mantenimiento_m->consulta3($sql);
        echo  json_encode($data);
    }
      
}   