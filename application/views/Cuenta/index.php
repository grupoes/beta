<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<center><h3>Configuracion de tu Perfil</h3></center>

<div class="row">
	<h5>Perfil</h5>
	<div class="col-md-4">
		<input type="file"  accept="image/*;capture=camera" name="perfil" id="perfil" class="form-control">
	</div>
	<div class="col-md-4">
		<button class="btn btn-success" id="subir">Subir</button>
		<button class="btn btn-success" id="tomar_foto">Tomar foto</button>
	</div>
	<div class="col-md-2">
		<canvas id="canvas"></canvas>

	</div>

</div>





			<div class="row">
				<h5>Cambiar contraseña</h5>
			
				<div class="col-md-4">
					<label class="col-md-6">Contraseña Antigua</label>
					<div class="col-md-6">
						<input type="password" name="con_ant" id="con_ant" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<label class="col-md-6">Contraseña Nueva</label>
					<div class="col-md-6">
						<input type="password" name="con_nue" id="con_nue" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<label class="col-md-6">Repertir contraseña</label>
					<div class="col-md-6">
						<input type="password" name="con_rep" id="con_rep" class="form-control">
					</div>
				</div>
			</div>
			<div class="row">
				<br>
				<center>
					<button class="btn btn-danger">Cancelar</button>
					<button class="btn btn-primary" id="guardar">Guardar</button>
				</center>
			</div>
		</div>
	</div>
</div>






<div id="modal_foto" class="modal fade in" >
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">×</button>
									<h5 class="modal-title">TOMAR FOTO</h5>
								</div>

								<div class="modal-body">
									<video id="video"></video>
<!--<button id="startbutton">Take photo</button>-->
                                      <img src="https://placekitten.com/g/320/261" id="photo" alt="photo">

								</div>

								<div class="modal-footer">
									<button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Cerrar</button>
									<button type="button" class="btn btn-primary legitRipple" id="tomar">Tomar</button>
									<button type="button " class="btn btn-success legitRipple" id="subirfoto">subir</button>
									<button type="button" class="btn btn-primary" id="nuevo">Tomar de nuevo</button>
									
								</div>
							</div>
						</div>
</div>































<script type="text/javascript">
   $("#guardar").click(function(){
   	$(this).attr("disabled", true);
   	  if($("#con_nue").val()==$("#con_rep").val())
   	  { 
   	  	

   	  	 $.post(base_url+"Cuenta/cambiar",{"con_ant":$("#con_ant").val(),"con_nue":$("#con_nue").val()},function(data){
   	  	 	if(data=="1")
   	  	 	{
                    alerta1("Se cambio correctamente","Se cerrar la session para que ingrese de nuevo con el nuevo password");
                   setTimeout(function(){ 
                   	location.href =base_url+"Login/destroy_login";
                   }, 2000);
   	  	 	}
   	  	 	else{

               alerta2("Error","Contraseña antigua no es correcta");
                $("#guardar").attr("disabled", false);
   	  	 	}

   	  	 });
   	  }

   	  else{
           alerta2("Error","Las contraseñas son diferentes");
            $("#guardar").attr("disabled", false);
   	  }
   });





	$("#subir").click(function()
		{

              $('#subir').attr("disabled", true);
               var formData= new FormData();
      formData.append('foto', $('input[name=perfil]')[0].files[0]); 
              ruta="<?php echo base_url(); ?>Cuenta/subir_foto";
       $("#subir").text("subiendo..");
         $.ajax({
                url: ruta,
                type: "POST",
                data:  formData,
                contentType: false,
                processData: false,
                success: function(datos)
                {

                       $('input[type=file]').val('');
                      
                       $("#subir").text("subir");
                       $('#subir').attr("disabled", false);
                       $('#imagen123').empty().append(datos);

                }
            });

		});


$(function(){
  $("#canvas").hide();
  $("#photo").hide();
});

	
          

  /*function takepicture() {
  	canvas=document.querySelector("#canvas"),
  	  video   = document.querySelector('#video'),
  	   photo    = document.querySelector('#photo');
    canvas.width = 560;
    canvas.height = 0;
    canvas.getContext('2d').drawImage(video, 0, 0, 560, 0);

    var data = canvas.toDataURL('image/png');
    alert(data);

    photo.setAttribute('src', data);
   
    $("#photo").show();
     $("#video").hide();

  }
*/

$("#tomar_foto").click(function()
	{
		$("#modal_foto").modal();
		$("#nuevo").hide();
		$("#subirfoto").hide();
	
  var streaming = false,
      video        = document.querySelector('#video'),
      canvas       = document.querySelector('#canvas'),
      photo        = document.querySelector('#photo'),
      startbutton  = document.querySelector('#tomar'),
      subirfoto= document.querySelector('#subirfoto'),
      nuevo=document.querySelector("#nuevo"),
      width = 560,
      height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: true,
      audio: false
    },
    function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
      console.log("An error occured! " + err);
    }
  );

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
  }, false);
let dato = new FormData();
function dataURI2Blob(dataURI) {
  var byteString;
    if (dataURI.split(',')[0].indexOf('base64') >= 0)
        byteString = atob(dataURI.split(',')[1]);
    else
        byteString = unescape(dataURI.split(',')[1]);
    // separate out the mime component
    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

    // write the bytes of the string to an ArrayBuffer
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }

    // write the ArrayBuffer to a blob, and you're done
    return new Blob([ab],{type: mimeString});
  }


  function takepicture() {
    canvas.width = width;
    canvas.height = height;
    canvas.getContext('2d').drawImage(video, 0, 0, width, height);
    var data = canvas.toDataURL('image/png');
   dato.append('foto', dataURI2Blob(data));
    photo.setAttribute('src', data);

     $("#photo").show();
     $("#video").hide();
     $("#tomar").hide();
     $("#nuevo").show();
     $("#subirfoto").show();
  }

  function subirfoto()
  {
   $("#subirfoto").attr("disabled",true);
   //ruta="<?php echo base_url(); ?>Cuenta/subir_foto";
     //  $("#subirfoto").text("subiendo..");
         /*$.ajax({
                url: ruta,
                type: "POST",
                data:  dato,
                contentType: false,
                processData: false,
                success: function(datos)
                {

                       //$('input[type=file]').val('');
                      
                       $("#subirfoto").text("subir");
                       $('#subirfoto').attr("disabled", false);
                       $('#imagen123').empty().append(datos);

                }
            });*/

  }


  startbutton.addEventListener('click', function(ev){
      takepicture();
    ev.preventDefault();
  }, false);
    nuevo.addEventListener('click', function(ev){
     $("#subirfoto").hide();
      $("#photo").hide();
     $("#video").show();
     $("#nuevo").hide();
     $("#tomar").show();
    ev.preventDefault();
  }, false);

subirfoto.addEventListener('click', function(ev){
       $("#subirfoto").attr("disabled",true);
       ruta="<?php echo base_url(); ?>Cuenta/subir_foto";
        $("#subirfoto").text("subiendo..");
         $("#nuevo").hide();
        $.ajax({
                url: ruta,
                type: "POST",
                data:  dato,
                contentType: false,
                processData: false,
                success: function(datos)
                {

                       //$('input[type=file]').val('');
                      
                       $("#subirfoto").text("subir");
                       $('#subirfoto').attr("disabled", false);
                       $('#imagen123').empty().append(datos);
                       $("#subirfoto").hide();
                      
                       $("#tomar").show();
                        $("#photo").hide();
                          $("#video").show();
                       $("#modal_foto").modal("hide");

  
  var streamRef;


 navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

  navigator.getMedia(
    {
      video: false,
      audio: false
    },
    function(stream) {
       

    },
    function(err) {
      console.log("An error occured! " + err);
    });












                
                }
            });
    ev.preventDefault();
  }, false);


	});
</script>