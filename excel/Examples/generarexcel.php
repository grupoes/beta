<?php
try{
	$usuario="GrupoES";
	$password="GrupoES123";
	
    $db="consultoria2";
    $conn = new PDO('mysql:host=localhost;dbname='.$db, $usuario, $password);
   
}catch(PDOException $e){
    echo "ERROR: " . $e->getMessage();
}

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/../Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$styleArray = array(
 'alignment' => array(
            'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
        ),
    'font'  => array(
        'bold'  => true,
     
        'size'  => 10,
        'name'  => 'Arial'
    ));



function cellColor($cells,$color){
    global $objPHPExcel;

    $objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
             'rgb' => $color
        )
    ));
}
cellColor('A1', 'FFFF99');
cellColor('B1', 'FFFF99');
cellColor('C1', 'FFFF99');
cellColor('D1', 'FFFF99');
cellColor('E1', 'FFFF99');
cellColor('F1', 'FFFF99');
cellColor('G1', 'FFFF99');
cellColor('H1', 'FFFF99');
cellColor('I1', 'FFFF99');
cellColor('J1', 'FFFF99');
cellColor('K1', 'FFFF99');
cellColor('L1', 'FFFF99');
// Set document properties
$objPHPExcel->getProperties()->setCreator("ESconsultores")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");


// Add some data
                             /*
							$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('A1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('B1')->setWidth('220');

								$objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('C1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('D1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('E1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('F1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('G1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('H1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('I1')->setWidth('15');

								$objPHPExcel->getActiveSheet()->getStyle('J1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('J1')->setWidth('15');

							$objPHPExcel->getActiveSheet()->getStyle('K1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('K1')->setWidth('15');

							$objPHPExcel->getActiveSheet()->getStyle('L1')->applyFromArray($styleArray);
							$objPHPExcel->getActiveSheet()->getColumnDimensionByColumn('L1')->setWidth('15');
                            */

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'FECHA')
            ->setCellValue('B1', 'TIPO_MONEDA')
            ->setCellValue('C1', 'DOCUMENTO')
            ->setCellValue('D1', '#_DOCUMENTO')
             ->setCellValue('E1', 'CONDICION')
              ->setCellValue('F1', 'RUC')
               ->setCellValue('G1', 'RAZON_SOCIAL')
              ->setCellValue('H1', 'VVENTA')
              ->setCellValue('I1', ' VALOR_DE_VENTA')
             ->setCellValue('J1', ' IGV')
  ->setCellValue('K1', 'TOTAL')
             ->setCellValue('L1', '   TIPO_CAMBIO');  
            
      


// Miscellaneous glyphs, UTF-8
 $sql="select * from comprobante,tipo_comprobante,tipo_moneda
where  comprobante.id_tipo_comprobante=tipo_comprobante.id_tipo_comprobante and tipo_moneda.id_tipo_moneda=comprobante.id_tipo_moneda
and comprobante.comprobante_tipo_estado=1 and comprobante.ruc_empresa_numero=".$_GET["id"]."
 and comprobante.comprobante_fecha BETWEEN '".$_GET["inicio"]."' and '".$_GET["fin"]."' order by tipo_comprobante.id_tipo_comprobante desc,
comprobante.comprobante_documento_serie_caracteristicas asc
,comprobante.comprobante_fecha asc, comprobante.comprobante_documento_serie_numero asc";
$C=2;
 $resultado = $conn->query($sql); 

 foreach ($resultado as $key => $value) {


 	$myDateTime = DateTime::createFromFormat('Y-m-d', $value["comprobante_fecha"]);
   $dat=(string)  $myDateTime->format('d/m/Y');
 	//echo date_format($value["comprobante_fecha"], 'd/m/Y');
 $ayuda="";
 if($value['id_tipo_comprobante']==3)
 {
     $ayuda="B";
 }
 if($value['id_tipo_comprobante']==4)
 {
    $ayuda="F";
 }

 if($_GET["igv"]=="1")
 {
      $monto=(float)$value['comprobante_venta']/1.18;
      $igv=(float)$value['comprobante_venta']-(float)$monto;


 }
 else
 {
    $igv="0.00";
    $monto=$value['comprobante_venta'];
 }



  list($codigo,$nombre_razon)=datos($value['comprobante_venta'],$value['comprobante_nombre_razon'],$value['id_tipo_comprobante'],$value['comprobante_ruc'],$conn);


             $objPHPExcel->getActiveSheet()->setCellValue('A'.$C,  $dat);
          
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$C, $value["tipo_moneda_descripcion"]);
             $objPHPExcel->getActiveSheet()->setCellValue('C'.$C, $value['tipo_comprobante_nombre']);
             $objPHPExcel->getActiveSheet()->setCellValue('D'.$C, $ayuda.$value['comprobante_documento_serie_caracteristicas']."-".$value['comprobante_documento_serie_numero']);
             $objPHPExcel->getActiveSheet()->setCellValue('E'.$C, 'A');
             $objPHPExcel->getActiveSheet()->setCellValueExplicit('F'.$C, $codigo,PHPExcel_Cell_DataType::TYPE_STRING);
             $objPHPExcel->getActiveSheet()->setCellValue('G'.$C, $nombre_razon);

             $objPHPExcel->getActiveSheet()->setCellValue('H'.$C,number_format( $monto,  2, '.', ''));
    

             $objPHPExcel->getActiveSheet()->setCellValue('I'.$C,number_format( $monto,  2, '.', ''));
             $objPHPExcel->getActiveSheet()->setCellValue('J'.$C, number_format( $igv,  2, '.', ''));
             $objPHPExcel->getActiveSheet()->setCellValue('K'.$C, number_format($value['comprobante_venta'],  2, '.', ''));
             $objPHPExcel->getActiveSheet()->setCellValue('L'.$C, $value['comprobante_tipo_cambio']);
            $C=$C+1;
 }



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');



$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel2007)

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;


 function datos($monto,$razon_social,$tipo_comprobante,$ruc,$conn)
   {

    
       if((float)$monto!=0)
          {


            if($tipo_comprobante==2 || $tipo_comprobante==4  )
            {
             
                   $c=0;
                   $sql="select * from ruc where id_ruc='".$ruc."'";
                    $resultado = $conn->query($sql);
                     foreach ($resultado as $key => $value)
                      {
                          $c=1;
                          $nombre_razon=$value["ruc_razon_social"];
                           $codigo=$ruc;
                     }
                  
                 if($c==0)
                 {



                   $codigo=$ruc;
                   $nombre_razon=$razon_social;
                  require_once("src/autoload.php");
                    $cliente = new \Sunat\Sunat();
                     $data=   $cliente->search( $codigo );
                   if($data["success"]=="1")
                   {
                      $nombre_razon=$data["result"]["RazonSocial"];
                      $sql="insert into ruc(id_ruc,ruc_razon_social) values('".$ruc."','".$nombre_razon."')";
                       $conn->query($sql);
                   }
                    else{

                       $nombre_razon=$razon_social;
                    }
                   
                   }



              }
              else{
                    
                      if($razon_social!="")
                {
                   $codigo=$ruc;
                   $nombre_razon=$razon_social;
                 }
            else
             {

                   $dat=$conn->query("select * from codificacion,codigo_tipo where codificacion.id_codigo_tipo=codigo_tipo.id_codigo_tipo
                   and  codificacion.id_codigo_tipo=2 and codificacion.ruc_empresa_numero='".$_GET["id"]."' and codificacion.id_tipo_comprobante=".$tipo_comprobante);
                   foreach ($dat as $key => $value1) {
                     $codigo=$value1['codificacion_numero'];
                    $nombre_razon=$value1['codigo_tipo_descripcion'];
                   }
   
                 }
  

               }


       }
       else
        {
          $sql="select * from codificacion,codigo_tipo where codificacion.id_codigo_tipo=codigo_tipo.id_codigo_tipo
          and  codificacion.id_codigo_tipo=1 and codificacion.ruc_empresa_numero='".$_GET["id"]."' and codificacion.id_tipo_comprobante=".$tipo_comprobante;
           $dat=$conn->query($sql);


            foreach ($dat as $key => $value1) {
         $codigo=$value1['codificacion_numero'];
           $nombre_razon=$value1['codigo_tipo_descripcion'];
          }

    }


    return array ($codigo,$nombre_razon);

}
