<div  class=" panel panel-flat "  >
<div class="panel-heading" id="cuerpo">	
	
    <center><h3>Lista  de Horario de Trabajadores<?php if($_SESSION['usuario_perfil']==2){ echo "(".$_SESSION['usuario_nombre'].")";}?></h3></center>
</div>
	<div class="panel-body">
<div class="row">
	<div class="col-md-4">  <select id="horas" class="select-search">
     <option value="1">5 minutos</option>
     <option value="2">15 minutos</option>
     <option value="3">30 minutos</option>
          <option value="4">1 hora</option>
  </select></div>
	<div class="col-md-4">
	<?php if($_SESSION['usuario_perfil']!=2 || $_SESSION['usuario_perfil']!=4){?>

  <select id="id_trabajador" class="select-search">
		
	</select><?php } ?>
	</div>
</div>
<br>
<div class="row">
	<div id="calendar"></div>
</div>

    	

</div>
</div>


<div id="modal_backdrop" class="modal fade" data-backdrop="false">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header bg-primary">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Datos del horario</h5>
								</div>

								<div class="modal-body">
								<form id="formulario">
								<div class="row">
								<input type="hidden" name="id_horario" id="id_horario">
									<div class="form-group">
										<label class="control-label col-lg-2">Titulo</label>
										<div class="col-lg-10">
											<input type="text" class="form-control" name="value" id="value" disabled="true">
										</div>
									</div>
									</div>
									<div class="row">
									<div class="form-group">
										<label class="control-label col-lg-2">Descripcion</label>
										<div class="col-lg-10">
											<textarea name="descripcion" rows="4" id="descripcion" class="form-control" disabled="true"></textarea>
																					</div>
									</div>
									</div>
									</form>
										<div class="row">
									<div class="form-group">
										<label class="control-label col-lg-3">HORA DE INICIO:</label>
										<div class="col-lg-9">
											<h6 id="inicio"></h6>
										</div>
									</div>
									</div>
										<div class="row">
									<div class="form-group">
										<label class="control-label col-lg-3">HORA DE FIN:</label>
										<div class="col-lg-9">
											<h6 id="fin"></h6>
										</div>
									</div>
									</div>
                  <div class="row">
                  <div class="form-group">
                    <label class="control-label col-lg-3">CLIENTE:</label>
                    <div class="col-lg-9">
                      <h6 id="cliente"></h6>
                    </div>
                  </div>

                  </div>
                      <div class="row">
                  <div class="form-group">
                    <label class="control-label col-lg-3">UNIVERSIDAD:</label>
                    <div class="col-lg-9">
                      <h6 id="universidad"></h6>
                    </div>
                  </div>

                  </div>
                      <div class="row">
                  <div class="form-group">
                    <label class="control-label col-lg-3">TELEFONO:</label>
                    <div class="col-lg-9">
                      <h6 id="telefono"></h6>
                    </div>
                  </div>

                  </div>
									<?php if($_SESSION['usuario_perfil']!=2){?>
									<div class="row">
									<div class="form-group">
										<label class="control-label col-lg-4">Asignar a otro asesor:</label>
										<div class="col-lg-8">
										
												<select id="id_trabajador1" class="form-control"></select>
												
										</div>
									</div>
									</div>
									<?php } ?>
								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
					<?php if($_SESSION['usuario_perfil']!=2){?><button type="button" class="btn btn-primary" data-dismiss="modal" id="cortar">Cortar horario</button>	<?php } ?>
            <?php if($_SESSION['usuario_perfil']!=2){?><button type="button" class="btn btn-danger" data-dismiss="modal" id="elimnarhorario">Eliminar</button> <?php } ?>
								</div>
							</div>
						</div>
					</div>


						<div id="modal_remote" class="modal">
						<div class="modal-dialog modal-full">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h5 class="modal-title">Horario del asesor : <label id="nombre_asesor"></label></h5>
								</div>

								<div class="modal-body">
									<div id="calendar1"></div>

								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
									
								</div>
							</div>
						</div>
					</div>




<script type="text/javascript" src="<?php echo base_url();?>public/modulos/horario.js"></script>
<script type="text/javascript">
var tiempo="00:05:00";
 
 $("#horas").change(function(event) {
    if ($("#horas").val()=="1") { tiempo="00:05:00";}
      if ($("#horas").val()=="2") {tiempo="00:15:00";}
        if ($("#horas").val()=="3") { tiempo="00:30:00";}
          if ($("#horas").val()=="4") { tiempo="01:00:00";}


    var id=$("#id_trabajador").val(); 
  
     if(id!="-1")
      {
        
       /*   var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");*/
     
      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
       {
       $('#calendar').fullCalendar( 'destroy' );
       $('#calendar').fullCalendar({
           height: 500,
           width: 100,
            slotDuration: tiempo,
     /*       businessHours: {
    // days of week. an array of zero-based day of week integers (0=Sunday)
    dow: [ 1, 2, 3, 4 ], // Monday - Thursday

    start: '10:00', // a start time (10am in this example)
    end: '18:00', // an end time (6pm in this example)
},*/
/*minTime:"07:00:00",
maxTime:"20:00:00",*/
           header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listWeek,agendaDay'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            navLinks: true,
         editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
       eventLimit: true,
       scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                        if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      
                      });
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                        function(data){
                        $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                       $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);     
                  },"json");
                    },
                      eventResize: function(event, delta, revertFunc) {

                     var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    } ,
             eventRender: function(event,element)
              {
                  var el=element.html();
                  element.html("<div style='width=20px !important;float=left;'>"+el+"</div> <div style='width=10%;color:red;text-aling:rigth;' class='close'>x</div>");

              }







          });
       $( "body" ).scrollTop( 300 );
         },"json");

}










 });

<?php if($_SESSION['usuario_perfil']!=2){?>
	$(function () {
    $('#calendar').fullCalendar( 'destroy' );
       $('#calendar').fullCalendar({
           height: 500,
           width: 100,
            slotDuration: '00:10:00',
           header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaWeek,listWeek,agendaDay'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            navLinks: true,
       editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
       eventLimit: true});


     $("#table_sistema").DataTable().destroy();
       $("#table_sistema").DataTable({ } );
       $("#titulo").text("Tesis");
       $("#subtitulo").text('Lista de Horarios');   
      $.post(base_url+"Ficha_enfoque/asesores",function(data){
         $('#id_trabajador').empty();
        $('#id_trabajador').append(data);
          $('#id_trabajador1').empty();
        $('#id_trabajador1').append(data);
        
      })
            $('.select-search').select2();   
     
    });
<?php
}else{?>
  $(function () {  

  $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":<?php echo $_SESSION['dni_usuario']; ?>},
  	function(data)
 	     {
 		   $('#calendar').fullCalendar( 'destroy' );
 		   $('#calendar').fullCalendar({
 	         height: 500,
 	         width: 100,
 	          slotDuration: tiempo,
       		 header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,listWeek,agendaDay'
			   },
			  defaultView: 'agendaWeek',
     	      defaultDate: new Date(),
     	      navLinks: true,
			   editable: false,
       eventResourceEditable: false,
             eventStartEditable: false,
			 eventLimit: false,
			 scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                     	"id":id,
                     	"fi":fi,
                     	"ff":ff

                     },

                     	function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                     	});
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                      	function(data){
                 	      $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                         $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);
                 	},"json");
                    },
                      eventResize: function(event, delta, revertFunc) {
             var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  
    }        
		     	});
 		   $( "body" ).scrollTop( 300 );
 	       },"json");



       });
<?php
}
?>














	  $("#id_trabajador").change(function(event) {
     var id=$("#id_trabajador").val(); 
  
     if(id!="-1")
      {
      	
       /*   var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
 	    $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");*/
 	   
 	    $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
 	     {
 		   $('#calendar').fullCalendar( 'destroy' );
 		   $('#calendar').fullCalendar({
 	         height: 500,
 	         width: 100,
 	          slotDuration: tiempo,
     /*       businessHours: {
    // days of week. an array of zero-based day of week integers (0=Sunday)
    dow: [ 1, 2, 3, 4 ], // Monday - Thursday

    start: '10:00', // a start time (10am in this example)
    end: '18:00', // an end time (6pm in this example)
},*/
/*minTime:"07:00:00",
maxTime:"20:00:00",*/
       		 header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,listWeek,agendaDay'
			   },
			  defaultView: 'agendaWeek',
     	      defaultDate: new Date(),
     	      navLinks: true,
			   editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
			 eventLimit: true,
			 scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                     	"id":id,
                     	"fi":fi,
                     	"ff":ff

                     },

                     	function(data){
                        if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      
                     	});
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                      	function(data){
                 	      $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                       $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);     
                 	},"json");
                    },
                      eventResize: function(event, delta, revertFunc) {

                     var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    } ,
             eventRender: function(event,element)
              {
                  var el=element.html();
                  element.html("<div style='width=20px !important;float=left;'>"+el+"</div> <div style='width=10%;color:red;text-aling:rigth;' class='close'>x</div>");

              }







		     	});
 		   $( "body" ).scrollTop( 300 );
 	       },"json");

}

	
});


$("#id_trabajador1").change(function(event) {

	if($("#id_trabajador1").val()!=$("#id_trabajador").val()){
	       var id=$("#id_trabajador1").val();
            var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
 	         $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");
		    $("#modal_remote").modal();
             

             id_horario=$("#id_horario").val();
             id_trabajador1=$("#id_trabajador1").val();
             $.post(base_url+"Ficha_enfoque/cambiarHorario", 
             	{"id_horario": id_horario,"id_trabajador1":id_trabajador1}, function(data, textStatus, xhr) {
                $("#modal_backdrop").modal("hide");
                  var id=$("#id_trabajador").val(); 

 $.post(base_url+"Ficha_enfoque/asesores",function(data){

          $('#id_trabajador1').empty();
        $('#id_trabajador1').append(data);
        
      })
                   
                                         if(id!="-1")
                                           {
        
       /*   var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");*/
     
      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
       {
       $('#calendar').fullCalendar( 'destroy' );
       $('#calendar').fullCalendar({
           height: 500,
           width: 100,
            slotDuration: tiempo,
           header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listWeek,agendaDay'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            navLinks: true,
         editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
       eventLimit: true,
       scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                        if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      
                      });
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                        function(data){
                        $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                       $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);     
                  },"json");
                    },
                      eventResize: function(event, delta, revertFunc) {

                     var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    }







          });
       $( "body" ).scrollTop( 300 );
         },"json");

}
             });

   

function horario()
{
 var id=$("#id_trabajador").val(); 
  
     if(id!="-1")
      {
        
       /*   var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");*/
     
      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
       {
       $('#calendar').fullCalendar( 'destroy' );
       $('#calendar').fullCalendar({
           height: 500,
           width: 100,
            slotDuration: tiempo,
     /*       businessHours: {
    // days of week. an array of zero-based day of week integers (0=Sunday)
    dow: [ 1, 2, 3, 4 ], // Monday - Thursday

    start: '10:00', // a start time (10am in this example)
    end: '18:00', // an end time (6pm in this example)
},*/
/*minTime:"07:00:00",
maxTime:"20:00:00",*/
           header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listWeek,agendaDay'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            navLinks: true,
         editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
       eventLimit: true,
       scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                        if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      
                      });
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                        function(data){
                        $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                       $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);     
                  },"json");
                    },
                      eventResize: function(event, delta, revertFunc) {

                     var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    } /*,
             eventRender: function(event,element)
              {
                  var el=element.html();
                  element.html("<div style='width=20px !important;float=left;'>"+el+"</div> <div style='width=10%;color:red;text-aling:rigth;' class='close'>x</div>");

              }*/







          });
       $( "body" ).scrollTop( 300 );
         },"json");

}


}


 	        $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
 	         {
              $('#calendar1').fullCalendar( 'destroy' );
 		       $('#calendar1').fullCalendar({
 	           height: 500,
 	          width: 100,
 	          slotDuration: tiempo,
       		 header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,listWeek,agendaDay'
			   },
			  defaultView: 'agendaWeek',
     	      defaultDate: new Date(),
     	      navLinks: true,
			 editable: true,
			 eventLimit: true,
			 scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                     	"id":id,
                     	"fi":fi,
                     	"ff":ff

                     },

                     	function(data){
                            if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        } 
                     	});
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                      	function(data){
                 	    $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                        $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                        $("#telefono").text(data.telefono);
                 	     },"json");
                    },
                  
                      eventResize: function(event, delta, revertFunc) {
             var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    }    
		     	});
 	       },"json");






 	}else{
      alerta2("Error","no se puede selecionar el mismo asesor");
 	}
	
});


$("#guardarInformacion").click(function(event) {
	
	$.post(base_url+"Horario/actualizacion_datos",$("#formulario").serialize(),function(data){
       alerta1("Registado Correctamente","exitos en la actualizacion del horario");
	});
	horario();
});


$("#elimnarhorario").click(function(event) {
 //alert($("#id_horario").val());
    if(!confirm("¿estas seguro ?")){
                     // revertFunct();
                 }
                 else{
 $.post(base_url+"Horario/eliminar", {"idhorario": $("#id_horario").val()}, function(data, textStatus, xhr) {
         var id=$("#id_trabajador").val(); 
          if(id!="-1")
      {
        
       /*   var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");*/
     
      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
       {
       $('#calendar').fullCalendar( 'destroy' );
       $('#calendar').fullCalendar({
           height: 500,
           width: 100,
            slotDuration: tiempo,
     /*       businessHours: {
    // days of week. an array of zero-based day of week integers (0=Sunday)
    dow: [ 1, 2, 3, 4 ], // Monday - Thursday

    start: '10:00', // a start time (10am in this example)
    end: '18:00', // an end time (6pm in this example)
},*/
/*minTime:"07:00:00",
maxTime:"20:00:00",*/
           header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listWeek,agendaDay'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            navLinks: true,
         editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
       eventLimit: true,
       scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                        if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      
                      });
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                        function(data){
                        $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                       $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);     
                  },"json");
                    },
                      eventResize: function(event, delta, revertFunc) {

                     var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    } /*,
             eventRender: function(event,element)
              {
                  var el=element.html();
                  element.html("<div style='width=20px !important;float=left;'>"+el+"</div> <div style='width=10%;color:red;text-aling:rigth;' class='close'>x</div>");

              }*/







          });
       $( "body" ).scrollTop( 300 );
         },"json");


       alerta1("Correctamente","se realizo La eliminacion de horario correctamente");
   }
   else{
    alert(data);
   }
   
 
});

 }

     });

$("#cortar").click(function(event) {
 //alert($("#id_horario").val());
    if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
 $.post(base_url+"Horario/cortar", {"idhorario": $("#id_horario").val()}, function(data, textStatus, xhr) {
   if(data=="1"){
       var id=$("#id_trabajador").val(); 
  
     if(id!="-1")
      {
        
       /*   var opcion_seleccionada = $("#id_trabajador1 option[value="+id+"]").text();
      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");*/
     
      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)
       {
       $('#calendar').fullCalendar( 'destroy' );
       $('#calendar').fullCalendar({
           height: 500,
           width: 100,
            slotDuration: tiempo,
     /*       businessHours: {
    // days of week. an array of zero-based day of week integers (0=Sunday)
    dow: [ 1, 2, 3, 4 ], // Monday - Thursday

    start: '10:00', // a start time (10am in this example)
    end: '18:00', // an end time (6pm in this example)
},*/
/*minTime:"07:00:00",
maxTime:"20:00:00",*/
           header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,listWeek,agendaDay'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            navLinks: true,
         editable: false,
       eventResourceEditable: false,
             eventStartEditable: true,
       eventLimit: true,
       scrollTime:  moment().format('H:m'),
             events:data,
             eventDrop: function(event,delta,revertFunct){
                var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_horario",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                        if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      
                      });
                 }
             },
              eventClick:function(event,jsEvent,view){
                     $("#modal_backdrop").modal();
                        $.post(base_url+"Horario/datos",{"id":event.id},
                        function(data){
                        $("#id_horario").val(event.id);
                        $("#value").val(data.titulo);
                        $("#descripcion").val(data.descripcion);
                        $("#inicio").text(data.inicio);
                        $("#fin").text(data.fin);
                       $("#cliente").text(data.nombres);
                        $("#universidad").text(data.universidad);
                            $("#telefono").text(data.telefono);     
                  },"json");
                    },
                      eventResize: function(event, delta, revertFunc) {

                     var id=event.id;
                var fi=event.start.format();
                var ff=event.end.format();
                 if(!confirm("¿estas seguro ?")){
                      revertFunct();
                 }
                 else{
                     $.post(base_url+"Horario/editar_tamano",{
                      "id":id,
                      "fi":fi,
                      "ff":ff

                     },

                      function(data){
                             if(data=="0"){
                          alert("no se puede poner en esa fecha el tiempo porque ya paso");
                             revertFunct();
                        }
                      });
                      }  

    } /*,
             eventRender: function(event,element)
              {
                  var el=element.html();
                  element.html("<div style='width=20px !important;float=left;'>"+el+"</div> <div style='width=10%;color:red;text-aling:rigth;' class='close'>x</div>");

              }*/







          });
       $( "body" ).scrollTop( 300 );
         },"json");

}
       alerta1("Correctamente","se realizo el corte  de horario correctamente");
   }
   else{
    alert(data);
   }
   
 });

}
});

</script>