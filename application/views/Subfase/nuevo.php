<div class="panel panel-flat">
 <div class="panel-heading">
  
 </div>
<?php 
//print_r($lista_categoria);
if(isset($data)){
    if(is_object($data)) {
    	$titulo=$data->titulo;
      $id_subfase=$data->id_subfase;
      $descripcion=$data->descripcion;
      $id_fase=$data->id_fase;
      $observacion=$data->observacion;
    }
}
    else{
    	 $id_subfase="";
    	 $titulo="";
  $descripcion="";
  $observacion="";
  $id_subfase="";
    }

?>
 <div class="panel-body">
<form onsubmit="return guardar()" id="formulario">
<input type="hidden" name="id_subfase" value="<?php echo $id_subfase; ?>">
	<div class="row">
		<div class="form-group">
			<label class="control-label col-lg-2">Titulo de la subfase<span class="text-danger">*</span></label>
				<div class="col-lg-10">
			    	<input type="text" required="true" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo">
				</div>
		</div>
	 </div>

	 <div class="row">
	 <div class="form-group">
	   <label class="control-label col-lg-2">Observacion</label>
		<div class="col-lg-10">
			<textarea rows="2" cols="5" class="form-control" name="descripcion" id="descripcion"><?php echo $descripcion; ?></textarea>
		</div>
	</div>
	</div>
<br/>
	
	<div class="row">
	<div class="col-md-4">
	 <div class="form-group">
	   <label>FASES DE PRODUCCION</label>
	    <select id="id_fase" class="select-search" name="id_fase">
	    	<?php 
                 echo "<option>Selecionar fase</option>";
                foreach ($fase as $key => $value) {
                    if($value->id_fase==$id_fase){
                       echo "<option value='".$value->id_fase."' selected>".$value->titulo."(".$value->descripcion.")"."</option>"  ;
                    }
                    else{
                   echo "<option value='".$value->id_fase."'>".$value->titulo."(".$value->descripcion.")"."</option>"  ;
                   }
               }
	    	?>
	    </select>
	  </div>
	  </div>
	  <div class=" col-md-4">
	  	<div class="form-group ">
										<label class="display-block text-semibold">CATEGORIA:</label>
				<?php foreach ($categoria as $key => $value) 
										{
											$c=0;
											if(isset($lista_categoria)){
											foreach ($lista_categoria as $key => $value1) {
											if ($value1->id_categoria==$value->id_categoria) {
												echo '<div class="checkbox">
											<label>
												<span class="checked"><input value="'.$value->id_categoria.'" type="checkbox" name="id_categoria[]" id="id_categoria[]" class="styled" checked></span>
												'.$value->descripcion.'
											</label>
										</div>';
										   $c=1;
											}
										}
										}
										if($c==0){
										echo '<div class="checkbox">
											<label>
												<span class="checked"><input value="'.$value->id_categoria.'" type="checkbox" name="id_categoria[]" id="id_categoria[]" class="styled"></span>
												'.$value->descripcion.'
											</label>
										</div>';
									 }
									}
								?>
	</div>
	</div>
	</div>
	<div class="row">
		<div class="form-group">
	   <label class="control-label col-lg-2">Observacion</label>
		<div class="col-lg-10">
			<textarea rows="3 	" cols="5" class="form-control" name="observacion" id="observacion"><?php echo $observacion; ?></textarea>
		</div>
	</div>
	</div>
      <br>
      <div class="row">
      <center>
      	 <button type="submit" id="btn_guardar" class="btn btn-primary " ><?php if(isset($data)){echo 'actualizar';}else
      	 {echo 'Registrar';}?></button>
      
      	 <button type="button" class="btn btn-danger" 
      	 onclick="reload_url('Subfase','mantenimiento')");">Cancelar</button>
      	 </center>
      </div>
</form>
	</div>
 </div>

<script type="text/javascript">
			$(function () {
				 $('.select-search').select2();


  } );

</script>