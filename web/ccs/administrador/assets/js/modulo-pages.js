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