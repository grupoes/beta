<!DOCTYPE html>


<html>
  <link href="https://www.grupoesconsultores.com/icon.png" rel="shortcut icon">

<?php include("css.php"); ?>

<?php include("js.php"); //sidebar-xs sidebar-opposite-visible?> 

<body class="navbar-top pace-done ">

	<?php include("header.php"); ?>

	<div class="page-container" id="cuerpo">

		<div class="page-content">

			<?php include("menu.php"); ?>

			<div class="content-wrapper">



				<div class="page-header page-header-default">

					<div class="page-header-content">

						<div class="page-title">

							<h4><span class="text-semibold" id="titulo">INICIO</span> -<label id="subtitulo"> Estadistica</label></h4>
                            <input type="hidden" id="idsede"name="idsede" value="<?php echo $_SESSION['id_sede']; ?>">
						</div>



						<!--<div class="heading-elements">

							<div class="heading-btn-group">

								 <a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>

								<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>

								<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>

								

							</div>

						</div>--> 	 

					</div>



					<!--<div class="breadcrumb-line">

						<ul class="breadcrumb">

							<<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>

							<li class="active">Dashboard</li> 

						</ul>



						<ul class="breadcrumb-elements">

							 <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>

							<li class="dropdown">

								<a href="#" class="dropdown-toggle" data-toggle="dropdown">

									<i class="icon-gear position-left"></i>

									Settings

									<span class="caret"></span>

								</a>



								<ul class="dropdown-menu dropdown-menu-right">

									<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>

									<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>

									<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>

									<li class="divider"></li>

									<li><a href="#"><i class="icon-gear"></i> All settings</a></li>

								</ul>

							</li> 

						</ul>

					</div>-->

				</div>

				<div class="content" id="cont_sistema">



                  <?php if($_SESSION['usuario_perfil']=="5"){?>

                  <div class="row">

                      <div class="col-md-6">

                         <div class="panel panel-flat">



                            <div class="panel-body">



                               <div class="panel-body">

                                  <div id="container" ></div>

                              </div>

                          </div>

                      </div>

                  </div>



                  <div class="col-md-6">

                     <div class="panel panel-flat">









                         <div class="panel-body">

                          <div id="container1" style="height: 440px"></div>

                      </div>

                  </div>

              </div>

          </div>

          <div class="row">
            <div class="col-md-12">
                <div class="panel panel-flat">
                    <div class="panel-body">

                     <div id="container2" ></div>

                 </div>
             </div>
         </div>
     </div>
     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-body">

                    <div id="container3" ></div>

                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
         <div class="panel panel-flat">
            <div class="panel-body">
            <div class="col-md-2" id="sede">
                    <label>Reportes</label>
                    <select class="form-control" id="tipocliente" >
                        <option value="0">Todos</option>
                        <?php   foreach ($sedes as $sede) { ?>
                        <option value="<?php echo $sede->id_sede ?>"><?php echo $sede->descripcion ?></option>
                        <?php } ?>

                    </select>
                </div>
                <div id="container5" ></div>

            </div>
        </div>

    </div>
</div>











</div>

<?php }else{
    if($_SESSION['usuario_perfil']=="1"){ ?>
    <div class="row">

      <div class="col-md-6">

         <div class="panel panel-flat">



            <div class="panel-body">



               <div class="panel-body">

                  <div id="container" ></div>

              </div>

          </div>

      </div>

  </div>

   <div class="col-md-6">

         <div class="panel panel-flat">



            <div class="panel-body">
             <center><h4>TERMINO DE HORARIO</h4></center>
             <div id="datos_trabajador">
             
             </div>
     
     

          </div>

      </div>

  </div>


  <div class="col-md-12">

     <div class="panel panel-flat">









         <div class="panel-body">

          <div id="container1" style="height: 440px"></div>

      </div>

  </div>

</div>

</div>
<div id="modal_trabajador" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<center><h5>TRABAJOS ENCARGADOS</h5></center>	
			</div>

			<div class="modal-body">
				<div class="row">
					<form id="formulario">
						<div class="col-md-5">
							<div class="form-group">
								<label >Inicio</label>
								<input type="date" name="inicio" id="inicio" class="form-control">
								<input type="hidden" name="idusuario" id="idusuario" class="form-control">
							</div>
						</div>
						<div class="col-md-5">
							<div class="form-group">
								<label >Fin</label>
								<input type="date" name="fin" id="fin" class="form-control">
							</div>
						</div>
						<div class="col-md-2">
							<br>
							<button class="btn btn-success" id="buscar" type="button">buscar</button>
						</div>
					</form>
				</div>
		 <div class="row">
		  	 <div class="col-md-3"><b>TOTAL TRABAJOS:</b><label id="trabajostotal">0</label></div>
		  </div>
						<div id="tabla_trabajos" class="table-responsive" style='display:none;'>	
			<table class="table table-striped table-bordered datatable-button-html5-basic" id="table_sistema">
				<thead>
					<tr>
						<th class="center">#</th>					
						<th class="center">Titulo</th>						
					</tr>
				</thead>
				<tbody id="tabla_datos">
				</tbody>
		</table>
	</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

<?php  }else{?>  

<div class="panel-body">

   <div class="panel panel-white">

     <div class="panel-heading">
       <h3>Misión</h3>
       <div class="row">
           <div class="col-md-12">
               <h6 style="text-align : justify !important;">Grupo Es Consultores S.A.C. es una empresa de servicios de consultora y/o asesoría a nivel nacional, atendiendo a empresarios en cuanto a las problemáticas de su gestión; Como también a estudiantes de la facultad de ciencias empresariales en sus proyectos y desarrollos de investigación, contamos con colaboradores capacitados en visión innovadora y alianzas estratégicas sólidas, que permiten brindar un servicio de calidad e innovación a nuestros clientes, incrementando de esta manera la competitividad comercial del país.</h6>
           </div>
       </div>
       <h3>Vision</h3>
       <div class="row">
           <div class="col-md-7">
               <h6 style="text-align : justify !important;">Ser un referente importante e innovador para los empresarios y estudiantes de la facultad de ciencias empresariales, en los servicios de consultora y/o asesoría, con una alta y sólida presencia en el país, teniendo como base el compromiso de todos los integrantes en el desarrollo sostenible del Perú.</h6>
           </div>
           <div class="col-md-5">
            <div class="thumbnail">
                <div class="video-container">
                 <video  width="386" height="217" controls  poster="<?php echo base_url(); ?>public/perfil/logo2.png">
                    <source  src="<?php echo base_url(); ?>public/img/video.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>




















    </div>
</div>
</div>
</div>


<?php } }?>





</div>

</div>   

</div>

</div>
<div class="modal fade in" id="validarcaja" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h4 class="modal-title">Atención Usuario ?</h4>
                <h5>
                    <p id="mensaje"></p> <b id="fechacerrar"></b>
                </h5>
                <?php 
                if ($_SESSION["usuario_perfil"]==1) { ?>
                <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="reload_url('Sesion_caja','caja')">
                    Ir a caja
                </button>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>


<script type="text/javascript" src="../../../firebase-messaging-sw.js">
	
	 /*var config = {
    apiKey: "AIzaSyDoESZ3t9G-wosVO5jZU6QQ2-KT-BWz7_E",
    authDomain: "consultoria-ac0e3.firebaseapp.com",
    databaseURL: "https://consultoria-ac0e3.firebaseio.com",
    projectId: "consultoria-ac0e3",
    storageBucket: "consultoria-ac0e3.appspot.com",
    messagingSenderId: "290294403515"
  }; */
  //firebase.initializeApp(config);
  const messaging = firebase.messaging();
  messaging.requestPermission()
.then(function() {
  console.log('Notification permission granted.');
  return messaging.getToken();
  // TODO(developer): Retrieve an Instance ID token for use with FCM.
  // ...
})
.then(function(token){
	console.log(token);
})
.catch(function(err) {
  console.log('Unable to get permission to notify.', err);
});


messaging.onMessage(function(payload){
	console.log('onMessage :',payload);
});


</script>



<!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async='async'></script>-->

<script type="text/javascript">


   /* var OneSignal = window.OneSignal || [];
    OneSignal.push(["init", {
        appId: "aa5a6137-99d5-472c-a413-2c666046d5c5",
        subdomainName: 'consultoria',
        autoRegister: true,
        promptOptions: {
            /* These prompt options values configure both the HTTP prompt and the HTTP popup. */
            /* actionMessage limited to 90 characters */
            //actionMessage: "¿Estamos mejorarando el servicio prueba nuestro  sistema de notificaciones?",
            /* acceptButtonText limited to 15 characters */
            //acceptButtonText: "Si",
            /* cancelButtonText limited to 15 characters 
            cancelButtonText: "NO gracias"
        }
    }]);*/

</script>
<script>
    /*function subscribe() {
                // OneSignal.push(["registerForPushNotifications"]);
                OneSignal.push(["registerForPushNotifications"]);
                event.preventDefault();
            }
            function unsubscribe(){
                OneSignal.setSubscription(true);
            }

            var OneSignal = OneSignal || [];
            OneSignal.push(function() {
                /* These examples are all valid 
                // Occurs when the user's subscription changes to a new value.
                OneSignal.on('subscriptionChange', function (isSubscribed) {
                    console.log("The user's subscription state is now:", isSubscribed);
                    OneSignal.sendTag("user_id","4444", function(tagsSent)
                    {
                        // Callback called when tags have finished sending
                        console.log("Tags have finished sending!");
                    });
                });

                var isPushSupported = OneSignal.isPushNotificationsSupported();
                if (isPushSupported)
                {
                    // Push notifications are supported
                    OneSignal.isPushNotificationsEnabled().then(function(isEnabled)
                    {
                        if (isEnabled)
                        {
                            console.log("Push notifications are enabled!");

                        } else {
                            OneSignal.showHttpPrompt();
                            console.log("Push notifications are not enabled yet.");
                        }
                    });

                } else {
                    console.log("Push notifications are not supported.");
                }
            });
*/


</script>
<script type="text/javascript">




    $(function () {
        Push.create("Bienvenido a ES Consultoria", {

            body: "<?php echo $_SESSION['usuario_nombre']; ?>",

            icon: "<?php echo base_url()?>public/perfil/<?php echo ucwords(strtolower($_SESSION['imagen']));?>",

            timeout: 2000,

            onClick: function () {

                window.focus();

                this.close();

            }
        });

        <?php if($_SESSION['usuario_perfil']=="5"){?>

           var fecha = new Date();

           var ano = fecha.getFullYear();

           var mes=moment.months()[moment().month()]; 

           $.post(base_url+"Graficos/mes",  function(data, textStatus, xhr) {

              Highcharts.chart('container2', {



                chart: {

                    type: 'column'

                },

                title: {

                    text: 'Horas de trabajo en el mes de '+mes+' del año '+ano

                },

                subtitle: {

                    text: ''

                },

                xAxis: {

                    type: 'category'

                },

                yAxis: {

                    title: {

                        text: 'Total de horas de trabajo'

                    }



                },

                legend: {

                    enabled: false

                },

                plotOptions: {

                    series: {

                        borderWidth: 0,

                        dataLabels: {

                            enabled: true,

                            format: '{point.y:.1f} Horas'

                        }

                    }

                },



                tooltip: {

                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',

                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} horas</b> total<br/>'

                },



                series: [{

                    name: 'Tabajadores',

                    colorByPoint: true,

                    data: data

                }]

            });

},"json");


$.post(base_url+"Graficos/caja_total",  function(data, textStatus, xhr) {

    Highcharts.chart('container3', {
        chart: {
            type: 'area'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: 'Ganancia Mensual'
        },
        xAxis: {
            categories: data.ingresos.categoria,
            tickmarkPlacement: 'on',
            title: {
                enabled: false
            }
        },
        yAxis: {
            title: {
                text: 'Ganancia'
            },
            labels: {
                formatter: function () {
                    return this.value ;
                }
            }
        },
        tooltip: {
            split: true,
            valueSuffix: ' s/.'
        },
        plotOptions: {
            area: {
                stacking: 'normal',
                lineColor: '#666666',
                lineWidth: 1,
                marker: {
                    lineWidth: 1,
                    lineColor: '#666666'
                }
            }
        },
        series: data.ingresos.datos
    });

},"json");


$.getJSON(base_url+"Graficos/arqueo_grafico",function(data){ 

   Highcharts.chart('container', {

    chart: {

        plotBackgroundColor: null,

        plotBorderWidth: null,

        plotShadow: false,

        type: 'pie'

    },

    title: {

        text: 'Estado de fichas de enfoque'

    },



    plotOptions: {

        pie: {

            allowPointSelect: true,

            cursor: 'pointer',

            dataLabels: {

                enabled: true,

                format: '<b>{point.name}</b>: {point.y} ',

                style: {

                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'

                }

            }

        }

    },

    series: [{



        colorByPoint: true,

        data: [['Ficha',data.ficha],

        ['Asesor',data.asesor],

        ['Horario',data.horario],

        ['Pago',data.pago],

        ['Produccion',data.produccion],

        ['Finalizado',data.finalizacion]]

    }]

});

});

///data conteiner 


$.getJSON(base_url+"Graficos/caja_x_sede",function(data){ 

    Highcharts.chart('container1', {

        chart: {
            type: 'column'
        },

        title: {
            text: 'Detalle de Caja Por Sede del Día'
        },

        xAxis: {
            categories: data.ingresos.categoria
        },

        yAxis: {
            allowDecimals: false,
            title: {
                text: 'Soles'
            }
        },

        tooltip: {
            formatter: function () {
                return '<b>' + this.x + '</b><br/>' +
                this.series.name + ': ' + this.y + '<br/>' +
                'Total: ' + this.point.stackTotal;
            }
        },

        plotOptions: {
            column: {
                stacking: 'normal'
            }
        },

        series: data.ingresos.datos
    });
},"json"); 
$( "#tipocliente" ).change(function() {
   var id  =  ($("#tipocliente").val() );
   $.getJSON(base_url+"Graficos/caja_x_diaria",{"id" : id},function(data){    
 
    Highcharts.chart('container5', {

        chart: {
            type: 'arearange',
            zoomType: 'x'
        },

        title: {
            text: 'Detalle de caja del año'
        },

        xAxis: {
            type: 'datetime'
        },

        yAxis: {
            title: {
                text: null
            }
        },

        tooltip: {
            crosshairs: true,
            shared: true,
            valueSuffix: 'S./'
        },

        legend: {
            enabled: false
        },

        series: data.ingresos.datos

    });


   },"json"); 
}); 


$(function()
    {
   var idc  =  0;
$.getJSON(base_url+"Graficos/caja_x_diaria",{"id" : idc},function(data){    
        Highcharts.chart('container5', {

        chart: {
            type: 'arearange',
            zoomType: 'x'
        },

        title: {
            text: 'Detalle de caja del año'
        },

        xAxis: {
            type: 'datetime'
        },

        yAxis: {
            title: {
                text: null
            }
        },

        tooltip: {
            crosshairs: true,
            shared: true,
            valueSuffix: 'S./'
        },

        legend: {
            enabled: false
        },
        series: data.ingresos.datos

    });

   },"json");


    });


<?php }?>
<?php if($_SESSION['usuario_perfil']=="1"){?>

$.post(base_url+"Graficos/ver_ultimo",{},function(data){
  $("#datos_trabajador").empty().append(data);

});

	$("#buscar").click(function(){
  
document.getElementById('tabla_trabajos').style.display = 'block';
     $.post(base_url+"Graficos/ver_trabajos",$("#formulario").serialize(),function(data){
     	alert(data);
     	   
      $(".datatable-button-html5-basic").DataTable().destroy();              
      $("#trabajostotal").text(data.total);
      $("#tabla_datos").empty().append(data.tabla);
                   $.extend( $.fn.dataTable.defaults, {
        autoWidth: false,
        dom: '<"datatable-header"fBl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
        language: {
            search: '<span>Buscar:</span> _INPUT_',
            lengthMenu: '<span>Mostrar:</span> _MENU_',
            paginate: { 'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;' }
        }
    });
         
         $('.datatable-button-html5-basic').DataTable({
        	 buttons: {            
            dom: {
                button: {
                    className: 'btn btn-default'
                }
            },
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ]
        }
    });
      $.extend( true, $.fn.dataTable.defaults, {
    buttons: [  ]
} );
     },"json")

	});


   var fecha = new Date();

   var ano = fecha.getFullYear();

   var mes=moment.months()[moment().month()]; 
   $.getJSON(base_url+"Graficos/caja",function(data){ 

       Highcharts.chart('container', {

        chart: {

            plotBackgroundColor: null,

            plotBorderWidth: null,

            plotShadow: false,

            type: 'pie'

        },

        title: {

            text: 'Estado de Caja'

        },



        plotOptions: {

            pie: {

                allowPointSelect: true,

                cursor: 'pointer',

                dataLabels: {

                    enabled: true,

                    format: '<b>{point.name}</b>: {point.y} ',

                    style: {

                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'

                    }

                }

            }

        },

        series: [{



            colorByPoint: true,

            data: [['Ingreso Fisico',data.ingresosf],

            ['Egreso Fisico',data.egresosf],

            ['Ingreso Virtual',data.ingresosv],

            ['Egreso Virtual',data.egresosv]]

        }]

    });

   });
$.getJSON(base_url+"Graficos/caja_mes",function(data){ 
    Highcharts.chart('container1', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Ingreso de Caja'
        },
        subtitle: {
            text: 'GrupoEsconsultores'
        },
        xAxis: {
            categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',

            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dec'],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Soles (S)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} S/.</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Ingreso Virtual',
            data: [data.hingresosv.ene,data.hingresosv.feb,data.hingresosv.mar,data.hingresosv.abr,data.hingresosv.may,data.hingresosv.jun,data.hingresosv.jul,

            data.hingresosv.ago,data.hingresosv.set,data.hingresosv.oct,data.hingresosv.nov,data.hingresosv.dic]

        }, {
            name: 'Egreso Virual',
            data: [data.hegresosv.ene,data.hegresosv.feb,data.hegresosv.mar,data.hegresosv.abr,data.hegresosv.may,data.hegresosv.jun,data.hegresosv.jul,

            data.hegresosv.ago,data.hegresosv.set,data.hegresosv.oct,data.hegresosv.nov,data.hegresosv.dic]

        }, {
            name: 'Ingreso Fisico',
            data: [data.hingresosf.ene,data.hingresosf.feb,data.hingresosf.mar,data.hingresosf.abr,data.hingresosf.may,data.hingresosf.jun,data.hingresosf.jul,

            data.hingresosf.ago,data.hingresosf.set,data.hingresosf.oct,data.hingresosf.nov,data.hingresosf.dic]

        }, {
            name: 'Egreso Fisico',
            data: [data.hegresosf.ene,data.hegresosf.feb,data.hegresosf.mar,data.hegresosf.abr,data.hegresosf.may,data.hegresosf.jun,data.hegresosf.jul,

            data.hegresosf.ago,data.hegresosf.set,data.hegresosf.oct,data.hegresosf.nov,data.hegresosf.dic]

        }]
    });

},"json"); 

<?php }?>

});



</script>



