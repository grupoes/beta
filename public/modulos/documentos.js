
function ver(id){
	$("#titulo").text("Nuevo modulo en "+empresa); reload();
	$.post(base_url+"Documentos_c/new_documento",{'id':id},function(data){
		$("#table_sistema").DataTable();
		$('#cont_sistema').empty().html(data);
	});
}
function modificar1(id){
	/*$("#titulo").text("Modificar cliente en "+empresa);*/ reload();
     $("#subtitulo").text('Actualizar de ficha de enfoque');
     		$.post(base_url+"Ficha_enfoque/actualizar",{'id':id},function(data){
     			   //alert(data);
                $('#cont_sistema').empty().html(data);

     			
		});
}

function nuevo1(){
	$("#titulo").text("Nuevo antecente en "+empresa); reload();
	$.get(base_url+"Documentos_c/nuevo_antecedente",function(data){
		$('#cont_sistema').empty().html(data);
	});
}


function finalizar(id){

    swal({
  title: "CONDICIONES Y TERMINOS",
  text: "Usted eligio la opcion de finalizar el desarrollo de la tesis,si acepta esta condicion usted confirmara que la tesis se realizo todo correctamente y ya no necesita los servicios de Grupo ES consultores. Si desea posteriormente hacer algun cambio debera acercarse a la empresa",
  type: "success",
 
  showCancelButton: true,
  confirmButtonColor: "rgb(76, 175, 80)",
  confirmButtonText: "si,lo deseo",
  closeOnConfirm: false
},
function(){

    $.post(base_url+"Ficha_enfoque/finalizar",{'id':id},function(data){
                   swal("FINALIZAR TESIS", "SE FINALIZO CORRECTAMENTE LA TESIS", "success");
                 reload_url('Documentos_c','produccion');
        });

});
}
function abrirEnPestana(url) {
	   	var url=base_url+"pdf/crear.php?id="+url;
		var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
	}
 
function abrirEnPestana1(url) {
var dat =url;
$.post(base_url+"Documentos_c/buscar",{'id':url},function(data){

     if(data!="1"){
      	var url=base_url+"pdf/contrato_contado.php?id_enfoque="+dat;
		var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();

     }
     else{

            	var url=base_url+"pdf/contrato_credito.php?id_enfoque="+dat;
		var a = document.createElement("a");
		a.target = "_blank";
		a.href = url;
		a.click();
     }
	  


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

 function seleccionar(id)
{
  // alert(id);
   /*$("#datos").modal();
   $("#id_ficha").val(id);*/
   	$.post(base_url+"Documentos_c/seleccionables",{
             "id":  id
		},function(data){
   $('#cont_sistema').empty().html(data);
	   
          
         });
   
}
