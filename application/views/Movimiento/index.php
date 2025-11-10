<div  class=" panel panel-flat "  >
	<div class="panel-heading" id="cuerpo">
		<button class="btn btn-primary" type="button" onclick="nuevo(1)" >
			<i class="fa fa-fire"></i> Nuevo Ingreso
		</button>
		<button class="btn btn-danger" type="button" onclick="nuevo(2)" >
			<i class="fa fa-fire"></i> Nuevo Egreso
		</button>	
		<button class="btn btn-success" type="button" onclick="transferencia(1)" >
			<i class="fa fa-fire"></i> Transferencia
		</button>	
		
	</div>
	<div class="panel-body">


		<div class="table-responsive">	
			<table class="table table-striped table-bordered" id="table_sistema">
				<thead>
					<tr>
						<th class="center">#</th>					
						<th class="center">Caja</th>
						<th class="center">Tipo</th>
						<th class="center">Concepto</th>						
						<th class="center">Monto</th>
						<th class="center">Descripcion</th>
						<th class="center">Accion</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$c=0;
					foreach ($lista as $value) { $c++; ?>
					<tr>
						<td class="center"><?php echo $c;?></td>
						<td class="center"><?php echo $value->caja_descripcion;?></td>
						<td class="center"><?php echo $value->tipo_movimiento_descripcion?></td>
						<td class="center"><?php echo $value->con_descripcion;?></td>
						<td class="center"><?php echo $value->mov_monto;?></td>
						<td class="center"><?php echo $value->mov_descripcion;?></td>
						<td class="center">
							<button class="btn btn-danger btn-xs" type="button" onclick="confirmar('<?php echo $value->mov_id; ?>')"><i class="fa fa-exchange"></i> Extornar</button>
						</td>
					</tr>
					<?php }
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal fade in" id="confirmar" tabindex="-1" role="dialog">

	<div class="modal-dialog modal-sm">

	 	<div class="modal-content">

		   	<div class="modal-header" align="center">

		     		<h4 class="modal-title" style="font-weight: bold;">

		     			<i class="fa fa-comments-o"></i> Confirmar Extornación

		     		</h4>

		   	</div>

		   	<div class="modal-body" align="center">

		   		<div class="alert alert-success">

					<strong class="default"> ATENCION ADMINISTRADOR:</strong> 

				</div>

		   		<h4>

		   			<b>Seguro que desea extornar este movimiento?</b>

		   		</h4> <br>

		   		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

	        		<button type="button" class="btn btn-primary" id="btn_extornar" onclick="confirmarextornar()">

	        			Si, Extornar

	        		</button>

		   	</div>

	 	</div>

	</div>

</div>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/movimiento.js"></script>