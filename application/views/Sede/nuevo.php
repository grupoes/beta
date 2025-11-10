<div class="panel panel-flat">
 <div class="panel-heading">
  
 </div>
<?php 
//print_r($data);
if(isset($data)){
    if(is_object($data)) {
  $id_sede=$data->id_sede;
      $descripcion=$data->descripcion;
      $observacion=$data->observacion;
      $direccion=$data->direccion;

       $horario_m_i=$data->horario_m_i;
        $horario_m=$data->horario_m;
        $horario_t_i=$data->horario_t_i;
         $horario_t=$data->horario_t;
         $telefono=$data->telefono;
    }
}
    else{
    	 $id_sede="";
  $descripcion="";
  $observacion="";
  $direccion="";
   $horario_m_i="0:00";
    $horario_m="0:00";
     $horario_t_i="0:00";
      $horario_t="0:00";
      $telefono="";
    }

?>
 <div class="panel-body">
<form onsubmit="return guardar()" id="formulario">
<input type="hidden" name="id_sede" value="<?php echo $id_sede; ?>">
	<div class="row">
		<div class="form-group">
			<label class="control-label col-lg-2">Nombre de la sede<span class="text-danger">*</span></label>
				<div class="col-lg-10">
			    	<input type="text" required="true" class="form-control" value="<?php echo $descripcion; ?>" name="descripcion" id="descripcion">
				</div>
		</div>
	 </div>
	 <div class="row">
	 	<div class="form-group">
			<label class="control-label col-lg-2">Direccion<span class="text-danger">*</span></label>
				<div class="col-lg-5">
			    	<input type="text" required="true" class="form-control" value="<?php echo $direccion; ?>" name="direccion" id="direccion">
				</div>
        <label class="control-label col-lg-1">Telefono<span class="text-danger">*</span></label>
        <div class="col-lg-4">
            <input type="text" required="true" class="form-control" value="<?php echo $telefono; ?>" name="telefono" id="telefono">
        </div>
		</div>
	 </div>                


   <div class="row">
                            <div class="form-group">
                                <label class="control-label col-lg-1">Departamento:</label>
                                <div class="col-lg-3">
                                  <select name="select" id="departamento" name="departamento" class="form-control">
                                                    <option value="opt1">Selecionar</option>

                                                    <?php
                                                               foreach ($departamento as $value ){
                                                                echo "<option value='".$value->id_departamento."'>".$value->descripcion."</option>";
                                                               }
                                                    ?>
                                                  </select>
                                  </div>
                                  <label class="control-label col-lg-1">Provincia:</label>
                                <div class="col-lg-3">
                                  <select name="select" id="provincia" name="departamento" class="form-control">
                                                    <option value="opt1">Selecionar</option>
                                                   
                                                  </select>
                                  </div>
                                  <label class="control-label col-lg-1">Distrito:</label>
                                <div class="col-lg-3">
                                  <select  id="distrito" name="distrito" class="form-control" required="true">
                                                    <option value="">Selecionar</option>
                                                  </select>
                                  </div>
                                  </div>          
                             </div>






	 <div class="row">
     <div class="col-md-12"><h5>Horario</h5></div>
        <div class="col-md-12">
         <div class="row">
         <div class="col-md-3">
      	   <label class="col-md-4">H.m. Inicio</label>
      	   <div  class="input-group col-md-8">
      	     <span class="input-group-addon"><i class="icon-watch2"></i></span>
			<input type="text" name="horario_m_i" class="form-control anytime-time" id="horario_m_i" value="<?php echo $horario_m_i;?>">
			</div>
         </div>
          <div class="col-md-3">
			<label class="col-md-4">H.m. Fin</label>
         	<div  class="input-group col-md-8">
         	<span class="input-group-addon"><i class="icon-watch2"></i></span>
			<input type="text" name="horario_m" class="form-control anytime-time" id="horario_m" value="<?php echo $horario_m;?>">
			</div>
			</div>
			 <div class="col-md-3">
			<label class="col-md-4">H.T. Inicio</label>
      	<div  class="input-group col-md-8">
      	<span class="input-group-addon"><i class="icon-watch2"></i></span>
			<input type="text" name="horario_t_i" class="form-control anytime-time" id="horario_t_i" value="<?php echo $horario_t_i;?>">
			</div>
			</div>
			<label class="col-md-1">H.T. Fin</label>
      	<div  class="input-group col-md-2">
      	<span class="input-group-addon"><i class="icon-watch2"></i></span>
			<input type="text" name="horario_t" class="form-control anytime-time" id="horario_t" value="<?php echo $horario_t;?>">
			</div>
			</div>
      </div>
	 </div>
<br>
	
	<div class="row">
	 <div class="form-group">
	   <label class="control-label col-lg-1">Observacion</label>
		<div class="col-lg-11">
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
      	 onclick="reload_url('Sede','mantenimiento')");">Cancelar</button>
      	 </center>
      </div>
</form>
	</div>
 </div>

<script type="text/javascript">
		$(function(){
	$('.anytime-time').datetimepicker({
  format:'LT'
});
});	

       $("#departamento").change(function(event) {
       $.post(base_url+"Ficha_enfoque/provincia",{"id": $("#departamento").val()},function(data){
       $('#provincia').empty();
       $('#provincia').append(data);
       });
      });

           $("#provincia").change(function(event) {
      $.post(base_url+"Ficha_enfoque/distrito",{"id": $("#provincia").val()},function(data){
      $('#distrito').empty();
      $('#distrito').append(data);
     });
    });

</script>