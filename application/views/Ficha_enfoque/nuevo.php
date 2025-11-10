

<?php 

$id_produccion="";

if(isset($produccion))

{

  foreach ($produccion as $key => $value) {

    $id_produccion=$value->id_producion;

  }

}



//echo $id_produccion;



?>

<script type="text/javascript">

  function selecionar(data2,data1,data3) {



   var listaCompras = "";

   $("input[id=id_tiempo]").each(function (index) {  



    data= $(this).val();

    datos=data.split(",");



    if( datos[1]==data1 &&  datos[2]==data2)

    { 

     if(  $(this).prop('checked') ) 

     {

      $(this).prop("checked",false);

    }

    else

    {

     $(this).prop("checked",true);

   }







 }

 else

 {

   $(this).prop("checked",false);

 }





});





   $("input[id=id_t]").each(function (index) 

   {   



    if($(this).val()==data3) 

    {



      if(  $(this).prop('checked') ) 

      {

        $(this).prop("checked",true);

      }

      else

      {

       $(this).prop("checked",false);

     }



   }

   else

   {

     $(this).prop("checked",false);

   }



 });





   $(".styled, .multiselect-container input").uniform({

    radioClass: "choice"

  });

 }

 



</script>





<?php 

$estadoficha=0;

if(isset($data))

{



  foreach ($data as  $value) {



    $idenfoque=$value->id_ficha_enfoque;



    $id_categoria=$value->id_categoria;

    $id_grado=$value->id_grado;

    $titulo=$value->titulo_enfoque;

    $id_especialidad=$value->id_especialidad;

    $estadoficha=$value->estado_ficha;

  }





  ?>

  <script type="text/javascript">

   $(function(){

     $.post(base_url+"Ficha_enfoque/asesores",function(data){

      $('#id_trabajador').empty();

      $('#id_trabajador').append(data);



    });



     $.post(base_url+'Ficha_enfoque/data', {id:<?php echo $idenfoque;?>}, function(data, textStatus, xhr) {



      $("#nombres").val(data.cliente_nombre);

      $("#apellidos").val(data.cliente_apellidos);

      $("#correo").val(data.cliente_correo);

      $("#telefono").val(data.telefono_cliente);

       //  $("#universidad").val(data.universidad);

       $("#universidad option[value='"+ data.universidad+"']").attr("selected",true);

       $("#carrera").val(data.carrera);

       $("#direccion").val(data.direccion_cliente);

       $("#dni").val(data.dni);

       $("#dni1").val(data.dni);

       $("#id_ficha_enfoque").val(data.id_ficha_enfoque);

       $("#porque").val(data.porque);

       $("#paraque").val(data.paraque);

       $("#como").val(data.como);

       $("#donde").val(data.donde);

       $("#muestra").val(data.muestra);

       $("#problemage").val(data.problemageneral);

       $("#objgeneral").val(data.objetivogeneral);

       $("#variabled").val(data.variable_dependiente);

       $("#variablei").val(data.variable_independiente);

       $("#anios_antiguedad").val(data.anios_antiguedad);

       $("#cant_inter").val(data.cant_inter);

       $("#cant_nacio").val(data.cant_nacio);

       $("#cant_local").val(data.cant_local);

       $("#res_cant_hojas").val(data.res_cant_hojas);

       $("#bio_cantidad").val(data.bio_cantidad);

       $("#bio_ordenado").val(data.bio_ordenado);

       $("#forma_orden").val(data.forma_orden);

       $("#plan_mejora").val(data.plan_mejora);

       $("#marco_conceptual").val(data.marco_conceptual);

       $("#can_autor").val(data.can_autor);

       $("#docente").val(data.docente);

       $("#can_realidad").val(data.can_realidad);

       $("#cant_marco").val(data.cant_marco);

       $("#anio_teoria").val(data.anio_teoria);

       if($("#hipg21").val() != ""){
         document.getElementById('detallehipcausal').style.display = 'block';
       }else{
        document.getElementById('detallehipcausal').style.display = 'none';
      }

      $("#id_tipocliente option[value="+ data.tipocliente+"]").attr("selected",true);

      $("#id_tipo_enfoque option[value="+ data.id_tipo_enfoque+"]").attr("selected",true);

      $("#select option[value="+ data.ficha_iddiseo+"]").attr("selected",true);

      $("#id_categoria option[value="+ data.id_categoria+"]").attr('checked', 'checked');

      $("#id_trabajador option[value="+ data.id_trabajador+"]").attr("selected",true);

      <?php $estado ='<script> alertz(data.estado_ficha) </script>';?>

      if(data.estado_ficha==3 || data.estado_ficha==6)

      {



        $("#tab3").removeClass('disabledTab');

        $("#tab3").addClass('active');

        $("#tab1").removeClass('active');

        $("#bordered-justified-tab1").removeClass('active');

        $("#btn_form2").prop( "disabled", false );

          //$(".modal-backdrop fade in").removeClass('modal-backdrop fade in');

          $("#bordered-justified-tab3").addClass('active');

          $.post(base_url+'Ficha_enfoque/categoria_subfases', {id_categoria: data.id_categoria,id_tipo_enfoque: data.id_tipo_enfoque},

           function(data, textStatus, xhr)

           {

             $('#cuerpo_tabla').empty();

             $('#cuerpo_tabla').append(data);

           });

        }

        else

        {

         if(data.estado_ficha==5){

           $("#tab5").removeClass('disabledTab');

           $("#tab2").removeClass('disabledTab');

           $("#tab5").addClass('active');

           $("#tab1").removeClass('active');

           $("#bordered-justified-tab1").removeClass('active');

           $("#btn_form2").prop( "disabled", false );

          //$(".modal-backdrop fade in").removeClass('modal-backdrop fade in');

          $("#bordered-justified-tab5").addClass('active');

        }

      }

    },"json");

});

</script>

<?php }

else{

 $id_categoria="";

 $id_grado="";

 $titulo="";

 $id_especialidad="";

 $idenfoque="";

 ?>



 <script type="text/javascript">

   $(function(){

     $.post(base_url+"Ficha_enfoque/asesores",function(data){

      $('#id_trabajador').empty();

      $('#id_trabajador').append(data);



    });

   });

 </script>

 <?php 



}







?>



<style>







  #calendar {

    max-width: 900px;

    margin: 0 auto;

    width: 900px;

    height: 800px;

    

  }



</style>

<?php

if($_SESSION['usuario_perfil']==2 || $_SESSION['usuario_perfil']==4)



 {  ?>    

<script type="text/javascript">

  $( function() {

   $('#formulario1').find('input, textarea, select').attr('disabled','disabled');

   $('#btn_form2').attr("disabled",false);

   $('#guardar_clientes').attr("disabled",true);



   $('#id_trabajador').attr("disabled",true);





   var opciones1 = document.getElementsByName("id_especialidad");

   for(var i=0; i<opciones1.length; i++) {

    opciones1[i].disabled = true;

  }

  var opciones1 = document.getElementsByName("id_grado");

  for(var i=0; i<opciones1.length; i++) {

    opciones1[i].disabled = true;

  }

  var opciones1 = document.getElementsByName("id_categoria");

  for(var i=0; i<opciones1.length; i++) {

    opciones1[i].disabled = true;

  }









  $("#tab1").removeClass('active');

  $("#tab2").removeClass('disabledTab');

  $("#tab2").addClass('active');



  $("#bordered-justified-tab1").removeClass('active');

  $("#bordered-justified-tab2").addClass('active');

});

</script>



<?php   }











$universidad1=array();



foreach ($universidad as  $value) {



  $universidad1[]=$value->descripcion;

}



$carrera1=array();



foreach ($carrera as  $value) {



  $carrera1[]=$value->carrera;

}







?>

<style type="text/css">

  .disabledTab{

    pointer-events: none;

  }

</style>





<div class="panel panel-flat">

  <div class="panel-heading">



  </div>



  <div class="panel-body">

    <div class="row">

     <div class="tabbable tab-content-bordered">

      <ul class="nav nav-tabs nav-tabs-highlight nav-justified">

        <li id="tab1" class="active"><a href="#bordered-justified-tab1" data-toggle="tab" class="legitRipple" aria-expanded="true">Datos Personales</a></li>

        <li id="tab2"   <?php if($estadoficha!=6){?>

         class="disabledTab"

         <?php }?> ><a href="#bordered-justified-tab2" data-toggle="tab" class="legitRipple" aria-expanded="false">Ficha De Enfoque</a></li>

         <li id="tab3" class="disabledTab"><a href="#bordered-justified-tab3" data-toggle="tab" class="legitRipple" aria-expanded="false">Asignacion</a></li>

         <li id="tab4" class="disabledTab"><a href="#bordered-justified-tab4" data-toggle="tab" class="legitRipple" aria-expanded="false">Horario</a></li>

         <li id="tab5" class="disabledTab"><a href="#bordered-justified-tab5" data-toggle="tab" class="legitRipple" aria-expanded="false">pagos</a></li>

         <li id="tab6" class="disabledTab"><a href="#bordered-justified-tab6" data-toggle="tab" class="legitRipple" aria-expanded="false">Contrato</a></li>



       </ul>

       <div class="tab-content">

        <div  class="tab-pane has-padding active " id="bordered-justified-tab1">



         <form id="formulario1" autocomplete="off">

          <div class="row">

           <div class="form-group">

             <label class="control-label col-lg-1">Nombres<span class="text-danger">*</span></label>

             <div class="col-lg-5">

               <input type="text" required="true" onkeypress="return sololetras(event)"  name="nombres" id="nombres" class="form-control" value="" >

             </div>



             <label class="control-label col-lg-1">Apellidos<span class="text-danger">*</span></label>

             <div class="col-lg-5">

               <input type="text" required="true" onkeypress="return sololetras(event)" class="form-control" name="apellidos" id="apellidos" value="" >

             </div>

           </div>

         </div>



         <div class="row">

           <div class="form-group">

             <label class="control-label col-lg-1">DNI<span class="text-danger">*</span></label>

             <div class="col-lg-5">

               <input type="text"  required="true" onkeypress="return solonumeros(event)" maxlength="8" name="dni" id="dni"  class="form-control" value="" >

             </div>



             <label class="control-label col-lg-1">Telefono<span class="text-danger">*</span></label>

             <div class="col-lg-5">

               <input type="text" required="true" onkeypress="return solonumeros(event)" maxlength="9" id="telefono" name="telefono" class="form-control" value="" >

             </div>

           </div>

         </div>





         <div class="row">

           <div class="form-group">

             <label class="control-label col-lg-1">Correo<span class="text-danger">*</span></label>

             <div class="col-lg-10">

               <input type="text" required="true" id="correo" name="correo" class="form-control" value="" >

             </div>





           </div>

         </div>

         <div class="row">

           <div class="form-group">

             <label class="control-label col-lg-1">Direccion<span class="text-danger">*</span></label>

             <div class="col-lg-10">

               <input type="text" required="true" id="direccion" name="direccion" class="form-control" value="" >

             </div>





           </div>

         </div>

         <br>

         <div class="row">

           <div class="form-group">

            <label class="control-label col-lg-1">Departamento:</label>

            <div class="col-lg-3">

             <select name="select" id="departamento" name="departamento" class="form-control">

               <option value="opt1">Selecionar</option>



               <?php

               foreach ($departamento as $value ){

                echo "<option value='".$value->id_departamento."'>".$value->descripcion."</option>";

              }

              ?>

            </select>

          </div>

          <label class="control-label col-lg-1">Provincia:</label>

          <div class="col-lg-3">

           <select name="select" id="provincia" name="departamento" class="form-control">

             <option value="opt1">Selecionar</option>



           </select>

         </div>

         <label class="control-label col-lg-1">Distrito:</label>

         <div class="col-lg-3">

           <select  id="distrito" name="distrito" class="form-control">

             <option value="opt1">Selecionar</option>

           </select>

         </div>

       </div>          

     </div>

     <br>

     <div class="row">

       <div class="form-group">

        <label class="control-label col-lg-1">Tipo Cliente:</label>

        <div class="col-lg-3">

         <select  id="id_tipocliente" name="id_tipocliente" class="form-control">

                                                    <?php //print_r($tipocliente);

                                                    foreach ($tipocliente as $value ){

                                                      echo "<option value='".$value->id_tipocliente."'>".$value->descripcion."</option>";

                                                    }

                                                    ?>



                                                  </select>

                                                </div>



                                                <label class="control-label col-lg-1">Universidad<span class="text-danger">*</span></label>

                                                <div class="col-lg-3">

                                                  <!-- <input type="text" required="true" id="universidad" name="universidad" class="form-control" value=""  id="universidad">-->

                                                  <select id="universidad" name="universidad" class="form-control">

                                                   <option>Seleccionar universidad</option>

                                                   <?php

                                                   foreach ($universidad as $value ){

                                                    echo "<option value='".$value->descripcion."'>".$value->descripcion."</option>";

                                                  }

                                                  ?>



                                                </select>

                                              </div>



                                              <label class="control-label col-lg-1">Carrera<span class="text-danger">*</span></label>

                                              <div class="col-lg-3">

                                               <input type="text" required="true" id="carrera" name="carrera" class="form-control" value="" >

                                             </div>



                                           </div>

                                         </div>



                                       </form>





                                       <br>

                                       <div class="row">



                                        <center> 

                                         <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('Ficha_enfoque','Tesis')">Cancelar</button>

                                         <button id="guardar_clientes" class="btn btn-primary legitRipple">Guardar y seguir</button>

                                       </center>



                                     </div>                                 

                                   </div>







                                   <div class="tab-pane has-padding " id="bordered-justified-tab2">

                                     <form id="formulario_enfoque" > 

                                       <input type="hidden" value="<?php echo $idenfoque; ?>" name="id_enfoque" id="id_enfoque" />

                                       <input type="hidden" name="dni1" id="dni1">

                                       <input type="hidden" name="empiezo" id="empiezo">

                                       <input type="hidden" name="fin" id="fin">

                                       <div class="row">



                                         <?php 

                                         if($estadoficha!=6 ){

                                           if($_SESSION['usuario_perfil']=="5" || $_SESSION['usuario_perfil']=="4" || $_SESSION['usuario_perfil']=="1"){ ?>

                                           <div class="col-md-2">

                                            <div class="form-group">

                                              <label class="control-label col-lg-6">Captacion<span class="text-danger">*</span></label>

                                              <select class="form-control" value="" name="id_captacion" id="id_captacion">

                                               <?php



                                               foreach ($captacion as $value) {



                                                echo "<option value='".$value->id_captacion."'>".$value->descripcion."</option>";

                                              }



                                              ?>

                                            </select>

                                          </div>

                                        </div>

                                        <div class="col-md-1">

                                         <label>agregar</label><br>

                                         <button class="btn btn-primary" id="agregarCaptacion1"><b>+</b></i></button>

                                       </div>

                                       <div class="col-md-4">

                                        <div class="form-group">

                                          <label class="control-label col-lg-6">Detalle<span class="text-danger">*</span></label>

                                          <input type="text" name="detalle" id="detalle" class="form-control">

                                        </div>

                                      </div>

                                      <div class="col-md-2">

                                        <div class="form-group">

                                          <input type="hidden" name="color" id="color" value="">

                                          <label class="control-label col-lg-6">color<span class="text-danger">*</span></label>

                                          <button type="button" id="btn-color" class="btn btn-primary">color</button>



                                        </div>



                                      </div>



                                      <?php } }?>







                                    </div>

                                    <br>

                                    <div class="row">

                                     <div class="form-group">

                                       <label class="control-label col-lg-1">Titulo<span class="text-danger">*</span></label>

                                       <div class="col-lg-11">

                                        <input type="text" required="true" name="titulo_enfoque" id="titulo_enfoque" class="form-control" value="<?php echo $titulo; ?>">

                                      </div>

                                    </div>

                                  </div>

                                  <br/>

                                  <div class="row">

                                   <div class="col-md-4">

                                    <div class="form-group">

                                      <label class="text-semibold">Categorias</label>

                                      <?php foreach($categoria as $value){



                                        if($value->id_categoria==$id_categoria){

                                         echo '<div class="radio">

                                         <label>

                                           <input type="radio" value="'.$value->id_categoria.'" id="id_categoria" checked="checked" name="id_categoria" >

                                           '.$value->descripcion.'

                                         </label>

                                       </div>';

                                     }

                                     else{

                                       echo '<div class="radio">

                                       <label>

                                         <input type="radio" value="'.$value->id_categoria.'" id="id_categoria" name="id_categoria" >

                                         '.$value->descripcion.'

                                       </label>

                                     </div>';

                                   }

                                 }

                                 ?>

                               </div>

                             </div>

                             <div class="col-md-4">

                               <div class="form-group">

                                <label class="text-semibold">Grado academico</label>

                                <?php foreach($grado as $value){

                                 if($value->id_grado==$id_grado)

                                 {

                                  echo '<div class="radio">

                                  <label>

                                   <input checked="checked" type="radio" value="'.$value->id_grado.'" id="id_grado" name="id_grado" >

                                   '.$value->descripcion.'

                                 </label>

                               </div>';

                             }

                             else{

                              echo '<div class="radio">

                              <label>

                               <input type="radio" value="'.$value->id_grado.'" id="id_grado" name="id_grado" >

                               '.$value->descripcion.'

                             </label>

                           </div>';

                         }

                       }

                       ?>

                     </div>

                   </div>



                   <div class="col-md-4">

                     <?php 

                     if($estadoficha!=6 ){

                       if($_SESSION['usuario_perfil']==5 || $_SESSION['usuario_perfil']=="4" || $_SESSION['usuario_perfil']=="1"){ ?>

                       <div class="panel-body">

                        <div class="form-group">



                          <label class="col-md-4"><b>Tiempo enfoque</b> </label>

                          <div  class="input-group col-md-8">

                           <span class="input-group-addon"><i class="icon-watch2"></i></span>

                           <input type="text" name="hora" class="form-control anytime-time" id="hora" value="00:00">

                         </div>



                       </div>

                       <div class="form-group">



                        <label><b>Seleccionar asesor</b></label>

                        <select class="form-control" id="id_trabajador" name="id_trabajador" >

                         <option value="-1">Selecionar asesor</option>

                       </select>

                     </div>





                   </div>

                   <?php } }?>

                 </div>





               </div>

                    <!--  <div class="row">

                        <div class="form-group">

          

               <?php foreach($especialidad as $value1){

                  if($value1->id_especialidad==$id_especialidad){

                    echo '<label class="radio-inline">

                     <input type="radio" checked="checked" value="'.$value1->id_especialidad.'" name="id_especialidad" id="id_especialidad" >'.$value1->descripcion.'</label>';

                     }



                    else{

                      echo '<label class="radio-inline">

                     <input type="radio" value="'.$value1->id_especialidad.'" name="id_especialidad" id="id_especialidad" >'.$value1->descripcion.'</label>';

                    }

                        

                    }

                                 ?>

                  

                  </div>

                </div><--></-->

                <div class="row">

                  <div class="col-md-6">

                    <label class="display-block text-semibold">Especialidad de la tesis</label>

                    <select class="select-search" id="id_especialidad" name="id_especialidad">

                      <option value="">Seleccionar Especialidad</option>

                      <?php foreach($especialidad as $value1){

                        if($value1->id_especialidad==$id_especialidad){

                          echo '

                          <option  selected="true" value="'.$value1->id_especialidad.'">'.$value1->descripcion."</option>";

                        }



                        else{

                         echo '

                         <option value="'.$value1->id_especialidad.'">'.$value1->descripcion."</option>";

                       }



                     }

                     ?>

                   </select>

                 </div>

               </div>

               <br>

               <div class="row">



                <div class="col-md-12">

                  <label>Docente</label>

                  <input type="text" name="docente"  id="docente" class="form-control">

                </div>

              </div>

              <div class="row">

                <center><h2><u>ENFOQUE</u></h2></center>

                <rigth><label>(Debe Contener la idea clara de la problematica, ademas debe mostar cataracteristcas detalladas de la empresa o institucion arealizar la investigacion ""Nombre a que se dedica, donde encontrar informacion, deudas, cantidad producida)</label></rigth>

              </div>

              <div class="row">

                <div class="form-group">

                  <label class="control-label col-lg-6">Enfoque<span class="text-danger">*</span></label>

                  <select class="form-control" value="" name="id_tipo_enfoque" id="id_tipo_enfoque">

                   <?php



                   foreach ($tipo as $value) {



                    echo "<option value='".$value->id_tipo_enfoque."'>".$value->descripcion."</option>";

                  }



                  ?>

                </select>

              </div>


              <div class="form-group">

                <label class="control-label col-lg-2">Diseño de investigación:</label>

                <div class="col-lg-3">

                  <select name="select" id="diseño" name="diseño" class="form-control">

                    <option value="opt1">Selecionar</option>



                  </select>

                </div>

              </div>

            </div>

            <div class="row">

             <div class="form-group">

               <label class="control-label col-lg-2">¿Porque?</label>

               <div class="col-lg-11">

                <textarea rows="2   " cols="5" class="form-control" name="porque" id="porque"></textarea>

              </div>

            </div>  

          </div>

          <div class="row">

           <div class="form-group">

             <label class="control-label col-lg-2">¿Para que?</label>

             <div class="col-lg-11">

              <textarea rows="2   " cols="5" class="form-control" name="paraque" id="paraque"></textarea>

            </div>

          </div>  

        </div>

        <div class="row">

         <div class="form-group">

           <label class="control-label col-lg-2">¿Como?</label>

           <div class="col-lg-11">

            <textarea rows="2   " cols="5" class="form-control" name="como" id="como"></textarea>

          </div>

        </div>  

      </div>




      <div class="row">

       <div class="form-group">

         <label class="control-label col-lg-2">Lugar</label>

         <div class="col-lg-11">

          <textarea rows="2   " cols="5" class="form-control" name="donde" id="donde"></textarea>

        </div>

      </div>  

    </div>
    <div class="row">

     <div class="form-group">

       <label class="control-label col-lg-2">Problema</label>

       <div class="col-lg-11">

        <textarea rows="2   " cols="5" class="form-control" name="problemage" id="problemage" ></textarea>

      </div>

    </div>  

  </div>
  <div class="row">

   <div class="form-group">

     <label class="control-label col-lg-2">Objetivo General</label>

     <div class="col-lg-11">

      <textarea rows="2   " cols="5" class="form-control" name="objgeneral" id="objgeneral" ></textarea>

    </div>

  </div>  

</div>
<div class="row" id="hipgeneraldiv" style='display:none;'>

 <div class="form-group">

   <label class="control-label col-lg-2">Hipotesis</label>

   <div class="col-lg-11">

    <textarea rows="2   " cols="5" class="form-control" name="hipgeneral" id="hipgeneral" ></textarea>

  </div>

</div>  

</div>

<div class="row">

 <div class="form-group">

   <label class="control-label col-lg-2">Variable Dependiente</label>

   <div class="col-lg-11">

    <textarea rows="1   " cols="5" class="form-control" name="variabled" id="variabled" ></textarea>

  </div>

</div>  

</div>


<div class="row">

 <div class="form-group">

   <label class="control-label col-lg-2">Variable Independiente</label>

   <div class="col-lg-11">

    <textarea rows="1   " cols="5" class="form-control" name="variablei" id="variablei" ></textarea>

  </div>

</div>  

</div>

<div class="row">

  <div class="form-group">

   <label class="control-label col-lg-1">Muestra<span class="text-danger">*</span></label>

   <div class="col-lg-11">

    <input type="text" required="true" name="muestra" id="muestra" class="form-control" value="" >

  </div>

</div>

</div>
<div class="row" id="detallehipcausal" style='display:none;'>
 <div class="form-group">
   <legend id="titulohipotesis"></legend>
   <div id="mostrardetalle" name="mostrardetalle">
    <div class="col-md-6">
      <div class='form-group'>  
       <label>Hipotesis  </label>
       <?php foreach ($hipot as $hipotesis) {?>
       <?php if($hipotesis->detfi_idhip ==1){?>
       <div class="col-lg-11">
        <input type="text" placeholder="2 da Hipotesis de la Investigación "Hi"" required="true" name="hip2[]" id="hipg21" class="form-control" value="<?php echo  $hipotesis->hipotesis?> " readonly>
      </div>
      <?php }?>
      <?php }?>
    </div>  
  </div>
  <?php $c =1; ?>
  <div class="col-md-6">
    <div class='form-group'>  
     <label>Hipotesis </label>
     <?php foreach ($hipot as $hipotesis) {?>
     <?php if($hipotesis->detfi_idhip ==2){?>
     <div class="col-lg-11">
      <input type="text" placeholder="2 da Hipotesis de la Investigación "Hi"" required="true" name="hip2[]" id="hipg2 <?php echo $c+1 ?>" class="form-control" value="<?php echo $hipotesis->hipotesis ?> " readonly>
    </div>
    <?php }?>
    <?php $c++;}?>
  </div>  
  </div>
</div>
  <div id="detallepre" name="detallepre"></div>
</div>
</div>


<div class="row" id="detalleprob" style='display:none;'>
  <div class="form-group">
   <legend>Problemas y Objetivos</legend>
   <div class='row'>
    <div class="col-md-6">  
      <div class='form-group'>
        <div class='radio'>
          <div class="col-lg-2">
            <label>Problema 1</label>
          </div>
          <div id="hipopo" class="col-lg-10">
           <textarea rows="2" cols="2" required="true" name="pactual" id="pactual" class="form-control" value="" ></textarea>
         </div>  
       </div>
     </div>  
   </div>
   <div class="col-md-6">  
    <div class='form-group'>
      <div class='radio'>
        <div class="col-lg-2">
          <label>OBJ. 1 </label>
        </div>
        <div id="hipopo" class="col-lg-10">
         <textarea rows="2" cols="2" required="true" name="obj1" id="obj1" class="form-control" value="" ></textarea>
       </div>  
     </div>
   </div>  
 </div>
</div>
<div class='row'>
  <div class="col-md-6">  
    <div class='form-group'>
      <div class='radio'>
        <div class="col-lg-2">
          <label>Problema 2</label>
        </div>
        <div id="hipopo" class="col-lg-10">
         <textarea rows="2" cols="2" required="true" name="pinfluyente" id="pinfluyente" class="form-control" value="" ></textarea>
       </div>  
     </div>
   </div>  
 </div>
 <div class="col-md-6">  
  <div class='form-group'>
    <div class='radio'>
      <div class="col-lg-2">
        <label>OBJ. 2</label>
      </div>
      <div id="hipopo" class="col-lg-10">
       <textarea rows="2" cols="2" required="true" name="obj2" id="obj2" class="form-control" value="" ></textarea>
     </div>  
   </div>
 </div>  
</div>
</div>
<div class='row'>
  <div class="col-md-6">  
    <div class='form-group'>
      <div class='radio'>
        <div class="col-lg-2">
          <label>Problema 3</label>
        </div>
        <div id="hipopo" class="col-lg-10">
         <textarea rows="2" cols="2" required="true" name="psolucion" id="psolucion" class="form-control" value="" ></textarea>
       </div>  
     </div>
   </div>  
 </div>
 <div class="col-md-6">  
  <div class='form-group'>
    <div class='radio'>
      <div class="col-lg-2">
        <label>OBJ. 3</label>
      </div>
      <div id="hipopo" class="col-lg-10">
       <textarea rows="2" cols="2" required="true" name="obj3" id="obj3" class="form-control" value="" ></textarea>
     </div>  
   </div>
 </div>  
</div>
</div>
<div class='row'>
  <div class="col-md-6">  
    <div class='form-group'>
      <div class='radio'>
        <div class="col-lg-2">
          <label>Problema 4</label>
        </div>
        <div id="hipopo" class="col-lg-10">
         <textarea rows="2" cols="2" required="true" name="presultados" id="presultados" class="form-control" value="" ></textarea>
       </div>  
     </div>
   </div>  
 </div>
 <div class="col-md-6">  
  <div class='form-group'>
    <div class='radio'>
      <div class="col-lg-2">
        <label>OBJ. 4</label>
      </div>
      <div id="hipopo" class="col-lg-10">
       <textarea rows="2" cols="2" required="true" name="obj4" id="obj4" class="form-control" value="" ></textarea>
     </div>  
   </div>
 </div>  
</div>
</div>
</div>
</div>

<br>

<div class="row form-horizontal">

  <div class="col-md-4">

   <fieldset class="content-group">

     <legend class="text-bold">Antecedentes</legend>



     <div class="form-group">

      <label class="control-label col-lg-5">Años de antiguedad</label>

      <div class="col-lg-7">

       <div class="input-group">

        <input type="text" name="anios_antiguedad" onkeypress="return solonumeros(event)"  id="anios_antiguedad" class="form-control" >

      </div>

    </div>

  </div>



  <div class="form-group">

    <label class="control-label col-lg-5">Cant. de internacionales</label>

    <div class="col-lg-7">

     <div class="input-group">

      <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="cant_inter" id="cant_inter" >



    </div>

  </div>

</div>



<div class="form-group">

  <label class="control-label col-lg-5">Cant. de Nacionales</label>

  <div class="col-lg-7">

   <div class="input-group">



    <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="cant_nacio" id="cant_nacio" >



  </div>

</div>

</div>

<div class="form-group">

  <label class="control-label col-lg-5">Cant. de Locales</label>

  <div class="col-lg-7">

   <div class="input-group">



    <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="cant_local" id="cant_local" >



  </div>

</div>

</div>



</fieldset>

</div>

<div class="col-md-4">

 <fieldset class="content-group">

   <legend class="text-bold">REALIDAD PROBLEMATICA Y MARCO TEORICO</legend>



   <div class="form-group">

    <label class="control-label col-lg-8">Cant. hojas realidad problematica</label>

    <div class="col-lg-4">

     <div class="input-group">

      <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="can_realidad" id="can_realidad" >

    </div>

  </div>

</div>



<div class="form-group">

  <label class="control-label col-lg-8">Cant. hojas de marco teorico</label>

  <div class="col-lg-4">

   <div class="input-group">

    <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="cant_marco" id="cant_marco" >



  </div>

</div>

</div>



<div class="form-group">

  <label class="control-label col-lg-8">Años de antiguedad de las teorias</label>

  <div class="col-lg-4">

   <div class="input-group">



    <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="anio_teoria" id="anio_teoria"   >



  </div>

</div>

</div>

<div class="form-group">

  <label class="control-label col-lg-8">Cantidad de autores</label>

  <div class="col-lg-4">

   <div class="input-group">



    <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="can_autor" id="can_autor">



  </div>

</div>

</div>

<div class="form-group">

  <label class="control-label col-lg-9">Llevar Marco conceptual con autores</label>

  <div class="col-lg-3">

   <div class="input-group">

     <div class="radio">

       <label> 

         <input type="radio"  value="si" name="marco_conceptual" checked="checked">

         Si

       </label>

     </div>

     <div class="radio">

       <label> 

         <input type="radio" value="no" name="marco_conceptual" >

         No

       </label>

     </div>



   </div>

 </div>

</div>          

</fieldset>

</div>

<div class="col-md-4">

 <fieldset class="content-group">

   <legend class="text-bold">RESULTADOS</legend>

   <div class="form-group">

    <label class="control-label col-lg-5">Cant. hojas</label>

    <div class="col-md-7">

     <div class="input-group">

      <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="res_cant_hojas" id="res_cant_hojas" >

    </div>

  </div>

</div>

<div class="form-group ">

  <label class="display-block text-semibold">Resultado por:</label>

  <?php foreach ($resultado as $value) {?>





  <div class="checkbox">

   <label>

    <span class="checked"><input value="<?php echo $value->id_resultado; ?>" type="checkbox" name="res_por[]" id="res_por[]" class="styled"></span>

    <?php echo $value->descripcion; ?>

  </label>

</div>

<?php }?>

</div>

</fieldset>

</div>

</div>

<div class="row">

 <div class="col-md-4">

  <fieldset class="content-group" >

    <legend>Referencias bibliograficas</legend>

    <div class="form-group">

      <label class="control-label col-lg-9">Tipo de normas</label>

      <div class="col-lg-3">

       <div class="input-group">

        <?php foreach($tipo_norma as $value){

          echo '<div class="radio">

          <label> 

            <input type="radio" value="'.$value->id_tipo_norma.'" name="id_tipo_norma" id="id_tipo_norma" checked="checked">'.$value->descripcion.'



          </label>

        </div>';

      }?>



    </div>

  </div>

</div>

<div class="form-group">



  <label class="control-label col-lg-5">Cantidad</label>

  <div class="col-md-7">

    <div class="input-group">

     <input type="text" class="form-control" onkeypress="return solonumeros(event)"  name="bio_cantidad" id="bio_cantidad" >

   </div>

 </div>

</div>

<div class="form-group">

  <label class="control-label col-lg-5">Ordenado por:</label>

  <div class="col-lg-7">

   <div class="input-group">

     <div class="radio">

       <label> 

         <input type="radio" value="si" name="bio_ordenado" checked="checked">

         Orden Alfabetico

       </label>

     </div>

     <div class="radio">

       <label> 

         <input type="radio" value="no" name="bio_ordenado" >

         Por tipo

       </label>

     </div>



   </div>

 </div>

</div>  



</fieldset>



</div>            

</div>

<div class="row">

 <div class="form-group">

   <center><label class="control-label col-lg-12" style="text-transform: uppercase;">Forma y orden de como se expresa los resultados</label></center>

   <div class="col-lg-12">

    <textarea rows="5" cols="5" class="form-control" name="forma_orden" id="forma_orden"></textarea>

  </div>

</div>  

</div>

<div class="row">

 <div class="col-md-8">

  <div class="form-group">

    <label class="control-label col-lg-5">La investigacion¿llevara un plan de mejoramiento?:</label>

    <div class="col-lg-7">

     <div class="input-group">

       <div class="radio">

         <label> 

           <input type="radio" value="si" name="plan_mejora" checked="checked">

           si

         </label>

       </div>

       <div class="radio">

         <label> 

           <input type="radio" value="no" name="plan_mejora" >

           no

         </label>

       </div>



     </div>

   </div>

 </div> 

</div>

</div>



<div class="row">

 <center>

  <div class="row">

    <center> 

      <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('Ficha_enfoque','Tesis')">Cancelar</button>

      <button id="btn_form2" disabled="true" type="button"  class="btn btn-primary legitRipple">Guardar </button>

    </center>               

  </div>

</center>

</div>

</form>

</div>



















<div class="tab-pane has-padding" id="bordered-justified-tab3">

  <input type="hidden" name="id_produccion1" value="<?php echo $id_produccion; ?>" id="id_produccion1">

  <div id="cabeza-tab3">



    <form id="formulario2">

      <input type="hidden" name="id_produccion" value="<?php echo $id_produccion; ?>" id="id_produccion">

      <div id="cuerpo-tab3">

        <div class="row"> 

         <table class="table table-bordered table-framed">

           <thead>

            <tr>

             <th width="80%" colspan="2">

              <b>FASES A EJECUTAR</b>

            </th>

            <th colspan="3">

              <center>HACER </center>

            </th>

            <th colspan="3">

              <center>CORREGIR</center>

            </th>

          </tr>

          <tr>

            <th></th>

            <th></th>

            <th><center><b >Bajo</b><br><input id="id_t"  class="styled" value="1" type="checkbox" onclick="selecionar('1','1','1')"/></center></th>

            <th><center><b >Medio</b><br><input id="id_t"  class="styled" value="2"   type="checkbox" onclick="selecionar('1','2','2')"/></center></th>

            <th><center><b >Dificil</b><br><input id="id_t"  class="styled" value="3"  type="checkbox" onclick="selecionar('1','3','3')"/></center></th>

            <th><center><b >Bajo</b><br><input  id="id_t" class="styled" value="4"  type="checkbox" onclick="selecionar('2','1','4')"></center></th>

            <th><center><b >Medio</b><br><input id="id_t"  class="styled" value="5"  type="checkbox" onclick="selecionar('2','2','5')"/></center></th>

            <th><center><b >Dificil</b><br><input  id="id_t" class="styled" value="6"  type="checkbox" onclick="selecionar('2','3','6')"/></center></th>

          </tr>

        </thead>

        <tbody id="cuerpo_tabla">



        </tbody>

      </table>

    </div>

  </div>

  <br><br>

  <div class="row" id="boton3">

    <center> 

      <button class="btn btn-danger legitRipple" type="button"  onclick="reload_url('Ficha_enfoque','Tesis')">Cancelar</button>

      <button id="btn_form3"  type="button" class="btn btn-primary legitRipple">Guardar </button>

    </center>               

  </div>

</form>

</div>

<div id="boton2">



</div>

</div>

















<div class="tab-pane has-padding" id="bordered-justified-tab4">

 <div class="row">

   <center>

     <div id="botones"></div>

   </center>

 </div>

 <div class="row"><div id='calendar'></div></div>



 <div>

   <center>

     <button class="btn btn-danger" onclick="reload_url('Ficha_enfoque','Tesis')" >

      <?php if($estadoficha!=6){?>

      Cancelar

      <?php }else{?>

      Salir

      <?php }?>

    </button>

    <?php if($estadoficha!=6){?>

    <button class="btn btn-primary" onclick="seguir()">Seguir</button>

    <?php }?>

  </center>

</div>

</div>







<div class="tab-pane has-padding" id="bordered-justified-tab5"> 

  <form id="formularioPago" >

   <div class="row">

    <label class="col-sm-1 control-label">Monto_Pago.</label>

    <div class="col-md-1">

      <div class="icon-group">

       <i class="fa fa-dollar"></i>

       <input type="number" class="form-control" name="monto" id="monto" autocomplete="off" onkeyup="sincronograma()" required>

     </div>

   </div>

   <label class="col-sm-1 control-label">Fecha_Pago.</label>

   <div class="col-md-2">

     <input type="date" class="form-control" id="fechaprestamo" name="fechaprestamo" onkeyup="sincronograma()" value="<?php echo date('Y-m-d');?>"  required>

   </div>

   

   <label  class="col-sm-2 control-label">Seleccionar tipo de pago</label>

   <div class="col-md-4">

     <select class="form-control" id="tipo_pago">

       <option value="1">Contado</option>

       <option value="2">Credito</option>
       <option value="3">Contra entrega</option>

     </select>

   </div>

 </div>

 <br>

 <div class="row" id="credito">

  <div class="col-md-3"></div><label class="col-sm-1 control-label">#Partes</label>

  <div class="col-md-1">

   <input type="number" class="form-control" name="semanas" id="semanas" value="4" onkeyup="sincronograma()" required>

 </div>

 <label class="col-sm-1 control-label">Intervalo</label>

 <div class="col-md-2">

   <select class="form-control" name="intervalo" id="intervalo" required onchange="vercronograma()">

    <option value="MENSUAL">MENSUAL</option>

    <option value="DIARIO">DIARIO</option>

    <option value="SEMANAL">SEMANAL</option>

    <option value="QUINCENAL">QUINCENAL</option>



  </select>

</div>

<div class="col-md-2">

 <button type="button" class="btn btn-primary" onclick="vercronograma()">Ver cronograma</button>

</div>

</div>



<br>

<div class="form-group" id="cronograma"></div>







<div class="form-group">

  <center>

   <button type="button" class="btn btn-primary" id="btn_guardar12">

    <i class="fa fa-save"></i> Guardar

  </button>

  <button type="button" class="btn btn-danger"  onclick="reload_url('Ficha_enfoque','Tesis')">

    Cancelar - Atras

  </button>

</center>

</div>

</form>









































</div>

<div class="tab-pane has-padding" id="bordered-justified-tab6">

 <center><iframe id="ficha_enfoque_pdf1" src="" width="850px" height="600px"></iframe></center>

</div>



</div>

</div>

</div>

</div>

</div>











<div id="modal_large" class="modal fade">

  <div class="modal-dialog modal-lg">

   <div class="modal-content">

    <div class="modal-header">

     <button type="button" class="close" data-dismiss="modal">&times;</button>

     <h5 class="modal-title">Ficha de enfoque</h5>

   </div>



   <div class="modal-body">

     <center><iframe id="ficha_enfoque_pdf" src="" width="850px" height="450px"></iframe></center>

   </div>



   <div class="modal-footer">

     <button type="button" class="btn btn-link" data-dismiss="modal">Cerrar</button>

     <?php if($estadoficha!=6){?>

     <button type="button" id="modal-fase3" data-dismiss="modal" class="btn btn-primary">Listo</button>

     <?php }?> 



   </div>

 </div>

</div>

</div>



<div id="modal_remote1" class="modal">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title" id="titulodiseo"></h5>
      </div>

      <div class="modal-body">
        <!-- "Educaiton" form for Stepy wizard -->
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label>La Hipotesis (Variable Independiente) o (Variable 1) </label>
              <input type="text" name="variableind" id="variableind" placeholder="Variable Independiente" class="form-control" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>El Problema (Variable Dependiente) o (Variable 2)</label>
              <input type="text" name="variabledepe" id="variabledepe" placeholder="Variable Dependient" class="form-control" >
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Opcional Para determinar el (grado o nivel)</label>
              <input type="text" name="gradonivel" id="gradonivel" placeholder="Gradonivel" class="form-control" >
            </div>
          </div>

          <div id="palabrasutilizar">
            <div class="col-md-4">
              <div class="form-group">
                <label>Palabra a Utilizar(1):</label>
                <select class="form-control" value="" name="palabra1" id="palabra1">
                  <option value="">Seleccionar</option>
                  <?php foreach ($palabras as $value) {
                    echo "<option value='".$value->ver_id."'>".$value->ver_sus1."</option>";
                  }?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Palabra a Utilizar(2):</label>
                <select class="form-control" value="" name="palabra2" id="palabra2" disabled>
                  <option value="">Seleccionar</option>
                  <?php foreach ($palabras as $value) {
                    echo "<option value='".$value->ver_id."'>".$value->ver_sus2."</option>";
                  }?>
                </select>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>INSITU (LUGAR) CIUDAD y (Año y/o Periodo)</label>
              <input type="text" name="lugar" id="lugar" placeholder="Lugar" class="form-control" >
            </div>
          </div>

          <div class='col-md-4'>
            <div class='form-group'>
              <label class='control-label col-md-4'>Verbos para Objetivos</label>
              <div class='col-md-8'>
                <select class="select-search" name="verbo" id="verbo" required>             
                  <?php 
                  foreach ($verbo as $value) { ?>
                  <option value="<?php echo $value->ver_id?>"><?php echo $value->ver_verbo?></option>
                  <?php }
                  ?>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row" id="enunciados">
        </div>

        <div class="row">
          <!-- /"educaiton" form for Stepy wizard --></div>

          <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="button" name="desccorrelacional" id="desccorrelacional" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

  </div>


  <div id="modal_remote2" class="modal">
    <div class="modal-dialog modal-full">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title">Descriptivo propositiva</h5>
        </div>

        <div class="modal-body">
          <!-- "Educaiton" form for Stepy wizard -->
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label>Meta:</label>
                <select class="form-control" value="" name="meta" id="meta">
                  <option value="">Seleccionar</option>
                  <?php foreach ($verbof as $value) {
                    echo "<option value='".$value->ver_id."'>".$value->ver_verbo."</option>";
                  }?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>En futuro</label>
                <select class="form-control" value="" name="futuro" id="futuro" disabled>
                  <option value="">Seleccionar</option>
                  <?php foreach ($verbof as $value) {
                    echo "<option value='".$value->ver_id."'>".$value->ver_sus1 ."</option>";
                  }?>
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>INSITU (LUGAR) CIUDAD y (Año y/o Periodo)</label>
                <input type="text" name="exlugar" id="exlugar" placeholder="Lugar" class="form-control" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>NIVEL DE ALCANCE(NA)</label>
                <input type="text" name="nivelalcance" id="nivelalcance" value="elaborar" placeholder="Nivel de Alcance" class="form-control" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>La Hipotesis (Variable Independiente) o (Variable 1) </label>
                <input type="text" name="variable1" id="variable1" placeholder="Variable Independiente" class="form-control" >
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>El Problema (Variable Dependiente) o (Variable 2)</label>
                <input type="text" name="variable2" id="variable2" placeholder="Variable Dependient" class="form-control" >
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label>SUSTANTIVO</label>
                <input type="text" name="sustantivo" id="sustantivo" value="elaboración" placeholder="Sustantivo" class="form-control" >
              </div>
            </div>
          </div>
          <div class="row" id="descriptivo_propositiva"  ><!--style="display: none;"-->
            <div class="panel-group content-group-lg" id="accordion1">
              <div class="panel panel-white">
                <div class="panel-heading">
                  <h6 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group11">Enunciado del Problema </a>
                  </h6>
                </div>
                <div id="accordion-group11" class="panel-collapse collapse">
                  <div class="panel-body">
                    <fieldset class='content-group'>
                      <div class='row'>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <div class="form-group">
                              <label  class="control-label col-lg-3">X (VI)</label>
                              <div class="col-lg-9">
                                <textarea rows="2" cols="5" required="true" name="exvi" id="exvi" class="form-control" value="" readonly=""></textarea>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class='col-md-6'>
                          <div class='form-group'>
                            <div class="form-group">
                              <label  class="control-label col-lg-3">Y (VD)</label>
                              <div class="col-lg-9">
                               <textarea rows="2" cols="5"  required="true" name="exvd" id="exvd" class="form-control" value="" readonly=""></textarea>
                             </div>
                           </div>
                         </div>  
                       </div>
                     </div>

                     <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="form-group">
                            <label  class="control-label col-lg-3">Titulo</label>
                            <div class="col-lg-9">
                              <textarea rows="2" cols="5"  required="true" name="extitulo" id="extitulo" class="form-control" value="" readonly=""></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="form-group">
                            <label  class="control-label col-lg-3">Hipotesis</label>
                            <div class="col-lg-9">
                             <textarea rows="2" cols="5"  required="true" name="exhipotesis" id="exhipotesis" class="form-control" value="" readonly=""></textarea>
                           </div>
                         </div>
                       </div>  
                     </div>

                   </div>

                   <div class='row'>
                    <div class='col-md-6'>
                      <div class="form-group">
                        <label class="control-label col-lg-3">Problema</label>
                        <div class="col-lg-9">
                         <textarea rows="2" cols="5"  required="true" name="exproblema" id="exproblema" class="form-control" value="" readonly=""></textarea>
                       </div>
                     </div>
                   </div>
                   <div class='col-md-6'>
                    <div class="form-group">
                      <label  class="control-label col-lg-3">Objetivo</label>
                      <div class="col-lg-9">
                        <textarea rows="2" cols="5"  required="true" name="exobjetivo" id="exobjetivo" class="form-control" value="" readonly=""></textarea>
                      </div>
                    </div> 
                  </div>
                </div>

                <div class='row'>
                  <div class='col-md-6'>
                    <div class='form-group'>
                      <div class="form-group">
                        <label  class="control-label col-lg-3">Problema 1</label>
                        <div class="col-lg-9">
                         <textarea rows="2" cols="5"  required="true" name="exactual" id="exactual" class="form-control" value="" readonly=""></textarea>
                       </div>
                     </div>
                   </div>  
                 </div>
                 <div class='col-md-6'>
                  <div class='form-group'>
                    <div class="form-group">
                      <label  class="control-label col-lg-3">OBJETIVO 1</label>
                      <div class="col-lg-9">
                       <textarea rows="2" cols="5"  required="true" name="exobjetivo1" id="exobjetivo1" class="form-control" value="" readonly=""></textarea>
                     </div>
                   </div>
                 </div>  
               </div>
             </div>
             <div class='row'>

              <div class='col-md-6'>
                <div class='form-group'>
                  <div class="form-group">
                    <label  class="control-label col-lg-3">Problema 2</label>
                    <div class="col-lg-9">
                      <textarea rows="2" cols="5"  required="true" name="exfactores" id="exfactores" class="form-control" value="" readonly=""></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class='col-md-6'>
                <div class='form-group'>
                  <div class="form-group">
                    <label  class="control-label col-lg-3">OBJETIVO 2</label>
                    <div class="col-lg-9">
                      <textarea rows="2" cols="5"  required="true" name="exobjetivo2" id="exobjetivo2" class="form-control" value="" readonly=""></textarea>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class='row'>
              <div class='col-md-6'>
                <div class='form-group'>
                  <div class="form-group">
                    <label  class="control-label col-lg-3">Problema 3</label>
                    <div class="col-lg-9">
                     <textarea rows="2" cols="5" required="true" name="exdiseño" id="exdiseño" class="form-control" value="" readonly=""></textarea>
                   </div>
                 </div>
               </div>  
             </div>
             <div class='col-md-6'>
              <div class='form-group'>
                <div class="form-group">
                  <label  class="control-label col-lg-3">OBJETIVO 3</label>
                  <div class="col-lg-9">
                    <textarea rows="2" cols="5"  required="true" name="exobjetivo3" id="exobjetivo3" class="form-control" value="" readonly=""></textarea>
                  </div>
                </div>
              </div>  
            </div>
          </div>


          <div class='row'>
            <div class='col-md-6'>
              <div class='form-group'>
                <div class="form-group">
                  <label  class="control-label col-lg-3">Problema 4</label>
                  <div class="col-lg-9">
                    <textarea rows="2" cols="5" required="true" name="exresultados" id="exresultados" class="form-control" value="" readonly=""></textarea>
                  </div>
                </div>
              </div>
            </div>      
            <div class='col-md-6'>
              <div class='form-group'>
                <div class="form-group">
                  <label  class="control-label col-lg-3">OBJETIVO 4</label>
                  <div class="col-lg-9">
                    <textarea rows="2" cols="5" required="true" name="exobjetivo4" id="exobjetivo4" class="form-control" value="" readonly=""></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </fieldset>
      </div>
    </div>
  </div>



</div>
</div>

<div class="row">
  <!-- /"educaiton" form for Stepy wizard --></div>

  <div class="modal-footer">
    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
    <button type="button" name="descpropositiva" id="descpropositiva" class="btn btn-primary">Save changes</button>
  </div>
</div>
</div>
</div>

</div>

<div id="modal_remote3" class="modal">
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h5 class="modal-title">Pre Experimental</h5>
      </div>

      <div class="modal-body">
        <!-- "Educaiton" form for Stepy wizard -->
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Palabra a Utilizar(1):</label>
              <select class="form-control" value="" name="palabrapre" id="palabrapre">
                <option value="">Seleccionar</option>
                <?php foreach ($palabras1 as $value) {
                  echo "<option value='".$value->ver_id."'>".$value->ver_sus1."</option>";
                }?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Meta:</label>
              <select class="form-control" value="" name="metapre" id="metapre">
                <option value="">Seleccionar</option>
                <?php foreach ($verbof as $value) {
                  echo "<option value='".$value->ver_id."'>".$value->ver_verbo."</option>";
                }?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>En Presente</label>
              <select class="form-control" value="" name="presentepre" id="presentepre" disabled>
                <option value="">Seleccionar</option>
                <?php foreach ($verbof as $value) {
                  echo "<option value='".$value->ver_id."'>".$value->ver_sus2 ."</option>";
                }?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>INSITU (LUGAR) CIUDAD y (Año y/o Periodo)</label>
              <input type="text" name="lugarpre" id="lugarpre" placeholder="Lugar" class="form-control" >
            </div>
          </div>
          <div class='col-md-3'>
            <div class='form-group'>
              <label>Verbos para Objetivos General</label>
              <select class="select-search" name="generalpre" id="generalpre" required>             
                <?php 
                foreach ($verbo as $value) { ?>
                <option value="<?php echo $value->ver_id?>"><?php echo $value->ver_verbo?></option>
                <?php }
                ?>
              </select> 
            </div>
          </div>
          <div class='col-md-3'>
            <div class='form-group'>
              <label>Verbos para Objetivos Especificos</label>
              <select class="select-search" name="especificospre" id="especificospre" required>             
                <?php 
                foreach ($verbo as $value) { ?>
                <option value="<?php echo $value->ver_id?>"><?php echo $value->ver_verbo?></option>
                <?php }
                ?>
              </select> 
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>La Hipotesis (Variable Independiente) o (Variable 1) </label>
              <input type="text" name="independientepre" id="independientepre" placeholder="Variable Independiente" class="form-control" >
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>El Problema (Variable Dependiente) o (Variable 2)</label>
              <input type="text" name="dependientepre" id="dependientepre" placeholder="Variable Dependient" class="form-control" >
            </div>
          </div>
        </div>
        <div class="row" id="pre_experimental"  ><!--style="display: none;"-->
          <div class="panel-group content-group-lg" id="accordion1">
                      <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group33">TITULO</a>
                </h6>
              </div>
              <div id="accordion-group33" class="panel-collapse collapse">
                <div class="panel-body">
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div id="titulopre1id" class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='titulopre' id='titulopre' onclick="titulopre(this);"></span>
                              <label id='titulopre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div id="titulopre2id" class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='titulopre' id='titulopre' onclick="titulopre(this);"></span>
                              <label id='titulopre2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group30">PROBLEMA GENERAL</a>
                </h6>
              </div>
              <div id="accordion-group30" class="panel-collapse collapse">
                <div class="panel-body">
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div id="progeneralpre1id" class='col-md-6'>
                        <div class='form-group '>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='progeneralpre' id='progeneralpre' onclick="progeneralpre(this);"></span>
                              <label id='progeneralpre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='progeneralpre' id='progeneralpre' onclick="progeneralpre(this);"></span>
                              <label id='progeneralpre2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='3' type='radio' name='progeneralpre' id='progeneralpre' onclick="progeneralpre(this);"></span>
                              <label id='progeneralpre3'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='4' type='radio' name='progeneralpre' id='progeneralpre' onclick="progeneralpre(this);"></span>
                              <label id='progeneralpre4'></label>
                            </label>
                          </div>
                        </div>
                      </div>
                </div>
                  </fieldset>
                </div>
              </div>
            </div>
            <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group31">HIPÓTESIS GENERAL</a>
                </h6>
              </div>
              <div id="accordion-group31" class="panel-collapse collapse">
                <div class="panel-body">
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div  id="hgeneralpre1id" class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='hgeneralpre' id='hgeneralpre' onclick="hgeneralpre(this);"></span>
                              <label id='hgeneralpre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div id="hgeneralpre2id" class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='hgeneralpre' id='hgeneralpre' onclick="hgeneralpre(this);"></span>
                              <label id='hgeneralpre2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='3' type='radio' name='hgeneralpre' id='hgeneralpre' onclick="hgeneralpre(this);"></span>
                              <label id='hgeneralpre3'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='4' type='radio' name='hgeneralpre' id='hgeneralpre' onclick="hgeneralpre(this);"></span>
                              <label id='hgeneralpre4'></label>
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='5' type='radio' name='hgeneralpre' id='hgeneralpre' onclick="hgeneralpre(this);"></span>
                              <label id='hgeneralpre5'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group32">OBJETIVO GENERAL</a>
                </h6>
              </div>
              <div id="accordion-group32" class="panel-collapse collapse">
                <div class="panel-body">
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='obgeneralpre' id='obgeneralpre' onclick="obgeneralpre(this);"></span>
                              <label id='obgeneralpre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group34">OBJETIVO ESPECÍFICOS</a>
                </h6>
              </div>
              <div id="accordion-group34" class="panel-collapse collapse">
                <div class="panel-body">
                <h5 class="panel-title">
                 OBJETIVO ESPECÍFICOS 1
                </h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='especificopre1' id='especificopre1' onclick="especificopre1(this);"></span>
                              <label id='obespecificopre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='especificopre1' id='especificopre1' onclick="especificopre1(this);"></span>
                              <label id='obespecificopre2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='3' type='radio' name='especificopre1' id='especificopre1' onclick="especificopre1(this);"></span>
                              <label id='obespecificopre3'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
                                <div class="panel-body">
                <h5 class="panel-title">
                 OBJETIVO ESPECÍFICOS 2
                </h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='especificopre2' id='especificopre2' onclick="especificopre2(this);"></span>
                              <label id='objespecificopre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='especificopre2' id='especificopre2' onclick="especificopre2(this);"></span>
                              <label id='objespecificopre2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
                                <div class="panel-body">
                <h5 class="panel-title">
                 OBJETIVO ESPECÍFICOS 3
                </h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='especificopre3' id='especificopre3' onclick="especificopre3(this);"></span>
                              <label id='objtespecificopre1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='especificopre3' id='especificopre3' onclick="especificopre3(this);"></span>
                              <label id='objtespecificopre2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class='radio'>
                            <label>
                              <span class='radio'><input value='3' type='radio' name='especificopre3' id='especificopre3' onclick="especificopre3(this);"></span>
                              <label id='objtespecificopre3'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group35">PROBLEMA ESPECÍFICOS</a>
                </h6>
              </div>
              <div id="accordion-group35" class="panel-collapse collapse">
                <div class="panel-body">
                <h5 class="panel-title">
                 PROBLEMA ESPECÍFICOS 1
                </h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='proespecificopre' id='proespecificopre' onclick="proespecificopre(this);"></span>
                              <label id='proespecificopre_1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                                <div class="panel-body">
                <h5 class="panel-title">
                 PROBLEMA ESPECÍFICOS 2
                </h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='proespecificopre2' id='proespecificopre2' onclick="proespecificopre2(this);"></span>
                              <label id='proespecificopre2_1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='proespecificopre2' id='proespecificopre2' onclick="proespecificopre2(this);"></span>
                              <label id='proespecificopre2_2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
                                <div class="panel-body">
                <h5 class="panel-title">
                 PROBLEMA ESPECÍFICOS 3
                </h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='proespecificopre3' id='proespecificopre3' onclick="proespecificopre3(this);"></span>
                              <label id='proespecificopre3_1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

            <div class="panel panel-white">
              <div class="panel-heading">
                <h6 class="panel-title">
                  <a data-toggle="collapse" data-parent="#accordion1" href="#accordion-group36">HIPÓTESIS ESPECÍFICAS</a>
                </h6>
              </div>
              <div id="accordion-group36" class="panel-collapse collapse">
                <div class="panel-body">
                      <h5 class="panel-title">HIPÓTESIS ESPECÍFICA 1</h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='hiespecificapre1' id='hiespecificapre1' onclick="hiespecificapre1(this);"></span>
                              <label id='hiespecificapre1_1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
                                <div class="panel-body">
                      <h5 class="panel-title">HIPÓTESIS ESPECÍFICA 2</h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='hiespecificapre2' id='hiespecificapre2' onclick="hiespecificapre2(this);"></span>
                              <label id='hiespecificapre2_1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                      <div class='col-md-6'>
                        <div class='form-group'>
                          <div class="radio">
                            <label>
                              <span class='radio'><input value='2' type='radio' name='hiespecificapre2' id='hiespecificapre2' onclick="hiespecificapre2(this);"></span>
                              <label id='hiespecificapre2_2'></label>
                            </label>
                          </div>
                        </div>  
                      </div>
                    </div>
                  </fieldset>
                </div>
                                <div class="panel-body">
                      <h5 class="panel-title">HIPÓTESIS ESPECÍFICA 3</h5>
                  <fieldset class='content-group'>
                    <div class='row'>
                      <div class='col-md-6'>
                        <div class='form-group '>

                          <div class="radio">
                            <label>
                              <span class='radio'><input value='1' type='radio' name='hiespecificapre3' id='hiespecificapre3' onclick="hiespecificapre3(this);"></span>
                              <label id='hiespecificapre3_1'></label>
                            </label>
                          </div>

                        </div>
                      </div>
                    </div>
                  </fieldset>
                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="row">
          <!-- /"educaiton" form for Stepy wizard --></div>

          <div class="modal-footer">
            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
            <button type="button" name="preexperimental" id="preexperimental" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>

  </div>

  <div id="modal_remote" class="modal">

    <div class="modal-dialog modal-full">

     <div class="modal-content">

      <div class="modal-header">

       <button type="button" class="close" data-dismiss="modal">&times;</button>

       <h5 class="modal-title">Horario del asesor : <label id="nombre_asesor"></label></h5>

     </div>



     <div class="modal-body">

       <div id="calendar1"></div>



     </div>



     <div class="modal-footer">

       <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

       <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="resetear()" >Save changes</button>

     </div>

   </div>

 </div>

</div>















<div id="modal_mini" class="modal fade">

  <div class="modal-dialog modal-xs">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">¿Desea Confirmar el pago?</h5>

      </div>



      <div class="modal-body">

        Responde "si" la transaccion sera guarda

      </div>



      <div class="modal-footer">

        <button type="button" class="btn btn-link" data-dismiss="modal">no</button>

        <button type="button" class="btn btn-primary" id="guardar_pago" data-dismiss="modal">Si</button>

      </div>

    </div>

  </div>

</div>





<div id="modal_mini1" class="modal fade">

  <div class="modal-dialog ">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">Monto inicial</h5>

      </div>

      <input type="hidden" name="id_pago_primero" id="id_pago_primero">

      <div class="modal-body">

        <div class="row">
         <label class="col-md-2">CAJA:</label>
         <div class="col-md-4">

           <select class="form-control" id="id_caja" name="id_caja">

             <?php 

             foreach ($caja as $key => $value) {

              echo "<option value='".$value->id_caja."'>".$value->caja_descripcion."</option>";

            }

            ?>

          </select>

        </div>


        <label class="col-md-3">Ingresar Monto</label>

        <div class="col-md-3"><input type="text" name="monto1" id="monto1" value="0" class="form-control"  /></div>
        <label class="col-md-2">Tipo comp.</label>
        <div class="col-md-4">
         <select class="form-control" id="id_tipo_comprobante" name="id_tipo_comprobante">
          <?php 

          foreach ($tipo_comprobante as $key => $value) {

            echo "<option value='".$value->id_tipo_comprobante."'>".$value->tipo_comprobante_descripcion."</option>";

          }

          ?>
        </select>
      </div>
      <label class="col-md-2"></label>
      <div class="col-md-4"><input type="text" name="codigo" id="codigo" value="0" class="form-control"  /></div>


    </div>



  </div>



  <div class="modal-footer">



    <button type="button" class="btn btn-primary" id="guardar_monto" >Guardar</button>

  </div>

</div>

</div>

</div>



<div id="agregarCaptacion" class="modal fade">

  <div class="modal-dialog modal-xs">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title"> Descripcion</h5>

      </div>

      <input type="hidden" name="id_pago_primero" id="id_pago_primero">

      <div class="modal-body">

        <div class="row">

         <label class="col-md-5">Ingresar Captacion</label>

         <div class="col-md-4"><input type="text" name="inputCaptacion" id="inputCaptacion" class="form-control"  /></div>

       </div>

     </div>



     <div class="modal-footer">



      <button type="button" class="btn btn-primary" id="guardar_captacion" data-dismiss="modal">Guardar</button>

    </div>

  </div>

</div>

</div>





<div id="modal_largecolor" class="modal fade">

  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h5 class="modal-title">Color</h5>

      </div>



      <div class="modal-body">

       <div class="row">

        <?php 



        foreach ($color as $key => $value) {

          $a="'".$value->color."'";

          echo '<div class="col-md-2">

          <div class="'.$value->clase.'" onclick="colors('.$a.')"><span>'.$value->color.'</span></div>

        </div>';

      }

      ?>



    </div>

  </div>



  <div class="modal-footer">

    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>

  </div>

</div>

</div>

</div>







<div id="aceptacion" class="modal fade in" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">×</button>

        <h5 class="modal-title">Desea usted, generar un nuevo pago</h5>

      </div>



      <div class="modal-footer">

        <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Cerrar</button>

        <button type="button" class="btn btn-primary legitRipple" onclick="irpaso()">Ir a pagos</button>

      </div>

    </div>

  </div>

</div>


<div id="requerimiento" class="modal fade" backdrop="static" keyboard="true">

            <div class="modal-dialog ">

              <div class="modal-content">

                <div class="modal-header">

                  <button type="button" class="close" data-dismiss="modal">&times;</button>

                  <h5 class="modal-title">ficha de requerimientos</h5>

                </div>



                <div class="modal-body">
                <div class="row">
                  <form id="enviar_requerimiento">
                    <input type="hidden" name="enfoque_requerimiento" id="enfoque_requerimiento">
                  <div id="reque" >
                    <div class="col-md-12">
                        <div class="form-group">
                          <label>Requerimiento 1</label>
                        <textarea id="requermientos1" name="requermientos[]" class="form-control" cols="2"></textarea>
                      </div>
                     </div>
                 </div>
                </form>
                 </div>
                 <div class="row">
                  <div class="col-md-10"></div>
                   <div class="col-md-2"><br><button class="btn btn-success" id="nuevo_requerimiento">+</button></div>
                 </div>
                </div>



                <div class="modal-footer">

                  <button type="button" class="btn btn-primary" id="guardar_requerimiento">Guardar y salir</button>

                 

                </div>

              </div>

            </div>

          </div>





<script type="text/javascript" src="<?php echo base_url()?>public/assets/js/pages/extra_fullcalendar_formats.js"></script>

<script type="text/javascript">

  function colors(data)

  {  

   $("#modal_largecolor").modal('hide');

   $("#color").val(data);

 }







 $("#btn-color").click(function(event) {

  $("#modal_largecolor").modal();

});

 $("#tipo_pago").change(function(event) {



   if($("#tipo_pago").val()!=1){

     $("#credito").show();
     $("#cronograma").hide();


   }

   else{

     $("#credito").hide();

     $("#cronograma").hide();

   }

 });



 $("#btn_guardar12").click(function(event) {



  var num=parseInt($("#monto").val());

  if(num>=0){

    if($("#tipo_pago").val()=="2" || $("#tipo_pago").val()=="3"){



      if($("#cronograma").text()!="")

      {

       $("#modal_mini").modal();

     }

     else{

      alerta2("Error","Por favor primero genere su cronograma");

    }

  }

  else{

   $("#modal_mini").modal();

 }



}

else{

  alerta2("Error","Por favor ingresa un numero mayor a 0");

}

});



 $("#guardar_pago").click(function(event) {

    //alert($("#id_enfoque").val()+$("#dni").val());

    $(this).attr("disabled",true);

    





    if($("#tipo_pago").val()==1){



      $.post(base_url+"Pagos/guardarContado",{"id_enfoque":$("#id_enfoque").val(),"monto":$("#monto").val(),

        "fecha":$("#fechaprestamo").val()},function(data){


          if(data=="1"){
            $.post(base_url+"Ficha_enfoque/crear_usuario",{"id_enfoque":$("#id_enfoque").val(),"dni":$("#dni").val()},function(data1){

       //  alert(data);

     });

            $("#modal_mini").modal("hide");

            $("#tab5").removeClass('active');

            $("#tab6").removeClass('disabledTab');

            $("#tab6").addClass('active'); 

            $("#bordered-justified-tab5").removeClass('active');

            $("#bordered-justified-tab6").addClass('active');

            var ruta=base_url+"pdf/contrato_contado.php?id_enfoque="+$("#id_enfoque").val();

            var iframe = document.getElementById("ficha_enfoque_pdf1");

            iframe.setAttribute("src", ruta);

          }else{

           $("#guardar_pago").attr("disabled",false);
           $("#modal_mini").modal("hide");
           alerta2("Error","TRANSACCION ERRONIA");


         }





       });

}

else{

  $.ajax({

    url:base_url+"Pagos/guardarCredito",

    data:'id_enfoque='+$("#id_enfoque").val()+'&'+$("#formularioPago").serialize(),

    type:'post',

    success: function(data) {
      if(data!=0){

       $.post(base_url+"Ficha_enfoque/crear_usuario",{"id_enfoque":$("#id_enfoque").val(),"dni":$("#dni").val()},function(data1){


       });


       $("#modal_mini").modal("hide");

       $("#modal_mini1").modal();

       $("#id_pago_primero").val(data);

       $("#monto1").focus();
     }
     else{
      alerta2("ERROR","SE GENERO UN ERROR AL MOMENTO DE GENERAR EL CRONOGRAMA");
      $("#modal_mini").modal("hide");
      $("#guardar_pago").attr("disabled",false);

    }

  }

});  

}

});


$("#guardar_monto").click(function(event) {

  $(this).attr("disabled",true);

  var montoinicial=parseInt($("#monto1").val());

  var monto=parseInt($("#monto").val());

  if(montoinicial>=0){

   if(montoinicial<=monto){ 

    $.post(base_url+"Pagos/realizar_amortizacion",{

      "idprestamo":$("#id_pago_primero").val(),"monto":$("#monto1").val(),"id_enfoque":$("#id_enfoque").val(),

      "id_forma_pago":"1","codigo":$("#codigo").val(),"id_caja":$("#id_caja").val(),"id_tipo_comprobante":$("#id_tipo_comprobante").val(),
      "cliente":""

    },function(data){
      if(data!=0){

        $("#tab5").removeClass('active');

        $("#tab6").removeClass('disabledTab');

        $("#tab6").addClass('active'); 

        $("#bordered-justified-tab5").removeClass('active');

        $("#bordered-justified-tab6").addClass('active');

        $('#modal_mini1').modal('hide');


        if($("#tipo_pago").val()=="2"){
          var ruta=base_url+"pdf/contrato_credito.php?id_enfoque="+$("#id_enfoque").val();
        }
        else{
         var ruta=base_url+"pdf/contrato_contra.php?id_enfoque="+$("#id_enfoque").val();
       }


       var iframe = document.getElementById("ficha_enfoque_pdf1");

       iframe.setAttribute("src", ruta);
     }
     else{
       $('#modal_mini1').modal('hide');
       $("#guardar_monto").attr("disabled",false);
       alerta2("ERROR","SE GENERO UN ERROR EN LA TRANSSACCION");

     }

   });

}

else{

  alerta2("Error","Por favor el numero tiene q ser menor o igual al monto");

}

}

else{

  alerta2("Error","Por favor el numero tiene q ser mayor que 0");

}



});




$( function() {



 $(".styled, .multiselect-container input").uniform({

  radioClass: 'choice'

});

 document.getElementById("dni").focus();

 $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

   $('#calendar').fullCalendar('render');

 });



 $('#myTab a:first').tab('show');

 $(".styled, .multiselect-container input").uniform({

  radioClass: 'choice'

});



 $( document ).tooltip({

  track: true

});

 availableTags = <?php echo json_encode($universidad1);?>;

 $('.select').select2({

  minimumResultsForSearch: Infinity

});

 availableTags1 = <?php echo json_encode($carrera1);?>;

   /* $( "#universidad" ).autocomplete({

      source: availableTags

    });*/

$( "#carrera" ).autocomplete({

  source: availableTags1

});

$('.select-search').select2();



$("#credito").hide();

} );



$("#id_trabajador").click(function(event) {



  if($("#color").val()!=""){

   if($('input:radio[id=id_categoria]:checked').prop('checked'))

   {

    if($('input:radio[id=id_grado]:checked').prop('checked'))

    {

     if( $('#id_especialidad').val()!="")

     {

        //  alert($("#hora").val());

        if($("#hora").val()!="0:00"){



        }else{

          alert("por favor seleccione el tiempo que necesitas");

          $("#hora").focus();

        }

      }

      else{

        alert("por favor seleccione la especialidad de la tesis");

      }

    }

    else

    {

      alert("por favor seleccione el grado academico");

    }

  }

  else{

    alert("por favor seleccione la categoria");

  }

}else{

  alert("registra el color");

  $("#modal_largecolor").modal();



}





});



$("#dni").keyup(function(event) {

  $("#dni1").val($("#dni").val());

  var r=$("#dni").val();

  if(r.length==8)

  {



   $.post(base_url+"Ficha_enfoque/traer_un_cliente",{"dni":r},function(data){

        //alert(data);

        $("#nombres").val(data.nombres);

        $("#apellidos").val(data.apellidos);

        $("#correo").val(data.correo);

        $("#telefono").val(data.telefono);

        $("#universidad").val(data.descripcion);

        $("#universidad option[value="+ data.descripcion+"]").attr("selected",true);

        $("#carrera").val(data.carrera);

        $("#direccion").val(data.direccion);

        $.post(base_url+"Ficha_enfoque/distrito_lista",{"id_distrito":data.id_distrito},function(data)

        {

          $('#distrito').empty();

          $('#distrito').append(data);

          $("#distrito option[value="+ data.id_distrito+"]").attr("selected",true);

        });

        $("#id_tipocliente option[value="+ data.id_tipocliente +"]").attr("selected",true);

      },"json");

 }

});



$("#id_trabajador").change(function(event) {

 var id=$("#id_trabajador").val(); 

     //alert(id);

     var res = id.split("/");

     if (res[1]==0) 

     {

      var id=res[0]; 

      var opcion_seleccionada = $("#id_trabajador option[value="+id+"]").text();

      if(id!="-1")

      {

        $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");

        $("#modal_remote").modal();

        $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)

        {

         $('#calendar1').fullCalendar( 'destroy' );

         $('#calendar1').fullCalendar({

           height: 500,

           width: 100,

           slotDuration: '00:10:00',

           header: {

            left: 'prev,next today',

            center: 'title',

            right: 'agendaWeek,listWeek,agendaDay'

          },

          defaultView: 'agendaWeek',

          defaultDate: new Date(),

          navLinks: true,

          editable: false,

          eventResourceEditable: false,

          eventStartEditable: true,

          eventLimit: true,

          scrollTime:  moment().format('H:m'),

          events:data,

          eventDrop: function(event,delta,revertFunct){

            var id=event.id;

            var fi=event.start.format();

            var ff=event.end.format();

            if(!confirm("¿estas seguro ?")){

              revertFunct();

            }

            else{

             $.post(base_url+"Horario/editar_horario",{

              "id":id,

              "fi":fi,

              "ff":ff



            },



            function(data){

             if(data=="0"){

              alert("no se puede poner en esa fecha el tiempo porque ya paso");

              revertFunct();

            }

          });

           }

         }



          // allow "more" link when too many events

        });

},"json");

}

 //alert($("#formulario_enfoque").serialize());

 

}

else

{

  $.post(base_url+"Ficha_enfoque/guardar_ficha_admin",$("#formulario_enfoque").serialize(),function(data){

    // alert(data);

    alerta("Se asigno correctamente","espere que el asesor termine de llenar la ficha");

    reload_url('Ficha_enfoque','Tesis');

  });

}



     /*var opcion_seleccionada = $("#id_trabajador option[value="+id+"]").text();

     if(id!="-1")

      {

      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");

      $("#modal_remote").modal();

      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)

       {

       $('#calendar1').fullCalendar( 'destroy' );

       $('#calendar1').fullCalendar({

           height: 500,

           width: 100,

            slotDuration: '00:10:00',

           header: {

        left: 'prev,next today',

        center: 'title',

        right: 'agendaWeek,listWeek,agendaDay'

         },

        defaultView: 'agendaWeek',

            defaultDate: new Date(),

            navLinks: true,

       editable: false,

       eventResourceEditable: false,

             eventStartEditable: true,

       eventLimit: true,

       scrollTime:  moment().format('H:m'),

             events:data,

             eventDrop: function(event,delta,revertFunct){

                var id=event.id;

                var fi=event.start.format();

                var ff=event.end.format();

                 if(!confirm("¿estas seguro ?")){

                      revertFunct();

                 }

                 else{

                     $.post(base_url+"Horario/editar_horario",{

                      "id":id,

                      "fi":fi,

                      "ff":ff



                     },



                      function(data){

                         alert(data);

                      });

                 }

             }



          // allow "more" link when too many events

      });

        },"json");

         }

 //alert($("#formulario_enfoque").serialize());

  $.post(base_url+"Ficha_enfoque/guardar_ficha_admin",$("#formulario_enfoque").serialize(),function(data){

     //alert(data);



   });*/

});







$("#departamento").change(function(event) {

 $.post(base_url+"Ficha_enfoque/provincia",{"id": $("#departamento").val()},function(data){

   $('#provincia').empty();

   $('#provincia').append(data);

 });

});



$("#provincia").change(function(event) {

  $.post(base_url+"Ficha_enfoque/distrito",{"id": $("#provincia").val()},function(data){

    $('#distrito').empty();

    $('#distrito').append(data);

  });

});



$("#guardar_clientes").click(function(){



  if($("#dni").val()==""){

    $("#dni").focus(); return 0;

  }

  if($("#nombres").val()==""){

    $("#nombres").focus(); return 0;

  }

  if($("#apellidos").val()==""){

    $("#apellidos").focus(); return 0;

  }
  if($("#telefono").val()==""){
    $("#telefono").focus(); return 0;
  }
  if($("#correo").val()==""){
    $("#correo").focus(); return 0;
  }


  $("#tab1").removeClass('active');

  $("#tab2").removeClass('disabledTab');

  $("#tab2").addClass('active'); 

  $("#bordered-justified-tab1").removeClass('active');

  $("#bordered-justified-tab2").addClass('active');

  $.post(base_url+"Ficha_enfoque/registrarcliente",$("#formulario1").serialize(),function(data){

      //alert(data);



    });

});





$("#tab4").click(function(event) 

{

  $('#calendar').fullCalendar({ 

    header: 

    {

      left: 'prev,next today',

      center: 'title',

      right: 'agendaWeek,agendaDay,listWeek'

    },

    slotDuration: '00:05:00',

    views:{

      month:{

        titleFormat: '[MCH In-Sevices for ]'+'MMMM YYYY'

      },

      listWeek:{buttonText: 'List Week'},



    },

    defaultView: 'agendaWeek',

    defaultDate: new Date(),

    editable: true,

    eventLimit: true, // allow "more" link when too many events

  });    

});







function vercronograma()

{

  if($("#fechaprestamo").val()=="")

  {

    $("#fechaprestamo").focus(); return 0;

  }

  if($("#monto").val()=="")

  {

    $("#monto").focus(); return 0;

  }

  if($("#semanas").val()=="")

  {

    $("#semanas").focus(); return 0;

  }



  $("#cronograma").empty().html('<center> <h1><i class="fa fa-spin fa-spinner"></i></h1> </center>');

  $.post(base_url+"Ficha_enfoque/cronograma_prestamo",$("#formularioPago").serialize(),function(data)

  {
    $("#cronograma").show();
    $('#cronograma').empty().html(data);

  });

}



function sincronograma()

{

  $("#cronograma").empty();

}













$("#btn_form2").click(function(event) {



  if($("#titulo_enfoque").val()==""){

    $("#titulo_enfoque").focus(); return 0;

  }

  if($("#porque").val()==""){

    $("#porque").focus(); return 0;

  }

  if($("#paraque").val()==""){

    $("#paraque").focus(); return 0;

  }

  if($("#como").val()==""){

    $("#como").focus(); return 0;

  }

  if($("#donde").val()==""){

    $("#donde").focus(); return 0;

  }

  if($("#variables").val()==""){

    $("#variables").focus(); return 0;

  }

  <?php if($estadoficha!=0){?>

   $.post(base_url+'Ficha_enfoque/ingresar', $("#formulario_enfoque").serialize(), function(data, textStatus, xhr) {

    //alert(data);

    var ruta=base_url+"pdf/crear.php?id="+$("#id_enfoque").val();

    var iframe = document.getElementById("ficha_enfoque_pdf");

    iframe.setAttribute("src", ruta);

    $("#modal_large").modal();

   /*  $.post(base_url+'Ficha_enfoque/categoria_subfases', {id_categoria: $("#id_categoria").val(),id_tipo_enfoque:$("#id_tipo_enfoque").val()},

     function(data, textStatus, xhr)

      {

        $('#cuerpo_tabla').empty();

         $('#cuerpo_tabla').append(data);

       });*/

 });

   <?php }else{?>

     var ruta=base_url+"pdf/crear.php?id="+$("#id_enfoque").val();

     var iframe = document.getElementById("ficha_enfoque_pdf");

     iframe.setAttribute("src", ruta);

     $("#modal_large").modal();

     <?php }?> 











   });

</script>



<script type="text/javascript">

  $(function()

  {

    dragula([document.getElementById('panels-target-left'), document.getElementById('panels-target-right')]);

    dragula([document.getElementById('forms-target-left'), document.getElementById('forms-target-right')]);

    dragula([document.getElementById('media-list-target-left'), document.getElementById('media-list-target-right')], {

      mirrorContainer: document.querySelector('.media-list-container'),

      moves: function (el, container, handle) {

        return handle.classList.contains('dragula-handle');

      }

    });

    var containers = $('.dropdown-menu-sortable').toArray();

    dragula(containers, {

      mirrorContainer: document.querySelector('.dropdown-menu-sortable')

    });

  });



  $("#modal-fase3").click(function(event) {

    //alert("hola");

    document.body.scrollTop = 0;

         /*$("#tab3").removeClass('disabledTab');

         $("#tab3").addClass('active');

         $("#tab2").removeClass('active');

         $("#bordered-justified-tab2").removeClass('active');

          //$(".modal-backdrop fade in").removeClass('modal-backdrop fade in');

          $("#bordered-justified-tab3").addClass('active');*/
          $("#enfoque_requerimiento").val($("#id_enfoque").val());

          $.post(base_url+'Ficha_enfoque/estado3',{id_enfoque:$("#id_enfoque").val()}, function(data, textStatus, xhr) {



            alerta("Se Realizo con exito","La insercion de datos","sas");



          });

         //setTimeout(function(){  reload_url('Ficha_enfoque','Tesis'); }, 500);
         setTimeout(function(){ 
        //reload_url('Ficha_enfoque','Tesis'); 
        $("#requerimiento").modal({    backdrop: 'static',

    keyboard: false});

      }, 500);

        });



  $("#btn_form3").click(function(event) {



    $("#btn_form3").attr("disabled","true");

    $.ajax({

      url:base_url+"Ficha_enfoque/asesores_subfase",

      data:"id_enfoque="+$("#id_enfoque").val()+"&"+$("#formulario2").serialize(),

      type:"post",

      dataType: "json",

      success: function(data) {

       $("#id_produccion").val(data.id_produccion);

       $("#cuerpo-tab3").empty();

       $("#cuerpo-tab3").append(data.asesores);

       $("#boton3").empty();

       $("#boton3").append(data.boton);

     }});

  });



  function horario(id)

  {

   $.post(base_url+'Ficha_enfoque/horario', {id: id}, function(data, textStatus, xhr) {});

 }



 function boton()

 {

  $.ajax({

    url:base_url+"Ficha_enfoque/asignacion",

    data:"id_produccion="+$("#id_produccion").val()+"&"+$("#formulario2").serialize(),

    type:"post",

    dataType: "json", 

    success: function(data) {



    }});

}



function horario1(id){

 $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)

 {

   $('#calendar').fullCalendar( 'destroy' );

   $('#calendar').fullCalendar({

     height: 500,

     width: 100,

     slotDuration: '00:10:00',

     header: {

      left: 'prev,next today',

      center: 'title',

      right: 'agendaWeek,listWeek,agendaDay'

    },

    defaultView: 'agendaWeek',

    defaultDate: new Date(),

    navLinks: true,

    editable: false,

    eventResourceEditable: false,

    eventStartEditable: true,

    eventLimit: true,

    scrollTime:  moment().format('H:m'),

    events:data,

    eventDrop: function(event,delta,revertFunct){

      var id=event.id;

      var fi=event.start.format();

      var ff=event.end.format();

      if(!confirm("¿estas seguro ?")){

        revertFunct();

      }

      else{

       $.post(base_url+"Horario/editar_horario",{

        "id":id,

        "fi":fi,

        "ff":ff



      },



      function(data){

        if(data=="0"){

          alert("no se puede poner en esa fecha el tiempo porque ya paso");

          revertFunct();

        }

      });

     }

   }



          // allow "more" link when too many events

        });

},"json");

}           











/*function horario_nuevo(dni,estado)

{

   if (estado==0) 

   {

      var id=dni; 

     var opcion_seleccionada = $("#id_trabajador option[value="+id+"]").text();

     if(id!="-1")

      {

      $("#nombre_asesor").html("<b>"+opcion_seleccionada+"</b>");

      $("#modal_remote").modal();

      $.post(base_url+"Ficha_enfoque/horario",{"id_trabajador":id},function(data)

       {

       $('#calendar1').fullCalendar( 'destroy' );

       $('#calendar1').fullCalendar({

           height: 500,

           width: 100,

            slotDuration: '00:10:00',

           header: {

        left: 'prev,next today',

        center: 'title',

        right: 'agendaWeek,listWeek,agendaDay'

         },

        defaultView: 'agendaWeek',

            defaultDate: new Date(),

            navLinks: true,

       editable: false,

       eventResourceEditable: false,

             eventStartEditable: true,

       eventLimit: true,

       scrollTime:  moment().format('H:m'),

             events:data,

             eventDrop: function(event,delta,revertFunct){

                var id=event.id;

                var fi=event.start.format();

                var ff=event.end.format();

                 if(!confirm("¿estas seguro ?")){

                      revertFunct();

                 }

                 else{

                     $.post(base_url+"Horario/editar_horario",{

                      "id":id,

                      "fi":fi,

                      "ff":ff



                     },



                      function(data){

                         alert(data);

                      });

                 }

             }



          // allow "more" link when too many events

      });

        },"json");

         }

 //alert($("#formulario_enfoque").serialize());

 

   }

   else

   {

        $.post(base_url+"Ficha_enfoque/guardar_ficha_admin",$("#formulario_enfoque").serialize(),function(data){

     //alert(data);

         });

   }

 }  */   

</script>



<script type="text/javascript">
  var valor;
  $(function(){
    $("#id_tipo_enfoque").change(function(event) {

     $.post(base_url+"Ficha_enfoque/Tipodise",{"id": $("#id_tipo_enfoque").val()},function(data){


      $('#diseño').empty();

      $('#diseño').append(data);

    });

   });

//$("#diseño").change(function(event) {
//  if($("#diseño").val() != ""){
//    $.post(base_url+"Ficha_enfoque/enfoqueproblema",{"id": $("#diseño").val()},function(data){
//    $("#modal_remote1").modal();
//
//   $('#formato').empty();
//
//   $('#formato').append(data);
//    });
//  }else{
//
//  }
//});
$("#diseño").change(function(event) {
  if($("#diseño").val() != ""){
    if($("#diseño").val() == 1 || $("#diseño").val() ==3 ){
      $("#modal_remote1").modal();
      if($("#diseño").val() == 1){
        document.getElementById('palabrasutilizar').style.display = 'block';

      }else{
        document.getElementById('palabrasutilizar').style.display = 'none';

      }
      $.post(base_url+"Ficha_enfoque/concatenar",function(data){
       $('#enunciados').empty();
       $('#enunciados').append(data);
       if($("#diseño").val() == 1){
        $("#titulodiseo").text("Descriptivo Correlacional - Causal");
        document.getElementById('ocultar').style.display = 'block';
        document.getElementById('hipotesisocultar').style.display = 'none';
        document.getElementById('problemasocultar').style.display = 'none';
        document.getElementById('objetivoocultar').style.display = 'none';
      }else{    
        $("#titulodiseo").text("Descriptivo Correlacional");      
        document.getElementById('ocultar').style.display = 'none';
        document.getElementById('hipotesisocultar').style.display = 'block';
        document.getElementById('problemasocultar').style.display = 'block';
        document.getElementById('objetivoocultar').style.display = 'block';
      }

    });
    }else{
      if($("#diseño").val() == 2){
        $("#modal_remote2").modal();
      }else{
        if($("#diseño").val() == 8){
          $("#modal_remote3").modal();
        }

      }
    }

  }else{

  }
});

$("#variableind").change(function(event) {
  var iddi = $("#diseño").val();  
  if($("#variableind").val() != ""){
    if(iddi == 1){
      if($("#lugar").val() != "" && $("#palabra1 :selected").val() != ""  && $("#gradonivel").val() != "" ){
        concatenar();
      }
    }else{

      concatenar3();

    }
  }else{

  }    
});

$("#variabledepe").change(function(event) {
  var iddi = $("#diseño").val(); 
  if($("#variabledepe").val() != ""){
    if(iddi == 1){
      if($("#lugar").val() != "" && $("#palabra1 :selected").val() != ""  && $("#gradonivel").val() != "" ){
        concatenar();
      }
    }else{

      concatenar3();

    }
  }else{

  }    
});

$("#palabra1").change(function(event) {
  var iddi = $("#diseño").val();  
  if($("#palabra1").val() != ""){
    $("#lugar").removeAttr("disabled");
    document.getElementById("palabra2").value = $("#palabra1 :selected").val();
    if($("#lugar").val() != "" && $("#palabra1 :selected").val() != ""  && $("#gradonivel").val() != "" ){
      if(iddi == 1){
        concatenar();
      }else{
        concatenar3();
      }
    }
  }else{

  }    
});

$("#verbo").change(function(event){
  var iddi = $("#diseño").val();  
  if($("verbo :selected").val() !=""){
    if(iddi == 1){
      if($("#lugar").val() != "" && $("#palabra1 :selected").val() != ""  && $("#gradonivel").val() != "" ){
        concatenar();
      }
    }else{

      concatenar3();

    }
  }
});




$("#lugar").change(function(event) {
  var iddi = $("#diseño").val();  
  if($("#lugar").val() != ""){
    $("#gradonivel").removeAttr("disabled");
    if(iddi == 1){
      if($("#lugar").val() != "" && $("#palabra1 :selected").val() != ""  && $("#gradonivel").val() != "" ){
        concatenar();
      }
    }else{

      concatenar3();

    }
  }else{

  }    
});
$("#gradonivel").change(function(event) {
  var iddi = $("#diseño").val();  
  if(iddi == 1){
    if($("#lugar").val() != "" && $("#palabra1 :selected").val() != ""  && $("#gradonivel").val() != "" ){
      concatenar();
    }
  }else{

    concatenar3();

  }   
});


function concatenar(){
  var lugar = $("#lugar").val();
  var palabra1 = $("#palabra1 :selected").text();
  var palabra2 = $("#palabra2 :selected").text();
  var gradonivel = $("#gradonivel").val();
  var variablei = $("#variableind").val();
  var variabled = $("#variabledepe").val();
  $('#problemas1').text('¿Cómo ' + variablei +' ' +palabra1+ ' en ' + variabled + ' de ' + lugar+'?.');
  $('#problemas2').text( '¿De que manera ' + variablei +" " + palabra1 +" en " + variabled + " de " + lugar +".");
  $('#problemas3').text('¿Cuáles son los factores del ' + variablei.substring(3) +' que tienen mayor ' +palabra2+' en '+ variabled + ' de ' + lugar+'?.');
  $('#problemas4').text('¿Cuál es el factor del ' + variablei.substring(3) +' que tienen mayor ' +palabra2+' en '+ variabled + ' de ' + lugar+'?.');

  $('#objetivos1').text( $("#verbo :selected").text() + " la forma en que "+ variablei +" " + palabra1 +" en " + variabled + " de " + lugar +".");
  $('#objetivos2').text( $("#verbo :selected").text() + " "+ gradonivel  + " de " + palabra2 +" del " + variablei.substring(3) +" en " + variabled + " de " + lugar +".");
  $('#objetivos3').text( $("#verbo :selected").text() + "  los factores del "+ variablei.substring(3) +" que tienen mayor " + palabra2 +" en " + variabled + " de " + lugar +".");
  $('#objetivos4').text( $("#verbo :selected").text() + " el factor del "+ variablei.substring(3) +" que mayor " + palabra2 +"  tiene en " + variabled + " de " + lugar +".");


  $('#titulo1').text( palabra2+ " del "+ variablei.substring(3) +" en " + variabled +"  de " + lugar +".");
  $('#titulo2').text(variablei.substring(3)  + " y su "+ palabra2 +" en " + variabled +"  de " + lugar +".");
  $('#titulo3').text( "Análisis del " + variablei.substring(3) +" y su " + palabra2 +"  en " + variabled + " de " + lugar +".");
  $('#titulo4').text("Identificación del factor determinante del " +  variablei.substring(3) +" con " +  variabled + " de " + lugar +".");
  $('#titulo5').text( "Factores determinantes del "   + variablei.substring(3) + " en " + variabled + " de " + lugar +".");
  $('#titulo6').text( "Factores del "  + variablei.substring(3) +" que influyen en " +  variabled + " de " + lugar +".");



  $('#hipotesis1').val("Hi "+ variablei+ " " + palabra1+" de manera significativa en "+ variabled  +" de "+ lugar +"."); 

   //         $('#problemas').text( $("#verbo :selected").text() + " la forma en que "+ variablei +" " + palabra1 +" en " + variabled + " de " + lugar +".");
   //   $('#problemas').text('Hi ' + variablei +' ' +palabra1+' de manera significativa en '+ variabled + ' de ' + lugar);
   //   $('#problemas').text('Hi' + variablei +' ' +palabra1+' en '+ variabled + ' de ' + lugar);


 }



 function concatenar3(){
  var lugar = $("#lugar").val();  
  var gradonivel = $("#gradonivel").val();
  var variablei = $("#variableind").val();
  var variabled = $("#variabledepe").val();
  var verbo = $("#verbo :selected").text();
  var conproblema = $("#variableind").val();
  var art = conproblema.substring(0,2);
  if(art == 'el'){
    var articonec = 'del ' +conproblema.substring(3);
  }else{
    var articonec = 'de ' +conproblema;
  }
  $('#problemas1').text('¿Cómo es la relación entre ' + variablei +' y ' + variabled + ' en ' + lugar+'?.');
  $('#problemas2').text( '¿Cuál es ' + gradonivel +" de relación entre " + variablei + " y " + variabled + " en " + lugar +".");
  $('#problemas3').text('¿Cuáles son los factores ' + articonec +' que tienen mayor relación con ' + variabled + ' de ' + lugar+'?.');
  $('#problemas4').text('¿Cuál es el factor ' + articonec +'  que mayor relación tiene con ' + variabled + ' de ' + lugar+'?.');
  $('#problemas5').text( "¿De qué manera "+ variablei + " se relaciona con " + variabled + " de los colaboradores en " + lugar +".");


  $('#objetivos1').text( verbo + " cómo se relaciona "+  variablei +" y " + variabled + " en " + lugar +".");
  $('#objetivos2').text( verbo + " "+ gradonivel  + " relación entre " +  variablei +" y " + variabled + " en " + lugar +".");
  $('#objetivos3').text( verbo + "  los factores "+ articonec +" que tienen mayor relación con " + variabled + " en " + lugar +".");
  $('#objetivos4').text( verbo + " el factor "+ articonec +" que mayor relación tiene con " + variabled + " en " + lugar +".");
  $('#objetivos5').text( "Deteminar la relación " + articonec + " en " + variabled + " de " + lugar +".");
  $('#objetivos6').text( "Deteminar la relación entre " + variablei + " y " + variabled + " en " + lugar +".");


  $('#titulo1').text( "Análisis correlacional entre "+ variablei +" y " + variabled +"  en " + lugar +".");
  $('#titulo2').text(variablei.substring(3)  + " y su relación con "+ variabled +"  en " + lugar +".");
  $('#titulo5').text( "Factores determinantes "   + articonec + " en " + variabled + " en " + lugar +".");
  $('#titulo6').text( "Identificación del factor determinante "  + articonec +" en " +  variabled + " en " + lugar +".");

  $('#hipotesis1').val("Hi "+ variablei+ " se relaciona de manera positiva con " + variabled+" en "+ lugar +"."); 
  $('#hipotesis5').val("Hi " +"Existe una relacion significativa entre " + variablei+" y "+ variabled + ' en ' +lugar +"."); 
  $('#hipotesis6').val("Hi "+ variablei+ " se relaciona significativamente con " + variabled+" en "+ lugar +"."); 
}


$("#metapre").change(function(event) {
  if($("#metapre").val() != ""){  
    document.getElementById("presentepre").value = $("#metapre :selected").val();  
    concatenar4();
  }else{
  }   
});
$("#palabrapre").change(function(event) {
  if($("#palabrapre").val() != ""){    
    concatenar4();
  }else{
  } 
});

$("#presentepre").change(function(event) {
  if($("#presentepre").val() != ""){    
    concatenar4();
  }else{
  }   
});

$("#lugarpre").change(function(event) {
  if($("#lugarpre").val() != ""){    
    concatenar4();
  }else{
  }   
});
$("#generalpre").change(function(event) {
  if($("#generalpre").val() != ""){    
    concatenar4();
  }else{
  }   
});
$("#especificospre").change(function(event) {
  if($("#especificospre").val() != ""){    
    concatenar4();
  }else{
  }   
});
$("#independientepre").change(function(event) {
  if($("#independientepre").val() != ""){    
    concatenar4();
  }else{
  }   
});
$("#dependientepre").change(function(event) {
  if($("#dependientepre").val() != ""){    
    concatenar4();
  }else{
  }   
});
function concatenar4(){
  var articulo = ($('#independientepre').val());
  var variablex = $("#independientepre").val();
  var variabley = $("#dependientepre").val();
  
  var art = variablex.substring(0,2);

  if(art == 'el'){
    var articonec = 'del ' +variablex.substring(3);
    var articonec1 = 'del ' +variabley.substring(3);
  }else{
    var articonec = 'de ' +variablex;
    var articonec1 = 'de ' +variabley;
  }
  var pala = ($("#palabrapre :selected").text()).toUpperCase();
  var premeta = $("#metapre :selected").text();
  var prepresente = $("#presentepre :selected").text();
  var prelugar = $("#lugarpre").val();
  var variabley = $("#dependientepre").val();
  var prepalabra = $("#palabrapre :selected").text();
  var preverbog = $("#generalpre :selected").text();
  var preverboe = $("#especificospre :selected").text();

  if(pala == "EFECTO"){
    document.getElementById('progeneralpre1id').style.display = 'block';
    document.getElementById('titulopre1id').style.display = 'block'; 
    document.getElementById('hgeneralpre1id').style.display = 'block';
    document.getElementById('hgeneralpre2id').style.display = 'block';
  $('#titulopre1').text( prepalabra+' ' + articonec+  " en "+ variabley  + " de "  + prelugar +".");
  $('#titulopre2').text( variablex.substring(3) + " y "+ variabley.substring(3)  + " de "   + prelugar +".");

  $('#progeneralpre1').text('¿Qué ' + prepalabra +' tendrá ' +variablex +' en ' +variabley+ ' de ' + prelugar+'?.');
  $('#progeneralpre2').text( '¿Tendrá '+ variablex +" algun " + prepalabra +" en " + variabley + " de " + prelugar +".");
  $('#progeneralpre3').text('¿Será ' + variablex +' un afectante positivo en ' + variabley + ' de ' + prelugar+'.');
  $('#progeneralpre4').text('¿Qué diferencia existe en ' + variabley +' antes y después de la implementación ' +articonec+  ' de ' + prelugar+'.');

  $('#hgeneralpre1').text('Hi ' + variablex +' tiene un '+ prepalabra +' significativo en la '+ prepresente + ' ' +articonec1+  ' en ' + prelugar+'.');
  $('#hgeneralpre2').text('Hi ' + variablex +' tiene un ' + prepalabra +' positivo en la ' + prepresente + ' ' +articonec1 +  ' en ' + prelugar+'.');
  $('#hgeneralpre3').text('Hi ' + variablex +' es un afectante positivo en ' +variabley+  ' en ' + prelugar+'.');
  $('#hgeneralpre4').text('Hi Depués de la implementación ' + articonec +' ' +prelugar+  ' muestran una diferencia significativa  en ' + variabley+'.');
  $('#hgeneralpre5').text('Hi Depués de la implementación ' + articonec +' ' +prelugar+  ' tienen un incremento significativo en  ' + variabley+'.');

  $('#obgeneralpre1').text(preverbog + ' el efecto ' + articonec+  ' en ' + variabley+' en '+prelugar+'.');  
  }
  if(pala == "IMPACTO"){
    document.getElementById('progeneralpre1id').style.display = 'block'; 
    document.getElementById('titulopre1id').style.display = 'block'; 
    document.getElementById('hgeneralpre1id').style.display = 'block';
    document.getElementById('hgeneralpre2id').style.display = 'block';
  $('#titulopre1').text( prepalabra+' ' + articonec+  " en "+ variabley  + " en "  + prelugar +".");
  $('#titulopre2').text( variablex.substring(3) + " y "+ variabley.substring(3)  + " en "   + prelugar +".");

  $('#progeneralpre1').text('¿Qué ' + prepalabra +' tendrá ' +variablex +' en ' +variabley+ ' en ' + prelugar+'?.');
  $('#progeneralpre2').text( '¿Tendrá '+ variablex +" algun " + prepalabra +" en " + variabley + " en " + prelugar +".");
  $('#progeneralpre3').text('¿Será ' + variablex +' un afectante positivo en ' + variabley + ' en ' + prelugar+'.');
  $('#progeneralpre4').text('¿Qué diferencia existe en ' + variabley +' antes y después de la implementación ' +articonec+  ' en ' + prelugar+'.');

  $('#hgeneralpre1').text('Hi ' + variablex +' tiene un '+ prepalabra +' significativo en la '+ prepresente + ' ' +articonec1+  ' en ' + prelugar+'.');
  $('#hgeneralpre2').text('Hi ' + variablex +' tiene un ' + prepalabra +' positivo en la ' + prepresente + ' ' +articonec1 +  ' en ' + prelugar+'.');
  $('#hgeneralpre3').text('Hi ' + variablex +' es un afectante positivo en la ' +prepresente + ' '+articonec1 + ' en ' + prelugar+'.');
  $('#hgeneralpre4').text('Hi Depués de la implementación ' + articonec +' ' +prelugar+  ' muestran una diferencia significativa  en ' + variabley+'.');
  $('#hgeneralpre5').text('Hi Depués de la implementación ' + articonec +' ' +prelugar+  ' tienen un incremento significativo en  ' + variabley+'.');

  $('#obgeneralpre1').text(preverbog + ' el efecto ' + articonec+  ' en ' + variabley+' en '+prelugar+'.');

  }
  if(pala == "EFICIENCIA" || pala == "EFICACIA"){
    document.getElementById('progeneralpre1id').style.display = 'none';
    document.getElementById('titulopre1id').style.display = 'none'; 
    document.getElementById('hgeneralpre1id').style.display = 'none';
    document.getElementById('hgeneralpre2id').style.display = 'none';
  $('#titulopre2').text( variablex.substring(3) + " y "+ variabley.substring(3)  + " en "   + prelugar +".");

  $('#progeneralpre2').text( '¿Tendrá '+ variablex +" algun " + prepalabra +" en " + variabley + " en " + prelugar +".");
  $('#progeneralpre3').text('¿Será ' + variablex +' un afectante positivo en ' + variabley + ' en ' + prelugar+'.');
  $('#progeneralpre4').text('¿Qué diferencia existe en ' + variabley +' antes y después de la implantación ' +articonec+  ' en ' + prelugar+'.');

  $('#hgeneralpre3').text('Hi ' + variablex +' es un afectante positivo en la ' +prepresente + ' '+articonec1 + ' en ' + prelugar+'.');
  $('#hgeneralpre4').text('Hi Depués de la implementación ' + articonec +' ' +prelugar+  ' muestran una diferencia significativa  en ' + variabley+'.');
  $('#hgeneralpre5').text('Hi Depués de la implementación ' + articonec +' ' +prelugar+  ' tienen un incremento significativo en  ' + variabley+'.');

  $('#obgeneralpre1').text(preverbog + ' el efecto ' + articonec+  ' en ' + variabley+' en '+prelugar+'.');

  }
  $('#obespecificopre1').text(preverboe + ' antes de la implementación ' + articonec +', ' + variabley + ' en ' + prelugar+'.');
  $('#obespecificopre2').text(preverboe + ', ' + variabley +' en ' + prelugar +'  antes de la implementación ' +  articonec+'.');
  $('#obespecificopre3').text(preverboe + ', ' +variabley+  ' antes de la implementación de ' + variablex+' en '+ prelugar +'.');

  $('#objespecificopre1').text('Describir la Implementación ' + articonec +  ' para mejorar ' + variabley+ ' en ' + prelugar+'.');
  $('#objespecificopre2').text('Describir los procesos en la implementación ' + articonec +' ' +  ' para mejorar ' + variabley+' en ' +prelugar+'.');

  $('#objtespecificopre1').text(preverboe + ' después de la implementación ' + articonec +', ' + variabley+' en ' + prelugar+ '.');
  $('#objtespecificopre2').text(preverboe + ', ' + variabley +' en ' +prelugar+  ' después de la implementación ' + articonec+'.');
  $('#objtespecificopre3').text(preverboe + ', ' + variabley +' después de la implementación de ' +articonec+  ' en ' + prelugar+'.');

  $('#proespecificopre_1').text('¿Cómo esta ' +  variabley +' en ' +prelugar+  ' antes de la implementación ' + articonec+'.?');

  $('#proespecificopre2_1').text('¿Cómo es el proceso de la Implementación ' +  articonec +' para mejorar ' +variabley+  ' en ' + prelugar+'.?');
  $('#proespecificopre2_2').text('¿Cuántos procesos tiene la Implementación ' +  articonec +' para mejorar ' +variabley+  ' en ' + prelugar+'.?');

  $('#proespecificopre3_1').text('¿Cómo esta ' +  variabley +' en ' +prelugar+  ' después  de la implementación ' + articonec+'.?');

  $('#hiespecificapre1_1').text('Hi, 1.1.Antes de la implementación ' +  articonec +', ' +prelugar+  ' Muestran un inadecuado ' + variabley.substring(3)+'.');

  $('#hiespecificapre2_2').text('Hi,1.2.2.La Implementación ' +  articonec +' para mejorar ' +variabley+  ' en '  + prelugar+' tiene ....  procesos.');
  $('#hiespecificapre2_1').text('Hi,1.2.1. el proceso de la Implementación ' +  articonec +' para mejorar ' +variabley+ ' en ' +  prelugar +   ', es metodológica y cientificamente valido, sustentado bajo la problemática y literatura estudiada. '+'.');

  $('#hiespecificapre3_1').text('Hi,1.3.Después de la implementación ' +  articonec +', ' +prelugar+  ' Muestran un adecuado incremento en ' + variabley+'.');
   //         $('#problemas').text( $("#verbo :selected").text() + " la forma en que "+ variablei +" " + palabra1 +" en " + variabled + " de " + lugar +".");
   //   $('#problemas').text('Hi ' + variablei +' ' +palabra1+' de manera significativa en '+ variabled + ' de ' + lugar);
   //   $('#problemas').text('Hi' + variablei +' ' +palabra1+' en '+ variabled + ' de ' + lugar);


 }
 $("#preexperimental").click(function(event) {
 if($("#independientepre").val() !='' &&  $("#dependientepre").val() != '' && $("#metapre :selected").text() != '' && $("#generalpre :selected").text() != ''){
   $("#mostrardetalle").empty();
   var idtitulo=$('input[name="titulopre"]:checked').val();
   $('#titulo_enfoque').val($("#titulopre"+idtitulo).text());
   var idobjetivos2=$('input[name="obgeneralpre"]:checked').val();
   $('#objgeneral').val($("#obgeneralpre"+idobjetivos2).text());
   var idproblema=$('input[name="progeneralpre"]:checked').val();
   $('#problemage').val($("#progeneralpre"+idproblema).text());
   $('#donde').val($("#lugarpre").val());
   $('#variabled').val($("#dependientepre").val());
   $('#variablei').val($("#independientepre").val());
   var idprob1=$('input[name="proespecificopre"]:checked').val();
   $('#pactual').val($("#proespecificopre_"+idprob1).text());
   var idprob2=$('input[name="proespecificopre2"]:checked').val();
   $('#pinfluyente').val($("#proespecificopre2_"+idprob2).text());
   var idprob3=$('input[name="proespecificopre3"]:checked').val();
   $('#psolucion').val($("#proespecificopre3_"+idprob3).text());
   var idobj1 = $('input[name="especificopre1"]:checked').val();
   $('#obj1').val($("#obespecificopre"+idobj1).text());
   var idobj2 = $('input[name="especificopre2"]:checked').val();
   $('#obj2').val($("#objespecificopre"+idobj2).text());
   var idobj3 = $('input[name="especificopre3"]:checked').val();
   $('#obj3').val($("#objtespecificopre"+idobj3).text());
   var idhipogen = $('input[name="hgeneralpre"]:checked').val();

   var idhipot1 = $('input[name="hiespecificapre1"]:checked').val();
   var idhipot2 = $('input[name="hiespecificapre2"]:checked').val();
   var idhipot3 = $('input[name="hiespecificapre3"]:checked').val();
   var hipesp1 = $("#hiespecificapre1_"+idhipot1).text();
   var hipesp2 =  $("#hiespecificapre2_"+idhipot2).text();
   var hipesp3 =  $("#hiespecificapre3_"+idhipot3).text();
   document.getElementById('detalleprob').style.display = 'block';       

   var newtr = '<div class="col-md-6">';
   newtr = newtr +  '<div class="form-group">';
   newtr = newtr +    '<label>Hipotesis Especifica</label>';
   newtr = newtr +      '<div class="col-lg-11">';
   newtr = newtr +        '<textarea rows="2" cols="2" placeholder="2 da Hipotesis de la Investigación "Hi"" required="true" name="hip2[]" id="hipg20" class="form-control" ></textarea>';
   newtr = newtr +      '</div>';
   newtr = newtr +   '</div>';
   newtr = newtr +  '</div>';
   newtr = newtr +'<div class="col-md-6">';
   newtr = newtr +  '<div class="form-group">';
   newtr = newtr +    '<label>Hipotesis Especifica</label>';
   newtr = newtr +      '<div class="col-lg-11">';
   newtr = newtr +        '<textarea rows="2" cols="2" placeholder="2 da Hipotesis de la Investigación "Hi"" required="true" name="hip2[]" id="hipg21" class="form-control" ></textarea>';
   newtr = newtr +      '</div>';
   newtr = newtr +   '</div>';
   newtr = newtr +  '</div>';
   newtr = newtr +'<div class="col-md-6">';
   newtr = newtr +  '<div class="form-group">';
   newtr = newtr +    '<label>Hipotesis Especifica</label>';
   newtr = newtr +      '<div class="col-lg-11">';
   newtr = newtr +        '<textarea rows="2" cols="2" placeholder="2 da Hipotesis de la Investigación "Hi"" required="true" name="hip2[]" id="hipg22" class="form-control" ></textarea>';
   newtr = newtr +      '</div>';
   newtr = newtr +   '</div>';
   newtr = newtr +  '</div>';
   newtr = newtr +'<div class="col-md-6">';
   newtr = newtr +  '<div class="form-group">';
   newtr = newtr +    '<label>Hipotesis Especifica</label>';
   newtr = newtr +      '<div class="col-lg-11">';
   newtr = newtr +        '<textarea rows="2" cols="2" placeholder="2 da Hipotesis de la Investigación "Hi"" required="true" name="hip2[]" id="hipg23" class="form-control" ></textarea>';
   newtr = newtr +      '</div>';
   newtr = newtr +   '</div>';
   newtr = newtr +  '</div>';
   $('#detallepre').empty().append(newtr);   
    $('#hipg21').text(hipesp1);
     $('#hipg22').text(hipesp2);
      $('#hipg23').text(hipesp3);
         $('#hipg20').val($("#hgeneralpre"+idhipogen).text());
   setTimeout(function(){  $("#modal_remote3").modal('hide');; }, 500);



 }else{
  alert('falta llenar datos');
}



});
$("#desccorrelacional").click(function(event) {
  if(deproblema !='' && objet != '' && tit != '' && hipote != ''){
    $("#mostrardetalle").empty();
    document.getElementById('detalleprob').style.display = 'none';
    var idtitulo=$('input[name="titulo"]:checked').val();
    $('#titulo_enfoque').val($("#titulo"+idtitulo).text());
    var idobjetivos2=$('input[name="objetivo"]:checked').val();
    $('#objgeneral').val($("#objetivos"+idobjetivos2).text());
    var idproblema=$('input[name="problema"]:checked').val();
    $('#problemage').val($("#problemas"+idproblema).text());
    $('#donde').val($("#lugar").val());
    $('#variabled').val($("#variableind").val());
    $('#variablei').val($("#variabledepe").val());
    if(hipote != 2 && hipote != 3){
      $('#hipgeneral').val($("#hipotesis1").val());
      document.getElementById('hipgeneraldiv').style.display = 'block';
    }else{
      var valor=[];
      $('input[name="hip2[]"]').map(function ( n, i) {

       valor[n]=$(this).val();
     }).get();
      var valor1=[];
      $('input[name="hip[]"]').map(function ( n, i) {

       valor1[n]=$(this).val();
     }).get();
      $('#mostrardetalle').empty().append($('#llenahipotesis').html());

      $('input[name="hip2[]"]').map(function ( n, i) {

        $(this).val(valor[n]);
      }).get();
      $('input[name="hip[]"]').map(function ( n, i) {

        $(this).val(valor1[n]);
      }).get();
      document.getElementById('hipgeneraldiv').style.display = 'none';
      document.getElementById('detallehipcausal').style.display = 'block';
      $('#hipgeneral').val('');
    }



    setTimeout(function(){  $("#modal_remote1").modal('hide');; }, 500);

  }else{
    alert('falta llenar datos');
  }



});



$("#descpropositiva").click(function(event) {
 if($("#variable1").val() !='' &&  $("#variablede").val() != '' && $("#meta :selected").text() != '' && $("#futuro :selected").text() != ''){
   $("#mostrardetalle").empty();
   $('#titulo_enfoque').val($("#extitulo").val());
   $('#objgeneral').val($("#exobjetivo").val());
   $('#problemage').val($("#exproblema").val());
   $('#donde').val($("#exlugar").val());
   $('#variabled').val($("#exvd").val());
   $('#variablei').val($("#exvi").val());
   $('#pactual').val($("#exactual").val());
   $('#pinfluyente').val($("#exfactores").val());
   $('#psolucion').val($("#exdiseño").val());
   $('#presultados').val($("#exresultados").val());
   $('#obj1').val($("#exobjetivo1").val());
   $('#obj2').val($("#exobjetivo2").val());
   $('#obj3').val($("#exobjetivo3").val());
   $('#obj4').val($("#exobjetivo4").val());
   $('#hipgeneral').val($("#exhipotesis").val());
   document.getElementById('hipgeneraldiv').style.display = 'block';
   document.getElementById('detalleprob').style.display = 'block';
   document.getElementById('detallehipcausal').style.display = 'none';
   setTimeout(function(){  $("#modal_remote2").modal('hide');; }, 500);



 }else{
  alert('falta llenar datos');
}



});

$("#meta").change(function(event) {
  if($("#meta").val() != ""){
    document.getElementById("futuro").value = $("#meta :selected").val();
    concatenar2();
  }else{
  }   
});
$("#exlugar").change(function(event) {
  if($("#exlugar").val() != ""){
    concatenar2();
  }else{
  }   
});
$("#nivelalcance").change(function(event) {
  if($("#nivelalcance").val() != ""){
    concatenar2();
  }else{
  }   
});
$("#variable1").change(function(event) {
  if($("#variable1").val() != ""){
    concatenar2();
  }else{
  }   
});
$("#variable2").change(function(event) {
  if($("#variable2").val() != ""){
    concatenar2();
  }else{
  }   
});
$("#sustantivo").change(function(event) {
  if($("#sustantivo").val() != ""){
    concatenar2();
  }else{
  }   
});



function concatenar2(){
  var articulo = ($('#variable2').val());
  var conproblema = $("#variable2").val();
  
  var art = conproblema.substring(0,2);

  if(art == 'el'){
    var articonec = 'del ' +conproblema.substring(3);
  }else{
    var articonec = 'de ' +conproblema;
  }
  

  var meta = $("#meta :selected").text();
  var futuro = $("#futuro :selected").text();
  var exlugar = $("#exlugar").val();
  var solucion = $("#variable1").val();
  var nivelalcance = $("#nivelalcance").val();
  var sustantivo = $("#sustantivo").val();
  $('#exproblema').val('¿Cómo la implementación de ' + solucion +' ' +futuro +' ' +conproblema+ ' en ' + exlugar+'?.');
  $('#exobjetivo').val( nivelalcance+ ' ' + solucion +" para " + meta +"  " + conproblema + " en " + exlugar +".");
  $('#exhipotesis').val('La implementación de ' + solucion +' ' +futuro+ ' ' + conproblema + ' en ' + exlugar+'.');
  $('#exvi').val(solucion);

  $('#exvd').val( conproblema);
  $('#extitulo').val( sustantivo + " de "+ solucion  + " para " + meta +" " +conproblema +" en " + exlugar +".");
  $('#exactual').val( '¿Cuál es el estado '  + articonec +" en " +  exlugar +'?.');
  $('#exfactores').val( '¿Qué factores influyen en ' + conproblema  + "en " + exlugar +'?.');


  $('#exdiseño').val( '¿Qué características debe tener una estrategia de solución para  '+ meta +"  " + conproblema +"  en " + exlugar +'?.');
  $('#exresultados').val('¿Qué resultados generá la implantación '  +  solucion +" en " + conproblema +"  en " + exlugar +".?");
  $('#exobjetivos').val( nivelalcance + ' ' +solucion +" para " + meta +"  " + conproblema + " en " + exlugar +".");
  $('#exobjetivo1').val('Diagnosticar el estado actual ' + articonec +" en " + exlugar +".");
  $('#exobjetivo2').val('Identificar los factores influyentes en ' + conproblema +" en " + exlugar +".");
  $('#exobjetivo3').val('Diseñar ' + solucion + ' para ' + meta + ' ' +conproblema +" en " + exlugar +".");
  $('#exobjetivo4').val('Estimar mediante el método DELPHI los resultados que generará la implantación de ' + solucion + ' en ' + conproblema +" en " + exlugar +".");
   //         $('#problemas').text( $("#verbo :selected").text() + " la forma en que "+ variablei +" " + palabra1 +" en " + variabled + " de " + lugar +".");
   //   $('#problemas').text('Hi ' + variablei +' ' +palabra1+' de manera significativa en '+ variabled + ' de ' + lugar);
   //   $('#problemas').text('Hi' + variablei +' ' +palabra1+' en '+ variabled + ' de ' + lugar);


 }

 $('.anytime-time').datetimepicker({

  format:'LT',



  enabledHours: [0,1,2,3],

  stepping: 5

}).on('dp.change',function(event){

 valor=$(this).val();
 

                 //  alert(valor);

                 $.post(base_url+'Ficha_enfoque/asesoresListos',{"hora":valor}, function(data) {

                    //console.log(data);

                    //alert(data.empiezo);

                    //alert(data.fin);

                    $("#empiezo").val(data.empiezo);

                    $("#fin").val(data.fin)

                    $('#id_trabajador').empty();

                    $("#id_trabajador").append(data.html);



                  },"json");  

               });



}); 



$("#agregarCaptacion1").click(function(event) {

 $("#agregarCaptacion").modal();

});

$("#guardar_captacion").click(function(event) {

 $.post(base_url+'Ficha_enfoque/guardar_captacion', {data: $("#inputCaptacion").val()}, function(data, textStatus, xhr) {

   $("#inputCaptacion").focus();

   $("#id_captacion").empty();

   $("#id_captacion").append(data);

   $("#agregarCaptacion").show();

   $("#inputCaptacion").val("");



 });

});



function seguir(){

  <?php

  if($_SESSION['usuario_perfil']==4){ ?>

    reload_url('Ficha_enfoque','Tesis');

    alerta("No puede ingresar a pagos","Gracias el administrador solo puede ingresar");

    <?php }

    else{

      ?>

      $("#tab4").removeClass('active');

      $("#tab5").removeClass('disabledTab');

      $("#tab5").addClass('active'); 

      $("#bordered-justified-tab4").removeClass('active');

      $("#bordered-justified-tab5").addClass('active');

      <?php }



      ?>

      $.post(base_url+'Ficha_enfoque/estadoCambiar5', {"id_enfoque": $("#id_enfoque").val()}, function(data, textStatus, xhr) {});



    }



    function resetear(){

      var valor=$("#hora").val();

                 //  alert(valor);

                 $.post(base_url+'Ficha_enfoque/asesoresListos',{"hora":valor}, function(data) {

                    //console.log(data);

                    //alert(data.empiezo);

                    //alert(data.fin);

                    $("#empiezo").val(data.empiezo);

                    $("#fin").val(data.fin)

                    $('#id_trabajador').empty();

                    $("#id_trabajador").append(data.html);



                  },"json");  

               }

               <?php if($estadoficha==6 &&  ($_SESSION['usuario_perfil']==5 || $_SESSION['usuario_perfil']==1)){?>



                $('input[name="id_categoria"]').on('change', function(e) {

 //alert($('input[name="id_categoria"]:checked').val());

 $("#aceptacion").modal();

});









                function irpaso(){



                 $("#aceptacion").modal('hide');

                 $.post(base_url+'Ficha_enfoque/ingresar', $("#formulario_enfoque").serialize(), function(data, textStatus, xhr) {

    //alert(data);

    var ruta=base_url+"pdf/crear.php?id="+$("#id_enfoque").val();

    var iframe = document.getElementById("ficha_enfoque_pdf");

    iframe.setAttribute("src", ruta);

    $("#modal_large").modal();

  });

                 <?php

                 if($_SESSION['usuario_perfil']==4){ ?>

                  reload_url('Ficha_enfoque','Tesis');

                  alerta("No puede ingresar a pagos","Gracias el administrador solo puede ingresar");

                  <?php }

                  else{

                    ?>

                    $("#tab2").removeClass('active');

                    $("#tab2").addClass('disabledTab');

   //disabledTab

   $("#tab5").removeClass('disabledTab');

   $("#tab5").addClass('active'); 

   $("#bordered-justified-tab2").removeClass('active');

   $("#bordered-justified-tab5").addClass('active');

   <?php }



   ?>

   $.post(base_url+'Ficha_enfoque/estadoCambiar5', {"id_enfoque": $("#id_enfoque").val()}, function(data, textStatus, xhr) {});

 }





 <?php }?>

  cant_requerimiento=1;
   $("#nuevo_requerimiento").click(function()
    {
      cant_requerimiento++;
      $("#reque").append('<div class="col-md-12"><div class="form-group"><label>Requerimiento '+cant_requerimiento+'</label><textarea id="requermientos'+cant_requerimiento+'" name="requermientos[]" class="form-control" cols="2"></textarea></div></div>');
      $("#requermientos"+cant_requerimiento).focus();
    });

   $("#guardar_requerimiento").click(function(){
      $(this).attr("disabled",true);
      $.post(base_url+"Ficha_enfoque/guardar_ficha_requerimiento",$("#enviar_requerimiento").serialize(),function(data){
        ///alert(data);
          var url=base_url+"pdf/requerimiento.php?id="+data;
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
     $("#requerimiento").modal("hide");
        setTimeout(function(){  reload_url('Ficha_enfoque','Tesis'); }, 500);
      });
   });



</script>





