<div class="panel-body">
	<div class="panel panel-white">
		<div class="panel-heading">
			<center><h3><b>Seleccionar que desea tributo desea registar</b></h3></center>
      <div  class="row"><div class="col-md-3"><button class="btn btn-danger" onclick="atras()">Atras</button></div></div>
			<div class="row">
			<?php 

             $data=(string)$_SESSION["ruc_empresa"];
              $id_numero=substr($data, 10, 10);
              $id_tributo;
              $data1=$this->db->query('SELECT DISTINCT(anio.id_anio) as "anio",anio.anio_descripcion,anio.anio_color from anio,numero,fecha_declaracion where anio.id_anio=fecha_declaracion.id_anio and numero.id_numero=fecha_declaracion.id_numero
and numero.num_descripcion='.$id_numero.' and fecha_declaracion.id_tributo='.$id_tributo)->result();
               foreach ($data1 as $key => $value) {?>
                 <div class="col-md-12">
                 	<h3><?php echo $value->anio_descripcion; ?></h3>
                     <?php
                     $data2=$this->db->query('SELECT * from mes,numero,fecha_declaracion where numero.id_numero=fecha_declaracion.id_numero AND
mes.id_mes=fecha_declaracion.id_mes 
and numero.num_descripcion='.$id_numero.' and fecha_declaracion.id_tributo='.$id_tributo.' and fecha_declaracion.id_anio='.$value->anio." order by mes.id_mes")->result();
                       foreach ($data2 as $key1 => $meses) { ?>

                         <div class="col-md-4" >
	                         <div class="panel bg-<?php echo $value->anio_color; ?>" onclick="declaracion('<?php echo $meses->id_fecha_declaracion ?>','<?php echo $meses->mes_descripcion ?>','<?php echo $value->anio_descripcion ?>')">
						        <div class="panel-body">
							
								 	<h5 class="no-margin"><?php echo $meses->mes_descripcion."(".$meses->fecha_exacta.")"; ?></h5>
										
								 </div>
			                </div>
			             </div>
                       	   
                      <?php

                       }
            
                     ?>

                 </div>
               <?php 

           }

			?>
		</div>
		</div>
	</div>
</div>

<div class="modal fade" id="declaracion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="titulo_texto"></h3>
        <button type="button" class="close"  aria-label="Close" onclick="imprimir()">
          <i class="icon-printer"></i>

                </button>
      </div>
       <input type="hidden" name="id_fecha_declaracion" value="" id="id_fecha_declaracion" >    
      <div class="modal-body" id="data_declaracion">
           <div class="row">
           	<label class="col-md-3">nº de orden</label>
           	<div class="col-md-9">
           		<input type="text" name="codigo" id="codigo" value="" class="form-control">
           	</div>


          <div id="venta_compra">
           	<label class="col-md-3">Venta</label>
           	<div class="col-md-9">
           		<input type="number" name="venta" id="venta" value="" class="form-control">
           	</div>
           	<label class="col-md-3">compra</label>
           	<div class="col-md-9">
           		<input type="number" name="compra" id="compra" value="" class="form-control">
           	</div>
          </div>
             
         
         <div id="porcentaje_">
           <label class="col-md-3">Porcentaje</label>
            <div class="col-md-9">
              <input type="number" name="porcentaje" id="porcentaje" value="" class="form-control">
            </div>
         </div>



          <div id="monto_id">
            <label class="col-md-3">Importe</label>
            <div class="col-md-9">
              <input type="number" name="monto" id="monto" value="" class="form-control">
            </div>
          </div>
           	<label class="col-md-3">Fecha de declaracion</label>
           	<div class="col-md-9">
           		<input type="date" name="fecha" id="fecha"  value="<?php echo date('Y-m-d');?>" max="<?php echo date('Y-m-d');?>" class="form-control">
           	</div>
           </div>
  
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" id="aceptar_declaracion1" class="btn btn-primary" onclick="guardar_declaracion()">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(function()
        {

           $("#porcentaje_").hide();
           
        });
    <?php if($tipo==2){ ?>

      $(function()
        {
          $("#venta_compra").hide();

        });
   
<?php } ?>
 <?php if($tipo==3){ ?>

      $(function()
        {
          $("#venta_compra").hide();
          $("#monto_id").hide();

        });
   
<?php } ?>

var venta;

function imprimir()
{

    var url=base_url+"pdf/declaracion.php?ruc=<?php echo $_SESSION['ruc_empresa'] ?>&id_fecha="+$("#id_fecha_declaracion").val();

    var a = document.createElement("a");
    a.target = "_blank";
    a.href = url;
    a.click();
}


		function declaracion(id_fecha_declaracion,mes,anio)
	 {
			//alert(id_fecha_declaracion);
			$("#titulo_texto").text("declaracion "+mes+" "+anio);
			$("#declaracion").modal();
			$("#id_fecha_declaracion").val(id_fecha_declaracion);
			$("#codigo").focus();

   

			$.post("<?php echo base_url(); ?>Declaracion/ver_codigo",{
            "id_fecha_declaracion":id_fecha_declaracion
			},function(data){
               $("#codigo").val(data["codigo"]);
              // $("#venta").val(data["monto_venta"]);
               $("#compra").val(data["monto_compra"]);
               $("#fecha").val(data["fecha"]);
               $("#monto").val(data["monto"]);

			},"json");
            
            <?php if($tipo==1){ ?>
      



      $.post("<?php echo base_url(); ?>Declaracion/ventas",{
        "ruc":"<?php echo $_SESSION['ruc_empresa'] ?>",
        "id_fecha_declaracion":id_fecha_declaracion

      },function(data){
        
        venta=parseFloat(data);
         $("#venta").val(venta);
        

         <?php if($id_tributo==2){ ?>
                   total=Math.round(parseFloat((venta*1.5)/100));   
              $("#monto").val(total);
         <?php } else{?>
              $("#porcentaje_").show();
              $.post("<?php echo base_url(); ?>Declaracion/maximo_porcentaje",{"ruc":"<?php echo $_SESSION['ruc_empresa']?>"},function(data1){

               
                if(data1!="")
                {
                  $("#porcentaje").val(parseFloat(data1));
                  total=Math.round(parseFloat((venta*parseFloat(data1))/100));   
                   $("#monto").val(total);
                   
                }


              });
              


         <?php } ?> 
          




      });
        

               

 




<?php } ?>
            
   
	}

	function guardar_declaracion()
	{



		$("#aceptar_declaracion1").attr("disabled",true);
		$.post("<?php echo base_url(); ?>Declaracion/guardar_fecha_declaracion",{
            "id_fecha_declaracion":$("#id_fecha_declaracion").val(),
            "codigo":$("#codigo").val(),
            "venta":$("#venta").val(),
            "compra":$("#compra").val(),"fecha":$("#fecha").val(),
            "monto":$("#monto").val(),
            "porcentaje":$("#porcentaje").val()
			},function(data){
				$("#aceptar_declaracion1").attr("disabled",false);
					$("#declaracion").modal("hide");
                		
                		alerta("Declaracion","Se guardo correctamente");
                    imprimir();
			},"json");
	}


$("#porcentaje").keyup(function()
  {
     total=Math.round(parseFloat(($(this).val()*$("#venta").val())/100));   
    
        $("#monto").val(total);
    
  });

</script>
<script type="text/javascript">
  function atras()
  {
    reload();
    $.post(base_url+"Declaracion/registrar_declaracion",{"ruc":"<?php echo $_SESSION['ruc_empresa']; ?>"},function(data){
      
     $('#cont_sistema').empty().html(data);
    });
  }
</script>