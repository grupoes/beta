
<?php defined('BASEPATH') OR exit('No direct script access allowed');
include('Controler.php');

class Ficha_enfoque extends Controler {
 public function __construct() {
        parent::__construct();
        $this->load->model("Mantenimiento_m");
      
    }

  public function index()
      {
     
        if($_SESSION['usuario_perfil'] ==5){
         $lista=$this->Mantenimiento_m->consulta("SELECT ficha_enfoque.ficha_enfoque_estado_observacion,universidad.descripcion ,cliente.carrera,ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,per_cliente.nombres as cliente_nombre,per_cliente.apellidos as cliente_apellidos,
           per_trabajador.nombres as trabajador_nombre,per_trabajador.apellidos as trabajador_apellido,ficha_enfoque.titulo_enfoque as titulo, ficha_enfoque.estado_ficha as estado
            from universidad,ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario
           where universidad.id_universidad=cliente.id_universidad and ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario AND
            per_cliente.dni=cliente.dni and per_trabajador.dni=trabajador.dni and per_usuario.dni=usuario.persona and (ficha_enfoque.estado_ficha!=7 and ficha_enfoque.estado_ficha!=0)");
        }else
        {
          if($_SESSION['usuario_perfil'] ==4){
          $lista=$this->Mantenimiento_m->consulta("SELECT ficha_enfoque.ficha_enfoque_estado_observacion,universidad.descripcion,cliente.carrera,ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,per_cliente.nombres as cliente_nombre,per_cliente.apellidos as cliente_apellidos,
           per_trabajador.nombres as trabajador_nombre,per_trabajador.apellidos as trabajador_apellido,ficha_enfoque.titulo_enfoque as titulo, ficha_enfoque.estado_ficha as estado
            from universidad,ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario
           where universidad.id_universidad=cliente.id_universidad and ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario AND
            per_cliente.dni=cliente.dni and per_trabajador.dni=trabajador.dni and per_usuario.dni=usuario.persona and (ficha_enfoque.estado_ficha<5
            and ficha_enfoque.estado_ficha!=0)
            and usuario.usu_sede=".$_SESSION['id_sede']);
            }
            else{

              if($_SESSION['usuario_perfil'] ==2){
                   $lista=$this->Mantenimiento_m->consulta("SELECT ficha_enfoque.ficha_enfoque_estado_observacion,universidad.descripcion,cliente.carrera,ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,per_cliente.nombres as cliente_nombre,per_cliente.apellidos as cliente_apellidos,
           per_trabajador.nombres as trabajador_nombre,per_trabajador.apellidos as trabajador_apellido,ficha_enfoque.titulo_enfoque as titulo, ficha_enfoque.estado_ficha as estado
            from universidad,ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario
           where (ficha_enfoque.estado_ficha=2 and ficha_enfoque.estado_ficha!=0) and ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario AND
            per_cliente.dni=cliente.dni and universidad.id_universidad=cliente.id_universidad and per_trabajador.dni=".$_SESSION['dni_usuario']." and per_usuario.dni=usuario.persona");
            }
            else
            {
              $lista=$this->Mantenimiento_m->consulta("SELECT ficha_enfoque.ficha_enfoque_estado_observacion,universidad.descripcion,cliente.carrera,ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,per_cliente.nombres as cliente_nombre,per_cliente.apellidos as cliente_apellidos,
           per_trabajador.nombres as trabajador_nombre,per_trabajador.apellidos as trabajador_apellido,ficha_enfoque.titulo_enfoque as titulo, ficha_enfoque.estado_ficha as estado
            from universidad,ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario
           where universidad.id_universidad=cliente.id_universidad and ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario AND
            per_cliente.dni=cliente.dni and per_trabajador.dni=trabajador.dni and per_usuario.dni=usuario.persona and (ficha_enfoque.estado_ficha!=7
            and ficha_enfoque.estado_ficha!=0)
            and usuario.usu_sede=".$_SESSION['id_sede']);
            }
        }

      }

        $this->load->view("Ficha_enfoque/index",compact('lista'));
       
       }

  public function provincia()
   {
        if (isset($_POST['id'])) {
            $lista=$this->Mantenimiento_m->provincia($_POST['id']);
            $html="";
            $html.= "<option value=''>Selecionar provincia</option>";
            foreach ($lista as $value) {
              $html.= "<option value='".$value->id_provincia."'>".$value->descripcion."</option>";
            }
            echo $html;
    }
  }

    public function distrito()
     {
      if (isset($_POST['id'])) {

              $lista=$this->Mantenimiento_m->distrito($_POST['id']);
             
             $html="";
               $html.= "<option value=''>Selecionar distrito</option>";
            foreach ($lista as $value) {
              $html.= "<option value='".$value->id_distrito."'>".$value->descripcion."</option>";
            }
            echo $html;
      }
  }
    
    public function registrarcliente()
    {
    $dni="";
    $dni1=(string)$_POST['dni'];

    $pub=$this->Mantenimiento_m->consulta3("select * from persona,cliente where persona.dni=cliente.dni and persona.dni=".$dni1);
   if(count($pub)!=0){
   $dni=$pub[0]["dni"];
 } 
     


      if($dni==""){
     
            $data=array(
              "dni"=>$_POST['dni'],
              "nombres"=>strtoupper($_POST['nombres']),
              "apellidos"=>strtoupper($_POST['apellidos']),
              "telefono"=>$_POST["telefono"],
              "correo"=>$_POST['correo'],
               "direccion"=>$_POST['direccion']
        );
          $iduniversidad=$this->Mantenimiento_m->universidad_id($_POST['universidad']);
        $data1=array(
          "dni"=>$_POST['dni'],
          "id_universidad"=>$iduniversidad,
          "id_distrito"=>$_POST['distrito'],
          "carrera"=>strtoupper($_POST['carrera']),
          "id_tipocliente"=>$_POST['id_tipocliente']

        );
          $this->Mantenimiento_m->insertar_cliente($data,$data1);
          echo "1";
      }
      else{
          $data=array(
              
              "nombres"=>strtoupper($_POST['nombres']),
              "apellidos"=>strtoupper($_POST['apellidos']),
              "telefono"=>$_POST["telefono"],
              "correo"=>$_POST['correo'],
               "direccion"=>$_POST['direccion']
        );
          $iduniversidad=$this->Mantenimiento_m->universidad_id($_POST['universidad']);
        $data1=array(
          
          "id_universidad"=>$iduniversidad,
          "id_distrito"=>$_POST['distrito'],
          "carrera"=>strtoupper($_POST['carrera']),
          "id_tipocliente"=>$_POST['id_tipocliente']

        );
       
       $this->Mantenimiento_m->actualizar("persona",$data,$dni1,"dni"); 
       $this->Mantenimiento_m->actualizar("cliente",$data1,$dni1,"dni");   
           echo "2";
      }
         
      
    
        
    }

    


  public function nuevo()
  {
    
      $tipo=$this->Mantenimiento_m->tipo_enfoque();
      $departamento=$this->Mantenimiento_m->lista("departamento");
      $universidad=$this->Mantenimiento_m->universidad("universidad");
      $categoria=$this->Mantenimiento_m->lista("categoria");
      $tipocliente=$this->Mantenimiento_m->tipocliente();
      $grado=$this->Mantenimiento_m->lista("grado");
      $tipo_norma=$this->Mantenimiento_m->lista("tipo_norma");
      $especialidad=$this->Mantenimiento_m->lista("especialidad");
      $resultado=$this->Mantenimiento_m->lista("resultado");
      $captacion=$this->Mantenimiento_m->lista("captacion");
      $color=$this->Mantenimiento_m->lista("color");
       $forma_pago=$this->Mantenimiento_m->consulta("select * from formapago");
         $carrera=$this->Mantenimiento_m->consulta("SELECT DISTINCT(carrera) from cliente ");
      $this->load->view('Ficha_enfoque/nuevo',compact("color","resultado","departamento","tipocliente","universidad","categoria","grado","tipo_norma","especialidad","tipo","captacion","forma_pago","carrera"));
    
   
  }
   
    public function asesores()
    {   
      $html="";
      if($_SESSION['usuario_perfil']=="5"){
      $sede=$this->Mantenimiento_m->lista("sede");
       }
       else
       {
        $sede=$this->Mantenimiento_m->consulta("select * from sede where id_sede=".$_SESSION['id_sede']);
       }
              $html.="<option>Por favor selecione el asesor</option>";
      foreach ($sede as $datasede)
       {
          $asesorsede=$this->Mantenimiento_m->asesores($datasede->id_sede);

          $html.= '<optgroup label="'.$datasede->descripcion.'">';
          foreach ($asesorsede as $datasesor) {
          $html.='<option class="bg-danger" data-toggle="modal" value="'.$datasesor->dni.'" data-target="#modal_large">'.$datasesor->nombres." ".$datasesor->apellidos.'</option>';
          }
            $html.='</optgroup>';
         }
      echo $html;
      }

    public function guardar_ficha_admin()
    {
      $data=array(
        "id_trabajador"=>$_POST['id_trabajador'],
        "id_categoria"=>$_POST['id_categoria'],
        "id_grado"=>$_POST['id_grado'],
        "id_usuario"=>$_SESSION['usuario_id'],
        "id_cliente"=>$_POST['dni1'],
        "fecha_registro"=>date('Y-m-d h:i:s'),
        "id_especialidad"=>$_POST["id_especialidad"],    
        "estado_ficha"=>2,
        "disenio"=>$_POST['detalle'],
        "id_captacion"=>$_POST['id_captacion'],
        "id_tipo_enfoque"=>$_POST["id_tipo_enfoque"]
        );
      
      $this->Mantenimiento_m->insertar("ficha_enfoque",$data);
        $r=$this->Mantenimiento_m->maximo_ficha();
        $maximo=0;
        $nombres="";
        $max=$this->Mantenimiento_m->consulta("select max(id_ficha_enfoque) as maximo from ficha_enfoque");
        foreach ($max as $key => $value) {
          $maximo=$value->maximo;
        }
        $x=$this->Mantenimiento_m->consulta("select * from persona where dni=".$_POST['dni1']);
        foreach ($x as $key => $value) {
          $nombres=$value->nombres." ".$value->apellidos;
        }
         
          $data=array("descripcion"=>"",
         "estado_fase"=>1,
         "id_ficha_enfoque"=>$maximo,
         "color"=>$_POST['color']
        );
       $this->Mantenimiento_m->insertar("produccion",$data);

        $data1=array(
           "descripcion"=>"Se le asigno una nueva ficha de enfoque",
           "fecha"=>date('Y-m-d H:i:s'),
           "url"=>"Ficha_enfoque/actualizar",
           "id_usuario"=>$_POST['id_trabajador'],
           "id"=>$maximo,
           "nombre"=>$nombres

          );
            $this->Mantenimiento_m->insertar("notificacion",$data1);

       /////////////////////////////////////////////////////////////////////////////////
       $hola=$this->Mantenimiento_m->consulta2("select max(id_producion) as maximo from produccion");

      
   // echo $maximo1;
        $datos=array(
          "id_produccion"=>$hola->maximo,
           "id_trabajador"=>$_POST['id_trabajador'],

          );

      $this->Mantenimiento_m->insertar("subfase_tiempo_produccion",$datos);
             $datos=array(
           "empiezo_tiempo"=>$_POST['empiezo'],
           "fin_tiempo"=>$_POST['fin'],
           "id_trabajador"=>$_POST['id_trabajador'],
           "titulo"=>"Fase 1",
           "color"=>$_POST['color'],
           "descripcion"=>"Ficha de enfoque",
           "tiempo"=>$_POST['hora'].":00"

          );

   
        $this->Mantenimiento_m->insertar("horario_trabajador",$datos);


 $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");

$datos=array(
      "idhorario"=>$hola1->maximo,
      "idtiempo"=>"",
      "idproduccion"=>$hola->maximo
  );
          
 $this->Mantenimiento_m->insertar("logproduccion",$datos);
    }
    
    public function traer_un_cliente()
    {
      $dni=$_POST['dni'];
      $res=$this->Mantenimiento_m->traer_cliente($dni);
      print_r(json_encode($res));
    }
    public function distrito_lista()
    {
      $res=$this->Mantenimiento_m->lista_distritos($_POST['id_distrito']);
       $html="";
              foreach ($res as $value) {
                $html.= "<option value='".$value->id_distrito."'>".$value->descripcion."</option>";
              }
              echo $html;
    }


   public function cronograma_prestamo(){
   
      $monto_prest = $_POST["monto"];
      $semanas = $_POST["semanas"];
      $intervalo = $_POST["intervalo"];
      $fecha = $_POST["fechaprestamo"];
      $this->load->view('Ficha_enfoque/cronograma',compact('monto_prest','semanas','intervalo','fecha'));
   
  }

public function ingresar()
{  
     // print_r($_POST);exit();

  $id_enfoque="";
  $valores ="";
  $idhi = "";
  if(isset($_POST['id_enfoque'])){
   $id_enfoque=$_POST['id_enfoque'];
 }

  if(isset($_POST['hip2'])){
   $valores = $_POST['hip2'];
 }

 


 if($id_enfoque==""){
  $data=array(
    "id_tipo_enfoque"=>$_POST['id_tipo_enfoque'],
    "titulo_enfoque"=>$_POST['titulo_enfoque'],
    "porque"=>$_POST['porque'],
    "paraque"=>$_POST['paraque'],
    "como"=>$_POST['como'],
    "donde"=>$_POST['donde'],
    "muestra"=>$_POST['muestra'],
    "anios_antiguedad"=>$_POST['anios_antiguedad'],
    "cant_inter"=>$_POST['cant_inter'],
    "cant_nacio"=>$_POST['cant_nacio'],
    "cant_local"=>$_POST['cant_local'],
    "can_realidad"=>$_POST['can_realidad'],
    "cant_marco"=>$_POST['cant_marco'],
    "anio_teoria"=>$_POST['anio_teoria'],
    "can_autor"=>$_POST['can_autor'],
    "marco_conceptual"=>$_POST['marco_conceptual'],
    "res_cant_hojas"=>$_POST['res_cant_hojas'],
    "id_tipo_norma"=>$_POST['id_tipo_norma'],
    "bio_cantidad"=>$_POST['bio_cantidad'],
    "forma_orden"=>$_POST['forma_orden'],
    "bio_ordenado"=>$_POST['bio_ordenado'],
    "plan_mejora"=>$_POST['plan_mejora'],
    "estado_ficha"=>"2",
    "docente"=>$_POST['docente'],


    );
$this->Mantenimiento_m->insertar("ficha_enfoque",$data);
echo "1";
$maxFicha = $this->db->insert_id();
foreach ($_POST['res_por'] as $key => $value) {
  $res=$_POST['res_por'][$key];
  $datos=array(
   "id_ficha_enfoque"=>$maxFicha,
   "id_resultado"=>$res
   );
  $this->Mantenimiento_m->insertar("fichaenfoque_resultado",$data);  
}
}
else {

 $dato12=$this->Mantenimiento_m->consulta2("select * from ficha_enfoque where id_ficha_enfoque=".$id_enfoque);
 if($dato12->estado_ficha==6){
   $categoria= $_POST['id_categoria'];
 }
 else{
  $categoria=$dato12->id_categoria;
}
$data=array(
  "id_tipo_enfoque"=>$_POST['id_tipo_enfoque'],
  "titulo_enfoque"=>$_POST['titulo_enfoque'],
  "porque"=>$_POST['porque'],
  "paraque"=>$_POST['paraque'],
  "como"=>$_POST['como'],
  "donde"=>$_POST['donde'],
  "muestra"=>$_POST['muestra'],
  "anios_antiguedad"=>$_POST['anios_antiguedad'],
  "cant_inter"=>$_POST['cant_inter'],
  "cant_nacio"=>$_POST['cant_nacio'],
  "cant_local"=>$_POST['cant_local'],
  "can_realidad"=>$_POST['can_realidad'],
  "cant_marco"=>$_POST['cant_marco'],
  "anio_teoria"=>$_POST['anio_teoria'],
  "can_autor"=>$_POST['can_autor'],
  "marco_conceptual"=>$_POST['marco_conceptual'],
  "res_cant_hojas"=>$_POST['res_cant_hojas'],
  "id_tipo_norma"=>$_POST['id_tipo_norma'],
  "bio_cantidad"=>$_POST['bio_cantidad'],
  "forma_orden"=>$_POST['forma_orden'],
  "bio_ordenado"=>$_POST['bio_ordenado'],
  "plan_mejora"=>$_POST['plan_mejora'],
  "estado_ficha"=>"6",
  "docente"=>$_POST['docente'],
  "problema1"=>$_POST['pactual'],
  "problema2"=>$_POST['pinfluyente'],
  "problema3"=>$_POST['psolucion'],
  "problema4"=>$_POST['presultados'],
  "objetivo1"=>$_POST['obj1'],
  "objetivo2"=>$_POST['obj2'],
  "objetivo3"=>$_POST['obj3'],
  "objetivo4"=>$_POST['obj4'],
  "problemageneral"=>$_POST['problemage'],
  "objetivogeneral"=>$_POST['objgeneral'],
  "variable_independiente"=>$_POST['variablei'],
  "variable_dependiente"=>$_POST['variabled'],
  "ficha_iddiseo"=>$_POST['select'],
  "id_categoria"=>$categoria
  );

$this->Mantenimiento_m->actualizar("ficha_enfoque",$data,$id_enfoque,"id_ficha_enfoque");
if($_POST['select'] == 2){
  $this->Mantenimiento_m->consulta1("delete from detalle_hip_ficha where detfi_idfich=".$id_enfoque);
  $dat=array(
    "detfi_idhip"=>1,
    "detfi_idfich"=>$_POST['id_enfoque'],
    "hipotesis"=>$_POST['hipgeneral'],
  );
  $this->Mantenimiento_m->insertar("detalle_hip_ficha",$dat);  
}else{
    if($valores != ""){
      if($_POST['select'] == 1 || $_POST['select'] == 3){
         $this->Mantenimiento_m->consulta1("delete from detalle_hip_ficha where detfi_idfich=".$id_enfoque);
        for ($j=0; $j <count($valores); $j++) {
          if($j == 0){$idhi = 1;}else{$idhi =2;}
            $datosa=array(
            "detfi_idhip"=>$idhi,
            "detfi_idfich"=>$_POST['id_enfoque'],
            "hipotesis"=>$valores[$j],
            ); 
            $this->Mantenimiento_m->insertar("detalle_hip_ficha",$datosa);  
        }  
      }
     if($_POST['select'] == 8){
       $this->Mantenimiento_m->consulta1("delete from detalle_hip_ficha where detfi_idfich=".$id_enfoque);
        for ($j=0; $j <count($valores); $j++) {
            $datosa=array(
            "detfi_idhip"=>1,
            "detfi_idfich"=>$_POST['id_enfoque'],
            "hipotesis"=>$valores[$j],
            ); 
            $this->Mantenimiento_m->insertar("detalle_hip_ficha",$datosa);  
        }    
     }
    }else{
       $this->Mantenimiento_m->consulta1("delete from detalle_hip_ficha where detfi_idfich=".$id_enfoque);
        $dat=array(
          "detfi_idhip"=>1,
          "detfi_idfich"=>$_POST['id_enfoque'],
          "hipotesis"=>$_POST['hipgeneral'],
        );
        $this->Mantenimiento_m->insertar("detalle_hip_ficha",$dat);  
    }
    
}
echo "2";
$this->Mantenimiento_m->consulta1("delete from fichaenfoque_resultado where id_ficha_enfoque=".$id_enfoque);
foreach ($_POST['res_por'] as $key => $value) {
  $res=$_POST['res_por'][$key];
  $datos=array(
   "id_ficha_enfoque"=>$id_enfoque,
   "id_resultado"=>$res
   );

  $this->Mantenimiento_m->insertar("fichaenfoque_resultado",$datos);  
}
}

}



public function actualizar()
{

  $query="SELECT * from ficha_enfoque where id_ficha_enfoque=".$_POST['id'];
  $color=$this->Mantenimiento_m->lista("color");
  $resultado=$this->Mantenimiento_m->lista("resultado");
  $data=$this->Mantenimiento_m->consulta($query);
  $tipo=$this->Mantenimiento_m->tipo_enfoque();
  $departamento=$this->Mantenimiento_m->lista("departamento");
  $universidad=$this->Mantenimiento_m->universidad("universidad");
  $categoria=$this->Mantenimiento_m->lista("categoria");
  $tipocliente=$this->Mantenimiento_m->tipocliente();
  $grado=$this->Mantenimiento_m->lista("grado");
  $tipo_norma=$this->Mantenimiento_m->lista("tipo_norma");
  $especialidad=$this->Mantenimiento_m->lista("especialidad");
  $produccion=$this->Mantenimiento_m->consulta("select * from produccion where id_ficha_enfoque=".$_POST['id']);
  $captacion=$this->Mantenimiento_m->lista("captacion");     
  $forma_pago=$this->Mantenimiento_m->consulta("select * from formapago");
  $carrera=$this->Mantenimiento_m->consulta("SELECT DISTINCT(carrera) from cliente ");
  $caja=$this->Mantenimiento_m->consulta("select * from caja");
  $tipo_comprobante=$this->Mantenimiento_m->consulta("select * from  tipo_comprobante");
  $hipot = $this->Mantenimiento_m->consulta("SELECT detalle_hip_ficha.detfi_idhip,detalle_hip_ficha.hipotesis FROM detalle_hip_ficha INNER JOIN ficha_enfoque ON detalle_hip_ficha.detfi_idfich = ficha_enfoque.id_ficha_enfoque
  where ficha_enfoque.id_ficha_enfoque =".$_POST['id']);
  $palabras=$this->Mantenimiento_m->consulta("SELECT verbo.ver_id,verbo.ver_sus1,verbo.ver_sus2 FROM detalle_tip_verbo INNER JOIN tipo_verbo ON detalle_tip_verbo.tiv_id = tipo_verbo.tiv_id
    INNER JOIN verbo ON detalle_tip_verbo.ver_id = verbo.ver_id
    where tipo_verbo.tiv_id = 3");
  $palabras1=$this->Mantenimiento_m->consulta("SELECT verbo.ver_id,verbo.ver_sus1,verbo.ver_sus2 FROM detalle_tip_verbo INNER JOIN tipo_verbo ON detalle_tip_verbo.tiv_id = tipo_verbo.tiv_id
    INNER JOIN verbo ON detalle_tip_verbo.ver_id = verbo.ver_id
    where tipo_verbo.tiv_id = 6");
  $verbo = $this->Mantenimiento_m->consulta("SELECT verbo.ver_id,verbo.ver_verbo FROM detalle_tip_verbo INNER JOIN tipo_verbo ON detalle_tip_verbo.tiv_id = tipo_verbo.tiv_id
    INNER JOIN verbo ON detalle_tip_verbo.ver_id = verbo.ver_id   where tipo_verbo.tiv_id = 1");
  $verbof = $this->Mantenimiento_m->consulta("SELECT verbo.ver_verbo,verbo.ver_id,verbo.ver_sus1,verbo.ver_sus2 FROM detalle_tip_verbo INNER JOIN tipo_verbo ON detalle_tip_verbo.tiv_id = tipo_verbo.tiv_id
    INNER JOIN verbo ON detalle_tip_verbo.ver_id = verbo.ver_id   where tipo_verbo.tiv_id = 4");
  $sustantivos = $this->Mantenimiento_m->consulta("SELECT verbo.ver_verbo,verbo.ver_id,verbo.ver_sus1,verbo.ver_sus2 FROM detalle_tip_verbo INNER JOIN tipo_verbo ON detalle_tip_verbo.tiv_id = tipo_verbo.tiv_id
    INNER JOIN verbo ON detalle_tip_verbo.ver_id = verbo.ver_id   where tipo_verbo.tiv_id = 5");
  $this->load->view('Ficha_enfoque/nuevo',compact("color","hipot","produccion","resultado","palabras","palabras1","sustantivos","verbof","verbo","departamento","tipocliente","universidad","categoria","grado","tipo_norma","especialidad","tipo","data","captacion","forma_pago","carrera","caja","tipo_comprobante"));

}

  public function data()
  {
    $query="SELECT per_cliente.dni as dni,
ficha_enfoque.id_ficha_enfoque as id_ficha_enfoque,
per_cliente.nombres as cliente_nombre,
per_cliente.apellidos as cliente_apellidos,
per_cliente.dni as dni_cliente,
per_cliente.telefono as telefono_cliente,
per_cliente.direccion as direccion_cliente,
per_cliente.correo as cliente_correo,
cliente.id_tipocliente as tipocliente,
universidad.descripcion as universidad,
per_trabajador.nombres as trabajador_nombre,
per_trabajador.apellidos as trabajador_apelido,
ficha_enfoque.titulo_enfoque as titulo,
ficha_enfoque.id_tipo_enfoque as id_tipo_enfoque,
ficha_enfoque.id_categoria as id_categoria,
ficha_enfoque.id_trabajador as id_trabajador,
cliente.carrera as carrera,
ficha_enfoque.estado_ficha as estado_ficha,
ficha_enfoque.can_realidad as can_realidad,
ficha_enfoque.porque as porque,
ficha_enfoque.paraque as paraque,
ficha_enfoque.como as como,
ficha_enfoque.donde as donde,
ficha_enfoque.muestra as muestra,
ficha_enfoque.dis_inv as dis_inv,
ficha_enfoque.variables as variables,
ficha_enfoque.anios_antiguedad as anios_antiguedad,
ficha_enfoque.cant_inter as cant_inter,
ficha_enfoque.cant_nacio as cant_nacio,
ficha_enfoque.cant_local as cant_local,
ficha_enfoque.res_cant_hojas as res_cant_hojas,
ficha_enfoque.id_tipo_norma as id_tipo_norma,
ficha_enfoque.bio_cantidad as bio_cantidad,
ficha_enfoque.bio_ordenado as bio_ordenado,
ficha_enfoque.forma_orden as forma_orden,
ficha_enfoque.plan_mejora as plan_mejora,
ficha_enfoque.marco_conceptual as marco_conceptual,
ficha_enfoque.can_autor as can_autor,
ficha_enfoque.docente as docente,
ficha_enfoque.cant_marco as cant_marco,
ficha_enfoque.anio_teoria as anio_teoria,
ficha_enfoque.variable_independiente,
ficha_enfoque.variable_dependiente ,
ficha_enfoque.ficha_iddiseo,
ficha_enfoque.problema1,
ficha_enfoque.problema2,
ficha_enfoque.problema3,
ficha_enfoque.problema4,
ficha_enfoque.objetivo1,
ficha_enfoque.objetivo2,
ficha_enfoque.objetivo3,
ficha_enfoque.objetivo4,
ficha_enfoque.objetivogeneral,
ficha_enfoque.problemageneral

from ficha_enfoque,cliente,trabajador,usuario,persona as per_cliente,persona as per_trabajador,persona as per_usuario,universidad
where ficha_enfoque.id_cliente=cliente.dni AND trabajador.dni=ficha_enfoque.id_trabajador and usuario.usu_id=ficha_enfoque.id_usuario 
AND universidad.id_universidad=cliente.id_universidad and
per_cliente.dni=cliente.dni and per_trabajador.dni=trabajador.dni and per_usuario.dni=usuario.persona and 
ficha_enfoque.id_ficha_enfoque=".$_POST['id'];
   $data=$this->Mantenimiento_m->consulta2($query);

$data1=array("cliente_nombre"=>$data->cliente_nombre,"ficha_iddiseo"=>$data->ficha_iddiseo,"cliente_apellidos"=>$data->cliente_apellidos,"dni"=>$data->dni,"telefono_cliente"=>$data->telefono_cliente,"direccion_cliente"=>$data->direccion_cliente,"cliente_correo"=>$data->cliente_correo,"universidad"=>$data->universidad,
    "carrera"=>$data->carrera,"tipocliente"=>$data->tipocliente,"id_tipo_enfoque"=>$data->id_tipo_enfoque,"id_categoria"=>$data->id_categoria,
    "id_trabajador"=>$data->id_trabajador,"estado_ficha"=>$data->estado_ficha,"porque"=>$data->porque,"paraque"=>$data->paraque,"como"=>$data->como,
    "donde"=>$data->donde,"muestra"=>$data->muestra,"dis_inv"=>$data->dis_inv,"variables"=>$data->variables,"anios_antiguedad"=>$data->anios_antiguedad,"cant_inter"=>$data->cant_inter,"cant_nacio"=>$data->cant_nacio,"cant_local"=>$data->cant_local,
    "res_cant_hojas"=>$data->res_cant_hojas,"id_tipo_norma"=>$data->id_tipo_norma,"bio_cantidad"=>$data->bio_cantidad,"forma_orden"=>$data->forma_orden,"plan_mejora"=>$data->plan_mejora,"marco_conceptual"=>$data->marco_conceptual,"can_autor"=>$data->can_autor,"docente"=>$data->docente,
    "can_realidad"=>$data->can_realidad,"cant_marco"=>$data->cant_marco,"anio_teoria"=>$data->anio_teoria,"variable_independiente"=>$data->variable_independiente,"variable_dependiente"=>$data->variable_dependiente,"ficha_iddiseo"=>$data->ficha_iddiseo,"problema1"=>$data->problema1,
    "problema2"=>$data->problema2,"problema3"=>$data->problema3,"problema4"=>$data->problema4,"objetivo1"=>$data->objetivo1,"objetivo2"=>$data->objetivo2,"objetivo3"=>$data->objetivo3,"objetivo4"=>$data->objetivo4,"objetivogeneral"=>$data->objetivogeneral,"problemageneral"=>$data->problemageneral);

 

   echo json_encode($data1);

  }

  

  public function categoria_subfases()
  {  //echo $_POST['id_categoria'];
       $sql="select DISTINCT(subfase.id_fase) as id_fase,fases.titulo as fases,fases.descripcion as descripcion from categoria_subfase,subfase,fases    WHERE categoria_subfase.id_categoria=".$_POST['id_categoria']." and categoria_subfase.id_subfase=subfase.id_subfase
        and subfase.id_fase=fases.id_fase and fases.id_tipo_enfoque=".$_POST['id_tipo_enfoque']." order by subfase.id_subfase asc";
       $data=$this->Mantenimiento_m->consulta($sql);
       $html="";





       foreach ($data as $key => $value)
        {
           $radio1="";
           $radio2="";
           $radio3="";
           $radio4="";
           $radio5="";
           $radio6="";
         $html.="<tr>";
           $html.="<td><h3><b title='".$value->descripcion ."'>".$value->fases."</b></h3>";
           $sql="select * from subfase where estado=1 and id_fase=".$value->id_fase;
            $data1=$this->Mantenimiento_m->consulta($sql);
           $html.="<td >";
         
          //print_r($data1);exit();

          foreach ($data1 as $key => $data2) 
           {    

                //echo $data2->id_subfase;exit();
                $html.="<h6 title='".$data2->descripcion."'>".$data2->titulo."</h6>";
                $sql="select * from subfase,subfase_tiempo WHERE subfase.id_subfase=subfase_tiempo.id_subfase and subfase.id_subfase= ".$data2->id_subfase." ORDER BY id_tarea asc ,id_dificultad asc" ;
              
                $tiempo=$this->Mantenimiento_m->consulta($sql);
                 // print_r($tiempo);exit();
                $difi=0;
                $tar=0;
               foreach ($tiempo as $key => $value1 ) 
               {
                
                
                  $difi=$value1->id_dificultad;
                  $tar=$value1->id_tarea;
                  if($tar==1 && $difi==1){
                   $radio1.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>
                      
                  ';
                  }
                 if($tar==1 && $difi==2){
                  $radio2.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==1 && $difi==3){
                    $radio3.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==2 && $difi==1){
                   $radio4.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==2 && $difi==2){
                   $radio5.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                  if($tar==2 && $difi==3){
                   $radio6.='<h6><center><input type="checkbox" class="styled" value="'.$value1->id_tiempo.",".$value1->id_dificultad.",".$value1->id_tarea.",".$value1->id_subfase.'" id="id_tiempo" name="id_tiempo[]" ></center></h6>';
                  }
                
                
             }
           }
               $html.="</td>";
               $html.="<td>".$radio1."</td>";
               $html.="<td>".$radio2."</td>";
               $html.="<td>".$radio3."</td>";
               $html.="<td>".$radio4."</td>";
               $html.="<td>".$radio5."</td>";
              $html.="<td>".$radio6."</td>";
             

         $html.="</tr>";

      

       }

          $html.='<script>
                   $( function() {
                   $(".styled, .multiselect-container input").uniform({
                     radioClass: "choice"
                     });}); 
                 </script>';
         echo $html;
  }

  public function estado3(){

    $id_enfoque=$_POST['id_enfoque'];
    $data=array("estado_ficha"=>3);
    $this->Mantenimiento_m->actualizar("ficha_enfoque",$data,$id_enfoque,"id_ficha_enfoque");
     $nombres="";
  $dni1="";
     $sql=$this->Mantenimiento_m->consulta("select * from ficha_enfoque where id_ficha_enfoque=".$id_enfoque);
           foreach ($sql as $key => $value) {
              $id_usuario=$value->id_usuario;
              $x=$this->Mantenimiento_m->consulta("select * from persona where dni=".$value->id_cliente);
                foreach ($x as $key => $value1) {
                 $nombres=$value1->nombres." ".$value1->apellidos;
               }
               $x=$this->Mantenimiento_m->consulta("select * from usuario where usu_id=".$id_usuario);
                foreach ($x as $key => $value1) {
                $dni1=$value1->persona;
               }

         }
        $data1=array(
           "descripcion"=>"se acabo de llenar la ficha de enfoque ",
           "fecha"=>date('Y-m-d H:i:s'),
           "url"=>"Ficha_enfoque/actualizar",
           "id_usuario"=>$dni1,
           "id"=>$id_enfoque,
           "nombre"=>$nombres

          );
      
            $this->Mantenimiento_m->insertar("notificacion",$data1);
  }
  public function asesores_subfase()
  {
     
     $id_produccion="";
     if (isset($_POST['id_produccion'])) {
      $id_produccion=$_POST["id_produccion"];
     }
   
     
    $this->Mantenimiento_m->consulta1("delete from subfase_tiempo_produccion where id_produccion=".$_POST['id_produccion']);
    

    if($id_produccion=="")
    { 
        $data=array("descripcion"=>"",
         "estado_fase"=>1,
         "id_ficha_enfoque"=>$_POST["id_enfoque"]
        );
       $this->Mantenimiento_m->insertar("produccion",$data);
       $data=$this->Mantenimiento_m->consulta("select max(id_producion ) as maximo from produccion");
       foreach ($data as $key => $value) {
        $id_produccion=$value->maximo;
       }
      
    }
 // print_r($_POST['id_tiempo']);exit(); 

  foreach ($_POST['id_tiempo'] as $key => $value) {
   
         $data1=array(
             "id_tiempo"=>$_POST['id_tiempo'][$key],
             "id_produccion"=>$id_produccion
             );
   
 $this->Mantenimiento_m->insertar("subfase_tiempo_produccion",$data1);
    // print_r($data);
    }
  
              
     $html="";
  if($_SESSION['usuario_perfil']=="5"){
      $sede=$this->Mantenimiento_m->lista("sede");
       }
       else
       {
        $sede=$this->Mantenimiento_m->consulta("select * from sede where id_sede=".$_SESSION['id_sede']);
       }
       $html.="<h3><center>ASIGNAR LOS EMPLEADOS</center></h3>";
     /*  $html.='
    <div class="row">
    <div class="col-sm-4"></div>
        <div class="col-sm-3">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1">
                    <input type="text" id="empiezo" name="empiezo" class="form-control" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $("#datetimepicker1").datetimepicker();

        $(".styled, .multiselect-container input").uniform({
        radioClass: "choice"
    });
            });
        </script>
    </div>
</div>';*/
      foreach ($sede as $datasede) {
            $asesorsede=$this->Mantenimiento_m->asesores($datasede->id_sede);
              $html.="
                
              <div class='form-group '>";
            $html.= ' <label class="display-block text-semibold">'.$datasede->descripcion.'</label>';
            foreach ($asesorsede as $datasesor) {
              $html.='<div class="checkbox-inline">
                      <label>';
            $html.='<input type="checkbox" class="styled" name="id_empleado[]" id="id_empleado" value="'.$datasesor->dni.'">'.$datasesor->nombres." ".$datasesor->apellidos.'</input>';
            $html.='</label>
                    </div>';
                    
            }
           
            $html.='</div>';
      }
      $a="'Ficha_enfoque','Tesis'";
      $boton=' <center> 
                        <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('.$a.')">Cancelar</button>
                        <button id="btn_form4"  type="button" class="btn btn-primary legitRipple">Guardar </button>
                              </center>               
               <script>
                $("#btn_form4").click(function(event) {
                   $("#btn_form4").attr("disabled","true");
                  $.post(base_url+"ficha_enfoque/arrastrar_asesor",$("#formulario2").serialize(),function(data){
                  /*alert(data.botones);*/
                   if(data.html==1)
                   {
                      $.post(base_url+"ficha_enfoque/asignacion_horario",{"id_produccion":$("#id_produccion").val()},function(data){
                      $("#tab3").removeClass("active");
                      $("#tab4").removeClass("disabledTab");
                      $("#tab4").addClass("active");

                      $("#bordered-justified-tab3").removeClass("active");
                       $("#bordered-justified-tab4").addClass("active");
                
                       document.body.scrollTop = 0;
                       
                     });
                     horario1(data.boton);
                      $("#botones").empty();
                    $("#botones").append(data.botones);
                   }
                   else{
                      document.body.scrollTop = 0;
                    $("#cabeza-tab3").empty();
                    $("#cabeza-tab3").append(data.html);
                    $("#boton2").empty();
                    $("#boton2").append(data.boton);
                  
                    $("#botones").empty();
                    $("#botones").append(data.botones);
                    }
                  },"json");
                    
               });
               </script>';

    $data2=array("id_produccion"=>$id_produccion,"asesores"=>$html,"boton"=>$boton);
    echo json_encode($data2);
  }

  public function horario()
  {

        $sql="select titulo as title,empiezo_tiempo as start,color as color,fin_tiempo as end,id_horario as id from horario_trabajador where estado=1 and id_trabajador=".$_POST['id_trabajador'];
        //echo $sql;
       //exit();
        $data=$this->Mantenimiento_m->consulta($sql);
     
          $datos1= [];

       foreach ($data as $key => $value) {
            
             $datos1[$key]["title"]=$value->title;
              $datos1[$key]["start"]=$value->start;
              $datos1[$key]["color"]=$value->color;
              $datos1[$key]["end"]=$value->end;
              $datos1[$key]["id"]=$value->id;
              $datos1[$key]["overlap"]=false;
               $diaActual=date("Y-m-d H:i:00");
    $datetime1 = new DateTime($diaActual);
    $datetime2 = new DateTime($value->end);
     if($_SESSION['usuario_perfil']!=2)
     {
       if($datetime2 >$datetime1)
       {
           $datos1[$key]["startEditable"]=true; 
           if($_SESSION['usuario_perfil']==5 || $_SESSION['usuario_perfil']==1 ){
           $datos1[$key]["durationEditable"]=true;
           }
     
       }
       else{
                 $datos1[$key]["startEditable"]=false;
                  $datos1[$key]["durationEditable"]=false;
           }        
      }
      
      else
      {
            $datos1[$key]["startEditable"]=false;
      }
   } 

        echo json_encode($datos1);
  }


  public function arrastrar_asesor()
  {
    $html1="";
    $html2="";
    $html="";
    $html3="";
    $post="";
    $em="";
    $botones="";
    $ax="";
  /*  echo $_POST['empiezo']; exit();
     $this->Mantenimiento_m->consulta1("UPDATE produccion set inicio=".$_POST['empiezo']."
                              where id_produccion=".$_POST['id_produccion']);*/ 

     $cantidad= count($_POST['id_empleado']);

       if($cantidad==1)
       {
          
          foreach ($_POST['id_empleado'] as $key => $value) 
          {
                 $em=$_POST['id_empleado'][$key];
            $this->Mantenimiento_m->consulta1("UPDATE subfase_tiempo_produccion set id_trabajador=".$_POST['id_empleado'][$key]."
            where id_produccion=".$_POST['id_produccion']);
             
            
          }
              $dni="";
                    $sql="select * from persona where dni=".$em;
                    $data=$this->Mantenimiento_m->consulta($sql);
                    foreach ($data as $key => $value) {
                       $nombre=$value->nombres." ".$value->apellidos;
                       $ddatos=$value->nombres;
                       $dni=$value->dni;
                      }
                        $ax="'". $dni."'";

                      $botones.='<button class="btn btn-primary" onclick="horario1('.$ax.')"  >'.$ddatos.'</button>&nbsp;';
    

             $datos=array("html"=>"1","boton"=>$em,"botones"=>$botones);

             $datos1 = array('descripcion' => "Se asigno un nuevo trabajo de produccion","fecha"=>date("Y-m-d H:i:s"),
              "url"=>"Documentos_c/new_documento","id_usuario"=>$em,"nombre"=>"Trabajo Asignado","id"=>$_POST['id_produccion']
              );

                     $this->Mantenimiento_m->insertar("notificacion",$datos1);



             echo json_encode($datos);
       }
       else
       {
         foreach ($_POST['id_empleado'] as $key => $value) 
              {  
                $id_empleado=$_POST['id_empleado'][$key];

                
             $datos1 = array('descripcion' => "Se asigno un nuevo trabajo de produccion","fecha"=>date("Y-m-d H:i:s"),
              "url"=>"Documentos_c/new_documento","id_usuario"=> $id_empleado,"nombre"=>"Trabajo Asignado","id"=>$_POST['id_produccion']
              );

                     $this->Mantenimiento_m->insertar("notificacion",$datos1);





                 if(($key+2)%2==0)
                  { 
                    $nombre="";
                    $dni="";
                    $sql="select * from persona where dni=".$id_empleado;
                    $data=$this->Mantenimiento_m->consulta($sql);
                    foreach ($data as $key => $value) {
                       $nombre=$value->nombres." ".$value->apellidos;
                       $ddatos=$value->nombres;
                       $dni=$value->dni;
                      }
                        $ax="'". $dni."'";

                      $botones.='<button class="btn btn-primary" onclick="horario1('.$ax.')"  >'.$ddatos.'</button>&nbsp;';
                     $post.='/*alert($("#'.$dni.'").serialize());*/
                     $.ajax({
                             url:base_url+"Ficha_enfoque/asignacion",
                             data:"id_produccion="+'.$_POST['id_produccion'].'+"&"+$("#'.$dni.'").serialize(),
                             type:"post",
                             dataType: "json",
                             success: function(data){}
                            });';

                         $html1.=' <form id="'.$dni.'">
                         <div class="panel panel-body border-top-info">
                          <div class="text-center">
                          <input id="id_asesor" type="hidden" name="id_asesor" value="'.$dni.'">
                          <h6 class="text-semibold no-margin">Asesor</h6>
                          <p class="content-group-sm text-muted">'.$nombre.'</p>
                         </div>
                          <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
                          </ul>
                         </div>
                      </form>';
                     }

                      else
                      {
                        //echo "hola2";
                          $nombre="";
                          $sql="select * from persona where dni=".$id_empleado;
                            $data=$this->Mantenimiento_m->consulta($sql);
                            //   print_r($sql);
                              //  print_r($data);
                          foreach ($data as $key => $value) {
                            $nombre=$value->nombres." ".$value->apellidos;
                            $dni=$value->dni;
                            $ddatos=$value->nombres;
                          }
                               $ax="'". $dni."'";

                      $botones.='<button class="btn btn-primary" onclick="horario1('.$ax.')"  >'.$ddatos.'</button>&nbsp;';
                           $post.=' 
                              $.ajax({
                              url:base_url+"Ficha_enfoque/asignacion",
                              data:"id_produccion="+'.$_POST['id_produccion'].'+"&"+$("#'.$dni.'").serialize(),
                              type:"post",
                              dataType: "json",
                              success: function(data) {} });';

                         $html2.='
                           <form id="'.$dni.'">
                            <div class="panel panel-body border-top-info">
                              <div class="text-center">
                               <input id="id_asesor" type="hidden"  name="id_asesor" value="'.$dni.'"/>
                              <h6 class="text-semibold no-margin">Asesor</h6>
                              <p class="content-group-sm text-muted">'.$nombre.'</p>
                           </div>
                          <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">
                  
                             </ul>
                          </div>
                         </form>';
                      }

                   
                  } 
           
                   $sql="SELECT DISTINCT(fases.id_fase) as id_fase,fases.titulo as titulo,fases.descripcion as descripcion from subfase_tiempo_produccion,subfase_tiempo,subfase,fases
                     where subfase_tiempo.id_tiempo=subfase_tiempo_produccion.id_tiempo and 
                     subfase_tiempo.id_subfase=subfase.id_subfase and subfase.id_fase=fases.id_fase and 
                     subfase_tiempo_produccion.id_produccion=".$_POST['id_produccion']." order by subfase.id_subfase asc";
                         $data=$this->Mantenimiento_m->consulta($sql);   
                    foreach ($data as $key => $value)
                      {     

                      $sql="SELECT subfase_tiempo_produccion.id_tiempo as id_tiempo,subfase.titulo as titulo, subfase.descripcion as descripcion from subfase_tiempo_produccion,subfase_tiempo,subfase
                        where subfase_tiempo.id_tiempo=subfase_tiempo_produccion.id_tiempo and 
                           subfase_tiempo.id_subfase=subfase.id_subfase and subfase.id_fase=".$value->id_fase." and
                           subfase_tiempo_produccion.id_produccion=".$_POST['id_produccion']." order by subfase.id_subfase asc";
                        $data1=$this->Mantenimiento_m->consulta($sql);  
                        $html3.='<form id="validar1"><div class="form-group">
                        <label title="'.$value->descripcion.'" ><b>'.$value->titulo.'</b></label>
                        <ul class="dropdown-menu dropdown-menu-sortable" style="display: block; position: static; width: 100%; margin-top: 0; float: none;">';
                              
                        foreach ($data1 as $key => $data2) 
                            {  
                              $html3.='<li class=""><input type="hidden" name="idsubfases[]" id="idsubfases" value="'.$data2->id_tiempo.'" ><a href="#" title="'.$value->titulo.":".$data2->descripcion.'">'.$data2->titulo.'</a></li>';
                            }
                          $html3.='</ul> </div></form>';
                    }

              //echo $html3;
                  $html.='<div class="row">
                  <div class="col-md-4"> ';
                  $html.=$html1;
                  $html.="</div>";
                  $html.='<div class="col-md-4"> ';
                  $html.=$html3;
                  $html.='</div><div class="col-md-4">';
                  $html.=$html2;
                  $html.="</div></div>";
              $html.="<script>
                       $( function() {
                          var containers = $('.dropdown-menu-sortable').toArray();
                          dragula(containers, {
                           mirrorContainer: document.querySelector('.dropdown-menu-sortable')
                            });
                     });
                   function boton()
                    {
                    if($('#validar1').serialize()==''){
                    ".$post."
                  //alert($('#validar1').serialize());
                     $.post(base_url+'ficha_enfoque/asignacion_horario',{'id_produccion':$('#id_produccion1').val()},function(data){
                      $('#tab3').removeClass('active');
                      $('#tab4').removeClass('disabledTab');
                      $('#tab4').addClass('active');

                      $('#bordered-justified-tab3').removeClass('active');
                       $('#bordered-justified-tab4').addClass('active');
                
                       document.body.scrollTop = 0;
                       
                     });
                   }
                   else{
                        alert('Se necesita asignar todos las subfase para seguir ');
                      } 
                   }
              </script>";
                $a="";
                $a="'Ficha_enfoque','Tesis'";
                $boton=' <center> 
                  <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('.$a.')">Cancelar</button>
                  <button id="btn_form5" onclick="boton()" type="button" class="btn btn-primary legitRipple">Guardar </button>
                  </center>  
                  ';
              $datos=array("html"=>$html,"boton"=>$boton,"botones"=>$botones);
              echo json_encode($datos);
      }




                     

    }

    
    public function notificaciones1()
    {  

 
        $nombre="";
        $descripcion="";
        $fecha="";
        $imagen="";
        $url="";
        $sql="select * from notificacion where estado=2 and id_usuario=".$_SESSION['dni_usuario']." LIMIT 1";
        $html="";
        $id="";
        $arp=1;
         $cantidad=0;
         $id_notificacion="";
         $id1="";
        $data=$this->Mantenimiento_m->consulta($sql);
        //print_r($data);
       
        foreach ($data as $key => $value)
         {
            $url=$value->url;
            $nombre=$value->nombre;
            $fecha=$value->fecha;
            $descripcion=$value->descripcion;
            $imagen=$value->imagen;
            $id=$value->id_notificacion;
            $id1=$value->id;
            $arp=2;
        
        }

   

        $sql="select  * from notificacion where estado<>0 and id_usuario=".$_SESSION['dni_usuario'];
     
        $data1=$this->Mantenimiento_m->consulta($sql);
         $tal= count($data1); 
        // print_r($tal);
          $html.='<ul class="media-list dropdown-content-body width-350">';
       foreach ($data1 as $key => $value)
        { $fecha = date_create($value->fecha);
              
          $a="'".$value->id_notificacion."','".$value->url."','".$value->id."'";
          $html.='<li class="media">
                  <div class="media-left">
                    <a href="#" class="btn bg-teal-400 btn-rounded btn-icon btn-xs legitRipple"><i class="icon-spinner11"></i></a>
                  </div>
                  
                  <div class="media-body" onclick="notificacion('.$a.')">
                  <a> <strong>'.$value->nombre.'</strong>-'.$value->descripcion.'
                  </a><div class="media-annotation">'.date_format($fecha, "F j, Y, g:i a").'</div>
                  </div>
                </li>
                 ';
       }

      

           $html.='</ul>
                <script>
                   function notificacion(id_notificacion,url,id)
                       {
                        $.post(base_url+"Ficha_enfoque/borrar_notificacion",{id:id_notificacion},function(data){
    
                       });
                       $.post(base_url+url,{id:id},function(data){
                   
                            $("#cont_sistema").empty().html(data);
                             });
                       $(".dropdown").removeClass("open");

                     }
                   </script>
                ';

         $datos=array("notificaciones"=>$html,"cantidad"=>$tal,"nombre"=>$nombre,"fecha"=>$fecha,"imagen"=>$imagen,"descripcion"=>$descripcion
        ,"url"=>$url,"arp"=>$arp,"id"=>$id1,"id_notificacion"=>$id);
         echo json_encode($datos);
         if($id!=""){
          $this->Mantenimiento_m->consulta1("update notificacion set estado=1 where id_notificacion=".$id);
         }
        
    }

    public function borrar_notificacion()
    { // echo $_POST['id'];exit();
        $this->Mantenimiento_m->consulta1("update notificacion set estado=0 where id_notificacion=".$_POST['id']);
    }


 public function asignacion()
   {
      foreach ($_POST['idsubfases'] as $key => $value) 
      {
        $sql="update subfase_tiempo_produccion set id_trabajador=".$_POST['id_asesor']." where id_produccion=".$_POST['id_produccion']."
        and id_tiempo=".$_POST['idsubfases'][$key];
        $this->Mantenimiento_m->consulta1($sql);

      }
   }



    function validarhorario($id_asesor,$tiempo)
   {
     $minuto=0;
     $minutos=0;
     $horas=0;
      $ar=explode(":", $tiempo); 
      $horas=int($ar[0]);
      $minuto=int($ar[1]);
      $sql="select max(id_horario),fin_tiempo from horario_trabajador where id_trabajador=".$id_asesor;
      $data=$this->Mantenimiento_m->consulta2($sql);
      $tal= count($data);
      $minutos=$horas*60+$minuto;
     $dia=$data->fin_tiempo;
      $fecha = date_create($dia);
      date_add($fecha, date_interval_create_from_date_string('$minutos minutes'));
    
       $datos=array(
        "empiezo_tiempo"=>$dia,
        "fin_tiempo"=>  date_format($fecha, 'Y-m-d H:i:00'),
        "id_trabajador"=>$id_asesor,
        "titulo"=>"SDasd"
        );
       $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
     /*
      if($tal==0)
      {
        
      }
      else
      {
          
      }
    */
   }

public function crear_usuario()
{
   $datos1=$this->Mantenimiento_m->consulta2("select * from usuario where persona=".$_POST['dni']);
   if($datos1->persona==""){

  $datos=array(
     "usu_usuario"=>$_POST['dni'],
     "usu_clave"=>$_POST['dni'],
     "usu_fechareg"=>date("Y-m-d"),
     "usu_perfil"=>3,
     "usu_sede"=>$_SESSION['id_sede'],
     "persona"=>$_POST['dni']
    );

  $this->Mantenimiento_m->insertar("usuario",$datos);
   }



  $datos=array(
     "estado_ficha"=>6
    );
  $this->Mantenimiento_m->actualizar("ficha_enfoque",$datos,$_POST['id_enfoque'],"id_ficha_enfoque");
}


function asignacion_horario()
{
 $sql="SELECT
subfase.descripcion as subdescripcion,
fases.descripcion as fadescripcion,
subfase.titulo as subtitulo,
fases.titulo as fasetitulo,
subfase_tiempo.tiempo as tiempo,
subfase_tiempo.id_tiempo as id_tiempo,
subfase_tiempo_produccion.id_fase_tiempo as id_fase_tiempo,
subfase_tiempo_produccion.id_trabajador as trabajador,
produccion.color as color

FROM
subfase_tiempo_produccion ,
subfase,subfase_tiempo,fases,produccion

WHERE subfase_tiempo_produccion.id_produccion=produccion.id_producion and 
subfase_tiempo_produccion.id_tiempo=subfase_tiempo.id_tiempo and subfase.id_subfase=subfase_tiempo.id_subfase and
fases.id_fase=subfase.id_fase AND produccion.id_producion=".$_POST['id_produccion'];
  //  echo $sql;exit();
  $data=$this->Mantenimiento_m->consulta($sql);


$titu=$this->Mantenimiento_m->consulta2("SELECT
ficha_enfoque.titulo_enfoque
FROM
ficha_enfoque
INNER JOIN produccion ON ficha_enfoque.id_ficha_enfoque = produccion.id_ficha_enfoque

WHERE produccion.id_producion  = ".$_POST['id_produccion']);
$iproducion = $_POST['id_produccion'];
  foreach ($data as $key => $value) 
  {
   
     $this->nuevohorario($value->tiempo,$value->trabajador,$value->fasetitulo."(".$value->subtitulo.")",$value->fadescripcion."(".$value->subdescripcion.")TITULO :".$titu->titulo_enfoque,$value->color,$value->id_fase_tiempo,$iproducion,$value->id_tiempo);
                   
    }

    // agregar para las observaciones

     $id_ficha_enfoque=$this->Mantenimiento_m->consulta2("select * from produccion where id_producion=".$_POST["id_produccion"]);
        $data2  = array(
      "ficha_enfoque_estado_observacion" => '1'
    );
    //print_r($id_ficha_enfoque);
    $this->db->where('id_ficha_enfoque',$id_ficha_enfoque->id_ficha_enfoque);
    $estado=$this->db->update('ficha_enfoque', $data2);
           

   }



public function nuevohorario($tiempo,$id_trabajador,$titulo,$descripcion,$color,$id,$idproduccion,$idT)
{  //echo "hola";

if($id!=""){

    list($horas,$minuto)=$this->dividir_tiempo($tiempo);
    $minutos=($horas*60)+$minuto;
    $data=$this->Mantenimiento_m->consulta2("select * from usuario,sede where usuario.usu_sede=sede.id_sede AND usuario.persona='".$id_trabajador."'");
   
    $h_m_i=strtotime($data->horario_m_i);
    $h_m_f=strtotime($data->horario_m);
    $h_t_i=strtotime($data->horario_t_i);
    $h_t_f=strtotime($data->horario_t);

    $ho_m_i=$data->horario_m_i;
    $ho_m_f=$data->horario_m;
    $ho_t_i=$data->horario_t_i;
    $ho_t_f=$data->horario_t;
    
    $data1=$this->Mantenimiento_m->consulta2("select max(fin_tiempo) as maximo_tiempo from horario_trabajador where estado=1 and id_trabajador=".$id_trabajador);
    $dia=$data1->maximo_tiempo;
   
    $diaActual=date("Y-m-d H:i:00");
    $datetime1 = new DateTime($diaActual);
    $datetime2 = new DateTime($dia);
   if($dia!=""){
    if($datetime1 > $datetime2)
     {
      $fecha3= $datetime1->format('Y-m-d H:i:00');
      $fecha4= $datetime1->format('Y-m-d');
      $fecha2 = date_create($fecha3); 
      $tiemponuevo1=date_format($fecha2, 'H:i:00');
      $ar7=explode(":",$tiemponuevo1); 
      $horas=(int)$ar7[0];
      $minuto3=(int)$ar7[1];
      $total=(int)(($minuto3/5)+1)*5;
      if($total<60){
         $dia= $fecha4." ".$horas.":".$total.":00";
      }
      else{
              $maria=$fecha4." ".$horas.":00:00";
              $fecha6= date_create($maria);
              date_add($fecha6, date_interval_create_from_date_string('1 hours'));
              $dia=date_format($fecha6, 'Y-m-d H:i:00');

          }

    } 
  }
  else{
          $fecha3= $datetime1->format('Y-m-d H:i:00');
      $fecha4= $datetime1->format('Y-m-d');
      $fecha2 = date_create($fecha3); 
      $tiemponuevo1=date_format($fecha2, 'H:i:00');
      $ar7=explode(":",$tiemponuevo1); 
      $horas=(int)$ar7[0];
      $minuto3=(int)$ar7[1];
      $total=(int)(($minuto3/5)+1)*5;
      if($total<60){
         $dia= $fecha4." ".$horas.":".$total.":00";
      }
      else{
              $maria=$fecha4." ".$horas.":00:00";
              $fecha6= date_create($maria);
              date_add($fecha6, date_interval_create_from_date_string('1 hours'));
              $dia=date_format($fecha6, 'Y-m-d H:i:00');

          }
  }
  
$dia_hora=date_create($dia);
$ho_i=date_format($dia_hora,"H:i:00");
$fecha_i=date_format($dia_hora,"Y-m-d");
$dia_validacion = strtotime($fecha_i);
$h_i=strtotime($ho_i);


if($h_i<$h_t_f && (date("w",$dia_validacion)!=6 || $h_i<$h_m_f) )
{
  //echo "hola";
  if ($h_i>=$h_m_i) 
  {
    if ($h_i>=$h_m_f)
    {
      if($h_i>=$h_t_i)
      {
         $fecha_inicio=$fecha_i." ".$ho_i;
         $crear_dia=date_create($fecha_inicio);
         $fecha_final=date_format(date_add($crear_dia, date_interval_create_from_date_string($minutos.' minutes')) , 'Y-m-d H:i:00');
         $h_f=date_format($crear_dia, ' H:i:00');
          $verficar_inicio=strtotime($fecha_i." ".$ho_t_f);
          $verficar_horario=strtotime($fecha_final);
         if ($verficar_inicio>=$verficar_horario)
          {
           $datos=array(
           "empiezo_tiempo"=>$fecha_inicio,
           "fin_tiempo"=>$fecha_final ,
           "tiempo"=>$this->convertir($minutos),
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id
           );
           print_r($datos);
           echo 1;
           $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
             
           $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion

              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
          }
          else
          {
            $fecha_final1=$fecha_i." ".$ho_t_f;
            $datetime1 = date_create($fecha_inicio);
            $datetime2=date_create($fecha_final1);
            $interval = date_diff($datetime1, $datetime2);
            $minutos1=$interval->format('%H:%i:00');
            $datos=array(
             "empiezo_tiempo"=>$fecha_inicio,
             "fin_tiempo"=>$fecha_final1,
             "tiempo"=>$minutos1,
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id    
             );
             print_r($datos);echo 2;
             $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
                  $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
        //$datetime2 = date_create($fecha_final);
            $datetime1 = date_create($fecha_final1);
            $datetime2=date_create($fecha_final);
            $interval = date_diff($datetime1, $datetime2);
            $minutos2=$interval->format('%H:%i:00');
            $this->nuevohorario($minutos2,$id_trabajador,$titulo,$descripcion,$color,$id,$idproduccion,$idT);

          }
     
      }
      else
      {
    
         $fecha_inicio=$fecha_i." ".$ho_t_i;
         $crear_dia=date_create($fecha_inicio);
         $fecha_final=date_format(date_add($crear_dia, date_interval_create_from_date_string($minutos.' minutes')) , 'Y-m-d H:i:00');
          $verficar_inicio=strtotime($fecha_i." ".$ho_t_f);
          $verficar_horario=strtotime($fecha_final);
      
         if($verficar_inicio>=$verficar_horario)
         {
           
           $datos=array(
          "empiezo_tiempo"=>$fecha_inicio,
          "fin_tiempo"=>$fecha_final,
          "tiempo"=>$this->convertir($minutos),
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id  
           );
         print_r($datos);
         echo 3;
         $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
            $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);


         }
         else 
         { 


            $fecha_final2=$fecha_i." ".$ho_t_f;
             $datos=array(
          "empiezo_tiempo"=>$fecha_inicio,
          "fin_tiempo"=>$fecha_final2,
          "tiempo"=>$this->diferencia_tiempo($fecha_inicio,$fecha_final2),
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id  
           );
         print_r($datos);
         echo 3;
         $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
            $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);

            $minutos2=$this->diferencia_tiempo($fecha_final2,$fecha_final);
          $this->nuevohorario($minutos2,$id_trabajador,$titulo,$descripcion,$color,$id,$idproduccion,$idT);

         }







        

      }
    }
    else
    {
      $fecha_inicio=$fecha_i." ".$ho_i;
      $crear_dia=date_create($fecha_inicio);
      $fecha_final=date_format(date_add($crear_dia, date_interval_create_from_date_string($minutos.' minutes')) , 'Y-m-d H:i:00');
      $h_f=date_format($crear_dia, ' H:i:00');
      if (strtotime($h_f)<=strtotime($ho_m_f))
      {
        $datos=array(
           "empiezo_tiempo"=>$fecha_inicio,
           "fin_tiempo"=>$fecha_final ,
           "tiempo"=>$this->convertir($minutos)  ,
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id
          );
        print_r($datos);
        echo 4;
        $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
           $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
      }
      else
      {
        $fecha_final1=$fecha_i." ".$ho_m_f;
        $datetime1 = date_create($fecha_inicio);
        $datetime2=date_create($fecha_final1);
        $interval = date_diff($datetime1, $datetime2);
        $minutos1=$interval->format('%H:%i:00');
        $datos=array(
           "empiezo_tiempo"=>$fecha_inicio,
           "fin_tiempo"=>$fecha_final1,
           "tiempo"=>$minutos1,
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id   
          );
          print_r($datos);echo 5;
          $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
             $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
        //$datetime2 = date_create($fecha_final);
        $datetime1 = date_create($fecha_final1);
        $datetime2=date_create($fecha_final);
        $interval = date_diff($datetime1, $datetime2);
        $minutos2=$interval->format('%H:%i:00');
        $this->nuevohorario($minutos2,$id_trabajador,$titulo,$descripcion,$color,$id,$idproduccion,$idT);


      }
      

    }
  }
  else
  {



    //////////////////////////
   $fecha_inicio=$fecha_i." ".$ho_m_i;
   $crear_dia=date_create($fecha_inicio);
   //date_add($crear_dia, date_interval_create_from_date_string($minutos.' minutes')) ;
   //$fecha_final=date_format($crear_dia, 'Y-m-d H:i:00');
     $valid_dia = strtotime($fecha_inicio);

   if(date('w', $valid_dia)==0){
       date_add($crear_dia, date_interval_create_from_date_string('1 days'));
   }
  $fecha_inicio=date_format($crear_dia,'Y-m-d H:i:00');
   $fecha_final=date_format(date_add($crear_dia, date_interval_create_from_date_string($minutos.' minutes')) , 'Y-m-d H:i:00');
   $datos=array(
   "empiezo_tiempo"=>$fecha_inicio,
   "fin_tiempo"=>$fecha_final,
   "tiempo"=>$this->convertir($minutos),
            "id_trabajador"=>$id_trabajador,
            "titulo"=>$titulo,
            "descripcion"=>$descripcion,
            "color"=>$color,
            "idTiempo"=>$id
    );
   print_r($datos);echo  6;
   $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
      $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
            $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
  }

}
else
{
   $fecha_inicio=$fecha_i." ".$ho_m_i;
   $crear_dia=date_create($fecha_inicio);
   date_add($crear_dia, date_interval_create_from_date_string('1 days'));

   $valid_dia = strtotime($fecha_inicio);

   if(date('w', $valid_dia)==6){
       date_add($crear_dia, date_interval_create_from_date_string('1 days'));
   }


   $fecha_inicio=date_format($crear_dia,'Y-m-d H:i:00');
   $fech=date_format($crear_dia,'Y-m-d');
   $fecha_final=date_format(date_add($crear_dia, date_interval_create_from_date_string($minutos.' minutes')) , 'Y-m-d H:i:00');
    $verficar_inicio=strtotime($fech." ".$ho_m_f);
          $verficar_horario=strtotime($fecha_final);

      if($verficar_inicio>=$verficar_horario){
    
              $datos=array(
                   "empiezo_tiempo"=>$fecha_inicio,
                   "fin_tiempo"=>$fecha_final,
                   "tiempo"=>$this->convertir($minutos),
                   "id_trabajador"=>$id_trabajador,
                    "titulo"=>$titulo,
                    "descripcion"=>$descripcion,
                    "color"=>$color,
                    "idTiempo"=>$id
                );
               print_r($datos);
               echo 7;
              $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
              $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
               $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);

      }
      else{

        $fecha_final1=$fech." ".$ho_m_f;

           $datos=array(
                   "empiezo_tiempo"=>$fecha_inicio,
                   "fin_tiempo"=>$fecha_final1,
                   "tiempo"=>$this->diferencia_tiempo($fecha_inicio,$fecha_final1),
                   "id_trabajador"=>$id_trabajador,
                    "titulo"=>$titulo,
                    "descripcion"=>$descripcion,
                    "color"=>$color,
                    "idTiempo"=>$id
                );
              print_r($datos);
               echo 7;
              $this->Mantenimiento_m->insertar("horario_trabajador",$datos);
              $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");
               $datos=array(
                 "idhorario"=>$hola1->maximo,
                "idtiempo"=>$idT,
                 "idproduccion"=>$idproduccion
              );
          
             $this->Mantenimiento_m->insertar("logproduccion",$datos);
            $minutos2=$this->diferencia_tiempo($fecha_final,$fecha_final1);
              $this->nuevohorario($minutos2,$id_trabajador,$titulo,$descripcion,$color,$id,$idproduccion,$idT);



      }



}
 



}


}  

public function diferencia_tiempo($tiempo_inicial,$tiempo_final)
{
          $datetime1 = date_create($tiempo_inicial);
        $datetime2=date_create($tiempo_final);
        $interval = date_diff($datetime1, $datetime2);
        return $minutos2=$interval->format('%H:%i:00');



}  
public function prueba()
{
  $this->nuevohorario("1:10:00","87654321");
  //$this->convertir("200");
}

public function dividir_tiempo($mtiempo)
{
   $ar=explode(":", $mtiempo); 
   $horas=(int)$ar[0];
   $minuto=(int)$ar[1];
   return array ($horas,$minuto);
}



public function asesoresListos()
{

   $ar=explode(":", $_POST['hora']); 
                     $horas=(int)$ar[0];
                     $minuto=(int)$ar[1];

  $minutos=($horas*60)+$minuto;



   $diaActual=date("Y-m-d H:i:00");
     $datetime1 = new DateTime($diaActual);
$fecha3= $datetime1->format('Y-m-d H:i:00');
  $fecha4= $datetime1->format('Y-m-d');
  $fecha2 = date_create($fecha3);

  $tiemponuevo1=date_format($fecha2, 'H:i:00');
  $ar7=explode(":",$tiemponuevo1); 
  $horas=(int)$ar7[0];
  $minuto3=(int)$ar7[1];
  $total=(int)(($minuto3/5)+1)*5;

  if($total<60){
     $dia= $fecha4." ".$horas.":".$total.":00";
  }
  else{
             $maria=$fecha4." ".$horas.":00:00";
              $fecha6= date_create($maria);
              date_add($fecha6, date_interval_create_from_date_string('1 hours'));
             $dia=date_format($fecha6, 'Y-m-d H:i:00');

  }

  $dianuev=date_create($dia);
  $dia2=date_create($dia);
  date_add($dianuev, date_interval_create_from_date_string($minutos.' minutes'));
  
  $data=date_format($dianuev, 'Y-m-d H:i:00');
  $menor=date_format($dia2, 'Y-m-d H:i:00');
 $html="<option>Selecionar trabajador</option>";
           if($_SESSION['usuario_perfil']=="5"){
      $sede=$this->Mantenimiento_m->lista("sede");
       }
       else
       {
        $sede=$this->Mantenimiento_m->consulta("select * from sede where id_sede=".$_SESSION['id_sede']);
       }
    
      foreach ($sede as $datasede)
       {
          $asesorsede=$this->Mantenimiento_m->asesores($datasede->id_sede);

          $html.= '<optgroup label="'.$datasede->descripcion.'">';
          foreach ($asesorsede as $datasesor) {
              $son=$this->Mantenimiento_m->consulta2("select * from  persona where dni=".$datasesor->dni);

        $sql="select *  from horario_trabajador where id_trabajador='".$datasesor->dni."' and 
          (empiezo_tiempo<=STR_TO_DATE('".$dia."','%Y-%m-%d %H:%i:%s') and fin_tiempo>=STR_TO_DATE('".$data."', '%Y-%m-%d %H:%i:%s') 
      or STR_TO_DATE('".$data."','%Y-%m-%d %H:%i:%s')>fin_tiempo and STR_TO_DATE('".$dia."','%Y-%m-%d %H:%i:%s')<fin_tiempo)";
    //echo $sql;
    
    $data2=$this->Mantenimiento_m->consulta($sql);
    
    $c=0;
   ///print_r($data2);exit();
    foreach ($data2 as $key => $datasesor) {
       
       if($datasesor->empiezo_tiempo!="")
       {
         $c=$c+1;
         
       }
    
    }
 // echo $c;
    if($c==0)
    {
      $a="'".$son->dni."','"."1"."'";
     $html.='<option class="bg-success"  value="'.$son->dni."/1".'" >'.$son->nombres." ".$son->apellidos.'</option>';

    }
    else
    {
       $a="'".$son->dni."','"."0"."'";
      $html.='<option class="bg-danger"  value="'.$son->dni."/0".'" >'.$son->nombres." ".$son->apellidos.'</option>';
    }

            
         
          }
            $html.='</optgroup>';
         }
      //echo $html;

      echo json_encode(array("html"=>$html,"empiezo"=>$dia,"fin"=>$data));


} 
public function convertir($data){
  $hora=(int)((int)$data/60);
  $minuto=(int)((int)$data%60);
  return $hora.":".$minuto.":00";
} 

public function cambiarHorario()
{
 // nuevohorario($tiempo,$id_trabajador,$titulo,$descripcion,$color,$id,$idproduccion,$idT)
    $id_horario=$_POST['id_horario'];
    $id_trabajador1=$_POST['id_trabajador1'];

    $data=$this->Mantenimiento_m->consulta2("select * from horario_trabajador where id_horario=".$id_horario);
    $data1=$this->Mantenimiento_m->consulta2("select * from logproduccion where idhorario=".$id_horario);

    $this->nuevohorario($data->tiempo,$id_trabajador1,$data->titulo,$data->descripcion,$data->color,$data1->idtiempo,$data1->idproduccion,$data1->idtiempo);
     $this->Mantenimiento_m->consulta1("update horario_trabajador Set estado =0 where id_horario=".$id_horario);

}

public function  guardar_captacion()
{
  $data = array('descripcion' =>$_POST['data'] );
  $this->Mantenimiento_m->insertar("captacion",$data);
  $datos= $this->Mantenimiento_m->lista("captacion");
  $html="";
  foreach ($datos as $key => $value) {
    $html.="<option value= '".$value->id_captacion."'>".$value->descripcion."</option>";

  }
  echo $html;
}
public function  estadoCambiar5()
{
//  echo $_POST['id_enfoque'];
  echo $sql="update ficha_enfoque set estado_ficha=5 where id_ficha_enfoque=".$_POST['id_enfoque'];
   $this->Mantenimiento_m->consulta1($sql);
}
public function finalizar()
{
  //echo $_POST['id'];
  
      $id_enfoque=$_POST['id'];
    $data=array("estado_ficha"=>7);
    $this->Mantenimiento_m->actualizar("ficha_enfoque",$data,$id_enfoque,"id_ficha_enfoque");
  
}
public function eliminarLista()
{
  $sql="update ficha_enfoque set estado_ficha=0 where id_ficha_enfoque=".$_POST['id'];
   $this->Mantenimiento_m->consulta1($sql);

   $sql="select id_producion from produccion where id_ficha_enfoque=".$_POST['id'];
     $dat=$this->Mantenimiento_m->consulta2($sql);

     $dato="select * from logproduccion where idproduccion=".$dat->id_producion;
     $d=$this->Mantenimiento_m->consulta($dato);
     foreach ($d as $key => $value) {
         $sql="delete from logproduccion where idhorario=".$value->idhorario;
                $this->Mantenimiento_m->consulta1($sql);
                 $sql="delete from horario_trabajador where id_horario=".$value->idhorario;
                  $this->Mantenimiento_m->consulta1($sql);

     }

}

 
  function vertodo()
  {
     $contrato=$this->Mantenimiento_m->consulta2("select * from ficha_enfoque where id_ficha_enfoque=".$_POST['id']);

    $sql ="SELECT tarea.descripcion, dificultad.descripcion as dis,fases.titulo as titu, persona.nombres,persona.apellidos,horario_trabajador.empiezo_tiempo,horario_trabajador.fin_tiempo,
    horario_trabajador.tiempo,subfase.titulo from 
produccion,logproduccion,subfase_tiempo,subfase,
horario_trabajador,trabajador,persona,fases,tarea,dificultad
where 
produccion.id_producion=logproduccion.idproduccion and fases.id_fase=subfase.id_fase
and logproduccion.idhorario=horario_trabajador.id_horario
and trabajador.dni=horario_trabajador.id_trabajador
and persona.dni=trabajador.dni
and logproduccion.idtiempo=subfase_tiempo.id_tiempo
and subfase.id_subfase=subfase_tiempo.id_subfase and horario_trabajador.estado=1 and tarea.id_tarea=subfase_tiempo.id_tarea and 
dificultad.id_dificultad=subfase_tiempo.id_dificultad and produccion.id_ficha_enfoque=".$_POST['id']." ORDER BY horario_trabajador.empiezo_tiempo asc";
$dat=$this->Mantenimiento_m->consulta($sql);
$html="";
$c=1;
foreach ($dat as $key => $value) {
   $html.="<tr>";
    $html.="<td>".$c."</td>";
     $html.="<td>".$value->nombres." ".$value->apellidos."</td>";
      $html.="<td>".$value->empiezo_tiempo."</td>";
       $html.="<td>".$value->fin_tiempo."</td>";
         $html.="<td>".$value->tiempo."</td>";
             $html.="<td>".$value->titu."(".$value->titulo.")".$value->descripcion.",".$value->dis."</td>";
    $html.="</tr>"; 

     $c=$c+1;
}

//echo $html;
$json=array("datos"=>$html,"fecha"=>$contrato->fecha_registro);
echo json_encode($json);

  }
public function Tipodise()
{
  if (isset($_POST['id'])) {
    $lista=$this->Mantenimiento_m->tipodise($_POST['id']);
    $html="";
    $html.= "<option value=''>Selecionar Diseño</option>";
    foreach ($lista as $value) {
      $html.= "<option value='".$value->dis_id."'>".$value->dis_diseo."</option>";
    }
    echo $html;
  }
}
public function concatenar(){


 $verbo = $this->Mantenimiento_m->consulta("SELECT verbo.ver_id,verbo.ver_verbo FROM detalle_tip_verbo INNER JOIN tipo_verbo ON detalle_tip_verbo.tiv_id = tipo_verbo.tiv_id
  INNER JOIN verbo ON detalle_tip_verbo.ver_id = verbo.ver_id   where tipo_verbo.tiv_id = 1");
 $this->load->view("Ficha_enfoque/matriz",compact('verbo'));
}


public function guardar_observacion()
{
     $produccion=$this->Mantenimiento_m->consulta2("select * from produccion where id_ficha_enfoque=".$_POST["observacion_id_ficha_enfoque"]);
     $id_produccion=$produccion->id_producion;
        $color=$produccion->color;

    $x=$this->Mantenimiento_m->consulta("select * from persona where dni=".$_POST['id_trabajador']);
        foreach ($x as $key => $value) {
          $nombres=$value->nombres." ".$value->apellidos;
        }
     $id_trabajador=$this->Mantenimiento_m->consulta2("select * from usuario where persona=".$_POST["id_trabajador"]);


    $arrayName = array(
      'idusuario' =>$id_trabajador->usu_id,
      'idficha'=>$_POST["observacion_id_ficha_enfoque"],
      'fecha'=>date("Y-m-d H:i:s"),
      'descripcion'=>"obseravion ",
      'id_asignador'=>$_SESSION['dni_usuario']
      

  );
     $this->Mantenimiento_m->insertar("observaciones",$arrayName);
       $hola=$this->Mantenimiento_m->consulta2("select max(idobservacion) as maximo from observaciones");  
         

        $data1=array(
           "descripcion"=>"Se le asigno una nueva ficha de Observaciones",
           "fecha"=>date('Y-m-d H:i:s'),
           "url"=>"Observaciones/nuevasobservaciones",
           "id_usuario"=>$_POST['id_trabajador'],
           "id"=>$hola->maximo,
           "nombre"=>$nombres

          );
            $this->Mantenimiento_m->insertar("notificacion",$data1);

       /////////////////////////////////////////////////////////////////////////////////
 

      
   // echo $maximo1;
        $datos=array(
          "id_produccion"=>$id_produccion,
           "id_trabajador"=>$_POST['id_trabajador'],

          );

      $this->Mantenimiento_m->insertar("subfase_tiempo_produccion",$datos);
             $datos=array(
           "empiezo_tiempo"=>$_POST['empiezo'],
           "fin_tiempo"=>$_POST['fin'],
           "id_trabajador"=>$_POST['id_trabajador'],
           "titulo"=>"Fase 1",
           "color"=>$color,
           "descripcion"=>"Ficha de observacion",
           "tiempo"=>$_POST['hora'].":00"

          );

   
        $this->Mantenimiento_m->insertar("horario_trabajador",$datos);


 $hola1=$this->Mantenimiento_m->consulta2("select max(id_horario) as maximo from horario_trabajador");

$datos=array(
      "idhorario"=>$hola1->maximo,
      "idtiempo"=>"",
      "idproduccion"=>$id_produccion
  );
          
 $this->Mantenimiento_m->insertar("logproduccion",$datos);





}

public function titulo_enfoque()
{
  $data=$this->Mantenimiento_m->consulta2("select * from ficha_enfoque where id_ficha_enfoque=".$_POST["id"]);
  echo $data->titulo_enfoque;

}

public function guardar_ficha_requerimiento()
{

    $data=array("id_ficha_enfoque"=>$_POST["enfoque_requerimiento"],"fecha_requerimiento"=>date("Y-m-d H:i:s"));
    $this->Mantenimiento_m->insertar("ficha_requerimiento",$data);
    $id_ficha_requerimiento=$this->db->insert_id(); 
    foreach($_POST["requermientos"] as $key => $value) {
        $des_requerimiento=$_POST['requermientos'][$key];
        $dat=array("id_ficha_requerimiento"=>$id_ficha_requerimiento,"descripcion_requerimiento"=>$des_requerimiento);
          $this->Mantenimiento_m->insertar("detalle_requerimiento",$dat);
        
    }

    echo $id_ficha_requerimiento;

    $dat=$this->Mantenimiento_m->consulta3("SELECT * from ficha_enfoque,persona where ficha_enfoque.id_cliente=persona.dni and ficha_enfoque.id_ficha_enfoque=".$_POST["enfoque_requerimiento"]);
   $para=$dat[0]["correo"];
    $titulo    = 'FICHA DE REQUERIMIENTOS PARA SU TESIS EN GRUPO ESCONSULTORES';
$mensaje   = '<img src="https://www.grupoesconsultores.com/public/assets/img/logo-color.png"  width="100px" height="60px" /> <br>Muy buenos días, la presente ficha de requerimiento es adjuntada con el fin de que usted proporcione cierta información necesaria para la realización de su trabajo de investigación. Para observar la mencionada ficha, por favor haga click  <a href="https://www.grupoesconsultores.com/beta/pdf/requerimiento.php?id='.$id_ficha_requerimiento.'">aqui</a>';




$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Cabeceras adicionales

$cabeceras .= 'From: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";
$cabeceras .= 'Cc: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";
$cabeceras .= 'Bcc: GRUPOESCONSULTORES@grupoesconsultores.com' . "\r\n";

mail($para, $titulo, $mensaje, $cabeceras);

}



}

?>