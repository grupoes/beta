$(function () {
	$("#titulo").text("Estado de la caja "+empresa);
});

function confirmarcierre() {
	$("#confirmarcierre").modal("show");
}

function confirmarapertura(){
	$("#btn_apertura").attr("disabled","true");
	$.get(base_url+"Sesion_caja/apertura_caja",function(data){
		alerta("success","CAJA ABIERTA - Se Abrio correctamente la Caja");
		setTimeout(ir_caja, 800);
	});
}

function cerrarcaja(){
	$("#btn_cierrecaja").attr("disabled","true");
	$.get(base_url+"Sesion_caja/close_sesioncaja",function(data){
		$("#confirmarcierre").modal("hide");
		alerta("success","CAJA CERRADA - Se Cerró correctamente la Caja");
		setTimeout(ir_caja, 800);
	});
}

function ir_caja(){
	reload_url('sesion_caja','caja');
}