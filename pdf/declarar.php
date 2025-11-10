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
 $ruc=$_GET["ruc"];

$ruc1="&nbsp;".$ruc[0];
$ruc2="&nbsp;".$ruc[1];
$ruc3="&nbsp;".$ruc[2];
$ruc4="&nbsp;".$ruc[3];
$ruc5="&nbsp;".$ruc[4];
$ruc6="&nbsp;".$ruc[5];
$ruc7="&nbsp;".$ruc[6];
$ruc8="&nbsp;".$ruc[7];
$ruc9="&nbsp;".$ruc[8];
$ruc10="&nbsp;".$ruc[9];
$ruc11="&nbsp;".$ruc[10]; 



$fecha = explode("-", $_GET["inicio"]);

 $sql="SELECT *
FROM 
fecha_declaracion
INNER JOIN mes ON fecha_declaracion.id_mes = mes.id_mes
INNER JOIN anio ON fecha_declaracion.id_anio = anio.id_anio
INNER JOIN numero ON fecha_declaracion.id_numero = numero.id_numero
where anio.anio_descripcion=".$fecha[0]." and mes.id_mes=".$fecha[1]." and numero.num_descripcion='".$ruc[10]."' and
fecha_declaracion.id_tributo=".$_GET['id_tributo'];
$datos=$conn->query($sql);
$id_fecha_declaracion=0;

foreach ($datos as $key => $value) {
    $fecha_exacta=$value["fecha_exacta"];

   $ver=date("d/m/Y", strtotime($fecha_exacta));


   $id_fecha_declaracion=$value["id_fecha_declaracion"];
}



$datos=$conn->query("SELECT *
FROM
fecha_declaracion
INNER JOIN anio ON fecha_declaracion.id_anio = anio.id_anio
INNER JOIN mes ON fecha_declaracion.id_mes = mes.id_mes
INNER JOIN numero ON fecha_declaracion.id_numero = numero.id_numero
INNER JOIN tributo ON fecha_declaracion.id_tributo = tributo.id_tributo where id_fecha_declaracion=".$id_fecha_declaracion);
//print_r($datos);


foreach ($datos as $key => $value) {
$mes=(string)$value["mes_fecha"];
$anio=(string)$value["anio_descripcion"];
$codigo=(string)$value["tri_codigo"];
}

$sql=$conn->query("SELECT * from ruc_empresa where ruc_empresa_numero='".$_GET["ruc"]."'");
foreach ($sql as $key => $value) {
    $nombre_ruc=$value["ruc_empresa_razon_social"];
  }


$sql=$conn->query("SELECT * from tributo where id_tributo=".$_GET["id_tributo"]);
foreach ($sql as $key => $value) {
    $nombre_tributo=$value["tri_descripcion"];
  }



$monto=0;
$monto1=0;
$ven=$conn->query("SELECT SUM(comprobante_venta) as suma from comprobante where MONTH(comprobante_fecha)=".$fecha[1]." and year(comprobante_fecha)=".$fecha[0]."
and ruc_empresa_numero='".$ruc."'");
foreach ($ven as $key => $value) {
  if($value["suma"]){
  $monto1=$value["suma"];
  }
  else{
    $monto1=0;

  }
}

$monto=round((int)$monto1*(float)$_GET["porcentaje"]/100);










$mes1=$mes[0];
$mes2=$mes[1];

$anio1=$anio[0];
$anio2=$anio[1];
$anio3=$anio[2];
$anio4=$anio[3];

$codigo1=$codigo[0];
$codigo2=$codigo[1];
$codigo3=$codigo[2];
$codigo4=$codigo[3];


$con=0;

$datos1="SELECT * from declaracion_sunat where ruc_empresa_numero='".$ruc."' and id_fecha_declaracion=".$id_fecha_declaracion;

$dat=$conn->query($datos1);
foreach ($dat as $key => $value) {
 $con=1;
}



if($con==0){
 $sql="INSERT INTO declaracion_sunat (decl_sunat_codigo, decl_sunat_importe_venta, decl_sunat_importe_compra,id_fecha_declaracion,ruc_empresa_numero,fecha_registro,fecha_ingreso,monto,decl_porcentaje)

VALUES ('',".$monto1.",'',".$id_fecha_declaracion.",'".$ruc."','".date("Y-m-d")."','".date("Y-m-d H:i:s")."',".$monto.",".$_GET["porcentaje"].")";
$conn->query($sql);
}




$id="x";

$html.="<html>

  <br>
   <div id='data' style=''> x </div>
  <div id='data5'><b>".$nombre_ruc."</b> vence(".$ver.")".$nombre_tributo."</div>
  <br> <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b id='data1'>".$ruc1."</b><b id='data1'>".$ruc2."</b><b id='data1'>".$ruc3."</b><b id='data1'>".$ruc4."</b><b id='data1'>".$ruc5."</b><b id='data1'>".$ruc6."</b>&nbsp;<b id='data1'>".$ruc7."</b><b id='data1'>".$ruc8."</b><b id='data1'>".$ruc9."</b><b id='data1'>".$ruc10."</b>&nbsp;<b id='data1'>".$ruc11."</b>
    <div id='data2'>".$mes1." &nbsp;&nbsp;".$mes2." &nbsp;&nbsp;".$anio1."&nbsp;&nbsp;&nbsp;".$anio2."&nbsp;&nbsp;&nbsp;".$anio3."&nbsp;&nbsp;&nbsp;&nbsp;".$anio4."</div>
    <div id='data3'>".$codigo1."&nbsp;".$codigo2."&nbsp;".$codigo3."&nbsp;&nbsp;&nbsp;".$codigo4."</div>
    <div id='data4'>".$monto."</div>
   </html>
   ";


include("mpdf/mpdf.php");

$mpdf=new mPDF("en-GB-x","A4","","",0,0,0,0,6,3);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

$css=file_get_contents("estilos2.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("FichaEnfoque.pdf", 'I');
