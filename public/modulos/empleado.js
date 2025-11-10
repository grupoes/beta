$(function () {
	$("#titulo").text("Lista de empleados en "+empresa);
	 $("#table_sistema").DataTable().destroy();
     $("#table_sistema").DataTable();
});

function nuevo(){
     $("#titulo").text("Nuevo empleado en "+empresa); reload();
     $.get(base_url+"empleados/new_empleado",function(data){
          $('#cont_sistema').empty().html(data);
     });
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"empleados/save_empleado",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","EMPLEADO REGISTRADO - Se Agregó Un Empleado");
			}else{
				alerta("info","EMPLEADO ACTUALIZADO - Se Actualizó Un Empleado");
			}
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('empleados','seguridad');
	});
	return false;
}

function modificar(id){
	$("#titulo").text("Modificar empleado en "+empresa); reload();
     $.get(base_url+"empleados/new_empleado",function(data){
     		$.post(base_url+"empleados/update_empleado",{'id':id},function(info){
     			$('#cont_sistema').empty().html(data);
     			var datos = eval(info);
     			$("#id").val(datos[0]["usu_id"]);
     			$("#dni").val(datos[0]["usu_dni"]);
     			$("#nombres").val(datos[0]["usu_nombres"]);
     			$("#apellidos").val(datos[0]["usu_apellidos"]);
     			$("#direccion").val(datos[0]["usu_direccion"]);
     			$("#email").val(datos[0]["usu_email"]);
     			$("#usuario").val(datos[0]["usu_usuario"]);
     			$("#clave").val(datos[0]["usu_clave"]);
     			$("#celular").val(datos[0]["usu_celular"]);
     			$("#sexo").val(datos[0]["usu_sexo"]);
     			$("#fechanac").val(datos[0]["usu_fechanac"]);
     			$("#perfil").val(datos[0]["usu_perfil"]);
		});
     });
}

var idmant = 0;
function confirmar(id){
	idmant = id;
	$("#confirmar").modal("show");
}

function eliminar(){
	$.post(base_url+"empleados/delete_empleado",{'id':idmant},function(data){
		if(data==1){
			alerta("info","EMPLEADO ELIMINADO - Se Eliminó Un Empleado");
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		$("#confirmar").modal("hide");
		reload_url('empleados','seguridad');
	});
}