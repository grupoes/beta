			<!-- Main sidebar -->

			<div class="sidebar sidebar-main sidebar-default sidebar-fixed">

				<div class="sidebar-content">



					<!-- User menu -->

					<div class="sidebar-user-material">

						<div class="category-content">

							<div class="sidebar-user-material-content">

								<a href="#" id="imagen123"><img src="<?php

                                  if($_SESSION['imagen']!=''){

								 echo base_url()?>public/perfil/<?php echo $_SESSION['imagen'];

                                   }

                                   else{

                                      echo base_url()?>public/img/placeholder.jpg<?php    

                                   }

								 ?>" class="img-circle img-responsive" alt=""></a>

								<h6><?php echo $_SESSION['usuario_nombre'];



								?></h6>

								<span class="text-size-small"><?php echo $_SESSION['perfil'].",".$_SESSION['sede'];?></span>

							</div>



							<div class="sidebar-user-material-menu">

								<a href="#user-nav" data-toggle="collapse"><span>Mi cuenta</span> <i class="caret"></i></a>

							</div>

						</div>

						

						<div class="navigation-wrapper collapse" id="user-nav">

							<ul class="navigation">

								<li><a href="#"><i class="icon-user-plus"></i> <span>Mi perfil</span></a></li>

								<li onclick="reload_url('Cuenta','Mantenimiento')"><a href="#"><i class="icon-cog5" > </i> <span>Configurar Cuenta</span></a></li>

								<li><a href="<?php echo base_url();?>Login/destroy_login"><i class="icon-switch2"></i> <span>Salir</span></a></li>

							</ul>

						</div>

					</div>

					<!-- /user menu -->





					<!-- Main navigation -->

					<div class="sidebar-category sidebar-category-visible">

						<div class="category-content no-padding">

							<ul class="navigation navigation-main navigation-accordion">



								<!-- Main -->

								<li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Main pages"></i></li>

								<li class="active"><a onclick="location.reload();"><i class="icon-home4"></i> <span>Inicio</span></a></li>

								



								<?php foreach ($lista_modulos as $value) { 

									if(count($value["lista"])>0){ ?>

									<li>

										<a href="#"><i class="<?php echo strtolower($value["mod_icono"])?>"></i> <span><?php echo ($value["mod_descripcion"])?></span></a>

										<ul>

											<?php foreach ($value["lista"] as $val) { ?>

											<li><a href="#" onclick="reload_url('<?php echo $val["mod_url"]?>','<?php echo strtolower($value["mod_descripcion"])?>')">

												<i class="<?php echo strtolower($val["mod_icono"])?>"></i><?php echo $val["mod_descripcion"]?></a></li>

											<?php } 	?>	

										</ul>

									</li>

									<?php } 

								}

								?>

								<!-- /forms -->



								<!-- Appearance -->



								<!-- /page kits -->



							</ul>

						</div>

					</div>

					<!-- /main navigation -->



				</div>

			</div>



<div class="sidebar sidebar-opposite sidebar-default">
				<div class="sidebar-content">

					<!-- Sidebar search -->
					<div class="sidebar-category">
						<div class="category-title category-collapsed">
							<span>Buscar</span>
							<ul class="icons-list">
								<li><a href="#" class="rotate-180" onclick="cerrar_buscar()"><b>X</b></a></li>
							</ul>
						</div>

						<div class="category-content" style="display: block;">
							<form action="#">
								<div class="has-feedback has-feedback-left">
									<input type="search" class="form-control" id="buscar_libros" placeholder="buscar">
									<div class="form-control-feedback">
										<i class="icon-search4 text-size-base text-muted"></i>
									</div>
								</div>
							</form>
						</div>
					</div>
					<ul class="navigation navigation-alt navigation-accordion" id="data_libro">
								
								<li><a href="#" class="legitRipple"> Link</a></li>
								<li><a href="#" class="legitRipple"> Another link</a></li>
								<li><a href="#" class="legitRipple">data</a></li>
								
							</ul>
					<!-- /sidebar search -->


					<!-- /form sample -->

				</div>
			</div>





			<script type="text/javascript">

				$("#buscar_libros").keyup(function(){
                          var data=$(this).val();
                          if(data.length>3)
                          {
                          	html="";
                            
$.ajax({
	 method: "GET",
    url : 'http://www.etnassoft.com/api/v1/get/',
 
    // se agrega como parámetro el nombre de la función de devolución,
    // según se especifica en el servicio de YQL
    jsonp : 'callback',
 
    // se le indica a jQuery que se espera información en formato JSONP
    dataType : 'jsonp',
 
    // se le indica al servicio de YQL cual es la información
    // que se desea y que se la quiere en formato JSON
    data : {
        "book_title":data,
        "language":"spanish"
    },
 
    // se ejecuta una función al ser satisfactoria la petición
    success : function(results) {
    	
    	for (var i =0; i<results.length; i++) {
    		html+='<li><a href="#"><div class="row"><div class="col-md-2"><img src="'+results[i].thumbnail+'" height="50" width="25"></div><div class="col-md-10">'+results[i].title+"</div></div></a></li>";
    	}

    	$("#data_libro").empty().append(html);
        
    }
});








                          }
                          else{
                          	$("#data_libro").empty().append("");
                          }

				});
			</script>




			<!-- /main sidebar -->



			<!-- Main content -->

			

			<!-- /main content -->

