<div class="panel panel-flat">
<div class="panel-heading">

<div class="panel-heading">
	<button class="btn btn-primary" type="button" onclick="nuevo()" style="z-index:2;margin-bottom: 10px !important; position: absolute;top:10px;">
		<i class="fa fa-fire"></i> Nuevo Usuario
	</button>
</div>
<div class="panel-body">

</div>
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr>
			<th class="text-center">D.N.I</th>
			<th>Nombres</th>
			<th>Telefono</th>
			<th>Correo</th>			
			<th>Direccion</th>
			<th>Rol</th>
			<th class="text-center">Acciones</th>
		</tr>
	</thead>
	<tbody>
		<?php 
	//	print_r($listar);
		foreach ($listar as $value) { ?>
		<tr>
			<td class="text-center"><?php echo $value->dni;?></td>
			<td><?php echo $value->nombres.' '.$value->apellidos;?></td>
			<td><?php echo $value->telefono;?></td>
			<td><?php echo $value->correo;?></td>
			<td><?php echo $value->direccion;?></td>
			<td><?php echo $value->per_descripcion;?></td>
			<td class="text-center">
				<ul class="icons-list">
					<li class="text-primary-600"><a href="#"  data-popup="tooltip" title="Editar" onclick="modificar('<?php echo $value->dni;?>','<?php echo $value->per_descripcion ?>')"><i class="icon-pencil7"></i></a></li>
					<li class="text-danger-600"><a href="#"  data-popup="tooltip" title="Eliminar" onclick="eliminar('<?php echo $value->dni; ?>')"><i class="icon-trash"></i></a></li>
				</ul>
			</td>
		</tr>
		<?php }
		?>
	</tbody>
</table>
</div>
</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/usuario.js"></script>