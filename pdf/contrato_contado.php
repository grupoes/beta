<?php

$id_enfoque=$_GET['id_enfoque'];
try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}

$query="select * from ficha_enfoque where id_ficha_enfoque=".$id_enfoque;
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
$idcliente=$rows['id_cliente'];
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
$direccion=$rows['direccion'];
$universidad=$rows['observacion'];
$id_distrito=$rows['id_distrito'];
}

$query="select * from distrito where id_distrito=".$id_distrito;
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
  $distrito=$rows['descripcion'];
  $id_provincia=$rows['id_provincia'];
}
$query="select * from provincia where id_provincia=".$id_provincia;
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
  $provincia=$rows['descripcion'];
  $id_departamento=$rows['id_departamento'];
}
$query="select * from departamento where id_departamento=".$id_departamento;
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
  $departamento=$rows['descripcion'];
 
}

$query="select * from contrato where id_ficha_enfoque=".$id_enfoque;
$resultado = $conn->query($query); 
foreach ( $resultado as $rows) { 
  $monto=$rows['pago'];
  $fecha=$rows['dia'];
 
}
  $datetime2 = new DateTime($fecha);
  $fecha3= $datetime2->format('d/m/Y');
   $dia1= $datetime2->format('d');
    $anio= $datetime2->format('Y');
    $mes= $datetime2->format('m');
switch ($mes){ 
                  
                  case 1: $dia="Enero"; break; 
                  case 2: $dia="Febrero"; break; 
                  case 3: $dia="Marzo"; break; 
                  case 4: $dia="Abril"; break; 
                  case 5: $dia="Mayo"; break; 
                  case 6: $dia="Junio"; break;
                  case 7: $dia="Julio"; break; 
                  case 8: $dia="Agosto"; break; 
                  case 9: $dia="Setiembre"; break; 
                  case 10: $dia="Octubre"; break; 
                  case 11: $dia="Noviembre"; break; 
                  case 12: $dia="Diciembre"; break;  
            }

$html="<body>
<h3 id='data'><center>CONTRATO PRIVADO DE ASESORIA DE TESIS</center></h3>
<h5 id='texto' ><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Conste por el presente documento, el contrato privado que celebran de una parte la empresa ERIK CONSULTORES S.A.C., con RUC Nº 20542322501, con domicilio en Jirón. Colón 566 – Atumpampa, distrito de Morales, Provincia y Departamento de San Martín, debidamente representado por el Sr. ERIK PEZO ARTEAGA, con DNI Nº 43845329, e-mail: investigaciontarapoto@grupoesconsultores.com, con teléfono fijo (042) 530047 con Rpm #941690831 y con Bitel 938669769  a quien en adelante se le denominará EL CONSULTOR; y de la otra parte, El Sr ".$nombre." ".$apellido."  identificado con DNI N° ".$dni." de profesión estudiante de la carrera de ".$carrera." ,e-mail: ".$email.", cel/rpm ".$telefono." con domicilio real en ".$direccion.", distrito de ".$distrito.",  Provincia ".$provincia." y Departamento ".$departamento."; a quien en adelante se le denominará EL ASESORADO,  en los términos y condiciones siguientes:</p>

<p><b>CLÁUSULA PRIMERA:</b> EL CONSULTOR es una empresa que está asociada al Grupo ES Consultores SAC, con RUC 20542322412, con sede principal la Ciudad Morales, provincia y departamento de San Martín, en el  Jirón Colón 566 – Sector Atumpampa; con sucursales en Pasaje Los Sauces N°155 Departamento 401 Urbanización Santa Victoria en la Ciudad de Chiclayo del departamento de Lambayeque; Avenida San Lorenzo N°383 en la Ciudad de Huamanga en el Departamento de Ayacucho y en Calle Mariscal Castilla N°608 en la Ciudad de Yurimaguas en el departamento de Loreto.
Brinda servicio de asesoría en la investigación para la elaboración de proyectos de Tesis, así como su desarrollo, en temas diversos, con especialidad en las ciencias empresariales, para estudiantes y profesionales de diferentes grados académicos.<br>
Nuestro trabajo puede tener hasta el 28% de índice de similitud, así mismo, es cumplir con las fases lineales cuando se trata de una investigación con enfoque cuantitativo, y fases circulares cuando se trata de una investigación cualitativa, lo que implica cumplir la secuencia en cada una de ellas.
Cuenta con acceso a fuentes primarias, secundarias y terciarias en investigación.</p>

<p><b>CLÁUSULA SEGUNDA:</b> En cuanto a las obligaciones:<br> 
<b>EL CONSULTOR:</b> En este acto se obliga:<br>
<b>2.1.</b> 	Al no existir, plantea temas a investigar para consensuar, teniendo en cuenta la especialidad de EL ASESORADO, ello se concretiza con el llenado de la ficha de enfoque para seguir los lineamiento, el tipo de investigación, estructura y metodología.<br>
<b>2.2.</b> 	Presentar a EL ASESORADO el borrador de Proyecto y/o Desarrollo de Tesis, de manera virtual y oportuna.<br>
<b>2.3.</b> 	Informar a EL ASESORADO sobre el avance del trabajo y sustentar las observaciones levantadas.<br>
<b>2.4. </b>	Convocar a reuniones de asesoría las veces que sea necesario, de acuerdo a la naturaleza y la exigencia de la propia investigación.<br>
<b>2.5.</b>	Orientar y presentar la información de resultado del trabajo a EL ASESORADO, desde su inicio hasta su final.<br>
<b>2.6.</b>	Mantener en reserva cualquier tipo de información de insumo o de resultado del trabajo de tesis y/o proyecto.<br>
<b>2.7.</b>	Hacer la entrega del acabado de tesis en el tiempo convenido. Teniendo en cuenta el formato o modelo de estructura que hace uso su universidad.<br>
<b>2.8.</b>	Iniciar el trabajo previo pago de adelanto a la firma del presente contrato. Aclarando que el inicio del trabajo se da con la aprobación de una ficha de enfoque,  que debe ser consentida – firmada por EL ASESORADO.<br> 
<b>2.9.</b>	Dependiendo del tipo de observación (de forma o fondo) realizado por el asesor interno o jurados, éstas deben ser subsanadas dentro del plazo de los siete días, contadas desde el día siguiente de haber recepcionado. </p>

<p>DEL ASESORADO: En este acto se obliga:<br>
<b>2.10.</b>	Asistir a las reuniones convocadas por  EL CONSULTOR, previa concertación de fecha y hora a la convocatoria.<br>
<b>2.11.</b>	Proporcionar información pertinente y oportuna - dentro del plazo convenido, con fotocopiado,  impresión o/y virtual; caso contrario retrotrae el trabajo en EL CONSULTOR en el plazo establecido.<br>
<b>2.12.</b>	En el plazo de 24 horas, hacer llegar las observaciones de manera clara y detallada hechas por el asesor interno y/o jurado de su universidad, pudiendo ser enviadas en forma física y/o virtual.<br>
<b>2.13.</b>	Planificar y desarrollar actividades para recolectar información de campo, para las tabulaciones de resultados e interpretación.<br>
<b>2.14.</b>	A la impresión, encuadernado.<br>
<b>2.15.</b>	 El cambio de tema y enfoque puede hacerlo dentro de las 24 horas; pasado este tiempo, si va ser aceptado por EL CONSULTOR, previo pago de un importe adicional.</p>



<p><b>CLÁUSULA TERCERO:</b> El CONSULTOR y EL ASESORADO convienen que el pago por el cumplimiento de las obligaciones para ELABORAR LA TESIS Y/O PROYECTO es la suma  S/. ".$monto.",00 precio al contado en la firma del contrato.<br><br>
Aclarando que el pago debe hacerse en el local donde se firma el presente contrato, el cual emitirá un recibo por el monto consignado e indicando el restante, también se puede efectuar el pago mediante transferencias y/o depósitos, en las cuentas proporcionadas por el consultor, esta acción deberá ser concretada con la evidencia física y/o virtual de la misma. El retraso del pago, causa retraso en el avance o culminación de la tesis.</p>

<p><b>CLÁUSULA CUARTO:</b> En cuanto se refiere al plazo que EL CONSULTOR necesita para realizar el trabajo de PROYECTO Y/O DESARROLLO DE TESIS, debe ser de mutuo acuerdo con  EL ASESORADO, en este caso se inicia el día ".$fecha3." y concluye el día que tanto el PROYECTO Y/O DESARROLLO DE TESIS son aprobados; cuando se trata de realizar la tesis en una asignatura que se impone en la curricular de la Universidad, esta culmina con la aprobación de la asignatura. <br> 

<p><b>CLÁUSULA QUINTO:</b> De acuerdo al envio  virtual de los documentos y observaciones; todos se realizarán mediante el intranet, entrando a la página web “http://www.grupoesconsultores.com/consultoria/”, EL ASESORADO contará con un usuario y contraseña que le brindará EL CONSULTOR. 
USUARIO: ".$dni."
CONTASEÑA: ".$dni.".</p>






<b>CLÁUSULA sexto:</b> El desistimiento se puede realizar por cualquiera de las partes antes de la firma del contrato, esto debe ser expresamente anunciado en el acto o tácitamente en no firmar el contrato. Ahora, en cuanto  a la figura legal de resolución o rescisión del contrato, esto es aplicable de acuerdo a los Art. 1370º, 1371º y 1372° del Código Civil.<br>
<b>CLÁUSULA SÉPTIMO:</b> EL ASESORADO puede exigir  a EL CONSULTOR el cumplimiento de su TRABAJO TESIS Y/O PROYECTO siempre y cuando está al día en sus pagos convenidos.<br>
<b>CLÁUSULA OCTAVO:</b> Se entenderá por desinterés la falta de comunicación por cualquier de las vías, si es por parte de EL ASESORADO luego de vencido el plazo; más un mes, no tiene derecho a reclamarlo ni las devoluciones de sus cuotas aportadas. Si es por parte de EL CONSULTOR, éste tendría que hacer la devolución del dinero más los intereses legales o entregar hasta donde fue el avance de su trabajo.<br>
<b>CLÁUSULA NOVENO:</b> Las partes pueden llegar a acuerdos de resolver el contrato cuando existen actos de fuerza mayor o por cuestión fortuita, de tal manera que existe medio de prueba indubitable, por tanto puede existir la devolución de dinero, dejando consigo el gasto logístico, administrativo, de tiempo y otras a favor de EL CONSULTOR.<br>
<b>CLÁUSULA DÉCIMO :</b> Cualquier modificación de los términos pactados en el presente contrato, se ejecutarán de mutuo acuerdo, debiendo formalizarse mediante la suscripción de la addenda respectiva. En caso de que, el Asesorado cambie su tema y/o enfoque, establecida en la FICHA DE ENFOQUE; el monto adicional será señalado en dicha addenda, juntamente con su nuevo tema y/o enfoque.<br>
<b>CLÁUSULA DÉCIMO PRIMERO:</b> Las partes declaran que el domicilio para efecto de las notificaciones que se realicen durante la ejecución del presente contrato está indicado en el exordio del presente documento, incluyendo los números celulares y correos electrónicos. Sin embargo ante cualquier variación debe ser comunicado inmediatamente a la otra parte, por cualquier medio, a efectos de cumplir con los objetivos de contrato. Por tanto EL CONSULTOR no se responsabiliza de la no comunicación oportuna de cambio de domicilio electrónico por parte de EL ASESORADO.<br>
<b>CLÁUSULA DÉCIMO SEGUNDO:</b> Si las partes no llegan a un buen entendimiento, tendrían que hacer valer su derecho en primera instancia por medio de conciliación.</p>

Estando ambas partes de acuerdo firman el presente en señal de aceptación.</h5><br><br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tarapoto, ". $dia1." de ".$dia." del ".$anio."

                            <br><br><br>
                        
                                <table >
                             <tr><td width='25%'> <h6 id='centro'>..............................................................<br> Sr. ERIK PEZO ARTEAGA<br>
                                   DNI N°43845329<br>
                               <b>EL CONSULTOR</b><h6></td>
                               <td id='datos' width='20%' ></td>
                               <td width='10%'></td>
                               <td width='25%'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <h6 id='centro'>................................................................<br> Sr. ".$nombre." ".$apellido."<br>
                                   DNI N°".$dni."<br>
                               <b> EL ASESORADO</b><h6></td>
                               <td id='datos' width='20%' ></td>

                             </tr>
                            </table>

</body>";



 include("mpdf/mpdf.php");

$mpdf=new mPDF("en-GB-x","A4","","",13,30,36,54,6,3);
$html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

$css=file_get_contents("estilo.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html,2);
$mpdf->Output("FichaEnfoque.pdf", 'I');

?>