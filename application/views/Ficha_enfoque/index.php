<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">
	   <?php if($_SESSION['usuario_perfil']=="5" || $_SESSION['usuario_perfil']=="4" || $_SESSION['usuario_perfil']=="1")
     	
     { ?>
			<button onclick="nuevo()"  class="btn btn-primary legitRipple">Nueva ficha</button>
	   
		<?php }?>
	   <?php if($_SESSION['usuario_perfil']=="5"){?>
<button class="btn btn-sucess">Editar Ficha</button>
        <?php }?>
	</div>
	<div class="panel-body">
<div class="row">
<div class="col-md-12">

<div class="table-responsive">
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr >
			<th width="5%">#</th>
			<th width="25%">Titulo</th>
			<th width="30%">Cliente</th>
      <th width="30%">Carrera</th>
      <th width="5%">Universidad</th>
			<th width="25%">Asesor</th>
			<th width="5%">Estado</th>
			<th width="20%">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php

		$c=1;
		$titulo="";
        $estado="";
        //print_r($lista);
       foreach ($lista as $value) {
                	 if($value->titulo!=""){"<label style='color:red;font-size:10px;'>".$titulo=$value->titulo."</label>";}else{$titulo="<label style='color:red;font-size:10px;'>Falta agregar titulo</label>";}
                	echo "<tr>";
                	echo "<td>".$c."</td>";
                    
                	echo "<td>".$titulo."</td>";
                	echo "<td>".$value->cliente_nombre." ".$value->cliente_apellidos."</td>";
                  echo "<td>".$value->carrera."</td>";
                  echo "<td>".$value->descripcion."</td>";
                	echo "<td>";
                
               $query=$this->db->query("SELECT DISTINCT(trabajador.dni),persona.nombres,persona.apellidos
FROM logproduccion ,ficha_enfoque, produccion,horario_trabajador,trabajador,persona 
WHERE ficha_enfoque.id_ficha_enfoque=produccion.id_ficha_enfoque AND
logproduccion.idproduccion=produccion.id_producion and horario_trabajador.id_horario=logproduccion.idhorario
and trabajador.dni=horario_trabajador.id_trabajador and persona.dni=trabajador.dni and horario_trabajador.idTiempo!=''
and ficha_enfoque.id_ficha_enfoque=".$value->id_ficha_enfoque);

               $cin=count($query->result());
foreach ($query->result() as $key1 => $value1) {
    if($cin==$key1+1){

            echo $value1->nombres." ".$value1->apellidos." ";
    }
         
         else
         {
          echo $value1->nombres." ".$value1->apellidos.",";
         }
    }


         
              if($cin>0){
                echo ",".$value->trabajador_nombre." ".$value->trabajador_apellido;
              }
                else{
                       echo $value->trabajador_nombre." ".$value->trabajador_apellido;
                }


                  echo "</td>";
                      if($value->estado==1){
                          $estado='<span class="label label-danger">Asignado</span>';
                      }
                      if($value->estado==2){
                        $estado='<span class="label label-info">Ficha</span>';
                      }
                      if($value->estado==3){
                        $estado='<span class="label label-success">Asesor</span>';
                      }
                      if($value->estado==4){
                         $estado='<span class="label label-success">Horario</span>';
                      }
                      if($value->estado==5){
                       $estado='<span class="label label-success">Pagos</span>';
                      }
                         if($value->estado==6){
                       $estado='<span class="label label-primary">Produccion</span>';
                      }

                    echo "<td>".$estado."</td>";
                    echo '<td> <ul class="icons-list">';?>
              }
			  


       <?php if($value->ficha_enfoque_estado_observacion==1 and $value->estado==6){ ?>  
                   <li class="text-success-600"><a title="observacion" onclick="observacion('<?php echo $value->id_ficha_enfoque; ?>')"  ><i class="icon-book">
         </i></a></li>  
<?php } else{  ?>  
    <li class="text-primary-600"><a title="modificar y asignar tiempo" onclick="modificar('<?php echo $value->id_ficha_enfoque; ?>')" ><i class="icon-pencil7">
         </i></a></li>
<?php } ?>



            <?php if( $_SESSION['usuario_perfil']==5){?>
			 <li class="text-danger-600"><a title="eliminar" onclick="eliminar('<?php echo $value->id_ficha_enfoque; ?>')" ><i class="icon-trash"></i></a> </li>
								  <?php }   ?>	


                    <?php if($value->estado==6){ ?>  
                   <li class="text-success-600"><a title="ver horas" onclick="lista('<?php echo $value->id_ficha_enfoque; ?>','<?php echo $value->titulo; ?>')"  href="#"><i class=" icon-file-text2">
         </i></a></li>	
<?php }   ?>  

     <?php if($value->estado==6){ ?>  
                   <li class="text-warning-600"><a title="finalizar" onclick="finalizar('<?php echo $value->id_ficha_enfoque; ?>')"  href="#"><i class="  icon-checkmark">
         </i></a></li>  

<?php }   ?>  

			<?php echo "</ul></td>
                    </tr>";
                    $c=$c+1;
 
                }
          

         
		?>
	</tbody>
</table>
</div>
</div>
</div>



</div>
</div>



<div id="modal_full" class="modal fade in" >
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h5 id="titulo1" class="modal-title">Full width modal</h5>Fecha de Inicio:<span id="fecha"></span>
                </div>

                <div class="modal-body">
                <div class="table-responsive">
                   <table class="table"> 
                       <thead>
                         <tr>
                           <th>#</th>
                            <th>trabajador</th>
                             <th>Fecha Inicio</th>
                              <th>Fecha Fin</th>
                              <th>Tiempo</th>
                              <th>Descripcion</th>
                         </tr>
                       </thead>
                       <tbody id="datos">
                         
                       </tbody>
                   </table>
                   </div>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Close</button>
                 
                </div>
              </div>
            </div>
          </div>


<div id="modal_default" class="modal fade in" >
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h5 class="modal-title" id="observacion_texto"></h5>
                </div>

                <div class="modal-body">
                  <form id="formulario">
                    <input type="hidden" name="observacion_id_ficha_enfoque" id="observacion_id_ficha_enfoque">
                  <input type="hidden" name="empiezo" id="empiezo">
                  <input type="hidden" name="fin" id="fin">
                    <div class="row">
                      <div class="col-md-4">

                           <div class="form-group">

                             <label ><b>Tiempo enfoque</b> </label>

                  <div  class="input-group ">

                   <span class="input-group-addon"><i class="icon-watch2"></i></span>

                <input type="text" name="hora" class="form-control anytime-time" id="hora" value="00:00">

                    </div>

                    </div>


                      </div>
                      <div class="col-md-8">
                        
                  <div class="form-group">



                    <label><b>Seleccionar asesor</b></label>

                    <select class="form-control" id="id_trabajador" name="id_trabajador" >

                      <option value="-1">Selecionar tiempo</option>

                    </select>

                  </div>
                      </div>
                    </div>
                  </form>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Cerrar</button>
                 
                </div>
              </div>
            </div>
          </div>


<script type="text/javascript" src="<?php echo base_url();?>public/modulos/ficha_enfoque.js"></script>
<script type="text/javascript">

var valor;
    $(function(){

  $('.anytime-time').datetimepicker({

  format:'LT',

     

        enabledHours: [0,1,2,3],

        stepping: 5

}).on('dp.change',function(event){

   valor=$(this).val();
 
   if(valor=="0:00")
   {
        $('#id_trabajador').empty();

                   $("#id_trabajador").append('<option value="-1">Selecionar tiempo</option>');
   }
                 //  alert(valor);
   else{
    $.post(base_url+'Ficha_enfoque/asesoresListos',{"hora":valor}, function(data) {

                    //console.log(data);

                    //alert(data.empiezo);

                    //alert(data.fin);
                

                    $("#empiezo").val(data.empiezo);

                    $("#fin").val(data.fin)

                   $('#id_trabajador').empty();

                   $("#id_trabajador").append(data.html);

              

              },"json"); 
          } 

  });



}); 

$("#id_trabajador").change(function(){
        var id=$("#id_trabajador").val(); 

     //alert(id);

     var res = id.split("/");

        if (res[1]==0) 

   {

      var id=res[0]; 

     var opcion_seleccionada = $("#id_trabajador option[value="+id+"]").text();

     if(id!="-1")

      {
         alert("error no se puede seleccionar a es este asesor porque tiene el horario lleno");
      }
    }
    else{

         $.post(base_url+"Ficha_enfoque/guardar_observacion",$("#formulario").serialize(),function(data){

                         $("#modal_default").modal("hide");
                        alerta("Se asigno correctamente","espere que el asesor termine de llenar la ficha");
                  setTimeout(function(){   reload_url('Ficha_enfoque','Tesis');}, 800);

               

         

             

         });

    }

});
  function observacion(id)
  {
        $("#modal_default").modal();
        $("#observacion_id_ficha_enfoque").val(id);
        $.post(base_url+"ficha_enfoque/titulo_enfoque",{"id":id},function(data){
              $("#observacion_texto").text("Observacion para:"+data);
        });
       
  }
function lista(id,titulo)
{
 // alert(id);
  $("#titulo1").html(titulo);
  $("#modal_full").modal();
      $.post(base_url+"Ficha_enfoque/vertodo",{'id':id},function(data){
           $("#datos").empty().append(data.datos);
           $("#fecha").empty().append(data.fecha);
        },"json");
}


   function eliminar(id){
  

    swal({
  title: "¿Estas segur que desea eliminar?",
  text: "Una vez eliminado el dato ya nose se podra recuperar",
  type: "warning",
 
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "si,lo deseo",
  closeOnConfirm: false
},
function(){

    $.post(base_url+"Ficha_enfoque/eliminarLista",{'id':id},function(data){
                   swal("Deleted!", "Se Elimino Correctamente", "success");
                  reload_url('Ficha_enfoque','Tesis');
        });

});
  
        
     
}


function finalizar(id){

    swal({
  title: "CONDICIONES Y TERMINOS",
  text: "Usted eligio la opcion de finalizar el desarrollo de la tesis,si acepta esta condicion usted confirmara que la tesis se realizo todo correctamente y ya no necesita los servicios de Grupo ES consultores. Si desea posteriormente hacer algun cambio debera acercarse a la empresa",
  type: "success",
 
  showCancelButton: true,
  confirmButtonColor: "rgb(76, 175, 80)",
  confirmButtonText: "si,lo deseo",
  closeOnConfirm: false
},
function(){

    $.post(base_url+"Ficha_enfoque/finalizar",{'id':id},function(data){
                   swal("FINALIZAR TESIS", "SE FINALIZO CORRECTAMENTE LA TESIS", "success");
                 reload_url('Documentos_c','produccion');
        });

});
}
</script>