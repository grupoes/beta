<div class="panel panel-flat">
 <div class="panel-heading">
  
 </div>
<?php 

if(isset($data)){
    if(is_object($data)) {
      $id_fase=$data->id_fase;
      $descripcion=$data->descripcion;
      $observacion=$data->observacion;
      $titulo=$data->titulo;
      $id_tipo_enfoque=$data->id_tipo_enfoque;
    }
}
    else{
    	 $id_fase="";
  $descripcion="";
  $observacion="";
  $id_tipo_enfoque="";
  $titulo="";


    }

?>
 <div class="panel-body">
<form onsubmit="return guardar()" id="formulario_ficha">
<input type="hidden" name="id_fase" id="id_fase" value="<?php echo $id_fase; ?>"/>
	<div class="row">
		<div class="form-group">
			<label class="control-label col-md-2">Titulo de la fase<span class="text-danger">*</span></label>
				<div class="col-md-4">
			    	<input type="text" required="true" class="form-control" value="<?php echo $titulo; ?>" name="titulo" id="titulo">
				</div>
		
	        	<label class="control-label col-md-2">Tipo de enfoque</label>
	        	<div class="col-md-4 ">
				<select class="form-control" id="id_tipo_enfoque"  name="id_tipo_enfoque">
					<?php  

                         foreach ($tipo_enfoque as $key => $value) {
                         	if ($value->id_tipo_enfoque==$id_tipo_enfoque) {
                         	  echo "<option value='".$value->id_tipo_enfoque."' selected>".$value->descripcion."</option>";	
                         	}
                         	else{
                         	echo "<option value='".$value->id_tipo_enfoque."'>".$value->descripcion."</option>";
                            }
                         }
					?>
				</select>
				</div>
	</div>
	 </div>
     

     <div class="row">
		<div class="form-group">
			<label class="control-label col-lg-2">Descripcion de la fase<span class="text-danger">*</span></label>
				<div class="col-lg-10">
			    	<input type="text" required="true" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion">
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
      	 onclick="reload_url('Fase','mantenimiento')");">Cancelar</button>
      	 </center>
      </div>
</form>
	</div>
 </div>

<script type="text/javascript">
		
</script>