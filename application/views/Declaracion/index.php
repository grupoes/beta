<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<center><h3><b>DECLARACIONES TRIBUTARIAS</b></h3></center>
			<h6>En este modulo se configuracion de las notificaciones de cada uno de las declaraciones tributarias </h6>
	       <div class="row">
<br>           <?php foreach ($lista as $key => $value) {
           	# code...
            ?>
      
                  <div class="col-md-4" >
	                  <div class="panel <?php echo $value->decl_color;?>" onclick="seleccionar('<?php echo $value->id_declaracion ?>')">
						 <div class="panel-body">
							<div class="heading-elements">
								<ul class="icons-list">
						        		
						              	</ul>
						                	</div>
											<h3 class="no-margin"><?php echo $value->decl_nombre; ?></h3>
											<?php echo $value->decl_descripcion; ?>
										
                          </div>
									
			           </div>
			       
			       </div>
                 <?php } ?>
             
			 </div>
		</div>
	</div>
</div>
<script type="text/javascript">
	 function seleccionar(id)
{

	
 
   /*$("#datos").modal();
   $("#id_ficha").val(id);*/
   	$.post(base_url+"Declaracion/pdt",{
             "id":  id
		},function(data){
   $('#cont_sistema').empty().html(data);
	   
          
         });
   
}

</script>