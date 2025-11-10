
<form id="formulario" >
  <div  class=" panel panel-flat "  >
    <div class="panel-heading" id="cuerpo">
       <div class="row"><button id="migrar" class="btn btn-success" onclick="ver_data()">migrar</button></div>
    </div>  
    <div class="panel-body">
      <div class="row">
        <center><h3>Configuracion de la tabulacion</h3></center>
        <div class="col-md-3">
          <label class="control-label col-lg-6">Nº de muestra</label>
          <div class="col-lg-6  "><input type="number" class="form-control" name="muestra" id="muestra"  required></div> 
        </div>
        <div class="col-md-3">
          <label class="control-label col-lg-6">Nº Item</label>
          <div class="col-lg-6  "><input type="number" class="form-control"  name="item" id="item"  required></div> 
        </div>
        <div class="col-md-3">
          <label class="control-label col-lg-6">Nº Variables</label>
          <div class="col-lg-6  "><input type="number" class="form-control" name="variable" id="variable"  required></div> 
        </div>
        <div class="col-md-3">
          <label class="control-label col-lg-6">Nomb. Muestra</label>
          <div class="col-lg-6  "><input type="text" class="form-control" name="nommuestra" id="nommuestra"  required></div> 
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
         <label class="control-label col-lg-6">Nº escala valorativa </label>
         <div class="col-lg-6    "><input type="number" class="form-control" name="escala" id="escala"  required></div>  
       </div>
       <div class="col-md-4">
        <div id="respuesta_escala"></div>
      </div>
    </div>
    <div class="row">
     <div class="col-md-3">
      <label class="control-label col-lg-6">Nº de respuestas</label>
      <div class="col-lg-6  "><input type="number" class="form-control" name="respuesta" id="respuesta" required></div> 
    </div>
    <div class="col-md-4">
      <div id="respuesta_numero"></div>
    </div>
  </div>

  <div id="respuesta2" style='display:none;'>
    <div class="row">
     <div class="col-md-2">
      <label class="control-label col-lg-12">Valor respuesta</label>
    </div>
    <div class='col-md-1'>
      <label class="control-label col-lg-6">.</label>
      <div class='form-group'>
        <div class='radio'>
          <label>
            <span class='radio'><input value='1' type='radio' name='valorresp' id='valorresp' required></span>
            <label>1-2</label>
          </label>
        </div>
      </div>
    </div> 
  </div>
</div>
<div class="row">
 <div class="col-md-1">
  <label class="control-label col-lg-6">Tipo</label>
  <div class='radio'>
    <label>
      <span class='radio'><input value='Item' type='radio' name='resitem' id='resitem' required></span>
      <label>Item</label>
    </label>
  </div>
</div>
<div class='col-md-1'>
  <label class="control-label col-lg-6">.</label>
  <div class='form-group'>
    <div class='radio'>
      <label>
        <span class='radio'><input value='Pregunta' type='radio' name='resitem' id='resitem' required></span>
        <label>Pregunta</label>
      </label>
    </div>
  </div>
</div> 
</div>

<div class="row">
 <div class="col-md-1">
  <label class="control-label col-lg-6">Relación</label>
  <div class='radio'>
    <label>
      <span class='radio'><input value='0' type='radio' name='relacionversa' id='relacionversa' required></span>
      <label>No Inversa</label>
    </label>
  </div>
</div>
<div class='col-md-1'>
  <label class="control-label col-lg-6">.</label>
  <div class='form-group'>
    <div class='radio'>
      <label>
        <span class='radio'><input value='1' type='radio' name='relacionversa' id='relacionversa' required></span>
        <label>Inversa</label>
      </label>
    </div>
  </div>
</div> 
</div>

<div class="row">
  <br><br>
  <center><button class="btn btn-primary" type="button" id="generar">Generar</button><button class="btn btn-danger">Cancelar</button></center>
</div>
</div>
</div>

<div id="segundavariable" style='display:none;'>
  <div  class=" panel panel-flat"  >
    <div class="panel-heading" id="variable"></div>  
    <div class="panel-body">
      <div class="row">
        <center><h3>Segunda Variable</h3></center>
        <div class="col-md-3">
          <label class="control-label col-lg-6">Nº Item</label>
          <div class="col-lg-6  "><input type="text" class="form-control"  name="itemv2" id="itemv2"></div> 
        </div>
        <div class="col-md-4">
          <div id="respuesta_escalav2" ></div>
        </div>
        <div class="col-md-4">
          <div id="respuesta_numerov2"></div>
        </div>

      </div>
      <div class="row">
        <br><br>
        <div class="col-md-3">
        <label class="control-label col-lg-6">Porcentaje de Variación</label>
        <div class="col-lg-6  "><input type="number" class="form-control" name="porcentajevar" id="porcentajevar" ></div> 
        </div>
      </div>
    </div>
  </div>
</div>


<div  class=" panel panel-flat "  >
  <div class="panel-heading" id="deta"></div>  
  <div class="panel-body">
    <div class="row">
      <center><h4 id="tabla"></h4></center>
      <div class="col-md-3"><h5 id="maximo"> </h5></div>
      <div class="col-md-3"><h5 id="minimo"></h5></div>
      <div class="col-md-3"><h5 id="rango"></h5></div>
      <div class="col-md-3"><h5 id="amplitud"></h5></div>
    </div>
    <div class="row">
      <div id="escalar"></div>
    </div>
    <div class="row">
      <div id="deficit"></div>
    </div>
    <div class="row">
      <div class="col-md-3"> <div id="crear_cabezera"></div></div>
      <div class="col-md-3"><div id="crear_dimension"></div></div>
      <div class="col-md-0"><div id="crear_indicador"></div></div>
      <div class="col-md-3"><div id="crear_preguntas"></div></div>
      <div class="col-md-3"><div id="crear_conca"></div></div>
    </div>
    <div class="row">
      <div id="botones"></div> 
    </div>
  </div>
</div>

</form>

<div  class=" panel panel-flat "  >
  <div class="panel-heading" id="detalle"></div>  
  <div class="panel-body">
    <div class="row">
      <center><h3>Cuadro Estadistico</h3></center>
      <div id="llamar">
        <div id="hot"></div>
      </div>

    </div>
  </div>
</div>


<div id="modal_full" class="modal fade in" >
  <div class="modal-dialog modal-full">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h5 class="modal-title">Cuadro de tabulacion</h5>
      </div>

      <div class="modal-body">
        <div class="table-responsive">
         <table class="table table-bordered table-framed">   
           <thead id="tabla_cabeza"></thead>                  
           <tbody id="datos"></tbody>
         </table>
       </div>
     </div>

     <div class="modal-footer">
      <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">Close<span class="legitRipple-ripple" style="left: 38.0351%; top: 28.9474%; transform: translate3d(-50%, -50%, 0px); width: 225.475%; opacity: 0;"></span></button>
      <button type="button" class="btn btn-primary legitRipple">Save changes</button>
    </div>
  </div>
</div>
</div>









<script type="text/javascript">
  function cargar()
  {
   alert('Tenga encuenta que esto puede tardar,espere un momento!!!');
 }



 $("#item").keyup(function(){
  if($(this).val()>50){
    alert("Recuerda que a mayor items el proceso demore mas o no se pueda generar los datos");
  }

});

 $("#probar").click(function(){
  $.post(base_url+"Tabulacion/distribucion_normal",function(data){
   alert(data);
 });
});

 function enviar_dato() {

  $("#llamar").empty().html("<div class='paneles'><center><div class='loader'><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div></div></center></div>");

// $.post(base_url+"Tabulacion/procesamiento",$("#formulario").serialize(),function(data){
//    var url=base_url+"excel/Examples/tabulacion.php?data="+data;
//    var a = document.createElement("a");
//    a.target = "_blank";
//    a.href = url;
 //   a.click();
//  },"json");
}
maximo=0;
minimo=0;
rango=0;
amplitud=0;
$("#generar").click(function()
{

  if ($("#item").val() >= 20 && $("#item").val() < 30) {
    alert("Atención solo podra ingresar como maximo 9 negativos con algo de lentitud");
  }
  if ($("#item").val() >= 30 && $("#item").val() < 40) {
    alert("Atención solo podra ingresar como maximo 11 negativos con algo de lentitud");
  }
  if ($("#item").val() >= 40 && $("#item").val() < 50) {
    alert("Atención solo podra ingresar como maximo 13 negativos con algo de lentitud");
  }
  if ($("#item").val() >= 50 && $("#item").val() < 60) {
    alert("Atención solo podra ingresar como maximo 14 negativos con algo de lentitud");
  }
/*var escalas = [];

$('input[name="nombre_escala[]"]').map(function(n){
escalas[n]=$(this);
}).get();
alert(escalas[0].val("hola"));*/
if($("#respuesta").val() == 2){
  var valrespues = $('input:radio[name=valorresp]:checked').val();
  if(parseFloat(valrespues) == 1){
    maximo=parseFloat(2)*parseFloat($("#item").val());
    minimo=parseFloat($("#item").val());
  }else{
    maximo=parseFloat(1)*parseFloat($("#item").val());
    minimo=parseFloat(0);  
  }
}else{
  maximo=parseFloat($("#respuesta").val())*parseFloat($("#item").val());
  minimo=parseFloat($("#item").val());

}


$("#maximo").text("Maximo: "+maximo);
$("#minimo").text("Minimo: "+minimo);

rango=maximo-minimo;
$("#rango").text("Rango: "+rango);
amplitud=Math.round(rango/parseFloat($("#escala").val()));
$("#amplitud").text("Amplitud del intervalo: "+amplitud);
html="";
data1="";
data2="";
data3="";
data4="";
html2="";
desde=0;
hasta=0;
data5="";
          $('input[id="nombre_escala[]').map(function ( n, i) {
               //alert($(this).val());
               desde=minimo;
               hasta=minimo+(amplitud-1);
               data1+="<h6>"+(n+1)+".- "+$(this).val()+"</h6>";
               data2+="<input  value='"+desde+"' type='text' class='form-control' id='desde' name='desde[]' required>";
               if(n+1==$("#escala").val())
               {
                data3+="<input  value='"+maximo+"' type='text' class='form-control' id='hasta' name='hasta[]' required>";
              }
              else{
                data3+="<input  value='"+hasta+"' type='text' class='form-control' id='hasta' name='hasta[]' required>";
              }

              data4+="<input  value='' type='text' class='form-control' onkeyup='cal_cant()' id='porcentaje' name='porcentaje[]' required>";
              data5+="<input  value='' type='text' class='form-control' id='cantidad' name='cantidad[]' required>";
              minimo=hasta+1;

          }).get();



html+='';
html+='<div class="col-md-2"><h5>Descripcion</h5>'+data1+'</div>';
html+='<div class="col-md-1"><h5>Desde</h5>'+data2+'</div>';
html+='<div class="col-md-1"><h5>Hasta</h5>'+data3+'</div>';
html+='<div class="col-md-1"><h6>Porcentaje%</h6>'+data4+'</div>';
html+='<div class="col-md-1"><h6>cantidad</h6>'+data5+'</div>';
html1='<br><br><center><button type="submit"   class="btn btn-primary">enviar datos</button></center>';
html2+='<div class="col-md-12"><h4>Nivel bajo</h4></div>';
for (var i = 1; i<=$("#item").val(); i++) {
  html2+='<div class="col-md-1"><label class="text-semibold">Item'+i+'</label><div class="radio radio-right"><label><input type="radio" name="desficiente'+i+'" value="1" onclick="verificar(this,'+i+')" id="desficiente[]" >negativo</label></div><div class="radio radio-right"><label><input type="radio" name="desficiente'+i+'" value="0" onclick="verificar(this,'+i+')" id="desficiente[]"  checked="checked">positivo</label></div></div>'; 
}                     

$("#escalar").empty().append(html);
$("#botones").empty().append(html1);
$("#deficit").empty().append(html2);
variable();

  
});

function verificar(rbutton,id){

  sum=0;
  var desde = [];
  var  ayuda =$("#item").val();
  $('input[name="desde[]"]').map(function ( n, i1){
    desde[n] = $(this).val();
  }).get();
  for (var i = 1; i<=$("#item").val(); i++) {
    sum+=parseFloat($('input:radio[name=desficiente'+i+']:checked').val())*cantidad();
    var res =parseFloat(ayuda)-sum;

  }
  var mult = 0;mult1 = 0;
  
  if(parseInt($("#escala").val()) == 3){
    if((parseInt(sum)>=parseInt(22)) && ((parseInt($("#item").val())) >= 50) ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
    if((parseInt(sum)>=parseInt(18)) && ( ((parseInt($("#item").val())) >= 40) && ((parseInt($("#item").val())) <= 49))   ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
    if((parseInt(sum)>=parseInt(13)) && ( ((parseInt($("#item").val())) >= 30) && ((parseInt($("#item").val())) <= 39))   ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
    if((parseInt(sum)>=parseInt(9)) && ( ((parseInt($("#item").val())) >= 20) && ((parseInt($("#item").val())) <= 29))   ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
    if((parseInt(sum)>=parseInt(4)) && ( ((parseInt($("#item").val())) >= 10) && ((parseInt($("#item").val())) <= 19))   ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
    if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 5) && ((parseInt($("#item").val())) <= 9))   ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
    if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 0) && ((parseInt($("#item").val())) <= 4))   ){
      alert("ya no sé puede ingresar mas negativos");
      $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
    }
  }else{
    if(parseInt($("#escala").val()) == 4){
          if((parseInt(sum)>=parseInt(15)) && ((parseInt($("#item").val())) >= 50) ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
          if((parseInt(sum)>=parseInt(12)) && ( ((parseInt($("#item").val())) >= 40) && ((parseInt($("#item").val())) <= 49))   ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
          if((parseInt(sum)>=parseInt(10)) && ( ((parseInt($("#item").val())) >= 30) && ((parseInt($("#item").val())) <= 39))   ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
          if((parseInt(sum)>=parseInt(6)) && ( ((parseInt($("#item").val())) >= 20) && ((parseInt($("#item").val())) <= 29))   ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
          if((parseInt(sum)>=parseInt(1)) && ( ((parseInt($("#item").val())) >= 10) && ((parseInt($("#item").val())) <= 19))   ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
          if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 5) && ((parseInt($("#item").val())) <= 9))   ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
          if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 0) && ((parseInt($("#item").val())) <= 4))   ){
            alert("ya no sé puede ingresar mas negativos");
            $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
          }
    }else{
       if(parseInt($("#escala").val()) == 2){
              if((parseInt(sum)>=parseInt(27)) && (((parseInt($("#item").val())) >= 50)) ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(22)) && ( ((parseInt($("#item").val())) >= 40) && ((parseInt($("#item").val())) <= 49))   ){
                 alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(16)) && ( ((parseInt($("#item").val())) >= 30) && ((parseInt($("#item").val())) <= 39))   ){
                 alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(13)) && ( ((parseInt($("#item").val())) >= 20) && ((parseInt($("#item").val())) <= 29))   ){
                 alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(12)) && ( ((parseInt($("#item").val())) >= 10) && ((parseInt($("#item").val())) <= 19))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(6)) && ( ((parseInt($("#item").val())) >= 5) && ((parseInt($("#item").val())) <= 9))   ){
                 alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(2)) && ( ((parseInt($("#item").val())) >= 0) && ((parseInt($("#item").val())) <= 4))   ){
                 alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
        }else{
           if(parseInt($("#escala").val()) == 5){
              if((parseInt(sum)>=parseInt(11)) && ((parseInt($("#item").val())) >= 50) ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(8)) && ( ((parseInt($("#item").val())) >= 40) && ((parseInt($("#item").val())) <= 49))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(6)) && ( ((parseInt($("#item").val())) >= 30) && ((parseInt($("#item").val())) <= 39))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(3)) && ( ((parseInt($("#item").val())) >= 20) && ((parseInt($("#item").val())) <= 29))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 10) && ((parseInt($("#item").val())) <= 19))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 5) && ((parseInt($("#item").val())) <= 9))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 0) && ((parseInt($("#item").val())) <= 4))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
          }else{

              if((parseInt(sum)>=parseInt(11)) && ((parseInt($("#item").val())) >= 50) ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(8)) && ( ((parseInt($("#item").val())) >= 40) && ((parseInt($("#item").val())) <= 49))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(6)) && ( ((parseInt($("#item").val())) >= 30) && ((parseInt($("#item").val())) <= 39))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(3)) && ( ((parseInt($("#item").val())) >= 20) && ((parseInt($("#item").val())) <= 29))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 10) && ((parseInt($("#item").val())) <= 19))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 5) && ((parseInt($("#item").val())) <= 9))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
              if((parseInt(sum)>=parseInt(0)) && ( ((parseInt($("#item").val())) >= 0) && ((parseInt($("#item").val())) <= 4))   ){
                alert("ya no sé puede ingresar mas negativos");
                $('input:radio[name=desficiente'+id+']').filter('[value=0]').prop('checked', true);
              }
            
          }
        }
    }
  }                   



}

$("#numerosvariable").keypress(function(){
  var limit   = (($("#itemv2").val()*2)-2);
  var value   = $(this).val();
  var current = value.length;
  var ultimaletra = value.substr(current-1); 

  if (limit < current) { 
   $(this).val(value.substring(0, limit));
 }else{

  if (ultimaletra >= 1 && ultimaletra <= 5) {
    if (limit != current) {
      var concate = $(this).val() +','; 
    }else{
      var concate = $(this).val();
    }

    $(this).val(concate);
  }else{
    $(this).val(value.substring(0, (current-1)));
  }

} 
});



$("#variable").keyup(function(){
  if($(this).val() > 2){
    $(this).val(2);
  }
  if($(this).val() == 2){
    document.getElementById('segundavariable').style.display = 'block';
    $('#itemv2').prop("required", true);
    $('input[id="nombre_escalav2[]"]').map(function ( n, i) {
      $(this).prop("required", true);
    }).get();
    $('input[id="nombre_respuestav2[]"]').map(function ( n, i) {
      $(this).prop("required", true);
    }).get();
    $('#numerosvariable').prop("required", false);
  }else{
    document.getElementById('segundavariable').style.display = 'none';
    $('#itemv2').removeAttr("required");
    $('input[id="nombre_escalav2[]"]').map(function ( n, i) {
      $(this).removeAttr("required");
    }).get();
    $('input[id="nombre_respuestav2[]"]').map(function ( n, i) {
      $(this).removeAttr("required");
    }).get();
    $('#numerosvariable').removeAttr("required");
  }
});
$("#variable").change(function(){
  if($(this).val() > 2){
    $(this).val(2);
  }
  if($(this).val() == 2){
    document.getElementById('segundavariable').style.display = 'block';
    $('#itemv2').prop("required", true);
    $('input[id="nombre_escalav2[]"]').map(function ( n, i) {
      $(this).prop("required", true);
    }).get();
    $('input[id="nombre_respuestav2[]"]').map(function ( n, i) {
      $(this).prop("required", true);
    }).get();
    $('#numerosvariable').prop("required", true);
  }else{
    document.getElementById('segundavariable').style.display = 'none';
    $('#itemv2').removeAttr("required");
    $('input[id="nombre_escalav2[]"]').map(function ( n, i) {
      $(this).removeAttr("required");
    }).get();
    $('input[id="nombre_respuestav2[]"]').map(function ( n, i) {
      $(this).removeAttr("required");
    }).get();
    $('#numerosvariable').removeAttr("required");
  }
});

$("#escala").keyup(function(){

  html="";
  html1="";
  for (i = 0; i < $(this).val(); i++) { 
    html += "<label class='control-label col-lg-6'>nombre escala"+(i+1)+"</label> <div class='col-lg-6'><input type='text'  name='nombre_escala[]' id='nombre_escala[]' class='form-control' required ></div>";
    html1 += "<label class='control-label col-lg-6'>nombre escala"+(i+1)+"</label> <div class='col-lg-6'><input type='text'  name='nombre_escalav2[]' id='nombre_escalav2[]' class='form-control' ></div>";
  }
  $("#respuesta_escala").empty().append(html);
  $("#respuesta_escalav2").empty().append(html1);
});

$("#escala").change(function(){

  html="";
  html1="";
  for (i = 0; i < $(this).val(); i++) { 
    html += "<label class='control-label col-lg-6'>nombre escala"+(i+1)+"</label> <div class='col-lg-6'><input type='text'  name='nombre_escala[]' id='nombre_escala[]' class='form-control' required></div>";
    html1 += "<label class='control-label col-lg-6'>nombre escala"+(i+1)+"</label> <div class='col-lg-6'><input type='text'  name='nombre_escalav2[]' id='nombre_escalav2[]' class='form-control' ></div>";
  }
  $("#respuesta_escala").empty().append(html);
  $("#respuesta_escalav2").empty().append(html1);
});

$("#respuesta").keyup(function(){ 

  html="";
  html1="";
  for (i = 0; i < $(this).val(); i++) { 
    html += "<label class='control-label col-lg-3'>Resp :"+(i+1)+"</label> <div class='col-lg-9'><input type='text'  name='nombre_respuesta[]' id='nombre_respuesta[]' class='form-control' required></div>";
    html1 += "<label class='control-label col-lg-3'>Resp :"+(i+1)+"</label> <div class='col-lg-9'><input type='text'  name='nombre_respuestav2[]' id='nombre_respuestav2[]' class='form-control'></div>";

  }
  if($("#respuesta").val() == 2){
    document.getElementById('respuesta2').style.display = 'block';
  }else{      
    document.getElementById('respuesta2').style.display = 'none';
  }
  $("#respuesta_numero").empty().append(html);
  $("#respuesta_numerov2").empty().append(html1);
});

$("#respuesta").change(function(){ 

  html="";
  html1="";
  for (i = 0; i < $(this).val(); i++) { 
    html += "<label class='control-label col-lg-3'>Resp :"+(i+1)+"</label> <div class='col-lg-9'><input type='text'  name='nombre_respuesta[]' id='nombre_respuesta[]' class='form-control' required></div>";
    html1 += "<label class='control-label col-lg-3'>Resp :"+(i+1)+"</label> <div class='col-lg-9'><input type='text'  name='nombre_respuestav2[]' id='nombre_respuestav2[]' class='form-control' ></div>";

  }
  $("#respuesta_numero").empty().append(html);
  $("#respuesta_numerov2").empty().append(html1);
});

function cal_cant()
{

 var porcentaje= [];
 var cantidad=[];
 c=0;
 sum=0;
 estado=0;
 total=0;
 $('input[name="cantidad[]"]').map(function ( n, i) {
  cantidad[n]=$(this);        
}).get();
 $('input[name="porcentaje[]"]').map(function ( n, i) {
   porcentaje[n]=$(this);
 }).get();
 $('input[name="porcentaje[]"]').map(function ( n, i) {
  if(n!=parseFloat($("#escala").val())-1){
    if($(this).val()!=""){
      c=c+1;

      if(c==parseFloat($("#escala").val())-1)
      { 
       sum+=parseFloat($(this).val()); 
       estado=1;
       cantidad[n].val(Math.round(parseFloat($(this).val()/100)*parseFloat($("#muestra").val())));
     }
     else{
       cantidad[n].val(Math.round(parseFloat($(this).val()/100)*parseFloat($("#muestra").val())));
       sum+=parseFloat($(this).val());
     }
     total+=parseFloat(cantidad[n].val());

   }
 }
 if(n==parseFloat($("#escala").val())-1){
  if(estado==1){

    $(this).val(100-sum); 
    cantidad[n].val(parseFloat($("#muestra").val()-total));

  }
}
}).get();

}



function variable()
{
 html="";
 data1="";
 data2="";
 for (var i =1;  i <= $("#variable").val(); i++) {

  data1+="<input  value='' type='text' class='form-control'  placeholder='Nombre Variable"+i+"' id='nombre_dimension[]' name='nombre_dimension[]' required>";
  data2+="<input  value='' type='text' class='form-control' id='numero_indicador[]' name='numero_indicador0[]' onkeyup='generar_indicador()' required>";    
}

html+='<div class="row"><div class="col-md-10"><h6>Nombre variables</h6>'+data1+'</div>';
html+='<div class="col-md-2"><h6>dim.</h6>'+data2+'</div></div>';

$("#crear_cabezera").empty().append(html);
}


function generar_indicador()
{
 html="";
 html1="";
 con=0;
 band = 0;
 $('input[id="numero_indicador[]"]').map(function ( n, i1){
  if($(this).val()!=""){
    band++;
  }
}).get();
 

 if ( band == $("#variable").val() ){
  $('input[id="numero_indicador[]"]').map(function ( n, i1){
   if($(this).val()!="")
   {
     data1="";
     data2="";
     data3="";
     data4="";

     for (var i =1;  i <=$(this).val(); i++) 
     {

      data1+="<input  type='text' value=''  class='form-control' id='nombre_indicador[]' name='nombre_indicador[]' required>";
      data2+="<input  value='' type='text' class='form-control' id='numero_pregunta[]' onkeyup='cal_preg();generar_preguntas();generar_conca();' name='numero_pregunta"+n+"[]'  required>";

    }

    html+='<div class="row"><div class="col-md-10"><FONT SIZE="2">Nombre de las dimensiones para la V. '+(n+1)+'</FONT>'+data1+'</div>';
    html+='<div class="col-md-2"><FONT SIZE="2">preg.</FONT>'+data2+'</div></div>';
  }
}).get();
  $("#crear_dimension").empty().append(html);
  data3+="<input  value='Dimension 1' type='hidden' class='form-control' id='nombre_variable[]' name='nombre_variable[]' required>";
  data4+="<input  value='1' type='hidden' class='form-control' id='numero_dimension[]' name='numero_dimension[]' required>";
  html1+=data3;
  html1+=data4;
  $("#crear_indicador").empty().append(html1);
}
if( band == 0){
  $("#crear_dimension").empty();
  $("#crear_indicador").empty();
  $("#crear_preguntas").empty();
  $("#crear_conca").empty();
}


}

function cal_preg(){
  var numero_indicador=[];
  var numero_pregunta=[];

  sum=0;
  sum1=0;
  estado=0;
  condici =0;
  condici1 =0;
  ayuda = 0;
//cantidad[n]=$(this);



$('input[id="numero_pregunta[]"]').map(function ( n, i) {
  numero_pregunta[n] = $(this);
  ayuda = ayuda + $(this).val();
}).get();

$('input[id="numero_indicador[]"]').map(function ( n1, i) {
  numero_indicador[n1]= $(this).val();
  total=0;
  total1=0;
  sum=0;
  sum1=0;
  c=0;
  
  $('input[id="numero_pregunta[]"]').map(function ( n, i) {  
    if (n1 == 0 && n < numero_indicador[n1] && $(this).val()!="") {

     if(n!=parseFloat(numero_indicador[n1])-1){
      if($(this).val()!=""){
        c=c+1;
        if(c==parseFloat(numero_indicador[n1])-1)
        { 
          sum+=parseFloat($(this).val()); 
          estado=1;
          numero_pregunta[n].val(Math.round(parseFloat($(this).val())));
        }
        else{
         numero_pregunta[n].val(Math.round(parseFloat($(this).val())));
         sum+=parseFloat($(this).val());
       }
       total+=parseFloat(numero_pregunta[n].val());

     }
   }

   if(estado==1){             
    numero_pregunta[n+1].val(parseFloat($("#item").val()-total));
    condici = parseFloat($("#item").val()-total);
    estado = 0;
  }
  if(condici < 0 ){
    alert('Distribucion incorrecta, vuelva a distribuir los datos!');
    $('input[id="numero_pregunta[]"]').map(function ( n1, i1) {
      numero_pregunta[n].val(0);
    }).get();
  }

}

if (n1 == 1 && n >= numero_indicador[0] && $(this).val()!="" ) {

 if(n!=parseFloat(numero_indicador[n1] + numero_indicador[0])-1){
  if($(this).val()!=""){
    c=c+1;
    if(c==parseFloat(numero_indicador[n1])-1)
    { 
      sum1+=parseFloat($(this).val()); 
      estado=1;
      numero_pregunta[n].val(Math.round(parseFloat($(this).val())));
    }
    else{
     numero_pregunta[n].val(Math.round(parseFloat($(this).val())));
     sum1+=parseFloat($(this).val());

   }
   total1+=parseFloat(numero_pregunta[n].val());
 }
}
if(estado==1){             
  numero_pregunta[n+1].val(parseFloat($("#itemv2").val()-total1));
  condici1 = parseFloat($("#item").val()-total);
  estado = 0;
}
if(condici1 < 0 ){
  alert('Distribucion incorrecta, vuelva a distribuir los datos!');
  $('input[id="numero_pregunta[]"]').map(function ( n1, i1) {
    numero_pregunta[n1].val(0);
  }).get();
}
}

}).get();

}).get();
}

function generar_preguntas(){
  var items = $("#item").val();
  html="";
  var numero_pregunta=[];
  var nombre_indicador = [];
  band = 0;
  suma = 0;
  $('input[id="numero_pregunta[]"]').map(function ( n, i1){
    if($(this).val()!=""){
      band++;
    }
  }).get();

  $('input[id="numero_indicador[]"]').map(function ( n, i1){
    suma =parseInt($(this).val()) + parseInt(suma);
  }).get();
  if ( band == suma ){

    $('input[id="nombre_indicador[]"]').map(function ( n, i) {
      nombre_indicador[n] = $(this).val();
    }).get();

    $('input[id="numero_pregunta[]"]').map(function ( n1, i1) {
      if($(this).val()!=""){
        data1="";
        data2="";
        for (var i =1;  i <=$(this).val(); i++){
          data1+="<textarea  value='' rows='2' cols='5' class='form-control' id='nombre_pregunta' name='nombre_pregunta[]' required></textarea>";
        }   
        html+='<div class="row"><div class="col-md-12"><FONT SIZE="2">'+nombre_indicador[n1]+' - (Variable)</FONT>'+data1+'</div>';
        html+='</div>';
      }
    }).get();
    $("#crear_preguntas").empty().append(html);
  }
  if( band == 0){
    $("#crear_preguntas").empty();
    $("#crear_conca").empty();
  }

}

function generar_conca(){
  var items = $("#item").val(); 
  html=""; 
  var numero_pregunta=[];
  var nombre_indicador = [];
  $('input[id="nombre_indicador[]"]').map(function ( n, i) {
    nombre_indicador[n] = $(this).val();
  }).get();
  band = 0;
  suma = 0;
  $('input[id="numero_pregunta[]"]').map(function ( n, i1){
    if($(this).val()!=""){
      band++;
    }
  }).get();

  $('input[id="numero_indicador[]"]').map(function ( n, i1){
    suma =parseInt($(this).val()) + parseInt(suma);
  }).get();

  if ( band == suma ){
    $('input[id="numero_pregunta[]"]').map(function ( n1, i1) {
      if($(this).val()!=""){
        data1="";
        data2="";
        for (var i =1;  i <=$(this).val(); i++){
          data1+="<textarea  value='' rows='2' cols='5' class='form-control' id='nombre_conca' name='nombre_conca[]' required></textarea>";
        }   
        html+='<div class="row"><div class="col-md-12"><FONT SIZE="2">'+nombre_indicador[n1]+' (variable para interpretación) </FONT>'+data1+'</div>';
        html+='</div>';
      }
    }).get();
    $("#crear_conca").empty().append(html);
  }  
  if( band == 0){
    $("#crear_preguntas").empty();
    $("#crear_conca").empty();
  }
}

function cantidad()
{
  respuesta=0;
  max=parseFloat($("#respuesta").val());  
  switch (max) {
    case 1:
    return 1 ;
    break;
    case 2:
    return 1;
    break;
    case 3:
    return 1;
    break;
    case 4:
    return 1;
    break;
    case 5:
    return 1;

    break;
    
  }

}
</script>

<script>
  var datos_matriz={};
  function matriz(){
     coeficiente = 0;
     bandera = 0;

      do{


        var deficit= [];
        var nombre_escala1 = [];
        nombre_escala = 0;
        num_deficit=0;
        contad = 0;
        var desde = [];
        var hasta = [];
        var cantidad = [];

        for(var i=1; i<= $("#item").val();  i++){
          deficit[i]= $('input:radio[name=desficiente'+i+']:checked').val();

          if($('input:radio[name=desficiente'+i+']:checked').val()==1){
            num_deficit+=1;
          }
        }    
        var muestra1 = []; 
        $('input[name="desde[]"]').map(function ( n, i1){
          desde[n] = $(this).val();
        }).get();
        $('input[name="hasta[]"]').map(function ( n, i1){
          hasta[n] = $(this).val();
        }).get();
        $('input[name="cantidad[]"]').map(function ( n, i1){
          cantidad[n] = $(this).val();
        }).get();
        $('input[id="nombre_escala[]"]').map(function ( n, i1){
          nombre_escala1[n] = $(this).val();
        }).get();    

        excel =  {};
        var valrespues = $('input:radio[name=valorresp]:checked').val();
        contacant = new Array();
        cant = $("#escala").val();
        var cant1;
        cant1 = parseInt(cant) - 1;
        ordenalea=[];
        ordenaleayuda=[];
        for (var i=0; i <$("#muestra").val() ; i++) { 

          excel[i] = new Array();
          num_a=0;
          num_aleatorio=0;
          can=0;
          data=[];
          apoyo=[];   
          do{         
            num_a= Math.round(Math.random() * (cant1 - 0) + 0);
            ordenalea[i] = num_a;
            ordenaleayuda[i] = num_a;
            if(parseInt($("#respuesta").val()) != 2){
              data=generar_matriz(desde[num_a],hasta[num_a],$("#item").val(),$("#respuesta").val(),deficit,cant,num_a,num_deficit,1);
            }else{
              if(parseInt(valrespues) == 1){
                data=generar_matriz(desde[num_a],hasta[num_a],$("#item").val(),$("#respuesta").val(),deficit,cant,num_a,num_deficit,1);
              }else{
                data=generar_array(desde[num_a],hasta[num_a],$("#item").val(),$("#respuesta").val(),deficit,cant,num_a,num_deficit,valrespues);
              }
              
            }      
            nombre_escala = nombre_escala1[num_a];
            can=cantidad[num_a];
            if (typeof(data.length) === "undefined") {
              break;
            }
          }while(can==0); 
          if(typeof(data.length) === "undefined"){
            break;
          }else{
              cantidad[num_a]=can-1;
              suma = 0; 
              for (var j=0; j <=(parseFloat($("#item").val())+1) ; j++) {
                if(j==0){
                  excel[i][j] = $("#nommuestra").val()+ ' ' + (i+1);
                }else{
                  if(j==$("#item").val()+1){
                   excel[i][j]=data[j-1];
                   excel[i][j+1]=nombre_escala;
                 }else{
                  excel[i][j]=data[j-1];
                  suma = suma + data[j-1];
                }              
              }     
            }        
          }

      }  
    if(typeof(data.length) === "undefined"){
      alert('Se tuvo que cancelar la generación de aleatorios D:');
      break;
    }
      excel2 = {};
      desdev2 = [];
      hastav2 = [];
      alto = [];

      if ($("#variable").val() == 2) {
     //   if( $("#escala").val() == 3 ){
     //     var porcen = ((Math.round(Math.random() * (10 - 10) + 10))/100); 
     //   }else{
     //      if( $("#escala").val() == 4 ){
     //       var porcen = ((Math.round(Math.random() * (20 - 20) + 20))/100); 
     //      }else{
     //         if( $("#escala").val() == 2 ){
     //           var porcen = ((Math.round(Math.random() * (5 - 5) + 5))/100);
     //         }else{
     //           var porcen = ((Math.round(Math.random() * (30 - 30) + 30))/100);
     //         }
      //     }
     //      
     //   }
     //   

        var porcen = parseFloat(parseInt($("#porcentajevar").val()) /100);
        console.log("el porcentaje es:" +porcen);
        var porcentaje = parseInt($("#muestra").val() * porcen);
        var inicial = parseInt($("#escala").val()/2);
        var iniciador = 1;
        var contador = 1;
        var porinicial = parseInt(parseInt(porcentaje) / inicial);
        for (var i = 1; i <= inicial; i++) {  
          banderapor = cantidad[iniciador];     
          for(var j = 1;j<= $("#muestra").val() ;j++){
            if(parseInt($("#escala").val()) % 2 != 0){
              var aleatorionum = (Math.round(Math.random() * (2 - 1) + 1));
              if (parseInt(aleatorionum) == 2) {
                aleatorionum = -1;
              }
            }else{
              aleatorionum = -1;
            }
            
            num_ayuda = ordenalea[j];
            if( (num_ayuda == iniciador) && (contador <= porinicial)  ){
              ordenaleayuda[j] =  num_ayuda+aleatorionum;
              contador++;
              banderapor=banderapor-1;
            }
          }
          
          contador = 1;
          iniciador = iniciador + 2;
        }


        var valor = $('input:radio[name=relacionversa]:checked').val();
        var nombre_escala1 = [];
        var j=0;
        var deficitv2= [];
        var inverso= [];
        for(var i=1; i<= $("#item").val();  i++){
          deficitv2[i] = 0;
        }
        for(var i=1; i<= $("#escala").val();  i++){
          inverso[i-1] = parseFloat($("#escala").val()) - i;
        }

        $('input[id="nombre_escalav2[]"]').map(function ( n, i1){
          nombre_escala1[n] = $(this).val();
        }).get();   
        maximo=parseFloat($("#respuesta").val())*parseFloat($("#itemv2").val());
        minimo=parseFloat($("#itemv2").val());
        rango=maximo-minimo;
        amplitud=Math.round(rango/parseFloat($("#escala").val()));
        $('input[id="nombre_escala[]').map(function ( n, i) {
        j = n;
        desdev2[n] = minimo;
        hastav2[n] = minimo+(amplitud-1);
        minimo = minimo+amplitud;
        }).get();
        hastav2[j] = maximo;
        for (var i=0; i <$("#muestra").val() ; i++) { 
          data=[];
            if (valor == 0) {
              num_a = ordenaleayuda[i];
            }else{
              //num_a = ordenaleayuda[i];
              num_a = inverso[ordenaleayuda[i]];
            }
            
            if(parseInt($("#respuesta").val()) != 2){
              data=generar_matriz(desdev2[num_a],hastav2[num_a],$("#itemv2").val(),$("#respuesta").val(),deficitv2,cant,num_a,num_deficit,2);
            }else{
              if(parseInt(valrespues) == 1){
                data=generar_matriz(desdev2[num_a],hastav2[num_a],$("#itemv2").val(),$("#respuesta").val(),deficitv2,cant,num_a,num_deficit,2);
              }else{
                data=generar_array(desdev2[num_a],hastav2[num_a],$("#itemv2").val(),$("#respuesta").val(),deficitv2,cant,num_a,num_deficit,valrespues);
              }
            }
            if (typeof(data.length) === "undefined") {
              break;
            }
            var nombre_escala = nombre_escala1[num_a];
            suma = 0;
            excel2[i] = new Array();
            for (j=0; j <= $("#itemv2").val() ; j++) {
              if(j==0){
                excel2[i][j]= $("#nommuestra").val()+' '+(i+1);
              }

              else{
                if(j==($("#item").val()+1)){
                 excel2[i][j]=data[j-1];
               }else{
                 excel2[i][j]=data[j-1];
                 suma = parseInt(suma) + parseInt(data[j-1]);
               }                
             }  
           }  
           excel2[i][j]=suma;
        }
      }
        meno = parseFloat(0.78);
        mayo = parseFloat(0.93);
      if ($("#variable").val() == 2) {
        coeficiente = parseFloat(parseFloat(calculate(excel,excel2,$("#muestra").val(),$("#item").val(),$("#itemv2").val())).toFixed(2));
        console.log(coeficiente);
        if (valor == 1) {
         coeficiente = coeficiente*(-1);
        }
        if (bandera == 50) {
          if (coeficiente < meno) {
            alert("No hemos podido encontrar una relacion, por favor ingrese un porcentaje menos al que ingreso !!!");
          }else{
            alert("No hemos podido encontrar una relacion, por favor ingrese un porcentaje mayor al que ingreso !!!");
          }
          break;
        }
        bandera++;
      }else{
        coeficiente = parseFloat(0.85)
      }

    }while( (coeficiente < meno ) || (coeficiente > mayo)  );
//return excel,excel2;
        if (valor == 1) {
         coeficiente = coeficiente*(-1);
        }
if((typeof(data.length) !== "undefined") && (bandera != 50)){
    datos_matriz["excel1"]=excel;
    datos_matriz["excel2"]=excel2;
    datos_matriz["datos"]=$("#formulario").serialize();

    var $mensaje = "El coeficiente de relación encontrado fue de "+coeficiente +"   ¿Está seguro de Generar la Tabulación,con este valor encontrado?";
    var $form = $('<div></div>');
    $form.append('<p>'+$mensaje+'</p>');

    BootstrapDialog.show({
      title: 'Consulta',
        //type: BootstrapDialog.TYPE_DANGER,
        size: BootstrapDialog.SIZE_SMALL,
        message: $form,
        autospin: true,
        buttons: [{
          label: 'Sí,Continuar',
          cssClass: 'btn-primary',
          autospin: true,
          action: function(dialogRef){

            dialogRef.enableButtons(false);
            dialogRef.setClosable(false);

            url = base_url+"Tabulacion/procesamiento";

            $.post(url,JSON.stringify(datos_matriz), function(respuesta){

              dialogRef.close();

              var titulo = "Reporte Turno";
              var mensaje = "";
              var tipo_mensaje = "";
              var $form = $('<div></div>');

              if(respuesta == '1'){
                mensaje = "Se ha creado el las tabulaciones correctamente.";
                tipo_mensaje = BootstrapDialog.TYPE_SUCCESS;

                var $a = $("<a>");
                window.location.assign(base_url+"descargar/Tabulaciones.zip");

                $form.append('<p>'+mensaje+'</p>');                 
                $form.append($a);   

                var nombre_archivo = "Generación_Tabulación"  + ".zip";

                $a.attr("download",nombre_archivo);
                $a[0].click();
                $a.remove();

                console.log(respuesta.log);


              } else {
                mensaje = "Se ha producido un error al crear las tabulaciones.";
                tipo_mensaje = BootstrapDialog.TYPE_DANGER;

                $form.append('<p>'+mensaje+'</p>'); 
              }

              BootstrapDialog.show({
                title: titulo,
                type: tipo_mensaje,
                message: $form,
                buttons: [{
                  label: 'Cerrar',
                  action: function(dialogRef){
                    dialogRef.close();
                  }
                }]
              });

            },'json').fail(function(){

              dialogRef.close();

              var titulo = "Tabulacion";
              var mensaje = "";
              var tipo_mensaje = "";
              var $form = $('<div></div>');

              mensaje = "Se ha producido un error al crear las tabulaciones.";
              tipo_mensaje = BootstrapDialog.TYPE_DANGER;
              $form.append('<p>'+mensaje+'</p>'); 

              BootstrapDialog.show({
                title: titulo,
                type: tipo_mensaje,
                message: $form,
                buttons: [{
                  label: 'Cerrar',
                  action: function(dialogRef){
                    dialogRef.close();
                  }
                }]
              });

            });
            return; 
          }
        },
        {
          label: 'Regresar',
          action: function(dialogRef){
            dialogRef.close();

          }
        }]      
      }); 
  }
}









function traerinverso(num_noinv,item){

}

function insertionSort( ordenar,ordenar1 ) {
  var size = ordenar.length,slot,ayuda,tmp;
  metodo = new Array();
  metodo[0] = new Array();
  metodo[0] = ordenar;
  metodo[1] = new Array();
  metodo[1] = ordenar1;
        for ( var item = 0; item < size; item++ ) { // outer loop   
          tmp = ordenar[item];
          for ( slot = item - 1; slot >= 0 && ordenar[slot] > tmp; slot-- ){ 
            ordenar[ slot + 1 ] = ordenar[slot];
            metodo[1][slot + 1] = metodo[1][slot]  ;  
          }
          ordenar[ slot + 1 ] = tmp;
          metodo[0][slot + 1] = ordenar[ slot + 1 ];
          metodo[1][slot + 1] = item;
        }
        return metodo;
      }; 


    
function generar_arrayapoyo(tam){
  data = [];
  suma = 0;
  for (var i=0; i <tam ; i++){
    data[i]= parseFloat((Math.random() * (2 - 1) + 1).toFixed(2));
    suma = parseFloat(suma) + parseFloat(data[i]);
  }
    data[i] = parseFloat(suma.toFixed(2));
  return data;
}

function calculate(excel=[],excel2=[],muestra,item,itemv2)
{
  var aa = 0;
  var bb = 0;
  var cc = 0;
  var dd = 0;
  var ee = 0;
  var item = parseInt(item) + 1;
  var itemv2 = parseInt(itemv2) + 1;
  for(var y=0; y<muestra; y++)
  {
    
    var a = excel[y][item];
    var b = excel2[y][itemv2];;
    aa = aa + parseFloat(a);
    bb = bb + parseFloat(b);
    cc = cc + (a*b);
    dd = dd + (a*a); 
    ee = ee + (b*b); 
    var f = ((muestra*dd)-(aa*aa))*((muestra*ee)-(bb*bb));
    var ff = ((muestra*cc)-(aa*bb))/Math.sqrt(f); 

    var ff1 = (ff*100000)/100000;
  
    
  }
  return ff1;
  
}

function generar_matriz(desde,hasta,tam,max, deficit=[],cant,num_a,num_deficit,numero){
  var max = parseInt(max);
  var ayudax = 0;
  do{
    sum=0;
    aleatoriosgeneral=0;
    numerogenerado=0;
    apoyo=[];
    apoyo = generar_arrayapoyo(tam);
    aleatoriosgeneral= Math.round(Math.random() * (parseInt(hasta) - parseInt(desde)) + parseInt(desde));

    data = [];
    for (var i=0; i <tam ; i++){
       if(deficit[i+1]==0){
        numerogenerado = ((parseFloat(apoyo[i])/parseFloat(apoyo[parseInt(tam)]))*aleatoriosgeneral).toFixed(0);
        if (parseFloat(numerogenerado) > parseFloat(max)){
          numerogenerado = parseFloat(max);
        }
        if(parseFloat(numerogenerado) < 1){
          numerogenerado = 1;
        }
        data[i]=numerogenerado;
       }else{
        dat=generar_deficit(max);
        data[i]=Math.round(Math.random() * (dat - 1) + 1);
       }
       sum+= parseFloat(data[i]);
    }
    data[i] = sum;
    ayudax++;
    if(ayudax==90000){
      alert('Al parecer estamos llegando al limite, es posible que las tabulaciones no se generen :( !!!');
    }
    if(ayudax>=100000){
    alert('Se supero el limite maximo de posibilidades, hicimos lo que pudimos!!!');
    return 0;
    }
  }while((sum<desde || sum>hasta)) ; 

  if(ayudax>=100000){
    alert('Se supero el limite maximo de posibilidades, hicimos lo que pudimos!!!');
    return 0;
  }else{
    return data;
  }
  
}
    function generar_array(desde,hasta,tam,max, deficit=[],cant,num_a,num_deficit,valrespues){
      var max = parseInt(max);
      var valrespues = parseFloat(valrespues);
      var ayudax = 0;
      switch(max) {
    case 2:
    if(parseInt(valrespues) == 0){
      do{ 
        sum=0;
        data = [];
        for (var i=0; i <parseInt(tam) ; i++){
          if(deficit[i+1]==0){
            if(parseInt(cant) == 3){
              rand = Math.round(Math.random() * (1 - 0) + 0); 
              if(num_a == 0){
                if(rand != 0 ){
                  data[i]= Math.round(Math.random() * (0 - 0) + 0);  
                }else{
                  data[i]= Math.round(Math.random() * (1 - 0) +0);
                }              
              }
              if(num_a ==1){
                if(rand > 0 ){
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }else{
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }            
              }
              if(num_a == 2){
                if(rand > 0 ){
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }else{
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }           
              }            
            }
            if(parseInt(cant) == 2){
              rand = Math.round(Math.random() * (3 - 1) + 1);
              if(num_a == 0){
                if(rand != 1 ){
                  data[i]= Math.round(Math.random() * (0 - 0) + 0);
                }else{
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }                 
              }
              if(num_a == 1){
                if(rand > 1 ){
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);

                }else{
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }
              } 
            }
            if(parseInt(cant) == 4){
              rand = Math.round(Math.random() * (3 - 1) + 1);
              if(num_a == 0){
                if(rand < 3 ){
                  data[i]= Math.round(Math.random() * (0 - 0) + 0);
                }else{
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }                 
              }
              if(num_a == 1){
                if(rand > 1 ){
                  data[i]= Math.round(Math.random() * (0 - 0) + 0);
                }else{
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }
              }
              if(num_a == 2){
                if(rand < 2 ){
                  data[i]= Math.round(Math.random() * (0 - 0) + 0);
                }else{
                  data[i]= Math.round(Math.random() * (1 - 0) + 0);
                }                 
              }
              if(num_a == 3){
                if(rand < 3  ){
                  data[i]=Math.round(Math.random() * (1 - 0) + 0); 
                }else{
                  data[i]= Math.round(Math.random() * (0 - 0) + 0);
                }
              } 
            }
              if(parseInt(cant) == 5){
                rand = Math.round(Math.random() * (5 - 1) + 1);
                if(num_a == 0){
                  if(rand < 5 ){
                    data[i]= Math.round(Math.random() * (0 - 0) + 0);
                  }else{
                    data[i]= Math.round(Math.random() * (1 - 0) + 0);
                  }                 
                }
                if(num_a == 1){
                  if(rand < 4 ){
                    data[i]= Math.round(Math.random() * (0 - 0) + 0);
                  }else{
                    data[i]= Math.round(Math.random() * (1 - 0) + 0);
                  }
                }
                if(num_a == 2){
                  if(rand < 3 ){
                    data[i]= Math.round(Math.random() * (0 - 0) + 0);
                  }else{
                    data[i]= Math.round(Math.random() * (1 - 0) + 0);
                  }                 
                }
                if(num_a == 3){
                  if(rand < 2 ){
                    data[i]=Math.round(Math.random() * (0 - 0) + 0); 
                  }else{
                    data[i]= Math.round(Math.random() * (1 - 1) + 1);
                  }
                }
                if(num_a == 4){
                  if(rand = 1  ){
                    data[i]=Math.round(Math.random() * (0 - 0) + 0); 
                  }else{
                    data[i]= Math.round(Math.random() * (1 - 1) + 1);
                  }
                } 
              }
          }else{
            dat=generar_deficit(max);
            data[i]=Math.round(Math.random() * (0 - 0) + 0);
          }
          sum+= data[i];
        }

        data[i] = sum;
        ayudax++;
        console.log(ayudax);
        if(ayudax==50000){
          alert('Al parecer estamos llegando al limite, es posible que las tabulaciones no se generen :( !!!');
        }
        if(ayudax>=70000){
        alert('Se supero el limite maximo de posibilidades, hicimos lo que pudimos!!!');
        return 0;
        }
      } while(sum<desde || sum>hasta); 
        if(ayudax>=70000){
          alert('Se supero el limite maximo de posibilidades, hicimos lo que pudimos!!!');
          return 0;
        }else{
          return data;
        }

    }else{

      do{ 
        console.log(ayudax);
        sum=0;
        data = [];
        for (var i=0; i <tam ; i++){
          if(deficit[i+1]==0){
            if(cant == 3){
              rand = Math.round(Math.random() * (2 - 1) + 1); 
              if(num_a == 0){
                if(rand != 1 ){
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);  
                }else{
                  data[i]= Math.round(Math.random() * (2 - 1) +1);
                }              
              }
              if(num_a ==1){
                if(rand > 1 ){
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }else{
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }            
              }
              if(num_a == 2){
                if(rand > 1 ){
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }else{
                  data[i]= Math.round(Math.random() * (2 - 2) + 2);
                }  
                  
              }            
            }
            if(cant == 2){
              rand = Math.round(Math.random() * (3 - 1) + 1);
              if(num_a == 0){
                if(rand != 1 ){
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }else{
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }                 
              }
              if(num_a == 1){
                if(rand > 1 ){
                  data[i]= Math.round(Math.random() * (2 - 2) + 2);

                }else{
                  data[i]= Math.round(Math.random() * (2 - 2) + 2);
                }
              } 
            }
            if(cant == 4){
              rand = Math.round(Math.random() * (3 - 1) + 1);
              if(num_a == 0){
                if(rand < 3 ){
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }else{
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }                 
              }
              if(num_a == 1){
                if(rand > 1 ){
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }else{
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }
              }
              if(num_a == 2){
                if(rand < 2 ){
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }else{
                  data[i]= Math.round(Math.random() * (2 - 1) + 1);
                }                 
              }
              if(num_a == 3){
                if(rand < 3  ){
                  data[i]=Math.round(Math.random() * (2 - 1) + 1); 
                }else{
                  data[i]= Math.round(Math.random() * (1 - 1) + 1);
                }
              } 
            }
              if(parseInt(cant) == 5){
                rand = Math.round(Math.random() * (5 - 1) + 1)
                if(num_a == 0){
                  console.log("xxx"+1);
                  if(rand < 5 ){
                    data[i]= Math.round(Math.random() * (1 - 1) + 1);
                  }else{
                    data[i]= Math.round(Math.random() * (2 - 1) + 1);
                  }                 
                }
                if(num_a == 1){
                  console.log("xxx"+2);
                  if(rand < 4 ){
                    data[i]= Math.round(Math.random() * (1 - 1) + 1);
                  }else{
                    data[i]= Math.round(Math.random() * (2 - 1) + 1);
                  }
                }
                if(num_a == 2){
                  console.log("xxx"+3);
                  if(rand < 3 ){
                    data[i]= Math.round(Math.random() * (1 - 1) + 1);
                  }else{
                    data[i]= Math.round(Math.random() * (2 - 1) + 1);
                  }                 
                }
                if(num_a == 3){
                  console.log("xxx"+4);
                  if(rand < 3 ){
                    data[i]=Math.round(Math.random() * (1 - 1) + 1); 
                  }else{
                    data[i]= Math.round(Math.random() * (2 - 2) + 2);
                  }
                }
                if(num_a == 4){
                  console.log("xxx"+rand+5);
                  if(rand < 5  ){
                    data[i]=Math.round(Math.random() * (2 - 2) + 2); 
                  }else{
                    data[i]= Math.round(Math.random() * (2 - 1) + 1);
                  }
                } 
              }
          }else{
            dat=generar_deficit(max);
            data[i]=Math.round(Math.random() * (dat - 1) + 1);
          }
          sum+= data[i];
        }
        ayudax++;
        console.log(num_a);
        console.log(data);
        console.log(sum); 
        if(ayudax==50000){
          alert('Al parecer estamos llegando al limite, es posible que las tabulaciones no se generen :( !!!');
        }
        if(ayudax>=70000){
        alert('Se supero el limite maximo de posibilidades, hicimos lo que pudimos!!!');
        return 0;
        }
        data[i] = sum;
      } while(sum<desde || sum>hasta); 
        if(ayudax>=70000){
          alert('Se supero el limite maximo de posibilidades, hicimos lo que pudimos!!!');
          return 0;
        }else{
          return data;
        }
    }

    break;
  }
  return data;
} 

function generar_deficit(max){

  respuesta=0;

  switch (parseInt(max)) {
    case 1:
    return 1 ;
    break;
    case 2:
    return 1;
    break;
    case 3:
    return 1;
    break;
    case 4:
    return 2;
    break;
    case 5:
    return 3;
    break;
    case 6:
    return 3;
    break;
    case 7:
    return 4;
    break;
    case 8:
    return 4;
    break;
    case 9:
    return 5;
    break;
    case 10:
    return 5;
    break;
    
  }

}

// var matrices = matriz();

$(document).ready(function () {

    $('#formulario').validate({ // initialize the plugin
      rules: {
        muestra: {
          required: true
        },
        item: {
          required: true
        },
        variable: {
          required: true
        },
        nommuestra: {
          required: true
        },
        escala: {
          required: true
        },
        respuesta: {
          required: true
        },
        cantidad: {
          required: true
        },
        'cantidad[]': {
          required: true
        },
        'nombre_pregunta[]': {
          required: true
        }
      },
      messages :{
        muestra : {
          required : 'Ingrese muestra correcta'
        }
      },
        submitHandler: function (form) { // for demo
         var matrices = matriz();
       }
     });

  });
function ver_data()
{
 $("#modal_mini").modal();
}


$("#subir_datos").click(function(){
 $('#subir_datos').attr("disabled", true);
   var formData= new FormData();
      formData.append('archivo', $('input[name=archivo]')[0].files[0]); 

          
        ruta="<?php echo base_url(); ?>Tabulacion/subir";
   
         $.ajax({
                url: ruta,
                type: "POST",
                data:  formData,
                contentType: false,
                 dataType: "json",
                processData: false,
                success: function(datos)
                {
                    html="";
                    html1="";
                      $("#muestra").val(datos["muestra"]);
                      $("#item").val(datos["item"]);
                      $("#variable").val(datos["variable"]);
                      $("#nommuestra").val(datos["nommuestra"]);
                      $("#escala").val(datos["escala"]);
                      $("#respuesta").val(datos["nombre_escala"]);
                      $("#modal_mini").modal("hide"); 
                     var num_escala=$("#escala").val();
                      for (i1 = 0; i1 < num_escala; i1++) { 
                          html += "<label class='control-label col-lg-6'>nombre escala"+(i1+1)+"</label> <div class='col-lg-6'><input type='text' value="+datos["nombre_escala"][i1]+" name='nombre_escala[]' id='nombre_escala[]' class='form-control' required ></div>";
                          if($("#variable").val() == 2){
                             html1 += "<label class='control-label col-lg-6'>nombre escala"+(i1+1)+"</label> <div class='col-lg-6'><input type='text' value="+datos["nombre_escalav2"][i1]+" name='nombre_escalav2[]' id='nombre_escalav2[]' class='form-control' required ></div>";                        
                          }

                        }
                      $("#respuesta_escala").empty().append(html);
                      $("#respuesta_escalav2").empty().append(html1);
                      $("#respuesta").val(datos["respuesta"]); 
                      var num_respuesta=$("#respuesta").val();
                       html="";
                       html1="";
                      for (i1 = 0; i1 < num_respuesta; i1++) { 
                          html += "<label class='control-label col-lg-3'>Resp :"+(i1+1)+"</label> <div class='col-lg-9'><input type='text' value="+datos["nombre_respuesta"][i1]+" name='nombre_respuesta[]' id='nombre_respuesta[]' class='form-control' required></div>";
                          if($("#variable").val() == 2){
                           html1 += "<label class='control-label col-lg-3'>Resp :"+(i1+1)+"</label> <div class='col-lg-9'><input type='text' value="+datos["nombre_respuestav2"][i1]+" name='nombre_respuestav2[]' id='nombre_respuestav2[]' class='form-control' required></div>";
                          }
                        }
                        $("#respuesta_numero").empty().append(html);
                        $("#respuesta_numerov2").empty().append(html1);
                      $('input:radio[name=resitem]').filter('[value='+datos["resitem"]+']').prop('checked', true);
                      $('input:radio[name=relacionversa]').filter('[value='+datos["relacionversa"]+']').prop('checked', true);

  if($("#variable").val() == 2){
    document.getElementById('segundavariable').style.display = 'block';
    $('#itemv2').val(datos["itemv2"]);
    $('#itemv2').prop("required", true);
    $('input[id="nombre_escalav2[]"]').map(function ( n, i) {
      $(this).prop("required", true);
    }).get();
    $('input[id="nombre_respuestav2[]"]').map(function ( n, i) {
      $(this).prop("required", true);
    }).get();
    $('#numerosvariable').prop("required", false);
  }else{
    document.getElementById('segundavariable').style.display = 'none';
    $('#itemv2').removeAttr("required");
    $('input[id="nombre_escalav2[]"]').map(function ( n, i) {
      $(this).removeAttr("required");
    }).get();
    $('input[id="nombre_respuestav2[]"]').map(function ( n, i) {
      $(this).removeAttr("required");
    }).get();
    $('#numerosvariable').removeAttr("required");
  }

                      if ($("#item").val() >= 20 && $("#item").val() < 30) {
                        alert("Atención solo podra ingresar como maximo 9 negativos con algo de lentitud");
                      }
                      if ($("#item").val() >= 30 && $("#item").val() < 40) {
                        alert("Atención solo podra ingresar como maximo 11 negativos con algo de lentitud");
                      }
                      if ($("#item").val() >= 40 && $("#item").val() < 50) {
                        alert("Atención solo podra ingresar como maximo 13 negativos con algo de lentitud");
                      }
                      if ($("#item").val() >= 50 && $("#item").val() < 60) {
                        alert("Atención solo podra ingresar como maximo 14 negativos con algo de lentitud");
                      }

                    if($("#respuesta").val() == 2){
                      var valrespues = $('input:radio[name=valorresp]:checked').val();
                      if(parseFloat(valrespues) == 1){
                        maximo=parseFloat(2)*parseFloat($("#item").val());
                        minimo=parseFloat($("#item").val());
                      }else{
                        maximo=parseFloat(1)*parseFloat($("#item").val());
                        minimo=parseFloat(0);  
                      }
                    }else{
                      maximo=parseFloat($("#respuesta").val())*parseFloat($("#item").val());
                      minimo=parseFloat($("#item").val());

                    }


                    $("#maximo").text("Maximo: "+maximo);
                    $("#minimo").text("Minimo: "+minimo);

                    rango=maximo-minimo;
                    $("#rango").text("Rango: "+rango);
                    amplitud=Math.round(rango/parseFloat($("#escala").val()));
                    $("#amplitud").text("Amplitud del intervalo: "+amplitud);
                    html="";
                    data1="";
                    data2="";
                    data3="";
                    data4="";
                    html2="";
                    desde=0;
                    hasta=0;
                    data5="";
                    i1 = 0;
                              $('input[id="nombre_escala[]').map(function ( n, i) {
                                   //alert($(this).val());
                                   desde=minimo;
                                   hasta=minimo+(amplitud-1);
                                   data1+="<h6>"+(n+1)+".- "+$(this).val()+"</h6>";
                                   data2+="<input  value='"+desde+"' type='text' class='form-control' id='desde' name='desde[]' required>";
                                   if(n+1==$("#escala").val())
                                   {
                                    data3+="<input  value='"+maximo+"' type='text' class='form-control' id='hasta' name='hasta[]' required>";
                                  }
                                  else{
                                    data3+="<input  value='"+hasta+"' type='text' class='form-control' id='hasta' name='hasta[]' required>";
                                  }

                                  data4+="<input  value="+datos["porcentaje"][i1]+" type='text' class='form-control' onkeyup='cal_cant()' id='porcentaje'  name='porcentaje[]' required>";
                                  data5+="<input   value="+datos["cantidad"][i1]+" type='text' class='form-control' id='cantidad' name='cantidad[]' required>";
                                  minimo=hasta+1;
                                  i1++;
                              }).get();



                    html+='';
                    html+='<div class="col-md-2"><h5>Descripcion</h5>'+data1+'</div>';
                    html+='<div class="col-md-1"><h5>Desde</h5>'+data2+'</div>';
                    html+='<div class="col-md-1"><h5>Hasta</h5>'+data3+'</div>';
                    html+='<div class="col-md-1"><h6>Porcentaje%</h6>'+data4+'</div>';
                    html+='<div class="col-md-1"><h6>cantidad</h6>'+data5+'</div>';
                    html1='<br><br><center><button type="submit"   class="btn btn-primary">enviar datos</button></center>';
                    html2+='<div class="col-md-12"><h4>Nivel bajo</h4></div>';
                    for (var i = 1; i<= $("#item").val(); i++) {
                      html2+='<div class="col-md-1"><label class="text-semibold">Item'+i+'</label><div class="radio radio-right"><label><input type="radio" name="desficiente'+i+'" value="1" onclick="verificar(this,'+i+')" id="desficiente[]" >negativo</label></div><div class="radio radio-right"><label><input type="radio" name="desficiente'+i+'" value="0" onclick="verificar(this,'+i+')" id="desficiente[]"  checked="checked">positivo</label></div></div>'; 
                    }                     

                    $("#escalar").empty().append(html);
                    $("#botones").empty().append(html1);
                    $("#deficit").empty().append(html2);
                    for (var i1 = 0 ; i1 < $("#item").val(); i1++) {
                      $('input:radio[name=desficiente'+i1+']').filter('[value='+datos["desficiente"+i1]+']').prop('checked', true);
                    }
                     html="";
                     data1="";
                     data2="";
                     for (var i1 =0;  i1 < $("#variable").val(); i1++) {
                      data1+="<input value="+datos["nombre_dimension"][i1]+"  type='text' class='form-control'  placeholder='Nombre Variable"+i1+"' id='nombre_dimension[]' name='nombre_dimension[]' required>";
                      data2+="<input value="+datos["numero_indicador0"][i1]+" type='text' class='form-control' id='numero_indicador[]' name='numero_indicador0[]' onkeyup='generar_indicador()' required>";    
                    }

                    html+='<div class="row"><div class="col-md-10"><h6>Nombre variables</h6>'+data1+'</div>';
                    html+='<div class="col-md-2"><h6>dim.</h6>'+data2+'</div></div>';

                    $("#crear_cabezera").empty().append(html);

                   html="";
                   html1="";
                   con=0;
                   band = 0;
                   $('input[id="numero_indicador[]"]').map(function ( n, i1){
                    if($(this).val()!=""){
                      band++;
                    }
                  }).get();
                   var ayuda = 0;
                   if ( band == $("#variable").val() ){
                    $('input[id="numero_indicador[]"]').map(function ( n, i1){
                     if($(this).val()!="")
                     {
                       data1="";
                       data2="";
                       data3="";
                       data4="";

                       for (var i1 =0;  i1 < $(this).val(); i1++) 
                       {

                        data1+="<input  type='text' value="+datos["nombre_indicador"][ayuda]+"  class='form-control' id='nombre_indicador[]' name='nombre_indicador[]' required>";
                        data2+="<input value="+datos["numero_pregunta"+n][i1]+" type='text' class='form-control' id='numero_pregunta[]' onkeyup='cal_preg();generar_preguntas();generar_conca();' name='numero_pregunta"+n+"[]'  required>";
                        ayuda++;
                      }

                      html+='<div class="row"><div class="col-md-10"><FONT SIZE="2">Nombre de las dimensiones para la V. '+(n+1)+'</FONT>'+data1+'</div>';
                      html+='<div class="col-md-2"><FONT SIZE="2">preg.</FONT>'+data2+'</div></div>';
                    }
                  }).get();
                    $("#crear_dimension").empty().append(html);
                    data3+="<input  value='Dimension 1' type='hidden' class='form-control' id='nombre_variable[]' name='nombre_variable[]' required>";
                    data4+="<input  value='1' type='hidden' class='form-control' id='numero_dimension[]' name='numero_dimension[]' required>";
                    html1+=data3;
                    html1+=data4;
                    $("#crear_indicador").empty().append(html1);
                  }
                  if( band == 0){
                    $("#crear_dimension").empty();
                    $("#crear_indicador").empty();
                    $("#crear_preguntas").empty();
                    $("#crear_conca").empty();
                  }
                   var items = $("#item").val();
                    html="";
                    var numero_pregunta=[];
                    var nombre_indicador = [];
                    band = 0;
                    suma = 0;
                    $('input[id="numero_pregunta[]"]').map(function ( n, i1){
                      if($(this).val()!=""){
                        band++;
                      }
                    }).get();

                    $('input[id="numero_indicador[]"]').map(function ( n, i1){
                      suma =parseInt($(this).val()) + parseInt(suma);
                    }).get();
                    if ( band == suma ){

                      $('input[id="nombre_indicador[]"]').map(function ( n, i) {
                        nombre_indicador[n] = $(this).val();
                      }).get();

                      $('input[id="numero_pregunta[]"]').map(function ( n1, i1) {
                        if($(this).val()!=""){
                          data1="";
                          data2="";
                          for (var i1 =0;  i1 < $(this).val(); i1++){
                            data1+="<textarea  rows='2' cols='5' class='form-control' id='nombre_pregunta' name='nombre_pregunta[]' required>"+datos["nombre_pregunta"][i1]+"</textarea>";
                          }   
                          html+='<div class="row"><div class="col-md-12"><FONT SIZE="2">'+nombre_indicador[n1]+' - (Variable)</FONT>'+data1+'</div>';
                          html+='</div>';
                        }
                      }).get();
                      $("#crear_preguntas").empty().append(html);
                    }
                    if( band == 0){
                      $("#crear_preguntas").empty();
                      $("#crear_conca").empty();
                    }
                      var items = $("#item").val(); 
                      html=""; 
                      var numero_pregunta=[];
                      var nombre_indicador = [];
                      $('input[id="nombre_indicador[]"]').map(function ( n, i) {
                        nombre_indicador[n] = $(this).val();
                      }).get();
                      band = 0;
                      suma = 0;
                      $('input[id="numero_pregunta[]"]').map(function ( n, i1){
                        if($(this).val()!=""){
                          band++;
                        }
                      }).get();

                      $('input[id="numero_indicador[]"]').map(function ( n, i1){
                        suma =parseInt($(this).val()) + parseInt(suma);
                      }).get();

                      if ( band == suma ){
                        $('input[id="numero_pregunta[]"]').map(function ( n1, i1) {
                          if($(this).val()!=""){
                            data1="";
                            data2="";
                            for (var i1 =0;  i1 <$(this).val(); i1++){
                              data1+="<textarea  value='' rows='2' cols='5' class='form-control' id='nombre_conca' name='nombre_conca[]' required>"+datos["nombre_conca"][i1]+"</textarea>";
                            }   
                            html+='<div class="row"><div class="col-md-12"><FONT SIZE="2">'+nombre_indicador[n1]+' (variable para interpretación) </FONT>'+data1+'</div>';
                            html+='</div>';
                          }
                        }).get();
                        $("#crear_conca").empty().append(html);
                      }  
                      if( band == 0){
                        $("#crear_preguntas").empty();
                        $("#crear_conca").empty();
                      }
                    $('#subir_datos').attr("disabled", false);

                }
            });
});
</script>

<div id="modal_mini" class="modal fade in" >
            <div class="modal-dialog modal-xs">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">×</button>
                  <h5 class="modal-title">Migrar Datos</h5>
                </div>

                <div class="modal-body">
                 <input type="file" name="archivo" id="subir" >
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-link legitRipple" data-dismiss="modal">cerrar</button>
                  <button type="button" class="btn btn-primary legitRipple" id="subir_datos">Subir y Procesar</button>
                </div>
              </div>
            </div>
          </div>