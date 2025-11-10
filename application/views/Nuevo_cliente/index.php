<div  class=" panel panel-flat "  >
	<div class="panel-heading" id="cuerpo">
			<center><h3>DATOS DE FORMULARIO</h3></center>	
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="table-responsive">	
			<table class="table datatable-button-html5-basic" id="table_sistema">
				<thead>
					<tr>
						<th class="center">#</th>					
						<th class="center">Nombres y Apellidos</th>
						<th class="center">Celular</th>
						<th class="center">Ciudad</th>						
						<th class="center">Ciclo</th>
						<th class="center">Correo</th>
						<th class="center">Especialidad</th>
										</tr>
				</thead>
				<tbody>
					<?php 
					$c=0;
					foreach ($lista as $value) { $c++; ?>
					<tr>
						<td class="center"><?php echo $c;?></td>
						<td class="center"><?php echo $value->cli_ing_nombre." ".$value->cli_ing_apellido;?></td>
						<td class="center"><?php echo $value->cli_ing_telefono?></td>
						<td class="center"><?php echo $value->cli_ing_ciudad;?></td>
						<td class="center"><?php echo $value->cli_ing_ciclo;?></td>
						<td class="center"><?php echo $value->cli_ing_correo;?></td>
						<td class="center"><?php echo $value->cli_ing_carrera;?></td>
						
					</tr>
					<?php }
					?>
				</tbody>
			</table>
		</div>

		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		   $("#titulo").text("FORMULARIO");
       $("#subtitulo").text('Datos de posibles clientes');
       $(".datatable-button-html5-basic").DataTable().destroy();
        $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Buscar:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });
         
         $('.datatable-button-html5-basic').DataTable({
        	 buttons: {            
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        }
    });
      $.extend( true, $.fn.dataTable.defaults, {
    buttons: [  ]
} );  



	});
</script>