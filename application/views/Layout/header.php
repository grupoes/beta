<?php header('Access-Control-Allow-Origin: *'); 

?>
<style type="text/css">
	#iman{
      margin-top: 10px;
      margin-left: 80px;
      width: 100px;

  	}
</style>

<div class="navbar navbar-inverse navbar-fixed-top bg-indigo">
		<div class="navbar-header">
		<img src="<?php echo base_url(); ?>public/assets/images/logo grupo.png" id="iman">

			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle" id="reducir_barra"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
               <li>
				<a href="#" onclick="ver()" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
							<i class=" icon-search4"></i>
					
						</a>
				</li>

				<li>
                   <div class="navbar-center">
					<div class="_1qkq _1qkz">
							<div id="">
								<div class="_1r_y">
									<span>
										<label class="_1r_z clearfix _58ak" id="js_g1">
											<input class="_58al" type="text" aria-autocomplete="list" name="autocomplete" id="autocomplete" aria-controls="js_0"  placeholder="Hola <?php echo $_SESSION['usuario_nombre'] ?>, ¿en qué podemos ayudarte?">
										</label>
									</span>
									<div class=" _1s0b"></div>
								</div>
							</div>
					</div>
				</div>


				</li>

			</ul>

			<div class="navbar-right">

				<p class="navbar-text">Bienvenido, <?php echo " ".$_SESSION['usuario']?></p>
				<p class="navbar-text"><span class="label bg-success-400" id="hora"> </span></p>

				<ul class="nav navbar-nav">				
					<li class="dropdown">
                           
                              



						<a href="#" class="dropdown-toggle legitRipple" data-toggle="dropdown" aria-expanded="false">
							<i class="icon-bell2"></i>
							<span class="visible-xs-inline-block position-right">Notificaciones</span>
							
						</a><span class="badge bg-danger-400 media-badge position-right"><div id="notican">0</div></span>


						<div class="dropdown-menu dropdown-content">
							<div class="dropdown-content-heading">
								Notificaciones
								<ul class="icons-list">
									<li><a href="#"><i class="icon-menu7"></i></a></li>
								</ul>
							</div>
                           
							<div id="notificacion">
							   
							</div>
						</div>




					</li>

					
				</ul>




                
<audio id="sound"></audio>












			</div>
		</div>
	</div>

	<script type="text/javascript">



setInterval(function(){ 

var Dia = new Array("Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo");
var Mes = new Array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", 
"Octubre", "Noviembre", "Diciembre");
var Hoy = new Date();
var Anio = Hoy.getFullYear();
var Fecha = Dia[Hoy.getDay()] + ", " + Hoy.getDate() + " de " + Mes[Hoy.getMonth()] + " del " + Anio + ". ";


	var f=new Date();
cad=Fecha+" "+f.getHours()+":"+f.getMinutes()+":"+f.getSeconds(); 
    $("#hora").text(cad);
}, 1000);

	</script>

	<script type="text/javascript">
		/*$("#reducir_barra").click(function(){
		if($("#sidebar-xs").length > 0 ){
            $('body').removeClass("sidebar-xs");
		}
		else{
             $('body').addClass("sidebar-xs");
		}
		});*/
  $( function() {


$('#autocomplete').autocomplete({
        source: base_url+"Graficos/buscador",
      minLength: 2,
      select: function( event, ui ) {
         // log( "Selected: " + ui.item.value + " aka " + ui.item.id );
         //alert(ui.item.id);
          var strin=ui.item.id;
         var valor = strin.split("/");
         

      }
});
  } );
	</script>

	<script type="text/javascript">
		function ver()
		{
			 $('body').addClass("sidebar-xs");
			  $('body').addClass("sidebar-opposite-visible");
			  setTimeout(function(){ $("#buscar_libros").focus();}, 50);
			  


		}
		function cerrar_buscar()
		{
			 $('body').removeClass("sidebar-xs");
			  $('body').removeClass("sidebar-opposite-visible");
			  	$("#data_libro").empty().append("");
			  	$("#buscar_libros").val("");
		}
	</script>