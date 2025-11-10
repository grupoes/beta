<?php $total = 0; $totalpagado = 0;
	foreach ($cuotas as $value) { 
		$total = $total + $value["cuo_montocuota"];
		$totalpagado = $totalpagado + $value["cuo_montopagado"];
		if (($value["cuo_montocuota"] - $value["cuo_montopagado"])==0) {
			$monto = $value["cuo_montocuota"];
		}else{
			$monto = $value["cuo_montocuota"] - $value["cuo_montopagado"];
		}
	}
?>
<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">
	
			
	
	</div>
	<div class="panel-body">
<form class="form-horizontal" id="form_amortizacion">
	<input type="hidden" name="cliente" id="cliente" value="<?php echo $cliente; ?>">
	<div class="form-group">
		    <label class="col-sm-1 control-label">
		     Caja
			</label>
			<div class="col-sm-2">
		   <select id="id_caja" name="id_caja" class="form-control" required="true">  
		   	  <option value="">Seleccionar</option>
              <?php 
              foreach ($caja as $key => $value) {
                   echo "<option value=".$value->id_caja.">".$value->caja_descripcion."</option>";
              }
              ?>
		   </select>
              </div>

	
				
	    	<div class="col-sm-2">
	        	<input type="date" class="form-control" id="fechapago" name="fechapago" value="<?php echo date('Y-m-d')?>" max="<?php echo date('Y-m-d')?>">
	    	</div>
	    	<label class="col-sm-1 control-label">S/.Monto</label>
	    	<div class="col-sm-2">
	        	<input type="number" class="form-control" id="monto" name="monto" placeholder="S/. Monto" required value="<?php echo $monto; ?>">
	        	<input type="hidden" name="montototal" id="montototal" value="<?php echo $total-$totalpagado; ?>">
	        	<input type="hidden" name="idprestamo" id="idprestamo">
	    	</div>

 <label class="col-sm-2 control-label">
		     Forma de pago
			</label>
			<div class="col-sm-2">
		   <select id="id_forma_pago" name="id_forma_pago" class="form-control" required="true">  
		   	  
              <?php 
              foreach ($formapagos as $key => $value) {
                   echo "<option value=".$value->for_id.">".$value->for_descripcion."</option>";
              }
              ?>
		   </select>
              </div>

 <label class="col-sm-2 control-label">
		     Tipo de Comprobante
			</label>
			<div class="col-sm-2">
		   <select id="id_tipo_comprobante" name="id_tipo_comprobante" class="form-control" required="true">  
		   	  
              <?php 
              foreach ($tipo_comprobante as $key => $value) {
                   echo "<option value=".$value->id_tipo_comprobante.">".$value->tipo_comprobante_descripcion."</option>";
              }
              ?>
		   </select>
              </div>

<label class="col-sm-2 control-label">
			Nº Comprobante:
			</label>
			<div class="col-sm-2">
			<input type="text" name="codigo" id="codigo" class=" form-control"/>
              </div>




	    	
	   
	</div>
	<div class="row">
		 <div class="col-md-6">
			<div class="btn-group">
				<button type="button" class="btn btn-default">
			  		S/. Cobrado: <?php echo $totalpagado;?>
			  	</button>
			  	<button type="button" class="btn btn-default">
			  		S/. Restante: <?php echo $total-$totalpagado;?>
			  	</button>
			  	<button type="button" class="btn btn-primary">
			  		S/. Total: <?php echo $total;?>
			  	</button>
			</div>
		</div>
	</div>
	<br><br>
	<div class="row">
		<center>	
	        	<button type="button" class="btn btn-success" onclick="confirm_cobro()">Cobrar</button>
	        	<button type="button" class="btn btn-danger" onclick="reload_url('Pagos','tesis')">
				Cancelar
			</button>
	    	</center>
	</div>
	<br>
	<div style="height: 400px; overflow-y: auto;">
		<table class="table table-bordered">
			<thead>
				<tr class="bg-blue">
					<th class="center">Nro. Cuota</th>
		            	<th class="center">F. Vence</th>
		            	<th class="center">F. Pago</th>
		            	<th class="center">Monto Cuota</th>
		            	<th class="center">Monto Cancelado</th>
		            	<th class="center">Monto Restante</th>
		            	<th class="center">Estado</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($cuotas as $value) { ?>
						<tr>
							<td><?php echo $value["cuo_nrocuota"]; ?></td>
							<td><?php echo $value["cuo_fechavence"]; ?></td>
							<td><?php echo $value["cuo_fechacancelado"]; ?></td>
							<td><?php echo $value["cuo_montocuota"]; ?></td>
							<td><?php echo $value["cuo_montopagado"]; ?></td>
							<td><?php echo ($value["cuo_montocuota"] - $value["cuo_montopagado"]); ?></td>
							<td>
								<?php 
									if ($value["cuo_estado"]==1) 
									{
										echo '<span class="label label-danger">Pendiente</span>';
									}else{
										echo '<span class="label label-primary">Cancelado</span>';
									}
								?>
							</td>
						</tr>
					<?php }
				?>
			</tbody>
		</table>
	</div>
	</form>
	</div>
</div>


<div class="modal fade in" id="confirmargeneral" tabindex="-1" role="dialog">
		   	<div class="modal-dialog modal-sm">
			    	<div class="modal-content">
			      	<div class="modal-header" align="center">
			        		<h4 class="modal-title" id="titleconfirm"></h4>
			        		<h5>
			        			<span class="label label-danger" style="font-size: 13px;" id="contenconfirm"></span>
			        		</h5>
			        		<button type="button" class="btn btn-danger" data-dismiss="modal" >Cancelar</button>
			        		<button type="button" class="btn btn-primary" id="btn_confirm" data-dismiss="modal" onclick="confirmar()">
			        			Si, Continuar
			        		</button>
			      	</div>
			    	</div>
		  	</div>
		</div>
