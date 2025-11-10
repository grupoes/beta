<div class="panel-body">

	<div class="panel panel-white">

		<div class="panel-heading">

           <h3>INGRESAR <?php echo strtoupper($tipo); ?></h3>

           <form method="POST" id="formulario_contabilidad"> 

             <div class="row">

                <div class="col-md-4"><label id="series">Serie:</label></div>

                <div class="col-md-4"><label class="col-md-4">FECHA:</label> <div class="col-md-8"><input type="date" value="" name="fecha" id="fecha" class="form-control"></div></div>

                <input type="hidden" name="id_tipo_comprobante" id="id_tipo_comprobante" value="<?php  echo $id_tipo_comprobante;?>">
 
             </div>

             <div class="row">

             <center>

             		<table class="table table-lg invoice-archive" id="table_sistema">

			          <thead>

				<tr>

					<th width="20%">N°</th>

		

					<th width="20%">RUC</th>
                    <th width="40%">RAZON SOCIAL</th>
					<th width="20%">IMPORTE</th>
          <th >ACCIONES</th>

	

					

				</tr>



			</thead>

            <tbody id="cuerpotabla">

            	

            </tbody>

			</table>

			</center>

             </div>

              <div class="row">

              <div class="col-md-11"></div>   <div class="col-md-1"><button onclick="crear()" type="button" class="btn btn-info btn-float btn-rounded legitRipple"><i class=" icon-plus3"></i></button>

</div>

                 </div>

             <div class="row">

             	<center><button type="button" id="guardar" class="btn btn-success">Guardar</button><button type="button" class="btn btn-danger">Cancelar</button></center>

             </div>

             </form>

             </div>

             </div>

             </div>







<!-- Modal -->

<div class="modal fade" id="inicio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Iniciar</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

         <div class="row">

         	<div class="col-md-6"><label class="control-label col-lg-2">Titulo:</label><div class="col-lg-10"><input autofocus="true" placeholder="Ingrese la serie" maxlength="4" class="form-control" type="text" name="serie1" id="serie1"></div></div>

         	<div class="col-md-6"><label class="control-label col-lg-2">inicio:</label><div class="col-lg-10"><input placeholder="" class="form-control" type="text" name="inicio1" id="inicio1" value="1" ></div></div>

         </div>

      </div>

      <div class="modal-footer">

       

        <button type="button" id="iniciar" class="btn btn-primary">Iniciar</button>

      </div>

    </div>

  </div>

</div>









<div class="modal fade" id="aceptacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

  <div class="modal-dialog" role="document">

    <div class="modal-content">

      <div class="modal-header">

        <h5 class="modal-title" id="exampleModalLabel">Total de ingresos</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>

        </button>

      </div>

      <div class="modal-body">

        <h4 id="total"></h4>

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        <button type="button" id="aceptar" class="btn btn-primary">Aceptar</button>

      </div>

    </div>

  </div>

</div>





<?php $cat="";
$cat1="";


if($tipo=="BOLETA DE VENTA")

{

  $cat="00000002";
  $cat1="Cliente Varios";

}

 ?>

             <script type="text/javascript">

             	   var c=1;

             	  serie="";

             		$(function () {

                             

  

                       $("#inicio").modal({    backdrop: 'static',

    keyboard: false});

          

                     });



$("#iniciar").click(function(){

   //alert("hola");

    if($("#serie1").val()=="")

    {         

		$("#serie1").focus(); return 0;

    }

    if($("#inicio1").val()=="")

    {        
		$("#inicio1").focus(); return 0; 

    }
    
  if($("#serie1").val().length <=2  )

    {

		alert("tiene que tener 3 0 4 digitos");$("#serie1").focus();  return 0;

    }

  var serie_caracter=$("#serie1").val();
     var serie_numer=$("#inicio1").val();
     var serie_tipo=$("#id_tipo_comprobante").val();
      var respuesta="";
     $.post(base_url+"Boletas/validar",{"serie_caracter":serie_caracter,"serie_numer":serie_numer,"serie_tipo":serie_tipo},function(data)
      {
            if(data==0)
            {
                  serie=$("#serie1").val();

                 serier=serie.toUpperCase();

                   $("#inicio").modal("hide");

                  $("#series").text("Serie: "+ serier);

                    c=parseInt($("#inicio1").val());

                  crear();

         }


        else
          {
             alerta2("error","el codigo ya existe");
       }


      });


});

scrol=0;





             		function crear()

             		{

                      
 $('input[name="importe[]"]').map(function () {
               //alert($(this).val());
            if($(this).val()==""){

              alert("tienes que llenar");
             exit();
            }
      }).get();
             				var table="";

             				serie=$("#serie1").val();

                         var ventana_ancho = $(window).width();

	var ventana_alto = $(window).height();

             			table+="<tr id='eli"+serier+c+"'>";

             	

                          table+="<td><h6 style='";

                          if(ventana_ancho<450)

                           { 

                               table+=" font-size: 7pt";



                              }

                          table+="'>"+serier+"-"+c+"</h6><input type='hidden'  id='serie' value='"+serier+"-"+c+"' name='serie[]'></td> ";

             			table+="<td><input  class='form-control' style='";

             			if(ventana_ancho<450)

                           { 

                               table+=" font-size: 7pt";



                              }


    a="'eli"+serier+c+"'";
             			table+="' id='ruc' type='text'  onkeypress='return solonumeros(event)' maxlength='11'  name='ruc[]' value='<?php echo $cat; ?>'></td>";
                  table+="<td><input type='text' value='<?php echo $cat1; ?>' class='form-control' id='razon' value='0' name='razon[]' ></td>"
             			table+="<td><input onkeypress='validar(event)' type='number'  class='form-control' id='importe' value='' name='importe[]' autofocus></td>";
               table+="<td><button class='btn btn-danger btn-xs' ";
            table+= 'onclick="eliminar_producto('+a+')" type="button">Eliminar</button</td>';
             			table+="</tr>";

             			  $("#cuerpotabla").append(table);

             			     c=c+1;
                       //alert(scrol);
                      $(document.body).scrollTop( scrol );

             			     scrol=scrol+200;
                        $('input[name="importe[]"]').map(function () {
               //alert($(this).val());
            $(this).focus();
      }).get();

             		}

       

       $("#guardar").click(function(){

             if($("#fecha").val()=="")

          {

           

		$("#fecha").focus(); return 0; 

         }

         $.post(base_url+"Boletas/datos",$("#formulario_contabilidad").serialize(),function(data){

                $("#total").text("Total : S/."+data);   

               $("#aceptacion").modal();

               $("#aceptar").attr("disabled", false);



         });

       });







       $("#aceptar").click(function(){

          $(this).attr("disabled", true);
          
          $.post(base_url+"Boletas/guardar",$("#formulario_contabilidad").serialize(),function(data)

          {

             //alert(data);

              if(data=="1")

              {

              	  $("#aceptacion").modal("hide");

                 alerta1("Se ingreso correctamente",":)");

                     $.post(base_url+"Boletas/tipo",{"id":"<?php echo $_SESSION['id_empresa_comprobante'] ?>"},function(data){

                       

                     	setTimeout(function(){   $('#cont_sistema').empty().html(data);}, 800);

                    });

              }

              else

              {

              	 $("#aceptacion").modal("hide");

                 alerta2("error","conexion erronea")

              }

          });

          

       });


function validar(e) {
  tecla = (document.all) ? e.keyCode : e.which;
  if (tecla==13)  crear();
}


 function eliminar_producto(id)
   {
    var texto=id;

        document.getElementById(texto).innerHTML="";
      


   }
            

 
             </script>



