$(document).ready(function () {
	
	/*
	EDITORIES ENRIQUECIDOS
	*/
	tinyMCE.init({
		selector: '.editor-enriquecido',
		toolbar1: 'bold, italic, underline, strikethrough, alignleft, aligncenter, alignright, alignjustify, bullist, numlist, undo, redo, link, image, media',
		toolbar2: 'formatselect, cut, copy, paste, blockquote, forecolor backcolor, removeformat, code',
		menubar: false,
		height: 200,
		plugins: [
		  'code advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
		  'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
		  'save table contextmenu directionality emoticons template paste textcolor colorpicker media',
		],
		branding: false,
		media_live_embeds: true,
		language: 'es',
		language_url: 'assets/lib/tinymce/langs/es.js',
		//mantiene sincronizado los cambios del editor con el textarea hidden
		setup: function (editor) {
	        editor.on('change', function () {
	            editor.save();
	        });
	    },
	    file_browser_callback : 
		function(field_name, url, type, win){
		var imagebrowser = templatesDir + '/media-browser-tinymce.php';
		tinymce.activeEditor.windowManager.open({
		title : "Insertar Medio",
		width : 780,
		height : 600,
		url : imagebrowser
		}, {
		window : win,
		input : field_name
		});
		return false;
		}
	});

	/*
	CLIC EN BOTON CAMBIAR IMAGEN
	*/
	$(document).on('click', '.btn-change-image', function(){

		var contenedor = this.closest('div');
		var input = $(contenedor).find('.change-image-input');
		var img = $(contenedor).find('img');

		$( "#dialog" ).dialog({
				title: 'Biblioteca de imágenes',
				autoOpen: false,
				appendTo: '.contenido-modulo',
				height: 600,
				width:768,
				modal: true,
				buttons: [
			    {
			    	text: "Cerrar",
			      	class: 'btn btn-default',
			      	click: function() {
				        $( this ).dialog( "close" );
			      	}
			    },
			    {
			    	text: 'Insertar imagenes',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		var contenedor = $('.galeria-imagenes-wrapper');
			    		//se toma el nombre de la imagen
			    		newImages = $('.previewAtachment');
			    		if ( newImages.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		for (var i = 0; i < newImages.length; i++) {
			    			nombreArchivo = $(newImages[i]).val();
			    			$(input).val(nombreArchivo);
			    			$(img).attr('src', uploadsDir+'/'+nombreArchivo);
			    			
			    		}
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( templatesDir + '/media-browser.php' );
	})

	/*
	GALERIA DE IMAGENES (MEDIA BROWSER)
	*/
	
	$( ".galeria-imagenes-wrapper" ).sortable({
		stop: function( event, ui ) {
			var item = 0;
			$('.imgGaleriaItemOrden').each(function(){
				$(this).html(item+1);
				item++;
			});
		},
	});

	//eliminar imagen galeria
	$(document).on('click', '.imgGaleriaItemDelBTN', function(){
		this.parentElement.remove();
	});//eliminar imagen galeria

	//agregar imagenes galeria
	$( ".galeria-imagenes-wrapper" ).disableSelection();

	$(document).on('click', '#agregar_imagenes_galeria', function(){
		
		$( "#dialog" ).dialog({
				title: 'Biblioteca de imágenes',
				autoOpen: false,
				appendTo: '.contenido-modulo',
				height: 600,
				width:768,
				modal: true,
				buttons: [
			    {
			    	text: "Cerrar",
			      	class: 'btn btn-default',
			      	click: function() {
				        $( this ).dialog( "close" );
			      	}
			    },
			    {
			    	text: 'Insertar imagenes',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		var contenedor = $('.galeria-imagenes-wrapper');
			    		//se toma el nombre de la imagen
			    		newImages = $('.previewAtachment');
			    		if ( newImages.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		for (var i = 0; i < newImages.length; i++) {
			    			nombreArchivo = $(newImages[i]).val();
			    			var html = '<li><input type="hidden" name="imgGaleriaItem" value="'+nombreArchivo+'"><figure><img src="'+uploadsDir+'/'+nombreArchivo+'" class="img-responsive"><span class="imgGaleriaItemOrden">0</span></figure><button class="btn btn-primary imgGaleriaItemDelBTN">Borrar imagen</button></li>';
			    			var node = $(html);
			    			contenedor.append(node);
			    		}
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( templatesDir + '/media-browser.php' );
	});//clic agregar imagenes galeria

	/*
	* Submit PAGE, GUARDAR CAMBIOS
	*/

	$('#editar-pagina-formulario').submit(function( event ){
		event.preventDefault();
		var error = $('.error-msj-list');
		
		var formulario = $( this );
		var formData = new FormData( formulario[0] );

		$.ajax({
			type: 'POST',
			url: ajaxFunctionDir + '/save-page.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            },
			success: function ( response ) {
				
				var msj = $('<li>'+response+'</li>');
				error.append(msj);
				scrollHaciaArriba();
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax


	});


});// ready














/*
	* Submit PAGE, GUARDAR CAMBIOS
	
	$('#editar-pagina-formulario').submit(function( event ){
		event.preventDefault();
		var error = $('.error-msj-list');
console.log('submit')
		//primero revalidamos que el titulo y el url esten,sino estan hay un error
		//el título no puede estar vacío
		if ( $('#post_title').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">El título de la noticia no puede estar vacía</li>');
			return;
		}
		//la url no puede estar vacía
		if ( $('#post_url').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">La URL no puede estar vacía</li>');
			return;
		}
		var galeriaImagenes = [];
		//procesa los datos de la galeria de imagenes y su orden actual
		var imagenes = $('.galeria-imagenes-wrapper').find('input');
		for (var i = 0; i < imagenes.length; i++) {
			
			galeriaImagenes.push( $(imagenes[i]).val() );

		}
		var formulario = $( this );
		var formData = new FormData( formulario[0] );
		formData.append('imgGaleria', galeriaImagenes);
		
		$.ajax({
			type: 'POST',
			url: ajaxFunctionDir + '/editor-backend.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            },
			success: function ( response ) {
				
				switch(response) {
					case 'saved':
						var slug = $('#post_url').val();
						var url = window.location.href;
						url += '&slug=';
						url += slug;
						window.location.href = url;
						break;

					case 'error-url':
						error.append( '<li class="error-msj-list-item-danger">Ya existe una entrada con ese URL</li>');
						break;

					case 'updated':
						error.append( '<li class="error-msj-list-item-danger">Los Cambios fueron guardados</li>');
						scrollHaciaArriba();
						break;					

					default:
						error.append( '<li class="error-msj-list-item-danger">Hubo un pequeño error</li>');
						break;
				}
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax
	});//submit #editar-noticia-formulario*/