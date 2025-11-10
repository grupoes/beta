<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Lectura extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

    public function leer()
    {
  $dir_subida="";

    	$fichero_subido = $dir_subida . basename($_FILES['archivo']['name']);

//echo $fichero_subido;


if (move_uploaded_file($_FILES['archivo']['tmp_name'], $fichero_subido)) {
  //  echo "El fichero es válido y se subió con éxito.\n";
} else {
   // echo "¡Posible ataque de subida de ficheros!\n";
}

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';
$archivo=$fichero_subido;

$fecha1= (String)strtoupper($_POST["fecha"]);
$serie= (String)strtoupper($_POST["serie"]);
$numero=(String) strtoupper($_POST["numero"]);
$monto=(String) strtoupper($_POST["monto"]);
$ruc= (String)strtoupper($_POST["ruc"]);
$tipo=(String)strtoupper($_POST["tipo"]);
$razon=(String)strtoupper($_POST["razon"]);
//echo $fecha1;
//echo $serie;
//echo $numero;
//echo $monto;
//echo $ruc;
//echo $tipo;
$Leerexcel=PHPExcel_IOFactory::createReaderForFile($archivo);
$excelobj=$Leerexcel->load($archivo);
$trabajo=$excelobj->getActiveSheet();
$tam=$trabajo->getHighestRow();


for ($row=1; $row <$tam+1 ; $row++) { 
 
$fecha_insertar1= $trabajo->getCell($fecha1.$row)->getValue();
$data_fecha= explode("/", $fecha_insertar1);


if(count($data_fecha)==1)
{

   $timestamp=PHPExcel_Shared_Date::ExcelToPHP($trabajo->getCell($fecha1.$row)->getValue());
   $fecha = date("Y-m-d ",$timestamp);
    
    $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha) ) ;
$fecha = date ( 'Y-m-d' , $nuevafecha );
}

else
{
    $fecha=$data_fecha[2]."-".$data_fecha[1]."-".$data_fecha[0];

   
}

//$fecha=date('Y-d-m', strtotime(str_replace('-','/', $fecha_insertar1)));

 /*  $timestamp=PHPExcel_Shared_Date::ExcelToPHP($trabajo->getCell($fecha1.$row)->getValue());*/

//$valor_dia_entrega=date("d-m-Y ",$fecha_insertar1);
//$fecha = date_create($valor_dia_entrega);

  $fecha_insertar=$fecha;
   $serie_insertar=$trabajo->getCell($serie.$row)->getValue();
 $numero_insertar=$trabajo->getCell($numero.$row)->getValue();

 $monto_insertar=(string)$trabajo->getCell($monto.$row)->getValue();
   $ruc_insertar=$trabajo->getCell($ruc.$row)->getValue();
   $tipo_insertar=$trabajo->getCell($tipo.$row)->getValue();
   $razon_social=(string)$trabajo->getCell($razon.$row)->getValue();
   if($monto_insertar!=""){

   $data=array(
     "fecha"=>$fecha_insertar,
     "serie"=>$serie_insertar,
     "numero"=>$numero_insertar,
       "ruc"=>$ruc_insertar,
       "monto"=>$monto_insertar,
       "tipo"=>$tipo_insertar,
       "ruc_empresa"=>$_SESSION["id_empresa_comprobante"],
       "id_migracion"=>$_POST["id"],
       "razon_social"=> $razon_social
   	);

   $this->Mantenimiento_m->insertar("migrar",$data);

   
  /* $sql="insert into migrar(fecha,serie,numero,ruc,monto,tipo,ruc_empresa,id_migracion) values('".$fecha_insertar."','".$serie_insertar."',".$numero_insertar.",'".$ruc_insertar."',".$monto_insertar.",".$tipo_insertar.",".$_SESSION['id_empresa_comprobante'].",".$_POST["id"].")";

   $conn->query($sql); */
 }
}

unlink($fichero_subido);
 $sql="select min(fecha) as minimo from migrar where id_migracion=".$_POST['id'];
 $sql1="select max(fecha) as  maximo from migrar where id_migracion=".$_POST['id'];
 $data=$this->Mantenimiento_m->consulta2($sql);
 $data1=$this->Mantenimiento_m->consulta2($sql1);
$fecha_minima=$data->minimo;
$fecha_maxima=$data1->maximo;
$datos=$this->Mantenimiento_m->consulta3("select DISTINCT(tipo) as tipo from migrar where id_migracion=".$_POST["id"]);



foreach ($datos as $key => $value) 
{
   $id_tipo_comprobante=$value["tipo"];         
    if($id_tipo_comprobante=="2" || $id_tipo_comprobante=="4")
    {
      $sql1="select * from migrar where id_migracion=".$_POST['id']." and tipo=".$id_tipo_comprobante." order by fecha asc,serie desc,numero asc";
      $migrar_base=$this->Mantenimiento_m->consulta3($sql1);
      foreach ($migrar_base as $key1 => $migracion_base1) 
      {         
          $data=array(
               "id_tipo_moneda"=>1,
               "id_tipo_comprobante"=>$id_tipo_comprobante,
               "comprobante_documento_serie_caracteristicas"=>$migracion_base1["serie"],
               "comprobante_ruc"=> $migracion_base1["ruc"],
               "comprobante_nombre_razon"=>"",
               "comprobante_venta"=>(float) $migracion_base1["monto"],
               "comprobante_tipo_cambio"=>1,
               "comprobante_condicion"=>'A',
               "ruc_empresa_numero"=>$migracion_base1["ruc_empresa"],
               "comprobante_documento_serie_numero"=>$migracion_base1["numero"],
               "comprobante_fecha"=>$migracion_base1['fecha'],
               "comprobante_nombre_razon"=>$migracion_base1["razon_social"]
          	);
             $this->Mantenimiento_m->insertar("comprobante",$data);
      } 

   }
else
    {
      $toda_serie=$this->Mantenimiento_m->consulta3("select DISTINCT(serie) as serie from migrar where tipo=".$id_tipo_comprobante." and id_migracion=".$_POST["id"]);
      foreach ($toda_serie as $key => $data_serie)
        {
         $toda_fecha=$this->Mantenimiento_m->consulta3("select DISTINCT(fecha) as fecha from migrar where serie='".$data_serie["serie"]."' and tipo=".$id_tipo_comprobante." and id_migracion=".$_POST["id"]);
          foreach ($toda_fecha as $key => $toda_fechas) 
            {
              $data_unica=$this->Mantenimiento_m->consulta3("select * from migrar where serie='".$data_serie["serie"]."' and tipo=".$id_tipo_comprobante." and id_migracion=".$_POST["id"]." and fecha='".$toda_fechas["fecha"]."' order by numero asc");
              $inicio="";
              $fin="";
              $total=0;
              $tam=count($data_unica);
              foreach ($data_unica as $key => $data_unicas)
              {
                $data=array(
                         "serie_caracteristica"=>$data_unicas["serie"],
                         "serie_numero"=> $data_unicas["numero"],
                         "id_ruc_empresa"=> $data_unicas["ruc_empresa"],
                         "monton"=>$data_unicas["monto"],
                          "fecha"=> $data_unicas["fecha"],
                         "ruc_cliente"=> $data_unicas["ruc"]
                      );
                    $this->Mantenimiento_m->insertar("ayuda_boleta",$data);
                    $serie_codigo=$data_unicas["serie"];
                    $serie_numero=$data_unicas["numero"];
                    $comprobante_ruc= $data_unicas["ruc"];

                    $comprobante_fecha=$data_unicas["fecha"];
                    $ruc_empresa_numero=$_SESSION["id_empresa_comprobante"];
                    
                    $id_tipo_moneda=1;
                    $comprobante_tipo_cambio=1;
                    $comprobante_condicion="A";
                 if($data_unicas["monto"]>=700 || $data_unicas["monto"]<=0)
                   {
                      if($inicio=="" )
                      {
                         $data=array(
                             "id_tipo_moneda"=> $id_tipo_moneda,
                             "id_tipo_comprobante"=>$id_tipo_comprobante,
                             "comprobante_documento_serie_caracteristicas"=>$serie_codigo,
                             "comprobante_ruc"=> $comprobante_ruc,
                             "comprobante_nombre_razon"=>$data_unicas["razon_social"],
                             "comprobante_venta"=>$data_unicas["monto"],
                             "comprobante_tipo_cambio"=>$comprobante_tipo_cambio,
                             "comprobante_condicion"=>$comprobante_condicion,
                             "ruc_empresa_numero"=> $ruc_empresa_numero,
                             "comprobante_documento_serie_numero"=>$serie_numero,
                             "comprobante_fecha"=>$comprobante_fecha

                          );
                         $this->Mantenimiento_m->insertar("comprobante",$data);
                      }
                      else
                      {
                          if($inicio!=$fin)
                          {
                             $serie_numer=$inicio."/".$fin; 
                          }
                          else
                          {
                             $serie_numer=$inicio;  
                          }
                        
                          $data=array(
                             "id_tipo_moneda"=> $id_tipo_moneda,
                             "id_tipo_comprobante"=>$id_tipo_comprobante,
                             "comprobante_documento_serie_caracteristicas"=>$serie_codigo,
                             "comprobante_ruc"=> $comprobante_ruc,
                             "comprobante_nombre_razon"=>"",
                             "comprobante_venta"=>$total,
                             "comprobante_tipo_cambio"=>$comprobante_tipo_cambio,
                             "comprobante_condicion"=>$comprobante_condicion,
                             "ruc_empresa_numero"=> $ruc_empresa_numero,
                             "comprobante_documento_serie_numero"=>$serie_numer,
                             "comprobante_fecha"=>$comprobante_fecha

                          );
                         $this->Mantenimiento_m->insertar("comprobante",$data);
                         $inicio="";
                         $fin="";
                         $total=0;

                          $data=array(
                             "id_tipo_moneda"=> $id_tipo_moneda,
                             "id_tipo_comprobante"=>$id_tipo_comprobante,
                             "comprobante_documento_serie_caracteristicas"=>$serie_codigo,
                             "comprobante_ruc"=> $comprobante_ruc,
                             "comprobante_nombre_razon"=>$data_unicas["razon_social"],
                             "comprobante_venta"=>$data_unicas["monto"],
                             "comprobante_tipo_cambio"=>$comprobante_tipo_cambio,
                             "comprobante_condicion"=>$comprobante_condicion,
                             "ruc_empresa_numero"=> $ruc_empresa_numero,
                             "comprobante_documento_serie_numero"=>$serie_numero,
                             "comprobante_fecha"=>$comprobante_fecha

                          );
                        $this->Mantenimiento_m->insertar("comprobante",$data);
                      }
                       
                  }
                  else
                  {
                     if( $tam!=$key+1)
                     { 
                       if($inicio=="")
                        {
                          $inicio=$serie_numero;
                          $fin=$serie_numero  ; 
                          $total=(float)$data_unicas["monto"];
                        } 
                        else
                       {
                        $fin=$serie_numero;
                         $total=$total+(float)$data_unicas["monto"];
                       }
                     }
                     else
                     {
                         if($inicio=="")
                         {
                          $importe_venta=(float)$data_unicas["monto"];
                          $comprobante_ruc=$data_unicas["ruc"];
                          $comprobante_fecha=$data_unicas["fecha"];
                          $ruc_empresa_numero=$data_unicas["ruc_empresa"];
                          //$id_tipo_comprobante=$_POST["id_tipo_comprobante"];
                          $id_tipo_moneda=1;
                          $comprobante_tipo_cambio=1;
                           $comprobante_condicion="A";

                        $data=array(
                              "id_tipo_moneda"=> $id_tipo_moneda,
                              "id_tipo_comprobante"=>$id_tipo_comprobante,
                              "comprobante_documento_serie_caracteristicas"=>$serie_codigo,
                              "comprobante_ruc"=> $comprobante_ruc,
                              "comprobante_nombre_razon"=>"",
                              "comprobante_venta"=> $importe_venta,
                              "comprobante_tipo_cambio"=>$comprobante_tipo_cambio,
                              " comprobante_condicion"=>$comprobante_condicion,
                              "ruc_empresa_numero"=> $ruc_empresa_numero,
                              "comprobante_documento_serie_numero"=>$serie_numero,
                               "comprobante_fecha"=>$comprobante_fecha
                            );
                           $this->Mantenimiento_m->insertar("comprobante",$data);
                         }
                         else
                         {
                             $fin=$serie_numero;
                             $total=$total+(float)$data_unicas["monto"];
                             $serie_numer=$inicio."/".$fin;
                              $data=array(
                             "id_tipo_moneda"=> $id_tipo_moneda,
                             "id_tipo_comprobante"=>$id_tipo_comprobante,
                             "comprobante_documento_serie_caracteristicas"=>$serie_codigo,
                             "comprobante_ruc"=> $comprobante_ruc,
                             "comprobante_nombre_razon"=>"",
                             "comprobante_venta"=>$total,
                             "comprobante_tipo_cambio"=>$comprobante_tipo_cambio,
                             "comprobante_condicion"=>$comprobante_condicion,
                             "ruc_empresa_numero"=> $ruc_empresa_numero,
                             "comprobante_documento_serie_numero"=>$serie_numer,
                             "comprobante_fecha"=>$comprobante_fecha

                          );
                         $this->Mantenimiento_m->insertar("comprobante",$data);
                         } 

                      }
                    }

                  }     
                }

           }


   
       }

  }


  header('Location: '.base_url()."excel/Examples/generarexcel.php?id=".$_SESSION["id_empresa_comprobante"]."&inicio=".$fecha_minima."&fin=".$fecha_maxima."&igv=".$_POST["igv"]);
    exit();
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




// Set document properties
$objPHPExcel->getProperties()->setCreator("ESconsultores")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Test result file");



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
            
      



$sql="select * from comprobante,tipo_comprobante,tipo_moneda
where  comprobante.id_tipo_comprobante=tipo_comprobante.id_tipo_comprobante and tipo_moneda.id_tipo_moneda=comprobante.id_tipo_moneda
and comprobante.comprobante_tipo_estado=1 and comprobante.ruc_empresa_numero=".$_SESSION["id_empresa_comprobante"]."
 and comprobante.comprobante_fecha BETWEEN '".$fecha_minima."' and '".$fecha_maxima."' order by tipo_comprobante.id_tipo_comprobante desc,
comprobante.comprobante_documento_serie_caracteristicas desc
,comprobante.comprobante_fecha asc, comprobante.comprobante_documento_serie_numero asc";

$C=2;
$resultado=$this->Mantenimiento_m->consulta3($sql); 

 foreach ($resultado as $key => $value) {
 $ayuda="";
 if($value['id_tipo_comprobante']==3)
 {
     $ayuda="B";
 }
 if($value['id_tipo_comprobante']==4)
 {
    $ayuda="F";
 }

 	$myDateTime = DateTime::createFromFormat('Y-m-d', $value["comprobante_fecha"]);
   $dat=(string)  $myDateTime->format('d/m/Y');
 	//echo date_format($value["comprobante_fecha"], 'd/m/Y');
  if($_POST["igv"]=="1")
 {
      $monto=(float)$value['comprobante_venta']/1.18;
      $igv=(float)$value['comprobante_venta']-(float)$monto;


 }
 else
 {
    $igv="0.00";
    $monto=$value['comprobante_venta'];
 }





   list($codigo,$nombre_razon)=$this->datos($value['comprobante_venta'],$value['comprobante_nombre_razon'],$value['id_tipo_comprobante'],$value['comprobante_ruc']);


             $objPHPExcel->getActiveSheet()->setCellValue('A'.$C,  $dat);
          
             $objPHPExcel->getActiveSheet()->setCellValue('B'.$C, $value["tipo_moneda_descripcion"]);
             $objPHPExcel->getActiveSheet()->setCellValue('C'.$C, $value['tipo_comprobante_nombre']);
             $objPHPExcel->getActiveSheet()->setCellValue('D'.$C, $ayuda.$value['comprobante_documento_serie_caracteristicas']."-".$value['comprobante_documento_serie_numero']);
             $objPHPExcel->getActiveSheet()->setCellValue('E'.$C, 'A');
             $objPHPExcel->getActiveSheet()->setCellValue('F'.$C, $codigo);
             $objPHPExcel->getActiveSheet()->setCellValue('G'.$C, $nombre_razon);

             $objPHPExcel->getActiveSheet()->setCellValue('H'.$C,number_format( $monto,  2, '.', ''));
             //$objPHPExcel->getActiveSheet()->getStyle('H'.$C)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);

             $objPHPExcel->getActiveSheet()->setCellValue('I'.$C, number_format( $monto,  2, '.', ''));
             $objPHPExcel->getActiveSheet()->setCellValue('J'.$C,  number_format( $igv,  2, '.', ''));
             $objPHPExcel->getActiveSheet()->setCellValue('K'.$C,number_format( $monto,  2, '.', ''));
             $objPHPExcel->getActiveSheet()->setCellValue('L'.$C, $value['comprobante_tipo_cambio']);
            $C=$C+1;
 }



// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Simple');



$objPHPExcel->setActiveSheetIndex(0);

exit();
// Redirect output to a client’s web browser (Excel2007)
$nombre=$_SESSION["descripcion_empresa_comprobante"]." ".$fecha_minima."  ".$fecha_maxima;
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$nombre.'.xlsx"');
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



   

   }

   public function datos($monto,$razon_social,$tipo_comprobante,$ruc)
   {
       if((float)$monto!=0)
          {
             if($razon_social!="")
                {
                   $codigo=$ruc;
                   $nombre_razon=$razon_social;
                 }
       else
          {

            $dat=$this->Mantenimiento_m->consulta3("select * from codificacion,codigo_tipo where codificacion.id_codigo_tipo=codigo_tipo.id_codigo_tipo
      and  codificacion.id_codigo_tipo=2 and codificacion.ruc_empresa_numero='".$_SESSION["id_empresa_comprobante"]."' and codificacion.id_tipo_comprobante=".$tipo_comprobante);
          foreach ($dat as $key => $value1) {
           $codigo=$value1['codificacion_numero'];
            $nombre_razon=$value1['codigo_tipo_descripcion'];
          }
   
        }
       }
       else
        {
          $sql="select * from codificacion,codigo_tipo where codificacion.id_codigo_tipo=codigo_tipo.id_codigo_tipo
          and  codificacion.id_codigo_tipo=1 and codificacion.ruc_empresa_numero='".$_SESSION["id_empresa_comprobante"]."' and codificacion.id_tipo_comprobante=".$tipo_comprobante;
           $dat=$this->Mantenimiento_m->consulta3($sql);


            foreach ($dat as $key => $value1) {
         $codigo=$value1['codificacion_numero'];
           $nombre_razon=$value1['codigo_tipo_descripcion'];
          }

    }
    return array ($codigo,$nombre_razon);

}



}