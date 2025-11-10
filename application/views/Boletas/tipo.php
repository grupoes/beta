
<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
           <h3>ESCOGER TIPO DE COMPROBANTE <?php echo $id_tributo; ?></h3>
           <div class="row"><div class="col-md-10"></div><div class="col-md-2"><button id="exportar" class="btn btn-success">exportar</button></div></div>
           <br>
             <div class="row">

  
                  
             <?php foreach($datos as $row){?>

                 <?php 

                    $sql="select count(id_comprobante) as cont from comprobante where ruc_empresa_numero='".$_SESSION["id_empresa_comprobante"]."' and id_tipo_comprobante=".$row->id_tipo_comprobante;
                   $datos1=$this->db->query($sql);

                    $max=$datos1->row();
                 ?>
               <div class="col-md-6">
               <a href="#" onclick="tipo_comprobante('<?php echo $row->id_tipo_comprobante; ?>')">
                 <div class="panel bg-teal-400">
										<div class="panel-body">
											<div class="heading-elements">
												<span class="heading-text badge bg-teal-800"><?php echo $max->cont;?></span>
											</div>

											<h3 class="no-margin">	<?php echo $row->tipo_comprobante_descripcion;?></h3>
											<?php echo $row->tipo_comprobante_descripcion;?>
										
										</div>

										<div class="container-fluid">
										
										</div>
									</div>
									</a>
             </div>

               <?php 



               }?>

          </div>


		</div>

		</div>
</div>



<div class="modal fade" id="fecha" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ingresa las fechas del reporte</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="col-md-4">
             <label class="control-label col-lg-2">Incio:</label><div class="col-lg-10"><input autofocus="true"  class="form-control" type="date" name="inicio" id="inicio">
           </div>
           </div>
           <div class="col-md-4">
               <label class="control-label col-lg-2">Fin:</label><div class="col-lg-10"><input autofocus="true"  class="form-control" type="date" name="fin" id="fin">
           </div>
         </div>
           <div class="col-md-2">
              <label class="control-label col-lg-6">IGV:</label>
              <div class="col-md-6">
              <input autofocus="true"  class="form-control" type="checkbox" value="1" name="igv" id="igv">
              </div>
         
           </div>
           <div id="porcentaje_">
           <div class="col-md-2">
            <input placeholder="porcen."  class="form-control" type="number" name="porcentaje" id="porcentaje">
           </div>
         </div>
          
  </div>
        
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="aceptar" class="btn btn-primary">Aceptar</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">


var   valor=1.5;

		$(function () {
      $("#porcentaje_").hide();
       $("#titulo").text("Contabilidad");
       $("#subtitulo").text('EMPRESA '+"<?php echo strtoupper($_SESSION['descripcion_empresa_comprobante']); ?>");
   
    });


		function tipo_comprobante(id)
		{
         
           $.post(base_url+"Boletas/nuevo",{"id":id},function(data){
                  $('#cont_sistema').empty().html(data);
           });
       }




       $("#exportar").click(function()
        {
            $("#fecha").modal();  
               <?php  if($id_tributo!=2){     ?>

     $("#porcentaje_").show();
       $.post("<?php echo base_url(); ?>Declaracion/maximo_porcentaje",{"ruc":"<?php echo $_SESSION['id_empresa_comprobante']?>"},function(data1){

               
                if(data1!="")
                {
                  $("#porcentaje").val(parseFloat(data1));
                 
                   
                }


              });
  

    <?php   } ?>



        });


       $("#aceptar").click(function()
       {

        porcentaje=$("#porcentaje").val();
        if(porcentaje!="")
           {
              valor=porcentaje;
           }

          var con=0

           if (typeof($('input:checkbox[name=igv]:checked').val())!="undefined")
            { 
                con=1;
            }
            else{
                  cont=0;
            }


           if($("#inicio").val()=="")
                  {
         
                   $("#inicio").focus(); return 0;
                   }
                   if($("#fin").val()=="")
                  {
         
                   $("#fin").focus(); return 0;
                   }
    dat="<?php echo $_SESSION['id_empresa_comprobante']; ?>";
            var url=base_url+"excel/Examples/generarexcel.php?id="+dat+"&inicio="+$("#inicio").val()+"&fin="+$("#fin").val()+"&igv="+con;
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
     dat="<?php echo $_SESSION['id_empresa_comprobante']; ?>";
            var url=base_url+"pdf/declarar.php?id_tributo=<?php echo $id_tributo; ?>&ruc="+dat+"&inicio="+$("#inicio").val()+"&porcentaje="+valor;
    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
     $("#fecha").modal("hide");  

       });
</script>