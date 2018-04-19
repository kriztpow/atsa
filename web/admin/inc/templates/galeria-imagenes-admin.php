<?php
require_once("inc/functions.php");
?>
<div class="wrapper-modulo">
	<!-- wrapper interno modulo -->
	<div class="contenido-modulo">

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-8 col-sm-12">
					<!-- wrapper galeria -->
					<div class="wrapper-galeria">
						<div class="container-fluid">
							<h2>Galería de imágenes</h2>
								
							<?php //printImagesGalery(); ?>
						</div>
					</div><!-- // wrapper galeria -->
				</div>
				<div class="col-md-4 col-sm-12">
					<!-- wrapper form -->
					<aside id="wrapper-form-upload-galery">
						<div class="load-ajax"></div>
						<div class="container-fluid">
							
							<h4>Subir nuevas imágenes:</h4>	
							<p class="text-aclaracion">Se pueden subir más de uno simultaneamente, máximo 5mbs en total.</p>	
							<form action="inc/upload_images.php" method="post" enctype="multipart/form-data" name="upload_imgs" id="upload_imgs">
								<p><input name="archivo[]" type="file" multiple>
							  	<input type="hidden" name="MAX_FILE_SIZE" value="5000000" /></p>
							  	<p><input type="submit" value="Subir imágenes" class="btn btn-success"></p>
							</form>
						</div><!-- // container fluid form-->
					</aside><!-- // wrapper form -->
				</div>

				<div class="col-md-4 col-sm-12 instrucciones">
				
				</div>
			</div><!-- // row gral modulo -->
		</div><!-- // container gral modulo -->
		<!-- botones del modulo -->
	    <div class="modal-footer container">
		    <a type="button" href="index.php" class="btn btn-default">Volver al inicio</a>
		    <button type="button" class="btn btn-primary submit-save" data-btn="data-modulo">Guardar cambios</button>
	    </div>
	</div><!-- // wrapper interno modulo -->
</div>


<!-- Script subir las imagenes -->
<script>
	//subir imagenes galeria
	$(document).ready(function() {
		$( '.load-ajax' ).fadeOut();

		$( '#upload_imgs' ).on('submit', function( event ){
			event.preventDefault();

			var formulario = $( this );
			var imgAjax = $( '.load-ajax' );
			var formData = new FormData( formulario[0] );
			var post_type = 'galeria_imgs';
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
					//mostrar imagen en html
					
					var contenedor = $('.lista-imagenes');
					var nuevasImagenes = $.parseJSON(response);
					
					for (i=0; i<nuevasImagenes.length; i+=2) {
						var html = '<li class="imagen ui-sortable-handle"><article class="thumbnail"><div class="data-imagen" style="display: none;"><div><h1>Nombre Imagen: <small><input type="text" value="galeria_imgs1.jpg"></small></h1><p>Orden:<br>0 </p></div></div><input type="hidden" name="image_id" value="'+nuevasImagenes[i+1]+'"><input type="hidden" name="orden" value="0"><figure><img src="../uploads/'+nuevasImagenes[i]+'" alt="imagen-galeria" class="img-responsive"></figure></article></li>'
						contenedor.prepend( $(html) );
					}
					//se reinicial la función principal
					manipularGaleria();
				},
				error: function ( error ) {
					console.log('error');
				},
			});//cierre ajax

		}); //cierra subir imagenes galeria
	});
</script>


<script>
	/*
	* Funciones: Ordenar, imprime html instrucciones, muestra la info de las imagenes y save button
	*/
	$(document).ready( manipularGaleria() );

	//hice la función principal separada para volver a iniciarlo luego de algunos ajax
	function manipularGaleria() {

	/*
	* TEXTOS DE INSTRUCCIONES
	*/
	//texto de instrucciones
	var htmlConImagenes = '<h2>Instrucciones</h2><ul><li>Para ordenar las imágenes solo muevalas al lugar que considere</li><li>Tener en cuenta que actualmente estan organizadas primero de arriba hacia abajo y luego hacia la derecha</li><li>Para ver el orden actual, coloque el mouse sobre la imagen</li><li>Si quiere <strong>borrar</strong> alguna imagen, muévala al cuadrito de aquí abajo. Al pulsar guardar cambios se borrará, pero si se arrepiente puede quitarla del cuadrito y llevarla nuevamente a la galería.</li></ul>';
		htmlConImagenes += '<div class="container-fluid recicle-bin-wrapper"><h4>Borrar imágenes:</h4><p class="text-aclaracion">Mueva las imágenes aquí y guarde los cambios para borrarlas.</p><div id="recicle-bin" class="connectedSortable"></div></div>';
	
	var htmlSinImagenes = '<h2>Instrucciones</h2><ul><li>Para subir las imágenes utilizar el cuadrito aquí arriba.</li><li>Pueden subir más de un archivo a la vez pero en total no debe superar los 5mb</li><li>Guardar los cambios aplica solo a el orden de las imágenes.</li></ul>';

	//sortable jqueryUI para poder ordenar con el mouse la galería de imagenes
	$( '.lista-imagenes' ).sortable({
		connectWith: '.connectedSortable',
		stop: function( event, ui ) {
			//funcion que se ejecuta para rechequear el orden y escribir en html el nuevo orden para luego poder guardar en base de datos
			var imagenes = $('.imagen');
			var lista = [];

			for ( i = 0; i < imagenes.length; i++) {
				var image_id = imagenes[i].children[0].children[1].value;
				lista.push(image_id);
			}//cierra for

			for ( i = 0; i < imagenes.length; i++) {
				var image_id = lista[i];
				var nuevoOrden = i + 1;
				var input = 'input[name=image_id][value=' +image_id+ ']';
				var article = $(input).parent();
				var texto = article.children()[0].children[0].children[1].innerHTML;
				texto = 'Orden:<br>' + nuevoOrden;
				//imprime el numero para que el usuario lo vea
				article.children()[0].children[0].children[1].innerHTML = texto;
				//esto cambia el formulario para que luego al guardar los cambios la base de datos lo guarde
				article.children()[2].value = nuevoOrden;

			}//cierra for
		}//funcion stop sort
	});//sortable()

	$( '.lista-imagenes' ).disableSelection();

	var contenedor = $('.instrucciones');
	var imagenes = $('.imagen');
	var instrucciones;

	//si hay imagenes se imprime instrucciones con papelera de reciclaje
	if ( imagenes.length != 0 ) {
		contenedor.html('');
		instrucciones = $( htmlConImagenes );
		
		//imprimo instrucciones
		contenedor.append(instrucciones);

		//función papelera de reciclaje
		//que la lista de imagenes sea draggable
		$( '.lista-imagenes' ).draggable({
			revert: "invalid",
			containment: "document",
		      helper: "clone",
		      cursor: "move"
		});
		//preparo la papelera
		$( '#recicle-bin' ).sortable({
				connectWith: '.connectedSortable'
			});
		
		$( '#recicle-bin' ).droppable({
			accept: '.lista-imagenes > li',
		      drop: function( event, ui ) {
		      	console.log('imagen a borrar');
		      }
		    });
		  
		//sino hay imagenes las instrucciones son otras y la papelera no es necesaria
	} else {
		contenedor.html('');
		instrucciones = $( htmlSinImagenes );

		//imprimo instrucciones si no hay imagenes
		contenedor.append(instrucciones);
	}

	//oculta data de imagen
	$('.data-imagen').fadeOut();
	//muestra data de imagen on mouse hover
	$('.imagen').hover(
		function(){
			$(".data-imagen", this).fadeIn();
		}, function() {
			$('.data-imagen', this).fadeOut();
		}
	);//hover
	
	/*
	* Save button activar si está desactivado
	*/
	$('.submit-save').removeAttr('disabled');
	

	/*
	* Save button
	*/	

	$('.submit-save').click(function( event ){
		event.preventDefault();
		var section = $(this).attr('data-btn');
		var btn = $(this);
		//texto botones
		var btnNormalText = btn.html();
		var btnSavingText = 'guardando';
		var btnSavedText = 'guardado';

		//objeto a pasar al servidor
		var data = {'galeria' : [], 'recicleBin' : []};

		imgToDelete = $( '#recicle-bin' ).find('.imagen');

		for (i = 0; i < imgToDelete.length; i++) {
			imgToDelete[i].setAttribute('class', 'img-deleting');
			var image_id = imgToDelete[i].children[0].children[1].value;

			var obj = {
				'image_id': image_id
			}

			data.recicleBin.push(obj);
		}
		
		//galeria de imagenes		
		var imagenes = $('.imagen');

		for ( i = 0; i < imagenes.length; i++) {
			var image_id = imagenes[i].children[0].children[1].value;
			var orden = imagenes[i].children[0].children[2].value;
			
			var obj = {
				'image_id': image_id,
				'orden': orden
			}

			data.galeria.push(obj);
		}

		

		//envio la data al servidor para que se guarde
		$.ajax( {
				type: 'POST',
				url: 'inc/save-button.php',
				data: {
					section: section,
					galeria: data.galeria,
					recicleBin: data.recicleBin
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
					//recarga el modulo
					$('.modal-body').load('inc/templates/galeria-imagenes-admin.php');
				},
				error: function ( ) {
					console.log('error');
				},
		});//cierre ajax

	})//click save
}//manipular galeria()



</script>