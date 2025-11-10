<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');
class Documentos_c extends Controler{
	 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }
	public function index(){
		if ($this->input->is_ajax_request()){
		   /*if($_SESSION['usuario_perfil']=="2"){

		
			$lista = $this->db->query("   	SELECT persona.nombres,persona.apellidos,ficha_enfoque.id_ficha_enfoque,produccion.id_producion as id_produccion,ficha_enfoque.titulo_enfoque,
persona.telefono
FROM
ficha_enfoque
INNER JOIN persona ON ficha_enfoque.id_cliente = persona.dni
INNER JOIN produccion ON ficha_enfoque.id_ficha_enfoque = produccion.id_ficha_enfoque
INNER JOIN logproduccion ON produccion.id_producion = logproduccion.idproduccion
INNER JOIN horario_trabajador ON logproduccion.idhorario = horario_trabajador.id_horario
where ficha_enfoque.estado!=0 and ficha_enfoque.estado!=7 and horario_trabajador.id_trabajador=".$_SESSION['id_persona']." 
GROUP BY produccion.id_producion")->result();
		   }
		   if($_SESSION['usuario_perfil']=="3")
		   {
		   	$lista = $this->db->query("select persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque FROM
produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente  and  ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque
and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.id_cliente=".$_SESSION['id_persona']." ORDER BY produccion.id_producion DESC  ")->result();

		   }
		   if($_SESSION['usuario_perfil']=="1"){
		  	 $sql="select DISTINCT(id_producion) as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque,persona.telefono,persona.nombres,persona.apellidos FROM
usuario,produccion,ficha_enfoque,persona 
where persona.dni=ficha_enfoque.id_cliente and  usuario.usu_sede=".$_SESSION['id_sede']." and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.estado_ficha!=7 ORDER BY produccion.id_producion DESC ";
           $lista = $this->db->query($sql)->result();
		   }
		     if($_SESSION['usuario_perfil']=="4"){
		     	 $sql="select DISTINCT(id_producion) as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque,persona.telefono,persona.nombres,persona.apellidos FROM
usuario,produccion,ficha_enfoque,persona 
where persona.dni=ficha_enfoque.id_cliente and  usuario.usu_sede=".$_SESSION['id_sede']." and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.estado_ficha!=7 ORDER BY produccion.id_producion DESC ";
           $lista = $this->db->query($sql)->result();
		   }
		   if ($_SESSION['usuario_perfil']=="5")
             {
		   		$lista = $this->db->query("SELECT persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque from produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.estado_ficha!=7 ORDER BY produccion.id_producion DESC ")->result();
		   	}	*/


			$this->load->view('Documentos/index');
		}else{
			$this->load->view('Error/404');
		}
	}


public function tabla_data()
{


	$columns = array( 
                            0 =>'id', 
                            1 =>'titulo',
                            2=> 'cliente',
                            3=>'asesores',
                            4=> 'telefono',
                           5=>'acciones',
                        );
		$limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columns[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];


       
    if ($_SESSION['usuario_perfil']=="5")
             {
        $lista1=$this->db->query("SELECT persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque from produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0  ORDER BY produccion.id_producion ".$dir)->result();
             }

             if($_SESSION['usuario_perfil']=="1" || $_SESSION['usuario_perfil']=="4"){
              $sql="select DISTINCT(id_producion) as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque,persona.telefono,persona.nombres,persona.apellidos FROM
usuario,produccion,ficha_enfoque,persona 
where persona.dni=ficha_enfoque.id_cliente and  produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque
 and persona.dni=usuario.persona and  usuario.usu_sede=".$_SESSION['id_sede']." and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0  ORDER BY produccion.id_producion ".$dir;
		  	  $lista1=$this->db->query($sql)->result();
     }
      if($_SESSION['usuario_perfil']=="3")
		   {
		   	$lista1 = $this->db->query("select persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque FROM
produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente  and  ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque
and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.id_cliente=".$_SESSION['id_persona']." ORDER BY produccion.id_producion ".$dir)->result();

		   }
		   if($_SESSION['usuario_perfil']=="2"){

		
			$lista1 = $this->db->query("   	SELECT persona.nombres,persona.apellidos,ficha_enfoque.id_ficha_enfoque,produccion.id_producion as id_produccion,ficha_enfoque.titulo_enfoque,
persona.telefono
FROM
ficha_enfoque
INNER JOIN persona ON ficha_enfoque.id_cliente = persona.dni
INNER JOIN produccion ON ficha_enfoque.id_ficha_enfoque = produccion.id_ficha_enfoque
INNER JOIN logproduccion ON produccion.id_producion = logproduccion.idproduccion
INNER JOIN horario_trabajador ON logproduccion.idhorario = horario_trabajador.id_horario
where ficha_enfoque.estado!=0 and ficha_enfoque.estado!=7 and horario_trabajador.id_trabajador=".$_SESSION['id_persona']." 
GROUP BY produccion.id_producion ".$dir)->result();
		   }




          
          $totalFiltered = count($lista1); 
           $totalData = count($lista1); 
      
         $data;
          if(empty($this->input->post('search')['value']))
        {            
             if ($_SESSION['usuario_perfil']=="5")
             {
             $lista = $this->db->query("SELECT persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque from produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0  ORDER BY produccion.id_producion ".$dir." limit ".$start.",".$limit);
             }

               if($_SESSION['usuario_perfil']=="1" || $_SESSION['usuario_perfil']=="4"){
           	$sql="select DISTINCT(id_producion) as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque,persona.telefono,persona.nombres,persona.apellidos FROM
usuario,produccion,ficha_enfoque,persona 
where persona.dni=ficha_enfoque.id_cliente and  produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque
 and persona.dni=usuario.persona and  usuario.usu_sede=".$_SESSION['id_sede']." and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0  ORDER BY produccion.id_producion ".$dir." limit ".$start.",".$limit;
		  	  $lista=$this->db->query($sql);
		  	  
     }

if($_SESSION['usuario_perfil']=="3")
		   {
		    $sql="select persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque FROM
produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente  and  ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque
and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.id_cliente=".$_SESSION['id_persona']." ORDER BY produccion.id_producion  ".$dir." limit ".$start.",".$limit;
		   	$lista = $this->db->query($sql);
		

		   }
		    if($_SESSION['usuario_perfil']=="2"){

		
			$lista = $this->db->query("   	SELECT persona.nombres,persona.apellidos,ficha_enfoque.id_ficha_enfoque,produccion.id_producion as id_produccion,ficha_enfoque.titulo_enfoque,
persona.telefono
FROM
ficha_enfoque
INNER JOIN persona ON ficha_enfoque.id_cliente = persona.dni
INNER JOIN produccion ON ficha_enfoque.id_ficha_enfoque = produccion.id_ficha_enfoque
INNER JOIN logproduccion ON produccion.id_producion = logproduccion.idproduccion
INNER JOIN horario_trabajador ON logproduccion.idhorario = horario_trabajador.id_horario
where ficha_enfoque.estado!=0 and ficha_enfoque.estado!=7 and horario_trabajador.id_trabajador=".$_SESSION['id_persona']." 
GROUP BY produccion.id_producion ".$dir." limit ".$start.",".$limit);
		   }




              if($lista->num_rows()>0)
             {
                    $data= $lista->result(); 
                }
              else
             {
               $data= null;
              }
        }
         else
         {
         	 $search = $this->input->post('search')['value']; 


                   
               if ($_SESSION['usuario_perfil']=="5" || $_SESSION['usuario_perfil']=="4")
             {
         	   $lista = $this->db->query("SELECT persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque from produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0  and (ficha_enfoque.titulo_enfoque like '%". $search."%' or persona.nombres like '%". $search."%' or persona.telefono like '%". $search."%')  ORDER BY produccion.id_producion ".$dir." limit ".$start.",".$limit);
               }

              if($_SESSION['usuario_perfil']=="1"){
		  	 $lista=$this->db->query("select DISTINCT(id_producion) as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque,persona.telefono,persona.nombres,persona.apellidos FROM
usuario,produccion,ficha_enfoque,persona 
where persona.dni=ficha_enfoque.id_cliente and  produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque
 and persona.dni=usuario.persona and  usuario.usu_sede=".$_SESSION['id_sede']." and produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque and ficha_enfoque.estado_ficha!=0  and (ficha_enfoque.titulo_enfoque like '%". $search."%' or persona.nombres like '%". $search."%' or persona.telefono like '%". $search."%')  ORDER BY produccion.id_producion ".$dir." limit ".$start.",".$limit);
		  	 
     }
     if($_SESSION['usuario_perfil']=="3")
		   {
		   	$lista = $this->db->query("select persona.telefono,persona.nombres,persona.apellidos,id_producion as id_produccion,ficha_enfoque.titulo_enfoque,ficha_enfoque.id_ficha_enfoque FROM
produccion,ficha_enfoque,persona where persona.dni=ficha_enfoque.id_cliente  and  ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque
and ficha_enfoque.estado_ficha!=0 and ficha_enfoque.id_cliente=".$_SESSION['id_persona']." and (ficha_enfoque.titulo_enfoque like '%". $search."%' or persona.nombres like '%". $search."%' or persona.telefono like '%". $search."%') ORDER BY produccion.id_producion  ".$dir." limit ".$start.",".$limit);

		   }
  if($_SESSION['usuario_perfil']=="2"){

		
			$lista = $this->db->query("   	SELECT persona.nombres,persona.apellidos,ficha_enfoque.id_ficha_enfoque,produccion.id_producion as id_produccion,ficha_enfoque.titulo_enfoque,
persona.telefono
FROM
ficha_enfoque
INNER JOIN persona ON ficha_enfoque.id_cliente = persona.dni
INNER JOIN produccion ON ficha_enfoque.id_ficha_enfoque = produccion.id_ficha_enfoque
INNER JOIN logproduccion ON produccion.id_producion = logproduccion.idproduccion
INNER JOIN horario_trabajador ON logproduccion.idhorario = horario_trabajador.id_horario
where ficha_enfoque.estado!=0 and ficha_enfoque.estado!=7 and  (ficha_enfoque.titulo_enfoque like '%". $search."%' or persona.nombres like '%". $search."%' or persona.telefono like '%". $search."%') and horario_trabajador.id_trabajador=".$_SESSION['id_persona']." 
GROUP BY produccion.id_producion ".$dir." limit ".$start.",".$limit);
		   }





         	    $totalFiltered=$lista->num_rows();
              if($lista->num_rows()>0)
             {
                    $data= $lista->result(); 
                }
              else
             {
               $data= null;
              }
         }




         $data1 = array();
        if(!empty($data))
        {
            foreach ($data as $post)
            {
            	$html1="";

                $nestedData['id'] = $post->id_ficha_enfoque;
                $nestedData['titulo'] = $post->titulo_enfoque;
                $nestedData['cliente'] = $post->nombres." ".$post->apellidos;
                $html="";
                 $query=$this->db->query("SELECT DISTINCT(trabajador.dni),persona.nombres,persona.apellidos
FROM logproduccion ,ficha_enfoque, produccion,horario_trabajador,trabajador,persona 
WHERE ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque AND
logproduccion.idproduccion=produccion.id_producion and horario_trabajador.id_horario=logproduccion.idhorario
and trabajador.dni=horario_trabajador.id_trabajador and persona.dni=trabajador.dni
and ficha_enfoque.id_ficha_enfoque=".$post->id_ficha_enfoque);

							 $cin=count($query->result());
foreach ($query->result() as $key1 => $value1) {
	  if($cin==$key1+1){

            $html.= $value1->nombres." ".$value1->apellidos." ";
	  }
         
         else
         {
         	$html.= $value1->nombres." ".$value1->apellidos.",";
         }
	  }

 $nestedData['asesores']=$html;

                $nestedData['telefono'] = $post->telefono;
                      $html1.='<ul class="icons-list">
						<li>
		<a href="#" data-toggle="modal" data-target="#invoice" onclick="seleccionar('.$post->id_ficha_enfoque.')"><i class=" icon-pencil7"></i></a></li>


<li><a href="#" data-toggle="modal" data-target="#invoice" onclick="ver('.$post->id_produccion.')"><i class="icon-file-eye"></i></a></li>

<li><a href="#" data-toggle="modal" data-target="#invoice" onclick="abrirEnPestana('.$post->id_ficha_enfoque.')"><i class=" icon-file-text2"></i></a></li>';
                      if($_SESSION["usuario_perfil"]!="2"){
                         $html1.='<li><a href="#" data-toggle="modal" data-target="#invoice" onclick="abrirEnPestana1('.$post->id_ficha_enfoque.')"><i class="icon-file-check2"></i></a></li>';
                      }
                     $html1.='</ul>';
                 $nestedData['acciones'] =$html1;
								

		
                $data1[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($this->input->post('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data1   
                    );
            
        echo json_encode($json_data); 
}














	public function new_documento(){

		$id=$_POST['id'];
		$lista = $this->db->query("SELECT t1.id_log,t1.nombre_archivo,t1.tipo_archivo,t1.id_archivo,t1.observacion FROM 
		(SELECT log_transacional.id_log,archivo.nombre_archivo,archivo.id_archivo,archivo.tipo_archivo,log_transacional.observacion FROM archivo,log_transacional 
		where log_transacional.id_archivo = archivo.id_archivo and archivo.estado = 1 and log_transacional.id_log=".$id." order by log_transacional.id_log desc)t1 GROUP BY nombre_archivo ")->result();
      $dato  =$this->Mantenimiento_m->consulta2("SELECT ficha_enfoque.estado_ficha,ficha_enfoque.id_ficha_enfoque,ficha_enfoque.titulo_enfoque,persona.nombres,persona.apellidos,persona.telefono from produccion,ficha_enfoque,persona WHERE
produccion.id_ficha_enfoque=ficha_enfoque.id_ficha_enfoque AND
ficha_enfoque.id_cliente= persona.dni and produccion.id_producion=".$id);

		$this->load->view('Documentos/nuevo',compact('id','lista',"dato"));
	}

	public function imagen_nueva(){
		$carpetaAdjunta="archivos";
// Contar envían por el plugin
		$Imagenes =count(isset($_FILES['imagenes']['name'])?$_FILES['imagenes']['name']:0);
		$infoImagenesSubidas = array();
		for($i = 0; $i < $Imagenes; $i++) {
	// El nombre y nombre temporal del archivo que vamos para adjuntar
			$nombreArchivo=isset($_FILES['imagenes']['name'][$i])?$_FILES['imagenes']['name'][$i]:null;
			$nombreTemporal=isset($_FILES['imagenes']['tmp_name'][$i])?$_FILES['imagenes']['tmp_name'][$i]:null;

			$rutaArchivo=base_url()."archivos".$_FILES['imagenes']['name'][$i];

			move_uploaded_file($_FILES["file"]["tmp_name"][$i],"archivos".$_FILES['imagenes']['name'][$i]);

			$infoImagenesSubidas[$i]=array("caption"=>"$nombreArchivo","height"=>"120px","url"=>"borrar.php","key"=>$nombreArchivo);
			$ImagenesSubidas[$i]="<img  height='120px'  src=".base_url()."archivos".$_FILES['imagenes']['name'][$i]." class='file-preview-image'>";
		}
		$arr = array("file_id"=>0,"overwriteInitial"=>true,"initialPreviewConfig"=>$infoImagenesSubidas,
			"initialPreview"=>$ImagenesSubidas);
		echo json_encode($arr);
	}

	public function traerarchivos(){
		$lista = $this->db->query("SELECT archivo.id_archivo,archivo.nombre_archivo FROM archivo where archivo.id_ficha=1")->result();
		echo json_encode($lista);	
	}

public function buscar(){
	$sql= "select * from contrato where id_ficha_enfoque=".$_POST["id"];
	$hola= $this->Mantenimiento_m->consulta2($sql);
	if($hola->inicial=="")
	{
      echo 0;
	}
	else
	{
        echo 1;
	}
}

public function antecedentes()
{


	$datos=$this->Mantenimiento_m->consulta("select * from antecedente,referencia,alcance,grado_tesis where antecedente.id_antecedentes=referencia.id_antecedentes and alcance.id_alcance=antecedente.id_alcance
		and grado_tesis.id_grado_tesis=  antecedente.id_grado_tesis and antecedente.id_ficha_enfoque=".$_SESSION["id_ficha_enfoque"]."
		");
	$this->load->view("Antecedente/index",compact("datos"));
}

public function nuevo_antecedente()
{   
    

   $tipo_url=$this->Mantenimiento_m->consulta("select * from tipo_url where tipo_url_estado=1");

    $alcance=$this->Mantenimiento_m->consulta("select * from alcance where alc_estado=1");
    $grado_tesis=$this->Mantenimiento_m->consulta("select * from grado_tesis where gra_estado=1");

	$max2=$this->Mantenimiento_m->consulta2("select max(id_antecedentes) as maximo from antecedente where ant_estado=1 and id_ficha_enfoque=".$_SESSION["id_ficha_enfoque"]);
	
	//echo count($max2->maximo);
	if (count($max2->maximo)!=0) 
	{
		  $max1=$this->Mantenimiento_m->consulta2("select ant_objetivo from antecedente where ant_estado=1 and id_antecedentes=".$max2->maximo);  
               if($max1->ant_objetivo=="") {

               	$id_antecedente=(int) $max2->maximo;
                
               }
		       else {
		       	    $id_antecedente=(int) $max2->maximo+1;
		       	    $verificar=$this->Mantenimiento_m->consulta2("select id_antecedentes from antecedente where id_antecedentes=".$max2->maximo);

	               if($verificar->id_antecedentes!="")
	               {
                        $sql=$this->Mantenimiento_m->consulta2("select max(id_antecedentes) as maximo from antecedente");
                        $id_antecedente=$sql->maximo+1;   
	               }
                   $data=array("id_antecedentes"=>$id_antecedente,"id_ficha_enfoque"=>$_SESSION["id_ficha_enfoque"]);
                 $this->Mantenimiento_m->insertar("antecedente",$data);

		       }
		       $max=$this->Mantenimiento_m->consulta2("select max(id_referencia) as maximo,ref_titulo from referencia where ref_estado=1 and id_antecedentes=".$max2->maximo);
	} 
	else
	{
        
        $cont=$this->Mantenimiento_m->consulta2("select max(id_antecedentes) as maximo from antecedente");
        if(count($cont->maximo)==0)
        {
           $id_antecedente=1;
        }
        else{ 
        	$id_antecedente=$cont->maximo+1;
        }
            $data=array("id_antecedentes"=>$id_antecedente,"id_ficha_enfoque"=>$_SESSION["id_ficha_enfoque"]);
                     $this->Mantenimiento_m->insertar("antecedente",$data);

		$max=$this->Mantenimiento_m->consulta2("select max(id_referencia) as maximo,ref_titulo from referencia where ref_estado=1 ");
		


	}

	 

	$idda= $this->Mantenimiento_m->consulta2("select max(id_referencia) as maximo from referencia where id_referencia=".$id_antecedente);	

    if($idda->maximo!="")
    {
         $id_referencia=$id_antecedente;
    }

    else
    {
    	    $id_referencia=$id_antecedente;
            $data=array("id_referencia"=>$id_referencia,"id_antecedentes"=>$id_antecedente);
            $this->Mantenimiento_m->insertar("referencia",$data);
    }

	/*if (count($max->maximo)!=0) 
	{   

        $max1=$this->Mantenimiento_m->consulta2("select ref_titulo from referencia where ref_estado=1 and id_referencia=".$max->maximo);      
	 if($max1->ref_titulo=="") {
	     	$id_referencia=(int) $max->maximo;

	      }
         else {
         	$id_referencia=(int) $max->maximo+1;
         	   //print_r($data);
            $data=array("id_referencia"=>$id_referencia,"id_antecedentes"=>$id_antecedente);
            $this->Mantenimiento_m->insertar("referencia",$data);
         }
	}
	else
	{
		$id_referencia=1;
		 $data=array("id_referencia"=>$id_referencia,"id_antecedentes"=>$id_antecedente);
            $this->Mantenimiento_m->insertar("referencia",$data);
	}*/
	
    
    

	$this->load->view("Antecedente/nuevo",compact("id_antecedente","id_referencia","alcance","grado_tesis","tipo_url"));
}

public function guardar()
{
     $datos=array(
       "ant_intro_objetivo"=>$_POST["ant_intro_objetivo"],
       "ant_objetivo"=>$_POST["ant_objetivo"],
       "ant_intro_muestra"=>$_POST["ant_intro_muestra"],
       "ant_muestra"=>$_POST["ant_muestra"],
       "ant_prose_diseno"=>$_POST["ant_prosa_diseno"],
       "ant_diseno"=>$_POST["ant_diseno"],
       "ant_intro_prosa_instrumento"=>$_POST["ant_intro_prosa_instrumento"],
       "ant_instrumento"=>$_POST["ant_instrumento"],
       "ant_prosa"=>$_POST["ant_prosa"],
        "ant_conclusion"=>$_POST["ant_conclusion"],
         "ant_prosa_intro_inv"=>$_POST["ant_prosa_intro_inv"],
          "ant_investigacion"=>$_POST["ant_investigacion"],
          "id_grado_tesis"=>$_POST["id_grado_tesis"],
          "id_alcance"=>$_POST["id_alcance"]
          
  
     	);
     //print_r($datos);

     $this->Mantenimiento_m->actualizar("antecedente",$datos,$_POST["id_antecedente"],"id_antecedentes");

     $datos=array(
        "ref_universidad"=>$_POST["ref_universidad"],
        "ref_ciudad"=>$_POST["ref_ciudad"],
        "ref_pais"=>$_POST["ref_pais"],
        "ref_anio"=>$_POST["ref_anio"],
        "ref_url"=>$_POST["ref_url"],
        "ref_titulo"=>$_POST["ref_titulo"]

     	);
     //print_r($datos);

     $this->Mantenimiento_m->actualizar("referencia",$datos,$_POST["id_referencia"],"id_referencia");

     $this->Mantenimiento_m->consulta1("delete from autor where id_referencia=".$_POST["id_referencia"]);
     foreach ($_POST['aut_nombre'] as $key => $value)
      { 
     	  
     	   $datos=array(
          "aut_nombre"=>$value,
          "aut_apelllido"=>$_POST["aut_apellido"][$key],
          "id_referencia"=>(int)$_POST["id_referencia"]

     	);
     	   print_r($datos);
     	   $this->Mantenimiento_m->insertar("autor",$datos);
     }

}

public function seleccionables()
{
		$_SESSION["id_ficha_enfoque"]=$_POST["id"];
        //$_SESSION["nombre_ficha_enfoque"]=$_POST["nombre"];
        $sacarnombre=$this->Mantenimiento_m->consulta2("select titulo_enfoque from ficha_enfoque where id_ficha_enfoque=".$_POST["id"]);
        $_SESSION["nombre_ficha_enfoque"]=$sacarnombre->titulo_enfoque;
$this->load->view("Documentos/selecionar");
   

}

}
