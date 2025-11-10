<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			
		
			<button id="nuevo" class="btn btn-primary legitRipple">Nueva Empresa</button>
	

		</div>
         <?php  $c=1; //print_r($datos);?> 
		<table class="table table-lg invoice-archive" id="table_sistema">
			<thead>
				<tr>
					<th>#</th>
					<th>RUC</th>
					<th>Razon Social</th>
	
					<th class="text-center">acciones</th>
				</tr>
			</thead>
			<tbody>
              <?php
              $c=0;
                 
                  foreach ($datos as $key => $value) {
                     $c++;
                  	 echo "<tr>";
                     echo "<td>".$c."</td>";
                     echo "<td>".$value->ruc_empresa_numero."</td>";
                     echo "<td>".$value->ruc_empresa_razon_social."</td>";
                  
             echo  '<td><center>
             <ul class="icons-list">';?>
              <li  class="text-success-600" ><a title="lista de boletas" onclick="lista('<?php echo $value->ruc_empresa_numero; ?>')"  href="#"><i class=" icon-bookmark4"></i></a></li>
			<li  class="text-success-600" ><a title="registrar de boletas" onclick="registrar('<?php echo $value->ruc_empresa_numero; ?>')"  href="#"><i class="icon-pencil7"></i></a></li>
			<li class="text-primary-600"><a title="Importar de boletas" onclick="subir('<?php echo $value->ruc_empresa_numero; ?>')"  href="#"><i class="icon-upload7"></i></a></li>
		<li class="text-danger-600">  <a title="eliminar de empreas" onclick="eliminar('<?php echo $value->ruc_empresa_numero; ?>')"><i class="icon-trash"></i></a></li>}
    <li class="text-warning-800">
      <a title="configurar declaraciones" onclick="configuracion('<?php echo $value->ruc_empresa_numero; ?>')"><i class="icon-cog7"></i></li>
      <li class="text-success-300" ><a title="declaracion tributaria" onclick="declaracion('<?php echo $value->ruc_empresa_numero; ?>')"><i class=" icon-pencil4"></i></li>
												
			<?php echo '</ul>
       </center>

         	</td>'.
         	"</tr>";
                         echo "</tr>";
                  }

                 
                    $c=$c+1;

               ?>
			</tbody>
		</table>
 </div>
</div>
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Nuevo Contribuyente</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
         <form id="formulario_ruc" method="POST">
           <div class="col-md-6">
             <label class="control-label col-lg-2">RUC:</label><div class="col-lg-10"><input   class="form-control" type="text" name="ruc" maxlength="11" id="ruc">
           </div>
           </div>
           <div class="col-md-6">
               <label class="control-label col-lg-2">Razon Social:</label><div class="col-lg-10"><input   class="form-control" type="text" name="razon" id="razon">
           </div>
           </div>
  </div>
  <div class="row">
  	<h4>Boletas</h4>
  	 <div class="col-md-6">
               <label class="control-label col-lg-2">Clientes varios</label><div class="col-lg-10">
                <input maxlength="8"  class="form-control" type="text" name="varios_b" id="varios_b">
           </div>
           </div>
           <div class="col-md-6">
               <label class="control-label col-lg-2">Anulado</label><div class="col-lg-10">
                <input maxlength="8"  class="form-control" type="text" name="anulado_b" id="anulado_b">
           </div>
           </div>
        
       </div>
       <div class="row">
       	   <h4>Facturas</h4>
  	
           <div class="col-md-6">
               <label class="control-label col-lg-2">Anulado</label><div class="col-lg-10">
                <input  maxlength="11"  class="form-control" type="text" name="anulado_f" id="anulado_f">
           </div>
           </div>
       </div>
  
  
    </form>
        
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="aceptar" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="configurar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">Configuracion de declaraciones</h2>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <input type="hidden" name="ruc_empresa" value="" id="ruc_empresa" >    
      <div class="modal-body" id="data_declaracion">
           
  
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="aceptar_declaracion" class="btn btn-primary" onclick="declara_contribuyente()">Guardar</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript">
  function configuracion(ruc)
  {

     $("#configurar").modal();
     $("#ruc_empresa").val(ruc);
     $.post("<?php echo base_url(); ?>Declaracion/declaracion",{"ruc":ruc},function(data){
      $("#data_declaracion").empty().append(data);

     });
  }
  function declara_contribuyente()
  {
    $("#aceptar_declaracion").attr("disabled",true);  


    $.post("<?php echo base_url();?>Declaracion/guardar_declaracion",
      {"ruc":$("#ruc_empresa").val(),"declaracion[]":JSON.stringify($('input:checkbox[id=declaracion]:checked').serializeArray())},function(data){

           $("#configurar").modal("hide");
           alerta("Configuracion Existosa","gracias");
            $("#aceptar_declaracion").attr("disabled",false);  
    });
  }
	$("#nuevo").click(function()
		{
            $("#crear").modal();


		});
	$("#aceptar").click(function()
		{

			$.post(base_url+"Boletas/guardar_empresa",{"ruc":$("#ruc").val(),"razon":$("#razon").val(),"varios_b":$("#varios_b").val(),
        "anulado_b":$("#anulado_b").val(),"anulado_f":$("#anulado_f").val()},function(data){
               if(data=="1"){
                 alerta1("Registro exitoso","correctamente");
                    $("#crear").modal("hide");
                 setTimeout(function(){  reload_url('Boletas','contabilidad'); }, 800);
               }
               else{
                 alerta2("error","correctamente");


               }
			});
		});
	function eliminar(id)
	{
      	swal({
		title: "Esta seguro?",
		text: "Esto sera eliminado!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Si, eliminar esto!",
		cancelButtonText: "No, Cancelar!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
			$.post(base_url+"Boletas/eliminar",{'id':id},function(data){
				if(data==1){
					swal("Deleted!", "Se Elimino Correctamente", "success");
					alerta("info","Empresa ELIMINADO - Se Eliminó Una empresa");
				}else{
					alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
				}
			
				 reload_url('Boletas','contabilidad');
			});
		}
		else {
			 swal({
                    title: "Cancelado",
                    text: "Tu informacion, no fue eliminada :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
		}
	});
	}

function subir(id)

{
$.post(base_url+"Boletas/subir",{"id":id},function(data){
   $('#cont_sistema').empty().html(data);
  }); 

}


function declaracion(ruc)
{
   $.post(base_url+"Declaracion/registrar_declaracion",{"ruc":ruc},function(data){
   $('#cont_sistema').empty().html(data);
  }); 
}
function lista(ruc)
{
  reload();
   $.post(base_url+"Declaracion/lista_documentos",{"ruc":ruc},function(data){
   $('#cont_sistema').empty().html(data);
  }); 
}


</script>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/boleta.js"></script>
