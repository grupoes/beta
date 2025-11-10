<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<center><h3><b>Seleccionar que desea tributo desea registar</b></h3></center>

			   <div class="row">
<br>           <?php foreach ($lista as $key => $value) {
           	# code...
            ?>
      
                  <div class="col-md-4" >
	                  <div class="panel <?php echo $value->decl_color;?>" onclick="periodo('<?php echo $value->id_tributo ?>')">
						 <div class="panel-body">
							
											<h5 class="no-margin"><?php echo $value->tri_descripcion; ?></h5>
										
										
                          </div>
									
			           </div>
			       
			       </div>
                 <?php } ?>
		</div>
	</div>
</div>
</div>

<script type="text/javascript">
	function periodo(id_tributo)
	 {
			$.post(base_url+"Declaracion/periodo",{
             "id_tributo":  id_tributo
		},function(data)
		{
          $('#cont_sistema').empty().html(data);
	   
          
         });
   
	}
</script>

