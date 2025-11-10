<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<div class="row">
			<center><h3>CREAR NUEVO ANTECEDENTE</h3></center>
				<div class="col-md-10">
				<button onclick="generarautor()"  class="btn btn-primary legitRipple">Nueva autor</button>
				</div>
				<div class="col-md-2">
								<button id="enlaces"  class="btn btn-success legitRipple">Enlaces</button>
				</div>

			</div>
		   
		
	

		</div>
		<div class="panel-body">
		<form id="formulario_antecedente" name="formulario_antecedente" action="post">
		    <div class="row">
		    	<div class="col-md-6">
		    		<select class="form-control" name="id_alcance" id="id_alcance">
		    		<option value="">Selecionar alcance</option>
		    		<?php
                        foreach ($alcance as $key => $value) {
                         echo "<option value='".$value->id_alcance."'>".$value->alc_descripcion."</option>";
                        }


		    		 ?>
		    		</select> 
		    	</div>
		    	<div class="col-md-6">
		    		<select class="form-control" name="id_grado_tesis" id="id_grado_tesis">
		    		<option value="">Seleccionar grado de tesis</option>
		    		<?php
                        foreach ($grado_tesis as $key => $value) {
                         echo "<option value='".$value->id_grado_tesis."'>".$value->gra_descripcion."</option>";
                        }


		    		 ?>
		    		</select> 
		    	</div>
		    </div>
		<h4><b>Datos Para Referencia</b></h4>
			  <div class="row">
			  <input type="hidden" name="id_antecedente" id="id_antecedente" value="<?php echo $id_antecedente; ?>">
			   <input type="hidden" name="id_referencia" id="id_referencia" value="<?php echo $id_referencia; ?>">
		  	 <div id="autor"></div>
		  </div>	
		  <br>
		<div class="row">
			 
			 <div class="col-md-12">
			 	<label class="control-label col-lg-2">Titulo:</label>
			 	<div class="col-lg-10"><input id="ref_titulo" name="ref_titulo" class="form-control" ></div>
			 </div>
			 <div class="col-md-12">
			 	<label class="control-label col-lg-2">Universidad:</label>
			 	<div class="col-lg-10"><input id="ref_universidad" name="ref_universidad" class="form-control" ></div>
			 </div>
			  <div class="col-md-8">
			 	<label class="control-label col-lg-2">Pais:</label>
			 	<div class="col-lg-10"><input id="ref_pais" name="ref_pais" class="form-control" ></div>
			 </div>
			 <div class="col-md-4">
			 	<label class="control-label col-lg-2">Año:</label>
			 	<div class="col-lg-10"><input id="ref_anio" name="ref_anio" class="form-control" ></div>
			 </div>
			  <div class="col-md-12">
			 	<label class="control-label col-lg-2">URL:</label>
			 	<div class="col-lg-10"><input id="ref_url" name="ref_url" class="form-control" ></div>
			 </div>
			   <div class="col-md-12">
			 	<label class="control-label col-lg-2">Ciudad:</label>
			 	<div class="col-lg-10"><input id="ref_ciudad" name="ref_ciudad" class="form-control" ></div>
			 </div>
		</div>
		<h4><b>Datos Para los antecedentes</b></h4>
        <div class="row">
        	<div class="form-group">
	          <label class="control-label col-lg-2">Introduccion para la prosa para obejtivos:</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_intro_objetivo" id="ant_intro_objetivo"></textarea>
		    </div>
	         </div>
	         <div class="form-group">
	          <label class="control-label col-lg-2">Objetivo:</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_objetivo" id="ant_objetivo"></textarea>
		    </div>
	       </div>
	       <div class="form-group">
	          <label class="control-label col-lg-2">Introducción de la prosa para muestra:</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_intro_muestra" id="ant_intro_muestra"></textarea>
		    </div>
	     </div>
	     <div class="form-group">
	          <label class="control-label col-lg-2">Muestra:</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_muestra" id="ant_muestra"></textarea>
		    </div>
	     </div>
	          <div class="form-group">
	          <label class="control-label col-lg-2">Prosa para diseño :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_prosa_diseno" id="ant_prosa_diseno"></textarea>
		    </div>
	     </div>
	          <div class="form-group">
	          <label class="control-label col-lg-2">Diseño :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_diseno" id="ant_diseno"></textarea>
		    </div>
	     </div>
	      <div class="form-group">
	          <label class="control-label col-lg-2">Prosa Introductoria de instrumentos :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_intro_prosa_instrumento" id="ant_intro_prosa_instrumento"></textarea>
		    </div>
	     </div>
	       <div class="form-group">
	          <label class="control-label col-lg-2">Instrumentos:</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_instrumento" id="ant_instrumento"></textarea>
		    </div>
	     </div>
	     <div class="form-group">
	          <label class="control-label col-lg-2">Prosa introductoria para conclusiones :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_prosa" id="ant_prosa"></textarea>
		    </div>
	     </div>
	        <div class="form-group">
	          <label class="control-label col-lg-2">Conclusiones :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_conclusion" id="ant_conclusion"></textarea>
		    </div>
	     </div>
          <div class="form-group">
	          <label class="control-label col-lg-2">Introduccion de aporte de la investigación :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_prosa_intro_inv" id="ant_prosa_intro_inv"></textarea>
		    </div>
	     </div>

    <div class="form-group">
	          <label class="control-label col-lg-2">Aporte de la investigación :</label>
		       <div class="col-lg-10">
			     <textarea rows="2 	" cols="5" class="form-control" name="ant_investigacion" id="ant_investigacion"></textarea>
		    </div>
	     </div>
 </form>
        </div>
		<br>

		 <div class="row">
		 <center>
		 	 <button type="button" id="btn_guardar" class="btn btn-primary " >Guardar</button>
      
      	 <button type="button" class="btn btn-danger" onclick="reload_url('Captacion','mantenimiento')");">Cancelar</button>
      	 </center>
		 </div>
		
	

		</div>
          </div>
</div>


<div id="modal_mini1" class="modal fade">
            <div class="modal-dialog modal-xs">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title">seleccionar</h5>
                </div>
              
                <div class="modal-body">
                  
                  <div class="row">
      <center>	
      <button class="btn btn-primary" id="seguir">Seguir</button>
      	<button class="btn btn-success" id="antes">ver antecedentes</button>
      	</center>

      </div>
                </div>

                <div class="modal-footer">
              
                
                </div>
              </div>
            </div>
          </div>







          <div id="datos1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
   
      <div class="modal-body">
          <div class="row">
      
          	<?php 

             foreach ($tipo_url as $key => $value)
              {
                   echo "<h3>".$value->tipo_url_descripcion."</h3>";
                       $query2=$this->db->query("select * from categoria_url  where categoria_url_estado=1 and id_tipo_url=".$value->id_tipo_url);

                       echo '<div class="panel-group content-group-lg" id="accordion1">';

                      $bolean="false";
                        foreach ($query2->result() as $key1 => $value1)
                         {
                         		if($key1==0){$data= "";$bolean="false";
                         	}

                         echo '	<div class="panel panel-white">';

                          echo '<div class="panel-heading"><h4 class="panel-title"><a class="collapsed" data-toggle="collapse" data-parent="#accordion1" href="#accordion-group'.$value1->id_categoria_url.'" aria-expanded="false">'.$value1->categoria_url_descripcion."</a></div></h4>";


                            $query1=$this->db->query("select * from url   where url_estado=1 and id_categoria_url=".$value1->id_categoria_url);
                            	$data="";
                             	if($key1==0){$data= "";}
                             	echo '<div id="accordion-group'.$value1->id_categoria_url.'" class="panel-collapse collapse '.$data.'" aria-expanded="false" style="">
										<div class="panel-body">';
                             foreach ($query1->result() as $key => $value2) 
                             {
                             
                                $d='"'.$value2->url_descripcion.'"';
                                  echo "<div class='col-md-11'><input class='form-control' value='".$value2->url_descripcion."'> </div><div class='col-md-1'><button onclick='url(".$d.")'>+</button></div>";
                                
                             }
                                   echo '</div></div>';
                             echo '</div>';
                        }


                  echo '</div>';



							
               }

          	?>
          	
          </div>
          <div class="row">
          	<div class="col-md-6">Si tus textos están en ingles traducirlos en:</div>
          	<div class="col-md-5"><input  type="text" class="form-control" value="https://www.bing.com/translator"></div><div class="col-md-1"><button onclick="url('https://www.bing.com/translator')">+</button></div>
          	<div class="col-md-6">Para Parafrasear tus textos hacerlo en:</div>
          	<div class="col-md-5"><input type="text" value="http://free-article-spinner.com/" class="form-control" name=""></div><div class="col-md-1"><button onclick="url('http://free-article-spinner.com/')">+</button></div>
          </div>
          <div class="row">
          	<h6 style="font-size: 10px">Es muy importante recordad que el primer paso para parafrasear textos en español, consiste en traducirlo al inglés, luego de ello copiar el texto traducido en el spinner, una vez spinneado volver a traducirlo de inglés a español y listo. </h6>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" type="text" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
 idautor=1;
	$(function () {
       //$("#table_sistema").DataTable({ } );
       $("#titulo").text("Produccion");
       $("#subtitulo").text('Nuevo Antecendente');
      
        html='<div class="col-md-6"><h5><b>Datos del Autor '+idautor+'</b></h5><div class="row"><label class="control-label col-lg-4">Apellido:</label><div class="col-lg-8"><input id="aut_apellido" name="aut_apellido[]" class="form-control" ></div><div class="row"><br><label class="control-label col-lg-4">Primera letra nombre:</label><div class="col-lg-8"><input id="aut_nombre" name="aut_nombre[]" class="form-control" ></div></div></div>';
        $("#autor").append(html);

    });
  function generarautor()
  {
       idautor=idautor+1;
      
  html='<div class="col-md-6"><h5><b>Datos del Autor '+idautor+'</b></h5><div class="row"><label class="control-label col-lg-4">Apellido:</label><div class="col-lg-8"><input id="aut_apellido" name="aut_apellido[]" class="form-control" ></div><div class="row"><br><label class="control-label col-lg-4">Primera letra nombre:</label><div class="col-lg-8"><input id="aut_nombre" name="aut_nombre[]" class="form-control" ></div></div></div>';
        $("#autor").append(html);
    }

    $("#btn_guardar").click(
      function(){
 //  alert($("#formulario_antecedente").serialize());
 

if($("#id_alcance").val()=="")
{
 $("#id_alcance").focus(); 
 return 1; 
} 
if($("#id_grado_tesis").val()=="")
{
 $("#id_grado_tesis").focus(); 
 return 1; 
} 


 $('input[name="aut_nombre[]"]').map(function () {
             //alert($(this).val());
            if($(this).val()==""){
                 $(this).focus();
                 return 1;

            }
      }).get();


 $('input[name="aut_apellido[]"]').map(function () {
               //alert($(this).val());
            if($(this).val()==""){
                 $(this).focus();
              return 1;
            }
      }).get();


if($("#ref_titulo").val()=="")
{
 $("#ref_titulo").focus(); 
 return 1; 
}
if($("#ref_ciudad").val()=="")
{
 $("#ref_ciudad").focus();  
  return 1; 
}

if($("#ref_url").val()=="")
{
 $("#ref_url").focus();  
  return 1; 
}
if($("#ref_anio").val()=="")
{
 $("#ref_anio").focus();  
  return 1; 
}
if($("#ref_pais").val()=="")
{
 $("#ref_pais").focus(); 
  return 1;  
}
if($("#ref_ciudad").val()=="")
{
 $("#ref_ciudad").focus(); 
  return 1;  
}

if($("#ant_investigacion").val()=="")
{
 $("#ant_investigacion").focus();  
  return 1; 
}
if($("#ant_conclusion").val()=="")
{
 $("#ant_conclusion").focus();  
  return 1; 
}

if($("#ant_prosa").val()=="")
{
 $("#ant_prosa").focus();  
  return 1; 
}
if($("#ant_conclusion").val()=="")
{
 $("#ant_conclusion").focus();  
  return 1; 
}
if($("#ant_instrumento").val()=="")
{
 $("#ant_instrumento").focus(); 
  return 1;  
}
if($("#ant_muestra").val()=="")
{
 $("#ant_muestra").focus();  
  return 1; 
}

if($("#ant_diseno").val()=="")
{
 $("#ant_diseno").focus();  
  return 1; 
}






  $.post(base_url+"Documentos_c/guardar",$("#formulario_antecedente").serialize(),function(data){
   // alert(data);
    $("#modal_mini1").modal();

  });
      }

    	);

    $("#seguir").click(function(){
    	   $("#modal_mini1").modal("hide");
         $.post(base_url+"Documentos_c/nuevo_antecedente",function(data){
              	   setTimeout(function(){    $('#cont_sistema').empty().html(data); }, 500);
	   
          
         });
    });

 $("#antes").click(function(){
   $("#modal_mini1").modal("hide");
     $.post(base_url+"Documentos_c/antecedentes",{
             "id":"<?php echo $_SESSION['id_ficha_enfoque'] ?>"
		},function(data){
              	   setTimeout(function(){    $('#cont_sistema').empty().html(data); }, 800);
	   
          
         });
         });



 $("#enlaces").click(function(){

     $("#datos1").modal();
 });

 function url(datos){
var a = document.createElement("a");
		a.target = "_blank";
		a.href = datos;
		a.click();

 }
</script>