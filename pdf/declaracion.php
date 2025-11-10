<?php 

try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}
$ruc=(string)$_GET["ruc"];
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


$sql=$conn->query("SELECT * from ruc_empresa where ruc_empresa_numero='".$_GET["ruc"]."'");
foreach ($sql as $key => $value) {
    $nombre_ruc=$value["ruc_empresa_razon_social"];
  }
$datos=$conn->query("SELECT *
FROM
fecha_declaracion
INNER JOIN anio ON fecha_declaracion.id_anio = anio.id_anio
INNER JOIN mes ON fecha_declaracion.id_mes = mes.id_mes
INNER JOIN numero ON fecha_declaracion.id_numero = numero.id_numero
INNER JOIN tributo ON fecha_declaracion.id_tributo = tributo.id_tributo where id_fecha_declaracion=".$_GET["id_fecha"]);

foreach ($datos as $key => $value) {
$mes=(string)$value["mes_fecha"];
$anio=(string)$value["anio_descripcion"];
$codigo=(string)$value["tri_codigo"];
$id_tributo=$value["id_tributo"];
   $fecha_exacta=$value["fecha_exacta"];

   $ver=date("d/m/Y", strtotime($fecha_exacta));
}

$datos=$conn->query("SELECT * 
FROM
declaracion_sunat
where id_fecha_declaracion=".$_GET["id_fecha"]." and ruc_empresa_numero=".$_GET["ruc"]);

foreach ($datos as $key => $value) {

$monto=(string)$value["monto"];
}

$sql=$conn->query("SELECT * from tributo where id_tributo=".$id_tributo);
foreach ($sql as $key => $value) {
    $nombre_tributo=$value["tri_descripcion"];
  }





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


$id="x";

$html.="<html>

  <br>
   <div id='data' style=''> x </div>
  <div id='data5'><b>".$nombre_ruc."</b> vence(".$ver.")".$nombre_tributo."</div>
  <br> <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b id='data1'>".$ruc1."</b><b id='data1'>".$ruc2."</b><b id='data1'>".$ruc3."</b><b id='data1'>".$ruc4."</b><b id='data1'>".$ruc5."</b><b id='data1'>".$ruc6."</b>&nbsp;<b id='data1'>".$ruc7."</b><b id='data1'>".$ruc8."</b><b id='data1'>".$ruc9."</b><b id='data1'>".$ruc10."</b>&nbsp;<b id='data1'>".$ruc11."</b>
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
