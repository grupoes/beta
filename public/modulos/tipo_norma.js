$(function () {
       $("#table_sistema").DataTable({ } );
       $("#titulo").text("Mantenimiento");
       $("#subtitulo").text('Lista de Tipos de norma');
    });

    function nuevo(){
     reload();
      $("#subtitulo").text('Nuevo tipo de norma');
     $.get(base_url+"Tipo_norma/nuevo",function(data){

          $('#cont_sistema').empty().html(data);
     });
}
    function guardar(){
     		
	//$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Tipo_norma/registrar",$("#formulario").serialize(),function(data){
 
    if(data=="2"){
     swal("muy bien!", "Se actualizo Correctamente!", "success");
    }
    else{
        swal("muy bien!", "Se Ingreso Correctamente!", "success");
    }
	});
 reload_url('Tipo_norma','mantenimiento');

    }


function modificar(id){
	/*$("#titulo").text("Modificar cliente en "+empresa);*/ reload();
     $("#subtitulo").text('Actualizar grado');
     		$.post(base_url+"Tipo_norma/actualizar",{'id':id},function(data){
     			       // alert(data);
                $('#cont_sistema').empty().html(data);

     			
		});
}
 function eliminar(id){
	

    swal({
  title: "¿Estas segur que desea eliminar?",
  text: "Una vez eliminado el dato ya nose se podra recuperar",
  type: "warning",
 
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "si,lo deseo",
  closeOnConfirm: false
},
function(){

    $.post(base_url+"Tipo_norma/eliminar",{'id':id},function(data){
                   swal("Deleted!", "Se Elimino Correctamente", "success");
                  reload_url('Tipo_norma','mantenimiento');
        });

});
	
     		
     
}
