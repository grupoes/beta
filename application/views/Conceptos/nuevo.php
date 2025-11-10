<div class="panel panel-flat">
<div class="panel-heading">

	<div class="panel-body">

<form class="form-horizontal" role="form" id="formulario" onsubmit="return guardar()">
	<input type="hidden" name="id" id="id">
	<div class="form-group">
		<label class="col-sm-4 control-label">Descripcion</label>
		<div class="col-md-4">
			<input type="text" class="form-control" id="descripcion" name="descripcion" maxlength="60" required>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-4 control-label">Tipo movimiento</label>
		<div class="col-md-4">
			<select class="form-control" name="tipomovimiento" id="tipomovimiento" required>
				<option value="">Seleccione</option>
				<?php 
					foreach ($tipos as $value) { ?>
						<option value="<?php echo $value->id_tipo_movimiento?>"><?php echo $value->tipo_movimiento_descripcion?></option>
					<?php }
				?>
			</select>
		</div>
	</div>
	<div class="form-group">
		<center>
			<button type="submit" class="btn btn-primary" id="btn_guardar">
				<i class="fa fa-save"></i> Guardar
			</button>
			<button type="button" class="btn btn-danger" onclick="reload_url('conceptos','administracion_caja');">
				Cancelar - Atras
			</button>
		</center>
	</div>
</form>
</div>