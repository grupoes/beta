<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">
	
			
	
	</div>
	<div class="panel-body">
	

<div class="table-responsive">	
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr >
			<th>#</th>
			<th>Nombre y apellido</th>
			<th>Titulo</th>
			<th>Fecha</th>
			<th>Monto</th>
			<th>Accion</th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$c=0;
       foreach ($lista as $key => $value) {
           $c=$c+1;
           $a="'".$value->id_pago."','".$value->nombres." ".$value->apellidos."'";
           echo "<tr>";
           echo "<td>".$c."</td>";
           echo "<td>".$value->nombres." ".$value->apellidos."</td>";
           echo "<td>".$value->titulo_enfoque."</td>";
           echo "<td>".$value->fecha."</td>";
           echo "<td>".$value->monto."</td>";
           echo '<td><a><span onclick="amortizar('.$a.')" class="label label-success">Cobrar</span></a></td>';
           echo "</tr>";
       }
	?>
	
	</tbody>
</table>
</div>
</div>
</div>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/pagos.js"></script>
