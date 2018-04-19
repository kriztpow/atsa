<?php
require_once("inc/functions.php");
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<h4>Activar o desactivar</h4>				
					<p class="text-aclaracion">Se muestra la imagen cargada actualmente.</p>
					<p class="text-aclaracion">Para subir una nueva, usar el formulario.</p>
					<p class="text-aclaracion">Marcar el cuadro para activar la promoción y que aparezca en la página.</p>
					<div class="row"><br></div>
					<div class="row">
						<div class="col-sm-4">
							<label for="popUpActive">Activar:</label>
						</div>
						<div class="col-sm-8">
							<input type="checkbox" id="popUpActive" name="popUpActive" <?php ispopupActive(); ?>>
						</div>
					</div>
				</div><!-- // col -->

				<div class="col-md-4 col-sm-12">
					<?php showPopupImg (); ?>
				</div><!-- // col -->
				
				<div class="col-md-4 col-sm-12">
					<aside id="wrapper-form-upload-galery">
						<div class="load-ajax"></div>
						<div class="container-fluid">
							
							<h4>Subir nuevas imágenes:</h4>	
							<p class="text-aclaracion">Se pueden subir más de uno simultaneamente, máximo 5mbs en total.</p>	
							<form action="inc/upload_images.php" method="post" enctype="multipart/form-data" name="upload_imgs" id="upload_imgs">
								<p><input name="archivo[]" type="file">
							  	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></p>
							  	<p><input type="submit" value="Subir imágenes" class="btn btn-success"></p>
							</form>
						</div><!-- // container fluid form-->
					</aside><!-- // wrapper form -->	
				</div><!-- // col -->
			</div><!-- // row gral modulo -->
		</div><!-- // container gral modulo -->
		<!-- botones del modulo -->
	    <div class="modal-footer">
		    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		    <button type="button" class="btn btn-primary submit-save" data-btn="data-modulo">Guardar cambios</button>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div>

<script>
	$(document).ready(function(){

		/*
		* Subir imagen
		*/

		$( '#upload_imgs' ).on('submit', function( event ){
			event.preventDefault();

			var formulario = $( this );
			var imgAjax = $( '.load-ajax' );
			var formData = new FormData( formulario[0] );
			var post_type = 'popup';
			formData.append('post_type', post_type);

			$.ajax( {
				type: 'POST',
				url: 'inc/upload_images.php',
				data: formData,
				cache: false,
	            contentType: false,
	            processData: false,
	            //funcion antes de enviar
	            beforeSend: function() {
	            	console.log('enviando imagenes');
	            	$( '.load-ajax' ).fadeIn();
	            },
				success: function ( response ) {
					console.log('La imagen ha subido correctamente');
					$( '.load-ajax' ).fadeOut();
					//recarga el modulo
					$('.modal-body').load('inc/templates/promociones-admin.php');
					
				},
				error: function ( error ) {
					console.log('error');
				},
			});//cierre ajax

		}); //cierra subir imagen

		/*
		* Borrar imagen
		*/

		$( '.del-btn-file' ).click(function(event) {
		event.preventDefault();
		idFile = this.getAttribute('id');
		var data = {};
		data.id = idFile;
		//botones
		var btn = $(this);
		//texto botones
		var btnNormalText = btn.text()
		var btnSavingText = 'borrando';
		var btnSavedText = 'borrado';


		$.ajax( {
				type: 'POST',
				url: 'inc/delete_images.php',
				data: data,
	            //funcion antes de enviar
	            beforeSend: function() {
	            	//modifica textos de los botones
	            	btn.text(btnSavingText);
	            	console.log('borrando archivo');
	            },
				success: function ( response ) {
					console.log('El archivo se ha borrado correctamente');
					console.log(response);
					
					//recarga el modulo
					$('.modal-body').load('inc/templates/promociones-admin.php');
					//modifica textos de los botones
					btn.text(btnSavedText)
				},
				error: function ( ) {
					console.log('error');
				},
			});//cierre ajax

	});//click delete btn


	/*
	* Save button
	*/	
	//vuelve a activar el boton si estaba desactivado;
	$('.submit-save').removeAttr('disabled');

	$('.submit-save').click(function( event ){
		event.preventDefault();
		var section = $(this).attr('data-btn');
		var btn = $(this);
		//texto botones
		var btnNormalText = btn.html();
		var btnSavingText = 'guardando';
		var btnSavedText = 'guardado';

		//objeto a pasar al servidor
		var data = {'popup' : 'false'};
		
		if ( $('#popUpActive').prop('checked') ) {
			data.popup = 'true';
		}
		//envio la data al servidor para que se guarde
		$.ajax( {
				type: 'POST',
				url: 'inc/save-button.php',
				data: {
					section: section,
					popup: data.popup
				},
	            //funcion antes de enviar
	            beforeSend: function() {
	            	console.log('saving');
	            	//cambio texto del boton
	            	btn.html(btnSavingText);
	            },
				success: function ( response ) {
					console.log('saved');
					console.log(response);

					btn.html(btnSavedText);
					setTimeout(function(){
						btn.html(btnNormalText);
					 }, 2000);
					//mostrar imagen en html
				},
				error: function ( ) {
					console.log('error');
				},
		});//cierre ajax

	})//click save


	});//ready
</script>