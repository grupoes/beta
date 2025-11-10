<div class="panel panel-flat">
<div class="panel-heading">

<div class="panel-body">
	<form id="formulario" onsubmit="return guardar()" enctype="multipart/form-data"  method="post">
		<input type="hidden" name="id" id="id">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Información del Trabajador</h6>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Nombre</label>
							<input type="text" value="" id="nombre" name="nombre" class="form-control" required>
						</div>
						<div class="col-md-6">
							<label>Apellidos</label>
							<input type="text" value="" id="apellido" name="apellido" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Direccion</label>
							<input type="text" value="" id="direccion" name="direccion" class="form-control" required>
						</div>
						<div class="col-md-4">
							<label>Correo </label>
							<input type="text" value="" id="correo" name="correo" class="form-control" required>
						</div>
						<div class="col-md-4">
							<label>Sede</label>
							<select class="select-search" name="sede" id="sede" required>							
								<?php 
								foreach ($sede as $value) { ?>
								<option value="<?php echo $value->id_sede?>"><?php echo $value->descripcion?></option>
								<?php }
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Numero de Cuenta: </label>
							<input type="text" class="form-control" id="ncuenta" name="ncuenta" placeholder="Ingrese N° de cuenta" required>
						</div>
						<div class="col-md-4">
							<label>Celular: </label>
							<input type="text" class="form-control" id="celular" name="celular"  placeholder="Ingrese su Telefono" maxlength="9" required>
						</div>
						<div class="col-md-4">
							<label>D.N.I</label>
							<input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese su D.N.I" maxlength="8" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group" id="mydatepicker">
								<div class="form-grop"><label>Fecha de Nacimiento: </label><div class="input-group"><span class="input-group-addon"><i class="icon-calendar3"></i></span><input type="text" class="form-control" name="fechanacimiento" id="anytime-month-numeric" value="2016/02/02"></div></div>
							</div>
						</div>

						<div class="col-md-4">
							<label>Perfil</label>
							<select class="select-search" name="perfil" id="perfil" required>							
								<?php 
								foreach ($perfiles as $value) { ?>
								<option value="<?php echo $value->per_id?>"><?php echo $value->per_descripcion?></option>
								<?php }
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-4 es" >
						<label>Especialidad</label>
						<select multiple="multiple" id="especialidad[]" name="especialidad[]" class="select" >
							<?php 
							foreach ($especialidad as $value) { ?>
							<option value="<?php echo $value->id_especialidad?>"><?php echo $value->descripcion?></option>
							<?php }
							?>
						</select>
					</div>	
				</div>
			</div>
		</div>
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Registro Usuario</h6>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>

			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-12">
								<label>Usuario</label>
								<div class="input-group">
									<input type="text" value="" name="usuario" id="usuario" class="form-control" required>
									<span class="input-group-btn" id="activar"><button class="btn btn-default bootstrap-touchspin-up legitRipple" onclick="agregar(1)" type="button">+</button></span>
									<span class="input-group-btn" style='display:none;' id="desactivar"><button class="btn btn-default bootstrap-touchspin-up legitRipple" onclick="quitar(1)" type="button">-</button></span>
								</div>
							</div>
							<div class="col-md-12">
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							</div>
							<div class="col-md-12">
								<label>Contraseña</label>
								<div class="input-group">
									<input type="text" value="" name="clave" id="clave" class="form-control" required>
									<span class="input-group-btn" id="activar"><button class="btn btn-default bootstrap-touchspin-up legitRipple" onclick="agregar(2)" type="button">+</button></span>
									<span class="input-group-btn" style='display:none;' id="desactivar"><button class="btn btn-default bootstrap-touchspin-up legitRipple" onclick="quitar(2)" type="button">-</button></span>
								</div>
							</div>
						</div>		
						<div class="col-md-1"></div>				
						<div class="col-md-3">
							<div class="thumbnail">
								<input type="hidden" name="nombre_archivo" id="nombre_archivo" />
								<input type="hidden" name="valor" id="valor" value="0" />
								<input type="file" id="files" name="files" onchange="ValidarImagen(this);" />
								<div class="thumb thumb-rounded thumb-slide">
									<img id="imag" src="<?php echo base_url();?>public/assets/images/placeholder.jpg" alt="" >
									<output id="list"></output>
									<div class="caption">
										<span>
											<a onclick="xd()" class="btn bg-success-400 btn-icon btn-xs" data-popup="lightbox"><i class="icon-plus2"></i></a>
											<a href="user_pages_profile.html" class="btn bg-success-400 btn-icon btn-xs"><i class="icon-link"></i></a>
										</span>
									</div>
								</div>
							</div>
						</div>

					</div>
					<div class="row">

					</div>
				</div>

				<div class="form-group">
					<div class="row">
					</div>
				</div>
			</div>
		</div>

		<div class="form-group">
			<center>
				<button type="submit" class="btn btn-primary" id="btn_guardar">
					<i class="fa fa-save"></i> Guardar
				</button>
				<button type="button" class="btn btn-danger" onclick="reload_url('Usuario_c','seguridad');">
					Cancelar
				</button>
			</center>
		</div>
	</form>
</div>
</div>
</div>
<script type="text/javascript">
  $(function() {
    $(".es").hide();
  });
	$('.select').select2();
	$('.select-search').select2();
	$("#anytime-month-numeric").datetimepicker({
		 
		// viewMode: 'years',
                format: 'YYYY/MM/DD'
	});
	document.getElementById('files').addEventListener('change', archivo, false);   

	$("#perfil").change(function(event) {
		
		if($("#perfil").val()=="2"){
         $(".es").show();
		}
		else{
			   $(".es").hide();
		}
	});
</script>

