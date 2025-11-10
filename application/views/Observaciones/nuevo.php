<style type="text/css">
	.flotante {
		display:scroll;
		position:fixed;
		bottom:70px;
		right:40px;
	}
	.flotante1 {
		display:scroll;
		position:fixed;
		bottom:0px;
		right:40px;
	}
</style>
<div class="panel panel-flat">
	<div class="panel-heading">

		<div class="panel-body">
			                 <div class="row">
										<div class="form-group" id="buscador1">
											<label>Buscador</label>
											<input type="text" name="buscador" id="buscador" class="form-control">
										</div>
									</div>
			<form class="form-horizontal" role="form" id="formulario" >
				<input type="hidden" name="id_observacion" value="<?php echo $id; ?>" id="id_observacion">
				<div class="row" id="detalleobs1">
				</div>
				<div class="row">
					<div class="col-md-11"></div>   
					<div class="col-md-1"> <a class='flotante'  ><button onclick="agregarfase()" id="botonflotante" type="button" class="btn btn-info btn-float btn-rounded legitRipple"><i class=" icon-plus3"></i></button></a>
					</div>
					<div class="col-md-1"> <a href="#" class='flotante1'  ><button onclick="buscador()" id="botonflotante" type="button" class="btn btn-danger btn-float btn-rounded legitRipple"><i class=" icon-search4"></i></button></a>
					</div>
				</div>
				<div class="row">
					<center><button type="button" id="guardar" class="btn btn-success">Guardar</button><button type="button" class="btn btn-danger">Cancelar</button></center>
				</div>
			</form>
		</div>
	</div>
</div>

<div id="modal_large" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h5 class="modal-title">Ficha de Observacion</h5>
			</div>
			<div class="modal-body">
				<center><iframe id="ficha_enfoque_pdf" src="" width="850px" height="450px"></iframe></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
				<button type="button" id="modal-fase3" onclick="salir_observacion()"  class="btn btn-primary">Listo</button>
			</div>
		</div>
	</div>
</div>





















<script type="text/javascript">
	var cont = 0;
	var i = 0;
	function mostrar(valor,id){
		$.post(base_url+"Observaciones/subfase",{'id_fase' : valor },function(data){
			$('#subfase'+id+'').empty().append(data);
		});   
	}
	function comprobar(){
		if($('#fases'+cont+'').val() != "" && $('#subfase'+cont+'').val() != "" && $('#descripcion'+cont+'').val() != ""){
			$('#botonflotante').removeAttr('disabled','disabled');
			$('#guardar').removeAttr('disabled','disabled');
		}else{
			$('#botonflotante').attr('disabled','disabled');
			$('#guardar').attr('disabled','disabled');
		}
	}
	$(function(){
		agregarfase();
		if(i==0){
			$('#guardar').attr('disabled','disabled');
		}
	});    
	$("#guardar").click(function(){
		$.post(base_url+"Observaciones/categoria_subfases",$("#formulario").serialize(),function(data){
			//alert(data);
     var ruta=base_url+"pdf/observacion.php?id="+$("#id_observacion").val();
     var iframe = document.getElementById("ficha_enfoque_pdf");
     iframe.setAttribute("src", ruta);
     $("#modal_large").modal();

		});   	
	});  
	function ActualizarObservaciones(id){

		if (i > 0) {
			$('#guardar').removeAttr('disabled','disabled');
			comprobar();
		}else{
			$('#guardar').attr('disabled','disabled');
			$('#botonflotante').removeAttr('disabled','disabled');
		}
	}
	function agregarfase(){
          		
		if((cont == 0) || ($('#fases'+cont+'').val() != "" && $('#subfase'+cont+'').val() != "" && $('#descripcion'+cont+'').val() != "")){
			$('#botonflotante').attr('disabled','disabled');

			cont = parseInt(cont+1);
			i = parseInt(i+1);

			var newtr = '<div id="contenedor">'
			newtr = newtr + '<div class="col-md-12">';
			newtr = newtr + '<div class="panel panel-flat">';
			newtr = newtr + '<div class="panel-heading"><h5 class="panel-title"></h5>';
			newtr = newtr + '<div class="heading-elements"><ul class="icons-list remove-item"><li><a data-action="close"></a></li></ul></div></div>';
			newtr = newtr + '<div class="panel-body">';
			newtr = newtr + '<div class="row">';
			newtr = newtr + '<div class="col-md-2">';
			newtr = newtr + '<label>fase</label>';
			newtr = newtr + '<select onchange="mostrar(this.value,'+cont+');comprobar()" id="fases'+cont+'" class="form-control" name="fases[]" required></select>';
			newtr = newtr + '</div>';
			newtr = newtr + '<div class="col-md-2">';
			newtr = newtr + '<label class="display-block">Sub Fase</label>';
			newtr = newtr + '<select id="subfase'+cont+'" name="subfase[]" onchange="comprobar()" class="form-control"  required="required"></select>';
			newtr = newtr + '</div>';
			newtr = newtr + '<div class="col-md-6">';
			newtr = newtr + '<label class="display-block">Observación</label>';
			newtr = newtr + '<textarea rows="1" cols="5" class="form-control" onkeypress="comprobar()" id="descripcion'+cont+'" name="descripcion[]" cols="5" required></textarea>';
			newtr = newtr + '</div>';

			 newtr = newtr + '<div class="col-md-2"><div class="form-group"><label ><b>Tiempo enfoque</b> </label><div  class="input-group "><span class="input-group-addon"><i class="icon-watch2"></i></span><input type="text" name="hora[]" class="form-control anytime-time" id="hora'+cont+'" value="00:00"></div></div></div>';

			newtr = newtr + '</div></div>';
			newtr = newtr + '</div></div></div>';
		
			$('#detalleobs1').append(newtr);
			$.post(base_url+"Observaciones/fases",{'id_observacion' : $('#id_observacion').val() },function(data){
				$('#fases'+cont+'').empty().append(data);
			});  
			$('#descripcion'+cont+'').focus();
			ActualizarObservaciones();
			$('.remove-item').off().click(function(e) {
				i = parseInt(i-1);
				$(this).parent('div').parent().parent().parent().remove(); 
				if ($('#detalleobs1 tr.item').length == 0)
					$('#detalleobs1 .no-item').slideDown(300); 
				ActualizarObservaciones();
			});        

		}else{
			$('#botonflotante').attr('disabled','disabled');
		}
		
	} 

	function buscador()
	{
		  $("#buscador1").show();
		$("#buscador").focus();

	}


  $( function() {
   $("#buscador1").hide();
 
 
    $( "#buscador" ).autocomplete({
      source: base_url+"Observaciones/buscador",
      minLength: 2,
      select: function( event, ui ) {
         // log( "Selected: " + ui.item.value + " aka " + ui.item.id );
         //alert(ui.item.id);
          var strin=ui.item.id;
         var valor = strin.split("/");
          $("#fases"+cont+" option[value='"+valor[1]+"']").attr("selected",true);
          $.post(base_url+"Observaciones/subfase",{'id_fase' : valor[1] },function(data){
          	  $("#buscador1").hide();
			$('#subfase'+cont+'').empty().append(data);
			$("#subfase"+cont+" option[value='"+valor[0]+"']").attr("selected",true);
			 $( "#buscador" ).val("");
			 $("#descripcion"+cont).focus();

		});   

      }
    });
  } );

  function salir_observacion()
  {
  	$("#modal-fase3").attr("disabled",true);
  	$.post(base_url+"Observaciones/salir",$("#formulario").serialize(),function(data){
  	$("#modal_large").modal("hide");
    setTimeout(function(){  reload_url('Observaciones','tesis'); }, 800);
     });
  }
</script>
