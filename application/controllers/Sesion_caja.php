<?php defined('BASEPATH') OR exit('No direct script access allowed');

include('Controler.php');

class Sesion_caja extends Controler {

	public function __construct() {

		parent::__construct();

		$this->load->model("Mantenimiento_m");



	}



	public function index(){








		$id_sede=$_SESSION['id_sede'];
		$hingresosf=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=1 and movimiento.mov_estado = 1 and sede_caja.id_caja=1 and sede_caja.id_sede=".$id_sede);
		if ($hingresosf[0]["monto"]=="") {
			$hingresosf=0.00;
		}else{
			$hingresosf = $hingresosf[0]["monto"];
		}



		$hegresosf=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=2 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and sede_caja.id_sede=".$id_sede);
		if ($hegresosf[0]["monto"]=="") {
			$hegresosf=0.00;
		}else{
			$hegresosf = $hegresosf[0]["monto"];
		}

		$hingresosv=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=1 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and sede_caja.id_sede=".$id_sede);
		if ($hingresosv[0]["monto"]=="") {
			$hingresosv=0.00;
		}else{
			$hingresosv = $hingresosv[0]["monto"];
		}

		$hegresosv=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=2 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and sede_caja.id_sede=".$id_sede);
		if ($hegresosv[0]["monto"]=="") {
			$hegresosv=0.00;
		}else{
			$hegresosv = $hegresosv[0]["monto"];
		}


		if($_SESSION['usuario_perfil']==1)
		{

			$sql="SELECT MAX(sesion_caja.id_sesion_caja) as ult FROM sede_caja,sesion_caja where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sede_caja.id_caja=1 and sede_caja.id_sede=".$id_sede;
			$ulsesionf=$this->Mantenimiento_m->consulta3($sql);

			if(count($ulsesionf[0]["ult"])>0){
				$estado_sesionf = $this->db->query("select * from sesion_caja where id_sesion_caja=".$ulsesionf[0]["ult"])->result_array();
				$fecha = explode(' ', $estado_sesionf[0]["ses_fechaapertura"]);
				if ($estado_sesionf[0]["ses_estado"]==0)
				{
					
					if($fecha[0]==date('Y-m-d')){
						$estado_caja = 4;
					}
					else{
						$estado_caja = 2;
					}
				}else{
					if($fecha[0]==date('Y-m-d')){
						$estado_caja = 3;
					}else{

						$estadosesion = $this->db->query("select * from sesion_caja where id_sesion_caja=".$ulsesionf[0]['ult'])->result_array();
						$fecha = explode(' ', $estadosesion[0]["ses_fechaapertura"]);
						$estado_caja = 3;
					}
				}



				$ingresosf=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
					where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
					sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
					concepto.id_tipo_movimiento=1 and sede_caja.id_caja=1  and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$id_sede);
				if ($ingresosf[0]["monto"]=="") {
					$ingresosf=0.00;
				}else{
					$ingresosf = $ingresosf[0]["monto"];
				}



				$egresosf=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
					where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
					sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
					concepto.id_tipo_movimiento=2 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$id_sede);
				if ($egresosf[0]["monto"]=="") {
					$egresosf=0.00;
				}else{
					$egresosf = $egresosf[0]["monto"];
				}

				$ingresosv=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
					where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
					sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
					concepto.id_tipo_movimiento=1 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$id_sede);
				if ($ingresosv[0]["monto"]=="") {
					$ingresosv=0.00;
				}else{
					$ingresosv = $ingresosv[0]["monto"];
				}

				$egresosv=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
					where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
					sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
					concepto.id_tipo_movimiento=2 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$id_sede);
				if ($egresosv[0]["monto"]=="") {
					$egresosv=0.00;
				}else{
					$egresosv = $egresosv[0]["monto"];
				} 

			}
			else{
				$estado_caja = 2;

				$ingresosf=0.00;
				$egresosv=0.00;
				$ingresosv=0.00;
				$egresosf=0.00;
			}



          /* $ulsesionv=$this->Mantenimiento_m->consulta3("SELECT MAX(sesion_caja.id_sesion_caja) FROM sede_caja,sesion_caja where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
          	sede_caja.id_caja=2  and sede_caja.id_sede=".$id_sede);*/


}
else{
	$estado_caja=1;
	$ingresosf=0.00;
	$egresosv=0.00;
	$ingresosv=0.00;
	$egresosf=0.00;
}

	if($_SESSION['usuario_perfil']==1)
		{

$this->load->view("Sesion_caja/index",compact("estado_caja","hingresosf","hegresosf","hingresosv","hegresosv","ingresosf","egresosf","ingresosv","egresosv"));
 
 }
 else
 {
    $sede=$this->Mantenimiento_m->consulta("select * from sede where estado=1");
 	$this->load->view("Sesion_caja/administrador",compact("sede"));
 	
 }













}

public function apertura_caja(){
	if ($this->input->is_ajax_request()){
		$exist_sesion = $this->db->query("select *from sesion_caja where ses_estado=1 and id_usuario='".$_SESSION['usuario_id']."'")->result_array();
		if (count($exist_sesion)==0) {

			$ult =$this->Mantenimiento_m->consulta("SELECT Max(sesion_caja.id_sesion_caja) AS ult,sede_caja.id_caja,sede_caja.sede_caja_monto,sede_caja.id_sede_caja FROM sesion_caja
				INNER JOIN sede_caja ON sesion_caja.id_sede_caja = sede_caja.id_sede_caja
				where sede_caja.id_sede =  '".$_SESSION['id_sede']."' GROUP BY id_caja");
			if(count($ult) != 0){
			foreach ($ult as $values) {

				if( $values->ult ==""){
					$ultimo = 0;
					
				}else{
					$ultimo = $values->ult;
				}
				$estadosesion = $this->db->query("select * from sesion_caja where id_sesion_caja=".$ultimo)->result_array();
				if (count($estadosesion)==0) {
					$valid_fecha = date('Y-m-d');

				}else{
					$fecha = explode(' ', $estadosesion[0]["ses_fechaapertura"]);
					if ($fecha[0]==date('Y-m-d')) {
						$actual = date('Y-m-d');
						$valid_fecha = date('Y-m-d',strtotime('+1 days', strtotime($actual)));
					}else{
						$valid_fecha = date('Y-m-d');
					}
				}
				//$caja = $this->db->query("SELECT * FROM sede_caja where id_sede_caja = '".$values->id_sede_caja."' ")->result_array();
				$data = array(
					'id_usuario' => $_SESSION['usuario_id'],
					'id_sede_caja' => $values->id_sede_caja,
					'ses_fechaapertura' => $valid_fecha.' '.date('H:i'),
					'ses_montoapertura' => $values->sede_caja_monto,
					'ses_montocierre' => 0.00
					);
				$estado=$this->db->insert('sesion_caja', $data);
			}
			}else{
				$valid_fecha = date('Y-m-d');
				$caja = $this->db->query("SELECT sede_caja.id_sede_caja FROM sede_caja where id_sede ='".$_SESSION['id_sede']."'")->result_array();
				foreach ($caja as $sedes) {
					$data = array(
					'id_usuario' => $_SESSION['usuario_id'],
					'id_sede_caja' => $sedes['id_sede_caja'],
					'ses_fechaapertura' => $valid_fecha.' '.date('H:i'),
					'ses_montoapertura' => 0.00,
					'ses_montocierre' => 0.00
					);
				$estado=$this->db->insert('sesion_caja', $data);
				}

			}
		}else{

		}
	}else{
		$this->load->view('Error/404');
	}
}

public	function close_sesioncaja(){
	if ($this->input->is_ajax_request()){
		$caja = $this->Mantenimiento_m->consulta("SELECT * FROM sede_caja where id_sede = '".$_SESSION['id_sede']."' ");
		foreach ($caja as $values) {
			$data = array(
				'ses_fechacierre' => date('Y-m-d').' '.date('H:i'),
				'ses_montocierre' => $values->sede_caja_monto,
				'ses_estado' => 0
				);
			$this->db->where('ses_estado',1);
			$this->db->where('id_sede_caja',$values->id_sede_caja);
			$estado=$this->db->update('sesion_caja', $data);
//			Sesioncaja::open_sesioncaja();
		}
	}else{
		$this->load->view('Error/404');
	}
}

public	function validarcaja(){
	if ($this->input->is_ajax_request()){
		$html = '1';
		$exist_sesion = $this->db->query("select *from sesion_caja where ses_estado=1 and id_usuario='".$_SESSION['usuario_id']."'")->result();
		  if(count($exist_sesion) !=0){		  		
		  		foreach ($exist_sesion as $values) {
				$fecha = explode(' ', $values->ses_fechaapertura);
				if($fecha[0]>=date('Y-m-d')){
					$html = $html;
				}else{
					$html = 'Estimado usuario: Aun no cierra caja del día: 	'."$fecha[0]";
				}


			}
		  }else{

		  			  	$html='Estimado usuario: Aun no abrio caja del día';

		  }

			echo $html;

	}else{
		$this->load->view('Error/404');
	}
}

}