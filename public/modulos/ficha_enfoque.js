
	$(function () {
     $("#table_sistema").DataTable().destroy();
       $("#table_sistema").DataTable({ } );
       $("#titulo").text("Mantenimiento");
       $("#subtitulo").text('Lista de fichas de enfoques');
     
    });
  

function nuevo(){
     reload();
      $("#subtitulo").text('Nueva ficha de enfoque');
     $.get(base_url+"Ficha_enfoque/nuevo",function(data){
          $('#cont_sistema').empty().html(data);
     });
}
    function guardar()
    {
     		
	//$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Especialidad/registrar",$("#formulario").serialize(),function(data){
    
      if(data=="2"){
     swal("muy bien!", "Se actualizo Correctamente!", "success");
    }
    else{
        swal("muy bien!", "Se Ingreso Correctamente!", "success");
    }
	});
 reload_url('Especialidad','mantenimiento');

    }

   function guardar_ficha_enfoque(){
     $.post(base_url+'Ficha_enfoque/guardar_ficha_admin', {id: 'value1'}, function(data, textStatus, xhr) {
       /*optional stuff to do after success */
     });

   }

function modificar(id){
	/*$("#titulo").text("Modificar cliente en "+empresa);*/ reload();
     $("#subtitulo").text('Actualizar de ficha de enfoque');
     		$.post(base_url+"Ficha_enfoque/actualizar",{'id':id},function(data){
     			   //alert(data);
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

    $.post(base_url+"Especialidad/eliminar",{'id':id},function(data){
                   swal("Deleted!", "Se Elimino Correctamente", "success");
                  reload_url('Especialidad','mantenimiento');
        });

});
	
     		
     
}