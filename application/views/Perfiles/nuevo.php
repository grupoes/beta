<div class="panel panel-flat">
<div class="panel-heading">
	
<div class="panel-body">
	<form class="form-horizontal" id="formulario" onsubmit="return guardar()">
		<fieldset class="content-group">
			<legend class="text-bold">Registro de Perfiles</legend>
			<input type="hidden" name="id" id="id">
			<div class="form-group">
				<label class="control-label col-lg-2">Perfil</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" id="perfil" name="perfil" placeholder="Nombre de Perfil" maxlength="60">
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-lg-2">Descripcion</label>
				<div class="col-lg-10">
					<textarea rows="5" cols="5" class="form-control" placeholder="Ingrese una descipción" id="descripcion" name="descripcion"></textarea>
				</div>
			</div>
		</fieldset>
		<div class="form-group">
			<center>
				<button type="submit" class="btn btn-primary" id="btn_guardar">
					<i class="fa fa-save"></i> Guardar
				</button>
				<button type="button" class="btn btn-danger" onclick="reload_url('perfiles_c','seguridad');">
					Cancelar
				</button>
			</center>
		</div>
	</form>
</div>
</div>
</div>