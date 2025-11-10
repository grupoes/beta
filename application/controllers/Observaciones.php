<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Observaciones extends Controler {
	public function __construct() {
		parent::__construct();
		$this->load->model("Mantenimiento_m");

	}
	public function index(){
		if ($this->input->is_ajax_request()){
			$lista = $this->db->query("SELECT ficha_enfoque.titulo_enfoque,observaciones.descripcion,observaciones.fecha,observaciones.idobservacion,
				observaciones.idficha,CONCAT(persona.nombres,' ',persona.apellidos) as nombre,observaciones.estado
				FROM ficha_enfoque ,usuario ,observaciones,persona,cliente
				where usuario.usu_id = observaciones.idusuario and ficha_enfoque.id_ficha_enfoque = observaciones.idficha
				and cliente.dni = ficha_enfoque.id_cliente and persona.dni = cliente.dni
			and observaciones.estado = 1")->result();
			$this->load->view('Observaciones/index',compact('lista'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function nuevasobservaciones(){
		if ($this->input->is_ajax_request()){
			$id =  $_POST['id'];
			$this->load->view('Observaciones/nuevo',compact('id'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function categoria_subfases(){
		//print_r($_POST['subfase']); exit();
		$this->Mantenimiento_m->consulta1("delete from detalle_observaciones where detalle_observaciones.idobservaciones=".$_POST["id_observacion"]);
		for($i=0; $i<count($_POST['subfase']); $i++){
			$data1=array(
			 "idobservaciones"=>$_POST['id_observacion'],
			 "idsubfase"=>$_POST['subfase'][$i],
			 "descripcion"=>$_POST['descripcion'][$i],
			 "tiempo"=>$_POST["hora"][$i]
			 );
			$this->Mantenimiento_m->insertar("detalle_observaciones",$data1);
		}
		$data2  = array(
			"estado" => '0'
		);
		$this->db->where('idobservacion',$_POST["id_observacion"]);
		$estado=$this->db->update('observaciones', $data2);
       

       $id_ficha_enfoque=$this->Mantenimiento_m->consulta2("select * from observaciones where idobservacion=".$_POST["id_observacion"]);
        $data2  = array(
			"ficha_enfoque_estado_observacion" => '0'
		);
		//print_r($id_ficha_enfoque);
		$this->db->where('id_ficha_enfoque',$id_ficha_enfoque->idficha);
		$estado=$this->db->update('ficha_enfoque', $data2);



    






	}

	public function fases(){
		if ($this->input->is_ajax_request()){
			$cate_tipo =  $this->db->query("SELECT ficha_enfoque.id_categoria,ficha_enfoque.id_tipo_enfoque FROM observaciones 
			INNER JOIN ficha_enfoque ON ficha_enfoque.id_ficha_enfoque = observaciones.idficha where observaciones.idobservacion =".$_POST['id_observacion'])->result_array();
			$fases = $this->db->query("select DISTINCT(subfase.id_fase) as id_fase,fases.titulo as fases,fases.descripcion as descripcion 
				from categoria_subfase,subfase,fases    WHERE categoria_subfase.id_categoria='".$cate_tipo[0]['id_categoria']."' and categoria_subfase.id_subfase=subfase.id_subfase
				and subfase.id_fase=fases.id_fase and fases.id_tipo_enfoque='".$cate_tipo[0]['id_tipo_enfoque']."' order by subfase.id_subfase asc")->result();

			   $_SESSION["id_tipo_enfoque"]=$cate_tipo[0]['id_tipo_enfoque'];
			$html="";
			$html.= "<option value=''>Selecionar Fase </option>";
			foreach ($fases as $value) {
				$html.= "<option value='".$value->id_fase."'>".$value->fases."</option>";
			}
			echo $html;
		}else{
			$this->load->view('Error/404');
		}
	}

	public function subfase(){
		if (isset($_POST['id_fase'])) {

			$subfase = $this->db->query("select * from subfase WHERE subfase.id_fase=".$_POST['id_fase'])->result();

			$html="";
			$html.= "<option value=''>Selecionar Fase </option>";
			foreach ($subfase as $value) {
				$html.= "<option value='".$value->id_subfase."'>".$value->descripcion."</option>";
			}
			echo $html;
		}
	}

	public function buscador()
	{
		$sql="SELECT  subfase.id_subfase ,fases.id_fase,subfase.descripcion as descripcion,subfase.titulo as titulo,fases.titulo as ftitulo FROM fases INNER JOIN subfase ON subfase.id_fase = fases.id_fase WHERE subfase.descripcion LIKE '%".$_GET["term"]."%' and fases.id_tipo_enfoque=".$_SESSION["id_tipo_enfoque"];
		$datos=$this->Mantenimiento_m->consulta3($sql);
		$data=array();
		foreach ($datos as $key => $value) {
			$data[$key]["id"]=$value["id_subfase"]."/".$value["id_fase"];
			$data[$key]["label"]=substr($value["ftitulo"]."(".$value["titulo"].")".$value["descripcion"],0, 165);
			$data[$key]["value"]=$value["titulo"];

		}
		echo json_encode($data);
	}

	public function salir()
	{

		$data=$this->Mantenimiento_m->consulta2("select * from observaciones where idobservacion=".$_POST["id_observacion"]);
		$id_ficha_enfoque=$data->idficha;
		$id_usuario=$data->id_asignador;
        
        $x=$this->Mantenimiento_m->consulta("select * from persona where dni=".$id_usuario);
        foreach ($x as $key => $value) {
          $nombres=$value->nombres." ".$value->apellidos;
        }
		 $data1=array(
           "descripcion"=>"Se termino la ficha de observacion",
           "fecha"=>date('Y-m-d H:i:s'),
           "url"=>"Ficha_enfoque/actualizar",
           "id_usuario"=>$id_usuario,
           "id"=>$id_ficha_enfoque,
           "nombre"=>$nombres

          );
            $this->Mantenimiento_m->insertar("notificacion",$data1);

	}

}