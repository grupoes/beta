
	$(function () {
       $("#table_sistema").DataTable({ } );
       $("#titulo").text("Mantenimiento");
       $("#subtitulo").text('Lista de universidades');   

    //  $("#cuerpo").addClass('animated bounceIn');
    });

    function nuevo(){
     reload();
      $("#subtitulo").text('Nueva universidad');
     $.get(base_url+"Universidad/nuevo",function(data){
          $('#cont_sistema').empty().html(data);
     });
}
    function guardar(){
     		
	//$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Universidad/registrar",$("#formulario").serialize(),function(data){

    if(data=="2"){
     swal("muy bien!", "Se actualizo Correctamente!", "success");
    }
    else{
        swal("muy bien!", "Se Ingreso Correctamente!", "success");
    }
	});
 reload_url('Universidad','mantenimiento');

    }


function modificar(id){
	/*$("#titulo").text("Modificar cliente en "+empresa);*/ reload();
     $("#subtitulo").text('Actualizar universidad');
     		$.post(base_url+"Universidad/actualizar",{'id':id},function(data){
     			
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

    $.post(base_url+"Universidad/eliminar",{'id':id},function(data){
                   swal("Deleted!", "Se Elimino Correctamente", "success");
                  reload_url('Universidad','mantenimiento');
        });

});
	
     		
     
}


