<div class="panel panel-flat">
 <div class="panel-heading">
  
 </div>

  <div class="panel-body">
  <div class="row">
  	<center>
  		<h2>Seleccionar una de las fases</h2>
  	</center>
  </div>
  <div class="row">
  	<div class="col-md-6">

          		<button onclick="buscar(1)" class="btn btn-primary btn-xlg legitRipple">Antecedentes</button>
          	</div>
  </div>
  </div>
</div>
<script type="text/javascript">
	
function buscar(id)
{
	   //$("#datos").modal("hide");


	if (id=1) {

		$.post(base_url+"Documentos_c/antecedentes",{
             "id":   "<?php echo $_SESSION['id_ficha_enfoque']; ?>"
		},function(data){
              	   $('#cont_sistema').empty().html(data); 
	   
          
         });
	}
}

$(function () {
	$("#table_sistema").DataTable();
$("#titulo").text("Produccion ");
       $("#subtitulo").text('<?php echo $_SESSION["nombre_ficha_enfoque"]; ?>');   

});
</script>