$(function () {
       //$("#table_sistema").DataTable({ } );
       $("#titulo").text("Reportes");
       $("#subtitulo").text('Lista de Morosos');

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

function generar1(){
  //alert("hola");
 tipocliente=$("#tipocliente").val();
 data=$("#data").val();
 info=$("#info1").val();
 fechainicio=$("#fechainicio").val();
fechafin=$("#fechafin").val();
 //alert(tipocliente);
 $.post(base_url+"Moroso/info", 
  {
    "tipocliente": tipocliente,
    "data":data,
    "info":info,
   
     "fechainicio":fechainicio,
     "fechafin":fechafin
}, 
  function(data, textStatus, xhr) {
   //alert(data);
   $("#datos").empty();
   $("#datos").append(data);
 });
}
    
     		
     

