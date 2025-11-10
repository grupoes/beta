$( document ).ready(function(){
//   Hide the border by commenting out the variable below
var $on = 'section';
$($on).css({
	'background':'none',
	'border':'none',
	'box-shadow':'none'
});
});

function traer_permisos(id){
	$("#titulo").text("Traer Permisos"+empresa); reload();
	$.get(base_url+"Permisos_c/index",{'id':id},function(data){
		$('#cont_sistema').html(data);
		$("#perfil option[value="+ id +"]").attr("selected",true);
	});
}

function enviar_permisos(){
	$.post(base_url+"Permisos_c/save_permisos",$("#form_permisos").serialize(),function(data){
		if(data==1){
			alerta("success","PERMISOS REGISTRADOS - Se Registró Permisos Correctamente");
		}else{
			alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		setTimeout(location.reload(),10000);
	});
}
