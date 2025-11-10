<?php
	/*if($intervalo=="DIARIO"){
        	$interval = $semanas * 6;
    	}else{
        	if ($intervalo=="SEMANAL") {
            	$interval = $semanas * 1;
        	}else{
            	if ($intervalo=="QUINCENAL") {
                	$interval = $semanas/2;
            	}else{
                	$interval = $semanas/4;
            	}
        	}
    	}
    	*/
    	$interval=$semanas;
	$montocuota = round((($monto_prest)/$interval),2); 
?>
<div class="row">
	<div class="col-md-1"></div>
	<div class="col-md-10">
		<div class="btn-group">
			<button type="button" class="btn btn-info">
		  		Cronograma de pagos : <?php echo $intervalo;?>
		  	</button>
		  	<button type="button" class="btn btn-default">
		  		Monto de pago: S/. <?php echo $monto_prest;?>
		  	</button>
		  	
		  	<button type="button" class="btn btn-danger">
		  		Monto Total: S/. <?php echo round(($monto_prest),2);?>
		  	</button>
		</div>
	</div>
</div> <hr>
<div style="height: 140px; overflow-y: auto;">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th> <center> Nro. Cuota </center> </th>
	            	<th> <center> Fecha Vencimiento </center> </th>
	            	<th> <center> Monto Pagar </center> </th>
			</tr>
		</thead>
		<tbody>
			<?php 
				if($intervalo=="DIARIO"){
			            	$fecha = date('Y-m-d',strtotime('-1 days', strtotime($fecha)));
			        	}else{
			            	if ($intervalo=="SEMANAL") {
			                	$fecha = date('Y-m-d',strtotime('-1 weeks', strtotime($fecha)));
			            	}else{
			                	if ($intervalo=="QUINCENAL") {
			                    		$fecha = date('Y-m-d',strtotime('-15 days', strtotime($fecha)));
			                	}else{
			                    		$fecha = date('Y-m-d',strtotime('-1 months', strtotime($fecha)));
			                	}
			            	}
			        	} 

				for ($i=1; $i <= $interval ; $i++) { 
			        	if($intervalo=="DIARIO"){
			            	$fecha = date('Y-m-d',strtotime('+1 days', strtotime($fecha)));
			        	}else{
			            	if ($intervalo=="SEMANAL") {
			                	$fecha = date('Y-m-d',strtotime('+1 weeks', strtotime($fecha)));
			            	}else{
			                	if ($intervalo=="QUINCENAL") {
			                    		$fecha = date('Y-m-d',strtotime('+15 days', strtotime($fecha)));
			                	}else{
			                    		$fecha = date('Y-m-d',strtotime('+1 months', strtotime($fecha)));
			                	}
			            	}
			        	} 
			        	$valid_fecha = $fecha; $valido = 0;
			        	while ($valido <= 0) {
			        		$valid_dia = strtotime($valid_fecha);
						switch (date('w', $valid_dia)){ 
						    	case 0: $dia="Domingo"; break; 
						    	case 1: $dia="Lunes"; break; 
						    	case 2: $dia="Martes"; break; 
						    	case 3: $dia="Miercoles"; break; 
						    	case 4: $dia="Jueves"; break; 
						    	case 5: $dia="Viernes"; break; 
						    	case 6: $dia="Sabado"; break; 
						}
						if ($dia=="Domingo") {
							$valid_fecha = date('Y-m-d',strtotime('+1 days', strtotime($valid_fecha)));
							if($intervalo=="DIARIO"){
								$fecha = $valid_fecha;
							}
						}else{
							$valido = 1;
						}
			        	} ?>
			        	<tr>
						<td>
							<input type="hidden" name="nrocuotas[]" value="<?php echo $i;?>"> 
							<center> <?php echo $i; ?> </center> 
						</td>
			            	<td> 
			            		<input type="date" class="form-control" name="fechavence[]" id="fechavence[]" value="<?php echo $valid_fecha;?>"> 
			            		<center> <?php //echo $valid_fecha; ?> </center> 
			            	</td>
			            	<td> 
			            		<input type="text" class="form-control" name="montocuota[]" id="fechavence[]" value="<?php echo $montocuota;?>"> 
			            		<center>  <?php //echo "S/.".$montocuota; ?> </center> 
			            	</td>
					</tr>
			    <?php }
			?>
		</tbody>
	</table>
	<input type="hidden" name="total" id="total" value="<?php echo round(($monto_prest),2);?>">
</div>