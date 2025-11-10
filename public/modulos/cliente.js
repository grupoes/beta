$(function () {
	$("#titulo").text("Lista de clientes en "+empresa);
     $("#table_sistema").DataTable();
});

function nuevo(){
     $("#titulo").text("Nuevo cliente en "+empresa); reload();
     $.get(base_url+"clientes/new_cliente",function(data){
          $('#cont_sistema').empty().html(data);
     });
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"clientes/save_cliente",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","CLIENTE REGISTRADO - Se Agregó Un Cliente");
			}else{
				alerta("info","CLIENTE ACTUALIZADO - Se Actualizó Un Cliente");
			}
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('clientes','seguridad');
	});
	return false;
}

function modificar(id){
	$("#titulo").text("Modificar cliente en "+empresa); reload();
     $.get(base_url+"clientes/new_cliente",function(data){
     		$.post(base_url+"clientes/update_cliente",{'id':id},function(info){
     			$('#cont_sistema').empty().html(data);
     			var datos = eval(info);
     			$("#id").val(datos[0]["cli_id"]);
     			$("#dni").val(datos[0]["cli_dni"]);
     			$("#nombres").val(datos[0]["cli_nombres"]);
     			$("#apellidos").val(datos[0]["cli_apellidos"]);
     			$("#direccion").val(datos[0]["cli_direccion"]);
     			$("#celular").val(datos[0]["cli_celular"]);
     			$("#sexo").val(datos[0]["cli_sexo"]);
     			$("#fechanac").val(datos[0]["cli_fechanac"]);
		});
     });
}

var idmant = 0;
function confirmar(id){
	idmant = id;
	$("#confirmar").modal("show");
}

function eliminar(){
	$.post(base_url+"clientes/delete_cliente",{'id':idmant},function(data){
		if(data==1){
			alerta("info","CLIENTE ELIMINADO - Se Eliminó Un Cliente");
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		$("#confirmar").modal("hide");
		reload_url('clientes','seguridad');
	});
}