<div class="panel panel-flat">
<div class="panel-heading">
	
</div>
<div class="panel-body">




<?php foreach ($sede as $key => $value) {
	# code...
 ?>

   <?php 

       $hingresosf=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=1 and movimiento.mov_estado = 1 and sede_caja.id_caja=1 and sede_caja.id_sede=".$value->id_sede)->result_array();
      if ($hingresosf[0]["monto"]=="") {
			$hingresosf=0.00;
		}else{
			$hingresosf = $hingresosf[0]["monto"];
		}


	$hegresosf=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=2 and sede_caja.id_caja=1 and movimiento.mov_estado = 1 and sede_caja.id_sede=".$value->id_sede)->result_array();
		if ($hegresosf[0]["monto"]=="") {
			$hegresosf=0.00;
		}else{
			$hegresosf = $hegresosf[0]["monto"];
		}

		$hingresosv=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=1 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and sede_caja.id_sede=".$value->id_sede)->result_array();
		if ($hingresosv[0]["monto"]=="") {
			$hingresosv=0.00;
		}else{
			$hingresosv = $hingresosv[0]["monto"];
		}

		$hegresosv=$this->db->query("SELECT SUM(movimiento.mov_monto) as monto from sede_caja,sesion_caja,movimiento,concepto 
			where sede_caja.id_sede_caja=sesion_caja.id_sede_caja and
			sesion_caja.id_sesion_caja=movimiento.id_sesion_caja and movimiento.mov_concepto=concepto.con_id AND
			concepto.id_tipo_movimiento=2 and sede_caja.id_caja=2 and movimiento.mov_estado = 1 and sede_caja.id_sede=".$value->id_sede)->result_array();
		if ($hegresosv[0]["monto"]=="") {
			$hegresosv=0.00;
		}else{
			$hegresosv = $hegresosv[0]["monto"];
		}






   ?>
      
	<div class="col-sm-6">

	  	<div class="panel panel-primary">

		  	<div class="panel-heading">

		    		<h3 class="panel-title">Caja Grupo ESconsultores (<?php echo $value->descripcion; ?>)</h3>

		  	</div>

		  	<div class="panel-body">

		    		<h4 class="lead">Estado de la caja Grupo ESconsultores</h4>

		    		<ul class="list-group">

				     	<li class="list-group-item">

				        	<span class="badge badge-primary">S/. <?php echo  round($hingresosf,2); ?></span>

				        	<i class="fa fa-exchange"></i> Total Ingresos Caja Fisica

				     	</li>

				     <li class="list-group-item">

				        	<span class="badge badge-danger">S/. <?php echo  round($hegresosf,2);?></span>

				        	<i class="fa fa-exchange"></i> Total Egresos Caja Fisica

				     	</li>
				     	<li class="list-group-item">

				        	<span class="badge badge-success">S/. <?php echo  round(($hingresosf-$hegresosf),2);?></span>

				        	<b><i class="fa fa-exchange"></i> Utilidades Caja Fisica</b>

				     	</li>
				     	<li class="list-group-item">

				        	<span class="badge badge-primary">S/. <?php echo  round($hingresosv,2);?></span>

				        	<i class="fa fa-exchange"></i> Total Ingreso Caja Virtual

				     	</li>
				     	<li class="list-group-item">

				        	<span class="badge badge-danger">S/. <?php echo  round($hegresosv,2);?></span>

				        	<i class="fa fa-exchange"></i> Total Egresos Cajal Virtual

				     	</li>
				     	<li class="list-group-item">

				        	<span class="badge badge-success">S/. <?php echo round(($hingresosv-$hegresosv),2);?></span>

				        	<b><i class="fa fa-exchange"></i> Utilidades Caja Virtual</b>

				     	</li>

				     	<li class="list-group-item">

				        	<span class="badge badge-success">S/. <?php echo  round(($hingresosf+$hingresosv)-($hegresosf+$hegresosv));?> Soles</span>

				        	<b> <i class="fa fa-money"></i> Saldo en Caja </b>

				     	</li>

				</ul>

		  	</div>

		</div>

	</div>


<?php } ?>











</div>
</div>