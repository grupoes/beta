<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">
	<h4>MONTO EN CAJA:<b id="monto_texto">0</b></h3>
</div>
 	<div class="panel-body">
<form class="form-horizontal" role="form" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="tipomovi" id="tipomovi">
	<div class="form-group">
		<label class="col-sm-2 control-label">Concepto caja</label>
		<div class="col-md-3">
			<select class="form-control" name="concepto" id="concepto" required>
				<option value="">Seleccione</option>
				<?php 
					foreach ($conceptos as $value) { ?>
						<option value="<?php echo $value->con_id?>"><?php echo $value->con_descripcion?></option>
					<?php }
				?>
			</select>
		</div>
		<label class="col-sm-2 control-label">Forma pago</label>
		<div class="col-md-2">
			<select class="form-control" name="formapago" id="formapago" required>
				<?php 
					foreach ($formapagos as $value) { ?>
						<option value="<?php echo $value->for_id?>"><?php echo $value->for_descripcion?></option>
					<?php }
				?>
			</select>
		</div>
		<label class="col-sm-1 control-label">Caja</label>
		<div class="col-md-2">
			<select class="form-control" name="caja" id="caja" required>
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
			<input type="number" class="form-control" step="0.01" id="monto" name="monto" required>
		</div>
	</div>
	<div class="row">
	<label class="col-sm-2 control-label">Comprobante:</label>
		<div class="col-md-3">
			<select class="form-control" name="id_tipo_comprobante" id="id_tipo_comprobante" required>
				<option value="">Seleccione</option>
				<?php 
					foreach ($tipo_comprobante as $value) {
					 ?>
						<option value="<?php echo $value->id_tipo_comprobante?>"><?php echo $value->tipo_comprobante_descripcion?></option>
					<?php }
				?>
			</select>
		</div>

		<div class="col-md-2">
			<input type="text"  class="form-control"  id="descripcion_comprobante" name="descripcion_comprobante" placeholder="descripcion Comprobante">
		</div>
	</div>
<br>
	<div class="form-group">
		<center>
			<button type="submit" class="btn btn-primary" id="btn_guardar">
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
	$("#caja").change(function()
		{
             var id_caja=$(this).val();
             if(id_caja!=""){
             $.post(base_url+"movimiento/saldo_caja",{"id_caja":id_caja},function(data){
                   $("#monto_texto").text(data);
                   monto=parseFloat(data);
                   if(parseFloat($("#monto").val())>monto)
                   {
                   	//alert("hola");
                     if($("#tipomovi").val()==2)
                     {
                       $("#btn_guardar").attr("disabled",true);
                     }
                   }
                   else
                   {
                   	 $("#btn_guardar").attr("disabled",false);
                   }

             });
             }
             else{
             	 $("#monto_texto").text("0");
                   monto=parseFloat(0);

             }

		});

	$("#monto").keyup(function(){
		if($("#tipomovi").val()==2){
          if(parseFloat($("#monto").val())>monto){
              $("#btn_guardar").attr("disabled",true);
          }
          	else{
              $("#btn_guardar").attr("disabled",false);
          	}
          }
	});
</script>