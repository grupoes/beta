<div class="panel panel-flat">
<div class="panel-heading">
	
			<button onclick="$('.page-header-content').hide();$('.panel-heading').hide();$('.sidebar-content').hide();$('.row').hide();$('#im').hide();window.print();$('.page-header-content').show();$('.panel-heading').show();$('.sidebar-content').show();$('.row').show();$('#im').show();"  class="btn btn-primary legitRipple" id="im">Imprimir</button>
		
	
	</div>
	<div class="panel-body">
	<div class="row">
		<div class="col-md-2">
			<label>tipo de cliente</label>
			<select class="form-control" id="tipocliente">
			<<option value="0">todos</option>
				<?php 

                  foreach ($tipocliente as $key => $value) {
                  echo "<option value='".$value->id_tipocliente."'>".$value->descripcion."</option>";
                  }
				?>
			</select>
		</div>
		<div class="col-md-3">
			<label>Clasificacion</label>
			<select class="form-control" id="data" >
				<option value="0">ninguna</option>
				<option value="carrera">Carrera</option>
				<option value="universidad">Universidad</option>
				<option value="tiponivel">Tipo de nivel</option>
				<option value="grado">Grado</option>
				<option value="medio">Medios de Ingresos</option>
				<option value="trabajador">Trabajador</option>
				<option value="sede">Sede</option>
			</select>
		</div>
		<div class="col-md-3">
		<label id="info">por favor </label>
			<select id="info1" class="form-control" >
				<option>seleccionar la clasificacion</option>
			</select>

		</div>
	
		<div class="col-md-2">
		    <label>Generar</label><br>
		<button class="btn btn-success" id="generar" >Generar</button>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3">
		<label>Desde</label>
			<input type="date" id="fechainicio" name="fechainicio" class="form-control " max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>">
		</div>
		<div class="col-md-3">
		<label>
			Hasta
		</label>
			<input type="date" id="fechafin" name="fechafin" class="form-control " max="<?php echo date('Y-m-d');?>" value="<?php echo date('Y-m-d');?>">
		</div>
	</div>
<br>
<br>
	
<table class="table datatable-button-html5-basic" id="table_sistema">
	<thead>
		<tr >
			<th>#</th>
			<th>Nombre</th>
			<th>Titulo</th>
			<th>Fecha</th>
		
		</tr>
	</thead>
	<tbody id="datos">

	</tbody>
</table>
<br>
<br>
<br>
</div>
</div>
<script type="text/javascript">
	$(".anytime-month-numeric").datetimepicker({
		 
		// viewMode: 'years',
                format: 'YYYY/MM/DD'
	});
</script>

<script type="text/javascript">
$("#generar").click(function(event) {    

	
 tipocliente=$("#tipocliente").val();
 data=$("#data").val();
 info=$("#info1").val();

 fechainicio=$("#fechainicio").val();
fechafin=$("#fechafin").val();
 $.post(base_url+"Trabajos_generales/generar", 
  {
      "tipocliente": tipocliente,
       "data":data,
       "info":info,
   
     "fechainicio":fechainicio,
     "fechafin":fechafin
      
      }, 
  function(data, textStatus, xhr) {
   
      $(".datatable-button-html5-basic").DataTable().destroy();

   $("#datos").empty();
   $("#datos").append(data);
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

});
</script>
<script type="text/javascript" src="<?php echo base_url();?>public/modulos/trabajos_generales.js"></script>
