<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Pagos extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		//if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->consulta("SELECT
             persona.nombres,
persona.apellidos,
ficha_enfoque.titulo_enfoque,
pago.fecha,
pago.monto,
pago.estado,
pago.id_pago
FROM
persona
INNER JOIN ficha_enfoque ON persona.dni = ficha_enfoque.id_cliente
INNER JOIN pago ON ficha_enfoque.id_ficha_enfoque = pago.id_ficha_enfoque
where pago.estado=1
");



			
			$this->load->view("Pagos/index",compact('lista'));

		//}
		//else{
			//$this->load->view("Error/404");
		//}
	}
	public function nuevo()
	{
		if ($this->input->is_ajax_request()){
			$this->load->view('Categoria/nuevo');
		}else{
            	$this->load->view('Error/404');
        	}
	}
   

public function amortizar_prestamo(){
		if ($this->input->is_ajax_request()){
			$sql="select *from cronograma where id_pago=".$_GET["id"]." order by cuo_nrocuota";


			$cuotas = $this->db->query($sql)->result_array();
			//$datos = $this->db->query("select * from forma_pago")->result();
			//print_r($cuotas);exit();
			$cliente=$_GET["cliente"];
			$formapagos = $this->db->query("select * from formapago where for_estado=1")->result();
			$caja=$this->Mantenimiento_m->consulta("select * from caja ");
			$tipo_comprobante=$this->Mantenimiento_m->consulta("select * from  tipo_comprobante");
			$this->load->view('Pagos/amortizacion',compact('cuotas',"caja","formapagos","tipo_comprobante","cliente"));
		}else{
			$this->load->view('Error/404');
		}
	}

public	function realizar_amortizacion(){
	 $id_movimiento=$this->generar_movimiento($_POST["id_caja"],$_POST["monto"],
	 $_POST["id_forma_pago"],1,"Pago de credito ".$_POST["cliente"],1,$_POST["id_tipo_comprobante"],$_POST["codigo"]);

	    if($id_movimiento!=0){

			  $estado=1;
			  $fechapago="";
			  $sql="select *from cronograma where id_pago=".$_POST["idprestamo"]." and cuo_estado=1 order by cuo_nrocuota";
			         $fechapago=date("Y-m-d");
		          	$cuotas = $this->db->query($sql)->result_array();
		          	
		        	$monto = $_POST['monto'];
		        	//echo $monto;  print_r($cuotas);exit();
		          	foreach ($cuotas as $value) {
		               	if ($monto == 0) {
		                    break;
		               	}else{
		                    	if ((double)$monto>=((double)$value['cuo_montocuota']-(double)$value['cuo_montopagado'])){

		                        	
		                        	$data = array(
		                            	'cuo_fechacancelado' => $fechapago ,
		                            	'cuo_montopagado' => $value['cuo_montocuota'],
		                            	'cuo_estado' => 0,
		                            	
		                            	
		                        	);
		                        	$this->db->where('id_cronograma', $value['id_cronograma']);
									$this->db->update('cronograma', $data);
									
                               $data=array(
								   "id_cronograma"=>$value['id_cronograma'],
								   "mov_id"=>$id_movimiento,
								   "amor_monto"=>$value['cuo_montocuota']

							   );
                            $this->Mantenimiento_m->insertar("cronograma_movimiento",$data);

		                        	$monto = $monto - ($value['cuo_montocuota']-$value['cuo_montopagado']);
		                        
		                    	}else
		                    	{



		                        	

		                        	$data = array(
		                            	'cuo_montopagado' => ($value['cuo_montopagado'] + $monto)
		                        	);
		                        	$this->db->where('id_cronograma', $value['id_cronograma']);
									$this->db->update('cronograma', $data);
									
									$data=array(
										"id_cronograma"=>$value['id_cronograma'],
										"mov_id"=>$id_movimiento,
										"amor_monto"=>($value['cuo_montopagado'] + $monto)
	 
									);
								 $this->Mantenimiento_m->insertar("cronograma_movimiento",$data);
                                      
		                        	$monto = 0;

		                    	}
		               	}
		          	}

		          	$cancel = $this->db->get_where('cronograma', array('id_pago' => $_POST["idprestamo"],'cuo_estado' =>1))->result_array();
		          	if (count($cancel)==0) {
		               	$data = array(
		                    	'estado' => 0
		               	);
		               	$this->db->where('id_pago', $_POST["idprestamo"]);
		               	$this->db->update('pago', $data);

		          	}
		           $html="";
                           	  $fecha3= "";
		         	if(isset($_POST["id_enfoque"]))
		          	{  
		          		$data=$this->Mantenimiento_m->consulta("SELECT (cronograma.cuo_montocuota-cronograma.cuo_montopagado) as diferencia,
		          			                        DATE_FORMAT(cuo_fechavence,'%d/%m/%Y') as fecha
                                                 from cronograma,pago where cronograma.id_pago=pago.id_pago AND
                                               cronograma.cuo_montocuota<>cronograma.cuo_montopagado and
                                              pago.id_ficha_enfoque=".$_POST["id_enfoque"]);
                           	
                         foreach ($data as $key => $value) {
                         	
                             $html.="• S/. ".$value->diferencia.",00 Soles para ser pagado el día ".$value->fecha."<br>";
                         }
                       $dati=$this->Mantenimiento_m->consulta2("SELECT count(id_cronograma) as dato from cronograma,pago where cronograma.id_pago=pago.id_pago and pago.id_ficha_enfoque=".$_POST["id_enfoque"]);


         $sql1="update contrato set cuotas='".$html."', inicial ='".$_POST['monto']."',partes='".$dati->dato."' Where id_ficha_enfoque=".$_POST["id_enfoque"];
              
                         $this->Mantenimiento_m->consulta1(
                         	$sql1
                            
                         	);
		          	}

				}
				else{
					$estado=0;
				}
			







		
			echo $estado;
		
	}

public function guardarContado()
{



   $id_movimiento=$this->generar_movimiento(1,$_POST['monto'],1,1,"PAGO AL CONTADO",1,1,"");
if($id_movimiento!=0){

   $id_enfoque=$_POST['id_enfoque'];
   $fecha=$_POST['fecha'];
   $monto=$_POST['monto'];
   $datos=array(
     "id_ficha_enfoque"=>$id_enfoque,
     "fecha"=>$fecha,
     "monto"=>$monto,
      "intervalo"=>"mensual",
      "estado"=>0,
      "cantidad_semanas"=>1,

   	);
   $this->Mantenimiento_m->insertar("pago",$datos);
   $maximo="";
  $data=$this->Mantenimiento_m->consulta("select max(id_pago) as maximo from pago");
  foreach ($data as $key => $value) {
     $maximo=$value->maximo;
  }


   $datos=array(
     "id_pago"=>$maximo,
     "cuo_nrocuota"=>"1",
     "cuo_fechavence"=>$fecha,
     "cuo_fechacancelado"=>$fecha,
     "cuo_montocuota"=>$monto,
     "cuo_montopagado"=>$monto,
     "cuo_estado"=>0
   	);

   $this->Mantenimiento_m->insertar("cronograma",$datos);
    $datos = array('pago' => $monto,"dia"=>date("Y-m-d"),"id_ficha_enfoque"=>$id_enfoque);
    $this->Mantenimiento_m->insertar("contrato",$datos);

   $id_cronogram=$this->Mantenimiento_m->consulta2("select max(id_cronograma) as maximo from cronograma ");
   $id_cronograma=$id_cronogram->maximo;
   $data=array(
										"id_cronograma"=>$id_cronograma,
										"mov_id"=>$id_movimiento,
										"amor_monto"=>$monto
	 
									);
								 $this->Mantenimiento_m->insertar("cronograma_movimiento",$data);   
								 echo 1;


}else{

	echo 0;
}












}

public function guardarCredito()
{
	
			$sesion=$this->Mantenimiento_m->consulta2("SELECT max(sesion_caja.id_sesion_caja) as ult from sede_caja,sesion_caja 
			where 
			sede_caja.id_sede_caja=sesion_caja.id_sede_caja 
			and sede_caja.id_sede='".$_SESSION["id_sede"]."' and sede_caja.id_caja=1 and sesion_caja.id_usuario=".$_SESSION['usuario_id']."
			and sesion_caja.ses_estado=1");

		if(count($sesion->ult))
		{

			$data = array(
               		'id_ficha_enfoque' => $_POST['id_enfoque'],
               		
               		'fecha' => $_POST["fechaprestamo"],
               		'cantidad_semanas' => $_POST["semanas"],
               		
               		'monto' => $_POST["monto"],
               		'intervalo' => $_POST["intervalo"],
               		
            	);
            	$estado = $this->db->insert('pago', $data);
            	$prestamo = $this->db->insert_id();

            	foreach ($_POST["nrocuotas"] as $key => $value){
                	$data = array(
                   		'id_pago' => $prestamo,
                   		'cuo_nrocuota' => $_POST["nrocuotas"][$key],
                   		'cuo_fechavence' => $_POST["fechavence"][$key],
                   		'cuo_montocuota' => $_POST["montocuota"][$key],
                   		'cuo_montopagado' => 0
                	);
               		$this->db->insert('cronograma', $data);
            	}
            	echo $prestamo;
            	    $datos = array('pago' =>$_POST["monto"],"dia"=>date("Y-m-d"),"id_ficha_enfoque"=>$_POST['id_enfoque']);
            	     
               $this->Mantenimiento_m->insertar("contrato",$datos);
             }
             else{
             	echo 0;
             }


		
}




public function generar_movimiento($id_caja,$monto,$formapago,$concepto,$descripcion,$tipomovimiento,$id_tipo_comprobante,$descripcion_comprobante)
	{

		$sesion=$this->Mantenimiento_m->consulta2("SELECT max(sesion_caja.id_sesion_caja) as ult from sede_caja,sesion_caja 
			where 
			sede_caja.id_sede_caja=sesion_caja.id_sede_caja 
			and sede_caja.id_sede='".$_SESSION["id_sede"]."' and sede_caja.id_caja=".$id_caja." and sesion_caja.id_usuario=".$_SESSION['usuario_id']."
			and sesion_caja.ses_estado=1");

		if(count($sesion->ult))
		{
			$caja=$this->Mantenimiento_m->consulta2("select * from sede_caja where id_sede=".$_SESSION["id_sede"]." and id_caja=".$id_caja);
      //print_r($caja);exit();
			$id_sede_caja=$caja->id_sede_caja;

			$data = array(
				'id_sesion_caja' => $sesion->ult,
				'mov_formapago' => $formapago,
				'mov_concepto' => $concepto,
				'mov_fecha' => date('Y-m-d'),
				'mov_monto' => $monto,
				'mov_descripcion' => $descripcion,
				'mov_hora'=>date('H:i:s'),
				'id_tipo_comprobante'=>$id_tipo_comprobante,
				'tipo_comprobante_descripcion'=>$descripcion_comprobante
				);
			$estado=$this->db->insert('movimiento', $data);

			if ($tipomovimiento==1) {
				$monto_total = $caja->sede_caja_monto + $monto;
			}else{
				$monto_total = $caja->sede_caja_monto  - $monto;
			}
			$data = array(
				'sede_caja_monto' => $monto_total
				);
			$this->db->where('id_sede_caja',$id_sede_caja);
			$estado=$this->db->update('sede_caja', $data);
			
			$data1=$this->Mantenimiento_m->consulta2("select max(mov_id) as maximo from movimiento");

			$estado=$data1->maximo;
		}
		else{

			$estado=0;


		}

		return $estado;
	}

	
}

?>