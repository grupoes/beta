<div  class=" panel panel-flat "  >
	<div class="panel-heading" id="cuerpo">
			<center><h3>MOVIMIENTOS GENERALES</h3></center>	
	</div>
	<div class="panel-body">
		<div class="row">
			<form id="formulario">
			<div class="col-md-4">
				<div class="form-group">
					<label >Selecionar</label>
					<select class="form-control" id="id_sede" name="id_sede">
						<option value="0">Todos</option>
						<?php foreach($lista as $value){ ?>

                                   <option value="<?php echo $value->id_sede  ?>"><?php echo $value->descripcion;  ?></option>
                        <?php 
                          }

                        ?>
                        					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label >Inicio</label>
					<input type="date" name="inicio" id="inicio" class="form-control">
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label >Fin</label>
					<input type="date" name="fin" id="fin" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<br>
				<button class="btn btn-success" id="buscar" type="button">buscar</button>
			</div>
		  </form>
		</div>
		<div class="table-responsive">	
			<table class="table table-striped table-bordered datatable-button-html5-basic" id="table_sistema">
				<thead>
					<tr>
						<th class="center">#</th>					
						<th class="center">Caja</th>
						<th class="center">Tipo</th>
						<th class="center">Concepto</th>						
						<th class="center">Monto</th>
						<th class="center">Descripcion</th>
						<th class="center">Sede</th>
						
					</tr>
				</thead>
				<tbody id="tabla_datos">
			</tbody>
		</table>
	</div>

	</div>
</div>

<script type="text/javascript">
	$(function(){
		   $("#titulo").text("Movmientos");
       $("#subtitulo").text('Busqueda de Movmientos');  
	});


	$("#buscar").click(function(){
  

     $.post(base_url+"Movimiento/ver_movimientos",$("#formulario").serialize(),function(data){
     	   
      $(".datatable-button-html5-basic").DataTable().destroy();
              
               $("#tabla_datos").empty().append(data);
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
     })

	});
</script>
