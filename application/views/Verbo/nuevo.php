<div class="panel panel-flat">
	<div class="panel-heading">
		<?php if(isset($data)){
			if(is_object($data)) {
				$art_id=$data->art_id;
				$descripcion=$data->art_articulo;
				$observacion=$data->art_observacion;
			}
		}
		else{
			$art_id="";
			$descripcion="";
			$observacion="";
		} ?>
		<div class="panel-body">
			<form id="formulario" onsubmit="return guardar()">

				<legend class="text-bold">Registro de Verbo</legend>
				<input type="hidden" name="id" id="id">
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Verbo: </label>
							<input type="text" class="form-control" id="verbo" name="verbo" placeholder="Nombre de Modulo" maxlength="60" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Pal1: </label>
							<input type="text" class="form-control" id="pal1" name="pal1" placeholder="Nombre de Modulo" maxlength="60">
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Pal2: </label>
							<input type="text" class="form-control" id="pal2" name="pal2" placeholder="Nombre de Modulo" maxlength="60">
						</div>
					</div>
				</div>	
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>Tipo de Verbo</label>
							<div class="input-group">
								<select class="select-search" multiple="multiple" name="tipoverbo[]" id="tipoverbo[]" required>							
									<option value="">Seleccionar</option>
									<?php 
									foreach ($padres as $value) { ?>
									<option value="<?php echo $value->tiv_id?>"><?php echo $value->tiv_tipverbo?></option>
									<?php }
									?>
								</select>
								<span class="input-group-btn"><button class="btn btn-default bootstrap-touchspin-up legitRipple" type="button">+</button></span>
							</div>
							
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="">Observacion</label>

							<textarea rows="3 	" cols="5" class="form-control" name="observacion" id="observacion"><?php echo $observacion ?></textarea>

						</div>
					</div>
				</div>
				<div class="form-group">
					<center>
						<button type="submit" class="btn btn-primary" id="btn_guardar">
							<i class="fa fa-save"></i> Guardar
						</button>
						<button type="button" class="btn btn-danger" onclick="reload_url('Verbo','mantenimiento');">
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