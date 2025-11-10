<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">
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
				<option value="universidad">Universidad</option>
				<option value="tiponivel">Tipo de nivel</option>
				
				<option value="sede">Sede</option>
			</select>
		</div>
		<div class="col-md-3">
		<label id="info">por favor </label>
			<select id="info1" class="form-control" >
				<option>seleccionar la clasificacion</option>
			</select>

		</div>
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
		<div class="col-md-2">
		    <label>Generar</label><br>
		<button class="btn btn-success" id="generar" onclick="generar1()">Generar</button>
		</div>
	</div>
<div class="table-responsive">
<table class="table datatable-basic" id="table_sistema">
	<thead>
		<tr >
			<th width="5%">#</th>
			<th width="25%">Titulo</th>
			<th width="30%">Cliente</th>
			<th width="25%">Fecha</th>
			<th width="10%">Deuda </th>
			
		</tr>
	</thead>
	<tbody id="datos">
		

	</tbody>
</table>
</div>
</div>
<br><br><br><br>
</div>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/moroso.js"></script>
