<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<div class="form-group">
									<center><h3>Seleccionar cual de opciones desea configurar</h3></center>

										<?php
                                             // print_r($lista);
										 foreach ($lista as $key => $value) {
											# code...
										 ?>
										<div class="radio">
											<label>
											<input type="radio" name="tributo" id="tributo" value="<?php echo $value->id_pdt; ?>" checked="checked">
												<?php echo $value->pdt_descripcion; ?>
											</label>
										</div>

                                      <?php } ?>
									

										
									</div>

									<center><button class="btn btn-primary" onclick="seleccionar()">Ir a configurar</button></center>



		</div>
	</div>
</div>

<script type="text/javascript">
	 function seleccionar()
{
  var id_tributo=$('input:radio[name=tributo]:checked').val();

	
 
   /*$("#datos").modal();
   $("#id_ficha").val(id);*/
   	$.post(base_url+"Declaracion/configurar",{
            "id_tributo":id_tributo
		},function(data){
   $('#cont_sistema').empty().html(data);
	   
          
         });
   
}
</script>