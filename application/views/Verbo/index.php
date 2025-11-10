<div class="panel panel-flat">
<div class="panel-heading">

<div class="panel-heading">
	<button class="btn btn-primary" type="button" onclick="nuevo()" style="z-index:2;margin-bottom: 10px !important; position: absolute;top:10px;">
		<i class="fa fa-fire"></i> Nuevo Verbo
	</button>
</div>
<div class="panel-body">

</div>
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th>Verbo</th>
			<th>Observación</th>
			<th class="text-center">Acción</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		foreach ($lista as $value) { ?>
		<tr>
			<td class="text-center"><?php echo $value->ver_id;?></td>
			<td><?php echo $value->ver_verbo;?></td>
			<td><?php echo $value->ver_observacion;?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li class="text-primary-600"><a href="#"  data-popup="tooltip" title="Editar" onclick="modificar('<?php echo $value->ver_id; ?>')"><i class="icon-pencil7"></i></a></li>
					<li class="text-danger-600"><a href="#"  data-popup="tooltip" title="Eliminar" onclick="eliminar('<?php echo $value->ver_id; ?>')"><i class="icon-trash"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php }
		?>
	</tbody>
</table></div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/verbo.js"></script>