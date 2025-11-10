		<head>
			<meta charset="utf-8">
			<link href="../public/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
			<script src="../public/js/fileinput.js" type="text/javascript"></script>
		</head>
<div class="panel panel-flat">
	<div class="panel-heading">
	   <div class="row">
	   <div class="col-md-10">
         <h4><?php echo $dato->titulo_enfoque." (".$dato->nombres." ".$dato->apellidos.")";?></h4>
         </div>
       
         <div class="col-md-2" >
         <?php 

         if($dato->estado_ficha!=7){
         if($_SESSION['usuario_perfil']==1 || $_SESSION['usuario_perfil']==4 || $_SESSION['usuario_perfil']==5){?>
           <button class="btn btn-success" onclick="modificar1('<?php echo $dato->id_ficha_enfoque ?>')">Asignar tiempo</button>
            <?php }?>

            <?php if($_SESSION['usuario_perfil']==3){?>
           <button class="btn btn-success" onclick="

           finalizar('<?php echo $dato->id_ficha_enfoque ?>')">Finalizar Trabajo</button>
            <?php }
            }
            else{?>
               <button type="button" class="btn bg-teal-400 btn-labeled legitRipple"><b><i class="icon-checkmark"></i></b>Se finalizo </button>
             <?php
            }
            ?>
		</div>
		</div>
		<div class="panel-body">
		<div class="row">
		  <div class="col-md-12">
			<h5>Subir Archivos</h5>

			<br>
			<input id="id_archivo" type="hidden" value="<?php echo $id ;?>">
			<input id="activo" type="hidden" value="<?php echo base_url() ?>">
			<input id="archivos" name="imagenes[]" type="file" multiple=true class="file-loading">
			<br>

		<form id="descarga" name="descarga" action="<?php echo base_url() ?>Usuario_c/descargar"  method="post">
			<table class="table datatable-basic" id="table_sistema">
				<thead>
					<tr>
						<th><center><b >#</b><br><input id="id_t"  class="styled" value="1" type="checkbox" onclick="selecionar('1','1','1')"/></center></th>
						<th>ID</th>
						<th>Nombre Archivo</th>
						<th>Descripción</th>
						<th>Vista</th>
						<th class="text-center">Actions</th>
					</tr>
				</thead>
				<tbody>

					<?php 

                 
					foreach ($lista as $value) { 		?>

					<tr>
						<td><center><input type="checkbox" class="styled" name="linkurl[]" id="linkurl" value='<?php echo "archivos/".$id."/".$value->nombre_archivo?>'></center></td>
						<td><?php echo $value->id_log ?></td>
						<td><?php echo $value->nombre_archivo;?></td>
						<td><?php echo $value->observacion;?></td>
						<?php switch ($value->tipo_archivo){ 
							case 'png': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>' width='70' height='70'></a></td>
							<?php 	break;	
							case 'pdf': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php  echo base_url()?>public/pdf.png' width='70' height='70'></a></td>
							<?php 	break;
							case 'docx': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php  echo base_url()?>public/doc.png' width='70' height='70'></a></td>
							<?php 	break;
							case 'xlsx': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php  echo base_url()?>public/xls.png' width='70' height='70'></a></td>
							<?php 	break;	
							case 'html': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php echo  base_url()?>public/html.png' width='70' height='70'></a></td>
							<?php 	break;	
							case 'txt': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php  echo base_url()?>public/txt.png' width='70' height='70'></a></td>
							<?php 	break;
							case 'zip': ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php  echo base_url()?>public/zip.png' width='70' height='70'></a></td>
							<?php 	break;
							default: ?>
							<td><a target='_Blank' href='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>'><img src='<?php echo base_url()."archivos/".$id."/".$value->nombre_archivo?>' width='70' height='70'></a></td>
							<?php 	break;?>


							<?php } ?>
							<td class="text-center">
								<ul class="icons-list">
									<li><a href="#" data-toggle="modal" data-target="#invoice" onclick="verhistorial('<?php echo $value->id_archivo;?>')"><i class="icon-file-eye"></i></a></li>
								</ul>
							</td>
						</tr>
						<?php }	?>
					</tbody>
				</table>
				<button type="submit" class="btn btn-primary" id="btn_guardar" onclick="descargar()">
					<i class="fa fa-save"></i> Descargar
				</button>
			</form>

		</div>
	</div>
</div>
</div>

	<div id="historial" class="modal fade in">
						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">×</button>
									<h5 class="modal-title"><i class="icon-menu7"></i> &nbsp;Historial</h5>
								</div>

								<div class="modal-body" id="productosmodal">
								
								</div>

								<div class="modal-footer">
									<button class="btn btn-link legitRipple" data-dismiss="modal"><i class="icon-cross"></i> Close</button>
									
								</div>
							</div>
						</div>
					</div>
	<!-- The blueimp Gallery widget -->

	<!-- The template to display files available for upload -->
<div id="modal_default" class="modal fade">
			<div class="modal-dialog">
				<div class="modal-content">

					<div class="modal-body">
						<div class="form-group">
							<label class="control-label col-lg-2">Descripcion</label>
							<div class="col-lg-10">
								<input type="text" name="descripcion" id="descripcion" class="form-control" >

							</div>
						</div>
						<br>
						<br>
						<div class="modal-footer">
							<button type="button" class="btn btn-link" data-dismiss="modal" id="negacion">Cancelar</button>
							<button type="button" class="btn btn-primary" data-toggle="modal" id="confirmacion" value="si">Guardar</button>
						</div>
					</div>
				</div>
			</div>
		</div>


	<script type="text/javascript">
		<?php 	echo $directory =  "archivos/".$id."/";?> 
		<?php   
		$images = glob($directory . "*.*");
		?>
		$("#table_sistema").DataTable();
		$("#archivos").fileinput({
			uploadUrl: base_url+"Usuario_c/prueba", 
			uploadAsync: false,
			showUpload: false, 
			showRemove: false,
			
			 <?php 

         if($dato->estado_ficha!=7){?>
			showBrowse:true,showUploadFile: true, 
 <?php 
}else{?>

	showBrowse:false,showUploadFile: false, 
 <?php 
}?>

			previewFileIcon: '',
			preferIconicPreview: true,

			uploadExtraData: function() {
				return {
					descrip: $("#descripcion").val(),
					id_ficha: $("#id_archivo").val()
				};
			},

			initialPreview: [
			<?php foreach($images as $image){?>

				"<img src='<?php echo base_url().utf8_decode($image); ?>' height='120px' class='kv-preview-data file-preview-img'/>",
				<?php } ?>],
				fileActionSettings: { showRemove: false,
					uploadTitle: 'Upload file' } ,
					initialPreviewConfig: [<?php foreach($images as $image){ $infoImagenes=explode("/",$image);?>
					{caption: "<?php echo $infoImagenes[2];?>",  height: "120px", url:base_url+"Usuario_c/borrar", key:"<?php echo $infoImagenes[2].'';?>",key1 :"<?php echo '2' ?>"},
					<?php } ?>],
	 // this will force thumbnails to display icons for following file extensions
	        previewFileIconSettings: { // configure your icon file extensions
	        	'doc': '<i class="fa fa-file-word-o text-primary"></i>',
	        	'xls': '<i class="fa fa-file-excel-o text-success"></i>',
	        	'ppt': '<i class="fa fa-file-powerpoint-o text-danger"></i>',
	        	'pdf': '<i class="fa fa-file-pdf-o text-danger"></i>',
	        	'zip': '<i class="fa fa-file-archive-o text-muted"></i>',
	        	'htm': '<i class="fa fa-file-code-o text-info"></i>',
	        	'txt': '<i class="fa fa-file-text-o text-info"></i>',
	        	'mov': '<i class="fa fa-file-movie-o text-warning"></i>',
	        	'mp3': '<i class="fa fa-file-audio-o text-warning"></i>',
	            // note for these file types below no extension determination logic 
	            // has been configured (the keys itself will be used as extensions)
	            'jpg': '<i class="fa fa-file-photo-o text-danger"></i>', 
	            'gif': '<i class="fa fa-file-photo-o text-muted"></i>', 
	            'png': '<i class="fa fa-file-photo-o text-primary"></i>'    
	        },
	        previewFileExtSettings: { // configure the logic for determining icon file extensions
	        	'doc': function(ext) {
	        		return ext.match(/(doc|docx)$/i);
	        	},
	        	'xls': function(ext) {
	        		return ext.match(/(xls|xlsx)$/i);
	        	},
	        	'ppt': function(ext) {
	        		return ext.match(/(ppt|pptx)$/i);
	        	},
	        	'zip': function(ext) {
	        		return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
	        	},
	        	'htm': function(ext) {
	        		return ext.match(/(htm|html)$/i);
	        	},
	        	'txt': function(ext) {
	        		return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
	        	},
	        	'mov': function(ext) {
	        		return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
	        	},
	        	'mp3': function(ext) {
	        		return ext.match(/(mp3|wav)$/i);
	        	},
	        },

	    }).on("filebatchselected", function(event, files) {
	    	var res = $("#modal_default").modal('show');
	    	$('#confirmacion').click(function(){
	    		$("#archivos").fileinput("upload");
	    		$('#archivos').fileinput('reset');
	    		$("#modal_default").modal('hide');
	    		$("#descripcion").val('');
	    	});

	    	$('#negacion').click(function(){
	    		$("#modal_default").modal('hide');
	    		$('#archivos').fileinput('reset');
	    		$("#descripcion").val('');
	    	});

	    }).on('filebatchuploadcomplete', function(event, files, extra) {
	    		funcion();
	    });
	    function funcion(){
	    	var id = $("#id_archivo").val();
	    	$("#titulo").text("Nuevo modulo en "+empresa); reload();
	    	$.post(base_url+"Documentos_c/new_documento",{'id':id},function(data){
	    		$("#table_sistema").DataTable();
	    		$('#cont_sistema').empty().html(data);
	    	});
	    }
	    function descargar(){
	    	document.descarga.submit() ;
	    	funcion();
	    }

	    function verhistorial(id){


	    	$.ajax({
	    		url : "<?php echo site_url('Usuario_c/historial'); ?>",
	    		data : {id : id},
	    		type : 'POST',
	    		dataType : 'json',
	    		success : function(json,datos) {
	    			var HTML = '<table class="table table-striped table-hover" id="table3">' +
	    			'<thead>' +
	    			'<tr>' +
	    			'<th>#</th>'+
	    			'<th>Nombre Archivo</th>'+
	    			'<th>Fecha Movimiento</th>'+
	    			'<th>Observacion</th>'+
	    			'<th>Tipo Mov.</th>'+
	    			'<th>Nombres</th>'+
	    			'</tr>' +
	    			'</thead>' +
	    			'<tbody>';

	    			for (var i = 0; i < json.length; i++) {
	    				HTML = HTML + '<tr>';
	    				HTML = HTML + '<td>'+(i+1)+'</td>';
	    				HTML = HTML + '<td>'+json[i].nombre_archivo+'</td>';
	    				HTML = HTML + '<td>'+json[i].fecha_movimiento+'</td>';
	    				HTML = HTML + '<td>'+json[i].observacion+'</td>';
	    				HTML = HTML + '<td>'+json[i].tipomov+'</td>';
	    				HTML = HTML + '<td>'+json[i].nombres+'</td>';
	    				HTML = HTML + '</tr>';
	    			}
	    			HTML = HTML + '</tbody></table>'	;
	    			$('#productosmodal').html(HTML);

	    			$("#historial").modal('show');

	    			$.unblockUI({});
	    		},
	    		error : function(xhr, status) {
	    			$.unblockUI({});
	    			swal({
	    				title: "Disculpe ocurrio un problema!",
                // text: "Here's a custom image.",
                imageUrl: "<?php echo base_url().'public/images/dislike.png';?>"
            });
	    		},
	    	});

}
	function selecionar(data2,data1,data3) {
		 
     var listaCompras = "";
     $("input[id=linkurl]").each(function (index) {  
       
            if(  $(this).prop('checked') ) 
               {
                  $(this).prop("checked",false);
              }
              else
              {
              	$(this).prop("checked",true);
              }
      
    });  
		  	  
             $(".styled, .multiselect-container input").uniform({
        radioClass: "choice"
    });


}
        $(".styled, .multiselect-container input").uniform({
        radioClass: "choice"
    });
</script>