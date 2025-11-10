

<?php defined('BASEPATH') OR exit('No direct script access allowed');

include('Controler.php');

class Nuevo_cliente extends Controler {

 public function __construct() {

        parent::__construct();

        $this->load->model("Mantenimiento_m");

      

    }



	public function index(){
		  $lista=$this->Mantenimiento_m->consulta("select * from cliente_ingreso where cli_ing_estado=1");

                 $this->load->view('Nuevo_cliente/index',compact('lista'));

		}

	}
	?>