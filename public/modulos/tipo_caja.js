$(function () {
	$("#titulo").text("Lista de cajas en "+empresa);
  $("#table_sistema").DataTable().destroy();
       $("#table_sistema").DataTable({ } );
});

function nuevo(){
     $("#titulo").text("Nueva caja en "+empresa); reload();
     $.get(base_url+"Tipo_caja/new_caja",function(data){
          $('#cont_sistema').empty().html(data);
     });
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Tipo_caja/save_caja",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","CAJA REGISTRADO - Se Agregó Una Caja");
			}else{
				alerta("info","CAJA ACTUALIZADO - Se Actualizó Una Caja");
			}
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('Tipo_caja','administracion_caja');
	});
	return false;
}

function modificar(id){
	$("#titulo").text("Modificar caja en "+empresa); reload();
     $.get(base_url+"Tipo_caja/new_caja",function(data){
     		$.post(base_url+"Tipo_caja/update_caja",{'id':id},function(info){
     			$('#cont_sistema').empty().html(data);
     			var datos = eval(info);
     			$("#id").val(datos[0]["id_caja"]);
     			$("#descripcion").val(datos[0]["caja_descripcion"]);
		});
     });
}

var idmant = 0;
function confirmar(id){
	idmant = id;
	$("#confirmar").modal("show");
}

function eliminar(id){
	var config=confirm("¿Esta seguro que desea eliminar?");
	if(config==true){
	$.post(base_url+"Tipo_caja/delete_caja",{'id':id},function(data){
		if(data==1){
			alerta("info","CAJA ELIMINADO - Se Eliminó Una Caja");
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		$("#confirmar").modal("hide");
		reload_url('Tipo_caja','administracion_caja');
	});
    }
}