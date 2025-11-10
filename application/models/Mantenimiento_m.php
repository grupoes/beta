<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    class Mantenimiento_m extends CI_Model
    {
        public function __construct()
         {
            parent::__construct();

         }
          
          public function lista($tabla)
        {
            $resultado = $this->db->get_where($tabla,array("estado"=>"1"));
            return $resultado->result();

        }

          public function provincia($id)
        {
            
           $resulta=$this->db->query("select * from provincia where estado=1 and id_departamento=".$id);
           return $resulta->result();

        }

          public function distrito($id)
        {
           
           $resulta=$this->db->query("select * from distrito where estado=1 and id_provincia=".$id);
           return $resulta->result();

        }
        public function tipocliente()
        {
           
           $resulta=$this->db->query("select * from tipocliente where estado=1 ");
           return $resulta->result();

        }
         public function universidad()
        {
           
           $resulta=$this->db->query("select * from universidad where estado=1 ");
           return $resulta->result();

        }
        public function insertar($tabla,$datos=array())
        {
          $r=$this->db->insert($tabla,$datos);
        }

        public function lista_uno($tabla,$id,$id1)
        {
             $resultado=$this->db->get_where($tabla,array("estado"=>"1",$id1=>$id));
              return $resultado->row();
        }
        public function actualizar($tabla,$datos=array(),$id,$id1)
        {
            $this->db->where($id1,$id);
            $r=$this->db->update($tabla,$datos);
        }
        public function eliminar($tabla,$id,$id1){
                $datos = array(
                  "estado" => "0"
                 );

                 $this->db->where($id1,$id);
                 $r = $this->db->update($tabla,$datos);

              if ($r)
                {
                    return 1;
                 }
              else
                 {
                    return 0;
                 }

        }



        public function insertar_cliente($data=array(),$data1=array())
        {
           
           $r=$this->db->insert("persona",$data);
           $r=$this->db->insert("cliente",$data1);

        }
        public function universidad_id($data)
        {    
             $resultado="";
            //echo $data;
             $res=$this->db->query("select * from universidad where descripcion='".strtoupper($data)."' and estado=1");
             $respuesta=$res->row();
             
            

             if($respuesta!="")
             {
                 $resultado=$respuesta->id_universidad;

             }
             else
             {    
                $datos=array("descripcion"=>strtoupper($data));
                  
                   $this->db->insert("universidad",$datos);
                   $rest=$this->db->query("select MAX(id_universidad) as 'maximo' from universidad" );
                   $resto=$rest->row();
                 
                   $resultado=(int) $resto->maximo ;
                   $resultado=$resultado+1;
             }
            
             return $resultado;
        }
        public function asesores($idsede)
        {

         $datasesores=$this->db->query("SELECT persona.nombres,persona.apellidos,persona.dni from usuario,trabajador,persona WHERE usuario.usu_estado=1 and usuario.persona=persona.dni and persona.dni=trabajador.dni and (usuario.usu_perfil=2 or usuario.usu_perfil=4)  and usuario.usu_sede=".$idsede);

         return $datasesores->result();

        }
        public function maximo_ficha()
        {
            $max=$this->db->query("select MAX(id_ficha_enfoque) as 'maximo' from ficha_enfoque ");
            $maximo=$max->row();
            return $maximo->maximo;
        }

         public function maximo_subfase()
        {
            $max=$this->db->query("select MAX(id_subfase) as 'maximo' from subfase  ");
            $maximo=$max->row();
            return $maximo->maximo;
        }
        public function existe_cliente($dni)
        {
                 $resultado="";
            //echo $data;
             $res=$this->db->query("select * from persona where dni=".$dni."");
             $respuesta=$res->row();
             if($respuesta!="")
             {
                return 1;
             }
             else
             {  
                 return 0;
             }

        }

        public function traer_cliente($dni)
        {
             $data=$this->db->query("select * from persona,cliente,universidad  where persona.dni=cliente.dni and universidad.id_universidad=cliente.id_universidad and persona.dni=".$dni);
             return $data->row();

        }

        public function lista_distritos($id)
        {
             $data=$this->db->query("select * from distrito where id_distrito=".$id);
             $respuesta=$data->row();
             $lista=$this->db->query("select * from distrito where id_provincia=".$respuesta->id_provincia);

             return  $lista->result();
        }
        public function lista_provincia($id)
         {
              $data=$this->db->query("select * from provincia where id_provincia=".$id);
             $respuesta=$data->row();
             $lista=$this->db->query("select * from provincia where id_departamento=".$respuesta->id_departamento);

             return  $lista->result();
         }

         public function tipo_enfoque()
         {
            $datasesores=$this->db->query("select * from tipo_enfoque");

         return $datasesores->result();
         }

         public function consulta($sql)
         {
                 $datasesores=$this->db->query($sql);

         return $datasesores->result();
         }
          public function consulta1($sql)
         {
                 $this->db->query($sql);

         
         }

          public function consulta2($sql)
         {   $datasesores=$this->db->query($sql);

         return $datasesores->row();

         
         }
          public function consulta3($sql)
         {   $datasesores=$this->db->query($sql);

         return $datasesores->result_array();

         
         }
                 public function tipodise($id)
        {
            
           $resulta=$this->db->query("SELECT diseo_inves.dis_diseo,diseo_inves.dis_observacion,diseo_inves.dis_id FROM diseo_inves where diseo_inves.dis_tipoenfoque=".$id);
           return $resulta->result();

        }
        


    }

?>