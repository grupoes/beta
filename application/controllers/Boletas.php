<?php defined('BASEPATH') OR exit('No direct script access allowed');

include('Controler.php');

class Boletas extends Controler {

 public function __construct() {

        parent::__construct();

        $this->load->model("Mantenimiento_m");

      

    }



	public function index(){

		//if($this->input->is_ajax_request()){

  if($_SESSION['usuario_perfil']!=7)
      {
        $datos=$this->Mantenimiento_m->consulta("select * from ruc_empresa where ruc_empresa_estado=1");
      }
      else{
          $datos=$this->Mantenimiento_m->consulta("select * from ruc_empresa where ruc_empresa_estado=1 and ruc_empresa_numero=".$_SESSION['usuario']);
      }



			$this->load->view("Boletas/index",compact('datos'));



		//}

		//else{

		//	$this->load->view("Error/404");

		//}

	}



  public function guardar_empresa()

  {

  $dat= $this->Mantenimiento_m->consulta2("select * from ruc_empresa where ruc_empresa_numero=".$_POST["ruc"]);

  if(count($dat)==0)

  {

          $data=array(

         "ruc_empresa_numero"=>$_POST["ruc"],

         "ruc_empresa_razon_social"=>$_POST["razon"]

      );

       $this->Mantenimiento_m->insertar("ruc_empresa",$data);



  }



 

       $this->Mantenimiento_m->consulta1("delete from codificacion where ruc_empresa_numero=".$_POST["ruc"]);

       $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>1,"id_codigo_tipo"=>2,"codificacion_numero"=>$_POST["varios_b"]);

         $this->Mantenimiento_m->insertar("codificacion",$data);

         $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>1,"id_codigo_tipo"=>1,"codificacion_numero"=>$_POST["anulado_b"]);

           $this->Mantenimiento_m->insertar("codificacion",$data);


           $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>5,"id_codigo_tipo"=>2,"codificacion_numero"=>$_POST["varios_b"]);

         $this->Mantenimiento_m->insertar("codificacion",$data);

         $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>5,"id_codigo_tipo"=>1,"codificacion_numero"=>$_POST["anulado_b"]);

           $this->Mantenimiento_m->insertar("codificacion",$data);





           $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>2,"id_codigo_tipo"=>1,"codificacion_numero"=>$_POST["anulado_f"]);

             $this->Mantenimiento_m->insertar("codificacion",$data);

             $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>3,"id_codigo_tipo"=>2,"codificacion_numero"=>$_POST["varios_b"]);

               $this->Mantenimiento_m->insertar("codificacion",$data);

               $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>3,"id_codigo_tipo"=>1,"codificacion_numero"=>$_POST["anulado_b"]);

                 $this->Mantenimiento_m->insertar("codificacion",$data);

            $data=array("ruc_empresa_numero"=>$_POST["ruc"],"id_tipo_comprobante"=>4,"id_codigo_tipo"=>1,"codificacion_numero"=>$_POST["anulado_f"]);

                   $this->Mantenimiento_m->insertar("codificacion",$data);

     echo 1;

  }



public function eliminar()

{

  $sql="update ruc_empresa set  ruc_empresa_estado=0 where ruc_empresa_numero=".$_POST["id"];

  $this->Mantenimiento_m->consulta1($sql);

  echo 1;

}





public function validar()

{ 

  $dat="";

  if ($_POST["serie_tipo"]=="1")

   {



     $sql="select id_ayuda_boleta as id_respuesta from ayuda_boleta 

      where serie_caracteristica='".$_POST["serie_caracter"]."' and serie_numero='".$_POST["serie_numer"]."' and id_ruc_empresa='".$_SESSION["id_empresa_comprobante"]."'";

    $data=$this->Mantenimiento_m->consulta2($sql);

    //$dat= $data->id_respuesta;

    

  }

  else

  {

        $sql="select id_comprobante as id_respuesta from comprobante where comprobante_documento_serie_caracteristicas='".$_POST["serie_caracter"]."' and comprobante_documento_serie_numero='".$_POST["serie_numer"]."' and ruc_empresa_numero='".$_SESSION["id_empresa_comprobante"]."'";

          $data=$this->Mantenimiento_m->consulta2($sql);



  }



echo count($data);







}







	public function tipo()

	{

	$_SESSION["id_empresa_comprobante"]=$_POST["id"];

    $dat=$this->Mantenimiento_m->consulta2("select * from ruc_empresa where ruc_empresa_numero=".$_POST["id"]);

    $tributo=$this->Mantenimiento_m->consulta("SELECT * 
FROM
configuracion_notificacion
INNER JOIN tributo ON configuracion_notificacion.id_tributo = tributo.id_tributo
INNER JOIN pdt ON tributo.id_pdt = pdt.id_pdt
where pdt.id_pdt=1 and ruc_empresa_numero=".$_POST["id"]);
    
  foreach ($tributo as $key => $value) {
     $id_tributo=$value->id_tributo;
  }
   

    $_SESSION["descripcion_empresa_comprobante"]=$dat->ruc_empresa_razon_social;

     $datos=$this->Mantenimiento_m->consulta("select * from  tipo_comprobante where tipo_comprobante_estado=1 and id_tipo_comprobante<6");

     $this->load->view("Boletas/tipo",compact('datos','id_tributo'));



	}



	public function nuevo()

	{

        $id_tipo_comprobante=$_POST["id"];

		$dat=$this->Mantenimiento_m->consulta2("select * from tipo_comprobante where id_tipo_comprobante=".$_POST["id"]);

		$tipo=$dat->tipo_comprobante_descripcion;

		

	    $this->load->view("Boletas/nuevo",compact('tipo','id_tipo_comprobante'));

	}

     

     public function datos()

     {

     	$resultado=0;

     	 foreach ($_POST['importe'] as $key => $value)

      { 

          $resultado=$resultado+(float)$value;

      }



      echo $resultado;

     }



    













     public function guardar()

     {



      if($_POST["id_tipo_comprobante"]=="2" || $_POST["id_tipo_comprobante"]=="4")

      {



          foreach ($_POST['serie'] as $key => $value)

      { 

         // $resultado=$resultado+(float)$value;

      	  $datos = explode("-", $value);

      	  $serie_codigo=$datos[0];

      	  $serie_numero=$datos[1];

      	  $importe_venta=$_POST["importe"][$key];

      	  $comprobante_ruc=$_POST["ruc"][$key];

      	  $comprobante_fecha=$_POST["fecha"];

      	  $ruc_empresa_numero=$_SESSION["id_empresa_comprobante"];

      	  $id_tipo_comprobante=$_POST["id_tipo_comprobante"];

      	  $id_tipo_moneda=1;

      	  $comprobante_tipo_cambio=1;

      	  $comprobante_condicion="A";



          $data=array(

               "id_tipo_moneda"=> $id_tipo_moneda,

               "id_tipo_comprobante"=>$id_tipo_comprobante,

               "comprobante_documento_serie_caracteristicas"=>$serie_codigo,

               "comprobante_ruc"=> $comprobante_ruc,

               "comprobante_nombre_razon"=>$_POST["razon"][$key],

               "comprobante_venta"=> $importe_venta,

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

      //echo $_POST["id_tipo_comprobante"];exit();

            $inicio="";

            $fin="";

            $total=0;

           $tam=count($_POST['serie']);

            foreach ($_POST['serie'] as $key => $value)

             {       

                    $datos = explode("-", $value);

                    $serie_codigo=$datos[0];

                    $serie_numero=$datos[1];

                    $comprobante_ruc=$_POST["ruc"][$key];



                    $comprobante_fecha=$_POST["fecha"];

                    $ruc_empresa_numero=$_SESSION["id_empresa_comprobante"];

                    $id_tipo_comprobante=$_POST["id_tipo_comprobante"];

                    $id_tipo_moneda=1;

                    $comprobante_tipo_cambio=1;

                    $comprobante_condicion="A";

                    

                    $data=array(



                         "serie_caracteristica"=>$serie_codigo,

                         "serie_numero"=> $serie_numero,

                         "id_ruc_empresa"=> $ruc_empresa_numero,

                         "monton"=>$_POST["importe"][$key],

                          "fecha"=> $comprobante_fecha,

                          "ruc_cliente"=> $comprobante_ruc



                      );



                      $this->Mantenimiento_m->insertar("ayuda_boleta",$data);









                  

                  if($_POST["importe"][$key]>=700 || $_POST["importe"][$key]<=0)

                  {

                      if($inicio=="")

                      {

                         $data=array(

                             "id_tipo_moneda"=> $id_tipo_moneda,

                             "id_tipo_comprobante"=>$id_tipo_comprobante,

                             "comprobante_documento_serie_caracteristicas"=>$serie_codigo,

                             "comprobante_ruc"=> $comprobante_ruc,

                             "comprobante_nombre_razon"=>$_POST["razon"][$key],

                             "comprobante_venta"=>$_POST["importe"][$key],

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

                             "comprobante_nombre_razon"=>$_POST["razon"][$key],

                             "comprobante_venta"=>$_POST["importe"][$key],

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

                          $total=$_POST["importe"][$key];

                        } 

                        else

                       {

                        $fin=$serie_numero;

                         $total=$total+$_POST["importe"][$key];

                       }

                     }

                     else

                     {

                         if($inicio=="")

                         {

                          $importe_venta=$_POST["importe"][$key];

                          $comprobante_ruc=$_POST["ruc"][$key];

                          $comprobante_fecha=$_POST["fecha"];

                          $ruc_empresa_numero=$_SESSION["id_empresa_comprobante"];

                          $id_tipo_comprobante=$_POST["id_tipo_comprobante"];

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

                             $total=$total+$_POST["importe"][$key];

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









       echo 1;

     }



public function subir()

{

 $_SESSION["id_empresa_comprobante"]=$_POST["id"];

    $dat=$this->Mantenimiento_m->consulta2("select * from ruc_empresa where ruc_empresa_numero=".$_POST["id"]);

    $_SESSION["descripcion_empresa_comprobante"]=$dat->ruc_empresa_razon_social;



      $data=array("nombre_archivo"=>"archivo");

     $this->Mantenimiento_m->insertar("migracion",$data);

     $d=$this->Mantenimiento_m->consulta2("select max(id_migracion) as maximo from migracion");

     $dato=$d->maximo;



     $this->load->view("Boletas/subir",compact("dato"));



}

  





}

?>