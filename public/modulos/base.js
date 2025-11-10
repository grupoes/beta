

function validarcaja(){
	$.get(base_url+"sesion_caja/validarcaja",function(data){
		if (data!="1") {
			$("#mensaje").text(data);
			$("#validarcaja").modal({backdrop: 'static',show: true});
		}
     });
}
function reload(){
           //$("#cont_sistema").empty().html("<center> <br><br><img src='"+base_url+"public/cargando.gif'> </center>");
	$("#cont_sistema").empty().html("<div class='paneles'><center><div class='loader'><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div></div></center></div>");
}

function reload_url(modulo,padre){

	$('body').toggleClass('sidebar-mobile-main').removeClass('sidebar-mobile-secondary sidebar-mobile-opposite sidebar-mobile-detached');
       
	$(".principal").removeClass("active");$(".cobrarmovil").removeClass("active");$(".seguridad").removeClass("active");
	$(".administracion_caja").removeClass("active");$(".prestamos").removeClass("active");
	$("."+modulo).addClass("active"); $("."+padre).addClass("active"); reload();
	        $("#cont_sistema").empty().html("<div class='paneles'><center><div class='loader'><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div></div></center></div>");
	$.get(base_url+modulo,function(data){
		$("#cont_sistema").empty().html(data);
	});

}



function reload_url1(modulo,padre){
   if(confirm("¿estas seguro cancelar?")){
	$('body').toggleClass('sidebar-mobile-main').removeClass('sidebar-mobile-secondary sidebar-mobile-opposite sidebar-mobile-detached');
       
	$(".principal").removeClass("active");$(".cobrarmovil").removeClass("active");$(".seguridad").removeClass("active");
	$(".administracion_caja").removeClass("active");$(".prestamos").removeClass("active");
	$("."+modulo).addClass("active"); $("."+padre).addClass("active"); reload();
	        $("#cont_sistema").empty().html("<div class='paneles'><center><div class='loader'><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div></div></center></div>");
	$.get(base_url+modulo,function(data){
		$("#cont_sistema").empty().html(data);
	});
   }
}



function reload_otra_url(modulo,padre){
		$('body').toggleClass('sidebar-mobile-main').removeClass('sidebar-mobile-secondary sidebar-mobile-opposite sidebar-mobile-detached');
	$(".principal").removeClass("active");$(".cobrarmovil").removeClass("active");$(".seguridad").removeClass("active");
	$(".administracion_caja").removeClass("active");$(".prestamos").removeClass("active");
	$("."+modulo).addClass("active"); $("."+padre).addClass("active"); reload();
	var new_url = modulo.split("-");
	modulo = new_url[0]+'/'+new_url[1];
	        $("#cont_sistema").empty().html("<div class='paneles'><center><div class='loader'><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div></div></center></div>");
	$.get(base_url+modulo,function(data){
		$("#cont_sistema").empty().html(data);
	});
}

