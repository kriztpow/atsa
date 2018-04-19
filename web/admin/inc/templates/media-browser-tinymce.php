<?php
/*
 * Archivo de imagenes / inserta imagen nueva
 * versión reducida para el editor TinyMCE
 * Since 3.0
 * 
*/
require_once("../functions.php");
$carpeta_imagenes = UPLOADSIMAGES;
$directorio = opendir( $carpeta_imagenes ); // Abre la carpeta

?>

<!-------------- HTML -------------->
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Archivo de imágenes</title>

<!-- Bootstrap core CSS -->
    <link href="/admin/assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="/admin/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
<!-- jQquery UI css -->
  <link href="/admin/assets/css/jquery-ui.min.css" rel="stylesheet">
<!-- Custom CSS -->
  <link href="/admin/assets/css/admin-style.css" rel="stylesheet">

</head>
<body>
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
			    				<label for="file"></label>
			    				<input type="file" name="file[]" id="file" required>
		    				</div>
		    				<div class="col-sm-6">
			    				<select id="file_type" name="file_type">
				    				<option value="imagen">Imagen</option>
				    				<option value="pdf">PDF</option>
				    			</select>
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

<!------- // fin contenido ------>
<!------- scripts ------>
<!------- jquery 3.1.1 ------>
<script src="/admin/assets/js/jquery-3.1.1.min.js"></script>
<!------- jquery UI ------>
<script src="/admin/assets/js/jquery-ui.min.js"></script>

<!-- Bootstrap core JavaScript -->
<script src="/admin/assets/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="/admin/assets/js/ie10-viewport-bug-workaround.js"></script>
<!------- admin scripts ------>
<script src="/admin/assets/js/admin-script.js"></script>
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

//al hacer clic en las imágenes la url se inserta en el input
$(document).on("click","li.imagen",function(){
  item_url = 'http://' + window.location.host + '/uploads/images/' + $(this).data("src");
  var args = top.tinymce.activeEditor.windowManager.getParams();
  win = (args.window);
  input = (args.input);
  win.document.getElementById(input).value = item_url;
  top.tinymce.activeEditor.windowManager.close();
});
//al hacer clic en los pdf la url se inserta en el input
$(document).on("click","li.pdf",function(){
  item_url = $(this).data("src");
  var args = top.tinymce.activeEditor.windowManager.getParams();
  win = (args.window);
  input = (args.input);
  win.document.getElementById(input).value = item_url;
  top.tinymce.activeEditor.windowManager.close();
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
			console.log(response);
			response = $.parseJSON(response);
			$( '.load-ajax' ).fadeOut();
			//si nos devuelve el error lo pasamos al usuario
			if ( response == 'error-type') {
				alert('no es el archivo adecuado');
			} else {

				if ( imagen ) {
					urlimg = 'http://' + window.location.host + '/uploads/images/' + response;
					item_url = urlimg;
				  	var args = top.tinymce.activeEditor.windowManager.getParams();
					win = (args.window);
					input = (args.input);
					win.document.getElementById(input).value = item_url;
					top.tinymce.activeEditor.windowManager.close();		
				} else {
					urlimg = 'http://' + window.location.host + '/uploads/pdfs/' + response;
					item_url = urlimg;
				  	var args = top.tinymce.activeEditor.windowManager.getParams();
					win = (args.window);
					input = (args.input);
					win.document.getElementById(input).value = item_url;
					top.tinymce.activeEditor.windowManager.close();		
				}
			}	
		},
		error: function ( error ) {
			console.log('erroraquí');
		},
	});//cierre ajax
});//submit





</script>
</body>
</html>