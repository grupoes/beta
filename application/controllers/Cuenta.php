<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Cuenta extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

 public function index()
 {
 	$this->load->view("Cuenta/index");
 }

 public function subir_foto()
 {
 	    $dir_subida = "public/perfil/";


            //$fichero_subido = $dir_subida.basename($_FILES['foto']['name']);
      $ver=explode('.',$_FILES['foto']['name']);


      if(count($ver)>1){
       $name =basename($_FILES['foto']['name']);
       list($base,$extension) = explode('.',$name);
    $newname = implode('.', [$base, time(), $extension]);
      }
      else{
          $name =basename($_FILES['foto']['name']);
          $extension="jpg";
             $newname = implode('.', [$name, time(), $extension]);
      }
       
          if (move_uploaded_file($_FILES['foto']['tmp_name'], $dir_subida.$newname)) 
             {
              
              }
         else {
                echo "Error al subir la foto es demasiado grande";                 
           }
         $_SESSION['imagen']=$newname;
    
     $data=array(

        "usu_foto"=>$newname
     );
    
     $this->Mantenimiento_m->actualizar("usuario",$data,  $_SESSION['usuario_id'] ,"usu_id");
     echo "<img src='".base_url()."/public/perfil/".$_SESSION['imagen']."' class='img-circle img-responsive' alt=''>";
 }

 public function cambiar()
 {
     $data=$this->Mantenimiento_m->consulta3("select * from usuario where usu_usuario='".$_SESSION["usuario"]."' and usu_clave='".$_POST["con_ant"]."'");
     if(count($data)>0)
     {

       $data=array(

        "usu_clave"=>$_POST["con_nue"]
     );
    
     $this->Mantenimiento_m->actualizar("usuario",$data,  $_SESSION['usuario_id'] ,"usu_id");
      echo "1";

     }
     else
     {
       echo "2";
     }
 }

}
?>