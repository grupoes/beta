<div class="panel panel-flat">
<div class="panel-heading">

	<div class="panel-heading">

</div>
<form id="form_permisos">
<div class="panel-body">
	<div class="row" >
		<div class="col-md-12" style="float:none; margin: 0 auto !important;">
			<div style="width:285px; padding-left:90px;" class="col-md-3">
				<h3>Busque el Perfil</h3>
			</div>
			<br>
			<div class="col-md-6" style="padding:0 10px 0 0;">
				<select name="perfil" id="perfil" class="combobox form-control" onchange="traer_permisos(this.value)">
					<option value=""></option>
					<?php foreach ($perfiles as $value) { ?>
					<option value="<?php echo $value->per_id ?>"><?php echo $value->per_descripcion;; ?></option>
					<?php } ?>
				</select>

			</div>
			<div class="col-md-2">
				<button type="button" class="btn btn-azure" onclick="enviar_permisos()" >GUARDAR</button>
			</div>
		</div>
	</div>
</div>


<div class="row" >
	<div class="col-md-12">
		<div class="panel-group panel-group-control content-group-lg" >
			<?php 	foreach ($lista_permisos as $value) {?>
			<div class="panel panel-white">
				<div class="panel-heading">
					<h6 class="panel-title">
						<a data-toggle="collapse" href="#collapsible-control-group<?php echo  $value['mod_id']?>"><?php echo $value["mod_descripcion"]?> </a>
					</h6>
				</div>
				<div id="collapsible-control-group<?php echo  $value['mod_id']?>" class="panel-collapse collapse in">
					<div class="panel-body">
					<?php foreach ($value["lista"] as $val) { 
						$check = '';
						foreach ($activos as $v) {
							if ($v['per_modulo']==$val['mod_id']) {
									$check = 'checked'; break;
							}else{
									$check = '';
							}
						} ?>
						<div class="col-sm-5">
							<label style="color: #A4A4A4; font-weight: bold;">
							<input type="checkbox" name="modulos[]" value="<?php echo $val['mod_id']?>" <?php echo $check?> > 
							<i class="<?php echo $val['mod_icono']?>"></i> 
							<?php echo $val["mod_descripcion"]?>
							</label>
						</div>
					<?php } ?>	
					</div>
				</div>
			</div>
			<?php }  ?>
		</div>
	</div>
</div>
</form>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/permisos.js"></script>
