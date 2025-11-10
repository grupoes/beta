<div class="panel panel-flat">
<div class="panel-heading">

<div class="panel-body">
	<form id="formulario" onsubmit="return guardar()">

		<legend class="text-bold">Registro de Modulos</legend>
		<input type="hidden" name="id" id="id">
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label>Modulo: </label>
					<input type="text" class="form-control" id="modulo" name="modulo" placeholder="Nombre de Modulo" maxlength="60">
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label>Url: </label>
					<input type="text" class="form-control" id="url" name="url" placeholder="Nombre de la Url" maxlength="60">
				</div>
			</div>

			<div class="col-md-4">
				<div class="form-group">
					<label>Icono </label>
					<input type="text" class="form-control" id="icono" name="icono" placeholder="Nombre del Icono" maxlength="60">
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<label>Modulo Padre</label>
					<div class="input-group">
						<select class="select-search" name="padre" id="padre" required>							
							<option value="">Seleccionar</option>
							<option value="0">Es Modulo Padre</option>
							<?php 
							foreach ($padres as $value) { ?>
							<option value="<?php echo $value->mod_id?>"><?php echo $value->mod_descripcion?></option>
							<?php }
							?>
						</select>
						<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up legitRipple" type="button">+</button></span>
					</div>
					
				</div>
			</div>
			


		</div>	
		<div class="form-group">
			<center>
				<button type="submit" class="btn btn-primary" id="btn_guardar">
					<i class="fa fa-save"></i> Guardar
				</button>
				<button type="button" class="btn btn-danger" onclick="reload_url('Modulo_c','seguridad');">
					Cancelar
				</button>
			</center>
		</div>
	</form>
</div>
</div>
</div>
<script type="text/javascript">
	$('.select-search').select2();
</script>