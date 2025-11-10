<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Graficos extends Controler {
 public function __construct() {
  parent::__construct();
  $this->load->model("Mantenimiento_m");

}
public function arqueo_grafico(){
  if ($this->input->is_ajax_request()){
    $data = [];

    $ficha=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=2 and ficha_enfoque.estado_ficha!=0")->result_array();
    $asesor=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=3 and ficha_enfoque.estado_ficha!=0")->result_array();
    $horario=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=4 and ficha_enfoque.estado_ficha!=0")->result_array();
    $pago=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=5 and ficha_enfoque.estado_ficha!=0")->result_array();
    $produccion=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=6 and ficha_enfoque.estado_ficha!=0")->result_array();

    $finalizacion=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=7 and ficha_enfoque.estado_ficha!=0")->result_array();

    $data["ficha"] = (double)$ficha[0]["cuota"];
    $data["asesor"] = (double)$asesor[0]["cuota"];
    $data["horario"] = (double)$horario[0]["cuota"];
    $data["pago"] = (double)$pago[0]["cuota"];
    $data["produccion"] = (double)$produccion[0]["cuota"];
    $data["finalizacion"] = (double)$finalizacion[0]["cuota"];
    echo json_encode($data);
  }else{
    $this->load->view('Error/404');
  }
}

public function arqueo_caja(){
  if ($this->input->is_ajax_request()){
    $data = [];

    $ficha=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=2 and ficha_enfoque.estado_ficha!=0")->result_array();
    $asesor=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=3 and ficha_enfoque.estado_ficha!=0")->result_array();
    $horario=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=4 and ficha_enfoque.estado_ficha!=0")->result_array();
    $pago=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=5 and ficha_enfoque.estado_ficha!=0")->result_array();
    $produccion=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=6 and ficha_enfoque.estado_ficha!=0")->result_array();

    $finalizacion=$this->db->query("select count(id_ficha_enfoque) as cuota from ficha_enfoque where estado_ficha=7 and ficha_enfoque.estado_ficha!=0")->result_array();

    $data["ficha"] = (double)$ficha[0]["cuota"];
    $data["asesor"] = (double)$asesor[0]["cuota"];
    $data["horario"] = (double)$horario[0]["cuota"];
    $data["pago"] = (double)$pago[0]["cuota"];
    $data["produccion"] = (double)$produccion[0]["cuota"];
    $data["finalizacion"] = (double)$finalizacion[0]["cuota"];
    echo json_encode($data);
  }else{
    $this->load->view('Error/404');
  }
}

public function ingresos(){
  $ene1=0;$ene2=0;$ene3=0;$ene4=0;$ene5=0;$ene6=0;$ene7=0;$ene8=0;$ene9=0;$ene10=0;$ene11=0;$ene12=0;
  $sql="SELECT sum(cronograma.cuo_montopagado) as sumar,  MONTH(cuo_fechacancelado) AS mes
  from cronograma
  WHERE YEAR(cuo_fechacancelado)=".date('Y')."
  GROUP BY MONTH(cuo_fechacancelado)
  ORDER BY MONTH(cuo_fechacancelado) ASC;";


  $data=$this->Mantenimiento_m->consulta($sql);

  foreach ($data as $key => $value) {
    if($value->mes==1){$ene1=$value->sumar;}
    if($value->mes==2){$ene2=$value->sumar;}
    if($value->mes==3){$ene3=$value->sumar;}
    if($value->mes==4){$ene4=$value->sumar;}
    if($value->mes==5){$ene5=$value->sumar;}
    if($value->mes==6){$ene6=$value->sumar;}
    if($value->mes==7){$ene7=$value->sumar;}
    if($value->mes==8){$ene8=$value->sumar;}
    if($value->mes==9){$ene9=$value->sumar;}
    if($value->mes==10){$ene10=$value->sumar;}
    if($value->mes==11){$ene11=$value->sumar;}
    if($value->mes==12){$ene12=$value->sumar;}

  }

  $dato=[];
  $dato["numero"]["ene"]=(double)$ene1;
  $dato["numero"]["feb"]=(double)$ene2;
  $dato["numero"]["mar"]=(double)$ene3;
  $dato["numero"]["abr"]=(double)$ene4;
  $dato["numero"]["may"]=(double)$ene5;
  $dato["numero"]["jun"]=(double)$ene6;
  $dato["numero"]["jul"]=(double)$ene7;
  $dato["numero"]["ago"]=(double)$ene8;
  $dato["numero"]["set"]=(double)$ene9;
  $dato["numero"]["oct"]=(double)$ene10;
  $dato["numero"]["nov"]=(double)$ene11;
  $dato["numero"]["dic"]=(double)$ene12;

  echo json_encode($dato);
}

public function caja(){
  $id_sede=$_SESSION['id_sede'];


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
        concepto.id_tipo_movimiento=1 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and  movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$id_sede);
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
$data["ingresosf"] = (double)$ingresosf;
$data["egresosf"] = (double)$egresosf;
$data["ingresosv"] = (double)$ingresosv;
$data["egresosv"] = (double)$egresosv;
echo json_encode($data);
}


public function caja_mes(){
  $id_sede=$_SESSION['id_sede'];
  $EIF=0;$FIF=0;$MIF=0;$AIF=0;$MAIF=0;$JIF=0;$JUIF=0;$AIF=0;$SIF=0;$OIF=0;$NIF=0;$DIF=0;
  $EEF=0;$FEF=0;$MEF=0;$AEF=0;$MAEF=0;$JEF=0;$JUEF=0;$AEF=0;$SEF=0;$OEF=0;$NEF=0;$DEF=0;
  $EIV=0;$FIV=0;$MIV=0;$AIV=0;$MAIV=0;$JIV=0;$JUIV=0;$AIV=0;$SIV=0;$OIV=0;$NIV=0;$DIV=0;
  $EEV=0;$FEV=0;$MEV=0;$AEV=0;$MAEV=0;$JEV=0;$JUEV=0;$AEV=0;$SEV=0;$OEV=0;$NEV=0;$DEV=0;
  $hingresosf=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto,MONTH(movimiento.mov_fecha) AS mes from sede_caja,sesion_caja,movimiento,concepto 
    where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
    sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
    concepto.id_tipo_movimiento=1 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$id_sede." GROUP BY MONTH(movimiento.mov_fecha)
    ORDER BY MONTH(movimiento.mov_fecha) ASC")->result();
  foreach ($hingresosf as $value) {
    if($value->mes==1){$EIF=$value->monto;}
    if($value->mes==2){$FIF=$value->monto;}
    if($value->mes==3){$MIF=$value->monto;}
    if($value->mes==4){$AIF=$value->monto;}
    if($value->mes==5){$MAIF=$value->monto;}
    if($value->mes==6){$JIF=$value->monto;}
    if($value->mes==7){$JUIF=$value->monto;}
    if($value->mes==8){$AIF=$value->monto;}
    if($value->mes==9){$SIF=$value->monto;}
    if($value->mes==10){$OIF=$value->monto;}
    if($value->mes==11){$NIF=$value->monto;}
    if($value->mes==12){$DIF=$value->monto;}
  }
  $hegresosf=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto,MONTH(movimiento.mov_fecha) AS mes from sede_caja,sesion_caja,movimiento,concepto 
    where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
    sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
    concepto.id_tipo_movimiento=2 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$id_sede." GROUP BY MONTH(movimiento.mov_fecha)
    ORDER BY MONTH(movimiento.mov_fecha) ASC")->result();
  foreach ($hegresosf as $value) {
    if($value->mes==1){$EEF=$value->monto;}
    if($value->mes==2){$FEF=$value->monto;}
    if($value->mes==3){$MEF=$value->monto;}
    if($value->mes==4){$AEF=$value->monto;}
    if($value->mes==5){$MAEF=$value->monto;}
    if($value->mes==6){$JEF=$value->monto;}
    if($value->mes==7){$JUEF=$value->monto;}
    if($value->mes==8){$AEF=$value->monto;}
    if($value->mes==9){$SEF=$value->monto;}
    if($value->mes==10){$OEF=$value->monto;}
    if($value->mes==11){$NEF=$value->monto;}
    if($value->mes==12){$DEF=$value->monto;}
  }
  $hingresosv=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto,MONTH(movimiento.mov_fecha) AS mes from sede_caja,sesion_caja,movimiento,concepto 
    where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
    sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
    concepto.id_tipo_movimiento=1 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$id_sede." GROUP BY MONTH(movimiento.mov_fecha)
    ORDER BY MONTH(movimiento.mov_fecha) ASC")->result();
    foreach ($hingresosv as $value) {
    if($value->mes==1){$EIV=$value->monto;}
    if($value->mes==2){$FIV=$value->monto;}
    if($value->mes==3){$MIV=$value->monto;}
    if($value->mes==4){$AIV=$value->monto;}
    if($value->mes==5){$MAIV=$value->monto;}
    if($value->mes==6){$JIV=$value->monto;}
    if($value->mes==7){$JUIV=$value->monto;}
    if($value->mes==8){$AIV=$value->monto;}
    if($value->mes==9){$SIV=$value->monto;}
    if($value->mes==10){$OIV=$value->monto;}
    if($value->mes==11){$NIV=$value->monto;}
    if($value->mes==12){$DIV=$value->monto;}
  }
  $hegresosv=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto,MONTH(movimiento.mov_fecha) AS mes from sede_caja,sesion_caja,movimiento,concepto 
    where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
    sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
    concepto.id_tipo_movimiento=2 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$id_sede." GROUP BY MONTH(movimiento.mov_fecha)
    ORDER BY MONTH(movimiento.mov_fecha) ASC")->result();
  foreach ($hegresosv as $value) {
    if($value->mes==1){$EEV=$value->monto;}
    if($value->mes==2){$FEV=$value->monto;}
    if($value->mes==3){$MEV=$value->monto;}
    if($value->mes==4){$AEV=$value->monto;}
    if($value->mes==5){$MAEV=$value->monto;}
    if($value->mes==6){$JEV=$value->monto;}
    if($value->mes==7){$JUEV=$value->monto;}
    if($value->mes==8){$AEV=$value->monto;}
    if($value->mes==9){$SEV=$value->monto;}
    if($value->mes==10){$OEV=$value->monto;}
    if($value->mes==11){$NEV=$value->monto;}
    if($value->mes==12){$DEV=$value->monto;}
  }
    $dato=[];
  $dato["hingresosf"]["ene"]=(double)$EIF;
  $dato["hingresosf"]["feb"]=(double)$FIF;
  $dato["hingresosf"]["mar"]=(double)$MIF;
  $dato["hingresosf"]["abr"]=(double)$AIF;
  $dato["hingresosf"]["may"]=(double)$MAIF;
  $dato["hingresosf"]["jun"]=(double)$JIF;
  $dato["hingresosf"]["jul"]=(double)$JUIF;
  $dato["hingresosf"]["ago"]=(double)$AIF;
  $dato["hingresosf"]["set"]=(double)$SIF;
  $dato["hingresosf"]["oct"]=(double)$OIF;
  $dato["hingresosf"]["nov"]=(double)$NIF;
  $dato["hingresosf"]["dic"]=(double)$DIF;

   $dato["hegresosf"]["ene"]=(double)$EEF;
  $dato["hegresosf"]["feb"]=(double)$FEF;
  $dato["hegresosf"]["mar"]=(double)$MEF;
  $dato["hegresosf"]["abr"]=(double)$AEF;
  $dato["hegresosf"]["may"]=(double)$MAEF;
  $dato["hegresosf"]["jun"]=(double)$JEF;
  $dato["hegresosf"]["jul"]=(double)$JUEF;
  $dato["hegresosf"]["ago"]=(double)$AEF;
  $dato["hegresosf"]["set"]=(double)$SEF;
  $dato["hegresosf"]["oct"]=(double)$OEF;
  $dato["hegresosf"]["nov"]=(double)$NEF;
  $dato["hegresosf"]["dic"]=(double)$DEF;

   $dato["hingresosv"]["ene"]=(double)$EIV;
  $dato["hingresosv"]["feb"]=(double)$FIV;
  $dato["hingresosv"]["mar"]=(double)$MIV;
  $dato["hingresosv"]["abr"]=(double)$AIV;
  $dato["hingresosv"]["may"]=(double)$MAIV;
  $dato["hingresosv"]["jun"]=(double)$JIV;
  $dato["hingresosv"]["jul"]=(double)$JUIV;
  $dato["hingresosv"]["ago"]=(double)$AIV;
  $dato["hingresosv"]["set"]=(double)$SIV;
  $dato["hingresosv"]["oct"]=(double)$OIV;
  $dato["hingresosv"]["nov"]=(double)$NIV;
  $dato["hingresosv"]["dic"]=(double)$DIV;

   $dato["hegresosv"]["ene"]=(double)$EEV;
  $dato["hegresosv"]["feb"]=(double)$FEV;
  $dato["hegresosv"]["mar"]=(double)$MEV;
  $dato["hegresosv"]["abr"]=(double)$AEV;
  $dato["hegresosv"]["may"]=(double)$MAEV;
  $dato["hegresosv"]["jun"]=(double)$JEV;
  $dato["hegresosv"]["jul"]=(double)$JUEV;
  $dato["hegresosv"]["ago"]=(double)$AEV;
  $dato["hegresosv"]["set"]=(double)$SEV;
  $dato["hegresosv"]["oct"]=(double)$OEV;
  $dato["hegresosv"]["nov"]=(double)$NEV;
  $dato["hegresosv"]["dic"]=(double)$DEV;
  echo json_encode($dato);
}


public function mes(){
  $data2 = [];
  $dni=0;
  $sql="SELECT
  trabajador.dni,
  trabajador.n_cuenta_bcp,
  trabajador.fecha_nac,
  trabajador.fecha_ingre,
  trabajador.horas_trabajo,
  trabajador.estado,
  persona.nombres,
  persona.apellidos
  FROM
  trabajador
  INNER JOIN persona ON trabajador.dni = persona.dni
  INNER JOIN usuario ON usuario.persona = persona.dni and (usuario.usu_perfil=2 or usuario.usu_perfil=4) where usuario.usu_estado=1
  " ;
  $data=$this->Mantenimiento_m->consulta($sql);

  foreach ($data as $key1 => $value) {
    $monto=0.00;

    $dni=$value->dni;
    $sql1="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(tiempo))) as tiempo from horario_trabajador where id_trabajador=".$dni."
    and MONTH(fin_tiempo)=".date("m")." AND YEAR(fin_tiempo)=".date("Y");



    $data1=$this->Mantenimiento_m->consulta($sql1);
    foreach ($data1 as $key => $value1) {
      if($value1->tiempo!=""){
       $tiempo=$value1->tiempo;
       $ar=explode(":", $tiempo); 
       $horas=(int)$ar[0];
       $minuto=(int)$ar[1];
       $min=(double)($minuto/60);
       $data3=(double)($horas+$min);
       $monto=$data3;





     }
   }


   $data2[$key1]['name'] = $value->nombres.' '.$value->apellidos;
   $data2[$key1]['y'] = (double)$monto;


 }
 echo json_encode($data2);

}
function caja_total(){
  $sedes = $this->db->query("SELECT sede.descripcion, sede.id_sede FROM sede where sede.estado=1")->result();
  (double)$ene=0;(double)$feb=0;(double)$mar=0;(double)$abril=0;(double)$may=0;(double)$jun=0;(double)$jul=0;(double)$ago=0;(double)$sep=0;(double)$oct=0;(double)$nov=0;(double)$dic=0;
  $i =0;
  $serie ="";
  $categoria = "";
  $dato=[];
  $categoria =array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

  foreach ($sedes as $key =>$sede) {
    $i=$i+1;
    $ingresos=$this->db->query("SELECT SUM(movimiento.mov_monto) as ingresos,MONTH(movimiento.mov_fecha) AS mes from sede_caja,sesion_caja,movimiento,concepto 
      where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
      sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
      (concepto.id_tipo_movimiento=1) and movimiento.mov_estado = 1  and (sede_caja.id_caja=1 or sede_caja.id_caja=2) 
      and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$sede->id_sede." GROUP BY MONTH(movimiento.mov_fecha)  ORDER BY MONTH(movimiento.mov_fecha) ASC")->result();
        foreach($ingresos as $ingresostotal){
       if($ingresostotal->mes==1){(double)$ene=(double)($ene + $ingresostotal->ingresos);}
       if($ingresostotal->mes==2){(double)$feb=(double)($feb + $ingresostotal->ingresos);}
       if($ingresostotal->mes==3){(double)$mar=(double)($mar + $ingresostotal->ingresos);}
       if($ingresostotal->mes==4){(double)$abril=(double)($abril + $ingresostotal->ingresos);}
       if($ingresostotal->mes==5){(double)$may=(double)($may + $ingresostotal->ingresos);}
       if($ingresostotal->mes==6){(double)$jun=(double)($jun + $ingresostotal->ingresos);}
       if($ingresostotal->mes==7){(double)$jul=(double)($jul + $ingresostotal->ingresos);}
       if($ingresostotal->mes==8){(double)$ago=(double)($ago + $ingresostotal->ingresos);}
       if($ingresostotal->mes==9){(double)$sep=(double)($sep + $ingresostotal->ingresos);}
       if($ingresostotal->mes==10){(double)$oct=(double)($oct + $ingresostotal->ingresos);}
       if($ingresostotal->mes==11){(double)$nov=(double)($nov + $ingresostotal->ingresos);}
       if($ingresostotal->mes==12){(double)$dic=(double)($dic + $ingresostotal->ingresos);}
   }
    
    $egresos=$this->db->query("SELECT SUM(movimiento.mov_monto) as egresos,MONTH(movimiento.mov_fecha) AS mes from sede_caja,sesion_caja,movimiento,concepto 
      where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
      sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
      (concepto.id_tipo_movimiento=2) and movimiento.mov_estado = 1  and (sede_caja.id_caja=1 or sede_caja.id_caja=2) and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$sede->id_sede." GROUP BY MONTH(movimiento.mov_fecha)
      ORDER BY MONTH(movimiento.mov_fecha) ASC")->result();
        foreach($egresos as $ingresostotal){
       if($ingresostotal->mes==1){(double)$ene=(double)($ene - $ingresostotal->egresos);}
       if($ingresostotal->mes==2){(double)$feb=(double)($feb - $ingresostotal->egresos);}
       if($ingresostotal->mes==3){(double)$mar=(double)($mar - $ingresostotal->egresos);}
       if($ingresostotal->mes==4){(double)$abril=(double)($abril  - $ingresostotal->egresos);}
       if($ingresostotal->mes==5){(double)$may=(double)($may  - $ingresostotal->egresos);}
       if($ingresostotal->mes==6){(double)$jun=(double)($jun  - $ingresostotal->egresos);}
       if($ingresostotal->mes==7){(double)$jul=(double)($jul  - $ingresostotal->egresos);}
       if($ingresostotal->mes==8){(double)$ago=(double)($ago  - $ingresostotal->egresos);}
       if($ingresostotal->mes==9){(double)$sep=(double)($sep  - $ingresostotal->egresos);}
       if($ingresostotal->mes==10){(double)$oct=(double)($oct  - $ingresostotal->egresos);}
       if($ingresostotal->mes==11){(double)$nov=(double)($nov  - $ingresostotal->egresos);}
       if($ingresostotal->mes==12){(double)$dic=(double)($dic  - $ingresostotal->egresos);}
   }
    
   $dato["ingresos"]["datos"][$key]["name"]=$sede->descripcion;
    $dato["ingresos"]["datos"][$key]["data"]=array($ene,$feb,$mar,$abril,$may,$jun,$jul,$ago,$sep,$oct,$nov,$dic);
     (double)$ene=0;(double)$feb=0;(double)$mar=0;(double)$abril=0;(double)$may=0;(double)$jun=0;(double)$jul=0;(double)$ago=0;(double)$sep=0;(double)$oct=0;(double)$nov=0;(double)$dic=0;
 }
 $dato["ingresos"]["categoria"]=($categoria);

 echo json_encode($dato);

}

function caja_x_sede(){
  if($_SESSION['usuario_perfil']==5)
  {
   $sedes = $this->db->query("SELECT sede.descripcion, sede.id_sede FROM sede where sede.estado=1")->result();
   $ingresosfi = array();$ingresosvi =array();$egresosfi =array();$egresosvi = array(); $data["ingresos"]["categoria"] = array();
   foreach ($sedes as $key =>$sede) {
     $sql="SELECT MAX(sesion_caja.id_sesion_caja) as ult FROM sede_caja,sesion_caja where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
    sede_caja.id_caja=1 and sede_caja.id_sede=".$sede->id_sede;
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
        concepto.id_tipo_movimiento=1 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$sede->id_sede);
      if ($ingresosf[0]["monto"]=="") {
        array_push($ingresosfi,(double)(0.00));
      }else{
        array_push($ingresosfi,(double)($ingresosf[0]["monto"]));
      }



      $egresosf=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
        where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
        sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
        concepto.id_tipo_movimiento=2 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$sede->id_sede);
      if ($egresosf[0]["monto"]=="") {
        array_push($egresosfi,(double)(0.00));
      }else{
        $egre = (-1)*( $egresosf[0]["monto"]);
        array_push($egresosfi , (double)($egre));
      }

      $ingresosv=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
        where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
        sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
        concepto.id_tipo_movimiento=1 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$sede->id_sede);
      if ($ingresosv[0]["monto"]=="") {
        array_push($ingresosvi,(double)(0.00));
      }else{
        array_push($ingresosvi , (double)($ingresosv[0]["monto"]));
      }

      $egresosv=$this->Mantenimiento_m->consulta3("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
        where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
        sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
        concepto.id_tipo_movimiento=2 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and movimiento.mov_fecha='".$fecha[0]."' and sede_caja.id_sede=".$sede->id_sede);
      if ($egresosv[0]["monto"]=="") {
        array_push($egresosvi,(double)(0.00));
      }else{
        $egre = (-1) * $egresosv[0]["monto"];
        array_push($egresosvi , (double)($egre));
      } 

    }
    else{
      $estado_caja = 2;

      $ingresosf=0.00;
      $egresosv=0.00;
      $ingresosv=0.00;
      $egresosf=0.00;
    }

    array_push($data["ingresos"]["categoria"],$sede->descripcion);

            

   }


  }
  else{
    $estado_caja=1;
    $ingresosf=0.00;
    $egresosv=0.00;
    $ingresosv=0.00;
    $egresosf=0.00;
  }
$data["ingresos"]["datos"][0]["name"]=("Ingresos Fisicos");
$data["ingresos"]["datos"][1]["name"]=("Egresos Fisicos");
$data["ingresos"]["datos"][2]["name"]=("Ingresos Virtuales");
$data["ingresos"]["datos"][3]["name"]=("Egresos Virtuales");

$data["ingresos"]["datos"][0]["stack"]=('male');
$data["ingresos"]["datos"][1]["stack"]=('male');
$data["ingresos"]["datos"][2]["stack"]=('female');
$data["ingresos"]["datos"][3]["stack"]=('female');

$data["ingresos"]["datos"][0]["data"]=($ingresosfi);
$data["ingresos"]["datos"][1]["data"]=($egresosfi);
$data["ingresos"]["datos"][2]["data"]=($ingresosvi);
$data["ingresos"]["datos"][3]["data"]=($egresosvi);
echo json_encode($data);

    
}

function caja_x_diaria(){
  $id_sede = $_GET['id'];
  $i=0;
 $utilidades= array();

if($id_sede == 0){
  $utilidades= $this->db->query("SELECT (ingresos - egresos) as monto ,(fecha)
    from 
    (SELECT if((movimiento.mov_monto) != '',SUM(movimiento.mov_monto),0) as ingresos,sesion_caja.ses_fechaapertura as fecha  from sede_caja,sesion_caja,movimiento,concepto 
          where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
          sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
          (concepto.id_tipo_movimiento=1) and movimiento.mov_estado = 1  and (sede_caja.id_caja=1 or sede_caja.id_caja=2)
          and YEAR(movimiento.mov_fecha)= ".date('Y')."  
          GROUP BY movimiento.mov_fecha
ORDER BY movimiento.mov_fecha
    ) AS  ing
    Inner Join

    (      SELECT if((movimiento.mov_monto) != '',SUM(movimiento.mov_monto),0) as egresos,sesion_caja.ses_fechaapertura as fechas  from sede_caja,sesion_caja,movimiento,concepto 
          where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
          sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
          (concepto.id_tipo_movimiento=2) and movimiento.mov_estado = 1  and (sede_caja.id_caja=1 or sede_caja.id_caja=2)
    and YEAR(movimiento.mov_fecha)= ".date('Y')." 
    GROUP BY movimiento.mov_fecha
ORDER BY movimiento.mov_fecha ) as egre
where if(fecha = fechas,  (ingresos - egresos) , NULL) IS NOT NULL 
    ")->result();   
}else{
    $utilidades= $this->db->query("SELECT SUM(mov.ingresos-mov.egresos) as monto , mov.fecha from 
    (SELECT
      if((movimiento.mov_monto) != '',SUM(movimiento.mov_monto),0) AS ingresos,
        0 as egresos,
      sesion_caja.ses_fechaapertura AS fecha,
      sesion_caja.id_sesion_caja
      from sede_caja,sesion_caja,movimiento,concepto
      where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
      sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
      (concepto.id_tipo_movimiento=1) and movimiento.mov_estado = 1  and (sede_caja.id_caja=1 or sede_caja.id_caja=2)
      and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$id_sede." 
      GROUP BY movimiento.id_sesion_caja

      UNION ALL

      SELECT
      0 as ingresos,
      if((movimiento.mov_monto) != '',SUM(movimiento.mov_monto),0) AS egresos,
        sesion_caja.ses_fechaapertura AS fechas,
      sesion_caja.id_sesion_caja
      from sede_caja,sesion_caja,movimiento,concepto
      where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
      sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
      (concepto.id_tipo_movimiento=2) and movimiento.mov_estado = 1  and (sede_caja.id_caja=1 or sede_caja.id_caja=2)
      and YEAR(movimiento.mov_fecha)= ".date('Y')." and sede_caja.id_sede=".$id_sede." 
      GROUP BY movimiento.id_sesion_caja ) as mov 
GROUP BY mov.fecha")->result(); 
}
  foreach($utilidades as $value){
    $fech =  10 * strtotime($value->fecha);
    $fech = $fech .'00';
    $utilidades[$i] = array((double)($fech),(double)($value->monto),(double)($value->monto));
    $i++; 
  }
  $i=0;

$data["ingresos"]["datos"][0]["name"]=("Utilidades");

 $data["ingresos"]["datos"][0]["data"]=($utilidades);
  echo json_encode($data);
}

public function ver_ultimo()
{

   $sql="SELECT max(horario_trabajador.fin_tiempo) as maxtiempo,persona.nombres,persona.apellidos,persona.dni
FROM
usuario
INNER JOIN persona ON usuario.persona = persona.dni
INNER JOIN trabajador ON trabajador.dni = persona.dni
INNER JOIN horario_trabajador ON horario_trabajador.id_trabajador = trabajador.dni
where usuario.usu_estado=1 AND usuario.usu_sede=".$_SESSION["id_sede"]."
GROUP BY usuario.usu_usuario order by maxtiempo ASC";
echo '<div class="table-responsive">
              <table class="table">
                <thead>
                  <tr class="bg-blue">
                    <th>NOMBRES Y APELLIDOS</th>
                    <th>HORARIO</th>
                           
                  </tr>
                </thead>
                <tbody>';
$sql1=$this->Mantenimiento_m->consulta($sql);
foreach ($sql1 as $key => $value) {
    echo '<tr>
                    <td><a onclick="trabajos('.$value->dni.')"   class="editable editable-click" data-original-title="" title="" >'.$value->nombres." ".$value->apellidos.'</a></td>
               <td>'.$value->maxtiempo.'</td></tr>';
}
echo ' </tbody>
              </table>
            </div>';

        echo '<script>
        function trabajos(id) {
            $("#modal_trabajador").modal();
            $("#idusuario").val(id);
        }
        </script>';

}
  public function ver_trabajos(){
    $lista=$this->Mantenimiento_m->consulta("SELECT DISTINCT ficha_enfoque.id_ficha_enfoque,ficha_enfoque.titulo_enfoque,
      horario_trabajador.fin_tiempo,horario_trabajador.id_trabajador
      FROM produccion
      INNER JOIN logproduccion ON produccion.id_producion = logproduccion.idproduccion
      INNER JOIN ficha_enfoque ON produccion.id_ficha_enfoque = ficha_enfoque.id_ficha_enfoque
      INNER JOIN horario_trabajador ON horario_trabajador.id_horario = logproduccion.idhorario 
      where (DATE(horario_trabajador.fin_tiempo) BETWEEN '".$_POST["inicio"]."' and '".$_POST["fin"]."')  and horario_trabajador.id_trabajador = '".$_POST["idusuario"]."'
      GROUP BY ficha_enfoque.id_ficha_enfoque");
        $c=1;
        $html="";
        foreach ($lista as $key => $value) {
          $html.= "<tr >"; 
            $html.= "<td width='5%'>".$c."</td>";
               $html.=  "<td width='95%'>".$value->titulo_enfoque."</td>";
          $html.=  "</tr>";

          $c++;
        }
        $c=$c-1;
    $datos=array("tabla"=>$html,"total"=>$c);
        echo json_encode($datos);
  }

  public function buscador()
  {
    $dat=" SELECT
ficha_enfoque.id_ficha_enfoque,
ficha_enfoque.titulo_enfoque
FROM
ficha_enfoque
where ficha_enfoque.titulo_enfoque LIKE '%".$_GET["term"]."%' limit 10";

   $sql=$this->Mantenimiento_m->consulta3($dat);


$data=array();
if(count ($sql)>0){
    foreach ($sql as $key => $value) {
      $data[$key]["id"]=$value["id_ficha_enfoque"];
      $data[$key]["label"]=substr(mb_strtolower($value["titulo_enfoque"]),0,80);
      $data[$key]["value"]=$value["titulo_enfoque"];

    }
    
   }
   else{

      $data[0]["id"]="0";
      $data[0]["label"]="";
      $data[0]["value"]="no hay ningun resultado";
   }
   echo json_encode($data);


  }

}

?>
