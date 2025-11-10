<div class="panel panel-flat">
<div class="panel-heading">

<div class="panel-body">
	<?php foreach ($listar as $value) { ?>
	<form id="formulario" onsubmit="return guardarcliente()" enctype="multipart/form-data"  method="post">
		<input type="hidden" name="id" id="id">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h6 class="panel-title">Información del Clientes</h6>
			</div>
			<div class="panel-body">
				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label>Nombre</label>
							<input type="text" value="<?php echo $value->nombres;?>" id="nombre" name="nombre" class="form-control" required>
						</div>
						<div class="col-md-6">
							<label>Apellidos</label>
							<input type="text" value="<?php echo $value->apellidos;?>" id="apellido" name="apellido" class="form-control" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Direccion</label>
							<input type="text" value="<?php echo $value->direccion;?>" id="direccion" name="direccion" class="form-control" required>
						</div>
						<div class="col-md-4">
							<label>Correo </label>
							<input type="text" value="<?php echo $value->correo;?>" id="correo" name="correo" class="form-control" required>
						</div>
						<div class="col-md-4">
							<label>Universidad</label>
							<input type="hidden" name="idun" id="idun" value="<?php echo $value->id_universidad;?>" />
							<select class="select-search" name="universidad" id="universidad" required>							
								<?php 
								foreach ($universidad as $uni) { ?>
								<option value="<?php echo $uni->id_universidad?>"><?php echo $uni->descripcion?></option>
								<?php }
								?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<label>Celular: </label>
							<input type="text" class="form-control" id="celular" value="<?php echo $value->telefono;?>" name="celular" data-mask="999999999" placeholder="Ingrese su Telefono" maxlength="9" required>
						</div>
						<div class="col-md-4">
							<label>D.N.I</label>
							<input type="text" class="form-control" value="<?php echo $value->dni;?>" id="dni" name="dni" data-mask="99999999" onchange="validardni()" placeholder="Ingrese su D.N.I" maxlength="9" required>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group" id="mydatepicker">
								<div class="form-grop"><label>Fecha de Nacimiento: </label><div class="input-group"><span class="input-group-addon"><i class="icon-calendar3"></i></span><input type="text" class="form-control" name="fechanacimiento" id="anytime-month-numeric" value="04/06/2014"></div></div>
							</div>
						</div>
						<div class="col-md-4">
							<label>Tipo Cliente</label>
							<input type="hidden" name="idti" id="idti" value="<?php echo $value->id_tipocliente;?>" />
							<select class="select-search" name="tipocliente" id="tipocliente" required>				
								<?php 
								foreach ($tipocliente as $tipoclientes) { ?>
								<option value="<?php echo $tipoclientes->id_tipocliente?>"><?php echo $tipoclientes->descripcion?></option>
								<?php }
								?>
							</select>
						</div>

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
									<input type="text" value="<?php  foreach ($usuario as $usu) { echo $usu->usu_usuario;}?>" name="usuario" id="usuario" class="form-control" required>
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
									<input type="text" value="<?php  foreach ($usuario as $usu){ echo $usu->usu_clave;}?>" name="clave" id="clave" class="form-control" required>
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
									<input type="hidden" name="linkfoto" id="linkfoto" value="<?php  foreach ($usuario as $usu) { echo $usu->usu_foto;}?>" />
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
				<button type="submit" class="btn btn-primary" id="btn_guardarc">
					<i class="fa fa-save"></i> Guardar
				</button>
				<button type="button" class="btn btn-danger" onclick="reload_url('Usuario_c','seguridad');">
					Cancelar
				</button>
			</center>
		</div>
	</form>
	<?php } ?>
</div>
</div>
</div>
<script type="text/javascript">
	$('.select').select2();
	$('.select-search').select2();
		$("#anytime-month-numeric").datetimepicker({
		 
		// viewMode: 'years',
                format: 'YYYY/MM/DD'
	});
	document.getElementById('files').addEventListener('change', archivo, false);   
	$("#tipocliente option[value="+$("#idti").val()+"]").prop('selected', 'selected').change();
	$("#universidad option[value="+$("#idun").val()+"]").prop('selected', 'selected').change(); 
	if($("#link").val()!=''){
		//alert($("#link").val())
		$("#imag").attr('src', base_url+'public/perfil/'+$("#linkfoto").val());
	}       
	


</script>

