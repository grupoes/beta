<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<div class="row">
				<div class="row">
					<center><h3>CONFIGURACION </h3></center>
					<div class="col-md-4"><h5>Seleccionar el año en el que desea trabajar:</h5></div>
					<div class="col-md-4">
						<select class="form-control" id="anio" name="anio">
					         <option value="">Seleccionar el año</option>
					         <?php
                                     foreach ($anio as $key => $value) {
                                     	# code...
                                     
					          ?>	

					            <option value="<?php echo $value->id_anio ?>"><?php echo $value->anio_descripcion; ?></option>
					          <?php } ?>
					    </select>

					</div>

				</div>
				 <div class="row">
				   <div class="col-md-12">
				   	  <table class="table table-bordered table-striped table-hover">
				   	   <thead>
				   	   	<tr class="bg-teal-400">
				   	   		<th>Periodo</th>
				   	   		
				   	   		<?php foreach ($numero as $key => $value) {
				   	   			# code...
				   	   		 ?>
				   	   		 <th>
				   	   		 	 <?php echo $value->num_descripcion; ?>
				   	   		 </th>
				   	   		 <?php } ?>
				   	   	</tr>
				   	   </thead>
				   	   <tbody>
				   	   	  <?php  
 				   	   	   foreach ($mes as $key => $value) {
				   	   	       echo "<tr>";
				   	   	       echo "<td><b>".$value->mes_descripcion."</b> se declara(".$value->mes_declaracion.")"."</td>";
                                 
				   	   		       foreach ($numero as $key1 => $value1) {
                                    echo "<td><input type='text' maxlength='2' onkeyup='enviar_datos(".$value1->id_numero.",".$value->id_mes.")' class='form-control' id='datos".$value1->id_numero.$value->id_mes."' name='datos[]'/></td>";
				   	   		       }
				   	   					   	   		 
				   	   	        echo "</tr>";

                              
				   	   	    } ?>
				   	   </tbody>
				   	</table>
				   </div>

 				 </div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#anio").change(function()
		 {  var id_anio=$(this).val();
                  $('input[name="datos[]"]').map(function ( n, i) {
                  	$(this).val("");
                  }).get();
                  if($(this).val()!=""){
                         $.post("<?php echo base_url();?>Declaracion/extraer_data",{"id_anio":id_anio},function(data){
                         	//alert(data[0]["numeracion"]);
                         	//alert(data.length);
                         	for(i=0;i<data.length;i++){
                              //alert(data[i]["numeracion"]);
                              $("#datos"+data[i]["numeracion"]).val(data[i]["dia_exacto"]);
                         	}
                         },"json");

                  }

		 });
	function enviar_datos(id_numero,id_mes)
	{
		idn=id_numero.toString();
		idm=id_mes.toString();
		
		var anio=$("#anio").val();
		var fecha=$("#datos"+idn+idm);
         
         if(anio!=""){

               var maximo=mes(id_mes);
               if(fecha.val()>maximo)
               {
                  fecha.val(maximo);
               }
             if(fecha.val()!="" && fecha.val().length>=1){
               $.post("<?php echo base_url(); ?>Declaracion/guardar_fecha",
               	{"id_anio":anio,"id_mes":idm,"id_numero":idn,"dia":fecha.val()}
               	,function(data)
               {
                   if(data=="1"){
         	alerta("Registro","se registro correctamente");
                     
                   }
                   else{
         	alerta1("Actualizacion","se actualizo correctamente");
                     
                   } 
                  });

              }

            
         }
         else
         {
         		fecha.val("");
                $("#anio").focus();
         	alerta2("error","necesitas Seleccionar un año para poder modificar");
         }

	}


	function mes(id_mes)
	{
       if(id_mes==1)
       {
         return 31; 
       }
       if(id_mes==2)
       {
          return 28;
       }
        if(id_mes==3)
       {
          return 31;
       }
       if(id_mes==4)
       {
       	  return 30;
       }
        if(id_mes==5)
       {
          return 31;
       }
       if(id_mes==6)
       {
       	 return 30;
       }
        if(id_mes==7)
       {
            return 31;
       }
       if(id_mes==8)
       {
       	 return 31;
       }
        if(id_mes==9)
       {
          return 30;
       }
       if(id_mes==10)
       {
       	  return 31;
       }
        if(id_mes==11)
       {
          return 30;
       }
       if(id_mes==12)
       {
       	 return 31;
       	
       }




	}



</script>