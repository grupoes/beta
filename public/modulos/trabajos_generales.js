$(function () {
       //$("#table_sistema").DataTable({ } );
       $("#titulo").text("Reportes");
       $("#subtitulo").text('Lista de Trabajos ');
    });


$("#data").change(function(event) {
  //  alert($("#data").val());
    if($("#data").val()!=""){
    $.post(base_url+"Trabajos_generales/data", {"data": $("#data").val()}, function(data, textStatus, xhr) {
     // alert(data.data);
      $("#info1").empty();
      $("#info1").append(data.data);
      $("#info").html(data.titulo);
 
    },"json");
  }
  else
  {
    $("#info").html("por favor");
       $("#info1").empty();
    $("#info1").append("<option>seleccionar la clasificacion</option>");
  
  }
});
$("#info1").change(function(event) {
   $("#info1").val();
});



    
     		
     

