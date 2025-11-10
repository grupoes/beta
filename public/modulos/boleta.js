
	$(function () {
     $("#table_sistema").DataTable().destroy();
       $("#table_sistema").DataTable({ } );
       $("#titulo").text("Contabilidad");
       $("#subtitulo").text('Lista de Empresas');   

    //  $("#cuerpo").addClass('animated bounceIn');
    });

    function nuevo(){
     reload();
      $("#subtitulo").text('Nueva de categoria');
     $.get(base_url+"Categoria/nuevo",function(data){
          $('#cont_sistema').empty().html(data);
     });
}
    function guardar(){
     		
	//$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Categoria/registrar",$("#formulario").serialize(),function(data){

    if(data=="2"){
     swal("muy bien!", "Se actualizo Correctamente!", "success");
    }
    else{
        swal("muy bien!", "Se Ingreso Correctamente!", "success");
    }
	});
 reload_url('Categoria','mantenimiento');

    }


function modificar(id){
	/*$("#titulo").text("Modificar cliente en "+empresa);*/ reload();
     $("#subtitulo").text('Actualizar de categoria');
     		$.post(base_url+"Categoria/actualizar",{'id':id},function(data){
     			
                $('#cont_sistema').empty().html(data);

     			
		});

     		
     
}
function registrar(id)
{
 // alert(id);
  $.post(base_url+"Boletas/tipo",{"id":id},function(data){
   $('#cont_sistema').empty().html(data);
  });
}



