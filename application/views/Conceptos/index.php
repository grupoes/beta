<div class="panel panel-flat">
<div class="panel-heading">
<button class="btn btn-primary" type="button" onclick="nuevo()" >
	<i class="fa fa-fire"></i> Nuevo registro
</button>

</div>

	<div class="panel-body">
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr>
			<th class="center">Nro</th>
			<th class="center">Descripcion</th>
			<th class="center">Tipo movimiento</th>
			<th class="center">Accion</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		  $c=0;
			foreach ($lista as $value) { $c++; ?>
				<tr>
					<td class="center"><?php echo $c;?></td>
					<td class="center"><?php echo $value->con_descripcion;?></td>
					<td class="center"><?php echo $value->tipo_movimiento_descripcion;?></td>
					<td class="center">
						<?php 
							if ($value->con_id<=4) { ?>
								<button class="btn btn-primary btn-xs" type="button">Sin accion</button>
							<?php }else{ ?>
								<button class="btn btn-primary btn-xs" type="button" onclick="modificar('<?php echo $value->con_id; ?>')">Modificar</button>
								<button class="btn btn-danger btn-xs" type="button" onclick="confirmar('<?php echo $value->con_id; ?>')">Eliminar</button>
							<?php }
						?>
					</td>
				</tr>
			<?php }
		?>
	</tbody>
</table>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/concepto.js"></script>