<div  class=" panel panel-flat "  >
	<div class="panel-heading" id="cuerpo">
		<h4>MONTO EN CAJA:<b id="monto_texto">0</b></h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal" role="form" id="formulario" onsubmit="return transferir()">
				<input type="hidden" name="tipomovi" id="tipomovi">
				<div class="form-group">
					<label class="col-sm-2 control-label">Origen</label>
					<div class="col-md-3">
						<select class="form-control" name="origen" id="origen" required>
							<option value="">Seleccione</option>
							<?php 
							foreach ($caja as $value) {
								?>
								<option value="<?php echo $value->id_caja?>"><?php echo $value->caja_descripcion?></option>
								<?php }
								?>
							</select>
						</div>
						<label class="col-sm-2 control-label">Destino</label>
						<div class="col-md-3">
							<select class="form-control" name="destino" id="destino" >
								<option value="">Seleccione</option>
								<?php 
								foreach ($caja as $value) {
									?>
									<option value="<?php echo $value->id_caja?>"><?php echo $value->caja_descripcion?></option>
									<?php }
									?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">Descripcion</label>
							<div class="col-md-3">
								<input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="100">
							</div>
							<label class="col-sm-2 control-label">S/. Monto </label>
							<div class="col-md-2">
								<input type="number" step="0.01"  class="form-control" id="monto" name="monto" required>
							</div>
							
						</div>
						<div class="row">
							<label class="col-md-2">Descrip. Comprobante.</label>
							<div class="col-md-3">
								<input type="text" name="descripcion_comprobante" id="descripcion_comprobante" class="form-control">
							</div>
						</div>
 
						<div class="form-group">
							<br>
							<center>
								<button type="submit" class="btn btn-primary" id="btn_transferir">
									<i class="fa fa-save"></i> Guardar
								</button>
								<button type="button" class="btn btn-danger" onclick="reload_url('movimiento','caja');">
									Cancelar - Atras
								</button>
							</center>
						</div>
					</form>
				</div>
			</div>


			<script type="text/javascript">
				var monto=0;
				$("#origen").change(function()
				{	
					var id_caja=$(this).val();
					if(id_caja==1){
						$("#destino").val("2");
					}else{
						$("#destino").val("1");
					}


					if(id_caja!=""){
						$.post(base_url+"movimiento/saldo_caja",{"id_caja":id_caja},function(data){
							$("#monto_texto").text(data);
							monto=parseFloat(data);
							if(parseFloat($("#monto").val())>monto)
							{
                   	//alert("hola");
                   	if($("#tipomovi").val()==2)
                   	{
                   		$("#btn_transferir").attr("disabled",true);
                   	}
                   }
                   else
                   {
                   	$("#btn_transferir").attr("disabled",false);
                   }

               });
					}
					else{
						$("#monto_texto").text("0");
						monto=parseFloat(0);

					}

				});

				$("#monto").keyup(function(){

					if(parseFloat($("#monto").val())>monto){
						$("#btn_transferir").attr("disabled",true);
					}
					else{
						$("#btn_transferir").attr("disabled",false);
					}
					
				});
			</script>