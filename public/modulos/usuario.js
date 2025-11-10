$(function () {
	$("#table_sistema").DataTable();
});

function nuevo(){
	
	$("#titulo").text("Nuevo modulo en "+empresa); reload();
	$.get(base_url+"Usuario_c/new_asesor",function(data){
		$('#cont_sistema').empty().html(data);
	});

}

function agregar(id){
	if(id==1){
		if($("#dni").val()==''){
			alert('Aun no a ingresado su D.N.I');
		}else{
			$("#usuario").val($("#dni").val());
			$("#activar").hide();
			$("#desactivar").show();
		}		
	}else{
		var caracteres = "abcdefghijkmnpqrtuvwxyzABCDEFGHIJKLMNPQRTUVWXYZ2346789";
		var contraseña = "";
		for (i=0; i<8; i++) contraseña += caracteres.charAt(Math.floor(Math.random()*caracteres.length));
			$("#clave").val(contraseña);
		$("#desactivarc").show();
	}
	
}

function quitar(id){
	if(id==1){
		$("#usuario").val('');
		$("#activar").show();
		$("#desactivar").hide();
	}else{
		$("#clave").val($("#dni").val());
		$("#clave").prop('disabled', false);
		$("#activacontraseñar").show();
		$("#desactivar").hide();
	}
}

function guardar(){
	//$("#btn_guardar").attr("disabled","true");
	$.post(base_url+"Usuario_c/savetrabajador",$("#formulario").serialize(),function(data){
	//	alert(data);
		if(data==1){
			if($("#id").val()==""){
				alerta("success","USUARIO REGISTRADO - Se Agregó Un Usuario");
			}else{
				alerta("info","USUARIO ACTUALIZADO - Se Actualizó Un Usuario");
			}
			if($("#valor").val() == 1){
				$("#files").upload(base_url+"Usuario_c/savefoto",{nombre_archivo: $("#nombre_archivo").val(),dni: $("#dni").val() },
				 function(respuesta) {

                });
			}
			
		}else{
			alert("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('Usuario_c','Seguridad');
	});
return false;
}

function guardarcliente(){
	$("#btn_guardarc").attr("disabled","true");
	$.post(base_url+"Usuario_c/savecliente",$("#formulario").serialize(),function(data){
		if(data==1){
			if($("#id").val()==""){
				alerta("success","USUARIO REGISTRADO - Se Agregó Un Usuario");
			}else{
				alerta("info","USUARIO ACTUALIZADO - Se Actualizó Un Usuario");
			}
			if($("#valor").val() == 1){
				$("#files").upload(base_url+"Usuario_c/savefoto",{nombre_archivo: $("#nombre_archivo").val(),dni: $("#dni").val() },
				 function(respuesta) {
                });
			}
			
		}else{
			alert("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
		}
		reload_url('Usuario_c','Seguridad');
	});
return false;
}



  function mostrarRespuesta(mensaje, ok){
                $("#respuesta").removeClass('alert-success').removeClass('alert-danger').html(mensaje);
                if(ok){
                    $("#respuesta").addClass('alert-success');
                }else{
                    $("#respuesta").addClass('alert-danger');
                }
            }
function modificar(dni,rol){
	reload();
	var id = 4;
	if(rol != 'Cliente'){
		$.get(base_url+"Usuario_c/new_asesor",function(data){
			$.post(base_url+"Usuario_c/update_asesor",{'dni':dni},function(info){
				$('#cont_sistema').empty().html(data);
				var datos = eval(info);
				$("#id").val(datos[0]["dni"]);
				$("#nombre").val(datos[0]["nombres"]);
				$("#apellido").val(datos[0]["apellidos"]);
				$("#direccion").val(datos[0]["direccion"]);
				$("#correo").val(datos[0]["correo"]);
				$("#sede option[value="+datos[0]["usu_sede"]+"]").prop('selected', 'selected').change();
				$("#ncuenta").val(datos[0]["n_cuenta_bcp"]);
				$("#celular").val(datos[0]["telefono"]);
				$("#dni").val(datos[0]["dni"]);
				$("#anytime-month-numeric").val(datos[0]["fecha_nac"]);
				$("#imag").attr('src', base_url+'public/perfil/'+datos[0]["usu_foto"]);
                
				$("#perfil option[value="+datos[0]["usu_perfil"]+"]").prop('selected', 'selected').change();
				if(datos[0]["usu_perfil"]=="2"){
                      $(".es").show();
				}
				$("#usuario").val(datos[0]["usu_usuario"]);	
				$("#clave").val(datos[0]["usu_clave"]);					
			});
		});


	}else{

			$.post(base_url+"Usuario_c/update_cliente",{'dni':dni},function(info){
					$('#cont_sistema').empty().html(info);		

			});

	}
}
function eliminar(idusu){
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
			$.post(base_url+"Usuario_c/delete_usuario",{'id':idusu},function(data){
				if(data==1){
					swal("Deleted!", "Se Elimino Correctamente", "success");
					alerta("info","USUARIO ELIMINADO - Se Eliminó Un Usuario");
				}else{
					alerta("error","ERROR OPERACION - Ocurrió Un Error! Comunica Este Error");
				}
				$("#confirmar").modal("hide");
				reload_url('Usuario_c','seguridad');
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
function validardni(){
	$.post(base_url+"Usuario_c/validardni",{'dni':dni},function(data){
		var datos = eval(data);
		alert(datos[0]["cant"]);
		if(datos[0]["cant"]==1){
			alerta("error","Este D.N.I ya esta registrado intente otro!");
			$("#dni").val('');
		}
	});
}

function archivo(evt){

                  var files = evt.target.files; // FileList object
                  var uploadFile = evt.files;
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                    	continue;
                    }

                    var reader = new FileReader();

                    reader.onload = (function(theFile) {
                    	return function(e) {
                          // Insertamos la imagen
                          $("#imag").remove();
                          document.getElementById("list").innerHTML = ['<img src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                      };
                  })(f);

                  reader.readAsDataURL(f);
              }
          }


          function ValidarImagen(obj){
          	 $("#valor").val('1');
          	var uploadFile = obj.files[0];


          	if (!window.FileReader) {
          		alert('El navegador no soporta la lectura de archivos');
          		return;
          	}

          	if (!(/\.(jpg|png|gif)$/i).test(uploadFile.name)) {
          		alert('El archivo a adjuntar no es una imagen');
          	}
          	else {
          		var img = new Image();
          		img.onload = function () {
          			if (this.width.toFixed(0) >= 1200 && this.height.toFixed(0) >=600) {
          				alert('Las medidas deben ser: 600 * 600 Maximo');
          			}
          			else if (uploadFile.size > 500000)
          			{
          				alert('El peso de la imagen no puede exceder los 500kb')
          			}
          			else {

          			}
          		};
          		img.src = URL.createObjectURL(uploadFile);
          	}                 
          }


          $.fn.upload = function(remote, data, successFn, progressFn) {
    // if we dont have post data, move it along
    if (typeof data != "object") {
    	progressFn = successFn;
    	successFn = data;
    }
    return this.each(function() {
    	if ($(this)[0].files[0]) {
    		var formData = new FormData();
    		formData.append($(this).attr("name"), $(this)[0].files[0]);

            // if we have post data too
            if (typeof data == "object") {
            	for (var i in data) {
            		formData.append(i, data[i]);
            	}
            }

            // do the ajax request
            $.ajax({
            	url: remote,
            	type: 'POST',
            	xhr: function() {
            		myXhr = $.ajaxSettings.xhr();
            		if (myXhr.upload && progressFn) {
            			myXhr.upload.addEventListener('progress', function(prog) {
            				var value = ~~((prog.loaded / prog.total) * 100);

                            // if we passed a progress function
                            if (progressFn && typeof progressFn == "function") {
                            	progressFn(prog, value);

                                // if we passed a progress element
                            } else if (progressFn) {
                            	$(progressFn).val(value);
                            }
                        }, false);
            		}
            		return myXhr;
            	},
            	data: formData,
            	dataType: "json",
            	cache: false,
            	contentType: false,
            	processData: false,
            	complete: function(res) {
            		var json;
            		try {
            			json = JSON.parse(res.responseText);
            		} catch (e) {
            			json = res.responseText;
            		}
            		if (successFn)
            			successFn(json);
            	}
            });
}
});
};