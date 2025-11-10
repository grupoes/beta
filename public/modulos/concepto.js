$(function () {
	$("#titulo").text("Lista de conceptos en "+empresa);
     $("#table_sistema").DataTable();
});

function nuevo(){
     $("#titulo").text("Nuevo concepto en "+empresa); reload();
     $.get(base_url+"conceptos/new_concepto",function(data){
          $('#cont_sistema').empty().html(data);
     });
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"conceptos/save_concepto",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","CONCEPTO REGISTRADO - Se Agregó Un Concepto");
			}else{
				alerta("info","CONCEPTO ACTUALIZADO - Se Actualizó Un Concepto");
			}
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('conceptos','administracion_caja');
	});
	return false;
}

function modificar(id){
	$("#titulo").text("Modificar concepto en "+empresa); reload();
     $.get(base_url+"conceptos/new_concepto",function(data){
     		$.post(base_url+"conceptos/update_concepto",{'id':id},function(info){
     			$('#cont_sistema').empty().html(data);
     			var datos = eval(info);
     			$("#id").val(datos[0]["con_id"]);
     			$("#descripcion").val(datos[0]["con_descripcion"]);
     			$("#tipomovimiento").val(datos[0]["id_tipo_movimiento"]);
		});
     });
}

var idmant = 0;
function confirmar(id){
	idmant = id;
	$("#confirmar").modal("show");
}

function eliminar(){
	$.post(base_url+"conceptos/delete_concepto",{'id':idmant},function(data){
		if(data==1){
			alerta1("info","CONCEPTO ELIMINADO - Se Eliminó Un Concepto");
		}else{
			alerta2("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		$("#confirmar").modal("hide");
		reload_url('conceptos','administracion_caja');
	});
}