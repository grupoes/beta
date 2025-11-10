<div class="panel-body">

	<div class="panel panel-white">

		<div class="panel-heading">

           <h3>INGRESAR EXCEL </h3>
          
      <form class="form-horizontal" method="POST" role="form" action="<?php echo base_url()."Lectura/leer" ?>" enctype="multipart/form-data" id="formulario" >
        <div class="row"> 
            		<div class="col-md-4">
            			<div class="form-group">
											<label class="display-block">Subir Excel:</label>
									<input name="archivo" required="true" type="file" class="file-styled">
											<span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
										</div>
            		</div>
            			<h3>Campos</h3>
            		<div class="col-md-8"> 
                       <input type="hidden" name="id" id="id" value="<?php echo $dato; ?>">
            			<div class="row">
            				<div class="col-md-2"><input  onkeypress='return sololetras(event)' maxlength="1" class="form-control" type="text" name="fecha" id="fecha" placeholder="fecha" required="true"></div>
            				<div class="col-md-2"><input maxlength="1" onkeypress='return sololetras(event)'  class="form-control" type="text" name="serie" id="serie" placeholder="serie" required="true"></div>
            						<div class="col-md-2"><input maxlength="1" onkeypress='return sololetras(event)'  class="form-control" type="text" name="numero" id="fecha" placeholder="numero" required="true"></div>
            						<div class="col-md-2"><input maxlength="1" onkeypress='return sololetras(event)'  class="form-control" type="text" name="monto" id="monto" placeholder="monto" required="true"></div>
            						 <div class="col-md-2"><input maxlength="1" onkeypress='return sololetras(event)'  class="form-control" type="text" name="ruc" id="ruc" placeholder="RUC" required="true"></div>
            						 <div class="col-md-2"><input maxlength="1" onkeypress='return sololetras(event)'  type="text"  class="form-control"  name="tipo" placeholder="tipo" id="tipo" required="true"></div>
                          <div class="col-md-2"><input maxlength="1" onkeypress='return sololetras(event)'  type="text"  class="form-control" name="razon" placeholder="razon social" id="razon" required="true"></div>
                           <div class="col-md-4">
                             <label class="col-md-2">IGV</label>
                                  <div class="col-md-4">
                             <select class="form-control" id="igv" name="igv">
                               <option value="0">no</option>
                               <option value="1">si</option>
                             </select>
                           </div>
                           </div>

            			</div>
            		</div>
            		</div>
            		<br>
            		<br>
                   <div class="row">
                   	  <center>
                   	  	   <button type="button" class="btn btn-danger">Cancelar</button>
                   	  	   <button type="submit" class="btn btn-success" id="subir">Subir</button>
                   	  </center>
                   </div>
            	</form>
            
        </div>

        </div>
        </div>
<script type="text/javascript">
	$(function () {
   
       $("#titulo").text("Contabilidad");
       $("#subtitulo").text('EMPRESA '+"<?php echo strtoupper($_SESSION['descripcion_empresa_comprobante']); ?>");
      
    });

    $("#subir").submit(function()
    {
      $('#subir').attr("disabled", true);
    })

</script>