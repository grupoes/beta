<!DOCTYPE html>

<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>MIA-SISTEMA DE GESTION PARA DESARROLLO DE TESIS</title>



	<!-- Global stylesheets -->
	<link href="https://www.grupoesconsultores.com/icon.png" rel="shortcut icon">

	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">

	<link href="<?php base_url()?>public/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">

	<link href="<?php base_url()?>public/assets/css/bootstrap.css" rel="stylesheet" type="text/css">

	<link href="<?php base_url()?>public/assets/css/core.css" rel="stylesheet" type="text/css">

	<link href="<?php base_url()?>public/assets/css/components.css" rel="stylesheet" type="text/css">

	<link href="<?php base_url()?>public/assets/css/colors.css" rel="stylesheet" type="text/css">

	<!-- /global stylesheets -->



	<!-- Core JS files -->

	<script type="text/javascript" src="<?php base_url()?>public/assets/js/plugins/loaders/pace.min.js"></script>

	<script type="text/javascript" src="<?php base_url()?>public/assets/js/core/libraries/jquery.min.js"></script>

	<script type="text/javascript" src="<?php base_url()?>public/assets/js/core/libraries/bootstrap.min.js"></script>

	<script type="text/javascript" src="<?php base_url()?>public/assets/js/plugins/loaders/blockui.min.js"></script>

	<!-- /core JS files -->



	<!-- Theme JS files -->



	<script type="text/javascript" src="<?php base_url()?>public/assets/js/plugins/forms/styling/uniform.min.js"></script>



	<script type="text/javascript" src="<?php base_url()?>public/assets/js/core/app.js"></script>

	<script type="text/javascript" src="<?php base_url()?>public/assets/js/pages/login_validation.js"></script>



	<script type="text/javascript" src="<?php base_url()?>public/assets/js/plugins/ui/ripple.min.js"></script>

	<!-- /theme JS files -->



	<style type="text/css">

		#iman{



			height: 33px;

			width: 150px;

		}

	</style>

	<!-- Theme JS files -->

	<script type="text/javascript" src="<?php base_url()?>public/assets/js/core/app.js"></script>



	<script type="text/javascript" src="<?php base_url()?>public/assets/js/plugins/ui/ripple.min.js"></script>

	<!-- /theme JS files -->



</head>



<body class="login-container login-cover">



	<!-- Page container -->

	<div class="page-container">



		<!-- Page content -->

		<div class="page-content">



			<!-- Main content -->

			<div class="content-wrapper">



				<!-- Content area -->

				<div class="content pb-20">



					<!-- Form with validation -->

					<form method="POST" id="iniciosesion"   class="form-validate">

						<div class="panel panel-body login-form">

							<div class="text-center">

								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>

								<h5 class="content-group">Inicio de Sesión <small class="display-block">Ingresar sus credenciales</small></h5>

							</div>



							<div class="form-group has-feedback has-feedback-left">

								<input type="text" class="form-control" placeholder="Usuario" name="username" required="required">

								<div class="form-control-feedback">

									<i class="icon-user text-muted"></i>

								</div>

							</div>



							<div class="form-group has-feedback has-feedback-left">

								<input type="password" class="form-control" placeholder="Contraseña" name="password" required="required">

								<div class="form-control-feedback">

									<i class="icon-lock2 text-muted"></i>

								</div>

							</div>



							<div class="form-group login-options">

								<div class="row">

									<div class="col-sm-6">

										<label class="checkbox-inline">

											<input type="checkbox" class="styled" checked="checked">

											Recordar

										</label>

										<!--<label type="hidden" id="respuesta"></label>-->

									</div>

									

								</div>



							</div>

							<div class="col-sm-12">

										

									</div>

							<div class="form-group">

								<button type="button" id="btn_enviar" class="btn bg-pink-400 btn-block">Iniciar <i class="icon-circle-right2 position-right"></i></button>

							</div>



							

							

						</div>

					</form>

					

					<div class="row" >

					<div class="col-md-4"> </div>

								<div class="col-md-4">

						

									<div class="alert bg-danger"  style="display:none;" id="esconder">

										<button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>

										<span class="text-semibold">Error!</span> <label type="hidden"  id="respuesta"></label>

								    </div>

								    </div>

								    </div>

					<!-- /form with validation -->

					<div class="footer text-muted text-center">

						&copy; 2017. <a href="#">Desarrollado</a> por <a href="http://themeforest.net/user/Kopyov" target="_blank">jimmy jeiensto carbajal sanchez</a>

					</div>

				</div>

				<!-- /content area -->



			</div>

			<!-- /main content -->



		</div>

		<!-- /page content -->



	</div>

	<!-- /page container -->



</body>

</html>

<script type="text/javascript">



 $("#btn_enviar").click(function(){

 var url = "Login/crear_login"; // El script a dónde se realizará la petición.

    $.ajax({

           type: "POST",

           url: url,

           data: $("#iniciosesion").serialize(), // Adjuntar los campos del formulario enviado.

           success: function(data)

           {



           	var respta = data.split("-");

              if(respta[0] == 2){              	

              	$("#respuesta").html(respta[1]);

               $("#esconder").show();

              }else{

              	location.href="Inicio_c/software_empresa";

              	

              }

               // Mostrar la respuestas del script PHP.

           },

           error: function(data){

           	alert('error');

           }

         });



    return false; // Evitar ejecutar el submit del formulario.

 });



</script>