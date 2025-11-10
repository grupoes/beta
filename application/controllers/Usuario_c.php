<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Usuario_c extends Controler {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Usuario_m');
		$this->load->library('zip');
		        $this->load->model("Mantenimiento_m");
	}
	public function index(){
		if ($this->input->is_ajax_request()){
			$listar = $this->Usuario_m->traerusuarios();
			$this->load->view('Usuario/index',compact('listar'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function new_asesor(){
		if ($this->input->is_ajax_request()){
			$sede = $this->db->query("SELECT sede.id_sede,sede.descripcion FROM sede where estado=1")->result();
			$especialidad =  $this->db->query("SELECT especialidad.descripcion, especialidad.id_especialidad FROM especialidad where estado=1")->result();
			$perfiles =  $this->db->query("SELECT perfil.per_id,perfil.per_descripcion FROM perfil where per_estado =1 and per_id!=3")->result();
			$this->load->view('Usuario/nuevo',compact('sede','especialidad','perfiles'));
		}else{
			$this->load->view('Error/404');
		}
	}

	public function savetrabajador(){
		if ($this->input->is_ajax_request()){
			$fecha_nac =date("Y/m/d", strtotime($_POST['fechanacimiento']));  
			$persona = array(
				'dni' => $_POST["dni"],
				'nombres' => $_POST["nombre"],
				'apellidos' => $_POST["apellido"],
				'telefono' => $_POST["celular"],
				'correo' => $_POST["correo"],
				'direccion' => $_POST["direccion"]
				);

			$trabajador = array(
				'dni' => $_POST["dni"],
				'n_cuenta_bcp' => $_POST["ncuenta"],
				'fecha_ingre' => "",
				'fecha_nac' => $fecha_nac
				);
			
			$usuario = array(
				'usu_usuario' => $_POST["usuario"],
				'usu_clave' => $_POST["clave"],
				'usu_perfil' =>$_POST["perfil"],
				'usu_fechareg' =>date("Y-m-d"),
				'usu_sede' => $_POST["sede"],
				'persona' => $_POST["dni"]
				);
		 //  print_r($_POST['especialidad']);exit();
			if($_POST["id"]==""){
				$this->db->insert('persona', $persona);
				
				$this->db->insert('trabajador', $trabajador);
               if(isset($_POST['especialidad'])){
				foreach ($_POST['especialidad'] as $key => $value) {
					 $data=$_POST['especialidad'][$key];
					$detalle = array(
						'id_especialidad' => $data,
						'id_trabajador' => $_POST["dni"]
						);
					
					$this->db->insert('especialidad_trabajador', $detalle);

				}
			   }

				$estado=$this->db->insert('usuario', $usuario);
			}


			else{

				$this->db->where('dni',$_POST["id"]);
				$this->db->update('persona', $persona);
				$this->db->where('dni',$_POST["id"]);
				$this->db->update('trabajador', $trabajador);
                if(isset($_POST['especialidad'])){
				$this->db->query("DELETE FROM especialidad_trabajador where id_trabajador=".$_POST["dni"].";");
				foreach ($_POST['especialidad'] as $key => $value) {
					 $data=$_POST['especialidad'][$key];
					$detalle = array(
						'id_especialidad' => $data,
						'id_trabajador' => $_POST["dni"]
						);
					$this->db->insert('especialidad_trabajador', $detalle);
				}
			   }
				$this->db->where('persona',$_POST["id"]);
				$estado=$this->db->update('usuario', $usuario);

			}
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}
	public function savecliente(){

			$persona = array(
				'dni' => $_POST["dni"],
				'nombres' => $_POST["nombre"],
				'apellidos' => $_POST["apellido"],
				'telefono' => $_POST["celular"],
				'correo' => $_POST["correo"],
				'direccion' => $_POST["direccion"]
				);
			$cliente = array(
				'dni' => $_POST["dni"],
				'id_tipocliente' => $_POST['tipocliente'],
				'id_universidad' => $_POST['universidad'],
				
																			
				);

			$usuario = array(
				'usu_usuario' => $_POST["usuario"],
				'usu_clave' => $_POST["clave"],
				'usu_perfil' =>'3',
				'usu_fechareg' => date('Y-m-d'),
				'persona' => $_POST["dni"]
				);

				$this->db->where('dni',$_POST["dni"]);
				$this->db->update('persona', $persona);
				$this->db->where('dni',$_POST["dni"]);
				$this->db->update('cliente', $cliente);

					$this->db->where('persona',$_POST["dni"]);
				$estado=$this->db->update('usuario', $usuario);
		

			echo $estado;
		
	}
	public function savefoto(){
		if (isset($_FILES['files'])) {
			$archivo = $_FILES['files'];
			$extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);
			$time = time();
			$url = base_url();
			$nombre ="{$_POST['nombre_archivo']}_$time.$extension";
			$direccion = $url .$nombre; 
			echo $direccion;
			if (move_uploaded_file($_FILES["files"]["tmp_name"],"public/perfil/". $_FILES["files"]["name"])) {
				$usuario = array(
					'usu_foto' =>$_FILES["files"]["name"]
					);
				$this->db->where('persona',$_POST["dni"]);
				$this->db->update('usuario', $usuario);
			} else {
				echo 0;
			}
		}
	}

	public function update_asesor(){
		$query = $this->db->query("SELECT
persona.nombres,persona.apellidos,persona.telefono,persona.correo,persona.direccion,trabajador.n_cuenta_bcp,
			trabajador.fecha_nac,trabajador.estado,usuario.usu_usuario,usuario.usu_clave,usuario.usu_foto,persona.dni,
			usuario.usu_sede,usuario.usu_perfil
FROM
trabajador
INNER JOIN persona ON persona.dni = trabajador.dni
INNER JOIN usuario ON persona.dni = usuario.persona
where persona.dni=".$_POST["dni"].";")->result();
		echo json_encode($query);
	}


	public function update_cliente(){
		$listar = $this->db->query("SELECT persona.nombres,persona.apellidos,persona.telefono,persona.correo,persona.direccion,
			persona.dni,tipocliente.descripcion AS tipocliente,universidad.descripcion AS universidad,
			distrito.descripcion AS distrito,tipocliente.id_tipocliente,universidad.id_universidad,distrito.id_distrito
			FROM
			persona
			LEFT JOIN cliente ON cliente.dni = persona.dni
			LEFT JOIN tipocliente ON cliente.id_tipocliente = tipocliente.id_tipocliente
			LEFT JOIN universidad ON cliente.id_universidad = universidad.id_universidad
			LEFT JOIN distrito ON cliente.id_distrito = distrito.id_distrito
			where cliente.estado=1 	and persona.dni=".$_POST["dni"].";")->result();
		$universidad = $this->db->query("SELECT universidad.id_universidad,universidad.descripcion FROM universidad where estado =1")->result();
		$tipocliente = $this->db->query("SELECT tipocliente.id_tipocliente,tipocliente.descripcion FROM tipocliente where estado =1")->result();
		$usuario = $this->db->query("SELECT usuario.usu_id,usuario.usu_usuario,usuario.usu_clave,usuario.usu_foto FROM usuario where usuario.persona=".$_POST["dni"].";")->result(); 
		$this->load->view('Usuario/cliente',compact('listar','universidad','tipocliente','usuario'));
	}

	function delete_usuario(){
		if ($this->input->is_ajax_request()){
			$data = array(
				'usu_estado' => 0
				);
			$this->db->where('persona', $_POST["id"]);
			$estado=$this->db->update('usuario', $data);
			echo $estado;
		}else{
			$this->load->view('Error/404');
		}
	}

	function validardni()
	{
		$query = $this->db->query("SELECT count(persona.dni) as cant  FROM persona where dni=".$_POST["dni"].";")->result();
		echo json_encode($query);
	}
		public function prueba(){
		$carpetaAdjunta=base_url() . 'archivos/'.$_POST["id_ficha"].'/';
// Contar envían por el plugin
		$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);

		for($i = 0; $i < $Imagenes; $i++) {
	// El nombre y nombre temporal del archivo que vamos para adjuntar
			$infoImagenesSubidas = array();
			$arrayreempla=array("/","");
			$archivo= str_replace($arrayreempla," ", $_FILES['imagenes']['name'][$i]);
			$type= explode(".", $archivo);
			$extension = end($type);
			$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
			$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;
			$rutaArchivo=$carpetaAdjunta.$nombreArchivo;
			$canti = $this->db->query("SELECT count(archivo.nombre_archivo) as cantidad FROM archivo INNER JOIN log_transacional ON archivo.id_archivo = log_transacional.id_archivo
				where log_transacional.id_log =".$_POST["id_ficha"]." and archivo.nombre_archivo  LIKE '%".$nombreArchivo."%';")->row_array();
			$canti = $canti['cantidad']; 
			if($canti == 1){
				$borrar = '../archivos/'.$_POST["id_ficha"]."/".$nombreArchivo;
				unlink($borrar);
				move_uploaded_file($_FILES["imagenes"]["tmp_name"][$i],"archivos/".$_POST["id_ficha"]."/". $_FILES["imagenes"]["name"][$i]);
				$id=$this->db->query("SELECT archivo.id_archivo FROM archivo ORDER BY id_archivo DESC LIMIT 1")->row_array();
				$id = $id['id_archivo'];
				$transaccion = array(
					'id_log' => $_POST["id_ficha"],
					'id_archivo' => $id,
					'fecha_movimiento' => date("y-m-d"),
					'id_usuario'  => $_SESSION['usuario_id'],
					'observacion' => $_POST['descrip'],
					'id_tipo_movi' => '2'
					);
				$this->db->insert('log_transacional', $transaccion);
				$notificacion = array(
					'descripcion' => 'Se actualizo una imagen',
					'imagen' => $nombreArchivo,
					'fecha' => date("y-m-d H:i:s"),
					'url'  => 'Documentos_c/new_documento',
					'estado' => '1',
					'id_usuario' => $_SESSION['usuario_id'],
					'nombre' =>$_SESSION['usuario_nombre']
					);
				$this->db->insert('notificacion', $notificacion);
			}else{
				$directorio = "archivos/".$_POST["id_ficha"];
				if(!is_dir($directorio)){
					mkdir($directorio,0755,TRUE);
				}
				move_uploaded_file($_FILES["imagenes"]["tmp_name"][$i], "archivos/".$_POST["id_ficha"]."/". $_FILES["imagenes"]["name"][$i]);
				$archivo = array(
					'nombre_archivo' => $nombreArchivo,
					'tipo_archivo' => $extension
					);
				$this->db->insert('archivo', $archivo);
				$id=$this->db->query("SELECT archivo.id_archivo FROM archivo ORDER BY id_archivo DESC LIMIT 1")->row_array();
				$id = $id['id_archivo'];
				$transaccion = array(
					'id_log' => $_POST["id_ficha"],
					'id_archivo' => $id,
					'fecha_movimiento' => date("y-m-d H:i:s"),
					'id_usuario'  => $_SESSION['usuario_id'],
					'observacion' => $_POST['descrip'],
					'id_tipo_movi' => '1'
					);
				$this->db->insert('log_transacional', $transaccion);
								$notificacion = array(
					'descripcion' => 'Se inserto  una imagen',
					'imagen' => $nombreArchivo,
					'fecha' => date("y-m-d H:i:s"),
					'url'  => 'Documentos_c/new_documento',
					'estado' => '1',
					'id_usuario' => $_SESSION['usuario_id'],
					'nombre' =>$_SESSION['usuario_nombre']
					);
				//$this->db->insert('notificacion', $notificacion);
			}
			$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>base_url()."Usuario_c/borrar","key"=>$nombreArchivo);
			$ImagenesSubidas[$i]="<img  height='120px'  src=".$rutaArchivo." class='kv-preview-data file-preview-image file-zoom-detail'>";


		}
		$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			"initialPreview"=>$ImagenesSubidas);
		echo json_encode($arr);
      if($_SESSION['usuario_perfil']==3){
		$usuS =$this->Mantenimiento_m->consulta("SELECT * from usuario WHERE usuario.usu_perfil=5");
	
		foreach ($usuS as $key => $value) {
			
			$notificacion = array(
					'descripcion' => 'Se subio un nuevo archivo',
					'imagen' => "",
					'fecha' => date("Y-m-d H:i:s"),
					'url'  => 'Documentos_c/new_documento',
					'estado' => '1',
					'id_usuario' => $value->persona,
					'nombre' =>$_SESSION['usuario_nombre'],
					'id' =>$_POST["id_ficha"]
					);

						$this->db->insert('notificacion', $notificacion);
		}
			$usu =$this->Mantenimiento_m->consulta("SELECT * from usuario WHERE usuario.usu_perfil=4 or usuario.usu_perfil=1 and usuario.usu_sede=".$_SESSION['id_sede']);
	
		foreach ($usu as $key => $value) {
			
			$notificacion = array(
					'descripcion' => 'Se subio un nuevo archivo',
					'imagen' => "",
					'fecha' => date("Y-m-d H:i:s"),
					'url'  => 'Documentos_c/new_documento',
					'estado' => '1',
					'id_usuario' => $value->persona,
					'nombre' =>$_SESSION['usuario_nombre'],
					'id' =>$_POST["id_ficha"]
					);

						$this->db->insert('notificacion', $notificacion);
		}
	  }
	}

	public function historial(){
		$listar = $this->db->query("SELECT archivo.nombre_archivo,log_transacional.fecha_movimiento,log_transacional.observacion,
			tipo_mov.descripcion as tipomov,CONCAT(persona.nombres,' ',persona.apellidos) as nombres FROM archivo
			INNER JOIN log_transacional ON log_transacional.id_archivo = archivo.id_archivo
			INNER JOIN tipo_mov ON tipo_mov.id_tipo_movi = log_transacional.id_tipo_movi
			INNER JOIN usuario ON usuario.usu_id = log_transacional.id_usuario
			INNER JOIN persona ON usuario.persona = persona.dni  where archivo.id_archivo = ".$_POST["id"].";")->result();
		echo json_encode($listar);
	}

	public function borrar(){


		parse_str(file_get_contents("php://input"),$datosDELETE);
		$key= $datosDELETE['key'];
		$id = $this->db->query("SELECT archivo.id_archivo FROM archivo where 	nombre_archivo like '%".$key."%'")->row_array();
		$id = $id['id_archivo'];
		$id_pro = $this->db->query("SELECT `id_log` FROM `log_transacional` WHERE id_archivo=".$id." group by id_log")->row_array();
		$id_pro = $id_pro['id_log'];
		$carpetaAdjunta="archivos/".$id_pro."/";
		$archivo = array(
			'estado' => '0'
			);
		$this->db->where('nombre_archivo',$key);
		$this->db->update('archivo', $archivo);
		$transaccion = array(
			'id_log' => $id_pro,
			'id_archivo' => $id,
			'fecha_movimiento' => date("y-m-d"),
			'id_usuario'  => $_SESSION['usuario_id'],
			'observacion' => 'Eliminado',
			'id_tipo_movi' => '3'
			);
		$this->db->insert('log_transacional', $transaccion);
		unlink("archivos/".$id_pro."/".$key."");

		echo json_encode(0);

	}

	public function datos(){
		$query = $this->db->query("SELECT archivo.id_archivo,archivo.nombre_archivo FROM archivo INNER JOIN log_transacional ON archivo.id_archivo = log_transacional.id_archivo
			where log_transacional.id_log  =".$_POST["id_ficha"].";")->result();
		echo json_encode($query);
	}
	function descargar(){
		if (isset($_POST['linkurl'])) {

			foreach ($_POST['linkurl'] as $key => $value) {	
			
				$this->zip->read_file($value,TRUE);		
			}	
			
			($this->zip->download('descarga.zip'));
		}

	}
}