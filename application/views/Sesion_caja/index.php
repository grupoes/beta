<div class="panel panel-flat">
<div class="panel-heading">
	
</div>
<div class="panel-body">
		<div class="col-sm-6">

	  	<div class="panel panel-danger">

		  	<div class="panel-heading">

		    		<h3 class="panel-title">Estado de la caja hoy</h3>

		  	</div>

		  	<div class="panel-body">

		  		<div class="row">

		  			<?php 

		  				if ($estado_caja==1) { ?>

		  					

					  		<div class="col-md-12">

					  			<h4 class="lead">Usted no tiene permiso de abrir caja</h4>

					  		</div>

		  				<?php } 

		  				if ($estado_caja==2) { ?>

		  				<div class="col-md-4">
                                   <h4>
					  			<button class=" btn btn-danger" type="button" id="btn_apertura" onclick="confirmarapertura()">

									<i class="fa fa-money"></i> Abrir caja hoy

								</button>
                                </h4>
					  		</div>

					  		

		  				<?php } 
	if ($estado_caja==3) { ?>
		  				<div class="col-md-4">

					  			<button class="btn btn-danger" type="button" onclick="confirmarcierre()">

									<i class="fa fa-money"></i> Cerrar caja hoy

								</button>

					  		</div>

					  		<div class="col-md-8">

					  			<h4 class="lead"> Montos antes del cierre de caja</h4>

					  		</div>
       <?php } ?>

<?php if ($estado_caja==4) { ?>

		  					

					  		<div class="col-md-12">

					  			<h4 class="lead">Usted podra abrir mañana la caja</h4>

					  		</div>

		  				<?php } ?>

		  		</div>

				

		    		<ul class="list-group">

				     	<li class="list-group-item">

				        	<span class="badge badge-primary">S/. <?php echo $ingresosf; ?></span>

				        	<i class="fa fa-exchange"></i>  Ingresos Caja Fisica

				     	</li>

				     <li class="list-group-item">

				        	<span class="badge badge-danger">S/. <?php echo $egresosf; ?></span>

				        	<i class="fa fa-exchange"></i>  Egresos Caja Fisica

				     	</li>
				     	<li class="list-group-item">

				        	<span class="badge badge-success">S/. <?php echo ($ingresosf-$egresosf); ?></span>

				        	<b><i class="fa fa-exchange"></i>  Utilidad Caja Fisica </b>

				     	</li>

				     	   <li class="list-group-item">

				        	<span class="badge badge-primary">S/. <?php echo $ingresosv; ?></span>

				        	<i class="fa fa-exchange"></i>  Ingresos Caja Virtual

				     	</li>
				     	   <li class="list-group-item">

				        	<span class="badge badge-danger">S/. <?php echo $egresosv; ?></span>

				        	<i class="fa fa-exchange"></i>  Egresos Caja Virtual

				     	</li>
				     	<li class="list-group-item">

				        	<span class="badge badge-success">S/. <?php echo ($ingresosv-$egresosv); ?></span>

				        	<b><i class="fa fa-exchange"></i>  Utilidad Caja Virtual</b>

				     	</li>

				     	<li class="list-group-item">

				        	<span class="badge badge-success">S/. <?php echo ($ingresosf+$ingresosv)-($egresosf+$egresosv);?> Soles</span>

				        	<b> <i class="fa fa-money"></i> Utilidad Hoy </b>

				     	</li>

				</ul>

		  	</div>

		</div>

	</div>


	<div class="col-sm-6">

	  	<div class="panel panel-primary">

		  	<div class="panel-heading">

		    		<h3 class="panel-title">Caja Grupo ESconsultores (<?php echo $_SESSION["sede"] ?>)</h3>

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
	</div>
</div>


<div class="modal fade in" id="confirmarcierre" tabindex="-1" role="dialog">

	<div class="modal-dialog modal-sm">

	 	<div class="modal-content">

		   	<div class="modal-header" align="center">

		     		<h4 class="modal-title" style="font-weight: bold;">

		     			<i class="fa fa-comments-o"></i> Confirmar cierre de caja

		     		</h4>

		   	</div>

		   	<div class="modal-body" align="center">

		   		<div class="alert alert-success">

					<strong class="default"> ATENCION ADMINISTRADOR:</strong> 

					Compruebe que los montos de cada empleado se an entregado correctamente <br>

					<strong class="default">NORMALMENTE LOS CIERRES DE CAJA SON A LAS 10 PM</strong>

				</div>

		   		<h4>

		   			<b>Seguro desea cerrar caja?</b>

		   		</h4> <br>

		   		<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

	        		<button type="button" class="btn btn-primary" id="btn_cierrecaja" onclick="cerrarcaja()">

	        			Si, Cerrar caja ahora

	        		</button>

		   	</div>

	 	</div>

	</div>

</div>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/sesion_caja.js"></script>