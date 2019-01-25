/*
TORNEOS Y EVENTOS
* esta parte viene del viejo admin
*/

$(document).ready(function(){

	$( "#accordionDeportes" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});


	//agregar seccion en deportes
	$(document).on('click', '#new-section-deportes-btn', function(){
		var contenedor = $('#accordionDeportes');
		var nombreSeccion = prompt('Agregue un nombre para identificar la nueva sección');
		var textoSeccion = prompt('Agregue un texto que se vera en la página para la sección');

		if (nombreSeccion == '') {
			nombreSeccion = prompt('ES NECESARIO AGREAGAR UN NOMBRE PARA IDENTIFICAR LA NUEVA SECCIÓN');
		}

		if (textoSeccion == '') {
			textoSeccion = prompt('ES NECESARIO AGREAGAR UN TEXTO QUE SE VA A VER EN LA PÁGINA PARA LA NUEVA SECCIÓN');
		}

		if (nombreSeccion == '') {
			return;
		}

		if (textoSeccion == '') {
			return;
		}

		nombreSeccion = getCleanedStringPLUS(nombreSeccion,"!@#$^&%*()+=[]'\"\/{}|:;¡¿<>?,.");

		contenedor.empty()
		var html = '<h3>'+nombreSeccion+'</h3><div><h4 class="deportes-section-title" data-nombre="'+nombreSeccion+'">'+textoSeccion+' | <small class="change-section-name-deportes-btn">Cambiar nombre u orden</small></h4><ul class="links-deportes" id="'+nombreSeccion+'"><li><button class="btn btn-warning btn-sm new-link-deportes-btn">Crear nuevo link</button></li></ul></div><hr>';
		contenedor.append($(html));
		
		$.ajax( {
	            type: 'POST',
	            url: ajaxFunctionDir + '/new-section-deportes.php',
	            data: {
	                post_type: 'section',
	                seccion: nombreSeccion,
	                url: '',
	                texto: textoSeccion,
	                orden: '0',
	            },
	            success: function ( response ) {
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
		
	});//agregar seccion en deportes


	//cambiar nombre de sección
	$(document).on('click', '.change-section-name-deportes-btn', function(){
		var contenedor = this.closest('.deportes-section-title');
		var idsection = $(contenedor).attr('data-nombre');
		var li = this.closest('div');
		var contenedorOrden = $(li).find('.orden-secciones-deportes span');

		var nombreSeccion = prompt('Agregue un nuevo texto o déjelo en blanco para mantener el actual');
		var orden = prompt('Agregue un nuevo orden numérico o déjelo en blanco para mantener el actual');
		$(contenedor).html(nombreSeccion);
		contenedorOrden.html(orden);

		//hay que modificar el nombre de la nueva seccion en base de datos
		$.ajax( {
	            type: 'POST',
	            url: ajaxFunctionDir + '/update-section-deportes.php',
	            data: {
	                seccion: idsection,
	                texto: nombreSeccion,
	                orden: orden,
	            },
	            success: function ( response ) {
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax
	});//cambiar nombre de sección

	//botones de borrar y cambiar archivos
	$(document).on('click', '.btn-del-file-deportes', function(){
		var li = $(this).closest('li')
		var id = $(this).closest('article').attr('id');
		
		//borrar item de la base de datos
		$.ajax( {
	            type: 'POST',
	            url: ajaxFunctionDir + '/delete-item-deportes.php',
	            data: {
	                idItem: id,
	            },
	            success: function ( response ) {
	            	$(li).remove();
	            },
	            error: function ( ) {
	                console.log('error');
	                $('.error-msj-deportes').html('No se pudo borrar');
	            },
	        });//cierre ajax
	});//borrar archivo deportes


	//cambiar archivo deportes
	$(document).on('click', '.btn-load-file-deportes', function(){
		
		var article = $(this).closest('article');
		var contenedor = article.find('.link-deportes-file')
		var url = baseUrl + '/uploads/pdfs/'

		$( "#dialog" ).dialog({
				title: 'Biblioteca de archivos',
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
			    	text: 'Insertar archivo',
			    	class: 'btn btn-success imagenes-galerias',
			    	click: function () {
			    		//se toma el nombre de la imagen
			    		var newFile = $('.previewAtachment').val();
			    		if ( newFile.length == 0 ) {
			    			$( this ).dialog( "close" );
			    			return;
			    		}
			    		contenedor.empty();
			    		var html = '<a href="'+url+newFile+'" target="_blank" data-href="'+newFile+'">'+newFile+'</a><br><small><span class="btn-load-file-deportes">Cambiar</span> o <span class="btn-del-file-deportes">Borrar</span> archivo</small>';
			    		contenedor.append($(html));
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( templatesDir + '/media-browser.php' );

	});//cambiar archivo deportes


	//agregar link archivo deportes (no hace nada en la BD hasta que se guardan los cambios)
	$(document).on('click', '.new-link-deportes-btn', function(){
		var id = $(this).closest('ul').attr('id');
		var IDcontenedor = '#'+id;
		var contenedor = $(IDcontenedor);
		var html = '<li><article class="link-deportes-wrapper" id="id"><div class="row"><div class="col-sm-2"><h4><small>Orden:</small></h4><input type="text" class="link-deportes-orden" value="0"></div><div class="col-sm-3"><input type="text" class="link-deportes-texto" value="Texto del link"></div><div class="col-sm-3"><div class="link-deportes-file"><small><span class="btn-load-file-deportes new">Cargar nuevo</span> archivo</small></div></div><div class="col-sm-2"><button class="btn btn-sm btn-info btn-save-file-deportes">Guardar cambios</button></div><div class="col-sm-2"><span class="error-msj-deportes"></span></div></div></article></li>';
		contenedor.prepend($(html));
	});//agregar link archivo deportes


	//guardar cambios link deportes
	$(document).on('click', '.btn-save-file-deportes', function(){
		
		var idSeccion = $(this).closest('ul').attr('id');
		var article = $(this).closest('article');
		var orden = article.find('.link-deportes-orden').val();
		var texto = article.find('.link-deportes-texto').val();
		var url = article.find('.link-deportes-file a').attr('data-href');
		var errormsj = article.find('.error-msj-deportes');
		var newItem = false;
		var idItem = article.attr('id');
		if (article.attr('id') == 'id' ) {
			newItem = true;	
		}

		//modificar la base de datos con nuevo archivo
		$.ajax( {
	            type: 'POST',
	            url: ajaxFunctionDir + '/save-item-deportes.php',
	            data: {
	                post_type: 'link',
	                seccion: idSeccion,
	                url: url,
	                texto: texto,
	                orden: orden,
	                newItem: newItem,
	                idItem: idItem,
	            },
	            beforeSend: function() {
	            	errormsj.html('guardando, espere');
            	},
	            success: function ( response ) {
	            	article.attr('id', response);
	            	errormsj.html('Elemento guardado');
	            },
	            error: function ( ) {
	                console.log('error');
	            },
	        });//cierre ajax

	});//guardar cambios link deportes

});//ready torneos y eventos