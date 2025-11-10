<?php
$id=$_GET["id"];
echo $id;
try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="prueba_consultoria";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}

$query="select * from ficha_requerimiento where id_ficha_requerimiento=".$_GET['id'];
$resultado = $conn->query($query); 
foreach ( $resultado as $rows)
{ 
	$id_ficha_enfoque=$rows["id_ficha_enfoque"];
    $fecha=$rows["fecha_requerimiento"];

}
$query="SELECT * from ficha_enfoque,usuario,sede where ficha_enfoque.id_usuario=usuario.usu_id and usuario.usu_sede=sede.id_sede
and ficha_enfoque.id_ficha_enfoque=".$id_ficha_enfoque;
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) 
{ 
  $titulo=$rows["titulo_enfoque"];
  $sede=$rows["descripcion"];
}





$html.="<html>

<table width='100%'>
<tr>
  <td width='15%'>
  <img src='logo.png' width='120px' height='75px'/>
  </td>
  <td width='35%'>
    <h2><u>FICHA DE REQUERIMIENTO</u></h2>
  </td>
 
 </tr>
 </table>
 <table>
 <tr>
  <td width='100%'>
  <label style='font-size:20px'>FECHA: ".$fecha."</label>
    </td>
    </tr>

    <tr>
  <td width='100%'>
  <label style='font-size:20px'>SEDE : ".$sede."</label>
    </td>
    </tr>

    <tr>
  <td width='100%'>
  <label style='font-size:20px'>Para La Tesis titulada: <b>".$titulo."</b></label><br><br>
  <label>Se requiere lo siguiente:</label>
    </td>
    </tr>";
    $query="select * from detalle_requerimiento where id_ficha_requerimiento=".$_GET["id"];
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) 
{ 
  

    $html.=" <tr><td>
<textarea rows='6' cols='100'>".utf8_encode($rows["descripcion_requerimiento"])."</textarea>
</td>
</tr>";
}

 $html.="<tr ><td width='100%'>
<h6 style='text-align: justify;'><b>Nota:</b> La información solicitada, corresponde a una parte de la data necesaria para la elaboración de la realidad problemática del proyecto o plan de tesis, y la entrega del mismo de manera oportuna, permitirá la viabilización rauda de su trabajo.</h6></td></tr></table></html>";

include("mpdf/mpdf.php");

$mpdf=new mPDF("en-GB-x","A4","","",10,10,10,10,6,3);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

$css=file_get_contents("estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("requerimiento.pdf", 'I');
 ?>
