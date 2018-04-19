<?php
require_once("inc/functions.php");
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-4 col-sm-12">
					<div class="panel panel-primary">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Invierno</h3>
						</div>
						<div class="panel-body">
						  	<ul class="lista-files">
						  		<li>
						  			<h4><u>Hoteles</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'invierno_hoteles' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Servicios</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'invierno_servicios' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Itinerario</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'invierno_itinerario' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Contrato</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'invierno_contrato' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Tarifario</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'invierno_tarifario' ) ?>
							  		</div>
						  		</li>
						  	</ul>
					  		
					  		<div class="row"><br></div>
					  		<div class="row">
					  			<div class="col-sm-12">
					  				<h4 class="text-uppercase">Subir nuevo archivo:</h4>
					  				<p class="instrucciones">Seleccionar archivo e indicar a que sección pertenece, <small>(maximo 5mb)</small></p>
					  				<form action="inc/upload_files.php" method="post" enctype="multipart/form-data" name="upload_files" class="upload_files_form">
										<p><input name="archivo" type="file">
									  	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></p>
									  	<p>
									  		<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="invierno_hoteles">Hoteles 
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="invierno_servicios">Servicios
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="invierno_itinerario">Itinerario 
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="invierno_contrato">Contrato
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="invierno_tarifario">Tarifario 
										  	</label>
									  	</p>
									  	<p class="p-relative"><input type="submit" value="Subir archivo" class="btn btn-xs btn-success">
									  	<span class="load-ajax"></span></p>
									</form>
					  			</div>
					  		</div>
					  	</div>
					</div><!-- //cierra panel -->
				</div><!-- //col -->
				<div class="col-md-4 col-sm-12">
					<div class="panel panel-primary">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Verano</h3>
						</div>
						<div class="panel-body">
						  	<ul class="lista-files">
						  		<li>
						  			<h4><u>Hoteles</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'verano_hoteles' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Servicios</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'verano_servicios' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Itinerario</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'verano_itinerario' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Contrato</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'verano_contrato' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Tarifario</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'verano_tarifario' ) ?>
							  		</div>
						  		</li>
						  	</ul>
					  		
					  		<div class="row"><br></div>
					  		<div class="row">
					  			<div class="col-sm-12">
					  				<h4 class="text-uppercase">Subir nuevo archivo:</h4>
					  				<p class="instrucciones">Seleccionar archivo e indicar a que sección pertenece, <small>(maximo 5mb)</small></p>
					  				<form action="inc/upload_files.php" method="post" enctype="multipart/form-data" name="upload_files" class="upload_files_form">
										<p><input name="archivo" type="file">
									  	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></p>
									  	<p>
									  		<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="verano_hoteles">Hoteles 
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="verano_servicios">Servicios
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="verano_itinerario">Itinerario 
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="verano_contrato">Contrato
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="verano_tarifario">Tarifario 
										  	</label>
									  	</p>
									  	<p  class="p-relative"><input type="submit" value="Subir archivo" class="btn btn-xs btn-success">
									  	<span class="load-ajax"></span></p>
									</form>
					  			</div>
					  		</div>
					  	</div>
					</div><!-- //cierra panel -->
				</div><!-- //col -->
				<div class="col-md-4 col-sm-12">
					<div class="panel panel-primary">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Otros</h3>
						</div>
						<div class="panel-body">
						  	<ul class="lista-files">
						  		<li>
						  			<h4><u>Cómo comprar</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'program_comprar' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Cómo pagar</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'program_pagar' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Cruz Roja</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'cruz_roja' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>UAI</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'program_uai' ) ?>
							  		</div>
						  		</li>
						  		<li>
						  			<h4><u>Certificaciones N8</u>:</h4>
						  			<div class="row">
							  			<?php printFileLoaded( 'file_uploads', 'certificaciones_n8' ) ?>
							  		</div>
						  		</li>
						  	</ul>
					  		
					  		<div class="row"><br></div>
					  		<div class="row">
					  			<div class="col-sm-12">
					  				<h4 class="text-uppercase">Subir nuevo archivo:</h4>
					  				<p class="instrucciones">Seleccionar archivo e indicar a que sección pertenece, <small>(maximo 5mb)</small></p>
					  				<form action="inc/upload_files.php" method="post" enctype="multipart/form-data" name="upload_files" class="upload_files_form">
										<p><input name="archivo" type="file" required>
									  	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></p>
									  	<p>
									  		<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="program_comprar">Comprar 
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="program_pagar">Pagar
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="cruz_roja">Cruz Roja 
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="program_uai">Uai
										  	</label>
										  	<label class="checkbox-inline">
										  		<input type="checkbox" name="programas[]" value="certificaciones_n8">N8 
										  	</label>
									  	</p>
									  	<p class="p-relative"><input type="submit" value="Subir archivo" class="btn btn-xs btn-success">
									  		<span class="load-ajax"></span>
									  	</p>
									</form>
					  			</div>
					  		</div>
					  	</div>
					</div><!-- //cierra panel -->
				</div><!-- //col -->
			</div><!-- //cierra row -->
		</div><!-- // container -->
		<!-- botones del modulo -->
	    <div class="modal-footer">
		    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		    <button type="button" class="btn btn-primary submit-save" data-btn="data-modulo">Guardar cambios</button>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div><!-- //modulo -->

<!-- Script del módulo específico -->
<script>
	$(document).ready(function() {
	
	/*
	* Subir archivo
	*/

	$( '.upload_files_form' ).on('submit', function( event ){
		event.preventDefault();

		var formulario = $( this );
		var formData = new FormData( formulario[0] );
		var imgAjax = $( '.load-ajax', this );
		var filetoUp = true;
		var formularioReady = false;
		//botones
		var btn = $('.btn',this)[0];
		//texto botones
		var btnNormalText = btn.value;
		var btnSavingText = 'subiendo';
		var btnSavedText = 'subido';

		//chequear si hay una opcion marcada
		for ( i = 2; i < 8; i++) {
			if ( formulario[0][i].checked)  {
				formularioReady = true;
				break;
				}
		}
		//chequea si hay un archivo cargado
		if ( (formulario[0][0].value == '')) {
			filetoUp = false;
			
		}

		if (formularioReady && filetoUp) {
			console.log('enviando formulario');

			$.ajax( {
				type: 'POST',
				url: 'inc/upload_file.php',
				data: formData,
				cache: false,
	            contentType: false,
	            processData: false,
	            //funcion antes de enviar
	            beforeSend: function() {
	            	//modifica textos de los botones
	            	btn.value = btnSavingText;
	            	imgAjax.fadeIn();
	            	console.log('enviando archivo');
	            },
				success: function ( response ) {
					console.log('El archivo se ha subido correctamente');
					
					//recarga el modulo
					$('.modal-body').load('inc/templates/programas-admin.php');

					//modifica textos de los botones
					btn.value = btnSavedText;
					//vuelve el texto del boton a inicio
					setTimeout(function(){btn.value = btnNormalText;},2000);
					//elimina la imagen del cargador
					imgAjax.fadeOut();
					//limpio el formulario
					formulario[0].reset();
					
				},
				error: function ( ) {
					console.log('error');
				},
			});//cierre ajax

		} else {
			if ( !formularioReady ) {
				$('.instrucciones').html('<strong>Debe seleccionar una opción a la que el archivo pertenecerá</strong>');
			}
			if ( !filetoUp ) {
				$('.instrucciones').html('<strong>No se cargó un archivo</strong>')		
			}
		}

	});//submit formulario

	

	/*
	* Borrar archivo
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
				url: 'inc/delete_file.php',
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
					$('.modal-body').load('inc/templates/programas-admin.php');
					//modifica textos de los botones
					btn.text(btnSavedText)
				},
				error: function ( ) {
					console.log('error');
				},
			});//cierre ajax

	});//click delete btn

	/*
	* cargar link en vez de archivo
	*/

	//oculta input para pegar link
	$( '.inner-input-link-wrapper' ).hide();

	$( '.link-btn' ).click(function(){
		var idBtn = $(this).attr('data-btn');
		//var classWrapperOut = '.outer-wrapper-btn-' + idBtn;
		var clasBTN = '.wrapper-to-upload-' + idBtn;
		//$( classWrapperOut ).fadeOut();
		$( clasBTN ).fadeIn();
		
		

	});//click .link-btn

	$( '.link-btn-cancel' ).click(function(){
		var Idbtn = '.wrapper-to-upload-' + $(this).attr('data-btn');
		$( Idbtn ).fadeOut();

	});//click .link-btn-cancel
		
	$( '.inner-input-link' ).change(function() {
		var data = {}
	  		data.post_type = $( this ).attr('data-btn');
	  		data.url = $( this ).val();

		//setTimeout(saveLink,1000);
		saveLink();

		function saveLink() {
	  		$.ajax( {
					type: 'POST',
					url: 'inc/upload_link.php',
					data: data,
		            //funcion antes de enviar
		            beforeSend: function() {
		            	//modifica textos de los botones
		            	console.log('guardando link');
		            	$( '.inner-input-link-wrapper' ).append( $('<p style="position: absolute;top:0; left:20px;color:darkred;">Guardando Link</p>') )
		            },
					success: function ( response ) {
						console.log('link guardado');
						console.log(response);
						//recarga el modulo
						$('.modal-body').load('inc/templates/programas-admin.php');
					},
					error: function ( ) {
						console.log('error');
					},
				});//cierre ajax
  		}
  
});//keyup

	/*
	* Save button desactivado porque no hay nada que guardar
	*/
		$('.submit-save').attr('disabled', 'disabled');


	})//ready
</script>