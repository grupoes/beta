<?php defined('BASEPATH') OR exit('No direct script access allowed');

 date_default_timezone_set('America/Lima');
class Login extends CI_Controller {
	 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }
    public function removeCache()
	{
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
	}
	public function index(){
	    
		$this->load->view('Login/index');

	}
	
	public function crear_login(){
	
	$login = $this->db->query(
			"select *from usuario,persona,sede,perfil where usuario.usu_perfil=perfil.per_id and sede.id_sede=usuario.usu_sede and persona.dni=usuario.persona and usu_usuario='".$_POST['username']."' and usu_clave='".$_POST['password']."' and usu_estado=1"
		)->result_array();

	

		if (count($login)>0) {
			$_SESSION['usuario_id'] = $login[0]['usu_id'];
			$_SESSION['usuario'] = $login[0]['usu_usuario'];
			$_SESSION['usuario_nombre'] = $login[0]['nombres'].' '.$login[0]['apellidos'];
			$_SESSION['usuario_perfil'] = $login[0]['usu_perfil'];
			$_SESSION['sede']=$login[0]['descripcion'];
			$_SESSION['imagen']=$login[0]['usu_foto'];
			$_SESSION['perfil']=$login[0]['per_descripcion'];
			$_SESSION['dni_usuario']=$login[0]['dni'];
			$_SESSION['id_persona'] = $login[0]['persona'];
			$_SESSION['id_sede'] = $login[0]['id_sede'];
			 if($_SESSION['usuario_perfil']==2)
			 {
                     //$x=$this->validarLogin($_SESSION['id_persona']);
                     $x=1;
                     if($x==0){
                         		echo '2-Su Tiempo de hoy se agotado';
                     }
			 }
		}else{

			echo '2-Usuario o contraseña incorrento!';
			
		}
		session_destroy();
			$this->removeCache();
			
		session_start();
		$login = $this->db->query(
			"select *from usuario,persona,sede,perfil where usuario.usu_perfil=perfil.per_id and sede.id_sede=usuario.usu_sede and persona.dni=usuario.persona and usu_usuario='".$_POST['username']."' and usu_clave='".$_POST['password']."' and usu_estado=1"
		)->result_array();

	

		if (count($login)>0) {
			$_SESSION['usuario_id'] = $login[0]['usu_id'];
			$_SESSION['usuario'] = $login[0]['usu_usuario'];
			$_SESSION['usuario_nombre'] = $login[0]['nombres'].' '.$login[0]['apellidos'];
			$_SESSION['usuario_perfil'] = $login[0]['usu_perfil'];
			$_SESSION['sede']=$login[0]['descripcion'];
			$_SESSION['imagen']=$login[0]['usu_foto'];
			$_SESSION['perfil']=$login[0]['per_descripcion'];
			$_SESSION['dni_usuario']=$login[0]['dni'];
			$_SESSION['id_persona'] = $login[0]['persona'];
			$_SESSION['id_sede'] = $login[0]['id_sede'];
			 if($_SESSION['usuario_perfil']==2)
			 {
                     //$x=$this->validarLogin($_SESSION['id_persona']);
                     $x=1;
                     if($x==0){
                         		echo '2-Su Tiempo de hoy se agotado';
                     }
			 }
		}else{

			echo '2-Usuario o contraseña incorrento!';
			
		}
	
	
	}

	public function destroy_login(){
		session_destroy();
		$this->removeCache();
		header('Location: '.base_url());
		
	}

	public function validarLogin($id){
		 $sql="select max(fin_tiempo) as fecha from horario_trabajador where id_trabajador='".$id."'  and DATE(fin_tiempo)= curdate()";
		 $data=$this->Mantenimiento_m->consulta2($sql);
		  $diaActual=date("Y-m-d H:i:s");
    $datetime1 = new DateTime($diaActual);
    $datetime2 = new DateTime($data->fecha);
       if($datetime1 > $datetime2)
     {
          return 1;
     }
     else{
           return 1;
     }
   

	}
	public function validarLogin1(){
		 $sql="select max(fin_tiempo) as fecha from horario_trabajador where id_trabajador='".$_POST['datos']."'  and DATE(fin_tiempo)= curdate()";
		 $data=$this->Mantenimiento_m->consulta2($sql);
		  $diaActual=date("Y-m-d H:i:s");
    $datetime1 = new DateTime($diaActual);
    $datetime2 = new DateTime($data->fecha);
       $dteDiff  = $datetime2->diff($datetime1); 
  

       if($datetime1 > $datetime2)
     {
              $datos=array("estado"=>1,"minutos"=>"");
     }
     else{
                $datos=array("estado"=>1,"minutos"=>$dteDiff->format("%I:%S"));
     }
   
 echo json_encode($datos);
	}
}
