/*
Las primeras son funciones realacionadas al editor de noticias
*/
$(document).ready(function(){
	//titulo del modulo
	$('#myModalLabel').html('Nueva Noticia');

	/*
	 Editor de noticias by tinyMCE
	*/
	tinyMCE.init({
		selector: '#post_contenido',
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
		var imagebrowser = "inc/templates/media-browser-tinymce.php";
		tinymce.activeEditor.windowManager.open({
		title : "Insertar imagen",
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
	 accordion by jquery ui
	*/
	$( "#accordion" ).accordion({
		heightStyle: "content",
		active: false,
			collapsible: true,
	});


	/*
	* editar la noticia / crear nueva noticia
	*/

	//coloca la fecha de hoy automaticamente si no hay fecha anterior:
	function setDate(date){
	    z=$(date).attr('value');

	    var today = new Date();
	    var dd = today.getDate();
	    var mm = today.getMonth()+1; //January is 0!

	    var yyyy = today.getFullYear();
	    if(dd<10){dd='0'+dd} 
	    if(mm<10){mm='0'+mm} 
	    today = yyyy+'-'+mm+'-'+dd;     

	    $(date).attr('value',today);
	}
	if ( $('#post_date').val() == '' ) {
		setDate('#post_date');
	}
	
	//limpia cadena de textos de caracteres raros
	function getCleanedString(cadena){
	   // Definimos los caracteres que queremos eliminar
	   var specialChars = "!@#$^&%*()+=[]'\"\/{}|:;¡¿<>?,.";

	   // Los eliminamos todos
	   for (var i = 0; i < specialChars.length; i++) {
	       cadena= cadena.replace(new RegExp("\\" + specialChars[i], 'gi'), '');
	   }   

	   // Lo queremos devolver limpio en minusculas
	   cadena = cadena.toLowerCase();

	   // Quitamos espacios y los sustituimos por - porque nos gusta mas asi
	   cadena = cadena.replace(/ /g,"-");

	   // Quitamos acentos y "ñ". Fijate en que va sin comillas el primer parametro
	   cadena = cadena.replace(/á/gi,"a");
	   cadena = cadena.replace(/é/gi,"e");
	   cadena = cadena.replace(/í/gi,"i");
	   cadena = cadena.replace(/ó/gi,"o");
	   cadena = cadena.replace(/ú/gi,"u");
	   cadena = cadena.replace(/ñ/gi,"n");
	   return cadena;
	}


	//coloca un url automáticamente
	$('#post_title').focusout(function(){
		//primero chequea que no tenga ya un url, si lo tiene se anula
		var titulo = $(this).val();
		var url = $('#post_url');

		if (url.val() == '') {
			var newTitulo = getCleanedString(titulo);
			url.val(newTitulo);
		}
	});

	//detecta el cambio de status y cambia el input de publicado a borrador para que al guardar se modifique en la base de datos
	$('#change_status').change(function(){
		var status = $(this).val();
		$('#post_status').val(status);
	});

	/*
	 Clic en los botones del formulario, se realiza algunas validaciones primero
	*/
	$('.btn-submit').click(function( event ){
		event.preventDefault();
		var error = $('.error-msj-list');

		//el título no puede estar vacío
		if ( $('#post_title').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">El título de la noticia no puede estar vacía</li>');
			return;
		}
		//la url no puede estar vacía
		if ( $('#post_url').val() == '' ) {
			error.append( '<li class="error-msj-list-item-danger">La URL no puede estar vacía</li>');
			return;
		} else {
			var url = $('#post_url').val();
			var urlTag = $('#post_url');
			var newURL = getCleanedString(url);
			urlTag.val(newURL);
		}

		//pasa las etiquetas a mayusculas que es como se guardan para evitar duplicados y le quita la coma final imnecesaria y la coma inicial q a veces está
		var etiquetas = $('#post_tags').val().toUpperCase();
		if ( etiquetas.lastIndexOf(",") == etiquetas.length-1 ) {
			etiquetas = etiquetas.substring(0, etiquetas.length-1);
		}
		//borra la doble coma, punto y otros
		etiquetas = etiquetas.replace(/,,/gi,",");
		etiquetas = etiquetas.replace(/;/gi,",");
		etiquetas = etiquetas.replace(/,,/gi,",");
		etiquetas = etiquetas.replace(/\./gi,",");
		etiquetas = etiquetas.replace(/:/gi,",");

		//borra la coma inicial si es por error
		if ( etiquetas.indexOf(",") == 0 ) {
			etiquetas = etiquetas.substring(1, etiquetas.length);
		}
		$('#post_tags').val(etiquetas);

		

		//ver que boton se hace clic para cambiar el estado
		var name = $(this).attr('name');
		//si es boton publicar
		if ( name == 'submit_publish' ) {
			
			if (confirm('¿Seguro que quiere publicar esta noticia?')) {
				//se cambia el status a publicado
				$('#post_status').val('publicado');
				//se hace submit al formulario
				$('#editar-noticia-formulario').submit();
			}
		} else {
			//si es el boton guardar primero se chequea si ya fue publicado o es un nuevo post
			if ( $('#post_status').val() == 'new' ) {
				//si es nuevo se pasa a borrador
				$('#post_status').val('borrador');	
				$('#editar-noticia-formulario').submit();
			} else {
				//sino, simplemente se hace submit
				$('#editar-noticia-formulario').submit();	
			}
		}
	});//click button

	/*
	* Submit POST form ajax
	*/
	$('#editar-noticia-formulario').submit(function( event ){
		event.preventDefault();
		var error = $('.error-msj-list');

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
		var imgAjax = $( '.load-ajax' );
		var formData = new FormData( formulario[0] );
		formData.append('imgGaleria', galeriaImagenes);
		//serializo la data del formulario para enviar
		//var data = $( this ).serialize();
		
		$.ajax({
			type: 'POST',
			url: 'inc/editor-backend.php',
			data: formData,
			cache: false,
		    contentType: false,
		    processData: false,
            //funcion antes de enviar
            beforeSend: function() {
            	console.log('enviando formulario');
            	imgAjax.fadeIn();
            },
			success: function ( response ) {
				imgAjax.fadeOut();
				console.log(response);
				//si hay un error de vuelve el error
				if ( response == '0' ) {
					error.append( '<li class="error-msj-list-item-danger">Hubo un pequeño error</li>');
				} else if (response == 'error-url') {
					error.append( '<li class="error-msj-list-item-danger">Ya existe una entrada con ese URL</li>');
				} else {
					
					error.append( '<li class="error-msj-list-item-danger">Los Cambios fueron guardados</li>');
					
				}
			},
			error: function ( error ) {
				console.log(error);
			},
		});//cierre ajax
	});//submit #editar-noticia-formulario

	//esta inscripción sirve solo para arreglar un defecto de integracio del editor tinymce
	$(document).on('focusin', function(e) {
	  if ($(e.target).closest(".mce-window").length) {
	    e.stopImmediatePropagation();
	  }
	});

});//ready()

/*
la segunda son botones relacionados con otras cosas, por ejemplo el boton para volver a noticias
*/


$(document).ready(function(){
//boton para volver a mostrar la lista de noticias
$('.back-to-news').click(backToNews);//click .back-to-news
});

//funcion para volver, se usa varias veces, así que declaro la función
function backToNews( event ){
event.preventDefault();

var data = {'modulo' : 'admin=noticias'};

$.ajax( {
	type: 'POST',
	url: 'inc/templates/modulos.php',
	data: data,
    //funcion antes de enviar
    beforeSend: function() {
    	//chequea si hay un modulo anterior para borrarlo
    	var moduloAnt = $('.wrapper-modulo')
    	if ( moduloAnt ) {
    		moduloAnt.remove();
    	}
    },
	success: function ( response ) {
		//borrar cargardor
		//insertar contenido
		$('.modal-body').append(response);
	},
	error: function ( error ) {
		console.log(error);
	},
});//cierre ajax
}

/*
SUBIR Y BORRAR IMAGEN DESTACADA
*/

$(document).ready(function () {
	//borrar imagen destacada
$('#imagen_destacada_wrapper').on('click', '#del-post_imagen', function(){
	
	if (confirm('Seguro quiere borrar la imagen')) {
		//borra la imagen del src para que no se vea
		$('.post_imagen').attr('src', '');
		//borra la imagen del input, para que al guardar se elimine en la bd
		$('#post_imagen').val('');

		//se borra el boton de borrar imagen
		$('#del-post_imagen').remove();
		//se agrega el de cargar imagen

		$('#upload-post_imagen_btn').remove();
		var html = $('<div class="upload-post_imagen_btn_wrapper"><button type="button" id="upload-post_imagen_btn" class="btn btn-info">Subir imagen</button><p><small>La imagen debería ser por lo menos de 1440 px por 545px</small></p></div>');
		$('#imagen_destacada_wrapper').append(html);
	}
});



//cargar imagen destacada
$(document).on('click','#upload-post_imagen_btn',function(){
	
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
		    	text: 'Insertar imagen',
		    	class: 'btn btn-success',
		    	click: function () {
		    		//se toma el nombre de la imagen, siempre la primera porque es UNA imagen destacada
		    		newImage = $('.previewAtachment')[0];
		    		newImage =  $(newImage).val();
		    		if ( newImage == '' ) {
		    			$( this ).dialog( "close" );
		    			return;
		    		}
		    		//se incluye la imagen en el input a guardar en base de datos, solo nombre
					$('#post_imagen').val(newImage);
					//se genera url completo de la imagen para mostrar ahora
					urlimg = 'http://' + window.location.host + '/uploads/images/' + newImage;
					//se imprime el html con el url de la imagen
					var innherHtml = '<img src="'+urlimg+'" class="img-responsive post_imagen"><button id="del-post_imagen" class="btn btn-danger">Borrar imagen</button>'
					var html = $(innherHtml);
					$('#imagen_destacada_wrapper').append(html);
					//se borra el boton de cargar imagen
					$('.upload-post_imagen_btn_wrapper').remove();
		    		//se cierra el dialogo
		    		$( this ).dialog( "close" );
		    	}
		    },
		  ],
		});
		$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
});

});// ready imagenDestacada ()

	
/*
GALERIA DE IMAGENES
*/

$(document).ready(function () {
	
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
			    			var html = '<li><input type="hidden" name="imgGaleriaItem" value="'+nombreArchivo+'"><figure><img src="/uploads/images/'+nombreArchivo+'" class="img-responsive"><span class="imgGaleriaItemOrden">0</span></figure><button class="btn btn-xs btn-danger imgGaleriaItemDelBTN">Borrar imagen</button></li>';
			    			var node = $(html);
			    			contenedor.append(node);
			    		}
			    		//se cierra el dialogo
			    		$( this ).dialog( "close" );
			    	}
			    },
			  ],
			});
			$( "#dialog" ).dialog( 'open' ).load( 'inc/templates/media-browser.php' );
	});//clic agregar imagenes galeria

	
});// ready galeria imagenes