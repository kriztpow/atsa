<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../functions.php");

?>

<article>
	<div class="container-fluid">

		<div id="tabs">
		  <ul>
		    <li><a href="#upload">Subir archivo</a></li>
		    <li><a href="/admin/inc/templates/ajax/min-bilioteca-imagenes.php">Biblioteca imágenes</a></li>
		    <li><a href="/admin/inc/templates/ajax/min-bilioteca-pdfs.php">Biblioteca pdfs</a></li>
		  </ul>
		  <div id="upload">
		  	<div class="container-fluid">
		    	<h2 class="text-center">SUBIR ARCHIVO NUEVO</h2>
		    	
	    		<div class="load-ajax"></div>
	    		<form id="upload_file" name="upload_file">
	    			<div class="form-group">
	    				<div class="row">
		    				<div class="col-sm-6">
			    				<div class="form-group">
			    					<select id="file_type" name="file_type">
					    				<option value="imagen">Imagen</option>
					    				<option value="pdf">PDF</option>
					    			</select>
					    		</div>
					    		<div class="form-group">
				    				<label for="file"></label>
				    				<input type="file" name="file[]" id="file" required multiple>
				    			</div>
		    				</div>
		    				<div class="col-sm-6">
			    				<div class="preview-wrapper">
			    					
			    				</div>
		    				</div>
	    				</div>
	    			</div>
	    			<div class="form-group">
	    				<input type="submit" value="subir archivo" class="btn btn-success">
	    			</div>
	    		</form>
		    	<ul class="new-image-loaded"></ul>
		    </div>
		  </div>
		</div><!-- //.tabs-jquery-ui -->
	</div><!-- //.container-fluid -->
</article>


<script type="text/javascript" language="javascript">

$( function() {
    $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.fail(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
  } );

var destacado = false;

//al hacer clic en las imágenes la url se inserta en el input
$(document).on("click","li.imagen",function(){
	item_url = $(this).data("src");

	  if ( $('.ui-dialog-buttonset button').hasClass('imagenes-galerias') ) {
	  	//puede haber muchos seleccionados pero al deseleccionarlos hay que borrarlos del input para que no se incluyan luego
	  	//si ya tiene la clase y estaba seleccionada hay que deseleccionarla y luego borrarla del input
	  	if ( $(this).hasClass('image-selected') ) {
	  		$(this).removeClass('image-selected');
	  		$('.previewAtachment').each(function(){
				if ($(this).val() == item_url) {
					$(this).remove()
				}
			});
	  	} else {
	  		//sino tiene la clase es más facil, solo hay que agregarla
	  		$(this).addClass('image-selected');
	  		var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+item_url+'">';
			var node = $(html);
			$('#libreria').append(node);
	  	}

	  	//o puede haber una sola eleccion
	  } else {
  		//destacado indica que ya algo seleccionado entonces hay que encontrarlo y deseleccionarlo
		  if (destacado) {
		  	$.each( $('li.imagen'), function(){
		  		$(this).removeClass('image-selected');
		  	});
		  	//se borra la que antes estaba seleccionada
		  	$('.previewAtachment').remove();
		  }
		  //una vez todos seleccionados se selecciona la adecuada
		  $(this).toggleClass('image-selected');
		  //y a continuación se indica que hay algo destacado
		  destacado = true;
		  //se agrega al input para que pueda asignarse luego
			var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+item_url+'">';
			var node = $(html);
			$('#libreria').append(node);
	  }
});


//al hacer clic en los pdf la url se inserta en el input
$(document).on("click","li.pdf",function(){
 item_url = $(this).data("src");
  $('.previewAtachment').val(item_url);
  
  if (destacado) {
  	$.each( $('li.pdf'), function(){
  		$(this).removeClass('file-selected');
  	});
  	
  }
  $(this).toggleClass('file-selected');	
  destacado = true;
});


//subir la imagen por ajax
$('#upload_file').submit(function( event ){
	event.preventDefault();
	var formulario = $( this );
	var imgAjax = $( '.load-ajax' );
	var formData = new FormData( formulario[0] );
	var url = $('#file_type').val();
	var imagen = true;
	if ( url == 'pdf') {
		imagen = false;
	 }

	url = '/admin/inc/upload-'+url+'-minibrowser.php';

	$.ajax( {
		type: 'POST',
		url: url,
		data: formData,
		cache: false,
	    contentType: false,
	    processData: false,
	    //funcion antes de enviar
	    beforeSend: function() {
	    	$( '.load-ajax' ).fadeIn();
	    },
		success: function ( response ) {
			$( '.load-ajax' ).fadeOut();

			//si nos devuelve el error lo pasamos al usuario
			if ( response == 'error-type') {
				alert('no es el archivo adecuado');
			} else {
				//sino devuelve error puede ser imagen o archivo
			response = $.parseJSON(response);
				if ( imagen ) {
					//si no devuelve error puede ser multiple o individual
					if (response.length == 1) {
						var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+response+'"><img class="preview-image img-responsive" src="/uploads/images/'+response+'"><p><a href="" class="preview-file"></a></p>';
						var node = $(html);
						$('.preview-wrapper').append(node);
					} else {
						for (var i = 0; i < response.length; i++) {
							var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+response[i]+'"><img class="preview-image img-responsive" src="/uploads/images/'+response[i]+'"><p><a href="" class="preview-file"></a></p>';
							var node = $(html);
							$('.preview-wrapper').append(node);
						}
					}
					//si lo subido es un archivo
				} else {
					var html = '<input type="hidden" class="previewAtachment" name="previewAtachment" value="'+response+'"><p><a href="/uploads/pdfs/'+response+'" target="_blank" class="preview-file">'+response+'</a></p>';
						var node = $(html);
						$('.preview-wrapper').append(node);
				}
			}	
		},
		error: function ( error ) {
			console.log('erroraquí');
		},
	});//cierre ajax
});//submit

</script>