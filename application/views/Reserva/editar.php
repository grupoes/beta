<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>GRUPO ESCONSULTORES</title>
  <meta name="description" content="Reserva tu cita en una asesoria de tesis">

  <link href="https://www.grupoesconsultores.com/icon.png" rel="shortcut icon">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans|Candal|Alegreya+Sans">

  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugin/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugin/css/imagehover.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugin/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>plugin/css/timedropper.css">
    <link rel="stylesheet" type="text/css" href="https://felicegattuso.com/plugins/datedropper/datedropper.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.css">
  
</head>

<body>
  <!--Navigation bar-->
  <nav class="navbar navbar-default navbar-fixed-top" >
    <div class="container" >
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.html">
          <img src="https://www.grupoesconsultores.com/public/assets/img/logo-color.png" style="padding: 8px;" class="normal">
        </a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav navbar-right">
          
          <!--<li><a href="#" href="#footer"  data-target="#login" data-toggle="modal" >Skype</a></li>-->
      <li class="btn-trial"><a id="id_cambiar" onclick="cambiar()" class="btn btn-primary" >Cambiar Sede</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--/ Navigation bar-->
  <!--Modal box-->
  <div class="modal fade" id="login" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content no 1-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title text-center form-title">Editar Asesoria en Skype</h4>
        </div>
        <div class="modal-body padtrbl">

          <div class="login-box-body">
          
            <div class="form-group">
              <form id="loginForm">
                <div class="row">
                  <div class="col-md-6">
                <div class="form-group">
                  <input type="hidden" name="id_sede" id="id_sede" value="<?php echo $datos->id_sede; ?>">
                      <input type="hidden" name="id_horario" id="id_horario" value="<?php echo $datos->id_horario; ?>">
                     <input type="hidden" name="id_reserva" id="id_reserva" value="<?php echo $datos->id_reserva; ?>"> 
                  <label>Inicio de fecha</label>
                  <input class="form-control"  readonly="true" data-lang="es" data-format="Y-m-d"  name="inicio" placeholder="Inicio" id="inicio" type="text" autocomplete="off" data-default-date="" />
                  </div>
                </div>
                    <div class="col-md-6">
                <div class="form-group">
                  <label>Inicio de Hora</label>
                  <input class="form-control" readonly="true" onchange="cambiar()" placeholder="hora"  name="hora" id="hora" type="text" autocomplete="off" />
                  </div>
                </div>
                
                </div>
                <div class="row">
                   <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label>Nombres </label>
                  <input class="form-control" readonly="true"  value="<?php echo $datos->res_nombre; ?>" placeholder="Nombres Completos" id="nombre" name="nombre" type="text" autocomplete="off"  />
                  
                
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label>Apellidos</label>
                  <input class="form-control" readonly="true" value="<?php echo $datos->res_apellido; ?>" placeholder="Apellidos Completos" id="apellido" type="text" name="apellido" autocomplete="off" />
                  
                
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label>Celular o telefono</label>
                  <input class="form-control" readonly="true" placeholder="numero de celular" value="<?php echo $datos->res_telefono; ?>"   id="telefono" name="telefono" type="email" autocomplete="off"  />
                  
                
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label>Email</label>
                  <input class="form-control" readonly="true" placeholder="Correo Electronico" value="<?php echo $datos->res_email; ?>" id="correo" name="correo" type="email" autocomplete="off"  />
                  
                
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label>Tu Skype</label>
                  <input class="form-control" readonly="true" placeholder="Skype" id="skype" value="<?php echo $datos->res_skype; ?>" type="text" name="skype"  autocomplete="off"  />
                  
                
                </div>
              </div>
               <div class="col-md-12">
                <div class="form-group has-feedback">
                  <label>Duracion (Horas)</label>
                 <select class="form-control" name="duracion" id="duracion"> 
                   <option>1</option>
                 </select>
                  
                
                </div>
              </div>

              </div>
                <div class="form-group">
                  <center><button class="btn btn-primary" type="button" id="boton_enviar" onclick="enviar()">Actualizar</button></center>
                </div>
               
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>








<div data-backdrop="static" data-keyboard="false" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
     
        <center><h5 class="modal-title" id="exampleModalLabel">Para iniciar escoge una de las sede de Grupo ESconsultores</h5></center>
        
                </div>
      <div class="modal-body">
        <div class="row">
       <div class="col-md-12">
          <div class="form-group has-feedback">
                  <label>Seleccionar la sede </label>
                 <select class="form-control" name="sede" id="sede"> 
                   <option value="0">Seleccionar</option>
                   <?php
 
                     foreach ($lista as $key => $value) {
                       echo "<option value='".$value->id_sede."'>".$value->descripcion."</option>";
                     }

                    ?>
                 </select>
                  
                
                </div>
        </div>
      </div>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>
















  <!--/ Modal box-->
  <!--Banner-->
  <div class="banner">
    <div class="bg-color">
      <div class="container">
        <div class="row">
          <div class="banner-text text-center">
            <div class="text-border">
              <h2 class="text-dec">Separe su cita en skype</h2>
            </div>
            <div class="intro-para text-center quote">
              <p class="big-text">Asesoramos tu tesis</p>
              <p class="small-text">Somos un grupo de profesionales especialistas en ciencias empresariales que brinda servicios de asesoría y consultoría.</p>
              <a href="#organisations" class="btn get-quote">Cita en Skype</a>
            </div>
            <a href="#feature" class="mouse-hover">
              <div class="mouse"></div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Banner-->


  <!--/ feature-->
  <!--Organisations-->
  <section id="organisations" class="section-padding">
    <div class="container">
    <?php   
    $diaActual=date("Y-m-d H:i:00");
    $diaA = new DateTime($diaActual);
    $diaE = new DateTime($datos->res_inicio);
      if($diaE>$diaA)
      {
        
      



       ?>

      <div class="row">
           <center><h4 id="titulo"></h4></center>
        <div class="col-md-12"><center><label>Debe seleccionar un segmento del horario luego se debera ingresar tus datos personales</label></center></div>
        <div class="col-md-12"><center>
          <div id="numero"></div>
        </center></div>

      </div>
      <div class="row">
        <div class="" id="calendario"></div>
      </div>
      <?php }else{ ?>

         <center><h3>Nose puede editar la fecha porque ya paso</h3></center>

      <?php }  ?>


    </div>
  </section>
  <!--/ Organisations-->
  <!--Cta-->
 
  <!--/ Cta-->
  <!--work-shop-->

  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="header-section text-center">
          <h2>Contactanos</h2>
          <p></p>
          <hr class="bottom-line">
        </div>
        <div id="sendmessage">Your message has been sent. Thank you!</div>
        <div id="errormessage"></div>
        <form action="" method="post" role="form" class="contactForm">
          <div class="col-md-6 col-sm-6 col-xs-12 left">
            <div class="form-group">
              <input type="text" name="name" class="form-control form" id="name" placeholder="Nombre Completo" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Correo Electronico" data-rule="email" data-msg="Please enter a valid email" />
              <div class="validation"></div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" name="subject" id="subject" placeholder="Adjuntar" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
              <div class="validation"></div>
            </div>
          </div>

          <div class="col-md-6 col-sm-6 col-xs-12 right">
            <div class="form-group">
              <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Mensaje"></textarea>
              <div class="validation"></div>
            </div>
          </div>

          <div class="col-xs-12">
            <!-- Button -->
            <button type="submit" id="submit" name="submit" class="light-form-button  ">ENVIAR</button>
          </div>
        </form>

      </div>
    </div>
  </section>
  <!--/ Contact-->
  <!--Footer-->
  <footer id="footer" class="footer">
    <div class="container text-center">

      <h3>Los mejores Asesorando tu tesis</h3>

      <!-- End newsletter-form -->
      <ul class="social-links">
        <li><a href="#link"><i class="fa fa-instagram fa-fw"></i></a></li>
        <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>

        <li><a href="#link"><i class="fa fa-whatsapp fa-fw"></i></a></li>
      </ul>
      ©2018 GRUPO ESCONSULTORES. Todos los derechos reservados
      
    </div>
  </footer>
  <!--/ Footer-->

  <script src="<?php echo base_url();?>plugin/js/jquery.min.js"></script>
  <script src="<?php echo base_url();?>plugin/js/jquery.easing.min.js"></script>
  <script src="<?php echo base_url();?>plugin/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>plugin/js/custom.js"></script>
    <script src="<?php echo base_url();?>plugin/js/timedropper.js"></script>
   <script src="<?php echo base_url();?>plugin/js/datedropper.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

  <script type="text/javascript" src="https://momentjs.com/downloads/moment-with-locales.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.8.2/fullcalendar.min.js"></script>
</body>

</html>
<?php ?>
<script type="text/javascript">
$(function(){

 var data="<?php echo $datos->id_sede ?>";

 $.post("<?php echo base_url();?>reserva/traer_sede",{"sede":data},function(data1)
 { 
  var res1 = data1[0]["horario_m_i"].split(":");
  var res2 = data1[0]["horario_m"].split(":");
  var res3 = data1[0]["horario_t_i"].split(":");
  var res4 = data1[0]["horario_t"].split(":");
   $("#numero").empty().append("<h5>PARA UN HORARIO ESPECIAL CONSULTE: <a href='tel:"+data1[0]["telefono"]+"'> "+data1[0]["telefono"]+"</a></h5>");
   
   $("#titulo").text(data1[0]["descripcion"].toUpperCase()+" horario "+res1[0]+":"+res1[1]+" a "+res2[0]+":"+res2[1]+" y "+res3[0]+":"+res3[1]+" a "+res4[0]+":"+res4[1]);
 },"json")
 calendario(data);
  window.location.href = "#organisations";
   
    
});

function cambiar()
{ 
$("#id_cambiar").attr("disabled",true);  
  $.post("<?php echo base_url();?>reserva/ver_sede",function(data){
       $("#sede").empty().append(data);
         $("#id_cambiar").attr("disabled",false);  
        $("#myModal").modal();
});
   
}
  /*$(function(){
 
    $("#myModal").modal();
   

  });*/


function enviar()
{
  $("#boton_enviar").attr("disabled",true);
  $.post("<?php echo base_url()?>Reserva/editar_horario",$("#loginForm").serialize(),function(data)
  {
   
      toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": false,
          "positionClass": "toast-bottom-right",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "5000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
       }
       toastr["success"]("Se actualizo correctamente", "se envio un mensaje de confirmacion a su correo");
       $("#login").modal("hide");
            $("#nombre").val("");
      $("#apellido").val("");
      $("#correo").val("");
      $("#skype").val("");
       $("#telefono").val("");
      $("#boton_enviar").attr("disabled",false);
   calendario($("#sede").val());



  });
  return false;
}

function calendario(id)
{
   $('#calendario').fullCalendar( 'destroy' );

  $.post("<?php echo base_url();?>Reserva/horario_cliente",{"id_sede":id},function(data){
      
     $('#calendario').fullCalendar({
       minTime:"08:00:00",
      hiddenDays: [ 0 ], 
        allDaySlot: false,
maxTime:"19:00:00",
height:370,
           width: 100,
        locale: 'es',
          header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaWeek'
         },
        defaultView: 'agendaWeek',
            defaultDate: new Date(),
            slotDuration:"01:00:00",
             events:data,
         dayClick: function(date, jsEvent, view) 
         {
           
            str=date.format()
            var res = str.split("T");
            $("#inicio").val(res[0]);
          
            $( "#hora" ).val(res[1]);        
           // $("#id_sede").val($("#id_sede").val());
              $.post("<?php echo base_url(); ?>Reserva/verificar",{"fecha":date.format(),"id_sede":$("#id_sede").val()},function(data1){
               
                 if(data1=="falso")
                 {
                  toastr["error"]("EL DIA YA PASO POR FAVOR SELECCIONE UN FECHA VALIDA");
                 }
                  else{
                      if(data1=="almuerzo"){
                       toastr["warning"]("ESTA SELECCIONANDO UNA FUERA DEL HOARIO");
                      }
                      else{
                         $("#login").modal();
                       $("#duracion").empty().append(data1);
                       setTimeout(function(){ $("#login").scrollTop(150); $("#nombre").focus()}, 400);
                      }

                  }
                 
              });
            
         
         }
      
    });
      $("#myModal").modal("hide");


  window.location.href = "#organisations";
   
},"json");


}

</script>