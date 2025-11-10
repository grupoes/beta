<?php 
try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}


  $query= "select * from antecedente,referencia,alcance,grado_tesis where antecedente.id_antecedentes=referencia.id_antecedentes and alcance.id_alcance=antecedente.id_alcance
		and grado_tesis.id_grado_tesis=  antecedente.id_grado_tesis and antecedente.id_ficha_enfoque=".$_GET["id"];
		$query1= "select * from antecedente,referencia,alcance,grado_tesis where antecedente.id_antecedentes=referencia.id_antecedentes and alcance.id_alcance=antecedente.id_alcance
		and grado_tesis.id_grado_tesis=  antecedente.id_grado_tesis and antecedente.id_ficha_enfoque=".$_GET["id"];
$resultado = $conn->query($query); 
$resultado1 = $conn->query($query1); 

require_once 'vendor/autoload.php';
$phpWord = new \PhpOffice\PhpWord\PhpWord();

$section = $phpWord->addSection();

$dni="";
$c=0;
foreach ( $resultado as $key => $rows) { 
$c=$c+1;

 $query1="select * from autor where id_referencia=".$rows["id_referencia"];
    $result = $conn->query($query1); 

    //$numeroautor=count($result);
    $con=0;
        foreach ($result as $key => $value1){
        	$con=$con+1;
        }
  $result1=$conn->query($query1);
        foreach ($result1 as $key => $value) 
        {   
             
        	if($con<4){
                 $dni.=$value["aut_apelllido"].' ';
                  if($con!=$key+1)
                    {
                       $dni.='y ';
                    }

        	}
        	else{



        	}
             
        }
   
 $dni.=' ('.$rows["ref_anio"].'), en su '.$rows["gra_abreviatura"]. ': "'.$rows["ref_titulo"].'" .'.$rows["ref_universidad"].'. '.$rows["ref_ciudad"].', '.$rows["ref_pais"].'.';

 $dni.=" La ".utf8_decode("investigación ").$rows["ant_intro_objetivo"]." ".$rows["ant_objetivo"]." ".$rows["ant_intro_muestra"]." ".$rows["ant_muestra"]." ".$rows["ant_prose_diseno"]." ".$rows["ant_diseno"]." ".$rows["ant_intro_prosa_instrumento"]." ".$rows["ant_instrumento"]." ".$rows["ant_prosa"]." ".$rows["ant_conclusion"]." ".$rows["ant_prosa_intro_inv"]." ".$rows["ant_investigacion"];

//echo $dni;
/*if($c<22)
{*/
//echo $dni;

$section->addText(
    $dni,  array('name' => 'Arial', 'size' => 11),array('align'=>'both', 'spaceAfter'=>100)
   );
$dni="";
//}







}

foreach ( $resultado1 as $rows1) { 

 $query1="select * from autor where id_referencia=".$rows1["id_referencia"];
    $result = $conn->query($query1); 

   
    $con=0;
        foreach ($result as $key => $value1){
          $con=$con+1;
        }
 
      $result1=$conn->query($query1);
      $data="";
      foreach ($result1 as $key => $value) 
        {   
             
          if($con<5){
                  $data.=$value["aut_apelllido"].", ".$value["aut_nombre"].". ";
             if($con!=$key+1)
             {
               $data.="y ";
             }

          }
          else{



          }
             
        }
 $data.=' ('.$rows1["ref_anio"].') "'.$rows1["ref_titulo"].'" ('.$rows1["gra_descripcion"].'). '.$rows1["ref_universidad"].'. '.$rows1["ref_ciudad"].', '.$rows1["ref_pais"].'.';
     if($rows1["ref_url"]!=""){

      $data.="Recuperado de: ". htmlspecialchars ($rows1["ref_url"]);
    }
//echo $data."<br><br>";
  $section->addText(
    $data
    ,  array('name' => 'Arial', 'size' => 11),array('align'=>'both', 'spaceAfter'=>100)
   );

}


$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('jimy.docx');


header("Content-disposition: attachment; filename=antecedentes".$_GET["id"].".docx");
header("Content-type: application/docx");
readfile("jimy.docx");
unlink('jimy.docx');



?>