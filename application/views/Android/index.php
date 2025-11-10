<div class="panel panel-flat">
<div class="panel-heading">
	
			<h3 class="">Mensajes a la aplicacion</h3>
		   <div class="row">
		   	<div class="col-md-12">
		   		<label class="col-md-2">Titulo: </label>
		   		<div class="col-md-10"><input type="text" name="titulo" id="titulo" class="form-control"></div>
		   	</div>
		   	 	<div class="col-md-12">
		   		<label class="col-md-2">Descripcion: </label>
		   		<div class="col-md-10"><input type="text" name="descripcion" id="descripcion" class="form-control"></div>
		   	</div>
		   </div>
		   <div class="form-group">
		   	<br><br>
		   	<center>
		   			<button class="btn btn-danger">Cancelar</button>
		   		<button class="btn btn-primary" id="enviar">Enviar</button>
		   	</center>
		   </div>
	
	</div>
	<div class="panel-body">
	</div>
</div>

<script type="text/javascript">
	$("#enviar").click(function() {
          $.post(base_url+"Android/enviar",{"titulo":$("#titulo").val(),"descripcion":$("#descripcion").val()},function(data){

          });
	});
</script>