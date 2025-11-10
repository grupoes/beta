<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<h6 class="panel-title">Lista de Producción</h6>
			<div class="heading-elements">
				<ul class="icons-list">
					<li><a data-action="collapse"></a></li>
					<li><a data-action="reload"></a></li>
					<li><a data-action="close"></a></li>
				</ul>
			</div>
		</div>
         <?php  $c=1; ?> 
		<table class="table table-lg invoice-archive" id="table_sistema">
			<thead>
				<tr>
					<th>id</th>
					<th>Titulo Enfoque</th>
					<th>Cliente</th>
					<th>Asesores</th>
					<th>Telefono</th>
					<th>Acciones</th>
				</tr>
			</thead>
			
		</table>
	</div>
</div>

<script type="text/javascript">
	$(function () {
		$("#table_sistema").DataTable().destroy();
	$("#table_sistema").DataTable(

      {
      	
      	"language": {
              "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
        },
            "processing": true,
            "serverSide": true,
            "ajax":{
		     "url": "<?php echo base_url('Documentos_c/tabla_data') ?>",
		     "dataType": "json",
		     "type": "POST",
		     "data":{  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>' }
		                   },
	    "columns": [
		          { "data": "id" },
		          { "data": "titulo" },
		          { "data": "cliente" },
		          {"data":"asesores"},
		          { "data": "telefono" },
		          { "data": "acciones" },
		       ],


	    }




		);
$("#titulo").text("Producccion");
       $("#subtitulo").text('Documentos');   

});
</script>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/documentos.js"></script>