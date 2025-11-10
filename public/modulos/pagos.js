$(function () {
 $("#table_sistema").DataTable().destroy();
       $("#table_sistema").DataTable({ } );
       $("#titulo").text("Tesis");
       $("#subtitulo").text('Lista de Pagos');
});


// funciones para la amortizacion de pago
function amortizar(id,cliente){
	$("#btn_confirm").removeAttr("disabled");
     $("#subtitulo").text("Pago de prestamo por "+cliente); reload();
     $.get(base_url+"Pagos/amortizar_prestamo",{'id':id,'cliente':cliente},function(data){
     	//alert(data);
          $('#cont_sistema').empty().html(data); $("#idprestamo").val(id);
     	});
}





function confirm_cobro(){
	if($("#fechapago").val()==""){
		$("#fechapago").focus(); return 0;
	}
	if($("#monto").val()==""){
		$("#monto").focus(); return 0;
	}
	if($("#id_caja").val()==""){
		$("#id_caja").focus(); return 0;
	}
	if (parseFloat($("#monto").val())>parseFloat($("#montototal").val())) {
		alerta2("error","EL MONTO RESTANTE SOLO ES "+$("#montototal").val()+" Verifique el monto ingresado");
	}else{
		$("#titleconfirm").text("Seguro realizar cobro de S/. "+$("#monto").val()+"?");
		$("#contenconfirm").text("Usted realizará un cobro de S/. "+$("#monto").val());
		$("#confirmargeneral").modal("show");
	}
}

function confirmar(){

	$.post(base_url+"Pagos/realizar_amortizacion",$("#form_amortizacion").serialize(),function(data){
	
		if(data==1){
			alerta("success","COBRO PRESTAMO REALIZADO - Se Realizó Un Cobro por Prestamo");
		}else{
			alerta2("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		//$("#confirmargeneral").modal("hide");
  setTimeout(function(){	reload_url('Pagos','tesis'); }, 500);
		
     	});
	
}