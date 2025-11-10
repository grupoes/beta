
<div class="row">
<form id="formulario">
<div class="col-md-3">
 <div class="panel panel-flat">
    <input type="hidden" name="id_tiempo" id="id_tiempo" value="">
	<div class="panel-body">
       <div class="form-group">
       <label>Fases</label>
        <select class="select-search" id="id_fase" name="id_fase">
        	<option value="">Selecionar fase</option>
        	<?php 
                 foreach ($fase as $key => $value) {
                  
                   echo "<option value='".$value->id_fase."'>".$value->titulo."(".$value->descripcion.")"."</option>"  ;
                   
               }
        	?>
        </select>
        </div>
     </div>
 </div>
  <div class="panel panel-flat">
    <div class="panel-body">
      <div class="form-group">
        <label>Dificultad</label>
        <select class="form-control"  id="id_dificultad" name="id_dificultad">
          <option value="">Selecionar</option>
          <?php 
           foreach ($dificultad as $key => $value) {
             echo "<option value='".$value->id_dificultad."'>".$value->descripcion."</option>"  ;
           }
          ?>
        </select>
      </div>
     </div>
 </div>


  <div class="panel panel-flat">
    <div class="panel-body">
        <div class="form-group">
          <label>¿que hacer?</label>
          <select class="form-control"  name="id_tarea" id="id_tarea">
          <option value="">Selecionar</option>
          <?php 
           foreach ($hacer as $key => $value) {
             echo "<option value='".$value->id_tarea."'>".$value->descripcion."</option>"  ;
           }
          ?>
        </select>
        </div>
     </div>
 </div>
 </div>


 <div class="col-md-6">
 <div class="panel panel-flat">
	<div class="panel-body">
       <div class="form-group">
              <label class="display-block text-semibold">Especialidad de la tesis</label>
              <div id="fase1">
                
              </div>
   </div>
 </div>
 </div>
</div>

 <div class="col-md-3">



  <div class="panel panel-flat">
   	<div class="panel-body">
      <div class="form-group">
      	<label>Tiempo a usar</label>
      	<div class="input-group">
      	<span class="input-group-addon"><i class="icon-watch2"></i></span>
											<input type="text" name="anytime-time" class="form-control" id="anytime-time" value="0:00">
											</div>
      </div>
      <br>
      </form>
      <button class="btn btn-primary" id="boton" type="button">Guardar</button>
     </div>
 </div>


 </div>

 </div>

<script type="text/javascript" src="<?php echo base_url();?>public/modulos/subfase_tiempo.js"></script>
<script type="text/javascript">
$(function(){
	$('#anytime-time').datetimepicker({
  format:'LT'
});
});	

$("#id_fase").change(function(event) {
  $.post(base_url+"Subfase_tiempo/subfases", {id:$("#id_fase").val() }, function(data, textStatus, xhr) {
    $('#fase1').empty();
        $('#fase1').append(data);
  });
});


function cargar(){

    var fase=$("#id_fase").val();
var subfase=$('input:radio[name=id_subfase]:checked').val();

var dificultad=$("#id_dificultad").val();
var hacer=$("#id_tarea").val();
var tiempo=$("#anytime-time").val();
if(fase!="" && dificultad!="" && fase!="" && hacer!="" && tiempo!="00:00"){

   $.post(base_url+"Subfase_tiempo/traer",{"id_dificultad":dificultad,"id_subfase":subfase,"id_tarea":hacer},function(data){
 
         
        $("#anytime-time").val(data.tiempo);
        $("#id_tiempo").val(data.id_tiempo);
  }, "json");
}

}




/*$("#id_tarea").change(function(event) {
    var fase=$("#id_fase").val();
var subfase=$('input:radio[name=id_subfase]:checked').val();

var dificultad=$("#id_dificultad").val();
var hacer=$("#id_tarea").val();
var tiempo=$("#anytime-time").val();
if(fase!="" && dificultad!="" && fase!="" && hacer!="" && tiempo!="00:00"){
 
   $.post(base_url+"Subfase_tiempo/traer",{"id_dificultad":dificultad,"id_subfase":subfase,"id_tarea":hacer},function(data){
 
         alert(data.tiempo);
        $("#anytime-time").val(data.tiempo);
        $("#tiempo").val(data.id_tiempo);
  }, "json");
}
});

*/

$("#boton").click(function(event) {
var fase=$("#id_fase").val();
var subfase=$('input:radio[name=id_subfase]:checked').val();

var dificultad=$("#id_dificultad").val();
var hacer=$("#id_tarea").val();
var tiempo=$("#anytime-time").val();
//alert(subfase);
if(fase!="" && dificultad!="" && fase!="" && hacer!="" && tiempo!="00:00"){
  //alert($("#formulario").serialize());
    $.post(base_url+"Subfase_tiempo/registrar",$("#formulario").serialize(),function(data){
      swal("muy bien!", "Se actualizo Correctamente!", "success");

  });
}
else{
  alert("error");
}
});
</script>