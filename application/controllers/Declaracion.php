 <?php defined('BASEPATH') OR exit('No direct script access allowed');

include('Controler.php');

class Declaracion extends Controler {

 public function __construct() {

        parent::__construct();

        $this->load->model("Mantenimiento_m");

      

    }

public function ventas()
{


$dat=$this->Mantenimiento_m->consulta2("SELECT *
FROM
fecha_declaracion
INNER JOIN mes ON fecha_declaracion.id_mes = mes.id_mes
INNER JOIN anio ON fecha_declaracion.id_anio = anio.id_anio
where id_fecha_declaracion=".$_POST["id_fecha_declaracion"]);

$ruc=$_POST["ruc"];
$anio=$dat->anio_descripcion;
$mes=$dat->id_mes;

$ven=$this->Mantenimiento_m->consulta2("SELECT SUM(comprobante_venta) as suma from comprobante where MONTH(comprobante_fecha)=".$mes." and year(comprobante_fecha)=".$anio."
and ruc_empresa_numero='".$ruc."'");
echo $ven->suma;



}





    public function cantidad()
    {

     $boleta=$this->Mantenimiento_m->consulta2("select * from ayuda_boleta where id_ayuda_boleta=".$_POST["id_boleta"]);
        echo $monto_inicial=$boleta->monton;
    }
    public function guardar_boleta()
     {
        $sql="select * from comprobante where id_comprobante=".$_POST["id_comprobante"];
        $comprobante=$this->Mantenimiento_m->consulta2($sql);
        $monto_total=$comprobante->comprobante_venta;
        $boleta=$this->Mantenimiento_m->consulta2("select * from ayuda_boleta where id_ayuda_boleta=".$_POST["id_boleta"]);
        $monto_inicial=$boleta->monton;
        $monto_nuevo=$_POST["monto"];
        $total_nuevo=(float)$monto_total+(float)$monto_nuevo-(float)$monto_inicial;
         $data=array(
           "comprobante_venta"=>$total_nuevo
         );
           $this->Mantenimiento_m->actualizar("comprobante",$data,$_POST["id_comprobante"],"id_comprobante");
             $data=array(
           "monton"=>$monto_nuevo
         );
           $this->Mantenimiento_m->actualizar("ayuda_boleta",$data,$_POST["id_boleta"],"id_ayuda_boleta");


           $sql="select * from comprobante where id_comprobante=".$_POST["id_comprobante"];
        $comprobante=$this->Mantenimiento_m->consulta2($sql);
        echo $monto_total=$comprobante->comprobante_venta;

     }
public function lista_documentos()
{
  $lista=$this->Mantenimiento_m->consulta("select * from comprobante,tipo_comprobante where comprobante.id_tipo_comprobante=tipo_comprobante.id_tipo_comprobante and ruc_empresa_numero=".$_POST["ruc"]." ORDER BY comprobante.id_tipo_comprobante ASC");
  $_SESSION["ruc_empresa"]=$_POST["ruc"];

  $this->load->view("Boletas/boletas",compact("lista"));  

}

public function lista_documentos1()
{
  $lista=$this->Mantenimiento_m->consulta("select * from comprobante,tipo_comprobante where comprobante.id_tipo_comprobante=tipo_comprobante.id_tipo_comprobante and ruc_empresa_numero=". $_SESSION["ruc_empresa"]." ORDER BY comprobante.id_tipo_comprobante ASC");
 
  $this->load->view("Boletas/boletas",compact("lista"));  

}



public function detalle_boleta()
{
    $sql="select * from ayuda_boleta where id_ruc_empresa=".$_SESSION["ruc_empresa"]." and serie_caracteristica=".$_POST["serie"]." and serie_numero BETWEEN ".$_POST["inicio"]." and ".$_POST["fin"]." order by serie_numero ASC";

    $lista=$this->Mantenimiento_m->consulta($sql);
    $c=0;
   foreach ($lista as $key => $value) {
    $c++;
    $a="'".$value->serie_caracteristica."-".$value->serie_numero."'";
     echo "<tr>";
      echo "<td>".$c."</td>";
         echo "<td>".$value->fecha."</td>";
          echo "<td>".$value->serie_caracteristica."</td>";
             echo "<td >".$value->serie_numero."</td>";
             echo "<td id='monto".$value->id_ayuda_boleta."'>".$value->monton."</td>";  
         echo '<td>
         <center>
             <ul class="icons-list">
                
                  <li class="text-primary-600">  <a onclick="editar_boleta('.$value->id_ayuda_boleta.','.$value->monton.','.$a.')"><i class="icon-pencil7"></i></a></li>
             </ul>
        </center>


         </td>';     
     echo "</tr>";
   }
}

public function guardar_fecha_declaracion()
{
  $id_fecha_declaracion=$_POST["id_fecha_declaracion"];
  $id="";
  $datos=$this->Mantenimiento_m->consulta2("select * from declaracion_sunat where id_fecha_declaracion=".$id_fecha_declaracion." 
    and ruc_empresa_numero=".$_SESSION["ruc_empresa"]);
 if(count($datos)!=0)
 {
   $id=$datos->id_declaracion_sunat;
 }
  $data=array(
    "decl_sunat_codigo"=>$_POST["codigo"],
    "decl_sunat_importe_venta"=>$_POST["venta"],
    "decl_sunat_importe_compra"=>$_POST["compra"],
    "id_fecha_declaracion"=>$id_fecha_declaracion,
    "ruc_empresa_numero"=>$_SESSION["ruc_empresa"],
    "fecha_registro"=>$_POST["fecha"],
    "fecha_ingreso"=>date("Y-m-d H-i-s"),
    "monto"=>$_POST["monto"],
    "decl_porcentaje"=>$_POST["porcentaje"]

  );
        if($id=="")
           {
     
         $this->Mantenimiento_m->insertar("declaracion_sunat",$data);
           echo "1";
            }
            else
            {
            $this->Mantenimiento_m->actualizar("declaracion_sunat",$data,$id,"id_declaracion_sunat");
             echo "2";
            }


}

public function ver_codigo()
{
  $data=array("codigo"=>"","monto_compra"=>"","monto_venta"=>"","fecha"=>"");
   $id_fecha_declaracion=$_POST["id_fecha_declaracion"];
   $sql=$this->Mantenimiento_m->consulta("select * from declaracion_sunat where id_fecha_declaracion=".$id_fecha_declaracion." 
    and ruc_empresa_numero=".$_SESSION["ruc_empresa"]);

   foreach ($sql as $key => $value) {
     $data=array("codigo"=>$value->decl_sunat_codigo,
      "monto_compra"=>$value->decl_sunat_importe_compra,
      "monto_venta"=>$value->decl_sunat_importe_venta,
      "fecha"=>$value->fecha_registro,
       "monto"=>$value->monto);

   }

   echo json_encode($data);





}



public function periodo()
{    
     $id_tributo=$_POST["id_tributo"];
     $datos=$this->Mantenimiento_m->consulta2("select * from tributo where id_tributo=".$_POST["id_tributo"]);
     $tipo=$datos->tipo;
    
    $this->load->view("Declaracion/periodo",compact("id_tributo","tipo"));

}
  public function registrar_declaracion()
  {
    $lista=$this->Mantenimiento_m->consulta("select * from configuracion_notificacion,tributo,pdt,declaracion where declaracion.id_declaracion=pdt.id_declaracion and
 configuracion_notificacion.id_tributo=tributo.id_tributo AND
pdt.id_pdt=tributo.id_pdt and configuracion_notificacion.ruc_empresa_numero=".$_POST["ruc"]);
    $_SESSION["ruc_empresa"]=$_POST["ruc"];
    

    $this->load->view("Declaracion/registrar",compact("lista"));
  }

 public function guardar_declaracion(){
    $datos=json_decode($_POST["declaracion"][0],TRUE);
      $this->Mantenimiento_m->consulta1("delete from configuracion_notificacion where ruc_empresa_numero=".$_POST["ruc"]);
    foreach ($datos as $key => $value) {
        
      
     
       $data=array(
        "id_tributo"=>$value["value"],
        "ruc_empresa_numero"=>$_POST["ruc"]
       );

       $this->Mantenimiento_m->insertar("configuracion_notificacion",$data);

    }
   
 }
 
	public function index()
	{ 
		    $lista=$this->Mantenimiento_m->consulta("select * from declaracion where decl_estado=1");
     			$this->load->view("Declaracion/index",compact("lista"));  
	}


	public function pdt()
    {
    	$lista=$this->Mantenimiento_m->consulta("select * from pdt where id_declaracion=".$_POST["id"]);
    	$this->load->view("Declaracion/pdt",compact("lista"));
    }
    public function configurar()
    {   $_SESSION["id_pdt"]=$_POST["id_tributo"];
    	$anio=$this->Mantenimiento_m->consulta("select * from anio ");
    	$mes=$this->Mantenimiento_m->consulta("select * from mes");
    	$numero=$this->Mantenimiento_m->consulta("select * from numero");
    	$this->load->view("Declaracion/calendario",compact("anio","mes","numero"));
    }
     
  
     public function guardar_fecha()
     {
     	$pdt=$this->Mantenimiento_m->consulta("select * from tributo where id_pdt=".$_SESSION["id_pdt"]);
     	foreach ($pdt as $key => $value) 
     	{  

     	   $sql=$this->Mantenimiento_m->consulta2("select * from anio where id_anio=".$_POST["id_anio"]);
     		$anio=$sql->anio_descripcion;
                
             
     	    $id_existe="";
     	       $sql="select * from fecha_declaracion where id_anio=".$_POST["id_anio"]." and id_mes=".$_POST["id_mes"]." and id_numero=".$_POST["id_numero"]." and id_tributo=".$value->id_tributo;
     	 $tribut=$this->Mantenimiento_m->consulta($sql);
     	
     	    foreach ($tribut as $clave => $tributo)
     	     {
     	    	$id_existe=$tributo->id_fecha_declaracion;
     	    }

              $mes_exact=$this->Mantenimiento_m->consulta2("select * from mes where id_mes=".$_POST["id_mes"]);
              $mes_exacto=$mes_exact->mes_id_mes;
              if($mes_exacto=="1")
              {
                 $anio=(int)$anio+1;
              }
         $fecha_final=$anio."-".$mes_exacto."-".$_POST["dia"];           
        
               $date=date_create($fecha_final);
              date_add($date, date_interval_create_from_date_string('-3 days'));
               $fecha_notificacion= date_format($date,"Y-m-d");
 
                
            $data=array(
             "id_anio"=>$_POST["id_anio"],
              "id_mes"=>$_POST["id_mes"],
              "id_numero"=>$_POST["id_numero"],
              "id_tributo"=>$value->id_tributo,
              "fecha_exacta"=>$fecha_final,
              "fecha_notificar"=>$fecha_notificacion,
              "dia_exacto"=>$_POST["dia"]
            );

            //print_r($data);


     	    if($id_existe=="")
     	    {

                   $this->Mantenimiento_m->insertar("fecha_declaracion",$data);
			     echo "1";

     	    }
     	    else
     	    {
                 $this->Mantenimiento_m->actualizar("fecha_declaracion",$data,$id_existe,"id_fecha_declaracion");
	        	 echo "2";
     	    }
     	}
     }
     public function extraer_data()
     {
     	$sql=$this->Mantenimiento_m->consulta2("SELECT * from tributo where id_pdt=".$_SESSION["id_pdt"]." limit 1");
     	$datos=$this->Mantenimiento_m->consulta3("SELECT CONCAT(id_numero,id_mes) as numeracion,dia_exacto FROM fecha_declaracion where id_tributo=".$sql->id_tributo." and id_anio=".$_POST["id_anio"]);
     	echo json_encode($datos);

     }

     public function declaracion()
     {
     	$sql=$this->Mantenimiento_m->consulta("select * from declaracion where decl_estado=1");
     	foreach ($sql as $key => $value) 
     	{ 
     	   echo "<div class='row'>";
     	    echo "<div class='col-md-12'><b><h4><u>".$value->decl_nombre."</u></h4></b></div>";
     	     $sql1=$this->Mantenimiento_m->consulta("select * from pdt where  pdt_estado=1 and id_declaracion=".$value->id_declaracion);
     	     foreach ($sql1 as $key1 => $pdt) {
     	       echo "<div class='col-md-6'><h6>".$pdt->pdt_descripcion."</h6>";
     	       $sql2=$this->Mantenimiento_m->consulta("select * from tributo where id_pdt=".$pdt->id_pdt);

     	       foreach ($sql2 as $key2 => $tributo) {
                     $c=0;
                     $data=$this->Mantenimiento_m->consulta("select * from configuracion_notificacion where ruc_empresa_numero=".$_POST["ruc"]." and id_tributo=".$tributo->id_tributo);
                     foreach ($data as $key4 => $value4) {
                        $c=1;
                     }


     	       	   echo '<div class="col-md-6"><label class="col-md-8">
											'.$tributo->tri_descripcion.'
										</label><div class="col-md-4"><input type="checkbox" value="'.$tributo->id_tributo.'" id="declaracion" name="declaracion[]" ';
                                          if($c==1){
                                            echo "checked ";
                                          }
                                        echo '></div></div>';
     	       }
            




              echo "</div>";
     	     }
     	   echo "</div>";
     	  
     	}
     }


     public function maximo_porcentaje()
     {

      $sql=$this->Mantenimiento_m->consulta2("
        SELECT max(id_declaracion_sunat),decl_porcentaje from declaracion_sunat WHERE ruc_empresa_numero='".$_POST["ruc"]."' and decl_porcentaje!=''");
        echo $sql->decl_porcentaje;


     }

     


}