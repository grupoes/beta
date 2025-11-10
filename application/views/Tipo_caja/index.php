<div class="panel panel-flat">
<div class="panel-heading">
<button class="btn btn-primary" type="button" onclick="nuevo()" >
	<i class="fa fa-fire"></i> Nuevo registro
</button>
</div>
	<div class="panel-body">
	

<table class="table table-striped table-bordered" id="table_sistema">
	<thead>
		<tr>
			<th class="center">Nro</th>
			<th class="center">Descripcion</th>
			
			<th class="center">Accion</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			foreach ($lista as $value) { ?>
				<tr>
					<td class="center"><?php echo $value->id_caja;?></td>
					<td class="center"><?php echo $value->caja_descripcion;?></td>
					
					<td class="center">
						<button class="btn btn-primary btn-xs" type="button" onclick="modificar('<?php echo $value->id_caja; ?>')">Modificar</button>
						<button class="btn btn-danger btn-xs" type="button" onclick="eliminar('<?php echo $value->id_caja; ?>')">Eliminar</button>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/tipo_caja.js"></script>