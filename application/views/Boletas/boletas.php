<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<table id="table_sistema" class="table table-lg invoice-archive" >
				<thead>
					<tr>
						<th>#</th>
						<th>fecha</th>
						<th>Monto</th>
						<th>tipo</th>
						<th>Serie-num</th>
						
						<th>ruc</th>
						<th>accion</th>

					</tr>
				</thead>
				<tbody>
					<?php $c=0;
                     foreach ($lista as $key => $value) { $c=$c+1;	?>
                          <tr>
                          	 <td><?php echo $c; ?></td>
                          	 <td><?php echo $value->comprobante_fecha; ?></td>
                          	 <td id="monto_<?php echo $value->id_comprobante;?>"><?php echo $value->comprobante_venta; ?></td>
                          	 <td><?php echo $value->tipo_comprobante_descripcion; ?></td>
                          	 <td><?php echo $value->comprobante_documento_serie_caracteristicas."-".$value->comprobante_documento_serie_numero; ?></td>
                          	
                           <td><?php echo $value->comprobante_ruc; ?></td>	 
                          	 <td>
                          	 	<center>


                          	 		<ul class="icons-list">
                                        <?php 
                                              	  $datos = explode("/", $value->comprobante_documento_serie_numero);
                                              	  if(count($datos)==2){

                                                       ?>
                                   <li class="text-success-600"> 
                   <a onclick="detalle('<?php echo $value->id_comprobante; ?>','<?php echo $value->comprobante_documento_serie_caracteristicas ?>','<?php echo $datos[0]; ?>','<?php echo $datos[1]; ?>')"><i class="icon-book"></i></a></li>
                                              <?php } ?>
                                           
                          	 			<li class="text-danger-600">  <a onclick="eliminar('<?php echo $value->id_comprobante; ?>')"><i class="icon-trash"></i></a></li>
                          	 	    </ul>
                          	 	</center>

                          	 </td>
                          </tr>
					<?php } ?>
				</tbody>
			</table>
	</div>
</div>
</div>




<div class="modal fade" id="detalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="exampleModalLabel">DETALLE DE BOLETA</h2>
        
      </div>
      <div class="modal-body">
         <div class="row">
         	 <input type="hidden" name="id_comprobante" id="id_comprobante">
         	 <input type="hidden" name="id_boleta" id="id_boleta">
         	 <div class="col-md-12" id="editar">
         	 	<h4 class="col-md-2	" id="serie_numero"></h4>
         	 	<div class="col-md-2">
         	 		<input type="number" class="form-control" name="monto" id="monto" placeholder="monto">
         	 	</div>
         	 	<div class="col-md-4">
         	 		<button class="btn btn-primary" onclick="guardar_boleta()" id="btn_guardar">guardar</button>
         	 		<button class="btn btn-danger" onclick="limpiar()">Cancelar</button>
         	 	</div>
         	 </div>
             <table id="table_sistema" class="table table-lg invoice-archive" >
				<thead>
					<tr>
						<th>#</th>
						<th>fecha</th>
						
						
						<th>Serie</th>
						<th>correlativo</th>
						<th>Monto</th>
						<th>accion</th>

					</tr>
				</thead>
				<tbody id="datos">
                 
			    </tbody>
			</table>

        
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" id="cerrar">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
</div>




<script type="text/javascript">
$("#cerrar").click(function()
	{   
        limpiar();
        $("#detalle").modal("hide");
        setTimeout(function(){   

        	   
    }, 800);
       
     
	});

	$(function()
	{
		$("#editar").hide();
	})
	function editar_boleta(id,monto,boleta)
	{
		$("#editar").show();
		$("#id_boleta").val(id);
		
		$.post("<?php echo base_url();?>Declaracion/cantidad",{"id_boleta":id},function(data){
           $("#monto").val(parseFloat(data));  
           $("#serie_numero").text(boleta);
		$("#monto").focus();

		});
		

	}
	function detalle(id,serie,inicio,fin)
	{
        $("#id_comprobante").val(id);
		$("#detalle").modal({    backdrop: 'static',

    keyboard: false});
		$.post("<?php echo base_url();?>Declaracion/detalle_boleta",{
			"inicio":inicio,
			"fin":fin,
			"serie":serie
		},function(data)
			{
             $("#datos").empty().append(data);
			});

	}
	function limpiar()
	 {
	 	$("#editar").hide();
		$("#id_boleta").val("");
		$("#monto").val("");
		$("#serie_numero").text("");
        $("#btn_guardar").attr("disabled",false);
	 }
	 function guardar_boleta()
	 {
        $("#btn_guardar").attr("disabled",true);
        $.post("<?php echo base_url();?>Declaracion/guardar_boleta",{
			"id_comprobante":$("#id_comprobante").val(),
			"id_boleta":$("#id_boleta").val(),
			"monto":$("#monto").val(),
		},function(data)
			{   
				var id=$("#id_boleta").val();
				var id1=$("#id_comprobante").val();
				alerta1("listo ","Se actualizo correctamente");
                $("#monto"+id).text($("#monto").val());
                     $("#table_sistema").DataTable().destroy();
      
                $("#monto_"+id1).text(data);
                  $("#table_sistema").DataTable({ } );
                limpiar();
			});


	 }

	 function lista1()
{
  reload();
   $.post(base_url+"Declaracion/lista_documentos1",function(data){
   $('#cont_sistema').empty().html(data);
  }); 
}


</script>



















<script type="text/javascript" src="<?php echo base_url();?>public/modulos/boleta.js"></script>