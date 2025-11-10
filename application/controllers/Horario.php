<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Horario extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

	public function index(){
		if($this->input->is_ajax_request()){

			$lista=$this->Mantenimiento_m->lista("grado");
			$this->load->view("Horario/index");

		}
		else{
			$this->load->view("Error/404");
		}
	}

	public function editar_horario(){
		    $diaActual=date("Y-m-d H:i:00");
    $datetime1 = new DateTime($diaActual);
    $datetime2 = new DateTime($_POST['fi']);
 
       if($datetime2 >= $datetime1)
       {
		 $id=$_POST['id'];
		 $fi=$_POST['fi'];
		 $ff=$_POST['ff'];

		 $sql="update horario_trabajador set empiezo_tiempo='".$fi."',fin_tiempo='".$ff."' where id_horario=".$id;
		 
		$this->Mantenimiento_m->consulta1($sql);
		echo 1;
		  }
      else{
            echo 0;

       }
	}
		public function editar_tamano(){
		  /*  $diaActual=date("Y-m-d H:i:00");
    $datetime1 = new DateTime($diaActual);
    $datetime2 = new DateTime($_POST['fi']);
       if($datetime2 >= $datetime1)
       {*/
		 $id=$_POST['id'];
		 $fi=$_POST['fi'];
		 $ff=$_POST['ff'];
            $datetime1 = new DateTime($fi); 
                                                                     
            $datetime2 = new DateTime($ff); 
             $diff5=date_diff($datetime2,$datetime1 );
              // $diff5->format('%H:%i:%s');




		$sql="update horario_trabajador set tiempo='".$diff5->format('%H:%i:%s')."',empiezo_tiempo='".$fi."',fin_tiempo='".$ff."' where id_horario=".$id;
		 
		$this->Mantenimiento_m->consulta1($sql);
		echo 1;
		/*  }
      else{
            echo 0;

       }*/
	}

	public function datos(){
		$sql="select * from horario_trabajador where id_horario=".$_POST['id'];

		$sql1 ="SELECT
persona.nombres,
persona.apellidos,
universidad.descripcion,
cliente.carrera,
persona.telefono
FROM
logproduccion
INNER JOIN produccion ON logproduccion.idproduccion = produccion.id_producion
INNER JOIN ficha_enfoque ON produccion.id_ficha_enfoque = ficha_enfoque.id_ficha_enfoque
INNER JOIN cliente ON ficha_enfoque.id_cliente = cliente.dni
INNER JOIN persona ON cliente.dni = persona.dni
INNER JOIN universidad ON cliente.id_universidad = universidad.id_universidad WHERE logproduccion.idhorario=".$_POST['id'];
         $dat=$this->Mantenimiento_m->consulta2($sql1);
		$data=$this->Mantenimiento_m->consulta($sql);
		foreach ($data as $key => $value) {
			$titulo=$value->titulo;
			$descripcion=$value->descripcion;
			$inicio=$value->empiezo_tiempo;
            $fin=$value->fin_tiempo;
		}
		$dati=array("titulo"=>$titulo,"descripcion"=>$descripcion,"inicio"=>$inicio,"fin"=>$fin,"nombres"=>$dat->nombres." ".$dat->apellidos,
			"universidad"=>$dat->descripcion."(".$dat->carrera.")","telefono"=>$dat->telefono);
		echo json_encode($dati);
	}
	public function insertar_hora(){
		
	}
	   public function actualizacion_datos()
   {
   	     $this->Mantenimiento_m->consulta1("update horario_trabajador set titulo='".$_POST['value']."', descripcion='".$_POST['descripcion']."'
   	     where id_horario=".$_POST['id_horario']);
   }

   public function cortar()
   {
   	  $idhorario=$_POST['idhorario'];
   	  $id=$this->Mantenimiento_m->consulta2("select * from horario_trabajador where id_horario=".$_POST['idhorario']);
   	  $hi=$id->empiezo_tiempo;
   	  $hf=$id->fin_tiempo;
   	  $h=$this->Mantenimiento_m->consulta2("select * from usuario where persona=".$id->id_trabajador);
   	  $sede=$this->Mantenimiento_m->consulta2("select * from sede where id_sede=".$h->usu_sede);
   	  //print_r($sede);
   	  $hoim=$sede->horario_m_i;
   	  $hofm=$sede->horario_m;
   	  $hoit=$sede->horario_t_i;
   	  $hoft=$sede->horario_t;

   	  $inicio= new DateTime($hi);
   	  $fin= new DateTime($hf);
   	   $fechainicio= $inicio->format('Y-m-d');
   	   $horainicio= $inicio->format('H:i:00');
   	   $fechafin= $fin->format('Y-m-d');
   	   $horafin= $fin->format('H:i:00');
   	  // echo $fechainicio.$horainicio;
   	   $hi=strtotime($horainicio);
   	   $hf=strtotime($horafin);
   	     $h_m_i=strtotime($sede->horario_m_i);
    $h_m_f=strtotime($sede->horario_m);
    $h_t_i=strtotime($sede->horario_t_i);
    $h_t_f=strtotime($sede->horario_t);

    if($hi>=$h_m_i && $hi<$h_m_f)
    {
          if($hf>$h_m_f)
          {
                $fechaif=$fechainicio." ".$hofm;
                
                 $hinicio= new DateTime($hofm);
   	             $hfin= new DateTime($horafin);
                 $hora1 = $hfin->diff($hinicio); 
                  $horaN2 =$hora1->format("%H:%I:%S"); 

                 $hinicio= new DateTime($horainicio);
   	             $hfin= new DateTime($hofm);
                 $hora1 = $hfin->diff($hinicio); 
              $horaN1 =$hora1->format("%H:%I:%S"); 

                 $this->Mantenimiento_m->consulta1("update horario_trabajador set fin_tiempo='". $fechaif."',tiempo='". $horaN1."' where id_horario= ".$idhorario);
                 $datos=array(
             "empiezo_tiempo"=>$fechaif,
             "fin_tiempo"=>$id->fin_tiempo,
             "tiempo"=>$horaN2,
            "id_trabajador"=>$id->id_trabajador,
            "titulo"=>$id->titulo,
            "descripcion"=>$id->descripcion,
            "color"=>$id->color,
            "idTiempo"=>$id->idTiempo    
             );
            // print_r($datos);
             $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
                  $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
                  $dat=$this->Mantenimiento_m->consulta2("select * from logproduccion where idhorario=".$idhorario);
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$dat->idtiempo,
                 "idproduccion"=>$dat->idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
            echo "1";
          } 
          else
          {
          	echo "error";
          }
    }
    else
    {
   
       if($hi>=$h_t_i && $hi<$h_t_f)
        {
               if($hf>$h_t_f)
                  {
                      $fechaif=$fechainicio." ".$hoft;
                 $hinicio= new DateTime($hoft);
   	             $hfin= new DateTime($horafin);
                 $hora1 = $hfin->diff($hinicio); 
              $horaN2 =$hora1->format("%H:%I:%S"); 
                
                 $hinicio= new DateTime($horainicio);
   	             $hfin= new DateTime($hoft);
                 $hora1 = $hfin->diff($hinicio); 
              $horaN1 =$hora1->format("%H:%I:%S"); 

                    $this->Mantenimiento_m->consulta1("update horario_trabajador set fin_tiempo='". $fechaif."',tiempo='". $horaN1."' where id_horario= ".$idhorario);
                     $datos=array(
                       "empiezo_tiempo"=>$fechaif,
                        "fin_tiempo"=>$id->fin_tiempo,
                          "tiempo"=>$horaN2,
                          "id_trabajador"=>$id->id_trabajador,
                       "titulo"=>$id->titulo,
                       "descripcion"=>$id->descripcion,
                         "color"=>$id->color,
                         "idTiempo"=>$id->idTiempo    
                      );
            // print_r($datos);
             $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
                  $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
                  $dat=$this->Mantenimiento_m->consulta2("select * from logproduccion where idhorario=".$idhorario);
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$dat->idtiempo,
                 "idproduccion"=>$dat->idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
 echo "1";
                  } 
                else
                 {
                  echo "error";
                 }
        }
        else
         {

          echo "error mueve  este horario a un lugar de inicio en hora de a9tencion los horarios son ".$sede->horario_m_i." a ".$sede->horario_m. " y ".$sede->horario_t_i." a ".$sede->horario_t;
          } 
    }

       

   }
	public function eliminar()
  {     

    echo $sql= "delete from horario_trabajador where  id_horario=".$_POST['idhorario'];
         $this->Mantenimiento_m->consulta1($sql);
  }
}
?>