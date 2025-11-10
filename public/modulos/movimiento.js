$(function () {
	$("#titulo").text("Lista de movimientos hoy en "+empresa);
     $("#table_sistema").DataTable(); //validar_caja();
     validarcaja(); 
 });

function nuevo(id){
	$("#titulo").text("Nuevo movimiento en "+empresa); reload();
	$.get(base_url+"movimiento/new_movimiento",{'tipomovi':id},function(data){
		$('#cont_sistema').empty().html(data);
		$("#tipomovi").val(id);
	});
}

function transferencia(id){
	$("#titulo").text("Nuevo transferencia en "+empresa); reload();
	$.get(base_url+"movimiento/new_transferencia",{'tipomovi':id},function(data){
		$('#cont_sistema').empty().html(data);
		$("#tipomovi").val(id);
	});
}

function guardar(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"movimiento/save_movimiento",$("#formulario").serialize(),function(data){
		if(data==1){
			alerta("success","TRANSFERENCIA REGISTRADO - Se Registró Un nuevo Movimiento");
		}else{
			alerta2("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('movimiento','caja');
	});
	return false;
}

function transferir(){
	$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"movimiento/save_transferencia",$("#formulario").serialize(),function(data){
		if(data==1){
			alerta("success","MOVIMIENTO REGISTRADO - Se Registró Un nuevo Movimiento");
		}else{
			alerta2("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('movimiento','caja');
	});
	return false;
}

function confirmar(id){
	idmant = id;
	$("#confirmar").modal("show");
}

function confirmarextornar(){
	$("#btn_extornar").attr("disabled","true");
	$.get(base_url+"Movimiento/extornar",{"id" : idmant},function(data){
		$("#confirmar").modal("hide");
		 elem = data.split('-');
		 if(elem[0] == 1) {
		 	
		alerta("success","Extornación - Se extorno correctamente, Tiene de saldo" +elem[1] );
	}else{
		if(elem[0] == 2){
			alerta("success","No hay dinero suficiente en caja ");
		}else{
			alerta("success","Usted no tiene permiso ");
		}
		
	}
	setTimeout(function(){ reload_url('movimiento','caja'); }, 800);
		

	});
}

function eliminar(){
	$.post(base_url+"movimientos/delete_movimiento",{'id':idmant},function(data){
		if(data==1){
			alerta("info","MOVIMIENTO EXTORNADO - Se Extorno Un Movimiento");
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		$("#confirmar").modal("hide");
		reload_url('movimientos','administracion_caja');
	});
}

//Para pagar empleados
function pagar_empleado(){
	$("#titulo").text("Realizar pago empleados "+empresa); reload();
	$.get(base_url+"movimientos/pagar_empleado",function(data){
		$('#cont_sistema').empty().html(data);
		$("#tipomovi").val(id);
	});
}

