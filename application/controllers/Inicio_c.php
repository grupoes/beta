<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Inicio_c extends Controler {/*aqui debe jalar de la extensión controlador, pero aun no esta definida , por falta de base*/

	public function software_empresa(){
		if (!isset($_SESSION["usuario_perfil"])) {
			header('Location: '.base_url()); exit();
		}
		$lista_modulos = Controler::lista_modulos();
		$sedes = $this->db->query("SELECT sede.descripcion, sede.id_sede FROM sede where sede.estado=1")->result();
		$this->load->view('Layout/sistema',compact("lista_modulos","sedes"));
	}
	public function index(){
		
		$this->load->view('Layout/sistema');
	}
	
}