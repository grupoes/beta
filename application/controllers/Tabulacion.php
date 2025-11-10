
<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
use PhpOffice\PhpWord\Shared\Converter;
ini_set('memory_limit','1024m');
class Tabulacion extends Controler {
 public function __construct() {
  parent::__construct();
  $this->load->model("Mantenimiento_m");
   $this->load->library('zip');

}

public function index(){
    //if($this->input->is_ajax_request()){   
  $lista=$this->Mantenimiento_m->lista("categoria");
  $this->load->view("TabulacionPrueba/index",compact('lista'));

}

 public function subir()
 {
     $dir_subida = $_FILES['archivo']['name'];
if (move_uploaded_file($_FILES['archivo']['tmp_name'], $dir_subida)) 
             {
              
              }
         else {
                echo "Error al subir la foto es demasiado grande";                 
           } 

           $data = file_get_contents($dir_subida);
           echo $data;
       
 }
public function procesamiento(){
  $post=file_get_contents("php://input");  
  $res=json_decode($post, true);
  $params=array();
  parse_str($res["datos"], $params);
  if ($params["variable"] == 2) {
    for($i=0;$i<$params["itemv2"];$i++){
      $muestra1["nombre_pregunta"][$i] = $params["nombre_pregunta"][$i+$params["item"]];
      $muestra1["nombre_conca"][$i] = $params["nombre_conca"][$i+$params["item"]];
    }
    for ($i=0; $i <$params["numero_indicador0"][1] ; $i++) { 
      $muestra1["nombre_indicador"][$i] = $params["nombre_indicador"][$i+$params["numero_indicador0"][0]];
    }
  }else{
   $muestra1 = array();   
 }
 $excel = $res["excel1"];
 $excel2 = $res["excel2"];   
 $this->generar_excel($excel,$params,$muestra1,$excel2);
 exit();
}

public function generar_excel($excel = array(),$enviados = array(),$muestra1 = array(),$excel2 = array()){
  $time_start = microtime(true);
  $conectoresoracion = array("además","así","mismo","también","de nuevo","por su parte","de modo que","con motivo","incluso","no obstante","aunque","en cambio","sin embargo");

  $letra = substr($enviados["nommuestra"], -1);
  if ($letra == 'r' || $letra == 'R') {
    $letramuestra = $enviados["nommuestra"].'es';
  }else{
    $letramuestra = $enviados["nommuestra"].'s';
  }
$valoresentreitem = array();
$suma = 0;
$valoresentreitems = array();
//for ($i=1; $i <= $enviados["item"] ; $i++) { 
//  for ($j=0; $j < $enviados['muestra']  ; $j++) {
 //  $numer = $excel[$j][$i];
//    if(isset($valoresentreitem[$i][$numer])){
 //   $valoresentreitem[$i][$numer] =  $valoresentreitem[$i][$numer] + 1; 
 //   }else{
 //   $valoresentreitem[$i][$numer] = 1;
 //   }
 //   $valoresentreitem[$i][$enviados["respuesta"] + 1] =  $enviados['muestra'];
 // }
 // for ($k=1; $k <= $enviados["respuesta"] ; $k++) { 
//    $valoresentreitems[$i][$k] = (($valoresentreitem[$i][$k] / $valoresentreitem[$i][$enviados["respuesta"] + 1] ));
 // }
//}
$valorconteodimen = array();
$valorconteodimen1 = array();
$valoresentreitemsgeneral = array();
$iniciocontador =0;
$fin =0;

//for ($i=0; $i < $enviados["numero_indicador0"][0]; $i++) {
//  $fin = $iniciocontador + $enviados["numero_pregunta0"][$i];
//  $div = $enviados['muestra']* $enviados["numero_pregunta0"][$i];
//  $iniciocontador++;
//  for ($j=$iniciocontador; $j <= $fin ; $j++) { 
 //   for ($k=0; $k < $enviados['muestra']; $k++) { 
//     $numer = $excel[$k][$j];
//     if(isset($valorconteodimen[$i][$numer])){
//      $valorconteodimen[$i][$numer] =  $valorconteodimen[$i][$numer] + 1; 
//    }else{
//      $valorconteodimen[$i][$numer] = 1;
//    }      
//  } 
//}

//for ($k=1; $k <= $enviados["respuesta"] ; $k++) { 
//  $valorconteodimen1[$i][$k] = $valorconteodimen[$i][$k];
//  $valorconteodimen[$i][$k] = round(($valorconteodimen[$i][$k] / $div ),2); 
//  $valoresentreitemsgeneral[$i][$k] = $valorconteodimen[$i][$k];    
//} 
//$iniciocontador = $fin;
//}
//
//$n = $i;


//for ($j=1; $j <=  $enviados["item"] ; $j++) { 
//  for ($k=0; $k < $enviados['muestra']; $k++) { 
//   $numer = $excel[$k][$j];
//   if(isset($valorconteodimen[$n][$numer])){
//    $valorconteodimen1[$n][$numer] = $valorconteodimen1[$n][$numer]+ 1;
//    $valorconteodimen[$n][$numer] =  $valorconteodimen[$n][$numer] + 1; 
//
//  }else{
 //   $valorconteodimen1[$n][$numer] = 1;
//    $valorconteodimen[$n][$numer] = 1;
//  }      
//} 
//}
//$div = $enviados['muestra']* $enviados["item"];
//for ($k=1; $k <= $enviados["respuesta"] ; $k++) { 
//  $valorconteodimen[$n][$k] = round(($valorconteodimen[$n][$k] / $div ),2);  
 // $valoresentreitemsgeneral[$n][$k] = $valorconteodimen[$n][$k];    
//} 
  error_reporting(E_ALL);
  ini_set('display_errors', TRUE);
  ini_set('display_startup_errors', TRUE);
  date_default_timezone_set('America/Lima');

  define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
  require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
  require_once dirname(__FILE__) . '/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
  $objPHPExcel = new PHPExcel();

// Set document properties

  $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
  ->setLastModifiedBy("Maarten Balliauw")
  ->setTitle("Office 2007 XLSX Test Document")
  ->setSubject("Office 2007 XLSX Test Document")
  ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
  ->setKeywords("office 2007 openxml php")
  ->setCategory("Test result file");


// Add some data, we will use some formulas here
  $nombrepagina1 =  substr($enviados["nombre_dimension"][0], 0, 31);
  $objPHPExcel = new PHPExcel();
  $objPHPExcel->setActiveSheetIndex(0);
  $objPHPExcel->getActiveSheet()->setTitle($nombrepagina1);
  $sharedStyle1 = new PHPExcel_Style();
  $sharedStyle2 = new PHPExcel_Style();
  $sharedStyle3 = new PHPExcel_Style();
  $style = new PHPExcel_Style();
  $sharedStyle1->applyFromArray(
    array('fill'  => array(
      'type'    => PHPExcel_Style_Fill::FILL_SOLID,
      'color'   => array('argb' => 'E43B16')
    ),
    'borders' => array(
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  ));
  $sharedStyle2->applyFromArray(
    array('fill'  => array(
      'type'    => PHPExcel_Style_Fill::FILL_SOLID,
      'color'   => array('argb' => '2BAD56')
    ),
    'borders' => array(
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  ));
  $sharedStyle3->applyFromArray(
    array('fill'  => array(
      'type'    => PHPExcel_Style_Fill::FILL_SOLID,
      'color'   => array('argb' => 'FFFFFF')
    ),
    'borders' => array(
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  ));
  $cantidadglobalmuestra = $enviados['muestra']+14;
  $cantidadglobal_final = $cantidadglobalmuestra + 5;
  $Letra='A';
  $LetraFinal = 'A'; 
  $Cantidad_de_columnas_a_crear=$enviados['item']+2; 
  $Contador=0; 
  while($Contador<$Cantidad_de_columnas_a_crear) 
  { 
    $Contador++; 
    $LetraFinal++; 
  } 
  $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, $Letra."1:".$LetraFinal."2");
  $objPHPExcel->getActiveSheet()->getStyle($Letra."1:".$LetraFinal."2")->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($Letra."1", $enviados["nombre_variable"][0]);
  $objPHPExcel->setActiveSheetIndex(0)->mergeCells($Letra."1:".$LetraFinal."2");
  $Letra='B';
  $Contador =0;
  do{
    if($Contador<$enviados["numero_indicador0"][0]){
      $LetraFinal = $this-> generar_letra($Letra,$enviados["numero_pregunta0"][$Contador]-1);
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$LetraFinal."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',$enviados["nombre_indicador"][$Contador] );
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells($Letra."3:".$LetraFinal."3");
    }else{
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$LetraFinal."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3','Total');
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells($Letra."3:".$LetraFinal."3");
      $Letra=$LetraFinal++;
      $Letra=$LetraFinal++;
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$LetraFinal."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3','Valoración' );
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells($Letra."3:".$LetraFinal."3");
    }
    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
    $Contador++;
  }while($Contador <$enviados["numero_indicador0"][0]+1);
  $Letra = 'B';
  $Contador =0;
  do{
    $LetraFinal = $this-> generar_letra($Letra,0);
    $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."4:".$LetraFinal."4");
    $objPHPExcel->getActiveSheet()->getStyle($Letra."4:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.'4',"PRG.".($Contador+1));
    $objPHPExcel->setActiveSheetIndex(0)->mergeCells($Letra."4:".$LetraFinal."4");
    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
    $Contador++;
  }while($Contador <$enviados["item"]);
  $inicio = 5;


  for ($i=0; $i < $enviados['muestra']; $i++) { 
    $Letra = 'A';
    for ($j=0; $j < $enviados["item"]+2; $j++) { 
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$excel[$i][$j]);
      $objPHPExcel->getActiveSheet()->getStyle($Letra.$inicio)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
      $objPHPExcel->setActiveSheetIndex(0)->mergeCells($Letra.$inicio.":".$LetraFinal.$inicio);
      $Letra=$LetraFinal++;
      $Letra=$LetraFinal++;
    }
    $inicio++;
  }
  $Letra = 'A';
  $sumainicio = $enviados['muestra']+5;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$sumainicio,'TOTAL');

  $final = $inicio-1;
  $modainicio = $enviados['muestra']+6;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$modainicio,'MODA');

  $mediainicio = $enviados['muestra']+7;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$mediainicio,'MEDIA');

  $medianainicio = $enviados['muestra']+8;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$medianainicio,'MEDIANA');

  $desvinicio = $enviados['muestra']+9;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$desvinicio,'Desv.Est');

  $coefiinicio = $enviados['muestra']+10;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$coefiinicio,'Coef. Varia.
    ');
  $Letra = 'B';

  for ($i=0; $i < $enviados["item"] +1; $i++) { 
    $LetraFinal = $this-> generar_letra($Letra,0);
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$sumainicio,'=SUM('.$Letra.'5:'.$Letra.$final.')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$modainicio,'=MODE('.$Letra.'5:'.$Letra.$final.')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$mediainicio,'=('.$Letra.$sumainicio.'/'.$enviados['muestra'].')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$medianainicio,'=MEDIAN('.$Letra.'5:'.$Letra.$final.')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$desvinicio,'=ROUND(STDEV('.$Letra.'5:'.$Letra.$final.'),2)');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$coefiinicio,'=('.$Letra.$desvinicio.'/'.$Letra.$mediainicio.')');
    $objPHPExcel->getActiveSheet()->getStyle($Letra.$coefiinicio)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
  }
  $ini = $coefiinicio +1;
  $ini2 = $ini + $enviados["respuesta"] +1;
  $initotal = $ini2;
  $maximo = $enviados['muestra']+4;
  $numerobandera = $enviados['muestra'] + 1000;
  $numerobandera1 = $enviados['muestra'] + 1000+$enviados['respuesta']+1;
  $iniciobandera = $enviados['muestra'] + 1000;
  $iniciobandera1 = $enviados['muestra'] + 1000+$enviados['respuesta']+1;
  for ($i=0; $i <= $enviados["respuesta"] ; $i++) { 
    $LetraI = 'A';
    $LetraF = 'B';
    if ($i<$enviados["respuesta"]) {
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$numerobandera,($i+1));
      $objPHPExcel->getActiveSheet()->getStyle($LetraI.$numerobandera)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_TEXT);
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini,$enviados["nombre_respuesta"][$i]);
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini2,$enviados["nombre_respuesta"][$i].'%');
      for ($j=1; $j < $enviados["item"] +1; $j++) {
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini,'=COUNTIF($'.$LetraF.'$5:$'.$LetraF.'$'.$maximo.',$'.$LetraI.$numerobandera.')');
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini2,'=($'.$LetraF.$ini.'/$'.$LetraF.($initotal-1).')');

        $objPHPExcel->getActiveSheet()->getStyle($LetraF.$numerobandera1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $objPHPExcel->getActiveSheet()->getStyle($LetraF.$ini2)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $LetraF++;
      }

    }else{
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini,'Total');
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini2,'Total %');
      $finbandera = $numerobandera-1;
      $finbandera1 = $numerobandera1-1;
      for ($j=1; $j < $enviados["item"] +1; $j++) {
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini,'=SUM($'.$LetraF.($coefiinicio +1).':$'.$LetraF.($initotal-2).')');
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$numerobandera,'=SUM($'.$LetraF.($iniciobandera).':$'.$LetraF.($finbandera).')');
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$numerobandera1,'=SUM($'.$LetraF.($iniciobandera1).':$'.$LetraF.($finbandera1).')');

        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini2,'=SUM($'.$LetraF.$initotal.':$'.$LetraF.($ini2-1).')');

        $objPHPExcel->getActiveSheet()->getStyle($LetraF.$ini2)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $objPHPExcel->getActiveSheet()->getStyle($LetraF.$numerobandera1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $LetraF++;
      }
    }
    $numerobandera++;
    $numerobandera1++;
    $ini++;
    $ini2++;
  }    

  $nuevaaru = array();
  $nuevaarq = array();
  $mencion = array();
  $nueva_hoja = $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1); // marcar como activa la nueva hoja
$nueva_hoja->setTitle('Por Valoracion (3) Dimension'); // definimos el titulo
$nombrehoja[1] = "'Por Valoracion (3) Dimension'";
$nombrehoja1[0] = "'Por Valoracion (3) Dimension'";
$nuevaaro = array();
$nuevaarw = array();
$nueva_hoja->getColumnDimension('A')->setAutoSize(true);
//$nueva_hoja->setCellValue('A1',' Mi nueva hoja creada :) ');
$sharedStyle1 = new PHPExcel_Style();
$sharedStyle2 = new PHPExcel_Style();
$sharedStyle3 = new PHPExcel_Style();
$style = new PHPExcel_Style();
$sharedStyle1->applyFromArray(
  array('fill'  => array(
    'type'    => PHPExcel_Style_Fill::FILL_SOLID,
    'color'   => array('argb' => '0000FF')
  ),
  'borders' => array(
    'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  )
));

$sharedStyle2->applyFromArray(
  array('fill'  => array(
    'type'    => PHPExcel_Style_Fill::FILL_SOLID,
    'color'   => array('argb' => 'FFCC00')
  ),
  'borders' => array(
    'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  )
));

$sharedStyle3->applyFromArray(
  array('fill'  => array(
    'type'    => PHPExcel_Style_Fill::FILL_SOLID,
    'color'   => array('argb' => 'FFFFFF')
  ),
  'borders' => array(
    'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
  )
));
$Letra='A';
$linicia  = 'B';
$LetraFinal = 'A'; 
$Cantidad_de_columnas_a_crear=((($enviados["numero_indicador0"][0]+1)*2)); 
$Contador=0; 
while($Contador<$Cantidad_de_columnas_a_crear) 
{ 
  $Contador++; 
  $LetraFinal++; 
} 
$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, $Letra."1:".$LetraFinal."1");
$objPHPExcel->getActiveSheet()->getStyle($Letra."1:".$LetraFinal."1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('030303');
$objPHPExcel->getActiveSheet()->setCellValue($Letra."1", $enviados["nombre_variable"][0]);
$objPHPExcel->setActiveSheetIndex(1)->mergeCells($Letra."1:".$LetraFinal."1");

$objPHPExcel->getActiveSheet()->getStyle("A2:A3")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
$objPHPExcel->getActiveSheet()->setCellValue("A2", 'Nº de Personas');
$objPHPExcel->setActiveSheetIndex(1)->mergeCells("A2:A3");

$Letra='B';
$Contador =0;   
$nom_dimension = array();
do{
  $LetraFinal = $this-> generar_letra($Letra,1);
  if($Contador<$enviados["numero_indicador0"][0]){
    $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."2:".$LetraFinal."2");
    $objPHPExcel->getActiveSheet()->getStyle($Letra."2:".$LetraFinal."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.'2',$enviados["nombre_indicador"][$Contador] );
    $objPHPExcel->setActiveSheetIndex(1)->mergeCells($Letra."2:".$LetraFinal."2");  
    $nom_dimension[$Contador] = $Letra;
  }else{
    $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."2:".$LetraFinal."2");
    $objPHPExcel->getActiveSheet()->getStyle($Letra."2:".$LetraFinal."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.'2',$enviados["nombre_dimension"][0] );
    $objPHPExcel->setActiveSheetIndex(1)->mergeCells($Letra."2:".$LetraFinal."2");  
    $nom_dimension[$Contador] = $Letra;
  }


  for ($i=1; $i <=2 ; $i++) { 
    if($i ==1){
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$Letra."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$Letra."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',"Suma Total");
      $objPHPExcel->setActiveSheetIndex(1)->mergeCells($Letra."3:".$Letra."3"); 

      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$Letra."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$Letra."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',"Suma Total");
      $objPHPExcel->setActiveSheetIndex(1)->mergeCells($Letra."3:".$Letra."3"); 
    }else{
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$Letra."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$Letra."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',"Valoración");
      $objPHPExcel->setActiveSheetIndex(1)->mergeCells($Letra."3:".$Letra."3"); 
    }

    $Letra=$LetraFinal++;

  }
  $Letra = $Letra;
  $Contador++;
}while($Contador <$enviados["numero_indicador0"][0]+1);
$inicio = 4;
$inicio2= 5;
$LetraAyuda = $LetraFinal;
for ($i=0; $i < $enviados['muestra']; $i++) { 
  $Letra = 'B';
  $Letra2 = 'B';
  $iffor = $this->generar_letra($LetraAyuda,6);

  $parametroay = array();
  for ($j=0; $j < $enviados["numero_indicador0"][0]; $j++) {
    $LetraFinal = $this-> generar_letra($Letra,1);
    $LetraFinal2 = $this-> generar_letra($Letra2,$enviados["numero_pregunta0"][$j]-1);
    $segunletra = $this->generar_letra($LetraFinal,0);
    $condu = "=SUM('".$nombrepagina1."'!".$Letra2.$inicio2.":".$LetraFinal2.$inicio2.")";
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$condu);
    $ult = $Letra;
    if($enviados["escala"] == 2){
      $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",0))';
    }
    if($enviados["escala"] == 3){
      $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",0)))';
    }
    if($enviados["escala"] == 4){
      $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$22,"'.$enviados["nombre_escala"][3].'",0))))';
    }
    if($enviados["escala"] == 5){
      $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$22,"'.$enviados["nombre_escala"][3].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$23,"'.$enviados["nombre_escala"][4].'",0)))))';
    }
          if($enviados["escala"] == 6){
    $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$22,"'.$enviados["nombre_escala"][3].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$23,"'.$enviados["nombre_escala"][4].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$24,"'.$enviados["nombre_escala"][5].'",0))))))';
  }
    $parametroay[0][$j]  = ($this->generar_letra($Letra,0));
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio.":".($this->generar_letra($Letra,1)).$inicio)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1)).$inicio, $formula);

    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
    $Letra2=$LetraFinal2++;
    $Letra2=$LetraFinal2++;
    $iffor = $this->generar_letra($iffor,12);
  }
  $LetraFinal2 = $this-> generar_letra($ult,2);  
  $condu = "=SUM(B".$inicio.":".$ult.$inicio.")";
  $objPHPExcel->getActiveSheet()->setCellValue($LetraFinal2.$inicio,$condu);

  if($enviados["escala"] == 2){
    $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",0))';
  }
  if($enviados["escala"] == 3){
    $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",0)))';
  }
  if($enviados["escala"] == 4){
    $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$22,"'.$enviados["nombre_escala"][3].'",0))))';
  }
  if($enviados["escala"] == 5){
    $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$22,"'.$enviados["nombre_escala"][3].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$23,"'.$enviados["nombre_escala"][4].'",0)))))';
  }
      if($enviados["escala"] == 6){
    $formula = '=IF('.$Letra.$inicio.'<=$'.$iffor.'$19,"'.$enviados["nombre_escala"][0].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$20,"'.$enviados["nombre_escala"][1].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$21,"'.$enviados["nombre_escala"][2].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$22,"'.$enviados["nombre_escala"][3].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$23,"'.$enviados["nombre_escala"][4].'",IF('.$Letra.$inicio.'<=$'.$iffor.'$24,"'.$enviados["nombre_escala"][5].'",0))))))';
  }
  
  $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio.":".($this->generar_letra($Letra,1)).$inicio)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1)).$inicio, $formula);
  $parametroay[0][$j]  = ($this->generar_letra($Letra,0));
  $inicio++;
  $inicio2++;
}
$inicio = 4;
$Letra = 'A';
for ($i=0; $i < $enviados['muestra']; $i++) {
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$excel[$i][0]);
  $inicio++;
}
$pintado = new PHPExcel_Style();
$pintado2 = new PHPExcel_Style();
$pintado->applyFromArray(
  array('fill'  => array(
    'type'    => PHPExcel_Style_Fill::FILL_SOLID,
    'color'   => array('argb' => '8CC563')
  )
));
$pintado2->applyFromArray(
  array('fill'  => array(
    'type'    => PHPExcel_Style_Fill::FILL_SOLID,
    'color'   => array('argb' => 'bae704')
  )
));

$BStyle = array(
  'borders' => array(
    'bottom' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$BStyle1 = array(
  'borders' => array(
    'top' => array(
      'style' => PHPExcel_Style_Border::BORDER_THIN
    )
  )
);
$aux =0;
$bordeinicio = $this->generar_letra($LetraFinal2,3);
$valoresdimensiones= array();
$valoresdimensionres = array();
$contadorayuda = 0;
for ($i=0; $i <= $enviados["numero_indicador0"][0]; $i++) {
  $nuevom = $bordeinicio;
  $nuevon = $this->generar_letra($nuevom,1);

  $contador = 4;
  $bordefinal =$this->generar_letra($bordeinicio,10);
  $variables = $this->generar_letra($bordeinicio,2);
  $variables2 = $this->generar_letra($bordeinicio,3);
  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),"Variable");
  $nuevoo = $variables;
  $nuevaaro[$i] = $nuevoo;

  if ($i<$enviados["numero_indicador0"][0]) {
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordefinal.'3');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordeinicio.'45');  
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordefinal.'3:'.$bordefinal.'45');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'45:'.$bordefinal.'45');  
    $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),"Nombre de la Dimensión");
    $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+1).":".$variables.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+1),'='.$nom_dimension[$i].'2');  
    $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+1).":".$variables2.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+3),$enviados["numero_pregunta0"][$i]);
    $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+3).":".$variables2.($contador+3))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  }else{
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordefinal.'3');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordeinicio.'45');  
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordefinal.'3:'.$bordefinal.'45');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'45:'.$bordefinal.'45');

    $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+3),$enviados["item"]);
    $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+3).":".$variables2.($contador+3))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  }
  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),"Variable");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador).":".$variables.($contador))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+2),"Cantidad de Escalas Valorativas");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+2).":".$variables.($contador+2))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+3),"Nº de Peguntas");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+3).":".$variables.($contador+3))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+4),"Valor Mínimo por item");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+4).":".$variables.($contador+4))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+5),"Valor Máximo por item");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+5).":".$variables.($contador+5))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+6),"Máximo");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+6).":".$variables.($contador+6))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+7),"Mínimo");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+7).":".$variables.($contador+7))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+8),"Rango");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+8).":".$variables.($contador+8))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+9),"Amplitud del Intervalo");
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+9).":".$variables.($contador+9))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador),$enviados["nombre_dimension"][0]);
  $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador).":".$variables2.($contador))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $datosr = $variables2;
  $nuevop = $variables2;

  $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+2),$enviados["escala"]);
  $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+2).":".$variables2.($contador+2))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $datosr = $variables2;
  
  if($enviados["respuesta"] == 2){
    if($enviados["valorresp"] == 0){
      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+4),'0');
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+4).":".$variables2.($contador+4))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+5),'1');
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+5).":".$variables2.($contador+5))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    }else{
      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+4),'1');
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+4).":".$variables2.($contador+4))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+5),'2');
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+5).":".$variables2.($contador+5))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    }
  }else{
    $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+4),'1');
    $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+4).":".$variables2.($contador+4))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+5),$enviados["respuesta"]);
    $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+5).":".$variables2.($contador+5))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303'); 
  }

  $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+6),"=".$variables2."7*".$variables2."9");
  $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+6).":".$variables2.($contador+6))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+7),"=".$variables2."8*".$variables2."7");
  $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+7).":".$variables2.($contador+7))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+8),"=".$variables2."10-".$variables2."11");
  $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+8).":".$variables2.($contador+8))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $grafico = $variables2;
  $formula = $variables2."12/".$variables2."6";
  $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+9),"=ROUND(".$formula.",0)");
  $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+9).":".$variables2.($contador+9))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->getColumnDimension($datosr)->setWidth('25');

  $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setAutoSize(true);
  $var = $this->generar_letra($variables2,1);
  $var2 = $this->generar_letra($var,4);

  $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var2."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  if($i < $enviados["numero_indicador0"][0]){
    $objPHPExcel->getActiveSheet()->setCellValue($var."16", "=".$variables2."5");
    $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  }else{
    $objPHPExcel->getActiveSheet()->setCellValue($var."16", "=".$variables2."4");
    $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
//   $objPHPExcel->getActiveSheet()->getStyle($var.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  }

  $centrar = $var."14";
  $objPHPExcel->getActiveSheet()->setCellValue($var."15", 'Tabla '.($i+1));
  $nuevoq = $var;
  $nuevaarq[$i] = $var;
  $objPHPExcel->getActiveSheet()->getStyle($var."15:".$var."15")->getFont()->setName('Times new Roman')->setSize(10)->getColor()->setRGB('030303');



  $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var2."16")->applyFromArray($BStyle);
  $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var."17")->getFont()->setName('Times new Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var."17", 'Calificación');
  $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('15');
  $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setAutoSize(true);
  $objPHPExcel->setActiveSheetIndex(1)->mergeCells($var."17:".$var."18");

  $objPHPExcel->getActiveSheet()->getStyle($var."18:".$var2."18")->applyFromArray($BStyle);
  $contar = 19;
  $datoss =  $var ;
  for ($j=0; $j < $enviados["escala"] ; $j++) { 
    $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var2.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, $enviados["nombre_escala"][$j]);
    $contar++;
  }
  $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, 'Total');
  $numeross = $contar-1;
  $objPHPExcel->getActiveSheet()->getStyle($datoss.$contar.":".$var2.$contar)->applyFromArray($BStyle);
  $objPHPExcel->getActiveSheet()->getStyle($datoss.$contar.":".$var2.$contar)->applyFromArray($BStyle1);
  $objPHPExcel->getActiveSheet()->getColumnDimension($datoss)->setAutoSize(true);
///////////////////////////////////////////////////////////////////////////
  $var = $this->generar_letra($var,1);
  $var2 = $this->generar_letra($var,1);
  $objPHPExcel->getActiveSheet()->getStyle($var."17:".$var2."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var."17", 'Rango');
  $nuevor = $var;
  $objPHPExcel->setActiveSheetIndex(1)->mergeCells($var."17:".$var2."17");

  $objPHPExcel->getActiveSheet()->setCellValue($var."18", 'Desde');

  $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('10');
  $objPHPExcel->getActiveSheet()->getStyle($var."18:".$var2."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $datost = $var;
  $datosu = $this->generar_letra($datost,1);
  $contar = 19;
  $contarayuda = 2019;
  for ($j=0; $j < $enviados["escala"] ; $j++) { 
    $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var2.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    if ($j==0) {
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosr.'11');
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '='.$datosr.'11');
    }else{
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosu.($contar-1).'+ 1');
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '='.$datosu.($contar-1).'+ 1');
    }

    $contar++;
    $contarayuda++;
  }
  $var = $this->generar_letra($var,1);

  $objPHPExcel->getActiveSheet()->setCellValue($var."18", 'Hasta');
  $nuevos = $var;
  $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('10');
  $objPHPExcel->getActiveSheet()->getStyle($var."18:".$var2."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $datosu = $var;
  $contar = 19;
  $contarayuda = 2019;
  for ($j=0; $j < $enviados["escala"] ; $j++) { 
    $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    if ($j== ($enviados["escala"] -1)) {
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosr.'10'); 
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '='.$datosr.'10'); 
    }else{
      if ($i<$enviados["numero_indicador0"][0]) {
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datost.$contar.'+'.$datosr.'13');
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '='.$datost.$contar.'+'.$datosr.'13');
      }else{
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datost.$contar.'+'.$datosr.'13 - 1');
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '='.$datost.$contar.'+'.$datosr.'13 - 1');
      }

    }
    $contar++;
    $contarayuda++;
  }
///////////////////////////////////////////////////////////////////////////
  $var = $this->generar_letra($var,1);
  $datosv = $var;
  $objPHPExcel->getActiveSheet()->getStyle($var."17:".$var."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var."17", 'Frec.');
  $nuevot = $var;
  $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('15');
  $objPHPExcel->setActiveSheetIndex(1)->mergeCells($var."17:".$var."18");
  $maximo = $enviados['muestra']+3;
  $letrafre = $nom_dimension[$i];
  $contar = 19;
  $contarayuda = 2019;
  $ifcontador = $this->generar_letra($nom_dimension[$i],1); ;

  for ($j=0; $j < $enviados["escala"] ; $j++) {
    $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '=COUNTIF($'.$ifcontador.'$4:$'.$ifcontador.'$'.$maximo.',$'.$datoss.$contar.')');
    $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '=COUNTIF($'.$ifcontador.'$4:$'.$ifcontador.'$'.$maximo.',$'.$datoss.$contar.')');

    $contar++;
    $contarayuda++;
  }
  $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '=COUNTIF($'.$ifcontador.'$4:$'.$ifcontador.'$'.$maximo.',$'.$datoss.$contarayuda.')');

  $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '=SUM('.$datosv.'19:'.$datosv.($contar-1).')');
  $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '=SUM('.$datosv.'2019:'.$datosv.($contarayuda-1).')');
///////////////////////////////////////////////////////////////////////////

  $var = $this->generar_letra($var,1);

  $objPHPExcel->getActiveSheet()->getStyle($var."17:".$var."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var."17", '%');
  $nuevou = $var;
  $nuevaaru[$i] = $var;
  $nuevov = $this->generar_letra($nuevou,1);
  $nuevow = $this->generar_letra($nuevou,2);
  $nuevaarw[$i] = $nuevow;
  $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('10');
  $objPHPExcel->setActiveSheetIndex(1)->mergeCells($var."17:".$var."18");
  $apoyo = $contar;
  $apoyo1 = $contarayuda ;
  $contar = 19;
  $contarayuda = 2019;
  $datosw = $var;
  for ($j=0; $j < $enviados["escala"] ; $j++) {
    $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosv.$contar.'/'.$datosv.$apoyo);
    $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '='.$datosv.$contarayuda.'/'.$datosv.$apoyo1);

    $valoresdimensiones[$i][$j] = "'Por Valoracion (3) Dimension'!".$var.$contar;
    $objPHPExcel->getActiveSheet()->getStyle($var.$contar)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet()->getStyle($var.$contarayuda)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $contar++;
    $contarayuda++;
  }
  $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '=SUM('.$datosw.'19:'.$datosw.($contar-1).')');
  $objPHPExcel->getActiveSheet()->setCellValue($var.$contarayuda, '=SUM('.$datosw.'2019:'.$datosw.($contarayuda-1).')');
  $objPHPExcel->getActiveSheet()->getStyle($var.$contar)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
  $objPHPExcel->getActiveSheet()->getStyle($var.$contarayuda)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

  $centrarf = $var.$contar;
  $objPHPExcel->getActiveSheet()->getStyle($centrar.':'.$centrarf)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet();

  $condu = "Fuente: Encuesta aplicada";
  $objPHPExcel->getActiveSheet()->getStyle($datoss.($contar+1).":".$datoss.($contar+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($datoss.($contar+1),$condu);
  
  $condu = "'Tabulacion por item'";
  $condu1 = "Elaboración: Propia";
  $objPHPExcel->getActiveSheet()->getStyle($datoss.($contar+2).":".$datoss.($contar+2))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($datoss.($contar+2),$condu1);
  
  $objPHPExcel->getActiveSheet()->getStyle($datoss.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle($datoss.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $campo = "'Por Valoracion (3) Dimension'";

  $labels = array(
    new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$B$1', null, 1),
  );
  $categories = array(
    new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$'.$datoss.'$19:$'.$datoss.'$'.$numeross.'', null, 6),   
  );
  $values = array(
    new PHPExcel_Chart_DataSeriesValues('Number', $campo.'!$'.$datosw.'$19:$'.$datosw.'$'.$numeross.'', null, 4),
  );
  $series = new PHPExcel_Chart_DataSeries(
      PHPExcel_Chart_DataSeries::TYPE_BARCHART_3D,     // plotType
      PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
      array(0),                                     // plotOrder
      $labels,                                        // plotLabel
      $categories,                                    // plotCategory
      $values                                         // plotValues
    );  

  $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
    $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 

    $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
    $title    = new PHPExcel_Chart_Title('');  
    $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
    $xTitle   = new PHPExcel_Chart_Title('');
    $yTitle   = new PHPExcel_Chart_Title('');
    $chart    = new PHPExcel_Chart(
      'chart1',                                       // name
      $title,                                         // title
      $legend,                                        // legend 
      $plotarea,                                      // plotArea
      true,                                           // plotVisibleOnly
      0,                                              // displayBlanksAs
      $xTitle,                                        // xAxisLabel
      $yTitle                                         // yAxisLabel
    );                       
    $chart->setTopLeftPosition($datoss.'26');
    $chart->setBottomRightPosition(($this->generar_letra($datoss,5)).'42');
    $objPHPExcel->getActiveSheet()->addChart($chart);
    
    if($i<$enviados["numero_indicador0"][0]){
      $objPHPExcel->getActiveSheet()->setCellValue($datoss."43",'Figura.'.($i+1));
      $objPHPExcel->getActiveSheet()->getStyle($datoss."44:".$datoss."44")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($datoss."44",$enviados["nombre_indicador"][$i]);
    }else{
     $objPHPExcel->getActiveSheet()->setCellValue($datoss."43",'Figura.'.($i+1));
     $objPHPExcel->getActiveSheet()->getStyle($datoss."44:".$datoss."44")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
     $objPHPExcel->getActiveSheet()->setCellValue($datoss."44",$enviados["nombre_indicador"][0]);
   }
   $objPHPExcel->getActiveSheet()->getStyle($datoss."43:".$datosr."43")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
//ffffff
   $objPHPExcel->getActiveSheet()->setCellValue($nuevom."901","Variable");
   $objPHPExcel->getActiveSheet()->getStyle($nuevom."901:".$nuevom."901")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevom."2101","Variable");
   $objPHPExcel->getActiveSheet()->getStyle($nuevom."2101:".$nuevom."2101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


   $objPHPExcel->getActiveSheet()->setCellValue($nuevop."901","Unidades de Medida");
   $objPHPExcel->getActiveSheet()->getStyle($nuevop."901:".$nuevop."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevop."2101","Unidades de Medida");
   $objPHPExcel->getActiveSheet()->getStyle($nuevop."2101:".$nuevop."2102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


   $objPHPExcel->getActiveSheet()->setCellValue($nuevop."902",$letramuestra);
   $objPHPExcel->getActiveSheet()->getStyle($nuevop."902:".$nuevop."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevop."2102",$letramuestra);
   $objPHPExcel->getActiveSheet()->getStyle($nuevop."2102:".$nuevop."2102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


   $objPHPExcel->getActiveSheet()->setCellValue($nuevom."902","Dimensión");
   $objPHPExcel->getActiveSheet()->getStyle($nuevom."902:".$nuevom."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevom."2102","Dimensión");
   $objPHPExcel->getActiveSheet()->getStyle($nuevom."2102:".$nuevom."2102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevon."902","=(".$nuevop."5)");
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."902:".$nuevon."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevon."2102","=(".$nuevop."5)");
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."2102:".$nuevon."2102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevon."901","=(".$nuevop."4)");
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."901:".$nuevon."901")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevon."2101","=(".$nuevop."4)");
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."2101:".$nuevon."2101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevom."904","Valoración de la variable");
   $objPHPExcel->getActiveSheet()->getStyle($nuevom."904:".$nuevom."904")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevom."2104","Valoración de la variable");
   $objPHPExcel->getActiveSheet()->getStyle($nuevom."2104:".$nuevom."2104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $formula = '=MAX('.$nuevou.'19:'.$nuevou.(18+$enviados["escala"]).')';
   $objPHPExcel->getActiveSheet()->setCellValue($nuevon."904",$formula);
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."904:".$nuevon."904")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."904")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

   $objPHPExcel->getActiveSheet()->setCellValue($nuevon."2104",$formula);
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."2104:".$nuevon."2104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->getStyle($nuevon."2104")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

   $formula = '=IF('.$nuevon.'904='.$nuevou.'19,'.$nuevoq.'19,IF('.$nuevon.'904='.$nuevou.'20,'.$nuevoq.'20,IF('.$nuevon.'904='.$nuevou.'21,'.$nuevoq.'21,"algo esta mal")))';
   $formula = '=IF('.$nuevon.'2104='.$nuevou.'19,'.$nuevoq.'19,IF('.$nuevon.'2104='.$nuevou.'20,'.$nuevoq.'20,IF('.$nuevon.'2104='.$nuevou.'21,'.$nuevoq.'21,"algo esta mal")))';
   $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."904",$formula);
   $objPHPExcel->getActiveSheet()->getStyle($nuevoo."904:".$nuevoo."904")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."2104",$formula);
   $objPHPExcel->getActiveSheet()->getStyle($nuevoo."2104:".$nuevoo."2104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


    ////////////////////////
   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1100",'1');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1100:".$nuevov."1100")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1100",'valoró');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1100:".$nuevow."1100")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1101",'2');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1101:".$nuevov."1101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1101",'calificó');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1101:".$nuevow."1101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1102",'3');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1102:".$nuevov."1102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1102",'consideró');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1102:".$nuevow."1102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1103",'4');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1103:".$nuevov."1103")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1103",'respondió');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1103:".$nuevow."1103")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1104",'5');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1104:".$nuevov."1104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1104",'evaluó');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1104:".$nuevow."1104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1105",'6');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1105:".$nuevov."1105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1105",'determinó');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1105:".$nuevow."1105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1106",'7');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1106:".$nuevov."1106")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1106",'mencionó');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1106:".$nuevow."1106")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1107",'8');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1107:".$nuevov."1107")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1107",'apreció');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1107:".$nuevow."1107")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1108",'9');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1108:".$nuevov."1108")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1108",'percibió');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1108:".$nuevow."1108")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1109",'10');
   $objPHPExcel->getActiveSheet()->getStyle($nuevov."1109:".$nuevov."1109")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1109",'Tuvo una percepción de');
   $objPHPExcel->getActiveSheet()->getStyle($nuevow."1109:".$nuevow."1109")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   if($i != $enviados["numero_indicador0"][0]){
    $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."905","Preguntas Originales");
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo."905:".$nuevoo."905")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevop."905","Enunciados Para Palafraseo");
    $objPHPExcel->getActiveSheet()->getStyle($nuevop."905:".$nuevop."905")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."1015","Enunciados Para Palafraseo");
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo."1015:".$nuevoo."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevop."1015",'=CONCATENATE('.$nuevoq.'905," y ",'.$nuevor.'905)');
    $objPHPExcel->getActiveSheet()->getStyle($nuevop."1015:".$nuevop."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoq."1015",'=('.$nuevos.'905)');
    $objPHPExcel->getActiveSheet()->getStyle($nuevoq."1015:".$nuevoq."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevor."1015",'=CONCATENATE('.$nuevot.'905," y ",'.$nuevou.'905)');
    $objPHPExcel->getActiveSheet()->getStyle($nuevor."1015:".$nuevor."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevos."1015",'MÁXIMO');
    $objPHPExcel->getActiveSheet()->getStyle($nuevos."1015:".$nuevos."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevot."1015",'Valores');
    $objPHPExcel->getActiveSheet()->getStyle($nuevot."1015:".$nuevot."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevou."1015",'codificación de verbos aleatorios para concatenar');
    $objPHPExcel->getActiveSheet()->getStyle($nuevou."1015:".$nuevou."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1015",'verbo');
    $objPHPExcel->getActiveSheet()->getStyle($nuevov."1015:".$nuevov."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1015",'Concatenación');
    $objPHPExcel->getActiveSheet()->getStyle($nuevow."1015:".$nuevow."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

/////
    $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."2105","Preguntas Originales");
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo."2105:".$nuevoo."2105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevop."2105","Enunciados Para Palafraseo");
    $objPHPExcel->getActiveSheet()->getStyle($nuevop."2105:".$nuevop."2105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."2205","Enunciados Para Palafraseo");
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo."2205:".$nuevoo."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevop."2205",'=CONCATENATE('.$nuevoq.'2105," y ",'.$nuevor.'2105)');
    $objPHPExcel->getActiveSheet()->getStyle($nuevop."2205:".$nuevop."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoq."2205",'=('.$nuevos.'2105)');
    $objPHPExcel->getActiveSheet()->getStyle($nuevoq."2205:".$nuevoq."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevor."2205",'=CONCATENATE('.$nuevot.'2105," y ",'.$nuevou.'2105)');
    $objPHPExcel->getActiveSheet()->getStyle($nuevor."2205:".$nuevor."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevos."2205",'MÁXIMO');
    $objPHPExcel->getActiveSheet()->getStyle($nuevos."2205:".$nuevos."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevot."2205",'Valores');
    $objPHPExcel->getActiveSheet()->getStyle($nuevot."2205:".$nuevot."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevou."2205",'codificación de verbos aleatorios para concatenar');
    $objPHPExcel->getActiveSheet()->getStyle($nuevou."2205:".$nuevou."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevov."2205",'verbo');
    $objPHPExcel->getActiveSheet()->getStyle($nuevov."2205:".$nuevov."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($nuevow."2205",'Concatenación');
    $objPHPExcel->getActiveSheet()->getStyle($nuevow."2205:".$nuevow."2205")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $mencion[$i] = $nuevov;
    


    $iniciar = $nuevoq; 

    for ($k=0; $k <$enviados["respuesta"]; $k++) { 
      $objPHPExcel->getActiveSheet()->setCellValue($iniciar."905",$enviados["nombre_respuesta"][$k]);
      $objPHPExcel->getActiveSheet()->getStyle($iniciar."905:".$iniciar."905")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($iniciar."2105",$enviados["nombre_respuesta"][$k]);
      $objPHPExcel->getActiveSheet()->getStyle($iniciar."2105:".$iniciar."2105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $iniciar++;
    }
    $band = 906;
    $iniciadorb = 906;
    $band1 = 1016;
    for ($k=0; $k < $enviados["numero_pregunta0"][$i] ; $k++) { 
      $coninicio = $enviados['muestra'] +10 + $enviados['respuesta'] +2;
      $nnuevo = $nuevoq;
      $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.$band,$enviados["nombre_pregunta"][$aux]);
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band.":".$nuevoo.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevop.$band,$enviados["nombre_conca"][$aux]);
      $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band.":".$nuevop.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      for ($m=0; $m < $enviados["respuesta"] ; $m++){
        $formula = $condu = "=('".$nombrepagina1."'!".$linicia.$coninicio.")"; 
        $objPHPExcel->getActiveSheet()->setCellValue($nnuevo.$band,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band.":".$nuevop.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $nnuevo++;
        $coninicio++;
      }
      $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.$band1,'=('.$nuevop.$band.')');
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band1.":".$nuevoo.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $formula = '=SUM('.$nuevoq.$band.':'.$nuevor.$band.')';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevop.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1.":".$nuevop.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

      $formula = '=('.$nuevos.$band.')';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevoq.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1.":".$nuevoq.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

      $formula = '=SUM('.$nuevot.$band.':'.$nuevou.$band.')';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevor.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1.":".$nuevor.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


      $formula = '=MAX('.$nuevop.$band1.':'.$nuevor.$band1.')';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevos.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1.":".$nuevos.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


      $formula = '=IF('.$nuevos.$band1.'='.$nuevop.$band1.',$'.$nuevop.'$1015,IF('.$nuevos.$band1.'='.$nuevoq.$band1.',$'.$nuevoq.'$1015,IF('.$nuevos.$band1.'='.$nuevor.$band1.',$'.$nuevor.'$1015,"ALGO ESTA MAL")))';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevot.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevot.$band1.":".$nuevot.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $formula = '=RANDBETWEEN(1,10)';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevou.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevou.$band1.":".$nuevou.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $formula = '=IF('.$nuevou.$band1.'=$'.$nuevov.'$1100,$'.$nuevow.'$1100,IF('.$nuevou.$band1.'=$'.$nuevov.'$1101,$'.$nuevow.'$1101,IF('.$nuevou.$band1.'=$'.$nuevov.'$1102,$'.$nuevow.'$1102,IF('.$nuevou.$band1.'=$'.$nuevov.'$1103,$'.$nuevow.'$1103,IF('.$nuevou.$band1.'=$'.$nuevov.'$1104,$'.$nuevow.'$1104,IF('.$nuevou.$band1.'=$'.$nuevov.'$1105,$'.$nuevow.'$1105,IF('.$nuevou.$band1.'=$'.$nuevov.'$1106,$'.$nuevow.'$1106,IF('.$nuevou.$band1.'=$'.$nuevov.'$1107,$'.$nuevow.'$1107,IF('.$nuevou.$band1.'=$'.$nuevov.'$1108,$'.$nuevow.'$1108,IF('.$nuevou.$band1.'=$'.$nuevov.'$1109,$'.$nuevow.'$1109,"algo esta mal"))))))))))';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevov.$band1,$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevov.$band1.":".$nuevov.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      if($k ==0 || $k == 2){
        $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% ",'.$nuevov.$band1.'," como ",'.$nuevot.$band1.' )';
        $ayuda = 0;
      }else{
        if ($ayuda == 2 || $k == 1 || $k == 3) {
         $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% de los ",'.$nuevov.$band1.'," como ",'.$nuevot.$band1.')';     
         $ayuda =0;     
       }else{
        $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% ",'.$nuevov.$band1.'," como ",'.$nuevot.$band1.')';
        $ayuda++;
      }
    }
    $objPHPExcel->getActiveSheet()->setCellValue($nuevow.$band1,$formula);
    $objPHPExcel->getActiveSheet()->getStyle($nuevow.$band1.":".$nuevow.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $band++;
    $band1++;
    $aux++;
    $linicia++;
    $iniciadorb++;

    $formula2 =$nuevow.'1016," ",'.$nuevoo."1016".',",","asi mismo "';
    $add = 0;
    $paren ='';
    $band3 = '1017';
    for ($n=0; $n <= ($enviados["numero_pregunta0"][$i] -3) ; $n++) {
      $round =mt_rand(0,12);
      if ($add  < 1 && $n ==($enviados["numero_pregunta0"][$i] -3) ) {
        $formula2 = $formula2.','.$nuevow.$band3.'," ",'.$nuevoo.$band3.', ", "';
        $add++;
      }else{
        $formula2 = $formula2.','.$nuevow.$band3.'," ",'.$nuevoo.$band3.',", '.$conectoresoracion[$round].' "';
        $add =0;
      } 
      $band3++;
    }

    $formula2 = $formula2. ',"y ",'.$nuevoo.$band3.'," ",'.$nuevow.$band3.',"';

    $formula ='=CONCATENATE("en la ",'.$nuevoq."15".'," y ",'.$nuevoq."43".'," se puede observar que la variable ",'.$nuevon."901".'," en base a su dimensión ",'.$nuevon."902".'," tiene una calificación de ",'.$nuevoo."904".'," por el ",ROUND('.$nuevon."904".'*100,0),"% ","de los resultados, ","los cuales fueron extraídos  de las encuestas ejecutadas a los ",'.$nuevop."902".',", estos resultados son afectados debido a que, ",'.$formula2.', ","por todo ello la dimensión ",'.$nuevon."902".'," es ",'.$nuevoo."904".',".")';

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.'47',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo."47:".$nuevoo."47")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->mergeCells($nuevoo."47:".$nuevot."53");
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47:'.$nuevoo.'47')->getAlignment()->setWrapText(true);
    $valoresdimensionres[$i] = "'Por Valoracion (3) Dimension'!".$nuevoo.'47';
  }

}else{
  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1110",'1');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1110:".$nuevov."1110")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1110",'asi mismo');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1110:".$nuevow."1110")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1111",'2');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1111:".$nuevov."1111")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1111",'por otro lado ');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1111:".$nuevow."1111")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1112",'3');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1112:".$nuevov."1112")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1112",'por otra parte ');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1112:".$nuevow."1112")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1113",'4');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1113:".$nuevov."1113")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1113",'ademas ');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1113:".$nuevow."1113")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1114",'5');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1114:".$nuevov."1114")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1114",'en consecuencia ');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1114:".$nuevow."1114")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1115",'6');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1115:".$nuevov."1115")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1115",'adicional a ello ');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1115:".$nuevow."1115")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1116",'7');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1116:".$nuevov."1116")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1116",'por consecuencia ');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1116:".$nuevow."1116")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1120",'1');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1120:".$nuevov."1120")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1120",'=('.$nuevop."902".')');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1120:".$nuevow."1120")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1121",'2');
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1121:".$nuevov."1121")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1121",'Resultados');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1121:".$nuevow."1121")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');



  $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."1015","dimensión");
  $objPHPExcel->getActiveSheet()->getStyle($nuevoo."1015:".$nuevoo."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevos."1015",'MÁXIMO');
  $objPHPExcel->getActiveSheet()->getStyle($nuevos."1015:".$nuevos."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevot."1015",'Valor');
  $objPHPExcel->getActiveSheet()->getStyle($nuevot."1015:".$nuevot."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevou."1015",'codificación de verbos');
  $objPHPExcel->getActiveSheet()->getStyle($nuevou."1015:".$nuevou."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1015",'Verbo'); 
  $objPHPExcel->getActiveSheet()->getStyle($nuevov."1015:".$nuevov."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1015",'codificación de conectores');
  $objPHPExcel->getActiveSheet()->getStyle($nuevow."1015:".$nuevow."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $exc = $nuevow;
  $exc++;
  $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Conectores');
  $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $exc ++;
  $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de unidades de medida');
  $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $exc ++;
  $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Unidades de medida ');
  $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

  $exc ++;
  $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Concatenación');
  $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');





  $iniciar = $nuevop;
  for ($k=0; $k <$enviados["escala"]; $k++) { 
    $objPHPExcel->getActiveSheet()->setCellValue($iniciar."1015",$enviados["nombre_escala"][$k]);
    $objPHPExcel->getActiveSheet()->getStyle($iniciar."1015:".$iniciar."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $iniciar++;
  }
  $band1 = 1016;

  for ($k=0; $k <$enviados["numero_indicador0"][0]; $k++) { 
    $formula = '=('.$nuevaarq[$k]."16".')';

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band1.":".$nuevoo.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($nuevop.$band1,'=('.$nuevaaru[$k]."19".')');
    $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1.":".$nuevop.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($nuevoq.$band1,'=('.$nuevaaru[$k]."20".')');
    $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1.":".$nuevop.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($nuevor.$band1,'=('.$nuevaaru[$k]."21".')');
    $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1.":".$nuevor.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $formula = '=MAX('.$nuevop.$band1.':'.$nuevor.$band1.')';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevos.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1.":".$nuevos.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $formula = '=IF('.$nuevos.$band1.'='.$nuevop.$band1.',$'.$nuevop.'$1015,IF('.$nuevos.$band1.'='.$nuevoq.$band1.',$'.$nuevoq.'$1015,IF('.$nuevos.$band1.'='.$nuevor.$band1.',$'.$nuevor.'$1015,"algo esta mal")))';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevot.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevot.$band1.":".$nuevot.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '= RANDBETWEEN(1,10)';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevou.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevou.$band1.":".$nuevou.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '= RANDBETWEEN(1,7)';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevow.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevow.$band1.":".$nuevow.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $nuevox =$nuevow;
    $nuevox++;
    $nuevoy = $nuevox;
    $nuevoy++;
    $nuevoz = $nuevoy;
    $nuevoz++;
    $nuevoaa = $nuevoz;
    $nuevoaa++;
    $formula = '=IF('.$nuevou.$band1.'=$'.$nuevov.'$1100,$'.$nuevow.'$1100,IF('.$nuevou.$band1.'=$'.$nuevov.'$1101,$'.$nuevow.'$1101,IF('.$nuevou.$band1.'=$'.$nuevov.'$1102,$'.$nuevow.'$1102,IF('.$nuevou.$band1.'=$'.$nuevov.'$1103,$'.$nuevow.'$1103,IF('.$nuevou.$band1.'=$'.$nuevov.'$1104,$'.$nuevow.'$1104,IF('.$nuevou.$band1.'=$'.$nuevov.'$1105,$'.$nuevow.'$1105,IF('.$nuevou.$band1.'=$'.$nuevov.'$1106,$'.$nuevow.'$1106,IF('.$nuevou.$band1.'=$'.$nuevov.'$1107,$'.$nuevow.'$1107,IF('.$nuevou.$band1.'=$'.$nuevov.'$1108,$'.$nuevow.'$1108,IF('.$nuevou.$band1.'=$'.$nuevov.'$1109,$'.$nuevow.'$1109,"algo esta mal"))))))))))';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevov.$band1,$formula);
    $objPHPExcel->getActiveSheet()->getStyle($nuevov.$band1.":".$nuevov.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '=IF('.$nuevow.$band1.'=$'.$nuevov.'$1110,$'.$nuevow.'$1110,IF('.$nuevow.$band1.'=$'.$nuevov.'$1111,$'.$nuevow.'$1111,IF('.$nuevow.$band1.'=$'.$nuevov.'$1112,$'.$nuevow.'$1112,IF('.$nuevow.$band1.'=$'.$nuevov.'$1113,$'.$nuevow.'$1113,IF('.$nuevow.$band1.'=$'.$nuevov.'$1114,$'.$nuevow.'$1114,IF('.$nuevow.$band1.'=$'.$nuevov.'$1115,$'.$nuevow.'$1115,IF('.$nuevow.$band1.'=$'.$nuevov.'$1116,$'.$nuevow.'$1116,IF('.$nuevow.$band1.'=$'.$nuevov.'$1047,$'.$nuevow.'$1047,IF('.$nuevow.$band1.'=$'.$nuevov.'$1048,$'.$nuevow.'$1048,IF('.$nuevow.$band1.'=$'.$nuevov.'$1049,$'.$nuevow.'$1049,"algo esta mal"))))))))))';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevox.$band1,$formula);
    $objPHPExcel->getActiveSheet()->getStyle($nuevox.$band1.":".$nuevox.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '=IF('.$nuevoy.$band1.'=$'.$nuevov.'$1120,$'.$nuevow.'$1120,IF('.$nuevoy.$band1.'=$'.$nuevov.'$1121,$'.$nuevow.'$1121,"algo esta mal"))';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevoz.$band1,$formula);
    $objPHPExcel->getActiveSheet()->getStyle($nuevoz.$band1.":".$nuevoz.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '= RANDBETWEEN(1,2)';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevoy.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevoy.$band1.":".$nuevoy.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% de los ",'.$nuevoz.$band1.'," ",'.$nuevov.$band1.'," a la dimensión ",'.$nuevoo.$band1.'," como ",'.$nuevot.$band1.',", ",'.$nuevox.$band1.')';
    $objPHPExcel->getActiveSheet()->setCellValue($nuevoaa.$band1,$formula );
    $objPHPExcel->getActiveSheet()->getStyle($nuevoaa.$band1.":".$nuevoaa.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $band1++;

  }


  $formula = '=CONCATENATE("En la ",'.$nuevoq."15".'," y ",'.$nuevoq."43".'," se puede evidenciar que la variable ",'.$nuevon."901".'," es calificado como ",'.$nuevoo."904".'," por el ",ROUND('.$nuevon."904".'*100,0),"% de los resultados, mismos que son originados porque; ",'.$nuevoaa."1016".'," ",'.$nuevoaa."1017".'," ",'.$nuevoaa."1018".','.$nuevoaa."1019".','.$nuevoaa."1020".','.$nuevoaa."1021".','.$nuevoaa."1022".','.$nuevoaa."1023".','.$nuevoaa."1024".','.$nuevoaa."1025".','.$nuevoaa."1026".'," se concluye que la variable ",'.$nuevon."901".',"tiene un valor de ",'.$nuevoo."904".',".")';
  $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.'47',$formula);
  $objPHPExcel->getActiveSheet()->getStyle($nuevoo."47:".$nuevoo."47")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->mergeCells($nuevoo."47:".$nuevot."53");
  $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47:'.$nuevoo.'47')->getAlignment()->setWrapText(true);
  $valoresdimensionres[$i] = "'Por Valoracion (3) Dimension'!".$nuevoo.'47';
}

$valord = '1046';
$valori = 8;


$bordeinicio = $this->generar_letra($bordefinal,2);
}
if ($enviados["resitem"] == 'Pregunta') {
  $concate =  ' de la ';
}else{
  $concate = ' del ';
}
//// FIN SEGUNDA HOJA
$nueva_hoja = $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2); // marcar como activa la nueva hoja
$nueva_hoja->setTitle('Tabulacion por item'); // definimos el titulo

$iniciador1 = 'C';
$bordeinicio ='B';
$paginainicio2 = 'B';
$paginainicio3 = 'C';
$paginainicio31 = 'E';
$letrainicio = 'D';
$letrainicio1 = 'F';
$valorconcaitem = array();
for ($i=0; $i < $enviados["item"]; $i++) {
  $totalpagina1 = $enviados['muestra']+11;
  $totalpagina1x = $enviados['muestra'] + 1000;
  $totalpagina2 =  $enviados['muestra'] +10 + $enviados['respuesta'] +2;
  $totalpagina2x = $enviados['muestra'] + 1000+$enviados['respuesta']+1;
  $bordeestilo = $this->generar_letra($bordeinicio,2);
  for ($j=0; $j < 3 ; $j++) { 
    $objPHPExcel->getActiveSheet()->getColumnDimension($bordeestilo)->setWidth('26'); 
    $bordeestilo = $this->generar_letra($bordeestilo,1);   
  }
  $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7:".$paginainicio31."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($paginainicio31."7",'Frec.');
  $datose = $paginainicio31;

  $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7:".$letrainicio1."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($letrainicio1."7",'%');
  $datosf = $letrainicio1; 

  $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $contador = 5;
  $variables = $this->generar_letra($bordeinicio,2);
  $variables2 = $this->generar_letra($bordeinicio,3);
  $bordefinal =$this->generar_letra($bordeinicio,6);
  if ($i<$enviados["item"]) {
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordefinal.'3');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordeinicio.'39');  
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordefinal.'3:'.$bordefinal.'39');  

  }else{
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordefinal.'3');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordeinicio.'39');  
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordefinal.'3:'.$bordefinal.'39');
  }

  $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $variables."4:".$variables."4");
  $objPHPExcel->getActiveSheet()->getStyle($variables."4:".($this->generar_letra($variables,2))."4")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables.'4',$enviados["resitem"].' '.($i+1) );
  $objPHPExcel->getActiveSheet()->mergeCells($variables."4:".($this->generar_letra($variables,2))."4");
  $objPHPExcel->getActiveSheet()->getStyle($variables."4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $objPHPExcel->getActiveSheet()->getStyle($variables.$contador.":".$variables.$contador)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),'Tabla '.($i+1));
  $datosd = $variables;
  $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+1).":".$variables.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),$enviados["nombre_pregunta"][$i]);
  $cnuevo = 8;
  $cnuevox = 8+2000;
  $paginainicio = 'A';

  for ($j=0; $j <= $enviados["respuesta"] ; $j++) {
    $condu = "=('".$nombrepagina1."'!".$paginainicio.$totalpagina1.")";
    $condux = "=('".$nombrepagina1."'!".$paginainicio.$totalpagina1x.")";
    $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo.":".$variables.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables.$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

    $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevox.":".$variables.$cnuevox)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables.$cnuevox,$condux);
    $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevox)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);


    $condu = "=('".$nombrepagina1."'!".$paginainicio2.$totalpagina1.")";
    $condux = "=('".$nombrepagina1."'!".$paginainicio2.$totalpagina1x.")";
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo.":".($this->generar_letra($variables,1)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevox.":".($this->generar_letra($variables,1)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevox,$condux);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevox)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);




    $condu = "=('".$nombrepagina1."'!".$paginainicio2.$totalpagina2.")";
    $condux = "=('".$nombrepagina1."'!".$paginainicio2.$totalpagina2x.")";
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevox,$condux);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


    $letraband = ($this->generar_letra($variables,2));
    $to = $totalpagina2 -$enviados["respuesta"]-1;
    $valoresentreitem[$i][$j] = "'x'!".$paginainicio2.$to;
    if($j == $enviados["respuesta"] ){
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle1);

      $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle1);
    }
    $cnuevo++;
    $cnuevox++;
    $totalpagina1++;
    $totalpagina2++;
    $totalpagina1x++;
    $totalpagina2x++;
  }

  $numeross = $cnuevo-2;
  $condu = "Elaboración: Propia";
  $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
  $condu = "Fuente: Encuesta aplicada";
  $cnuevo++;
  $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
  $campo = "'Tabulacion por item'";
  $labels = array(
    new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$B$1', null, 1),
  );
  $categories = array(
    new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$'.$letrainicio.'$8:$'.$letrainicio.'$'.$numeross.'', null, 6),   
  );
  $values = array(
    new PHPExcel_Chart_DataSeriesValues('Number', $campo.'!$'.($this->generar_letra($letrainicio,2)).'$8:$'.($this->generar_letra($letrainicio,2)).'$'.$numeross.'', null, 4),
  );
  $series = new PHPExcel_Chart_DataSeries(
      PHPExcel_Chart_DataSeries::TYPE_BARCHART_3D,     // plotType
      PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
      array(0),                                     // plotOrder
      $labels,                                        // plotLabel
      $categories,                                    // plotCategory
      $values                                         // plotValues
    );  

  $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
    $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 

    $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
    $title    = new PHPExcel_Chart_Title('');  
    $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
    $xTitle   = new PHPExcel_Chart_Title('');
    $yTitle   = new PHPExcel_Chart_Title('');
    $chart    = new PHPExcel_Chart(
      'chart1',                                       // name
      $title,                                         // title
      $legend,                                        // legend 
      $plotarea,                                      // plotArea
      true,                                           // plotVisibleOnly
      0,                                              // displayBlanksAs
      $xTitle,                                        // xAxisLabel
      $yTitle                                         // yAxisLabel
    );                      
    $chart->setTopLeftPosition($letrainicio.'18');
    $chart->setBottomRightPosition(($this->generar_letra($letrainicio,3)).'32');
    $objPHPExcel->getActiveSheet()->addChart($chart);
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."33:".$letrainicio."33")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."33",'Figura. '.($i+1));
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."34:".$letrainicio."34")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."34",$enviados["nombre_pregunta"][$i]);


    $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."1045",$letramuestra);
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."1045:".$letrainicio."1045")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->setCellValue($this->generar_letra($letrainicio,1)."1045",$enviados["nombre_conca"][$i]);
    $objPHPExcel->getActiveSheet()->getStyle($this->generar_letra($letrainicio,1)."1045:".$this->generar_letra($letrainicio,1)."1045")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $valord = '1046';
    $valord1 = '2046';
    $valori = 8;

    for ($k=0; $k < $enviados["respuesta"] ; $k++) { 
      $objPHPExcel->getActiveSheet()->setCellValue($iniciador1.$valord,($k+1));
      $objPHPExcel->getActiveSheet()->getStyle($iniciador1.$valord.":".$iniciador1.$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $formula = '=IF('.$datose.$valord.'='.$datosf.'8,'.$datosd.'8,IF('.$datose.$valord.'='.$datosf.'9,'.$datosd.'9,IF('.$datose.$valord.'='.$datosf.'10,'.$datosd.'10,IF('.$datose.$valord.'='.$datosf.'11,'.$datosd.'11,IF('.$datose.$valord.'='.$datosf.'12,'.$datosd.'12,"ALGO ESTA MAL")))))';

      $formula1 = '=IF('.$datose.$valord1.'='.$datosf.'2008,'.$datosd.'2008,IF('.$datose.$valord1.'='.$datosf.'2009,'.$datosd.'2009,IF('.$datose.$valord1.'='.$datosf.'2010,'.$datosd.'2010,IF('.$datose.$valord1.'='.$datosf.'2011,'.$datosd.'2011,IF('.$datose.$valord1.'='.$datosf.'2012,'.$datosd.'2012,"ALGO ESTA MAL")))))';

      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,1)).$valord,$formula);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,1)).$valord.":".($this->generar_letra($iniciador1,1)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,1)).$valord1,$formula1);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,1)).$valord1.":".($this->generar_letra($iniciador1,1)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

      $formula = '=LARGE($'.$datosf.'$8:$'.$datosf.'$'.(7+$enviados["respuesta"]).','.$iniciador1.$valord.')';
      $formula1 = '=LARGE($'.$datosf.'$2008:$'.$datosf.'$'.(2007+$enviados["respuesta"]).','.$iniciador1.$valord.')';
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,2)).$valord,$formula);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,2)).$valord.":".($this->generar_letra($iniciador1,2)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,2)).$valord)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,2)).$valord1,$formula1);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,2)).$valord1.":".($this->generar_letra($iniciador1,2)).$valord1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,2)).$valord1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


      $formula = '=IF('.$datose.$valord.'>0.1%,'.$datose.$valord.',"Algo Esta Mal")';
      $formula1 = '=IF('.$datose.$valord1.'>0.1%,'.$datose.$valord1.',"Algo Esta Mal")';
   //   echo $formula;exit();
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,3)).$valord,$formula);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,3)).$valord.":".($this->generar_letra($iniciador1,3)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,3)).$valord)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,3)).$valord1,$formula1);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,3)).$valord1.":".($this->generar_letra($iniciador1,3)).$valord1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,3)).$valord1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

      
      $formula = '=IF('.$datosf.$valord.'='.$datose.$valord.','.$datosd.$valord.'," ")';
      $formula1 = '=IF('.$datosf.$valord1.'='.$datose.$valord1.','.$datosd.$valord1.'," ")';
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,4)).$valord,$formula);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,4)).$valord.":".($this->generar_letra($iniciador1,4)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,4)).$valord1,$formula1);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,4)).$valord1.":".($this->generar_letra($iniciador1,4)).$valord1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

      $datosg= ($this->generar_letra($iniciador1,4));
      $valord++; 
      $valord1++; 
    }
    $formula = '=SUM('.$datosf.'8:'.$datosf.'10)';
    $formula1 = '=SUM('.$datosf.'2008:'.$datosf.'2010)';

    $objPHPExcel->getActiveSheet()->setCellValue($datosd."1052",'Mayoria');
    $objPHPExcel->getActiveSheet()->getStyle($datosd."1052:".$datosd."1052")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->setCellValue($datosd."1053",$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datosd."1053")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet()->getStyle($datosd."1053:".$datosd."1053")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

    $objPHPExcel->getActiveSheet()->setCellValue($datosd."2052",'Mayoria');
    $objPHPExcel->getActiveSheet()->getStyle($datosd."2052:".$datosd."2052")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->setCellValue($datosd."2053",$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datosd."2053")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet()->getStyle($datosd."2053:".$datosd."2053")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');


    $formula = '=SUM('.$datosf.'10:'.$datosf.'12)';
    $formula1 = '=SUM('.$datosf.'2010:'.$datosf.'2012)';
    $objPHPExcel->getActiveSheet()->setCellValue($datosd."1054",$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datosd."1054:".$datosd."1054")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datosd."1054")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet()->setCellValue($datosd."2054",$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datosd."2054:".$datosd."2054")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datosd."2054")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $formula = '=MAX('.$datosd.'1053:'.$datosd.'1054)';
    $formula1 = '=MAX('.$datosd.'2053:'.$datosd.'2054)';
    $objPHPExcel->getActiveSheet()->setCellValue($datose."1053",$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datose."1053:".$datose."1053")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose."1053")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet()->setCellValue($datose."2053",$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datose."2053:".$datose."2053")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose."2053")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $co = 1056;
    $co1 = 1056;
    for ($k=0; $k < $enviados["escala"]; $k++) { 
      $objPHPExcel->getActiveSheet()->setCellValue($datosd.$co,$enviados["nombre_escala"][$k]);
      $objPHPExcel->getActiveSheet()->setCellValue($datosd.$co1,$enviados["nombre_escala"][$k]);
      $objPHPExcel->getActiveSheet()->getStyle($datosd.$co.":".$datosd.$co)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $objPHPExcel->getActiveSheet()->getStyle($datosd.$co.":".$datosd.$co1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
      $co++;
      $co1++;
    }
    $formula = '=SUM('.$datosf.'8:'.$datosf.'9)';
    $formula1 = '=SUM('.$datosf.'2008:'.$datosf.'2009)';
    $objPHPExcel->getActiveSheet()->setCellValue($datose.'1056',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datose."1056:".$datose."1056")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose.'1056')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $objPHPExcel->getActiveSheet()->setCellValue($datose.'2056',$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datose."2056:".$datose."2056")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose.'2056')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $formula = '=SUM('.$datosf.'10)';
    $formula1 = '=SUM('.$datosf.'2010)';
    $objPHPExcel->getActiveSheet()->setCellValue($datose.'1057',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datose."1057:".$datose."1057")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose.'1057')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($datose.'2057',$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datose."2057:".$datose."2057")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose.'2057')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


    $formula = '=SUM('.$datosf.'11:'.$datosf.'12)';
    $formula1 = '=SUM('.$datosf.'2011:'.$datosf.'2012)';
    $objPHPExcel->getActiveSheet()->setCellValue($datose.'1058',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datose."1058:".$datose."1058")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose.'1058')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $objPHPExcel->getActiveSheet()->setCellValue($datose.'2058',$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datose."2058:".$datose."2058")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->getStyle($datose.'2058')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $formula = '=IF('.$datose.'1056>=51%,'.$datosd.'1056,IF('.$datose.'1057>=51%,'.$datosd.'1057,IF('.$datose.'1058>=51%,'.$datosd.'1058,IF(SUM('.$datose.'1056:'.$datose.'1057)>SUM('.$datose.'1057:'.$datose.'1058),'.$datosd.'1056,IF(SUM('.$datose.'1056:'.$datose.'1057)<SUM('.$datose.'1057:'.$datose.'1058),'.$datosd.'1058,"Algo esta Mal")))))';
    $formula1 = '=IF('.$datose.'2056>=51%,'.$datosd.'2056,IF('.$datose.'2057>=51%,'.$datosd.'2057,IF('.$datose.'2058>=51%,'.$datosd.'2058,IF(SUM('.$datose.'2056:'.$datose.'2057)>SUM('.$datose.'2057:'.$datose.'2058),'.$datosd.'2056,IF(SUM('.$datose.'2056:'.$datose.'2057)<SUM('.$datose.'2057:'.$datose.'2058),'.$datosd.'2058,"Algo esta Mal")))))';

    $objPHPExcel->getActiveSheet()->setCellValue($datose.'1060',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datose."1060:".$datose."1060")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->setCellValue($datose.'1062',$enviados["nombre_conca"][$i]);
    $objPHPExcel->getActiveSheet()->getStyle($datose.'1062:'.$datose.'1062')->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

    $objPHPExcel->getActiveSheet()->setCellValue($datose.'2060',$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datose."2060:".$datose."2060")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
    $objPHPExcel->getActiveSheet()->setCellValue($datose.'2062',$enviados["nombre_conca"][$i]);
    $objPHPExcel->getActiveSheet()->getStyle($datose.'2062:'.$datose.'2062')->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

    $formula = '=CONCATENATE("En ","la ",'.$datosd.'5," y ",'.$datosd.'33," se observa los resultados '.$concate.' ",'.$datosd.'4," el cual aborda ",'.$datose.'1062,",en donde se demuestra que el ",ROUND('.$datosf.'8*100,0),"%"," de los ",'.$datosd.'1045," tienen una percepción de ",'.$datosg.'1046,", el ",ROUND('.$datosf.'9*100,0),"%"," ",'.$datosg.'1047,", un ",ROUND('.$datosf.'10*100,0),"%"," ",'.$datosg.'1048,",",IF('.$datose.'1049>0,CONCATENATE(" ademas el ",ROUND('.$datosf.'11*100,0),"%"," ",'.$datosg.'1049,)," "),IF('.$datose.'1049>0,CONCATENATE(" y ",ROUND('.$datosf.'12*100,0),"%",", ",'.$datosg.'1050,)," "),"en tal sentido la mayoría de los ",'.$datosd.'1045," es decir el ",ROUND('.$datose.'1053*100,0),"%"," tienen una percepción con una inclinación a un valor ",'.$datosd.'1056,","," para ",'.$datose.'1062,".")';

    $formula1 = '=CONCATENATE("En ","la ",'.$datosd.'5," y ",'.$datosd.'33," se observa los resultados '.$concate.' ",'.$datosd.'4," el cual aborda ",'.$datose.'2062,",en donde se demuestra que el ",ROUND('.$datosf.'2008*100,0),"%"," de los ",'.$datosd.'1045," tienen una percepción de ",'.$datosg.'2046,", el ",ROUND('.$datosf.'2009*100,0),"%"," ",'.$datosg.'2047,", un ",ROUND('.$datosf.'2010*100,0),"%"," ",'.$datosg.'2048,",",IF('.$datose.'2049>0,CONCATENATE(" ademas el ",ROUND('.$datosf.'2011*100,0),"%"," ",'.$datosg.'2049,)," "),IF('.$datose.'2049>0,CONCATENATE(" y ",ROUND('.$datosf.'2012*100,0),"%",", ",'.$datosg.'2050,)," "),"en tal sentido la mayoría de los ",'.$datosd.'1045," es decir el ",ROUND('.$datose.'2053*100,0),"%"," tienen una percepción con una inclinación a un valor ",'.$datosd.'2056,","," para ",'.$datose.'2062,".")';

    $objPHPExcel->getActiveSheet()->setCellValue($datosd.'35',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($datosd."35:".$datosd."35")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->mergeCells($datosd."35:".$datosf."43");
    $objPHPExcel->getActiveSheet()->getStyle($datosd.'35')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle($datosd.'35')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($datosd.'35:'.$datosd.'35')->getAlignment()->setWrapText(true);

    $objPHPExcel->getActiveSheet()->setCellValue($datosd.'2135',$formula1);
    $objPHPExcel->getActiveSheet()->getStyle($datosd."2135:".$datosd."2135")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->mergeCells($datosd."2135:".$datosf."2143");
    $objPHPExcel->getActiveSheet()->getStyle($datosd.'2135')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle($datosd.'2135')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($datosd.'2135:'.$datosd.'2135')->getAlignment()->setWrapText(true);

    $valorconcaitem[$i] = "'Tabulacion por item'!".$datosd.'2135';
    $iniciador1= $this->generar_letra($iniciador1,9);
    $letrainicio= $this->generar_letra($letrainicio,9); 
    $paginainicio2 = $this->generar_letra($paginainicio2,1); 
    $paginainicio3 =   $this->generar_letra($paginainicio2,1); 
    $paginainicio31 =   $this->generar_letra($paginainicio31,9);
    $letrainicio1= $this->generar_letra($letrainicio1,9);
    $bordeinicio = $this->generar_letra($bordefinal,3);
  }

  $nueva_hoja = $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(3); // marcar como activa la nueva hoja
$nueva_hoja->setTitle('Por conteo Dimension'); // definimos el titulo
$bordeinicio ='B';
$paginainicio2 = 'B';
$paginainicio3 = 'C';
$paginainicio31 = 'E';
$letrainicio = 'D';
$letrainicio1 = 'F';
$valorarr = array();
$conteoarrd = array();
$aux1 = 0;
$valorconcadimension = array();
for ($i=0; $i <= $enviados["numero_indicador0"][0]; $i++) {
  $totalpagina1 = $enviados['muestra']+11;
  $totalpagina2 = $enviados['muestra']+17;
  $bordeestilo = $this->generar_letra($bordeinicio,2);
  for ($j=0; $j < 3 ; $j++) { 
    $objPHPExcel->getActiveSheet()->getColumnDimension($bordeestilo)->setWidth('26'); 
    $bordeestilo = $this->generar_letra($bordeestilo,1);   
  }

  $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7:".$paginainicio31."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($paginainicio31."7",'Frec.');
  $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $conteoe = $paginainicio31;

  $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7:".$letrainicio1."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($letrainicio1."7",'%');
  $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

  $conteof = $letrainicio1;
  $conteog = $this->generar_letra($conteof,1);

  $contador = 5;
  $variables = $this->generar_letra($bordeinicio,2);
  $variables2 = $this->generar_letra($bordeinicio,3);
  $bordefinal =$this->generar_letra($bordeinicio,6);

  if ($i<$enviados["numero_indicador0"][0]) {
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordefinal.'3');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordeinicio.'39');  
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordefinal.'3:'.$bordefinal.'39');  

  }else{
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordefinal.'3');
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordeinicio.'39');  
    $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordefinal.'3:'.$bordefinal.'39');
  }
  $conteoc = $bordeinicio;
  $conteoc++;
  $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $variables."4:".$variables."4");
  $objPHPExcel->getActiveSheet()->getStyle($variables."4:".($this->generar_letra($variables,2))."4")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12)->getColor()->setRGB('030303');
  if ($i<$enviados["numero_indicador0"][0]) {
   $objPHPExcel->getActiveSheet()->setCellValue($variables.'4',"Dimensión ".($i+1));
 }else{
  $objPHPExcel->getActiveSheet()->setCellValue($variables.'4',"Variable 1");
}

$objPHPExcel->getActiveSheet()->mergeCells($variables."4:".($this->generar_letra($variables,2))."4");
$objPHPExcel->getActiveSheet()->getStyle($variables."4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$conteod = $variables;

$objPHPExcel->getActiveSheet()->getStyle($variables.$contador.":".$variables.$contador)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
$objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),'Tabla '.($i+1));
$objPHPExcel->getActiveSheet()->getStyle($variables.($contador+1).":".$variables.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
if ($i<$enviados["numero_indicador0"][0]) {
 $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),$enviados["nombre_indicador"][$i]);
}else{
  $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),$enviados["nombre_dimension"][0]);
}
$conteoarrd[$i] = $variables;
$cnuevo = 8;
$cnuevox = 2008;
$paginainicio = 'A';
for ($j=0; $j <= $enviados["respuesta"] ; $j++) {
  $condu = "=('".$nombrepagina1."'!"."A".$totalpagina1.")";
  $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo.":".$variables.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables.$cnuevo,$condu);
  $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
  if($j<$enviados["respuesta"]){
    if ($i<$enviados["numero_indicador0"][0]) {
      $condu = "=COUNTIF('".$nombrepagina1."'!".$paginainicio2."5:".($this->generar_letra($paginainicio2,($enviados["numero_pregunta0"][$i] -1))).($enviados['muestra']+4).",".($j+1).")";
    }else{
      $condu = "=COUNTIF('".$nombrepagina1."'!"."B5:".($this->generar_letra("B",($enviados["item"]-1))).($enviados['muestra']+4).",".($j+1).")";
    }     

    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo.":".($this->generar_letra($variables,1)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevox.":".($this->generar_letra($variables,1)).$cnuevox)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');




    $condu = "=(".($this->generar_letra($variables,1)).$cnuevo."/".($this->generar_letra($variables,1)).(8+$enviados["respuesta"]).")";
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));  
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
 
  }

  if($j == $enviados["respuesta"] ){
    $condu = "=SUM(".($this->generar_letra($variables,1))."8:".($this->generar_letra($variables,1)).(7+$enviados["respuesta"]).")";
    $condu1 = "=SUM(".($this->generar_letra($variables,1))."2008:".($this->generar_letra($variables,1)).(2007+$enviados["respuesta"]).")";

    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevox.":".($this->generar_letra($variables,2)).$cnuevox)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevox,$condu1);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevox)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


    $condu = "=SUM(".($this->generar_letra($variables,2))."8:".($this->generar_letra($variables,2)).(7+$enviados["respuesta"]).")";
    $condu1 = "=SUM(".($this->generar_letra($variables,2))."2008:".($this->generar_letra($variables,2)).(2007+$enviados["respuesta"]).")";
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
     $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox.":".($this->generar_letra($variables,2)).$cnuevox)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevox,$condu1);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevox)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


    $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle);
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle1);

    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle);
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle1);
  }
  $cnuevox++;
  $cnuevo++;
  $totalpagina1++;
  $totalpagina2++;
}
$numeross = $cnuevo-2;
$condu = "Elaboración: Propia";
$objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
$objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
$condu = "Fuente: Encuesta aplicada";
$cnuevo++;
$objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
$objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
$campo = "'Por conteo Dimension'";
$labels = array(
  new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$B$1', null, 1),
);
$categories = array(
  new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$'.$letrainicio.'$8:$'.$letrainicio.'$'.$numeross.'', null, 6),   
);
$values = array(
  new PHPExcel_Chart_DataSeriesValues('Number', $campo.'!$'.($this->generar_letra($letrainicio,2)).'$8:$'.($this->generar_letra($letrainicio,2)).'$'.$numeross.'', null, 4),
);
$series = new PHPExcel_Chart_DataSeries(
      PHPExcel_Chart_DataSeries::TYPE_BARCHART_3D,     // plotType
      PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
      array(0),                                     // plotOrder
      $labels,                                        // plotLabel
      $categories,                                    // plotCategory
      $values                                         // plotValues
    );  

$series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
    $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 

    $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
    $title    = new PHPExcel_Chart_Title('');  
    $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
    $xTitle   = new PHPExcel_Chart_Title('');
    $yTitle   = new PHPExcel_Chart_Title('');
    $chart    = new PHPExcel_Chart(
      'chart1',                                       // name
      $title,                                         // title
      $legend,                                        // legend 
      $plotarea,                                      // plotArea
      true,                                           // plotVisibleOnly
      0,                                              // displayBlanksAs
      $xTitle,                                        // xAxisLabel
      $yTitle                                         // yAxisLabel
    );                      
    $chart->setTopLeftPosition($letrainicio.'18');
    $chart->setBottomRightPosition(($this->generar_letra($letrainicio,3)).'32');
    $objPHPExcel->getActiveSheet()->addChart($chart);
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."33:".$letrainicio."33")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."33",'Figura.'.($i+1));
    $objPHPExcel->getActiveSheet()->getStyle($letrainicio."34:".$letrainicio."34")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $ayuda1 = $enviados["numero_indicador0"][0] ; 
    $ayuda1 = $this->generar_letra('D',(9*$ayuda1));

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1001","Variable");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1001:".$conteod."1001")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1001","=(".$ayuda1."6)");
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1001:".$conteoe."1001")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1002","Dimensión");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1002:".$conteod."1002")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1002","=(".$conteod."6)");
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1002:".$conteoe."1002")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1003","Unidad de Medida");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1003:".$conteod."1003")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1003",$letramuestra);
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1003:".$conteoe."1003")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1004","Valores");
    $objPHPExcel->getActiveSheet()->getStyle($conteoc."1004:".$conteoc."1004")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1005","Calificación");
    $objPHPExcel->getActiveSheet()->getStyle($conteoc."1005:".$conteoc."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1007","Calificación verdadera");
    $objPHPExcel->getActiveSheet()->getStyle($conteoc."1007:".$conteoc."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."2101","Variable");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."2101:".$conteod."2101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."2101","=(".$ayuda1."6)");
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."2101:".$conteoe."2101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."2102","Dimensión");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."2102:".$conteod."2102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."2102","=(".$conteod."6)");
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."2102:".$conteoe."2102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."2103","Unidad de Medida");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."2103:".$conteod."2103")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."2103",$letramuestra);
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."2103:".$conteoe."2103")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc."2104","Valores");
    $objPHPExcel->getActiveSheet()->getStyle($conteoc."2104:".$conteoc."2104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc."2105","Calificación");
    $objPHPExcel->getActiveSheet()->getStyle($conteoc."2105:".$conteoc."2105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc."2107","Calificación verdadera");
    $objPHPExcel->getActiveSheet()->getStyle($conteoc."2107:".$conteoc."2107")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $iniciar1 = $conteod;
    for ($k=0; $k <$enviados["escala"]; $k++) { 
      $objPHPExcel->getActiveSheet()->setCellValue($iniciar1."1004",$enviados["nombre_escala"][$k]);
      $objPHPExcel->getActiveSheet()->getStyle($iniciar1."1004:".$iniciar1."1004")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($iniciar1."2104",$enviados["nombre_escala"][$k]);
      $objPHPExcel->getActiveSheet()->getStyle($iniciar1."2104:".$iniciar1."2104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $iniciar1++;
    }

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1005",'=CONCATENATE('.$conteod.'8," y ",'.$conteod.'9)');
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1005:".$conteod."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1005",'='.$conteod.'10');
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1005:".$conteoe."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($conteof."1005",'=CONCATENATE('.$conteod.'11," y ",'.$conteod.'12)');
    $objPHPExcel->getActiveSheet()->getStyle($conteof."1005:".$conteof."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1006",'=SUM('.$conteof.'8:'.$conteof.'9)');
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1006:".$conteod."1006")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1006")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1006",'='.$conteof.'10');
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1006:".$conteoe."1006")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1006")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($conteof."1006",'=SUM('.$conteof.'11:'.$conteof.'12)');
    $objPHPExcel->getActiveSheet()->getStyle($conteof."1006:".$conteof."1006")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteof."1006")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1007",'=SUM('.$conteod.'1006:'.$conteoe.'1006)');
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1007:".$conteod."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1007",'=SUM('.$conteoe.'1006:'.$conteof.'1006)');
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1007:".$conteoe."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteoe."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($conteof."1007",'=('.$conteod.'1007-'.$conteoe.'1007)');
    $objPHPExcel->getActiveSheet()->getStyle($conteof."1007:".$conteof."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteof."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $objPHPExcel->getActiveSheet()->setCellValue($conteod."1008","Valor Mayor");
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1008:".$conteod."1008")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1008",'=IF(AND('.$conteof.'1007>=-5%,'.$conteof.'1007<=5%),'.$conteoe.'1004,IF('.$conteof.'1007>=6%,'.$conteod.'1004,IF('.$conteof.'1007<=-5%,'.$conteof.'1004,'.$conteoe.'1004)))');
    $objPHPExcel->getActiveSheet()->getStyle($conteod."1008:".$conteod."1008")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


    if ($i<$enviados["numero_indicador0"][0]) {
      $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."34",$enviados["nombre_indicador"][$i]);



      $band = 1011;
      $iniciadorb = 1016;

      for ($k=0; $k < $enviados["numero_pregunta0"][$i] ; $k++) {
        $objPHPExcel->getActiveSheet()->setCellValue($conteod.$band,"='Por Valoracion (3) Dimension'!".$nuevaarw[$i].$iniciadorb."");
        $objPHPExcel->getActiveSheet()->getStyle($conteod.$band.":".$conteod.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($conteoe.$band,"='Por Valoracion (3) Dimension'!".$nuevaaro[$i].$iniciadorb."");
        $objPHPExcel->getActiveSheet()->getStyle($conteoe.$band.":".$conteoe.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $band++;
        $iniciadorb++;
      }
      $formula2 =$conteod.'1011," ",'.$conteoe."1011".',",","asi mismo "';
      $add = 0;
      $paren ='';
      $band3 = '1012';
      for ($n=0; $n <= ($enviados["numero_pregunta0"][$i] -3) ; $n++) {
        $round =mt_rand(0,12);
        if ($add  < 1 && $n ==($enviados["numero_pregunta0"][$i] -3) ) {
          $formula2 = $formula2.','.$conteod.$band3.'," ",'.$conteoe.$band3.', ", "';
          $add++;
        }else{
          $formula2 = $formula2.','.$conteod.$band3.'," ",'.$conteoe.$band3.',", '.$conectoresoracion[$round].' "';
          $add =0;
        } 
        $band3++;
      }
      $formula2 = $formula2. ',"asi mismo ",'.$conteod.$band3.'," ",'.$conteoe.$band3.',"';
      $formula = '=CONCATENATE("En la ",'.$conteod.'5," y ",'.$conteod.'33," se puede observar que la variable ",'.$conteoe.'1001," en base a su dimensión ",'.$conteoe.'1002," es calificado como ",'.$conteoe.'1008," ya que el ",ROUND('.$conteod.'1006*100,0),"% de los resultados lo califican como ",'.$conteod.'1005,", el ",ROUND('.$conteoe.'1006*100,0),"% ",'.$conteoe.'1005," y el ",ROUND('.$conteof.'1006*100,0),"% lo califico como ",'.$conteof.'1005," estos resultados son originados debido a que, ",'.$formula2.',"," por todas estas razones, es que la variable ",'.$conteoe.'1001," basado en su dimensión ",'.$conteoe.'1002," y calificado por los ",'.$conteoe.'1003," es considerado como ",'.$conteoe.'1008,".")';

      $objPHPExcel->getActiveSheet()->setCellValue($conteod.'36',$formula);
      $objPHPExcel->getActiveSheet()->getStyle($conteod."36:".$conteod."36")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->mergeCells($conteod."36:".$conteof."47");
      $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($conteod.'36:'.$nuevoo.'36')->getAlignment()->setWrapText(true);
      $valorconcadimension[$i] = "'Por conteo Dimension'!".$conteod.'36';
    }else{
      $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."34",$enviados["nombre_dimension"][0]);

      $objPHPExcel->getActiveSheet()->setCellValue($conteog."1007",'=MAX('.$conteod.'1007:'.$conteoe.'1007)');
      $objPHPExcel->getActiveSheet()->getStyle($conteog."1007:".$conteog."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->getStyle($conteog."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


    //////////////////pppp
      $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1015","dimensión");
      $objPHPExcel->getActiveSheet()->getStyle($conteoc."1015:".$conteoc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($conteod."1015",'='.$conteod.'1005');
      $objPHPExcel->getActiveSheet()->getStyle($conteod."1015:".$conteod."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1015",'='.$conteoe.'1005');
      $objPHPExcel->getActiveSheet()->getStyle($conteoe."1015:".$conteoe."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($conteof."1015",'='.$conteof.'1005');
      $objPHPExcel->getActiveSheet()->getStyle($conteof."1015:".$conteof."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


      $objPHPExcel->getActiveSheet()->setCellValue($conteog."1015",'MAYOR');
      $objPHPExcel->getActiveSheet()->getStyle($conteog."1015:".$conteog."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc = $conteog;
      $exc++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Valor');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$nuevot."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de verbos');
      $objPHPExcel->getActiveSheet()->getStyle($nuevou."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Verbo');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de conectores');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Conectores');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc ++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de unidades de medida');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc ++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Unidades de medida ');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc ++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Concatenación');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $band1 = 1016;

      for ($k=0; $k <$enviados["numero_indicador0"][0]; $k++) { 
        $formula = '=('.$conteoarrd[$k]."6".')';

        $objPHPExcel->getActiveSheet()->setCellValue($conteoc.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($conteoc.$band1.":".$conteoc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '=('.$conteoarrd[$k]."1006".')';
        $objPHPExcel->getActiveSheet()->setCellValue($conteod.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($conteod.$band1.":".$conteod.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteod.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $agregado = $conteoarrd[$k];
        $agregado++;
        $formula = '=('.$agregado."1006".')';
        $objPHPExcel->getActiveSheet()->setCellValue($conteoe.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($conteoe.$band1.":".$conteoe.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteoe.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $agregado++;
        $formula = '=('.$agregado."1006".')';
        $objPHPExcel->getActiveSheet()->setCellValue($conteof.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($conteof.$band1.":".$conteof.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteof.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($conteog.$band1,'=MAX('.$conteod.$band1.':'.$conteof.$band1.')');
        $objPHPExcel->getActiveSheet()->getStyle($conteog.$band1.":".$conteog.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteog.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $exc = $conteog;
        $exc++;
        $conteoh = $exc;
        $formula = '=IF('.$conteog.$band1.'='.$conteod.$band1.',$'.$conteod.'$1015,IF('.$conteog.$band1.'='.$conteoe.$band1.',$'.$conteoe.'$1015,IF('.$conteog.$band1.'='.$conteof.$band1.',$'.$conteof.'$1015,"algo esta mal")))';
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $exc++;
        $conteoi = $exc;
        $formula = '= RANDBETWEEN(1,10)';
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = "=IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1100,'Por Valoracion (3) Dimension'!$".$nuevow."$1100,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1101,'Por Valoracion (3) Dimension'!$".$nuevow."$1101,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1102,'Por Valoracion (3) Dimension'!$".$nuevow."$1102,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1103,'Por Valoracion (3) Dimension'!$".$nuevow."$1103,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1104,'Por Valoracion (3) Dimension'!$".$nuevow."$1104,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1105,'Por Valoracion (3) Dimension'!$".$nuevow."$1105,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1106,'Por Valoracion (3) Dimension'!$".$nuevow."$1106,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1107,'Por Valoracion (3) Dimension'!$".$nuevow."$1107,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1108,'Por Valoracion (3) Dimension'!$".$nuevow."$1108,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1109,'Por Valoracion (3) Dimension'!$".$nuevow."$1109, A4000))))))))))";
        $exc++;
        $conteoj = $exc;
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $exc++;
        $conteok = $exc;
        $formula = '= RANDBETWEEN(1,7)';
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = "=IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1110,'Por Valoracion (3) Dimension'!$".$nuevow."$1110,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1111,'Por Valoracion (3) Dimension'!$".$nuevow."$1111,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1112,'Por Valoracion (3) Dimension'!$".$nuevow."$1112,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1113,'Por Valoracion (3) Dimension'!$".$nuevow."$1113,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1114,'Por Valoracion (3) Dimension'!$".$nuevow."$1114,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1115,'Por Valoracion (3) Dimension'!$".$nuevow."$1115,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1116,'Por Valoracion (3) Dimension'!$".$nuevow."$1116,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1117,'Por Valoracion (3) Dimension'!$".$nuevow."$1117,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1118,'Por Valoracion (3) Dimension'!$".$nuevow."$1118,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1119,'Por Valoracion (3) Dimension'!$".$nuevow."$1119, A4000))))))))))";
        $exc++;
        $conteol = $exc;
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $exc++;
        $conteom = $exc;
        $formula = '= RANDBETWEEN(1,2)';
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = "=IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1120,'Por Valoracion (3) Dimension'!$".$nuevow."$1120,IF(".$exc.$band1."='Por Valoracion (3) Dimension'!$".$nuevov."$1121,'Por Valoracion (3) Dimension'!$".$nuevow."$1121,A4000))";
        $exc++; 
        $conteon = $exc;    
        $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $exc++; 
        $conteoo = $exc; 
        $a = $k;
        if (($a+1)!=$enviados["numero_indicador0"][0]) {
         $formula = '=CONCATENATE("el ",ROUND('.$conteog.$band1.'*100,0),"% de los ",'.$conteon.$band1.'," ",'.$conteoj.$band1.'," a la dimensión ",'.$conteoc.$band1.'," como ",'.$conteoh.$band1.',", ",'.$conteol.$band1.')';
       }else{
        $formula = '=CONCATENATE("el ",ROUND('.$conteog.$band1.'*100,0),"% de los ",'.$conteon.$band1.'," ",'.$conteoj.$band1.'," a la dimensión ",'.$conteoc.$band1.'," como ",'.$conteoh.$band1.')';
      }

      $objPHPExcel->getActiveSheet()->setCellValue($conteoo.$band1,$formula );
      $objPHPExcel->getActiveSheet()->getStyle($conteoo.$band1.":".$conteoo.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $band1++;

    }


    $band2 = 1026 + 50;


    $formula = '=MAX('.$conteod.'1016:'.$conteod.($band1 -1).')';
    $objPHPExcel->getActiveSheet()->setCellValue($conteod.$band2,$formula);
    $objPHPExcel->getActiveSheet()->getStyle($conteod.$band2.":".$conteod.$band2)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->getStyle($conteod.$band2)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
    $formula = '=IF('.$conteod.$band2.'='.$conteod.'1016,'.$conteoc.'1016';
    $formula2 = $conteoo.'1016';
    $paren ='';
    $band3 = '1017';
    for ($k=0; $k <($enviados["numero_indicador0"][0] -1) ; $k++) { 
      $formula = $formula.',IF('.$conteod.$band2.'='.$conteod.$band3.','.$conteoc.$band3.'';
      $formula2 = $formula2.'," ",'.$conteoo.$band3.'';
      $paren = $paren.')';
      $band3++;
    }
    $formula = $formula.$paren.')';
    $objPHPExcel->getActiveSheet()->setCellValue($conteoc.$band2,$formula);
    $objPHPExcel->getActiveSheet()->getStyle($conteoc.$band2.":".$conteoc.$band2)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $formula = '=CONCATENATE("En la ",'.$conteod.'5," y ",'.$conteod.'33," se puede observar que la variable ",'.$conteoe."1001".'," tiene una calificación de ",'.$conteoe."1008".',","," ello debido a que el ",ROUND('.$conteoe."1006".'*100,0),"% de los resultados estan en las categorias de ",'.$conteod."1005".'," mientras que el ",ROUND('.$conteoe."1006".'*100,0),"% ",'.$conteoe."1005".'," y el ",ROUND('.$conteof."1006".'*100,0),"% ",'.$conteof."1005".'," en tal sentido se puede observar que la mayoria de los resultados es decir el ",ROUND('.$conteog."1007".'*100,0),"% tiene una calificación inclinada para un valor ",'.$conteoe."1008".'," estos resultados se originaron debido a que ",'.$formula2.',", finalmente dentro de las dimensiones evaluadas la que cuenta con mayor deficiencia es la dimensión ",'.$conteoc.$band2.','.')';
    $valorconcadimension[$i] = "'Por conteo Dimension'!".$conteod.'36';
    $objPHPExcel->getActiveSheet()->setCellValue($conteod.'36',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($conteod."36:".$conteod."36")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->mergeCells($conteod."36:".$conteof."47");
    $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($conteod.'36:'.$nuevoo.'36')->getAlignment()->setWrapText(true);

  }
  $letrainicio= $this->generar_letra($letrainicio,9); 
  if ($i<$enviados["numero_indicador0"][0]) {
    $paginainicio2 = $this->generar_letra($paginainicio2,($enviados["numero_pregunta0"][$i])); 
  }
  $paginainicio3 =   $this->generar_letra($paginainicio2,1); 
  $paginainicio31 =   $this->generar_letra($paginainicio31,9);
  $letrainicio1= $this->generar_letra($letrainicio1,9);
  $bordeinicio = $this->generar_letra($bordefinal,3);  
}
///////


if ($enviados["variable"] == 2) {
$nombrepagina2 =  substr($enviados["nombre_dimension"][1], 0, 31);
  $nueva_hoja = $objPHPExcel->createSheet();
  $objPHPExcel->setActiveSheetIndex(4);
  $nueva_hoja->setTitle($nombrepagina2);

  $sharedStyle1 = new PHPExcel_Style();
  $sharedStyle2 = new PHPExcel_Style();
  $sharedStyle3 = new PHPExcel_Style();
  $style = new PHPExcel_Style();
  $sharedStyle1->applyFromArray(
    array('fill'  => array(
      'type'    => PHPExcel_Style_Fill::FILL_SOLID,
      'color'   => array('argb' => 'E43B16')
    ),
    'borders' => array(
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  ));

  $sharedStyle2->applyFromArray(
    array('fill'  => array(
      'type'    => PHPExcel_Style_Fill::FILL_SOLID,
      'color'   => array('argb' => '2BAD56')
    ),
    'borders' => array(
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  ));

  $sharedStyle3->applyFromArray(
    array('fill'  => array(
      'type'    => PHPExcel_Style_Fill::FILL_SOLID,
      'color'   => array('argb' => 'FFFFFF')
    ),
    'borders' => array(
      'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
      'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
    )
  ));
  $Letra='A';
  $LetraFinal = 'A'; 
  $Cantidad_de_columnas_a_crear=$enviados['itemv2']+2; 
  $Contador=0; 
  while($Contador<$Cantidad_de_columnas_a_crear) 
  { 
    $Contador++; 
    $LetraFinal++; 
  } 
  $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, $Letra."1:".$LetraFinal."2");
  $objPHPExcel->getActiveSheet()->getStyle($Letra."1:".$LetraFinal."2")->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($Letra."1", $enviados["nombre_variable"][0]);
  $objPHPExcel->getActiveSheet()->mergeCells($Letra."1:".$LetraFinal."2");
  $Letra='B';
  $Contador =0;
  do{
    if($Contador<$enviados["numero_indicador0"][1]){
      $LetraFinal = $this-> generar_letra($Letra,$enviados["numero_pregunta1"][$Contador]-1);
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$LetraFinal."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',$muestra1["nombre_indicador"][$Contador] );
      $objPHPExcel->getActiveSheet()->mergeCells($Letra."3:".$LetraFinal."3");
    }else{
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$LetraFinal."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3','Total');
      $objPHPExcel->getActiveSheet()->mergeCells($Letra."3:".$LetraFinal."3");
      $Letra=$LetraFinal++;
      $Letra=$LetraFinal++;
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$LetraFinal."3");
      $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3','Valoración' );
      $objPHPExcel->getActiveSheet()->mergeCells($Letra."3:".$LetraFinal."3");
    }

    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
    $Contador++;
  }while($Contador <$enviados["numero_indicador0"][1]+1);

  $Letra = 'B';
  $Contador =0;
  do{
    $LetraFinal = $this-> generar_letra($Letra,0);
    $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."4:".$LetraFinal."4");
    $objPHPExcel->getActiveSheet()->getStyle($Letra."4:".$LetraFinal."3")->getFont()->setBold(true)->setName('Verdana')->setSize(7)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.'4',"PRG.".($Contador+1));
    $objPHPExcel->getActiveSheet()->mergeCells($Letra."4:".$LetraFinal."4");
    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
    $Contador++;
  }while($Contador <$enviados["itemv2"]);
  $inicio = 5;
  $aux2 = '';
  for ($i=0; $i < $enviados['muestra']; $i++) { 
    $Letra = 'A';
    
    for ($j=0; $j < $enviados["itemv2"]+1; $j++) { 
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$excel2[$i][$j]);
      $objPHPExcel->getActiveSheet()->mergeCells($Letra.$inicio.":".$LetraFinal.$inicio);
      $Letra=$LetraFinal++;
      $Letra=$LetraFinal++;
    }
    $inicio++;
  }

  $inicio = 5;
  $Letra = 'B';
  $LetraFinal = $this-> generar_letra($Letra,$enviados["itemv2"]);
  $aux2 = $this-> generar_letra($Letra,($enviados["itemv2"] -1));
  for ($i=0; $i < $enviados['muestra']; $i++) { 
    $objPHPExcel->getActiveSheet()->setCellValue($LetraFinal.$inicio,'=SUM(B'.$inicio.':'.$aux2.$inicio.')');
    $objPHPExcel->getActiveSheet()->mergeCells($LetraFinal.$inicio.":".$LetraFinal.$inicio);
    $inicio++;
  }

  $Letra = 'A';
  $sumainicio = $enviados['muestra']+5;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$sumainicio,'TOTAL');

  $final = $inicio-1;
  $modainicio = $enviados['muestra']+6;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$modainicio,'MODA');

  $mediainicio = $enviados['muestra']+7;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$mediainicio,'MEDIA');

  $medianainicio = $enviados['muestra']+8;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$medianainicio,'MEDIANA');

  $desvinicio = $enviados['muestra']+9;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$desvinicio,'Desv.Est');

  $coefiinicio = $enviados['muestra']+10;
  $objPHPExcel->getActiveSheet()->setCellValue($Letra.$coefiinicio,'Coef. Varia.
    ');
  $Letra = 'B';

  for ($i=0; $i < $enviados["itemv2"] +1; $i++) { 
    $LetraFinal = $this-> generar_letra($Letra,0);
    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$sumainicio,'=SUM('.$Letra.'5:'.$Letra.$final.')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$modainicio,'=MODE('.$Letra.'5:'.$Letra.$final.')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$mediainicio,'=('.$Letra.$sumainicio.'/'.$enviados['muestra'].')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$medianainicio,'=MEDIAN('.$Letra.'5:'.$Letra.$final.')');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$desvinicio,'=ROUND(STDEV('.$Letra.'5:'.$Letra.$final.'),2)');

    $objPHPExcel->getActiveSheet()->setCellValue($Letra.$coefiinicio,'=('.$Letra.$desvinicio.'/'.$Letra.$mediainicio.')');
    $objPHPExcel->getActiveSheet()->getStyle($Letra.$coefiinicio)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

    $Letra=$LetraFinal++;
    $Letra=$LetraFinal++;
  }
  $ini = $coefiinicio +1;
  $ini2 = $ini + $enviados["respuesta"] +1;
  $initotal = $ini2;
  $maximo = $enviados['muestra']+4;
  for ($i=0; $i <= $enviados["respuesta"] ; $i++) { 
    $LetraI = 'A';
    $LetraF = 'B';
    if ($i<$enviados["respuesta"]) {
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini,$enviados["nombre_respuestav2"][$i]);
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini2,$enviados["nombre_respuestav2"][$i].'%');
      for ($j=1; $j < $enviados["itemv2"] +1; $j++) {
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini,'=COUNTIF($'.$LetraF.'$5:$'.$LetraF.'$'.$maximo.','.($i+1).')');
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini2,'=($'.$LetraF.$ini.'/$'.$LetraF.($initotal-1).')');
        $objPHPExcel->getActiveSheet()->getStyle($LetraF.$ini2)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $LetraF++;
      }

    }else{
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini,'Total');
      $objPHPExcel->getActiveSheet()->setCellValue($LetraI.$ini2,'Total %');
      for ($j=1; $j < $enviados["itemv2"] +1; $j++) {
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini,'=SUM($'.$LetraF.($coefiinicio +1).':$'.$LetraF.($initotal-2).')');
        $objPHPExcel->getActiveSheet()->setCellValue($LetraF.$ini2,'=SUM($'.$LetraF.$initotal.':$'.$LetraF.($ini2-1).')');
        $objPHPExcel->getActiveSheet()->getStyle($LetraF.$ini2)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $LetraF++;
      }
    }

    $ini++;
    $ini2++;
  }



  $nuevaaru = array();
  $nuevaarq = array();
  $mencion = array();
  $nueva_hoja = $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(5); // marcar como activa la nueva hoja
    $nueva_hoja->setTitle('Por Valoracion (3) Dimension 2'); // definimos el titulo
    $nombrehoja[0] = "'Por Valoracion (3) Dimension 2'";
    $nombrehoja1[1] = "'Por Valoracion (3) Dimension 2'";
    $nuevaaro = array();
    $nuevaarw = array();
    $nueva_hoja->getColumnDimension('A')->setAutoSize(true);
    //$nueva_hoja->setCellValue('A1',' Mi nueva hoja creada :) ');
    $sharedStyle1 = new PHPExcel_Style();
    $sharedStyle2 = new PHPExcel_Style();
    $sharedStyle3 = new PHPExcel_Style();
    $style = new PHPExcel_Style();
    $sharedStyle1->applyFromArray(
      array('fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => '0000FF')
      ),
      'borders' => array(
        'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
    ));

    $sharedStyle2->applyFromArray(
      array('fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFCC00')
      ),
      'borders' => array(
        'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
    ));

    $sharedStyle3->applyFromArray(
      array('fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'FFFFFF')
      ),
      'borders' => array(
        'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
        'right'   => array('style' => PHPExcel_Style_Border::BORDER_MEDIUM)
      )
    ));
    $Letra='A';
    $linicia  = 'B';
    $LetraFinal = 'A'; 
    $Cantidad_de_columnas_a_crear=((($enviados["numero_indicador0"][1]+1)*2)); 
    $Contador=0; 
    while($Contador<$Cantidad_de_columnas_a_crear) 
    { 
      $Contador++; 
      $LetraFinal++; 
    } 
    $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, $Letra."1:".$LetraFinal."1");
    $objPHPExcel->getActiveSheet()->getStyle($Letra."1:".$LetraFinal."1")->getFont()->setBold(true)->setName('Verdana')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($Letra."1", $enviados["nombre_variable"][0]);
    $objPHPExcel->getActiveSheet()->mergeCells($Letra."1:".$LetraFinal."1");

    $objPHPExcel->getActiveSheet()->getStyle("A2:A3")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue("A2", 'Nº de Personas');
    $objPHPExcel->getActiveSheet()->mergeCells("A2:A3");

    $Letra='B';
    $Contador =0;
    $nom_dimension = array();

    do{
      $LetraFinal = $this-> generar_letra($Letra,1);
      if($Contador<$enviados["numero_indicador0"][1]){
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."2:".$LetraFinal."2");
        $objPHPExcel->getActiveSheet()->getStyle($Letra."2:".$LetraFinal."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($Letra.'2',$muestra1["nombre_indicador"][$Contador] );
        $objPHPExcel->getActiveSheet()->mergeCells($Letra."2:".$LetraFinal."2");  
        $nom_dimension[$Contador] = $Letra;
      }else{
        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."2:".$LetraFinal."2");
        $objPHPExcel->getActiveSheet()->getStyle($Letra."2:".$LetraFinal."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($Letra.'2',$enviados["nombre_dimension"][1] );
        $objPHPExcel->getActiveSheet()->mergeCells($Letra."2:".$LetraFinal."2");  
        $nom_dimension[$Contador] = $Letra;
      }


      for ($i=1; $i <=2 ; $i++) { 
        if($i ==1){
          $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$Letra."3");
          $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$Letra."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',"Suma Total");
          $objPHPExcel->getActiveSheet()->mergeCells($Letra."3:".$Letra."3"); 

          $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$Letra."3");
          $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$Letra."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',"Suma Total");
          $objPHPExcel->getActiveSheet()->mergeCells($Letra."3:".$Letra."3"); 
        }else{
          $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $Letra."3:".$Letra."3");
          $objPHPExcel->getActiveSheet()->getStyle($Letra."3:".$Letra."2")->getFont()->setBold(true)->setName('Verdana')->setSize(6)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($Letra.'3',"Valoración");
          $objPHPExcel->getActiveSheet()->mergeCells($Letra."3:".$Letra."3"); 
        }

        $Letra=$LetraFinal++;

      }
      $Letra = $Letra;
      $Contador++;
    }while($Contador <$enviados["numero_indicador0"][1]+1);

    $inicio = 4;
    $inicio2= 5;
    for ($i=0; $i < $enviados['muestra']; $i++) { 
      $Letra = 'B';
      $Letra2 = 'B';

      for ($j=0; $j < $enviados["numero_indicador0"][1]; $j++) {
        $LetraFinal = $this-> generar_letra($Letra,1);
        $LetraFinal2 = $this-> generar_letra($Letra2,$enviados["numero_pregunta1"][$j]-1);
        $segunletra = $this->generar_letra($LetraFinal,0);
        $condu = "=SUM('".$nombrepagina2."'!".$Letra2.$inicio2.":".$LetraFinal2.$inicio2.")";
        $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$condu);
        $ult = $Letra;

        $Letra=$LetraFinal++;
        $Letra=$LetraFinal++;
        $Letra2=$LetraFinal2++;
        $Letra2=$LetraFinal2++;
      }
      $LetraFinal2 = $this-> generar_letra($ult,2);  
      $condu = "=SUM(B".$inicio.":".$ult.$inicio.")";
      $objPHPExcel->getActiveSheet()->setCellValue($LetraFinal2.$inicio,$condu);
      $inicio++;
      $inicio2++;
    }
    //echo $this->generar_letra($LetraFinal2,5);

    $inicio = 4;
    $Letra = 'A';
    for ($i=0; $i < $enviados['muestra']; $i++) {
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$excel2[$i][0]);
      $inicio++;
    }
    $pintado = new PHPExcel_Style();
    $pintado2 = new PHPExcel_Style();
    $pintado->applyFromArray(
      array('fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => '8CC563')
      )
    ));
    $pintado2->applyFromArray(
      array('fill'  => array(
        'type'    => PHPExcel_Style_Fill::FILL_SOLID,
        'color'   => array('argb' => 'bae704')
      )
    ));

    $BStyle = array(
      'borders' => array(
        'bottom' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      )
    );
    $BStyle1 = array(
      'borders' => array(
        'top' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN
        )
      )
    );
    $iffor = $this->generar_letra($LetraFinal2,9);

    for ($j=0; $j < count($nom_dimension) ; $j++) { 
      $iniciador = 4;
      $LetraIni = $this->generar_letra($nom_dimension[$j],1);
      $Letra = $nom_dimension[$j];
      for ($m=0; $m <$enviados['muestra'] ; $m++){ 
        $formula = '=IF('.$Letra.$iniciador.'<=$'.$iffor.'$19,"'.$enviados["nombre_escalav2"][0].'"';
        $paren = ')';
        $contar = 20;
        for ($k=1; $k < $enviados["escala"] ; $k++) {       
          if($k == ($enviados["escala"] -1)){
            $formula =$formula. ',IF('.$Letra.$iniciador.'<=$'.$iffor.'$'.$contar.',"'.$enviados["nombre_escalav2"][$k].'",0)'.$paren;
          }else{
            $formula =$formula. ',IF('.$Letra.$iniciador.'<=$'.$iffor.'$'.$contar.',"'.$enviados["nombre_escalav2"][$k].'"';
          }
          $paren = ')'.$paren; 
          $contar++;
        }
        $objPHPExcel->getActiveSheet()->getStyle($iffor.$contar.":".$iffor.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($LetraIni.$iniciador, $formula);
        $parametroay[1][$j]  = $this->generar_letra($nom_dimension[$j],0);
        $iniciador++;
      }
      $iffor = $this->generar_letra($iffor,12);
    }

    $aux =0;
    $bordeinicio = $this->generar_letra($LetraFinal2,3);
    for ($i=0; $i <= $enviados["numero_indicador0"][1]; $i++) {
      $nuevom = $bordeinicio;
      $nuevon = $this->generar_letra($nuevom,1);

      $contador = 4;
      $bordefinal =$this->generar_letra($bordeinicio,10);
      $variables = $this->generar_letra($bordeinicio,2);
      $variables2 = $this->generar_letra($bordeinicio,3);
      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),"Variable");
      $nuevoo = $variables;
      $nuevaaro[$i] = $nuevoo;
      if ($i<$enviados["numero_indicador0"][1]) {
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordefinal.'3');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordeinicio.'45');  
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordefinal.'3:'.$bordefinal.'45');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'45:'.$bordefinal.'45');  
        $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),"Nombre de la Dimensión");
        $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+1).":".$variables.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+1),'='.$nom_dimension[$i].'2');  
        $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+1).":".$variables2.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+3),$enviados["numero_pregunta1"][$i]);
        $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+3).":".$variables2.($contador+3))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      }else{
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordefinal.'3');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordeinicio.'45');  
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordefinal.'3:'.$bordefinal.'45');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'45:'.$bordefinal.'45');

        $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+3),$enviados["itemv2"]);
        $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+3).":".$variables2.($contador+3))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      }
      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),"Variable");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador).":".$variables.($contador))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+2),"Cantidad de Escalas Valorativas");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+2).":".$variables.($contador+2))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+3),"Nº de Peguntas");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+3).":".$variables.($contador+3))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+4),"Valor Mínimo por item");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+4).":".$variables.($contador+4))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+5),"Valor Máximo por item");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+5).":".$variables.($contador+5))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+6),"Máximo");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+6).":".$variables.($contador+6))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+7),"Mínimo");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+7).":".$variables.($contador+7))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+8),"Rango");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+8).":".$variables.($contador+8))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+9),"Amplitud del Intervalo");
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+9).":".$variables.($contador+9))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador),$enviados["nombre_dimension"][1]);
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador).":".$variables2.($contador))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $datosr = $variables2;
      $nuevop = $variables2;

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+2),$enviados["escala"]);
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+2).":".$variables2.($contador+2))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $datosr = $variables2;
      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+4),'1');
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+4).":".$variables2.($contador+4))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+5),$enviados["respuesta"]);
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+5).":".$variables2.($contador+5))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+6),"=".$variables2."7*".$variables2."9");
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+6).":".$variables2.($contador+6))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+7),"=".$variables2."8*".$variables2."7");
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+7).":".$variables2.($contador+7))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+8),"=".$variables2."10-".$variables2."11");
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+8).":".$variables2.($contador+8))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $grafico = $variables2;
      $formula = $variables2."12/".$variables2."6";
      $objPHPExcel->getActiveSheet()->setCellValue($variables2.($contador+9),"=ROUND(".$formula.",0)");
      $objPHPExcel->getActiveSheet()->getStyle($variables2.($contador+9).":".$variables2.($contador+9))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->getColumnDimension($datosr)->setWidth('25');

      $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setAutoSize(true);

    ///////////////////////////////////////////////////////////////////////////
      $var = $this->generar_letra($variables2,1);
      $var2 = $this->generar_letra($var,4);

      $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var2."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      if($i < $enviados["numero_indicador0"][1]){
        $objPHPExcel->getActiveSheet()->setCellValue($var."16", "=".$variables2."5");
        $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      }else{
        $objPHPExcel->getActiveSheet()->setCellValue($var."16", "=".$variables2."4");
        $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    //   $objPHPExcel->getActiveSheet()->getStyle($var.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      }
      $centrar = $var."14";
      $objPHPExcel->getActiveSheet()->setCellValue($var."15", 'Tabla '.($i+1));
      $nuevoq = $var;
      $nuevaarq[$i] = $var;
      $objPHPExcel->getActiveSheet()->getStyle($var."15:".$var."15")->getFont()->setName('Times new Roman')->setSize(10)->getColor()->setRGB('030303');



      $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var2."16")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($var."16:".$var."17")->getFont()->setName('Times new Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var."17", 'Calificación');
      $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('15');
      $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setAutoSize(true);
      $objPHPExcel->getActiveSheet()->mergeCells($var."17:".$var."18");

      $objPHPExcel->getActiveSheet()->getStyle($var."18:".$var2."18")->applyFromArray($BStyle);
      $contar = 19;
      $datoss =  $var ;
      for ($j=0; $j < $enviados["escala"] ; $j++) { 
        $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var2.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, $enviados["nombre_escalav2"][$j]);
        $contar++;
      }
      $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, 'Total');
      $numeross = $contar-1;
      $concon = $contar;

      $objPHPExcel->getActiveSheet()->getStyle($datoss.$contar.":".$var2.$contar)->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($datoss.$contar.":".$var2.$contar)->applyFromArray($BStyle1);
      $objPHPExcel->getActiveSheet()->getColumnDimension($datoss)->setAutoSize(true);
    ///////////////////////////////////////////////////////////////////////////
      $var = $this->generar_letra($var,1);
      $var2 = $this->generar_letra($var,1);
      $objPHPExcel->getActiveSheet()->getStyle($var."17:".$var2."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var."17", 'Rango');
      $nuevor = $var;
      $objPHPExcel->getActiveSheet()->mergeCells($var."17:".$var2."17");

      $objPHPExcel->getActiveSheet()->setCellValue($var."18", 'Desde');

      $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('10');
      $objPHPExcel->getActiveSheet()->getStyle($var."18:".$var2."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $datost = $var;
      $datosu = $this->generar_letra($datost,1);
      $contar = 19;
      for ($j=0; $j < $enviados["escala"] ; $j++) { 
        $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var2.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if ($j==0) {
          $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosr.'11');
        }else{
          $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosu.($contar-1).'+ 1');
        }
        

        $contar++;
      }


    ///////////////////////////////////////////////////////////////////////////
      $var = $this->generar_letra($var,1);

      $objPHPExcel->getActiveSheet()->setCellValue($var."18", 'Hasta');
      $nuevos = $var;
      $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('10');
      $objPHPExcel->getActiveSheet()->getStyle($var."18:".$var2."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $datosu = $var;
      $contar = 19;
      for ($j=0; $j < $enviados["escala"] ; $j++) { 
        $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if ($j== ($enviados["escala"] -1)) {
          $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosr.'10'); 
        }else{
          if ($i<$enviados["numero_indicador0"][1]) {
            $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datost.$contar.'+'.$datosr.'13');
          }else{
            $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datost.$contar.'+'.$datosr.'13 - 1');
          }

        }
        $contar++;
      }



    ///////////////////////////////////////////////////////////////////////////
      $var = $this->generar_letra($var,1);
      $datosv = $var;
      $objPHPExcel->getActiveSheet()->getStyle($var."17:".$var."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var."17", 'Frec.');
      $nuevot = $var;
      $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('15');
      $objPHPExcel->getActiveSheet()->mergeCells($var."17:".$var."18");
      $maximo = $enviados['muestra']+3;
      $letrafre = $nom_dimension[$i];
      $contar = 19;
      $ifcontador = $this->generar_letra($nom_dimension[$i],1); ;

      for ($j=0; $j < $enviados["escala"] ; $j++) {
        $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '=COUNTIF($'.$ifcontador.'$4:$'.$ifcontador.'$'.$maximo.',$'.$datoss.$contar.')');
        $contar++;
      }

      $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '=SUM('.$datosv.'19:'.$datosv.($contar-1).')');

    ///////////////////////////////////////////////////////////////////////////

      $var = $this->generar_letra($var,1);

      $objPHPExcel->getActiveSheet()->getStyle($var."17:".$var."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var."17", '%');
      $nuevou = $var;
      $nuevaaru[$i] = $var;
      $nuevov = $this->generar_letra($nuevou,1);
      $nuevow = $this->generar_letra($nuevou,2);
      $nuevaarw[$i] = $nuevow;
      $objPHPExcel->getActiveSheet()->getColumnDimension($var)->setWidth('10');
      $objPHPExcel->getActiveSheet()->mergeCells($var."17:".$var."18");

      $contar = 19;
      $datosw = $var;
      for ($j=0; $j < $enviados["escala"] ; $j++) { 
        $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '='.$datosv.$contar.'/'.$datosv.$concon);
        $objPHPExcel->getActiveSheet()->getStyle($var.$contar)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $contar++;
      }
      $objPHPExcel->getActiveSheet()->getStyle($var.$contar.":".$var.$contar)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($var.$contar, '=SUM('.$datosw.'19:'.$datosw.($contar-1).')');
      $objPHPExcel->getActiveSheet()->getStyle($var.$contar)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
      $centrarf = $var.$contar;
      $objPHPExcel->getActiveSheet()->getStyle($centrar.':'.$centrarf)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet();

      $condu = "Fuente: Encuesta aplicada";
      $objPHPExcel->getActiveSheet()->getStyle($datoss.($contar+1).":".$datoss.($contar+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($datoss.($contar+1),$condu);
      
      $condu = "'Tabulacion por item 2'";
      $condu1 = "Elaboración: Propia";
      $objPHPExcel->getActiveSheet()->getStyle($datoss.($contar+2).":".$datoss.($contar+2))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($datoss.($contar+2),$condu1);
      
      $objPHPExcel->getActiveSheet()->getStyle($datoss.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle($datoss.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $campo = "'Por Valoracion (3) Dimension 2'";

      $labels = array(
        new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$B$1', null, 1),
      );
      $categories = array(
        new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$'.$datoss.'$19:$'.$datoss.'$'.$numeross.'', null, 6),   
      );
      $values = array(
        new PHPExcel_Chart_DataSeriesValues('Number', $campo.'!$'.$datosw.'$19:$'.$datosw.'$'.$numeross.'', null, 4),
      );
      $series = new PHPExcel_Chart_DataSeries(
          PHPExcel_Chart_DataSeries::TYPE_BARCHART_3D,     // plotType
          PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
          array(0),                                     // plotOrder
          $labels,                                        // plotLabel
          $categories,                                    // plotCategory
          $values                                         // plotValues
        );  

      $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
        $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 

        $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
        $title    = new PHPExcel_Chart_Title('');  
        $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
        $xTitle   = new PHPExcel_Chart_Title('');
        $yTitle   = new PHPExcel_Chart_Title('');
        $chart    = new PHPExcel_Chart(
          'chart1',                                       // name
          $title,                                         // title
          $legend,                                        // legend 
          $plotarea,                                      // plotArea
          true,                                           // plotVisibleOnly
          0,                                              // displayBlanksAs
          $xTitle,                                        // xAxisLabel
          $yTitle                                         // yAxisLabel
        );                       
        $chart->setTopLeftPosition($datoss.'26');
        $chart->setBottomRightPosition(($this->generar_letra($datoss,5)).'42');
        $objPHPExcel->getActiveSheet()->addChart($chart);
        
        if($i<$enviados["numero_indicador0"][1]){
          $objPHPExcel->getActiveSheet()->setCellValue($datoss."43",'Figura.'.($i+1));
          $objPHPExcel->getActiveSheet()->getStyle($datoss."44:".$datoss."44")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($datoss."44",$muestra1["nombre_indicador"][$i]);
        }else{
         $objPHPExcel->getActiveSheet()->setCellValue($datoss."43",'Figura.'.($i+1));
         $objPHPExcel->getActiveSheet()->getStyle($datoss."44:".$datoss."44")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
         $objPHPExcel->getActiveSheet()->setCellValue($datoss."44",$muestra1["nombre_indicador"][0]);
       }
       $objPHPExcel->getActiveSheet()->getStyle($datoss."43:".$datosr."43")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    //ffffff
       $objPHPExcel->getActiveSheet()->setCellValue($nuevom."901","Variable");
       $objPHPExcel->getActiveSheet()->getStyle($nuevom."901:".$nuevom."901")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevop."901","Unidades de Medida");
       $objPHPExcel->getActiveSheet()->getStyle($nuevop."901:".$nuevop."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevop."902",$letramuestra);
       $objPHPExcel->getActiveSheet()->getStyle($nuevop."902:".$nuevop."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevom."902","Dimensión");
       $objPHPExcel->getActiveSheet()->getStyle($nuevom."902:".$nuevom."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevon."902","=(".$nuevop."5)");
       $objPHPExcel->getActiveSheet()->getStyle($nuevon."902:".$nuevon."902")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevon."901","=(".$nuevop."4)");
       $objPHPExcel->getActiveSheet()->getStyle($nuevon."901:".$nuevon."901")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevom."904","Valoración de la variable");
       $objPHPExcel->getActiveSheet()->getStyle($nuevom."904:".$nuevom."904")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $formula = '=MAX('.$nuevou.'19:'.$nuevou.(18+$enviados["escala"]).')';
       $objPHPExcel->getActiveSheet()->setCellValue($nuevon."904",$formula);
       $objPHPExcel->getActiveSheet()->getStyle($nuevon."904:".$nuevon."904")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->getStyle($nuevon."904")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

       $formula = '=IF('.$nuevon.'904='.$nuevou.'19,'.$nuevoq.'19,IF('.$nuevon.'904='.$nuevou.'20,'.$nuevoq.'20,IF('.$nuevon.'904='.$nuevou.'21,'.$nuevoq.'21,"algo esta mal")))';

       $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."904",$formula);
       $objPHPExcel->getActiveSheet()->getStyle($nuevoo."904:".$nuevoo."904")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        ////////////////////////
       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1100",'1');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1100:".$nuevov."1100")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1100",'valoró');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1100:".$nuevow."1100")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1101",'2');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1101:".$nuevov."1101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1101",'calificó');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1101:".$nuevow."1101")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1102",'3');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1102:".$nuevov."1102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1102",'consideró');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1102:".$nuevow."1102")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1103",'4');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1103:".$nuevov."1103")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1103",'respondió');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1103:".$nuevow."1103")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1104",'5');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1104:".$nuevov."1104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1104",'evaluó');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1104:".$nuevow."1104")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1105",'6');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1105:".$nuevov."1105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1105",'determinó');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1105:".$nuevow."1105")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1106",'7');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1106:".$nuevov."1106")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1106",'mencionó');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1106:".$nuevow."1106")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1107",'8');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1107:".$nuevov."1107")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1107",'apreció');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1107:".$nuevow."1107")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1108",'9');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1108:".$nuevov."1108")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1108",'percibió');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1108:".$nuevow."1108")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

       $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1109",'10');
       $objPHPExcel->getActiveSheet()->getStyle($nuevov."1109:".$nuevov."1109")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1109",'Tuvo una percepción de');
       $objPHPExcel->getActiveSheet()->getStyle($nuevow."1109:".$nuevow."1109")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        /////////////////

       if($i != $enviados["numero_indicador0"][1]){
        $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."905","Preguntas Originales");
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo."905:".$nuevoo."905")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevop."905","Enunciados Para Palafraseo");
        $objPHPExcel->getActiveSheet()->getStyle($nuevop."905:".$nuevop."905")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."1015","Enunciados Para Palafraseo");
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo."1015:".$nuevoo."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevop."1015",'=CONCATENATE('.$nuevoq.'905," y ",'.$nuevor.'905)');
        $objPHPExcel->getActiveSheet()->getStyle($nuevop."1015:".$nuevop."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevoq."1015",'=('.$nuevos.'905)');
        $objPHPExcel->getActiveSheet()->getStyle($nuevoq."1015:".$nuevoq."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevor."1015",'=CONCATENATE('.$nuevot.'905," y ",'.$nuevou.'905)');
        $objPHPExcel->getActiveSheet()->getStyle($nuevor."1015:".$nuevor."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevos."1015",'MÁXIMO');
        $objPHPExcel->getActiveSheet()->getStyle($nuevos."1015:".$nuevos."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevot."1015",'Valores');
        $objPHPExcel->getActiveSheet()->getStyle($nuevot."1015:".$nuevot."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevou."1015",'codificación de verbos aleatorios para concatenar');
        $objPHPExcel->getActiveSheet()->getStyle($nuevou."1015:".$nuevou."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1015",'verbo');
        $objPHPExcel->getActiveSheet()->getStyle($nuevov."1015:".$nuevov."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1015",'Concatenación');
        $objPHPExcel->getActiveSheet()->getStyle($nuevow."1015:".$nuevow."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');



        $mencion[$i] = $nuevov;
        


        $iniciar = $nuevoq; 

        for ($k=0; $k <$enviados["respuesta"]; $k++) { 
          $objPHPExcel->getActiveSheet()->setCellValue($iniciar."905",$enviados["nombre_respuestav2"][$k]);
          $objPHPExcel->getActiveSheet()->getStyle($iniciar."905:".$iniciar."905")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $iniciar++;
        }
        $band = 906;
        $iniciadorb = 906;
        $band1 = 1016;
        for ($k=0; $k < $enviados["numero_pregunta1"][$i] ; $k++) { 
          $coninicio = $enviados['muestra'] +10 + $enviados['respuesta'] +2;
          $nnuevo = $nuevoq;
          $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.$band,$muestra1["nombre_pregunta"][$aux]);
          $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band.":".$nuevoo.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $objPHPExcel->getActiveSheet()->setCellValue($nuevop.$band,$muestra1["nombre_conca"][$aux]);
          $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band.":".$nuevop.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          for ($m=0; $m < $enviados["respuesta"] ; $m++){
            $formula = $condu = "=('".$nombrepagina2."'!".$linicia.$coninicio.")"; 
            $objPHPExcel->getActiveSheet()->setCellValue($nnuevo.$band,$formula);
            $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band.":".$nuevop.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
            $nnuevo++;
            $coninicio++;
          }
          $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.$band1,'=('.$nuevop.$band.')');
          $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band1.":".$nuevoo.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $formula = '=SUM('.$nuevoq.$band.':'.$nuevor.$band.')';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevop.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1.":".$nuevop.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

          $formula = '=('.$nuevos.$band.')';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevoq.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1.":".$nuevoq.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

          $formula = '=SUM('.$nuevot.$band.':'.$nuevou.$band.')';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevor.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1.":".$nuevor.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


          $formula = '=MAX('.$nuevop.$band1.':'.$nuevor.$band1.')';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevos.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1.":".$nuevos.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


          $formula = '=IF('.$nuevos.$band1.'='.$nuevop.$band1.',$'.$nuevop.'$1015,IF('.$nuevos.$band1.'='.$nuevoq.$band1.',$'.$nuevoq.'$1015,IF('.$nuevos.$band1.'='.$nuevor.$band1.',$'.$nuevor.'$1015,"ALGO ESTA MAL")))';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevot.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevot.$band1.":".$nuevot.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $formula = '=RANDBETWEEN(1,10)';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevou.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevou.$band1.":".$nuevou.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $formula = '=IF('.$nuevou.$band1.'=$'.$nuevov.'$1100,$'.$nuevow.'$1100,IF('.$nuevou.$band1.'=$'.$nuevov.'$1101,$'.$nuevow.'$1101,IF('.$nuevou.$band1.'=$'.$nuevov.'$1102,$'.$nuevow.'$1102,IF('.$nuevou.$band1.'=$'.$nuevov.'$1103,$'.$nuevow.'$1103,IF('.$nuevou.$band1.'=$'.$nuevov.'$1104,$'.$nuevow.'$1104,IF('.$nuevou.$band1.'=$'.$nuevov.'$1105,$'.$nuevow.'$1105,IF('.$nuevou.$band1.'=$'.$nuevov.'$1106,$'.$nuevow.'$1106,IF('.$nuevou.$band1.'=$'.$nuevov.'$1107,$'.$nuevow.'$1107,IF('.$nuevou.$band1.'=$'.$nuevov.'$1108,$'.$nuevow.'$1108,IF('.$nuevou.$band1.'=$'.$nuevov.'$1109,$'.$nuevow.'$1109,"algo esta mal"))))))))))';
          $objPHPExcel->getActiveSheet()->setCellValue($nuevov.$band1,$formula);
          $objPHPExcel->getActiveSheet()->getStyle($nuevov.$band1.":".$nuevov.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          if($k ==0 || $k == 2){
            $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% ",'.$nuevov.$band1.'," como ",'.$nuevot.$band1.')';
            $ayuda = 0;
          }else{
            if ($ayuda == 2 || $k == 1 || $k == 3) {
             $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% de los ",'.$nuevop."902".'," ",'.$nuevov.$band1.'," como ",'.$nuevot.$band1.')';     
             $ayuda =0;     
           }else{
            $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% ",'.$nuevov.$band1.'," como ",'.$nuevot.$band1.')';
            $ayuda++;
          }
        }
        $objPHPExcel->getActiveSheet()->setCellValue($nuevow.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($nuevow.$band1.":".$nuevow.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $band++;
        $band1++;
        $aux++;
        $linicia++;
        $iniciadorb++;

        $formula2 =$nuevow.'1016," ",'.$nuevoo."1016".',",","asi mismo "';
        $add = 0;
        $paren ='';
        $band3 = '1017';
        for ($n=0; $n <= ($enviados["numero_pregunta1"][$i] -3) ; $n++) {
          $round =mt_rand(0,12);
          if ($add  < 1 && $n ==($enviados["numero_pregunta1"][$i] -3) ) {
            $formula2 = $formula2.','.$nuevow.$band3.'," ",'.$nuevoo.$band3.', ", "';
            $add++;
          }else{
            $formula2 = $formula2.','.$nuevow.$band3.'," ",'.$nuevoo.$band3.',", '.$conectoresoracion[$round].' "';
            $add =0;
          } 
          $band3++;
        }

        $formula2 = $formula2. ',"y ",'.$nuevoo.$band3.'," ",'.$nuevow.$band3.',"';

        $formula ='=CONCATENATE("en la ",'.$nuevoq."15".'," y ",'.$nuevoq."43".'," se puede observar que la variable ",'.$nuevon."901".'," en base a su dimensión ",'.$nuevon."902".'," tiene una calificación de ",'.$nuevoo."904".'," por el ",ROUND('.$nuevon."904".'*100,0),"% ","de los resultados, ","los cuales fueron extraídos  de las encuestas ejecutadas a los ",'.$nuevop."902".',", estos resultados son afectados debido a que, ",'.$formula2.', ","por todo ello la dimensión ",'.$nuevon."902".'," es ",'.$nuevoo."904".',".")';

        $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.'47',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo."47:".$nuevoo."47")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($nuevoo."47:".$nuevot."53");
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47:'.$nuevoo.'47')->getAlignment()->setWrapText(true);
      }

    }else{
      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1110",'1');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1110:".$nuevov."1110")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1110",'asi mismo');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1110:".$nuevow."1110")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1111",'2');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1111:".$nuevov."1111")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1111",'por otro lado ');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1111:".$nuevow."1111")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1112",'3');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1112:".$nuevov."1112")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1112",'por otra parte ');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1112:".$nuevow."1112")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1113",'4');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1113:".$nuevov."1113")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1113",'ademas ');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1113:".$nuevow."1113")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1114",'5');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1114:".$nuevov."1114")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1114",'en consecuencia ');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1114:".$nuevow."1114")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1115",'6');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1115:".$nuevov."1115")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1115",'adicional a ello ');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1115:".$nuevow."1115")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1116",'7');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1116:".$nuevov."1116")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1116",'por consecuencia ');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1116:".$nuevow."1116")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1120",'1');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1120:".$nuevov."1120")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1120",'=('.$nuevop."902".')');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1120:".$nuevow."1120")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1121",'2');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1121:".$nuevov."1121")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1121",'Resultados');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1121:".$nuevow."1121")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');



      $objPHPExcel->getActiveSheet()->setCellValue($nuevoo."1015","dimensión");
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo."1015:".$nuevoo."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevos."1015",'MÁXIMO');
      $objPHPExcel->getActiveSheet()->getStyle($nuevos."1015:".$nuevos."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevot."1015",'Valor');
      $objPHPExcel->getActiveSheet()->getStyle($nuevot."1015:".$nuevot."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevou."1015",'codificación de verbos');
      $objPHPExcel->getActiveSheet()->getStyle($nuevou."1015:".$nuevou."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevov."1015",'Verbo');
      $objPHPExcel->getActiveSheet()->getStyle($nuevov."1015:".$nuevov."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $objPHPExcel->getActiveSheet()->setCellValue($nuevow."1015",'codificación de conectores');
      $objPHPExcel->getActiveSheet()->getStyle($nuevow."1015:".$nuevow."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc = $nuevow;
      $exc++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Conectores');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc ++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de unidades de medida');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $exc ++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Unidades de medida ');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

      $exc ++;
      $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Concatenación');
      $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');





      $iniciar = $nuevop;
      for ($k=0; $k <$enviados["escala"]; $k++) { 
        $objPHPExcel->getActiveSheet()->setCellValue($iniciar."1015",$enviados["nombre_escalav2"][$k]);
        $objPHPExcel->getActiveSheet()->getStyle($iniciar."1015:".$iniciar."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $iniciar++;
      }
      $band1 = 1016;

      for ($k=0; $k <$enviados["numero_indicador0"][1]; $k++) { 
        $formula = '=('.$nuevaarq[$k]."16".')';

        $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band1.":".$nuevoo.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($nuevoo.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($nuevop.$band1,'=('.$nuevaaru[$k]."19".')');
        $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1.":".$nuevop.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($nuevop.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($nuevoq.$band1,'=('.$nuevaaru[$k]."20".')');
        $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1.":".$nuevop.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($nuevoq.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($nuevor.$band1,'=('.$nuevaaru[$k]."21".')');
        $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1.":".$nuevor.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($nuevor.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $formula = '=MAX('.$nuevop.$band1.':'.$nuevor.$band1.')';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevos.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1.":".$nuevos.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($nuevos.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $formula = '=IF('.$nuevos.$band1.'='.$nuevop.$band1.',$'.$nuevop.'$1015,IF('.$nuevos.$band1.'='.$nuevoq.$band1.',$'.$nuevoq.'$1015,IF('.$nuevos.$band1.'='.$nuevor.$band1.',$'.$nuevor.'$1015,"algo esta mal")))';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevot.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevot.$band1.":".$nuevot.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '= RANDBETWEEN(1,10)';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevou.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevou.$band1.":".$nuevou.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '= RANDBETWEEN(1,7)';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevow.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevow.$band1.":".$nuevow.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $nuevox =$nuevow;
        $nuevox++;
        $nuevoy = $nuevox;
        $nuevoy++;
        $nuevoz = $nuevoy;
        $nuevoz++;
        $nuevoaa = $nuevoz;
        $nuevoaa++;
        $formula = '=IF('.$nuevou.$band1.'=$'.$nuevov.'$1100,$'.$nuevow.'$1100,IF('.$nuevou.$band1.'=$'.$nuevov.'$1101,$'.$nuevow.'$1101,IF('.$nuevou.$band1.'=$'.$nuevov.'$1102,$'.$nuevow.'$1102,IF('.$nuevou.$band1.'=$'.$nuevov.'$1103,$'.$nuevow.'$1103,IF('.$nuevou.$band1.'=$'.$nuevov.'$1104,$'.$nuevow.'$1104,IF('.$nuevou.$band1.'=$'.$nuevov.'$1105,$'.$nuevow.'$1105,IF('.$nuevou.$band1.'=$'.$nuevov.'$1106,$'.$nuevow.'$1106,IF('.$nuevou.$band1.'=$'.$nuevov.'$1107,$'.$nuevow.'$1107,IF('.$nuevou.$band1.'=$'.$nuevov.'$1108,$'.$nuevow.'$1108,IF('.$nuevou.$band1.'=$'.$nuevov.'$1109,$'.$nuevow.'$1109,"algo esta mal"))))))))))';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevov.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($nuevov.$band1.":".$nuevov.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '=IF('.$nuevow.$band1.'=$'.$nuevov.'$1110,$'.$nuevow.'$1110,IF('.$nuevow.$band1.'=$'.$nuevov.'$1111,$'.$nuevow.'$1111,IF('.$nuevow.$band1.'=$'.$nuevov.'$1112,$'.$nuevow.'$1112,IF('.$nuevow.$band1.'=$'.$nuevov.'$1113,$'.$nuevow.'$1113,IF('.$nuevow.$band1.'=$'.$nuevov.'$1114,$'.$nuevow.'$1114,IF('.$nuevow.$band1.'=$'.$nuevov.'$1115,$'.$nuevow.'$1115,IF('.$nuevow.$band1.'=$'.$nuevov.'$1116,$'.$nuevow.'$1116,IF('.$nuevow.$band1.'=$'.$nuevov.'$1047,$'.$nuevow.'$1047,IF('.$nuevow.$band1.'=$'.$nuevov.'$1048,$'.$nuevow.'$1048,IF('.$nuevow.$band1.'=$'.$nuevov.'$1049,$'.$nuevow.'$1049,"algo esta mal"))))))))))';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevox.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($nuevox.$band1.":".$nuevox.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '=IF('.$nuevoy.$band1.'=$'.$nuevov.'$1120,$'.$nuevow.'$1120,IF('.$nuevoy.$band1.'=$'.$nuevov.'$1121,$'.$nuevow.'$1121,"algo esta mal"))';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevoz.$band1,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($nuevoz.$band1.":".$nuevoz.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '= RANDBETWEEN(1,2)';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevoy.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevoy.$band1.":".$nuevoy.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '=CONCATENATE("el ",ROUND('.$nuevos.$band1.'*100,0),"% de los ",'.$nuevoz.$band1.'," ",'.$nuevov.$band1.'," a la dimensión ",'.$nuevoo.$band1.'," como ",'.$nuevot.$band1.',", ",'.$nuevox.$band1.')';
        $objPHPExcel->getActiveSheet()->setCellValue($nuevoaa.$band1,$formula );
        $objPHPExcel->getActiveSheet()->getStyle($nuevoaa.$band1.":".$nuevoaa.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $band1++;

      }


      $formula = '=CONCATENATE("En la ",'.$nuevoq."15".'," y ",'.$nuevoq."43".'," se puede evidenciar que la variable ",'.$nuevon."901".'," es calificado como ",'.$nuevoo."904".'," por el ",ROUND('.$nuevon."904".'*100,0),"% de los resultados, mismos que son originados porque; ",'.$nuevoaa."1016".'," ",'.$nuevoaa."1017".'," ",'.$nuevoaa."1018".','.$nuevoaa."1019".','.$nuevoaa."1020".','.$nuevoaa."1021".','.$nuevoaa."1022".','.$nuevoaa."1023".','.$nuevoaa."1024".','.$nuevoaa."1025".','.$nuevoaa."1026".'," se concluye que la variable ",'.$nuevon."901".',"tiene un valor de ",'.$nuevoo."904".',".")';
      $objPHPExcel->getActiveSheet()->setCellValue($nuevoo.'47',$formula);
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo."47:".$nuevoo."47")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->mergeCells($nuevoo."47:".$nuevot."53");
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($nuevoo.'47:'.$nuevoo.'47')->getAlignment()->setWrapText(true);
    }

    $valord = '1046';
    $valori = 8;


    $bordeinicio = $this->generar_letra($bordefinal,2);
  }
  if ($enviados["resitem"] == 'Pregunta') {
    $concate =  ' de la ';
  }else{
    $concate = ' del ';
  }

    //print_r($enviados);exit();
  $nueva_hoja = $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(6); // marcar como activa la nueva hoja
    $nueva_hoja->setTitle('Tabulacion por item 2'); // definimos el titulo

    $iniciador1 = 'C';
    $bordeinicio ='B';
    $paginainicio2 = 'B';
    $paginainicio3 = 'C';
    $paginainicio31 = 'E';
    $letrainicio = 'D';
    $letrainicio1 = 'F';
    for ($i=0; $i < $enviados["itemv2"]; $i++) {
      $totalpagina1 = $enviados['muestra']+11;
      $totalpagina2 = $enviados['muestra'] +10 + $enviados['respuesta'] +2;;
      $bordeestilo = $this->generar_letra($bordeinicio,2);
      for ($j=0; $j < 3 ; $j++) { 
        $objPHPExcel->getActiveSheet()->getColumnDimension($bordeestilo)->setWidth('26'); 
        $bordeestilo = $this->generar_letra($bordeestilo,1);   
      }
      $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7:".$paginainicio31."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($paginainicio31."7",'Frec.');
      $datose = $paginainicio31;

      $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7:".$letrainicio1."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($letrainicio1."7",'%');
      $datosf = $letrainicio1; 

      $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $contador = 5;
      $variables = $this->generar_letra($bordeinicio,2);
      $variables2 = $this->generar_letra($bordeinicio,3);
      $bordefinal =$this->generar_letra($bordeinicio,6);
      if ($i<$enviados["itemv2"]) {
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordefinal.'3');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordeinicio.'39');  
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordefinal.'3:'.$bordefinal.'39');  

      }else{
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordefinal.'3');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordeinicio.'39');  
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordefinal.'3:'.$bordefinal.'39');
      }

      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $variables."4:".$variables."4");
      $objPHPExcel->getActiveSheet()->getStyle($variables."4:".($this->generar_letra($variables,2))."4")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables.'4',$enviados["resitem"].' '.($i+1) );
      $objPHPExcel->getActiveSheet()->mergeCells($variables."4:".($this->generar_letra($variables,2))."4");
      $objPHPExcel->getActiveSheet()->getStyle($variables."4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $objPHPExcel->getActiveSheet()->getStyle($variables.$contador.":".$variables.$contador)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),'Tabla '.($i+1));
      $datosd = $variables;
      $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+1).":".$variables.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),$muestra1["nombre_pregunta"][$i]);
      $cnuevo = 8;
      $paginainicio = 'A';

      for ($j=0; $j <= $enviados["respuesta"] ; $j++) {
        $condu = "=('".$nombrepagina2."'!".$paginainicio.$totalpagina1.")";
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo.":".$variables.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cnuevo,$condu);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

        $condu = "=('".$nombrepagina2."'!".$paginainicio2.$totalpagina1.")";
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo.":".($this->generar_letra($variables,1)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevo,$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


        $condu = "=('".$nombrepagina2."'!".$paginainicio2.$totalpagina2.")";
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevo,$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        if($j == $enviados["respuesta"] ){
          $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle);
          $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle1);

          $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle);
          $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle1);
        }
        $cnuevo++;
        $totalpagina1++;
        $totalpagina2++;
      }

      $numeross = $cnuevo-2;
      $condu = "Elaboración: Propia";
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
      $condu = "Fuente: Encuesta aplicada";
      $cnuevo++;
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
      $campo = "'Tabulacion por item 2'";
      $labels = array(
        new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$B$1', null, 1),
      );
      $categories = array(
        new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$'.$letrainicio.'$8:$'.$letrainicio.'$'.$numeross.'', null, 6),   
      );
      $values = array(
        new PHPExcel_Chart_DataSeriesValues('Number', $campo.'!$'.($this->generar_letra($letrainicio,2)).'$8:$'.($this->generar_letra($letrainicio,2)).'$'.$numeross.'', null, 4),
      );
      $series = new PHPExcel_Chart_DataSeries(
          PHPExcel_Chart_DataSeries::TYPE_BARCHART_3D,     // plotType
          PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
          array(0),                                     // plotOrder
          $labels,                                        // plotLabel
          $categories,                                    // plotCategory
          $values                                         // plotValues
        );  

      $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
        $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 

        $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
        $title    = new PHPExcel_Chart_Title('');  
        $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
        $xTitle   = new PHPExcel_Chart_Title('');
        $yTitle   = new PHPExcel_Chart_Title('');
        $chart    = new PHPExcel_Chart(
          'chart1',                                       // name
          $title,                                         // title
          $legend,                                        // legend 
          $plotarea,                                      // plotArea
          true,                                           // plotVisibleOnly
          0,                                              // displayBlanksAs
          $xTitle,                                        // xAxisLabel
          $yTitle                                         // yAxisLabel
        );                      
        $chart->setTopLeftPosition($letrainicio.'18');
        $chart->setBottomRightPosition(($this->generar_letra($letrainicio,3)).'32');
        $objPHPExcel->getActiveSheet()->addChart($chart);
        $objPHPExcel->getActiveSheet()->getStyle($letrainicio."33:".$letrainicio."33")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."33",'Figura. '.($i+1));
        $objPHPExcel->getActiveSheet()->getStyle($letrainicio."34:".$letrainicio."34")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."34",$muestra1["nombre_pregunta"][$i]);


        $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."1045",$letramuestra);
        $objPHPExcel->getActiveSheet()->getStyle($letrainicio."1045:".$letrainicio."1045")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->setCellValue($this->generar_letra($letrainicio,1)."1045",$muestra1["nombre_conca"][$i]);
        $objPHPExcel->getActiveSheet()->getStyle($this->generar_letra($letrainicio,1)."1045:".$this->generar_letra($letrainicio,1)."1045")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $valord = '1046';
        $valori = 8;

        for ($k=0; $k < $enviados["respuesta"] ; $k++) { 
          $objPHPExcel->getActiveSheet()->setCellValue($iniciador1.$valord,($k+1));
          $objPHPExcel->getActiveSheet()->getStyle($iniciador1.$valord.":".$iniciador1.$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
          $formula = '=IF('.$datose.$valord.'='.$datosf.'8,'.$datosd.'8,IF('.$datose.$valord.'='.$datosf.'9,'.$datosd.'9,IF('.$datose.$valord.'='.$datosf.'10,'.$datosd.'10,IF('.$datose.$valord.'='.$datosf.'11,'.$datosd.'11,IF('.$datose.$valord.'='.$datosf.'12,'.$datosd.'12,"ALGO ESTA MAL")))))';
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,1)).$valord,$formula);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,1)).$valord.":".($this->generar_letra($iniciador1,1)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

          $formula = '=LARGE($'.$datosf.'$8:$'.$datosf.'$'.(7+$enviados["respuesta"]).','.$iniciador1.$valord.')';

          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,2)).$valord,$formula);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,2)).$valord.":".($this->generar_letra($iniciador1,2)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,2)).$valord)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

          $formula = '=IF('.$datose.$valord.'>0.1%,'.$datose.$valord.',"Algo Esta Mal")';
       //   echo $formula;exit();
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,3)).$valord,$formula);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,3)).$valord.":".($this->generar_letra($iniciador1,3)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,3)).$valord)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
          
          $formula = '=IF('.$datosf.$valord.'='.$datose.$valord.','.$datosd.$valord.'," ")';
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($iniciador1,4)).$valord,$formula);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($iniciador1,4)).$valord.":".($this->generar_letra($iniciador1,4)).$valord)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
          $datosg= ($this->generar_letra($iniciador1,4));
          $valord++; 
        }
        $formula = '=SUM('.$datosf.'8:'.$datosf.'10)';
        $objPHPExcel->getActiveSheet()->setCellValue($datosd."1052",'Mayoria');
        $objPHPExcel->getActiveSheet()->getStyle($datosd."1052:".$datosd."1052")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->setCellValue($datosd."1053",$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datosd."1053")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $objPHPExcel->getActiveSheet()->getStyle($datosd."1053:".$datosd."1053")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

        $formula = '=SUM('.$datosf.'10:'.$datosf.'12)';
        $objPHPExcel->getActiveSheet()->setCellValue($datosd."1054",$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datosd."1054:".$datosd."1054")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->getStyle($datosd."1054")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $formula = '=MAX('.$datosd.'1053:'.$datosd.'1054)';
        $objPHPExcel->getActiveSheet()->setCellValue($datose."1053",$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datose."1053:".$datose."1053")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->getStyle($datose."1053")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $co = 1056;
        for ($k=0; $k < $enviados["escala"]; $k++) { 
          $objPHPExcel->getActiveSheet()->setCellValue($datosd.$co,$enviados["nombre_escalav2"][$k]);
          $objPHPExcel->getActiveSheet()->getStyle($datosd.$co.":".$datosd.$co)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
          $co++;
        }
        $formula = '=SUM('.$datosf.'8:'.$datosf.'9)';
        $objPHPExcel->getActiveSheet()->setCellValue($datose.'1056',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datose."1056:".$datose."1056")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->getStyle($datose.'1056')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $formula = '=SUM('.$datosf.'10)';
        $objPHPExcel->getActiveSheet()->setCellValue($datose.'1057',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datose."1057:".$datose."1057")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->getStyle($datose.'1057')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $formula = '=SUM('.$datosf.'11:'.$datosf.'12)';
        $objPHPExcel->getActiveSheet()->setCellValue($datose.'1058',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datose."1058:".$datose."1058")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->getStyle($datose.'1058')->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $formula = '=IF('.$datose.'1056>=51%,'.$datosd.'1056,IF('.$datose.'1057>=51%,'.$datosd.'1057,IF('.$datose.'1058>=51%,'.$datosd.'1058,IF(SUM('.$datose.'1056:'.$datose.'1057)>SUM('.$datose.'1057:'.$datose.'1058),'.$datosd.'1056,IF(SUM('.$datose.'1056:'.$datose.'1057)<SUM('.$datose.'1057:'.$datose.'1058),'.$datosd.'1058,"Algo esta Mal")))))';

        $objPHPExcel->getActiveSheet()->setCellValue($datose.'1060',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datose."1060:".$datose."1060")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');
        $objPHPExcel->getActiveSheet()->setCellValue($datose.'1062',$muestra1["nombre_conca"][$i]);
        $objPHPExcel->getActiveSheet()->getStyle($datose.'1062:'.$datose.'1062')->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('ffffff');

        $formula = '=CONCATENATE("En ","la ",'.$datosd.'5," y ",'.$datosd.'33," se observa los resultados '.$concate.' ",'.$datosd.'4," el cual aborda ",'.$datose.'1062,",en donde se demuestra que el ",ROUND('.$datosf.'8*100,0),"%"," de los ",'.$datosd.'1045," tienen una percepción de ",'.$datosg.'1046,", el ",ROUND('.$datosf.'9*100,0),"%"," ",'.$datosg.'1047,", un ",ROUND('.$datosf.'10*100,0),"%"," ",'.$datosg.'1048,",",IF('.$datose.'1049>0,CONCATENATE(" ademas el ",ROUND('.$datosf.'11*100,0),"%"," ",'.$datosg.'1049,)," "),IF('.$datose.'1049>0,CONCATENATE(" y ",ROUND('.$datosf.'12*100,0),"%",", ",'.$datosg.'1050,)," "),"en tal sentido la mayoría de los ",'.$datosd.'1045," es decir el ",ROUND('.$datose.'1053*100,0),"%"," tienen una percepción con una inclinación a un valor ",'.$datosd.'1056,","," para ",'.$datose.'1062,".")';
        $objPHPExcel->getActiveSheet()->setCellValue($datosd.'35',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($datosd."35:".$datosd."35")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($datosd."35:".$datosf."43");
        $objPHPExcel->getActiveSheet()->getStyle($datosd.'35')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($datosd.'35')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($datosd.'35:'.$datosd.'35')->getAlignment()->setWrapText(true);

        $iniciador1= $this->generar_letra($iniciador1,9);
        $letrainicio= $this->generar_letra($letrainicio,9); 
        $paginainicio2 = $this->generar_letra($paginainicio2,1); 
        $paginainicio3 =   $this->generar_letra($paginainicio2,1); 
        $paginainicio31 =   $this->generar_letra($paginainicio31,9);
        $letrainicio1= $this->generar_letra($letrainicio1,9);
        $bordeinicio = $this->generar_letra($bordefinal,3);
      }

      $nueva_hoja = $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(7); // marcar como activa la nueva hoja
    $nueva_hoja->setTitle('Por conteo Dimension 2'); // definimos el titulo
    $bordeinicio ='B';
    $paginainicio2 = 'B';
    $paginainicio3 = 'C';
    $paginainicio31 = 'E';
    $letrainicio = 'D';
    $letrainicio1 = 'F';
    $valorarr = array();
    $conteoarrd = array();
    $aux1 = 0;
    for ($i=0; $i <= $enviados["numero_indicador0"][1]; $i++) {
      $totalpagina1 = $enviados['muestra']+11;
      $totalpagina2 = $enviados['muestra']+17;
      $bordeestilo = $this->generar_letra($bordeinicio,2);
      for ($j=0; $j < 3 ; $j++) { 
        $objPHPExcel->getActiveSheet()->getColumnDimension($bordeestilo)->setWidth('26'); 
        $bordeestilo = $this->generar_letra($bordeestilo,1);   
      }

      $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7:".$paginainicio31."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($paginainicio31."7",'Frec.');
      $objPHPExcel->getActiveSheet()->getStyle($paginainicio31."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $conteoe = $paginainicio31;

      $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7:".$letrainicio1."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($letrainicio1."7",'%');
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio1."7")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $conteof = $letrainicio1;
      $conteog = $this->generar_letra($conteof,1);

      $contador = 5;
      $variables = $this->generar_letra($bordeinicio,2);
      $variables2 = $this->generar_letra($bordeinicio,3);
      $bordefinal =$this->generar_letra($bordeinicio,6);

      if ($i<$enviados["numero_indicador0"][1]) {
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordefinal.'3');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordeinicio.'3:'.$bordeinicio.'39');  
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado, $bordefinal.'3:'.$bordefinal.'39');  

      }else{
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordefinal.'3');
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordeinicio.'3:'.$bordeinicio.'39');  
        $objPHPExcel->getActiveSheet()->setSharedStyle($pintado2, $bordefinal.'3:'.$bordefinal.'39');
      }
      $conteoc = $bordeinicio;
      $conteoc++;
      $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle2, $variables."4:".$variables."4");
      $objPHPExcel->getActiveSheet()->getStyle($variables."4:".($this->generar_letra($variables,2))."4")->getFont()->setBold(true)->setName('Times New Roman')->setSize(12)->getColor()->setRGB('030303');
      if ($i<$enviados["numero_indicador0"][1]) {
       $objPHPExcel->getActiveSheet()->setCellValue($variables.'4',"Dimensión ".($i+1));
     }else{
      $objPHPExcel->getActiveSheet()->setCellValue($variables.'4',"Variable 1");
    }

    $objPHPExcel->getActiveSheet()->mergeCells($variables."4:".($this->generar_letra($variables,2))."4");
    $objPHPExcel->getActiveSheet()->getStyle($variables."4")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $conteod = $variables;

    $objPHPExcel->getActiveSheet()->getStyle($variables.$contador.":".$variables.$contador)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador),'Tabla '.($i+1));
    $objPHPExcel->getActiveSheet()->getStyle($variables.($contador+1).":".$variables.($contador+1))->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    if ($i<$enviados["numero_indicador0"][1]) {
     $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),$muestra1["nombre_indicador"][$i]);
   }else{
    $objPHPExcel->getActiveSheet()->setCellValue($variables.($contador+1),$enviados["nombre_dimension"][1]);
  }
  $conteoarrd[$i] = $variables;
  $cnuevo = 8;

  $paginainicio = 'A';
  for ($j=0; $j <= $enviados["respuesta"] ; $j++) {
    $condu = "=('".$nombrepagina2."'!"."A".$totalpagina1.")";
    $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo.":".$variables.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables.$cnuevo,$condu);
    $objPHPExcel->getActiveSheet()->getStyle($variables.$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    if($j<$enviados["respuesta"]){
      if ($i<$enviados["numero_indicador0"][1]) {
        $condu = "=COUNTIF('".$nombrepagina2."'!".$paginainicio2."5:".($this->generar_letra($paginainicio2,($enviados["numero_pregunta1"][$i] -1))).($enviados['muestra']+4).",".($j+1).")";
      }else{
        $condu = "=COUNTIF('".$nombrepagina2."'!"."B5:".($this->generar_letra("B",($enviados["itemv2"]-1))).($enviados['muestra']+4).",".($j+1).")";
      }     

      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo.":".($this->generar_letra($variables,1)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevo,$condu);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $condu = "=(".($this->generar_letra($variables,1)).$cnuevo."/".($this->generar_letra($variables,1)).(8+$enviados["respuesta"]).")";
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevo,$condu);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));  
    }

    if($j == $enviados["respuesta"] ){
      $condu = "=SUM(".($this->generar_letra($variables,1))."8:".($this->generar_letra($variables,1)).(7+$enviados["respuesta"]).")";
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,1)).$cnuevo,$condu);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,1)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

      $condu = "=SUM(".($this->generar_letra($variables,2))."8:".($this->generar_letra($variables,2)).(7+$enviados["respuesta"]).")";
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo.":".($this->generar_letra($variables,2)).$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($variables,2)).$cnuevo,$condu);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($variables,2)).$cnuevo)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


      $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".($this->generar_letra($letrainicio,2)).$cnuevo)->applyFromArray($BStyle1);

      $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($letrainicio."7:".($this->generar_letra($letrainicio,2))."7")->applyFromArray($BStyle1);
    }

    $cnuevo++;
    $totalpagina1++;
    $totalpagina2++;
  }
  $numeross = $cnuevo-2;
  $condu = "Elaboración: Propia";
  $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
  $condu = "Fuente: Encuesta aplicada";
  $cnuevo++;
  $objPHPExcel->getActiveSheet()->getStyle($letrainicio.$cnuevo.":".$letrainicio.$cnuevo)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($letrainicio.$cnuevo,$condu);
  $campo = "'Por conteo Dimension 2'";
  $labels = array(
    new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$B$1', null, 1),
  );
  $categories = array(
    new PHPExcel_Chart_DataSeriesValues('String', $campo.'!$'.$letrainicio.'$8:$'.$letrainicio.'$'.$numeross.'', null, 6),   
  );
  $values = array(
    new PHPExcel_Chart_DataSeriesValues('Number', $campo.'!$'.($this->generar_letra($letrainicio,2)).'$8:$'.($this->generar_letra($letrainicio,2)).'$'.$numeross.'', null, 4),
  );
  $series = new PHPExcel_Chart_DataSeries(
          PHPExcel_Chart_DataSeries::TYPE_BARCHART_3D,     // plotType
          PHPExcel_Chart_DataSeries::GROUPING_STACKED,  // plotGrouping
          array(0),                                     // plotOrder
          $labels,                                        // plotLabel
          $categories,                                    // plotCategory
          $values                                         // plotValues
        );  

  $series->setPlotDirection(PHPExcel_Chart_DataSeries::DIRECTION_COL);
        $layout1 = new PHPExcel_Chart_Layout();    // Create object of chart layout to set data label 

        $plotarea = new PHPExcel_Chart_PlotArea($layout1, array($series));
        $title    = new PHPExcel_Chart_Title('');  
        $legend   = new PHPExcel_Chart_Legend(PHPExcel_Chart_Legend::POSITION_RIGHT, null, false);
        $xTitle   = new PHPExcel_Chart_Title('');
        $yTitle   = new PHPExcel_Chart_Title('');
        $chart    = new PHPExcel_Chart(
          'chart1',                                       // name
          $title,                                         // title
          $legend,                                        // legend 
          $plotarea,                                      // plotArea
          true,                                           // plotVisibleOnly
          0,                                              // displayBlanksAs
          $xTitle,                                        // xAxisLabel
          $yTitle                                         // yAxisLabel
        );                      
        $chart->setTopLeftPosition($letrainicio.'18');
        $chart->setBottomRightPosition(($this->generar_letra($letrainicio,3)).'32');
        $objPHPExcel->getActiveSheet()->addChart($chart);
        $objPHPExcel->getActiveSheet()->getStyle($letrainicio."33:".$letrainicio."33")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."33",'Figura.'.($i+1));
        $objPHPExcel->getActiveSheet()->getStyle($letrainicio."34:".$letrainicio."34")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $ayuda1 = $enviados["numero_indicador0"][1] ; 
        $ayuda1 = $this->generar_letra('D',(9*$ayuda1));

        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1001","Variable");
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1001:".$conteod."1001")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1001","=(".$ayuda1."6)");
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1001:".$conteoe."1001")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1002","Dimensión");
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1002:".$conteod."1002")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1002","=(".$conteod."6)");
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1002:".$conteoe."1002")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1003","Unidad de Medida");
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1003:".$conteod."1003")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1003",$letramuestra);
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1003:".$conteoe."1003")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        
        $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1004","Valores");
        $objPHPExcel->getActiveSheet()->getStyle($conteoc."1004:".$conteoc."1004")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1005","Calificación");
        $objPHPExcel->getActiveSheet()->getStyle($conteoc."1005:".$conteoc."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1007","Calificación verdadera");
        $objPHPExcel->getActiveSheet()->getStyle($conteoc."1007:".$conteoc."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $iniciar1 = $conteod;
        for ($k=0; $k <$enviados["escala"]; $k++) { 
          $objPHPExcel->getActiveSheet()->setCellValue($iniciar1."1004",$enviados["nombre_escalav2"][$k]);
          $objPHPExcel->getActiveSheet()->getStyle($iniciar1."1004:".$iniciar1."1004")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $iniciar1++;
        }

        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1005",'=CONCATENATE('.$conteod.'8," y ",'.$conteod.'9)');
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1005:".$conteod."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1005",'='.$conteod.'10');
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1005:".$conteoe."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($conteof."1005",'=CONCATENATE('.$conteod.'11," y ",'.$conteod.'12)');
        $objPHPExcel->getActiveSheet()->getStyle($conteof."1005:".$conteof."1005")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1006",'=SUM('.$conteof.'8:'.$conteof.'9)');
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1006:".$conteod."1006")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1006")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1006",'='.$conteof.'10');
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1006:".$conteoe."1006")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1006")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($conteof."1006",'=SUM('.$conteof.'11:'.$conteof.'12)');
        $objPHPExcel->getActiveSheet()->getStyle($conteof."1006:".$conteof."1006")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteof."1006")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1007",'=SUM('.$conteod.'1006:'.$conteoe.'1006)');
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1007:".$conteod."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1007",'=SUM('.$conteoe.'1006:'.$conteof.'1006)');
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1007:".$conteoe."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteoe."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($conteof."1007",'=('.$conteod.'1007-'.$conteoe.'1007)');
        $objPHPExcel->getActiveSheet()->getStyle($conteof."1007:".$conteof."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteof."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

        $objPHPExcel->getActiveSheet()->setCellValue($conteod."1008","Valor Mayor");
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1008:".$conteod."1008")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1008",'=IF(AND('.$conteof.'1007>=-5%,'.$conteof.'1007<=5%),'.$conteoe.'1004,IF('.$conteof.'1007>=6%,'.$conteod.'1004,IF('.$conteof.'1007<=-5%,'.$conteof.'1004,'.$conteoe.'1004)))');
        $objPHPExcel->getActiveSheet()->getStyle($conteod."1008:".$conteod."1008")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


        if ($i<$enviados["numero_indicador0"][1]) {
          $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."34",$muestra1["nombre_indicador"][$i]);



          $band = 1011;
          $iniciadorb = 1016;

          for ($k=0; $k < $enviados["numero_pregunta1"][$i] ; $k++) {
            $objPHPExcel->getActiveSheet()->setCellValue($conteod.$band,"='Por Valoracion (3) Dimension 2'!".$nuevaarw[$i].$iniciadorb."");
            $objPHPExcel->getActiveSheet()->getStyle($conteod.$band.":".$conteod.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

            $objPHPExcel->getActiveSheet()->setCellValue($conteoe.$band,"='Por Valoracion (3) Dimension 2'!".$nuevaaro[$i].$iniciadorb."");
            $objPHPExcel->getActiveSheet()->getStyle($conteoe.$band.":".$conteoe.$band)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $band++;
            $iniciadorb++;
          }
          $formula2 =$conteod.'1011," ",'.$conteoe."1011".',",","asi mismo "';
          $add = 0;
          $paren ='';
          $band3 = '1012';
          for ($n=0; $n <= ($enviados["numero_pregunta1"][$i] -3) ; $n++) {
            $round =mt_rand(0,12);
            if ($add  < 1 && $n ==($enviados["numero_pregunta1"][$i] -3) ) {
              $formula2 = $formula2.','.$conteod.$band3.'," ",'.$conteoe.$band3.', ", "';
              $add++;
            }else{
              $formula2 = $formula2.','.$conteod.$band3.'," ",'.$conteoe.$band3.',", '.$conectoresoracion[$round].' "';
              $add =0;
            } 
            $band3++;
          }
          $formula2 = $formula2. ',"asi mismo ",'.$conteod.$band3.'," ",'.$conteoe.$band3.',"';
          $formula = '=CONCATENATE("En la ",'.$conteod.'5," y ",'.$conteod.'33," se puede observar que la variable ",'.$conteoe.'1001," en base a su dimensión ",'.$conteoe.'1002," es calificado como ",'.$conteoe.'1008," ya que el ",ROUND('.$conteod.'1006*100,0),"% de los resultados lo califican como ",'.$conteod.'1005,", el ",ROUND('.$conteoe.'1006*100,0),"% ",'.$conteoe.'1005," y el ",ROUND('.$conteof.'1006*100,0),"% lo califico como ",'.$conteof.'1005," estos resultados son originados debido a que, ",'.$formula2.',"," por todas estas razones, es que la variable ",'.$conteoe.'1001," basado en su dimensión ",'.$conteoe.'1002," y calificado por los ",'.$conteoe.'1003," es considerado como ",'.$conteoe.'1008,".")';

          $objPHPExcel->getActiveSheet()->setCellValue($conteod.'36',$formula);
          $objPHPExcel->getActiveSheet()->getStyle($conteod."36:".$conteod."36")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->mergeCells($conteod."36:".$conteof."47");
          $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
          $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($conteod.'36:'.$nuevoo.'36')->getAlignment()->setWrapText(true);

        }else{
          $objPHPExcel->getActiveSheet()->setCellValue($letrainicio."34",$enviados["nombre_dimension"][1]);

          $objPHPExcel->getActiveSheet()->setCellValue($conteog."1007",'=MAX('.$conteod.'1007:'.$conteoe.'1007)');
          $objPHPExcel->getActiveSheet()->getStyle($conteog."1007:".$conteog."1007")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->getStyle($conteog."1007")->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));


        //////////////////pppp
          $objPHPExcel->getActiveSheet()->setCellValue($conteoc."1015","dimensión");
          $objPHPExcel->getActiveSheet()->getStyle($conteoc."1015:".$conteoc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $objPHPExcel->getActiveSheet()->setCellValue($conteod."1015",'='.$conteod.'1005');
          $objPHPExcel->getActiveSheet()->getStyle($conteod."1015:".$conteod."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $objPHPExcel->getActiveSheet()->setCellValue($conteoe."1015",'='.$conteoe.'1005');
          $objPHPExcel->getActiveSheet()->getStyle($conteoe."1015:".$conteoe."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $objPHPExcel->getActiveSheet()->setCellValue($conteof."1015",'='.$conteof.'1005');
          $objPHPExcel->getActiveSheet()->getStyle($conteof."1015:".$conteof."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');


          $objPHPExcel->getActiveSheet()->setCellValue($conteog."1015",'MAYOR');
          $objPHPExcel->getActiveSheet()->getStyle($conteog."1015:".$conteog."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc = $conteog;
          $exc++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Valor');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$nuevot."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de verbos');
          $objPHPExcel->getActiveSheet()->getStyle($nuevou."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Verbo');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de conectores');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Conectores');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc ++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'codificación de unidades de medida');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc ++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Unidades de medida ');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $exc ++;
          $objPHPExcel->getActiveSheet()->setCellValue($exc."1015",'Concatenación');
          $objPHPExcel->getActiveSheet()->getStyle($exc."1015:".$exc."1015")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $band1 = 1016;

          for ($k=0; $k <$enviados["numero_indicador0"][1]; $k++) { 
            $formula = '=('.$conteoarrd[$k]."6".')';

            $objPHPExcel->getActiveSheet()->setCellValue($conteoc.$band1,$formula );
            $objPHPExcel->getActiveSheet()->getStyle($conteoc.$band1.":".$conteoc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

            $formula = '=('.$conteoarrd[$k]."1006".')';
            $objPHPExcel->getActiveSheet()->setCellValue($conteod.$band1,$formula );
            $objPHPExcel->getActiveSheet()->getStyle($conteod.$band1.":".$conteod.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $objPHPExcel->getActiveSheet()->getStyle($conteod.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

            $agregado = $conteoarrd[$k];
            $agregado++;
            $formula = '=('.$agregado."1006".')';
            $objPHPExcel->getActiveSheet()->setCellValue($conteoe.$band1,$formula);
            $objPHPExcel->getActiveSheet()->getStyle($conteoe.$band1.":".$conteoe.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $objPHPExcel->getActiveSheet()->getStyle($conteoe.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

            $agregado++;
            $formula = '=('.$agregado."1006".')';
            $objPHPExcel->getActiveSheet()->setCellValue($conteof.$band1,$formula);
            $objPHPExcel->getActiveSheet()->getStyle($conteof.$band1.":".$conteof.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $objPHPExcel->getActiveSheet()->getStyle($conteof.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));

            $objPHPExcel->getActiveSheet()->setCellValue($conteog.$band1,'=MAX('.$conteod.$band1.':'.$conteof.$band1.')');
            $objPHPExcel->getActiveSheet()->getStyle($conteog.$band1.":".$conteog.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $objPHPExcel->getActiveSheet()->getStyle($conteog.$band1)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
            $exc = $conteog;
            $exc++;
            $conteoh = $exc;
            $formula = '=IF('.$conteog.$band1.'='.$conteod.$band1.',$'.$conteod.'$1015,IF('.$conteog.$band1.'='.$conteoe.$band1.',$'.$conteoe.'$1015,IF('.$conteog.$band1.'='.$conteof.$band1.',$'.$conteof.'$1015,"algo esta mal")))';
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $exc++;
            $conteoi = $exc;
            $formula = '= RANDBETWEEN(1,10)';
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

            $formula = "=IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1100,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1100,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1101,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1101,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1102,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1102,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1103,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1103,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1104,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1104,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1105,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1105,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1106,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1106,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1107,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1107,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1108,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1108,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1109,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1109, A4000))))))))))";
            $exc++;
            $conteoj = $exc;
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula);
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $exc++;
            $conteok = $exc;
            $formula = '= RANDBETWEEN(1,7)';
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

            $formula = "=IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1110,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1110,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1111,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1111,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1112,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1112,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1113,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1113,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1114,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1114,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1115,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1115,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1116,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1116,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1117,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1117,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1118,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1118,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1119,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1119, A4000))))))))))";
            $exc++;
            $conteol = $exc;
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula);
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $exc++;
            $conteom = $exc;
            $formula = '= RANDBETWEEN(1,2)';
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula );
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

            $formula = "=IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1120,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1120,IF(".$exc.$band1."='Por Valoracion (3) Dimension 2'!$".$nuevov."$1121,'Por Valoracion (3) Dimension 2'!$".$nuevow."$1121,A4000))";
            $exc++; 
            $conteon = $exc;    
            $objPHPExcel->getActiveSheet()->setCellValue($exc.$band1,$formula);
            $objPHPExcel->getActiveSheet()->getStyle($exc.$band1.":".$exc.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
            $exc++; 
            $conteoo = $exc; 
            $a = $k;
            if (($a+1)!=$enviados["numero_indicador0"][1]) {
             $formula = '=CONCATENATE("el ",ROUND('.$conteog.$band1.'*100,0),"% de los ",'.$conteon.$band1.'," ",'.$conteoj.$band1.'," a la dimensión ",'.$conteoc.$band1.'," como ",'.$conteoh.$band1.',", ",'.$conteol.$band1.')';
           }else{
            $formula = '=CONCATENATE("el ",ROUND('.$conteog.$band1.'*100,0),"% de los ",'.$conteon.$band1.'," ",'.$conteoj.$band1.'," a la dimensión ",'.$conteoc.$band1.'," como ",'.$conteoh.$band1.')';
          }

          $objPHPExcel->getActiveSheet()->setCellValue($conteoo.$band1,$formula );
          $objPHPExcel->getActiveSheet()->getStyle($conteoo.$band1.":".$conteoo.$band1)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $band1++;

        }


        $band2 = 1026 + 50;


        $formula = '=MAX('.$conteod.'1016:'.$conteod.($band1 -1).')';
        $objPHPExcel->getActiveSheet()->setCellValue($conteod.$band2,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($conteod.$band2.":".$conteod.$band2)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->getStyle($conteod.$band2)->getNumberFormat()->applyFromArray(array('code' => PHPExcel_Style_NumberFormat::FORMAT_PERCENTAGE));
        $formula = '=IF('.$conteod.$band2.'='.$conteod.'1016,'.$conteoc.'1016';
        $formula2 = $conteoo.'1016';
        $paren ='';
        $band3 = '1017';
        for ($k=0; $k <($enviados["numero_indicador0"][1] -1) ; $k++) { 
          $formula = $formula.',IF('.$conteod.$band2.'='.$conteod.$band3.','.$conteoc.$band3.'';
          $formula2 = $formula2.'," ",'.$conteoo.$band3.'';
          $paren = $paren.')';
          $band3++;
        }
        $formula = $formula.$paren.')';
        $objPHPExcel->getActiveSheet()->setCellValue($conteoc.$band2,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($conteoc.$band2.":".$conteoc.$band2)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $formula = '=CONCATENATE("En la ",'.$conteod.'5," y ",'.$conteod.'33," se puede observar que la variable ",'.$conteoe."1001".'," tiene una calificación de ",'.$conteoe."1008".',","," ello debido a que el ",ROUND('.$conteoe."1006".'*100,0),"% de los resultados estan en las categorias de ",'.$conteod."1005".'," mientras que el ",ROUND('.$conteoe."1006".'*100,0),"% ",'.$conteoe."1005".'," y el ",ROUND('.$conteof."1006".'*100,0),"% ",'.$conteof."1005".'," en tal sentido se puede observar que la mayoria de los resultados es decir el ",ROUND('.$conteog."1007".'*100,0),"% tiene una calificación inclinada para un valor ",'.$conteoe."1008".'," estos resultados se originaron debido a que ",'.$formula2.',", finalmente dentro de las dimensiones evaluadas la que cuenta con mayor deficiencia es la dimensión ",'.$conteoc.$band2.','.')';

        $objPHPExcel->getActiveSheet()->setCellValue($conteod.'36',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($conteod."36:".$conteod."36")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($conteod."36:".$conteof."47");
        $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($conteod.'36')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($conteod.'36:'.$nuevoo.'36')->getAlignment()->setWrapText(true);

      }
      $letrainicio= $this->generar_letra($letrainicio,9); 
      if ($i<$enviados["numero_indicador0"][1]) {
        $paginainicio2 = $this->generar_letra($paginainicio2,($enviados["numero_pregunta1"][$i])); 
      }
      $paginainicio3 =   $this->generar_letra($paginainicio2,1); 
      $paginainicio31 =   $this->generar_letra($paginainicio31,9);
      $letrainicio1= $this->generar_letra($letrainicio1,9);
      $bordeinicio = $this->generar_letra($bordefinal,3);  
    }

/////RELACION NUMERICA /////
    $nueva_hoja = $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(8); // marcar como activa la nueva hoja
    $nueva_hoja->setTitle('Rela. ent. dimension'); // definimos el titulo
    $bordeinicio ='A';
    $partefinal = $enviados['muestra'] + 5;
    $Letra = 'C';
    $variablex = 'B';
    $aux1 = 0;
    $suma = 1;
    $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(9)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(13)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(15)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(16)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(17)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(18)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(19)->setRowHeight(-1);


    for ($i=0; $i < $enviados["numero_indicador0"][0]; $i++) {
      $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
      $color = $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
      $formula1 = $this->generar_letra($Letra,5);
      $formula2 = $this->generar_letra($Letra,6);
      $formula3 = $this->generar_letra($Letra,7);
      $formula4 = $this->generar_letra($Letra,8);
      $formula5 = $this->generar_letra($Letra,9);
      $formula6 = $this->generar_letra($Letra,10);
      $variablex1 = 'B';
      $variabley1 = 'B';
      $variabley = 'B';


      for ($j=0; $j < $enviados["numero_indicador0"][1]; $j++) {
        $variables =$this->generar_letra($bordeinicio,2);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,3);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,3);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('12');
        $variables =$this->generar_letra($bordeinicio,4);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('12');
        $variables =$this->generar_letra($bordeinicio,6);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,7);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,8);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,9);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,10);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,11);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,12);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,14);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('23');
        $variables =$this->generar_letra($bordeinicio,15);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('15');
        $variables =$this->generar_letra($bordeinicio,16);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,17);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,19);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('22');
        $variables =$this->generar_letra($bordeinicio,20);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('22');
        $variables =$this->generar_letra($bordeinicio,21);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('15');
        $variables =$this->generar_letra($bordeinicio,22);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');


        $variables = $this->generar_letra($bordeinicio,2);
        $variables2 = $this->generar_letra($bordeinicio,3);
        $bordefinal =$this->generar_letra($bordeinicio,25);
        $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.'1:'.$bordefinal.'1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
        $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.'1:'.$bordeinicio.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
        $objPHPExcel->getActiveSheet()->getStyle($bordefinal.'1:'.$bordefinal.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
        $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.$partefinal.':'.$bordefinal.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));

        $numero1 = $enviados['muestra']+8;
        $numero2 = $enviados['muestra']+9;
        $numero3 = $enviados['muestra']+10;
        $numero4 = $enviados['muestra']+11;

        $letracuadro = $this->generar_letra($bordeinicio,2);
        $letraconcatenar[0] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Probabilidad de error');
        
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[1] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Dimensión ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadro.'3');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$this->generar_letra($letracuadro,9).'8');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[2] = $letracuadro;
        $dimensiong = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Dimensión ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadro.'3');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$this->generar_letra($letracuadro,8).'9');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[3] = $letracuadro;
        $letracuadroa = $this->generar_letra($letracuadro,2);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Prueba a utilizar  ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$this->generar_letra($letracuadro,1).'8<=50,'.$this->generar_letra($letracuadro,2).'6,'.$letracuadroa.'6)');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[4] = $letracuadro;
        $letraante = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' decición ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$dimensiong.'3<5/100,"la distribución de sus valores son diferentes a la distribución normal","la distribución de sus valores no son diferentes a la distribución normal")');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[5] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' decición concreta  ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$letraante.$numero2.'="la distribución de sus valores son diferentes a la distribución normal"," es decir los datos no se encuentran normalmente distribuidos"," es decir los datos si se encuentran normalmente distribuidos")');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[6] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'decición de prueba de relación');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$letraante.$numero2.'=" es decir los datos no se encuentran normalmente distribuidos"," la prueba no paramétrica de correlación de Rho de Spearman","la prueba paramétrica de correlación de Pearson")');

        $letracuadro = $this->generar_letra($letracuadro,4);
        $letraconcatenar2[0] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'Categorización ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'dimensiones');
        
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[1] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' probabilidad de error ');
        $letracuadroa = $this->generar_letra($letracuadro,4);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'14');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'/100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 
        
        $condu = "'Criterio para el valor r'!";
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[2] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' "r" ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'13');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'*100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<='.$condu.'$A$2,'.$condu.'$C$2,IF('.$letracuadro.$numero2.'<='.$condu.'$A$3,'.$condu.'$C$3,IF('.$letracuadro.$numero2.'<='.$condu.'$A$4,'.$condu.'$C$4,IF('.$letracuadro.$numero2.'<='.$condu.'$A$5,'.$condu.'$C$5,IF('.$letracuadro.$numero2.'<='.$condu.'$A$6,'.$condu.'$C$6,IF('.$letracuadro.$numero2.'<='.$condu.'$A$8,'.$condu.'$C$7,IF('.$letracuadro.$numero2.'<='.$condu.'$A$7,'.$condu.'$C$8,IF('.$letracuadro.$numero2.'<='.$condu.'$B$9,'.$condu.'$C$9,IF('.$letracuadro.$numero2.'<='.$condu.'$B$10,'.$condu.'$C$10,IF('.$letracuadro.$numero2.'<='.$condu.'$B$11,'.$condu.'$C$11,IF('.$letracuadro.$numero2.'<='.$condu.'$B$12,'.$condu.'$C$12,IF('.$letracuadro.$numero2.'<='.$condu.'$B$13,'.$condu.'$C$13,IF('.$letracuadro.$numero2.'<='.$condu.'$B$14,'.$condu.'$C$14,"algo esta mal")))))))))))))');

        $letracuadroa = $letracuadro;
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[3] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadroa.$numero2.'<0,"menor","mayor")'); 


        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[4] = $letracuadro;
        $letraconcatenar2[5] = $this->generar_letra($letracuadro,1);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Decición ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letraconcatenar2[1].$numero3.'>=5/100,"se acepta la Ho y se rechaza la Hi","se rechaza la Ho y se acepta la Hi")');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[0] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'Categorización ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'dimensiones');
        
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[1] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' probabilidad de error ');
        $letracuadroa = $this->generar_letra($letracuadro,5);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'14');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'/100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[2] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'"Rho"');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'13');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'*100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 
        
        $letracuadroa = $letracuadro;
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[3] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadroa.$numero2.'<0,"menor","mayor")'); 


        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[4] = $letracuadro;
        $letraconcatenar3[5] = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[6] = $this->generar_letra($letracuadro,2);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Decición ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letraconcatenar3[1].$numero3.'>=5/100,"se acepta la Ho y se rechaza la Hi","se rechaza la Ho y se acepta la Hi")');                                   

        $inicio = 4;
        $ayuda1 = 4;
        $condu = "='Por Valoracion (3) Dimension'!".$variablex."2";
        $variabled = $this->generar_letra($Letra,1);
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1))."3",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3:'.($this->generar_letra($Letra,1)).'3')->getAlignment()->setWrapText(true);

        $condu = "Dimensión ".($i+1)." Variable 1";

        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1))."2",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2:'.($this->generar_letra($Letra,1)).'2')->getAlignment()->setWrapText(true);

        $condu = "Dimensión ".($j+1)." Variable 2";
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2))."2",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2:'.($this->generar_letra($Letra,2)).'2')->getAlignment()->setWrapText(true);

        $condu = "='Por Valoracion (3) Dimension 2'!".$variabley1."2";
        $variablee = $this->generar_letra($Letra,2);
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2))."3",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3:'.($this->generar_letra($Letra,2)).'3')->getAlignment()->setWrapText(true);

        for ($l=0; $l < $enviados['muestra']; $l++) {
          $condu = "='Por Valoracion (3) Dimension'!".$variablex.$ayuda1;
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1)).$inicio,$condu);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio.':'.$variables.$inicio)->getAlignment()->setWrapText(true);

          $condu = "='Por Valoracion (3) Dimension 2'!".$variabley.$ayuda1;
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2)).$inicio,$condu);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio.':'.$variables.$inicio)->getAlignment()->setWrapText(true);

          $ayuda1++;
          $condu = "=('".$nombrepagina1."'!"."A".$ayuda1.")";
          $LetraFinal = $this-> generar_letra($Letra,0);
          $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$condu);
          $objPHPExcel->getActiveSheet()->mergeCells($Letra.$inicio.":".$LetraFinal.$inicio);
          $inicio++;
        }
        $variables = $this->generar_letra($Letra,4);
        $objPHPExcel->getActiveSheet()->getStyle($variables."4:".$variables."4")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."4",'Tabla '.$suma);
        $LetraFinal = $this->generar_letra($variables,6);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."5:".$LetraFinal."5");
        $objPHPExcel->getActiveSheet()->getStyle($variables."5:".$variables."5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."5","Pruebas de normalidad");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'5:'.$variables.'5')->getAlignment()->setWrapText(true);

        $nuevot = $this->generar_letra($Letra,10);
        $formula = '=CONCATENATE("en la ",'.$variables.'4," y basándose en la prueba de ",'.$letraconcatenar[3].$numero2.'," se puede observar que, ","con una probabilidad de error de ",'.$letraconcatenar[1].$numero3.',"% para la ",'.$letraconcatenar[1].$numero1.'," ",'.$letraconcatenar[1].$numero2.'," y ",'.$letraconcatenar[2].$numero3.',"% para la ",'.$letraconcatenar[2].$numero1.'," ",'.$letraconcatenar[2].$numero2.',", ",'.$letraconcatenar[4].$numero2.','.$letraconcatenar[5].$numero2.', " por tal motivo se procederá a utilizar ",'.$letraconcatenar[6].$numero2.',".")';
        $objPHPExcel->getActiveSheet()->setCellValue($variables.'12',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".$nuevot."17");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


        $columnaa = $this->generar_letra($bordeinicio,3);
        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$columnaa."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);

        $columnab = $this->generar_letra($bordeinicio,4);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$columnab."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->mergeCells($variables."10:".$LetraFinal."10");
        $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."10","a. Corrección de significación de Lilliefors");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'10')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'10:'.$variables.'10')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->getStyle($variables."5:".$LetraFinal."5")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$LetraFinal."7")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$LetraFinal."9")->applyFromArray($BStyle);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$variables."7");

        $variables = $this->generar_letra($Letra,5);
        $LetraFinal = $this->generar_letra($variables,2);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$LetraFinal."6");
        $objPHPExcel->getActiveSheet()->getStyle($variables."6:".$variables."6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."6","Kolmogorov-Smirnova");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6:'.$variables.'6')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Estadístico");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
          $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula1."8"); 
        }        
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


        $variables = $this->generar_letra($Letra,6);
        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","gl");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
          $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula2."8");
        }      
        
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


        $variables = $this->generar_letra($Letra,7);
        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Sig.");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
          $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula3."8");
        } 
        
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


        $variables = $this->generar_letra($Letra,8);
        $LetraFinal = $this->generar_letra($variables,2);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$LetraFinal."6");
        $objPHPExcel->getActiveSheet()->getStyle($variables."6:".$variables."6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."6","Shapiro-Wilk");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6:'.$variables.'6')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Estadístico");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
          $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula4."8");
        }        
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


        $variables = $this->generar_letra($Letra,9);
        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."6")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","gl");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
          $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula5."8");
        }         
        
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


        $variables = $this->generar_letra($Letra,10);
        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Sig.");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
          $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula6."8");
        }
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);

        if ($i == 0) {
          $letraayuda[$j] =  $this->generar_letra($Letra,5);
        }else{
          $formula1 = $this->generar_letra($letraayuda[$j],0);
          $formula2 = $this->generar_letra($letraayuda[$j],1);
          $formula3 = $this->generar_letra($letraayuda[$j],2);
          $formula4 = $this->generar_letra($letraayuda[$j],3);
          $formula5 = $this->generar_letra($letraayuda[$j],4);
          $formula6 = $this->generar_letra($letraayuda[$j],5);

          $variables = $this->generar_letra($Letra,5);
          $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula1."9");
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

          $variables = $this->generar_letra($Letra,6);
          $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula2."9");
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

          $variables = $this->generar_letra($Letra,7);
          $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula3."9");
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

          $variables = $this->generar_letra($Letra,8);
          $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula4."9");
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

          $variables = $this->generar_letra($Letra,9);
          $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
          $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula5."9");
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);
          $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

          $variables = $this->generar_letra($Letra,10);
          $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula6."9");
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);
        }


////// AYUDA ///
        $variables = $this->generar_letra($variables,2);
        $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."10",'Tabla '.$suma);
        $LetraFinal = $this->generar_letra($variables,3);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."11:".$LetraFinal."11");
        $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$variables."11")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."11","Correlaciones");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'11:'.$variables.'11')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$LetraFinal."11")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$LetraFinal."12")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$LetraFinal."18")->applyFromArray($BStyle);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".($this->generar_letra($variables,1))."12");

        $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."15");
        $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."13","=".$variabled."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."16:".$variables."18");
        $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."16","=".$variablee."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."19:".$LetraFinal."19");
        $objPHPExcel->getActiveSheet()->getStyle($variables."19:".$variables."19")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."19","**. La correlación es significativa en el nivel 0,01 (2 colas).");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'19:'.$variables.'19')->getAlignment()->setWrapText(true);

        $nuevot = $this->generar_letra($variables,3);
        $formula = '=CONCATENATE("la ",'.$variables.'10," muestra los resultados de la prueba de ",'.$letraconcatenar2[3].'13,", en donde se evidencia que con una ",'.$letraconcatenar2[1].$numero1.'," del ",'.$letraconcatenar2[1].$numero3.',"% ",'.$letraconcatenar2[1].$numero4.'," ",'.$letraconcatenar2[0].$numero2.'," ",'.$letraconcatenar2[2].'13," y ",'.$letraconcatenar2[2].'16,", adicional a ello se puede observar que la fuerza y/o grado de correlación ",'.$letraconcatenar2[2].$numero1.'," tiene un valor de ",'.$letraconcatenar2[2].$numero3.',"% lo que afirma que es una ",'.$letraconcatenar2[2].$numero4.'," mismo que asu vez significa que a mayor ",'.$letraconcatenar2[4].'12," ",'.$letraconcatenar2[3].$numero4.'," ",'.$letraconcatenar2[2].'16,", por todo ello en el presente objetivo ",'.$letraconcatenar2[4].$numero4.',".")';
        

        

        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cantidadglobalmuestra,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.":".$variables.$cantidadglobalmuestra)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables.$cantidadglobalmuestra.":".$nuevot.$cantidadglobal_final);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.':'.$variables.$cantidadglobalmuestra)->getAlignment()->setWrapText(true);



        $variables = $this->generar_letra($variables,1);
        $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Correlación de Pearson");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."14:".$variables."14")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."14","Sig. (bilateral)");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'14:'.$variables.'14')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."15:".$variables."15")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."15","N");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'15:'.$variables.'15')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."16","Correlación de Pearson");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."17:".$variables."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."17","Sig. (bilateral)");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'17:'.$variables.'17')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$variables."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."18","N");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'18:'.$variables.'18')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($variables,1);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variabled."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($variables,1);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variablee."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


/////////////////AYUDA 1 //////////////
        $variables = $this->generar_letra($variables,2);
        $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."10",'Tabla '.$suma);
        $LetraFinal = $this->generar_letra($variables,4);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."11:".$LetraFinal."11");
        $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$variables."11")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."11","Correlaciones");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'11:'.$variables.'11')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$LetraFinal."11")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$LetraFinal."12")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$LetraFinal."18")->applyFromArray($BStyle);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".($this->generar_letra($variables,2))."12");


        $objPHPExcel->getActiveSheet()->mergeCells($variables."19:".$LetraFinal."19");
        $objPHPExcel->getActiveSheet()->getStyle($variables."19:".$variables."19")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."19","**. La correlación es significativa en el nivel 0,01 (2 colas).");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'19:'.$variables.'19')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."18");

        $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Rho de Spearman");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

        $nuevot = $this->generar_letra($variables,3);
        $formula = '=CONCATENATE("la ",'.$variables.'10," muestra los resultados de la prueba de ",'.$letraconcatenar3[4].'13,", en donde se evidencia que con una ",'.$letraconcatenar3[1].$numero1.'," del ",'.$letraconcatenar3[1].$numero3.',"% ",'.$letraconcatenar3[1].$numero4.'," ",'.$letraconcatenar3[0].$numero2.'," ",'.$letraconcatenar3[3].'13," y ",'.$letraconcatenar3[3].'16,", adicional a ello se puede observar que la fuerza y/o grado de correlación ",'.$letraconcatenar3[2].$numero1.'," tiene un valor de ",'.$letraconcatenar3[2].$numero3.',"% lo que afirma que es una ",'.$letraconcatenar3[2].$numero4.'," mismo que asu vez significa que a mayor ",'.$letraconcatenar3[5].'12," ",'.$letraconcatenar3[3].$numero4.'," ",'.$letraconcatenar3[6].'12,", por todo ello en el presente objetivo ",'.$letraconcatenar3[4].$numero4.',".")';


        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cantidadglobalmuestra,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.":".$variables.$cantidadglobalmuestra)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables.$cantidadglobalmuestra.":".$nuevot.$cantidadglobal_final);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.':'.$variables.$cantidadglobalmuestra)->getAlignment()->setWrapText(true);





        $variables = $this->generar_letra($variables,1);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."15");
        $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."13","=".$variabled."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."16:".$variables."18");
        $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."16","=".$variablee."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);





        $variables = $this->generar_letra($variables,1);

        $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Correlación de Rho de Spearman");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."14:".$variables."14")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."14","Sig. (bilateral)");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'14:'.$variables.'14')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."15:".$variables."15")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."15","N");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'15:'.$variables.'15')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."16","Correlación de Rho de Spearman");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."17:".$variables."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."17","Sig. (bilateral)");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'17:'.$variables.'17')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$variables."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."18","N");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'18:'.$variables.'18')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($variables,1);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variabled."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($variables,1);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variablee."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


        $bordeinicio = $bordefinal;
        $Letra = $this->generar_letra($bordeinicio,2);
        $variabley = $this->generar_letra($variabley,2);
        $variabley1 = $this->generar_letra($variabley1,2);
        $suma++;
      }



      $bordeinicio = $this->generar_letra($bordefinal,2);
      $Letra = $this->generar_letra($bordeinicio,2);
      $variablex = $this->generar_letra($variablex,2);
    } 

    $nueva_hoja = $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(9); // marcar como activa la nueva hoja
    $nueva_hoja->setTitle('Rela. dimen. ent. vari'); // definimos el titulo
    $bordeinicio ='A';
    $partefinal = $enviados['muestra'] + 5;
    $Letra = 'C';
    $variablex = 'B';
    $aux1 = 0;
    $suma = 1;
    $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(9)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(13)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(15)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(16)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(17)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(18)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(19)->setRowHeight(-1);
    $h = 1;
    for ($i=0; $i < $enviados['variable']; $i++) {      
      $h = $h-$i;  
      $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
      $color = $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
      $formula1 = $this->generar_letra($Letra,5);
      $formula2 = $this->generar_letra($Letra,6);
      $formula3 = $this->generar_letra($Letra,7);
      $formula4 = $this->generar_letra($Letra,8);
      $formula5 = $this->generar_letra($Letra,9);
      $formula6 = $this->generar_letra($Letra,10);
      $variablex1 = 'B';
      $variabley1 = 'B';
      $variabley = 'B';
      $ultimale = $enviados["numero_indicador0"][$h];


      for ($j=0; $j < $enviados["numero_indicador0"][$i]; $j++) {
        $variables =$this->generar_letra($bordeinicio,2);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,3);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,3);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('12');
        $variables =$this->generar_letra($bordeinicio,4);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('12');
        $variables =$this->generar_letra($bordeinicio,6);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,7);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,8);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,9);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,10);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,11);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,12);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
        $variables =$this->generar_letra($bordeinicio,14);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('23');
        $variables =$this->generar_letra($bordeinicio,15);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('15');
        $variables =$this->generar_letra($bordeinicio,16);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,17);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
        $variables =$this->generar_letra($bordeinicio,19);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('22');
        $variables =$this->generar_letra($bordeinicio,20);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('22');
        $variables =$this->generar_letra($bordeinicio,21);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('15');
        $variables =$this->generar_letra($bordeinicio,22);
        $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');


        $variables = $this->generar_letra($bordeinicio,2);
        $variables2 = $this->generar_letra($bordeinicio,3);
        $bordefinal =$this->generar_letra($bordeinicio,25);
        $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.'1:'.$bordefinal.'1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
        $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.'1:'.$bordeinicio.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
        $objPHPExcel->getActiveSheet()->getStyle($bordefinal.'1:'.$bordefinal.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
        $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.$partefinal.':'.$bordefinal.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));

        $letracuadro = $this->generar_letra($bordeinicio,2);
        $letraconcatenar[0] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Probabilidad de error');
        
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[1] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Dimensión ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadro.'3');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$this->generar_letra($letracuadro,9).'8');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[2] = $letracuadro;
        $dimensiong = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Variable ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadro.'3');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$this->generar_letra($letracuadro,8).'9');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[3] = $letracuadro;
        $letracuadroa = $this->generar_letra($letracuadro,2);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Prueba a utilizar  ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$this->generar_letra($letracuadro,1).'8<=50,'.$this->generar_letra($letracuadro,2).'6,'.$letracuadroa.'6)');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[4] = $letracuadro;
        $letraante = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' decición ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$dimensiong.'3<5/100,"la distribución de sus valores son diferentes a la distribución normal","la distribución de sus valores no son diferentes a la distribución normal")');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[5] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' decición concreta  ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$letraante.$numero2.'="la distribución de sus valores son diferentes a la distribución normal"," es decir los datos no se encuentran normalmente distribuidos"," es decir los datos si se encuentran normalmente distribuidos")');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar[6] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'decición de prueba de relación');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$letraante.$numero2.'=" es decir los datos no se encuentran normalmente distribuidos"," la prueba no paramétrica de correlación de Rho de Spearman","la prueba paramétrica de correlación de Pearson")');

        $letracuadro = $this->generar_letra($letracuadro,4);
        $letraconcatenar2[0] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'Categorización ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'dimensiones');
        
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[1] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' probabilidad de error ');
        $letracuadroa = $this->generar_letra($letracuadro,4);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'14');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'/100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 
        
        $condu = "'Criterio para el valor r'!";
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[2] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' "r" ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'13');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'*100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<='.$condu.'$A$2,'.$condu.'$C$2,IF('.$letracuadro.$numero2.'<='.$condu.'$A$3,'.$condu.'$C$3,IF('.$letracuadro.$numero2.'<='.$condu.'$A$4,'.$condu.'$C$4,IF('.$letracuadro.$numero2.'<='.$condu.'$A$5,'.$condu.'$C$5,IF('.$letracuadro.$numero2.'<='.$condu.'$A$6,'.$condu.'$C$6,IF('.$letracuadro.$numero2.'<='.$condu.'$A$8,'.$condu.'$C$7,IF('.$letracuadro.$numero2.'<='.$condu.'$A$7,'.$condu.'$C$8,IF('.$letracuadro.$numero2.'<='.$condu.'$B$9,'.$condu.'$C$9,IF('.$letracuadro.$numero2.'<='.$condu.'$B$10,'.$condu.'$C$10,IF('.$letracuadro.$numero2.'<='.$condu.'$B$11,'.$condu.'$C$11,IF('.$letracuadro.$numero2.'<='.$condu.'$B$12,'.$condu.'$C$12,IF('.$letracuadro.$numero2.'<='.$condu.'$B$13,'.$condu.'$C$13,IF('.$letracuadro.$numero2.'<='.$condu.'$B$14,'.$condu.'$C$14,"algo esta mal")))))))))))))');

        $letracuadroa = $letracuadro;
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[3] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadroa.$numero2.'<0,"menor","mayor")'); 


        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar2[4] = $letracuadro;
        $letraconcatenar2[5] = $this->generar_letra($letracuadro,1);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Decición ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letraconcatenar2[1].$numero3.'>=5/100,"se acepta la Ho y se rechaza la Hi","se rechaza la Ho y se acepta la Hi")');

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[0] = $letracuadro;
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'Categorización ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'dimensiones');
        
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[1] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' probabilidad de error ');
        $letracuadroa = $this->generar_letra($letracuadro,5);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'14');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'/100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 

        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[2] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'"Rho"');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'13');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'*100');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 
        
        $letracuadroa = $letracuadro;
        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[3] = $letracuadro; 
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadroa.$numero2.'<0,"menor","mayor")'); 


        $letracuadro = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[4] = $letracuadro;
        $letraconcatenar3[5] = $this->generar_letra($letracuadro,1);
        $letraconcatenar3[6] = $this->generar_letra($letracuadro,2);
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Decición ');
        $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letraconcatenar3[1].$numero3.'>=5/100,"se acepta la Ho y se rechaza la Hi","se rechaza la Ho y se acepta la Hi")');                                   

        $inicio = 4;
        $ayuda1 = 4;
        $condu = "=".$nombrehoja1[$i]."!".$parametroay[$i][$j]."2";
        $variabled = $this->generar_letra($Letra,1);
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1))."3",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3:'.($this->generar_letra($Letra,1)).'3')->getAlignment()->setWrapText(true);

        $condu = "Dimensión ".($j+1)." Variable ".($i+1);
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1))."2",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2:'.($this->generar_letra($Letra,1)).'2')->getAlignment()->setWrapText(true);

        $condu = "Variable ".($enviados["variable"]-$i);
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2))."2",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2:'.($this->generar_letra($Letra,2)).'2')->getAlignment()->setWrapText(true);

        $condu = "=".$nombrehoja[$i]."!".$parametroay[$h][$ultimale]."2";
        $variablee = $this->generar_letra($Letra,2);
        $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2))."3",$condu);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3:'.($this->generar_letra($Letra,2)).'3')->getAlignment()->setWrapText(true);

        for ($l=0; $l < $enviados['muestra']; $l++) {
          $condu = "=".$nombrehoja1[$i]."!".$parametroay[$i][$j].$ayuda1;
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1)).$inicio,$condu);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio.':'.$variables.$inicio)->getAlignment()->setWrapText(true);

          $condu = "=".$nombrehoja[$i]."!".$parametroay[$h][$ultimale].$ayuda1;
          $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2)).$inicio,$condu);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
          $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio.':'.$variables.$inicio)->getAlignment()->setWrapText(true);

          $ayuda1++;
          $condu = "=('".$nombrepagina1."'!"."A".$ayuda1.")";
          $LetraFinal = $this-> generar_letra($Letra,0);
          $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$condu);
          $objPHPExcel->getActiveSheet()->mergeCells($Letra.$inicio.":".$LetraFinal.$inicio);
          $inicio++;
        }
        $variables = $this->generar_letra($Letra,4);
        $objPHPExcel->getActiveSheet()->getStyle($variables."4:".$variables."4")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."4",'Tabla '.$suma);
        $LetraFinal = $this->generar_letra($variables,6);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."5:".$LetraFinal."5");
        $objPHPExcel->getActiveSheet()->getStyle($variables."5:".$variables."5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."5","Pruebas de normalidad");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'5:'.$variables.'5')->getAlignment()->setWrapText(true);

        $nuevot = $this->generar_letra($Letra,10);
        $formula = '=CONCATENATE("en la ",'.$variables.'4," y basándose en la prueba de ",'.$letraconcatenar[3].$numero2.'," se puede observar que, ","con una probabilidad de error de ",'.$letraconcatenar[1].$numero3.',"% para la ",'.$letraconcatenar[1].$numero1.'," ",'.$letraconcatenar[1].$numero2.'," y ",'.$letraconcatenar[2].$numero3.',"% para la ",'.$letraconcatenar[2].$numero1.'," ",'.$letraconcatenar[2].$numero2.',", ",'.$letraconcatenar[4].$numero2.','.$letraconcatenar[5].$numero2.', " por tal motivo se procederá a utilizar ",'.$letraconcatenar[6].$numero2.',".")';
        $objPHPExcel->getActiveSheet()->setCellValue($variables.'12',$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".$nuevot."17");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


        $columnaa = $this->generar_letra($bordeinicio,3);
        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$columnaa."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);

        $columnab = $this->generar_letra($bordeinicio,4);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$columnab."3");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->mergeCells($variables."10:".$LetraFinal."10");
        $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."10","a. Corrección de significación de Lilliefors");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'10')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'10:'.$variables.'10')->getAlignment()->setWrapText(true);


        $objPHPExcel->getActiveSheet()->getStyle($variables."5:".$LetraFinal."5")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$LetraFinal."7")->applyFromArray($BStyle);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$LetraFinal."9")->applyFromArray($BStyle);

        $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$variables."7");

        $variables = $this->generar_letra($Letra,5);
        $LetraFinal = $this->generar_letra($variables,2);
        $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$LetraFinal."6");
        $objPHPExcel->getActiveSheet()->getStyle($variables."6:".$variables."6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."6","Kolmogorov-Smirnova");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'6:'.$variables.'6')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Estadístico");
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

        $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        if($j != 0){
         $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula1."9"); 
       }

       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


       $variables = $this->generar_letra($Letra,6);
       $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($variables."7","gl");
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

       $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       if($j != 0){
         $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula2."9"); 
       }       
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


       $variables = $this->generar_letra($Letra,7);
       $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Sig.");
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

       $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       if($j != 0){
         $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula3."9"); 
       }   
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


       $variables = $this->generar_letra($Letra,8);
       $LetraFinal = $this->generar_letra($variables,2);
       $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$LetraFinal."6");
       $objPHPExcel->getActiveSheet()->getStyle($variables."6:".$variables."6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($variables."6","Shapiro-Wilk");
       $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'6:'.$variables.'6')->getAlignment()->setWrapText(true);


       $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Estadístico");
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

       $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       if($j != 0){
         $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula4."9"); 
       } 
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


       $variables = $this->generar_letra($Letra,9);
       $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."6")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($variables."7","gl");
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

       $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       if($j != 0){
         $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula5."9"); 
       }  
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


       $variables = $this->generar_letra($Letra,10);
       $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Sig.");
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);


       $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
       if($j != 0){
         $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula6."9"); 
       }      
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
       $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);

       if ($i == 0) {
        $letraayuda[$j] =  $this->generar_letra($Letra,5);
      }else{


        $variables = $this->generar_letra($Letra,5);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($Letra,6);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($Letra,7);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($Letra,8);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

        $variables = $this->generar_letra($Letra,9);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);
        $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

        $variables = $this->generar_letra($Letra,10);

        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);
      }


////// AYUDA ///
      $variables = $this->generar_letra($variables,2);
      $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."10",'Tabla '.$suma);
      $LetraFinal = $this->generar_letra($variables,3);
      $objPHPExcel->getActiveSheet()->mergeCells($variables."11:".$LetraFinal."11");
      $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$variables."11")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."11","Correlaciones");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'11:'.$variables.'11')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$LetraFinal."11")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$LetraFinal."12")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$LetraFinal."18")->applyFromArray($BStyle);

      $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".($this->generar_letra($variables,1))."12");

      $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."15");
      $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."13","=".$variabled."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->mergeCells($variables."16:".$variables."18");
      $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."16","=".$variablee."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->mergeCells($variables."19:".$LetraFinal."19");
      $objPHPExcel->getActiveSheet()->getStyle($variables."19:".$variables."19")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."19","**. La correlación es significativa en el nivel 0,01 (2 colas).");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'19:'.$variables.'19')->getAlignment()->setWrapText(true);

      $nuevot = $this->generar_letra($variables,3);
      $formula = '=CONCATENATE("la ",'.$variables.'10," muestra los resultados de la prueba de ",'.$letraconcatenar2[3].'13,", en donde se evidencia que con una ",'.$letraconcatenar2[1].$numero1.'," del ",'.$letraconcatenar2[1].$numero3.',"% ",'.$letraconcatenar2[1].$numero4.'," ",'.$letraconcatenar2[0].$numero2.'," ",'.$letraconcatenar2[2].'13," y ",'.$letraconcatenar2[2].'16,", adicional a ello se puede observar que la fuerza y/o grado de correlación ",'.$letraconcatenar2[2].$numero1.'," tiene un valor de ",'.$letraconcatenar2[2].$numero3.',"% lo que afirma que es una ",'.$letraconcatenar2[2].$numero4.'," mismo que asu vez significa que a mayor ",'.$letraconcatenar2[4].'12," ",'.$letraconcatenar2[3].$numero4.'," ",'.$letraconcatenar2[2].'16,", por todo ello en el presente objetivo ",'.$letraconcatenar2[4].$numero4.',".")';

        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cantidadglobalmuestra,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.":".$variables.$cantidadglobalmuestra)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables.$cantidadglobalmuestra.":".$nuevot.$cantidadglobal_final);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.':'.$variables.$cantidadglobalmuestra)->getAlignment()->setWrapText(true);


      $variables = $this->generar_letra($variables,1);
      $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Correlación de Pearson");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."14:".$variables."14")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."14","Sig. (bilateral)");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'14:'.$variables.'14')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."15:".$variables."15")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."15","N");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'15:'.$variables.'15')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."16","Correlación de Pearson");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."17:".$variables."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."17","Sig. (bilateral)");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'17:'.$variables.'17')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$variables."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."18","N");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'18:'.$variables.'18')->getAlignment()->setWrapText(true);

      $variables = $this->generar_letra($variables,1);
      $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variabled."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);

      $variables = $this->generar_letra($variables,1);
      $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variablee."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


/////////////////AYUDA 1 //////////////
      $variables = $this->generar_letra($variables,2);
      $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."10",'Tabla '.$suma);
      $LetraFinal = $this->generar_letra($variables,4);
      $objPHPExcel->getActiveSheet()->mergeCells($variables."11:".$LetraFinal."11");
      $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$variables."11")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."11","Correlaciones");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'11:'.$variables.'11')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$LetraFinal."11")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$LetraFinal."12")->applyFromArray($BStyle);
      $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$LetraFinal."18")->applyFromArray($BStyle);

      $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".($this->generar_letra($variables,2))."12");


      $objPHPExcel->getActiveSheet()->mergeCells($variables."19:".$LetraFinal."19");
      $objPHPExcel->getActiveSheet()->getStyle($variables."19:".$variables."19")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."19","**. La correlación es significativa en el nivel 0,01 (2 colas).");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'19:'.$variables.'19')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."18");

      $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Rho de Spearman");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

      $nuevot = $this->generar_letra($variables,3);
      $formula = '=CONCATENATE("la ",'.$variables.'10," muestra los resultados de la prueba de ",'.$letraconcatenar3[4].'13,", en donde se evidencia que con una ",'.$letraconcatenar3[1].$numero1.'," del ",'.$letraconcatenar3[1].$numero3.',"% ",'.$letraconcatenar3[1].$numero4.'," ",'.$letraconcatenar3[0].$numero2.'," ",'.$letraconcatenar3[3].'13," y ",'.$letraconcatenar3[3].'16,", adicional a ello se puede observar que la fuerza y/o grado de correlación ",'.$letraconcatenar3[2].$numero1.'," tiene un valor de ",'.$letraconcatenar3[2].$numero3.',"% lo que afirma que es una ",'.$letraconcatenar3[2].$numero4.'," mismo que asu vez significa que a mayor ",'.$letraconcatenar3[5].'12," ",'.$letraconcatenar3[3].$numero4.'," ",'.$letraconcatenar3[6].'12,", por todo ello en el presente objetivo ",'.$letraconcatenar3[4].$numero4.',".")';

        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cantidadglobalmuestra,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.":".$variables.$cantidadglobalmuestra)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables.$cantidadglobalmuestra.":".$nuevot.$cantidadglobal_final);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.':'.$variables.$cantidadglobalmuestra)->getAlignment()->setWrapText(true);


      $variables = $this->generar_letra($variables,1);
      $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."15");
      $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."13","=".$variabled."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->mergeCells($variables."16:".$variables."18");
      $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."16","=".$variablee."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);





      $variables = $this->generar_letra($variables,1);

      $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Correlación de Rho de Spearman");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."14:".$variables."14")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."14","Sig. (bilateral)");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'14:'.$variables.'14')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."15:".$variables."15")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."15","N");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'15:'.$variables.'15')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."16","Correlación de Rho de Spearman");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."17:".$variables."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."17","Sig. (bilateral)");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'17:'.$variables.'17')->getAlignment()->setWrapText(true);

      $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$variables."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."18","N");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'18:'.$variables.'18')->getAlignment()->setWrapText(true);

      $variables = $this->generar_letra($variables,1);
      $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variabled."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);

      $variables = $this->generar_letra($variables,1);
      $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
      $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variablee."3");
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


      $bordeinicio = $bordefinal;
      $Letra = $this->generar_letra($bordeinicio,2);
      $variabley = $this->generar_letra($variabley,2);
      $variabley1 = $this->generar_letra($variabley1,2);
      $suma++;
    }



    $bordeinicio = $this->generar_letra($bordefinal,2);
    $Letra = $this->generar_letra($bordeinicio,2);

    $variablex = $this->generar_letra($variablex,2);
  } 

  $nueva_hoja = $objPHPExcel->createSheet();
    $objPHPExcel->setActiveSheetIndex(10); // marcar como activa la nueva hoja
    $nueva_hoja->setTitle('Rela. ent. variable'); // definimos el titulo
    $bordeinicio ='A';
    $i = 0;
    $j = 0;
    $partefinal = $enviados['muestra'] + 5;
    $Letra = 'C';
    $variablex = 'B';
    $aux1 = 0;
    $suma = 1;
    $objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(6)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(8)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(9)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(10)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(11)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(13)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(14)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(15)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(16)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(17)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(18)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getRowDimension(19)->setRowHeight(-1);



    $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
    $color = $rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
    $formula1 = $this->generar_letra($Letra,5);
    $formula2 = $this->generar_letra($Letra,6);
    $formula3 = $this->generar_letra($Letra,7);
    $formula4 = $this->generar_letra($Letra,8);
    $formula5 = $this->generar_letra($Letra,9);
    $formula6 = $this->generar_letra($Letra,10);
    $variablex1 = 'B';
    $variabley1 = 'B';
    $variabley = 'B';
    $ultimale = $enviados["numero_indicador0"][0];
    $ultimale1 = $enviados["numero_indicador0"][1];  
    $variables =$this->generar_letra($bordeinicio,2);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
    $variables =$this->generar_letra($bordeinicio,3);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
    $variables =$this->generar_letra($bordeinicio,3);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('12');
    $variables =$this->generar_letra($bordeinicio,4);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('12');
    $variables =$this->generar_letra($bordeinicio,6);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
    $variables =$this->generar_letra($bordeinicio,7);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
    $variables =$this->generar_letra($bordeinicio,8);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
    $variables =$this->generar_letra($bordeinicio,9);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
    $variables =$this->generar_letra($bordeinicio,10);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
    $variables =$this->generar_letra($bordeinicio,11);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
    $variables =$this->generar_letra($bordeinicio,12);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('10');
    $variables =$this->generar_letra($bordeinicio,14);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('23');
    $variables =$this->generar_letra($bordeinicio,15);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('15');
    $variables =$this->generar_letra($bordeinicio,16);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
    $variables =$this->generar_letra($bordeinicio,17);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');
    $variables =$this->generar_letra($bordeinicio,19);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('22');
    $variables =$this->generar_letra($bordeinicio,20);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('22');
    $variables =$this->generar_letra($bordeinicio,21);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('15');
    $variables =$this->generar_letra($bordeinicio,22);
    $objPHPExcel->getActiveSheet()->getColumnDimension($variables)->setWidth('20');


    $variables = $this->generar_letra($bordeinicio,2);
    $variables2 = $this->generar_letra($bordeinicio,3);
    $bordefinal =$this->generar_letra($bordeinicio,25);
    $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.'1:'.$bordefinal.'1')->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
    $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.'1:'.$bordeinicio.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
    $objPHPExcel->getActiveSheet()->getStyle($bordefinal.'1:'.$bordefinal.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));
    $objPHPExcel->getActiveSheet()->getStyle($bordeinicio.$partefinal.':'.$bordefinal.$partefinal)->getFill()->applyFromArray(array('type' => PHPExcel_Style_Fill::FILL_SOLID,'startcolor' => array('rgb' => $color)));

    $letracuadro = $this->generar_letra($bordeinicio,2);
    $letraconcatenar[0] = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Probabilidad de error');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar[1] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Variable ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadro.'3');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$this->generar_letra($letracuadro,9).'8');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar[2] = $letracuadro;
    $dimensiong = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Variable ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadro.'3');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$this->generar_letra($letracuadro,8).'9');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar[3] = $letracuadro;
    $letracuadroa = $this->generar_letra($letracuadro,2);
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' Prueba a utilizar  ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$this->generar_letra($letracuadro,1).'8<=50,'.$this->generar_letra($letracuadro,2).'6,'.$letracuadroa.'6)');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar[4] = $letracuadro;
    $letraante = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' decición ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$dimensiong.'3<5/100,"la distribución de sus valores son diferentes a la distribución normal","la distribución de sus valores no son diferentes a la distribución normal")');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar[5] = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' decición concreta  ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$letraante.$numero2.'="la distribución de sus valores son diferentes a la distribución normal"," es decir los datos no se encuentran normalmente distribuidos"," es decir los datos si se encuentran normalmente distribuidos")');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar[6] = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'decición de prueba de relación');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'=IF('.$letraante.$numero2.'=" es decir los datos no se encuentran normalmente distribuidos"," la prueba no paramétrica de correlación de Rho de Spearman","la prueba paramétrica de correlación de Pearson")');

    $letracuadro = $this->generar_letra($letracuadro,4);
    $letraconcatenar2[0] = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'Categorización ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'dimensiones');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar2[1] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' probabilidad de error ');
    $letracuadroa = $this->generar_letra($letracuadro,4);
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'14');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'/100');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 

    $condu = "'Criterio para el valor r'!";
    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar2[2] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' "r" ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'13');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'*100');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<='.$condu.'$A$2,'.$condu.'$C$2,IF('.$letracuadro.$numero2.'<='.$condu.'$A$3,'.$condu.'$C$3,IF('.$letracuadro.$numero2.'<='.$condu.'$A$4,'.$condu.'$C$4,IF('.$letracuadro.$numero2.'<='.$condu.'$A$5,'.$condu.'$C$5,IF('.$letracuadro.$numero2.'<='.$condu.'$A$6,'.$condu.'$C$6,IF('.$letracuadro.$numero2.'<='.$condu.'$A$8,'.$condu.'$C$7,IF('.$letracuadro.$numero2.'<='.$condu.'$A$7,'.$condu.'$C$8,IF('.$letracuadro.$numero2.'<='.$condu.'$B$9,'.$condu.'$C$9,IF('.$letracuadro.$numero2.'<='.$condu.'$B$10,'.$condu.'$C$10,IF('.$letracuadro.$numero2.'<='.$condu.'$B$11,'.$condu.'$C$11,IF('.$letracuadro.$numero2.'<='.$condu.'$B$12,'.$condu.'$C$12,IF('.$letracuadro.$numero2.'<='.$condu.'$B$13,'.$condu.'$C$13,IF('.$letracuadro.$numero2.'<='.$condu.'$B$14,'.$condu.'$C$14,"algo esta mal")))))))))))))');

    $letracuadroa = $letracuadro;
    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar2[3] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadroa.$numero2.'<0,"menor","mayor")'); 


    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar2[4] = $letracuadro;
    $letraconcatenar2[5] = $this->generar_letra($letracuadro,1);
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Decición ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letraconcatenar2[1].$numero3.'>=5/100,"se acepta la Ho y se rechaza la Hi","se rechaza la Ho y se acepta la Hi")');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar3[0] = $letracuadro;
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'Categorización ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'dimensiones');

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar3[1] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,' probabilidad de error ');
    $letracuadroa = $this->generar_letra($letracuadro,5);
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'14');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'/100');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 

    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar3[2] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero1,'"Rho"');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero2,'='.$letracuadroa.'13');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'='.$letracuadro.$numero2.'*100');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadro.$numero2.'<5/100,"existe relación significativa entre las ","no existe relación entre las ")'); 

    $letracuadroa = $letracuadro;
    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar3[3] = $letracuadro; 
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letracuadroa.$numero2.'<0,"menor","mayor")'); 


    $letracuadro = $this->generar_letra($letracuadro,1);
    $letraconcatenar3[4] = $letracuadro;
    $letraconcatenar3[5] = $this->generar_letra($letracuadro,1);
    $letraconcatenar3[6] = $this->generar_letra($letracuadro,2);
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero3,'Decición ');
    $objPHPExcel->getActiveSheet()->setCellValue($letracuadro.$numero4,'=IF('.$letraconcatenar3[1].$numero3.'>=5/100,"se acepta la Ho y se rechaza la Hi","se rechaza la Ho y se acepta la Hi")');                                   
//print_r($parametroay);exit();
    
    $inicio = 4;
    $ayuda1 = 4;
    $condu = "='Por Valoracion (3) Dimension'!".$parametroay[0][$ultimale]."2";
    $variabled = $this->generar_letra($Letra,1);
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1))."3",$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'3:'.($this->generar_letra($Letra,1)).'3')->getAlignment()->setWrapText(true);

    $condu = "Variable 1";
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1))."2",$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).'2:'.($this->generar_letra($Letra,1)).'2')->getAlignment()->setWrapText(true);

    $condu = "Variable 2";
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2))."2",$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'2:'.($this->generar_letra($Letra,2)).'2')->getAlignment()->setWrapText(true);

    $condu = "='Por Valoracion (3) Dimension 2'!".$parametroay[1][$ultimale1]."2";
    $variablee = $this->generar_letra($Letra,2);
    $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2))."3",$condu);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).'3:'.($this->generar_letra($Letra,2)).'3')->getAlignment()->setWrapText(true);

    for ($l=0; $l < $enviados['muestra']; $l++) {
      $condu = "=".$nombrehoja1[0]."!".$parametroay[0][$ultimale].$ayuda1;
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,1)).$inicio,$condu);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); 
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,1)).$inicio.':'.$variables.$inicio)->getAlignment()->setWrapText(true);

      $condu = "=".$nombrehoja[0]."!".$parametroay[1][$ultimale1].$ayuda1;
      $objPHPExcel->getActiveSheet()->setCellValue(($this->generar_letra($Letra,2)).$inicio,$condu);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
      $objPHPExcel->getActiveSheet()->getStyle(($this->generar_letra($Letra,2)).$inicio.':'.$variables.$inicio)->getAlignment()->setWrapText(true);

      $ayuda1++;
      $condu = "=('".$nombrepagina1."'!"."A".$ayuda1.")";
      $LetraFinal = $this-> generar_letra($Letra,0);
      $objPHPExcel->getActiveSheet()->setCellValue($Letra.$inicio,$condu);
      $objPHPExcel->getActiveSheet()->mergeCells($Letra.$inicio.":".$LetraFinal.$inicio);
      $inicio++;
    }
    $variables = $this->generar_letra($Letra,4);
    $objPHPExcel->getActiveSheet()->getStyle($variables."4:".$variables."4")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."4",'Tabla '.$suma);
    $LetraFinal = $this->generar_letra($variables,6);
    $objPHPExcel->getActiveSheet()->mergeCells($variables."5:".$LetraFinal."5");
    $objPHPExcel->getActiveSheet()->getStyle($variables."5:".$variables."5")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."5","Pruebas de normalidad");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'5:'.$variables.'5')->getAlignment()->setWrapText(true);

    $nuevot = $this->generar_letra($Letra,10);
    $formula = '=CONCATENATE("en la ",'.$variables.'8," y basándose en la prueba de ",'.$letraconcatenar[3].$numero2.'," se puede observar que, ","con una probabilidad de error de ",'.$letraconcatenar[1].$numero3.',"% para la ",'.$letraconcatenar[1].$numero1.'," ",'.$letraconcatenar[1].$numero2.'," y ",'.$letraconcatenar[2].$numero3.',"% para la ",'.$letraconcatenar[2].$numero1.'," ",'.$letraconcatenar[2].$numero2.',", ",'.$letraconcatenar[4].$numero2.','.$letraconcatenar[5].$numero2.', " por tal motivo se procederá a utilizar ",'.$letraconcatenar[6].$numero2.',".")';
    $objPHPExcel->getActiveSheet()->setCellValue($variables.'12',$formula);
    $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".$nuevot."17");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);
    

    $columnaa = $this->generar_letra($bordeinicio,3);
    $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$columnaa."3");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);

    $columnab = $this->generar_letra($bordeinicio,4);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$columnab."3");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);


    $objPHPExcel->getActiveSheet()->mergeCells($variables."10:".$LetraFinal."10");
    $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."10","a. Corrección de significación de Lilliefors");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'10')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'10')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'10:'.$variables.'10')->getAlignment()->setWrapText(true);


    $objPHPExcel->getActiveSheet()->getStyle($variables."5:".$LetraFinal."5")->applyFromArray($BStyle);
    $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$LetraFinal."7")->applyFromArray($BStyle);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$LetraFinal."9")->applyFromArray($BStyle);

    $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$variables."7");

    $variables = $this->generar_letra($Letra,5);
    $LetraFinal = $this->generar_letra($variables,2);
    $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$LetraFinal."6");
    $objPHPExcel->getActiveSheet()->getStyle($variables."6:".$variables."6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."6","Kolmogorov-Smirnova");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'6:'.$variables.'6')->getAlignment()->setWrapText(true);

    $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Estadístico");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

    $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    if($j != 0){
     $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula1."8"); 
     $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula2."8"); 
     $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula3."8"); 
     $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula4."8"); 
     $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula5."8"); 
     $objPHPExcel->getActiveSheet()->setCellValue($variables."8","=".$formula6."8"); 
   }

   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getRowDimension(12)->setRowHeight(-1);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


   $variables = $this->generar_letra($Letra,6);
   $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($variables."7","gl");
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

   $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


   $variables = $this->generar_letra($Letra,7);
   $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Sig.");
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

   $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


   $variables = $this->generar_letra($Letra,8);
   $LetraFinal = $this->generar_letra($variables,2);
   $objPHPExcel->getActiveSheet()->mergeCells($variables."6:".$LetraFinal."6");
   $objPHPExcel->getActiveSheet()->getStyle($variables."6:".$variables."6")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($variables."6","Shapiro-Wilk");
   $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'6:'.$variables.'6')->getAlignment()->setWrapText(true);


   $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Estadístico");
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

   $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


   $variables = $this->generar_letra($Letra,9);
   $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."6")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($variables."7","gl");
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);

   $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);


   $variables = $this->generar_letra($Letra,10);
   $objPHPExcel->getActiveSheet()->getStyle($variables."7:".$variables."7")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
   $objPHPExcel->getActiveSheet()->setCellValue($variables."7","Sig.");
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'7:'.$variables.'7')->getAlignment()->setWrapText(true);


   $objPHPExcel->getActiveSheet()->getStyle($variables."8:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
   $objPHPExcel->getActiveSheet()->getStyle($variables.'8:'.$variables.'8')->getAlignment()->setWrapText(true);

   if ($i == 0) {
    $letraayuda[$j] =  $this->generar_letra($Letra,5);
  }else{
    $formula1 = $this->generar_letra($letraayuda[$j],0);
    $formula2 = $this->generar_letra($letraayuda[$j],1);
    $formula3 = $this->generar_letra($letraayuda[$j],2);
    $formula4 = $this->generar_letra($letraayuda[$j],3);
    $formula5 = $this->generar_letra($letraayuda[$j],4);
    $formula6 = $this->generar_letra($letraayuda[$j],5);

    $variables = $this->generar_letra($Letra,5);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula1."9");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

    $variables = $this->generar_letra($Letra,6);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."8")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula2."9");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

    $variables = $this->generar_letra($Letra,7);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula3."9");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

    $variables = $this->generar_letra($Letra,8);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula4."9");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);

    $variables = $this->generar_letra($Letra,9);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula5."9");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);
    $objPHPExcel->getActiveSheet()->getStyle($variables."9:".$variables."9")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');

    $variables = $this->generar_letra($Letra,10);
    $objPHPExcel->getActiveSheet()->setCellValue($variables."9","=".$formula6."9");
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
    $objPHPExcel->getActiveSheet()->getStyle($variables.'9:'.$variables.'9')->getAlignment()->setWrapText(true);
  }


////// AYUDA ///
  $variables = $this->generar_letra($variables,2);
  $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."10",'Tabla '.$suma);
  $LetraFinal = $this->generar_letra($variables,3);
  $objPHPExcel->getActiveSheet()->mergeCells($variables."11:".$LetraFinal."11");
  $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$variables."11")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."11","Correlaciones");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'11:'.$variables.'11')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$LetraFinal."11")->applyFromArray($BStyle);
  $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$LetraFinal."12")->applyFromArray($BStyle);
  $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$LetraFinal."18")->applyFromArray($BStyle);

  $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".($this->generar_letra($variables,1))."12");

  $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."15");
  $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."13","=".$variabled."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->mergeCells($variables."16:".$variables."18");
  $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."16","=".$variablee."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->mergeCells($variables."19:".$LetraFinal."19");
  $objPHPExcel->getActiveSheet()->getStyle($variables."19:".$variables."19")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."19","**. La correlación es significativa en el nivel 0,01 (2 colas).");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'19:'.$variables.'19')->getAlignment()->setWrapText(true);

  $nuevot = $this->generar_letra($variables,3);
  $formula = '=CONCATENATE("la ",'.$variables.'10," muestra los resultados de la prueba de ",'.$letraconcatenar2[3].'13,", en donde se evidencia que con una ",'.$letraconcatenar2[1].$numero1.'," del ",'.$letraconcatenar2[1].$numero3.',"% ",'.$letraconcatenar2[1].$numero4.'," ",'.$letraconcatenar2[0].$numero2.'," ",'.$letraconcatenar2[2].'13," y ",'.$letraconcatenar2[2].'16,", adicional a ello se puede observar que la fuerza y/o grado de correlación ",'.$letraconcatenar2[2].$numero1.'," tiene un valor de ",'.$letraconcatenar2[2].$numero3.',"% lo que afirma que es una ",'.$letraconcatenar2[2].$numero4.'," mismo que asu vez significa que a mayor ",'.$letraconcatenar2[4].'12," ",'.$letraconcatenar2[3].$numero4.'," ",'.$letraconcatenar2[2].'16,", por todo ello en el presente objetivo ",'.$letraconcatenar2[4].$numero4.',".")';

        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cantidadglobalmuestra,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.":".$variables.$cantidadglobalmuestra)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables.$cantidadglobalmuestra.":".$nuevot.$cantidadglobal_final);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.':'.$variables.$cantidadglobalmuestra)->getAlignment()->setWrapText(true);

  $variables = $this->generar_letra($variables,1);
  $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Correlación de Pearson");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."14:".$variables."14")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."14","Sig. (bilateral)");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'14:'.$variables.'14')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."15:".$variables."15")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."15","N");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'15:'.$variables.'15')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."16","Correlación de Pearson");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."17:".$variables."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."17","Sig. (bilateral)");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'17:'.$variables.'17')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$variables."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."18","N");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'18:'.$variables.'18')->getAlignment()->setWrapText(true);

  $variables = $this->generar_letra($variables,1);
  $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variabled."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);

  $variables = $this->generar_letra($variables,1);
  $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variablee."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


/////////////////AYUDA 1 //////////////
  $variables = $this->generar_letra($variables,2);
  $objPHPExcel->getActiveSheet()->getStyle($variables."10:".$variables."10")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."10",'Tabla '.$suma);
  $LetraFinal = $this->generar_letra($variables,4);
  $objPHPExcel->getActiveSheet()->mergeCells($variables."11:".$LetraFinal."11");
  $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$variables."11")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."11","Correlaciones");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'11')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'11:'.$variables.'11')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."11:".$LetraFinal."11")->applyFromArray($BStyle);
  $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$LetraFinal."12")->applyFromArray($BStyle);
  $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$LetraFinal."18")->applyFromArray($BStyle);

  $objPHPExcel->getActiveSheet()->mergeCells($variables."12:".($this->generar_letra($variables,2))."12");


  $objPHPExcel->getActiveSheet()->mergeCells($variables."19:".$LetraFinal."19");
  $objPHPExcel->getActiveSheet()->getStyle($variables."19:".$variables."19")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."19","**. La correlación es significativa en el nivel 0,01 (2 colas).");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'19')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'19:'.$variables.'19')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."18");

  $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Rho de Spearman");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

  $nuevot = $this->generar_letra($variables,3);
  $formula = '=CONCATENATE("la ",'.$variables.'10," muestra los resultados de la prueba de ",'.$letraconcatenar3[4].'13,", en donde se evidencia que con una ",'.$letraconcatenar3[1].$numero1.'," del ",'.$letraconcatenar3[1].$numero3.',"% ",'.$letraconcatenar3[1].$numero4.'," ",'.$letraconcatenar3[0].$numero2.'," ",'.$letraconcatenar3[3].'13," y ",'.$letraconcatenar3[3].'16,", adicional a ello se puede observar que la fuerza y/o grado de correlación ",'.$letraconcatenar3[2].$numero1.'," tiene un valor de ",'.$letraconcatenar3[2].$numero3.',"% lo que afirma que es una ",'.$letraconcatenar3[2].$numero4.'," mismo que asu vez significa que a mayor ",'.$letraconcatenar3[5].'12," ",'.$letraconcatenar3[3].$numero4.'," ",'.$letraconcatenar3[6].'12,", por todo ello en el presente objetivo ",'.$letraconcatenar3[4].$numero4.',".")';

        $objPHPExcel->getActiveSheet()->setCellValue($variables.$cantidadglobalmuestra,$formula);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.":".$variables.$cantidadglobalmuestra)->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
        $objPHPExcel->getActiveSheet()->mergeCells($variables.$cantidadglobalmuestra.":".$nuevot.$cantidadglobal_final);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle($variables.$cantidadglobalmuestra.':'.$variables.$cantidadglobalmuestra)->getAlignment()->setWrapText(true);


  $variables = $this->generar_letra($variables,1);
  $objPHPExcel->getActiveSheet()->mergeCells($variables."13:".$variables."15");
  $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."13","=".$variabled."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->mergeCells($variables."16:".$variables."18");
  $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."16","=".$variablee."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);





  $variables = $this->generar_letra($variables,1);

  $objPHPExcel->getActiveSheet()->getStyle($variables."13:".$variables."13")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."13","Correlación de Rho de Spearman");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'13:'.$variables.'13')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."14:".$variables."14")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."14","Sig. (bilateral)");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'14')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'14:'.$variables.'14')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."15:".$variables."15")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."15","N");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'15')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'15:'.$variables.'15')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."16:".$variables."16")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."16","Correlación de Rho de Spearman");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'16:'.$variables.'16')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."17:".$variables."17")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."17","Sig. (bilateral)");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'17')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'17:'.$variables.'17')->getAlignment()->setWrapText(true);

  $objPHPExcel->getActiveSheet()->getStyle($variables."18:".$variables."18")->getFont()->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."18","N");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'18:'.$variables.'18')->getAlignment()->setWrapText(true);

  $variables = $this->generar_letra($variables,1);
  $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variabled."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);

  $variables = $this->generar_letra($variables,1);
  $objPHPExcel->getActiveSheet()->getStyle($variables."12:".$variables."12")->getFont()->setBold(true)->setName('Times New Roman')->setSize(10)->getColor()->setRGB('030303');
  $objPHPExcel->getActiveSheet()->setCellValue($variables."12","=".$variablee."3");
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
  $objPHPExcel->getActiveSheet()->getStyle($variables.'12:'.$variables.'12')->getAlignment()->setWrapText(true);


  $bordeinicio = $bordefinal;
  $Letra = $this->generar_letra($bordeinicio,2);
  $variabley = $this->generar_letra($variabley,2);
  $variabley1 = $this->generar_letra($variabley1,2);
  $suma++;




  $bordeinicio = $this->generar_letra($bordefinal,2);
  $Letra = $this->generar_letra($bordeinicio,2);
  $variablex = $this->generar_letra($variablex,2);

  $nueva_hoja = $objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(11); // marcar como activa la nueva hoja
$nueva_hoja->setTitle('Criterio para el valor r'); // definimos el titulo

PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel->getActiveSheet()->getStyle("A2:A14")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat :: FORMAT_NUMBER_00);
$objPHPExcel->getActiveSheet()->setCellValue("A1","Desde");
$objPHPExcel->getActiveSheet()->setCellValue("A2",-0.91);
$objPHPExcel->getActiveSheet()->setCellValue("A3",-0.76);
$objPHPExcel->getActiveSheet()->setCellValue("A4",-0.51);
$objPHPExcel->getActiveSheet()->setCellValue("A5",-0.26);
$objPHPExcel->getActiveSheet()->setCellValue("A6",-0.11);
$objPHPExcel->getActiveSheet()->setCellValue("A7",-0.01);
$objPHPExcel->getActiveSheet()->setCellValue("A8",0.00);
$objPHPExcel->getActiveSheet()->setCellValue("A9",0.01);
$objPHPExcel->getActiveSheet()->setCellValue("A10",0.11);
$objPHPExcel->getActiveSheet()->setCellValue("A11",0.26);
$objPHPExcel->getActiveSheet()->setCellValue("A12",0.51);
$objPHPExcel->getActiveSheet()->setCellValue("A13",0.76);
$objPHPExcel->getActiveSheet()->setCellValue("A14",0.91);

$objPHPExcel->getActiveSheet()->getStyle("B2:B14")->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat :: FORMAT_NUMBER_00);
$objPHPExcel->getActiveSheet()->setCellValue("B1","Hasta");
$objPHPExcel->getActiveSheet()->setCellValue("B2",-1.00);
$objPHPExcel->getActiveSheet()->setCellValue("B3",-0.90);
$objPHPExcel->getActiveSheet()->setCellValue("B4",-0.75);
$objPHPExcel->getActiveSheet()->setCellValue("B5",-0.50);
$objPHPExcel->getActiveSheet()->setCellValue("B6",-0.25);
$objPHPExcel->getActiveSheet()->setCellValue("B7",-0.10);
$objPHPExcel->getActiveSheet()->setCellValue("B8",0.00);
$objPHPExcel->getActiveSheet()->setCellValue("B9",0.10);
$objPHPExcel->getActiveSheet()->setCellValue("B10",0.25);
$objPHPExcel->getActiveSheet()->setCellValue("B11",0.50);
$objPHPExcel->getActiveSheet()->setCellValue("B12",0.75);
$objPHPExcel->getActiveSheet()->setCellValue("B13",0.90);
$objPHPExcel->getActiveSheet()->setCellValue("B14",1.00);

$objPHPExcel->getActiveSheet()->setCellValue("C1","Significado");
$objPHPExcel->getActiveSheet()->setCellValue("C2","Correlación negativa perfecta");
$objPHPExcel->getActiveSheet()->setCellValue("C3","Correlación negativa muy fuerte");
$objPHPExcel->getActiveSheet()->setCellValue("C4","Correlación negativa considerable");
$objPHPExcel->getActiveSheet()->setCellValue("C5","Correlación negativa media");
$objPHPExcel->getActiveSheet()->setCellValue("C6","Correlación negativa débil");
$objPHPExcel->getActiveSheet()->setCellValue("C7","Correlación negativa muy débil");
$objPHPExcel->getActiveSheet()->setCellValue("C8","No existe correlación alguna entre las variables");
$objPHPExcel->getActiveSheet()->setCellValue("C9","Correlación positiva muy débil");
$objPHPExcel->getActiveSheet()->setCellValue("C10","Correlación positiva débil");
$objPHPExcel->getActiveSheet()->setCellValue("C11","Correlación positiva media");
$objPHPExcel->getActiveSheet()->setCellValue("C12","Correlación positiva considerable");
$objPHPExcel->getActiveSheet()->setCellValue("C13","Correlación positiva muy fuerte");
$objPHPExcel->getActiveSheet()->setCellValue("C14","Correlación positiva perfecta");


}




// Save Excel 2007 file

$nombreexcel  = "archivo";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombreexcel.'.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0


$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->setIncludeCharts(TRUE);        
ob_start();
$objWriter->save("descargar/Tabulacion.xlsx");
$xlsData = ob_get_contents();
ob_end_clean();
$objPHPExcel->disconnectWorksheets();
unset($objPHPExcel);



$time_end = microtime(true);
$time_total = $time_end - $time_start;
// echo (json_encode($response,$time_total));




$json_string = json_encode($enviados);
$file = 'descargar/Tabulacion.json';
file_put_contents($file, $json_string);




$value=array();
$value[1]="descargar/Tabulacion.json";
$value[2]="descargar/Tabulacion.xlsx";
$tmp_file  = "descargar/Tabulaciones.zip";
$zip = new ZipArchive;
if ($zip->open($tmp_file,  ZipArchive::CREATE)) {
        $zip->addFile($value[1], 'Tabulacion.json');
        $zip->addFile($value[2], 'Tabulacion.xlsx');
        $zip->close();
   } else {
       echo 'Failed!';
   }
echo json_encode('1');
exit();
//$this->zip->read_file($value[0],TRUE);   
//$this->zip->read_file($value[1],TRUE); 
//$this->zip->read_file($value[2],TRUE); 
//ob_start();

//($this->zip->download('php://output'));
//$xlsData = ob_get_contents();
//ob_end_clean();
//$response =  array(
//  'status' => true,
//  'file' => "data:application/zip;base64,".base64_encode($xlsData)
//);
//
       
}

function testFormula($sheet,$cell) {
    $formulaValue = $sheet->getCell($cell)->getValue();
    echo 'Formula Value is' , $formulaValue , PHP_EOL;
    $expectedValue = $sheet->getCell($cell)->getOldCalculatedValue();
    echo 'Expected Value is '  , 
          ((!is_null($expectedValue)) ? 
              $expectedValue : 
              'UNKNOWN'
          ) , PHP_EOL;

    $calculate = false;
    try {
        $tokens = PHPExcel_Calculation::getInstance()->parseFormula($formulaValue,$sheet->getCell($cell));
        echo 'Parser Stack :-' , PHP_EOL;
        print_r($tokens);
        echo PHP_EOL;
        $calculate = true;
    } catch (Exception $e) {
        echo 'PARSER ERROR: ' , $e->getMessage() , PHP_EOL;

        echo 'Parser Stack :-' , PHP_EOL;
        print_r($tokens);
        echo PHP_EOL;
    }

    if ($calculate) {
        try {
            $cellValue = $sheet->getCell($cell)->getCalculatedValue();
            echo 'Calculated Value is ' , $cellValue , PHP_EOL;

            echo 'Evaluation Log:' , PHP_EOL;
            print_r(PHPExcel_Calculation::getInstance()->debugLog);
            echo PHP_EOL;
        } catch (Exception $e) {
            echo 'CALCULATION ENGINE ERROR: ' , $e->getMessage() , PHP_EOL;

            echo 'Evaluation Log:' , PHP_EOL;
            print_r(PHPExcel_Calculation::getInstance()->debugLog);
            echo PHP_EOL;
        }
    }
}


public  function generar_letra($letra,$cantidad){
  $Letra=$letra;
  $Cantidad_de_columnas_a_crear=$cantidad; 
  $Contador=0; 
  while($Contador<$Cantidad_de_columnas_a_crear) 
  { 
    $Contador++; 
    $Letra++; 
  } 
  return $Letra;
}

public function generar_numero($desde,$hasta,$num_escala,$respuesta,$num_deficit,$escala){  
  $numero=0;
  if((int)$escala-1==$num_escala){
    $hasta=$hasta-($this->cantidad($respuesta)*$num_deficit);
    $numero= mt_rand ($desde ,$hasta);
  }
  else{
    $numero= mt_rand ($desde ,$hasta);
  }
  return $numero;
}

public function hallarModa($excel = array(),$prim,$ult,$k){
  $i=0; $frec=0; $maxfrec=0; $moda=0;
  if ($prim == $ult){
    return $excel[$prim][$k];
  }
  $moda = $excel[$prim][$k];
  $maxfrec =$this->Contador($excel,$excel[$prim][$k],$prim,$ult,$k);
  for ($i = $prim + 1; $i<=$ult; $i++) {
    $frec = $this->Contador ($excel, $excel[$i][$k], $i, $ult,$k);
    if ($frec > $maxfrec) {
      $maxfrec = $frec;
      $moda = $excel[$i][$k];
    }
  }

  return $moda;
}

public function Contador ($excel = array(),$p,$prim,$ult,$k){
  $i=0; $suma=0;
  if ($prim > $ult){return 0;}
  $suma = 0;
  for ($i = $prim; $i<= $ult; $i++)
    if($excel[$i][$k] == $p){
      $suma++;
    }

    return $suma;

  }

  public function generar_array($desde,$hasta,$tam,$max,$deficit=array(),$cant,$num_a){
    do{ 
      $sum=0;
      $data=array();
      for ($i=1; $i <=$tam ; $i++){
        if($deficit[$i]==0){

          if($cant == 3){
            $rand = mt_rand(1,5);
            if($num_a == 0){
              if($rand != 1 ){
                $data[$i]= mt_rand(1,2);  
              }else{
                $data[$i]= mt_rand(3,5);
              }              
            }
            if($num_a ==1){
              if($rand > 2 ){
                $data[$i]= mt_rand(1,3);  
              }else{
                $data[$i]= mt_rand(4,5);
              }            
            }
            if($num_a == 2){
              if($rand > 1 ){
                $data[$i]= mt_rand(3,5);  
              }else{
                $data[$i]= mt_rand(1,5);
              }            
            }            
          }

          if($cant == 2){
            $rand = mt_rand(1,5);
            if($num_a == 0){
              if($rand != 2 ){
                $data[$i]= mt_rand(1,2);  
              }else{
                $data[$i]= mt_rand(3,5);
              }                 
            }
            if($num_a == 1){
              if($rand > 2 ){
                $data[$i]= mt_rand(1,5);  
              }else{
                $data[$i]= mt_rand(5,5);
              }
            } 
          }
          if($cant == 4){
            $rand = mt_rand(1,5);
            if($num_a == 0){
              if($rand < 5 ){
                $data[$i]= mt_rand(1,2);  
              }else{
                $data[$i]= mt_rand(1,5);
              }                 
            }
            if($num_a == 1){
              if($rand > 2 ){
                $data[$i]= mt_rand(1,3);  
              }else{
                $data[$i]= mt_rand(1,5);
              }
            }
            if($num_a == 2){
              if($rand < 3 ){
                $data[$i]= mt_rand(1,4);  
              }else{
                $data[$i]= mt_rand(4,5);
              }                 
            }
            if($num_a == 3){
              if($rand < 5  ){
                $data[$i]= mt_rand(4,5);  
              }else{
                $data[$i]= mt_rand(1,5);
              }
            } 
          }
          if ($i>1) {
            if($data[$i-1] == 1 ){
             $data[$i]=mt_rand(1,3);
           }
           if($data[$i-1] == 2 ){
             $data[$i]=mt_rand(1,4);
           }
           if($data[$i-1] == 4 ){
             $data[$i]=mt_rand(2,5);
           }
           if($data[$i-1] == 5 ){
             $data[$i]=mt_rand(3,5);
           }

         }
       }else{
        $dat=$this->generar_deficit($max);
        $data[$i]=mt_rand(1,$dat);
      }

      $sum+= $data[$i];
    }
    $data[$tam+1] = $sum;
  } while($sum<$desde || $sum>$hasta);
  return $data;
} 

public function generar_deficit($max)
{
  $respuesta=0;

  switch ($max) {
    case 1:
    return $respuesta=1 ;
    break;
    case 2:
    return $respuesta=1;
    break;
    case 3:
    return $respuesta=1;
    break;
    case 4:
    return $respuesta=2;
    break;
    case 5:
    return $respuesta=3;

    break;
    
  }

}
public function cantidad($max)
{
  $respuesta=0;

  switch ($max) {
    case 1:
    return $respuesta=1 ;
    break;
    case 2:
    return $respuesta=1;

    break;
    case 3:
    return $respuesta=1;
    break;
    case 4:
    return $respuesta=2;
    break;
    case 5:
    return $respuesta=2;

    break;
    
  }

}

public function distribucion_normal()
{
  $datos=array(1.352,1.420,1.594,1.614,1.628,1.692,1.0080,1.924,2.132);
  $data_acumulaciones=array();
  $data_tipificada=array();
  $data_buscada=array();
  $data_buscada_acumulacion_2=array();
  $data_inicio=$datos;
  $tam=count($datos);
  sort($datos);
  $data_ordenada=$datos;
  $data_buscada_acumulacion=array();
  $sum=0;
  foreach ($data_inicio as $key => $value) {
    $sum=$sum+$value;
  }
  $media=round($sum/$tam,3);
  $sum_des=0;
  foreach ($data_inicio as $key => $value) {
    $valor=$value-$media;
    $sum_des=$sum_des+pow($valor,2);
  }
  $desv=round(sqrt($sum_des/($tam-1)),3);

  for ($i=0; $i <$tam ; $i++) { 
    $data_acumulaciones[$i]=round(($i+1)/$tam,3);
  }
  foreach ($data_ordenada as $key => $value) {
    $data_tipificada[$key]=round(($value-$media)/$desv,3);
  }
     //print_r($data_tipificada);
  foreach ($data_tipificada as $key => $value) {
    $ver_data=abs($value);
    $datos=(string)$ver_data;
    $fila=substr($datos,0,3); 
    $columna=substr($datos,3,1);
    $sql=$this->Mantenimiento_m->consulta2("SELECT * FROM fila_normal,columna_normal,tabla_normal where fila_normal.id_fila=tabla_normal.id_fila
      and tabla_normal.id_columna=columna_normal.id_columna and 
      columna_normal.col_descripcion=".$columna." and fila_normal.fila_descripcion=".$fila);
    if($value<0){ 
      $data_buscada[$key]=(float)$sql->numero;
    }
    else{
     $data_buscada[$key]=1-(float)$sql->numero;

   }

 }
     //print_r($data_buscada);
    //print_r($data_tipificada);Ç
 for ($i=0; $i <$tam ; $i++) { 
   $data_buscada_acumulacion[$i]=abs($data_acumulaciones[$i]-$data_buscada[$i]);
   if($i==0){
    $data_buscada_acumulacion_2[$i]=abs(0-$data_buscada[$i]);
  }
  else{
   $data_buscada_acumulacion_2[$i]=abs($data_acumulaciones[$i-1]-$data_buscada[$i]);
 }

}
$may1=0;
$may=0;
for ($i=0; $i <$tam ; $i++) { 
  if($i==0){
   $may=$data_buscada_acumulacion[$i];
   $may1=$data_buscada_acumulacion_2[$i];
 }
 else{
  if($data_buscada_acumulacion[$i]>$may){$may=$data_buscada_acumulacion[$i];}
  if($data_buscada_acumulacion_2[$i]>$may1){ $may1=$data_buscada_acumulacion_2[$i];}

}

}

if($may>$may1)
{
 echo $may;
}
else{

 echo $may1;

}




}

}

?>