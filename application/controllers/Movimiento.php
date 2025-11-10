<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Movimiento extends Controler {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mantenimiento_m");

	}



		public function index(){
		if ($this->input->is_ajax_request()){
          
          if($_SESSION["usuario_perfil"]!="5"){

			$lista=$this->Mantenimiento_m->consulta("select *
				FROM
				sede_caja
				INNER JOIN sesion_caja ON sesion_caja.id_sede_caja = sede_caja.id_sede_caja
				INNER JOIN movimiento ON movimiento.id_sesion_caja = sesion_caja.id_sesion_caja
				INNER JOIN concepto ON movimiento.mov_concepto = concepto.con_id
				INNER JOIN tipo_movimiento ON concepto.id_tipo_movimiento = tipo_movimiento.id_tipo_movimiento
				INNER JOIN caja ON sede_caja.id_caja = caja.id_caja
				where sede_caja.id_sede=".$_SESSION["id_sede"]." and movimiento.mov_estado = 1 order by movimiento.mov_id desc");
				$this->load->view('Movimiento/index',compact('lista'));
		    }
		    else{
                  
                  $lista=$this->Mantenimiento_m->consulta("select * from sede where estado=1");

                 $this->load->view('Movimiento/ver_index',compact('lista'));
                
		    }





			

		
		}else{
			$this->load->view('Error/404');
		}
	}
	public function new_movimiento(){
		if ($this->input->is_ajax_request()){
			$conceptos = $this->db->query("select * from concepto where con_estado=1 and con_id>4 and id_tipo_movimiento=".$_GET["tipomovi"])->result();
			$formapagos = $this->db->query("select *from formapago where for_estado=1")->result();
			$caja=$this->Mantenimiento_m->consulta("select * from caja where caja_estado=1");
			$tipo_comprobante=$this->Mantenimiento_m->consulta("select * from  tipo_comprobante");
			$this->load->view('Movimiento/nuevo',compact('conceptos','formapagos','caja','tipo_comprobante'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function new_transferencia(){
		if ($this->input->is_ajax_request()){
			$conceptos = $this->db->query("SELECT concepto.con_descripcion,concepto.con_id FROM concepto where concepto.con_id = 3 or concepto.con_id = 4")->result();
		//	$formapagos = $this->db->query("select *from formapago where for_estado=1")->result();
			$caja=$this->Mantenimiento_m->consulta("select * from caja where caja_estado=1");
			$this->load->view('Movimiento/transferencia',compact('conceptos','caja'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function extornar(){
		$id =  $_GET['id'];
		$estado = 0;
		$movimiento = $this->db->query("SELECT movimiento.mov_id,movimiento.id_sesion_caja,movimiento.mov_monto,tipo_movimiento.id_tipo_movimiento,tipo_movimiento.tipo_movimiento_descripcion
			FROM movimiento
			INNER JOIN concepto ON movimiento.mov_concepto = concepto.con_id
			INNER JOIN tipo_movimiento ON concepto.id_tipo_movimiento = tipo_movimiento.id_tipo_movimiento
			WHERE mov_id =".$id)->result_array();
		$sesion_caja = $this->db->query("SELECT sede_caja.sede_caja_monto,sede_caja.id_sede_caja, sesion_caja.id_sesion_caja FROM sesion_caja INNER JOIN sede_caja ON sesion_caja.id_sede_caja = sede_caja.id_sede_caja
			where sesion_caja.id_usuario=".$_SESSION['usuario_id']." and id_sesion_caja =".$movimiento[0]["id_sesion_caja"] )->result_array();
		if(count($movimiento) >0){
		$extornar = $sesion_caja[0]["sede_caja_monto"];
		if($movimiento[0]["id_tipo_movimiento"] == 1){
			$extornar = $sesion_caja[0]["sede_caja_monto"] - $movimiento[0]["mov_monto"] ;
			if($extornar > 0){
				$estado =1;
			}
		}else{
			$extornar = $sesion_caja[0]["sede_caja_monto"] + $movimiento[0]["mov_monto"] ;
			$estado  = 1 ;
		}

		if($estado == 1 ){
			$data = array(
				'sede_caja_monto' => $extornar
				);
			$this->db->where('id_sede_caja',$sesion_caja[0]["id_sede_caja"]);
			$estado=$this->db->update('sede_caja', $data);

			$data = array(
				'mov_estado' => '0'
				);
			$this->db->where('mov_id',$id);
			$estado=$this->db->update('movimiento', $data);
			$data = array(
				'ext_movimiento' => $id,
				'ext_usuario' => $_SESSION['usuario_id'],
				'fecha' => date('Y-m-d')
				);
			$estado=$this->db->insert('extornar', $data);


			$estado = 1;
		}else{
			$estado = 2;
		}
		 $datos = $estado."-".$extornar;
		}else{
			$datos = 0 ;
		}
		echo ($datos);
	}


	public function generar_movimiento($id_caja,$monto,$formapago,$concepto,$descripcion,$tipomovimiento,$id_tipo_comprobante,
		$descripcion_comprobante)
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

			$estado=1;
		}
		else{

			$estado=0;


		}

		return $estado;
	}

	public function generar_transferencia($id_origen,$monto,$id_destino){
		$sesion=$this->Mantenimiento_m->consulta2("SELECT max(sesion_caja.id_sesion_caja) as ult from sede_caja,sesion_caja 
			where 
			sede_caja.id_sede_caja=sesion_caja.id_sede_caja 
			and sede_caja.id_sede='".$_SESSION["id_sede"]."' and sede_caja.id_caja=".$id_caja." and sesion_caja.id_usuario=".$_SESSION['usuario_id']."
			and sesion_caja.ses_estado=1");
	}

	public function save_movimiento()
	{
		echo $this->generar_movimiento($_POST["caja"],$_POST["monto"],$_POST["formapago"],$_POST["concepto"],$_POST["descripcion"],$_POST["tipomovi"],$_POST["id_tipo_comprobante"],$_POST["descripcion_comprobante"]);

	}

	public function save_transferencia()
	{	
		$this->generar_movimiento($_POST["origen"],$_POST["monto"],1,4,$_POST["descripcion"],2,1,$_POST["descripcion_comprobante"]);
		echo $this->generar_movimiento($_POST["destino"],$_POST["monto"],1,3,$_POST["descripcion"],1,1,$_POST["descripcion_comprobante"]);

	}

	public function saldo_caja()
	{

		$caja=$this->Mantenimiento_m->consulta2("select * from sede_caja where id_sede=".$_SESSION["id_sede"]." and id_caja=".$_POST["id_caja"]);
		echo $caja->sede_caja_monto;

	}



	    public function ver_movimientos()
    {

        if($_POST["id_sede"]==0)
        { 
            $lista=$this->Mantenimiento_m->consulta("select *
				FROM
				sede_caja
				INNER JOIN sesion_caja ON sesion_caja.id_sede_caja = sede_caja.id_sede_caja
				INNER JOIN movimiento ON movimiento.id_sesion_caja = sesion_caja.id_sesion_caja
				INNER JOIN concepto ON movimiento.mov_concepto = concepto.con_id
				INNER JOIN tipo_movimiento ON concepto.id_tipo_movimiento = tipo_movimiento.id_tipo_movimiento
				INNER JOIN caja ON sede_caja.id_caja = caja.id_caja
				INNER JOIN sede ON sede.id_sede=sede_caja.id_sede 
				where movimiento.mov_fecha BETWEEN '".$_POST["inicio"]."' and '".$_POST["fin"]."' and movimiento.mov_estado = 1 order by movimiento.mov_id desc");
			

      
        }
        else{
            


			$lista=$this->Mantenimiento_m->consulta("select *
				FROM
				sede_caja
				INNER JOIN sesion_caja ON sesion_caja.id_sede_caja = sede_caja.id_sede_caja
				INNER JOIN movimiento ON movimiento.id_sesion_caja = sesion_caja.id_sesion_caja
				INNER JOIN concepto ON movimiento.mov_concepto = concepto.con_id
				INNER JOIN tipo_movimiento ON concepto.id_tipo_movimiento = tipo_movimiento.id_tipo_movimiento
				INNER JOIN caja ON sede_caja.id_caja = caja.id_caja
				INNER JOIN sede ON sede.id_sede=sede_caja.id_sede 
				where  movimiento.mov_fecha BETWEEN '".$_POST["inicio"]."' and '".$_POST["fin"]."' and sede_caja.id_sede=".$_POST["id_sede"]." and movimiento.mov_estado = 1 order by movimiento.mov_id desc");            

        }


        $c=1;
        foreach ($lista as $key => $value) {
        	echo "<tr>"; 
        	  echo "<td>".$c."</td>";
                echo "<td>".$value->caja_descripcion."</td>";
                echo "<td>".$value->tipo_movimiento_descripcion."</td>";
                echo "<td>".$value->con_descripcion."</td>";
                echo "<td>".$value->mov_monto."</td>";
                echo "<td>".$value->mov_descripcion."</td>";
                  echo "<td>".$value->descripcion."</td>";
        	echo "</tr>";

        	$c++;
        }


    }




}

