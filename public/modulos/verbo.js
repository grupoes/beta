$(function () {
	$("#titulo").text("Lista de Verbos en "+empresa);
     $("#table_sistema").DataTable();
});

function nuevo(){
	$("#titulo").text("Nuevo verbo en "+empresa); reload();
	$.get(base_url+"Verbo/new_modulo",function(data){
		$('#cont_sistema').empty().html(data);
	});
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Verbo/save_modulo",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","MODULO REGISTRADO - Se Agregó Un Modulo");
			}else{
				alerta("info","MODULO ACTUALIZADO - Se Actualizó Un Modulo");
			}
		}else{
			alert("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('Verbo','Seguridad');
	});
	return false;
}

function modificar(id){
	reload();
	$.get(base_url+"Verbo/new_modulo",function(data){
		$.post(base_url+"Verbo/update_modulo",{'id':id},function(info){
			$('#cont_sistema').empty().html(data);
			var datos = eval(info);
			$("#id").val(datos[0]["ver_id"]);
			$("#tipoverbo").val(datos[0]["tiv_id"]);
			$("#verbo").val(datos[0]["ver_verbo"]);
			$("#observacion").val(datos[0]["ver_observacion"]);
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
			$.post(base_url+"Verbo/delete_modulo",{'id':idmant},function(data){
				if(data==1){
					alerta("info","VERBO ELIMINADO - Se Eliminó Un Modulo");
				}else{
					alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
				}
		
				reload_url('Verbo','mantenimiento');
			});
			 swal({
                    title: "Cancelado",
                    text: "Tu informacion,  fue eliminada :)",
                    confirmButtonColor: "#2196F3",
                    type: "success"
                });
		}
		else {
			 swal({
                    title: "Cancelado",
                    text: "Tu informacion, no fue eliminada :(",
                    confirmButtonColor: "#2196F3",
                    type: "error"
                });
		}
	});
}