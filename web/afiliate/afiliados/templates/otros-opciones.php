<?php
load_module( 'opciones' );
?>
<div class="contenido-modulo">
	<div class="container-fluid">
		<div class="row">
			<!-- col -->
			<div class="col-md-6 col-sm-12">
				<div class="panel panel-primary">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Redes sociales</h3>
					</div>
					<div class="panel-body">
					  	<ul class="otras-opciones">
					  		<li>
					  			<label>
					  				Instagram:<br>
					  				<input id="social_instagram" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_instagram' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Pinterest:<br>
					  				<input id="social_pinterest" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_pinterest' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Twitter:<br>
					  				<input id="social_twitter" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_twitter' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Snapchat:<br>
					  				<input id="social_snapchat" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_snapchat' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Vimeo:<br>
					  				<input id="social_vimeo" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_vimeo' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Youtube:<br>
					  				<input id="social_youtube" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_youtube' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Spotify:<br>
					  				<input id="social_spotify" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_spotify' ); ?>">
					  			</label>
					  		</li>

					  		<li>
					  			<label>
					  				Facebook:<br>
					  				<input id="social_facebook" type="url" value="<?php printOtherOptions( 'file_uploads', 'social_facebook' ); ?>">
					  			</label>
					  		</li>

					  	</ul>
				  	</div>
				</div><!-- //cierra panel -->
			</div><!-- //col -->

			<!-- col -->
			<div class="col-md-6 col-sm-12">
				<div class="panel panel-primary">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">Teléfonos</h3>
					</div>
					<div class="panel-body">
					  	<ul class="otras-opciones">
					  		<li>
					  			<label>Teléfono a mostrar:
					  			<input id="telephone_show" type="text" value="<?php printOtherOptions( 'file_uploads', 'telephone_show' ); ?>">
					  			</label>
					  		</li>
					  		<li>
					  			<label>
					  			Teléfono en el link:
					  			<input id="telephone_url" type="number" value="<?php printOtherOptions( 'file_uploads', 'telephone_url' ); ?>">
					  			</label>
					  		</li>
					  	</ul>
				  	</div>
				</div><!-- //cierra panel -->
			</div><!-- //col -->

			<!-- col -->
			<div class="col-md-6 col-sm-12">
				<div class="panel panel-primary">
				  	<div class="panel-heading">
				    	<h3 class="panel-title">emails</h3>
					</div>
					<div class="panel-body">
					  	<ul class="otras-opciones">
					  		<li>
					  			<label>Formulario 1:
					  			<input id="email_form1" type="email" value="<?php printOtherOptions( 'file_uploads', 'email_form1' ); ?>">
					  			</label>
					  		</li>
					  		<li>
					  			<label>
					  			Formulario 2:
					  			<input id="email_form2" type="email" value="<?php printOtherOptions( 'file_uploads', 'email_form2' ); ?>">
					  			</label>
					  		</li>
					  	</ul>
				  	</div>
				</div><!-- //cierra panel -->
			</div><!-- //col -->

		</div><!-- //row -->
	</div><!-- // container -->
		<!-- botones del modulo -->
<footer class="footer-modulo container">
    <a type="button" href="index.php" class="btn">Volver al inicio</a>
    <a type="button" href="index.php?admin=editar-noticias" class="btn">Agregar nueva</a>
</footer>
	</div><!-- // wrapper interno modulo -->
<!-- Script del módulo específico -->
<script>
	$(document).ready(function() {
		
		/*
		* Detecta cambios para guardar solo lo que se modifica, al cambiar le agrega la clase changed
		*/

		$('input').change(function(){
			$(this).addClass('changed')
		});

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
			var data = {'otroslinks' : []};
			//inputs a recorrer
			var inputToSave = $('input');


			for ( i = 0; i < inputToSave.length; i++) {
				var inputValue = inputToSave[i].value;
				var inputID = inputToSave[i].id;
				var obj = {
					'inputValue': inputValue,
					'inputID': inputID
				}

				if ( inputToSave[i].className == 'changed' ) {
					data.otroslinks.push(obj);
				}
			}
				
			//envio la data al servidor para que se guarde
			$.ajax( {
					type: 'POST',
					url: 'inc/save-button.php',
					data: {
						section: section,
						otroslinks: data.otroslinks
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

	})//ready
</script>