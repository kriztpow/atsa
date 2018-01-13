$(document).ready(function () {
	
	/*
	EDITORIES ENRIQUECIDOS
	*/
	editoresEnriquecidos();

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
	});


	/*
	CLIC EN BOTON BORRAR CURSO
	*/
	$(document).on('click', '.btn-delete-curso', function(){
		var curso = $(this).attr('data-cursoid');
		var li = this.closest('li');
		
		if ( confirm( '¿Está seguro de querer BORRAR este curso?' ) ) {
			$.ajax( {
	            type: 'POST',
	            url: ajaxFunctionDir + '/delete-curso.php',
	            data: {
	                curso: curso,
	            },
	            success: function ( response ) {
	            	if (response == 'deleted') {
	            	//borra el slider del front
	                	$(li).remove()
	                }
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
		}//if
	});

	/*
	CLIC EN BOTON CREAR CURSO
	*/
	$(document).on('click', '#new-curso', function(){
		var error = $('.error-msj-list');
		var contenedor = $('.wrapper-cursos');
		$.ajax( {
            type: 'POST',
            url: ajaxFunctionDir + '/nuevo-curso.php',
            success: function ( response ) {
            	//console.log(response);
            	if ( response == 'error' ) {
            		var msj = $('<li> Hubo un error, intente más tarde</li>');
					error.append(msj);
					scrollHaciaArriba();
            	} else {
            		contenedor.prepend(response);
            		editoresEnriquecidos();
            		scrollHaciaArriba();
            	}
                
            },
            error: function ( ) {
                console.log('error');
            },
        });//cierre ajax

	});

	/*
	* Submit PAGE, GUARDAR CAMBIOS
	*/
	$(document).on('submit', 'form', function( event ){
	
		event.preventDefault();
		var error = $('.error-msj-list', this);
		
		var formulario = $( this );
		var formData = new FormData( formulario[0] );

		$.ajax({
			type: 'POST',
			url: ajaxFunctionDir + '/save-curso.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            },
			success: function ( response ) {
				console.log(response);
				var msj = $('<li>'+response+'</li>');
				error.append(msj);
				//scrollHaciaArriba();
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax


	});


});// ready


function editoresEnriquecidos () {
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
}