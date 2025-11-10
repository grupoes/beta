<?php 

try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}
$porque=".";
$paraque=".";
$como=".";
$donde=".";
$muestra=".";
$dis_inv=".";
$variables=".";
$cant_inter="";
$anios_antiguedad="";
$cant_nacio="";
$cant_local="";
$res_cant_hojas="";
$fecha="";
$query="select * from ficha_enfoque where id_ficha_enfoque=".$_GET['id'];
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
$idcliente=$rows['id_cliente'];
$titulo_enfoque=$rows['titulo_enfoque'];
$id_categoria=$rows['id_categoria'];
$id_grado=$rows['id_grado'];
$porque=$rows['porque'];
$paraque=$rows['paraque'];
$como=$rows['como'];
$donde=$rows['donde'];
$muestra=$rows['muestra'];
$dis_inv=$rows['dis_inv'];
$variables=$rows['variables'];
$anios_antiguedad=$rows['anios_antiguedad'];
$cant_inter=$rows['cant_inter'];
$cant_nacio=$rows['cant_nacio'];
$cant_local=$rows['cant_local'];
$res_cant_hojas=$rows['res_cant_hojas'];
$bio_cantidad=$rows['bio_cantidad'];
$bio_ordenado=$rows["bio_ordenado"];
$forma_orden=$rows['forma_orden'];
$plan_mejora=$rows['plan_mejora'];
$marco_conceptual=$rows['marco_conceptual'];
$can_autor=$rows['cant_autor'];
$anio_teoria=$rows['anio_teoria'];
$cant_marco=$rows['cant_marco'];
$can_realidad=$rows["can_realidad"];
$can_realidad=$rows["can_realidad"];
$id_tipo_norma=$rows["id_tipo_norma"];
$idDocente=$rows['id_trabajador'];
$docente=$rows['docente'];
$fecha=$rows["fecha_registro"];


}
$resultado =null;

$query= "select * from persona,cliente,universidad where persona.dni=cliente.dni and universidad.id_universidad=cliente.id_universidad and persona.dni=".$idcliente;


$resultado = $conn->query($query); 
$nombre="";

foreach ( $resultado as $rows) { 

$dni=$rows["dni"];
$nombre=$rows["nombres"];
$apellido=$rows["apellidos"];
$email=$rows['correo'];
$telefono=$rows['telefono'];
$carrera=$rows['carrera'];

$universidad=$rows['descripcion'];
$idtipoCliente=$rows['id_tipocliente'];
}



$resultado =null;
$query= "select * from categoria where estado=1";


$resultado = $conn->query($query); 

$query= "select * from grado where estado=1";


$grado = $conn->query($query); 
$query= "select * from resultado where estado=1";


$resultado1= $conn->query($query); 

$query= "select * from tipo_norma where estado=1";


$norma= $conn->query($query); 

$query= "select * from persona where dni=".$idDocente;
$doce= $conn->query($query); 
foreach ($doce as $key => $value) {
  $nombred=$value["nombres"];
$apellidod=$value["apellidos"];
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
    <h2><u>FICHA DE ENFOQUE</u></h2>
  </td>
  <td>
    <label style='font-size:3px'>Fecha de Entrega: </label><input style='font-size:7px;width:40px;height:8px; margin: 0px 0px 0px 0px;' type='text' value='".$dateTime->format('d-m-Y')."'/><br>
     <label style='font-size:3px'>Hora de Entrega: </label><input style='font-size:7px;width:40px;height:8px;margin:3px;'  type='text' value='".date('h:i:s A')."'/>
  </td>
 </tr>
 </table>
 <table>
 <tr>
  <td width='100%'>
  <h6 style='font-size:10px'>Titulo:</h6><textarea rows='3' cols='100'>".utf8_encode($titulo_enfoque)."</textarea>
    </td>

 </table>
<table width='100%'>
<tr>
   <td width='10%'>Categoria:</td>
   <td width='30%'>";
foreach ( $resultado as $rows) { 
      if($id_categoria==$rows['id_categoria'])
      {   
        $html.="<font id='texto'><input type='radio' checked='checked'>  ".utf8_encode($rows['descripcion'])."</font><br/>";
      }
      else{
      $html.="<font id='texto'><input type='radio' />  ".utf8_encode($rows['descripcion'])."</font><br/>";
        }
      }
         $html.="</td>
   <td width='10%'>";
     if($idtipoCliente==8){
      $html.="ALUMNO:";
     }
     else{
      $html.="PROVEDOR:";
     }
   


   $html.="</td>
    <td width='50%'>
     <font id='texto'>Nombres y Apellidos:<input type='text' value='".utf8_encode($nombre)." ".utf8_encode($apellido)."' id='campo1'/></font><br/>
     <font id='texto'>email:<input type='text' id='campo2' value='".$email."' /></font><br/>
     <font id='texto'>telf.:<input type='text' id='campo3' value='".$telefono."'/><font id='texto'>Univ.:<input value='".utf8_encode($universidad)."' type='text'  id='campo4'/><br/>
     <font id='texto'>Escuela:<input type='text' id='campo5' value='".utf8_encode($carrera)."'/>
    <font id='texto'>Profesor:<input type='text' id='campo5' value='".utf8_encode($docente)."'/>
   </td>

</tr>
</table>
<table>
<tr>
<td>Grado (</td>
<td>";
foreach ( $grado as $rows) { 
      if($id_grado==$rows['id_grado'])
      {   
        $html.="<font id='texto'> ".$rows['descripcion']."<input type='checkbox' checked='checked'> </font>";
      }
      else{
      $html.="<font id='texto'> ".$rows['descripcion']."<input type='checkbox' /> </font>";
        }
      }

$html.="

)</td>
</tr>
</table>
<table>
<tr>
<td width='80%'></td>
<td><h3><center><u>ENFOQUE</u></center><h3></td>
</tr>
</table>
<table>
<tr>
<td><h6>(Debe Contener la idea clara de la problematica , demas debe mostrar caracteristicas detalladas de la empresa o institucion a realizar la investigacion 'Nombre a que se decdica, donde encontrare informacion, deudas, cantidad producida, cantdad vendida, pagina web, facebook, telefono, etc')</h6></td>
<tr>
</table>
<table>
<tr>
<td>
<h5>¿PORQUE?</h5>
<textarea rows='20' cols='100'>".utf8_encode($porque)."</textarea>
</td>
</tr>
</table>
<table>
<tr>
<td>
<h5>¿PARA QUE?</h5>
<textarea rows='20' cols='100'>".utf8_encode($paraque)."</textarea>
</td>
</tr>
</table>
<table>
<tr>
<td>
<h5>¿COMO?</h5>
<textarea rows='20' cols='100'>".utf8_encode($como)."</textarea>
</td>
</tr>
</table>
<table>
<tr>
<td>
<h5>¿DONDE?</h5>
<textarea rows='20' cols='100'>".utf8_encode($donde)."</textarea>
</td>
</tr>
</table>
<table>
<tr>
<td>
<h5>VARIABLES:</h5>
<textarea rows='20' cols='100'>".utf8_encode($variables)."</textarea>
</td>
</tr>
</table>
<table>
<tr>
<td>
<h5>MUESTRA:</h5>
<textarea rows='5' cols='100'>".utf8_encode($muestra)."</textarea>
</td>
</tr>
</table>
<table>
<tr>
<td>
<h5>DISENO DE INV:</h5>
<textarea rows='5' cols='100'>".utf8_encode($dis_inv)."</textarea>
</td>
</tr>
</table>
<table>
  <tr>
     <td><h6>ANTECEDES</h6></td>
     <td>
      <h6>años de antiguedad&nbsp;&nbsp;&nbsp;&nbsp;<input value='".$anios_antiguedad."' type='text'/></h6>
        <h6>Cant. internacionales&nbsp;<input type='text' value='".$cant_inter."'/></h6>
          <h6>Cant. de nacionales&nbsp;&nbsp;&nbsp;&nbsp;<input value='".$cant_nacio."' type='text'/></h6>
           <h6>Cant. de locales &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input value='".$cant_local."' type='text'/></h6> 
           <h6 style='font-size:7px;width:40px;height:8px;margin:3px;'>(los antecedentes locales esta en resposabilidad del estudiante)</h6>
     </td>
     <td>
        <h6>REALIDAD</h6>
        <h6>PROBLEMETICA Y</h6>
        <h6>MARCO TEORICO</h6>
     </td>
     <td>
     <h6>Cant. hojas realidad problematica<input type='text' value='".$can_realidad."'/></h6>

      <h6>Cant. hojas marco teorico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' value='".$cant_marco."'/></h6>
       <h6>Años de antiguedad de las teoria&nbsp;<input type='text' value='".$anio_teoria."'/></h6>
        <h6>Cantidad de autores&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' value='".$cant_marco."' /></h6>
        <h6>Lleva mapa conceptual con los autores</h6>
          <font id='texto'>si<input type='checkbox' ";
            if($marco_conceptual=="si"){ $html.=" checked='checked' ";}
          $html.=" /> </font>
         <font id='texto'> no<input type='checkbox'";
  if($marco_conceptual=="no"){ $html.=" checked='checked' ";}
        $html.= " /> </font>
     </td>
  </tr>
  <tr>
     <td>
       <h6>RESULTADO:</h6>
     </td>
     <td>
          <h6>Cant. hojas<input type='text' value='".$res_cant_hojas."'/></h6>
          <h6>RESULTADOS POR</h6>";

foreach ( $resultado1 as $rows) { 
        $con=0;
            $query= "select fichaenfoque_resultado.id_resultado,resultado.descripcion from resultado,fichaenfoque_resultado where resultado.id_resultado=fichaenfoque_resultado.id_resultado and fichaenfoque_resultado.id_ficha_enfoque=".$_GET['id'];;
            $resul= $conn->query($query);

            foreach ( $resul as $rows1) { 
                 
            if($rows1['id_resultado']==$rows['id_resultado']){

              $html.="<h6 ><input type='checkbox' checked='checked' /> ".$rows1['descripcion']." </h6>";
              $con=1;
            }
       }
       if($con==0){
           $html.="<h6 ><input type='checkbox' /> ".$rows['descripcion']." </h6>";
        }
      }
   $html.="  </td>
  </tr>
  <td>
    <h6>REFERENCIAS</h6><h6> BIBLIOGRAFICAS</h6>";
foreach ( $norma as $key=>$rows) { 
    $hola="";
    $da="";
    if($rows['id_tipo_norma']==$id_tipo_norma){
         $da="  checked='checked' ";
    }
      if($key==2){
      $hola="<input type='text'/>";
      }
      $html.="<h6 ><input type='radio' ".$da." /> ".$rows['descripcion'].$hola." </h6>";
        
      }

    $html.="
  </td>
  <td>
     <h6>Cantidad<input type='text' value='".$bio_cantidad."' /></h6>
     <h6><u>Ordenado por</u></h6>
     <h6><input type='radio'";
  if($bio_ordenado=="si"){ $html.=" checked='checked' ";}

      $html.="/>Orden Alfabetio</h6>
       <h6><input type='radio'";
 if($bio_ordenado=="no"){ $html.=" checked='checked' ";}
       $html.="/>Por tipo</h6>
  </td>
</table>
<table>
<tr>
<td>
<h5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FORMA Y ORDEN DE COMO EXPRESAR LOS RESULTADOS</h5>
<textarea rows='10' cols='100'>".utf8_encode($forma_orden)."</textarea>
</td>
</tr>
<<tr>
  <td><h6>LA INVESTIGACION ,¿LLEVARA UN PLAN DE MEJORA? <input type='radio'";
  if($plan_mejora=="si"){ $html.=" checked='checked' ";}
  
   $html.=">SI <input type='radio'";
  if($plan_mejora=="no"){ $html.=" checked='checked' ";}
   $html.=">NO</h6></td>
</tr>
</table>
<table>
 <tr>
   <td><h5>FIRMAS DE CONFORMIDAD DE LA FICHA DE ENFOQUE</h5></td>
 </tr>
 <tr> <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
     <td><h6>----------------------------------------------</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASESOR</td>
      <td><h6>------------------------------------------</h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASESORADO</td>
 </tr>
 <tr>
 <br>
  <td><h5>Elaborador Por ".$nombred." ".$apellidod."</h5></td>
  <td><h5>Fecha: ".date("d/m/Y")."</h5></td>
 </tr>
</table>
</html>

";

include("mpdf/mpdf.php");

$mpdf=new mPDF("en-GB-x","A4","","",0,0,0,0,6,3);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

$css=file_get_contents("estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("FichaEnfoque.pdf", 'I');
