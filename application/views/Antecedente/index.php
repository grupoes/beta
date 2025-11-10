<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			
		
			<button onclick="nuevo1()"  class="btn btn-primary legitRipple">Nueva Antecedente</button>
		
	      <button onclick="generarword()" class="btn btn-success">Generar Word</button>

		</div>
         <?php  $c=1; //print_r($datos);?> 
		<table class="table table-lg invoice-archive" id="table_sistema">
			<thead>
				<tr>
					<th>#</th>
					<th>Titulo </th>
					<th>grado_tesis</th>
					<th>Pais</th>
					<th>Universidad</th>
					<th>Alcance</th>
					<th class="text-center">Actions</th>
				</tr>
			</thead>
			<tbody>
              <?php
              $c=1;
                 
                  foreach ($datos as $key => $value) {
                  	 echo "<tr>";
                     echo "<td>".$c."</td>";
                     echo "<td>".$value->ref_titulo."</td>";
                     echo "<td>".$value->gra_descripcion."</td>";
                     echo "<td>".$value->ref_pais."</td>";
                     echo "<td>".$value->ref_universidad."</td>";
                      echo "<td>".$value->alc_descripcion."</td>";
                      echo "<td>".$value->alc_descripcion."</td>";
                         echo "</tr>";
                  }

                 
                    $c=$c+1;

               ?>
			</tbody>
		</table>
 </div>
</div>


<script type="text/javascript">
function generarword()
{
		   	var url=base_url+"word/generarword.php?id="+"<?php echo $_SESSION['id_ficha_enfoque'] ?>";
		var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
	
}

$(function () {
	$("#table_sistema").DataTable();


});

	
</script>