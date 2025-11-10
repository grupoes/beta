<?php 

try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="prueba_consultoria";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}


$sql=$conn->query("select * from observaciones where idobservacion=".$_GET["id"]);
foreach ($sql as $key => $value) {
	$id_usuaurio=$value["idusuario"];
	$id_ficha_enfoque=$value["idficha"];
}

$sql=$conn->query("select * from ficha_enfoque where id_ficha_enfoque=".$id_ficha_enfoque);
foreach ($sql as $key => $value) {

	$titulo_ficha=$value["titulo_enfoque"];
}



$sql1=$conn->query("select persona.nombres, persona.apellidos
FROM 
usuario
INNER JOIN persona ON usuario.persona = persona.dni and usuario.usu_id=".$id_usuaurio);
foreach ($sql1 as $key => $value) {
	$nombre=$value["nombres"]." ".$value["apellidos"];
}

$html="";
  $dateTime = new DateTime($fecha);


$html.="<html>

<table width='100%'>
<tr>
  <td width='30%'>
  <img src='logo.png' width='120px' height='75px'/>
  </td>
  <td width='40%'>
    <h2><u>FICHA DE OBSERVACIONES</u></h2>
  </td>
  <td>
    <label style='font-size:3px'>Fecha de Entrega: </label><input style='font-size:7px;width:40px;height:8px; margin: 0px 0px 0px 0px;' type='text' value='".$dateTime->format('d-m-Y')."'/><br>
     <label style='font-size:3px'>Hora de Entrega: </label><input style='font-size:7px;width:40px;height:8px;margin:3px;'  type='text' value='".date('h:i:s A')."'/>
  </td>
 </tr>
 </table>
 <table width='100%'>
 <tr>
    <td><b><center>".utf8_encode($titulo_ficha)."</center></b></td>
 </tr>
  <tr>
  <td width='25%'>
   Realizado por:".$nombre."
   </td>
   </tr>
  </table>
 <table  width='100%'>
  <tr>
    <td width='15%'>
    Fase
    </td>
    <td width='35%'>
     Subfase
    </td>
    <td width='45%'>
     Descripcion
    </td>
    <td width='8%'>
     Tiempo
    </td>


  </tr>
  
</table><table  width='100%'>";
 $sql = "SELECT fases.titulo as ftitulo,fases.descripcion as fdescripcion, subfase.descripcion as sdescripcion , detalle_observaciones.descripcion as odescripcion,
detalle_observaciones.tiempo
FROM
fases
INNER JOIN subfase ON subfase.id_fase = fases.id_fase
INNER JOIN detalle_observaciones ON subfase.id_subfase = detalle_observaciones.idsubfase and
 detalle_observaciones.idobservaciones=".$_GET['id'];
$resultado12=$conn->query($sql); 
foreach ( $resultado12 as $rows) { 
$html.="
  <tr>
    <td width='15%'>
     <textarea rows='10' cols='15' style=''>".utf8_encode($rows["ftitulo"])."</textarea>
    </td>
    <td width='35%'>
     <textarea rows='10' cols='35' style=''>".utf8_encode($rows["sdescripcion"])."</textarea>
    </td>
    <td width='45%'>
     <textarea rows='10' cols='45' style=''>".utf8_encode($rows["odescripcion"])."</textarea>
    </td>
    <td width='8%'>
     <textarea rows='10' cols='8' style=''>".utf8_encode($rows["tiempo"])."</textarea>
    </td>


  </tr>

 
 


";
}

$html.="
</table>
</html>

";


include("mpdf/mpdf.php");

$mpdf=new mPDF("en-GB-x","A4","","",0,0,0,0,6,3);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("FichaEnfoque.pdf", 'I');
