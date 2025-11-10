<div class="panel panel-flat">
<div class="panel-heading">
	
			<button onclick="nuevo()"  class="btn btn-primary legitRipple">Nueva categoria</button>
		
	
	</div>
	<div class="panel-body">
	

	
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr >
			<th>#</th>
			<th>Descripcion</th>
			<th>Observacion</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
		<?php 
		$c=1;
         foreach ($lista as $values) {
         	echo "<tr>".
         	"<td>".$c."</td>".
         	"<td>".$values->descripcion."</td>".
         	"<td>".$values->observacion."</td>".
         	'<td>
             <ul class="icons-list">';?>
			   <li class="text-primary-600"><a onclick="modificar('<?php echo $values->id_categoria; ?>')"  href="#"><i class="icon-pencil7">
			   </i></a></li>

			    <li class="text-danger-600"><a onclick="eliminar('<?php echo $values->id_categoria; ?>')" href="#"><i class="icon-trash"></i></a> </li>
												
			<?php echo '</ul>
       

         	</td>'.
         	"</tr>";
         	$c=$c+1;
         }
		?>
	</tbody>
</table>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/categoria.js"></script>

