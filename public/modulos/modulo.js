$(function () {
	$("#titulo").text("Lista de modulos en "+empresa);
     $("#table_sistema").DataTable();
});

function nuevo(){
	$("#titulo").text("Nuevo modulo en "+empresa); reload();
	$.get(base_url+"Modulo_c/new_modulo",function(data){
		$('#cont_sistema').empty().html(data);
	});
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Modulo_c/save_modulo",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","MODULO REGISTRADO - Se Agregó Un Modulo");
			}else{
				alerta("info","MODULO ACTUALIZADO - Se Actualizó Un Modulo");
			}
		}else{
			alert("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('Modulo_c','Seguridad');
	});
	return false;
}

function modificar(id){
	reload();
	$.get(base_url+"Modulo_c/new_modulo",function(data){
		$.post(base_url+"Modulo_c/update_modulo",{'id':id},function(info){
			$('#cont_sistema').empty().html(data);
			var datos = eval(info);
			$("#id").val(datos[0]["mod_id"]);
			$("#modulo").val(datos[0]["mod_descripcion"]);
			$("#url").val(datos[0]["mod_url"]);
			$("#icono").val(datos[0]["mod_icono"]);
			$("#padre").val(datos[0]["mod_padre"]);
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
			$.post(base_url+"Modulo_c/delete_modulo",{'id':idmant},function(data){
				if(data==1){
					alerta("info","MODULO ELIMINADO - Se Eliminó Un Modulo");
				}else{
					alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
				}
				$("#confirmar").modal("hide");
				reload_url('Modulo_c','seguridad');
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