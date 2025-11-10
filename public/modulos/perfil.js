$(function () {
	$("#table_sistema").DataTable();

});
function nuevo(){
	$("#titulo").text("Nuevo modulo en "+empresa); reload();
	$.get(base_url+"Perfiles_c/new_perfil",function(data){
		$('#cont_sistema').empty().html(data);
	});
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Perfiles_c/save_perfil",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","PERFIL REGISTRADO - Se Agregó Un Perfil");
			}else{
				alerta("info","PERFIL ACTUALIZADO - Se Actualizó Un Perfil");
			}
		}else{
			alert("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('Perfiles_c','Seguridad');
	});
	return false;
}

function modificar(id){
	reload();
	$.get(base_url+"Perfiles_c/new_perfil",function(data){
		$.post(base_url+"Perfiles_c/update_perfil",{'id':id},function(info){
			$('#cont_sistema').empty().html(data);
			var datos = eval(info);
			$("#id").val(datos[0]["per_id"]);
			$("#perfil").val(datos[0]["per_descripcion"]);
			$("#descripcion").val(datos[0]["observacion"]);
		});
	});
}

function eliminar(idmant){
	swal({
		title: "Esta seguro?",
		text: "Esto sera eliminado!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#EF5350",
		confirmButtonText: "Si, eliminar esto!",
		cancelButtonText: "No, Cancelar!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm) {
			$.post(base_url+"Perfiles_c/delete_perfil",{'id':idmant},function(data){
				if(data==1){
					alerta("info","PERFIL ELIMINADO - Se Eliminó Un Perfil");
				}else{
					alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
				}
				$("#confirmar").modal("hide");
				reload_url('Perfiles_c','seguridad');
			});
		}
		else {
			 swal({
                    title: "Cancelado",
                    text: "Tu informacion, no fue eliminada :)",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
		}
	});
}