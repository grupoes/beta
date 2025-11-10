<?php 

try{
  $usuario="GrupoES";
  $password="GrupoES123";
  
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}
date_default_timezone_set('America/Lima');

define( 'API_ACCESS_KEY', 'AAAAQ5blEbs:APA91bH34O_Ch66z1Dq5lrKBgEO8lSWf7KPY3cRK_okO6Irb2QfQJyXLC9PzlP-dfmFUtEutqn3GlIc30VD1WoNgNwfJgFCuoCHLSt2AO9lklVn4_Kx4s9GViJYRjozrPRip-OPyWTYS' );


$sql=$conn->query("select *  from ruc_empresa where ruc_empresa_estado=1");

foreach ($sql as $key => $rucs)
{
   $ruc=$rucs["ruc_empresa_numero"];
   $ruc_numero_ultimo=substr($ruc, 10, 10);
   $anio_ruc=date("Y");
   $mes=date("m");
   $query=$conn->query("SELECT * from fecha_declaracion,tributo,configuracion_notificacion,numero
where month(fecha_exacta)=".$mes." and year(fecha_exacta)=".$anio_ruc." and numero.id_numero=fecha_declaracion.id_numero and
 fecha_declaracion.id_tributo=tributo.id_tributo and numero.num_descripcion='".$ruc_numero_ultimo."'
and configuracion_notificacion.id_tributo=tributo.id_tributo AND  configuracion_notificacion.ruc_empresa_numero='".$ruc."'");
  
   foreach ($query as $key => $value) 
   {
        $ex=0;
        $verificar=$conn->query("select * from declaracion_sunat where id_fecha_declaracion=".$value["id_fecha_declaracion"]." and ruc_empresa_numero='".$ruc."'");
        
       foreach ($verificar as $key => $datttt)
        {
         $ex=1;
       }

      if($ex==0){
            $fecha_actual=strtotime(date("Y-m-d"));
            $fecha_nueva=strtotime($value["fecha_notificar"]);
                if($fecha_actual>=$fecha_nueva){
                $data1="Falta declarar el tributo ".$value["tri_descripcion"]." Vence ".$value["fecha_exacta"];
             enviar_mensaje($rucs["ruc_empresa_razon_social"],$data1,API_ACCESS_KEY);
           }

      }

        

   }
  

}




function enviar_mensaje($titulo,$descripcion,$API_ACCESS_KEY)
{

try{
  $usuario="GrupoES";
  $password="GrupoES123";
  
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}


  $datos=array();


  $sql="select * from token";

   $resultado = $conn->query($sql); 

  foreach ($resultado as $key => $value) 
  {
    $datos[$key]=$value["token"];
   
  }
   


  //$singleID = 'fPo6t6jlQVU:APA91bGNk_XiiD-fDvs_XEOzXwI4JEr7DrhCHkGQLF-7bqaHvuHTwc73ptfwhB87XOOMWrjWRWSI9qh46y9yAQhSyAsYg67vGDNPALioW1TsXQnLQD_3SWxMoiTOlKOh7YmSX0Uxr1Xp' ;
  $fcmMsg = array(
  'body' => $descripcion,
  'title' =>$titulo,
  'sound' => "default",
        'color' => "#203E78" ,
    'icon'=>'http://www.grupoesconsultores.com/consultoria/public/assets/images/logo%20grupo.png'
);

$fcmFields = array(
  'registration_ids' => $datos,
        'priority' => 'high',
  'notification' => $fcmMsg
);
$headers = array(
  'Authorization: key='.$API_ACCESS_KEY,
  'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result ;

}




